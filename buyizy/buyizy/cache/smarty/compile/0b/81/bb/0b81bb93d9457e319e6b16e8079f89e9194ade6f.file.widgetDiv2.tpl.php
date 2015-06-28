<?php /* Smarty version Smarty-3.1.19, created on 2015-06-07 11:35:30
         compiled from "/home/buyizy/public_html/modules/yotpo/views/templates/front/widgetDiv2.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6198961205573df2aec8571-83847715%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0b81bb93d9457e319e6b16e8079f89e9194ade6f' => 
    array (
      0 => '/home/buyizy/public_html/modules/yotpo/views/templates/front/widgetDiv2.tpl',
      1 => 1416031500,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6198961205573df2aec8571-83847715',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'yotpoProductId' => 0,
    'yotpoProductName' => 0,
    'yotpoProductLink' => 0,
    'yotpoProductImageUrl' => 0,
    'yotpoProductDescription' => 0,
    'yotpoLanguage' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5573df2af13700_45153019',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5573df2af13700_45153019')) {function content_5573df2af13700_45153019($_smarty_tpl) {?><div class="yotpo yotpo-main-widget"
   data-product-id="<?php echo intval($_smarty_tpl->tpl_vars['yotpoProductId']->value);?>
"
   data-name="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['yotpoProductName']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" 
   data-url="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['yotpoProductLink']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" 
   data-image-url="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['yotpoProductImageUrl']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" 
   data-description="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['yotpoProductDescription']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" 
   data-lang="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['yotpoLanguage']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
">
</div>


 <?php }} ?>
