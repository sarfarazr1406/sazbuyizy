<?php /* Smarty version Smarty-3.1.19, created on 2015-06-15 00:20:44
         compiled from "success.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1798431874557dcd048425d1-29347076%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6132e71881359c0cc34f1d060a55fc41931686fe' => 
    array (
      0 => 'success.tpl',
      1 => 1434307663,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1798431874557dcd048425d1-29347076',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'link' => 0,
    'baseUrl' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_557dcd049002e1_61219358',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_557dcd049002e1_61219358')) {function content_557dcd049002e1_61219358($_smarty_tpl) {?><head>    	<!-- Facebook Conversion Code for Checkout- Sarfaraz -->    <script>(function() {        var _fbq = window._fbq || (window._fbq = []);        if (!_fbq.loaded) {            var fbds = document.createElement('script');            fbds.async = true;            fbds.src = '//connect.facebook.net/en_US/fbds.js';            var s = document.getElementsByTagName('script')[0];            s.parentNode.insertBefore(fbds, s);            _fbq.loaded = true;        }    })();    window._fbq = window._fbq || [];    window._fbq.push(['track', '6027337779003', {'value':'0.00','currency':'INR'}]);    </script>    <noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?ev=6027337779003&amp;cd[value]=0.00&amp;cd[currency]=INR&amp;noscript=1" /></noscript>	</head><br /><p><?php echo smartyTranslate(array('s'=>'Congratulations! You have successfully placed your order on Buyizy.com.','mod'=>'payu'),$_smarty_tpl);?>
        <br />        <?php echo smartyTranslate(array('s'=>'Payment Method - PayUMoney Checkout ','mod'=>'payu'),$_smarty_tpl);?>
        <br /><span class="bold"><?php echo smartyTranslate(array('s'=>'Your order will be delivered soon.','mod'=>'payu'),$_smarty_tpl);?>
</span>        <br /><?php echo smartyTranslate(array('s'=>'For any questions or for further information, please contact our','mod'=>'payu'),$_smarty_tpl);?>
 <span><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('contact-form',true), ENT_QUOTES, 'UTF-8', true);?>
"><font color="green"><u><b><?php echo smartyTranslate(array('s'=>'customer support','mod'=>'payu'),$_smarty_tpl);?>
</b></u></font></a>.</span></p>
<p >
	<a href="<?php echo $_smarty_tpl->tpl_vars['baseUrl']->value;?>
" title="Continue Shopping">
			Continue Shopping
	<link href="<?php echo $_smarty_tpl->tpl_vars['baseUrl']->value;?>
themes/default/css/product_list.css" rel="stylesheet" type="text/css" media="all" />
	<link href="<?php echo $_smarty_tpl->tpl_vars['baseUrl']->value;?>
themes/default/css/grid_prestashop.css" rel="stylesheet" type="text/css" media="all" />
	<link href="<?php echo $_smarty_tpl->tpl_vars['baseUrl']->value;?>
themes/default/css/global.css" rel="stylesheet" type="text/css" media="all" />
	</a>
</p><?php }} ?>
