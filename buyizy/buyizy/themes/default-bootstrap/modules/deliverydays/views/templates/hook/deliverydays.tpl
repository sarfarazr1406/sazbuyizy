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
			<label for="deliverydays_day">{l s='Please choose a delivery day (Select a date to choose delivery slots)' mod='deliverydays'}</label>
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
		{assign value=0 var='slot_no'}
			<select id="deliverydays_timeframe" name="deliverydays_timeframe" disabled>
				{foreach from=$timeframe item=frame name="delivery_loop"}
				    {$slot_no =  $delivery_loop@iteration}
					{if $slot_no == 0}					
					    {if ((int)$smarty.now|date_format:"%H") >= 0}						    
					            <option id="dateslot1" disabled="disabled" value="{$frame|escape:'htmlall':'UTF-8'}" {if $frame==$selected_day.timeframe}selected="selected"{/if}>{$frame|escape:'htmlall':'UTF-8'}</option>
					        {else}
					            <option id="dateslot1" value="{$frame|escape:'htmlall':'UTF-8'}" {if $frame==$selected_day.timeframe}selected="selected"{/if}>{$frame|escape:'htmlall':'UTF-8'}</option>
						{/if}
					{/if}
						
					{if $slot_no == 1}
					    {if ((int)$smarty.now|date_format:"%H") >= 0}
						    
					            <option id="dateslot2" disabled="disabled" value="{$frame|escape:'htmlall':'UTF-8'}" {if $frame==$selected_day.timeframe}selected="selected"{/if}>{$frame|escape:'htmlall':'UTF-8' }</option>
					        {else}
					            <option id="dateslot2" value="{$frame|escape:'htmlall':'UTF-8'}" {if $frame==$selected_day.timeframe}selected="selected"{/if}>{$frame|escape:'htmlall':'UTF-8'}</option>
							
					    {/if}
					{/if}
					
					{if $slot_no == 2}
					    {if ((int)$smarty.now|date_format:"%H") >= 14}
						        <option id="dateslot3" disabled="disabled" value="{$frame|escape:'htmlall':'UTF-8'}" {if $frame==$selected_day.timeframe}selected="selected"{/if}>{$frame|escape:'htmlall':'UTF-8'}</option>
					        {else}
					            <option id="dateslot3" value="{$frame|escape:'htmlall':'UTF-8'}" {if $frame==$selected_day.timeframe}selected="selected"{/if}>{$frame|escape:'htmlall':'UTF-8'}</option>
							
					    {/if}
					{/if}
					
					{if $slot_no == 3}
					    {if ((int)$smarty.now|date_format:"%H") >= 17}
						        <option id="dateslot4" disabled="disabled" value="{$frame|escape:'htmlall':'UTF-8'}" {if $frame==$selected_day.timeframe}selected="selected"{/if}>{$frame|escape:'htmlall':'UTF-8'}</option>
					        {else}
					            <option id="dateslot4" value="{$frame|escape:'htmlall':'UTF-8'}" {if $frame==$selected_day.timeframe}selected="selected"{/if}>{$frame|escape:'htmlall':'UTF-8'}</option>
					    {/if}
					{/if}
					
				{/foreach}
			</select>
		</div>
		<div style="float: left; margin-bottom: 1em; padding-left: 1.4em;">
		    <div id="notSelectedMsdDiv">
		        <strong><span id="notSelectedDateMsg" style="color: #de0064">You havn't selected any timeslot yet.</span></strong>
		    </div>
		    <div id="selectedMsdDiv" style="display: none;color: #006400">
		        <span>You have selected <strong><span id="selDate"></span>and<span id="selTime"></span></strong>as your date and time slot.</span>
		    </div>
		    <div style="clear: both"></div>
		</div>
		{else}
			<input type="hidden" name="deliverydays_timeframe" value=""/>
		{/if}
	</div>
{literal}<script type="text/javascript">
    
	$(document).ready(function() {
	    var dateSelected = false;
	    var selectedDateG = null;
		$('#deliverydays_day').hide();
		$('#deliverydays_timeframe').change(function(){
		    document.getElementById("selTime").innerHTML=" " + document.getElementById("deliverydays_timeframe").value + " ";
	        });
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
			    $('#notSelectedMsdDiv').hide();
			    $('#selectedMsdDiv').show();
			    dateSelected = true;
				$('#deliverydays_day').val(dateText);
				var selectedDate = dateText.split("-");
				selectedDateG = dateText;
				var date = new Date();
				var tomo = new Date(date);
				tomo.setDate(date.getDate() + 1);
                var day = date.getDate();
				var hrs = date.getHours();
				var month = date.getMonth();
				var tomoDate = tomo.getDate();
				var selectTime=document.getElementById("deliverydays_timeframe");		
				selectTime.disabled=false;
				var weekday = new Array();
                                weekday[6] = "Sunday";
				weekday[0] = "Monday";
				weekday[1] = "Tuesday";
				weekday[2] = "Wednesday";
				weekday[3] = "Thursday";
				weekday[4] = "Friday";
				weekday[5] = "Saturday";
				if(day == selectedDate[2]) {
				    if (hrs < 12) {
				        document.getElementById("deliverydays_timeframe").options[0].disabled = true;
				        document.getElementById("deliverydays_timeframe").options[1].disabled = true;
				        document.getElementById("deliverydays_timeframe").options[2].disabled = false;
				        document.getElementById("deliverydays_timeframe").options[3].disabled = false;
				        selectTime.options[2].selected=true;
				        document.getElementById("selDate").innerHTML=" " + selectedDateG + " (Today) ";
				        document.getElementById("selTime").innerHTML=" " + document.getElementById("deliverydays_timeframe").value + " ";
				    }
                                    if (hrs >= 12 && hrs < 14) {
                                        document.getElementById("deliverydays_timeframe").options[0].disabled = true;
                                        document.getElementById("deliverydays_timeframe").options[1].disabled = true;
                                        document.getElementById("deliverydays_timeframe").options[2].disabled = true;
                                        document.getElementById("deliverydays_timeframe").options[3].disabled = false;
										selectTime.options[3].selected=true;
                                        document.getElementById("selDate").innerHTML=" " + selectedDateG + " (Today) ";
                                        document.getElementById("selTime").innerHTML=" " + document.getElementById("deliverydays_timeframe").value + " ";
                                    } else if (hrs >= 14){
                                          document.getElementById("deliverydays_timeframe").disabled = true;
                                          $('#selectedMsdDiv').hide();
                                          alert("The slots are full. Please select another date.");
                                          $('#notSelectedMsdDiv').show();
                                    }
                                    
				}
				else if (tomoDate == selectedDate[2]) {
				if(hrs >= 21 ) {
					    document.getElementById("deliverydays_timeframe").options[0].disabled = true;
						document.getElementById("deliverydays_timeframe").options[1].disabled = false;
					    document.getElementById("deliverydays_timeframe").options[2].disabled = false;
						document.getElementById("deliverydays_timeframe").options[3].disabled = false;
						selectTime.options[1].selected=true;
						document.getElementById("selDate").innerHTML=" " + selectedDateG + " (Tomorrow) ";
			            document.getElementById("selTime").innerHTML=" " + document.getElementById("deliverydays_timeframe").value + " ";
						
					} else if (hrs >= 23) {
				        document.getElementById("deliverydays_timeframe").options[0].disabled = true;
						document.getElementById("deliverydays_timeframe").options[1].disabled = true;
					    document.getElementById("deliverydays_timeframe").options[2].disabled = false;
						document.getElementById("deliverydays_timeframe").options[3].disabled = false;
						selectTime.options[2].selected=true;
						document.getElementById("selDate").innerHTML=" " + selectedDateG + " (Tomorrow) ";
			            document.getElementById("selTime").innerHTML=" " + document.getElementById("deliverydays_timeframe").value + " ";
				    } else {
					    document.getElementById("deliverydays_timeframe").options[0].disabled = false;
					    document.getElementById("deliverydays_timeframe").options[1].disabled = false;
					    document.getElementById("deliverydays_timeframe").options[2].disabled = false;
					    document.getElementById("deliverydays_timeframe").options[3].disabled = false;
					    selectTime.options[0].selected=true;
						document.getElementById("selDate").innerHTML=" " + selectedDateG + " (Tomorrow)  ";
			            document.getElementById("selTime").innerHTML=" " + document.getElementById("deliverydays_timeframe").value + " ";
					}
				}
				else {
				    document.getElementById("deliverydays_timeframe").options[0].disabled = false;
					document.getElementById("deliverydays_timeframe").options[1].disabled = false;
					document.getElementById("deliverydays_timeframe").options[2].disabled = false;
					document.getElementById("deliverydays_timeframe").options[3].disabled = false;
					selectTime.options[0].selected=true;
					document.getElementById("selDate").innerHTML=" " + selectedDateG + " (" + weekday[($(this).datepicker('getDate').getUTCDay())] + ") ";
			        document.getElementById("selTime").innerHTML=" " + document.getElementById("deliverydays_timeframe").value + " ";
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