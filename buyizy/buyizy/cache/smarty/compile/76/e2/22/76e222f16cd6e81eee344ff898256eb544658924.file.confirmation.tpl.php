<?php /* Smarty version Smarty-3.1.19, created on 2015-06-14 12:50:10
         compiled from "/home/buyizy/public_html/themes/default-bootstrap/modules/cashondelivery/views/templates/hook/confirmation.tpl" */ ?>
<?php /*%%SmartyHeaderCode:46862735955746da73f1e37-13116818%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '76e222f16cd6e81eee344ff898256eb544658924' => 
    array (
      0 => '/home/buyizy/public_html/themes/default-bootstrap/modules/cashondelivery/views/templates/hook/confirmation.tpl',
      1 => 1434266347,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '46862735955746da73f1e37-13116818',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_55746da743bab5_74187160',
  'variables' => 
  array (
    'link' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55746da743bab5_74187160')) {function content_55746da743bab5_74187160($_smarty_tpl) {?>
<head>
    
	<!-- Facebook Conversion Code for Checkout- Sarfaraz -->
    <script>(function() {
        var _fbq = window._fbq || (window._fbq = []);
        if (!_fbq.loaded) {
            var fbds = document.createElement('script');
            fbds.async = true;
            fbds.src = '//connect.facebook.net/en_US/fbds.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(fbds, s);
            _fbq.loaded = true;
        }
    })();
    window._fbq = window._fbq || [];
    window._fbq.push(['track', '6027337779003', {'value':'0.00','currency':'INR'}]);
    </script>
    <noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?ev=6027337779003&amp;cd[value]=0.00&amp;cd[currency]=INR&amp;noscript=1" /></noscript>
	
</head>
<div class="box">
    <p><?php echo smartyTranslate(array('s'=>'Congratulations! You have successfully placed your order on Buyizy.com.','mod'=>'cashondelivery'),$_smarty_tpl);?>

        <br />
        <?php echo smartyTranslate(array('s'=>'Payment Method - Cash on Delivery ','mod'=>'cashondelivery'),$_smarty_tpl);?>

        <br /><span class="bold"><?php echo smartyTranslate(array('s'=>'Your order will be delivered soon.','mod'=>'cashondelivery'),$_smarty_tpl);?>
</span>
        <br /><?php echo smartyTranslate(array('s'=>'For any questions or for further information, please contact our','mod'=>'cashondelivery'),$_smarty_tpl);?>
 <span><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('contact-form',true), ENT_QUOTES, 'UTF-8', true);?>
"><font color="green"><u><b><?php echo smartyTranslate(array('s'=>'customer support','mod'=>'cashondelivery'),$_smarty_tpl);?>
</b></u></font></a>.</span>
    </p>
</div><?php }} ?>
