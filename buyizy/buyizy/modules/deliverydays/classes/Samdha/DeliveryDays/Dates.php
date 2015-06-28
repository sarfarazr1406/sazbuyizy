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

class Samdha_DeliveryDays_Dates
{
	private $module;

	public function __construct($module)
	{
		$this->module = $module;
	}

	/**
	 * find possible delivery days for current group
	 *
	 * @return array possible delivery days (Y-m-d)
	 */
	public function getPossibleDates()
	{
		static $delivery_days = null;
		if (is_null($delivery_days))
		{
			$delivery_days = array();

			if ($this->module->config->use_group)
			{
				$group = $this->module->tools->getCurrentGroup();
				$id_group = $group->id;
			}
			else
				$id_group = 0;

			if ($this->module->config->{'enabled'.$id_group})
			{
				$i = (int)$this->module->config->{'offset'.$id_group};
				$count_delivery_days = 0;
				$max_delivery_days = (int)$this->module->config->{'duration'.$id_group};
				$possible_delivery_days = $this->module->config->{'days'.$id_group};
				$exceptions = $this->module->config->{'exception'.$id_group};
				// 2011-09-30 by Georges Cubas sometime \r are added at the end of dates
				array_walk($exceptions, create_function('&$val', '$val = trim($val);'));
				$offsets = $this->module->config->{'offsets'.$id_group};
				$hours = $this->module->config->{'hours'.$id_group};
				$minutes = $this->module->config->{'minutes'.$id_group};
				$current_time = time();

				while (($count_delivery_days < $max_delivery_days) && $i < 200)
				{
					$day = mktime(0, 0, 0, date('n'), date('j') + $i);
					$day_index = (int)date('w', $day);

					if ($possible_delivery_days[$day_index]
						&& !in_array(date('Y-m-d', $day), $exceptions))
					{
						// get deadline for this day
						$dead_line = mktime($hours[$day_index], $minutes[$day_index], 0, date('n'), date('j') + $i - $offsets[$day_index]);
						if ($dead_line > $current_time)
						{
							$delivery_days[] = date('Y-m-d', $day);
							$count_delivery_days = count($delivery_days);
						}
					}
					$i++;
				}
			}
		}
		return $delivery_days;
	}


	/**
	 * get a delivery date for a cart
	 *
	 * @param  integer  $id_cart
	 * @param  boolean $check   if true check if the date is valid
	 * @return boolean/array           array('date', 'timeframe')
	 */
	public function getDate($id_cart, $check = true)
	{
		$result = false;
		if (is_object($id_cart))
			$id_cart = $id_cart->id;
		$sql = 'SELECT `date_delivery`, `timeframe` FROM `'._DB_PREFIX_.'deliverydays_cart` WHERE id_cart = '.(int)$id_cart;
		$date = Db::getInstance()->getRow($sql);
		if ($date)
		{
			if ($check)
			{
				$dates = $this->getPossibleDates();
				if (in_array($date['date_delivery'], $dates))
					$result = array('date' => $date['date_delivery'], 'timeframe' => $date['timeframe']);
			}
			else
				$result = array('date' => $date['date_delivery'], 'timeframe' => $date['timeframe']);
		}
		return $result;
	}

	/**
	 * Get formated delivery day for a cart
	 *
	 * @param integer $id_cart Cart ID
	 * @param integer $id_lang Language ID unused for Prestashop 1.5+
	 * @return string formated delivery day
	 */
	public function getFormatedDate($id_cart, $id_lang = null)
	{
		$result = '';
		$delivery_day = $this->getDate($id_cart, false);
		if ($delivery_day)
		{
			$date = Tools::displayDate($delivery_day['date'], version_compare(_PS_VERSION_, '1.5.0.0', '<')?$id_lang:null);
			$result = trim($date.' '.$delivery_day['timeframe']);
		}
		return $result;
	}

	/**
	 * save a delivery day for a cart
	 *
	 * @param integer/object $id_cart Cart ID or Cart object
	 * @param string $date
	 * @param string $timeframe
	 * @return boolean
	 */
	public function setDate($id_cart, $date, $timeframe)
	{
		if (is_object($id_cart))
			$id_cart = $id_cart->id;
		$sql = '
			INSERT INTO `'._DB_PREFIX_.'deliverydays_cart`
			SET `date_delivery` = \''.pSQL($date).'\',
				`timeframe` = \''.pSQL($timeframe, true).'\',
				`id_cart` = '.(int)$id_cart.'
			ON DUPLICATE KEY UPDATE
				`date_delivery` = \''.pSQL($date).'\',
				`timeframe` = \''.pSQL($timeframe, true).'\'';
		return Db::getInstance()->execute($sql);
	}
}
