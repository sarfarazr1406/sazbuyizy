<?php /* Smarty version Smarty-3.1.19, created on 2015-06-07 11:34:35
         compiled from "/home/buyizy/public_html/themes/default-bootstrap/modules/blockcontact/nav.tpl" */ ?>
<?php /*%%SmartyHeaderCode:988125435573def3aceb63-83512730%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '78a464946819e0adf7343ad527a0b2369708c1d8' => 
    array (
      0 => '/home/buyizy/public_html/themes/default-bootstrap/modules/blockcontact/nav.tpl',
      1 => 1431172499,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '988125435573def3aceb63-83512730',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'link' => 0,
    'telnumber' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5573def3af5ed2_33750920',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5573def3af5ed2_33750920')) {function content_5573def3af5ed2_33750920($_smarty_tpl) {?>
<div id="contact-link">
	<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('contact',true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Contact Us','mod'=>'blockcontact'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'Contact us','mod'=>'blockcontact'),$_smarty_tpl);?>
</a>
</div>
<?php if ($_smarty_tpl->tpl_vars['telnumber']->value) {?>
	<span class="shop-phone">
		<span style='margin-right:8px'>Pune |</span><i class="icon-phone"></i><?php echo smartyTranslate(array('s'=>'Call now to order: ','mod'=>'blockcontact'),$_smarty_tpl);?>
 <strong><?php echo $_smarty_tpl->tpl_vars['telnumber']->value;?>
</strong>&nbsp;&nbsp;&nbspIzyOrder : Go to order history in your account and reorder any previous order. Quick & Simple!!! 
	</span>
<?php }?>
<?php }} ?>
