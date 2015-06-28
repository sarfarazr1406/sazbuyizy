{*
 * Delivery days module
 *
 * @category Prestashop
 * @category Module
 * @author Samdha <contact@samdha.net>
 * @copyright Samdha
 * @license http://www.opensource.org/licenses/osl-3.0.php Open-source licence 3.0
 * @license logo http://www.gnu.org/copyleft/gpl.html
 * @author logo http://code.google.com/u/newmooon/
 * @version 1.6.1.0
*}
<div id="deliverydays">
	<p>
		<label for="deliverydays_day">{l s='Please choose a delivery day' mod='deliverydays'}</label>
		<select id="deliverydays_day" name="deliverydays_day">
				<option value=""></option>
			{foreach from=$deliverydays item=day name='deliverydays_loop'}
				{if $smarty.foreach.deliverydays_loop.first}{assign value=$day var='first_day'}{/if}
				{if $smarty.foreach.deliverydays_loop.last}{assign value=$day var='last_day'}{/if}
				<option value="{$day|escape:'htmlall':'UTF-8'}" {if $day==$selected_day.date}selected="selected"{/if}>{dateFormat date=$day}</option>
			{/foreach}
		</select>
	</p>
	<div id="deliverydays_picker" style="clear: both; margin: 0 auto; width: 204px;"></div>
	{if $timeframe}
	<p>
		<label for="deliverydays_timeframe">{l s='Delivery time frame' mod='deliverydays'}</label>
		<select id="deliverydays_timeframe" name="deliverydays_timeframe">
			{foreach from=$timeframe item=frame}
				<option value="{$frame|escape:'htmlall':'UTF-8'}" {if $frame==$selected_day.timeframe}selected="selected"{/if}>{$frame|escape:'htmlall':'UTF-8'}</option>
			{/foreach}
		</select>
	</p>
	{else}
		<input type="hidden" id="deliverydays_timeframe" name="deliverydays_timeframe" value=""/>
	{/if}
</div>
{literal}<script type="text/javascript"><!--
	$(document).ready(function() {
		$('#deliverydays.moved').remove();
		$('#deliverydays_day').hide();
		$('#extra_carrier').after($('#deliverydays'));
		$('#deliverydays').addClass('moved');
		$('#deliverydays label:first').replaceWith('<h3>'+$('#deliverydays label:first').text()+'</h3>');
		$('#deliverydays_picker').datepicker({
			dateFormat: 'yy-mm-dd',
			hideIfNoPrevNext: true,
			{/literal}minDate: $.datepicker.parseDate('yy-mm-dd', '{$first_day|escape:'javascript':'UTF-8'}'),
			maxDate: $.datepicker.parseDate('yy-mm-dd', '{$last_day|escape:'javascript':'UTF-8'}'),
			{if $selected_day && ($selected_day.date >= $deliverydays.0)}defaultDate: $.datepicker.parseDate('yy-mm-dd', '{$selected_day.date|escape:'javascript':'UTF-8'}'),{/if}{literal}
   			beforeShowDay: function(date) {
				window.setTimeout(function(){
					$('#deliverydays_picker a.ui-state-highlight').removeClass('ui-state-highlight ui-state-hover')      
				},0);
				dateformated = $.datepicker.formatDate('yy-mm-dd',date);
				{/literal}{foreach from=$deliverydays item=day name=deliverydays}
					if (dateformated == '{$day|escape:'javascript':'UTF-8'}') return [true, '']; else
				{/foreach}{literal}
				return [false, ''];
			},
			onSelect: function(dateText, inst) {
				$('#deliverydays_day').val(dateText);

				$('#opc_delivery_methods-overlay').fadeIn('slow');
				$.ajax({
				   type: 'POST',
				   url: '{/literal}{$this_path|escape:'javascript':'UTF-8'}{literal}order-opc.php?controller=order-opc',
				   async: false,
				   cache: false,
				   dataType : "json",
				   data: 'ajax=true&method=updateDeliveryDay&deliveryday=' + encodeURIComponent($('#deliverydays_day').val()) + '&timeframe=' + $('#deliverydays_timeframe').val() + '&token=' + static_token ,
				   success: function(json)
				   {
						$('div#HOOK_TOP_PAYMENT').html(json.HOOK_TOP_PAYMENT);
						$('#opc_payment_methods-content div#HOOK_PAYMENT').html(json.HOOK_PAYMENT);
						$('#opc_delivery_methods-overlay').fadeOut('slow');
					},
				   error: function(XMLHttpRequest, textStatus, errorThrown) {alert("TECHNICAL ERROR: unable to save message \n\nDetails:\nError thrown: " + XMLHttpRequest + "\n" + 'Text status: ' + textStatus);}
			   });
			}
		});
		$('#deliverydays_timeframe').change( function() {
			$('#opc_delivery_methods-overlay').fadeIn('slow');
			$.ajax({
			   type: 'POST',
			   url: '{/literal}{$this_path|escape:'javascript':'UTF-8'}{literal}order-opc.php?controller=order-opc',
			   async: false,
			   cache: false,
			   dataType : "json",
			   data: 'ajax=true&method=updateDeliveryDay&deliveryday=' + encodeURIComponent($('#deliverydays_day').val()) + '&timeframe=' + $('#deliverydays_timeframe').val() + '&token=' + static_token ,
			   success: function(json)
			   {
					$('div#HOOK_TOP_PAYMENT').html(json.HOOK_TOP_PAYMENT);
					$('#opc_payment_methods-content div#HOOK_PAYMENT').html(json.HOOK_PAYMENT);
					$('#opc_delivery_methods-overlay').fadeOut('slow');
				},
			   error: function(XMLHttpRequest, textStatus, errorThrown) {alert("TECHNICAL ERROR: unable to save message \n\nDetails:\nError thrown: " + XMLHttpRequest + "\n" + 'Text status: ' + textStatus);}
		   });
		});		
	});
//--></script>
<style type="text/css">
	.ui-datepicker .ui-icon-circle-triangle-w,
	.ui-datepicker .ui-icon-circle-triangle-e {
		text-indent : -500em;
	}
</style>{/literal}
