{breadcrumbs}
	<a href="{$GLOBALS.site_url}/manage-{$selected_listing_type_id|lower}s/?restore=1">
		[[{$selected_listing_type_id} Postings]]
	</a>
	/
	[[Export {$selected_listing_type_id}s]]
{/breadcrumbs}
<div class="page-title">
	<h1 class="title">[[Export {$selected_listing_type_id}s]]</h1>
</div>
<div class="panel panel-default panel--max">
	<form method="post" class="panel-body form-horizontal">
		<div class="form-group">
			<div class="col-xs-12">[[Export Filter]]</div>
		</div>
		<div class="form-group" style="display: none;">
			<label class="col-md-2 control-label">[[Listing Type]]: </label>
			<div class="col-md-7">{search property="listing_type" template="list_with_reload.tpl"}</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">[[Activation Date]]:</label>
			<div class="col-md-7">{search property="activation_date"}</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">[[Expiration Date]]:</label>
			<div class="col-md-7">{search property="expiration_date"}</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">[[Username]]: </label>
			<div class="col-md-7">{search property="username"}</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">[[Featured]]: </label>
			<div class="col-md-7">{search property="featured"}</div>
		</div>
		<div class="form-group">
			<div class="col-md-7 col-md-offset-2">
				<div class="table-responsive">
					<table class="basetable table table-bordered table__export">
						<input type="hidden" name="action" value="export" />
						<thead>
						<tr>
							<th colspan="6">[[Listing Properties To Export]]</th>
						</tr>
						</thead>
						<tbody class="listings-properties">
						<tr class="oddrow">
							{assign var='i' value=1}
							{foreach from=$properties.system item=property_id name=system_properties}
							<td colspan="2">
								<label class="cr-styled">
									<input type="checkbox" name="export_properties[{$property_id}]" value="1" />
									<i class="fa"></i>
									{$property_id|escape}
								</label>
							</td>
							{if $i % 3 == 0}
						</tr><tr class="{cycle values="evenrow,oddrow"}">
							{/if}
							{assign var='i' value=$i+1}
							{/foreach}
							{foreach from=$properties.common item=property name=common_properties}
							<td colspan="2">
								<label class="cr-styled">
									<input type="checkbox" name="export_properties[{$property.id}]" value="1" />
									<i class="fa"></i>
									[[{$property.caption|escape}]]
								</label>
							</td>
							{if $i % 3 == 0}
						</tr><tr class="{cycle values="evenrow,oddrow"}">
							{/if}
							{assign var='i' value=$i+1}
							{/foreach}
							{foreach from=$properties.extra item=property name=extra_properties}
							<td colspan="2">
								<label class="cr-styled">
									<input type="checkbox" name="export_properties[{$property.id}]" value="1" />
									<i class="fa"></i>
									[[{$property.caption|escape}]]
								</label>
							</td>
							{if $i % 3 == 0}
						</tr><tr class="{cycle values="evenrow,oddrow"}">
							{/if}
							{assign var='i' value=$i+1}
							{/foreach}
						</tr>
						<tr class="{cycle values="evenrow,oddrow"}">
							<td colspan="6">
								<a href="#" onClick="check_all_system();return false;" class="btn btn--secondary">[[Select All]]</a> /
								<a href="#" onClick="uncheck_all_system();return false;" class="btn btn--secondary">[[Deselect All]]</a>
							</td>
						</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-7 col-md-offset-2"><input type="submit" value="[[Export]]" class="btn btn--primary" /></div>
		</div>
	</form>
</div>
<br/>
<script language="Javascript">
	function check_all_system() 	{ set_checkbox_to(true); }
	function uncheck_all_system() 	{ set_checkbox_to(false); }

	function set_checkbox_to(flag)
	{
		$('.listings-properties :checkbox').each(function() {
			this.checked = flag;
		});
	}

</script>
