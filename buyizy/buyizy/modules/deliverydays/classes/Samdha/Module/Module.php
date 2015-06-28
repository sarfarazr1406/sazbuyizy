<?php
/**
 * Module base
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this module to newer
 * versions in the future. If you wish to customize this module for your
 * needs please refer to http://doc.prestashop.com/display/PS15/Overriding+default+behaviors
 * #Overridingdefaultbehaviors-Overridingamodule%27sbehavior for more information.
 *
 * @category  Prestashop
 * @category  Module
 * @author    Samdha <contact@samdha.net>
 * @copyright Samdha
 * @license   commercial license see license.txt
 */

/* $this->l('Error while downloading module.', 'Samdha_Module_Module'); */

class Samdha_Module_Module extends Module
{

	public $context;
	public $errors = array();
	public $warnings = array(); /* @since 1.2.0.0 */
	public $config_arrays_keys = array();
	public $config_global = false; /* get configuration by shop */
	public $short_name = 'samdha';
	public $need_licence_number = true;
	public $description_big = '';
	public $id_addons = false;

	const INSTALL_SQL_FILE = 'install.sql';
	const UNINSTALL_SQL_FILE = 'uninstall.sql';

	public $author = 'Samdha';
	public $need_instance = 0;
	public $toolbar_btn = array();
	public $samdha_tools;
	public $config;
	public $licence;
	public $bootstrap = true;

	public function __construct()
	{
		/* Backward compatibility */
		if (version_compare(_PS_VERSION_, '1.5.0.0', '<') && file_exists(_PS_MODULE_DIR_.$this->name.'/backward_compatibility/backward.php'))
			require(_PS_MODULE_DIR_.$this->name.'/backward_compatibility/backward.php');

		parent::__construct();
		$this->samdha_tools = new Samdha_Module_Tools($this);
		$this->config = new Samdha_Module_Configuration($this);
		$this->licence = new Samdha_Module_Licence($this);

		if (file_exists(_PS_MODULE_DIR_.$this->name.'/config/config.ini.php'))
		{
			$configs = parse_ini_file(_PS_MODULE_DIR_.$this->name.'/config/config.ini.php');
			foreach ($configs as $key => $value)
				$this->$key = $value;
		}
		else
		{
			$this->support_url = 'https://addons.prestashop.com/contact-community.php?id_product=%d&content_only=1&licence_number=%s&lang=%s#contact-form';
			$this->support_url_https = 'https://addons.prestashop.com/contact-community.php?id_product=%d&content_only=1&licence_number=%s&lang=%s#contact-form';
			$this->documentation_url = '../modules/%s/help/index.php?setlang=%s';
			$this->documentation_url_https = '../modules/%s/help/index.php?setlang=%s';
			$this->home_url = 'https://addons.prestashop.com/%s/2_community?contributor=5716&utm_source=module&utm_medium=prestashop&utm_content=homelink&utm_campaign=%s';
			$this->contact_url = 'https://addons.prestashop.com/contact-community.php?id_product=%d&utm_source=module&utm_medium=prestashop&utm_content=contactlink&utm_campaign=%s#contact-form';
		}
	}

	public function uninstall()
	{
		return parent::uninstall() && $this->config->delete();
	}

