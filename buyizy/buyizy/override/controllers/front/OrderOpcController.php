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

class OrderOpcController extends OrderOpcControllerCore
{
	protected function _getPaymentMethods()
	{
		$module = Module::getInstanceByName('deliverydays');
		if ($module && $module->active)
		{
			$return = $module->_getPaymentMethods(self::$cart);
			if ($return !== true)
				return '<p class="warning">'.$return.'</p>';
		}
		return parent::_getPaymentMethods();
	}
}
