<div class="panel panel-default page-title--wide">
	<div class="panel-heading" style="border: none;">
		<h4 class="panel-title">[[Transactions]]</h4>
	</div>
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-striped table__invoice">
				<tr>
					<th>[[Date]]</th>
					<th>[[Transaction Id]]</th>
					<th>[[Payment Method]]</th>
					<th>[[Amount]]</th>
				</tr>
				{foreach from=$transactions item=field}
					<tr class="{cycle values = 'evenrow,oddrow'}">
						<td>{$field.date|date}</td>
						<td>{$field.transaction_id}</td>
						<td>{$field.payment_method}</td>
						<td>{tr type="float"}{$field.amount}{/tr}</td>
					</tr>
				{/foreach}
			</table>
		</div>
	</div>
</div>
