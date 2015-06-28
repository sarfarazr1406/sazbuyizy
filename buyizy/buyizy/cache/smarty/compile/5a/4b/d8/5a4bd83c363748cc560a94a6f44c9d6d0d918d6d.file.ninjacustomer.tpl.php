<?php /* Smarty version Smarty-3.1.19, created on 2015-06-07 14:53:59
         compiled from "/home/buyizy/public_html/modules/ninjacustomer/views/templates/hook/ninjacustomer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:34355261355740daf658d88-41302164%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5a4bd83c363748cc560a94a6f44c9d6d0d918d6d' => 
    array (
      0 => '/home/buyizy/public_html/modules/ninjacustomer/views/templates/hook/ninjacustomer.tpl',
      1 => 1433585395,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '34355261355740daf658d88-41302164',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'errors' => 0,
    'logged' => 0,
    'fun' => 0,
    'error' => 0,
    'content_dir' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_55740daf6c6676_23182310',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55740daf6c6676_23182310')) {function content_55740daf6c6676_23182310($_smarty_tpl) {?><div id="ninjac" class="<?php if (!empty($_smarty_tpl->tpl_vars['errors']->value)) {?>error<?php }?> <?php if ($_smarty_tpl->tpl_vars['logged']->value) {?>logged<?php }?> <?php if (!$_smarty_tpl->tpl_vars['fun']->value) {?>not_fun<?php }?>">
	<div class="openbutton"></div>
	<div class="nj_content">
	<?php if (!empty($_smarty_tpl->tpl_vars['errors']->value)) {?>
		<?php  $_smarty_tpl->tpl_vars['error'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['error']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['errors']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['error']->key => $_smarty_tpl->tpl_vars['error']->value) {
$_smarty_tpl->tpl_vars['error']->_loop = true;
?>
			<?php echo $_smarty_tpl->tpl_vars['error']->value;?>
<br/>
		<?php } ?>
	<?php }?>
	<?php if (!$_smarty_tpl->tpl_vars['logged']->value) {?>
	<form method="post">
		<label><?php echo smartyTranslate(array('s'=>"Enter customer e-mail or ID"),$_smarty_tpl);?>
</label>
		<input class="nj_mail" type="text" name="ninjaCustomerMail" value=""/>
		<input class="nj_submit" type="submit" value="<?php if ($_smarty_tpl->tpl_vars['fun']->value) {?><?php echo smartyTranslate(array('s'=>'Ninja Login'),$_smarty_tpl);?>
<?php } else { ?><?php echo smartyTranslate(array('s'=>'Login'),$_smarty_tpl);?>
<?php }?>" name="ninjaLogin" />
	</form>
	
	<?php } else { ?>
		<a class="nj_logout" href="<?php echo $_smarty_tpl->tpl_vars['content_dir']->value;?>
?mylogout="><?php echo smartyTranslate(array('s'=>"Logout"),$_smarty_tpl);?>
</a>
	<?php }?>
	</div>
</div><?php }} ?>
