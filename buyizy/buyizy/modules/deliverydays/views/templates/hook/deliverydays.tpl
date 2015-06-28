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
*}</div>
{if $deliverydays_error}
	<div class="error">
		<p>{l s='Delivery day is required' mod='deliverydays'}</p>
	</div>
{/if}
<div class="addresses" style="margin-top: 20px">
	<div id="ordermsg" class="clearfix">
		<p class="txt">
			<label for="deliverydays_day">{l s='Please choose a delivery day' mod='deliverydays'}</label>
		</p>
		<div class="textarea" style="float: left; margin-bottom: 1em; padding-left: 1.4em;">
			<select id="deliverydays_day" name="deliverydays_day">
					<option value=""></option>
				{foreach from=$deliverydays item=day name='deliverydays_loop'}
					{if $smarty.foreach.deliverydays_loop.first}{assign value=$day var='first_day'}{/if}
					{if $smarty.foreach.deliverydays_loop.last}{assign value=$day var='last_day'}{/if}
					<option value="{$day|escape:'htmlall':'UTF-8'}" {if $day==$selected_day.date}selected="selected"{/if}>{dateFormat date=$day}</option>
				{/foreach}
			</select>
			<div id="deliverydays_picker"></div>
		</div>
		{if $timeframe}
		<p class="txt clear">
			<label for="deliverydays_timeframe">{l s='Delivery time frame' mod='deliverydays'}</label>
		</p>
		<div class="textarea" style="float: left; margin-bottom: 1em; padding-left: 1.4em;">
			<select id="deliverydays_timeframe" name="deliverydays_timeframe">
				{foreach from=$timeframe item=frame name="delivery_loop"}
				    {if $smarty.foreach.delivery_loop.first}{assign value=0 var='slot_no'}
					{elseif $smarty.foreach.delivery_loop.last}{assign value=2 var='slot_no'}
					{else}{assign value=1 var='slot_no'}
					
					{/if}
					{if $slot_no == 0}					
					    {if ((int)$smarty.now|date_format:"%H") >= 8}
						    
					            <option id="dateslot1" disabled="disabled" value="{$slot_no}" {if $frame==$selected_day.timeframe}selected="selected"{/if}>{$frame|escape:'htmlall':'UTF-8'}</option>
					        {else}
					            <option id="dateslot1" "value="{$frame|escape:'htmlall':'UTF-8'}" {if $frame==$selected_day.timeframe}selected="selected"{/if}>{$frame|escape:'htmlall':'UTF-8'}</option>
							
					    {/if}
					{/if}
						
					{if $slot_no == 1}
					    {if ((int)$smarty.now|date_format:"%H") >= 13}
						    
					            <option id="dateslot2" disabled="disabled" value="{$frame|escape:'htmlall':'UTF-8'}" {if $frame==$selected_day.timeframe}selected="selected"{/if}>{$frame|escape:'htmlall':'UTF-8'}</option>
					        {else}
					            <option id="dateslot2" value="{$frame|escape:'htmlall':'UTF-8'}" {if $frame==$selected_day.timeframe}selected="selected"{/if}>{$frame|escape:'htmlall':'UTF-8'}</option>
							
					    {/if}
					{/if}
					
					{if $slot_no == 2}
					    {if ((int)$smarty.now|date_format:"%H") >= 18}
						        <option id="dateslot3" disabled="disabled" value="{$frame|escape:'htmlall':'UTF-8'}" {if $frame==$selected_day.timeframe}selected="selected"{/if}>{$frame|escape:'htmlall':'UTF-8'}</option>
					        {else}
					            <option id="dateslot3" value="{$frame|escape:'htmlall':'UTF-8'}" {if $frame==$selected_day.timeframe}selected="selected"{/if}>{$frame|escape:'htmlall':'UTF-8'}</option>
							
					    {/if}
					{/if}
				{/foreach}
			</select>
		</div>
		{else}
			<input type="hidden" name="deliverydays_timeframe" value=""/>
		{/if}
	</div>
{literal}<script type="text/javascript">
	$(document).ready(function() {
		$('#deliverydays_day').hide();
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
				var selectedDate = dateText.split("-");
				var date = new Date();
				var day = date.getDate();
				var hrs = date.getHours();
				if(day == selectedDate[2]) {
				    
					if(hrs > 8) {
					    document.getElementById("deliverydays_timeframe").options[0].disabled = true;
						document.getElementById("dateslot2").selected = true;
					}
					if(hrs > 13) {
					    document.getElementById("deliverydays_timeframe").options[1].disabled = true;
						document.getElementById("dateslot3").selected = true;
					}
					if(hrs > 18) {
					    document.getElementById("deliverydays_timeframe").options[2].disabled = true;
					}
				}
				else {
				    document.getElementById("deliverydays_timeframe").options[0].disabled = false;
					document.getElementById("deliverydays_timeframe").options[1].disabled = false;
					document.getElementById("deliverydays_timeframe").options[2].disabled = false;
					document.getElementById("dateslot1").selected = true;
				}
				
			}
		});
	});
</script>
<style type="text/css">
	.ui-datepicker .ui-icon-circle-triangle-w,
	.ui-datepicker .ui-icon-circle-triangle-e {
		text-indent : -500em;
	}
</style>{/literal}