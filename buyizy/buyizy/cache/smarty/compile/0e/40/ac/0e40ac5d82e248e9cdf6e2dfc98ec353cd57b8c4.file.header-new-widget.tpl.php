<?php /* Smarty version Smarty-3.1.19, created on 2015-06-07 11:34:32
         compiled from "/home/buyizy/public_html/modules/zopimfree/header-new-widget.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11270673305573def0905a74-50576680%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0e40ac5d82e248e9cdf6e2dfc98ec353cd57b8c4' => 
    array (
      0 => '/home/buyizy/public_html/modules/zopimfree/header-new-widget.tpl',
      1 => 1416143008,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11270673305573def0905a74-50576680',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'content_only' => 0,
    'widgetid' => 0,
    'customerName' => 0,
    'customerEmail' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5573def09ac275_20369197',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5573def09ac275_20369197')) {function content_5573def09ac275_20369197($_smarty_tpl) {?><!--Start of Zopim Live Chat Script-->
<?php if (!$_smarty_tpl->tpl_vars['content_only']->value) {?>

<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');
$.src='//v2.zopim.com/?<?php echo $_smarty_tpl->tpl_vars['widgetid']->value;?>
';z.t=+new Date;$.
type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script');

</script>
<!--End of Zopim Live Chat Script-->

<?php if ($_smarty_tpl->tpl_vars['customerName']->value&&$_smarty_tpl->tpl_vars['customerEmail']->value) {?>

<script>
  $zopim(function() {
    $zopim.livechat.setName('<?php if ($_smarty_tpl->tpl_vars['customerName']->value) {?><?php echo $_smarty_tpl->tpl_vars['customerName']->value;?>
<?php }?>');
    $zopim.livechat.setEmail('<?php if ($_smarty_tpl->tpl_vars['customerEmail']->value) {?><?php echo $_smarty_tpl->tpl_vars['customerEmail']->value;?>
<?php }?>');
  });
</script>

<?php }?>
<?php }?><?php }} ?>
