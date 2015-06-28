<?php
/**
 *	This file is part of Mobile Assistant Connector.
 *
 *   Mobile Assistant Connector is free software: you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation, either version 3 of the License, or
 *   (at your option) any later version.
 *
 *   Mobile Assistant Connector is distributed in the hope that it will be useful,
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *   GNU General Public License for more details.
 *
 *   You should have received a copy of the GNU General Public License
 *   along with Mobile Assistant Connector.  If not, see <http://www.gnu.org/licenses/>.
 *
 *  @author    eMagicOne <contact@emagicone.com>
 *  @copyright 2014-2015 eMagicOne
 *  @license   http://www.gnu.org/licenses   GNU General Public License
 */

if (!defined('_PS_VERSION_'))
	exit;

include_once _PS_MODULE_DIR_.'/mobassistantconnector/classes/FileLoggerMob.php';

class Mobassistantconnector extends Module
{
	private $file_logger;
	private $login_data;
	private $context_id_shop_prev;
	const HOOK_NEW_ORDER = 1;
	const HOOK_ACTION_ORDER_STATUS_POST_UPDATE = 2;
	const LOG_FILENAME = 'mobassistantconnector.log';
	const TRACKING_NUMBER_TEMPLATE_COMMON_MIDDLE = '/modules/mobassistantconnector/mails/common/tracking_number_middle.txt';

