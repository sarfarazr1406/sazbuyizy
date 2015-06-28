{*
* 2007-2015 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2015 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}

<h2>{l s='Order confirmed' mod='powatag'}</h2>

<p>
{l s='An order has been successfully created.' mod='powatag'}<br/>
{l s='If you need to contact the merchant because of the order please use the following reference : ' mod='powatag'} {$order->reference|escape:'html':'UTF-8'}.<br/>
{l s='The order state is : ' mod='powatag'} {$state->name|escape:'html':'UTF-8'}. <br/>
</p>

<p>
	{l s='You can visit the shop by clicking' mod='powatag'} <a href="{$link->getPageLink('index')|escape:'html':'UTF-8'}"> {l s='here' mod='powatag'}</a>
</p>