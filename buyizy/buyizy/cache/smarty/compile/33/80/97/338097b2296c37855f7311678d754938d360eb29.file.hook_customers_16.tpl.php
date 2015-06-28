<?php /* Smarty version Smarty-3.1.19, created on 2015-06-09 09:18:51
         compiled from "/home/buyizy/public_html/modules/referralprogram/views/templates/hook/hook_customers_16.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12951658665573f99a659649-18095722%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '338097b2296c37855f7311678d754938d360eb29' => 
    array (
      0 => '/home/buyizy/public_html/modules/referralprogram/views/templates/hook/hook_customers_16.tpl',
      1 => 1433787590,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12951658665573f99a659649-18095722',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5573f99a8dd8d5_53662112',
  'variables' => 
  array (
    'friends' => 0,
    'sponsor' => 0,
    'token' => 0,
    'key' => 0,
    'friend' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5573f99a8dd8d5_53662112')) {function content_5573f99a8dd8d5_53662112($_smarty_tpl) {?>
<div class="col-lg-12">
	<div class="panel">
		<div class="panel-heading"><?php echo smartyTranslate(array('s'=>'Referral program','mod'=>'referralprogram'),$_smarty_tpl);?>
 <span class="badge"><?php echo intval(count($_smarty_tpl->tpl_vars['friends']->value));?>
</span></div>
		<div class="panel-heading"><?php if (isset($_smarty_tpl->tpl_vars['sponsor']->value)) {?><?php echo smartyTranslate(array('s'=>'Customer\'s sponsor:','mod'=>'referralprogram'),$_smarty_tpl);?>
&nbsp;<a href="index.php?tab=AdminCustomers&amp;id_customer=<?php echo $_smarty_tpl->tpl_vars['sponsor']->value->id;?>
&amp;viewcustomer&amp;token=<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['sponsor']->value->firstname;?>
 <?php echo $_smarty_tpl->tpl_vars['sponsor']->value->lastname;?>
</a><?php } else { ?><?php echo smartyTranslate(array('s'=>'No one has sponsored this customer.','mod'=>'referralprogram'),$_smarty_tpl);?>
<?php }?></div>
		<div class="panel-heading"><span class="badge"><?php echo intval(count($_smarty_tpl->tpl_vars['friends']->value));?>
</span> <?php if (count($_smarty_tpl->tpl_vars['friends']->value)>1) {?><?php echo smartyTranslate(array('s'=>'Sponsored customers:','mod'=>'referralprogram'),$_smarty_tpl);?>
<?php } else { ?><?php echo smartyTranslate(array('s'=>'Sponsored customer:','mod'=>'referralprogram'),$_smarty_tpl);?>
<?php }?></div>
		<table class="table">
			<thead>
				<tr>
					<th><span class="title_box"><?php echo smartyTranslate(array('s'=>'ID','mod'=>'referralprogram'),$_smarty_tpl);?>
</span></th>
					<th><span class="title_box"><?php echo smartyTranslate(array('s'=>'Name','mod'=>'referralprogram'),$_smarty_tpl);?>
</span></th>
					<th><span class="title_box"><?php echo smartyTranslate(array('s'=>'Email','mod'=>'referralprogram'),$_smarty_tpl);?>
</span></th>
					<th><span class="title_box"><?php echo smartyTranslate(array('s'=>'Registration date','mod'=>'referralprogram'),$_smarty_tpl);?>
</span></th>
					<th><span class="title_box"><?php echo smartyTranslate(array('s'=>'Customers sponsored by this friend','mod'=>'referralprogram'),$_smarty_tpl);?>
</span></th>
					<th><span class="title_box"><?php echo smartyTranslate(array('s'=>'Placed orders','mod'=>'referralprogram'),$_smarty_tpl);?>
</span></th>
					<th><span class="title_box"><?php echo smartyTranslate(array('s'=>'Customer account created','mod'=>'referralprogram'),$_smarty_tpl);?>
</span></th>
				</tr>
			</thead>
			<tbody>
				<?php  $_smarty_tpl->tpl_vars['friend'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['friend']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['friends']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['friend']->key => $_smarty_tpl->tpl_vars['friend']->value) {
$_smarty_tpl->tpl_vars['friend']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['friend']->key;
?>
				<tr<?php if ($_smarty_tpl->tpl_vars['key']->value++%2) {?> class="alt_row"<?php }?><?php if ($_smarty_tpl->tpl_vars['friend']->value['id_customer']) {?> onclick="document.location='?controller=AdminCustomers&amp;id_customer=<?php echo intval($_smarty_tpl->tpl_vars['friend']->value['id_customer']);?>
&amp;viewcustomer&amp;token=<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
'"<?php }?>>
					<td><?php if ($_smarty_tpl->tpl_vars['friend']->value['id_customer']) {?><?php echo $_smarty_tpl->tpl_vars['friend']->value['id_customer'];?>
<?php } else { ?>--<?php }?></td>
					<td><?php echo $_smarty_tpl->tpl_vars['friend']->value['firstname'];?>
 <?php echo $_smarty_tpl->tpl_vars['friend']->value['lastname'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['friend']->value['email'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['friend']->value['date_add'];?>
</td>
					<td><?php echo intval($_smarty_tpl->tpl_vars['friend']->value['sponsored_friend_count']);?>
</td>
					<td><?php echo intval($_smarty_tpl->tpl_vars['friend']->value['orders_count']);?>
</td>
					<td><?php if ($_smarty_tpl->tpl_vars['friend']->value['id_customer']) {?><i class="icon-check list-action-enable action-enabled"></i><?php } else { ?><i class="icon-remove list-action-enable action-disabled"></i><?php }?></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<?php }} ?>
