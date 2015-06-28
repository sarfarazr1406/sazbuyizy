<?php /* Smarty version Smarty-3.1.19, created on 2015-06-12 11:50:59
         compiled from "/home/buyizy/public_html/themes/default-bootstrap/modules/deliverydays/views/templates/hook/samdha_licenceform.tpl" */ ?>
<?php /*%%SmartyHeaderCode:200982393557a7a4b0a9af4-61498580%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '534d5d2468446f10fb1f9740ec5f46f33ff06e8f' => 
    array (
      0 => '/home/buyizy/public_html/themes/default-bootstrap/modules/deliverydays/views/templates/hook/samdha_licenceform.tpl',
      1 => 1429475430,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '200982393557a7a4b0a9af4-61498580',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'registered' => 0,
    'content' => 0,
    'bootstrap' => 0,
    'space' => 0,
    'licence_url' => 0,
    'module_url' => 0,
    'licence_number' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_557a7a4b144f09_05969922',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_557a7a4b144f09_05969922')) {function content_557a7a4b144f09_05969922($_smarty_tpl) {?>
<?php if ($_smarty_tpl->tpl_vars['registered']->value) {?>
    <?php if ($_smarty_tpl->tpl_vars['content']->value) {?>
        <fieldset class="<?php if (!$_smarty_tpl->tpl_vars['bootstrap']->value) {?>ui-widget ui-widget-content ui-corner-all<?php }?><?php if ($_smarty_tpl->tpl_vars['space']->value) {?> space<?php }?>"><?php echo htmlspecialchars_decode(htmlspecialchars($_smarty_tpl->tpl_vars['content']->value, ENT_QUOTES, 'UTF-8', true), ENT_QUOTES);?>
</fieldset>
    <?php }?>
<?php } else { ?>
    <fieldset class="<?php if (!$_smarty_tpl->tpl_vars['bootstrap']->value) {?>ui-widget ui-widget-content ui-corner-all<?php }?><?php if ($_smarty_tpl->tpl_vars['space']->value) {?> space<?php }?>" id="samdha_registerform">
        <legend class="<?php if (!$_smarty_tpl->tpl_vars['bootstrap']->value) {?>ui-widget-header ui-corner-all<?php }?>"><?php echo smartyTranslate(array('s'=>'Register this module','mod'=>'samdha'),$_smarty_tpl);?>
</legend>
        <p><?php echo smartyTranslate(array('s'=>'By register your module you will get:','mod'=>'samdha'),$_smarty_tpl);?>
</p>
        <ul>
            <li><?php echo smartyTranslate(array('s'=>'Faster and better support,','mod'=>'samdha'),$_smarty_tpl);?>
</li>
            <li><?php echo smartyTranslate(array('s'=>'Latest version before everyone,','mod'=>'samdha'),$_smarty_tpl);?>
</li>
            <li><?php echo smartyTranslate(array('s'=>'Automatic update of the module.','mod'=>'samdha'),$_smarty_tpl);?>
</li>
        </ul>
        <p>
            <?php echo smartyTranslate(array('s'=>'Just fill','mod'=>'samdha'),$_smarty_tpl);?>
 <a style="text-decoration: underline;" href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['licence_url']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" target="_blank" class="module_support"><?php echo smartyTranslate(array('s'=>'this form','mod'=>'samdha'),$_smarty_tpl);?>
</a><?php echo smartyTranslate(array('s'=>', it\'s free.','mod'=>'samdha'),$_smarty_tpl);?>

        </p>
        <hr/>
        <form action="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['module_url']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" method="post" enctype="multipart/form-data">
            <p style="font-size: 0.85em;">
                <label for="licence_number" class="t"><?php echo smartyTranslate(array('s'=>'Licence number:','mod'=>'samdha'),$_smarty_tpl);?>
</label><br/>
                <input style="display: inline-block; width: 200px" type="text" name="licence_number" id="licence_number" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['licence_number']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
                <button class="ui-button-primary" name="saveLicence" value="1" style="margin-top: -.1em;"><?php echo smartyTranslate(array('s'=>'Ok','mod'=>'samdha'),$_smarty_tpl);?>
</button>
            </p>
        </form>
    </fieldset>
<?php }?>
<?php }} ?>
