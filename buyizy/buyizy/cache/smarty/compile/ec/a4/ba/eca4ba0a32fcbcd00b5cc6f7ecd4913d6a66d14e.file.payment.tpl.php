<?php /* Smarty version Smarty-3.1.19, created on 2015-06-07 13:56:01
         compiled from "/home/buyizy/public_html/modules/payu/payment.tpl" */ ?>
<?php /*%%SmartyHeaderCode:56901528155740019da7893-48697722%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'eca4ba0a32fcbcd00b5cc6f7ecd4913d6a66d14e' => 
    array (
      0 => '/home/buyizy/public_html/modules/payu/payment.tpl',
      1 => 1428398961,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '56901528155740019da7893-48697722',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'base_dir_ssl' => 0,
    'buttonText' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_55740019df3e80_83473689',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55740019df3e80_83473689')) {function content_55740019df3e80_83473689($_smarty_tpl) {?><p class="payment_module">
	<a href="<?php echo $_smarty_tpl->tpl_vars['base_dir_ssl']->value;?>
modules/payu/payment.php" title="<?php echo $_smarty_tpl->tpl_vars['buttonText']->value;?>
">
		<img src="<?php echo $_smarty_tpl->tpl_vars['base_dir_ssl']->value;?>
modules/payu/payu-logo.gif" alt="<?php echo $_smarty_tpl->tpl_vars['buttonText']->value;?>
" />
		<link href="<?php echo $_smarty_tpl->tpl_vars['base_dir_ssl']->value;?>
themes/default/css/grid_prestashop.css" rel="stylesheet" type="text/css" media="all" />
		<link href="<?php echo $_smarty_tpl->tpl_vars['base_dir_ssl']->value;?>
themes/default/css/global.css" rel="stylesheet" type="text/css" media="all" />
		
		<?php echo $_smarty_tpl->tpl_vars['buttonText']->value;?>

	</a>
</p><?php }} ?>
