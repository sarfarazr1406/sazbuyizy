<?php 
 
include(dirname(__FILE__).'/../../config/config.inc.php');
include(dirname(__FILE__).'/../../init.php');
include(dirname(__FILE__).'/payu.php');
include(dirname(__FILE__).'/../../header.php');

$payu = new payu();
$response=$_REQUEST;
$id_order=$response['txnid']-354572829452247; 



$baseUrl=Tools::getShopDomain(true, true).__PS_BASE_URI__;	
$smarty->assign('baseUrl',$baseUrl);
$smarty->assign('orderId',$id_order);
$amount        = $response['amount'];

global $cart,$cookie;

$total = $amount;
$currency = new Currency(Tools::getValue('currency_payement', false) ? Tools::getValue('currency_payement') : $cookie->id_currency);
$customer = new Customer((int)$cart->id_customer);
$payu->validateOrder((int)$cart->id, _PS_OS_CANCELED_, $total, $payu->displayName, NULL, NULL, (int)$currency->id, false, $customer->secure_key);

$smarty->display('cancel.tpl');

$result = Db::getInstance()->getRow('SELECT * FROM ' . _DB_PREFIX_ . 'orders WHERE id_cart = ' . (int)$cart->id);

Tools::redirectLink(__PS_BASE_URI__ . 'order-detail.php?id_order=' . $result['id_order']);

include(dirname(__FILE__).'/../../footer.php');
?>