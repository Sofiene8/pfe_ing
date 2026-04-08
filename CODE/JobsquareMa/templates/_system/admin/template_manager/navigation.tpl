{if $params}
	{breadcrumbs}
		{foreach name="foreach" item="item" from=$navigation}
			{if $item.reference eq ""}
				[[{$item.name}]]
			{else}
				<a href="{$item.reference}">[[{$item.name}]]</a>
			{/if}
			{if not $smarty.foreach.foreach.last} / {/if}
		{/foreach}
	{/breadcrumbs}
{/if}

<div class="page-title">
	<h1 class="title">[[{$title}]]</h1>
</div>

{if !empty($errors.CANT_DELETE_FILES)}
	<p class="error">[[The following files could not be removed]]:</p>
	<p class="errorList">
	{foreach from=$errors.CANT_DELETE_FILES key=key item=file}
		-{$file};<br />
	{/foreach}
	</p>
{elseif !empty($result)}
	<p class="message">[[{$result}]]</p>
{/if}

<p>[[Active theme]]: <b>{$GLOBALS.settings.TEMPLATE_USER_THEME}</b></p>
