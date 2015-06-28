<?php
//#####
//#####
//##### Store Commander - Installation module - http://www.storecommander.com
//#####
//#####

if (isset($_GET['DEBUG']))
	@ini_set('display_errors', 'on');
	
class StoreCommander extends Module {

	public $currentUrl = '';
	public $_err = array();
	private $url_zip_SC = "http://www.storecommander.com/files/StoreCommander.zip"; // for PHP < 5.5
	private $ioncubeReady = 2; // 2 = not set

	public function __construct()
	{
		$this->name		= 'storecommander';
		$this->tab		= 'administration';
		$this->version	= '1.3.7';
		$this->author	= 'Store Commander';
		$this->module_key	= '50e0efd3066f3d3b63fe2623fc55adf8';
		if (version_compare(phpversion(), '5.5', '>=')) // for PHP >= 5.5
			$this->url_zip_SC = 'http://www.storecommander.com/files/StoreCommanderPHP5.5.zip';
		parent::__construct();
		global $currentIndex;
		$this->currentUrl 				= $currentIndex;
		$this->page								= basename(__FILE__, '.php');
		$this->displayName 				= $this->l('Store Commander Installer');
		$this->description 				= $this->l('Install Store Commander to boost your backoffice.');
		$this->confirmUninstall 	= $this->l('Warning! This action definitely uninstall Store Commander!');
		$warning='';
		if (!is_writeable(_PS_ROOT_DIR_.'/modules/'.$this->name))
			$warning .= ' '.$this->l('The /modules/storecommander folder must be writable.');
		if(!$this->isIoncubeReady())
			$warning .= ' '.$this->l('ionCube is not installed!');
		if(!Configuration::get('SC_INSTALLED'))
			$warning .= ' '.$this->l('Store Commander is not installed!');
		if ($warning!='')
			$this->warning = $warning;
	}

	public function install()
	{
		if (		!parent::install()
				||	!Configuration::updateValue('SC_FOLDER_HASH', substr(md5(date("YmdHis")._COOKIE_KEY_),0,11))
				||	!$this->createSCFolder(Configuration::get('SC_FOLDER_HASH'))
				||	!Configuration::updateValue('SC_INSTALLED', false)
				)
			return false;
		Tools::redirectAdmin($this->currentUrl.'&configure='.$this->name.'&token='.Tools::getValue("token"));
		return true;
	}

	public function uninstall()
	{
		$qaccess=Db::getInstance()->ExecuteS("SELECT GROUP_CONCAT(`id_quick_access`) AS qaccess FROM `"._DB_PREFIX_."quick_access` WHERE `link` LIKE '%storecommander%'");
		if (count($qaccess) && $qaccess[0]['qaccess']!='')
		{
			Db::getInstance()->Execute("DELETE FROM `"._DB_PREFIX_."quick_access` WHERE id_quick_access IN (".psql($qaccess[0]['qaccess']).")");
			Db::getInstance()->Execute("DELETE FROM `"._DB_PREFIX_."quick_access_lang` WHERE id_quick_access IN (".psql($qaccess[0]['qaccess']).")");
		}
		$tab=new Tab(Tab::getIdFromClassName('AdminStoreCommander'));
		$tab->delete();
		$this->removeSCFolder(Configuration::get('SC_FOLDER_HASH'));
		Configuration::deleteByName('SC_FOLDER_HASH');
		Configuration::deleteByName('SC_INSTALLED');
		Configuration::deleteByName('SC_SETTINGS');
		Configuration::deleteByName('SC_LICENSE_DATA');
		Configuration::deleteByName('SC_LICENSE_KEY');
		Configuration::deleteByName('SC_VERSIONS');
		Configuration::deleteByName('SC_VERSIONS_LAST');
		Configuration::deleteByName('SC_VERSIONS_LAST_CHECK');
		
		parent::uninstall();
		return true;
	}

