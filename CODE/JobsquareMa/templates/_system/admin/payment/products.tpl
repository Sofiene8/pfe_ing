{capture assign="trToDelete"}[[Are you sure you want to delete this product?]]{/capture}
{capture assign="trToCannotActivateProduct"}[[The product cannot be activated. Please change the availability date.]]{/capture}
{capture assign="trToProductForEmployers"}[[The product cannot be activated. This product is only for Employers. Please change the User Group.]]{/capture}

<div class="page-title page-title--wide">
	<h1 class="title">[[{$userGroup.name} Products]]</h1>
	<div class="page-title__buttons">
		{if $userGroup.id == 'Employer'}
			<div class="btn-group">
				<button type="button" class="btn btn--primary dropdown-toggle" data-toggle="dropdown" aria-expanded="true">[[Add New Job Product]] <span class="caret"></span></button>
				<ul class="dropdown-menu" role="menu">
					<li>
						<a href="{$GLOBALS.site_url}/add-product/?user_group_sid={$userGroup.sid}">[[Onetime Payment]]</a>
					</li>
					<li>
						<a href="{$GLOBALS.site_url}/add-product/?user_group_sid={$userGroup.sid}&amp;recurring=1">[[Recurring Subscription]]</a>
					</li>
				</ul>
			</div>
			<div class="btn-group">
				<button type="button" class="btn btn--primary dropdown-toggle" data-toggle="dropdown" aria-expanded="true">[[Add New Training Product]] <span class="caret"></span></button>
				<ul class="dropdown-menu" role="menu">
					<li>
						<a href="{$GLOBALS.site_url}/add-product/?user_group_sid={$userGroup.sid}&amp;listing_type_sid=26">[[Onetime Payment]]</a>
					</li>
					<li>
						<a href="{$GLOBALS.site_url}/add-product/?user_group_sid={$userGroup.sid}&amp;recurring=1&amp;listing_type_sid=26">[[Recurring Subscription]]</a>
					</li>
				</ul>
			</div>
		{else}
			<a href="{$GLOBALS.site_url}/add-product/?user_group_sid={$userGroup.sid}" class="btn btn--primary">[[Add New Product]]</a>
		{/if}
	</div>
</div>
<div class="errors">
</div>
<div class="panel panel-default panel--wide">
	<form method="post" action="{$GLOBALS.admin_site_url}/products/{$userGroup.id|lower}/" class="products__form">
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table__products">
					<thead>
						<tr>
							<th style="width: 45px !important;"></th>
							<th style="width: 500px; white-space: normal;">[[Name]]</th>
							<th>[[Price]]</th>
							<th>[[Status]]</th>
							<th class="actions" width="1%"></th>
						</tr>
					</thead>
					<tbody>
						{foreach from=$products item=product}
							<tr>
								<td class="sortable-handle">...</td>
								<td class="table__products-name" style="width: 500px; white-space: normal;">
									<input type="hidden" name="products[]" value="{$product.sid}" />
									<a href="{$GLOBALS.site_url}/edit-product/?sid={$product.sid}" title="[[Edit]]">
										<strong>[[{$product.name|escape}]]</strong> {if $product.recurring}<span class="label label-info">[[Recurring]]</span>{/if}
									</a>
									{if $userGroup.default_product == $product.sid}
										<div style="margin: 5px 0;">
											<small>
												[[Assigned to {$userGroup.name|lower} upon registration]]
											</small>
										</div>
									{/if}
								</td>
								<td>
									{capture assign="productPrice"}{tr type="float"}{$product.price}{/tr}{/capture}
									{if $product.period}
										{if $product.period_name == 'unlimited'}
											{currencyFormat amount=$productPrice}
										{else}
											{currencyFormat amount=$productPrice} [[per]] {$product.period} {if $product.period > 1 }[[{$product.period_name|capitalize}s]]{else}[[{$product.period_name|capitalize}]]{/if}
										{/if}
									{else}
										{currencyFormat amount=$productPrice}
									{/if}
								</td>
								<td>
									{if $product.active == 1}
										<span class="label label--active">[[Active]]</span>
									{else}
										<span class="label label--inactive">[[Not Active]]</span>
									{/if}
								</td>
								<td nowrap="nowrap">
									<a href="{$GLOBALS.site_url}/products/{$userGroup.id|lower}/?action=delete&sid={$product.sid}" onClick="return confirm('{$trToDelete|escape}');" title="[[Delete]]">
										<i class="ion-close-circled"></i>
									</a>
								</td>
							</tr>
						{/foreach}
					</tbody>
				</table>
			</div>
		</div>
	</form>
</div>
{javascript}
	<script>
		$(document).ready(function() {
			$('tbody').sortable({
				helper: function(e, ui) {
					ui.width(ui.width());
					return ui;
				},
				handle: '.sortable-handle',
				update: function() {
					$('.products__form').ajaxSubmit({
						data: {
							action: 'reorder'
						},
						success: function() {
							$('.errors').empty();
						},
						error: function() {
							$('.errors').empty();
							$('.errors').append('<div class="alert alert-danger">[[Oops... Something went wrong. Please try again!]]</div>');
						}
					});
				}
			});

			$('.sortable-handle').disableSelection();
		});
	</script>
{/javascript}