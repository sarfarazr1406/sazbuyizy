<?php /* Smarty version Smarty-3.1.19, created on 2015-06-12 11:50:59
         compiled from "/home/buyizy/public_html/themes/default-bootstrap/modules/deliverydays/views/templates/hook/samdha_admin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2102338269557a7a4b186618-45543420%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '106f67aea8c09e3489b6ac8541d42c6dc7a0d063' => 
    array (
      0 => '/home/buyizy/public_html/themes/default-bootstrap/modules/deliverydays/views/templates/hook/samdha_admin.tpl',
      1 => 1429475430,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2102338269557a7a4b186618-45543420',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'version_16' => 0,
    'bootstrap' => 0,
    'version_15' => 0,
    'tabs' => 0,
    'tab' => 0,
    'documentation_url' => 0,
    'support_url' => 0,
    'content' => 0,
    'about_form' => 0,
    'active_tab' => 0,
    'module_url' => 0,
    'module_path' => 0,
    'module_short_name' => 0,
    'module_version' => 0,
    'footer' => 0,
    'admin_js' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_557a7a4b3f7054_84176071',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_557a7a4b3f7054_84176071')) {function content_557a7a4b3f7054_84176071($_smarty_tpl) {?>
<div id="samdha_wait"><img src="../img/loader.gif"/></div>
<?php if ($_smarty_tpl->tpl_vars['version_16']->value&&$_smarty_tpl->tpl_vars['bootstrap']->value) {?><div class="container-fluid"><?php }?>
<div id="samdha_warper" class="<?php if ($_smarty_tpl->tpl_vars['version_16']->value) {?>ps16<?php } else { ?><?php if ($_smarty_tpl->tpl_vars['version_15']->value) {?>ps15<?php } else { ?>ps14<?php }?><?php }?> <?php if ($_smarty_tpl->tpl_vars['version_16']->value&&$_smarty_tpl->tpl_vars['bootstrap']->value) {?>row<?php }?>" style="visibility: hidden">
    <div id="samdha_content" class="<?php if ($_smarty_tpl->tpl_vars['version_16']->value) {?>ps16<?php } else { ?><?php if ($_smarty_tpl->tpl_vars['version_15']->value) {?>ps15<?php } else { ?>ps14<?php }?><?php }?> col-lg-9 col-xs-12">
        <div id="samdha_tab">
            <ul>
                <?php if (isset($_smarty_tpl->tpl_vars['tabs']->value)&&is_array($_smarty_tpl->tpl_vars['tabs']->value)) {?>
                    <?php  $_smarty_tpl->tpl_vars['tab'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['tab']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['tabs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['tab']->key => $_smarty_tpl->tpl_vars['tab']->value) {
$_smarty_tpl->tpl_vars['tab']->_loop = true;
?>
                        <li>
                            <a href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['tab']->value['href'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" <?php if (isset($_smarty_tpl->tpl_vars['tab']->value['rel'])) {?>rel="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['tab']->value['rel'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"<?php }?> <?php if (isset($_smarty_tpl->tpl_vars['tab']->value['id'])) {?>id="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['tab']->value['id'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"<?php }?> <?php if (isset($_smarty_tpl->tpl_vars['tab']->value['title'])) {?>id="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['tab']->value['title'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"<?php }?>>
                                <span> <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['tab']->value['display_name'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</span>
                            </a>
                        </li>
                    <?php } ?>
                <?php }?>
                <li><a rel="iframe" id="tabHelp" href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['documentation_url']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
">
                    <span> <?php echo smartyTranslate(array('s'=>'Documentation','mod'=>'samdha'),$_smarty_tpl);?>
</span>
                </a></li>
                <li><a rel="iframe" id="tabSupport" href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['support_url']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
">
                    <span> <?php echo smartyTranslate(array('s'=>'Support','mod'=>'samdha'),$_smarty_tpl);?>
</span>
                </a></li>
            </ul>
            <?php if ($_smarty_tpl->tpl_vars['content']->value) {?>
                <?php echo $_smarty_tpl->getSubTemplate ($_smarty_tpl->tpl_vars['content']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

            <?php }?>
        </div>
    </div>
    <div id="samdha_about" class="<?php if ($_smarty_tpl->tpl_vars['version_16']->value) {?>ps16<?php } else { ?><?php if ($_smarty_tpl->tpl_vars['version_15']->value) {?>ps15<?php } else { ?>ps14<?php }?><?php }?> col-lg-3 col-xs-12">
        <?php echo htmlspecialchars_decode(htmlspecialchars($_smarty_tpl->tpl_vars['about_form']->value, ENT_QUOTES, 'UTF-8', true), ENT_QUOTES);?>

    </div>
</div>
<?php if ($_smarty_tpl->tpl_vars['version_16']->value&&$_smarty_tpl->tpl_vars['bootstrap']->value) {?></div><?php }?>
<br style="clear: both"/>
<script type="text/javascript">
    var module = {
        active_tab: '<?php echo strtr($_smarty_tpl->tpl_vars['active_tab']->value, array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
',
        module_url: '<?php echo strtr($_smarty_tpl->tpl_vars['module_url']->value, array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
',
        module_path: '<?php echo strtr($_smarty_tpl->tpl_vars['module_path']->value, array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
',
        short_name: '<?php echo strtr($_smarty_tpl->tpl_vars['module_short_name']->value, array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
',
        version_15: '<?php echo strtr($_smarty_tpl->tpl_vars['version_15']->value, array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
'
    };
    var messages = {
    };
</script>
<?php if ($_smarty_tpl->tpl_vars['version_16']->value&&$_smarty_tpl->tpl_vars['bootstrap']->value) {?>
    <link rel="stylesheet" type="text/css" href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['module_path']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
css/jquery-ui-1.10.3.custom.css">
    <!--[if lt IE 9]>
    <link rel="stylesheet" href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['module_path']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
css/jquery.ui.1.10.3.ie.css">
    <![endif]-->
<?php } else { ?>
    <link rel="stylesheet" type="text/css" href="//ajax.aspnetcdn.com/ajax/jquery.ui/1.10.3/themes/smoothness/jquery-ui.css">
<?php }?>
<link rel="stylesheet" type="text/css" href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['module_path']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
css/samdha_admin.css?v=<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['module_version']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
">
<script src="//ajax.aspnetcdn.com/ajax/jQuery/jquery-1.9.1.min.js"></script>
<script src="//ajax.aspnetcdn.com/ajax/jquery.ui/1.10.3/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['module_path']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
css/jquery.chosen.css">
<script src="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['module_path']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
js/jquery.chosen.js?v=<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['module_version']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" type="text/javascript"></script>
<?php if ($_smarty_tpl->tpl_vars['footer']->value) {?>
    <?php echo $_smarty_tpl->getSubTemplate ($_smarty_tpl->tpl_vars['footer']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php }?>
<script src="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['module_path']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
js/samdha_admin.js?v=<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['module_version']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" type="text/javascript"></script>
<?php if ($_smarty_tpl->tpl_vars['admin_js']->value) {?>
    <script src="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['module_path']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
js/admin.js?v=<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['module_version']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" type="text/javascript"></script>
<?php }?>
<?php }} ?>
