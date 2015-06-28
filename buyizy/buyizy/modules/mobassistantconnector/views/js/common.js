/**
 *    This file is part of Mobile Assistant Connector.
 *
 *   Mobile Assistant Connector is free software: you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation, either version 3 of the License, or
 *   (at your option) any later version.
 *
 *   Mobile Assistant Connector is distributed in the hope that it will be useful,
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *   GNU General Public License for more details.
 *
 *   You should have received a copy of the GNU General Public License
 *   along with Mobile Assistant Connector.  If not, see <http://www.gnu.org/licenses/>.
 *
 *  @author    eMagicOne <contact@emagicone.com>
 *  @copyright 2014-2015 eMagicOne
 *  @license   http://www.gnu.org/licenses   GNU General Public License
 */

$(document).ready(function() {
    var password           = $('#mobassistantconnector_password');
    var login              = $('#mobassistantconnector_login');
    var password_value_old = password.val();
    var login_value_old    = login.val();

    var mobassistantconnector_div_qrcode = '<div id="mobassistantconnector_div_qrcode" style="position: relative;">' +
        '<div id="mobassistantconnector_div_qrcode_img"></div>' +
        '<div id="mobassistantconnector_div_qrcode_changed" style="display: none; position: absolute; color: red; z-index: 1000; top: 100px; left: 15px; width: 230px;">' +
        'Login details have been changed. Save changes for code to be regenerated</div></div>';

    $('#mobassistantconnector_qrcode').parent().append(mobassistantconnector_div_qrcode);

    var qrcode = new QRCode(document.getElementById('mobassistantconnector_div_qrcode_img'), {
        width : 250,
        height : 250
    });
    qrcode.makeCode($('#mobassistantconnector_qr_data').val());

    var links = '<div style="text-align: right; padding: 0px 10px 15px 0px;">' +
        '<a href="https://support.emagicone.com/submit_ticket" target="_blank">Submit ticket</a>&nbsp;|&nbsp;' +
        '<a href="http://mobile-store-assistant-help.emagicone.com/3-prestashop-mobile-assistant-installation-instructions" target="_blank">Documentation</a></div>';
    $(login).parent().parent().prepend(links);


    login.keyup(function() {
        changeQRCode();
    });

    password.keyup(function() {
        changeQRCode();
    });

    function changeQRCode() {
        var login_new       = login.val();
        var password_new    = password.val();
        var qrcode_changed  = $('#mobassistantconnector_div_qrcode_changed');
        var qrcode_img      = $('#mobassistantconnector_div_qrcode_img');

        if (login_value_old != login_new || password_value_old != password_new) {
            $(qrcode_changed).show('fast');
            $(qrcode_img).css('opacity', '0.1');
        } else {
            $(qrcode_changed).hide('fast');
            $(qrcode_img).css('opacity', '1');
        }
    }
});