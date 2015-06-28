<?php
/*
* 2007-2014 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2014 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/


if (!defined('_PS_VERSION_'))
	exit;

class ninjacustomer extends Module
{
	public $html;
	public $config;
	public $context;
	private $cookie;

	public function __construct()
	{
		$this->name = 'ninjacustomer';
		$this->tab = 'administration';
		$this->version = '1.0.1';
		$this->author = 'Syncrea';
		$this->need_instance = 0;
		$this->secure_key = Tools::encrypt($this->name);
		
		$this->bootstrap = true;

		parent::__construct();

		$this->displayName = $this->l('!Ninja Customer!');
		$this->description = $this->l('Allows to login as a customer');
		$this->ps_versions_compliancy = array('min' => '1.5', 'max' => _PS_VERSION_);	
		$this->initialize(); 
	}

	/*
	 * Set the properties of the module, like the link to the image and the title (contextual to the current shop context)
	 */
	protected function initialize()
	{
		$this->context = Context::getContext();
		//set/get configuration
		$config = Configuration::get('NINJACUSTOMER_CONFIG');
		if (!empty($config) && is_array(unserialize($config)))
			$this->config = unserialize($config);
		else
			$this->config = array(
				'ap' => array(),
				'funmode' => 1
			);
	}

	public function install()
	{
		if (!parent::install())
			return false;
		$this->registerHook('displayHeader');
		$this->registerHook('displayBackofficeHeader');
		$this->registerHook('displayFooter');


		Configuration::updateGlobalValue('NINJACUSTOMER_CONFIG', '');

		return true;
	}

	public function uninstall()
	{
		Configuration::deleteByName('NINJACUSTOMER_CONFIG');

		return (parent::uninstall());
	}
	
	private function isNinja() {
		$this->cookie = new Cookie('psAdmin');
		if (in_array($this->cookie->profile, $this->config['ap']))
			return true;
		else if (isset($this->cookie->id_employee) &&  $this->cookie->id_employee != ''){
			$employee = new Employee($this->cookie->id_employee);
			if ( $employee->isSuperAdmin() )
				return true;
		}
	}
	
	public function hookDisplayHeader($params) {
		if ($this->isNinja()){
			$this->context->controller->addCSS($this->_path.'css/style.css');
		}
	}
	
	public function hookDisplayFooter($params) {
		if ($this->isNinja()){
			$errors = array();
			if (Tools::getValue('ninjaCustomerMail')){	
				$email_id = Tools::getValue('ninjaCustomerMail');
				if (Validate::isEmail($email_id)) {
					$customer = new Customer();
					if ($customer = $customer->getByEmail(trim($email_id))) {
						$this->doLogin($customer);
						header("location:".$_SERVER["REQUEST_URI"]);
					} else
						$errors[] = $this->l('Customer doesn\'t exists for this shop.');
				} else if (Validate::isInt($email_id) && Customer::customerIdExists((int)$email_id)){
					$customer = new Customer((int)$email_id);
					$this->doLogin($customer);
					header("location:".$_SERVER["REQUEST_URI"]);
				} else
					$errors[] = $this->l('Not a valid mail or user id');
			}
			if (!empty($errors))
				$this->smarty->assign('errors', $errors);
			if (isset($this->context->customer->id) && $this->context->customer->id > 0)
				$this->smarty->assign('logged', true);
				
			$this->smarty->assign('fun', $this->config['funmode']);
			return $this->display(__FILE__, 'ninjacustomer.tpl');
		}
	}
	
	private function doLogin($customer){
		$context = Context::getContext();
		$context->cookie->id_compare = isset($context->cookie->id_compare) ? $context->cookie->id_compare: CompareProduct::getIdCompareByIdCustomer($customer->id);
		$context->cookie->id_customer = (int)($customer->id);
		$context->cookie->customer_lastname = $customer->lastname;
		$context->cookie->customer_firstname = $customer->firstname;
		$context->cookie->logged = 1;
		$customer->logged = 1;
		$context->cookie->is_guest = $customer->isGuest();
		$context->cookie->passwd = $customer->passwd;
		$context->cookie->email = $customer->email;
		
		// Add customer to the context
		$this->context->customer = $customer;
		
		if (Configuration::get('PS_CART_FOLLOWING') && (empty($this->context->cookie->id_cart) || Cart::getNbProducts($this->context->cookie->id_cart) == 0) && $id_cart = (int)Cart::lastNoneOrderedCart($this->context->customer->id))
			$context->cart = new Cart($id_cart);
		else
		{
			$context->cart->id_carrier = 0;
			$context->cart->setDeliveryOption(null);
			$context->cart->id_address_delivery = Address::getFirstCustomerAddressId((int)($customer->id));
			$context->cart->id_address_invoice = Address::getFirstCustomerAddressId((int)($customer->id));
		}
		$context->cart->id_customer = (int)$customer->id;
		$context->cart->secure_key = $customer->secure_key;
		$context->cart->save();
		$context->cookie->id_cart = (int)$this->context->cart->id;
		$context->cookie->write();
		$context->cart->autosetProductAddress();
	}


	public function postProcess()
	{
		if (Tools::isSubmit('saveProfiles')) {
			$ap = Tools::getValue('allowedProfiles');
			
			if (!empty($ap))
				$this->config['ap'] = $ap;
			else 
				$this->config['ap'] = array();
				
			$this->config['funmode'] = Tools::getValue('funmode');
			Configuration::updateValue('NINJACUSTOMER_CONFIG', serialize($this->config));
		}
	}

	/**
	 * getContent used to display admin module form
	 *
	 * @return string content
	 */
	public function getContent()
	{
		$this->postProcess();
		$this->html .= $this->headerHTML();
		$profiles = Profile::getProfiles($this->context->language->id);
		//$this->html .= '<pre>'.print_r($profiles,true).'</pre>';
		$this->html .= '<div id="beyour">';
		$this->html .= '<div class="header"><h2><img class="logo" src="'._MODULE_DIR_.$this->name.'/logo.png"/> '.$this->displayName.'<span class="small"> ('.$this->version.')</span></h2></div>';
		
		$this->html .= '<form class="ninjaform" action="'.AdminController::$currentIndex.'&token='.Tools::getAdminTokenLite('AdminModules').'&configure='.$this->name.'" method="post">
			<fieldset><legend>'.$this->l('Select employee profiles allowed to login as customers on front office.').'</legend>';
		$this->html .= '<div class="avv">'.$this->l('Please rember that allowing employees to login as customers have security implications, they will be able to access and modify every customer data on your shop. Give this permission only to people you trust.').'</div>';
		foreach ($profiles as $profile){
			$checked = $profile['id_profile'] == _PS_ADMIN_PROFILE_ || in_array($profile['id_profile'], $this->config['ap']) ? 'checked="checked"': '';
			$this->html .= '<label>'.$profile['name'].'&nbsp;&nbsp;<input '.$checked.' '.($profile['id_profile'] == _PS_ADMIN_PROFILE_ ? 'readonly disabled' : '').' type="checkbox" name="allowedProfiles[]" value="'.$profile['id_profile'].'"/></label><br/>';
		}
		$this->html .= '</fieldset>
		<fieldset><legend>'.$this->l('Fun mode?').'</legend>
			<label>'.$this->l('Oh yes!').'<input '.($this->config['funmode'] ? 'checked="checked"': '').' type="radio" name="funmode" value="1" /></label><br/>
			<label>'.$this->l('Sadly no!').'<input '.(!$this->config['funmode'] ? 'checked="checked"': '').'type="radio" name="funmode" value="0" /></label>
		</fieldset>
		<input class="button btn" type="submit" name="saveProfiles" value="'.$this->l('Save').'"/></form>';
		$this->html .= $this->getCreds();
		$this->html .= '</div>';
	
		return $this->html;
	}

	public function hookDisplayBackOfficeHeader($params = NULL){
		if (Tools::getValue('configure') == $this->name) {
			$headHtml ='<link type="text/css" rel="stylesheet" href="'.$this->_path.'css/style.css"/>';
			$headHtml .='<link type="text/css" rel="stylesheet" href="'.$this->_path.'css/font-awesome.css"/>';
			$headHtml .='<script type="text/javascript" src="'.$this->_path.'js/ninjacustomer.js"></script>';
			return $headHtml;
		}
	}
	
	public function needCheck(){
		if (Tools::getValue('configure') == $this->name || Tools::getValue('controller') == 'AdminModules') {
			$time = time();
			if (!isset($this->config['update_time']) || $this->config['update_time'] == 0) {
				$this->config['update_time'] = $time;
				Configuration::updateValue('NINJACUSTOMER_CONFIG', serialize($this->config));
			}
			if( $this->config['update_time'] < ($time-(60*60)) || Tools::getValue('check') == 1) {
				$this->config['need_update'] = 0;
				$this->config['update_time'] = $time;
				Configuration::updateValue('NINJACUSTOMER_CONFIG', serialize($this->config));
				return true;
			}
		}
	}
	
	public function headerHTML()
	{
		
		$html ='
		<script type="text/javascript">
			var njajaxUrl = "'.$this->_path.'ajax_'.$this->name.'.php?secure_key='.$this->secure_key.'";
			'.($this->needCheck() ? 'var njupdateUrl = "'.base64_decode('aHR0cDovL3N5bmNyZWEuaXQvZGV2ZWwvdXBkYXRlLnBocA==').'";' : '' ).'
			var njactualVersion = "'.$this->version.'";
		</script>';
		
		if ($this->config['need_update'] && $this->config['need_update'] > $this->version) {
			$this->html .= $this->updateMsg();
		} else {
			$this->config['need_update'] = 0;
		}
		
		return $html;
	}
	
	public function getCreds(){
		$html = '<div class="credits">
		<p style="text-align:center;"><img src="../modules/'.$this->name.'/beer.png"/>'.$this->l('If you like this module and wanna see it improved why not to buy the developer a beer? it\'s just 5€!').'<img src="../modules/'.$this->name.'/beer.png"/></p>
		
		<form style="display:block;text-align:center;" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
		<input type="hidden" name="cmd" value="_s-xclick"/>
		<input type="hidden" name="hosted_button_id" value="WKKKH27C9RU3E"/>
		<input type="image" src="//imageshack.com/a/img691/3066/o4t.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!"/>
		<img alt="" border="0" src="https://www.paypalobjects.com/it_IT/i/scr/pixel.gif" width="1" height="1"/>
		</form>
		<!-- <p style="text-align:center;"><a href="http://www.prestashop.com/forums/index.php?showtopic=310597" target="_blank">'.$this->l('Need support? Click here!').'</a></p>--></div>';
		return $html;
	}
	
	public function updateMsg(){
		$html = '<div class="module_confirmation conf confirm">
			'.$this->l('NEW VERSION Available for ').$this->displayName.' (v:'.$this->config['need_update'].')
			</div>';
		$html .= '<form action="#" id="moduleUpdate" method="post">
				<input type="submit" class="button centered big" id="moduleUpdate" name="moduleUpdate" value="'.$this->l('Update Now!').' (BETA)"/>
				<!-- <a class="button centered" href="http://www.prestashop.com/forums/index.php?showtopic=310597" target="blank">'.$this->l('If the update button doesn\'t work you can download the latest version manually on the forums clicking here.').'</a>-->
			</form>';
		return $html;
	}

}
