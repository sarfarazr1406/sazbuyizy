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
<div style="font-size: 9pt; color: #444">

<table>
	<tr><td>&nbsp;</td></tr>
</table>

<!-- ADDRESSES -->
<table style="width: 100%; font-size: 13pt; color: #000;">
	<tr>
		<td style="width: 48%;"><span style="font-weight: bold;">{l s='Billing Address' pdf='true'}</span></td>
		<td style="width: 4%">&nbsp;</td>
		<td style="width: 48%;"><span style="font-weight: bold;">{l s='Delivery Address' pdf='true'}</span></td>
	</tr>
	<tr>
		<td style="height: 105px;"><br /><br />{if empty($invoice_address)}{$delivery_address}{else}{$invoice_address}{/if}</td>
		<td>&nbsp;</td>
		<td style="height: 105px;"><br /><br />{if empty($delivery_address)}{$invoice_address}{else}{$delivery_address}{/if}</td>
	</tr>
</table>
<!-- / ADDRESSES -->

<br /><br />

<table>
	<tr><td style="line-height: 8px">&nbsp;</td></tr>
</table>
<table style="width: 100%; text-align: center; border: 1px solid #CCC; font-size: 9pt;">
	<tr>
		<td style="width: 33%; background-color: #CCC; color: #000;">
			<b>{l s='Order Reference:' pdf='true'}</b>
		</td>
		<td style="width: 33%; background-color: #CCC; color: #000;">
			<b>{l s='Order Date:' pdf='true'}</b>
		</td>
		<td style="width: 34%; background-color: #CCC; color: #000;">
			<b>{l s='Payment Method:' pdf='true'}</b>
		</td>
	</tr>
	<tr>
		<td style="width: 33%;">
			{$order->getUniqReference()}
		</td>
		<td style="width: 33%;">
			{$order->date_add|date_format:"%d-%m-%Y %H:%M"}
		</td>
		<td style="width: 34%;">
			{foreach from=$order_invoice->getOrderPaymentCollection() item=payment}
				<b>{$payment->payment_method}</b> : {displayPrice price=$payment->amount currency=$order->id_currency}
			{foreachelse}
				{l s='No payment' pdf='true'}
			{/foreach}
		</td>
	</tr>
</table>

<table>
	<tr><td style="line-height: 8px">&nbsp;</td></tr>
</table>

<!-- PRODUCTS TAB -->
<table style="width: 100%; font-size: 8pt;">
	<tr style="line-height:4px;">
		<!-- <td style="text-align: left; background-color: #CCC; color: #000; padding-left: 10px; font-weight: bold; width: 12%">{l s='Reference' pdf='true'}</td> -->
		<td style="text-align: left; background-color: #CCC; color: #000; padding-left: 10px; font-weight: bold; width: 75%">{l s='Product' pdf='true'}</td>
		<td style="background-color: #CCC; color: #000; text-align: center; font-weight: bold; width: 12.5%">{l s='Qty' pdf='true'}</td>
		<td style="background-color: #CCC; color: #000; text-align: right; font-weight: bold; width: 12.5%">
			{l s='Total' pdf='true'}
			{if $tax_excluded_display}
				{l s='(Tax Excl.)' pdf='true'}
			{else}
				{l s='(Tax Incl.)' pdf='true'}
			{/if}
		</td>
		
	</tr>
	<!-- PRODUCTS -->
	{foreach $order_details as $order_detail}
	{cycle values='#FFF,#EEE' assign=bgcolor}
	<tr style="line-height:6px;background-color:{$bgcolor};">
		<!-- <td style="text-align: center;">
			{if !empty($order_detail.product_reference)}
				{$order_detail.product_reference}
			{else}
				--
			{/if}
		</td> -->
		<td style="text-align: left;">{$order_detail.product_name}</td>
		<td style="text-align: center;">{$order_detail.product_quantity}</td><td style="text-align: right;">
		{if $tax_excluded_display}
			{displayPrice currency=$order->id_currency price=$order_detail.total_price_tax_excl}
		{else}
			{displayPrice currency=$order->id_currency price=$order_detail.total_price_tax_incl}
		{/if}
		</td>
		
	</tr>
		{foreach $order_detail.customizedDatas as $customizationPerAddress}
			{foreach $customizationPerAddress as $customizationId => $customization}
				<tr style="line-height:6px;background-color:{$bgcolor}; ">
					<td style="line-height:3px; text-align: left; width: 60%; vertical-align: top">

							<blockquote>
								{if isset($customization.datas[$smarty.const._CUSTOMIZE_TEXTFIELD_]) && count($customization.datas[$smarty.const._CUSTOMIZE_TEXTFIELD_]) > 0}
									{foreach $customization.datas[$smarty.const._CUSTOMIZE_TEXTFIELD_] as $customization_infos}
										{$customization_infos.name}: {$customization_infos.value}
										{if !$smarty.foreach.custo_foreach.last}<br />
										{else}
										<div style="line-height:0.4pt">&nbsp;</div>
										{/if}
									{/foreach}
								{/if}

								{if isset($customization.datas[$smarty.const._CUSTOMIZE_FILE_]) && count($customization.datas[$smarty.const._CUSTOMIZE_FILE_]) > 0}
									{count($customization.datas[$smarty.const._CUSTOMIZE_FILE_])} {l s='image(s)' pdf='true'}
								{/if}
							</blockquote>
					</td>
					<td style="text-align: right; width: 15%"></td>
					<td style="text-align: center; width: 10%; vertical-align: top">({$customization.quantity})</td>
					<td style="width: 15%; text-align: right;"></td>
				</tr>
			{/foreach}
		{/foreach}
	{/foreach}
	<!-- END PRODUCTS -->


<table>
	<tr><td style="line-height: 8px">&nbsp;</td></tr>
</table>

{if isset($HOOK_DISPLAY_PDF)}
	<div style="line-height: 1pt">&nbsp;</div>
	<table style="width: 100%">
		<tr>
			<td style="width: 15%"></td>
			<td style="width: 85%">
				{$HOOK_DISPLAY_PDF}
			</td>
		</tr>
	</table>
{/if}

</div>

