{*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade this module to newer
* versions in the future. If you wish to customize this module for your
* needs please refer to http://doc.prestashop.com/display/PS15/Overriding+default+behaviors
* #Overridingdefaultbehaviors-Overridingamodule%27sbehavior for more information.
*
* @author Samdha <contact@samdha.net>
* @copyright  Samdha
* @license    commercial license see license.txt
*}
<div id="tabParameters">
	<div class="panel">
		<form action="{$module_url|escape:'htmlall':'UTF-8'}" method="post" enctype="multipart/form-data">
			<input type="hidden" name="active_tab" value="tabParameters"/>

			<div class="form-group">
				<label>{l s='Manage by group' mod='deliverydays'}</label>
				<div class="margin-form">
					<span class="radio">
						<input type="radio" name="setting[use_group]" id="setting_use_group_on" value="1" {if $module_config.use_group}checked="checked"{/if} />
						<label for="setting_use_group_on">{l s='Yes' mod='deliverydays'}</label>
						<input type="radio" name="setting[use_group]" id="setting_use_group_off" value="0" {if !$module_config.use_group}checked="checked"{/if} />
						<label for="setting_use_group_off">{l s='No' mod='deliverydays'}</label>
					</span>
					<a class="module_help" title="{l s='Click to see more informations about this element' mod='deliverydays'}" href="{$documentation_url|escape:'htmlall':'UTF-8'}#use_group">?</a>
					<p {if $version_16}class="help-block"{/if}>
						{l s='Set delivery days by group' mod='deliverydays'}
					</p>
				</div>
			</div>

			<div class="form-group setting_use_group_off clear">
				 <label>{l s='Required to order' mod='deliverydays'}</label>
				 <div class="margin-form">
					  <span class="radio">
							<input type="radio" name="setting[required0]" id="setting_required0_on" value="1" {if $module_config.required0}checked="checked"{/if} />
							<label for="setting_required0_on">{l s='Yes' mod='deliverydays'}</label>
							<input type="radio" name="setting[required0]" id="setting_required0_off" value="0" {if !$module_config.required0}checked="checked"{/if} />
							<label for="setting_required0_off">{l s='No' mod='deliverydays'}</label>
					  </span>
					  <a class="module_help" title="{l s='Click to see more informations about this element' mod='deliverydays'}" href="{$documentation_url|escape:'htmlall':'UTF-8'}#header">?</a>
					  <p {if $version_16}class="help-block"{/if}>
							{l s='Customer has to select a delivery day to order' mod='deliverydays'}
					  </p>
				 </div>
			</div>

			<div class="form-group clear setting_use_group_on">
				 <label>{l s='Enable for' mod='deliverydays'}</label>
				 <div class="margin-form">
					  <table>
							<thead>
								 <tr>
									  <th scope="col">{l s='Group' mod='deliverydays'}</th>
									  <th scope="col">{l s='Enabled' mod='deliverydays'} <a class="module_help" title="{l s='Click to see more informations about this element' mod='deliverydays'}" href="{$documentation_url|escape:'htmlall':'UTF-8'}#enabled">?</a></th>
									  <th scope="col">{l s='Required' mod='deliverydays'} <a class="module_help" title="{l s='Click to see more informations about this element' mod='deliverydays'}" href="{$documentation_url|escape:'htmlall':'UTF-8'}#required">?</a></th>
								 </tr>
							</thead>
							<tbody>
							{foreach from=$groups item=group_name key=id_group}
								 <tr>
									  <td scope="row">{$group_name|escape:'htmlall':'UTF-8'}</td>
									  <td>
											<span class="radio">
												 {capture assign=key}enabled{$id_group|escape:'htmlall':'UTF-8'}{/capture}
												 <input type="radio" name="setting[{$key|escape:'htmlall':'UTF-8'}]" id="setting_{$key|escape:'htmlall':'UTF-8'}_on" value="1" {if $module_config[$key]}checked="checked"{/if} />
												 <label for="setting_{$key|escape:'htmlall':'UTF-8'}_on">{l s='Yes' mod='deliverydays'}</label>
												 <input type="radio" name="setting[{$key|escape:'htmlall':'UTF-8'}]" id="setting_{$key|escape:'htmlall':'UTF-8'}_off" value="0" {if !$module_config[$key]}checked="checked"{/if} />
												 <label for="setting_{$key|escape:'htmlall':'UTF-8'}_off">{l s='No' mod='deliverydays'}</label>
											</span>
									  </td>
									  <td>
											<span class="radio setting_enabled{$id_group|escape:'htmlall':'UTF-8'}_on">
												 {capture assign=key}required{$id_group|escape:'htmlall':'UTF-8'}{/capture}
												 <input type="radio" name="setting[{$key|escape:'htmlall':'UTF-8'}]" id="setting_{$key|escape:'htmlall':'UTF-8'}_on" value="1" {if $module_config[$key]}checked="checked"{/if} />
												 <label for="setting_{$key|escape:'htmlall':'UTF-8'}_on">{l s='Yes' mod='deliverydays'}</label>
												 <input type="radio" name="setting[{$key|escape:'htmlall':'UTF-8'}]" id="setting_{$key|escape:'htmlall':'UTF-8'}_off" value="0" {if !$module_config[$key]}checked="checked"{/if} />
												 <label for="setting_{$key|escape:'htmlall':'UTF-8'}_off">{l s='No' mod='deliverydays'}</label>
											</span>
									  </td>
								 </tr>
							{/foreach}
							</tbody>
					  </table>
					  <p {if $version_16}class="help-block"{/if}>
							{l s='For each group, choose if delivery date is activated and, if so, required.' mod='deliverydays'}
					  </p>
				 </div>
			</div>

			<div class="form-group">
           <label for="setting_id_employee"> {l s='Send delivery date to' mod='deliverydays'}</label>
           <div class="margin-form">
               <select class="input_large nochosen" name="setting[id_employee]" id="setting_id_employee">
                   <option value="0" {if $module_config.id_employee == 0}selected="selected"{/if}>{l s='Nobody' mod='deliverydays'}</option>
                   {html_options options=$employees selected=$module_config.id_employee}
               </select>
					<p {if $version_16}class="help-block"{/if}>{l s='Send the delivery date to an employee when an order is created' mod='deliverydays'}</p>
           </div>
			</div>

			<div class="form-group">
				<label>{l s='Send delivery date to customer' mod='deliverydays'}</label>
				<div class="margin-form">
					<span class="radio">
						<input type="radio" name="setting[mailcustomer]" id="setting_mailcustomer_on" value="1" {if $module_config.mailcustomer}checked="checked"{/if} />
						<label for="setting_mailcustomer_on">{l s='Yes' mod='deliverydays'}</label>
						<input type="radio" name="setting[mailcustomer]" id="setting_mailcustomer_off" value="0" {if !$module_config.mailcustomer}checked="checked"{/if} />
						<label for="setting_mailcustomer_off">{l s='No' mod='deliverydays'}</label>
					</span>
					<a class="module_help" title="{l s='Click to see more informations about this element' mod='deliverydays'}" href="{$documentation_url|escape:'htmlall':'UTF-8'}#header">?</a>
					<p {if $version_16}class="help-block"{/if}>{l s='Send the delivery date by e-mail when an order is created' mod='deliverydays'}</p>
				</div>
			</div>

			{if $version_15}
				<div class="form-group clear setting_mailcustomer_on">
					<label>{l s='Use separated mail' mod='deliverydays'}</label>
					<div class="margin-form">
						<span class="radio">
							<input type="radio" name="setting[separate_mail]" id="setting_separate_mail_on" value="1" {if $module_config.separate_mail}checked="checked"{/if} />
							<label for="setting_separate_mail_on">{l s='Yes' mod='deliverydays'}</label>
							<input type="radio" name="setting[separate_mail]" id="setting_separate_mail_off" value="0" {if !$module_config.separate_mail}checked="checked"{/if} />
							<label for="setting_separate_mail_off">{l s='No' mod='deliverydays'}</label>
						</span>
						<a class="module_help" title="{l s='Click to see more informations about this element' mod='deliverydays'}" href="{$documentation_url|escape:'htmlall':'UTF-8'}#separate_mail">?</a>
						<p {if $version_16}class="help-block"{/if}>
							{l s='Delivery date can be send in a separated e-mail or included in the order confirmation' mod='deliverydays'}
						</p>
					</div>
				</div>

				<div class="form-group">
					<label>{l s='Show delivery date in orders list' mod='deliverydays'}</label>
					<div class="margin-form">
						 <span class="radio">
							  <input type="radio" name="setting[add_column]" id="setting_add_column_on" value="1" {if $module_config.add_column}checked="checked"{/if} />
							  <label for="setting_add_column_on">{l s='Yes' mod='deliverydays'}</label>
							  <input type="radio" name="setting[add_column]" id="setting_add_column_off" value="0" {if !$module_config.add_column}checked="checked"{/if} />
							  <label for="setting_add_column_off">{l s='No' mod='deliverydays'}</label>
						 </span>
						 <a class="module_help" title="{l s='Click to see more informations about this element' mod='deliverydays'}" href="{$documentation_url|escape:'htmlall':'UTF-8'}#add_column">?</a>
						 <p {if $version_16}class="help-block"{/if}>{l s='Add a column with delivery date in \'Orders\' tab' mod='deliverydays'}</p>
					</div>
				</div>
			{/if}

			<div class="clear panel-footer">
				<p><input type="submit" class="samdha_button" name="saveSettings" value="{l s='Save' mod='deliverydays'}" /></p>
			</div>
		</form>
	</div>
