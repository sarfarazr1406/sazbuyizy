<?php /* Smarty version Smarty-3.1.19, created on 2015-06-07 11:35:31
         compiled from "/home/buyizy/public_html/modules/yotpo/views/templates/front/bottomLineDiv.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19727009455573df2b06f504-34024832%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e223cba68c127dc24294cb3dd9281b8f9b5c80bd' => 
    array (
      0 => '/home/buyizy/public_html/modules/yotpo/views/templates/front/bottomLineDiv.tpl',
      1 => 1416031500,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19727009455573df2b06f504-34024832',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'yotpoAppkey' => 0,
    'yotpoDomain' => 0,
    'yotpoProductId' => 0,
    'yotpoProductModel' => 0,
    'yotpoProductName' => 0,
    'yotpoProductLink' => 0,
    'yotpoProductImageUrl' => 0,
    'yotpoProductDescription' => 0,
    'yotpoProductBreadCrumbs' => 0,
    'yotpoLanguage' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5573df2b0edd02_90534421',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5573df2b0edd02_90534421')) {function content_5573df2b0edd02_90534421($_smarty_tpl) {?><div class="yotpo bottomLine"
	data-appkey="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['yotpoAppkey']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"
	data-domain="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['yotpoDomain']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"
	data-product-id="<?php echo intval($_smarty_tpl->tpl_vars['yotpoProductId']->value);?>
"
	data-product-models="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['yotpoProductModel']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"
	data-name="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['yotpoProductName']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"
	data-url="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['yotpoProductLink']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"
	data-image-url="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['yotpoProductImageUrl']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"
	data-description="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['yotpoProductDescription']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"
	data-bread-crumbs="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['yotpoProductBreadCrumbs']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"
	data-lang="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['yotpoLanguage']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"></div><?php }} ?>
