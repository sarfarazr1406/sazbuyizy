<?php /* Smarty version Smarty-3.1.19, created on 2015-06-07 11:32:46
         compiled from "/home/buyizy/public_html/admin3039/themes/default/template/content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:510073915573de86a12dc2-74884234%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ce818d72724d8f1523979ad5f94b5479c993d123' => 
    array (
      0 => '/home/buyizy/public_html/admin3039/themes/default/template/content.tpl',
      1 => 1416031498,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '510073915573de86a12dc2-74884234',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'content' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5573de86a1b5a5_96724303',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5573de86a1b5a5_96724303')) {function content_5573de86a1b5a5_96724303($_smarty_tpl) {?>
<div id="ajax_confirmation" class="alert alert-success hide"></div>

<div id="ajaxBox" style="display:none"></div>


<div class="row">
	<div class="col-lg-12">
		<?php if (isset($_smarty_tpl->tpl_vars['content']->value)) {?>
			<?php echo $_smarty_tpl->tpl_vars['content']->value;?>

		<?php }?>
	</div>
</div><?php }} ?>
