<?php /* Smarty version Smarty-3.1.19, created on 2015-06-09 12:05:14
         compiled from "/home/buyizy/public_html/pdf//header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1459862513557689224dfc30-14770803%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cc10f7b39ecd95e4bab726275fc69e5bc74d0bb1' => 
    array (
      0 => '/home/buyizy/public_html/pdf//header.tpl',
      1 => 1421599059,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1459862513557689224dfc30-14770803',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'logo_path' => 0,
    'shop_name' => 0,
    'date' => 0,
    'title' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_55768922553266_25015656',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55768922553266_25015656')) {function content_55768922553266_25015656($_smarty_tpl) {?><br /><br />
<table style="width: 100%">
<tr>
	<td style="width: 50%">
		<?php if ($_smarty_tpl->tpl_vars['logo_path']->value) {?>
			<img src="<?php echo $_smarty_tpl->tpl_vars['logo_path']->value;?>
" style="height:55px;" />
		<?php }?>
	</td>
	<td style="width: 50%; text-align: right;">
		<table style="width: 100%">
			<tr>
				<td style="font-weight: bold; font-size: 14pt; color: #444; width: 100%"><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['shop_name']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</td>
			</tr>
			<tr>
				<td style="font-size: 14pt; color: #9E9F9E"><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['date']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</td>
			</tr>
			<tr>
				<td style="font-size: 14pt; color: #9E9F9E"><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['title']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</td>
			</tr>
		</table>
	</td>
</tr>
</table><?php }} ?>
