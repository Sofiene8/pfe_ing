<script language="JavaScript" type="text/javascript" src="{common_js}/pagination.js"></script>
{capture name="confirmToDelete"}[[Are you sure you want to delete this {$listingsType.name|lower}?]]{/capture}
<div class="panel panel-default panel--max clearfix">
	<div class="table__pagination table__pagination--header">
		{include file="../pagination/pagination_top.tpl" layout="header"}
	</div>

	<form method="post" action="{$GLOBALS.site_url}/listing-actions/" name="resultsForm" class="clearfix">
		<input type="hidden" name="action_name" id="action_name" value="">
		<input type="hidden" name="listingTypeId" value="{$listingsType.id}">
		<div class="table-responsive">
			<table width="100%" class="table table-striped with-bulk">
				<thead>
					{include file="../pagination/sort.tpl"}
				</thead>
				<tbody>
				{foreach from=$listings item=listing name=listings_block}
					<tr>
						<td class="text-center">
							<label class="cr-styled">
								<input type="checkbox" name="listings[{$listing.id}]" value="1" id="checkbox_{$smarty.foreach.listings_block.iteration}" />
								<i class="fa"></i>
							</label>
						</td>
						<td class="td-wide"><a href="{$GLOBALS.site_url}/edit-listing/?listing_id={$listing.id}">{$listing.Title|escape:'html'}</a></td>
						<td class="td-wide">
							<a href="{$GLOBALS.site_url}/edit-user/?user_sid={$listing.user.sid}">
								{if $listing.type.id == 'Job' || $listing.type.id == 'Training'}
									{$listing.user.CompanyName|escape}
									{*{if !$listing.user.CompanyName}{$listing.user|@var_dump}{/if}*}
								{else}
									{$listing.user.FullName|escape}
								{/if}
							</a>
						</td>
						{if $listing.type.id == 'Job'}
							<td class="td-wide">[[{$listing.product.name|escape}]]</td>
						{/if}
						<td>{$listing.activation_date|date:null:true}</td>
						{if $listing.type.id == 'Job'}
							<td>
								{if $listing.applications || !$listing.application_redirects}
									<span class="nowrap">
										{if $listing.applications}
											<a href="{$GLOBALS.site_url}/system/applications/view/?user_sid={$listing.user.id}&amp;appJobId={$listing.id}">
												{$listing.applications} [[applications]]
											</a>
										{else}
											{$listing.applications} [[applications]]
										{/if}
									</span>
								{/if}
								{if $listing.application_redirects}
									<span class="nowrap">{if $listing.applications}/{/if} {$listing.application_redirects} [[apply clicks]]</span>
								{/if}
							</td>
						{/if}
						<td>
							{if $listing.views}
								<span class="nowrap">{$listing.views} Views</span>
														
							{else}
								<span class="nowrap">0 View</span>
							{/if}
						</td>
						<td>
							{if $listing.active|status == 'active'}
								<span class="label label--active">[[Active]]</span>
							{elseif $listing.active|status == 'pending'}
								<span class="label label--pending">[[Pending Approval]]</span>
							{else}
								<span class="label label--inactive">[[Not Active]]</span>
							{/if}
						</td>
					</tr>
				{/foreach}
				</tbody>
			</table>
		</div>
	</form>
	<div class="table__pagination table__pagination--footer">
		{include file="../pagination/pagination.tpl" layout="footer"}
	</div>
</div>

{javascript}
	<script type="text/javascript">
		$('.bulk-action').on('click', function() {
			var action = $(this).data('action');
			if (action == 'delete') {
				if (confirm('{$paginationInfo.translatedText.delete}')) {
					submitForm(action);
				}
			} else {
				submitForm(action);
			}
			return false;
		});

		function isPopUp(button, textChooseAction, textChooseItem, textToDelete) {
			if (isActionEmpty(button, textChooseAction, textChooseItem)) {
				var action = $("#selectedAction_" + button).val();
				switch (action) {
					case "delete":
						if (confirm(textToDelete)) {
							submitForm(action);
						}
						break;
					default:
						submitForm(action);
						break;
				}
			}
		}

	</script>
{/javascript}
