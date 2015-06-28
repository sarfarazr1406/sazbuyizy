<?php /* Smarty version Smarty-3.1.19, created on 2015-06-19 12:40:08
         compiled from "/home/buyizy/public_html/modules/affinityitems//views/templates/hook/hook.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12344071755583c0503c7100-67442498%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4e775916f63b80469ea84fdb77dee99423436e50' => 
    array (
      0 => '/home/buyizy/public_html/modules/affinityitems//views/templates/hook/hook.tpl',
      1 => 1417109329,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12344071755583c0503c7100-67442498',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'abtesting' => 0,
    'renderCategory' => 0,
    'position' => 0,
    'hookCategoryConfiguration' => 0,
    'renderSearch' => 0,
    'hookSearchConfiguration' => 0,
    'additionalCss' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5583c0504802e8_29578198',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5583c0504802e8_29578198')) {function content_5583c0504802e8_29578198($_smarty_tpl) {?>

<script>
    var abtesting = '<?php echo $_smarty_tpl->tpl_vars['abtesting']->value;?>
';
    $(document).ready(function () {
       
       <?php if ($_smarty_tpl->tpl_vars['renderCategory']->value!=''&&!empty($_smarty_tpl->tpl_vars['renderCategory']->value)) {?>
       
        if ($("body").attr("id") == "category") {
            
            <?php $_smarty_tpl->tpl_vars['position'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['position']->step = 1;$_smarty_tpl->tpl_vars['position']->total = (int) ceil(($_smarty_tpl->tpl_vars['position']->step > 0 ? 2+1 - (1) : 1-(2)+1)/abs($_smarty_tpl->tpl_vars['position']->step));
if ($_smarty_tpl->tpl_vars['position']->total > 0) {
for ($_smarty_tpl->tpl_vars['position']->value = 1, $_smarty_tpl->tpl_vars['position']->iteration = 1;$_smarty_tpl->tpl_vars['position']->iteration <= $_smarty_tpl->tpl_vars['position']->total;$_smarty_tpl->tpl_vars['position']->value += $_smarty_tpl->tpl_vars['position']->step, $_smarty_tpl->tpl_vars['position']->iteration++) {
$_smarty_tpl->tpl_vars['position']->first = $_smarty_tpl->tpl_vars['position']->iteration == 1;$_smarty_tpl->tpl_vars['position']->last = $_smarty_tpl->tpl_vars['position']->iteration == $_smarty_tpl->tpl_vars['position']->total;?>
            
            var renderCategory_<?php echo $_smarty_tpl->tpl_vars['position']->value;?>
 = $.trim('<?php echo $_smarty_tpl->tpl_vars['renderCategory']->value[$_smarty_tpl->tpl_vars['position']->value-1];?>
');
            $("<?php echo $_smarty_tpl->tpl_vars['hookCategoryConfiguration']->value->{'recoSelectorCategory_'.$_smarty_tpl->tpl_vars['position']->value};?>
").first().<?php echo $_smarty_tpl->tpl_vars['hookCategoryConfiguration']->value->{'recoSelectorPositionCategory_'.$_smarty_tpl->tpl_vars['position']->value};?>
(renderCategory_<?php echo $_smarty_tpl->tpl_vars['position']->value;?>
);
            if ($(".aereco").length && $("<?php echo $_smarty_tpl->tpl_vars['hookCategoryConfiguration']->value->{'recoSelectorCategory_'.$_smarty_tpl->tpl_vars['position']->value};?>
").length) {
                $(".aereco").show();
            }
            
            <?php }} ?>
            
        }
        
        <?php }?>
        
       
       <?php if ($_smarty_tpl->tpl_vars['renderSearch']->value!=''&&!empty($_smarty_tpl->tpl_vars['renderSearch']->value)) {?>
       
        if ($("body").attr("id") == "search") {
            
            <?php $_smarty_tpl->tpl_vars['position'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['position']->step = 1;$_smarty_tpl->tpl_vars['position']->total = (int) ceil(($_smarty_tpl->tpl_vars['position']->step > 0 ? 2+1 - (1) : 1-(2)+1)/abs($_smarty_tpl->tpl_vars['position']->step));
if ($_smarty_tpl->tpl_vars['position']->total > 0) {
for ($_smarty_tpl->tpl_vars['position']->value = 1, $_smarty_tpl->tpl_vars['position']->iteration = 1;$_smarty_tpl->tpl_vars['position']->iteration <= $_smarty_tpl->tpl_vars['position']->total;$_smarty_tpl->tpl_vars['position']->value += $_smarty_tpl->tpl_vars['position']->step, $_smarty_tpl->tpl_vars['position']->iteration++) {
$_smarty_tpl->tpl_vars['position']->first = $_smarty_tpl->tpl_vars['position']->iteration == 1;$_smarty_tpl->tpl_vars['position']->last = $_smarty_tpl->tpl_vars['position']->iteration == $_smarty_tpl->tpl_vars['position']->total;?>
            
            var renderSearch_<?php echo $_smarty_tpl->tpl_vars['position']->value;?>
 = $.trim('<?php echo $_smarty_tpl->tpl_vars['renderSearch']->value[$_smarty_tpl->tpl_vars['position']->value-1];?>
');
            $("<?php echo $_smarty_tpl->tpl_vars['hookSearchConfiguration']->value->{'recoSelectorSearch_'.$_smarty_tpl->tpl_vars['position']->value};?>
").first().<?php echo $_smarty_tpl->tpl_vars['hookSearchConfiguration']->value->{'recoSelectorPositionSearch_'.$_smarty_tpl->tpl_vars['position']->value};?>
(renderSearch_<?php echo $_smarty_tpl->tpl_vars['position']->value;?>
);
            if ($(".aereco").length && $("<?php echo $_smarty_tpl->tpl_vars['hookSearchConfiguration']->value->{'recoSelectorSearch_'.$_smarty_tpl->tpl_vars['position']->value};?>
").length) {
                 $(".aereco").show();
             }
            
            <?php }} ?>
            
        }
        
        <?php }?>
        
        $('.ae-area a').on('click', function() {
            aenow = new Date().getTime();
            createCookie('aelastreco', (aenow+"."+$(this).parents(".ae-area").attr("class").split(" ")[1].split("-")[1]+"."+$(this).attr("rel")), 1);
        });        
    });
</script>
<style type="text/css">
      <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['additionalCss']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>

</style>
<?php }} ?>
