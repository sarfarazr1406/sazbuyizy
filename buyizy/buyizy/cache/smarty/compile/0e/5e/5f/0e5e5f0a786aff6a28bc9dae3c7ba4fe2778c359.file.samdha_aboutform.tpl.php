<?php /* Smarty version Smarty-3.1.19, created on 2015-06-12 11:50:58
         compiled from "/home/buyizy/public_html/themes/default-bootstrap/modules/deliverydays/views/templates/hook/samdha_aboutform.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1105438065557a7a4ade29d3-76691550%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0e5e5f0a786aff6a28bc9dae3c7ba4fe2778c359' => 
    array (
      0 => '/home/buyizy/public_html/themes/default-bootstrap/modules/deliverydays/views/templates/hook/samdha_aboutform.tpl',
      1 => 1429475429,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1105438065557a7a4ade29d3-76691550',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'bootstrap' => 0,
    'big' => 0,
    'space' => 0,
    'module_path' => 0,
    'module_display_name' => 0,
    'description_big' => 0,
    'description' => 0,
    'home_url' => 0,
    'module_version' => 0,
    'contact_url' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_557a7a4b03da55_46481587',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_557a7a4b03da55_46481587')) {function content_557a7a4b03da55_46481587($_smarty_tpl) {?>
<fieldset class="<?php if (!$_smarty_tpl->tpl_vars['bootstrap']->value) {?>ui-widget ui-widget-content ui-corner-all<?php }?><?php if ($_smarty_tpl->tpl_vars['big']->value) {?> width3<?php } else { ?><?php if ($_smarty_tpl->tpl_vars['space']->value) {?> space<?php }?>"<?php }?> id="samdha_aboutform">
	<legend class="<?php if (!$_smarty_tpl->tpl_vars['bootstrap']->value) {?>ui-widget-header ui-corner-all<?php }?>"><?php echo smartyTranslate(array('s'=>'About','mod'=>'samdha'),$_smarty_tpl);?>
</legend>
	<p style="font-size: 1.5em; font-weight: bold; padding-bottom: 0"><img src="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['module_path']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
logo.png" alt="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['module_display_name']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" style="float: left; padding-right: 1em"/><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['module_display_name']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</p>
	<p style="clear: left;"><?php echo smartyTranslate(array('s'=>'Thanks for installing this module on your website.','mod'=>'samdha'),$_smarty_tpl);?>
</p>
	<?php if ($_smarty_tpl->tpl_vars['description_big']->value) {?><?php echo htmlspecialchars_decode(htmlspecialchars($_smarty_tpl->tpl_vars['description_big']->value, ENT_QUOTES, 'UTF-8', true), ENT_QUOTES);?>
<?php } else { ?><p><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['description']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</p><?php }?>
	<p>
		<?php echo smartyTranslate(array('s'=>'Made with ❤ by','mod'=>'samdha'),$_smarty_tpl);?>
 <a style="color: #7ba45b; text-decoration: underline;" href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['home_url']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
">Samdha</a><?php echo smartyTranslate(array('s'=>', which helps you develop your e-commerce site.','mod'=>'samdha'),$_smarty_tpl);?>

	</p>
	<p>
		<span style="float: right; opacity: .2; font-size: 9px; padding-top: 5px;"><abbr title="<?php echo smartyTranslate(array('s'=>'version','mod'=>'samdha'),$_smarty_tpl);?>
">v</abbr><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['module_version']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</span>
		<a href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['contact_url']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" id="samdha_contact"><?php echo smartyTranslate(array('s'=>'Contact','mod'=>'samdha'),$_smarty_tpl);?>
</a>
	</p>
</fieldset>
<?php }} ?>
