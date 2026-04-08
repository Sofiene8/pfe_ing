{breadcrumbs}<a href="{$GLOBALS.site_url}/promotions/" title="">[[Discounts]]</a> / [[Discounts Log]]{/breadcrumbs}
<div class="page-title">
	<h1 class="title">[[Discounts Log]]</h1>
</div>
{if !empty($errors)}
	{include file="errors.tpl"}
{/if}
<div class="panel panel-default panel--small">
	<div class="panel-heading">
		<h3 class="panel-title">[[Discount Code Info]]</h3>
	</div>
	<div class="panel-body">
		<div><strong>[[Discount Code]]:</strong> {$promotionInfo.code|escape}</div>
		<div>
			<strong>[[Discount]]:</strong>
			{if $promotionInfo.type == 'percentage'}
				{$promotionInfo.discount}%
			{else}
				{capture assign="discount"}{tr type="float"}{$promotionInfo.discount}{/tr}{/capture}
				{currencyFormat amount=$discount}
			{/if}
		</div>
		<div><strong>[[Start Date]]:</strong> {$promotionInfo.start_date|date}</div>
		<div><strong>[[Expiry Date]]:</strong> {$promotionInfo.end_date|date}</div>
		<div><strong>[[Status]]:</strong> {if $promotionInfo.maximum_uses && $promotionInfo.uses >= $promotionInfo.maximum_uses}[[Used]]{elseif $promotionInfo.active == 1}[[Active]]{elseif $promotionInfo.active == 2}[[Expired]]{else}[[Not Active]]{/if}</div>
	</div>
</div>
<div class="page-title">
	<h1 class="title">[[Log of users used the code]]</h1>
</div>

<div class="panel panel-default panel--max">
	<form method="post" name="promotionsLogForm" class="panel-body">
		{capture name="tableHeaderContent"}
			<div class="resultsnumber">[[Usage number]]: {$resultsNumber}</div>
			<ul class="pagination pull-right pagination__discounts" style="margin-top: 2px;">
				{foreach from=$pages item=page}
					{if $page == $currentPage}
						<li><span>{$page}</span></li>
					{else}
						{if $page == $totalPages && $currentPage < $totalPages-3} ... {/if}
						</li><a href="?page={$page}{if $sorting_field ne null}&amp;sorting_field={$sorting_field}{/if}{if $sorting_order ne null}&amp;sorting_order={$sorting_order}{/if}&amp;items_per_page={$items_per_page}{$searchFields}">{$page}</a></li>
						<li><span>{if $page == 1 && $currentPage > 4} ... {/if}</span></li>
					{/if}
				{/foreach}
			</ul>
			<div class="number-per-page number-per-page__discounts pull-right">
				<label for="items_per_page">[[per page]]:</label>
				<select id="items_per_page" name="items_per_page" onchange="window.location = '?&items_per_page='+this.value;" class="per-page">
					<option value="10" {if $items_per_page == 10}selected="selected"{/if}>10</option>
					<option value="20" {if $items_per_page == 20}selected="selected"{/if}>20</option>
					<option value="50" {if $items_per_page == 50}selected="selected"{/if}>50</option>
					<option value="100" {if $items_per_page == 100}selected="selected"{/if}>100</option>
				</select>
			</div>
		{/capture}
		<div class="table__pagination table__pagination--header">
			{$smarty.capture.tableHeaderContent}
		</div>

		<div class="table-responsive">
			<table width="100%" class="table table-striped">
				<thead>
					<tr>
						<th>[[Username]]</th>
						<th>[[User Group]]</th>
						<th>[[Applied to]]</th>
						<th>[[Date]]</th>
						<th>[[Discount Amount]]</th>
					</tr>
				</thead>
				<tbody>
					{foreach from=$promotions item='promotion' name='promotion_block'}
						<tr>
							<td>{$promotion.user.username}</td>
							<td>[[{$promotion.user.userGroupID}]]</td>
							<td>{implode(', ', $promotion.products)}</td>
							<td>{$promotion.date|date}</td>
							<td>
								{capture assign="promotionAmount"}{tr type="float"}{$promotion.amount}{/tr}{/capture}
								{currencyFormat amount=$promotionAmount sign=$currency.currency_sign}
							</td>
						</tr>
					{/foreach}
				</tbody>
			</table>
		</div>
		<div class="table__pagination table__pagination--footer">
			{$smarty.capture.tableHeaderContent}
		</div>

	</form>
</div>
