<?php /* Smarty version Smarty-3.1.19, created on 2015-06-19 12:39:49
         compiled from "/home/buyizy/public_html/modules/affinityitems//views/templates/hook/16/hrecommendation.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6962397245583c03d857e84-52522908%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a3c9b2e69fde23d64bac830ef382006ee213f705' => 
    array (
      0 => '/home/buyizy/public_html/modules/affinityitems//views/templates/hook/16/hrecommendation.tpl',
      1 => 1417109329,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6962397245583c03d857e84-52522908',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'page_name' => 0,
    'recommendations' => 0,
    'reco' => 0,
    'nbLi' => 0,
    'nbItemsPerLine' => 0,
    'nbItemsPerLineTablet' => 0,
    'id' => 0,
    'class' => 0,
    'active' => 0,
    'nbItemsPerLineMobile' => 0,
    'totModulo' => 0,
    'totModuloTablet' => 0,
    'totModuloMobile' => 0,
    'product' => 0,
    'link' => 0,
    'PS_CATALOG_MODE' => 0,
    'restricted_country_mode' => 0,
    'priceDisplay' => 0,
    'static_token' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5583c03dd4ee14_82703013',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5583c03dd4ee14_82703013')) {function content_5583c03dd4ee14_82703013($_smarty_tpl) {?><?php if (!is_callable('smarty_function_math')) include '/home/buyizy/public_html/tools/smarty/plugins/function.math.php';
?>
	<?php if (!isset($_smarty_tpl->tpl_vars['page_name']->value)) {?> <?php $_smarty_tpl->tpl_vars['page_name'] = new Smarty_variable('preview', null, 0);?> <?php }?>

	<?php  $_smarty_tpl->tpl_vars['reco'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['reco']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['recommendations']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['reco']->key => $_smarty_tpl->tpl_vars['reco']->value) {
$_smarty_tpl->tpl_vars['reco']->_loop = true;
?>

	<?php $_smarty_tpl->tpl_vars['nbItemsPerLine'] = new Smarty_variable($_smarty_tpl->tpl_vars['reco']->value['theme']['productNumberOnLine'], null, 0);?>
	<?php $_smarty_tpl->tpl_vars['nbItemsPerLineTablet'] = new Smarty_variable($_smarty_tpl->tpl_vars['reco']->value['theme']['productNumberOnLine'], null, 0);?>
	<?php $_smarty_tpl->tpl_vars['nbItemsPerLineMobile'] = new Smarty_variable($_smarty_tpl->tpl_vars['reco']->value['theme']['productNumberOnLine'], null, 0);?>

	<?php $_smarty_tpl->tpl_vars['nbLi'] = new Smarty_variable(count($_smarty_tpl->tpl_vars['reco']->value['aeproducts']), null, 0);?>
	<?php echo smarty_function_math(array('equation'=>"nbLi/nbItemsPerLine",'nbLi'=>$_smarty_tpl->tpl_vars['nbLi']->value,'nbItemsPerLine'=>$_smarty_tpl->tpl_vars['nbItemsPerLine']->value,'assign'=>'nbLines'),$_smarty_tpl);?>

	<?php echo smarty_function_math(array('equation'=>"nbLi/nbItemsPerLineTablet",'nbLi'=>$_smarty_tpl->tpl_vars['nbLi']->value,'nbItemsPerLineTablet'=>$_smarty_tpl->tpl_vars['nbItemsPerLineTablet']->value,'assign'=>'nbLinesTablet'),$_smarty_tpl);?>


	<?php if (isset($_smarty_tpl->tpl_vars['reco']->value['aeproducts'])&&$_smarty_tpl->tpl_vars['reco']->value['aeproducts']) {?>

	<?php if (isset($_smarty_tpl->tpl_vars['reco']->value['configuration'])) {?><div class="ae-area ae-<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['reco']->value['configuration']->area, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"><?php }?>

	<div <?php if ($_smarty_tpl->tpl_vars['reco']->value['theme']['backgroundDisplayOptions']) {?> style="<?php if (!$_smarty_tpl->tpl_vars['reco']->value['theme']['backgroundColorTransparent']) {?>background-color: <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['reco']->value['theme']['backgroundColor'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
;<?php }?> border: <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['reco']->value['theme']['backgroundBorderSize'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
px solid <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['reco']->value['theme']['backgroundBorderColor'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
; border-radius: <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['reco']->value['theme']['backgroundBorderRoundedSize'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
px" <?php }?> id="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['reco']->value['theme']['backgroundProductsBlockId'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" class="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['reco']->value['theme']['backgroundProductsBlockClass'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
">
		<?php if ($_smarty_tpl->tpl_vars['reco']->value['theme']['titleActivation']) {?><h4 <?php if ($_smarty_tpl->tpl_vars['reco']->value['theme']['titleDisplayOptions']) {?> style="color: <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['reco']->value['theme']['titleColor'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
; font-size: <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['reco']->value['theme']['titleSize'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
px; border: <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['reco']->value['theme']['titleBorderSize'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
px solid <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['reco']->value['theme']['titleBorderColor'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
; border-radius: <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['reco']->value['theme']['titleBorderRoundedSize'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
px; <?php if (!$_smarty_tpl->tpl_vars['reco']->value['theme']['titleBackgroundColorTransparent']) {?>background-color: <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['reco']->value['theme']['titleBackgroundColor'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
; text-align: <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['reco']->value['theme']['titleAlign'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
; line-height: <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['reco']->value['theme']['titleLineHeight'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
px; <?php }?>"<?php }?> class="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['reco']->value['theme']['titleClass'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"><?php if (isset($_smarty_tpl->tpl_vars['reco']->value['titleZone'])) {?> <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['reco']->value['titleZone'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
 <?php } else { ?> <?php echo smartyTranslate(array('s'=>'We recommend','mod'=>'affinityitems'),$_smarty_tpl);?>
 <?php }?></h4><?php }?>
		<div id="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['reco']->value['theme']['backgroundContentId'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" class="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['reco']->value['theme']['backgroundContentClass'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
">

			<ul<?php if (isset($_smarty_tpl->tpl_vars['id']->value)&&$_smarty_tpl->tpl_vars['id']->value) {?> id="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
"<?php }?> id="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['reco']->value['theme']['backgroundListId'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" class="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['reco']->value['theme']['backgroundListClass'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
 <?php if (isset($_smarty_tpl->tpl_vars['class']->value)&&$_smarty_tpl->tpl_vars['class']->value) {?> <?php echo $_smarty_tpl->tpl_vars['class']->value;?>
<?php }?><?php if (isset($_smarty_tpl->tpl_vars['active']->value)&&$_smarty_tpl->tpl_vars['active']->value==1) {?> active<?php }?>">
			<?php  $_smarty_tpl->tpl_vars['product'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['product']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['reco']->value['aeproducts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['product']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['aeproducts']['total'] = $_smarty_tpl->tpl_vars['product']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['aeproducts']['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['product']->key => $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['aeproducts']['iteration']++;
?>
			<?php echo smarty_function_math(array('equation'=>"(total%perLine)",'total'=>$_smarty_tpl->getVariable('smarty')->value['foreach']['aeproducts']['total'],'perLine'=>$_smarty_tpl->tpl_vars['nbItemsPerLine']->value,'assign'=>'totModulo'),$_smarty_tpl);?>

			<?php echo smarty_function_math(array('equation'=>"(total%perLineT)",'total'=>$_smarty_tpl->getVariable('smarty')->value['foreach']['aeproducts']['total'],'perLineT'=>$_smarty_tpl->tpl_vars['nbItemsPerLineTablet']->value,'assign'=>'totModuloTablet'),$_smarty_tpl);?>

			<?php echo smarty_function_math(array('equation'=>"(total%perLineT)",'total'=>$_smarty_tpl->getVariable('smarty')->value['foreach']['aeproducts']['total'],'perLineT'=>$_smarty_tpl->tpl_vars['nbItemsPerLineMobile']->value,'assign'=>'totModuloMobile'),$_smarty_tpl);?>

			<?php if ($_smarty_tpl->tpl_vars['totModulo']->value==0) {?><?php $_smarty_tpl->tpl_vars['totModulo'] = new Smarty_variable($_smarty_tpl->tpl_vars['nbItemsPerLine']->value, null, 0);?><?php }?>
			<?php if ($_smarty_tpl->tpl_vars['totModuloTablet']->value==0) {?><?php $_smarty_tpl->tpl_vars['totModuloTablet'] = new Smarty_variable($_smarty_tpl->tpl_vars['nbItemsPerLineTablet']->value, null, 0);?><?php }?>
			<?php if ($_smarty_tpl->tpl_vars['totModuloMobile']->value==0) {?><?php $_smarty_tpl->tpl_vars['totModuloMobile'] = new Smarty_variable($_smarty_tpl->tpl_vars['nbItemsPerLineMobile']->value, null, 0);?><?php }?>
			<li <?php if ($_smarty_tpl->tpl_vars['reco']->value['theme']['productDisplayOptions']) {?> style="height: <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['reco']->value['theme']['productHeight'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
px; width: <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['reco']->value['theme']['productWidth'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
px;<?php if (!$_smarty_tpl->tpl_vars['reco']->value['theme']['productBackgroundColorTransparent']) {?> background-color: <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['reco']->value['theme']['productBackgroundColor'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
;<?php }?> border: <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['reco']->value['theme']['productBorderSize'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
px solid <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['reco']->value['theme']['productBorderColor'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
;<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['aeproducts']['iteration']%$_smarty_tpl->tpl_vars['nbItemsPerLine']->value!=0) {?> margin-right: <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['reco']->value['theme']['productMarginRight'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
px;<?php }?> border-radius: <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['reco']->value['theme']['productBorderRoundedSize'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
px;" <?php }?> id="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['reco']->value['theme']['productId'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" class="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['reco']->value['theme']['productClass'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
 <?php if ($_smarty_tpl->tpl_vars['page_name']->value=='index'||$_smarty_tpl->tpl_vars['page_name']->value=='product') {?> col-xs-12 col-sm-4 col-md-3<?php } else { ?> col-xs-12 col-sm-6 col-md-4<?php }?><?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['aeproducts']['iteration']%$_smarty_tpl->tpl_vars['nbItemsPerLine']->value==0) {?> last-in-line<?php } elseif ($_smarty_tpl->getVariable('smarty')->value['foreach']['aeproducts']['iteration']%$_smarty_tpl->tpl_vars['nbItemsPerLine']->value==1) {?> first-in-line<?php }?><?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['aeproducts']['iteration']>($_smarty_tpl->getVariable('smarty')->value['foreach']['aeproducts']['total']-$_smarty_tpl->tpl_vars['totModulo']->value)) {?> last-line<?php }?><?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['aeproducts']['iteration']%$_smarty_tpl->tpl_vars['nbItemsPerLineTablet']->value==0) {?> last-item-of-tablet-line<?php } elseif ($_smarty_tpl->getVariable('smarty')->value['foreach']['aeproducts']['iteration']%$_smarty_tpl->tpl_vars['nbItemsPerLineTablet']->value==1) {?> first-item-of-tablet-line<?php }?><?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['aeproducts']['iteration']%$_smarty_tpl->tpl_vars['nbItemsPerLineMobile']->value==0) {?> last-item-of-mobile-line<?php } elseif ($_smarty_tpl->getVariable('smarty')->value['foreach']['aeproducts']['iteration']%$_smarty_tpl->tpl_vars['nbItemsPerLineMobile']->value==1) {?> first-item-of-mobile-line<?php }?><?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['aeproducts']['iteration']>($_smarty_tpl->getVariable('smarty')->value['foreach']['aeproducts']['total']-$_smarty_tpl->tpl_vars['totModuloMobile']->value)) {?> last-mobile-line<?php }?>">
				<div id="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['reco']->value['theme']['productContainerId'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" class="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['reco']->value['theme']['productContainerClass'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" itemscope itemtype="http://schema.org/Product">
					<div id="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['reco']->value['theme']['productLeftBlockId'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" class="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['reco']->value['theme']['productLeftBlockClass'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
">
						<div class="product-image-container">
							<a rel="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['id_product'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" class="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['reco']->value['theme']['pictureLinkClass'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" id="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['reco']->value['theme']['pictureLinkId'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['link'], ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
" itemprop="url">
								<img id="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['reco']->value['theme']['pictureId'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" class="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['reco']->value['theme']['pictureClass'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['reco']->value['theme']['pictureDisplayOptions']) {?> style="border: <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['reco']->value['theme']['pictureBorderSize'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
px solid <?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['pictureBorderColor'];?>
; border-radius: <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['reco']->value['theme']['pictureBorderRoundedSize'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
px;" <?php }?> src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getImageLink($_smarty_tpl->tpl_vars['product']->value['link_rewrite'],$_smarty_tpl->tpl_vars['product']->value['id_image'],$_smarty_tpl->tpl_vars['reco']->value['theme']['pictureResolution']), ENT_QUOTES, 'UTF-8', true);?>
" alt="<?php if (!empty($_smarty_tpl->tpl_vars['product']->value['legend'])) {?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['legend'], ENT_QUOTES, 'UTF-8', true);?>
<?php } else { ?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
<?php }?>" title="<?php if (!empty($_smarty_tpl->tpl_vars['product']->value['legend'])) {?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['legend'], ENT_QUOTES, 'UTF-8', true);?>
<?php } else { ?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
<?php }?>" height="<?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['pictureHeight'];?>
" width="<?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['pictureWidth'];?>
" itemprop="image" />
							</a>
						</div>
					</div>
					<div id="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['reco']->value['theme']['productRightBlockId'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" class="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['reco']->value['theme']['productRightBlockClass'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
">
						<?php if ($_smarty_tpl->tpl_vars['reco']->value['theme']['productTitleActivation']) {?>
						<h5 <?php if ($_smarty_tpl->tpl_vars['reco']->value['theme']['productTitleDisplayOptions']) {?> style="height: <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['reco']->value['theme']['productTitleHeight'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
px" <?php }?> class="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['reco']->value['theme']['productTitleClass'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" id="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['reco']->value['theme']['productTitleId'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" itemprop="name">
							<?php if (isset($_smarty_tpl->tpl_vars['product']->value['pack_quantity'])&&$_smarty_tpl->tpl_vars['product']->value['pack_quantity']) {?><?php echo (intval($_smarty_tpl->tpl_vars['product']->value['pack_quantity'])).(' x ');?>
<?php }?>
							<a rel="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['id_product'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['reco']->value['theme']['productTitleDisplayOptions']) {?> style="color:<?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['productTitleColor'];?>
;font-size: <?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['productTitleSize'];?>
px;text-align: <?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['productTitleAlign'];?>
; line-height: <?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['productTitleLineHeight'];?>
px;"<?php }?> id="<?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['productLinkTitleId'];?>
" class="<?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['productLinkTitleClass'];?>
" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['link'], ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
" itemprop="url" >
								<?php echo htmlspecialchars($_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['truncate'][0][0]->smarty_modifier_truncate($_smarty_tpl->tpl_vars['product']->value['name'],45,'...'), ENT_QUOTES, 'UTF-8', true);?>

							</a>
						</h5>
						<?php }?>
						<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>'displayProductListReviews','product'=>$_smarty_tpl->tpl_vars['product']->value),$_smarty_tpl);?>

						<?php if ($_smarty_tpl->tpl_vars['reco']->value['theme']['productDescriptionActivation']) {?>
						<p <?php if ($_smarty_tpl->tpl_vars['reco']->value['theme']['productDescriptionDisplayOptions']) {?> style="height: <?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['productDescriptionHeight'];?>
px;color:<?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['productDescriptionColor'];?>
;font-size: <?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['productDescriptionSize'];?>
px; text-align: <?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['productDescriptionAlign'];?>
; line-height: <?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['productDescriptionLineHeight'];?>
px;" <?php }?> id="<?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['productDescriptionId'];?>
" class="<?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['productDescriptionClass'];?>
" itemprop="description">
							<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['truncate'][0][0]->smarty_modifier_truncate(strip_tags($_smarty_tpl->tpl_vars['product']->value['description_short']),360,'...');?>

						</p>
						<?php }?>
						<?php if ($_smarty_tpl->tpl_vars['reco']->value['theme']['priceActivation']) {?>
						<?php if ((!$_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value&&((isset($_smarty_tpl->tpl_vars['product']->value['show_price'])&&$_smarty_tpl->tpl_vars['product']->value['show_price'])||(isset($_smarty_tpl->tpl_vars['product']->value['available_for_order'])&&$_smarty_tpl->tpl_vars['product']->value['available_for_order'])))) {?>
						<div id="<?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['priceContainerId'];?>
" class="<?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['priceContainerClass'];?>
" <?php if ($_smarty_tpl->tpl_vars['reco']->value['theme']['priceDisplayOptions']) {?> style="height: <?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['priceHeight'];?>
px" <?php }?> itemprop="offers" itemscope itemtype="http://schema.org/Offer">
							<?php if (isset($_smarty_tpl->tpl_vars['product']->value['show_price'])&&$_smarty_tpl->tpl_vars['product']->value['show_price']&&!isset($_smarty_tpl->tpl_vars['restricted_country_mode']->value)) {?>
							<span itemprop="price" id="<?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['priceId'];?>
" class="<?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['priceClass'];?>
" <?php if ($_smarty_tpl->tpl_vars['reco']->value['theme']['priceDisplayOptions']) {?> style="color: <?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['priceColor'];?>
; font-size: <?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['priceSize'];?>
px;" <?php }?>>
								<?php if (!$_smarty_tpl->tpl_vars['priceDisplay']->value) {?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0][0]->convertPrice(array('price'=>$_smarty_tpl->tpl_vars['product']->value['price']),$_smarty_tpl);?>
<?php } else { ?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0][0]->convertPrice(array('price'=>$_smarty_tpl->tpl_vars['product']->value['price_tax_exc']),$_smarty_tpl);?>
<?php }?>
							</span>
							<meta itemprop="priceCurrency" content="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['priceDisplay']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" />
							<?php if (isset($_smarty_tpl->tpl_vars['product']->value['specific_prices'])&&$_smarty_tpl->tpl_vars['product']->value['specific_prices']&&isset($_smarty_tpl->tpl_vars['product']->value['specific_prices']['reduction'])&&$_smarty_tpl->tpl_vars['product']->value['specific_prices']['reduction']>0) {?>
							<span id="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['reco']->value['theme']['oldPriceId'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" class="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['reco']->value['theme']['oldPriceClass'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
">
								<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPrice'][0][0]->displayWtPrice(array('p'=>$_smarty_tpl->tpl_vars['product']->value['price_without_reduction']),$_smarty_tpl);?>

							</span>
							<?php if ($_smarty_tpl->tpl_vars['product']->value['specific_prices']['reduction_type']=='percentage') {?>
							<span id="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['reco']->value['theme']['priceReductionId'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" class="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['reco']->value['theme']['priceReductionClass'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
">-<?php echo $_smarty_tpl->tpl_vars['product']->value['specific_prices']['reduction']*100;?>
%</span>
							<?php }?>
							<?php }?>
							<?php }?>
						</div>
						<?php }?>
						<?php }?>
						<div class="button-container">
							<?php if ($_smarty_tpl->tpl_vars['product']->value['available_for_order']&&!isset($_smarty_tpl->tpl_vars['restricted_country_mode']->value)&&$_smarty_tpl->tpl_vars['product']->value['minimal_quantity']<=1&&$_smarty_tpl->tpl_vars['product']->value['customizable']!=2&&!$_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value) {?>
							<?php if (($_smarty_tpl->tpl_vars['product']->value['allow_oosp']||$_smarty_tpl->tpl_vars['product']->value['quantity']>0)) {?>
							<?php if (isset($_smarty_tpl->tpl_vars['static_token']->value)) {?>
							<?php if ($_smarty_tpl->tpl_vars['reco']->value['theme']['cartActivation']) {?>
							<a rel="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['id_product'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['reco']->value['theme']['cartDisplayOptions']) {?> style="color: <?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['cartColor'];?>
; border-radius: <?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['cartBorderRoundedSize'];?>
px !important; font-size: <?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['cartSize'];?>
px;  text-align: <?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['cartAlign'];?>
; line-height: <?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['cartLineHeight'];?>
px;" <?php }?> class="<?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['cartClass'];?>
" id="<?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['cartId'];?>
" href="<?php ob_start();?><?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
<?php $_tmp25=ob_get_clean();?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('cart',false,null,"add=1&amp;id_product=".$_tmp25."&amp;token=".((string)$_smarty_tpl->tpl_vars['static_token']->value),false), ENT_QUOTES, 'UTF-8', true);?>
" rel="nofollow" title="<?php echo smartyTranslate(array('s'=>'Add to cart','mod'=>'affinityitems'),$_smarty_tpl);?>
" data-id-product="<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
">
								<span <?php if ($_smarty_tpl->tpl_vars['reco']->value['theme']['cartDisplayOptions']) {?> style="color: <?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['cartColor'];?>
; border: <?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['cartBorderSize'];?>
px solid <?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['cartBorderColor'];?>
; border-radius: <?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['cartBorderRoundedSize'];?>
px !important; <?php if (!$_smarty_tpl->tpl_vars['reco']->value['theme']['cartBackgroundColorTransparent']) {?> background: <?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['cartBackgroundColor'];?>
;<?php }?> font-size: <?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['cartSize'];?>
px;  text-align: <?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['cartAlign'];?>
; line-height: <?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['cartLineHeight'];?>
px;" <?php }?>><?php echo smartyTranslate(array('s'=>'Add to cart','mod'=>'affinityitems'),$_smarty_tpl);?>
</span>
							</a>
							<?php }?>
							<?php } else { ?>
							<?php if ($_smarty_tpl->tpl_vars['reco']->value['theme']['cartActivation']) {?>
							<a rel="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['id_product'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['reco']->value['theme']['cartDisplayOptions']) {?> style="color: <?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['cartColor'];?>
; border-radius: <?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['cartBorderRoundedSize'];?>
px !important; font-size: <?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['cartSize'];?>
px; text-align: <?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['cartAlign'];?>
; line-height: <?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['cartLineHeight'];?>
px;" <?php }?> class="<?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['cartClass'];?>
" id="<?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['cartId'];?>
"  href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('cart',false,null,'add=1&amp;id_product={$product.id_product|intval}',false), ENT_QUOTES, 'UTF-8', true);?>
" rel="nofollow" title="<?php echo smartyTranslate(array('s'=>'Add to cart','mod'=>'affinityitems'),$_smarty_tpl);?>
" data-id-product="<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
">
								<span <?php if ($_smarty_tpl->tpl_vars['reco']->value['theme']['cartDisplayOptions']) {?> style="color: <?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['cartColor'];?>
; border: <?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['cartBorderSize'];?>
px solid <?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['cartBorderColor'];?>
; border-radius: <?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['cartBorderRoundedSize'];?>
px !important;<?php if (!$_smarty_tpl->tpl_vars['reco']->value['theme']['cartBackgroundColorTransparent']) {?> background: <?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['cartBackgroundColor'];?>
;<?php }?> font-size: <?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['cartSize'];?>
px; text-align: <?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['cartAlign'];?>
; line-height: <?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['cartLineHeight'];?>
px;" <?php }?>><?php echo smartyTranslate(array('s'=>'Add to cart','mod'=>'affinityitems'),$_smarty_tpl);?>
</span>
							</a>
							<?php }?>
							<?php }?>						
							<?php } else { ?>
							<?php if ($_smarty_tpl->tpl_vars['reco']->value['theme']['cartActivation']) {?>
							<span <?php if ($_smarty_tpl->tpl_vars['reco']->value['theme']['cartDisplayOptions']) {?> style="color: <?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['cartColor'];?>
; border-radius: <?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['cartBorderRoundedSize'];?>
px !important; font-size: <?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['cartSize'];?>
px; text-align: <?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['cartAlign'];?>
; line-height: <?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['cartLineHeight'];?>
px;" <?php }?> class="<?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['cartClass'];?>
 disabled" id="<?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['cartId'];?>
">
								<span <?php if ($_smarty_tpl->tpl_vars['reco']->value['theme']['cartDisplayOptions']) {?> style="color: <?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['cartColor'];?>
; border: <?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['cartBorderSize'];?>
px solid <?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['cartBorderColor'];?>
; border-radius: <?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['cartBorderRoundedSize'];?>
px !important;<?php if (!$_smarty_tpl->tpl_vars['reco']->value['theme']['cartBackgroundColorTransparent']) {?> background: <?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['cartBackgroundColor'];?>
;<?php }?> font-size: <?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['cartSize'];?>
px; text-align: <?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['cartAlign'];?>
; line-height: <?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['cartLineHeight'];?>
px;" <?php }?>><?php echo smartyTranslate(array('s'=>'Add to cart','mod'=>'affinityitems'),$_smarty_tpl);?>
</span>
							</span>
							<?php }?>
							<?php }?>
							<?php }?>
							<?php if ($_smarty_tpl->tpl_vars['reco']->value['theme']['detailActivation']) {?>
							<a rel="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['id_product'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" itemprop="url" <?php if ($_smarty_tpl->tpl_vars['reco']->value['theme']['detailDisplayOptions']) {?> style="color: <?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['detailColor'];?>
; font-size: <?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['detailSize'];?>
px;" <?php }?> id="<?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['detailId'];?>
" class="<?php echo $_smarty_tpl->tpl_vars['reco']->value['theme']['detailClass'];?>
" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['link'], ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'View','mod'=>'affinityitems'),$_smarty_tpl);?>
">
								<span><?php echo smartyTranslate(array('s'=>'More','mod'=>'affinityitems'),$_smarty_tpl);?>
</span>
							</a>
							<?php }?>
						</div>
					</div>
				</li>
				<?php } ?>
			</ul>
		</div>
	</div>
	<?php if (isset($_smarty_tpl->tpl_vars['reco']->value['configuration'])) {?></div><?php }?>
	<?php }?>
	<?php } ?>

<?php }} ?>