	public function __construct()
	{
		// Get current id_shop context
		$this->context_id_shop_prev = Shop::getContextShopID();

		// Set id_shop context to 'CONTEXT_ALL'
		$this->setContext();

		$this->name = 'mobassistantconnector';
		$this->tab = 'mobile';
		$this->version = '1.1.3';
		$this->author = 'eMagicOne';
		$this->module_key = 'c0b8b5438c3e54ae5f47df2d8da43907';
		$this->need_instance = 0;
		$this->is_configurable = 1;
		$this->bootstrap = true;
		$this->cart_version = Configuration::get('PS_INSTALL_VERSION');
		$this->def_shop = Configuration::get('PS_SHOP_DEFAULT');

		// Initialize logger
		$this->file_logger = new FileLoggerMob();
		$this->file_logger->setFilename(_PS_MODULE_DIR_.$this->name.'/log/'.self::LOG_FILENAME);

		if (version_compare($this->cart_version, '1.6.0.4', '='))
			$this->ps_versions_compliancy = array('min' => '1.5.1', 'max' => '1.7');
		else
			$this->ps_versions_compliancy = array('min' => '1.5.1', 'max' => '1.6');

		parent::__construct();

		$this->displayName = $this->l('Mobile Assistant Connector');
		$this->description = $this->l("Feel stressed leaving your Prestashop store off-hand during your vacation, meetings or conferences?
			Are you carrying laptop everywhere you go, repeatedly searching the answer for bothering question in your mind - 'What’s going on at my store?'
			With Prestashop Mobile Assistant on you can be on the move and have access to the real-time store data reports at your fingertips.
			Using it you can monitor key details on your products, customers and orders from your Android device wherever you are.");

		// Update module version in database
		$this->database_version_cur = $this->getDatabaseVersion();
		if ($this->database_version_cur !== null && version_compare($this->database_version_cur, $this->version, '<' ))
		{
			self::upgradeModuleVersion($this->name, $this->version);
			$this->_generateConfigXml();
		}

		$this->confirmUninstall = $this->l('Are you sure you want to uninstall?');

		if (!Configuration::get('MOBASSISTANTCONNECTOR'))
			$this->warning = $this->l('No name provided');
	}

	public function install()
	{
		return (parent::install()
			&& $this->registerHook('actionValidateOrder')
			&& $this->registerHook('actionOrderStatusPostUpdate')
			&& $this->registerHook('createAccount')
			&& Configuration::updateValue('MOBASSISTANTCONNECTOR', $this->formSaveLoginPassword())
			&& $this->updateTrackingNumberTemplate()
			&& Configuration::updateValue('MOBASSISTANTCONNECTOR_TN_LNG', 0));
	}

	public function uninstall()
	{
		if (!parent::uninstall()
			|| !Configuration::deleteByName('MOBASSISTANTCONNECTOR')
			|| !Configuration::deleteByName('MOBASSISTANTCONNECTOR_GOOGLE_IDS')
			|| !Configuration::deleteByName('MOBASSISTANTCONNECTOR_API_KEY')
			|| !Configuration::deleteByName('MOBASSISTANTCONNECTOR_TN_TEXT')
			|| !Configuration::deleteByName('MOBASSISTANTCONNECTOR_TN_LNG'))
			return false;

		return true;
	}

	public function getContent()
	{
		$output = null;

		if (isset($_REQUEST['mobassistantconnector_login']) && isset($_REQUEST['mobassistantconnector_password']))
		{
			if (Tools::isSubmit('submit'.$this->name))
			{
				$my_module_name = (string)Tools::getValue('submitmobassistantconnector');
				if (!$my_module_name || empty($my_module_name) || !Validate::isGenericName($my_module_name))
					$output .= $this->displayError($this->l('Invalid Configuration value'));
				else
				{
					if ($_REQUEST['mobassistantconnector_password'] == '')
					{
						$new_data = array();
						$data = unserialize(Configuration::get('MOBASSISTANTCONNECTOR'));
						$new_data['login'] = $_REQUEST['mobassistantconnector_login'];
						$new_data['password'] = $data['password'];
						Configuration::updateValue('MOBASSISTANTCONNECTOR', serialize($new_data));
					}
					else
						Configuration::updateValue(
							'MOBASSISTANTCONNECTOR',
							$this->formSaveLoginPassword($_REQUEST['mobassistantconnector_login'], $_REQUEST['mobassistantconnector_password'])
						);

					$languages = Language::getLanguages(false);

					// Update 'MOBASSISTANTCONNECTOR_TN_TEXT'
					$text = array();
					foreach ($languages as $lang)
						$text[$lang['id_lang']] = Tools::getValue('mobassistantconnector_tracknum_template_text_'.$lang['id_lang']);
					Configuration::updateValue('MOBASSISTANTCONNECTOR_TN_TEXT', $text);

					// Update 'MOBASSISTANTCONNECTOR_TN_LNG'
					Configuration::updateValue('MOBASSISTANTCONNECTOR_TN_LNG', $this->getMobassistantconnectorTracknumMessageLngAllValue());

					$output .= $this->displayConfirmation($this->l('Settings updated'));
				}
			}
		}

		$this->login_data = unserialize(Configuration::get('MOBASSISTANTCONNECTOR'));

		if ($this->login_data['login'] == '1' && $this->login_data['password'] == 'c4ca4238a0b923820dcc509a6f75849b')
			$output .= $this->displayError($this->l('Mobile Assistant Connector: Default login and password are "1".
				Change them because of security reasons, please!'));

		return $output.$this->displayForm();
	}

	public function displayForm()
	{
		// Get default language
		$default_lang = (int)Configuration::get('PS_LANG_DEFAULT');

		$fields_form = array();

		// Init Fields form array
		$fields_form[0]['form'] = array(
			'legend' => array(
				'title' => $this->l('Access Settings'),
			),
			'input' => array(
				array(
					'type' => 'text',
					'label' => $this->l('Login'),
					'name' => 'mobassistantconnector_login',
					'id' => 'mobassistantconnector_login',
					'desc' => $this->l('Login for accessing Mobile Assistant Connector from Your mobile application.'),
				),
				array(
					'type' => 'password',
					'label' => $this->l('Password'),
					'name' => 'mobassistantconnector_password',
					'id' => 'mobassistantconnector_password',
					'desc' => 'Password for accessing Mobile Assistant Connector from Your mobile application.
						Default password is \'1\'. Please change it to your own one.',
				),
				array(
					'type' => 'checkbox',
					'name' => 'mobassistantconnector',
					'label' => $this->l('Use current tracking number message for all languages'),
					'values' => array(
						'query' => array(
							array(
								'id' => 'tracknum_message_lng_all',
								'name' => $this->l('Use current tracking number message for all languages'),
								'val' => (int)Configuration::get('MOBASSISTANTCONNECTOR_TN_LNG'),
							),
						),
						'id' => 'id',
						'name' => 'name'
					),
				),
				array(
					'type' => 'textarea',
					'label' => $this->l('Tracking Number Change Message'),
					'name' => 'mobassistantconnector_tracknum_template_text',
					'id' => 'mobassistantconnector_tracknum_template_text',
					'desc' => $this->l("If 'Notify Customer by Email' option is enabled in Mobile Assistant, this message will be sent to a customer.
						You can set different messages for different languages if needed or use the same one for all the languages.
						{firstname}, {lastname}, {order_name}, {tracking_number} will be substituted by ones inherent to corresponding order"),
					'lang' => true,
				),
				array(
					'type' => 'text',
					'label' => $this->l('QR Code'),
					'name' => 'mobassistantconnector_qrcode',
					'id' => 'mobassistantconnector_qrcode',
					'class' => 'mobassistantconnector_invisible',
				),
				array(
					'type' => 'hidden',
					'name' => 'mobassistantconnector_qr_data',
					'id' => 'mobassistantconnector_qr_data',
				),

			),
			'submit' => array(
				'title' => (Tools::substr($this->cart_version, 0, 3) == '1.5') ? $this->l('Update settings') : $this->l('Save'),
				'class' => 'btn btn-default pull-right'
			)
		);

		$helper = new HelperForm();

		// Module, token and currentIndex
		$helper->module = $this;
		$helper->name_controller = $this->name;
		$helper->token = Tools::getAdminTokenLite('AdminModules');
		$helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->name;

		// Language
		$helper->default_form_language = $default_lang;
		$helper->allow_employee_form_lang = $default_lang;

		// Title and toolbar
		$helper->title = $this->displayName;
		(version_compare($this->cart_version, '1.6.0.0', '<' ) && version_compare($this->cart_version, '1.5.0.0', '>=' ))
			? $helper->show_toolbar = false
			: $helper->show_toolbar = true;		// false -> remove toolbar
		$helper->toolbar_scroll = true;	  // yes - > Toolbar is always visible on the top of the screen.
		$helper->submit_action = 'submit'.$this->name;
		$helper->toolbar_btn = array(
			'save' =>
			array(
				'desc' => $this->l('Save'),
				'href' => AdminController::$currentIndex.'&configure='.$this->name.'&save'.$this->name.
				'&token='.Tools::getAdminTokenLite('AdminModules'),
			),
			'back' => array(
				'href' => AdminController::$currentIndex.'&token='.Tools::getAdminTokenLite('AdminModules'),
				'desc' => $this->l('Back to list')
			)
		);

		$helper->tpl_vars = array(
			'fields_value' => $this->getConfigFieldsValues(),
			'languages' => $this->context->controller->getLanguages(),
			'id_language' => $this->context->language->id
		);

		if (version_compare($this->cart_version, '1.6.0.0', '<' ))
		{
			$root_path = '';
			$this->context->controller->addJS($root_path.'/modules/mobassistantconnector/views/js/ps_1.5.js');
		}
		else
		{
			$root_path = _PS_ROOT_DIR_;
			$this->context->controller->addJS($root_path.'/modules/mobassistantconnector/views/js/ps_1.6.js');
		}

		$this->context->controller->addCSS($root_path.'/modules/mobassistantconnector/views/css/mobassistantconnector.css');
		$this->context->controller->addJS($root_path.'/modules/mobassistantconnector/views/js/qrcode.min.js');
		$this->context->controller->addJS($root_path.'/modules/mobassistantconnector/views/js/common.js');

		return $helper->generateForm($fields_form);
	}

	public function getConfigFieldsValues()
	{
		$languages = Language::getLanguages(false);

		$data = array(
			'mobassistantconnector_login' => $this->login_data['login'],
			'mobassistantconnector_password' => $this->login_data['password'],
			'mobassistantconnector_tracknum_message_lng_all' => Configuration::get('MOBASSISTANTCONNECTOR_TN_LNG'),
			'mobassistantconnector_qrcode' => '',
			'mobassistantconnector_qr_data' => call_user_func('base64_encode', Tools::jsonEncode($this->getDataToQr())),
		);

		foreach ($languages as $lang)
			$data['mobassistantconnector_tracknum_template_text'][$lang['id_lang']] = Configuration::get('MOBASSISTANTCONNECTOR_TN_TEXT', $lang['id_lang']);

		return $data;
	}

	public function hookActionValidateOrder($params)
	{
		if (Module::isEnabled($this->name) === true)
			$this->hookOrderProcess(self::HOOK_NEW_ORDER, $params);
	}

	public function hookActionOrderStatusPostUpdate($params)
	{
		if (Module::isEnabled($this->name) === true && (!isset($GLOBALS['hookNewOrder']) || $GLOBALS['hookNewOrder'] != 1))
			$this->hookOrderProcess(self::HOOK_ACTION_ORDER_STATUS_POST_UPDATE, $params);
	}

	public function hookCreateAccount($params)
	{
		$device_ids = array();
		$type = 'new_customer';
		$id_shop = $params['newCustomer']->id_shop;

		if (Module::isEnabled($this->name) === true)
		{
			$device_id_actions = $this->pushSettingsUpgrade();

			if (count($device_id_actions) > 0)
			{
				foreach ($device_id_actions as $device_id)
				{
					if (($id_shop == $device_id['push_id_shop'] || $device_id['push_id_shop'] == -1) && (int)$device_id['app_connection_id'] > -1)
					{
						if ((int)$device_id['push_new_customer'] == 1)
						{
							$arr_tmp = array(
								'push_device_id' => $device_id['push_device_id'],
								'app_connection_id' => (int)$device_id['app_connection_id']
							);
							array_push($device_ids, $arr_tmp);
						}
					}
				}
			}

			$this->file_logger->logMessageCall(
				"******* Push message: Type: {$type}; All ids: ".count($device_id_actions).'; Accepted to current event: ('.count($device_ids).');',
				$this->file_logger->level
			);

			foreach ($device_ids as $device)
			{
				$store_url = $this->getStoreUrl($id_shop);
				$fields = array(
					'registration_ids' => array($device['push_device_id']),
					'data' => array(
						'message' => array(
							'push_notif_type' => $type,
							'email' => $params['newCustomer']->email,
							'customer_name' => $params['newCustomer']->firstname.' '.$params['newCustomer']->lastname,
							'customer_id' => $params['newCustomer']->id,
							'store_url' => $store_url,
							'id_shop' => $id_shop,
							'app_connection_id' => $device['app_connection_id']
						)
					)
				);

				$send_data = Tools::jsonEncode($fields['data']);
				$fields = Tools::jsonEncode($fields);

				$this->file_logger->logMessageCall(
					"Data: {$send_data}",
					$this->file_logger->level
				);

				$response = $this->sendPushMessage($fields);
				$device_ar_result = $this->proceedGoogleResponse($response, $device_ids, $device_id_actions);
				Configuration::updateValue('MOBASSISTANTCONNECTOR_GOOGLE_IDS', serialize($device_ar_result));
				$d_r = Tools::jsonDecode($response);

				$this->file_logger->logMessageCall(
					"Google response: (multicast_id = {$d_r->multicast_id}, success = {$d_r->success}, failure = {$d_r->failure},
						canonical_ids = {$d_r->canonical_ids})",
					$this->file_logger->level
				);
			}
		}

		// Set id_shop context to previous
		Shop::setContext(Shop::CONTEXT_SHOP, $this->context_id_shop_prev);
	}

	/* Common function for hookNewOrder, hookActionOrderStatusPostUpdate */
	private function hookOrderProcess($hook, $params)
	{
		$device_ids = array();
		$device_ids_by_ccode = array();
		$device_id_actions = $this->pushSettingsUpgrade();

		if ($hook == self::HOOK_NEW_ORDER)
		{
			$type = 'new_order';
			$total = $params['order']->total_paid;
			$id_shop = $params['order']->id_shop;
			$shop_info = new Shop($id_shop);
			$shop_name = $shop_info->name;
			$status = $params['orderStatus']->name;
			$status_id = $params['orderStatus']->id;

			$GLOBALS['hookNewOrder'] = 1;

			if (count($device_id_actions) > 0 && !is_null($status))
			{
				foreach ($device_id_actions as $device_id)
				{
					if ((int)$device_id['app_connection_id'] > -1)
					{
						$this->addLogPush($type, $device_id, $id_shop, $status, $status_id);

						if ($device_id['push_id_shop'] == $id_shop || $device_id['push_id_shop'] == -1)
						{
							if ((int)$device_id['push_new_order'] == 1 && !is_null($device_id['push_device_id']))
							{
								array_push($device_ids, $device_id['push_device_id']);
								$device_ids_by_ccode[$device_id['push_currency_code']]['push_device_id'][] = $device_id['push_device_id'];
								$device_ids_by_ccode[$device_id['push_currency_code']]['app_connection_id'][] = (int)$device_id['app_connection_id'];
							}
						}
					}
				}
			}

			$this->addLogDevice($type, $device_id_actions, $device_ids);

			foreach ($device_ids_by_ccode as $device_currency_code => $device_ids)
			{
				if (count($device_ids) > 0)
				{
					foreach ($device_ids['push_device_id'] as $key => $value)
					{
						// Form total
						$total = $this->getTotal($device_currency_code, $params['order']->id_currency, $total);

						$dev_id = array();
						$dev_id[] = $value;

						// Send data to Google
						$this->sendData(
							$device_ids['app_connection_id'][$key],
							$params['order']->id_shop,
							$shop_name,
							$dev_id,
							$type,
							$params['customer']->email,
							$params['customer']->firstname.' '.$params['customer']->lastname,
							$params['order']->id,
							$total,
							$device_id_actions,
							$status
						);
					}
				}
			}
		}
		else if ($hook == self::HOOK_ACTION_ORDER_STATUS_POST_UPDATE)
		{
			$type = 'order_changed';
			$order_info = new Order($params['id_order']);
			$customer_info = new Customer($order_info->id_customer);
			$id_shop = $order_info->id_shop;
			$shop_info = new Shop($id_shop);
			$shop_name = $shop_info->name;
			$order_currency_id = $order_info->id_currency;
			$total = $order_info->total_paid;
			$status_id = $params['newOrderStatus']->id;
			$status_name = $params['newOrderStatus']->name;

			if (count($device_id_actions) > 0 && !is_null($status_id))
			{
				foreach ($device_id_actions as $device_id)
				{
					if ((int)$device_id['app_connection_id'] > -1)
					{
						$this->addLogPush($type, $device_id, $id_shop, $params['newOrderStatus']->name, $status_id);

						if ($device_id['push_id_shop'] == $id_shop || $device_id['push_id_shop'] == -1)
						{
							if (Tools::strlen($device_id['push_order_statuses']) > 0 && (!in_array($device_id['push_device_id'], $device_ids)))
							{
								$statuses = explode('|', $device_id['push_order_statuses']);

								if (in_array($status_id, $statuses) || (int)$statuses[0] == -1)
								{
									if (!in_array($device_id['push_device_id'], $device_ids))
									{
										array_push($device_ids, $device_id['push_device_id']);
										$device_ids_by_ccode[$device_id['push_currency_code']]['push_device_id'][] = $device_id['push_device_id'];
										$device_ids_by_ccode[$device_id['push_currency_code']]['app_connection_id'][] = (int)$device_id['app_connection_id'];
									}
								}
							}
						}
					}
				}
			}

			$this->addLogDevice($type, $device_id_actions, $device_ids);

			foreach ($device_ids_by_ccode as $device_currency_code => $device_ids)
			{
				if (count($device_ids['push_device_id']) > 0)
				{
					foreach ($device_ids['push_device_id'] as $key => $value)
					{
						// Form total
						$total = $this->getTotal($device_currency_code, $order_currency_id, $total);

						$dev_id = array();
						$dev_id[] = $value;

						// Send data to Google
						$this->sendData(
							$device_ids['app_connection_id'][$key],
							$order_info->id_shop,
							$shop_name,
							$dev_id,
							$type,
							$customer_info->email,
							$customer_info->firstname.' '.$customer_info->lastname,
							$params['id_order'],
							$total,
							$device_id_actions,
							$status_name
						);
					}
				}
			}
		}

		// Set id_shop context to previous
		Shop::setContext(Shop::CONTEXT_SHOP, $this->context_id_shop_prev);
	}

	private function addLogDevice($type, $device_id_actions, $device_ids)
	{
		$this->file_logger->logMessageCall(
			"******* Push message: Type: {$type}; All ids: ".count($device_id_actions).'; Accepted to current event: ('.count($device_ids).');',
			$this->file_logger->level
		);
	}

	private function addLogPush($type, $device_id, $id_shop, $status, $status_id)
	{
		$this->file_logger->logMessageCall(
			'push_order_action: '.$type.
			"\n\t\t push_new_order: ".$device_id['push_new_order'].
			"\n\t\t push_id_shop: ".$device_id['push_id_shop'].
			"\n\t\t id_shop: ".$id_shop.
			"\n\t\t push_order_statuses: ".$device_id['push_order_statuses'].
			"\n\t\t status_name: ".$status.
			"\n\t\t status_id: ".$status_id.
			"\n\t\t push_device_id: ".$device_id['push_device_id'],
			$this->file_logger->level
		);
	}

	private function addLogSendData($type, $send_data)
	{
		$this->file_logger->logMessageCall(
			"Push message: Type: {$type}; data: {$send_data}",
			$this->file_logger->level
		);
	}

	private function addLogGoogleResponse($d_r)
	{
		$this->file_logger->logMessageCall(
			"Google response: (multicast_id = {$d_r->multicast_id}, success = {$d_r->success}, failure = {$d_r->failure},
				canonical_ids = {$d_r->canonical_ids})",
			$this->file_logger->level
		);
	}

	private function getTotal($device_currency_code, $order_currency_id, $total)
	{
		if (empty($device_currency_code) || (string)$device_currency_code == '0')
			$device_currency_code = (int)Configuration::get('PS_CURRENCY_DEFAULT');

		$device_currency = Currency::getCurrencyInstance($device_currency_code);

		if ((int)$device_currency_code != $order_currency_id)
		{
			$currency_from = Currency::getCurrencyInstance($order_currency_id);
			$total = Tools::convertPriceFull($total, $currency_from, $device_currency);
		}

		$total = Tools::displayPrice($total, $device_currency);

		return $total;
	}

	private function getStoreUrl($id_shop)
	{
		$store_info = Shop::getShop($id_shop);
		$store_url = $store_info['domain'].$store_info['uri'];
		$store_url = str_replace('http://', '', $store_url);
		$store_url = str_replace('https://', '', $store_url);
		preg_replace('/\/*$/i', '', $store_url);

		return $store_url;
	}

	private function sendData($app_connection_id,
		$id_shop,
		$shop_name,
		$device_ids,
		$type,
		$customer_email,
		$customer_name,
		$id_order,
		$total,
		$device_id_actions,
		$status_label)
	{
		$store_url = $this->getStoreUrl($id_shop);
		$fields = array(
			'registration_ids' => array_values($device_ids),
			'data' => array(
				'message' => array(
					'push_notif_type' => $type,
					'email' => $customer_email,
					'customer_name' => $customer_name,
					'order_id' => $id_order,
					'total' => $total,
					'store_url' => $store_url,
					'new_status' => $status_label,
					'id_shop' => $id_shop,
					'shop_name' => $shop_name,
					'app_connection_id' => $app_connection_id
				)
			),
		);

		$send_data = Tools::jsonEncode($fields['data']);

		$this->addLogSendData($type, $send_data);

		$fields = Tools::jsonEncode($fields);
		$response = $this->sendPushMessage($fields);
		$device_ar_result = $this->proceedGoogleResponse($response, $device_ids, $device_id_actions);
		Configuration::updateValue('MOBASSISTANTCONNECTOR_GOOGLE_IDS', serialize($device_ar_result));
		$d_r = Tools::jsonDecode($response);

		$this->addLogGoogleResponse($d_r);
	}

	private function sendPushMessage($message_content)
	{
		$api_key = Configuration::get('MOBASSISTANTCONNECTOR_API_KEY');
		$headers = array('Authorization: key='.$api_key, 'Content-Type: application/json');
		$result = false;

		if (is_callable('curl_init'))
		{
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, 'https://android.googleapis.com/gcm/send');
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $message_content);
			$result = curl_exec($ch);

			if (curl_errno($ch))
				$this->file_logger->logMessageCall(
					"Push message error while sending CURL request: {$result}",
					$this->file_logger->level
				);

			curl_close($ch);
		}

		return $result;
	}

