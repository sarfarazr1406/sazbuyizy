<?php /* Smarty version Smarty-3.1.19, created on 2015-06-07 12:15:48
         compiled from "/home/buyizy/public_html/admin3039/themes/default/template/helpers/list/list_action_default.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2909681875573e89c350524-75046366%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2679054c61fbe16853a8cd42d2d50a087dbbd608' => 
    array (
      0 => '/home/buyizy/public_html/admin3039/themes/default/template/helpers/list/list_action_default.tpl',
      1 => 1416031498,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2909681875573e89c350524-75046366',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'href' => 0,
    'action' => 0,
    'name' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5573e89c363403_58997947',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5573e89c363403_58997947')) {function content_5573e89c363403_58997947($_smarty_tpl) {?>
<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['href']->value, ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
"<?php if (isset($_smarty_tpl->tpl_vars['name']->value)) {?> name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8', true);?>
"<?php }?> class="default">
	<i class="icon-asterisk"></i> <?php echo $_smarty_tpl->tpl_vars['action']->value;?>

</a><?php }} ?>
