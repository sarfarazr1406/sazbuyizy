<?php /* Smarty version Smarty-3.1.19, created on 2015-06-19 12:39:49
         compiled from "/home/buyizy/public_html/modules/affinityitems//views/templates/admin/theme-editor.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16062821605583c03d4897e8-50538867%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2cde208f18880f51e9cf5a7dcb4d058617cc34af' => 
    array (
      0 => '/home/buyizy/public_html/modules/affinityitems//views/templates/admin/theme-editor.tpl',
      1 => 1417109329,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16062821605583c03d4897e8-50538867',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'baseUrl' => 0,
    'themeList' => 0,
    'theme' => 0,
    'themeSelected' => 0,
    'version' => 0,
    'imgSizeList' => 0,
    'size' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5583c03d83fba4_37038963',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5583c03d83fba4_37038963')) {function content_5583c03d83fba4_37038963($_smarty_tpl) {?>
	<div class="items-title">
		<?php echo smartyTranslate(array('s'=>'Theme editor','mod'=>'affinityitems'),$_smarty_tpl);?>

		<span class="visit"><a href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['baseUrl']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
?aeabtesting=A" target="_blank"><i class="fa fa-eye"></i> <?php echo smartyTranslate(array('s'=>'Display recommendation on your shop','mod'=>'affinityitems'),$_smarty_tpl);?>
</span></a>
	</div>
	<form action="#theme-editor" method="POST">
	<div class="items-theme-selector">
			<div class="items-register-theme items-left">
				<input type="text" class="items-new-theme-input" name="themeName" placeholder="Nom du thème">
				<input type="submit" value="Valider" class="items-button-plus">
			</div>
			<div class="items-theme-selector-content">
				<div class="items-left">
					<p><?php echo smartyTranslate(array('s'=>'Theme','mod'=>'affinityitems'),$_smarty_tpl);?>
 :</p><br>
				</div>
					<select name="themeId" id="themeSelector">
						<?php  $_smarty_tpl->tpl_vars['theme'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['theme']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['themeList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['theme']->key => $_smarty_tpl->tpl_vars['theme']->value) {
$_smarty_tpl->tpl_vars['theme']->_loop = true;
?>
						<option value="<?php echo $_smarty_tpl->tpl_vars['theme']->value['id_theme'];?>
" <?php if ($_smarty_tpl->tpl_vars['theme']->value['id_theme']==$_smarty_tpl->tpl_vars['themeSelected']->value['themeId']) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['theme']->value['name'];?>
</option>
						<?php } ?>
					</select>
					<input type="submit" class="items-button-submit items-theme-cancel" onClick="location.reload();return false;" value="<?php echo smartyTranslate(array('s'=>'Cancel','mod'=>'affinityitems'),$_smarty_tpl);?>
">
					<input type="submit" value="<?php echo smartyTranslate(array('s'=>'Save','mod'=>'affinityitems'),$_smarty_tpl);?>
" class="items-button-submit">
					<input type="submit" id="registerTheme" value="<?php echo smartyTranslate(array('s'=>'Save as','mod'=>'affinityitems'),$_smarty_tpl);?>
" class="items-button-submit">
			</div>
			<div class="clear"></div>
		</div>
		<div class="preview">
			<div class="toolbox">
				<div class="background-toolbox toolboxarea" style="display:none">
					<div class="items-config-title">
						<?php echo smartyTranslate(array('s'=>'Background','mod'=>'affinityitems'),$_smarty_tpl);?>

						<span toolbox="default" class="toolbox-button back">&#10550;</span>
						<hr>
					</div>
					<fieldset>
						<legend>
							<input type="hidden" name="backgroundDisplayOptions" value="0">
							<input type="checkbox" value="1" name="backgroundDisplayOptions" <?php if ($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['backgroundDisplayOptions']=="1") {?> checked="checked" <?php }?>>
							<span class="items-theme-zone-activation"><?php echo smartyTranslate(array('s'=>'Background Activation','mod'=>'affinityitems'),$_smarty_tpl);?>
</span>
						</legend>
						<div class="items-conf items-left">
							<label>	<?php echo smartyTranslate(array('s'=>'Background color','mod'=>'affinityitems'),$_smarty_tpl);?>
 :</label><br>
							<input name="backgroundColor" type="color" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['backgroundColor'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
						<div class="items-conf items-right">
							<label><?php echo smartyTranslate(array('s'=>'Transparent','mod'=>'affinityitems'),$_smarty_tpl);?>
 :</label>
							<input name="backgroundColorTransparent" type="hidden" value="0">
							<input name="backgroundColorTransparent" type="checkbox" value="1" <?php if ($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['backgroundColorTransparent']) {?> checked <?php }?>>
						</div>
						<div class="clear"></div>
						<div class="items-conf">
							<label><?php echo smartyTranslate(array('s'=>'Border color','mod'=>'affinityitems'),$_smarty_tpl);?>
 :</label><br>
							<input name="backgroundBorderColor" type="color" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['backgroundBorderColor'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
						<div class="items-conf">
							<label><?php echo smartyTranslate(array('s'=>'Round border','mod'=>'affinityitems'),$_smarty_tpl);?>
 :</label><br>
							<input name="backgroundBorderRoundedSize" type="number" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['backgroundBorderRoundedSize'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
						<div class="items-conf">
							<label><?php echo smartyTranslate(array('s'=>'Border size','mod'=>'affinityitems'),$_smarty_tpl);?>
 :</label><br>
							<input name="backgroundBorderSize" type="number" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['backgroundBorderSize'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
					</fieldset>
					<fieldset>
						<legend>CSS products bloc div</legend>
						<div class="items-conf">
							<label>id :</label><br>
							<input name="backgroundProductsBlockId" type="text" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['backgroundProductsBlockId'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
						<div class="items-conf">
							<label>class :</label><br>
							<input name="backgroundProductsBlockClass" type="text" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['backgroundProductsBlockClass'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
					</fieldset>
					<fieldset>
						<legend>CSS content div</legend>
						<div class="items-conf">
							<label>id :</label><br>
							<input name="backgroundContentId" type="text" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['backgroundContentId'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
						<div class="items-conf">
							<label>class :</label><br>
							<input name="backgroundContentClass" type="text" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['backgroundContentClass'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
					</fieldset>
					<fieldset>				
						<legend>CSS list div (ul)</legend>
						<div class="items-conf">
							<label>id :</label><br>
							<input name="backgroundListId" type="text" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['backgroundListId'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
						<div class="items-conf">
							<label>class :</label><br>
							<input name="backgroundListClass" type="text" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['backgroundListClass'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
					</fieldset>
				</div>
				<div class="title-toolbox toolboxarea" style="display:none">
					<div class="items-config-title">
						<?php echo smartyTranslate(array('s'=>'Title','mod'=>'affinityitems'),$_smarty_tpl);?>

						<span toolbox="default" class="toolbox-button back">&#10550;</span>
						<hr>
					</div>
					<hr>
					<fieldset>
						<legend> 
							<input type="hidden" name="titleDisplayOptions" value="0">
							<input type="checkbox" value="1" name="titleDisplayOptions" <?php if ($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['titleDisplayOptions']=="1") {?> checked="checked" <?php }?>>
							<span class="items-theme-zone-activation"><?php echo smartyTranslate(array('s'=>'Title Activation','mod'=>'affinityitems'),$_smarty_tpl);?>
</span>
						</legend>					
						<div class="items-conf">
							<label>	<?php echo smartyTranslate(array('s'=>'Text color','mod'=>'affinityitems'),$_smarty_tpl);?>
 :</label><br>
							<input name="titleColor" type="color" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['titleColor'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
						<div class="items-conf items-left">
							<label><?php echo smartyTranslate(array('s'=>'Background color','mod'=>'affinityitems'),$_smarty_tpl);?>
 :</label><br>
							<input name="titleBackgroundColor" type="color" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['titleBackgroundColor'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
						<div class="items-conf items-right">
							<label><?php echo smartyTranslate(array('s'=>'Transparent','mod'=>'affinityitems'),$_smarty_tpl);?>
 :</label> 
							<input name="titleBackgroundColorTransparent" type="hidden" value="0">
							<input name="titleBackgroundColorTransparent" type="checkbox" value="1" <?php if ($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['titleBackgroundColorTransparent']) {?> checked <?php }?>>
						</div>
						<div class="clear"></div>
						<div class="items-conf">
							<label><?php echo smartyTranslate(array('s'=>'Text size','mod'=>'affinityitems'),$_smarty_tpl);?>
 (px) :</label><br>
							<input name="titleSize" type="number" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['titleSize'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
						<div class="items-conf">
							<label><?php echo smartyTranslate(array('s'=>'Border color','mod'=>'affinityitems'),$_smarty_tpl);?>
 :</label><br>
							<input name="titleBorderColor" type="color" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['titleBorderColor'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
						<div class="items-conf">
							<label><?php echo smartyTranslate(array('s'=>'Round border','mod'=>'affinityitems'),$_smarty_tpl);?>
 :</label><br>
							<input name="titleBorderRoundedSize" type="number" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['titleBorderRoundedSize'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
						<div class="items-conf">
							<label><?php echo smartyTranslate(array('s'=>'Border size','mod'=>'affinityitems'),$_smarty_tpl);?>
 :</label><br>
							<input name="titleBorderSize" type="number" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['titleBorderSize'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
						<div class="items-conf">
							<label><?php echo smartyTranslate(array('s'=>'Text align','mod'=>'affinityitems'),$_smarty_tpl);?>
 :</label><br>
							<select name="titleAlign">
								<option value="left" <?php if ($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['titleAlign']=="left") {?> selected <?php }?>>Left</option>
								<option value="center" <?php if ($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['titleAlign']=="center") {?> selected <?php }?>>Center</option>
								<option value="right" <?php if ($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['titleAlign']=="right") {?> selected <?php }?>>Right</option>
							</select> 						
						</div>
						<div class="items-conf">
							<label><?php echo smartyTranslate(array('s'=>'Text Line height','mod'=>'affinityitems'),$_smarty_tpl);?>
 (px) :</label><br>
							<input name="titleLineHeight" type="number" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['titleLineHeight'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
					</fieldset>
					<fieldset>
						<legend>CSS <?php echo smartyTranslate(array('s'=>'Title','mod'=>'affinityitems'),$_smarty_tpl);?>
 </legend>
						<div class="items-conf">
							<label>id :</label><br>
							<input name="titleId" type="text"  value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['titleId'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
						<div class="items-conf">
							<label>class :</label><br>
							<input name="titleClass" type="text" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['titleClass'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
					</fieldset>
				</div>
				<div class="product-toolbox toolboxarea" style="display:none">
					<div class="items-config-title">
						<?php echo smartyTranslate(array('s'=>'Product','mod'=>'affinityitems'),$_smarty_tpl);?>

						<span toolbox="default" class="toolbox-button back">&#10550;</span>
						<hr>
					</div>
					<hr>
					<fieldset>				
						<legend>
							<input type="hidden" name="productDisplayOptions" value="0">
							<input type="checkbox" value="1" name="productDisplayOptions" <?php if ($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['productDisplayOptions']=="1") {?> checked="checked" <?php }?>>
							<span class="items-theme-zone-activation"><?php echo smartyTranslate(array('s'=>'Product Activation','mod'=>'affinityitems'),$_smarty_tpl);?>
</span>
						</legend>
						<div class="items-conf items-left">
							<label><?php echo smartyTranslate(array('s'=>'Background color','mod'=>'affinityitems'),$_smarty_tpl);?>
 :</label><br>
							<input name="productBackgroundColor" type="color" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['productBackgroundColor'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
						<div class="items-conf items-right">
							<label><?php echo smartyTranslate(array('s'=>'Transparent','mod'=>'affinityitems'),$_smarty_tpl);?>
</label>
							<input name="productBackgroundColorTransparent" type="hidden" value="0">
							<input name="productBackgroundColorTransparent" type="checkbox" value="1" <?php if ($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['productBackgroundColorTransparent']) {?> checked <?php }?>>
						</div>
						<div class="clear"></div>
						<div class="items-conf">
							<label><?php echo smartyTranslate(array('s'=>'Border color','mod'=>'affinityitems'),$_smarty_tpl);?>
 :</label><br>
							<input name="productBorderColor" type="color" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['productBorderColor'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
						<div class="items-conf">
							<label><?php echo smartyTranslate(array('s'=>'Round border','mod'=>'affinityitems'),$_smarty_tpl);?>
 :</label><br>
							<input name="productBorderRoundedSize" type="number" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['productBorderRoundedSize'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
						<div class="items-conf">
							<label><?php echo smartyTranslate(array('s'=>'Border size','mod'=>'affinityitems'),$_smarty_tpl);?>
 :</label><br>
							<input name="productBorderSize" type="number" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['productBorderSize'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
						<div class="items-conf">
							<label><?php echo smartyTranslate(array('s'=>'Zone height','mod'=>'affinityitems'),$_smarty_tpl);?>
 (li) :</label><br>
							<input name="productHeight" type="number" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['productHeight'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
						<div class="items-conf">
							<label><?php echo smartyTranslate(array('s'=>'Zone width','mod'=>'affinityitems'),$_smarty_tpl);?>
 (li) :</label><br>
							<input name="productWidth" type="number" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['productWidth'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
						<div class="items-conf">
							<label><?php echo smartyTranslate(array('s'=>'Product number on a line','mod'=>'affinityitems'),$_smarty_tpl);?>
 :</label><br>
							<input name="productNumberOnLine" type="number" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['productNumberOnLine'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
						<div class="items-conf">
							<label><?php echo smartyTranslate(array('s'=>'Margin right','mod'=>'affinityitems'),$_smarty_tpl);?>
 (px) :</label><br>
							<input name="productMarginRight" type="number" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['productMarginRight'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
					</fieldset>
					<fieldset>				
						<legend><?php echo smartyTranslate(array('s'=>'Product element','mod'=>'affinityitems'),$_smarty_tpl);?>
 (li)</legend>
						<div class="items-conf">
							<label>id :</label><br>
							<input name="productId" type="text"  value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['productId'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
						<div class="items-conf">
							<label>class :</label><br>
							<input name="productClass" type="text" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['productClass'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
					</fieldset>
					<?php if ($_smarty_tpl->tpl_vars['version']->value>=16) {?>
					<fieldset>				
						<legend>CSS <?php echo smartyTranslate(array('s'=>'product container','mod'=>'affinityitems'),$_smarty_tpl);?>
</legend>
						<div class="items-conf">
							<label>id :</label><br>
							<input name="productContainerId" type="text"  value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['productContainerId'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
						<div class="items-conf">
							<label>class :</label><br>
							<input name="productContainerClass" type="text" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['productContainerClass'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
					</fieldset>
					<fieldset>				
						<legend>CSS <?php echo smartyTranslate(array('s'=>'product left block','mod'=>'affinityitems'),$_smarty_tpl);?>
</legend>
						<div class="items-conf">
							<label>id :</label><br>
							<input name="productLeftBlockId" type="text"  value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['productLeftBlockId'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
						<div class="items-conf">
							<label>class :</label><br>
							<input name="productLeftBlockClass" type="text" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['productLeftBlockClass'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
					</fieldset>
					<fieldset>				
						<legend>CSS <?php echo smartyTranslate(array('s'=>'product right block','mod'=>'affinityitems'),$_smarty_tpl);?>
</legend>
						<div class="items-conf">
							<label>id :</label><br>
							<input name="productRightBlockId" type="text"  value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['productRightBlockId'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
						<div class="items-conf">
							<label>class :</label><br>
							<input name="productRightBlockClass" type="text" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['productRightBlockClass'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
					</fieldset>
					<?php }?>
				</div>
				<div class="productTitle-toolbox toolboxarea" style="display:none">
					<div class="items-config-title">
						<?php echo smartyTranslate(array('s'=>'Product title','mod'=>'affinityitems'),$_smarty_tpl);?>

						<span toolbox="default" class="toolbox-button back">&#10550;</span>
						<hr>
					</div>
					<hr>
					<fieldset>
						<legend>
							<input type="hidden" name="productTitleDisplayOptions" value="0">
							<input type="checkbox" value="1" name="productTitleDisplayOptions" <?php if ($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['productTitleDisplayOptions']=="1") {?> checked="checked" <?php }?>>
							<span class="items-theme-zone-activation"><?php echo smartyTranslate(array('s'=>'Product title Activation','mod'=>'affinityitems'),$_smarty_tpl);?>
</span>
						</legend>
						<div class="items-conf">
							<label><?php echo smartyTranslate(array('s'=>'Product title color','mod'=>'affinityitems'),$_smarty_tpl);?>
 :</label><br>
							<input name="productTitleColor" type="color" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['productTitleColor'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
						<div class="items-conf">
							<label><?php echo smartyTranslate(array('s'=>'Product text size','mod'=>'affinityitems'),$_smarty_tpl);?>
 (px) :</label><br>
							<input name="productTitleSize" type="number" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['productTitleSize'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
						<div class="items-conf">
							<label><?php echo smartyTranslate(array('s'=>'Product title height','mod'=>'affinityitems'),$_smarty_tpl);?>
 (px) :</label><br>
							<input name="productTitleHeight" type="number" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['productTitleHeight'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
						<div class="items-conf">
							<label><?php echo smartyTranslate(array('s'=>'Product title align','mod'=>'affinityitems'),$_smarty_tpl);?>
 :</label><br>
							<select name="productTitleAlign">
								<option value="left" <?php if ($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['productTitleAlign']=="left") {?> selected <?php }?>>Left</option>
								<option value="center" <?php if ($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['productTitleAlign']=="center") {?> selected <?php }?>>Center</option>
								<option value="right" <?php if ($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['productTitleAlign']=="right") {?> selected <?php }?>>Right</option>
							</select>
						</div>
						<div class="items-conf">
							<label><?php echo smartyTranslate(array('s'=>'Product title Line height','mod'=>'affinityitems'),$_smarty_tpl);?>
 (px) :</label><br>
							<input name="productTitleLineHeight" type="number" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['productTitleLineHeight'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
					</fieldset>
					<fieldset>				
						<legend>CSS <?php echo smartyTranslate(array('s'=>'product title','mod'=>'affinityitems'),$_smarty_tpl);?>
</legend>
						<div class="items-conf">
							<label>id :</label><br>
							<input name="productTitleId" type="text"  value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['productTitleId'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
						<div class="items-conf">
							<label>class :</label><br>
							<input name="productTitleClass" type="text" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['productTitleClass'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
					</fieldset>
					<?php if ($_smarty_tpl->tpl_vars['version']->value>=16) {?>
					<fieldset>				
						<legend>CSS <?php echo smartyTranslate(array('s'=>'product link title','mod'=>'affinityitems'),$_smarty_tpl);?>
</legend>
						<div class="items-conf">
							<label>id :</label><br>
							<input name="productLinkTitleId" type="text"  value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['productLinkTitleId'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
						<div class="items-conf">
							<label>class :</label><br>
							<input name="productLinkTitleClass" type="text" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['productLinkTitleClass'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
					</fieldset>
					<?php }?>		
				</div>
				<div class="description-toolbox toolboxarea" style="display:none">
					<div class="items-config-title">
						<?php echo smartyTranslate(array('s'=>'Description','mod'=>'affinityitems'),$_smarty_tpl);?>

						<span toolbox="default" class="toolbox-button back">&#10550;</span>
						<hr>
					</div>
					<hr>
					<fieldset>				
						<legend>
							<input type="hidden" name="productDescriptionDisplayOptions" value="0">
							<input type="checkbox" value="1" name="productDescriptionDisplayOptions" <?php if ($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['productDescriptionDisplayOptions']=="1") {?> checked="checked" <?php }?>>
							<span class="items-theme-zone-activation"><?php echo smartyTranslate(array('s'=>'Product Description Activation','mod'=>'affinityitems'),$_smarty_tpl);?>
</span>
						</legend>
						<div class="items-conf">
							<label><?php echo smartyTranslate(array('s'=>'Text color','mod'=>'affinityitems'),$_smarty_tpl);?>
 :</label><br>
							<input name="productDescriptionColor" type="color" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['productDescriptionColor'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
						<div class="items-conf">
							<label><?php echo smartyTranslate(array('s'=>'Text size','mod'=>'affinityitems'),$_smarty_tpl);?>
 (px) :</label><br>
							<input name="productDescriptionSize" type="number" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['productDescriptionSize'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
						<div class="items-conf">
							<label><?php echo smartyTranslate(array('s'=>'Zone height','mod'=>'affinityitems'),$_smarty_tpl);?>
 (px) :</label><br>
							<input name="productDescriptionHeight" type="number" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['productDescriptionHeight'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
						<div class="items-conf">
							<label><?php echo smartyTranslate(array('s'=>'Description title align','mod'=>'affinityitems'),$_smarty_tpl);?>
 :</label><br>
							<select name="productDescriptionAlign">
								<option value="left" <?php if ($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['productDescriptionAlign']=="left") {?> selected <?php }?>>Left</option>
								<option value="center" <?php if ($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['productDescriptionAlign']=="center") {?> selected <?php }?>>Center</option>
								<option value="right" <?php if ($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['productDescriptionAlign']=="right") {?> selected <?php }?>>Right</option>
							</select>
						</div>
						<div class="items-conf">
							<label><?php echo smartyTranslate(array('s'=>'Description title Line height','mod'=>'affinityitems'),$_smarty_tpl);?>
 (px) :</label><br>
							<input name="productDescriptionLineHeight" type="number" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['productDescriptionLineHeight'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
					</fieldset>
					<fieldset>				
						<legend>CSS <?php echo smartyTranslate(array('s'=>'product description','mod'=>'affinityitems'),$_smarty_tpl);?>
</legend>
						<div class="items-conf">
							<label>id :</label><br>
							<input name="productDescriptionId" type="text"  value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['productDescriptionId'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
						<div class="items-conf">
							<label>class :</label><br>
							<input name="productDescriptionClass" type="text" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['productDescriptionClass'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
					</fieldset>
				</div>
				<div class="image-toolbox toolboxarea" style="display:none">
					<div class="items-config-title">
						<?php echo smartyTranslate(array('s'=>'Picture','mod'=>'affinityitems'),$_smarty_tpl);?>

						<span toolbox="default" class="toolbox-button back">&#10550;</span>
						<hr>
					</div>
					<hr>
					<fieldset>
						<legend>
							<input type="hidden" name="pictureDisplayOptions" value="0">
							<input type="checkbox" value="1" name="pictureDisplayOptions" <?php if ($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['pictureDisplayOptions']=="1") {?> checked="checked" <?php }?>>
							<span class="items-theme-zone-activation"><?php echo smartyTranslate(array('s'=>'Picture Activation','mod'=>'affinityitems'),$_smarty_tpl);?>
</span>
						</legend>
						<div class="items-conf">
							<label><?php echo smartyTranslate(array('s'=>'Border color','mod'=>'affinityitems'),$_smarty_tpl);?>
 :</label><br>
							<input name="pictureBorderColor" type="color" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['pictureBorderColor'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
						<div class="items-conf">
							<label><?php echo smartyTranslate(array('s'=>'Round border','mod'=>'affinityitems'),$_smarty_tpl);?>
 :</label><br>
							<input name="pictureBorderRoundedSize" type="number" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['pictureBorderRoundedSize'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
						<div class="items-conf">
							<label><?php echo smartyTranslate(array('s'=>'Border size','mod'=>'affinityitems'),$_smarty_tpl);?>
 :</label><br>
							<input name="pictureBorderSize" type="number" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['pictureBorderSize'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
						<div class="items-conf">
							<label><?php echo smartyTranslate(array('s'=>'Picture height','mod'=>'affinityitems'),$_smarty_tpl);?>
 :</label><br>
							<input name="pictureHeight" type="number" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['pictureHeight'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
						<div class="items-conf">
							<label><?php echo smartyTranslate(array('s'=>'Picture width','mod'=>'affinityitems'),$_smarty_tpl);?>
 :</label><br>
							<input name="pictureWidth" type="number" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['pictureWidth'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
						<div class="items-conf">
							<label><?php echo smartyTranslate(array('s'=>'Picture resolution','mod'=>'affinityitems'),$_smarty_tpl);?>
 :</label><br>
							<select name="pictureResolution">
								<?php  $_smarty_tpl->tpl_vars['size'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['size']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['imgSizeList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['size']->key => $_smarty_tpl->tpl_vars['size']->value) {
$_smarty_tpl->tpl_vars['size']->_loop = true;
?>
								<option value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['size']->value['name'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['size']->value['name']==$_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['pictureResolution']) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['size']->value['name'];?>
</option>
								<?php } ?>
							</select> 
						</div>
					</fieldset>
					<fieldset>
						<legend>CSS <?php echo smartyTranslate(array('s'=>'picture link','mod'=>'affinityitems'),$_smarty_tpl);?>
 </legend>
						<div class="items-conf">
							<label>id :</label><br>
							<input name="pictureLinkId" type="text"  value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['pictureLinkId'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
						<div class="items-conf">
							<label>class :</label><br>
							<input name="pictureLinkClass" type="text" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['pictureLinkClass'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
					</fieldset>
					<fieldset>
						<legend>CSS <?php echo smartyTranslate(array('s'=>'picture','mod'=>'affinityitems'),$_smarty_tpl);?>
</legend>
						<div class="items-conf">
							<label>id :</label><br>
							<input name="pictureId" type="text"  value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['pictureId'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
						<div class="items-conf">
							<label>class :</label><br>
							<input name="pictureClass" type="text" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['pictureClass'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
					</fieldset>
				</div>
				<div class="price-toolbox toolboxarea" style="display:none">
					<div class="items-config-title">
						<?php echo smartyTranslate(array('s'=>'Price','mod'=>'affinityitems'),$_smarty_tpl);?>

						<span toolbox="default" class="toolbox-button back">&#10550;</span>
						<hr>
					</div>
					<hr>
					<fieldset>
						<legend>
							<input type="hidden" name="priceDisplayOptions" value="0">
							<input type="checkbox" value="1" name="priceDisplayOptions" <?php if ($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['priceDisplayOptions']=="1") {?> checked="checked" <?php }?>>
							<span class="items-theme-zone-activation"><?php echo smartyTranslate(array('s'=>'Price Activation','mod'=>'affinityitems'),$_smarty_tpl);?>
</span>
						</legend>
						<div class="items-conf">
							<label><?php echo smartyTranslate(array('s'=>'Text color','mod'=>'affinityitems'),$_smarty_tpl);?>
 :</label><br>
							<input name="priceColor" type="color" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['priceColor'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
						<div class="items-conf">
							<label><?php echo smartyTranslate(array('s'=>'Text size','mod'=>'affinityitems'),$_smarty_tpl);?>
 (px) :</label><br>
							<input name="priceSize" type="number" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['priceSize'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
						<div class="items-conf">
							<label><?php echo smartyTranslate(array('s'=>'Zone height','mod'=>'affinityitems'),$_smarty_tpl);?>
 (px) :</label><br>
							<input name="priceHeight" type="number" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['priceHeight'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
					</fieldset>

					<fieldset>
						<legend>CSS price container</legend>
						<div class="items-conf">
							<label>id :</label><br>
							<input name="priceContainerId" type="text"  value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['priceContainerId'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
						<div class="items-conf">
							<label>class :</label><br>
							<input name="priceContainerClass" type="text" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['priceContainerClass'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
					</fieldset>
					<fieldset>
						<legend>CSS price</legend>
						<div class="items-conf">
							<label>id :</label><br>
							<input name="priceId" type="text"  value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['priceId'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
						<div class="items-conf">
							<label>class :</label><br>
							<input name="priceClass" type="text" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['priceClass'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
					</fieldset>
					<?php if ($_smarty_tpl->tpl_vars['version']->value>=16) {?>
					<fieldset>				
						<legend>CSS old price</legend>
						<div class="items-conf">
							<label>id :</label><br>
							<input name="oldPriceId" type="text"  value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['oldPriceId'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
						<div class="items-conf">
							<label>class :</label><br>
							<input name="oldPriceClass" type="text" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['oldPriceClass'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
					</fieldset>
					<fieldset>				
						<legend>CSS price percent reduction</legend>
						<div class="items-conf">
							<label>id :</label><br>
							<input name="priceReductionId" type="text"  value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['priceReductionId'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
						<div class="items-conf">
							<label>class :</label><br>
							<input name="priceReductionClass" type="text" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['priceReductionClass'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
					</fieldset>
					<?php }?>
				</div>
				<div class="cart-toolbox toolboxarea" style="display:none">
					<div class="items-config-title">
						<?php echo smartyTranslate(array('s'=>'Cart','mod'=>'affinityitems'),$_smarty_tpl);?>

						<span toolbox="default" class="toolbox-button back">&#10550;</span>
						<hr>
					</div>
					<fieldset>
						<legend>
							<input type="hidden" name="cartDisplayOptions" value="0">
							<input type="checkbox" value="1" name="cartDisplayOptions" <?php if ($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['cartDisplayOptions']=="1") {?> checked="checked" <?php }?>>
							<span class="items-theme-zone-activation"><?php echo smartyTranslate(array('s'=>'Cart Activation','mod'=>'affinityitems'),$_smarty_tpl);?>
</span>
						</legend>
						<div class="items-conf">
							<label><?php echo smartyTranslate(array('s'=>'Text color','mod'=>'affinityitems'),$_smarty_tpl);?>
 :</label><br>
							<input name="cartColor" type="color" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['cartColor'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
						<div class="items-conf">
							<label><?php echo smartyTranslate(array('s'=>'Border size','mod'=>'affinityitems'),$_smarty_tpl);?>
 :</label><br>
							<input name="cartBorderSize" type="number" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['cartBorderSize'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
						<div class="items-conf">
							<label><?php echo smartyTranslate(array('s'=>'Text size','mod'=>'affinityitems'),$_smarty_tpl);?>
 (px) :</label><br>
							<input name="cartSize" type="number" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['cartSize'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
						<div class="items-conf items-left">
							<label><?php echo smartyTranslate(array('s'=>'Background color','mod'=>'affinityitems'),$_smarty_tpl);?>
 :</label><br>
							<input name="cartBackgroundColor" type="color" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['cartBackgroundColor'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
						<div class="items-conf items-right">
							<label><?php echo smartyTranslate(array('s'=>'Transparent','mod'=>'affinityitems'),$_smarty_tpl);?>
 :</label>
							<input name="cartBackgroundColorTransparent" type="hidden" value="0">
							<input name="cartBackgroundColorTransparent" type="checkbox" value="1" <?php if ($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['cartBackgroundColorTransparent']) {?> checked <?php }?>>
						</div>
						<div class="clear"></div>
						<div class="items-conf">
							<label><?php echo smartyTranslate(array('s'=>'Border color','mod'=>'affinityitems'),$_smarty_tpl);?>
 :</label><br>
							<input name="cartBorderColor" type="color" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['cartBorderColor'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
						<div class="items-conf">
							<label><?php echo smartyTranslate(array('s'=>'Round border size','mod'=>'affinityitems'),$_smarty_tpl);?>
 :</label><br>
							<input name="cartBorderRoundedSize" type="number" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['cartBorderRoundedSize'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
						<div class="items-conf">
							<label><?php echo smartyTranslate(array('s'=>'Cart text align','mod'=>'affinityitems'),$_smarty_tpl);?>
 :</label><br>
							<select name="cartAlign">
								<option value="left" <?php if ($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['cartAlign']=="left") {?> selected <?php }?>>Left</option>
								<option value="center" <?php if ($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['cartAlign']=="center") {?> selected <?php }?>>Center</option>
								<option value="right" <?php if ($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['cartAlign']=="right") {?> selected <?php }?>>Right</option>
							</select> 
						</div>
						<div class="items-conf">
							<label><?php echo smartyTranslate(array('s'=>'Cart text line height','mod'=>'affinityitems'),$_smarty_tpl);?>
 (px) :</label><br>
							<input name="cartLineHeight" type="number" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['cartLineHeight'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
					</fieldset>
					<fieldset>
						<legend>CSS price container</legend>
						<div class="items-conf">
							<label>id :</label><br>
							<input name="cartId" type="text" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['cartId'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
						<div class="items-conf">
							<label>class :</label><br>
							<input name="cartClass" type="text" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['cartClass'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
					</fieldset>
				</div>
				<div class="detail-toolbox toolboxarea" style="display:none">
					<div class="items-config-title">
						<?php echo smartyTranslate(array('s'=>'Detail','mod'=>'affinityitems'),$_smarty_tpl);?>

						<span toolbox="default" class="toolbox-button back">&#10550;</span>
						<hr>
					</div>
					<fieldset>
						<legend>
							<input type="hidden" name="detailDisplayOptions" value="0">
							<input type="checkbox" value="1" name="detailDisplayOptions" <?php if ($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['detailDisplayOptions']=="1") {?> checked="checked" <?php }?>>
							<span class="items-theme-zone-activation"><?php echo smartyTranslate(array('s'=>'Detail Activation','mod'=>'affinityitems'),$_smarty_tpl);?>
</span>
						</legend>
						<div class="items-conf">
							<label><?php echo smartyTranslate(array('s'=>'Text color','mod'=>'affinityitems'),$_smarty_tpl);?>
 :</label><br>
							<input name="detailColor" type="color" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['detailColor'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
						<div class="items-conf">
							<label><?php echo smartyTranslate(array('s'=>'Text size','mod'=>'affinityitems'),$_smarty_tpl);?>
 (px) : (px) :</label><br>
							<input name="detailSize" type="number" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['detailSize'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
					</fieldset>
					<fieldset>
						<legend>CSS product detail</legend>
						<div class="items-conf">
							<label>id :</label><br>
							<input name="detailId" type="text"  value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['detailId'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
						<div class="items-conf">
							<label>class :</label><br>
							<input name="detailClass" type="text" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['detailClass'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
						</div>
					</fieldset>
				</div>
				<div class="default-toolbox toolboxarea" style="display:inherit">
					<div class="title">
						<?php echo smartyTranslate(array('s'=>'General','mod'=>'affinityitems'),$_smarty_tpl);?>

						<hr>
					</div>
					<div class="items-conf">
						<div class="onoffswitch">
							<input type="checkbox" name="backgroundActivation" checked="true" disabled="true">
						</div>
						<button class="toolbox-button" toolbox="background" type="button"><?php echo smartyTranslate(array('s'=>'Background','mod'=>'affinityitems'),$_smarty_tpl);?>
 <span class="arrow">></span></button>
					</div>
					<div class="items-conf">
						<div class="onoffswitch">
							<input type='hidden' value='0' name='titleActivation'>
							<input type="checkbox" name="titleActivation" value='1'
							<?php if ($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['titleActivation']=="1") {?> checked="true" <?php }?>>
						</div>
						<button class="toolbox-button" toolbox="title" type="button"><?php echo smartyTranslate(array('s'=>'Title','mod'=>'affinityitems'),$_smarty_tpl);?>
 <span class="arrow">></span></button>
					</div>
					<div class="items-conf">
						<div class="onoffswitch">
							<input type="checkbox" name="productActivation" checked="true" disabled="true">
						</div>
						<button class="toolbox-button" toolbox="product" type="button"><?php echo smartyTranslate(array('s'=>'Product','mod'=>'affinityitems'),$_smarty_tpl);?>
 <span class="arrow">></span></button>
					</div>
					<div class="items-conf">
						<div class="onoffswitch">
							<input type='hidden' value='0' name='productTitleActivation'>
							<input type="checkbox" name="productTitleActivation" value='1' 
							<?php if ($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['productTitleActivation']=="1") {?> checked="true" <?php }?>>
						</div>
						<button class="toolbox-button" toolbox="productTitle" type="button"><?php echo smartyTranslate(array('s'=>'Title product','mod'=>'affinityitems'),$_smarty_tpl);?>
 <span class="arrow">></span></button>
					</div>
					<div class="items-conf">
						<div class="onoffswitch">
							<input type='hidden' value='0' name='productDescriptionActivation'>
							<input type="checkbox" name="productDescriptionActivation" value="1"
							<?php if ($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['productDescriptionActivation']=="1") {?> checked="true" <?php }?>>
						</div>
						<button class="toolbox-button" toolbox="description" type="button"><?php echo smartyTranslate(array('s'=>'Description','mod'=>'affinityitems'),$_smarty_tpl);?>
 <span class="arrow">></span></button>
					</div>
					<div class="items-conf">
						<div class="onoffswitch">
							<input type="checkbox" name="pictureActivation" checked="true" disabled="true">
						</div>
						<button class="toolbox-button" toolbox="image" type="button"><?php echo smartyTranslate(array('s'=>'Picture','mod'=>'affinityitems'),$_smarty_tpl);?>
 <span class="arrow">></span></button>
					</div>
					<div class="items-conf">
						<div class="onoffswitch">
							<input type='hidden' value='0' name='priceActivation'>
							<input type="checkbox" name="priceActivation" value="1"  
							<?php if ($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['priceActivation']=="1") {?> checked="true" <?php }?>>
						</div>
						<button class="toolbox-button" toolbox="price" type="button"><?php echo smartyTranslate(array('s'=>'Price','mod'=>'affinityitems'),$_smarty_tpl);?>
 <span class="arrow">></span></button>
					</div>
					<div class="items-conf">
						<div class="onoffswitch">
							<input type='hidden' value='0' name='cartActivation'>
							<input type="checkbox" name="cartActivation" value="1" 
							<?php if ($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['cartActivation']=="1") {?> checked="true" <?php }?>>
						</div>
						<button class="toolbox-button" toolbox="cart" type="button"><?php echo smartyTranslate(array('s'=>'Cart','mod'=>'affinityitems'),$_smarty_tpl);?>
 <span class="arrow">></span></button>
					</div>
					<div class="items-conf">
						<div class="onoffswitch">
							<input type='hidden' value='0' name='detailActivation'>
							<input type="checkbox" name="detailActivation" value="1"
							<?php if ($_smarty_tpl->tpl_vars['themeSelected']->value['themeConfiguration']['detailActivation']=="1") {?> checked="true" <?php }?>>
						</div>
						<button class="toolbox-button" toolbox="detail" type="button"><?php echo smartyTranslate(array('s'=>'Detail','mod'=>'affinityitems'),$_smarty_tpl);?>
 <span class="arrow">></span></button>
					</div>
				</div>
			</div>
			<div class="preview-area">
				<?php echo $_smarty_tpl->getSubTemplate ("../hook/".((string)$_smarty_tpl->tpl_vars['version']->value)."/hrecommendation.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

			</div>
		</div>
	<div class="clear"></div>
</form>
<?php }} ?>
