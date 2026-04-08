<div class="page-title page-title--wide">
	<h1 class="title">[[Job Auto Import]]</h1>
	<div class="page-title__buttons">
		<a href="{$GLOBALS.site_url}/add-import/?add_level=1" class="btn btn--primary">[[Add new data source]]</a>
	</div>
</div>

<div class="panel panel-default panel--wide">
	<p>[[Job Auto Import allows you to import job postings from other data sources]]</p>

	{assign var="counter" value=0}

	<p><strong>[[XML Data Sources]]</strong></p>
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>[[ID]]</th>
						<th>[[Name]]</th>
						<th>[[Description]]</th>
						<th nowrap="nowrap" class="actions">[[Actions]]</th>
						<th>[[Status]]</th>
					</tr>
				</thead>
				{foreach from=$systemParsers item=curr}
					{if $curr.active == 0}
						{assign var="stat" value="off"}
						{assign var="action" value="activate"}
						{assign var="title" value="[[Not active. Click to activate]]"}
					{else}
						{assign var="stat" value="on"}
						{assign var="action" value="deactivate"}
						{assign var="title" value="[[Active. Click to deactivate]]"}
					{/if}
					{assign var="counter" value=$counter+1}
					<tr class="{if $counter is odd}oddrow{else}evenrow{/if}">
						<td>{$curr.id}</td>
						<td class="td-wide">{$curr.name|escape:'html'}</td>
						<td class="td-wide">[[{$curr.description|escape:'html'}]]</td>
						<td style="white-space: nowrap; min-width: 200px" class="text-center"><a href="{$GLOBALS.site_url}/run-import/?id={$curr.id}" class="btn btn--secondary">[[Run]]</a> <a href="{$GLOBALS.site_url}/edit-import/?id={$curr.id}" class="btn btn--secondary">[[Edit]]</a> <a href="{$GLOBALS.site_url}/delete-import/?id={$curr.id}" onclick="return confirm('[[Are you sure?]]');" class="btn btn--danger">[[Delete]]</a></td>
						<td><center><a href="?action={$action}&id={$curr.id}"><img title="{$title}" border=0 src="{image}{$stat}.gif"></a></center></td>
					</tr>
				{/foreach}
			</table>
		</div>
	</div>
</div>
