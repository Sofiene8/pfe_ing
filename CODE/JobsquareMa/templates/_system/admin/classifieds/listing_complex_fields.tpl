{breadcrumbs}<a href="{$GLOBALS.site_url}/edit-listing-type/?sid={$type_sid}">[[{$type_info.name} Fields]]</a> / <a href="{$GLOBALS.site_url}/edit-listing-type-field/?sid={$field_sid}">{$field_info.caption|escape}</a> / [[Edit Fields]]{/breadcrumbs}
<div class="page-title">
	<h1 class="title">[[Edit Fields]]</h1>
</div>
<div class="panel panel-default panel--wide">
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>[[Caption]]</th>
						<th>[[Type]]</th>
						<th>[[Required]]</th>
						<th class="actions">[[Actions]]</th>
					</tr>
				</thead>
				<tbody>
					{foreach from=$listing_fields item=listing_field}
						<tr>
							<td>[[{$listing_field.caption|escape}]]</td>
							<td>[[{$listing_field.typeCaption}]]</td>
							<td>{display property='is_required' object_sid=$listing_field.sid}</td>
							<td class="text-center"><a href="?sid={$listing_field.sid}&field_sid={$field_sid}&action=edit" title="[[Edit]]" class="btn btn--secondary">[[Edit]]</a></td>
						</tr>
					{/foreach}
				</tbody>
			</table>
		</div>
	</div>
</div>