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
{capture name=path}<a href="{$link->getPageLink('my-account', true)|escape:'html':'UTF-8'}" title="{l s='Manage my account' mod='referralcode'}" rel="nofollow">{l s='My account' mod='referralcode'}</a><span class="navigation-pipe">{$navigationPipe}</span><span class="navigation_page">{l s='Referral Program' mod='referralcode'}</span>{/capture}

<h1 class="page-heading">{l s='Referral program' mod='referralcode'}</h1>

{if $error}
	<p class="alert alert-danger">
		{if $error == 'conditions not valided'}
			{l s='You need to agree to the conditions of the referral program!' mod='referralcode'}
		{elseif $error == 'email invalid'}
			{l s='At least one e-mail address is invalid!' mod='referralcode'}
		{elseif $error == 'name invalid'}
			{l s='At least one first name or last name is invalid!' mod='referralcode'}
		{elseif $error == 'email exists'}
			{l s='Someone with this e-mail address has already been sponsored!' mod='referralcode'}: {foreach from=$mails_exists item=mail}{$mail} {/foreach}
		{elseif $error == 'no revive checked'}
			{l s='Please mark at least one checkbox' mod='referralcode'}
		{elseif $error == 'cannot add friends'}
			{l s='Cannot add friends to database' mod='referralcode'}
		{/if}
	</p>
{/if}

{if $invitation_sent}
	<p class="alert alert-success">
	{if $nbInvitation > 1}
		{l s='E-mails have been sent to your friends!' mod='referralcode'}
	{else}
		{l s='An e-mail has been sent to your friend!' mod='referralcode'}
	{/if}
	</p>
{/if}

{if $revive_sent}
	<p class="alert alert-success">
	{if $nbRevive > 1}
		{l s='Reminder e-mails have been sent to your friends!' mod='referralcode'}
	{else}
		{l s='A reminder e-mail has been sent to your friend!' mod='referralcode'}
	{/if}
	</p>
{/if}
<ul class="nav nav-tabs" id="idTabs">
	<li class="active"><a data-toggle="tab" href="#idTab1" class="tab-pane {if $activeTab eq 'sponsor'} active{/if}" title="{l s='Sponsor my friends' mod='referralcode'}" rel="nofollow">{l s='Sponsor my friends' mod='referralcode'}</a></li>
	<li><a data-toggle="tab" href="#idTab2"  class="tab-pane {if $activeTab eq 'pending'} selected{/if}" title="{l s='List of pending friends' mod='referralcode'}" rel="nofollow">{l s='Pending friends' mod='referralcode'}</a></li>
	<li><a data-toggle="tab" href="#idTab3" class="tab-pane {if $activeTab eq 'subscribed'} selected{/if}" title="{l s='List of friends I sponsored' mod='referralcode'}" rel="nofollow">{l s='Friends I sponsored' mod='referralcode'}</a></li>
</ul>

