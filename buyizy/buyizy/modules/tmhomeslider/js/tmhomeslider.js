/*
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
*  @version  Release: $Revision$
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

$(document).ready(function(){

	if (typeof(tmhomeslider_speed) == 'undefined')
		tmhomeslider_speed = 500;
	if (typeof(tmhomeslider_pause) == 'undefined')
		tmhomeslider_pause = 3000;
	if (typeof(tmhomeslider_loop) == 'undefined')
		tmhomeslider_loop = true;
    if (typeof(tmhomeslider_width) == 'undefined')
        tmhomeslider_width = 779;


	if (!!$.prototype.bxSlider)
		$('#tmhomeslider').bxSlider({
			useCSS: false,
			maxSlides: 1,
			slideWidth: tmhomeslider_width,
			infiniteLoop: tmhomeslider_loop,
			hideControlOnEnd: true,
			pager: true,
			autoHover: true,
			auto: tmhomeslider_loop,
			speed: tmhomeslider_speed,
			pause: tmhomeslider_pause,
			controls: true
		});

    $('.tmhomeslider-description').click(function () {
        window.location.href = $(this).prev('a').prop('href');
    });
});