{breadcrumbs}
	<a href="{$GLOBALS.site_url}/manage-users/{$userGroup.id|lower}/">
		[[{$userGroup.name} Profiles]]
	</a>
	/
	[[Export {$userGroup.name}s]]
{/breadcrumbs}
<div class="page-title">
	<h1 class="title">[[Export {$userGroup.name}s]]</h1>
</div>

<div class="panel panel-default panel--max">
	<form method="post" class="panel-body form-horizontal">
		<div class="form-group">
			<div class="col-xs-12">[[Export Filter]]</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">[[Username]]: </label>
			<div class="col-md-7">{search property="username"}</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">[[Product]]:</label>
			<div class="col-md-7">{search property="product" template="multilist.tpl"}</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">[[Registration Date]]: </label>
			<div class="col-md-7">{search property="registration_date"}</div>
		</div>
		<div class="form-group">
			<div class="col-md-7 col-md-offset-2">
				<div class="table-responsive">
					<table class="basetable table table-bordered table__export">
						<input type="hidden" name="action" value="export">
						<input type="hidden" name="user_group_id" value="{$userGroup.id}">
						<thead>
							<tr>
								<th colspan="6">[[User Properties to Export]]</th>
							</tr>
						</thead>
						<tbody>
							<tr class="oddrow">
								{assign var="i" value=0}
								{foreach from=$userSystemProperties.system item=property_id name=system_properties}
									{assign var="i" value=$i+1}
									<td colspan="2">
										<label class="cr-styled">
											<input type="checkbox" name="export_properties[{$property_id}]" value="1" />
											<i class="fa"></i>
											{$property_id}
											[[{$property.caption|escape}]]
										</label>
									</td>
									{if $i % 3 == 0}
										</tr><tr class="{cycle values="evenrow,oddrow"}">
									{/if}
								{/foreach}
								{foreach from=$userCommonProperties item=properties key=groupName}
									{if $userGroup.id == $groupName}
										{foreach from=$properties item=property name="properties"}
											{assign var="i" value=$i+1}
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
										{/foreach}
									{/if}
								{/foreach}
							</tr>
							<tr class="{cycle values="evenrow,oddrow"}">
								<td colspan="6">
									<a href="#" onClick="check_all();return false;" class="btn btn--secondary">[[Select All]]</a> /
									<a href="#" onClick="uncheck_all();return false;" class="btn btn--secondary">[[Deselect All]]</a>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-7 col-md-offset-2">
				<input type="submit" value="[[Export]]" class="btn btn--primary" />
			</div>
		</div>
	</form>
</div>

<script language="Javascript">
function check_all()
{
	$('.basetable :checkbox').each(function() {
		this.checked = true;
	});
}

function uncheck_all()
{
	$('.basetable :checkbox').each(function() {
		this.checked = false;
	});
}
</script>