</div>

<div id="tabDays">
	<div class="panel">
	<form action="{$module_url|escape:'htmlall':'UTF-8'}" method="post" enctype="multipart/form-data">
		<input type="hidden" name="active_tab" value="tabDays"/>
			<div class="setting_use_group_off">
				{assign var=id_group value=0}

				<div class="form-group">
					<label>{l s='Delivery days' mod='deliverydays'}</label>
					<div class="margin-form">
						<table>
							<thead>
								<tr>
									<th>{l s='Day' mod='deliverydays'}</th>
										<th>
											{l s='Deliver' mod='deliverydays'}
											<a class="module_help" title="{l s='Click to see more informations about this element' mod='deliverydays'}" href="{$documentation_url|escape:'htmlall':'UTF-8'}#deliver">?</a>
										</th>
										<th>
											{l s='Deadline for order ' mod='deliverydays'}
											<a class="module_help" title="{l s='Click to see more informations about this element' mod='deliverydays'}" href="{$documentation_url|escape:'htmlall':'UTF-8'}#deadline">?</a>
										</th>
									</tr>
								</thead>
							<tbody>
								{foreach from=$days item=day_name key=day}
									<tr>
										<td>{$day_name|escape:'htmlall':'UTF-8'}</td>
										<td>
											<span class="radio">
												{capture assign=key}days{$id_group|escape:'htmlall':'UTF-8'}{/capture}
												<input type="radio" name="setting[{$key|escape:'htmlall':'UTF-8'}][{$day|escape:'htmlall':'UTF-8'}]" id="setting_{$key|escape:'htmlall':'UTF-8'}{$day|escape:'htmlall':'UTF-8'}_on" value="1" {if $module_config[$key][$day]}checked="checked"{/if} />
												<label for="setting_{$key|escape:'htmlall':'UTF-8'}{$day|escape:'htmlall':'UTF-8'}_on">{l s='Yes' mod='deliverydays'}</label>
												<input type="radio" name="setting[{$key|escape:'htmlall':'UTF-8'}][{$day|escape:'htmlall':'UTF-8'}]" id="setting_{$key|escape:'htmlall':'UTF-8'}{$day|escape:'htmlall':'UTF-8'}_off" value="0" {if !$module_config[$key][$day]}checked="checked"{/if} />
												<label for="setting_{$key|escape:'htmlall':'UTF-8'}{$day|escape:'htmlall':'UTF-8'}_off">{l s='No' mod='deliverydays'}</label>
											</span>
										</td>
										<td>
											<div class="setting_{$key|escape:'htmlall':'UTF-8'}{$day|escape:'htmlall':'UTF-8'}_on">
												{capture assign=key}offsets{$id_group|escape:'htmlall':'UTF-8'}{/capture}
												<input type="number" class="input_tiny" min="0" step="1" name="setting[{$key|escape:'htmlall':'UTF-8'}][{$day}]" value="{$module_config[$key][$day]|intval}" size="4" />
												{l s='day(s) before at' mod='deliverydays'}
												{strip}
													{capture assign=key}hours{$id_group|escape:'htmlall':'UTF-8'}{/capture}
													{assign var=hour value=$module_config[$key][$day]}
													<select class="input_tiny nochosen" name="setting[{$key|escape:'htmlall':'UTF-8'}][{$day}]">
														{html_options options=$hours selected=$hour}
													</select>:
													{capture assign=key}minutes{$id_group|escape:'htmlall':'UTF-8'}{/capture}
													{assign var=minute value=$module_config[$key][$day]}
													<select class="input_tiny nochosen" name="setting[{$key|escape:'htmlall':'UTF-8'}][{$day}]">
														{html_options options=$minutes selected=$minute}
													</select>
												{/strip}
											</div>
										</td>
									</tr>
								{/foreach}
							</tbody>
						</table>
						<p {if $version_16}class="help-block"{/if}>
							{l s='For each week days, choose if delivery is possible and, if so, the deadline for ordering.' mod='deliverydays'}
						</p>
					</div>
				</div>

				<div class="form-group">
					{capture assign=key}exception{$id_group|escape:'htmlall':'UTF-8'}{/capture}
					<label for="setting_{$key|escape:'htmlall':'UTF-8'}">{l s='Non delivery days' mod='deliverydays'}</label>
					<div class="margin-form setting_exception">
						<div class="setting_exception_datepicker"></div>
						<div class="setting_exception_div">
							<input type="text" name="setting[{$key|escape:'htmlall':'UTF-8'}]" id="setting_{$key|escape:'htmlall':'UTF-8'}" value="{','|implode:$module_config[$key]|escape:'htmlall':'UTF-8'}"/>
							<p {if $version_16}class="help-block"{/if}>{l s='coma separated, format: 2007-12-31.' mod='deliverydays'}</p>
						</div>
						<p {if $version_16}class="help-block"{/if}>
							{l s='Select the days where delivery is impossible regardless the week day, public holidays for example.' mod='deliverydays'}
						</p>
					</div>
				</div>

				<div class="form-group">
					{capture assign=key}offset{$id_group|escape:'htmlall':'UTF-8'}{/capture}
					<label for="setting_{$key|escape:'htmlall':'UTF-8'}">{l s='Days of preparation' mod='deliverydays'}</label>
					<div class="margin-form">
						<input type="number" class="input_small" min="0" step="1" value="{$module_config[$key]|intval}" name="setting[{$key|escape:'htmlall':'UTF-8'}]" id="setting_{$key|escape:'htmlall':'UTF-8'}" />
						<a class="module_help" title="{l s='Click to see more informations about this element' mod='deliverydays'}" href="{$documentation_url|escape:'htmlall':'UTF-8'}#offset">?</a>
						<p {if $version_16}class="help-block"{/if}>{l s='Number of days before than delivery is possible. If you set it to 3, a customer that buys on Monday will be able to select a delivery day only after Thursday' mod='deliverydays'}</p>
					</div>
				</div>

				<div class="form-group">
					{capture assign=key}duration{$id_group|escape:'htmlall':'UTF-8'}{/capture}
					<label for="setting_{$key|escape:'htmlall':'UTF-8'}">{l s='Days displayed' mod='deliverydays'}</label>
					<div class="margin-form">
						<input type="number" class="input_small" min="1" step="1" value="{$module_config[$key]|intval}" name="setting[{$key|escape:'htmlall':'UTF-8'}]" id="setting_{$key|escape:'htmlall':'UTF-8'}" />
						<a class="module_help" title="{l s='Click to see more informations about this element' mod='deliverydays'}" href="{$documentation_url|escape:'htmlall':'UTF-8'}#duration">?</a>
						<p {if $version_16}class="help-block"{/if}>{l s='Number of days proposed to the customer' mod='deliverydays'}</p>
					</div>
				</div>

				<div class="form-group">
					{capture assign=key}timeframe{$id_group|escape:'htmlall':'UTF-8'}{/capture}
					<label for="setting_{$key|escape:'htmlall':'UTF-8'}">{l s='Hourly ranges' mod='deliverydays'}</label>
					<div class="margin-form">
						<textarea class="timeframe" rows="10" cols="50" name="setting[{$key|escape:'htmlall':'UTF-8'}]" id="setting_{$key|escape:'htmlall':'UTF-8'}">{"\n"|implode:$module_config[$key]|escape:'htmlall':'UTF-8'}</textarea>
						<p {if $version_16}class="help-block"{/if}>{l s='One range by line. It can be anything, \'8am to 10am\', \'Morning\', \'Warehouse 1\'...' mod='deliverydays'}</p>
					</div>
				</div>
			</div>

           <div id="day_by_group" class="accordion setting_use_group_on">
               {foreach from=$groups item=group_name key=id_group}
                   <h3 class="modal-title setting_enabled{$id_group|escape:'htmlall':'UTF-8'}_on">{l s='Group' mod='deliverydays'} {$group_name|escape:'htmlall':'UTF-8'}</h3>
                   <div>
								<div class="form-group">
								<label>{l s='Delivery days' mod='deliverydays'}</label>
								<div class="margin-form">
									 <table>
										  <thead>
												<tr>
													 <th>{l s='Day' mod='deliverydays'}</th>
													 <th>
														  {l s='Deliver' mod='deliverydays'}
														  <a class="module_help" title="{l s='Click to see more informations about this element' mod='deliverydays'}" href="{$documentation_url|escape:'htmlall':'UTF-8'}#deliver">?</a>
													 </th>
													 <th>
														  {l s='Deadline for order ' mod='deliverydays'}
														  <a class="module_help" title="{l s='Click to see more informations about this element' mod='deliverydays'}" href="{$documentation_url|escape:'htmlall':'UTF-8'}#deadline">?</a>
													 </th>
												</tr>
										  </thead>
										  <tbody>
										  {foreach from=$days item=day_name key=day}
												<tr>
													 <td>{$day_name|escape:'htmlall':'UTF-8'}</td>
													 <td>
														  <span class="radio">
																{capture assign=key}days{$id_group|escape:'htmlall':'UTF-8'}{/capture}
																<input type="radio" name="setting[{$key|escape:'htmlall':'UTF-8'}][{$day|escape:'htmlall':'UTF-8'}]" id="setting_{$key|escape:'htmlall':'UTF-8'}{$day|escape:'htmlall':'UTF-8'}_on" value="1" {if $module_config[$key][$day]}checked="checked"{/if} />
																<label for="setting_{$key|escape:'htmlall':'UTF-8'}{$day|escape:'htmlall':'UTF-8'}_on">{l s='Yes' mod='deliverydays'}</label>
																<input type="radio" name="setting[{$key|escape:'htmlall':'UTF-8'}][{$day|escape:'htmlall':'UTF-8'}]" id="setting_{$key|escape:'htmlall':'UTF-8'}{$day|escape:'htmlall':'UTF-8'}_off" value="0" {if !$module_config[$key][$day]}checked="checked"{/if} />
																<label for="setting_{$key|escape:'htmlall':'UTF-8'}{$day|escape:'htmlall':'UTF-8'}_off">{l s='No' mod='deliverydays'}</label>
														  </span>
													 </td>
													 <td>
														  <div class="setting_{$key|escape:'htmlall':'UTF-8'}{$day|escape:'htmlall':'UTF-8'}_on">
																{capture assign=key}offsets{$id_group|escape:'htmlall':'UTF-8'}{/capture}
																<input type="number" class="input_tiny" min="0" step="1" name="setting[{$key|escape:'htmlall':'UTF-8'}][{$day}]" value="{$module_config[$key][$day]|intval}" size="4" />
																{l s='day(s) before at' mod='deliverydays'}
																{strip}
																	 {capture assign=key}hours{$id_group|escape:'htmlall':'UTF-8'}{/capture}
																	 {assign var=hour value=$module_config[$key][$day]}
																	 <select class="input_tiny nochosen" name="setting[{$key|escape:'htmlall':'UTF-8'}][{$day}]">
																		  {html_options options=$hours selected=$hour}
																	 </select>:
																	 {capture assign=key}minutes{$id_group|escape:'htmlall':'UTF-8'}{/capture}
																	 {assign var=minute value=$module_config[$key][$day]}
																	 <select class="input_tiny nochosen" name="setting[{$key|escape:'htmlall':'UTF-8'}][{$day}]">
																		  {html_options options=$minutes selected=$minute}
																	 </select>
																{/strip}
														  </div>
													 </td>
												</tr>
										  {/foreach}
										  </tbody>
									 </table>
									<p {if $version_16}class="help-block"{/if}>
										 {l s='For each week days, choose if delivery is possible and, if so, the deadline for ordering.' mod='deliverydays'}
									</p>
								</div>
								</div>

								<div class="form-group">
									{capture assign=key}exception{$id_group|escape:'htmlall':'UTF-8'}{/capture}
									<label for="setting_{$key|escape:'htmlall':'UTF-8'}">{l s='Non delivery days' mod='deliverydays'}</label>
									<div class="margin-form setting_exception">
										 <div class="setting_exception_datepicker"></div>
										 <div class="setting_exception_div">
											  <input type="text" name="setting[{$key|escape:'htmlall':'UTF-8'}]" id="setting_{$key|escape:'htmlall':'UTF-8'}" value="{','|implode:$module_config[$key]|escape:'htmlall':'UTF-8'}"/>
											  <p {if $version_16}class="help-block"{/if}>{l s='coma separated, format: 2007-12-31.' mod='deliverydays'}</p>
										 </div>
										<p {if $version_16}class="help-block"{/if}>
											 {l s='Select the days where delivery is impossible regardless the week day, public holidays for example.' mod='deliverydays'}
										</p>
									</div>
								</div>

								<div class="form-group">
									{capture assign=key}duration{$id_group|escape:'htmlall':'UTF-8'}{/capture}
									<label for="setting_{$key|escape:'htmlall':'UTF-8'}">{l s='Days displayed' mod='deliverydays'}</label>
									<div class="margin-form">
										 <input type="number" class="input_small" min="1" step="1" value="{$module_config[$key]|intval}" name="setting[{$key|escape:'htmlall':'UTF-8'}]" id="setting_{$key|escape:'htmlall':'UTF-8'}" />
										 <a class="module_help" title="{l s='Click to see more informations about this element' mod='deliverydays'}" href="{$documentation_url|escape:'htmlall':'UTF-8'}#duration">?</a>
										 <p {if $version_16}class="help-block"{/if}>{l s='Number of days proposed to the customer' mod='deliverydays'}</p>
									</div>
								</div>

								<div class="form-group">
									{capture assign=key}timeframe{$id_group|escape:'htmlall':'UTF-8'}{/capture}
									<label for="setting_{$key|escape:'htmlall':'UTF-8'}">{l s='Hourly ranges' mod='deliverydays'}</label>
									<div class="margin-form">
										 <textarea class="timeframe" rows="10" cols="50" name="setting[{$key|escape:'htmlall':'UTF-8'}]" id="setting_{$key|escape:'htmlall':'UTF-8'}">{"\n"|implode:$module_config[$key]|escape:'htmlall':'UTF-8'}</textarea>
										 <p {if $version_16}class="help-block"{/if}>{l s='One range by line. It can be anything, \'8am to 10am\', \'Morning\', \'Warehouse 1\'...' mod='deliverydays'}</p>
									</div>
								</div>
                </div>
           {/foreach}
           </div>

				<div class="clear panel-footer">
					<p><input type="submit" class="samdha_button" name="saveSettings" value="{l s='Save' mod='deliverydays'}" /></p>
				</div>
	</form>
	</div>
</div>

{if count($futur_dates)}
	<div id="tabExport">
		<div class="panel">
			<form action="{$module_url|escape:'htmlall':'UTF-8'}" method="post" enctype="multipart/form-data">
				<input type="hidden" name="active_tab" value="tabExport"/>
				<div class="form-group">
					<label for="{$module_short_name|escape:'htmlall':'UTF-8'}_export">{l s='Delivery day' mod='deliverydays'}</label>
					<div class="margin-form">
						<select name="{$module_short_name|escape:'htmlall':'UTF-8'}_export" id="{$module_short_name|escape:'htmlall':'UTF-8'}_export" class="nochosen">
							{html_options options=$futur_dates}
						</select>
					</div>
				</div>
				<div class="clear panel-footer">
					<p>
						<input type="submit" class="samdha_button" name="exportProducts" value="{l s='Export products' mod='deliverydays'}" />
						<input type="submit" class="samdha_button" name="exportOrders" value="{l s='Export orders' mod='deliverydays'}" />
					</p>
				</div>
			</form>
		</div>
	</div>
{/if}
