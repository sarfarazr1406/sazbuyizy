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
<head>
    {literal}
	<!-- Facebook Conversion Code for Checkout- Sarfaraz -->
    <script>(function() {
        var _fbq = window._fbq || (window._fbq = []);
        if (!_fbq.loaded) {
            var fbds = document.createElement('script');
            fbds.async = true;
            fbds.src = '//connect.facebook.net/en_US/fbds.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(fbds, s);
            _fbq.loaded = true;
        }
    })();
    window._fbq = window._fbq || [];
    window._fbq.push(['track', '6027337779003', {'value':'0.00','currency':'INR'}]);
    </script>
    <noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?ev=6027337779003&amp;cd[value]=0.00&amp;cd[currency]=INR&amp;noscript=1" /></noscript>
	{/literal}
</head>
<div class="box">
    <p>{l s='Congratulations! You have successfully placed your order on Buyizy.com.' mod='cashondelivery'}
        <br />
        {l s='Payment Method - Cash on Delivery ' mod='cashondelivery'}
        <br /><span class="bold">{l s='Your order will be delivered soon.' mod='cashondelivery'}</span>
        <br />{l s='For any questions or for further information, please contact our' mod='cashondelivery'} <span><a href="{$link->getPageLink('contact-form', true)|escape:'html'}"><font color="green"><u><b>{l s='customer support' mod='cashondelivery'}</b></u></font></a>.</span>
    </p>
</div>