	private function pushSettingsUpgrade()
	{
		$device_ids = Configuration::get('MOBASSISTANTCONNECTOR_GOOGLE_IDS');

		if (Tools::strlen($device_ids) > 0)
			$device_ids = unserialize($device_ids);
		else
			$device_ids = array();

		foreach (array_keys($device_ids) as $key)
		{
			if (!is_int($key))
			{
				$device_ids[$key]['push_device_id'] = $key;
				if (empty($device_ids[$key]['push_id_shop']))
					$device_ids[$key]['push_id_shop'] = -1;
				if (empty($device_ids[$key]['push_currency_code']))
					$device_ids[$key]['push_currency_code'] = Configuration::get('PS_CURRENCY_DEFAULT');
				if (empty($device_ids[$key]['app_connection_id']))
					$device_ids[$key]['app_connection_id'] = -1;
				array_push($device_ids, $device_ids[$key]);
				unset($device_ids[$key]);
			}
		}

		//Check for duplicated records
		foreach ($device_ids as $a1 => $first_device)
		{
			if (empty($first_device['push_currency_code']))
				$device_ids[$a1]['push_currency_code'] = Configuration::get('PS_CURRENCY_DEFAULT');

			if (empty($device_ids[$key]['app_connection_id']))
				$device_ids[$key]['app_connection_id'] = -1;

			foreach ($device_ids as $a2 => $second_device)
			{
				if (($first_device === $second_device) && ($a1 != $a2))
					unset($device_ids[$a1]);
			}
		}

		return $device_ids;
	}