	private function createSCFolder($folder)
	{
		if (!is_dir(dirname(__FILE__).'/'.$folder))
			return mkdir(dirname(__FILE__).'/'.$folder);
	}

	private function removeSCFolder($folder)
	{
		if (is_dir(dirname(__FILE__).'/'.$folder))
			$this->rrmdir(dirname(__FILE__).'/'.$folder);
		return true;
	}

	private function rrmdir($dir)
	{
		if (is_dir($dir)) {
			$objects = scandir($dir);
			foreach ($objects as $object)
				if ($object != "." && $object != "..")
					if (filetype($dir."/".$object) == "dir") $this->rrmdir($dir."/".$object); else unlink($dir."/".$object);
			reset($objects);
			@rmdir($dir);
		}
		return true;
	}

	public function getContent()
	{
		$sql = "SELECT class_name FROM "._DB_PREFIX_."tab
				WHERE class_name = 'AdminStoreCommander'";
		$exists = Db::getInstance()->ExecuteS($sql);
		if(empty($exists[0]) || $exists[0]["class_name"]!="AdminStoreCommander")
		{
			$tab = new Tab();
			$tab->class_name = 'AdminStoreCommander';
			if (version_compare(_PS_VERSION_, '1.5.0.0', '>=')){
				$tab->id_parent = intval(Tab::getIdFromClassName('AdminParentModules'));
			}else{
				$tab->id_parent = intval(Tab::getIdFromClassName('AdminModules'));
			}
			$tab->module = $this->name;
			$tab->name[Configuration::get('PS_LANG_DEFAULT')] = 'StoreCommander';
			$tab->name[Language::getIdByIso('en')] = 'StoreCommander';
			$tab->name[Language::getIdByIso('fr')] = 'StoreCommander';
			$tab->add();
		}
		
		$_html  = '';
		$_html .= '<link type="text/css" rel="stylesheet" href="../modules/'.$this->name.'/css/admin.css" />'."\n";
		$_html .= '<script type="text/javascript" src="../modules/'.$this->name.'/js/loader/jquery.loader-min.js"></script>
					<script type="text/javascript">
						$(document).ready(function() {
							$(".loading").click(function() {
								setTimeout(\'document.location="\'+$(this).attr("href2")+\'"\',1000);
								$.loader({
									className:"blue-with-image-2",
									content:""
								});
							});
						});
					</script>'."\n";
		$_html .= $this->displayStep(Tools::getValue("sc_step"));
		return $_html;
	}

	private function displayStep($step)
	{
		global $cookie;
		$_html = '';
		switch((int)$step) {
			case 1 :
				if (Configuration::get('SC_INSTALLED'))
					Tools::redirectAdmin($this->currentUrl.'&configure='.$this->name.'&token='.Tools::getValue("token").'&sc_step=3');
				else if($this->isSCFolderReady()){
					Tools::redirectAdmin($this->currentUrl.'&configure='.$this->name.'&token='.Tools::getValue("token").'&sc_step=3');
				}else {
					$_html .= '
						<fieldset>
							<div class="conf"><img src="../modules/storecommander/img/ok2.png" alt="" /> '.$this->l('Ready for StoreCommander installation!').'</div>
							<a href2="'.$this->currentUrl.'&configure='.$this->name.'&token='.Tools::getValue("token").'&sc_step=2" class="sc_bouton loading">
								<p><strong>'.$this->l('First step').'</strong></p>
								<p>'.$this->l('Download and prepare StoreCommander').'</p>
							</a>
						</fieldset>
						'."\n";
				}
				break;

			case 2 :
				if (Configuration::get('SC_INSTALLED') || $this->isSCFolderReady())
					Tools::redirectAdmin($this->currentUrl.'&configure='.$this->name.'&token='.Tools::getValue("token").'&sc_step=3');
				else {
					if (!$this->downloadExtractSC()) {
						$this->_err[] = Tools::displayError('Error downloading StoreCommander');
						$this->displayErrors($this->_err);
					}else {
						if (file_exists(dirname(__FILE__).'/license.php'))
							@copy(dirname(__FILE__).'/license.php',_PS_MODULE_DIR_.$this->name.'/'.Configuration::get('SC_FOLDER_HASH').'/SC/license.php');
						Tools::redirectAdmin($this->currentUrl.'&configure='.$this->name.'&token='.Tools::getValue("token").'&sc_step=3');
					}
				}
				break;

			case 21 :
				if (!$this->isIoncubeReady()) {
					$this->_err[] = Tools::displayError($this->l('ionCube is not installed!'));
				}

				$_html .= $this->displayErrors($this->_err);
				$_html .= '
					<fieldset>
						<h4>'.$this->l('To run Store Commander you need the <u>ionCube PHP Loader</u> to be installed.').' '.$this->l('What is your hosting provider?').'</h4>

						<label for="sc_id_ovh" class="sc_indent">
							<input type="radio" name="sc_hoster" class="sc_hoster" value="OVH" id="sc_id_ovh" >
							<img src="../modules/'.$this->name.'/img/ovh.png" title="'.$this->l('OVH').'" />
							<span>'.$this->l('Shared hosting').'</span>
						</label>
						<label for="sc_id_ovh2" class="sc_indent">
							<input type="radio" name="sc_hoster" class="sc_hoster" value="OVH2" id="sc_id_ovh2" >
							<img src="../modules/'.$this->name.'/img/ovh.png" title="'.$this->l('OVH').'" />
							<span>'.$this->l('Dedicated server').'</span>
						</label>
						<label for="sc_id_1and1" class="sc_indent">
							<input type="radio" name="sc_hoster" class="sc_hoster" value="1AND1" id="sc_id_1and1" >
							<img src="../modules/'.$this->name.'/img/1and1.png" title="'.$this->l('1AND1').'" />
						</label>
						<label for="sc_id_owner" class="sc_indent">
							<input type="radio" name="sc_hoster" class="sc_hoster" value="OWNER" id="sc_id_owner" >
							<span>'.$this->l('Loader Wizard for the installation. Only for expert.').'</span>
						</label>
						<label for="sc_id_unknow" class="sc_indent">
							<input type="radio" name="sc_hoster" class="sc_hoster" value="UNKNOWN" id="sc_id_unknow" >
							<span>'.$this->l('You don\'t know').'</span>
						</label>

						<div id="go_OWNER" class="sc_result_step">
							<div class="sc_info">
								<h3>'.$this->l('Read the following English instructions :').'</h3>
								<p><a href="../modules/'.$this->name.'/'.Configuration::get('SC_FOLDER_HASH').'/SC/ioncube/loader-wizard.php" target="_blank">Loader Wizard</a></p>
								<p><a href="http://www.ioncube.com/loader_installation.php" target="_blank">Loader Installation</a></p>
								<p class="center"><strong>'.$this->l('After install loader, you must refresh this page.').'</strong></p>
							</div>
							<a href2="'.$this->currentUrl.'&configure='.$this->name.'&token='.Tools::getValue("token").'&sc_step=3" class="sc_bouton refresh loading">
								<p>'.$this->l('You just installed<br />ionCube PHP Loader<br /><b>Refresh to continue</b>').'</p>
							</a>
						</div>
						<div id="go_UNKNOWN" class="sc_result_step">
							<div class="sc_info">
								<h3>'.$this->l('Don\'t worry!').'</h3>
								<p>'.$this->l('You need to contact your hosting provider to ask :').'</p>
								<p class="center">'.$this->l('"How to install ioncube on my website?".').'</p>
								<p class="center"><strong>'.$this->l('After install loader, you must refresh this page.').'</strong></p>
							</div>
							<a href2="'.$this->currentUrl.'&configure='.$this->name.'&token='.Tools::getValue("token").'&sc_step=3" class="sc_bouton refresh loading">
								<p>'.$this->l('You just installed<br />ionCube PHP Loader<br /><b>Refresh to continue</b>').'</p>
							</a>
						</div>
						<div id="go_OVH" class="sc_result_step">
							<div class="sc_info">
								<h3>'.$this->l('We will carry out an automatic configuration:').'</h3>
								<p>'.$this->l('Few lines will be added to the .htaccess file in the new StoreCommander secure directory.').'</p>
								<p class="center"><strong>'.$this->l('After the installation, the page is refreshed automatically.').'</strong></p>
							</div>
							<a href2="'.$this->currentUrl.'&configure='.$this->name.'&token='.Tools::getValue("token").'&sc_step=22" class="sc_bouton loading">
								<p><strong>'.$this->l('Step 2').'</strong></p>
								<p>'.$this->l('Create the ionCube<br /><b>OVH</b> configuration').'</p>
							</a>
						</div>
						<div id="go_OVH2" class="sc_result_step">
							<div class="sc_info">
								<h3>'.$this->l('Don\'t worry!').'</h3>
								<p>'.$this->l('You need to contact your hosting provider to ask :').'</p>
								<p class="center">'.$this->l('"How to install ioncube on my website?".').'</p>
								<p class="center"><strong>'.$this->l('After install loader, you must refresh this page.').'</strong></p>
							</div>
							<a href2="'.$this->currentUrl.'&configure='.$this->name.'&token='.Tools::getValue("token").'&sc_step=3" class="sc_bouton refresh loading">
								<p>'.$this->l('You just installed<br />ionCube PHP Loader<br /><b>Refresh to continue</b>').'</p>
							</a>
						</div>
						<div id="go_1AND1" class="sc_result_step">
							<div class="sc_info">
								<h3>'.$this->l('We will carry out an automatic configuration:').'</h3>
								<p>'.$this->l('Few lines will be added to the php.ini file in the new StoreCommander secure directory.').'</p>
								<p class="center"><strong>'.$this->l('After the installation, the page is refreshed automatically.').'</strong></p>
							</div>
							<a href2="'.$this->currentUrl.'&configure='.$this->name.'&token='.Tools::getValue("token").'&sc_step=23" class="sc_bouton loading">
								<p><strong>'.$this->l('Step 2').'</strong></p>
								<p>'.$this->l('Create the ionCube<br /><b>1AND1</b> configuration').'</p>
							</a>
						</div>

