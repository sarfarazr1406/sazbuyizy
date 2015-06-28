<?php
/**
* 2007-2015 PrestaShop 
*
* NOTICE OF LICENSE
*
* This source file is subject to the Open Software License (OSL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/osl-3.0.php
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
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2014 PrestaShop SA
*  @version  Release: $Revision: 7776 $
*  @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

class AdminPowaTagConfigurationController extends ModuleAdminController
{
	public function __construct()
	{
		$this->table = 'powatag_configuration';
		$this->lang = false;

		$this->_select = null; //If needed you can add informations to select issued from other databases
		$this->_join = null; //Join the databases here

		parent::__construct();

		$this->bootstrap = true;
						
		$this->fields_options = array(
			'api_settings' => array(
				'title'  =>	$this->l('API Settings'),
				'image'  => '../img/admin/prefs.gif',
				'fields' =>	array(
					'POWATAG_API_KEY' => array(
						'title'      => $this->l('API Key'),
						'validation' => 'isString',
						'type'       => 'text',
						'size'       => '80',
						'visibility' => Shop::CONTEXT_SHOP,
						'required'   => true
					),
					'POWATAG_HMAC_KEY' => array(
						'title'      => $this->l('HMAC Key'),
						'validation' => 'isString',
						'type'       => 'text',
						'visibility' => Shop::CONTEXT_SHOP,
						'size'       => 80,
						'required'   => true
					),
					'POWATAG_GENERATOR_URL' =>  array(
						'title'      => $this->l('Powatag Endpoint URL'),
						'validation' => 'isString', 
						'type'       => 'text', 
						'size'       => 80,
					),
					'POWATAG_JS_URL' =>  array(
						'title'      => $this->l('Head JavaScript URL'),
						'validation' => 'isString', 
						'type'       => 'text', 
						'size'       => 80,
					),
					'POWATAG_CSS_URL' =>  array(
						'title'      => $this->l('Head CSS URL'),
						'validation' => 'isString', 
						'type'       => 'text', 
						'size'       => 80,
					),
				),
				'submit' => array('title' => $this->l('Save'))
			),
			'other_settings' => array(
				'title'  =>	$this->l('Other Settings'),
				'image'  => '../img/admin/tab-tools.gif',
				'fields' =>	array(
					'POWATAG_SHIPPING' => array(
						'title'      => $this->l('Shipping Method'),
						'validation' => 'isInt',
						'type'       => 'select',
						'identifier' => 'id_carrier',
						'desc' => $this->l('This will be used to calculate shipping costs'),
						'list'       => Carrier::getCarriers($this->context->language->id),
						'visibility' => Shop::CONTEXT_SHOP,
						'required'   => true
					),
					'POWATAG_SUCCESS_MSG' => array(
						'title'      => $this->l('Sucess message'),
						'validation' => 'isString',
						'type'       => 'textLang',
						'size'       => '80',
						'visibility' => Shop::CONTEXT_SHOP
					),
					'POWATAG_IMG_TYPE' => array(
						'title'      => $this->l('Image type to send'),
						'validation' => 'isInt',
						'type'       => 'select',
						'identifier' => 'id_image_type',
						'list'       => ImageType::getImagesTypes(),
						'visibility' => Shop::CONTEXT_SHOP,
						'required'   => true
					),
				),
				'submit' => array('title' => $this->l('Save'))
			),
			'product_settings' => array(
				'title'  =>	$this->l('Product Settings'),
				'image'  => $this->module->getPathUri().'img/qr_code.png',
				'fields' =>	array(
					'POWATAG_QR' => array(
						'title'      => $this->l('QR Code enabled'),
						'validation' => 'isBool',
						'cast'       => 'intval',
						'type'       => 'bool',
						'visibility' => Shop::CONTEXT_SHOP
					),
					'POWATAG_QR_POS' => array(
						'title'      => $this->l('QR code Position'),
						'validation' => 'isString',
						'type'       => 'select',
						'identifier' => 'key', 
						'list'       => array(
							array('key' => 'displayRightColumnProduct', 'name' => $this->l('displayRightColumnProduct')),
							array('key' => 'displayLeftColumnProduct', 'name' => $this->l('displayLeftColumnProduct')),
							array('key' => 'displayFooterProduct', 'name' => $this->l('displayFooterProduct')),
							array('key' => 'displayProductButtons', 'name' => $this->l('displayProductButtons'))
						),
						'visibility' => Shop::CONTEXT_SHOP
					), 
					'POWATAG_SKU' => array(
						'title' => $this->l('Which SKU field to use '),
						'validation' => 'isInt', 
						'type' => 'select', 
						'identifier' => 'key', 
						'list' => array(
							array('key' => Powatag::EAN, 'name' => $this->l('EAN13 or JAN')),
							array('key' => Powatag::UPC, 'name' => $this->l('UPC')),
							array('key' => Powatag::PRODUCT_ID, 'name' => $this->l('Product ID')),
							array('key' => Powatag::REFERENCE, 'name' => $this->l('REFERENCE')),
						),
					)
				),
				'submit' => array('title' => $this->l('Save'))
			),
			'logs' => array(
				'title'  =>	$this->l('Logs'),
				'image'  => '../img/t/AdminLogs.gif',
				'fields' =>	array(
					'POWATAG_API_LOG' => array(
						'title'      => $this->l('Enable applicative logging'),
						'validation' => 'isBool',
						'cast'       => 'intval',
						'type'       => 'bool',
						'visibility' => Shop::CONTEXT_SHOP
					),
					'POWATAG_REQUEST_LOG' => array(
						'title'      => $this->l('Enable request logging'),
						'validation' => 'isBool',
						'cast'       => 'intval',
						'type'       => 'bool',
						'visibility' => Shop::CONTEXT_SHOP
					),
				),
				'submit' => array('title' => $this->l('Save'))
			)
		);

	}

	public function setMedia()
	{
		parent::setMedia();
		$this->addCSS($this->module->getPathUri().'css/backoffice.css');
	}

	public function initToolbar()
	{
		$this->toolbar_btn = $this->module->initToolbar();
		parent::initToolbar();
	}

	public function initPageHeaderToolbar()
	{
		$this->page_header_toolbar_btn = $this->module->initToolbar();
		parent::initPageHeaderToolbar();
	}
	
	public function renderOptions()
	{
		$this->context->smarty->assign(array(
			'marketing' => !Configuration::get('POWATAG_HMAC_KEY') || !Configuration::get('POWATAG_API_KEY')
		));
		$before = $this->module->display(dirname(__FILE__).'/../../'.$this->module->name.'.php', 'powatag_configuration_before.tpl');
		$form = parent::renderOptions();
		$after = $this->module->display(dirname(__FILE__).'/../../'.$this->module->name.'.php', 'powatag_configuration_after.tpl');

		return $before.$form.$after;
	}

	public static function install($menu_id, $module_name)
	{
		PowatagTotAdminTabHelper::addAdminTab(array(
			'id_parent'    => $menu_id,
			'className'    => 'AdminPowaTagConfiguration',
			'default_name' => 'Configuration',
			'name'         => 'Configuration',
			'position'     => 0, 
			'active'       => true,
			'module'       => $module_name,
		));
	}

}