<div class="sheets tab-content">

	<div id="idTab1" class="tab-pane active">
		<p class="bold">
			<strong>{l s='Get a discount of %1$s for you by recommending this Website.' sprintf=[$discount_sponsorer] mod='referralcode'}</strong>
		</p>
		{if $canSendInvitations}
			<p>
				{l s='It\'s quick and it\'s easy. Just fill in the first name, last name, and e-mail address(es) of your friend(s) in the fields below.' mod='referralcode'}
				{if $orderQuantity > 1}
					{l s='When one of them makes at least %d orders, ' sprintf=$orderQuantity mod='referralcode'}
				{else}
					{l s='When one of them makes at least %d order, ' sprintf=$orderQuantity mod='referralcode'}
				{/if}
				{l s='he or she can get a %1$s discount using the voucher' sprintf=[$discount_sponsored] mod='referralcode'}
				{l s=' and you will receive your own discount voucher worth %1$s.' sprintf=[$discount_sponsorer] mod='referralcode'}
			</p>
			<form method="post" action="{$link->getModuleLink('referralcode', 'code', [], true)|escape:'html':'UTF-8'}" class="std">
				<table class="table table-bordered">
				<thead>
					<tr>
						<th class="first_item">&nbsp;</th>
						<th class="item">{l s='Last name' mod='referralcode'}</th>
						<th class="item">{l s='First name' mod='referralcode'}</th>
						<th class="last_item">{l s='E-mail' mod='referralcode'}</th>
					</tr>
				</thead>
				<tbody>
					{section name=friends start=0 loop=$nbFriends step=1}
					<tr class="{if $smarty.section.friends.index % 2}item{else}alternate_item{/if}">
						<td class="align_right">{$smarty.section.friends.iteration}</td>
						<td><input type="text" class="form-control" name="friendsLastName[{$smarty.section.friends.index}]" size="14" value="{if isset($smarty.post.friendsLastName[$smarty.section.friends.index])}{$smarty.post.friendsLastName[$smarty.section.friends.index]|escape:'html':'UTF-8'}{/if}" /></td>
						<td><input type="text" class="form-control" name="friendsFirstName[{$smarty.section.friends.index}]" size="14" value="{if isset($smarty.post.friendsFirstName[$smarty.section.friends.index])}{$smarty.post.friendsFirstName[$smarty.section.friends.index]|escape:'html':'UTF-8'}{/if}" /></td>
						<td><input type="text" class="form-control" name="friendsEmail[{$smarty.section.friends.index}]" size="20" value="{if isset($smarty.post.friendsEmail[$smarty.section.friends.index])}{$smarty.post.friendsEmail[$smarty.section.friends.index]|escape:'html':'UTF-8'}{/if}" /></td>
					</tr>
					{/section}
				</tbody>
				</table>
				<p class="bold">
					<strong>{l s='Important: Your friends\' e-mail addresses will only be used in the referral program. They will never be used for other purposes.' mod='referralcode'}</strong>
				</p>
				<p class="checkbox">
					<input type="checkbox" name="conditionsValided" id="conditionsValided" value="1" {if isset($smarty.post.conditionsValided) AND $smarty.post.conditionsValided eq 1}checked="checked"{/if} />
					<label for="conditionsValided">{l s='I agree to the terms of service and adhere to them unconditionally.' mod='referralcode'}</label>
					<a href="{$link->getModuleLink('referralcode', 'rules', ['height' => '500', 'width' => '400'], true)|escape:'html':'UTF-8'}" class="thickbox" title="{l s='Conditions of the referral program' mod='referralcode'}" rel="nofollow">{l s='Read conditions.' mod='referralcode'}</a>
				</p>
				<p class="submit">
                    <button type="submit" id="submitSponsorFriends" name="submitSponsorFriends" class="btn btn-default button button-medium"><span>{l s='Validate' mod='referralcode'}<i class="icon-chevron-right right"></i></span></button>
				</p>
			</form>
		{else}
			<p class="alert alert-warning">
				{l s='To become a sponsor, you need to have completed at least' mod='referralcode'} {$orderQuantity} {if $orderQuantity > 1}{l s='orders' mod='referralcode'}{else}{l s='order' mod='referralcode'}{/if}.
			</p>
		{/if}
	</div>

	<div id="idTab2" class="tab-pane">
	{if $pendingFriends AND $pendingFriends|@count > 0}
		<p>
			{l s='These friends have not yet placed an order on this Website since you sponsored them, but you can try again! To do so, mark the checkboxes of the friend(s) you want to remind, then click on the button "Remind my friend(s)"' mod='referralcode'}
		</p>
		<form method="post" action="{$link->getModuleLink('referralcode', 'code', [], true)|escape:'html':'UTF-8'}" class="std">
			<table class="table table-bordered">
			<thead>
				<tr>
					<th class="first_item">&nbsp;</th>
					<th class="item">{l s='E-mail' mod='referralcode'}</th>
					<th class="last_item"><b>{l s='Last invitation' mod='referralcode'}</b></th>
				</tr>
			</thead>
			<tbody>
			{foreach from=$pendingFriends item=pendingFriend name=myLoop}
				<tr>
					<td>
						<input type="checkbox" name="friendChecked[{$pendingFriend.id_referralprogram}]" id="friendChecked[{$pendingFriend.id_referralprogram}]" value="1" />
					</td>
					<td>{$pendingFriend.email}</td>
					<td>{dateFormat date=$pendingFriend.date_upd full=1}</td>
				</tr>
			{/foreach}
			</tbody>
			</table>
			<p class="submit">
                <button type="submit" name="revive" id="revive" class="button_large btn btn-default">{l s='Remind my friend(s)' mod='referralcode'}</button>
			</p>
		</form>
		{else}
			<p class="alert alert-warning">{l s='You have not sponsored any friends.' mod='referralcode'}</p>
		{/if}
	</div>

	<div id="idTab3" class="tab-pane">
	{if $subscribeFriends AND $subscribeFriends|@count > 0}
		<p>
			{l s='Here are sponsored friends who have accepted your invitation:' mod='referralcode'}
		</p>
		<table class="table table-bordered">
		<thead>
			<tr>
				<th class="first_item">&nbsp;</th>
				<th class="item">{l s='E-mail' mod='referralcode'}</th>
				<th class="last_item">{l s='Inscription date' mod='referralcode'}</th>
			</tr>
		</thead>
		<tbody>
			{foreach from=$subscribeFriends item=subscribeFriend name=myLoop}
			<tr>
				<td>{$smarty.foreach.myLoop.iteration}.</td>
				<td>{$subscribeFriend.email}</td>
				<td>{dateFormat date=$subscribeFriend.date_upd full=1}</td>
			</tr>
			{/foreach}
		</tbody>
		</table>
	{else}
		<p class="alert alert-warning">
			{l s='No sponsored friends have accepted your invitation yet.' mod='referralcode'}
		</p>
	{/if}
	</div>
</div>

<ul class="footer_links clearfix">
	<li>
		<a class="btn btn-default button button-small" href="{$link->getPageLink('my-account', true)|escape:'html':'UTF-8'}" title="{l s='Back to Your Account' mod='referralcode'}" rel="nofollow">
		<span><i class="icon-chevron-left"></i> {l s='Back to Your Account' mod='referralcode'}</span></a>
	</li>
	<li><a class="btn btn-default button button-small" href="{$base_dir}" title="{l s='Home' mod='referralcode'}"><span><i class="icon-chevron-left"></i>{l s='Home' mod='referralcode'}</span></a></li>
</ul>
{addJsDefL name=ThickboxI18nClose}{l s='Close' mod='referralcode' js=1}{/addJsDefL}
{addJsDefL name=ThickboxI18nOrEscKey}{l s='or Esc key' mod='referralcode' js=1}{/addJsDefL}
{addJsDef tb_pathToImage=$img_ps_dir|cat:'loadingAnimation.gif'}
