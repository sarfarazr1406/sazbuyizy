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

class AdminOrdersController extends AdminOrdersControllerCore
{

	public function __construct()
	{
		parent::__construct();

		/**
		 * Used by the module deliverydays
		 * Add delivery dates in order list
		 */
		$module_name = 'deliverydays';
		$module = Module::getInstanceByName($module_name);
		if ($module && $module->active && $module->config->add_column)
		{
			$this->_select .= ', dd.date_delivery as date_delivery';
			$this->_join .= '
				LEFT JOIN `'._DB_PREFIX_.'deliverydays_cart` dd ON (dd.`id_cart` = a.`id_cart`)';

			$insert = array(
				'date_delivery' => array(
					'title' => Translate::getModuleTranslation($module, 'Delivery day', $module_name),
					'width' => 130,
					'align' => 'right',
					'type' => 'date',
					'filter_key' => 'dd!date_delivery'
			));
			$end = array_splice($this->fields_list, array_search("date_add",array_keys($this->fields_list)));
			$this->fields_list = array_merge($this->fields_list, $insert, $end);
		}
	}
}

