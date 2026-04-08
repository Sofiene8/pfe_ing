{breadcrumbs}[[Languages]]{/breadcrumbs}
<div class="page-title">
	<h1 class="title">[[Languages]]</h1>
</div>

{if $errors}
	{include file="errors.tpl" errors=$errors}
{/if}

<table>
	<thead>
		<tr>
			<th>[[Language]]</th>
			<th>[[Active]]</th>
			<th class="actions">[[Actions]]</th>
		</tr>
	</thead>
	{foreach from=$langs item=lang}
		<tr class="{cycle values = 'evenrow,oddrow'}">
			<td>
				{$lang.caption}
			</td>
			<td>
				{if $lang.activeFrontend}
					[[Yes]]
				{else}
					[[No]]
				{/if}
			</td>
			<td>
				<a href="{$GLOBALS.site_url}/manage-phrases/?language={$lang.id}&action=search_phrases" class="btn btn--primary">[[Manage Phrases]]</a>
				{if $lang.activeFrontend}
					{if not $lang.is_default}
						<a href="{$GLOBALS.site_url}/manage-languages/?language={$lang.id}&action=deactivate" class="btn btn--danger">[[Deactivate]]</a>
					{/if}
				{else}
					<a href="{$GLOBALS.site_url}/manage-languages/?language={$lang.id}&action=activate" class="btn btn--primary">[[Activate]]</a>
				{/if}
			</td>
		</tr>
	{/foreach}
</table>