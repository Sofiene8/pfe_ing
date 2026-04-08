<li class="dd-item">
	<div class="dd-handle sortable-handle">...</div>
	<div class="dd-content clearfix">
		<input class="dd-content__item" type="text" name="menu_item[]" value="{$item.name|escape}" />
		<input type="hidden" name="parent[]" value="{$item.parent}" />
		<select class="page-selector dd-content__item">
			{assign var='selected' value=false}
			{foreach from=$system_pages item='page' key='uri'}
				<option value="{$uri|escape}" {if $item.url == $uri}selected="selected" {assign var='selected' value=true}{/if}>{$page}</option>
			{/foreach}
			{foreach from=$pages item='page'}
				<option value="{$page.uri|escape}" {if $item.url == $page.uri}selected="selected" {assign var='selected' value=true}{/if}>{$page.title}</option>
			{/foreach}
			<option value="" {if $selected == false}selected="selected{/if}">[[External Page]]</option>
		</select>
		<span class="external-link dd-content__item">
			<input type="text" name="link[]" value="{$item.url|escape}" />
		</span>
		<i class="ion-close-circled"></i>
	</div>
	{if $item.children}
		<ol class="dd-list">
			{foreach from=$item.children item='sub_item'}
				{include file='navigation_menu_item.tpl' item=$sub_item}
			{/foreach}
		</ol>
	{/if}
</li>
