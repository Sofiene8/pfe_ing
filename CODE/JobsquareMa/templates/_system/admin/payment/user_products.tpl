{breadcrumbs}<a href="{$GLOBALS.site_url}/manage-users/{$user_group_info.id|lower}/?restore=1">[[{$user_group_info.name} Profiles]]</a> / <a href="{$GLOBALS.site_url}/edit-user/?user_sid={$user_sid}">[[Edit {$user_group_info.name}</a> / Products]]{/breadcrumbs}
{javascript}
	<script type="text/javascript">
		$('.addProduct').on('click', function(e) {
			e.preventDefault();
			$('#user-product').modal('show');
		});

		$('#user-product').on('show.bs.modal', function() {
			var options = {
				type: 'GET',
				target:  $(this).find('.modal-body'),
				url: $('.addProduct').data('href')
			};

			$('#user-product').ajaxSubmit(options);

		});

		function deleteProduct(link)
		{
			if (confirm('[[Are you sure you want to delete this user product?]]'))
				location.href=link;
		}
	</script>
{/javascript}

<div class="page-title page-title--wide">
	<h1 class="title">[[Manage User Products]]</h1>
	<div class="page-title__buttons">
		<a data-href="{$GLOBALS.site_url}/add-user-product/?user_sid={$user_sid}" class="addProduct btn btn--primary">[[Add New Product]]</a>
	</div>
</div>

<div class="modal fade" id="user-product" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="user-product-label">[[Add New Product]]</h4>
			</div>
			<div class="modal-body">
			</div>
		</div>
	</div>
</div>
<div class="panel panel-default panel--wide">
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-striped table__user-products">
				<thead>
					<tr>
						<th>[[Product Name]]</th>
						<th>[[Activation Date]]</th>
						<th>[[Expiration / Renewal Date]]</th>
						<th>[[Stats]]</th>
						<th>[[Status]]</th>
						<th class="text-center">[[Actions]]</th>
					</tr>
				</thead>
				<tbody>
					{foreach from=$contracts item=contract}
						<tr class="{cycle values = 'evenrow,oddrow'}">
							<td class="text-left">
								[[{$contract.product_info.name|escape}]]
								{if $contract.product_info.recurring}
									<span class="label label-info">[[Recurring]]</span>
								{/if}
							</td>
							<td>{$contract.creation_date|date}</td>
							<td>{if $contract.expired_date}{$contract.expired_date|date}{else}[[Unlimited]]{/if}</td>
							<td>
								{if $contract.listingAmount}
									{foreach from=$contract.listingAmount item=listingAmount}
										<div>[[{$listingAmount.name}s Left to Post]]: [[{$listingAmount.listingsLeft}]]</div>
									{/foreach}
								{/if}
							</td>
							<td>
								{if $contract.status == 'active'}
									<span class="label label--active">[[Active]]</span>
								{elseif $contract.status == 'canceled'}
									<span class="label label--inactive">[[Canceled]]</span>
								{else}
									<span class="label label--inactive">[[Not Active]]</span>
								{/if}
							</td>
							<td class="text-center">
								<a href="#" onclick="deleteProduct('{$GLOBALS.site_url}/user-products/?action=remove&user_sid={$user_sid}&contract_id={$contract.id}');">
									<i class="ion-close-circled"></i>
								</a>
								{if $contract.status == 'pending'}
									<input type="button" name="button" value="[[Activate]]" class="btn btn--primary" onclick="location.href='{$GLOBALS.site_url}/user-products/?action=activate&user_sid={$user_sid}&contract_id={$contract.id}'">
								{/if}
							</td>
						</tr>
					{/foreach}
				</tbody>
			</table>
		</div>
	</div>
</div>