<?php /* Smarty version Smarty-3.1.19, created on 2015-06-07 21:52:41
         compiled from "/home/buyizy/public_html/admin3039/themes/default/template/helpers/tree/tree_header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:40459983055746fd13d9691-68715308%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '11d0eb437ceb7a31559f94c57c60c772770a5ac1' => 
    array (
      0 => '/home/buyizy/public_html/admin3039/themes/default/template/helpers/tree/tree_header.tpl',
      1 => 1416031498,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '40459983055746fd13d9691-68715308',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
    'toolbar' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_55746fd13e9767_39552637',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55746fd13e9767_39552637')) {function content_55746fd13e9767_39552637($_smarty_tpl) {?>
<div class="tree-panel-heading-controls clearfix">
	<?php if (isset($_smarty_tpl->tpl_vars['title']->value)) {?><i class="icon-tag"></i>&nbsp;<?php echo smartyTranslate(array('s'=>$_smarty_tpl->tpl_vars['title']->value),$_smarty_tpl);?>
<?php }?>
	<?php if (isset($_smarty_tpl->tpl_vars['toolbar']->value)) {?><?php echo $_smarty_tpl->tpl_vars['toolbar']->value;?>
<?php }?>
</div><?php }} ?>
