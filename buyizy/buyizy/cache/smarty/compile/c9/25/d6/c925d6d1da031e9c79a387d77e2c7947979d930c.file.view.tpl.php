<?php /* Smarty version Smarty-3.1.19, created on 2015-06-15 12:22:53
         compiled from "/home/buyizy/public_html/admin3039/themes/default/template/controllers/request_sql/helpers/view/view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:530466663557e76450262f1-21870788%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c925d6d1da031e9c79a387d77e2c7947979d930c' => 
    array (
      0 => '/home/buyizy/public_html/admin3039/themes/default/template/controllers/request_sql/helpers/view/view.tpl',
      1 => 1416031498,
      2 => 'file',
    ),
    '384e1b599b19a4193cff6f7fb7da0630a24a710e' => 
    array (
      0 => '/home/buyizy/public_html/admin3039/themes/default/template/helpers/view/view.tpl',
      1 => 1416031498,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '530466663557e76450262f1-21870788',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'name_controller' => 0,
    'hookName' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_557e76450cef45_08363105',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_557e76450cef45_08363105')) {function content_557e76450cef45_08363105($_smarty_tpl) {?>

<div class="leadin"></div>


<div class="panel">
	<h3><i class="icon-cog"></i> <?php echo smartyTranslate(array('s'=>'SQL query result'),$_smarty_tpl);?>
</h3>
	<?php if (isset($_smarty_tpl->tpl_vars['view']->value['error'])) {?>
		<div class="alert alert-warning"><?php echo smartyTranslate(array('s'=>'This SQL query has no result.'),$_smarty_tpl);?>
</div>
	<?php } else { ?>
		<table class="table" id="viewRequestSql">
			<thead>
				<tr>
					<?php  $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['key']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['view']->value['key']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['key']->key => $_smarty_tpl->tpl_vars['key']->value) {
$_smarty_tpl->tpl_vars['key']->_loop = true;
?>
					<th><span class="title_box"><?php echo $_smarty_tpl->tpl_vars['key']->value;?>
</span></th>
					<?php } ?>
				</tr>
			</thead>
			<tbody>
			<?php  $_smarty_tpl->tpl_vars['result'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['result']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['view']->value['results']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['result']->key => $_smarty_tpl->tpl_vars['result']->value) {
$_smarty_tpl->tpl_vars['result']->_loop = true;
?>
				<tr>
					<?php  $_smarty_tpl->tpl_vars['name'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['name']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['view']->value['key']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['name']->key => $_smarty_tpl->tpl_vars['name']->value) {
$_smarty_tpl->tpl_vars['name']->_loop = true;
?>
						<?php if (isset($_smarty_tpl->tpl_vars['view']->value['attributes'][$_smarty_tpl->tpl_vars['name']->value])) {?>
							<td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['view']->value['attributes'][$_smarty_tpl->tpl_vars['name']->value], ENT_QUOTES, 'UTF-8', true);?>
</td>
						<?php } else { ?>
							<td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['result']->value[$_smarty_tpl->tpl_vars['name']->value], ENT_QUOTES, 'UTF-8', true);?>
</td>
						<?php }?>
					<?php } ?>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	
		<script type="text/javascript">
			$(function(){
				var width = $('#viewRequestSql').width();
				if (width > 990){
					$('#viewRequestSql').css('display','block').css('overflow-x', 'scroll');
				}
			});
		</script>
	<?php }?>
</div>


<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>'displayAdminView'),$_smarty_tpl);?>

<?php if (isset($_smarty_tpl->tpl_vars['name_controller']->value)) {?>
	<?php $_smarty_tpl->_capture_stack[0][] = array('hookName', 'hookName', null); ob_start(); ?>display<?php echo ucfirst($_smarty_tpl->tpl_vars['name_controller']->value);?>
View<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
	<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>$_smarty_tpl->tpl_vars['hookName']->value),$_smarty_tpl);?>

<?php } elseif (isset($_GET['controller'])) {?>
	<?php $_smarty_tpl->_capture_stack[0][] = array('hookName', 'hookName', null); ob_start(); ?>display<?php echo htmlentities(ucfirst($_GET['controller']));?>
View<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
	<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>$_smarty_tpl->tpl_vars['hookName']->value),$_smarty_tpl);?>

<?php }?>
<?php }} ?>
