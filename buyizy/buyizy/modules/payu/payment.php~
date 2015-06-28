<?php
 
include(dirname(__FILE__).'/../../config/config.inc.php');
include(dirname(__FILE__).'/../../init.php');
include(dirname(__FILE__).'/payu.php');


include(dirname(__FILE__).'/../../header.php');


$payu = new payu();
if (!$cookie->isLogged(true))
	Tools::redirect('authentication.php?back=order.php');
elseif (!$cart->getOrderTotal(true, Cart::BOTH))
	Tools::displayError('Error: Empty cart');

if ($cart->id_customer == 0 OR $cart->id_address_delivery == 0 OR $cart->id_address_invoice == 0 OR !$payu->active)
	Tools::redirectLink(__PS_BASE_URI__.'order.php?step=1');



// Prepare payment

$customer = new Customer((int)$cart->id_customer);

if (!Validate::isLoadedObject($customer))
	Tools::redirectLink(__PS_BASE_URI__.'order.php?step=1');

$currency = new Currency(Tools::getValue('currency_payement', false) ? Tools::getValue('currency_payement') : $cookie->id_currency);
$total = (float)($cart->getOrderTotal(true, Cart::BOTH));

 global $smarty,$cart,$cookie;
	   
	    $key=Configuration::get('PAYU_MERCHANT_ID');
	  	$salt=Configuration::get('PAYU_SALT');
		$mode=Configuration::get('PAYU_MODE');
		$log=Configuration::get('PAYU_LOGS');
		
		
	  	$customer = new Customer((int)($cart->id_customer));
	  
		 $action='https://test.payu.in/_payment.php';

		 //$cart = new Cart((int)($cookie->id_cart));;
		 $orderId = (int)($cookie->id_cart);
		 
		 //echo "<br/>id_order:" . $id_order;
		 
		 $txnid= $orderId+232585630456;
		 $amount=$total;
		 $productInfo='PayUMoney product information';
		 $firstname=$customer->firstname;
		 $Lastname= $customer->lastname;
		 $deloveryAddress = new Address((int)($cart->id_address_delivery));
		 $service_provider='payu_paisa';
		 
		
		
		 $Zipcode      =  $deloveryAddress->postcode;
		 $email=$customer->email;
		 $phone=$deloveryAddress->phone_mobile;
		 
		if($mode=='real')
		{
		  $action='https://secure.payu.in/_payment.php';
		}
	
	      $request=$key.'|'.$txnid.'|'.$amount.'|'.$productInfo.'|'.$firstname.'|'.$email.'|||||||||||'.$salt;
		//echo $request;
		//die();
		  $Hash=hash('sha512', $key.'|'.$txnid.'|'.$amount.'|'.$productInfo.'|'.$firstname.'|'.$email.'|||||||||||'.$salt); 
		  
		  
		  $baseUrl=Tools::getShopDomain(true, true).__PS_BASE_URI__;
                 
		  
		  
		  if($log==1)
		  {
		     $query="insert into ps_payu_order(id_order,payment_request) values($orderId,'$request')";
		     Db::getInstance()->Execute($query);
		  }
		  
		  $surl=$baseUrl.'modules/'.'payu'.'/success.php'; 
		  $curl=$baseUrl.'modules/'.'payu'.'/cancel.php?id='.base64_encode($orderId);	
		  $furl=$baseUrl.'modules/'.'payu'.'/failure.php';	
		  $Pg='CC';
		 
		 $payuInfo=array( 'action' => $action,
			'key' => $key,
			'txnid' => $txnid,
			'amount' => $amount,
			'productinfo' => $productInfo,
			'firstname' => $firstname,
			'Lastname' => $Lastname,
			'Zipcode' => $Zipcode,
			'email' => $email,
			'phone' => $phone,
			'surl' => $surl,
			'furl' => $furl,
			'curl' => $curl,
			'Hash' => $Hash,
			'Pg' => $Pg            
            //'service_provider' => $service_provider      
			
		);
		
		
		$smarty->assign('Message','Please wait, you will be redirected to PayU Checkout');
		$smarty->assign($payuInfo);	
		$smarty->display('payment.tpl');
		
	  
        //$payu->display(__FILE__, 'payu.tpl');
		echo '<br/><br/>Please wait. We are processing your request<form action="'.$action.'" method="post" id="payu_form" name="payu_form" >
			<input type="hidden" name="key" value="'.$key.'" />
			<input type="hidden" name="txnid" value="'.$txnid.'" />
			<input type="hidden" name="amount" value="'.$amount.'" />
			<input type="hidden" name="productinfo" value="PayUMoney product information" />
			<input type="hidden" name="firstname" value="'.$firstname.'" />
			<input type="hidden" name="Lastname" value="'.$Lastname.'" />
			<input type="hidden" name="Zipcode" value="'.$Zipcode.'" />
			<input type="hidden" name="email" value="'.$email.'" />
			<input type="hidden" name="phone" value="'.$phone.'" />
			<input type="hidden" name="surl" value="'.$surl.'" />
			<input type="hidden" name="furl" value="'.$furl.'" />
			<input type="hidden" name="curl" value="'.$curl.'" />
			<input type="hidden" name="Hash" value="'.$Hash.'" />
			<input type="hidden" name="Pg" value="'.$Pg.'" />
            <input type="hidden" name="service_provider" value="'.$service_provider.'" />            
                        
		</form>	
		
		<script type="text/javascript">
		
		setTimeout(document.payu_form.submit(),5000)
		
		</script>';
//$payu->validateOrder((int)$cart->id, Configuration::get('PS_OS_PREPARATION'), $total, $payu->displayName, NULL, NULL, (int)$currency->id, false, $customer->secure_key);

//$order = new Order($payu->currentOrder);
//echo $payu->currentOrder;
//Tools::redirectLink(__PS_BASE_URI__.'order-confirmation.php?id_cart='.(int)$cart->id.'&id_module='.$payu->id.'&id_order='.$payu->currentOrder.'&key='.$customer->secure_key);



