<?php /* Smarty version Smarty-3.1.19, created on 2015-06-21 20:51:55
         compiled from "/home/buyizy/public_html/themes/default-bootstrap/modules/deliverydays/views/templates/hook/deliverydays.tpl" */ ?>
<?php /*%%SmartyHeaderCode:204029695955744f124d1343-21219566%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '328e07845caf471be314083d1c465055ea8a9a75' => 
    array (
      0 => '/home/buyizy/public_html/themes/default-bootstrap/modules/deliverydays/views/templates/hook/deliverydays.tpl',
      1 => 1434879889,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '204029695955744f124d1343-21219566',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_55744f126356a9_00744191',
  'variables' => 
  array (
    'deliverydays_error' => 0,
    'deliverydays' => 0,
    'day' => 0,
    'selected_day' => 0,
    'timeframe' => 0,
    'slot_no' => 0,
    'frame' => 0,
    'first_day' => 0,
    'last_day' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55744f126356a9_00744191')) {function content_55744f126356a9_00744191($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/home/buyizy/public_html/tools/smarty/plugins/modifier.date_format.php';
?></div>
<?php if ($_smarty_tpl->tpl_vars['deliverydays_error']->value) {?>
	<div class="error">
		<p><?php echo smartyTranslate(array('s'=>'Delivery day is required','mod'=>'deliverydays'),$_smarty_tpl);?>
</p>
	</div>
<?php }?>
<div class="addresses" style="margin-top: 20px">
	<div id="ordermsg" class="clearfix">
		<p class="txt">
			<label for="deliverydays_day"><?php echo smartyTranslate(array('s'=>'Please choose a delivery day (Select a date to choose delivery slots)','mod'=>'deliverydays'),$_smarty_tpl);?>
</label>
		</p>
		<div class="textarea" style="float: left; margin-bottom: 1em; padding-left: 1.4em;">
			<select id="deliverydays_day" name="deliverydays_day">
					<option value=""></option>
				<?php  $_smarty_tpl->tpl_vars['day'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['day']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['deliverydays']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['day']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['day']->iteration=0;
 $_smarty_tpl->tpl_vars['day']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['day']->key => $_smarty_tpl->tpl_vars['day']->value) {
$_smarty_tpl->tpl_vars['day']->_loop = true;
 $_smarty_tpl->tpl_vars['day']->iteration++;
 $_smarty_tpl->tpl_vars['day']->index++;
 $_smarty_tpl->tpl_vars['day']->first = $_smarty_tpl->tpl_vars['day']->index === 0;
 $_smarty_tpl->tpl_vars['day']->last = $_smarty_tpl->tpl_vars['day']->iteration === $_smarty_tpl->tpl_vars['day']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['deliverydays_loop']['first'] = $_smarty_tpl->tpl_vars['day']->first;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['deliverydays_loop']['last'] = $_smarty_tpl->tpl_vars['day']->last;
?>
					<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['deliverydays_loop']['first']) {?><?php $_smarty_tpl->tpl_vars['first_day'] = new Smarty_variable($_smarty_tpl->tpl_vars['day']->value, null, 0);?><?php }?>
					<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['deliverydays_loop']['last']) {?><?php $_smarty_tpl->tpl_vars['last_day'] = new Smarty_variable($_smarty_tpl->tpl_vars['day']->value, null, 0);?><?php }?>
					<option value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['day']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['day']->value==$_smarty_tpl->tpl_vars['selected_day']->value['date']) {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['dateFormat'][0][0]->dateFormat(array('date'=>$_smarty_tpl->tpl_vars['day']->value),$_smarty_tpl);?>
</option>
				<?php } ?>
			</select>
			<div id="deliverydays_picker"></div>
		</div>
		<?php if ($_smarty_tpl->tpl_vars['timeframe']->value) {?>
		<p class="txt clear">
			<label for="deliverydays_timeframe"><?php echo smartyTranslate(array('s'=>'Delivery time frame','mod'=>'deliverydays'),$_smarty_tpl);?>
</label>
		</p>
		<div class="textarea" style="float: left; margin-bottom: 1em; padding-left: 1.4em;">
		<?php $_smarty_tpl->tpl_vars['slot_no'] = new Smarty_variable(0, null, 0);?>
			<select id="deliverydays_timeframe" name="deliverydays_timeframe" disabled>
				<?php  $_smarty_tpl->tpl_vars['frame'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['frame']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['timeframe']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['frame']->key => $_smarty_tpl->tpl_vars['frame']->value) {
$_smarty_tpl->tpl_vars['frame']->_loop = true;
?>
				    <?php $_smarty_tpl->tpl_vars['slot_no'] = new Smarty_variable($_smarty_tpl->tpl_vars['delivery_loop']->iteration, null, 0);?>
					<?php if ($_smarty_tpl->tpl_vars['slot_no']->value==0) {?>					
					    <?php if (((int)smarty_modifier_date_format(time(),"%H"))>=0) {?>						    
					            <option id="dateslot1" disabled="disabled" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['frame']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['frame']->value==$_smarty_tpl->tpl_vars['selected_day']->value['timeframe']) {?>selected="selected"<?php }?>><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['frame']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</option>
					        <?php } else { ?>
					            <option id="dateslot1" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['frame']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['frame']->value==$_smarty_tpl->tpl_vars['selected_day']->value['timeframe']) {?>selected="selected"<?php }?>><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['frame']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</option>
						<?php }?>
					<?php }?>
						
					<?php if ($_smarty_tpl->tpl_vars['slot_no']->value==1) {?>
					    <?php if (((int)smarty_modifier_date_format(time(),"%H"))>=0) {?>
						    
					            <option id="dateslot2" disabled="disabled" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['frame']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['frame']->value==$_smarty_tpl->tpl_vars['selected_day']->value['timeframe']) {?>selected="selected"<?php }?>><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['frame']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</option>
					        <?php } else { ?>
					            <option id="dateslot2" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['frame']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['frame']->value==$_smarty_tpl->tpl_vars['selected_day']->value['timeframe']) {?>selected="selected"<?php }?>><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['frame']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</option>
							
					    <?php }?>
					<?php }?>
					
					<?php if ($_smarty_tpl->tpl_vars['slot_no']->value==2) {?>
					    <?php if (((int)smarty_modifier_date_format(time(),"%H"))>=14) {?>
						        <option id="dateslot3" disabled="disabled" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['frame']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['frame']->value==$_smarty_tpl->tpl_vars['selected_day']->value['timeframe']) {?>selected="selected"<?php }?>><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['frame']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</option>
					        <?php } else { ?>
					            <option id="dateslot3" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['frame']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['frame']->value==$_smarty_tpl->tpl_vars['selected_day']->value['timeframe']) {?>selected="selected"<?php }?>><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['frame']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</option>
							
					    <?php }?>
					<?php }?>
					
					<?php if ($_smarty_tpl->tpl_vars['slot_no']->value==3) {?>
					    <?php if (((int)smarty_modifier_date_format(time(),"%H"))>=17) {?>
						        <option id="dateslot4" disabled="disabled" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['frame']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['frame']->value==$_smarty_tpl->tpl_vars['selected_day']->value['timeframe']) {?>selected="selected"<?php }?>><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['frame']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</option>
					        <?php } else { ?>
					            <option id="dateslot4" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['frame']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['frame']->value==$_smarty_tpl->tpl_vars['selected_day']->value['timeframe']) {?>selected="selected"<?php }?>><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['frame']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</option>
					    <?php }?>
					<?php }?>
					
				<?php } ?>
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
		<?php } else { ?>
			<input type="hidden" name="deliverydays_timeframe" value=""/>
		<?php }?>
	</div>
<script type="text/javascript">
    
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
			minDate: $.datepicker.parseDate('yy-mm-dd', '<?php echo strtr($_smarty_tpl->tpl_vars['first_day']->value, array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
'),
			maxDate: $.datepicker.parseDate('yy-mm-dd', '<?php echo strtr($_smarty_tpl->tpl_vars['last_day']->value, array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
'),
			<?php if ($_smarty_tpl->tpl_vars['selected_day']->value&&($_smarty_tpl->tpl_vars['selected_day']->value['date']>=$_smarty_tpl->tpl_vars['deliverydays']->value[0])) {?>defaultDate: $.datepicker.parseDate('yy-mm-dd', '<?php echo strtr($_smarty_tpl->tpl_vars['selected_day']->value['date'], array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
'),<?php }?>
			beforeShowDay: function(date) {
				window.setTimeout(function(){
					$('#deliverydays_picker a.ui-state-highlight').removeClass('ui-state-highlight ui-state-hover')      
				},0);
				dateformated = $.datepicker.formatDate('yy-mm-dd',date);
				<?php  $_smarty_tpl->tpl_vars['day'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['day']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['deliverydays']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['day']->key => $_smarty_tpl->tpl_vars['day']->value) {
$_smarty_tpl->tpl_vars['day']->_loop = true;
?>
					if (dateformated == '<?php echo strtr($_smarty_tpl->tpl_vars['day']->value, array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
') return [true, '']; else
				<?php } ?>
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
 
					
					if(hrs > 12 ) {
					   
						document.getElementById("deliverydays_timeframe").disabled = true;
						$('#selectedMsdDiv').hide();
						alert("The slots are full. Please select another date.");
						$('#notSelectedMsdDiv').show();
						
						
					}
					
					else {
						document.getElementById("deliverydays_timeframe").options[0].disabled = true;
						document.getElementById("deliverydays_timeframe").options[1].disabled = true;
					    document.getElementById("deliverydays_timeframe").options[2].disabled = false;
						document.getElementById("deliverydays_timeframe").options[3].disabled = false;
						selectTime.options[2].selected=true;
						document.getElementById("selDate").innerHTML=" " + selectedDateG + " (Today) ";
			            document.getElementById("selTime").innerHTML=" " + document.getElementById("deliverydays_timeframe").value + " ";
					}
				}
				else if (tomoDate == selectedDate[2]) {
				if(hrs >= 21 ) {
					    document.getElementById("deliverydays_timeframe").options[0].disabled = true;
						document.getElementById("deliverydays_timeframe").options[1].disabled = true;
					    document.getElementById("deliverydays_timeframe").options[2].disabled = false;
						document.getElementById("deliverydays_timeframe").options[3].disabled = false;
						selectTime.options[2].selected=true;
						document.getElementById("selDate").innerHTML=" " + selectedDateG + " (Tomorrow) ";
			            document.getElementById("selTime").innerHTML=" " + document.getElementById("deliverydays_timeframe").value + " ";
						
					}
					else {
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
</style><?php }} ?>