						<script type="text/javascript">
							$(document).ready(function() {
								$("div.sc_result_step").hide();
								$("input:radio[name=sc_hoster]").hide();
								$("input:radio[name=sc_hoster]").click(function() {
									$("label.sc_indent").removeClass("sc_true");
									$("div.sc_result_step").hide();
									switch($(this).val()) {
										case "OVH" :
											$("#go_OVH").fadeIn();
											$(this).parent().addClass("sc_true");
											break;
										case "OVH2" :
											$("#go_OVH2").fadeIn();
											$(this).parent().addClass("sc_true");
											break;
										case "1AND1" :
											$("#go_1AND1").fadeIn();
											$(this).parent().addClass("sc_true");
											break;
										case "OWNER" :
											$("#go_OWNER").fadeIn();
											$(this).parent().addClass("sc_true");
											break;
										case "UNKNOWN" :
											$("#go_UNKNOWN").fadeIn();
											$(this).parent().addClass("sc_true");
											break;
									}
								});
							});
						</script>
					</fieldset>
					'."\n";
				break;

			case 22 : // OVH CONFIG + DOWNLOAD/EXTRACT SC
				file_put_contents(
									_PS_MODULE_DIR_.$this->name.'/.htaccess',
									"SetEnv IONCUBE 1\nSetEnv ZEND_OPTIMIZER 0\nSetEnv PHP_VER 5"
									);
				file_put_contents(
									_PS_MODULE_DIR_.$this->name.'/'.Configuration::get('SC_FOLDER_HASH').'/.htaccess',
									"SetEnv IONCUBE 1\nSetEnv ZEND_OPTIMIZER 0\nSetEnv PHP_VER 5"
									);
				Tools::redirectAdmin($this->currentUrl.'&configure='.$this->name.'&token='.Tools::getValue("token").'&sc_step=3');
				break;

