/**
 * Common behaviour for modules configuration
 *
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
**/

/**
 * Init module interface
 *
 * @param  object $        jQuery
 * @param  object config   module parameters
 * @param  object messages messages to display
 * @return object
 */
;samdha_module = (function($, config, messages) {
    "use strict";

    var samdha_module = {};
    samdha_module.$ = $;
    samdha_module.config = config;
    samdha_module.messages = messages;
    samdha_module.preInit = function() {};
    samdha_module.postInit = function() {};

    /**
     * Display an error message
     *
     * @param string message
     * @returns void
     */
    samdha_module.displayError = function(message) {
        $('#samdha_warper').before('<div class="module_error alert error alert-danger"><span class="alert_close"></span>' + message + '</div>');
    };

    $(document).ready(function() {
        var $ = samdha_module.$;

        $(document).trigger('ajaxStart');

        samdha_module.preInit();
        // backward compatibility
        if (typeof samdhaAdminPreInit === 'function') {
            samdhaAdminPreInit($, config, messages, samdha_module);
        }

        // spinner
        var input = document.createElement('input');
        input.setAttribute('type', 'number');

        if (input.type === 'text') {
            $('#samdha_content input[type=number]').spinner();
        }

        // select
        if ($("#samdha_content select:not(.nochosen)").length > 0)
        {
            //$('#samdha_warper').css('visibility', 'hidden').css('display', 'block');
            $("#samdha_content select:not(.nochosen)")
                .chosen({disable_search_threshold: 5})
                .on("chosen:showing_dropdown", function(event, args) {
                    var $container = $(args.chosen.container);

                    var $replacement = $('<div style="display: inline-block;vertical-align: middle;">')
                        .width($container.width())
                        .height($('.chosen-single', $container).outerHeight())
                        .uniqueId();
                    $replacement.insertAfter($container);
                    $(this).data('chosen_replacement_id', $replacement.attr('id'));

                    $container.uniqueId().appendTo('body').css('position', 'absolute').offset($replacement.offset());
                    $('.chosen-drop', $container).css('display', 'block');
                    $(this).data('chosen_id', $container.attr('id'));
                })
                .on("chosen:hiding_dropdown", function(event, args) {
                    var $replacement = $('#' + $(this).data('chosen_replacement_id'));
                    $replacement.remove();
                    var $container = $('#' + $(this).data('chosen_id'));
                    $('.chosen-drop', $container).css('display', 'none');
                    $container.css('position', 'relative').css('top', '').css('left', '').insertAfter(this);
                });
            $('#samdha_content .chosen-container').each(function() {
                $(this).width($(this).width() + 10);
            });
            //$('#samdha_warper').css('display', 'none').css('visibility', 'visible');
        }

        // table
        $('#samdha_content table').each(function() {
            $(this).addClass('ui-widget');
            $('th', this).addClass('ui-widget-header');
            $('tbody', this)
                .addClass('ui-widget-content')
                .on('mouseenter mouseleave', 'tr', function() {
                $('td', this).toggleClass('ui-state-hover');
            });
            //$('tbody>tr', this).filter(":odd").find('td').css('background-color', '#EFEFEF');
        });

        // radio
        $( "#samdha_content .radio" ).buttonset();

        // Tooltips
        $( "#samdha_content *[title]" ).tooltip({
            position: {
                my: "center bottom-20",
                at: "center top",
                using: function( position, feedback ) {
                    $( this ).css( position );
                    $( "<div>" )
                        .addClass( "arrow" )
                        .addClass( feedback.vertical )
                        .addClass( feedback.horizontal )
                        .appendTo( this );
                }
            }
        });

        // Buttons
        $( "#samdha_warper input[type=submit], #samdha_warper input[type=button], #samdha_warper input[type=reset], #samdha_warper .samdha_button, #samdha_warper button" ).button();

        // errors/warn
        $('#content div.warn, #content div.error, #content div.solid_hint, #content div.conf, .bootstrap div.alert').each(function() {
            $('#hideWarn, button.close', this).remove();
            $(this).prepend('<span class="alert_close"></span>');
        });

        // Accordions
        $( "#samdha_content .accordion" ).accordion({heightStyle: "content"});

        // Tabs
        var active_tab = config.active_tab;
        /* test for not a number http://stackoverflow.com/a/1830844 */
        if (!(!isNaN(parseFloat(active_tab)) && isFinite(active_tab))) {
            if ($('#' + active_tab).length) {
                active_tab = $('#' + active_tab).index() - 1;
            } else {
                active_tab = 0;
            }
        }
        $("#samdha_tab").tabs({
            active: active_tab,
            beforeLoad: function(event, ui) {
                /**
                 * create an iframe instead of loading the content
                 */
                if ($('a', ui.tab).attr('rel') === 'iframe') {
                    if (!$(ui.panel).html()) {
                        $(ui.panel)
                            .css({
                                paddingLeft : 0,
                                paddingRight : 0
                            })
                            .html("<iframe style='height: 800px; width: 100%; border: none' src='"+ $("a", ui.tab).attr("href") +"'></iframe>");
                    }
                    return false;
                }
            }
        });

        $(document).ajaxError(function(event, jqXHR, settings, exception) {
            if (jqXHR.status) {
                var message = "Request failed\n";
                message += "\nStatus: " + jqXHR.status + ' ' + jqXHR.statusText;
                if (settings.url) {
                    message += "\nURL: " + settings.url;
                }
                if (jqXHR.responseText) {
                    var responseText = jqXHR.responseText;
                    if (responseText.indexOf('<body>') !== -1) {
                        responseText = $(responseText.substring(responseText.indexOf('<body>'), responseText.indexOf('</body>') + 7)).text();
                    } else if(jqXHR.responseText.indexOf('<BODY>') !== -1) {
                        responseText = $(responseText.substring(responseText.indexOf('<BODY>'), responseText.indexOf('</BODY>') + 7)).text();
                    }
                    message += "\nResponse: " + $.trim(responseText);
                }
                samdha_module.displayError(message.replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1<br/>$2'));
            }
        });

        // Help
        $('.module_help').on('click', function (event) {
            event.preventDefault();
            // open help links in help tab
            var $help_panel = $('div[aria-labelledby="tabHelp"]');
            if ($help_panel.html()) // iframe already created
                $('iframe', $help_panel).attr('src', $(this).attr('href'));
            else
                $('#tabHelp').attr('href', $(this).attr('href'));

            $("#samdha_tab").tabs( "option", "active", $('#tabHelp').parent().index());
            $('html, body').animate({ scrollTop: $('#samdha_tab').position().top }, 500);
        });

        // Support
        $('.module_support, #desc-' + module.short_name + '-register').on('click', function (event) {
            event.preventDefault();
            $("#samdha_tab").tabs( "option", "active", $('#tabSupport').parent().index());
            $('html, body').animate({ scrollTop: $('#samdha_tab').position().top }, 500);
        });

        $('#content').on('click', '.alert_close', function() {
            $(this).parent().hide({
                'effect': 'slide',
                'direction': 'up',
                'complete': function() {
                    $(this).remove();
                }
            });
        });

        // forms
        $('#samdha_tab .ui-tabs-panel').on('submit', 'form', function() {
            if ($('input[name="active_tab"]', this).length === 0) {
                $(this).append(
                    $('<input/>').prop(
                        {
                            type: 'hidden',
                            name: 'active_tab',
                            value: $(this).parent('.ui-tabs-panel').prop('id')
                        }
                    )
                );
            }
        });

        samdha_module.postInit();
        // backward compatibility
        if (typeof samdhaAdminPostInit === 'function') {
            samdhaAdminPostInit($, config, messages, samdha_module);
        }
        $('#samdha_wait').hide();
        $('#samdha_warper').css('visibility', 'visible');
        $(document).trigger('ajaxStop');
    });

    return samdha_module;
})($.noConflict(true), module, messages);
