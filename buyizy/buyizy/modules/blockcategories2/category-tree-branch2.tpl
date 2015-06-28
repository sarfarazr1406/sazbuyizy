<li class="blockcategoryitem_{$node.id} {if isset($last) && $last == 'true'}last{/if}">
	<a href="{$node.link|escape:'htmlall':'UTF-8'}" {if isset($currentCategoryId) && $node.id == $currentCategoryId}class="selected"{/if}
		title="{$node.desc|strip_tags|trim|escape:'htmlall':'UTF-8'}">{$node.name|escape:'htmlall':'UTF-8'} ({$node.productsCount})</a>
	{if $node.children|@count > 0}
		<ul>
		{foreach from=$node.children item=child name=categoryTreeBranch}
			{if $smarty.foreach.categoryTreeBranch.last}
				{include file="$branche_tpl_path" node=$child last='true'}
			{else}
				{include file="$branche_tpl_path" node=$child last='false'}
			{/if}
		{/foreach}
		</ul>
	{/if}
</li>