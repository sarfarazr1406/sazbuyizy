<?php /* Smarty version Smarty-3.1.19, created on 2015-06-07 11:42:14
         compiled from "/home/buyizy/public_html/modules/sendinblue/views/templates/front/newsletter.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19828073515573e0beaf0944-18420122%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ae9c942ff18565647f8a16bbfe8cf83a5fac89b0' => 
    array (
      0 => '/home/buyizy/public_html/modules/sendinblue/views/templates/front/newsletter.tpl',
      1 => 1428598376,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19828073515573e0beaf0944-18420122',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5573e0beb8c699_80046403',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5573e0beb8c699_80046403')) {function content_5573e0beb8c699_80046403($_smarty_tpl) {?>

<!-- sendinblue Newsletter module display on registration page-->
<fieldset class="account_creation" style="padding:15px 0 8px 40px; margin-top:0!important;">
<p class="checkbox">
<input id="newsletter" type="checkbox" value="1" checked="checked" name="newsletter">
<label for="newsletter"><?php echo smartyTranslate(array('s'=>'Want to save? Subscribe for our promotional mails','mod'=>'sendinblue'),$_smarty_tpl);?>
</label>
</p>
</fieldset>

<!-- /sendinblue Newsletter module-->
<?php }} ?>
