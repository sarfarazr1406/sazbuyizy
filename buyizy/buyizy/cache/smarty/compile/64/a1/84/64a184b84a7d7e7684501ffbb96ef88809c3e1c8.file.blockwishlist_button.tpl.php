<?php /* Smarty version Smarty-3.1.19, created on 2015-06-07 11:34:35
         compiled from "/home/buyizy/public_html/themes/default-bootstrap/modules/blockwishlist/blockwishlist_button.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17219905825573def3861244-92118586%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '64a184b84a7d7e7684501ffbb96ef88809c3e1c8' => 
    array (
      0 => '/home/buyizy/public_html/themes/default-bootstrap/modules/blockwishlist/blockwishlist_button.tpl',
      1 => 1428050813,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17219905825573def3861244-92118586',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'product' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5573def38764b7_45407270',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5573def38764b7_45407270')) {function content_5573def38764b7_45407270($_smarty_tpl) {?>

<div class="wishlist">
	<a class="addToWishlist wishlistProd_<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
" href="#" rel="<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
" onclick="WishlistCart('wishlist_block_list', 'add', '<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
', false, 1); return false;">
		<?php echo smartyTranslate(array('s'=>"Add to Wishlist",'mod'=>'blockwishlist'),$_smarty_tpl);?>

	</a>
</div><?php }} ?>
