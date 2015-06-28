<?php /* Smarty version Smarty-3.1.19, created on 2015-06-11 19:08:08
         compiled from "/home/buyizy/public_html/modules/cronjobs/views/templates/admin/configure.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7016255875575d36872bd47-32178596%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ee55062d0b8b4ba86c81133c769391ccabf64b7c' => 
    array (
      0 => '/home/buyizy/public_html/modules/cronjobs/views/templates/admin/configure.tpl',
      1 => 1434029850,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7016255875575d36872bd47-32178596',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5575d3687c1838_39169385',
  'variables' => 
  array (
    'module_dir' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5575d3687c1838_39169385')) {function content_5575d3687c1838_39169385($_smarty_tpl) {?>

<div class="panel">
	<h3><?php echo smartyTranslate(array('s'=>'What does this module do?','mod'=>'cronjobs'),$_smarty_tpl);?>
</h3>
	<p>
		<img src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['module_dir']->value, ENT_QUOTES, 'UTF-8', true);?>
/logo.png" class="pull-left" id="cronjobs-logo" />
		<?php echo smartyTranslate(array('s'=>'Originally, cron is a Unix system tool that provides time-based job scheduling: you can create many cron jobs, which are then run periodically at fixed times, dates, or intervals.','mod'=>'cronjobs'),$_smarty_tpl);?>

		<br/>
		<?php echo smartyTranslate(array('s'=>'This module provides you with a cron-like tool: you can create jobs which will call a given set of secure URLs to your PrestaShop store, thus triggering updates and other automated tasks.','mod'=>'cronjobs'),$_smarty_tpl);?>

	</p>
</div>
<?php }} ?>
