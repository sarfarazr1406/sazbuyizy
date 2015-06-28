<?php
/**
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

class Samdha_DeliveryDays_Export
{
	const CSV_SEPARATOR = ',';
	private $module;

	public function __construct($module)
	{
		$this->module = $module;
	}

	public function getFuturDeliveryDates()
	{
		$sql = '
			SELECT ddc.date_delivery, count(ddc.id_cart) as nb_cart
			FROM `'._DB_PREFIX_.'deliverydays_cart` ddc
			LEFT JOIN `'._DB_PREFIX_.'orders` o ON ddc.id_cart = o.id_cart
			WHERE ddc.date_delivery >= CURDATE() AND o.id_cart IS NOT NULL
			GROUP BY ddc.date_delivery
			ORDER BY ddc.date_delivery';
		return Db::getInstance()->executeS($sql);
	}

	public function exportProducts($date)
	{
		$valid_orders = $this->getValidOrders($date);
		$valid_orders[] = 0;
		$sql = '
			SELECT od.product_id, od.product_attribute_id, od.product_name, SUM(product_quantity) as quantity
			FROM `'._DB_PREFIX_.'deliverydays_cart` ddc
			LEFT JOIN `'._DB_PREFIX_.'orders` o ON ddc.id_cart = o.id_cart
			LEFT JOIN `'._DB_PREFIX_.'order_detail` od ON o.id_order = od.id_order
			WHERE ddc.date_delivery = \''.pSQL($date).'\' AND o.id_order IN ('.implode(',', $valid_orders).')
			GROUP BY od.product_name
			ORDER BY SUM(product_quantity) DESC';
		ob_end_clean();
		header('Content-Type: application/csv-tab-delimited-table');
		header('Content-disposition: filename=products_'.$date.'.csv');
		$result = Db::getInstance()->executeS($sql);

		$out = fopen('php://output', 'w');
		$line = array(
			$this->module->l('Product ID'),
			$this->module->l('Name'),
			$this->module->l('Quantity')
		);
		fputcsv($out, array_map('utf8_decode', $line), self::CSV_SEPARATOR);
		foreach ($result as $row)
		{
			$line = array(
				$row['product_id'].'-'.$row['product_attribute_id'],
				$row['product_name'],
				$row['quantity']
			);
			fputcsv($out, array_map('utf8_decode', $line), self::CSV_SEPARATOR);
		}
		fclose($out);
		die();
	}

	public function exportOrders($date)
	{
		$cookie = $this->context->cookie;

		$valid_orders = $this->getValidOrders($date);
		$valid_orders[] = 0;
		$sql = '
			SELECT a.*, o.*
			FROM `'._DB_PREFIX_.'deliverydays_cart` ddc
			LEFT JOIN `'._DB_PREFIX_.'orders` o ON ddc.id_cart = o.id_cart
			LEFT JOIN `'._DB_PREFIX_.'address` a ON a.id_address = o.id_address_delivery
			WHERE ddc.date_delivery = \''.pSQL($date).'\' AND o.id_order IN ('.implode(',', $valid_orders).')
			GROUP BY o.id_order
			ORDER BY a.id_address ASC';
		ob_end_clean();
		header('Content-Type: application/csv-tab-delimited-table');
		header('Content-disposition: filename=orders_'.$date.'.csv');
		$result = Db::getInstance()->executeS($sql);

		$out = fopen('php://output', 'w');
		$line = array(
			$this->module->l('Order ID'),
			$this->module->l('Delivery number'),
			$this->module->l('Invoice number'),
			$this->module->l('Amount'),
			$this->module->l('First name'),
			$this->module->l('Last name'),
			$this->module->l('Address'),
			$this->module->l('Address (2)'),
			$this->module->l('Postal code / Zip code'),
			$this->module->l('City')
		);
		fputcsv($out, array_map('utf8_decode', $line), self::CSV_SEPARATOR);
		foreach ($result as $row)
		{
			$line = array(
				$row['id_order'],
				$row['delivery_number']?Configuration::get('PS_DELIVERY_PREFIX', (int)$cookie->id_lang).sprintf('%06d', $row['delivery_number']):'',
				$row['invoice_number']?Configuration::get('PS_INVOICE_PREFIX', (int)$cookie->id_lang).sprintf('%06d', $row['invoice_number']):'',
				$row['total_paid'],
				$row['firstname'],
				$row['lastname'],
				$row['address1'],
				$row['address2'],
				$row['postcode'],
				$row['city']
			);
			fputcsv($out, array_map('utf8_decode', $line), self::CSV_SEPARATOR);
		}
		fclose($out);
		die();
	}

	public function getValidOrders($date)
	{
		$sql = '
			SELECT o.id_order
			FROM `'._DB_PREFIX_.'deliverydays_cart` ddc
			LEFT JOIN `'._DB_PREFIX_.'orders` o ON ddc.id_cart = o.id_cart
			WHERE ddc.date_delivery = \''.pSQL($date).'\' AND o.id_order IS NOT NULL
			ORDER BY o.id_order';
		$orders = Db::getInstance()->executeS($sql);
		$result = array();
		foreach ($orders as $order)
			if ($this->getOrderState($order['id_order']) != _PS_OS_CANCELED_)
				$result[] = (int)$order['id_order'];
		return $result;
	}

	/**
	 * return order current state ID
	 *
	 * @param integer $id_order Order ID
	 * @return integer Order current state ID
	 */
	public function getOrderState($id_order)
	{
		$result = false;
		if (version_compare(_PS_VERSION_, '1.5.0.0', '<'))
		{
			$order_history = OrderHistory::getLastOrderState($id_order);
			if (isset($order_history) && $order_history)
				$result = $order_history->id;
		}
		else
		{
			$order = new Order($id_order);
			$result = $order->getCurrentState();
		}
		return $result;
	}

	public function getMessages($id_product, $id_product_attribute, $date)
	{
		$sql = '
			SELECT o.id_order
			FROM `'._DB_PREFIX_.'deliverydays_cart` ddc
			LEFT JOIN `'._DB_PREFIX_.'orders` o ON ddc.id_cart = o.id_cart
			LEFT JOIN `'._DB_PREFIX_.'order_detail` od ON o.id_order = od.id_order
			WHERE ddc.date_delivery = \''.pSQL($date).'\'
				AND od.product_id = '.(int)$id_product.'
				AND od.product_attribute_id = '.(int)$id_product_attribute.'
			ORDER BY o.id_order';
		$orders = Db::getInstance()->executeS($sql);
		$result = array();
		foreach ($orders as $order)
			if ($this->getOrderState($order['id_order']) != _PS_OS_CANCELED_)
				if ($message = $this->getFirstMessage($order['id_order']))
					$result[] = html_entity_decode($message);
		return $result;

	}

	public function getFirstMessage($id_order)
	{
		$sql = 'SELECT `message` FROM `'._DB_PREFIX_.'message` WHERE `id_order` = '.(int)$id_order.' ORDER BY `id_message` asc';
		$result = Db::getInstance()->getRow($sql);
		return $result['message'];
	}

}
