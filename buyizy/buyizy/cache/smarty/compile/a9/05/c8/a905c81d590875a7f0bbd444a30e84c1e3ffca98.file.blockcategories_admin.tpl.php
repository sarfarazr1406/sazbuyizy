<?php /* Smarty version Smarty-3.1.19, created on 2015-06-07 21:52:41
         compiled from "/home/buyizy/public_html/modules/blockcategories/views/blockcategories_admin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:137522470955746fd1241e54-81548152%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a905c81d590875a7f0bbd444a30e84c1e3ffca98' => 
    array (
      0 => '/home/buyizy/public_html/modules/blockcategories/views/blockcategories_admin.tpl',
      1 => 1416031500,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '137522470955746fd1241e54-81548152',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'helper' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_55746fd1378262_27738496',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55746fd1378262_27738496')) {function content_55746fd1378262_27738496($_smarty_tpl) {?>
<div class="form-group">
	<label class="control-label col-lg-3">
		<span class="label-tooltip" data-toggle="tooltip" data-html="true" title="" data-original-title="<?php echo smartyTranslate(array('s'=>'You can upload a maximum of 3 images.','mod'=>'blockcategories'),$_smarty_tpl);?>
">
			<?php echo smartyTranslate(array('s'=>'Thumbnails','mod'=>'blockcategories'),$_smarty_tpl);?>

		</span>
	</label>
	<div class="col-lg-4">
		<?php echo $_smarty_tpl->tpl_vars['helper']->value;?>

	</div>
</div>
<?php }} ?>
