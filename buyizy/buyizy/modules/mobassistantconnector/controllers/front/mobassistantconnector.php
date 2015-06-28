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

if (!defined('_PS_VERSION_')) exit;

include_once _PS_MODULE_DIR_.'/mobassistantconnector/classes/FileLoggerMob.php';

class MobassistantconnectorMobassistantconnectorModuleFrontController extends ModuleFrontController
{
	private $module_name = 'mobassistantconnector';
	private $module_configuration_name = 'MOBASSISTANTCONNECTOR';
	private $google_ids = 'MOBASSISTANTCONNECTOR_GOOGLE_IDS';
	private $mob_api_key = 'MOBASSISTANTCONNECTOR_API_KEY';
	private $call_function;
	private $callback;
	private $hash;
	private $def_currency;
	private $def_lang;
	private $file_logger;
	private $def_shop;
	private $weight_unit;
	private $cart_version;
	const MODULE_VERSION = '19';
	const LOG_FILENAME = 'mobassistantconnector.log';
	const CURRENCY_NOT_SET = 'not_set';
	const GUEST = 'Guest not registered';

	public function init()
	{
		parent::init();
		$this->indexAction();
	}

	private function indexAction()
	{
		if (!Module::isEnabled($this->module_name))
			$this->generateOutput('module_disabled');

		$this->def_lang = (int)Configuration::get('PS_LANG_DEFAULT');
		$this->def_currency = (int)Configuration::get('PS_CURRENCY_DEFAULT');
		$this->cart_version = Configuration::get('PS_INSTALL_VERSION');
		$this->weight_unit = Configuration::get('PS_WEIGHT_UNIT');
		$this->def_shop = Configuration::get('PS_SHOP_DEFAULT');

		$this->file_logger = new FileLoggerMob();
		$this->file_logger->setFilename(_PS_MODULE_DIR_.$this->module_name.'/log/'.self::LOG_FILENAME);

		foreach ($_REQUEST as $key => $value)
		{
			if (Tools::getIsset($key) && $key == 'callback' && Tools::strlen(Tools::getValue($key)) > 0)
				$this->callback = Tools::getValue($key);
			if (Tools::getIsset($key) && $key == 'call_function' && Tools::strlen(Tools::getValue($key)) > 0)
				$this->call_function = Tools::getValue($key);
			if (Tools::getIsset($key) && $key == 'hash' && Tools::strlen(Tools::getValue($key)) > 0)
				$this->hash = Tools::getValue($key);
		}

		if ($this->call_function === null)
			$this->runSelfTest();

		if (!$this->checkAuth() && $this->call_function != 'run_self_test')
			$this->generateOutput('auth_error');

		$request_params = $_REQUEST;
		$params = $this->validateTypes($request_params, array(
			'show' => 'INT',
			'page' => 'INT',
			'is_mail' => 'INT',
			'search_order_id' => 'STR',
			'orders_from' => 'STR',
			'orders_to' => 'STR',
			'customers_from' => 'STR',
			'customers_to' => 'STR',
			'date_from' => 'STR',
			'date_to' => 'STR',
			'graph_from' => 'STR',
			'graph_to' => 'STR',
			'stats_from' => 'STR',
			'stats_to' => 'STR',
			'products_to' => 'STR',
			'products_from' => 'STR',
			'order_id' => 'INT',
			'user_id' => 'INT',
			'params' => 'STR',
			'val' => 'STR',
			'search_val' => 'STR',
			'statuses' => 'STR',
			'sort_by' => 'STR',
			'last_order_id' => 'STR',
			'product_id' => 'INT',
			'get_statuses' => 'INT',
			'cust_with_orders' => 'INT',
			'data_for_widget' => 'INT',
			'registration_id' => 'STR',
			'registration_id_old' => 'STR',
			'registration_id_new' => 'STR',
			'api_key' => 'STR',
			'push_new_order' => 'INT',
			'push_order_statuses' => 'STR',
			'push_new_customer' => 'INT',
			'app_connection_id' => 'INT',
			'push_currency_code' => 'INT',
			'tracking_number' => 'STR',
			'tracking_title' => 'STR',
			'action' => 'STR',
			'carrier_code' => 'STR',
			'custom_period' => 'INT',
			'shop_id' => 'INT',
			'cart_id' => 'INT',
			'new_status' => 'INT',
			'currency_code' => 'STR',
			'fc' => 'STR',
			'module' => 'STR',
			'controller' => 'STR',
			'search_carts' => 'STR',
			'carts_from' => 'STR',
			'carts_to' => 'STR',
		));

		foreach ($params as $k => $value)
		{
			$this->{$k} = $value;

			if ($k == 'currency_code')
				if ($value == self::CURRENCY_NOT_SET)
					$this->{$k} = $value;
				elseif ($value == 'base_currency' || Currency::getCurrencyInstance((int)$value)->id === null)
					$this->{$k} = Configuration::get('PS_CURRENCY_DEFAULT');
				else
					$this->{$k} = (int)$value;
		}

		if ($this->call_function == 'test_config')
			$this->generateOutput(array('test' => 1));

		$result = $this->getMethodResult($this->call_function);
		$this->generateOutput($result);
	}

	private function validateTypes(&$array, $names)
	{
		foreach ($names as $name => $type)
		{
			if (isset($array["$name"]))
			{
				switch ($type)
				{
					case 'INT':
						$array["$name"] = (int)$array["$name"];
						break;
					case 'FLOAT':
						$array["$name"] = (float)$array["$name"];
						break;
					case 'STR':
						$array["$name"] = str_replace(array("\r", "\n"), ' ', addslashes(htmlspecialchars(trim(urldecode($array["$name"])))));
						break;
					case 'STR_HTML':
						$array["$name"] = addslashes(trim(urldecode($array["$name"])));
						break;
					default:
						$array["$name"] = '';
				}
			}
			else
				$array["$name"] = '';
		}

		$array_keys = array_keys($array);

		foreach ($array_keys as $key)
		{
			if (!isset($names[$key]) && $key != 'call_function' && $key != 'hash')
				$array[$key] = '';
		}

		return $array;
	}

	private function checkAuth()
	{
		$login_data = unserialize(Configuration::get($this->module_configuration_name));

		if (md5($login_data['login'].$login_data['password']) == $this->hash)
			return true;
		else
		{
			$this->file_logger->logMessageCall("Hash accepted ({$this->hash}) is incorrect", $this->file_logger->level);

			return false;
		}
	}

	private function testDefaultPasswordIsChanged()
	{
		$login_data = unserialize(Configuration::get($this->module_configuration_name));

		return !($login_data['login'] == '1' && $login_data['password'] == 'c4ca4238a0b923820dcc509a6f75849b');
	}

	private function runSelfTest()
	{
		$html = '<h2>Mobile Assistant Connector Self Test Tool</h2>
			<div style="padding: 5px; margin: 10px 0;">
			This tool checks your website to make sure there are no issues in your hosting configuration.
			<br />Your hosting support can solve all issues found here.</div>
			<table cellpadding=2><tr><th>Test Title</th><th>Result</th></tr>
			<tr><td>Module Version</td><td>'.self::MODULE_VERSION.'</td><td></td></tr>
			<tr><td>Prestashop Market Module Version</td><td>'.Module::getInstanceByName($this->module_name)->version.'</td><td></td></tr>
			<tr><td>Prestashop Cart Version</td><td>'.Configuration::get('PS_INSTALL_VERSION').'</td><td></td></tr>
			<tr><td>Current PHP version</td><td>'.phpversion().'</td><td></td></tr>
			<tr><td>Default Login and Password Changed</td><td>'
			.(($res = $this->testDefaultPasswordIsChanged()) ? '<span style="color: #008000;">Yes</span>' : '<span style="color: #ff0000;">Fail</span>')
			.'</td>';

		if (!$res)
			$html = $html.'<td>Change your login credentials in '.basename($_SERVER['SCRIPT_NAME']).' to make your connection secure</td>';

		$html = $html.'</table><br/><br/>
			<div style="margin-top: 15px; font-size: 13px;">Mobile Assistant Connector by <a href="http://emagicone.com" target="_blank"
			style="color: #15428B">eMagicOne</a></div>';

		die($html);
	}

	private function getStores()
	{
		$shop_group_ret = array();
		$shop_groups_tree = Shop::getTree();

		foreach ($shop_groups_tree as $shop_group_tree)
		{
			$shop_group_ret_shops = array();

			foreach ($shop_group_tree['shops'] as $shop)
				$shop_group_ret_shops[] = array('id_shop' => $shop['id_shop'], 'id_shop_group' => $shop['id_shop_group'], 'name' => $shop['name']);

			$shop_group_ret[] = array('group_id' => $shop_group_tree['id'], 'name' => $shop_group_tree['name'], 'shops' => $shop_group_ret_shops);
		}

		return $shop_group_ret;
	}

	private function getCurrencies()
	{
		$currency_ret = array();
		$currency_ids = array();
		$i = 0;
		$currencies = Currency::getCurrencies();

		foreach ($currencies as $currency)
		{
			if (!in_array($currency['id_currency'], $currency_ids))
			{
				$currency_ret[$i]['code'] = $currency['id_currency'];
				$currency_ret[$i]['symbol'] = $currency['sign'];
				$currency_ret[$i]['name'] = $currency['name'];
				$currency_ids[] = $currency['id_currency'];
				$i ++;
			}
		}

		return $currency_ret;
	}

	private function getStoreTitle()
	{
		if (!empty($this->shop_id))
		{
			if ($this->shop_id == -1)
				$this->shop_id = $this->def_shop;
			$shop_info = new Shop($this->shop_id);
		}
		else
			$shop_info = new Shop((int)Configuration::get('PS_SHOP_DEFAULT'));

		return array('test' => 1, 'title' => $shop_info->name);
	}

