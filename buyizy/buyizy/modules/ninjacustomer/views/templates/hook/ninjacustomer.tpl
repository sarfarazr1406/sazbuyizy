<div id="ninjac" class="{if !empty($errors)}error{/if} {if $logged}logged{/if} {if !$fun}not_fun{/if}">
	<div class="openbutton"></div>
	<div class="nj_content">
	{if !empty($errors)}
		{foreach from=$errors item=error}
			{$error}<br/>
		{/foreach}
	{/if}
	{if !$logged}
	<form method="post">
		<label>{l s="Enter customer e-mail or ID"}</label>
		<input class="nj_mail" type="text" name="ninjaCustomerMail" value=""/>
		<input class="nj_submit" type="submit" value="{if $fun}{l s='Ninja Login'}{else}{l s='Login'}{/if}" name="ninjaLogin" />
	</form>
	
	{else}
		<a class="nj_logout" href="{$content_dir}?mylogout=">{l s="Logout"}</a>
	{/if}
	</div>
</div>