	public function postProcess($token)
	{
		$module_url = AdminController::$currentIndex.'&module_name='.$this->name.'&configure='.$this->name.'&conf=6&token='.$token;

		if (Tools::isSubmit('saveSettings'))
		{
			$this->config->update($this->samdha_tools->stripSlashesArray(Tools::getValue('setting')));
			$url = $module_url.'&conf=6';
			if (Tools::getValue('active_tab'))
				$url .= '&active_tab='.Tools::getValue('active_tab');
			Tools::redirectAdmin($url);
		}

		if (Tools::isSubmit('saveLicence'))
		{
			$this->licence->saveLicence(Tools::getValue('licence_number'));
			Tools::redirectAdmin($module_url.'&conf=6');
		}

		if (Tools::getValue('updateModule'))
		{
			try
			{
				$this->licence->update();
				Tools::redirectAdmin($module_url.'&postUpdateModule=1');
			} catch (Exception $e)
			{
				$this->errors[] = $this->l($e->getMessage(), 'Module');
				$this->errors[] = $this->l('Can\'t update the module.', 'Module');
			}
		}

		if (Tools::getValue('postUpdateModule'))
		{
			$this->postUpdateModule();
			Tools::redirectAdmin($module_url.'&conf=4');
		}

		if ($this->need_licence_number && $this->samdha_tools->canAccessInternet())
		{
			if (version_compare(_PS_VERSION_, '1.2.0.0', '<'))  // for translation with Prestashop 1.x
			{
				$tmp_page = $this->page;
				$this->page = 'Module';
			}

			if (!$this->licence->checkLicence())
			{
				if ($license_number = Configuration::get($this->short_name.'_licence'))
				{
					$message = sprintf($this->l('The current license number "%s" is not valid for this domain.', 'Module'), $license_number);
					$message .= ' <a class="module_help" href="http://prestawiki.samdha.net/wiki/Samdha:faq#wrong_license">?</a>';
					$this->errors[] = $message;
				}
				$message = '<a style="text-decoration: none;" href="'.$this->licence->getLicenceURL().'" target="_blank" class="module_support">';
				$message .= $this->l('This module is not registered. Why do not do it now ? It\'s free.', 'Module');
				$message .= '</a> <a class="module_help" href="http://prestawiki.samdha.net/wiki/Samdha:faq#register">?</a>';
				$this->warnings[] = $message;
			}
			elseif ($this->licence->checkModuleVersion() == 'NEED_UPDATE')
				$this->warnings[] = $this->l('There is a new version of this module. you can', 'Module')
						.' <a style="text-decoration: underline;" href="'.$module_url.'&updateModule=1">'.$this->l('update now', 'Module').'</a>.';

			if (version_compare(_PS_VERSION_, '1.2.0.0', '<')) // for translation with Prestashop 1.x
				$this->page = $tmp_page;
		}
	}

	public function getContent($tab = 'AdminModules')
	{
		$cookie = $this->context->cookie;
		$smarty = $this->context->smarty;

		if (version_compare(_PS_VERSION_, '1.4.9.0', '<'))
		{
			if (method_exists($this->context->smarty, 'register_modifier'))
			{
				$this->context->smarty->unregister_modifier('unescape');
				$this->context->smarty->register_modifier('unescape', array($this->samdha_tools, 'smartyModifiercompilerUnescape'));
			}
			else
			{
				$this->context->smarty->unregisterPlugin('modifier', 'unescape');
				$this->context->smarty->registerPlugin('modifier', 'unescape', array($this->samdha_tools, 'smartyModifiercompilerUnescape'));
			}
		}

		// load generic translations
		if (is_object($cookie) && isset($cookie->id_lang))
		{
			$iso_lang = Language::getIsoById($cookie->id_lang);
			$file = _PS_MODULE_DIR_.$this->name.DIRECTORY_SEPARATOR.'translations'.DIRECTORY_SEPARATOR.'samdha_'.$iso_lang.'.php';
			if (file_exists($file))
			{
				global $_MODULES, $_MODULE;
				$_MODULE = array();
				include($file);
				$_MODULES = !empty($_MODULES) ? $_MODULES + $_MODULE : $_MODULE; //we use "+" instead of array_merge() because array merge erase existing values.
			}
		}

		if (method_exists('Tools', 'getAdminToken') && isset($cookie->id_employee))
			$token = Tools::getAdminToken($tab.(int)Tab::getIdFromClassName($tab).(int)$cookie->id_employee);
		else
			$token = 1;

		$smarty->compile_check = true;
		$this->postProcess($token);

		if (version_compare(_PS_VERSION_, '1.5.0.0', '<'))
			$output = '<h2>'.$this->displayName.'</h2>';
		elseif (version_compare(_PS_VERSION_, '1.6.0.0', '<'))
			$output = $this->displayToolBar(AdminController::$currentIndex, $token);
		else
		{
			$output = '';
			if (is_object($this->context->controller) && is_array($this->context->controller->css_files))
			{
				foreach ($this->context->controller->css_files as $file => $media)
				{
					if (strpos($file, 'base/jquery.ui.theme.css') !== false)
					{
						unset($this->context->controller->css_files[$file]);
						break;
					}
				}
			}
		}

		$output .= $this->displayWarnings($this->warnings); // @since 1.2.0.0
		$output .= $this->displayErrors($this->errors);

		$output .= $this->displayForm($token);

		return $output;
	}

