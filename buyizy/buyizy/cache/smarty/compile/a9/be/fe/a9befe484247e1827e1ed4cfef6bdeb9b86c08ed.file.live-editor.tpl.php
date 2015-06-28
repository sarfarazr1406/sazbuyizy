<?php /* Smarty version Smarty-3.1.19, created on 2015-06-19 12:39:49
         compiled from "/home/buyizy/public_html/modules/affinityitems//views/templates/admin/live-editor.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6757340495583c03d42a1c0-25011420%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a9befe484247e1827e1ed4cfef6bdeb9b86c08ed' => 
    array (
      0 => '/home/buyizy/public_html/modules/affinityitems//views/templates/admin/live-editor.tpl',
      1 => 1417109329,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6757340495583c03d42a1c0-25011420',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'version' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5583c03d466d20_27557902',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5583c03d466d20_27557902')) {function content_5583c03d466d20_27557902($_smarty_tpl) {?>

$('input[name="backgroundColor"]').on("change", function() {
var div = '.'+$('input[name="backgroundProductsBlockClass"').val();
$(div.replace(/ /g, '.')).css('background-color',$('input[name="backgroundColor"]').val());
});
$('input[name="backgroundColorTransparent"]').on("change", function() {
	var div = '.'+$('input[name="backgroundProductsBlockClass"').val();
	if($(this).is(':checked')) {
		$(div.replace(/ /g, '.')).css('background-color','transparent');
	} else {
		$(div.replace(/ /g, '.')).css('background-color',$('input[name="backgroundColor"]').val());
	}
});
$('input[name="backgroundBorderColor"]').on("change", function() {
var div = '.'+$('input[name="backgroundProductsBlockClass"').val();
var content = $('input[name="backgroundBorderSize"').val()+'px solid '+$('input[name="backgroundBorderColor"').val();
$(div.replace(/ /g, '.')).css('border', content);
});
$('input[name="backgroundBorderRoundedSize"]').on("change", function() {
var div = '.'+$('input[name="backgroundProductsBlockClass"').val();
var content = $('input[name="backgroundBorderRoundedSize"').val()+'px';
$(div.replace(/ /g, '.')).css('border-radius', content);
});
$('input[name="backgroundBorderSize"]').on("change", function() {
var div = '.'+$('input[name="backgroundProductsBlockClass"').val();
var content = $('input[name="backgroundBorderSize"').val()+'px solid '+$('input[name="backgroundBorderColor"').val();
$(div.replace(/ /g, '.')).css('border', content);
});
$('input[name="titleColor"]').on("change", function() {
var div = '.'+$('input[name="titleClass"').val();
$(div.replace(/ /g, '.')).css('color',$('input[name="titleColor"]').val());
});
$('input[name="titleBackgroundColor"]').on("change", function() {
var div = '.'+$('input[name="titleClass"').val();
$(div.replace(/ /g, '.')).css('background-color',$('input[name="titleBackgroundColor"]').val());
});
$('input[name="titleBackgroundColorTransparent"]').on("change", function() {
	var div = '.'+$('input[name="titleClass"').val();
	if($(this).is(':checked')) {
		$(div.replace(/ /g, '.')).css('background-color','transparent');
	} else {
		$(div.replace(/ /g, '.')).css('background-color',$('input[name="titleBackgroundColor"]').val());
	}
});
$('input[name="titleSize"]').on("change", function() {
var div = '.'+$('input[name="titleClass"').val();
$(div.replace(/ /g, '.')).css('font-size',$('input[name="titleSize"]').val()+'px');
});
$('input[name="titleBorderColor"]').on("change", function() {
var div = '.'+$('input[name="titleClass"').val();
var content = $('input[name="titleBorderSize"').val()+'px solid '+$('input[name="titleBorderColor"').val();
$(div.replace(/ /g, '.')).css('border', content);
});
$('input[name="titleBorderSize"]').on("change", function() {
var div = '.'+$('input[name="titleClass"').val();
var content = $('input[name="titleBorderSize"').val()+'px solid '+$('input[name="titleBorderColor"').val();
$(div.replace(/ /g, '.')).css('border', content);
});
$('input[name="titleBorderRoundedSize"]').on("change", function() {
var div = '.'+$('input[name="titleClass"').val();
var content = $('input[name="titleBorderRoundedSize"').val()+'px';
$(div.replace(/ /g, '.')).css('border-radius', content);
});
$('select[name="titleAlign"]').on("change", function() {
var div = '.'+$('input[name="titleClass"').val();
$(div.replace(/ /g, '.')).css('text-align', $('select[name="titleAlign"').val());
});
$('input[name="titleLineHeight"]').on("change", function() {
var div = '.'+$('input[name="titleClass"').val();
$(div.replace(/ /g, '.')).css('line-height',$('input[name="titleLineHeight"]').val()+'px');
});
$('input[name="productBackgroundColor"]').on("change", function() {
var div = '.'+$('input[name="productClass"').val();
$(div.replace(/ /g, '.')).css('background-color',$('input[name="productBackgroundColor"]').val());
});
$('input[name="productBackgroundColorTransparent"]').on("change", function() {
var div = '.'+$('input[name="productClass"').val();
	if($(this).is(':checked')) {
		$(div.replace(/ /g, '.')).css('background-color','transparent');
	} else {
		$(div.replace(/ /g, '.')).css('background-color',$('input[name="productBackgroundColor"]').val());
	}
});
$('input[name="productBorderColor"]').on("change", function() {
var div = '.'+$('input[name="productClass"').val();
var content = $('input[name="productBorderSize"').val()+'px solid '+$('input[name="productBorderColor"').val();
$(div.replace(/ /g, '.')).css('border', content);
});
$('input[name="productBorderSize"]').on("change", function() {
var div = '.'+$('input[name="productClass"').val();
var content = $('input[name="productBorderSize"').val()+'px solid '+$('input[name="productBorderColor"').val();
$(div.replace(/ /g, '.')).css('border', content);
});
$('input[name="productBorderRoundedSize"]').on("change", function() {
var div = '.'+$('input[name="productClass"').val();
var content = $('input[name="productBorderRoundedSize"').val()+'px';
$(div.replace(/ /g, '.')).css('border-radius', content);
});
$('input[name="productHeight"]').on("change", function() {
var div = '.'+$('input[name="productClass"').val();
$(div.replace(/ /g, '.')).css('height', $('input[name="productHeight"').val()+'px');
});
$('input[name="productWidth"]').on("change", function() {
var div = '.'+$('input[name="productClass"').val();
$(div.replace(/ /g, '.')).css('width', $('input[name="productWidth"').val()+'px');
});
$('input[name="productMarginRight"]').on("change", function() {
var div = '.'+$('input[name="productClass"').val();
$(div.replace(/ /g, '.')).css('margin-right', $('input[name="productMarginRight"').val()+'px');
});
$('input[name="productTitleColor"]').on("change", function() {
var div = '.'+$('input[name="productTitleClass"').val();
$(div.replace(/ /g, '.')+' a').css('color', $('input[name="productTitleColor"]').val());
});
$('input[name="productTitleSize"]').on("change", function() {
var div = '.'+$('input[name="productTitleClass"').val();
$(div.replace(/ /g, '.')).css('font-size',$('input[name="productTitleSize"]').val()+'px');
});
$('input[name="productTitleHeight"]').on("change", function() {
var div = '.'+$('input[name="productTitleClass"').val();
$(div.replace(/ /g, '.')).css('height', $('input[name="productTitleHeight"]').val()+'px');
});
$('select[name="productTitleAlign"]').on("change", function() {
var div = '.'+$('input[name="productTitleClass"').val();
$(div.replace(/ /g, '.')+' a').css('text-align', $('select[name="productTitleAlign"').val());
});
$('input[name="productTitleLineHeight"]').on("change", function() {
var div = '.'+$('input[name="productTitleClass"').val();
$(div.replace(/ /g, '.')+' a').css('line-height',$('input[name="productTitleLineHeight"]').val()+'px');
});
$('input[name="productDescriptionColor"]').on("change", function() {
var div = '.'+$('input[name="productDescriptionClass"').val();
$(div.replace(/ /g, '.')+'  <?php if ($_smarty_tpl->tpl_vars['version']->value<16) {?>a<?php }?>').css('color', $('input[name="productDescriptionColor"]').val());
});
$('input[name="productDescriptionSize"]').on("change", function() {
var div = '.'+$('input[name="productDescriptionClass"').val();
$(div.replace(/ /g, '.')).css('font-size',$('input[name="productDescriptionSize"]').val()+'px');
});
$('input[name="productDescriptionHeight"]').on("change", function() {
var div = '.'+$('input[name="productDescriptionClass"').val();
$(div.replace(/ /g, '.')).css('height', $('input[name="productDescriptionHeight"').val()+'px');
});
$('select[name="productDescriptionAlign"]').on("change", function() {
var div = '.'+$('input[name="productDescriptionClass"').val();
$(div.replace(/ /g, '.')).css('text-align', $('select[name="productDescriptionAlign"').val());
});
$('input[name="productDescriptionLineHeight"]').on("change", function() {
var div = '.'+$('input[name="productDescriptionClass"').val();
$(div.replace(/ /g, '.')).css('line-height',$('input[name="productDescriptionLineHeight"]').val()+'px');
});
$('input[name="pictureBorderColor"]').on("change", function() {
var div = '.'+$('input[name="pictureClass"').val();
var content = $('input[name="pictureBorderSize"').val()+'px solid '+$('input[name="pictureBorderColor"').val();
$(div.replace(/ /g, '.')).css('border', content);
});
$('input[name="pictureBorderSize"]').on("change", function() {
var div = '.'+$('input[name="pictureClass"').val();
var content = $('input[name="pictureBorderSize"').val()+'px solid '+$('input[name="pictureBorderColor"').val();
$(div.replace(/ /g, '.')).css('border', content);
});
$('input[name="pictureBorderRoundedSize"]').on("change", function() {
var div = '.'+$('input[name="pictureClass"').val();
$(div.replace(/ /g, '.')).css('border-radius', $('input[name="pictureBorderRoundedSize"').val()+'px');
});
$('input[name="pictureHeight"]').on("change", function() {
var div = '.'+$('input[name="pictureClass"').val();
$(div.replace(/ /g, '.')).css('height', $('input[name="pictureHeight"').val()+'px');
});
$('input[name="pictureWidth"]').on("change", function() {
var div = '.'+$('input[name="pictureClass"').val();
$(div.replace(/ /g, '.')).css('width', $('input[name="pictureWidth"').val()+'px');
});
$('input[name="priceColor"]').on("change", function() {
var div = '.'+$('input[name="priceClass"').val();
$(div.replace(/ /g, '.')).css('color', $('input[name="priceColor"]').val());
});
$('input[name="priceSize"]').on("change", function() {
var div = '.'+$('input[name="priceClass"').val();
$(div.replace(/ /g, '.')).css('font-size',$('input[name="priceSize"]').val()+'px');
});
$('input[name="priceHeight"]').on("change", function() {
var div = '.'+$('input[name="priceContainerClass"').val();
$(div.replace(/ /g, '.')).css('height', $('input[name="priceHeight"').val()+'px');
});
$('input[name="cartColor"]').on("change", function() {
var div = '.'+$('input[name="cartClass"').val();
$(div.replace(/ /g, '.')+' <?php if ($_smarty_tpl->tpl_vars['version']->value==16) {?>span<?php }?>').css('color', $('input[name="cartColor"]').val());
});
$('input[name="cartSize"]').on("change", function() {
var div = '.'+$('input[name="cartClass"').val();
$(div.replace(/ /g, '.')+' <?php if ($_smarty_tpl->tpl_vars['version']->value==16) {?>span<?php }?>').css('font-size',$('input[name="cartSize"]').val()+'px');
});
$('input[name="cartBorderColor"]').on("change", function() {
var div = '.'+$('input[name="cartClass"').val();
var content = $('input[name="cartBorderSize"').val()+'px solid '+$('input[name="cartBorderColor"').val();
$(div.replace(/ /g, '.')+' <?php if ($_smarty_tpl->tpl_vars['version']->value==16) {?>span<?php }?>').css('border', content);
});
$('input[name="cartBorderSize"]').on("change", function() {
var div = '.'+$('input[name="cartClass"').val();
var content = $('input[name="cartBorderSize"').val()+'px solid '+$('input[name="cartBorderColor"').val();
$(div.replace(/ /g, '.')).css('border', content);
});
$('input[name="cartBackgroundColor"]').on("change", function() {
var div = '.'+$('input[name="cartClass"').val();
$(div.replace(/ /g, '.')+' <?php if ($_smarty_tpl->tpl_vars['version']->value==16) {?>span<?php }?>').css('background<?php if ($_smarty_tpl->tpl_vars['version']->value!=16) {?>-color<?php }?>', $('input[name="cartBackgroundColor"]').val());
});
$('input[name="cartBackgroundColorTransparent"]').on("change", function() {
var div = '.'+$('input[name="cartClass"').val();
	if($(this).is(':checked')) {
		$(div.replace(/ /g, '.')).css('background<?php if ($_smarty_tpl->tpl_vars['version']->value!=16) {?>-color<?php }?>','transparent');
	} else {
		$(div.replace(/ /g, '.')+' <?php if ($_smarty_tpl->tpl_vars['version']->value==16) {?>span<?php }?>').css('background<?php if ($_smarty_tpl->tpl_vars['version']->value!=16) {?>-color<?php }?>', $('input[name="cartBackgroundColor"]').val());
	}
});
$('input[name="cartBorderRoundedSize"]').on("change", function() {
var div = '.'+$('input[name="cartClass"').val();
$(div.replace(/ /g, '.')+' <?php if ($_smarty_tpl->tpl_vars['version']->value==16) {?>span<?php }?>').css('border-radius', $('input[name="cartBorderRoundedSize"').val()+'px');
});
$('select[name="cartAlign"]').on("change", function() {
var div = '.'+$('input[name="cartClass"').val();
$(div.replace(/ /g, '.')).css('text-align', $('select[name="cartAlign"').val());
});
$('input[name="cartLineHeight"]').on("change", function() {
var div = '.'+$('input[name="cartClass"').val();
$(div.replace(/ /g, '.')).css('line-height',$('input[name="cartLineHeight"]').val()+'px');
});
$('input[name="detailColor"]').on("change", function() {
var div = '.'+$('input[name="detailClass"').val();
$(div.replace(/ /g, '.')+'').css('color', $('input[name="detailColor"]').val());
});
$('input[name="detailSize"]').on("change", function() {
var div = '.'+$('input[name="detailClass"').val();
$(div.replace(/ /g, '.')).css('font-size',$('input[name="detailSize"]').val()+'px');
});
<?php }} ?>
