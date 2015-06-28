<?php /* Smarty version Smarty-3.1.19, created on 2015-06-08 19:08:44
         compiled from "/home/buyizy/public_html/admin3039/themes/default/template/controllers/logs/employee_field.tpl" */ ?>
<?php /*%%SmartyHeaderCode:191736896755759ae4bc6e05-32060203%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c2834751d425d0c11d81de648337ff7205d2d078' => 
    array (
      0 => '/home/buyizy/public_html/admin3039/themes/default/template/controllers/logs/employee_field.tpl',
      1 => 1416031498,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '191736896755759ae4bc6e05-32060203',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'employee_image' => 0,
    'employee_name' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_55759ae4bde717_72083465',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55759ae4bde717_72083465')) {function content_55759ae4bde717_72083465($_smarty_tpl) {?>
<span class="employee_avatar_small">
	<img class="imgm img-thumbnail" alt="" src="<?php echo $_smarty_tpl->tpl_vars['employee_image']->value;?>
" width="32" height="32" />
</span>
<?php echo $_smarty_tpl->tpl_vars['employee_name']->value;?>
<?php }} ?>
