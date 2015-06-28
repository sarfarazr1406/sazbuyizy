<?php /* Smarty version Smarty-3.1.19, created on 2015-06-07 12:30:03
         compiled from "/home/buyizy/public_html/modules/whatsappbutton/views/templates/hook/whatsapp-button.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14698644165573ebf360fb54-25827372%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0cf57d71b57df8c597c5f304ec312e2af9558887' => 
    array (
      0 => '/home/buyizy/public_html/modules/whatsappbutton/views/templates/hook/whatsapp-button.tpl',
      1 => 1430929318,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14698644165573ebf360fb54-25827372',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'PS_WHATSAPP_BUTTON' => 0,
    'whatsappbutton_text' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5573ebf36644c4_64286358',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5573ebf36644c4_64286358')) {function content_5573ebf36644c4_64286358($_smarty_tpl) {?>
<?php if ($_smarty_tpl->tpl_vars['PS_WHATSAPP_BUTTON']->value>=0) {?>
	<p class="whatsapp-button">
	    <a href="whatsapp://send?text=<?php echo rawurlencode($_smarty_tpl->tpl_vars['whatsappbutton_text']->value);?>
" data-action="share/whatsapp/share" class="btn btn-default btn-whatsapp<?php if ($_smarty_tpl->tpl_vars['PS_WHATSAPP_BUTTON']->value==0) {?> btn-whatsapp-16 btn-xs<?php } elseif ($_smarty_tpl->tpl_vars['PS_WHATSAPP_BUTTON']->value==1) {?> btn-whatsapp-24 btn-sm<?php } elseif ($_smarty_tpl->tpl_vars['PS_WHATSAPP_BUTTON']->value==2) {?> btn-whatsapp-32 btn-lg btn-block<?php }?>">
			<span><?php echo smartyTranslate(array('s'=>'Share','mod'=>'whatsappbutton'),$_smarty_tpl);?>
</span>
		</a>
	</p>
<?php }?>
<?php }} ?>
