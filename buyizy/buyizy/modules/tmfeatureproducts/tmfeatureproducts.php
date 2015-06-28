<?php
/**
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
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2014 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registred Trademark & Property of PrestaShop SA
*/

if (!defined('_PS_VERSION_'))
	exit;

class tmfeatureproducts extends Module
{
	protected static $cache_products;

	public function __construct()
	{
		$this->name = 'tmfeatureproducts';
		$this->tab = 'front_office_features';
		$this->version = '1.0';
		$this->author = 'Templatemela';
		$this->need_instance = 0;

		$this->bootstrap = true;
		parent::__construct();

		$this->displayName = $this->l('TM- FeatureProduct Slider or Grid in Homepage');
		$this->description = $this->l('Displays featured products as Slider or Grid on center column.');
	}

	public function install()
	{
		$this->_clearCache('*');
		Configuration::updateValue('HOME_FEATURED_NBR_TM', 5);
		Configuration::updateValue('HOME_FEATURED_SLIDER', 0);

		if (!parent::install() || !$this->registerHook('header') || !$this->registerHook('addproduct') || !$this->registerHook('updateproduct') || !$this->registerHook('deleteproduct') || !$this->registerHook('categoryUpdate') || !$this->registerHook('displayHome'))
		return false;
		return true;
	}
	public function uninstall()
	{
		$this->_clearCache('*');
		return parent::uninstall();
	}
	public function getContent()
	{
		$output = '';
		$slider = '';
		$errors = array();
		if (Tools::isSubmit('submittmfeatureproducts'))
		{
			$nbr = (int)Tools::getValue('HOME_FEATURED_NBR_TM');
			$slider = (int)Tools::getValue('HOME_FEATURED_SLIDER');
			
			if (!$nbr || $nbr <= 0 || !Validate::isInt($nbr))
				$errors[] = $this->l('An invalid number of products has been specified.');
			else
			{
				Configuration::updateValue('HOME_FEATURED_NBR_TM', (int)$nbr);
				Configuration::updateValue('HOME_FEATURED_SLIDER', (int)$slider);
			}
			if (isset($errors) && count($errors))
				$output .= $this->displayError(implode('<br />', $errors));
			else
				$output .= $this->displayConfirmation($this->l('Your settings have been updated.'));
		}
		return $output.$this->renderForm();
	}

	public function hookDisplayHeader($params)
	{
		$this->hookHeader($params);
	}

	public function hookHeader($params)
	{
		if (isset($this->context->controller->php_self) && $this->context->controller->php_self == 'index')
			$this->context->controller->addCSS(_THEME_CSS_DIR_.'product_list.css');
		$this->context->controller->addCSS(($this->_path).'tmfeatureproducts.css', 'all');
	}

	public function _cacheProducts()
	{
		if (!isset(tmfeatureproducts::$cache_products))
		{
			$category = new Category(Context::getContext()->shop->getCategory(), (int)Context::getContext()->language->id);
			$nb = (int)Configuration::get('HOME_FEATURED_NBR_TM');
			$slider = (int)Configuration::get('HOME_FEATURED_SLIDER');
			tmfeatureproducts::$cache_products = $category->getProducts((int)Context::getContext()->language->id, 1, ($nb ? $nb : 8), 'position');
		}
		if (tmfeatureproducts::$cache_products === false || empty(tmfeatureproducts::$cache_products))
			return false;
	}

	public function hookDisplayHome($params)
	{
		if (!$this->isCached('tmfeatureproducts.tpl', $this->getCacheId()))
		{
			$this->_cacheProducts();
			$this->smarty->assign(
				array(
					'products' => tmfeatureproducts::$cache_products,
					'add_prod_display' => Configuration::get('PS_ATTRIBUTE_CATEGORY_DISPLAY'),
					'homeSize' => Image::getSize(ImageType::getFormatedName('home')),
					'no_prod' => (int)Configuration::get('HOME_FEATURED_NBR_TM'),
					'slider' => (int)Configuration::get('HOME_FEATURED_SLIDER'),
				)
			);
		}

		return $this->display(__FILE__, 'tmfeatureproducts.tpl', $this->getCacheId());
	}

	public function hookDisplayHomeTabContent($params)
	{
		return $this->hookDisplayHome($params);
	}

	public function hookAddProduct($params)
	{
		$this->_clearCache('*');
	}

	public function hookUpdateProduct($params)
	{
		$this->_clearCache('*');
	}

	public function hookDeleteProduct($params)
	{
		$this->_clearCache('*');
	}

	public function hookCategoryUpdate($params)
	{
		$this->_clearCache('*');
	}

	public function _clearCache($template, $cache_id = null, $compile_id = null)
	{
		parent::_clearCache('tmfeatureproducts.tpl');
	}

	public function renderForm()
	{
		$fields_form = array(
			'form' => array(
				'legend' => array(
					'title' => $this->l('Settings'),
					'icon' => 'icon-cogs'
				),
				'description' => $this->l('To add products to your homepage, simply add them to the root product category (default: "Home").'),
				'input' => array(
					array(
						'type' => 'text',
						'label' => $this->l('Number of products to be displayed'),
						'name' => 'HOME_FEATURED_NBR_TM',
						'class' => 'fixed-width-xs',
						'desc' => $this->l('Set the number of products that you would like to display on homepage (default: 8).'),
					),
					array(
						'type' => 'switch',
						'label' => $this->l('Display Feature Product as Slider'),
						'name' => 'HOME_FEATURED_SLIDER',
						'desc' => $this->l('Display Slider or Grid.(Note:Slider is working if "Number of product" is set more than 5)'),
						'values' => array(
							array(
								'id' => 'active_on',
								'value' => 1,
								'label' => $this->l('Enabled')
							),
							array(
								'id' => 'active_off',
								'value' => 0,
								'label' => $this->l('Disabled')
							)
						),
					)
				),
				'submit' => array(
					'title' => $this->l('Save'),
				)
			),
		);

		$helper = new HelperForm();
		$helper->show_toolbar = false;
		$helper->table = $this->table;
		$lang = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
		$helper->default_form_language = $lang->id;
		$helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;
		$this->fields_form = array();
		$helper->id = (int)Tools::getValue('id_carrier');
		$helper->identifier = $this->identifier;
		$helper->submit_action = 'submittmfeatureproducts';
		$helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
		$helper->token = Tools::getAdminTokenLite('AdminModules');
		$helper->tpl_vars = array(
			'fields_value' => $this->getConfigFieldsValues(),
			'languages' => $this->context->controller->getLanguages(),
			'id_language' => $this->context->language->id
		);

		return $helper->generateForm(array($fields_form));
	}

	public function getConfigFieldsValues()
	{
		return array(
			'HOME_FEATURED_NBR_TM' => Tools::getValue('HOME_FEATURED_NBR_TM', Configuration::get('HOME_FEATURED_NBR_TM')),
			'HOME_FEATURED_SLIDER' => Tools::getValue('HOME_FEATURED_SLIDER', Configuration::get('HOME_FEATURED_SLIDER')),
		);
	}
}