	private function displayToolBar($current_index, $token)
	{
		if ($this->need_licence_number && $this->samdha_tools->canAccessInternet())
		{
			if (!$this->licence->checkLicence())
			{
				$this->toolbar_btn['register'] = array(
					'href' => $this->licence->getLicenceURL(),
					'desc' => $this->l('Register this module', 'Module'),
					'target' => true
				);
			}
			elseif ($this->licence->checkModuleVersion() == 'NEED_UPDATE')
			{
				$this->toolbar_btn['update'] = array(
					'href' => $current_index.'&amp;configure='.$this->name.'&amp;updateModule=1&amp;token='.$token,
					'desc' => $this->l('Update this module now', 'Module')
				);
			}
		}

		$back = $current_index.'&token='.$this->context->controller->token.'&module_name='.$this->name;
		$back .= '&tab_module='.$this->tab.'&anchor=anchor'.Tools::ucfirst($this->name);
		$this->toolbar_btn['back'] = array(
			'href' => $back,
			'desc' => $this->l('Back to list', 'Module')
		);

		$this->context->smarty->assign(array(
			'toolbar_btn' => $this->toolbar_btn,
			'toolbar_scroll' => true,
			'title' => $this->displayName,
			'table' => $this->short_name
		));
		$output = $this->context->smarty->fetch('toolbar.tpl');
		$output .= '
			<style type="text/css">
				.toolbarBox .process-icon-register {
					background-image: url("https://ssl.1and1.fr/support.samdha.net/img/Gnome-Dialog-Password-32.png");
				}
				.toolbarBox .process-icon-update {
					background-image: url("https://ssl.1and1.fr/support.samdha.net/img/Gnome-System-Software-Update-32.png");
				}
			</style>
		';
		return $output;
	}

	private function displayErrors($messages)
	{
		$nb_errors = count($this->errors);
		$output = '';
		if ($nb_errors)
		{
			if (method_exists($this, 'displayError'))
				foreach ($messages as $message)
					$output .= $this->displayError($message);
			else
			{
				if (version_compare(_PS_VERSION_, '1.2.0.0', '<'))  // for translation with Prestashop 1.x
				{
					$tmp_page = $this->page;
					$this->page = 'Module';
				}

				$output .= '
					<p class="warning clear" style="width: auto">
						<h3>'.($nb_errors > 1 ? $this->l('There are', 'Module') : $this->l('There is', 'Module')).'
						'.$nb_errors.' '.($nb_errors > 1 ? $this->l('errors', 'Module') : $this->l('error', 'Module')).'
						</h3>
						<ol>
				';
				foreach ($messages as $message)
					$output .= '<li>'.$message.'</li>';
				$output .= '
					</ol>
				</div>';

				if (version_compare(_PS_VERSION_, '1.2.0.0', '<')) // for translation with Prestashop 1.x
					$this->page = $tmp_page;
			}
		}
		return $output;
	}

	/**
	 * @since 1.2.0.0
	 */
	private function displayWarnings($messages)
	{
		$output = '';
		if (!empty($messages))
		{
			if (method_exists($this, 'displayWarning'))
			{
				foreach ($messages as $message)
					$output .= $this->displayWarning($message);
			}
			else
			{
				if (version_compare(_PS_VERSION_, '1.4.0.0', '<'))
				{
					if (!defined('_PS_ADMIN_IMG_')) // PS 1.0
						define('_PS_ADMIN_IMG_', _PS_IMG_.'admin/');

					$output .= '<style>#content .warn {border: 1px solid #D3C200;background-color: #FFFAC6;color: #383838;font-weight: 700;';
					$output .= 'margin: 0 0 10px 0;line-height: 20px;padding: 10px 15px;}</style>';
					foreach ($messages as $message)
					{
						$output .= '<div class="warn clear" style="margin-bottom: 10px;">';
						$output .= '<img src="http://addons.prestashop.com/img/admin/warn2.png"> '.$message.'</div>';
					}
				}
				elseif (version_compare(_PS_VERSION_, '1.5.0.0', '<'))
				{
					foreach ($messages as $message)
						$output .= '<div class="warn clear" style="margin-bottom: 10px;"><img src="'._PS_ADMIN_IMG_.'warn2.png"> '.$message.'</div>';
				}
				elseif ($this->bootstrap)
				{
					foreach ($messages as $message)
						$this->context->controller->warnings[] = $message;
				}
				else
				{
					foreach ($messages as $message)
					{
						$output .= '<div class="bootstrap"><div class="alert alert-warning"><button type="button" class="close" ';
						$output .= 'data-dismiss="alert">Ã—</button>'.$message.'</div></div>';
					}
				}
			}
		}
		return $output;
	}