	private function pushNotificationSettings()
	{
		if ((int)$this->app_connection_id < 1)
			return false;

		$matched = false;
		$device_actions = array(
			'push_device_id' => '',
			'push_new_order' => 0,
			'push_order_statuses' => '',
			'push_new_customer' => 0,
			'app_connection_id' => -1,
			'push_id_shop' => -1,
			'push_currency_code' => '');

		$device_ids = Configuration::get($this->google_ids);

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

				array_push($device_ids, $device_ids[$key]);
				unset($device_ids[$key]);
			}
		}

		if (Tools::strlen($this->registration_id) > 0 && Tools::strlen($this->api_key) > 0)
		{
			$device_actions['app_connection_id'] = (int)$this->app_connection_id;

			if (Tools::strlen($this->registration_id ) > 0)
				$device_actions['push_device_id'] = $this->registration_id;

			if (Tools::strlen($this->push_new_order ) > 0)
				$device_actions['push_new_order'] = $this->push_new_order;
			else
				$device_actions['push_new_order'] = 0;

			if (Tools::strlen($this->push_order_statuses) > 0)
				$device_actions['push_order_statuses'] = $this->push_order_statuses;
			else
				$device_actions['push_order_statuses'] = '';

			if (Tools::strlen($this->push_new_customer ) > 0)
				$device_actions['push_new_customer'] = $this->push_new_customer;
			else
				$device_actions['push_new_customer'] = 0;

			// Use shop_id instead of id_shop for saving data in the same cell of the table 'configuration'
			if (!empty($this->shop_id))
				$device_actions['push_id_shop'] = $this->shop_id;
			else
				$device_actions['push_id_shop'] = -1;

			if (Tools::strlen($this->push_currency_code) > 0)
				$device_actions['push_currency_code'] = $this->push_currency_code;
			elseif (Tools::strlen($this->currency_code) > 0)
				$device_actions['push_currency_code'] = $this->currency_code;
			else
				$device_actions['push_currency_code'] = $this->def_currency;

			// Delete empty record
			if (((int)$this->push_new_order == 0) && (Tools::strlen($this->push_order_statuses) == 0) && ((int)$this->push_new_customer == 0))
			{
				foreach ($device_ids as $setting_num => $device_id)
				{
					if ($device_id['push_device_id'] == $this->registration_id
						&& (isset($device_id['app_connection_id'])
						&& $device_id['app_connection_id'] == $device_actions['app_connection_id']))
						unset($device_ids[$setting_num]);
				}
			}
			else
			{
				// renew old record
				foreach ($device_ids as $setting_num => $device_id)
				{
					if ($device_id['push_device_id'] == $this->registration_id
						&& (isset($device_id['app_connection_id'])
						&& $device_id['app_connection_id'] == $device_actions['app_connection_id']))
					{
						$device_ids[$setting_num] = $device_actions;
						$matched = true;
					}
				}
				if (!$matched)
				{
					// add new record
					array_push($device_ids, $device_actions);
				}
			}

			// Delete old registration id
			if (isset($this->registration_id_old) && Tools::strlen($this->registration_id_old) > 0)
			{
				foreach ($device_ids as $setting_num => $device_id)
				{
					if ($device_id['push_device_id'] == $this->registration_id_old)
						unset($device_ids[$setting_num]);
				}
			}

			Configuration::updateValue($this->google_ids, serialize($device_ids));
			Configuration::updateValue($this->mob_api_key, $this->api_key);

			$result = array('success' => 'true');
		}
		else
			$result = array('error' => 'Can not get configuration value');

		return $result;
	}

	private function getOrdersStatuses()
	{
		$statuses = OrderStateCore::getOrderStates($this->def_lang);
		$statuses = array_map(array($this, 'statusProcess'), $statuses);

		return $statuses;
	}

	private function getStoreStats()
	{
		$data_graphs = '';
		$query_where_parts = '';
		$order_status_stats = array();
		$offset = $this->getTimezoneOffset();
		$store_stats = array('count_orders' => '0',
			'total_sales' => '0',
			'count_customers' => '0',
			'count_products' => '0',
			'last_order_id' => '0',
			'new_orders' => '0');
		$today = date('Y-m-d', time());
		$date_from = $date_to = $today;

		if (!empty($this->stats_from))
			$date_from = $this->stats_from;

		if (!empty($this->stats_to))
			$date_to = $this->stats_to;

		if (isset($this->custom_period) && Tools::strlen($this->custom_period) > 0)
		{
			$custom_period = $this->getCustomPeriod($this->custom_period);

			$date_from = $custom_period['start_date'];
			$date_to = $custom_period['end_date'];
		}

		if (!empty($date_from))
			$query_where_parts[] = "CONVERT_TZ(o.date_add, '+00:00',  '".pSQL($offset)."') >= '"
				.(date('Y-m-d H:i:s', (strtotime($date_from.' 00:00:00')))."'");

		if (!empty($date_to))
			$query_where_parts[] = "CONVERT_TZ(o.date_add, '+00:00',  '".pSQL($offset)."') <= '"
				.(date('Y-m-d H:i:s', (strtotime($date_to.' 23:59:59')))."'");

		if (!empty($this->shop_id) && $this->shop_id != -1)
			$query_where_parts[] = 'o.id_shop = '.(int)$this->shop_id;

		if (!empty($this->statuses))
		{
			$statuses = str_replace('|', ',', $this->statuses);
			$query_where_parts[] = 'osl.id_order_state IN ('.pSQL($statuses).')';
		}

		// Get count of orders
		$orders_count_obj = new DbQuery();
		$orders_count_obj->select('
			COUNT(o.id_order) AS count_orders,
			IFNULL(SUM(o.total_paid/o.conversion_rate), 0) AS total_sales
		');
		$orders_count_obj->from('orders', 'o');
		$orders_count_obj->leftJoin('order_state_lang', 'osl', 'osl.id_order_state = o.current_state AND osl.id_lang = '.(int)$this->def_lang);
		if (!empty($query_where_parts))
			$orders_count_obj->where(implode(' AND ', $query_where_parts));
		$orders_count_sql = $orders_count_obj->build();
		$orders_count = Db::getInstance()->executeS($orders_count_sql);
		$orders_count = array_shift($orders_count);

		// Convert price
		if ($this->currency_code != $this->def_currency)
			$orders_count['total_sales'] = $this->convertPrice($orders_count['total_sales'], $this->def_currency);

		// Form price
		$orders_count['total_sales'] = $this->displayPrice($orders_count['total_sales'], $this->currency_code, true);

		// Add count and sum of orders into return array
		$store_stats['count_orders'] = $orders_count['count_orders'];
		$store_stats['total_sales'] = $orders_count['total_sales'];

		// Get count of products
		$products_count_obj = new DbQuery();
		$products_count_obj->select('COUNT(od.product_id) AS count_products');
		$products_count_obj->from('orders', 'o');
		$products_count_obj->leftJoin('order_detail', 'od', 'od.id_order = o.id_order');
		$products_count_obj->leftJoin('order_state_lang', 'osl', 'osl.id_order_state = o.current_state AND osl.id_lang = '.(int)$this->def_lang);
		if (!empty($query_where_parts))
			$products_count_obj->where(implode(' AND ', $query_where_parts));
		$products_count_sql = $products_count_obj->build();
		$products_count = Db::getInstance()->executeS($products_count_sql);
		$products_count = array_shift($products_count);

		// Add count and sum of products into return array
		$store_stats['count_products'] = $products_count['count_products'];

		// Get last_order_id and count of new orders
		if ($this->last_order_id != '')
		{
			$order_last_obj = new DbQuery();
			$order_last_obj->select('
				COUNT(o.id_order) AS count_orders,
				MAX(o.id_order) AS last_order_id
			');
			$order_last_obj->from('orders', 'o');
			$order_last_obj->leftJoin('order_state_lang', 'osl', 'osl.id_order_state = o.current_state AND osl.id_lang = '.(int)$this->def_lang);
			if (!empty($query_where_parts))
				$order_last_obj->where(implode(' AND ', $query_where_parts).' AND o.id_order > '.(int)$this->last_order_id);
			else
				$order_last_obj->where('o.id_order > '.(int)$this->last_order_id);
			$order_last_sql = $order_last_obj->build();
			$order_last = Db::getInstance()->executeS($order_last_sql);
			$order_last = array_shift($order_last);

			// Add last_order_id and count of new orders into return array
			if ($order_last['last_order_id'] > (int)$this->last_order_id)
				$store_stats['last_order_id'] = $order_last['last_order_id'];
			$store_stats['new_orders'] = $order_last['count_orders'];
		}

		unset($query_where_parts);

		if (!empty($date_from))
			$query_where_parts[] = "CONVERT_TZ(date_add, '+00:00', '".$offset."') >= '".date('Y-m-d H:i:s', (strtotime($date_from.' 00:00:00')))."'";

		if (!empty($date_to))
			$query_where_parts[] = "CONVERT_TZ(date_add, '+00:00', '".$offset."') <= '".date('Y-m-d H:i:s', (strtotime($date_to.' 23:59:59')))."'";

		if (!empty($this->shop_id) && $this->shop_id != -1)
			$query_where_parts[] = 'id_shop = '.(int)$this->shop_id;

		// Get count of customers
		$customers_count_obj = new DbQuery();
		$customers_count_obj->select('COUNT(id_customer) AS count_customers');
		$customers_count_obj->from('customer');
		if (!empty($query_where_parts))
			$customers_count_obj->where(implode(' AND ', $query_where_parts));
		$customers_count_sql = $customers_count_obj->build();
		$customers_count = Db::getInstance()->executeS($customers_count_sql);
		$customers_count = array_shift($customers_count);

		// Add count of customers into return array
		$store_stats['count_customers'] = $customers_count['count_customers'];

		if (!isset($this->data_for_widget) || empty($this->data_for_widget) || $this->data_for_widget != 1)
			$data_graphs = $this->getDataGraphs();

		if (!isset($this->data_for_widget) || $this->data_for_widget != 1)
			$order_status_stats = $this->getStatusStats();

		$result = array_merge($store_stats, array('data_graphs' => $data_graphs), array('order_status_stats' => $order_status_stats));

		return $result;
	}

	private function getDataGraphs()
	{
		$orders = array();
		$customers = array();
		$where_statuses = '';
		$where_id_shop = '';
		$average = array(
			'avg_sum_orders' => 0,
			'sum_orders' => 0,
			'tot_orders' => 0,
			'tot_customers' => 0,
			'avg_orders' => 0,
			'avg_customers' => 0,
			'avg_cust_order' => '0.00',
		);
		$offset = $this->getTimezoneOffset();

		if (empty($this->graph_from))
			$this->graph_from = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') - 7, date('Y')));

		if (empty($this->graph_to))
		{
			if (!empty($this->stats_to))
				$this->graph_to = $this->stats_to;
			else
				$this->graph_to = date('Y-m-d', time());
		}

		if (!empty($this->shop_id) && $this->shop_id != -1)
			$where_id_shop = ' AND id_shop = '.(int)$this->shop_id;

		$start_date = $this->graph_from.' 00:00:00';
		$end_date = $this->graph_to.' 23:59:59';
		$plus_date = '+1 day';

		if (isset($this->custom_period) && Tools::strlen($this->custom_period) > 0)
		{
			$custom_period = $this->getCustomPeriod($this->custom_period);

			if ($this->custom_period == 3)
				$plus_date = '+3 day';
			else if ($this->custom_period == 4)
				$plus_date = '+1 week';
			else if ($this->custom_period == 5 || $this->custom_period == 6 || $this->custom_period == 7)
				$plus_date = '+1 month';

			if ($this->custom_period == 7)
			{
				$dates_obj = new DbQuery();
				$dates_obj->select('
					MIN(date_add) AS min_date_add,
					MAX(date_add) AS max_date_add
				');
				$dates_obj->from('orders');
				$dates_sql = $dates_obj->build();
				$dates = Db::getInstance()->executeS($dates_sql);

				$dates = array_shift($dates);
				$start_date = $dates['min_date_add'];
				$end_date = $dates['max_date_add'];
			}
			else
			{
				$start_date = $custom_period['start_date'].' 00:00:00';
				$end_date = $custom_period['end_date'].' 23:59:59';
			}
		}

		$start_date = strtotime($start_date);
		$end_date = strtotime($end_date);
		$date = $start_date;
		$d = 0;

		if (!empty($this->statuses))
		{
			$statuses = str_replace('|', ',', $this->statuses);
			$where_statuses = 'osl.id_order_state IN ('.pSQL($statuses).') AND ';
		}

		while ($date <= $end_date)
		{
			$d++;
			$date_str = date('Y-m-d H:i:s', ($date));
			$where_orders_date_add = "CONVERT_TZ(o.date_add, '+00:00', '{$offset}') >= '{$date_str}'
				AND CONVERT_TZ(o.date_add, '+00:00', '{$offset}') < '".date('Y-m-d H:i:s', (strtotime($plus_date, $date)))."'";

			// Get orders
			$orders_tot_obj = new DbQuery();
			$orders_tot_obj->select("
				(CONVERT_TZ(o.date_add, '+00:00', '{$offset}')) AS date_add,
				SUM(o.total_paid/o.conversion_rate) AS value,
				COUNT(o.id_order) AS tot_orders
			");
			$orders_tot_obj->from('orders', 'o');
			$orders_tot_obj->leftJoin('order_state_lang', 'osl', 'osl.id_order_state = o.current_state AND osl.id_lang = '.(int)$this->def_lang);
			$orders_tot_obj->where($where_statuses.$where_orders_date_add.$where_id_shop);
			$orders_tot_obj->groupBy('DATE(o.date_add)');
			$orders_tot_obj->orderBy('o.date_add');
			$orders_tot_sql = $orders_tot_obj->build();
			$orders_tot = Db::getInstance()->executeS($orders_tot_sql);

			$total_order_per_day = 0;

			// Get total of orders per date
			foreach ($orders_tot as $order)
			{
				$total_order_per_day += $order['value'];
				$average['tot_orders'] += $order['tot_orders'];
				$average['sum_orders'] += $order['value'];
			}

			// Convert price
			if ($this->currency_code != $this->def_currency)
				$total_order_per_day = $this->convertPrice($total_order_per_day, $this->def_currency);

			$orders[] = array($date * 1000, $total_order_per_day);
			$where_customers_date_add = "CONVERT_TZ(date_add, '+00:00', '{$offset}') >= '{$date_str}'
				AND CONVERT_TZ(date_add, '+00:00', '{$offset}') < '".date('Y-m-d H:i:s', (strtotime($plus_date, $date)))."'";

			// Get customers
			$customers_tot_obj = new DbQuery();
			$customers_tot_obj->select("
				COUNT(id_customer) AS tot_customers,
				CONVERT_TZ(date_add, '+00:00', '{$offset}') AS date_add
			");
			$customers_tot_obj->from('customer');
			$customers_tot_obj->where($where_customers_date_add.$where_id_shop);
			$customers_tot_obj->groupBy('DATE(date_add)');
			$customers_tot_obj->orderBy('date_add');
			$customers_tot_sql = $customers_tot_obj->build();
			$customers_tot = Db::getInstance()->executeS($customers_tot_sql);

			$total_customer_per_day = 0;

			// Get total of customers per date
			foreach ($customers_tot as $customer)
			{
				$total_customer_per_day += $customer['tot_customers'];
				$average['tot_customers'] += $customer['tot_customers'];
			}

			$customers[] = array($date * 1000, $total_customer_per_day);
			$date = strtotime($plus_date, $date);
		}

		// Add 2 additional element into array of orders for graph in mobile application
		if (count($orders) == 1)
		{
			$orders_tmp = $orders[0];
			$orders = array();
			$orders[0][] = strtotime(date('Y-m-d', $orders_tmp[0] / 1000).'-1 month') * 1000;
			$orders[0][] = 0;
			$orders[1] = $orders_tmp;
			$orders[2][] = strtotime(date('Y-m-d', $orders_tmp[0] / 1000).'+1 month') * 1000;
			$orders[2][] = 0;
		}

		// Add 2 additional element into array of customers for graph in mobile application
		if (count($customers) == 1)
		{
			$customers_tmp = $customers[0];
			$customers = array();
			$customers[0][] = strtotime(date('Y-m-d', $customers_tmp[0] / 1000).'-1 month') * 1000;
			$customers[0][] = 0;
			$customers[1] = $customers_tmp;
			$customers[2][] = strtotime(date('Y-m-d', $customers_tmp[0] / 1000).'+1 month') * 1000;
			$customers[2][] = 0;
		}

		if ($d <= 0) $d = 1;
		$average['avg_sum_orders'] = number_format($average['sum_orders'] / $d, 2, '.', ' ');
		$average['avg_orders'] = number_format($average['tot_orders'] / $d, 1, '.', ' ');
		$average['avg_customers'] = number_format($average['tot_customers'] / $d, 1, '.', ' ');

		if ($average['tot_customers'] > 0)
			$average['avg_cust_order'] = number_format($average['sum_orders'] / $average['tot_customers'], 1, '.', ' ');

		$average['sum_orders'] = number_format($average['sum_orders'], 2, '.', ' ');
		$average['tot_customers'] = number_format($average['tot_customers'], 1, '.', ' ');
		$average['tot_orders'] = number_format($average['tot_orders'], 1, '.', ' ');

		if ($this->currency_code != self::CURRENCY_NOT_SET)
			$currency = new Currency($this->currency_code);
		else
			$currency = new Currency($this->def_currency);

		return array('orders' => $orders, 'customers' => $customers, 'currency_sign' => $currency->sign, 'average' => $average);
	}

	private function getStatusStats()
	{
		$order_statuses_ret = array();
		$query_where_parts = array();
		$offset = $this->getTimezoneOffset();
		$today = date('Y-m-d', time());
		$date_from = $date_to = $today;

		if (!empty($this->stats_from))
			$date_from = $this->stats_from;

		if (!empty($this->stats_to))
			$date_to = $this->stats_to;

		if (isset($this->custom_period) && Tools::strlen($this->custom_period) > 0)
		{
			$custom_period = $this->getCustomPeriod($this->custom_period);

			$date_from = $custom_period['start_date'];
			$date_to = $custom_period['end_date'];
		}

		if (!empty($date_from))
			$date_from = $date_from.' 00:00:00';

		if (!empty($date_to))
			$date_to = $date_to.' 23:59:59';

		if (!empty($this->shop_id) && $this->shop_id != -1)
			$query_where_parts[] = 'o.id_shop = '.(int)$this->shop_id;

		if (!empty($date_from) && !empty($date_to))
		{
			$query_where_parts[] = "CONVERT_TZ(o.date_add, '+00:00', '{$offset}') >= '".date('Y-m-d H:i:s', strtotime($date_from))."'
				AND CONVERT_TZ(o.date_add, '+00:00', '{$offset}') <= '".date('Y-m-d H:i:s', strtotime($date_to))."'";
		}

		// Get count of orders by status
		$order_statuses_obj = new DbQuery();
		$order_statuses_obj->select('
			COUNT(o.id_order) AS count,
			SUM(o.total_paid/o.conversion_rate) AS total,
			osl.name,
			o.current_state AS code
		');
		$order_statuses_obj->from('orders', 'o');
		$order_statuses_obj->leftJoin('order_state_lang', 'osl', 'osl.id_order_state = o.current_state AND osl.id_lang = '.(int)$this->def_lang);
		if (!empty($query_where_parts))
			$order_statuses_obj->where(implode(' AND ', $query_where_parts));
		$order_statuses_obj->groupBy('o.current_state');
		$order_statuses_obj->orderBy('count DESC');
		$order_statuses_sql = $order_statuses_obj->build();
		$order_statuses = Db::getInstance()->executeS($order_statuses_sql);

		foreach ($order_statuses as $order_status)
		{
			if ($this->currency_code != $this->def_currency)
				$order_status['total'] = $this->convertPrice($order_status['total'], $this->def_currency);

			$order_status['total'] = $this->displayPrice($order_status['total'], $this->currency_code, true);
			$order_statuses_ret[] = $order_status;
		}

		return $order_statuses_ret;
	}

	private function searchProducts()
	{
		$query_where_parts = array();
		$products = array();
		$this->params = explode('|', $this->params);
		$query_limit = 0;
		$query_offset = 0;
		$order_by = '';
		$id_shop = (int)$this->def_shop;

		if (!empty($this->shop_id) && $this->shop_id != -1)
		{
			$where_id_shop = (int)$this->shop_id;
			$id_shop = (int)$this->shop_id;
		}
		else
			$where_id_shop = (int)$this->def_shop;

		if ($this->page !== null && !empty($this->page) && $this->show !== null && !empty($this->show))
		{
			$query_limit = ((int)$this->page - 1) * (int)$this->show;
			$query_offset = (int)$this->show;
		}

		if (empty($this->sort_by))
			$this->sort_by = 'id';

		switch ($this->sort_by)
		{
			case 'id':
				$order_by = 'p.id_product DESC';
				break;
			case 'name':
				$order_by = 'pl.name ASC';
				break;
		}

		foreach ($this->params as $param)
		{
			switch ($param)
			{
				case 'pr_id':
					if (!empty($this->val) && preg_match('/^\d+(?:,\d+)*$/', $this->val))
						$query_where_parts[] = 'p.id_product IN ('.pSQL($this->val).')';
					else
						$query_where_parts[] = 'p.id_product = '.(int)$this->val;

					break;
				case 'pr_sku':
					$query_where_parts[] = "p.reference = '".pSQL($this->val)."'";
					break;
				case 'pr_name':
					$query_where_parts[] = "pl.name LIKE '%".pSQL($this->val)."%'";
					break;
				case 'pr_desc':
					$query_where_parts[] = "pl.description LIKE '%".pSQL($this->val)."%'";
					break;
				case 'pr_short_desc':
					$query_where_parts[] = "pl.description_short LIKE '%".pSQL($this->val)."%'";
					break;
			}
		}

		// Get products
		$products_obj = new DbQuery();
		$products_obj->select('
			p.id_product AS main_id,
			p.id_product AS product_id,
			pl.name,
			pl.link_rewrite,
			p.price AS default_price,
			p.wholesale_price AS default_wholesale_price,
			sa.quantity,
			p.reference AS sku,
			ps.price,
			ps.wholesale_price,
			s.name AS shop_name
		');
		$products_obj->from('product', 'p');
		$products_obj->leftJoin('product_lang', 'pl', 'p.id_product = pl.id_product AND pl.id_lang = '.(int)$this->def_lang);
		$products_obj->leftJoin('stock_available', 'sa', 'p.id_product = sa.id_product AND sa.id_product_attribute = 0');
		$products_obj->leftJoin('product_shop', 'ps', 'ps.id_product = p.id_product AND ps.id_shop = '.(int)$id_shop);
		$products_obj->leftJoin('shop', 's', 's.id_shop = '.(int)$id_shop);

		if (!empty($query_where_parts))
			$products_obj->where(implode(' OR ', $query_where_parts));

		$products_obj->groupBy('p.id_product');
		$products_obj->orderBy($order_by);
		$products_obj->limit($query_offset, $query_limit);
		$products_sql = $products_obj->build();
		$products_res = Db::getInstance()->executeS($products_sql);

		foreach ($products_res as $product)
		{
			if ($this->currency_code != $this->def_currency)
			{
				$product['price'] = $this->convertPrice($product['price'], $this->def_currency);
				$product['wholesale_price'] = $this->convertPrice($product['wholesale_price'], $this->def_currency);
			}

			$product['price'] = $this->displayPrice($product['price'], $this->currency_code, true);
			$product['wholesale_price'] = $this->displayPrice($product['wholesale_price'], $this->currency_code, true);

			// Get url of product image
			$image_url = $this->getProductImageUrl($product['product_id'], $product['link_rewrite']);
			if ($image_url)
				$product['product_image'] = $image_url;

			$products[] = $product;
		}

		// Get count of products
		$products_count_obj = new DbQuery();
		$products_count_obj->select('COUNT(p.id_product) AS count_prods');
		$products_count_obj->from('product', 'p');
		$products_count_obj->leftJoin('product_lang', 'pl', 'p.id_product = pl.id_product AND pl.id_lang = '.(int)$this->def_lang.'
			AND id_shop = '.$where_id_shop);

		if (!empty($this->shop_id) && $this->shop_id != -1)
			$products_count_obj->innerJoin('product_shop', 'ps', 'p.id_product = ps.id_product AND ps.id_shop = '.(int)$this->shop_id);

		if (!empty($query_where_parts))
			$products_count_obj->where(implode(' OR ', $query_where_parts));

		$products_count_sql = $products_count_obj->build();
		$products_count = Db::getInstance()->executeS($products_count_sql);
		$products_count = array_shift($products_count);

		return array('products_count' => (int)$products_count['count_prods'], 'products' => $products);
	}

	private function searchProductsOrdered()
	{
		$offset = $this->getTimezoneOffset();
		$query_where_parts = array();
		$products = array();
		$order_by = '';
		$query_limit = 0;
		$query_offset = 0;
		$this->params = explode('|', $this->params);

		foreach ($this->params as $param)
		{
			switch ($param)
			{
				case 'pr_id':
					if (!empty($this->val) && preg_match('/^\d+(?:,\d+)*$/', $this->val))
						$query_where_parts[] = 'od.product_id IN ('.pSQL($this->val).')';
					else
						$query_where_parts[] = 'od.product_id = '.(int)$this->val;

					break;
				case 'pr_sku':
					$query_where_parts[] = "od.product_reference = '".pSQL($this->val)."'";
					break;
				case 'pr_name':
					$query_where_parts[] = "od.product_name LIKE '%".pSQL($this->val)."%'";
					break;
			}
		}

		if (!empty($this->shop_id) && $this->shop_id != -1)
			$query_where_parts[] = 'o.id_shop = '.(int)$this->shop_id;

		if (!empty($this->products_from))
			$query_where_parts[] = "CONVERT_TZ(o.date_add, '+00:00',  '".$offset."') >= '"
				.(date('Y-m-d H:i:s', (strtotime($this->products_from.' 00:00:00')))."'");

		if (!empty($this->products_to))
			$query_where_parts[] = "CONVERT_TZ(o.date_add, '+00:00',  '".$offset."') <= '"
				.(date('Y-m-d H:i:s', (strtotime($this->products_to.' 23:59:59')))."'");

		if ($this->page !== null && !empty($this->page) && $this->show !== null && !empty($this->show))
		{
			$query_limit = ((int)$this->page - 1) * (int)$this->show;
			$query_offset = (int)$this->show;
		}

		if (!empty($this->statuses))
		{
			$statuses = str_replace('|', ',', $this->statuses);
			$query_where_parts[] = 'o.current_state IN ('.pSQL($statuses).')';
		}

		if (empty($this->sort_by))
			$this->sort_by = 'id';

		switch ($this->sort_by)
		{
			case 'id':
				$order_by = 'od.id_order DESC';
				break;
			case 'name':
				$order_by = 'pl.name ASC';
				break;
		}

		// Get ordered products
		$products_ordered_obj = new DbQuery();
		$products_ordered_obj->select('
			od.id_order AS main_id,
			od.id_order AS order_id,
			od.product_id,
			pl.name,
			pl.link_rewrite,
			od.product_reference AS sku,
			od.product_price AS price,
			p.price AS real_product_price,
			p.wholesale_price,
			od.product_quantity AS quantity,
			osl.name AS `status`
		');
		$products_ordered_obj->from('order_detail', 'od');
		$products_ordered_obj->leftJoin('orders', 'o', 'od.id_order = o.id_order');
		$products_ordered_obj->leftJoin('product', 'p', 'p.id_product = od.product_id');
		$products_ordered_obj->leftJoin('product_lang', 'pl', 'od.product_id = pl.id_product AND o.id_lang = pl.id_lang AND od.id_shop = pl.id_shop');
		$products_ordered_obj->leftJoin('order_state_lang', 'osl', 'osl.id_order_state = o.current_state AND osl.id_lang = o.id_lang');
		if (!empty($query_where_parts))
			$products_ordered_obj->where(implode(' AND ', $query_where_parts));
		$products_ordered_obj->orderBy($order_by);
		$products_ordered_obj->limit($query_offset, $query_limit);
		$products_ordered_sql = $products_ordered_obj->build();
		$products_ordered_res = Db::getInstance()->executeS($products_ordered_sql);

		foreach ($products_ordered_res as $product_ordered)
		{
			if ($this->currency_code != $this->def_currency)
			{
				$product_ordered['price'] = $this->convertPrice($product_ordered['price'], $this->def_currency);
				$product_ordered['real_product_price'] = $this->convertPrice($product_ordered['real_product_price'], $this->def_currency);
				$product_ordered['wholesale_price'] = $this->convertPrice($product_ordered['wholesale_price'], $this->def_currency);
			}

			$product_ordered['price'] = $this->displayPrice($product_ordered['price'], $this->currency_code, true);
			$product_ordered['real_product_price'] = $this->displayPrice($product_ordered['real_product_price'], $this->currency_code, true);
			$product_ordered['wholesale_price'] = $this->displayPrice($product_ordered['wholesale_price'], $this->currency_code, true);

			// Get url of product image
			$image_url = $this->getProductImageUrl($product_ordered['product_id'], $product_ordered['link_rewrite']);
			if ($image_url)
				$product_ordered['product_image'] = $image_url;

			$products[] = $product_ordered;
		}

		// Get count of ordered products
		$products_ordered_count_obj = new DbQuery();
		$products_ordered_count_obj->select('
			COUNT(od.product_id) AS count_prods,
			MAX(o.date_add) AS max_date,
			MIN(o.date_add) AS min_date
		');
		$products_ordered_count_obj->from('order_detail', 'od');
		$products_ordered_count_obj->leftJoin('orders', 'o', 'od.id_order = o.id_order');
		if (!empty($query_where_parts))
			$products_ordered_count_obj->where(implode(' AND ', $query_where_parts));
		$products_ordered_count_sql = $products_ordered_count_obj->build();
		$products_ordered_count = Db::getInstance()->executeS($products_ordered_count_sql);
		$products_ordered_count = array_shift($products_ordered_count);

		return array(
			'products_count' => (int)$products_ordered_count['count_prods'],
			'products' => $products,
		);
	}

	private function getProductsInfo()
	{
		if ((int)$this->product_id < 1)
			return false;

		$sel_total_ordered = '';
		$query_where_parts = array();
		$id_shop = (int)$this->def_shop;

		if (!empty($this->shop_id) && (int)$this->shop_id != -1)
		{
			$query_where_parts[] = 'o.id_shop = '.(int)$this->shop_id;
			$sel_total_ordered = ' AND id_shop = '.(int)$this->shop_id;
			$id_shop = (int)$this->shop_id;
		}

		// Get product information
		$product_obj = new DbQuery();
		$product_obj->select("
			p.id_product,
			pl.name,
			p.price AS default_price,
			p.wholesale_price AS default_wholesale_price,
			sa.quantity,
			p.reference AS sku,
			if (p.active = 1, 'Enabled', 'Disabled') AS active,
			i.id_image,
			ps.price AS price,
			ps.wholesale_price,
			s.name AS shop_name,
			(SELECT SUM(product_quantity) FROM "._DB_PREFIX_.'order_detail WHERE product_id = p.id_product'.$sel_total_ordered.') AS total_ordered
		');
		$product_obj->from('product', 'p');
		$product_obj->leftJoin('product_lang', 'pl', 'pl.id_product = p.id_product AND pl.id_lang = '.(int)$this->def_lang);
		$product_obj->leftJoin('image', 'i', 'i.id_product = p.id_product AND i.cover = 1');
		$product_obj->leftJoin('stock_available', 'sa', 'p.id_product = sa.id_product AND sa.id_product_attribute = 0');
		$product_obj->leftJoin('product_shop', 'ps', 'ps.id_product = p.id_product AND ps.id_shop = '.(int)$id_shop);
		$product_obj->leftJoin('shop', 's', 's.id_shop = '.(int)$id_shop);
		$product_obj->where('p.id_product = '.(int)$this->product_id);
		$product_obj->groupBy('p.id_product');
		$product_sql = $product_obj->build();
		$product = Db::getInstance()->executeS($product_sql);
		$product = array_shift($product);

		if (!$product['total_ordered'])
			$product['total_ordered'] = 0;

		// Convert price
		if ($this->currency_code != $this->def_currency)
		{
			$product['price'] = $this->convertPrice($product['price'], $this->def_currency);
			$product['wholesale_price'] = $this->convertPrice($product['wholesale_price'], $this->def_currency);
		}

		// Form price
		$product['price'] = $this->displayPrice($product['price'], $this->currency_code, true);
		$product['wholesale_price'] = $this->displayPrice($product['wholesale_price'], $this->currency_code, true);

		// Get product images
		$id_image = $product['id_image'];
		$image_info = new Image($id_image);

		$home_type = 'home_';
		$thickbox_type = 'thickbox_';
		$default = 'default';

		if (file_exists(_PS_PROD_IMG_DIR_.$image_info->getExistingImgPath().'-'.$home_type.$default.'.jpg'))
			$product['id_image'] = _PS_BASE_URL_._THEME_PROD_DIR_.$image_info->getExistingImgPath().'-'.$home_type.$default.'.jpg';
		else
			$product['id_image'] = '';

		if (file_exists(_PS_PROD_IMG_DIR_.$image_info->getExistingImgPath().'-'.$thickbox_type.$default.'.jpg'))
			$product['id_image_large'] = _PS_BASE_URL_._THEME_PROD_DIR_.$image_info->getExistingImgPath().'-'.$thickbox_type.$default.'.jpg';
		else
			$product['id_image_large'] = '';

		return $product;
	}

	private function getProductsDescr()
	{
		$id_shop = (int)$this->def_shop;

		if (!empty($this->shop_id) && (int)$this->shop_id != -1)
			$id_shop = (int)$this->shop_id;

		$product_obj = new DbQuery();
		$product_obj->select('
			pl.description AS descr,
			pl.description_short AS short_descr
		');
		$product_obj->from('product_lang', 'pl');
		$product_obj->where('pl.id_product = '.(int)$this->product_id.' AND pl.id_shop = '.(int)$id_shop.' AND pl.id_lang = '.(int)$this->def_lang);
		$product_sql = $product_obj->build();
		$product = Db::getInstance()->executeS($product_sql);
		$product = array_shift($product);

		return $product;
	}

	private function getCustomers()
	{
		$offset = $this->getTimezoneOffset();
		$customers = array();
		$order_by = '';
		$query_where_parts = '';
		$query_limit = 0;
		$query_offset = 0;

		if (!empty($this->customers_from))
			$query_where_parts[] = "CONVERT_TZ(c.date_add, '+00:00',  '".$offset."') >= '"
				.(date('Y-m-d H:i:s', (strtotime($this->customers_from.' 00:00:00')))."'");

		if (!empty($this->customers_to))
			$query_where_parts[] = "CONVERT_TZ(c.date_add, '+00:00',  '".$offset."') <= '"
				.(date('Y-m-d H:i:s', (strtotime($this->customers_to.' 23:59:59')))."'");

		if (!empty($this->search_val) && preg_match('/^\d+(?:,\d+)*$/', $this->search_val))
			$query_where_parts[] = 'c.id_customer IN ('.pSQL($this->search_val).')';
		elseif (!empty($this->search_val))
			$query_where_parts[] = "(c.email LIKE '%".pSQL($this->search_val)."%' OR CONCAT(c.firstname, ' ', c.lastname) LIKE '%"
				.pSQL($this->search_val)."%')";

		if (!empty($this->cust_with_orders))
			$query_where_parts[] = 'tot.total_orders > 0';

		if (!empty($this->shop_id) && $this->shop_id != -1)
			$query_where_parts[] = 'c.id_shop = '.(int)$this->shop_id;

		if ($this->page !== null && !empty($this->page) && $this->show !== null && !empty($this->show))
		{
			$query_limit = ((int)$this->page - 1) * (int)$this->show;
			$query_offset = (int)$this->show;
		}

		if (empty($this->sort_by))
			$this->sort_by = 'id';

		switch ($this->sort_by)
		{
			case 'id':
				$order_by = 'c.id_customer DESC';
				break;
			case 'date':
				$order_by = 'c.date_add DESC';
				break;
			case 'name':
				$order_by = 'full_name ASC';
				break;
		}

		// Get customers
		$customers_obj = new DbQuery();
		$customers_obj->select("
			c.id_customer,
			c.firstname,
			c.lastname,
			CONCAT(c.firstname, ' ', c.lastname) AS full_name,
			c.email,
			c.date_add,
			IFNULL(tot.total_orders, 0) AS total_orders
		");
		$customers_obj->from('customer', 'c LEFT OUTER JOIN
			(SELECT COUNT(id_order) AS total_orders, id_customer FROM '._DB_PREFIX_.'orders GROUP BY id_customer) AS tot ON tot.id_customer = c.id_customer');
		if (!empty($query_where_parts))
			$customers_obj->where(implode(' AND ', $query_where_parts));
		$customers_obj->orderBy($order_by);
		$customers_obj->limit($query_offset, $query_limit);
		$customers_sql = $customers_obj->build();
		$customers_res = Db::getInstance()->executeS($customers_sql);

		foreach ($customers_res as $customer)
		{
			$date = explode(' ', $customer['date_add']);
			$customer['date_add'] = $date[0];
			$customer['total_orders'] = (int)$customer['total_orders'];
			$customers[] = $customer;
		}

		// Get count of customers
		$customers_count_obj = new DbQuery();
		$customers_count_obj->select('
			COUNT(c.id_customer) AS count_custs,
			MAX(c.date_add) AS max_date,
			MIN(c.date_add) AS min_date
		');
		$customers_count_obj->from('customer', 'c LEFT OUTER JOIN
			(SELECT COUNT(id_order) AS total_orders, id_customer FROM '._DB_PREFIX_.'orders GROUP BY id_customer) AS tot ON tot.id_customer = c.id_customer');
		if (!empty($query_where_parts))
			$customers_count_obj->where(implode(' AND ', $query_where_parts));
		$customers_count_sql = $customers_count_obj->build();
		$customers_count = Db::getInstance()->executeS($customers_count_sql);
		$customers_count = array_shift($customers_count);

		return array(
			'customers_count' => (int)$customers_count['count_custs'],
			'customers' => $customers,
		);
	}

	private function getCustomersInfo()
	{
		$customer_orders = array();
		$customer_addresses = array();
		$query_limit = 0;
		$query_offset = 0;

		if ($this->page !== null && !empty($this->page) && $this->show !== null && !empty($this->show))
		{
			$query_limit = ((int)$this->page - 1) * (int)$this->show;
			$query_offset = (int)$this->show;
		}

		$customer = new Customer((int)$this->user_id);

		// Get all cutomer addresses
		$addresses = $customer->getAddresses($this->def_lang);
		foreach ($addresses as $address)
		{
			$customer_addresses[] = array(
				'dni' 	   	   => $address['dni'],
				'alias' 	   => $address['alias'],
				'first_name'   => $address['firstname'],
				'last_name'    => $address['lastname'],
				'company'      => $address['company'],
				'vat_number'   => $address['vat_number'],
				'address1'     => $address['address1'],
				'address2'     => $address['address2'],
				'postcode'     => $address['postcode'],
				'city'     	   => $address['city'],
				'country'      => $address['country'],
				'state'        => $address['state'],
				'phone'    	   => $address['phone'],
				'phone_mobile' => $address['phone_mobile'],
				'other'        => $address['other'],
			);
		}

		// Get customer general information
		$customer_info = array(
			'id_customer' => $customer->id,
			'firstname'   => $customer->firstname,
			'lastname'    => $customer->lastname,
			'date_add'    => $customer->date_add,
			'email'       => $customer->email,
		);

		// Get customer orders
		$customer_orders_obj = new DbQuery();
		$customer_orders_obj->select('
			o.id_order,
			o.date_add,
			o.total_paid,
			o.id_currency,
			osl.name AS ord_status,
			c.iso_code,
			c.sign,
			c.format,
			SUM(od.product_quantity) AS pr_qty
		');
		$customer_orders_obj->from('orders', 'o');
		$customer_orders_obj->leftJoin('currency', 'c', 'o.id_currency = c.id_currency');
		$customer_orders_obj->leftJoin('order_detail', 'od', 'od.id_order = o.id_order');
		$customer_orders_obj->leftJoin('order_state_lang', 'osl', 'osl.id_order_state = o.current_state AND osl.id_lang = '.(int)$this->def_lang);
		$customer_orders_obj->where('o.id_customer = '.(int)$this->user_id);
		$customer_orders_obj->groupBy('o.id_order');
		$customer_orders_obj->orderBy('o.id_order DESC');
		$customer_orders_obj->limit($query_offset, $query_limit);
		$customer_orders_sql = $customer_orders_obj->build();
		$customer_orders_res = Db::getInstance()->executeS($customer_orders_sql);

		foreach ($customer_orders_res as $customer_order)
		{
			if ($this->currency_code != $customer_order['id_currency'])
				$customer_order['total_paid'] = $this->convertPrice($customer_order['total_paid'], $customer_order['id_currency']);

			$customer_order['total_paid'] = $this->displayPrice($customer_order['total_paid'], $customer_order['id_currency']);
			unset($customer_order['id_currency']);
			$customer_orders[] = $customer_order;
		}

		// Get count of orders for customer
		$customer_orders_count_obj = new DbQuery();
		$customer_orders_count_obj->select('
			COUNT(o.id_order) AS count_ords,
			SUM(o.total_paid/o.conversion_rate) AS sum_ords
		');
		$customer_orders_count_obj->from('orders', 'o');
		$customer_orders_count_obj->where('o.id_customer = '.(int)$this->user_id);
		$customer_orders_count_sql = $customer_orders_count_obj->build();
		$customer_orders_count_res = Db::getInstance()->executeS($customer_orders_count_sql);
		$customer_orders_count = array_shift($customer_orders_count_res);

		if ($this->currency_code != $this->def_currency)
			$customer_orders_count['sum_ords'] = $this->convertPrice($customer_orders_count['sum_ords'], $this->def_currency);

		$customer_orders_count['sum_ords'] = $this->displayPrice($customer_orders_count['sum_ords'], $this->currency_code, true);

		return array(
			'user_info'       => $customer_info,
			'addresses'       => $customer_addresses,
			'customer_orders' => $customer_orders,
			'c_orders_count'  => (int)$customer_orders_count['count_ords'],
			'sum_ords'        => $customer_orders_count['sum_ords']
		);
	}

	private function getOrders()
	{
		$offset = $this->getTimezoneOffset();
		$query_where_parts = array();
		$query_limit = 0;
		$query_offset = 0;
		$orders = array();

		if ($this->shop_id !== null && !empty($this->shop_id) && (int)$this->shop_id != -1)
			$query_where_parts[] = 'o.id_shop = '.(int)$this->shop_id;

		if ($this->statuses !== null && !empty($this->statuses))
			$query_where_parts[] = 'o.current_state IN ('.pSQL(str_replace('|', ',', $this->statuses)).')';

		if (!empty($this->search_order_id) && preg_match('/^\d+(?:,\d+)*$/', $this->search_order_id))
			$query_where_parts[] = 'o.id_order IN ('.pSQL($this->search_order_id).')';
		elseif (!empty($this->search_order_id))
			$query_where_parts[] = "(CONCAT(cus.firstname, ' ', cus.lastname) LIKE '%".pSQL($this->search_order_id)."%' OR o.reference LIKE '%"
				.pSQL($this->search_order_id)."%')";

		if ($this->orders_from !== null && !empty($this->orders_from))
			$query_where_parts[] = "CONVERT_TZ(o.date_add, '+00:00',  '".$offset."') >= '"
				.(date('Y-m-d H:i:s', (strtotime($this->orders_from.' 00:00:00')))."'");

		if ($this->orders_to !== null && !empty($this->orders_to))
			$query_where_parts[] = "CONVERT_TZ(o.date_add, '+00:00',  '".$offset."') <= '"
				.(date('Y-m-d H:i:s', (strtotime($this->orders_to.' 23:59:59')))."'");

		if ($this->page !== null && !empty($this->page) && $this->show !== null && !empty($this->show))
		{
			$query_limit = ((int)$this->page - 1) * (int)$this->show;
			$query_offset = (int)$this->show;
		}

		if (empty($this->sort_by))
			$this->sort_by = 'id';

		switch ($this->sort_by)
		{
			case 'id':
				$order_by = 'o.id_order DESC';
				break;
			case 'date':
				$order_by = 'o.date_add DESC';
				break;
			case 'name':
				$order_by = 'customer ASC';
				break;
			default:
				$order_by = '';
				break;
		}

		// Get orders
		$orders_obj = new DbQuery();
		$orders_obj->select("
			o.id_order,
			o.date_add,
			o.total_paid,
			o.id_currency,
			o.current_state AS status_code,
			c.iso_code,
			c.sign,
			c.format,
			CONCAT(cus.firstname, ' ', cus.lastname) AS customer,
			osl.name AS ord_status,
			s.name AS shop_name,
			o.id_shop,
			(SELECT SUM(od.product_quantity) FROM `"._DB_PREFIX_.'order_detail` AS od WHERE od.id_order = o.id_order) AS count_prods
		');
		$orders_obj->from('orders', 'o');
		$orders_obj->leftJoin('currency', 'c', 'o.id_currency = c.id_currency');
		$orders_obj->leftJoin('customer', 'cus', 'o.id_customer = cus.id_customer');
		$orders_obj->leftJoin('order_state_lang', 'osl', 'o.current_state = osl.id_order_state AND osl.id_lang = '.(int)$this->def_lang);
		$orders_obj->leftJoin('shop', 's', 's.id_shop = o.id_shop');
		if (!empty($query_where_parts))
			$orders_obj->where(implode(' AND ', $query_where_parts));
		$orders_obj->orderBy($order_by);
		$orders_obj->limit($query_offset, $query_limit);
		$orders_sql = $orders_obj->build();
		$orders_res = Db::getInstance()->executeS($orders_sql);

		// Convert price data
		foreach ($orders_res as $order)
		{
			if ($this->currency_code != $order['id_currency'])
				$order['total_paid'] = $this->convertPrice($order['total_paid'], $order['id_currency']);

			$order['total_paid'] = $this->displayPrice($order['total_paid'], $order['id_currency']);
			unset($order['id_currency']);
			$orders[] = $order;
		}

		// Get orders statistics
		$orders_stats_obj = new DbQuery();
		$orders_stats_obj->select('
			COUNT(o.id_order) AS count_ords,
			SUM(o.total_paid/o.conversion_rate) AS total_paid
		');
		$orders_stats_obj->from('orders', 'o');
		$orders_stats_obj->leftJoin('currency', 'c', 'o.id_currency = c.id_currency');
		$orders_stats_obj->leftJoin('customer', 'cus', 'o.id_customer = cus.id_customer');
		if (!empty($query_where_parts))
			$orders_stats_obj->where(implode(' AND ', $query_where_parts));
		$orders_stats_sql = $orders_stats_obj->build();
		$orders_stats = Db::getInstance()->executeS($orders_stats_sql);
		$orders_stats = array_shift($orders_stats);

		if ($this->currency_code != $this->def_currency)
			$orders_stats['total_paid'] = $this->convertPrice($orders_stats['total_paid'], $this->def_currency);

		$orders_total = $this->displayPrice($orders_stats['total_paid'], $this->currency_code, true);

		// Get all order statuses
		$orders_status = null;
		if (isset($this->get_statuses) && $this->get_statuses == 1)
			$orders_status = $this->getOrdersStatuses();

		return array(
			'orders' => $orders,
			'orders_count' => (int)$orders_stats['count_ords'],
			'orders_total' => $orders_total,
			'orders_status' => $orders_status,
		);
	}

	private function getOrdersInfo()
	{
		if ((int)$this->order_id < 1)
			return false;

		$query_limit = 0;
		$query_offset = 0;
		$order_products = array();

		if ($this->page !== null && !empty($this->page) && $this->show !== null && !empty($this->show))
		{
			$query_limit = ((int)$this->page - 1) * (int)$this->show;
			$query_offset = (int)$this->show;
		}

		// Get order object with information
		$order_obj = new Order((int)$this->order_id);

		// Get order information
		$order_info_obj = new DbQuery();
		$order_info_obj->select("
			o.id_order,
			o.date_add,
			o.id_customer,
			o.id_currency,
			o.total_paid,
			o.total_paid_real,
			o.total_discounts,
			o.total_products,
			o.total_products_wt,
			o.total_shipping,
			o.total_wrapping,
			o.current_state as status_code,
			c.iso_code,
			c.sign,
			c.format,
			CONCAT(cus.firstname, ' ', cus.lastname) AS customer,
			cus.email,
			CONCAT(ad.firstname, ' ', ad.lastname) AS d_name,
			ad.company AS d_company,
			ad.address1 AS d_address1,
			ad.address2 AS d_address2,
			ad.city AS d_city,
			sd.name AS d_state,
			ad.postcode AS d_postcode,
			cld.name AS d_country,
			ad.other AS d_other,
			ad.phone AS d_phone,
			ad.phone_mobile AS d_phone_mobile,
			CONCAT(ai.firstname, ' ', ai.lastname) AS i_name,
			ai.company AS i_company,
			ai.address1 AS i_address1,
			ai.address2 AS i_address2,
			ai.city AS i_city,
			si.name AS i_state,
			ai.postcode AS i_postcode,
			cli.name AS i_country,
			ai.other AS i_other,
			ai.phone AS i_phone,
			ai.phone_mobile AS i_phone_mobile,
			osl.name AS 'status',
			s.name AS shop_name,
			o.id_shop
		");
		$order_info_obj->from('orders', 'o');
		$order_info_obj->leftJoin('currency', 'c', 'o.id_currency = c.id_currency');
		$order_info_obj->leftJoin('customer', 'cus', 'o.id_customer = cus.id_customer');
		$order_info_obj->leftJoin('address', 'ad', 'o.id_address_delivery = ad.id_address');
		$order_info_obj->leftJoin('address', 'ai', 'o.id_address_invoice = ai.id_address');
		$order_info_obj->leftJoin('state', 'sd', 'ad.id_state = sd.id_state');
		$order_info_obj->leftJoin('state', 'si', 'ai.id_state = si.id_state');
		$order_info_obj->leftJoin('country_lang', 'cld', 'ad.id_country = cld.id_country AND cld.id_lang = '.(int)$this->def_lang);
		$order_info_obj->leftJoin('country_lang', 'cli', 'ad.id_country = cli.id_country AND cli.id_lang = '.(int)$this->def_lang);
		$order_info_obj->leftJoin('order_state_lang', 'osl', 'o.current_state = osl.id_order_state AND osl.id_lang = '.(int)$this->def_lang);
		$order_info_obj->leftJoin('shop', 's', 's.id_shop = o.id_shop');
		$order_info_obj->where('o.id_order = '.(int)$this->order_id);
		$order_info_sql = $order_info_obj->build();
		$order_info = Db::getInstance()->executeS($order_info_sql);

		$order_info = array_shift($order_info);
		$elements = array('total_paid', 'total_products', 'total_products_wt', 'total_discounts', 'total_shipping', 'total_wrapping', 'total_paid_real');

		// Convert and format price data
		foreach ($elements as $element)
		{
			if ($this->currency_code != $order_info['id_currency'])
				$order_info[$element] = $this->convertPrice($order_info[$element], $order_obj->id_currency);

			$order_info[$element] = $this->displayPrice($order_info[$element], $order_info['id_currency']);
		}

		// Get order products
		$order_products_obj = new DbQuery();
		$order_products_obj->select('
			od.id_order,
			od.product_id,
			od.product_name,
			od.product_reference AS sku,
			od.total_price_tax_excl AS product_price,
			od.product_quantity,
			ps.wholesale_price,
			pl.link_rewrite,
			o.id_currency
		');
		$order_products_obj->from('order_detail', 'od');
		$order_products_obj->leftJoin('orders', 'o', 'o.id_order = od.id_order');
		$order_products_obj->leftJoin('product_shop', 'ps', 'ps.id_product = od.product_id AND ps.id_shop = od.id_shop');
		$order_products_obj->leftJoin('product_lang', 'pl', 'ps.id_product = pl.id_product AND pl.id_lang = '.(int)$this->def_lang
			.' AND pl.id_shop = o.id_shop');
		$order_products_obj->where('od.id_order = '.(int)$this->order_id);
		$order_products_obj->limit($query_offset, $query_limit);
		$order_products_sql = $order_products_obj->build();
		$order_products_res = Db::getInstance()->executeS($order_products_sql);

		// Convert and form price data
		foreach ($order_products_res as $product)
		{
			if ($this->currency_code != $product['id_currency'])
				$product['product_price'] = $this->convertPrice($product['product_price'], $order_obj->id_currency);

			if ($this->currency_code != $this->def_currency)
				$product['wholesale_price'] = $this->convertPrice($product['wholesale_price'], $this->def_currency);

			$product['product_price'] = $this->displayPrice($product['product_price'], $product['id_currency']);
			$product['wholesale_price'] = $this->displayPrice($product['wholesale_price'], $product['id_currency']);

			// Get url of product image
			$image_url = $this->getProductImageUrl($product['product_id'], $product['link_rewrite']);
			if ($image_url)
				$product['product_image'] = $image_url;

			$order_products[] = $product;
		}

		// Get count products in order
		$order_products_count_obj = new DbQuery();
		$order_products_count_obj->select('COUNT(od.product_id) AS count_prods');
		$order_products_count_obj->from('order_detail', 'od');
		$order_products_count_obj->where('od.id_order = '.$this->order_id);
		$order_products_count_sql = $order_products_count_obj->build();
		$order_products_count = Db::getInstance()->executeS($order_products_count_sql);

		// Get order carrier
		$order_carrier_obj = new DbQuery();
		$order_carrier_obj->select('
			oc.date_add,
			c.name AS carrier_name,
			oc.weight,
			oc.shipping_cost_tax_excl AS shipping_cost,
			oc.tracking_number,
			o.id_currency
		');
		$order_carrier_obj->from('order_carrier', 'oc');
		$order_carrier_obj->leftJoin('carrier', 'c', 'c.id_carrier = oc.id_carrier');
		$order_carrier_obj->leftJoin('orders', 'o', 'o.id_order = oc.id_order');
		$order_carrier_obj->where('oc.id_order = '.(int)$this->order_id);
		$order_carrier_count_sql = $order_carrier_obj->build();
		$order_carrier = Db::getInstance()->executeS($order_carrier_count_sql);

		if (!empty($order_carrier))
		{
			// Form weight value
			$order_carrier[0]['weight'] = number_format($order_carrier[0]['weight'], 3).' '.$this->weight_unit;

			// Form and convert price data
			if ($this->currency_code != $order_carrier[0]['id_currency'])
				$order_carrier[0]['shipping_cost'] = $this->convertPrice($order_carrier[0]['shipping_cost'], $order_obj->id_currency);
			$order_carrier[0]['shipping_cost'] = $this->displayPrice($order_carrier[0]['shipping_cost'], $order_carrier[0]['id_currency']);
		}

		$order_full_info = array(
			'order_info' => $order_info,
			'order_products' => $order_products,
			'o_products_count' => $order_products_count[0]['count_prods'],
			'order_tracking' => $order_carrier
		);
		return $order_full_info;
	}

	private function setOrderAction()
	{
	$result = array('success' => false);

		if (isset($this->order_id) && (int)$this->order_id > 0)
		{
			if (isset($this->action) && Tools::strlen($this->action) > 0)
			{
				$order = new Order((int)$this->order_id);

				if ($order->id !== null)
				{
					switch ($this->action)
					{
						case 'change_status':
							if (isset($this->new_status) && (int)$this->new_status > 0)
								$result = $this->changeStatusOrder();
							else
								$result = array('error' => 'New order status is not set!');

							break;
						case 'update_track_number':
							if (isset($this->tracking_number))
								$result = $this->updateTrackNumber();
							else
								$result = array('error' => 'New order tracking number is not set!');

							break;
					}
				}
				else
					$result = array('error' => 'No order was found!');
			}
			else
				$result = array('error' => 'Action is not set!');
		}
		else
			$result = array('error' => 'Order id cannot be empty!');

		return $result;
	}

	private function updateTrackNumber()
	{
		$result = array();
		$order = new Order((int)$this->order_id);
		$lang_id = $order->id_lang;
		$lang_id_all = Configuration::get('MOBASSISTANTCONNECTOR_TN_LNG');

		if (method_exists('Order', 'setWsShippingNumber'))
			$is_updated = $order->setWsShippingNumber($this->tracking_number);
		else
			$is_updated = $this->setWsShippingNumberOwn($this->tracking_number);

		$result['success'] = ($is_updated === true) ? 'true' : 'false';

		if ($is_updated === true && $this->is_mail == 1)
		{
			$customer = new Customer($order->id_customer);

			if (Configuration::get('PS_LOGO_MAIL') !== false && file_exists(_PS_IMG_DIR_.Configuration::get('PS_LOGO_MAIL', null, null, $order->id_shop)))
				$logo = _PS_BASE_URL_._PS_IMG_.Configuration::get('PS_LOGO_MAIL', null, null, $order->id_shop);
			else
			{
				if (file_exists(_PS_IMG_DIR_.Configuration::get('PS_LOGO', null, null, $order->id_shop)))
					$logo = _PS_BASE_URL_._PS_IMG_.Configuration::get('PS_LOGO', null, null, $order->id_shop);
				else
					$logo = '';
			}

			$data = array(
				'{order_name}' => $order->reference,
				'{firstname}' => $customer->firstname,
				'{lastname}' => $customer->lastname,
				'{tracking_number}' => $this->tracking_number,
				'{shop_name}' => Tools::safeOutput(Configuration::get('PS_SHOP_NAME', null, null, $order->id_shop)),
				'{shop_url}' => Context::getContext()->link->getPageLink('index', true, Context::getContext()->language->id, null, false, $order->id_shop),
				'{shop_logo}' => $logo,
			);

			$headers = 'From: '.Configuration::get('PS_SHOP_EMAIL')."\r\n".
//				'Reply-To: '.Configuration::get('PS_SHOP_EMAIL')."\r\n".
				'Content-type: text/html; charset=utf-8: '."\r\n".
				'X-Mailer: PHP/'.phpversion();

			if ($lang_id_all != 0)
				$lang_id = $lang_id_all;

			$mail_body = Tools::file_get_contents(_PS_MODULE_DIR_.'mobassistantconnector/mails/common/tracking_number_header.txt');
			$mail_body .= str_replace("\r\n", '<br>', Configuration::get('MOBASSISTANTCONNECTOR_TN_TEXT', (int)$lang_id));
			$mail_body .= Tools::file_get_contents(_PS_MODULE_DIR_.'mobassistantconnector/mails/common/tracking_number_footer.txt');

			foreach ($data as $key => $value)
				$mail_body = str_replace($key, $value, $mail_body);

			if (function_exists('mail'))
				if (call_user_func('mail', $customer->email, 'Order Tracking Number', $mail_body, $headers))
					$mail_sent_error = false;
				else
					$mail_sent_error = 203;
			else
				$mail_sent_error = 202;

			if ($mail_sent_error !== false)
				$result['mail_sent_error'] = $mail_sent_error;
		}

		return $result;
	}

	private function changeStatusOrder()
	{
		try {
			$order = new Order((int)$this->order_id);
			$order->setCurrentState((int)$this->new_status);
		} catch (Exception $e) {
			return array('error' => 'An error occurred!');
//			return $e->getMessage();
		}

		return array('success' => 'true');
	}

	private function getCarriers()
	{
		$carriers_ret = array();
		$carries = Carrier::getCarriers($this->def_lang);

		foreach ($carries as $key => $carrier)
		{
			$carriers_ret[$key]['id_carrier'] = $carrier['id_carrier'];
			$carriers_ret[$key]['name'] = $carrier['name'];
		}

		return $carriers_ret;
	}

	private function getAbandonedCarts()
	{
		$query_where_parts = array('o.id_order IS NULL');
		$query_limit       = 0;
		$query_offset      = 0;
		$carts             = array();
		$carts_date        = array();
		$offset            = $this->getTimezoneOffset();

		if ($this->shop_id !== null && !empty($this->shop_id) && (int)$this->shop_id != -1)
			$query_where_parts[] = 'c.id_shop = '.(int)$this->shop_id;

		if (!empty($this->search_carts) && preg_match('/^\d+(?:,\d+)*$/', $this->search_carts))
			$query_where_parts[] = 'c.id_cart IN ('.pSQL($this->search_carts).')';
		elseif (!empty($this->search_carts))
			$query_where_parts[] = "( COALESCE(CONCAT(cus.firstname, ' ', cus.lastname), 'Guest not registered') LIKE '%".pSQL($this->search_carts)."%')";

		if ($this->carts_from !== null && !empty($this->carts_from))
			$query_where_parts[] = "CONVERT_TZ(c.date_add, '+00:00',  '".$offset."') >= '"
				.(date('Y-m-d H:i:s', (strtotime($this->carts_from.' 00:00:00')))."'");

		if ($this->carts_to !== null && !empty($this->carts_to))
			$query_where_parts[] = "CONVERT_TZ(c.date_add, '+00:00',  '".$offset."') <= '"
				.(date('Y-m-d H:i:s', (strtotime($this->carts_to.' 23:59:59')))."'");

		if ($this->page !== null && !empty($this->page) && $this->show !== null && !empty($this->show))
		{
			$query_limit = ((int)$this->page - 1) * (int)$this->show;
			$query_offset = (int)$this->show;
		}

		if (empty($this->sort_by))
			$this->sort_by = 'id';

		switch ($this->sort_by)
		{
			case 'id':
				$order_by = 'c.id_cart DESC';
				break;
			case 'date':
				$order_by = 'c.date_add DESC';
				break;
			case 'name':
				$order_by = 'customer ASC';
				break;
			default:
				$order_by = '';
				break;
		}

		// Get abandoned carts
		$carts_obj = new DbQuery();
		$carts_obj->select("
			c.id_cart,
			c.date_add,
			c.id_shop,
			c.id_currency,
			c.id_customer,
			cus.email,
			COALESCE(CONCAT(cus.firstname, ' ', cus.lastname), 'Guest not registered') AS customer,
			s.name AS shop_name,
			car.name AS carrier_name,
			SUM((ps.price + pas.price) * cp.quantity) AS cart_total,
			COUNT(cp.id_cart) AS cart_count_products
		");
		$carts_obj->from('cart', 'c');
		$carts_obj->innerJoin('cart_product', 'cp', 'cp.id_cart = c.id_cart');
		$carts_obj->leftJoin('product_shop', 'ps', 'ps.id_product = cp.id_product AND ps.id_shop = cp.id_shop');
		$carts_obj->leftJoin('product_attribute_shop', 'pas', 'pas.id_product_attribute = cp.id_product_attribute AND pas.id_shop = cp.id_shop');
		$carts_obj->leftJoin('customer', 'cus', 'c.id_customer = cus.id_customer');
		$carts_obj->leftJoin('orders', 'o', 'o.id_cart = c.id_cart');
		$carts_obj->leftJoin('shop', 's', 's.id_shop = c.id_shop');
		$carts_obj->leftJoin('carrier', 'car', 'car.id_carrier = c.id_carrier');
		$carts_obj->where(implode(' AND ', $query_where_parts));
		$carts_obj->groupBy('c.id_cart');
		$carts_obj->orderBy($order_by);
		$carts_obj->limit($query_offset, $query_limit);
		$carts_sql = $carts_obj->build();
		$carts_res = Db::getInstance()->executeS($carts_sql);

		// Convert price data
		foreach ($carts_res as $cart)
		{
			if ($this->currency_code != $cart['id_currency'])
				$cart['cart_total'] = $this->convertPrice($cart['cart_total'], $this->def_currency, $cart['id_currency']);

			$carts_date[] = strtotime($cart['date_add']);
			$cart['cart_total'] = $this->displayPrice($cart['cart_total'], $cart['id_currency']);
			$carts[] = $cart;
		}

		// Get abandoned carts total
		$cart_total_obj = new DbQuery();
		$cart_total_obj->select('
			SUM((ps.price + pas.price) * cp.quantity) AS total_sum,
			COUNT(DISTINCT cp.id_cart) AS total_count
		');
		$cart_total_obj->from('cart', 'c');
		$cart_total_obj->innerJoin('cart_product', 'cp', 'cp.id_cart = c.id_cart');
		$cart_total_obj->leftJoin('orders', 'o', 'o.id_cart = c.id_cart');
		$cart_total_obj->leftJoin('product_shop', 'ps', 'ps.id_product = cp.id_product AND ps.id_shop = cp.id_shop');
		$cart_total_obj->leftJoin('product_attribute_shop', 'pas', 'pas.id_product_attribute = cp.id_product_attribute AND pas.id_shop = cp.id_shop');
		$cart_total_obj->leftJoin('customer', 'cus', 'c.id_customer = cus.id_customer');
		$cart_total_obj->where(implode(' AND ', $query_where_parts));
		$cart_total_sql = $cart_total_obj->build();
		$cart_total_res = Db::getInstance()->executeS($cart_total_sql);
		$cart_total_res = array_shift($cart_total_res);

		// Convert price data
		if ($this->currency_code != $this->def_currency)
			$cart_total_res['total_sum'] = $this->convertPrice($cart_total_res['total_sum'], $this->def_currency, $this->currency_code);
		$cart_total_res['total_sum'] = $this->displayPrice($cart_total_res['total_sum'], $this->currency_code, true);

		return array('abandoned_carts' => $carts,
			'abandoned_carts_count' => $cart_total_res['total_count'],
			'abandoned_carts_total' => $cart_total_res['total_sum'],
		);
	}

	private function getAbandonedCartInfo()
	{
		if ((int)$this->cart_id < 1)
			return false;

		$query_limit   = 0;
		$query_offset  = 0;
		$cart_products = array();

		if ($this->page !== null && !empty($this->page) && $this->show !== null && !empty($this->show))
		{
			$query_limit = ((int)$this->page - 1) * (int)$this->show;
			$query_offset = (int)$this->show;
		}

		// Get cart information
		$cart_info_obj = new DbQuery();
		$cart_info_obj->select("
			c.id_cart,
			c.date_add,
			c.id_currency,
			c.id_customer,
			cus.date_add AS account_registered,
			cus.email,
			a.phone,
			CONCAT(cus.firstname, ' ', cus.lastname) AS customer,
			s.name AS shop_name,
			car.name AS carrier_name,
			SUM((ps.price + pas.price) * cp.quantity) AS cart_total
		");
		$cart_info_obj->from('cart', 'c');
		$cart_info_obj->innerJoin('cart_product', 'cp', 'cp.id_cart = c.id_cart');
		$cart_info_obj->leftJoin('product_shop', 'ps', 'ps.id_product = cp.id_product AND ps.id_shop = cp.id_shop');
		$cart_info_obj->leftJoin('product_attribute_shop', 'pas', 'pas.id_product_attribute = cp.id_product_attribute AND pas.id_shop = cp.id_shop');
		$cart_info_obj->leftJoin('customer', 'cus', 'c.id_customer = cus.id_customer');
		$cart_info_obj->leftJoin('address', 'a', 'a.id_customer = cus.id_customer');
		$cart_info_obj->leftJoin('shop', 's', 's.id_shop = c.id_shop');
		$cart_info_obj->leftJoin('carrier', 'car', 'car.id_carrier = c.id_carrier');
		$cart_info_obj->where('c.id_cart = '.(int)$this->cart_id);
		$cart_info_obj->groupBy('c.id_cart');
		$cart_info_sql = $cart_info_obj->build();
		$cart_info = Db::getInstance()->executeS($cart_info_sql);
		$cart_info = array_shift($cart_info);

		if (trim($cart_info['customer']) == '')
			$cart_info['customer'] = self::GUEST;

		// Convert and format price data
		if ($this->currency_code != $cart_info['id_currency'])
			$cart_info['cart_total'] = $this->convertPrice($cart_info['cart_total'], $this->def_currency, $cart_info['id_currency']);
		$cart_info['cart_total'] = $this->displayPrice($cart_info['cart_total'], $cart_info['id_currency']);

		// Get cart products
		$cart_products_obj = new DbQuery();
		$cart_products_obj->select('
			cp.id_product,
			cp.id_product_attribute,
			cp.quantity AS product_quantity,
			p.reference AS sku,
			(ps.price + pas.price) AS product_price,
			(ps.wholesale_price + pas.wholesale_price) AS wholesale_price,
			c.id_currency,
			pl.name AS product_name,
			pl.link_rewrite
		');
		$cart_products_obj->from('cart_product', 'cp');
		$cart_products_obj->leftJoin('product_shop', 'ps', 'ps.id_product = cp.id_product AND ps.id_shop = cp.id_shop');
		$cart_products_obj->leftJoin('product_attribute_shop', 'pas', 'pas.id_product_attribute = cp.id_product_attribute AND pas.id_shop = cp.id_shop');
		$cart_products_obj->leftJoin('product', 'p', 'p.id_product = cp.id_product');
		$cart_products_obj->leftJoin('cart', 'c', 'c.id_cart = cp.id_cart');
		$cart_products_obj->leftJoin('product_lang', 'pl', 'pl.id_product = cp.id_product AND pl.id_shop = cp.id_shop AND pl.id_lang = '
			.(int)$this->def_lang);
		$cart_products_obj->where('cp.id_cart = '.(int)$this->cart_id);
		$cart_products_obj->limit($query_offset, $query_limit);
		$cart_products_sql = $cart_products_obj->build();
		$cart_products_res = Db::getInstance()->executeS($cart_products_sql);

		// Get attribute values
		foreach ($cart_products_res as $product)
		{
			$product_attributes_obj = new DbQuery();
			$product_attributes_obj->select('
				al.name AS attribute_value,
				agl.public_name AS attribute_name
			');
			$product_attributes_obj->from('product_attribute_combination', 'pac');
			$product_attributes_obj->leftJoin('attribute_lang', 'al', 'al.id_attribute = pac.id_attribute AND al.id_lang = '.(int)$this->def_lang);
			$product_attributes_obj->leftJoin('attribute', 'a', 'a.id_attribute = pac.id_attribute');
			$product_attributes_obj->leftJoin(
				'attribute_group_lang',
				'agl',
				'agl.id_attribute_group = a.id_attribute_group AND agl.id_lang = '.(int)$this->def_lang
			);
			$product_attributes_obj->where('pac.id_product_attribute = '.(int)$product['id_product_attribute']);
			$product_attributes_obj->orderBy('attribute_name');
			$product_attributes_sql = $product_attributes_obj->build();
			$product_attributes = Db::getInstance()->executeS($product_attributes_sql);

			$product_attr = array();
			foreach ($product_attributes as $product_attribute)
				$product_attr[] = $product_attribute['attribute_name'].' : '.$product_attribute['attribute_value'];

			$product['combination'] = !empty($product_attr) ? implode(', ', $product_attr) : '';

			// Convert and form price data
			if ($this->currency_code != $this->def_currency)
			{
				$product['product_price'] = $this->convertPrice($product['product_price'], $this->def_currency, $product['id_currency']);
				$product['wholesale_price'] = $this->convertPrice($product['wholesale_price'], $this->def_currency, $product['id_currency']);
			}
			$product['product_price'] = $this->displayPrice($product['product_price'], $product['id_currency']);
			$product['wholesale_price'] = $this->displayPrice($product['wholesale_price'], $product['id_currency']);

			// Get url of product image
			$image_url = $this->getProductImageUrl($product['id_product'], $product['link_rewrite']);
			if ($image_url)
				$product['product_image'] = $image_url;

			$cart_products[] = $product;
		}

		// Get cart product count
		$cart_product_count_obj = new DbQuery();
		$cart_product_count_obj->select('
			COUNT(cp.id_product) AS product_count
		');
		$cart_product_count_obj->from('cart_product', 'cp');
		$cart_product_count_obj->where('cp.id_cart = '.(int)$this->cart_id);
		$cart_product_count_sql = $cart_product_count_obj->build();
		$cart_product_count_res = Db::getInstance()->executeS($cart_product_count_sql);
		$cart_product_count_res = array_shift($cart_product_count_res);

		return array(
			'cart_info' => $cart_info,
			'cart_products' => $cart_products,
			'cart_products_count' => $cart_product_count_res['product_count'],
		);
	}

	private function getMethodResult($call_function)
	{
		$result = false;

		switch ($call_function)
		{
			case 'run_self_test':
				$this->runSelfTest();
				break;
			case 'get_stores':
				$result = $this->getStores();
				break;
			case 'get_currencies':
				$result = $this->getCurrencies();
				break;
			case 'get_store_title':
				$result = $this->getStoreTitle();
				break;
			case 'push_notification_settings':
				$result = $this->pushNotificationSettings();
				break;
			case 'get_orders_statuses':
				$result = $this->getOrdersStatuses();
				break;
			case 'get_store_stats':
				$result = $this->getStoreStats();
				break;
			case 'get_data_graphs':
				$result = $this->getDataGraphs();
				break;
			case 'get_status_stats':
				$result = $this->getStatusStats();
				break;
			case 'search_products':
				$result = $this->searchProducts();
				break;
			case 'search_products_ordered':
				$result = $this->searchProductsOrdered();
				break;
			case 'get_products_info':
				$result = $this->getProductsInfo();
				break;
			case 'get_products_descr':
				$result = $this->getProductsDescr();
				break;
			case 'get_customers':
				$result = $this->getCustomers();
				break;
			case 'get_customers_info':
				$result = $this->getCustomersInfo();
				break;
			case 'get_orders':
				$result = $this->getOrders();
				break;
			case 'get_orders_info':
				$result = $this->getOrdersInfo();
				break;
			case 'set_order_action':
				$result = $this->setOrderAction();
				break;
			case 'get_carriers':
				$result = $this->getCarriers();
				break;
			case 'get_abandoned_carts_list':
				$result = $this->getAbandonedCarts();
				break;
			case 'get_abandoned_cart_details':
				$result = $this->getAbandonedCartInfo();
				break;
			default:
				$this->file_logger->logMessageCall("Unknown method call ({$this->call_function})", $this->file_logger->level);
				$this->generateOutput('old_bridge');
				break;
		}

		return $result;
	}

	private function statusProcess($status)
	{
		return array(
			'st_id' => $status['id_order_state'],
			'st_name' => $status['name']
		);
	}

	private function generateOutput($data)
	{
		$add_bridge_version = false;

		if (in_array($this->call_function, array('test_config', 'getStoreTitle', 'getStoreStats', 'getDataGraphs')))
			if (is_array($data) && $data != 'auth_error' && $data != 'connection_error' && $data != 'old_bridge') $add_bridge_version = true;

		if (!is_array($data)) $data = array($data);

		if (is_array($data)) array_walk_recursive($data, array($this, 'resetNull'));

		if ($add_bridge_version) $data['module_version'] = self::MODULE_VERSION;

		$data = Tools::jsonEncode($data);

		header('Content-Type: text/javascript;charset=utf-8');
		die($data);
	}

	private function resetNull(&$item)
	{
		if (empty($item) && $item != 0) $item = '';
		$item = trim($item);
	}

	/** For address only */
	private function splitValues($arr, $keys, $sign = ', ')
	{
		$new_arr = array();
		foreach ($keys as $key)
		{
			if (isset($arr[$key]))
				if (!is_null($arr[$key]) && $arr[$key] != '') $new_arr[] = $arr[$key];
		}
		return implode($sign, $new_arr);
	}

	private function convertPrice($data, $id_currency, $to_id_currency = false)
	{
		if ($this->currency_code == self::CURRENCY_NOT_SET && !$to_id_currency)
			return $data;
		elseif ($this->currency_code == self::CURRENCY_NOT_SET)
			$currency_to = Currency::getCurrencyInstance($to_id_currency);
		else
			$currency_to = Currency::getCurrencyInstance($this->currency_code);

		$currency_from = Currency::getCurrencyInstance($id_currency);

		return Tools::convertPriceFull($data, $currency_from, $currency_to);
	}

	private function displayPrice($data, $id_currency, $resume = false)
	{
		$currency = $id_currency;

		if ($resume !== false)
		{
			if ($id_currency == self::CURRENCY_NOT_SET)
				$currency = $this->def_currency;
		}
		elseif ($this->currency_code != self::CURRENCY_NOT_SET)
			$currency = $this->currency_code;

		return Tools::displayPrice($data, Currency::getCurrencyInstance($currency));
	}

	private function getTimezoneOffset()
	{
		$timezone = Configuration::get('PS_TIMEZONE');
		$origin_dtz = new DateTimeZone('UTC');
		$remote_dtz = new DateTimeZone($timezone);
		$origin_dt = new DateTime('now', $origin_dtz);
		$remote_dt = new DateTime('now', $remote_dtz);
		$offset = $remote_dtz->getOffset($remote_dt) - $origin_dtz->getOffset($origin_dt);

		$hours = (int)$offset / 60 / 60;
		$mins = $offset / 60 % 60;
		$offset = (($hours >= 0) ? '+'.$hours : $hours).':'.$mins;

		return $offset;
	}

	private function getCustomPeriod($period = 0)
	{
		$custom_period = array('start_date' => '', 'end_date' => '');
		$format = 'm/d/Y';

		switch ($period)
		{
			case 0: //3 days
				$custom_period['start_date'] = date($format, mktime(0, 0, 0, date('m'), date('d') - 2, date('Y')));
				$custom_period['end_date'] = date($format, mktime(23, 59, 59, date('m'), date('d'), date('Y')));
				break;

			case 1: //7 days
				$custom_period['start_date'] = date($format, mktime(0, 0, 0, date('m'), date('d') - 6, date('Y')));
				$custom_period['end_date'] = date($format, mktime(23, 59, 59, date('m'), date('d'), date('Y')));
				break;

			case 2: //Prev week
				$custom_period['start_date'] = date($format, mktime(0, 0, 0, date('N'), date('j') - 6, date('Y')) - ((date('N')) * 3600 * 24));
				$custom_period['end_date'] = date($format, mktime(23, 59, 59, date('N'), date('j'), date('Y')) - ((date('N')) * 3600 * 24));
				break;

			case 3: //Prev month
				$custom_period['start_date'] = date($format, mktime(0, 0, 0, date('m') - 1, 1, date('Y')));
				$custom_period['end_date'] = date($format, mktime(23, 59, 59, date('m'), date('d') - date('j'), date('Y')));
				break;

			case 4: //This quarter
				$m = date('N');
				$start_m = 1;
				$end_m = 3;

				if ($m <= 3)
				{
					$start_m = 1;
					$end_m = 3;
				}
				else if ($m >= 4 && $m <= 6)
				{
					$start_m = 4;
					$end_m = 6;
				}
				else if ($m >= 7 && $m <= 9)
				{
					$start_m = 7;
					$end_m = 9;
				}
				else if ($m >= 10)
				{
					$start_m = 10;
					$end_m = 12;
				}

				$custom_period['start_date'] = date($format, mktime(0, 0, 0, $start_m, 1, date('Y')));
				$custom_period['end_date'] = date($format, mktime(23, 59, 59, $end_m + 1, date(1) - 1, date('Y')));
				break;

			case 5: //This year
				$custom_period['start_date'] = date($format, mktime(0, 0, 0, date(1), date(1), date('Y')));
				$custom_period['end_date'] = date($format, mktime(23, 59, 59, date(1), date(1) - 1, date('Y') + 1));
				break;

			case 6: //Last year
				$custom_period['start_date'] = date($format, mktime(0, 0, 0, date(1), date(1), date('Y') - 1 ));
				$custom_period['end_date'] = date($format, mktime(23, 59, 59, date(1), date(1) - 1, date('Y')));
				break;
		}

		return $custom_period;
	}

	private function setWsShippingNumberOwn($shipping_number)
	{
		$id_order_carrier = Db::getInstance()->getValue('
			SELECT `id_order_carrier`
			FROM `'._DB_PREFIX_.'order_carrier`
			WHERE `id_order` = '.(int)$this->order_id);
		if ($id_order_carrier)
		{
			$order_carrier = new OrderCarrier($id_order_carrier);
			$order_carrier->tracking_number = $shipping_number;
			$order_carrier->update();
		}
		else
			$this->shipping_number = $shipping_number;

		return true;
	}

	private function getProductImageUrl($product_id, $link_rewrite, $image_name = 'medium')
	{
		$image_type = ImageType::getFormatedName($image_name);
		$image_url = false;
		$link_rewrite = (string)$link_rewrite;
		$image = Product::getCover($product_id);
		$id_image = (int)$image['id_image'];

		if (isset($link_rewrite[0]) && $id_image > 0)
			$image_url = Context::getContext()->link->getImageLink($link_rewrite, $id_image, $image_type);

		return $image_url;
	}

}