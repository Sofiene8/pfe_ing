{capture assign="trAskToDelete"}[[Are you sure you want to delete selected alert?]]{/capture}
<script language="JavaScript" type="text/javascript" src="{common_js}/pagination.js"></script>
{if !empty($errors)}
	{foreach from=$errors item="error"}
	<p class="error">[[{$error}]]</p>
	{/foreach}
{/if}

<div class="panel panel-default panel--max clearfix">
		<div class="table__pagination table__pagination--header">
			{include file="../pagination/pagination_top.tpl" layout="header"}
		</div>
		<form method="post" name="guestAlerts_form">
			<input type="hidden" name="action_name" id="action_name" value="" />
			<div class="table-responsive">
				<table width="100%" class="table table-striped with-bulk">
					<thead>
						{include file="../pagination/sort.tpl"}
					</thead>
					{foreach from=$guestAlerts item=guestAlert name=alerts_block}
						<tr class="{cycle values = 'evenrow,oddrow'}" id="guestAlerts[{$guestAlert.sid}]">
							<td class="text-center">
								<label class="cr-styled">
									<input type="checkbox" name="guestAlerts[]" value="{$guestAlert.sid}" id="checkbox_{$smarty.foreach.alerts_block.iteration}" />
									<i class="fa"></i>
								</label>
							</td>
							<td class="td-wide"><strong><a href="mailto:{$guestAlert.email}">{$guestAlert.email}</a></strong></td>
							<td>{$guestAlert.subscription_date|date:null:true}</td>
							<td>[[{$guestAlert.email_frequency}]]</b></td>
							<td>{$guestAlert.last_send|date}</td>
							<td>
								{if $guestAlert.status}
									<span class="label label--active">[[Active]]</span>
								{else}
									<span class="label label--inactive">[[Not Active]]</span>
								{/if}
							</td>
						</tr>
					{/foreach}
				</table>
			</div>
		</form>
		<div class="table__pagination table__pagination--footer">
			{include file="../pagination/pagination.tpl" layout="footer"}
		</div>

</div>

{javascript}
	<script>
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
	</script>
{/javascript}