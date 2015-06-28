<?php /* Smarty version Smarty-3.1.19, created on 2015-06-07 13:50:52
         compiled from "/home/buyizy/public_html/themes/default-bootstrap/mails/en/order_conf_product_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17911279675573fee46ca9b1-92025509%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c4eb7bc0e711c89df021ed8638658c1ba2a59630' => 
    array (
      0 => '/home/buyizy/public_html/themes/default-bootstrap/mails/en/order_conf_product_list.tpl',
      1 => 1429545673,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17911279675573fee46ca9b1-92025509',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'list' => 0,
    'product' => 0,
    'customization' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5573fee4722142_41758617',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5573fee4722142_41758617')) {function content_5573fee4722142_41758617($_smarty_tpl) {?><?php  $_smarty_tpl->tpl_vars['product'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['product']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['product']->key => $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->_loop = true;
?>
<tr>
	<td style="border:1px solid #D6D4D4;">
		<table class="table">
			<tr>
				<td width="10">&nbsp;</td>
				<td>
					<font size="2" face="Open-sans, sans-serif" color="#555454">
						<?php echo $_smarty_tpl->tpl_vars['product']->value['reference'];?>

					</font>
				</td>
				<td width="10">&nbsp;</td>
			</tr>
		</table>
	</td>
	<td style="border:1px solid #D6D4D4;">
		<table class="table">
			<tr>
				<td width="10">&nbsp;</td>
				<td>
					<font size="2" face="Open-sans, sans-serif" color="#555454">
						<strong><?php echo $_smarty_tpl->tpl_vars['product']->value['name'];?>
</strong>
					</font>
				</td>
				<td width="10">&nbsp;</td>
			</tr>
		</table>
	</td>
	<td style="border:1px solid #D6D4D4;">
		<table class="table">
			<tr>
				<td width="10">&nbsp;</td>
				<td align="right">
					<font size="2" face="Open-sans, sans-serif" color="#555454">
						<?php echo $_smarty_tpl->tpl_vars['product']->value['unit_price'];?>

					</font>
				</td>
				<td width="10">&nbsp;</td>
			</tr>
		</table>
	</td>
	<td style="border:1px solid #D6D4D4;">
		<table class="table">
			<tr>
				<td width="10">&nbsp;</td>
				<td align="right">
					<font size="2" face="Open-sans, sans-serif" color="#555454">
						<?php echo $_smarty_tpl->tpl_vars['product']->value['quantity'];?>

					</font>
				</td>
				<td width="10">&nbsp;</td>
			</tr>
		</table>
	</td>
	<td style="border:1px solid #D6D4D4;">
		<table class="table">
			<tr>
				<td width="10">&nbsp;</td>
				<td align="right">
					<font size="2" face="Open-sans, sans-serif" color="#555454">
						<?php echo $_smarty_tpl->tpl_vars['product']->value['price'];?>

					</font>
				</td>
				<td width="10">&nbsp;</td>
			</tr>
		</table>
	</td>
</tr>
	<?php  $_smarty_tpl->tpl_vars['customization'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['customization']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['product']->value['customization']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['customization']->key => $_smarty_tpl->tpl_vars['customization']->value) {
$_smarty_tpl->tpl_vars['customization']->_loop = true;
?>
		<tr>
		<td colspan="2" style="border:1px solid #D6D4D4;">
			<table class="table">
				<tr>
					<td width="10">&nbsp;</td>
					<td>
						<font size="2" face="Open-sans, sans-serif" color="#555454">
							<strong><?php echo $_smarty_tpl->tpl_vars['product']->value['name'];?>
</strong><br>
							<?php echo $_smarty_tpl->tpl_vars['customization']->value['customization_text'];?>

						</font>
					</td>
					<td width="10">&nbsp;</td>
				</tr>
			</table>
		</td>
		<td style="border:1px solid #D6D4D4;">
			<table class="table">
				<tr>
					<td width="10">&nbsp;</td>
					<td align="right">
						<font size="2" face="Open-sans, sans-serif" color="#555454">
							<?php echo $_smarty_tpl->tpl_vars['product']->value['unit_price'];?>

						</font>
					</td>
					<td width="10">&nbsp;</td>
				</tr>
			</table>
		</td>
		<td style="border:1px solid #D6D4D4;">
			<table class="table">
				<tr>
					<td width="10">&nbsp;</td>
					<td align="right">
						<font size="2" face="Open-sans, sans-serif" color="#555454">
							<?php echo $_smarty_tpl->tpl_vars['customization']->value['customization_quantity'];?>

						</font>
					</td>
					<td width="10">&nbsp;</td>
				</tr>
			</table>
		</td>
		<td style="border:1px solid #D6D4D4;">
			<table class="table">
				<tr>
					<td width="10">&nbsp;</td>
					<td align="right">
						<font size="2" face="Open-sans, sans-serif" color="#555454">
							<?php echo $_smarty_tpl->tpl_vars['customization']->value['quantity'];?>

						</font>
					</td>
					<td width="10">&nbsp;</td>
				</tr>
			</table>
		</td>
	</tr>
	<?php } ?>
<?php } ?><?php }} ?>
