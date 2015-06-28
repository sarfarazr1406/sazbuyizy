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
*  International Registred Trademark & Property of PrestaShop SA
*}

<div id="featured-products_block_center" class="block products_block clearfix">
	<h2 class="centertitle_block">{l s='Featured products' mod='tmfeatureproducts'}</h2>
	{if isset($products) AND $products}
		<div class="block_content">
		
			<!-- Megnor start -->
			{if $slider == 1 && $no_prod >= 5}
			{assign var='sliderFor' value=5} <!-- Define Number of product for SLIDER -->
			{assign var='productCount' value=count($homeFeaturedProducts)}
				<div class="customNavigation">
					<a class="btn prev feature_prev"><i class="icon-chevron-sign-left"></i></a>
					<a class="btn next feature_next"><i class="icon-chevron-sign-right"></i></a>
				</div>
				<ul id="feature-carousel" class="tm-carousel product_list">
			{else}
				<ul class="product_list grid row">
			{/if}		
			<!-- Megnor End -->
			
			
			{assign var='nbItemsPerLine' value=4}
			{assign var='nbItemsPerLineTablet' value=3}
			{assign var='nbItemsPerLineMobile' value=2}
			
		{foreach from=$products item=product name=homeFeaturedProducts}
			{math equation="(total%perLine)" total=$smarty.foreach.homeFeaturedProducts.total perLine=$nbItemsPerLine assign=totModulo}
			{math equation="(total%perLineT)" total=$smarty.foreach.homeFeaturedProducts.total perLineT=$nbItemsPerLineTablet assign=totModuloTablet}
			{math equation="(total%perLineT)" total=$smarty.foreach.homeFeaturedProducts.total perLineT=$nbItemsPerLineMobile assign=totModuloMobile}
			{if $totModulo == 0}{assign var='totModulo' value=$nbItemsPerLine}{/if}
			{if $totModuloTablet == 0}{assign var='totModuloTablet' value=$nbItemsPerLineTablet}{/if}
			{if $totModuloMobile == 0}{assign var='totModuloMobile' value=$nbItemsPerLineMobile}{/if}
		
			<li class="{if $slider == 1 && $no_prod >= 5} item {else} ajax_block_product col-xs-12 col-sm-4 col-md-4 {/if} {if $smarty.foreach.homeFeaturedProducts.iteration%$nbItemsPerLine == 0} last-in-line{elseif $smarty.foreach.homeFeaturedProducts.iteration%$nbItemsPerLine == 1} first-in-line{/if}{if $smarty.foreach.homeFeaturedProducts.iteration > ($smarty.foreach.homeFeaturedProducts.total - $totModulo)} last-line{/if}{if $smarty.foreach.homeFeaturedProducts.iteration%$nbItemsPerLineTablet == 0} last-item-of-tablet-line{elseif $smarty.foreach.homeFeaturedProducts.iteration%$nbItemsPerLineTablet == 1} first-item-of-tablet-line{/if}{if $smarty.foreach.homeFeaturedProducts.iteration%$nbItemsPerLineMobile == 0} last-item-of-mobile-line{elseif $smarty.foreach.homeFeaturedProducts.iteration%$nbItemsPerLineMobile == 1} first-item-of-mobile-line{/if}{if $smarty.foreach.homeFeaturedProducts.iteration > ($smarty.foreach.homeFeaturedProducts.total - $totModuloMobile)} last-mobile-line{/if}">
				{include file="$tpl_dir./product-slider.tpl" products=$products class='tmfeatureproducts' id='tmfeatureproducts'}
			</li>
			{/foreach}
			</ul>
		</div>
		
	{else}
		<p>{l s='No featured products' mod='tmfeatureproducts'}</p>
	{/if}
</div>