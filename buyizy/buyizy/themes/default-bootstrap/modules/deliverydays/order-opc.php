<?php
/**
 * Delivery days module
 *
 * @category  Prestashop
 * @category  Module
 * @author    Samdha <contact@samdha.net>
 * @copyright Samdha
 * @license   commercial license see license.txt
 * @version   2.0.0.0
 *
 * @link   logo http://www.gnu.org/copyleft/gpl.html logo license
 * @link    logo http://code.google.com/u/newmooon/ logo author
 */

require(dirname(__FILE__).'/../../config/config.inc.php');
include_once(_PS_ROOT_DIR_.'/init.php');

if (($module = Module::getInstanceByName('deliverydays'))
	&& $module->active)
	echo $module->order_opc();

die();