<?php /* Smarty version Smarty-3.1.19, created on 2015-06-21 14:42:47
         compiled from "/home/buyizy/public_html/modules/blocknewsletter/views/templates/admin/list_action_viewcustomer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7603639465586800f60b568-31591905%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'abe8f150169375f0f08d0e1d1494c4c36ffe9089' => 
    array (
      0 => '/home/buyizy/public_html/modules/blocknewsletter/views/templates/admin/list_action_viewcustomer.tpl',
      1 => 1427104197,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7603639465586800f60b568-31591905',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'href' => 0,
    'disable' => 0,
    'action' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5586800f68a141_82504992',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5586800f68a141_82504992')) {function content_5586800f68a141_82504992($_smarty_tpl) {?>
<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['href']->value, ENT_QUOTES, 'UTF-8', true);?>
" class="edit btn btn-default <?php if ($_smarty_tpl->tpl_vars['disable']->value) {?>disabled<?php }?>" title="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" >
	<i class="icon-search-plus"></i> <?php echo $_smarty_tpl->tpl_vars['action']->value;?>

</a><?php }} ?>
