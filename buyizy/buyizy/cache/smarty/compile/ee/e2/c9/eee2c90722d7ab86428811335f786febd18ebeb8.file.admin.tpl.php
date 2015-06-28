<?php /* Smarty version Smarty-3.1.19, created on 2015-06-12 11:50:59
         compiled from "/home/buyizy/public_html/modules/deliverydays/views/templates/hook/admin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:682190104557a7a4b458ec8-40712773%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'eee2c90722d7ab86428811335f786febd18ebeb8' => 
    array (
      0 => '/home/buyizy/public_html/modules/deliverydays/views/templates/hook/admin.tpl',
      1 => 1429525342,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '682190104557a7a4b458ec8-40712773',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'module_url' => 0,
    'module_config' => 0,
    'documentation_url' => 0,
    'version_16' => 0,
    'groups' => 0,
    'group_name' => 0,
    'id_group' => 0,
    'key' => 0,
    'employees' => 0,
    'version_15' => 0,
    'days' => 0,
    'day_name' => 0,
    'day' => 0,
    'hours' => 0,
    'hour' => 0,
    'minutes' => 0,
    'minute' => 0,
    'futur_dates' => 0,
    'module_short_name' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_557a7a4bcd57b3_18168174',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_557a7a4bcd57b3_18168174')) {function content_557a7a4bcd57b3_18168174($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include '/home/buyizy/public_html/tools/smarty/plugins/function.html_options.php';
?>
<div id="tabParameters">
	<div class="panel">
		<form action="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['module_url']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" method="post" enctype="multipart/form-data">
			<input type="hidden" name="active_tab" value="tabParameters"/>

			<div class="form-group">
				<label><?php echo smartyTranslate(array('s'=>'Manage by group','mod'=>'deliverydays'),$_smarty_tpl);?>
</label>
				<div class="margin-form">
					<span class="radio">
						<input type="radio" name="setting[use_group]" id="setting_use_group_on" value="1" <?php if ($_smarty_tpl->tpl_vars['module_config']->value['use_group']) {?>checked="checked"<?php }?> />
						<label for="setting_use_group_on"><?php echo smartyTranslate(array('s'=>'Yes','mod'=>'deliverydays'),$_smarty_tpl);?>
</label>
						<input type="radio" name="setting[use_group]" id="setting_use_group_off" value="0" <?php if (!$_smarty_tpl->tpl_vars['module_config']->value['use_group']) {?>checked="checked"<?php }?> />
						<label for="setting_use_group_off"><?php echo smartyTranslate(array('s'=>'No','mod'=>'deliverydays'),$_smarty_tpl);?>
</label>
					</span>
					<a class="module_help" title="<?php echo smartyTranslate(array('s'=>'Click to see more informations about this element','mod'=>'deliverydays'),$_smarty_tpl);?>
" href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['documentation_url']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
#use_group">?</a>
					<p <?php if ($_smarty_tpl->tpl_vars['version_16']->value) {?>class="help-block"<?php }?>>
						<?php echo smartyTranslate(array('s'=>'Set delivery days by group','mod'=>'deliverydays'),$_smarty_tpl);?>

					</p>
				</div>
			</div>

			<div class="form-group setting_use_group_off clear">
				 <label><?php echo smartyTranslate(array('s'=>'Required to order','mod'=>'deliverydays'),$_smarty_tpl);?>
</label>
				 <div class="margin-form">
					  <span class="radio">
							<input type="radio" name="setting[required0]" id="setting_required0_on" value="1" <?php if ($_smarty_tpl->tpl_vars['module_config']->value['required0']) {?>checked="checked"<?php }?> />
							<label for="setting_required0_on"><?php echo smartyTranslate(array('s'=>'Yes','mod'=>'deliverydays'),$_smarty_tpl);?>
</label>
							<input type="radio" name="setting[required0]" id="setting_required0_off" value="0" <?php if (!$_smarty_tpl->tpl_vars['module_config']->value['required0']) {?>checked="checked"<?php }?> />
							<label for="setting_required0_off"><?php echo smartyTranslate(array('s'=>'No','mod'=>'deliverydays'),$_smarty_tpl);?>
</label>
					  </span>
					  <a class="module_help" title="<?php echo smartyTranslate(array('s'=>'Click to see more informations about this element','mod'=>'deliverydays'),$_smarty_tpl);?>
" href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['documentation_url']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
#header">?</a>
					  <p <?php if ($_smarty_tpl->tpl_vars['version_16']->value) {?>class="help-block"<?php }?>>
							<?php echo smartyTranslate(array('s'=>'Customer has to select a delivery day to order','mod'=>'deliverydays'),$_smarty_tpl);?>

					  </p>
				 </div>
			</div>

			<div class="form-group clear setting_use_group_on">
				 <label><?php echo smartyTranslate(array('s'=>'Enable for','mod'=>'deliverydays'),$_smarty_tpl);?>
</label>
				 <div class="margin-form">
					  <table>
							<thead>
								 <tr>
									  <th scope="col"><?php echo smartyTranslate(array('s'=>'Group','mod'=>'deliverydays'),$_smarty_tpl);?>
</th>
									  <th scope="col"><?php echo smartyTranslate(array('s'=>'Enabled','mod'=>'deliverydays'),$_smarty_tpl);?>
 <a class="module_help" title="<?php echo smartyTranslate(array('s'=>'Click to see more informations about this element','mod'=>'deliverydays'),$_smarty_tpl);?>
" href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['documentation_url']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
#enabled">?</a></th>
									  <th scope="col"><?php echo smartyTranslate(array('s'=>'Required','mod'=>'deliverydays'),$_smarty_tpl);?>
 <a class="module_help" title="<?php echo smartyTranslate(array('s'=>'Click to see more informations about this element','mod'=>'deliverydays'),$_smarty_tpl);?>
" href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['documentation_url']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
#required">?</a></th>
								 </tr>
							</thead>
							<tbody>
							<?php  $_smarty_tpl->tpl_vars['group_name'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['group_name']->_loop = false;
 $_smarty_tpl->tpl_vars['id_group'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['groups']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['group_name']->key => $_smarty_tpl->tpl_vars['group_name']->value) {
$_smarty_tpl->tpl_vars['group_name']->_loop = true;
 $_smarty_tpl->tpl_vars['id_group']->value = $_smarty_tpl->tpl_vars['group_name']->key;
?>
								 <tr>
									  <td scope="row"><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['group_name']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</td>
									  <td>
											<span class="radio">
												 <?php $_smarty_tpl->_capture_stack[0][] = array('default', 'key', null); ob_start(); ?>enabled<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['id_group']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
												 <input type="radio" name="setting[<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
]" id="setting_<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
_on" value="1" <?php if ($_smarty_tpl->tpl_vars['module_config']->value[$_smarty_tpl->tpl_vars['key']->value]) {?>checked="checked"<?php }?> />
												 <label for="setting_<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
_on"><?php echo smartyTranslate(array('s'=>'Yes','mod'=>'deliverydays'),$_smarty_tpl);?>
</label>
												 <input type="radio" name="setting[<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
]" id="setting_<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
_off" value="0" <?php if (!$_smarty_tpl->tpl_vars['module_config']->value[$_smarty_tpl->tpl_vars['key']->value]) {?>checked="checked"<?php }?> />
												 <label for="setting_<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
_off"><?php echo smartyTranslate(array('s'=>'No','mod'=>'deliverydays'),$_smarty_tpl);?>
</label>
											</span>
									  </td>
									  <td>
											<span class="radio setting_enabled<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['id_group']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
_on">
												 <?php $_smarty_tpl->_capture_stack[0][] = array('default', 'key', null); ob_start(); ?>required<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['id_group']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
												 <input type="radio" name="setting[<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
]" id="setting_<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
_on" value="1" <?php if ($_smarty_tpl->tpl_vars['module_config']->value[$_smarty_tpl->tpl_vars['key']->value]) {?>checked="checked"<?php }?> />
												 <label for="setting_<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
_on"><?php echo smartyTranslate(array('s'=>'Yes','mod'=>'deliverydays'),$_smarty_tpl);?>
</label>
												 <input type="radio" name="setting[<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
]" id="setting_<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
_off" value="0" <?php if (!$_smarty_tpl->tpl_vars['module_config']->value[$_smarty_tpl->tpl_vars['key']->value]) {?>checked="checked"<?php }?> />
												 <label for="setting_<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
_off"><?php echo smartyTranslate(array('s'=>'No','mod'=>'deliverydays'),$_smarty_tpl);?>
</label>
											</span>
									  </td>
								 </tr>
							<?php } ?>
							</tbody>
					  </table>
					  <p <?php if ($_smarty_tpl->tpl_vars['version_16']->value) {?>class="help-block"<?php }?>>
							<?php echo smartyTranslate(array('s'=>'For each group, choose if delivery date is activated and, if so, required.','mod'=>'deliverydays'),$_smarty_tpl);?>

					  </p>
				 </div>
			</div>

			<div class="form-group">
           <label for="setting_id_employee"> <?php echo smartyTranslate(array('s'=>'Send delivery date to','mod'=>'deliverydays'),$_smarty_tpl);?>
</label>
           <div class="margin-form">
               <select class="input_large nochosen" name="setting[id_employee]" id="setting_id_employee">
                   <option value="0" <?php if ($_smarty_tpl->tpl_vars['module_config']->value['id_employee']==0) {?>selected="selected"<?php }?>><?php echo smartyTranslate(array('s'=>'Nobody','mod'=>'deliverydays'),$_smarty_tpl);?>
</option>
                   <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['employees']->value,'selected'=>$_smarty_tpl->tpl_vars['module_config']->value['id_employee']),$_smarty_tpl);?>

               </select>
					<p <?php if ($_smarty_tpl->tpl_vars['version_16']->value) {?>class="help-block"<?php }?>><?php echo smartyTranslate(array('s'=>'Send the delivery date to an employee when an order is created','mod'=>'deliverydays'),$_smarty_tpl);?>
</p>
           </div>
			</div>

			<div class="form-group">
				<label><?php echo smartyTranslate(array('s'=>'Send delivery date to customer','mod'=>'deliverydays'),$_smarty_tpl);?>
</label>
				<div class="margin-form">
					<span class="radio">
						<input type="radio" name="setting[mailcustomer]" id="setting_mailcustomer_on" value="1" <?php if ($_smarty_tpl->tpl_vars['module_config']->value['mailcustomer']) {?>checked="checked"<?php }?> />
						<label for="setting_mailcustomer_on"><?php echo smartyTranslate(array('s'=>'Yes','mod'=>'deliverydays'),$_smarty_tpl);?>
</label>
						<input type="radio" name="setting[mailcustomer]" id="setting_mailcustomer_off" value="0" <?php if (!$_smarty_tpl->tpl_vars['module_config']->value['mailcustomer']) {?>checked="checked"<?php }?> />
						<label for="setting_mailcustomer_off"><?php echo smartyTranslate(array('s'=>'No','mod'=>'deliverydays'),$_smarty_tpl);?>
</label>
					</span>
					<a class="module_help" title="<?php echo smartyTranslate(array('s'=>'Click to see more informations about this element','mod'=>'deliverydays'),$_smarty_tpl);?>
" href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['documentation_url']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
#header">?</a>
					<p <?php if ($_smarty_tpl->tpl_vars['version_16']->value) {?>class="help-block"<?php }?>><?php echo smartyTranslate(array('s'=>'Send the delivery date by e-mail when an order is created','mod'=>'deliverydays'),$_smarty_tpl);?>
</p>
				</div>
			</div>

			<?php if ($_smarty_tpl->tpl_vars['version_15']->value) {?>
				<div class="form-group clear setting_mailcustomer_on">
					<label><?php echo smartyTranslate(array('s'=>'Use separated mail','mod'=>'deliverydays'),$_smarty_tpl);?>
</label>
					<div class="margin-form">
						<span class="radio">
							<input type="radio" name="setting[separate_mail]" id="setting_separate_mail_on" value="1" <?php if ($_smarty_tpl->tpl_vars['module_config']->value['separate_mail']) {?>checked="checked"<?php }?> />
							<label for="setting_separate_mail_on"><?php echo smartyTranslate(array('s'=>'Yes','mod'=>'deliverydays'),$_smarty_tpl);?>
</label>
							<input type="radio" name="setting[separate_mail]" id="setting_separate_mail_off" value="0" <?php if (!$_smarty_tpl->tpl_vars['module_config']->value['separate_mail']) {?>checked="checked"<?php }?> />
							<label for="setting_separate_mail_off"><?php echo smartyTranslate(array('s'=>'No','mod'=>'deliverydays'),$_smarty_tpl);?>
</label>
						</span>
						<a class="module_help" title="<?php echo smartyTranslate(array('s'=>'Click to see more informations about this element','mod'=>'deliverydays'),$_smarty_tpl);?>
" href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['documentation_url']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
#separate_mail">?</a>
						<p <?php if ($_smarty_tpl->tpl_vars['version_16']->value) {?>class="help-block"<?php }?>>
							<?php echo smartyTranslate(array('s'=>'Delivery date can be send in a separated e-mail or included in the order confirmation','mod'=>'deliverydays'),$_smarty_tpl);?>

						</p>
					</div>
				</div>

				<div class="form-group">
					<label><?php echo smartyTranslate(array('s'=>'Show delivery date in orders list','mod'=>'deliverydays'),$_smarty_tpl);?>
</label>
					<div class="margin-form">
						 <span class="radio">
							  <input type="radio" name="setting[add_column]" id="setting_add_column_on" value="1" <?php if ($_smarty_tpl->tpl_vars['module_config']->value['add_column']) {?>checked="checked"<?php }?> />
							  <label for="setting_add_column_on"><?php echo smartyTranslate(array('s'=>'Yes','mod'=>'deliverydays'),$_smarty_tpl);?>
</label>
							  <input type="radio" name="setting[add_column]" id="setting_add_column_off" value="0" <?php if (!$_smarty_tpl->tpl_vars['module_config']->value['add_column']) {?>checked="checked"<?php }?> />
							  <label for="setting_add_column_off"><?php echo smartyTranslate(array('s'=>'No','mod'=>'deliverydays'),$_smarty_tpl);?>
</label>
						 </span>
						 <a class="module_help" title="<?php echo smartyTranslate(array('s'=>'Click to see more informations about this element','mod'=>'deliverydays'),$_smarty_tpl);?>
" href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['documentation_url']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
#add_column">?</a>
						 <p <?php if ($_smarty_tpl->tpl_vars['version_16']->value) {?>class="help-block"<?php }?>><?php echo smartyTranslate(array('s'=>'Add a column with delivery date in \'Orders\' tab','mod'=>'deliverydays'),$_smarty_tpl);?>
</p>
					</div>
				</div>
			<?php }?>

			<div class="clear panel-footer">
				<p><input type="submit" class="samdha_button" name="saveSettings" value="<?php echo smartyTranslate(array('s'=>'Save','mod'=>'deliverydays'),$_smarty_tpl);?>
" /></p>
			</div>
		</form>
	</div>
</div>

<div id="tabDays">
	<div class="panel">
	<form action="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['module_url']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" method="post" enctype="multipart/form-data">
		<input type="hidden" name="active_tab" value="tabDays"/>
			<div class="setting_use_group_off">
				<?php $_smarty_tpl->tpl_vars['id_group'] = new Smarty_variable(0, null, 0);?>

				<div class="form-group">
					<label><?php echo smartyTranslate(array('s'=>'Delivery days','mod'=>'deliverydays'),$_smarty_tpl);?>
</label>
					<div class="margin-form">
						<table>
							<thead>
								<tr>
									<th><?php echo smartyTranslate(array('s'=>'Day','mod'=>'deliverydays'),$_smarty_tpl);?>
</th>
										<th>
											<?php echo smartyTranslate(array('s'=>'Deliver','mod'=>'deliverydays'),$_smarty_tpl);?>

											<a class="module_help" title="<?php echo smartyTranslate(array('s'=>'Click to see more informations about this element','mod'=>'deliverydays'),$_smarty_tpl);?>
" href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['documentation_url']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
#deliver">?</a>
										</th>
										<th>
											<?php echo smartyTranslate(array('s'=>'Deadline for order ','mod'=>'deliverydays'),$_smarty_tpl);?>

											<a class="module_help" title="<?php echo smartyTranslate(array('s'=>'Click to see more informations about this element','mod'=>'deliverydays'),$_smarty_tpl);?>
" href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['documentation_url']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
#deadline">?</a>
										</th>
									</tr>
								</thead>
							<tbody>
								<?php  $_smarty_tpl->tpl_vars['day_name'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['day_name']->_loop = false;
 $_smarty_tpl->tpl_vars['day'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['days']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['day_name']->key => $_smarty_tpl->tpl_vars['day_name']->value) {
$_smarty_tpl->tpl_vars['day_name']->_loop = true;
 $_smarty_tpl->tpl_vars['day']->value = $_smarty_tpl->tpl_vars['day_name']->key;
?>
									<tr>
										<td><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['day_name']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</td>
										<td>
											<span class="radio">
												<?php $_smarty_tpl->_capture_stack[0][] = array('default', 'key', null); ob_start(); ?>days<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['id_group']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
												<input type="radio" name="setting[<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
][<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['day']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
]" id="setting_<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['day']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
_on" value="1" <?php if ($_smarty_tpl->tpl_vars['module_config']->value[$_smarty_tpl->tpl_vars['key']->value][$_smarty_tpl->tpl_vars['day']->value]) {?>checked="checked"<?php }?> />
												<label for="setting_<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['day']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
_on"><?php echo smartyTranslate(array('s'=>'Yes','mod'=>'deliverydays'),$_smarty_tpl);?>
</label>
												<input type="radio" name="setting[<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
][<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['day']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
]" id="setting_<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['day']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
_off" value="0" <?php if (!$_smarty_tpl->tpl_vars['module_config']->value[$_smarty_tpl->tpl_vars['key']->value][$_smarty_tpl->tpl_vars['day']->value]) {?>checked="checked"<?php }?> />
												<label for="setting_<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['day']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
_off"><?php echo smartyTranslate(array('s'=>'No','mod'=>'deliverydays'),$_smarty_tpl);?>
</label>
											</span>
										</td>
										<td>
											<div class="setting_<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['day']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
_on">
												<?php $_smarty_tpl->_capture_stack[0][] = array('default', 'key', null); ob_start(); ?>offsets<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['id_group']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
												<input type="number" class="input_tiny" min="0" step="1" name="setting[<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
][<?php echo $_smarty_tpl->tpl_vars['day']->value;?>
]" value="<?php echo intval($_smarty_tpl->tpl_vars['module_config']->value[$_smarty_tpl->tpl_vars['key']->value][$_smarty_tpl->tpl_vars['day']->value]);?>
" size="4" />
												<?php echo smartyTranslate(array('s'=>'day(s) before at','mod'=>'deliverydays'),$_smarty_tpl);?>

												<?php $_smarty_tpl->_capture_stack[0][] = array('default', 'key', null); ob_start(); ?>hours<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['id_group']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?><?php $_smarty_tpl->tpl_vars['hour'] = new Smarty_variable($_smarty_tpl->tpl_vars['module_config']->value[$_smarty_tpl->tpl_vars['key']->value][$_smarty_tpl->tpl_vars['day']->value], null, 0);?><select class="input_tiny nochosen" name="setting[<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
][<?php echo $_smarty_tpl->tpl_vars['day']->value;?>
]"><?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['hours']->value,'selected'=>$_smarty_tpl->tpl_vars['hour']->value),$_smarty_tpl);?>
</select>:<?php $_smarty_tpl->_capture_stack[0][] = array('default', 'key', null); ob_start(); ?>minutes<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['id_group']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?><?php $_smarty_tpl->tpl_vars['minute'] = new Smarty_variable($_smarty_tpl->tpl_vars['module_config']->value[$_smarty_tpl->tpl_vars['key']->value][$_smarty_tpl->tpl_vars['day']->value], null, 0);?><select class="input_tiny nochosen" name="setting[<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
][<?php echo $_smarty_tpl->tpl_vars['day']->value;?>
]"><?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['minutes']->value,'selected'=>$_smarty_tpl->tpl_vars['minute']->value),$_smarty_tpl);?>
</select>
											</div>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
						<p <?php if ($_smarty_tpl->tpl_vars['version_16']->value) {?>class="help-block"<?php }?>>
							<?php echo smartyTranslate(array('s'=>'For each week days, choose if delivery is possible and, if so, the deadline for ordering.','mod'=>'deliverydays'),$_smarty_tpl);?>

						</p>
					</div>
				</div>

				<div class="form-group">
					<?php $_smarty_tpl->_capture_stack[0][] = array('default', 'key', null); ob_start(); ?>exception<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['id_group']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
					<label for="setting_<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"><?php echo smartyTranslate(array('s'=>'Non delivery days','mod'=>'deliverydays'),$_smarty_tpl);?>
</label>
					<div class="margin-form setting_exception">
						<div class="setting_exception_datepicker"></div>
						<div class="setting_exception_div">
							<input type="text" name="setting[<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
]" id="setting_<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" value="<?php echo mb_convert_encoding(htmlspecialchars(implode(',',$_smarty_tpl->tpl_vars['module_config']->value[$_smarty_tpl->tpl_vars['key']->value]), ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
							<p <?php if ($_smarty_tpl->tpl_vars['version_16']->value) {?>class="help-block"<?php }?>><?php echo smartyTranslate(array('s'=>'coma separated, format: 2007-12-31.','mod'=>'deliverydays'),$_smarty_tpl);?>
</p>
						</div>
						<p <?php if ($_smarty_tpl->tpl_vars['version_16']->value) {?>class="help-block"<?php }?>>
							<?php echo smartyTranslate(array('s'=>'Select the days where delivery is impossible regardless the week day, public holidays for example.','mod'=>'deliverydays'),$_smarty_tpl);?>

						</p>
					</div>
				</div>

				<div class="form-group">
					<?php $_smarty_tpl->_capture_stack[0][] = array('default', 'key', null); ob_start(); ?>offset<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['id_group']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
					<label for="setting_<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"><?php echo smartyTranslate(array('s'=>'Days of preparation','mod'=>'deliverydays'),$_smarty_tpl);?>
</label>
					<div class="margin-form">
						<input type="number" class="input_small" min="0" step="1" value="<?php echo intval($_smarty_tpl->tpl_vars['module_config']->value[$_smarty_tpl->tpl_vars['key']->value]);?>
" name="setting[<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
]" id="setting_<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" />
						<a class="module_help" title="<?php echo smartyTranslate(array('s'=>'Click to see more informations about this element','mod'=>'deliverydays'),$_smarty_tpl);?>
" href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['documentation_url']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
#offset">?</a>
						<p <?php if ($_smarty_tpl->tpl_vars['version_16']->value) {?>class="help-block"<?php }?>><?php echo smartyTranslate(array('s'=>'Number of days before than delivery is possible. If you set it to 3, a customer that buys on Monday will be able to select a delivery day only after Thursday','mod'=>'deliverydays'),$_smarty_tpl);?>
</p>
					</div>
				</div>

				<div class="form-group">
					<?php $_smarty_tpl->_capture_stack[0][] = array('default', 'key', null); ob_start(); ?>duration<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['id_group']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
					<label for="setting_<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"><?php echo smartyTranslate(array('s'=>'Days displayed','mod'=>'deliverydays'),$_smarty_tpl);?>
</label>
					<div class="margin-form">
						<input type="number" class="input_small" min="1" step="1" value="<?php echo intval($_smarty_tpl->tpl_vars['module_config']->value[$_smarty_tpl->tpl_vars['key']->value]);?>
" name="setting[<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
]" id="setting_<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" />
						<a class="module_help" title="<?php echo smartyTranslate(array('s'=>'Click to see more informations about this element','mod'=>'deliverydays'),$_smarty_tpl);?>
" href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['documentation_url']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
#duration">?</a>
						<p <?php if ($_smarty_tpl->tpl_vars['version_16']->value) {?>class="help-block"<?php }?>><?php echo smartyTranslate(array('s'=>'Number of days proposed to the customer','mod'=>'deliverydays'),$_smarty_tpl);?>
</p>
					</div>
				</div>

				<div class="form-group">
					<?php $_smarty_tpl->_capture_stack[0][] = array('default', 'key', null); ob_start(); ?>timeframe<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['id_group']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
					<label for="setting_<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"><?php echo smartyTranslate(array('s'=>'Hourly ranges','mod'=>'deliverydays'),$_smarty_tpl);?>
</label>
					<div class="margin-form">
						<textarea class="timeframe" rows="10" cols="50" name="setting[<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
]" id="setting_<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"><?php echo mb_convert_encoding(htmlspecialchars(implode("\n",$_smarty_tpl->tpl_vars['module_config']->value[$_smarty_tpl->tpl_vars['key']->value]), ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</textarea>
						<p <?php if ($_smarty_tpl->tpl_vars['version_16']->value) {?>class="help-block"<?php }?>><?php echo smartyTranslate(array('s'=>'One range by line. It can be anything, \'8am to 10am\', \'Morning\', \'Warehouse 1\'...','mod'=>'deliverydays'),$_smarty_tpl);?>
</p>
					</div>
				</div>
			</div>

           <div id="day_by_group" class="accordion setting_use_group_on">
               <?php  $_smarty_tpl->tpl_vars['group_name'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['group_name']->_loop = false;
 $_smarty_tpl->tpl_vars['id_group'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['groups']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['group_name']->key => $_smarty_tpl->tpl_vars['group_name']->value) {
$_smarty_tpl->tpl_vars['group_name']->_loop = true;
 $_smarty_tpl->tpl_vars['id_group']->value = $_smarty_tpl->tpl_vars['group_name']->key;
?>
                   <h3 class="modal-title setting_enabled<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['id_group']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
_on"><?php echo smartyTranslate(array('s'=>'Group','mod'=>'deliverydays'),$_smarty_tpl);?>
 <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['group_name']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</h3>
                   <div>
								<div class="form-group">
								<label><?php echo smartyTranslate(array('s'=>'Delivery days','mod'=>'deliverydays'),$_smarty_tpl);?>
</label>
								<div class="margin-form">
									 <table>
										  <thead>
												<tr>
													 <th><?php echo smartyTranslate(array('s'=>'Day','mod'=>'deliverydays'),$_smarty_tpl);?>
</th>
													 <th>
														  <?php echo smartyTranslate(array('s'=>'Deliver','mod'=>'deliverydays'),$_smarty_tpl);?>

														  <a class="module_help" title="<?php echo smartyTranslate(array('s'=>'Click to see more informations about this element','mod'=>'deliverydays'),$_smarty_tpl);?>
" href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['documentation_url']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
#deliver">?</a>
													 </th>
													 <th>
														  <?php echo smartyTranslate(array('s'=>'Deadline for order ','mod'=>'deliverydays'),$_smarty_tpl);?>

														  <a class="module_help" title="<?php echo smartyTranslate(array('s'=>'Click to see more informations about this element','mod'=>'deliverydays'),$_smarty_tpl);?>
" href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['documentation_url']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
#deadline">?</a>
													 </th>
												</tr>
										  </thead>
										  <tbody>
										  <?php  $_smarty_tpl->tpl_vars['day_name'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['day_name']->_loop = false;
 $_smarty_tpl->tpl_vars['day'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['days']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['day_name']->key => $_smarty_tpl->tpl_vars['day_name']->value) {
$_smarty_tpl->tpl_vars['day_name']->_loop = true;
 $_smarty_tpl->tpl_vars['day']->value = $_smarty_tpl->tpl_vars['day_name']->key;
?>
												<tr>
													 <td><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['day_name']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</td>
													 <td>
														  <span class="radio">
																<?php $_smarty_tpl->_capture_stack[0][] = array('default', 'key', null); ob_start(); ?>days<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['id_group']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
																<input type="radio" name="setting[<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
][<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['day']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
]" id="setting_<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['day']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
_on" value="1" <?php if ($_smarty_tpl->tpl_vars['module_config']->value[$_smarty_tpl->tpl_vars['key']->value][$_smarty_tpl->tpl_vars['day']->value]) {?>checked="checked"<?php }?> />
																<label for="setting_<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['day']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
_on"><?php echo smartyTranslate(array('s'=>'Yes','mod'=>'deliverydays'),$_smarty_tpl);?>
</label>
																<input type="radio" name="setting[<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
][<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['day']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
]" id="setting_<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['day']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
_off" value="0" <?php if (!$_smarty_tpl->tpl_vars['module_config']->value[$_smarty_tpl->tpl_vars['key']->value][$_smarty_tpl->tpl_vars['day']->value]) {?>checked="checked"<?php }?> />
																<label for="setting_<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['day']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
_off"><?php echo smartyTranslate(array('s'=>'No','mod'=>'deliverydays'),$_smarty_tpl);?>
</label>
														  </span>
													 </td>
													 <td>
														  <div class="setting_<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['day']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
_on">
																<?php $_smarty_tpl->_capture_stack[0][] = array('default', 'key', null); ob_start(); ?>offsets<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['id_group']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
																<input type="number" class="input_tiny" min="0" step="1" name="setting[<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
][<?php echo $_smarty_tpl->tpl_vars['day']->value;?>
]" value="<?php echo intval($_smarty_tpl->tpl_vars['module_config']->value[$_smarty_tpl->tpl_vars['key']->value][$_smarty_tpl->tpl_vars['day']->value]);?>
" size="4" />
																<?php echo smartyTranslate(array('s'=>'day(s) before at','mod'=>'deliverydays'),$_smarty_tpl);?>

																<?php $_smarty_tpl->_capture_stack[0][] = array('default', 'key', null); ob_start(); ?>hours<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['id_group']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?><?php $_smarty_tpl->tpl_vars['hour'] = new Smarty_variable($_smarty_tpl->tpl_vars['module_config']->value[$_smarty_tpl->tpl_vars['key']->value][$_smarty_tpl->tpl_vars['day']->value], null, 0);?><select class="input_tiny nochosen" name="setting[<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
][<?php echo $_smarty_tpl->tpl_vars['day']->value;?>
]"><?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['hours']->value,'selected'=>$_smarty_tpl->tpl_vars['hour']->value),$_smarty_tpl);?>
</select>:<?php $_smarty_tpl->_capture_stack[0][] = array('default', 'key', null); ob_start(); ?>minutes<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['id_group']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?><?php $_smarty_tpl->tpl_vars['minute'] = new Smarty_variable($_smarty_tpl->tpl_vars['module_config']->value[$_smarty_tpl->tpl_vars['key']->value][$_smarty_tpl->tpl_vars['day']->value], null, 0);?><select class="input_tiny nochosen" name="setting[<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
][<?php echo $_smarty_tpl->tpl_vars['day']->value;?>
]"><?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['minutes']->value,'selected'=>$_smarty_tpl->tpl_vars['minute']->value),$_smarty_tpl);?>
</select>
														  </div>
													 </td>
												</tr>
										  <?php } ?>
										  </tbody>
									 </table>
									<p <?php if ($_smarty_tpl->tpl_vars['version_16']->value) {?>class="help-block"<?php }?>>
										 <?php echo smartyTranslate(array('s'=>'For each week days, choose if delivery is possible and, if so, the deadline for ordering.','mod'=>'deliverydays'),$_smarty_tpl);?>

									</p>
								</div>
								</div>

								<div class="form-group">
									<?php $_smarty_tpl->_capture_stack[0][] = array('default', 'key', null); ob_start(); ?>exception<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['id_group']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
									<label for="setting_<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"><?php echo smartyTranslate(array('s'=>'Non delivery days','mod'=>'deliverydays'),$_smarty_tpl);?>
</label>
									<div class="margin-form setting_exception">
										 <div class="setting_exception_datepicker"></div>
										 <div class="setting_exception_div">
											  <input type="text" name="setting[<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
]" id="setting_<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" value="<?php echo mb_convert_encoding(htmlspecialchars(implode(',',$_smarty_tpl->tpl_vars['module_config']->value[$_smarty_tpl->tpl_vars['key']->value]), ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
											  <p <?php if ($_smarty_tpl->tpl_vars['version_16']->value) {?>class="help-block"<?php }?>><?php echo smartyTranslate(array('s'=>'coma separated, format: 2007-12-31.','mod'=>'deliverydays'),$_smarty_tpl);?>
</p>
										 </div>
										<p <?php if ($_smarty_tpl->tpl_vars['version_16']->value) {?>class="help-block"<?php }?>>
											 <?php echo smartyTranslate(array('s'=>'Select the days where delivery is impossible regardless the week day, public holidays for example.','mod'=>'deliverydays'),$_smarty_tpl);?>

										</p>
									</div>
								</div>

								<div class="form-group">
									<?php $_smarty_tpl->_capture_stack[0][] = array('default', 'key', null); ob_start(); ?>duration<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['id_group']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
									<label for="setting_<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"><?php echo smartyTranslate(array('s'=>'Days displayed','mod'=>'deliverydays'),$_smarty_tpl);?>
</label>
									<div class="margin-form">
										 <input type="number" class="input_small" min="1" step="1" value="<?php echo intval($_smarty_tpl->tpl_vars['module_config']->value[$_smarty_tpl->tpl_vars['key']->value]);?>
" name="setting[<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
]" id="setting_<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" />
										 <a class="module_help" title="<?php echo smartyTranslate(array('s'=>'Click to see more informations about this element','mod'=>'deliverydays'),$_smarty_tpl);?>
" href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['documentation_url']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
#duration">?</a>
										 <p <?php if ($_smarty_tpl->tpl_vars['version_16']->value) {?>class="help-block"<?php }?>><?php echo smartyTranslate(array('s'=>'Number of days proposed to the customer','mod'=>'deliverydays'),$_smarty_tpl);?>
</p>
									</div>
								</div>

								<div class="form-group">
									<?php $_smarty_tpl->_capture_stack[0][] = array('default', 'key', null); ob_start(); ?>timeframe<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['id_group']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
									<label for="setting_<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"><?php echo smartyTranslate(array('s'=>'Hourly ranges','mod'=>'deliverydays'),$_smarty_tpl);?>
</label>
									<div class="margin-form">
										 <textarea class="timeframe" rows="10" cols="50" name="setting[<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
]" id="setting_<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"><?php echo mb_convert_encoding(htmlspecialchars(implode("\n",$_smarty_tpl->tpl_vars['module_config']->value[$_smarty_tpl->tpl_vars['key']->value]), ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</textarea>
										 <p <?php if ($_smarty_tpl->tpl_vars['version_16']->value) {?>class="help-block"<?php }?>><?php echo smartyTranslate(array('s'=>'One range by line. It can be anything, \'8am to 10am\', \'Morning\', \'Warehouse 1\'...','mod'=>'deliverydays'),$_smarty_tpl);?>
</p>
									</div>
								</div>
                </div>
           <?php } ?>
           </div>

				<div class="clear panel-footer">
					<p><input type="submit" class="samdha_button" name="saveSettings" value="<?php echo smartyTranslate(array('s'=>'Save','mod'=>'deliverydays'),$_smarty_tpl);?>
" /></p>
				</div>
	</form>
	</div>
</div>

<?php if (count($_smarty_tpl->tpl_vars['futur_dates']->value)) {?>
	<div id="tabExport">
		<div class="panel">
			<form action="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['module_url']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" method="post" enctype="multipart/form-data">
				<input type="hidden" name="active_tab" value="tabExport"/>
				<div class="form-group">
					<label for="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['module_short_name']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
_export"><?php echo smartyTranslate(array('s'=>'Delivery day','mod'=>'deliverydays'),$_smarty_tpl);?>
</label>
					<div class="margin-form">
						<select name="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['module_short_name']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
_export" id="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['module_short_name']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
_export" class="nochosen">
							<?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['futur_dates']->value),$_smarty_tpl);?>

						</select>
					</div>
				</div>
				<div class="clear panel-footer">
					<p>
						<input type="submit" class="samdha_button" name="exportProducts" value="<?php echo smartyTranslate(array('s'=>'Export products','mod'=>'deliverydays'),$_smarty_tpl);?>
" />
						<input type="submit" class="samdha_button" name="exportOrders" value="<?php echo smartyTranslate(array('s'=>'Export orders','mod'=>'deliverydays'),$_smarty_tpl);?>
" />
					</p>
				</div>
			</form>
		</div>
	</div>
<?php }?>
<?php }} ?>
