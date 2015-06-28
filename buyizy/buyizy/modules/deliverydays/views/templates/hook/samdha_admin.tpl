{*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade this module to newer
* versions in the future. If you wish to customize this module for your
* needs please refer to http://doc.prestashop.com/display/PS15/Overriding+default+behaviors
* #Overridingdefaultbehaviors-Overridingamodule%27sbehavior for more information.
*
* @author Samdha <contact@samdha.net>
* @copyright  Samdha
* @license    commercial license see license.txt
*}
<div id="samdha_wait"><img src="../img/loader.gif"/></div>
{if $version_16 && $bootstrap}<div class="container-fluid">{/if}
<div id="samdha_warper" class="{if $version_16}ps16{else}{if $version_15}ps15{else}ps14{/if}{/if} {if $version_16 && $bootstrap}row{/if}" style="visibility: hidden">
    <div id="samdha_content" class="{if $version_16}ps16{else}{if $version_15}ps15{else}ps14{/if}{/if} col-lg-9 col-xs-12">
        <div id="samdha_tab">
            <ul>
                {if isset($tabs) && is_array($tabs)}
                    {foreach from=$tabs item=tab}
                        <li>
                            <a href="{$tab.href|escape:'htmlall':'UTF-8'}" {if isset($tab.rel)}rel="{$tab.rel|escape:'htmlall':'UTF-8'}"{/if} {if isset($tab.id)}id="{$tab.id|escape:'htmlall':'UTF-8'}"{/if} {if isset($tab.title)}id="{$tab.title|escape:'htmlall':'UTF-8'}"{/if}>
                                <span> {$tab.display_name|escape:'htmlall':'UTF-8'}</span>
                            </a>
                        </li>
                    {/foreach}
                {/if}
                <li><a rel="iframe" id="tabHelp" href="{$documentation_url|escape:'htmlall':'UTF-8'}">
                    <span> {l s='Documentation' mod='samdha'}</span>
                </a></li>
                <li><a rel="iframe" id="tabSupport" href="{$support_url|escape:'htmlall':'UTF-8'}">
                    <span> {l s='Support' mod='samdha'}</span>
                </a></li>
            </ul>
            {if $content}
                {include file=$content}
            {/if}
        </div>
    </div>
    <div id="samdha_about" class="{if $version_16}ps16{else}{if $version_15}ps15{else}ps14{/if}{/if} col-lg-3 col-xs-12">
        {$about_form|escape:'html':'UTF-8'|unescape:'html':'UTF-8'}
    </div>
</div>
{if $version_16 && $bootstrap}</div>{/if}
<br style="clear: both"/>
<script type="text/javascript">
    var module = {ldelim}
        active_tab: '{$active_tab|escape:'javascript':'UTF-8'}',
        module_url: '{$module_url|escape:'javascript':'UTF-8'}',
        module_path: '{$module_path|escape:'javascript':'UTF-8'}',
        short_name: '{$module_short_name|escape:'javascript':'UTF-8'}',
        version_15: '{$version_15|escape:'javascript':'UTF-8'}'
    {rdelim};
    var messages = {ldelim}
    {rdelim};
</script>
{if $version_16 && $bootstrap}
    <link rel="stylesheet" type="text/css" href="{$module_path|escape:'htmlall':'UTF-8'}css/jquery-ui-1.10.3.custom.css">
    <!--[if lt IE 9]>
    <link rel="stylesheet" href="{$module_path|escape:'htmlall':'UTF-8'}css/jquery.ui.1.10.3.ie.css">
    <![endif]-->
{else}
    <link rel="stylesheet" type="text/css" href="//ajax.aspnetcdn.com/ajax/jquery.ui/1.10.3/themes/smoothness/jquery-ui.css">
{/if}
<link rel="stylesheet" type="text/css" href="{$module_path|escape:'htmlall':'UTF-8'}css/samdha_admin.css?v={$module_version|escape:'htmlall':'UTF-8'}">
<script src="//ajax.aspnetcdn.com/ajax/jQuery/jquery-1.9.1.min.js"></script>
<script src="//ajax.aspnetcdn.com/ajax/jquery.ui/1.10.3/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="{$module_path|escape:'htmlall':'UTF-8'}css/jquery.chosen.css">
<script src="{$module_path|escape:'htmlall':'UTF-8'}js/jquery.chosen.js?v={$module_version|escape:'htmlall':'UTF-8'}" type="text/javascript"></script>
{if $footer}
    {include file=$footer}
{/if}
<script src="{$module_path|escape:'htmlall':'UTF-8'}js/samdha_admin.js?v={$module_version|escape:'htmlall':'UTF-8'}" type="text/javascript"></script>
{if $admin_js}
    <script src="{$module_path|escape:'htmlall':'UTF-8'}js/admin.js?v={$module_version|escape:'htmlall':'UTF-8'}" type="text/javascript"></script>
{/if}
