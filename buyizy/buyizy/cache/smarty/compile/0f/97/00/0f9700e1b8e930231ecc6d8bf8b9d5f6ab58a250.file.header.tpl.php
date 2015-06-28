<?php /* Smarty version Smarty-3.1.19, created on 2015-06-07 11:34:32
         compiled from "/home/buyizy/public_html/modules/yotpo/views/templates/front/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10073354925573def09d2325-60549911%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0f9700e1b8e930231ecc6d8bf8b9d5f6ab58a250' => 
    array (
      0 => '/home/buyizy/public_html/modules/yotpo/views/templates/front/header.tpl',
      1 => 1416145165,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10073354925573def09d2325-60549911',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'content_only' => 0,
    'yotpoAppkey' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5573def0a492d4_12707791',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5573def0a492d4_12707791')) {function content_5573def0a492d4_12707791($_smarty_tpl) {?><?php if (!$_smarty_tpl->tpl_vars['content_only']->value) {?>
<script type="text/javascript">
	   var yotpoAppkey = "<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['yotpoAppkey']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" ;
	
	function inIframe () {
	    try {
	    	return window.self !== window.top;
	    } catch (e) {
	    	return true;
	    }
	}
	var inIframe = inIframe();
	if (inIframe) {
		window['yotpo_testimonials_active'] = true;
	}
	if (document.addEventListener){
	    document.addEventListener('DOMContentLoaded', function () {
	        var e=document.createElement("script");e.type="text/javascript",e.async=true,e.src="//staticw2.yotpo.com/" + yotpoAppkey  + "/widget.js";var t=document.getElementsByTagName("script")[0];t.parentNode.insertBefore(e,t)
	    });
	}
	else if (document.attachEvent) {
	    document.attachEvent('DOMContentLoaded',function(){
	        var e=document.createElement("script");e.type="text/javascript",e.async=true,e.src="//staticw2.yotpo.com/" + yotpoAppkey  + "/widget.js";var t=document.getElementsByTagName("script")[0];t.parentNode.insertBefore(e,t)
	    });
	}
	
</script>
<?php }?><?php }} ?>
