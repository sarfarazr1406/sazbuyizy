<?php /* Smarty version Smarty-3.1.19, created on 2015-06-19 12:48:09
         compiled from "/home/buyizy/public_html/modules/yotpo/views/templates/admin/settingsForm.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11464904395583c231375047-91313606%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e37975e05f18a4c57fcfa1345fede452fcc82e14' => 
    array (
      0 => '/home/buyizy/public_html/modules/yotpo/views/templates/admin/settingsForm.tpl',
      1 => 1416031500,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11464904395583c231375047-91313606',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'yotpo_action' => 0,
    'yotpo_finishedRegistration' => 0,
    'yotpo_allreadyUsingYotpo' => 0,
    'yotpo_appKey' => 0,
    'yotpo_oauthToken' => 0,
    'yotpo_rich_snippets' => 0,
    'yotpo_language_as_site' => 0,
    'yotpo_widget_language_code' => 0,
    'yotpo_widgetLocation' => 0,
    'yotpo_tabName' => 0,
    'yotpo_bottomLineEnabled' => 0,
    'yotpo_all_statuses' => 0,
    'order_state' => 0,
    'yotpo_bottomLineLocation' => 0,
    'yotpo_showPastOrdersButton' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5583c2314bc316_40662732',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5583c2314bc316_40662732')) {function content_5583c2314bc316_40662732($_smarty_tpl) {?><div class="y-settings-white-box">
	<form action="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['yotpo_action']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" method="post">
		<div class="y-page-header">
			<i class="y-logo"></i><?php echo smartyTranslate(array('s'=>'Settings','mod'=>'yotpo'),$_smarty_tpl);?>
</div>
			<?php if (!$_smarty_tpl->tpl_vars['yotpo_finishedRegistration']->value&&!$_smarty_tpl->tpl_vars['yotpo_allreadyUsingYotpo']->value) {?><div class="y-settings-title"><?php echo smartyTranslate(array('s'=>'To customize the look and feel of the widget, and to edit your Mail After Purchase settings, just head to the','mod'=>'yotpo'),$_smarty_tpl);?>
 
				<?php if ($_smarty_tpl->tpl_vars['yotpo_appKey']->value&&$_smarty_tpl->tpl_vars['yotpo_appKey']->value!=''&&$_smarty_tpl->tpl_vars['yotpo_oauthToken']->value&&$_smarty_tpl->tpl_vars['yotpo_oauthToken']->value!='') {?>
					<a class="y-href" href="https://api.yotpo.com/users/b2blogin?app_key=<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['yotpo_appKey']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
&secret=<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['yotpo_oauthToken']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" target="_blank"><?php echo smartyTranslate(array('s'=>'Yotpo Dashboard.','mod'=>'yotpo'),$_smarty_tpl);?>
</a></div> 
				<?php } else { ?>
					<a class="y-href" href="https://my.yotpo.com/?login=true" target="_blank"><?php echo smartyTranslate(array('s'=>'Yotpo Dashboard.','mod'=>'yotpo'),$_smarty_tpl);?>
</a></div> 
				<?php }?>
			<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['yotpo_allreadyUsingYotpo']->value) {?><div class="y-settings-title"><?php echo smartyTranslate(array('s'=>'To get your api key and secret token','mod'=>'yotpo'),$_smarty_tpl);?>
 
		<a class="y-href" href="https://my.yotpo.com/?login=true" target="_blank"><?php echo smartyTranslate(array('s'=>'log in here','mod'=>'yotpo'),$_smarty_tpl);?>
</a><?php echo smartyTranslate(array('s'=>', And go to your account settings.','mod'=>'yotpo'),$_smarty_tpl);?>
</div><?php }?>

		<?php if ($_smarty_tpl->tpl_vars['yotpo_finishedRegistration']->value) {?><div class="y-settings-title"><?php echo smartyTranslate(array('s'=>'All set! The Yotpo widget is now properly installed on your shop.','mod'=>'yotpo'),$_smarty_tpl);?>
<br />
			<?php echo smartyTranslate(array('s'=>'To customize the look and feel of the widget, and to edit your Mail After Purchase settings, just head to the','mod'=>'yotpo'),$_smarty_tpl);?>
 
			<?php if ($_smarty_tpl->tpl_vars['yotpo_appKey']->value&&$_smarty_tpl->tpl_vars['yotpo_appKey']->value!=''&&$_smarty_tpl->tpl_vars['yotpo_oauthToken']->value&&$_smarty_tpl->tpl_vars['yotpo_oauthToken']->value!='') {?>
				<a class="y-href" href="https://api.yotpo.com/users/b2blogin?app_key=<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['yotpo_appKey']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
&secret=<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['yotpo_oauthToken']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" target="_blank"><?php echo smartyTranslate(array('s'=>'Yotpo Dashboard.','mod'=>'yotpo'),$_smarty_tpl);?>
</a></div> 
			<?php } else { ?>
				<a class="y-href" href="https://my.yotpo.com/?login=true" target="_blank"><?php echo smartyTranslate(array('s'=>'Yotpo Dashboard.','mod'=>'yotpo'),$_smarty_tpl);?>
</a></div> 
			<?php }?>
		<?php }?>

		<fieldset id="y-fieldset">
	        <div class="y-label"><?php echo smartyTranslate(array('s'=>'Enable Rich snippets','mod'=>'yotpo'),$_smarty_tpl);?>

               <input type="checkbox" name="yotpo_rich_snippets" value="1" <?php if ($_smarty_tpl->tpl_vars['yotpo_rich_snippets']->value) {?>checked="checked"<?php }?> />
            </div> 
            <?php if ($_smarty_tpl->tpl_vars['yotpo_appKey']->value&&$_smarty_tpl->tpl_vars['yotpo_appKey']->value!=''&&$_smarty_tpl->tpl_vars['yotpo_oauthToken']->value&&$_smarty_tpl->tpl_vars['yotpo_oauthToken']->value!='') {?>
            	<p class="y-notification"> * In order to activate Rich Snippets you will also need to check the Rich Snippet tick box in your <a class="y-href" href="https://api.yotpo.com/users/b2blogin?app_key=<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['yotpo_appKey']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
&secret=<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['yotpo_oauthToken']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
&redirect=/features/rich-snippets&utm_source=customers_prestashop_admin&utm_medium=link&utm_campaign=prestashop_rich_snippets" target="_blank"><?php echo smartyTranslate(array('s'=>'Yotpo admin.','mod'=>'yotpo'),$_smarty_tpl);?>
</a> </p>				 
			<?php }?>
                   
	        <div class="y-label"><?php echo smartyTranslate(array('s'=>'For multipule-language sites, mark this check box. This will choose the language according to the user\'s site language','mod'=>'yotpo'),$_smarty_tpl);?>

               <input type="checkbox" name="yotpo_language_as_site" value="1" <?php if ($_smarty_tpl->tpl_vars['yotpo_language_as_site']->value) {?>checked="checked"<?php }?> />
            </div> 
            <div class="y-label"><?php echo smartyTranslate(array('s'=>'If you would like to choose a set language, please type the language code here. You can find the supported langauge codes ','mod'=>'yotpo'),$_smarty_tpl);?>
<a class="y-href" href="http://support.yotpo.com/entries/21861473-Languages-Customization-" target="_blank"><?php echo smartyTranslate(array('s'=>'here.','mod'=>'yotpo'),$_smarty_tpl);?>
</a></div>
    	    <div class="y-input"><input type="text" class="yotpo_language_code_text" name="yotpo_widget_language_code" maxlength="5" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['yotpo_widget_language_code']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" /></div>			
			<div class="y-label"><?php echo smartyTranslate(array('s'=>'Select widget location','mod'=>'yotpo'),$_smarty_tpl);?>

				<select name="yotpo_widget_location">
					<option value="footer" <?php if ($_smarty_tpl->tpl_vars['yotpo_widgetLocation']->value=='footer') {?>selected<?php }?>><?php echo smartyTranslate(array('s'=>'Page footer','mod'=>'yotpo'),$_smarty_tpl);?>
</option>
					<option value="tab" <?php if ($_smarty_tpl->tpl_vars['yotpo_widgetLocation']->value=='tab') {?>selected<?php }?>><?php echo smartyTranslate(array('s'=>'Tab','mod'=>'yotpo'),$_smarty_tpl);?>
</option>
					<option value="other" <?php if ($_smarty_tpl->tpl_vars['yotpo_widgetLocation']->value=='other') {?>selected<?php }?>><?php echo smartyTranslate(array('s'=>'Other (click update to see instructions)','mod'=>'yotpo'),$_smarty_tpl);?>
</option>
				</select>
			</div>

			
			<?php if ($_smarty_tpl->tpl_vars['yotpo_widgetLocation']->value=='other') {?>
				<div class="y-label"><?php echo smartyTranslate(array('s'=>'In order to locate the widget in a custom position, please open the "root" folder, then enter the "themes" library. Locate the specific theme you would like the widget to show up on, and in this specific themes folder, locate the file "product.tpl". Add the code here, wherever you would like it placed.','mod'=>'yotpo'),$_smarty_tpl);?>
<br> <br> 
					<div class="y-code">
					
					&lt;div class="yotpo yotpo-main-widget" </br>
					data-product-id="{$yotpoProductId|intval}"</br>
					data-name="{$yotpoProductName|escape:'htmlall':'UTF-8'}" </br>
					data-url="{$link-&gt;getProductLink($smarty.get.id_product, $smarty.get.id_product.link_rewrite)|escape:'htmlall':'UTF-8'}" </br>
					data-image-url="{$yotpoProductImageUrl|escape:'htmlall':'UTF-8'}" </br>
					data-description="{$yotpoProductDescription|escape:'htmlall':'UTF-8'}" </br>
					data-lang="{$yotpoLanguage|escape:'htmlall':'UTF-8'}"&gt; </br>
					{$richSnippetsCode|escape:'UTF-8'} <br>
					&lt;/div&gt;
					
					</div>
				</div>
			<?php }?>

			<div class="y-label"><?php echo smartyTranslate(array('s'=>'Select tab name','mod'=>'yotpo'),$_smarty_tpl);?>
</div>
			<div class="y-input"><input type="text" name="yotpo_widget_tab_name" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['yotpo_tabName']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" /></div>
			<div class="y-label"><?php echo smartyTranslate(array('s'=>'App key','mod'=>'yotpo'),$_smarty_tpl);?>
</div>
			<div class="y-input"><input type="text" name="yotpo_app_key" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['yotpo_appKey']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" /></div>
			<div class="y-label"><?php echo smartyTranslate(array('s'=>'Secret token','mod'=>'yotpo'),$_smarty_tpl);?>
</div>
			<div class="y-input"><input type="text" name="yotpo_oauth_token" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['yotpo_oauthToken']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/></div>
			<div class="y-label"><?php echo smartyTranslate(array('s'=>'Enable bottom line','mod'=>'yotpo'),$_smarty_tpl);?>

            	<input type="checkbox" name="yotpo_bottom_line_enabled" value="1" <?php if ($_smarty_tpl->tpl_vars['yotpo_bottomLineEnabled']->value) {?>checked="checked"<?php }?> />
        	</div>
        	
        	<div class="y-label"><?php echo smartyTranslate(array('s'=>'Select the status that will trigger the Mail After Purchase e-mail:','mod'=>'yotpo'),$_smarty_tpl);?>
 </br>
        	<div class="y-label y-multiselect">
        		<?php  $_smarty_tpl->tpl_vars['order_state'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['order_state']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['yotpo_all_statuses']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['order_state']->key => $_smarty_tpl->tpl_vars['order_state']->value) {
$_smarty_tpl->tpl_vars['order_state']->_loop = true;
?>
					<label><input type="checkbox" 
						  name="yotpo_map_status[]"										  
						  value="<?php echo intval($_smarty_tpl->tpl_vars['order_state']->value['id_order_state']);?>
"
						  <?php if ($_smarty_tpl->tpl_vars['order_state']->value['selected']=='1') {?> checked <?php }?>
						  />
						  <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['order_state']->value['name'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
									  
					</label>
				<?php } ?>
        	</div>
        	</div> 
	        <div class="y-label"><?php echo smartyTranslate(array('s'=>'Select bottom Line location','mod'=>'yotpo'),$_smarty_tpl);?>

	          <select name="yotpo_bottom_line_location">
	            <option value="right_column" <?php if ($_smarty_tpl->tpl_vars['yotpo_bottomLineLocation']->value=="right_column") {?>selected<?php }?>><?php echo smartyTranslate(array('s'=>'Right column','mod'=>'yotpo'),$_smarty_tpl);?>
</option>
	            <option value="left_column" <?php if ($_smarty_tpl->tpl_vars['yotpo_bottomLineLocation']->value=="left_column") {?>selected<?php }?>><?php echo smartyTranslate(array('s'=>'Left column','mod'=>'yotpo'),$_smarty_tpl);?>
</option>
	            <option value="other" <?php if ($_smarty_tpl->tpl_vars['yotpo_bottomLineLocation']->value=="other") {?>selected<?php }?>><?php echo smartyTranslate(array('s'=>'Other (click update to see instructions)','mod'=>'yotpo'),$_smarty_tpl);?>
</option>
	          </select>
	        </div> 
	        <?php if ($_smarty_tpl->tpl_vars['yotpo_bottomLineLocation']->value=='other') {?>
	        <div class="y-label"><?php echo smartyTranslate(array('s'=>'In order to locate the bottom line in a custom position, please open the "root" folder, then enter the "themes" library. Locate the specific theme you would like the widget to show up on, and in this specific themes folder, locate the file "product.tpl". Add the code here, wherever you would like it placed.','mod'=>'yotpo'),$_smarty_tpl);?>
<br /><br /> 
	          <div class="y-code">
	            
	            &lt;div class="yotpo bottomLine" <br>
	               data-appkey="{$yotpoAppkey|escape:'htmlall':'UTF-8'}"<br>
	               data-domain="{$yotpoDomain|escape:'htmlall':'UTF-8'}"<br>
	               data-product-id="{$yotpoProductId|intval}"<br>
	               data-product-models="{$yotpoProductModel|escape:'htmlall':'UTF-8'}" <br>
	               data-name="{$yotpoProductName|escape:'htmlall':'UTF-8'}" <br>
	               data-url="{$link-&gt;getProductLink($smarty.get.id_product, $smarty.get.id_product.link_rewrite)|escape:'htmlall':'UTF-8'}" <br>
	               data-image-url="{$yotpoProductImageUrl|escape:'htmlall':'UTF-8'}" <br>
	               data-description="{$yotpoProductDescription|escape:'htmlall':'UTF-8'}" <br>
	               data-bread-crumbs="{$yotpoProductBreadCrumbs|escape:'htmlall':'UTF-8'}"<br>
	               data-lang="{$yotpoLanguage|escape:'htmlall':'UTF-8'}"&gt; <br>
	              &lt;/div&gt;
	           
	         </div>
	        </div>
	        <?php }?> 	               	
		</fieldset>

		<div class="y-footer">
			<?php if ($_smarty_tpl->tpl_vars['yotpo_showPastOrdersButton']->value) {?><input type="submit" name="yotpo_past_orders" value="<?php echo smartyTranslate(array('s'=>'Submit past orders','mod'=>'yotpo'),$_smarty_tpl);?>
" class="y-submit-btn" <?php if (empty($_smarty_tpl->tpl_vars['yotpo_appKey']->value)||empty($_smarty_tpl->tpl_vars['yotpo_oauthToken']->value)) {?> disabled <?php }?>><?php }?>
			<input type="submit" name="yotpo_settings" value="<?php echo smartyTranslate(array('s'=>'Update','mod'=>'yotpo'),$_smarty_tpl);?>
" class="y-submit-btn" />
		</div>
	</form>
</div><?php }} ?>
