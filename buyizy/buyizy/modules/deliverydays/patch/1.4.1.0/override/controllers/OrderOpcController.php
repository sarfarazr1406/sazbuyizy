<?php

class OrderOpcController extends OrderOpcControllerCore
{
	protected function _getPaymentMethods()
	{
		if (!isset($shipping_date) &&
			($module = Module::getInstanceByName('deliverydays')) &&
			($module->active)) {
			$return = $module->_getPaymentMethods(self::$cart);
			if ($return !== true)
				return '<p class="warning">'.$return.'</p>';
		}
		return parent::_getPaymentMethods();
	}
}

