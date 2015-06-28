<?php
/**
 * Delivery days module
 *
 * @category  Prestashop
 * @category  Module
 * @author    Samdha <contact@samdha.net>
 * @copyright Samdha
 * @license   commercial license see license.txt
 * @version   2.3.0
 *
 * @link   logo http://www.gnu.org/copyleft/gpl.html logo license
 * @link    logo http://code.google.com/u/newmooon/ logo author
 */

if (!defined('_PS_VERSION_'))
	exit;

if (!class_exists('deliverydays', false))
{
	if (!defined('_PS_MODULE_DIR_')) /* PS 1.0 */
		define('_PS_MODULE_DIR_', _PS_ROOT_DIR_.DIRECTORY_SEPARATOR.'modules'.DIRECTORY_SEPARATOR);
	if (!defined('_PS_USE_SQL_SLAVE_')) /* PS 1.3 */
		define('_PS_USE_SQL_SLAVE_', false);

	/**
	 * Autoloader for this module classes
	 */
	function sdDeliveryDaysAutoload($class_name)
	{
		$module_name = 'deliverydays';
		$class_name = ltrim($class_name, '\\');
		$file_name  = '';
		$namespace = '';
		if ($last_ns_post = strrpos($class_name, '\\'))
		{
			$namespace = Tools::substr($class_name, 0, $last_ns_post);
			$class_name = Tools::substr($class_name, $last_ns_post + 1);
			$file_name  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace).DIRECTORY_SEPARATOR;
		}
		$file_name .= str_replace('_', DIRECTORY_SEPARATOR, $class_name).'.php';
		$file_name = _PS_MODULE_DIR_.$module_name.DIRECTORY_SEPARATOR.'classes'.DIRECTORY_SEPARATOR.$file_name;
		if (file_exists($file_name))
			return require_once($file_name);
		elseif (version_compare(_PS_VERSION_, '1.4.0.0', '>=') && function_exists('__autoload'))
			return __autoload($class_name);
		elseif (version_compare(_PS_VERSION_, '1.4.0.0', '<') && is_readable(_PS_ROOT_DIR_.'/classes/'.$class_name.'.php'))
			require_once _PS_ROOT_DIR_.'/classes/'.$class_name.'.php';
	}
	spl_autoload_register('sdDeliveryDaysAutoload');

	/* Let's begin */
	class DeliveryDays extends Samdha_Module_Module
	{
		public $short_name = 'deliverydays';
		public $config_arrays_keys = array();
		private $mail_path = null;

		public function __construct()
		{
			$this->name = 'deliverydays';
			$this->tab = version_compare(_PS_VERSION_, '1.4.0.0', '<')?'Tools':'shipping_logistics';
			$this->version = '2.3.0';
			$this->bootstrap = true;
			$this->module_key = '79b34ab6ee85dbd1a948d7cef4e6c02f';
			$this->id_addons = 1652;

			parent::__construct();

			/* The parent construct is required for translations */
			$this->page = basename(__FILE__, '.php');
			$this->displayName = $this->l('Delivery days');
			$this->description = $this->l('Allow your customers to select a delivery day.');
			$this->description_big = '
					<p>'.$this->l('This module allow your customers to select a delivery day.').'</p>
					<p>'.$this->l('You can export orders for delivery and products to prepare for a specific date.').'</p>';
			$this->mail_path = _PS_MODULE_DIR_.$this->name.'/mails/';

			$this->tools = new Samdha_DeliveryDays_Tools($this);
			$this->export = new Samdha_DeliveryDays_Export($this);
			$this->dates = new Samdha_DeliveryDays_Dates($this);
		}

		/**
		 * module installation
		 */
		public function install()
		{
			if (version_compare(_PS_VERSION_, '1.5.0.0', '<'))
				$before_carrier = method_exists('Hook', 'get') && Hook::get('beforeCarrier');
			else
				$before_carrier = true;

			if (!$this->samdha_tools->executeSQLFile(self::INSTALL_SQL_FILE)
				|| !parent::install()
				|| !($before_carrier?$this->registerHook('beforeCarrier'):true)
				|| !$this->registerHook('footer')
				|| !$this->registerHook('header')
				|| !$this->registerHook('adminOrder')
				|| !$this->registerHook('newOrder'))
				return false;
			return true;
		}

		/**
		 * module uninstallation
		 */
		public function uninstall()
		{
			return ($this->samdha_tools->executeSQLFile(self::UNINSTALL_SQL_FILE)
					&& parent::uninstall());
		}

		public function afterUpdateModule()
		{
			$this->registerHook('newOrder');

			$this->executeSQLFile(self::INSTALL_SQL_FILE);
			$sql = 'SHOW COLUMNS FROM `'._DB_PREFIX_.'deliverydays_cart` LIKE \'timeframe\'';
			$row = Db::getInstance()->executeS($sql);
			if (empty($row))
				$this->executeSQLFile('update.sql');

			if (!isset($this->smarty)
				&& file_exists(_PS_ROOT_DIR_.'/config/smarty.config.inc.php'))
				require_once(_PS_ROOT_DIR_.'/config/smarty.config.inc.php');

			if (is_object($this->smarty)
				&& method_exists($this->smarty, 'clearCache'))
			{
				$old_templates = glob(_PS_MODULE_DIR_.$this->name.'/*.tpl');
				foreach ($old_templates as $file)
					$this->smarty->clearCompiledTemplate($file);
				$templates = glob(_PS_MODULE_DIR_.$this->name.'/views/templates/*/*.tpl');
				foreach ($templates as $file)
					$this->smarty->clearCompiledTemplate($file);
			}

		}

		public function displayForm($token)
		{
			$temp_groups = Group::getGroups($this->context->cookie->id_lang);
			$groups = array();
			foreach ($temp_groups as $group)
				$groups[$group['id_group']] = $group['name'];

			$temp_employees = Employee::getEmployees();
			$employees = array();
			foreach ($temp_employees as $employee)
				$employees[$employee['id_employee']] = isset($employee['name'])?$employee['name']:($employee['firstname'].' '.$employee['lastname']);

			$temp_dates = $this->export->getFuturDeliveryDates();
			$futur_dates = array();
			foreach ($temp_dates as $date)
				$futur_dates[$date['date_delivery']] = Tools::displayDate(
					$date['date_delivery'],
					version_compare(_PS_VERSION_, '1.5.0.0', '<')?$this->context->cookie->id_lang:null
				);

			$days = array(
				0 => $this->l('Sunday'),
				1 => $this->l('Monday'),
				2 => $this->l('Tuesday'),
				3 => $this->l('Wednesday'),
				4 => $this->l('Thursday'),
				5 => $this->l('Friday'),
				6 => $this->l('Saturday'),
			);
			$tabs = array(
				array('href' => '#tabParameters', 'display_name' => $this->l('Parameters')),
				array('href' => '#tabDays', 'display_name' => $this->l('Delivery days'))
			);
			if ($futur_dates)
				$tabs[] = array('href' => '#tabExport', 'display_name' => $this->l('Export'));

			$this->smarty->assign(array(
				'tabs'        => $tabs,
				'groups'      => $groups,
				'days'        => $days,
				'hours'       => range(0, 23),
				'minutes'     => range(0, 59),
				'iso_code'    => $this->context->language->iso_code,
				'employees'   => $employees,
				'futur_dates' => $futur_dates,
			));

			return parent::displayForm($token);
		}

		public function postProcess($token)
		{
			// convert old config system
			$this->tools->importOldConfig();

			if (!$this->tools->checkPatch(_PS_MODULE_DIR_.$this->name.DIRECTORY_SEPARATOR.'patch'.DIRECTORY_SEPARATOR))
				$this->errors[] = $this->l('Please replace the Prestashop files by the ones corresponding to your version of PrestaShop in the patch folder.')
										.' <a class="module_help" href="http://prestawiki.samdha.net/wiki/Samdha:faq#patch">?</a>';
			if (Tools::isSubmit('exportProducts'))
				$this->export->exportProducts(Tools::getValue('deliverydays_export'));

			if (Tools::isSubmit('exportOrders'))
				$this->export->exportOrders(Tools::getValue('deliverydays_export'));

			$this->tools->cleanSettings();
			return parent::postProcess($token);
		}

		/**
		* set default config
		**/
		public function getDefaultConfig()
		{
			$result = array(
				'use_group' => 0,
				'id_employee' => 0,
				'mailcustomer' => 0,
				'add_column' => 0,
				'separate_mail' => version_compare(_PS_VERSION_, '1.5.0.0', '<')
			);
			$groups = Group::getGroups($this->context->cookie->id_lang);
			$groups[] = array('id_group' => 0); // used when use_group = 0
			foreach ($groups as $group)
			{
				$id_group = $group['id_group'];
				$config = array(
					'enabled'.$id_group => 1,
					'required'.$id_group => 0,
					'days'.$id_group => '0,1,1,1,1,1,0',
					'hours'.$id_group => '22,22,22,22,22,22,22',
					'minutes'.$id_group => '0,0,0,0,0,0,0', // @since 1.6.4.0
					'offsets'.$id_group => '2,3,1,1,1,1,1', // @since 1.6.4.0
					'offset'.$id_group => '0',
					'duration'.$id_group => '15',
					'exception'.$id_group => date('Y').'-12-25,'.(date('Y') + 1).'-01-01',
					'timeframe'.$id_group => '',
				);
				$result = array_merge($result, $config);
				$arrays_keys = array(
					'days'.$id_group,
					'hours'.$id_group,
					'minutes'.$id_group,
					'offsets'.$id_group,
					'exception'.$id_group,
					'timeframe'.$id_group
				);
				$this->config_arrays_keys = array_merge($this->config_arrays_keys, $arrays_keys);
			}

			return $result;
		}

		/**
		 * include calendar in order page (step 1)
		 * for Prestashop < 1.5.0.0
		 *
		 * @param array $params
		 */
		public function hookFooter($params)
		{
			$fileindex = basename($_SERVER['PHP_SELF']);
			if ((Configuration::get('PS_ORDER_PROCESS_TYPE') == 0) // not OnePageCheckout
				&& ($fileindex == 'order.php')
				&& (Tools::getValue('step') == 1)
				&& (count($this->dates->getPossibleDates()) !== 0))
			{
				$replace = $this->displayCalendar($params['cart'], false);
				if ($replace)
				{
					$buffer = ob_get_contents();
					ob_clean();
					// add template
					$buffer = preg_replace('/<div id="ordermsg"/ms', str_replace('$', '\$', $replace).'<div id="ordermsg"', $buffer, 1);
					$buffer = preg_replace('|'._PS_JS_DIR_.'jquery/jquery-1\.2\.6\.pack\.js|ms', $this->_path.'js/jquery-1.4.4.min.js', $buffer, 1);

					echo $buffer;
				}
			}
		}

		/**
		 * disable hook footer for Prestashop >= 1.5.0.0
		 *
		 * @param array $params
		 */
		public function hookDisplayFooter($params)
		{
		}

		public function hookbeforeCarrier($params)
		{
			if ((Configuration::get('PS_ORDER_PROCESS_TYPE') == 1)
				&& (count($this->dates->getPossibleDates()) !== 0))
			{
				if (version_compare(_PS_VERSION_, '1.5.0.0', '>='))
					$this->context->controller->addJqueryUI('ui.datepicker');
				return $this->displayCalendar($params['cart'], true);
			}
		}

		private function displayCalendar($cart, $opc)
		{
			$result = '';

			$deliverydays = $this->dates->getPossibleDates();
			if (!empty($deliverydays))
			{
				$smarty = $this->context->smarty;
				if ($this->config->use_group)
				{
					$group = $this->tools->getCurrentGroup();
					$id_group = $group->id;
				} else
					$id_group = 0;

				// 2011-03-21 by Georges Cubas Sometimes lang_iso is no more defined in smarty
				$method = method_exists($smarty, 'getTemplateVars')?'getTemplateVars':'get_template_vars';
				if (!$smarty->$method('lang_iso'))
					$smarty->assign('lang_iso', $this->context->language->iso_code);

				$selected_day = $this->dates->getDate($cart);
				$smarty->assign(
					array(
						'deliverydays_error' => Tools::getValue('deliverydays_error'),
						'selected_day' => $selected_day,
						'deliverydays' => $deliverydays,
						'timeframe' => $this->config->{'timeframe'.$id_group},
						'this_path' => $this->_path
					)
				);
				if (Tools::getValue('ps_mobile_site'))
					$result = $this->display(__FILE__, (version_compare(_PS_VERSION_, '1.5.0.0', '<')?'views/templates/hook/':'').$this->name.'_mobile.tpl');
				else
					$result = $this->display(__FILE__, (version_compare(_PS_VERSION_, '1.5.0.0', '<')?'views/templates/hook/':'').$this->name.($opc?'_opc':'').'.tpl');
			}
			return $result;
		}

		public function hookHeader($params)
		{
			$result = '';
			$fileindex = basename($_SERVER['PHP_SELF']);
			if ((Configuration::get('PS_ORDER_PROCESS_TYPE') == 0)
				&& ($fileindex == 'order.php')
				&& (Tools::getValue('step') == 2))
			{
				if ($this->config->use_group)
				{
					$group = $this->tools->getCurrentGroup();
					$id_group = $group->id;
				} else
					$id_group = 0;

				if (Tools::getValue('deliverydays_day'))
					$this->dates->setDate($params['cart'], Tools::getValue('deliverydays_day'), Tools::getValue('deliverydays_timeframe'));
				if ($this->config->{'required'.$id_group} && !$this->dates->getDate($params['cart']))
					Tools::redirect('order.php?step=1&deliverydays_error=1');
			}

			if ((($fileindex == 'order.php')
				&& ((Tools::getValue('ps_mobile_site') == 1)
					|| (Tools::getValue('step') == 1)))
				|| ($fileindex == 'order-opc.php'))
			{
				$result .= $this->samdha_tools->addCSS($this->_path.'css/jquery-ui-1.8.20.custom.css');
				$result .= $this->samdha_tools->addJS($this->_path.'js/jquery-ui-1.8.20.custom.min.js');
				$iso_code = $this->context->language->iso_code;
				if ($iso_code != 'en' && file_exists(_PS_MODULE_DIR_.$this->name.'/js/datepicker/jquery.ui.datepicker-'.$iso_code.'.js'))
					$result .= $this->samdha_tools->addJS($this->_path.'js/datepicker/jquery.ui.datepicker-'.$iso_code.'.js');
			}
			return $result;
		}

		public function hookDisplayHeader($params)
		{
			if ((Configuration::get('PS_ORDER_PROCESS_TYPE') == 0)
				&& ($this->context->controller instanceof OrderController))
			{
				if (!Tools::getValue('ajax') && Tools::getValue('step') == 2)
				{
					if ($this->config->use_group)
					{
						$group = $this->tools->getCurrentGroup();
						$id_group = $group->id;
					} else
						$id_group = 0;

					if (Tools::getValue('deliverydays_day'))
						$this->dates->setDate($params['cart'], Tools::getValue('deliverydays_day'), Tools::getValue('deliverydays_timeframe'));
					if ($this->config->{'required'.$id_group} && !$this->dates->getDate($params['cart']))
						Tools::redirect('order.php?step=1&deliverydays_error=1');
				} elseif ((Tools::getValue('step') == 1)
					&& (count($this->dates->getPossibleDates()) !== 0))
				{
					$this->context->controller->addJqueryUI('ui.datepicker');
					$smarty = $this->context->smarty;

					if (method_exists($smarty, 'register_outputfilter'))
						$smarty->register_outputfilter(array($this, 'smartyOutputfilterAddCalendar'));
					else
						$smarty->registerFilter('output', array($this, 'smartyOutputfilterAddCalendar'));
				}
			}
		}

		public function smartyOutputfilterAddCalendar($output, $smarty)
		{
			static $replace = null;

			if (basename($smarty->template_resource) == 'order-address.tpl')
			{
				if (is_null($replace))
					$replace = $this->displayCalendar($this->context->cart, false);
				if ($replace)
					$result = preg_replace('/<div ([^>]*id="ordermsg")/ms', str_replace('$', '\$', $replace).'<div \1', $output, 1);
				else
					$result = $output;
			} else
				$result = $output;
			return $result;
		}

		public function order_opc()
		{
			$cookie = $this->context->cookie;
			$cart = $this->context->cart;

			if ((Configuration::get('PS_ORDER_PROCESS_TYPE') == 1)
				&& Tools::getValue('ajax')
				&& Tools::getValue('deliveryday'))
				$this->dates->setDate($cart, Tools::getValue('deliveryday'), Tools::getValue('timeframe'));

			$_POST['method'] = 'updateTOSStatusAndGetPayments';
			$_POST['checked'] = $cookie->checkedTOS;
			Configuration::set('PS_CANONICAL_REDIRECT', '0');
			if (version_compare(_PS_VERSION_, '1.5.0.0', '>='))
			{
				$controller = new OrderOpcController();
				$controller->run();
			} else
				ControllerFactory::getController('OrderOpcController')->run();
		}

		public function hookAdminOrder($params)
		{
			$order = new Order($params['id_order']);
			$days = array(
				0 => $this->l('Sunday'),
				1 => $this->l('Monday'),
				2 => $this->l('Tuesday'),
				3 => $this->l('Wednesday'),
				4 => $this->l('Thursday'),
				5 => $this->l('Friday'),
				6 => $this->l('Saturday')
			);
			if ($date = $this->dates->getDate($order->id_cart, false))
			{
				$text = $this->l('Asked delivery day:').
						  ' '.Tools::displayDate($date['date'], version_compare(_PS_VERSION_, '1.5.0.0', '<')?$order->id_lang:null).' ('.$days[(int)date('w', strtotime($date['date']))].
						  ') '.htmlentities($date['timeframe'], ENT_QUOTES | ENT_IGNORE, 'UTF-8');
				if (version_compare(_PS_VERSION_, '1.6.0.0', '>='))
					$result = '<script>$(document).ready(function(){$("#shipping").prepend('.$this->samdha_tools->jsonEncode($text).')});</script>';
				else
					$result = '
					<br />
					<fieldset style="width: 400px">
						<legend><img src="'.$this->_path.'logo.gif" /> '.$this->l('Delivery day').'</legend>
						'.$text.'
					</fieldset>';
				return $result;
			}
		}

		public function _getPaymentMethods($cart)
		{
			if ($this->config->use_group)
			{
				$group = $this->tools->getCurrentGroup();
				$id_group = $group->id;
			} else
				$id_group = 0;

			if ($this->config->{'required'.$id_group}
				&& !$this->dates->getDate($cart))
				return $this->l('Please select a delivery day to see payment methods');
			return true;
		}

		/**
		 * @since 1.6.3.0
		 **/
		public function hookNewOrder($params)
		{
			$delivery_day = $this->dates->getFormatedDate($params['order']->id_cart, $params['order']->id_lang);

			if ($delivery_day
				&& $this->config->id_employee)
			{
				$employee = new Employee((int)$this->config->id_employee);

				if (Validate::isLoadedObject($employee))
				{
					$id_lang = Configuration::get('PS_LANG_DEFAULT');
					$vars = array(
						'{id_order}' => $params['order']->id,
						'{delivery_day}' => Tools::htmlentitiesUTF8($delivery_day),
						'{firstname}' => $employee->firstname,
						'{lastname}' => $employee->lastname,
					);

					Mail::Send(
						$id_lang,
						'merchant',
						$this->l('Delivery date for order', false, $id_lang).' '.$params['order']->id,
						$vars,
						$employee->email,
						$employee->firstname.' '.$employee->lastname,
						null, null, null, null, $this->mail_path
					);
				}
			}

			if ($delivery_day
				&& $this->config->mailcustomer
				&& $this->config->separate_mail)
			{
				$customer = $params['customer'];

				if (Validate::isLoadedObject($customer))
				{
					$id_lang = $params['order']->id_lang;
					$vars = array(
						'{id_order}' => $params['order']->id,
						'{delivery_day}' => Tools::htmlentitiesUTF8($delivery_day),
						'{firstname}' => $customer->firstname,
						'{lastname}' => $customer->lastname,
					);

					// $this->l('Delivery date for order')
					Mail::Send(
						$id_lang,
						'customer',
						$this->l('Delivery date for order', false, $id_lang).' '.$params['order']->id,
						$vars,
						$customer->email,
						$customer->firstname.' '.$customer->lastname,
						null, null, null, null, $this->mail_path
					);
				}
			}
		}

		/**
		 * modify template var for the mail order_conf
		 * add delivery day below carrier name
		 * called by Mail::send
		 *
		 * return $template_vars with 2 new items
		 * - {carrier_original} same as carrier
		 * - {delivery_day} the delivery day for current order
		 *
		 * $template_vars['{carrier}'] is modified with the delivery_day if any
		 *
		 * @param array $template_vars
		 * @param integer $id_lang
		 * @return array modified $template_vars
		 */
		public function setMailTemplateVars($template_vars, $id_lang)
		{
			if ($this->config->mailcustomer
				&& !$this->config->separate_mail)
			{
				$template_vars['{carrier_original}'] = $template_vars['{carrier}'];
				$template_vars['{delivery_day}'] = '';

				$order_name = $template_vars['{order_name}'];
				$reference = explode('#', $order_name);
				$orders = Order::getByReference(reset($reference));
				$order = $orders->getFirst();
				if (Validate::isLoadedObject($order))
				{
					$delivery_day = $this->dates->getFormatedDate($order->id_cart, $id_lang);
					if ($delivery_day)
					{
						$template_vars['{delivery_day}'] = Tools::htmlentitiesUTF8($delivery_day);
						$template_vars['{carrier}'] .= "\n\t</strong><br/>".$this->l('Delivery day:').' <strong>'.$template_vars['{delivery_day}'];
					}
				}
			}

			return $template_vars;
		}
	}
}
