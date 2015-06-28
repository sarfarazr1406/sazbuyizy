<?php /* Smarty version Smarty-3.1.19, created on 2015-06-09 12:05:14
         compiled from "/home/buyizy/public_html/pdf//delivery-slip.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5911021755768922623556-79206931%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '332925acc4c27a8d23bdb98e929eeeb480c706f5' => 
    array (
      0 => '/home/buyizy/public_html/pdf//delivery-slip.tpl',
      1 => 1431067887,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5911021755768922623556-79206931',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'invoice_address' => 0,
    'delivery_address' => 0,
    'order' => 0,
    'order_invoice' => 0,
    'payment' => 0,
    'tax_excluded_display' => 0,
    'order_details' => 0,
    'bgcolor' => 0,
    'order_detail' => 0,
    'customizationPerAddress' => 0,
    'customization' => 0,
    'customization_infos' => 0,
    'HOOK_DISPLAY_PDF' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_55768922702f24_10638953',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55768922702f24_10638953')) {function content_55768922702f24_10638953($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/home/buyizy/public_html/tools/smarty/plugins/modifier.date_format.php';
if (!is_callable('smarty_function_cycle')) include '/home/buyizy/public_html/tools/smarty/plugins/function.cycle.php';
?>
<div style="font-size: 9pt; color: #444">

<table>
	<tr><td>&nbsp;</td></tr>
</table>

<!-- ADDRESSES -->
<table style="width: 100%; font-size: 13pt; color: #000;">
	<tr>
		<td style="width: 48%;"><span style="font-weight: bold;"><?php echo smartyTranslate(array('s'=>'Billing Address','pdf'=>'true'),$_smarty_tpl);?>
</span></td>
		<td style="width: 4%">&nbsp;</td>
		<td style="width: 48%;"><span style="font-weight: bold;"><?php echo smartyTranslate(array('s'=>'Delivery Address','pdf'=>'true'),$_smarty_tpl);?>
</span></td>
	</tr>
	<tr>
		<td style="height: 105px;"><br /><br /><?php if (empty($_smarty_tpl->tpl_vars['invoice_address']->value)) {?><?php echo $_smarty_tpl->tpl_vars['delivery_address']->value;?>
<?php } else { ?><?php echo $_smarty_tpl->tpl_vars['invoice_address']->value;?>
<?php }?></td>
		<td>&nbsp;</td>
		<td style="height: 105px;"><br /><br /><?php if (empty($_smarty_tpl->tpl_vars['delivery_address']->value)) {?><?php echo $_smarty_tpl->tpl_vars['invoice_address']->value;?>
<?php } else { ?><?php echo $_smarty_tpl->tpl_vars['delivery_address']->value;?>
<?php }?></td>
	</tr>
</table>
<!-- / ADDRESSES -->

<br /><br />

<table>
	<tr><td style="line-height: 8px">&nbsp;</td></tr>
</table>
<table style="width: 100%; text-align: center; border: 1px solid #CCC; font-size: 9pt;">
	<tr>
		<td style="width: 33%; background-color: #CCC; color: #000;">
			<b><?php echo smartyTranslate(array('s'=>'Order Reference:','pdf'=>'true'),$_smarty_tpl);?>
</b>
		</td>
		<td style="width: 33%; background-color: #CCC; color: #000;">
			<b><?php echo smartyTranslate(array('s'=>'Order Date:','pdf'=>'true'),$_smarty_tpl);?>
</b>
		</td>
		<td style="width: 34%; background-color: #CCC; color: #000;">
			<b><?php echo smartyTranslate(array('s'=>'Payment Method:','pdf'=>'true'),$_smarty_tpl);?>
</b>
		</td>
	</tr>
	<tr>
		<td style="width: 33%;">
			<?php echo $_smarty_tpl->tpl_vars['order']->value->getUniqReference();?>

		</td>
		<td style="width: 33%;">
			<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['order']->value->date_add,"%d-%m-%Y %H:%M");?>

		</td>
		<td style="width: 34%;">
			<?php  $_smarty_tpl->tpl_vars['payment'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['payment']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['order_invoice']->value->getOrderPaymentCollection(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['payment']->key => $_smarty_tpl->tpl_vars['payment']->value) {
$_smarty_tpl->tpl_vars['payment']->_loop = true;
?>
				<b><?php echo $_smarty_tpl->tpl_vars['payment']->value->payment_method;?>
</b> : <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('price'=>$_smarty_tpl->tpl_vars['payment']->value->amount,'currency'=>$_smarty_tpl->tpl_vars['order']->value->id_currency),$_smarty_tpl);?>

			<?php }
if (!$_smarty_tpl->tpl_vars['payment']->_loop) {
?>
				<?php echo smartyTranslate(array('s'=>'No payment','pdf'=>'true'),$_smarty_tpl);?>

			<?php } ?>
		</td>
	</tr>
</table>

<table>
	<tr><td style="line-height: 8px">&nbsp;</td></tr>
</table>

<!-- PRODUCTS TAB -->
<table style="width: 100%; font-size: 8pt;">
	<tr style="line-height:4px;">
		<!-- <td style="text-align: left; background-color: #CCC; color: #000; padding-left: 10px; font-weight: bold; width: 12%"><?php echo smartyTranslate(array('s'=>'Reference','pdf'=>'true'),$_smarty_tpl);?>
</td> -->
		<td style="text-align: left; background-color: #CCC; color: #000; padding-left: 10px; font-weight: bold; width: 75%"><?php echo smartyTranslate(array('s'=>'Product','pdf'=>'true'),$_smarty_tpl);?>
</td>
		<td style="background-color: #CCC; color: #000; text-align: center; font-weight: bold; width: 12.5%"><?php echo smartyTranslate(array('s'=>'Qty','pdf'=>'true'),$_smarty_tpl);?>
</td>
		<td style="background-color: #CCC; color: #000; text-align: right; font-weight: bold; width: 12.5%">
			<?php echo smartyTranslate(array('s'=>'Total','pdf'=>'true'),$_smarty_tpl);?>

			<?php if ($_smarty_tpl->tpl_vars['tax_excluded_display']->value) {?>
				<?php echo smartyTranslate(array('s'=>'(Tax Excl.)','pdf'=>'true'),$_smarty_tpl);?>

			<?php } else { ?>
				<?php echo smartyTranslate(array('s'=>'(Tax Incl.)','pdf'=>'true'),$_smarty_tpl);?>

			<?php }?>
		</td>
		
	</tr>
	<!-- PRODUCTS -->
	<?php  $_smarty_tpl->tpl_vars['order_detail'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['order_detail']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['order_details']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['order_detail']->key => $_smarty_tpl->tpl_vars['order_detail']->value) {
$_smarty_tpl->tpl_vars['order_detail']->_loop = true;
?>
	<?php echo smarty_function_cycle(array('values'=>'#FFF,#EEE','assign'=>'bgcolor'),$_smarty_tpl);?>

	<tr style="line-height:6px;background-color:<?php echo $_smarty_tpl->tpl_vars['bgcolor']->value;?>
;">
		<!-- <td style="text-align: center;">
			<?php if (!empty($_smarty_tpl->tpl_vars['order_detail']->value['product_reference'])) {?>
				<?php echo $_smarty_tpl->tpl_vars['order_detail']->value['product_reference'];?>

			<?php } else { ?>
				--
			<?php }?>
		</td> -->
		<td style="text-align: left;"><?php echo $_smarty_tpl->tpl_vars['order_detail']->value['product_name'];?>
</td>
		<td style="text-align: center;"><?php echo $_smarty_tpl->tpl_vars['order_detail']->value['product_quantity'];?>
</td><td style="text-align: right;">
		<?php if ($_smarty_tpl->tpl_vars['tax_excluded_display']->value) {?>
			<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('currency'=>$_smarty_tpl->tpl_vars['order']->value->id_currency,'price'=>$_smarty_tpl->tpl_vars['order_detail']->value['total_price_tax_excl']),$_smarty_tpl);?>

		<?php } else { ?>
			<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('currency'=>$_smarty_tpl->tpl_vars['order']->value->id_currency,'price'=>$_smarty_tpl->tpl_vars['order_detail']->value['total_price_tax_incl']),$_smarty_tpl);?>

		<?php }?>
		</td>
		
	</tr>
		<?php  $_smarty_tpl->tpl_vars['customizationPerAddress'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['customizationPerAddress']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['order_detail']->value['customizedDatas']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['customizationPerAddress']->key => $_smarty_tpl->tpl_vars['customizationPerAddress']->value) {
$_smarty_tpl->tpl_vars['customizationPerAddress']->_loop = true;
?>
			<?php  $_smarty_tpl->tpl_vars['customization'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['customization']->_loop = false;
 $_smarty_tpl->tpl_vars['customizationId'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['customizationPerAddress']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['customization']->key => $_smarty_tpl->tpl_vars['customization']->value) {
$_smarty_tpl->tpl_vars['customization']->_loop = true;
 $_smarty_tpl->tpl_vars['customizationId']->value = $_smarty_tpl->tpl_vars['customization']->key;
?>
				<tr style="line-height:6px;background-color:<?php echo $_smarty_tpl->tpl_vars['bgcolor']->value;?>
; ">
					<td style="line-height:3px; text-align: left; width: 60%; vertical-align: top">

							<blockquote>
								<?php if (isset($_smarty_tpl->tpl_vars['customization']->value['datas'][@constant('_CUSTOMIZE_TEXTFIELD_')])&&count($_smarty_tpl->tpl_vars['customization']->value['datas'][@constant('_CUSTOMIZE_TEXTFIELD_')])>0) {?>
									<?php  $_smarty_tpl->tpl_vars['customization_infos'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['customization_infos']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['customization']->value['datas'][@constant('_CUSTOMIZE_TEXTFIELD_')]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['customization_infos']->key => $_smarty_tpl->tpl_vars['customization_infos']->value) {
$_smarty_tpl->tpl_vars['customization_infos']->_loop = true;
?>
										<?php echo $_smarty_tpl->tpl_vars['customization_infos']->value['name'];?>
: <?php echo $_smarty_tpl->tpl_vars['customization_infos']->value['value'];?>

										<?php if (!$_smarty_tpl->getVariable('smarty')->value['foreach']['custo_foreach']['last']) {?><br />
										<?php } else { ?>
										<div style="line-height:0.4pt">&nbsp;</div>
										<?php }?>
									<?php } ?>
								<?php }?>

								<?php if (isset($_smarty_tpl->tpl_vars['customization']->value['datas'][@constant('_CUSTOMIZE_FILE_')])&&count($_smarty_tpl->tpl_vars['customization']->value['datas'][@constant('_CUSTOMIZE_FILE_')])>0) {?>
									<?php echo count($_smarty_tpl->tpl_vars['customization']->value['datas'][@constant('_CUSTOMIZE_FILE_')]);?>
 <?php echo smartyTranslate(array('s'=>'image(s)','pdf'=>'true'),$_smarty_tpl);?>

								<?php }?>
							</blockquote>
					</td>
					<td style="text-align: right; width: 15%"></td>
					<td style="text-align: center; width: 10%; vertical-align: top">(<?php echo $_smarty_tpl->tpl_vars['customization']->value['quantity'];?>
)</td>
					<td style="width: 15%; text-align: right;"></td>
				</tr>
			<?php } ?>
		<?php } ?>
	<?php } ?>
	<!-- END PRODUCTS -->


<table>
	<tr><td style="line-height: 8px">&nbsp;</td></tr>
</table>

<?php if (isset($_smarty_tpl->tpl_vars['HOOK_DISPLAY_PDF']->value)) {?>
	<div style="line-height: 1pt">&nbsp;</div>
	<table style="width: 100%">
		<tr>
			<td style="width: 15%"></td>
			<td style="width: 85%">
				<?php echo $_smarty_tpl->tpl_vars['HOOK_DISPLAY_PDF']->value;?>

			</td>
		</tr>
	</table>
<?php }?>

</div>

<?php }} ?>
