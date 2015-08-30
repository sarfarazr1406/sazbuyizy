{*
* 2007-2014 PrestaShop
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
*  @copyright  2007-2014 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
<div id="contact-link">
	<a href="http://www.buyizy.com/content/14-FAQ">FAQs</a>
</div>
<div id="contact-link">
	<a href="{$link->getPageLink('contact', true)|escape:'html':'UTF-8'}" title="{l s='Contact Us' mod='blockcontact'}">{l s='Contact us' mod='blockcontact'}</a>
</div>
{if $telnumber}
	<span class="shop-phone">
		<span style='margin-right:8px'>Pune |</span><i class="icon-phone"></i>{l s='Call now to order: ' mod='blockcontact'} <strong>{$telnumber}</strong>
	</span>
{/if}
<div>
    <span class="shop-phone1" style="margin-left:100px;margin-top:10px;font-size: 18px;">
	    {l s="Free delivery on orders above Rs. 250"}
	</span>
</div>