	public function displayForm($token)
	{
		if (!defined('_PS_ADMIN_IMG_')) // PS 1.0
			define('_PS_ADMIN_IMG_', _PS_IMG_.'admin/');

		if (version_compare(_PS_VERSION_, '1.5.0.0', '<'))
		{
			$content = ob_get_clean();
			$new_content = preg_replace('|<link type="text/css" rel="stylesheet" href="[^"]*datepicker.css" />|', '', $content);
			echo $new_content;
			ob_start();
		}

		$about_form = $this->displayAboutForm();
		$about_form .= $this->displayRegisterForm($token, true);

		if (file_exists(_PS_MODULE_DIR_.$this->name.'/views/templates/hook/samdha_admin.tpl'))
		{
			$this->smarty->assign(array(
					'about_form'        => $about_form,
					'module_config'     => $this->config->getAsArray(),
					'module_short_name' => $this->short_name,
					'module_url'        => AdminController::$currentIndex.'&configure='.urlencode($this->name).'&token='.$token,
					'module_path'       => '//'.$this->samdha_tools->getHttpHost(false).$this->_path,
					'module_directory'  => _PS_MODULE_DIR_.$this->name,
					'active_tab'        => Tools::getValue('active_tab'),
					'support_url'       => $this->licence->licence_number?$this->licence->getSupportURL():$this->licence->getLicenceURL(),
					'documentation_url' => $this->getDocumentationURL(),
					'version_14'        => version_compare(_PS_VERSION_, '1.4.0.0', '>='),
					'version_15'        => version_compare(_PS_VERSION_, '1.5.0.0', '>='),
					'version_16'        => version_compare(_PS_VERSION_, '1.6.0.0', '>='),
					'bootstrap'         => $this->bootstrap,
					'module_version'    => $this->version,

					'content'           => file_exists(_PS_MODULE_DIR_.$this->name.'/views/templates/hook/admin.tpl')?_PS_MODULE_DIR_.$this->name.'/views/templates/hook/admin.tpl':false,
					'footer'            => file_exists(_PS_MODULE_DIR_.$this->name.'/views/templates/hook/admin_footer.tpl')?_PS_MODULE_DIR_.$this->name.'/views/templates/hook/admin_footer.tpl':false,
					'admin_js'          => file_exists(_PS_MODULE_DIR_.$this->name.'/js/admin.js')
			));
			// Display Form

			$output = $this->display(_PS_MODULE_DIR_.$this->name.DIRECTORY_SEPARATOR.$this->name.'.php', (version_compare(_PS_VERSION_, '1.5.0.0', '<')?'/views/templates/hook/':'').'samdha_admin.tpl');
		}
		else
			$output = $about_form;

		if (version_compare(_PS_VERSION_, '1.4.0.0', '<'))
		{
			$output .= '
			<style type="text/css">
			#content .warn {
				border: 1px solid #D3C200;
				background-color: #FFFAC6;
				font-family: Arial,Verdana,Helvetica,sans-serif;
			}
			#content .conf, #content .warn, #content .error {
				color: #383838;
				font-weight: 700;
				margin: 0 0 10px 0;
				line-height: 20px;
				padding: 10px 15px;
			}
			</style>
			';
		}
		return $output;
	}

	public function displayAboutForm($big = false, $space = false)
	{
		$smarty = isset($this->smarty) ? $this->smarty : $this->context->smarty;

		if (version_compare(_PS_VERSION_, '1.2.0.0', '<')) // for translation with Prestashop 1.x
		{
			$tmp_page = $this->page;
			$this->page = 'Module';
		}

		$iso_lang = Language::getIsoById($this->context->cookie->id_lang);
		if (!in_array($iso_lang, array('en', 'fr', 'es', 'de', 'it', 'nl', 'pl', 'pt', 'ru')))
			$iso_lang = 'en';
		$home_url = sprintf($this->home_url, $iso_lang, urlencode($this->name));
		$contact_url = sprintf($this->contact_url, $this->id_addons, urlencode($this->name));

		$smarty->assign(array(
			'big'                 => $big,
			'space'               => $space,
			'module_path'         => $this->_path,
			'module_display_name' => $this->displayName,
			'module_version'      => $this->version,
			'description_big'     => $this->description_big,
			'description'         => $this->description,
			'bootstrap'           => $this->bootstrap,
			'home_url'            => $home_url,
			'contact_url'         => $contact_url
		));

		$output = $this->display(_PS_MODULE_DIR_.$this->name.DIRECTORY_SEPARATOR.$this->name.'.php',
			(version_compare(_PS_VERSION_, '1.5.0.0', '<') ? '/views/templates/hook/' : '').'samdha_aboutform.tpl');

		if (version_compare(_PS_VERSION_, '1.2.0.0', '<')) // for translation with Prestashop 1.x
			$this->page = $tmp_page;

		return $output;
	}

	/** Licence management * */
	public function displayRegisterForm($token, $space = true)
	{
		$smarty = $this->context->smarty;
		$currentIndex = AdminController::$currentIndex;

		$output = '';
		if ($this->need_licence_number && $this->samdha_tools->canAccessInternet())
		{
			if (version_compare(_PS_VERSION_, '1.2.0.0', '<'))  // for translation with Prestashop 1.x
			{
				$tmp_page = $this->page;
				$this->page = 'Module';
			}

			$smarty->assign(array(
				'space'          => $space,
				'registered'     => $this->licence->checkLicence(),
				'licence_url'    => $this->licence->getLicenceURL(),
				'licence_number' => $this->licence->licence_number,
				'module_url'     => $currentIndex.'&configure='.urlencode($this->name).'&token='.$token,
				'content'        => $this->licence->getBoxContent(),
				'bootstrap'      => $this->bootstrap,
			));

			$output = $this->display(_PS_MODULE_DIR_.$this->name.DIRECTORY_SEPARATOR.$this->name.'.php',
				(version_compare(_PS_VERSION_, '1.5.0.0', '<') ? '/views/templates/hook/' : '').'samdha_licenceform.tpl');

			if (version_compare(_PS_VERSION_, '1.2.0.0', '<')) // for translation with Prestashop 1.x
				$this->page = $tmp_page;
		}
		return $output;
	}

	/**
	 * return documentation URL for this module
	 *
	 * @return string
	 */
	public function getDocumentationURL($page = false)
	{
		$iso_lang = Language::getIsoById($this->context->cookie->id_lang);

		if ($this->samdha_tools->usingSecureMode())
			$url = $this->documentation_url_https;
		else
			$url = $this->documentation_url;

		return sprintf($url, $this->name, ($page === false?'Module:'.$this->name:$page), $iso_lang);
	}

	/**
	 * set default config
	 */
	public function getDefaultConfig()
	{
		return array();
	}

	public function postSaveConfig()
	{

	}

	public function postUpdateModule()
	{
		// clean cache, update BDD...
	}

	/**
	 * idem than Module::l but with $id_lang
	 * @since 1.1.0.0
	 * */
	public function l($string, $specific = false, $id_lang = null)
	{
		if (version_compare(_PS_VERSION_, '1.4.0.0', '>=') && version_compare(_PS_VERSION_, '1.5.0.0', '<'))
			return parent::l($string, $specific, $id_lang);

		if (is_null($id_lang))
			$ret = parent::l($string, $specific);
		else
		{
			global $_MODULE;
			$_MODULE = array();
			$iso_lang = Language::getIsoById($id_lang);

			if (version_compare(_PS_VERSION_, '1.5.0.0', '>='))
			{
				$file = _PS_MODULE_DIR_.$this->name.DIRECTORY_SEPARATOR.'translations'.DIRECTORY_SEPARATOR.$iso_lang.'.php';
				if (!file_exists($file))
					$file = _PS_MODULE_DIR_.$this->name.DIRECTORY_SEPARATOR.$iso_lang.'.php';
			}
			else
				$file = _PS_MODULE_DIR_.$this->name.DIRECTORY_SEPARATOR.$iso_lang.'.php';

			if (method_exists('Tools', 'file_exists_cache'))
				if (Tools::file_exists_cache($file))
					include($file);
				elseif (file_exists($file))
					include($file);

			$string2 = str_replace('\'', '\\\'', $string);
			$source = Tools::strtolower($specific ? $specific : get_class($this));
			$current_key = '<{'.$this->name.'}'._THEME_NAME_.'>'.$source.'_'.md5($string2);
			$default_key = '<{'.$this->name.'}prestashop>'.$source.'_'.md5($string2);

			if (key_exists($current_key, $_MODULE))
				$ret = $this->samdha_tools->stripSlashes($_MODULE[$current_key]);
			elseif (key_exists($default_key, $_MODULE))
				$ret = $this->samdha_tools->stripSlashes($_MODULE[$default_key]);
			else
				$ret = $string;
			$ret = str_replace('"', '&quot;', $ret);
		}
		return $ret;
	}

}
