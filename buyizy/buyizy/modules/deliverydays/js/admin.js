/**
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this module to newer
 * versions in the future. If you wish to customize this module for your
 * needs please refer to http://doc.prestashop.com/display/PS15/Overriding+default+behaviors
 * #Overridingdefaultbehaviors-Overridingamodule%27sbehavior for more information.
 *
 * @category Prestashop
 * @category Module
 * @author Samdha <contact@samdha.net>
 * @copyright Samdha
 * @license commercial license see license.txt
 */

;samdha_module.postInit = function () {
    "use strict";

    var $ = samdha_module.$;
    var config = samdha_module.config;
console.log($.datepicker.regional);
    $("#samdha_content textarea.timeframe")
        .data('linenumber', false)
        .on('focus', function() {
            if (!$(this).data('linenumber'))
            {
                $(this)
						.linenumbers()
						.data('linenumber', true)
						.focus();
            }
        });

    $.datepicker.setDefaults( $.datepicker.regional[ config.iso_code ] );

    // display exception dates in a calendar
    $('#samdha_content .setting_exception').each(function () {
        if ($('input', this).val())
        {
            var dates = $('input', this).val().split(',');
            $('.setting_exception_datepicker', this).multiDatesPicker({
                dateFormat: 'yy-mm-dd',
                altField: '#' + $('input', this).prop('id'),
                addDates: dates
            });
        } else
            $('.setting_exception_datepicker', this).multiDatesPicker({
                dateFormat: 'yy-mm-dd',
                altField: '#' + $('input', this).prop('id')
            });
        $('.setting_exception_div', this).hide();
    });

    $('#samdha_content input[type=radio]').on('change', function() {
        var name = $(this).attr('name');
        if (name.indexOf('setting[enabled') === 0) {
            $("#day_by_group")
                .accordion('option', 'collapsible', true)
                .accordion('option', 'active', false);
        }
        if ($('#samdha_content input[type=radio][name="' + name + '"]:checked').attr('value') === '1') {
            $('#samdha_content .' + $('#samdha_content input[type=radio][name="' + name + '"][value=1]').attr('id')).show();
            $('#samdha_content .' + $('#samdha_content input[type=radio][name="' + name + '"][value=0]').attr('id')).hide();
        } else {
            $('#samdha_content .' + $('#samdha_content input[type=radio][name="' + name + '"][value=1]').attr('id')).hide();
            $('#samdha_content .' + $('#samdha_content input[type=radio][name="' + name + '"][value=0]').attr('id')).show();
        }
        if (name.indexOf('setting[enabled') === 0) {
            var index = false;
            $("#samdha_content #day_by_group h3").each(function(i) {
                if ((index === false) && ($(this).css('display') !== 'none')) {
                    index = i;
                }
            });
            if (index !== false) {
                $("#samdha_content #day_by_group")
                    .accordion('option', 'active', index)
                    .accordion('option', 'collapsible', false);
            }
        }
    }).change();
};
