{breadcrumbs}<a href="{$GLOBALS.site_url}/manage-invoices/">[[Orders]]</a> / [[View Order]]{/breadcrumbs}
<div class="page-title page-title--wide">
	<h1 class="title">[[View Order]]</h1>
	<div class="page-title__buttons">
		{if $user}
			<a class="btn btn--primary" href="{$GLOBALS.user_site_url}/invoice/{$invoice_sid}/{$invoice_hash}/" target="_blank">[[View Invoice]]</a>
		{/if}
	</div>
</div>
{include file='errors.tpl'}
<div class="panel panel-default panel--wide">
	<div class="panel-heading">
		<h3 class="panel-title">[[Order# {$invoice_sid}]]</h3>
	</div>
	<form method="post" enctype="multipart/form-data" class="panel-body">
		<input type="hidden" name="action" value="save" id="action">
		<input type="hidden" name="sid" value="{$invoice_sid}"/>
		<div class="table-responsive">
			<table class="table table-clear table__invoice">
				<tr>
					{if $user}
						<td class="text-left">
							<p>
								<a href="{$GLOBALS.site_url}/edit-user/?user_sid={$user.sid}">
									{if $user.CompanyName}{$user.CompanyName|escape}{else}{$user.FullName|escape}{/if}
								</a>
							</p>
							{if $user.GooglePlace}
								<p>{$user.GooglePlace|escape}</p>
							{/if}
							{if $user.Phone}
								<p>{$user.Phone|escape}</p>
							{/if}
						</td>
					{else}
						<td><span class="invoice-washy">[[User deleted]]</span></td>
					{/if}
					<td class="text-right">
						<p class="text-right"><strong>[[Order Date]]:</strong> {display property="date"}</p>
						<p>
							<strong>[[Order Status]]:</strong>
							{if {display property="status"} == 'Unpaid'}
								<span class="label label--inactive">{display property="status"}</span>
							{elseif {display property="status"} == 'Paid'}
								<span class="label label--active">{display property="status"}</span>
							{/if}
						</p>
						<p><strong>[[Payment Method]]:</strong> {display property="payment_method"}</p>
					</td>
				</tr>
				{input property='items' template="items_complex.tpl"}
				<tr>
					<td class="text-right" colspan="2">
						<div class="col-md-3 col-md-offset-9">
							<p><strong>[[Sub Total]]:</strong>  {display property='sub_total' assign="subtotal"}{currencyFormat amount=$subtotal}</p>
							<p {if !$include_tax}class="hidden"{/if}><strong>[[Tax]]:</strong> {capture assign='tax_amount'}{tr type='float'}{$tax.tax_amount}{/tr}{/capture} {currencyFormat amount=$tax_amount}</p>
							<hr>
							<h3 class="invoice__total">{display property='total' assign="total"}{currencyFormat amount=$total}</h3>
						</div>
					</td>
				</tr>
			</table>
		</div>
	</form>
</div>
<br/><br/>
{include file="transactions_by_invoice.tpl"}
