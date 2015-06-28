{*
* 2013-2014 Nosto Solutions Ltd
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to contact@nosto.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
* @author    Nosto Solutions Ltd <contact@nosto.com>
* @copyright 2013-2014 Nosto Solutions Ltd
* @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*}

<script>
function confirmUninstall(form) {
    return confirm('{l s='Are you sure you want to uninstall Nosto?' mod='nostotagging'}');
}
</script>
<div class="tw-bs">
    <div class="container-fluid">
        <div class="row">
            <form class="nostotagging" role="form" action="{$nostotagging_form_action|escape:'htmlall':'UTF-8'}" method="post" enctype="multipart/form-data" novalidate="">
                <input type="hidden" id="nostotagging_current_language" name="nostotagging_current_language" value="{$nostotagging_current_language.id_lang|escape:'htmlall':'UTF-8'}">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="col-xs-8">
                            {if count($nostotagging_languages) > 1}
                                <label for="nostotagging_language">{l s='Manage accounts:' mod='nostotagging'}
                                    <select class="form-control" id="nostotagging_language">
                                        {foreach from=$nostotagging_languages item=language}
                                            <option value="{$language.id_lang|escape:'htmlall':'UTF-8'}" {if $language.id_lang == $nostotagging_current_language.id_lang}selected="selected"{/if}>
                                                {$language.name|escape:'htmlall':'UTF-8'}
                                            </option>
                                        {/foreach}
                                    </select>
                                </label>
                            {/if}
                        </div>
                        <div class="col-xs-4 text-right">
                            {if $nostotagging_account_authorized}
                                <a href="#" id="nostotagging_account_setup">{l s='Account setup' mod='nostotagging'}
                                    <span class="glyphicon glyphicon-cog">&nbsp;</span>
                                </a>
                            {/if}
                        </div>
                    </div>
                    <div class="panel-body text-center">
                        {if $nostotagging_account_authorized}
                            <div id="nostotagging_installed" style="{if !empty($iframe_url)}display: none;{/if}">
                                <h2>{$translations.nostotagging_installed_heading|escape:'htmlall':'UTF-8'}</h2>
                                <p>{$translations.nostotagging_installed_account_name|escape:'htmlall':'UTF-8'}</p>
                                <div class="panes">
                                    <p>{l s='If you want to change the account, you need to remove the existing one first' mod='nostotagging'}</p>
                                    {if !empty($iframe_url)}<a id="nostotagging_back_to_iframe" class="btn btn-default" role="button">{l s='Back' mod='nostotagging'}</a>{/if}
                                    <button type="submit" onClick="return confirmUninstall(this);" value="1" class="btn btn-red" name="submit_nostotagging_reset_account">{l s='Remove Nosto' mod='nostotagging'}</button>
                                </div>
                            </div>
                            {if !empty($iframe_url)}
                                <iframe id="nostotagging_iframe" frameborder="0" width="100%" scrolling="no" src="{$iframe_url|escape:'htmlall':'UTF-8'}"></iframe>
                            {/if}
                        {else}
                            <h2>{$translations.nostotagging_not_installed_heading|escape:'htmlall':'UTF-8'}</h2>
                            <p>{l s='Do you have an existing Nosto account?' mod='nostotagging'}</p>

                            <div class="form-group">
                                <div class="switch-container">
                                    <span class="switch prestashop-switch fixed-width-lg">
                                        <input type="radio" name="nostotagging_has_account" id="nostotagging_has_account_on" value="1" checked="checked">
                                        <label for="nostotagging_has_account_on">{l s='Yes' mod='nostotagging'}</label>
                                        <input type="radio" name="nostotagging_has_account" id="nostotagging_has_account_off" value="0">
                                        <label for="nostotagging_has_account_off">{l s='No' mod='nostotagging'}</label>
                                        <a class="slide-button btn"></a>
                                    </span>
                                </div>
                            </div>

                            <div class="panes">
                                <div id="nostotagging_existing_account_group">
                                    <button type="submit" value="1" class="btn btn-green" name="submit_nostotagging_authorize_account">{l s='Add Nosto' mod='nostotagging'}</button>
                                </div>
                                <div id="nostotagging_new_account_group" style="display:none;">
                                    <div class="form-group">
                                        <label for="nostotagging_account_email">{l s='Email' mod='nostotagging'}</label>
                                        <input type="text" name="nostotagging_account_email" class="form-control" id="nostotagging_account_email" value="{$nostotagging_account_email|escape:'htmlall':'UTF-8'}">
                                    </div>
                                    <button type="submit" value="1" class="btn btn-green" name="submit_nostotagging_new_account">{l s='Create new account' mod='nostotagging'}</button>
                                    <p class="help-block">
                                        {l s='By creating a new account you agree to Nosto\'s' mod='nostotagging'} <a href="http://www.nosto.com/terms" target="_blank">{l s='Terms and Conditions' mod='nostotagging'}</a>
                                    </p>
                                </div>
                            </div>
                        {/if}
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