			case 23 : // 1AND1 CONFIG + DOWNLOAD/EXTRACT SC
				function is_64bit() {
					$int = "9223372036854775807";
					$int = intval($int);
					if ($int == 9223372036854775807) /* 64bit */
						return true;
					elseif ($int == 2147483647) /* 32bit */
						return false;
					else
						return false;
				}
				$PHPversion = explode('.',PHP_VERSION);
				$data="zend_extension = ".$_SERVER['DOCUMENT_ROOT'].__PS_BASE_URI__.'modules/'.$this->name.'/'.Configuration::get('SC_FOLDER_HASH')."/SC/ioncube".(is_64bit()?"-64":"")."/ioncube_loader_lin_".$PHPversion[0].".".$PHPversion[1].".so\nallow_url_fopen = on";
				file_put_contents(_PS_MODULE_DIR_.$this->name.'/php.ini',$data);
				file_put_contents(_PS_MODULE_DIR_.$this->name.'/'.Configuration::get('SC_FOLDER_HASH').'/SC/php.ini',$data);
				file_put_contents(_PS_MODULE_DIR_.$this->name.'/'.Configuration::get('SC_FOLDER_HASH').'/SC_TOOLS/php.ini',$data);
				Tools::redirectAdmin($this->currentUrl.'&configure='.$this->name.'&token='.Tools::getValue("token").'&sc_step=3');
				break;

