<?php /* Smarty version Smarty-3.1.19, created on 2015-06-09 12:05:14
         compiled from "/home/buyizy/public_html/pdf//footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:73124046655768922568bc2-76303034%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8a8825b978c30cf279416c6e31272fade037a71f' => 
    array (
      0 => '/home/buyizy/public_html/pdf//footer.tpl',
      1 => 1421599057,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '73124046655768922568bc2-76303034',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'available_in_your_account' => 0,
    'shop_address' => 0,
    'shop_details' => 0,
    'shop_phone' => 0,
    'shop_fax' => 0,
    'free_text' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_557689225d81a3_47277253',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_557689225d81a3_47277253')) {function content_557689225d81a3_47277253($_smarty_tpl) {?><table>
	<tr>
		<td style="text-align: center; font-size: 6pt; color: #444">
            <?php if ($_smarty_tpl->tpl_vars['available_in_your_account']->value) {?>
                <?php echo smartyTranslate(array('s'=>'An electronic version of this invoice is available in your account. To access it, log in to our website using your e-mail address and password (which you created when placing your first order).','pdf'=>'true'),$_smarty_tpl);?>
             
    			<br />
            <?php }?>
			<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['shop_address']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>

            
            <?php if (isset($_smarty_tpl->tpl_vars['shop_details']->value)) {?>
                - <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['shop_details']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<br />
			<?php } else { ?>
				<br />
            <?php }?>
			
			<?php if (!empty($_smarty_tpl->tpl_vars['shop_phone']->value)||!empty($_smarty_tpl->tpl_vars['shop_fax']->value)) {?>
				<?php echo smartyTranslate(array('s'=>'For more assistance, contact Support:','pdf'=>'true'),$_smarty_tpl);?>

				<?php if (!empty($_smarty_tpl->tpl_vars['shop_phone']->value)) {?>
					Tel: <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['shop_phone']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>

				<?php }?>
				<?php if (!empty($_smarty_tpl->tpl_vars['shop_fax']->value)) {?>
					Fax: <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['shop_fax']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>

				<?php }?>
			<?php }?>

            <?php if (isset($_smarty_tpl->tpl_vars['free_text']->value)) {?>
    			<br /><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['free_text']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>

            <?php }?>
		</td>
	</tr>
</table><?php }} ?>
