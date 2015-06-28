<?php
/*
* WhatsApp Sharing Button v1.1
* @author kik-off.com <info@kik-off.com>
* @file whatsappbutton.php
*/

class WhatsappButton extends Module
{
	protected $_html;

	public function __construct()
	{
		$this->name = 'whatsappbutton';
		if (version_compare(_PS_VERSION_, '1.5', '>='))
			$this->tab = 'mobile';
		else
			$this->tab = 'market_place';
		$this->version = '1.1';
		$this->author = 'kik-off.com';
		$this->bootstrap = true;
		
		parent::__construct();

		$this->displayName = $this->l('WhatsApp Sharing Button');
		$this->description = $this->l('WhatsApp sharing is currently supported by iOS and Android. This module will check the current platform and only shows up on supported devices.');
		$this->ps_versions_compliancy = array('min' => '1.5', 'max' => _PS_VERSION_);
	}

	public function install($delete_params = true)
	{
		if (!parent::install() ||
			!$this->registerHook('header') ||
			!$this->registerHook('actionObjectProductUpdateAfter') ||
			!$this->registerHook('actionObjectProductDeleteAfter') ||
			!$this->registerHook('displayRightColumnProduct') ||
			!$this->registerHook('displayCompareExtraInformation') ||
			!Configuration::updateValue('PS_WHATSAPP_BUTTON', 2))
			return false;
		return true;
	}

	public function uninstall($delete_params = true)
	{
		if (!parent::uninstall() || 
		    !Configuration::deleteByName('PS_WHATSAPP_BUTTON'))
			return false;
		return true;
	}

	public function reset()
	{
		if (!$this->uninstall(false))
			return false;
		if (!$this->install(false))
			return false;

		return true;
	}