			case 3 :
				if ($this->isIoncubeReady())
				{
					$this->createTab();
					Configuration::updateValue('SC_INSTALLED', true);
				}else {
					Tools::redirectAdmin($this->currentUrl.'&configure='.$this->name.'&token='.Tools::getValue("token").'&sc_step=21');
				}
				$_html .= '
					<fieldset>'.$this->l('Store Commnander is installed. You can launch the application from the Quick access menu.').'<br/>
						<a href="index.php?tab=AdminStoreCommander&token='.Tools::getAdminToken('AdminStoreCommander'.intval(Tab::getIdFromClassName('AdminStoreCommander')).intval($cookie->id_employee)).'" target="_blank" class="sc_bouton">
							<p><strong>'.$this->l('Go to<br/>StoreCommander').'</strong></p>
						</a>
					</fieldset>
					'."\n";
				break;

			default :
				if(!$this->isSCFolderReady())
					Tools::redirectAdmin($this->currentUrl.'&configure='.$this->name.'&token='.Tools::getValue("token").'&sc_step=1');
				elseif(!$this->isIoncubeReady())
					Tools::redirectAdmin($this->currentUrl.'&configure='.$this->name.'&token='.Tools::getValue("token").'&sc_step=21');
				else
					Tools::redirectAdmin($this->currentUrl.'&configure='.$this->name.'&token='.Tools::getValue("token").'&sc_step=3');
				break;
		}
		return $_html;
	}

	private function createTab()
	{
		if (!Tab::getIdFromClassName('AdminStoreCommander'))
		{
			$tab=new Tab();
			$tab->class_name='AdminStoreCommander';
			$tab->id_parent=intval(Tab::getIdFromClassName((version_compare(_PS_VERSION_, '1.5.0.0', '>=')?'AdminParentModules':'AdminModules')));
			$tab->module=$this->name;
			foreach (Language::getLanguages(false) AS $language)
				$tab->name[$language["id_lang"]]='Store Commander';
			$tab->add();
			@copy(_PS_MODULE_DIR_ . $this->name . '/logo.gif', _PS_IMG_DIR_ . 't/AdminStoreCommander.gif');
		}
		
		$sql = 'SELECT id_quick_access AS id FROM `'._DB_PREFIX_.'quick_access` q WHERE q.`link` LIKE \'%AdminStoreCommander%\'';
		$result = Db::getInstance()->getRow($sql);
		if (count($result) == 0)
		{
			$quickAccess= new QuickAccess();
			$tmp=array();
			$languages=Language::getLanguages();
			foreach($languages AS $lang){
				$tmp[$lang['id_lang']]="Store Commander";
			}
			$quickAccess->name=$tmp;
			if (version_compare(_PS_VERSION_, '1.5.0.0', '>='))
			{
				$quickAccess->link="index.php?controller=AdminStoreCommander";
			}else{
				$quickAccess->link="index.php?tab=AdminStoreCommander";
			}
			$quickAccess->new_window=true;
			$quickAccess->add();
		}
	}

	function isSCFolderReady()
	{
		if (file_exists(dirname(__FILE__).'/'.Configuration::get('SC_FOLDER_HASH').'/SC/index.php')) return true;
		return false;
	}
	
	function isIoncubeReady()
	{
		if ($this->ioncubeReady < 2) return $this->ioncubeReady;
		if (extension_loaded('ionCube Loader') || function_exists('ioncube_loader_version'))
		{
			$this->ioncubeReady=1;
			return true;
		}
		$this->ioncubeReady=($this->sc_file_get_contents((isset($_SERVER['HTTPS'])?'https://':'http://').$_SERVER['HTTP_HOST'].__PS_BASE_URI__.'modules/'.$this->name.'/ioncube-test.php')=="1"?1:0); 
		if ($this->ioncubeReady) return true;
		return false;
	}
	
	function sc_file_get_contents($param,$querystring='')
	{
		$result='';
		if (function_exists('file_get_contents')) {
			@$result=file_get_contents($param);
		}
		if ($result=='' && function_exists('curl_init')) {
			$curl = curl_init();
			$header[0] = "Accept: text/xml,application/xml,application/xhtml+xml,";
			$header[0] .= "text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5";
			$header[] = "Cache-Control: max-age=0";
			$header[] = "Connection: keep-alive";
			$header[] = "Keep-Alive: 300";
			$header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
			$header[] = "Accept-Language: en-us,en;q=0.5";
			$header[] = "Pragma: ";
			curl_setopt($curl, CURLOPT_URL, $param);
			curl_setopt($curl, CURLOPT_USERAGENT, 'Store Commander (http://www.storecommander.com)');
			curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
			curl_setopt($curl, CURLOPT_ENCODING, 'gzip,deflate');
			curl_setopt($curl, CURLOPT_AUTOREFERER, true);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $querystring);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 20);
			curl_setopt($curl, CURLOPT_TIMEOUT, 20);
			$result= curl_exec($curl);
			$info=curl_getinfo($curl);
			curl_close($curl);
			if ((int)$info['http_code']!=200) { return ''; }
		}
		return $result;
	}
	
	private function downloadExtractSC() {
		$data=$this->sc_file_get_contents($this->url_zip_SC);
		file_put_contents(_PS_MODULE_DIR_.$this->name.'/'.basename($this->url_zip_SC),$data);
		return $this->extractArchive(_PS_MODULE_DIR_.$this->name.'/'.basename($this->url_zip_SC));
	}

	
	private function extractArchive($file)
	{
		global $currentIndex;
		$success = true;
		require_once(dirname(__FILE__).'/pclzip.lib.php');
		$zip = new PclZip($file);
		$list = $zip->extract(PCLZIP_OPT_PATH, _PS_MODULE_DIR_.$this->name.'/'.Configuration::get('SC_FOLDER_HASH'));
		foreach ($list as $extractedFile)
			if ($extractedFile['status'] != 'ok')
				$success=false;
		@unlink($file);
		return $success;
	}

	public function displayErrors($errors)
	{
		if(is_array($errors) && count($errors))
		{
			$_html = '<div class="error">';
			foreach ($errors AS $error)
				$_html .= '<p><img src="../modules/storecommander/img/error2.png" />&nbsp;'.$error.'</p>';
			$_html .= '</div>';
			return $_html;
		}
	}
}
