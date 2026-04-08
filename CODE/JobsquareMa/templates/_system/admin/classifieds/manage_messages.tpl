{breadcrumbs}[[Messages]]{/breadcrumbs}
<div class="page-title">
	<h1 class="title">[[Messages]]</h1>
</div>
<div class="page-title__buttons">
		<a href="{$GLOBALS.site_url}/edit-message/?sid={$message.sid}" class="btn btn--primary">Nouveau message</a>
	</div>
<div class="panel panel-default panel--wide">
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-bordered">
				<thead>
					<th>[[Message]]</th>
					<th colspan="2" class="actions">[[Actions]]</th>
				</thead>
				<tbody>
					{foreach from=$messages item=message name=items_block}
					
						
						<tr>
							<td>{$message.message}</td>
							<td><a href="{$GLOBALS.site_url}/edit-message/?sid={$message.sid}" title="[[Edit]]" class="btn btn--secondary">[[Edit]]</a></td>
							<td><a href="{$GLOBALS.site_url}/delete-message/?sid={$message.sid}" onclick='return confirm("[[Are you sure you want to delete this message?]]")' title="[[Delete]]" class="btn btn--danger">[[Delete]]</a></td>
						
						</tr>
					{/foreach}
				</tbody>
			</table>
		</div>
	</div>
</div>