	public function getContent()
	{
		
		$this->_html = '';

		if (Tools::isSubmit('submitWhatsappButton'))
		{
			$PS_WHATSAPP_BUTTON = (int)Tools::getValue('PS_WHATSAPP_BUTTON');
			Configuration::updateValue('PS_WHATSAPP_BUTTON', $PS_WHATSAPP_BUTTON);
			$this->_html .= $this->displayConfirmation($this->l('Settings updated'));
			Tools::redirectAdmin($this->context->link->getAdminLink('AdminModules', true).'&conf=6&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name);

		}
		
		$this->_html = '<style type="text/css">
		.btn-whatsapp {
    		background-color: #56b94c!important;
    		border: 1px solid #56b94c!important;
    		-webkit-border-radius: 2px!important;
    		-moz-border-radius: 2px!important;
    		border-radius: 2px!important;
			box-shadow: none!important;
    		color: #ffffff!important;
    		cursor: pointer!important;
    		display: inline-block!important;
    		letter-spacing: 0.4px!important;
    		position: relative!important;
    		text-decoration: none!important;
    		text-transform: none!important;
		}
		.btn-whatsapp:hover {
    		background-color: #21a049!important;
			border: 1px solid #21a049!important;
    		color: #ffffff!important;
    		text-decoration: none!important;
		}
		.btn-whatsapp:focus,
		.btn-whatsapp:active { 
    		background-color: #3da84a!important;
			border: 1px solid #3da84a!important;
			color: #ffffff!important;
    		text-decoration: none!important;
		}
		.btn-whatsapp-16 span,
		.btn-whatsapp-24 span,
		.btn-whatsapp-32 span {
    		display: inline-block;
			background-repeat: no-repeat;
			background-position: left top;
		}
		.btn-whatsapp-16 span {
    		background-image: url("'.$this->_path.'img/whatssap-icon-16.png");
			padding-left: 20px;
			height: 16px;
			line-height: 16px;
		}
		.btn-whatsapp-24 span {
    		background-image: url("'.$this->_path.'img/whatssap-icon-24.png");
			padding-left: 28px;
			height: 24px;
			line-height: 24px;
		}
		.btn-whatsapp-32 span {
    		background-image: url("'.$this->_path.'img/whatssap-icon-32.png");
			padding-left: 36px;
			height: 32px;
			line-height: 32px;
		}
		.btn-whatsapp.btn-xs {
    		font-size: 13px!important;
		}
		.btn-whatsapp.btn-sm {
    		font-size: 16px!important;
		}
		.btn-whatsapp.btn-lg {
    		font-size: 24px!important;
			width: 370px!important;
		}
		</style>';

		$helper = new HelperForm();
		$helper->submit_action = 'submitWhatsappButton';
		$helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
		$helper->token = Tools::getAdminTokenLite('AdminModules');
		$helper->fields_value['PS_WHATSAPP_BUTTON'] = Configuration::get('PS_WHATSAPP_BUTTON');
		
		$this->_html .= '<div class="alert alert-warning">'.$this->description.'</div>';

		return $this->_html.$helper->generateForm(array(
			array(
				'form' => array(
					'legend' => array(
						'title' => $this->displayName,
						'image' => $this->_path.'img/whatssap-icon-16.png'
					),
					'input' => array(
		                array(
				            'type' => 'radio',
				            'label' => $this->l('Button size'),
				            'name' => 'PS_WHATSAPP_BUTTON',
				            'values' => array(
					            array(
						            'id' => 'PS_WHATSAPP_BUTTON_0',
						            'value' => 0,
						            'label' => '<a class="btn btn-default btn-whatsapp btn-whatsapp-16 btn-xs"><span>'.$this->l('Small').'</span></a>'
					            ),
								array(
						            'id' => 'PS_WHATSAPP_BUTTON_1',
						            'value' => 1,
						            'label' => '<a class="btn btn-default btn-whatsapp btn-whatsapp-24 btn-sm"><span>'.$this->l('Medium').'</span></a>'
					            ),
					            array(
						            'id' => 'PS_WHATSAPP_BUTTON_2',
						            'value' => 2,
						            'label' => '<a class="btn btn-default btn-whatsapp btn-whatsapp-32 btn-lg btn-block"><span>'.$this->l('Large').'</span></a>'
					            )
				            )
			            ),
		            ),
					'submit' => array(
						'title' => $this->l('Save')
					)
				)
			)
		));
		
		return $this->_html;
	}
	
	public function hookDisplayHeader($params)
	{
		if ($this->detectIsMobileSupported() && !isset($this->context->controller->php_self) || !in_array($this->context->controller->php_self, array('product', 'products-comparison')))
			return;

		$this->context->controller->addCss($this->_path.'css/whatsappbutton.css');
	}

	public function hookDisplayCompareExtraInformation($params)
	{
		if ($this->detectIsMobileSupported())
		{
		    $protocol_link = (Configuration::get('PS_SSL_ENABLED') || Tools::usingSecureMode()) ? 'https://' : 'http://';
			$compare_url = $protocol_link.Tools::getShopDomainSsl().$this->context->smarty->tpl_vars['request_uri']->value;
				
			$this->context->smarty->assign(array(
			    'whatsappbutton_text' => sprintf($this->l('Product comparison %1s'), $compare_url),
			    'PS_WHATSAPP_BUTTON' => Configuration::get('PS_WHATSAPP_BUTTON'),
			));

		    return $this->display(__FILE__, 'whatsapp-button-compare.tpl');
		}
	}
	
	protected function displayWhatsAppButton()
	{
		if ($this->detectIsMobileSupported())
		{
			$product = $this->context->controller->getProduct();
		        
			if (isset($product) && Validate::isLoadedObject($product))
		    {
	            $this->context->smarty->assign(array(
				    'sp' => $this->detectIsMobileSupported(),
					'os' => $_SERVER['HTTP_USER_AGENT'],
					'whatsappbutton_text' => sprintf($this->l('Take a look at this awesome product %1s %2s'), addcslashes($product->name, "'"), addcslashes($this->context->link->getProductLink($product), "'")),
		            'PS_WHATSAPP_BUTTON' => Configuration::get('PS_WHATSAPP_BUTTON')
		        ));

		        return $this->display(__FILE__, 'whatsapp-button.tpl');
			}
	    }
	}

	public function hookDisplayRightColumnProduct($params)
	{
		return $this->displayWhatsAppButton();
	}

	public function hookExtraleft($params)
	{
		return $this->displayWhatsAppButton();
	}

	public function hookProductActions($params)
	{
		return $this->displayWhatsAppButton();
	}

	public function hookProductFooter($params)
	{
		return $this->displayWhatsAppButton();
	}
	
	protected function detectIsMobileSupported()
	{
		if (stristr($_SERVER['HTTP_USER_AGENT'], 'ipad') || 
		    stristr($_SERVER['HTTP_USER_AGENT'], 'iphone') || strstr($_SERVER['HTTP_USER_AGENT'], 'iphone') ||
			stristr($_SERVER['HTTP_USER_AGENT'], 'android'))
		    return true;
		else
		    return false; 
	}
}
