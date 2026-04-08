<div class="page-title">
	<h1 class="title">{if $etGroups.$group}[[{$etGroups.$group}]]{else}[[Email Templates]]{/if}</h1>
</div>
<div class="panel panel-default panel--wide">
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-striped table__email-templates">
				<thead>
					<tr>
						<th>[[Template Name]]</th>
						<th class="actions">[[Actions]]</th>
					</tr>
				</thead>
				<tbody>
					{assign var="counter" value=0}
					{foreach from=$templates item="template"}
						{assign var="counter" value=$counter+1}
						<tr class="{if $template@index is odd}oddrow{else}evenrow{/if}">
							<td style="width: 100%;">[[{$template.name}]]</td>
							<td align=center>
								<a href="{$GLOBALS.site_url}/edit-email-templates/{$template.sid}/" title="[[Edit]]" class="btn btn--secondary">[[Edit]]</a>
							</td>
						</tr>
					{/foreach}
				</tbody>
			</table>
		</div>
	</div>
</div>