	private function proceedGoogleResponse($response, $device_ids, $device_id_actions)
	{
		if ($response)
		{
			$json = Tools::jsonDecode($response, true);

			if (!is_array($json))
				$json = array();
		}
		else
			$json = array();

		$failure = isset($json['failure']) ? $json['failure'] : null;
		$canonical_ids = isset($json['canonical_ids']) ? $json['canonical_ids'] : null;

		if ($failure || $canonical_ids)
		{
			$results = isset($json['results']) ? $json['results'] : array();
			foreach ($results as $id => $result)
			{
				$new_reg_id = isset($result['registration_id']) ? $result['registration_id'] : null;
				$error = isset($result['error']) ? $result['error'] : null;
				if ($new_reg_id)
				{
					// It's duplicated deviceId
					if (in_array($new_reg_id, $device_ids) && $new_reg_id != $device_ids[$id])
					{
						// Loop through the devices and delete old
						foreach ($device_id_actions as $setting_num => $device_id)
						{
							if ($device_id['push_device_id'] == $device_ids[$id])
								unset($device_id_actions[$setting_num]);
						}
						// Need to update old deviceId
					}
					else if (!in_array($new_reg_id, $device_ids))
					{
						foreach ($device_id_actions as $device_id)
						{
							if ($device_id['push_device_id'] == $device_ids[$id])
								$device_id_actions[$setting_num]['push_device_id'] = $new_reg_id;
						}
					}
				}
				else if ($error)
				{
					// Unset not registered device id
					if ($error == 'NotRegistered' || $error == 'InvalidRegistration')
					{
						foreach ($device_id_actions as $setting_num => $device_id)
						{
							if ($device_id['push_device_id'] == $device_ids[$id])
								unset($device_id_actions[$setting_num]);
						}
					}
				}
			}
		}

		return $device_id_actions;
	}

