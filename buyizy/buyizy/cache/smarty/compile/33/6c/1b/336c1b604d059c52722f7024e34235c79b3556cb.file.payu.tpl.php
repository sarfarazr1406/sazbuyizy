<?php /* Smarty version Smarty-3.1.19, created on 2015-06-07 13:56:01
         compiled from "/home/buyizy/public_html/modules/payu/payu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:179866317855740019cb67c1-17998147%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '336c1b604d059c52722f7024e34235c79b3556cb' => 
    array (
      0 => '/home/buyizy/public_html/modules/payu/payu.tpl',
      1 => 1428398961,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '179866317855740019cb67c1-17998147',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'Message' => 0,
    'action' => 0,
    'key' => 0,
    'txnid' => 0,
    'amount' => 0,
    'productinfo' => 0,
    'firstname' => 0,
    'Lastname' => 0,
    'Zipcode' => 0,
    'email' => 0,
    'phone' => 0,
    'surl' => 0,
    'furl' => 0,
    'curl' => 0,
    'Hash' => 0,
    'Pg' => 0,
    'service_provider' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_55740019d4bd17_41648658',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55740019d4bd17_41648658')) {function content_55740019d4bd17_41648658($_smarty_tpl) {?>     <?php echo $_smarty_tpl->tpl_vars['Message']->value;?>

	<br />
	<form action="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" method="post" id="payu_form" name="payu_form" >
			<input type="hidden" name="key" value="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" />
			<input type="hidden" name="txnid" value="<?php echo $_smarty_tpl->tpl_vars['txnid']->value;?>
" />
			<input type="hidden" name="amount" value="<?php echo $_smarty_tpl->tpl_vars['amount']->value;?>
" />
			<input type="hidden" name="productinfo" value="<?php echo $_smarty_tpl->tpl_vars['productinfo']->value;?>
" />
			<input type="hidden" name="firstname" value="<?php echo $_smarty_tpl->tpl_vars['firstname']->value;?>
" />
			<input type="hidden" name="Lastname" value="<?php echo $_smarty_tpl->tpl_vars['Lastname']->value;?>
" />
			<input type="hidden" name="Zipcode" value="<?php echo $_smarty_tpl->tpl_vars['Zipcode']->value;?>
" />
			<input type="hidden" name="email" value="<?php echo $_smarty_tpl->tpl_vars['email']->value;?>
" />
			<input type="hidden" name="phone" value="<?php echo $_smarty_tpl->tpl_vars['phone']->value;?>
" />
			<input type="hidden" name="surl" value="<?php echo $_smarty_tpl->tpl_vars['surl']->value;?>
" />
			<input type="hidden" name="furl" value="<?php echo $_smarty_tpl->tpl_vars['furl']->value;?>
" />
			<input type="hidden" name="curl" value="<?php echo $_smarty_tpl->tpl_vars['curl']->value;?>
" />
			<input type="hidden" name="Hash" value="<?php echo $_smarty_tpl->tpl_vars['Hash']->value;?>
" />
			<input type="hidden" name="Pg" value="<?php echo $_smarty_tpl->tpl_vars['Pg']->value;?>
" />
			<input type="hidden" name="service_provider" value="<?php echo $_smarty_tpl->tpl_vars['service_provider']->value;?>
" />
                       
		</form>	
		
		<script type="text/javascript">
		
		document.payu_form.submit();
		
		</script><?php }} ?>
