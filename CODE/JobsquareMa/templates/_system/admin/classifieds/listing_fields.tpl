{breadcrumbs}[[Common Fields]]{/breadcrumbs}
<div class="page-title">
	<h1 class="title">[[Common Fields]]</h1>
</div>
<div class="panel panel-default panel--wide">
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-bordered">
				<thead>
					<th>[[Caption]]</th>
					<th>[[Type]]</th>
					<th>[[Required]]</th>
					<th colspan="2" class="actions">[[Actions]]</th>
				</thead>
				<tbody>
					{foreach from=$listing_field_sids item=listing_field_sid name=items_block}
						{display property='id' object_sid=$listing_field_sid assign=fieldID}
						<tr {if $fieldID == "Location"}style="display: none;"{/if}>
							<td>[[{display property='caption' object_sid=$listing_field_sid}]]</td>
							<td>[[{display property='type' object_sid=$listing_field_sid}]]</td>
							<td>{display property='is_required' object_sid=$listing_field_sid}</td>
							<td><a href="{$GLOBALS.site_url}/edit-listing-field/?sid={$listing_field_sid}" title="[[Edit]]" class="btn btn--secondary">[[Edit]]</a></td>
							<td>{if $fieldID != 'Location'}<a href="{$GLOBALS.site_url}/delete-listing-field/?sid={$listing_field_sid}" onclick='return confirm("[[Are you sure you want to delete this field?]]")' title="[[Delete]]" class="btn btn--danger">[[Delete]]</a>{/if}</td>
						</tr>
					{/foreach}
				</tbody>
			</table>
		</div>
	</div>
</div>