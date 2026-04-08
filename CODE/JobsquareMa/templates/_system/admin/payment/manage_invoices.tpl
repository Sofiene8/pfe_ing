<script language="JavaScript" type="text/javascript" src="{common_js}/pagination.js"></script>
<div class="panel panel-default panel--max">
	<form method="post" name="invoices_form" action="{$GLOBALS.site_url}/manage-invoices/" class="panel-body">
		<input type="hidden" name="action_name" id="action_name" value="" />
		<div class="table__pagination table__pagination--header">
			{include file="../pagination/pagination_top.tpl" layout="header"}
		</div>
		<div class="table-responsive">
			<table class="table table-striped with-bulk">
				<thead>
					{include file="../pagination/sort.tpl"}
				</thead>
				<tbody>
					{foreach from=$found_invoices item=invoice name=invoices_block}
						<tr>
							<td style="width: 46px;">
								<label class="cr-styled">
									<input type="checkbox" name="invoices[{$invoice.sid}]" value="1" id="checkbox_{$smarty.foreach.invoices_block.iteration}" />
									<i class="fa"></i>
								</label>
							</td>
							<td><a href="{$GLOBALS.site_url}/view-invoice/?sid={$invoice.sid}">{$invoice.sid}</a></td>
							<td class="td-wide">
								{if $invoice.user}
									<a href="{$GLOBALS.site_url}/edit-user/?user_sid={$invoice.user_sid}">
										{if $invoice.user.CompanyName}
											{$invoice.user.CompanyName}
										{elseif $invoice.user.FullName}
											{$invoice.user.FullName}
										{else}
											{$invoice.user.username}
										{/if}
									</a>
								{else}
									<span class="invoice-washy">[[User deleted]]</span>
								{/if}
							</td>
							<td>{display property='date' object_sid=$invoice.sid}</td>
							<td>
								{display property='payment_method' object_sid=$invoice.sid}
								{if $invoice.recurring_id}
									<span class="label label-info">[[Recurring]]</span>
								{/if}
							</td>
							<td>
								{capture assign="invoiceTotal"}{display property='total' object_sid=$invoice.sid}{/capture}
								{currencyFormat amount=$invoiceTotal}
							</td>
							<td>
								{if $invoice.status == 'Paid'}
									<span class="label label--active">{display property='status' object_sid=$invoice.sid}</span>
								{else}
									<span class="label label--inactive">{display property='status' object_sid=$invoice.sid}</span>
								{/if}
							</td>
						</tr>
					{/foreach}
				</tbody>
			</table>
		</div>
		<div class="table__pagination table__pagination--footer">
			{include file="../pagination/pagination.tpl" layout="footer"}
		</div>
	</form>
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