	private function formSaveLoginPassword($login = '1', $password = '1')
	{
		$data = array();
		$data['login'] = $login;
		$data['password'] = md5($password);

		return serialize($data);
	}

	private function getDatabaseVersion()
	{
		$db_version_obj = new DbQuery();
		$db_version_obj->select('version');
		$db_version_obj->from('module');
		$db_version_obj->where('id_module = '.(int)$this->id);
		$db_version_sql = $db_version_obj->build();
		$db_version = Db::getInstance()->executeS($db_version_sql);

		if (is_array($db_version))
			$db_version = array_shift($db_version);

		return $db_version['version'];
	}

	private function updateTrackingNumberTemplate()
	{
		$languages = Language::getLanguages(false);

		$fp = fopen(_PS_ROOT_DIR_.self::TRACKING_NUMBER_TEMPLATE_COMMON_MIDDLE, 'r');
		if ($fp)
		{
			$file_content = fread($fp, filesize(_PS_ROOT_DIR_.self::TRACKING_NUMBER_TEMPLATE_COMMON_MIDDLE));

			$data = array();
			foreach ($languages as $lang)
				$data[$lang['id_lang']] = $file_content;

			return Configuration::updateValue('MOBASSISTANTCONNECTOR_TN_TEXT', $data);
		}

		return false;
	}

	private function getMobassistantconnectorTracknumMessageLngAllValue()
	{
		return isset($_REQUEST['mobassistantconnector_tracknum_message_lng_all']) ?
			$_REQUEST['mobassistantconnector_tracknum_message_lng_all'] : 0;
	}

	private function getDataToQr()
	{
		$array = array();
		$shop_info = new Shop((int)Configuration::get('PS_SHOP_DEFAULT'));
		$shop_url = $shop_info->getBaseURL();
		$store_url = str_replace('http://', '', $shop_url);
		$store_url = str_replace('https://', '', $store_url);
		preg_replace('/\/*$/i', '', $store_url);
		$array['url'] = $store_url;
		$data = unserialize(Configuration::get('MOBASSISTANTCONNECTOR'));
		$array['login'] = $data['login'];
		$array['password'] = $data['password'];

		return $array;
	}

	private function setContext()
	{
		if (Shop::isFeatureActive())
			Shop::setContext(Shop::CONTEXT_ALL);
	}

}