{breadcrumbs}[[Governorats]]{/breadcrumbs}
<div class="page-title">
	<h1 class="title">[[Governorats]]</h1>
</div>
<div class="page-title__buttons">
		<a href="{$GLOBALS.site_url}/edit-state/?sid={$state.sid}" class="btn btn--primary">Nouveau gouvernorat</a>
	</div>
<div class="panel panel-default panel--wide">
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-bordered">
				<thead>
					<th>[[Gouvernorat]]</th>
					<th>[[Description]]</th>
					<th>[[URL]]</th>
					<th>[[Image]]</th>
					<th>[[Afficher]]</th>
					<th colspan="2" class="actions">[[Actions]]</th>
				</thead>
				<tbody>
					{foreach from=$states item=state name=items_block}
					
						
						<tr>
							<td>{$state.name}</td>
							<td>{$state.description}</td>
							<td>{$state.url}</td>
							<td>{if $state.picture}<img src="{$GLOBALS.site_url}/../files/states/{$state.picture}" width="50" height="50"/>{/if}</td>
							<td>{if $state.display==1} OUI {else}NON{/if}</td>
							<td><a href="{$GLOBALS.site_url}/edit-state/?sid={$state.sid}" title="[[Edit]]" class="btn btn--secondary">[[Edit]]</a></td>
							<td><a href="{$GLOBALS.site_url}/delete-state/?sid={$state.sid}" onclick='return confirm("[[Are you sure you want to delete this state?]]")' title="[[Delete]]" class="btn btn--danger">[[Delete]]</a></td>
						
						</tr>
					{/foreach}
				</tbody>
			</table>
		</div>
	</div>
</div>