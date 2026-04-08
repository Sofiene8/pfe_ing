<div class="page-title">
	<h1 class="title">[[Discounts]]</h1>
	<div class="page-title__buttons">
		<a href="{$GLOBALS.site_url}/add-promotion-code/" class="btn btn--primary">[[Add a New Discount Code]]</a>
	</div>
</div>
<p>[[Discounts allow you to offer discounts to users for certain products and services]]</p>
{foreach from=$errors item="error_message" key="error"}
	{if $error eq "DATE_IS_NOT_VALID"}
		<p class="error">[[Please change the expiration date first]]</p>
	{elseif $error eq "MAX_USES_ACHIEVED"}
		<p class="error">[[Please change the 'Maximum Uses' first]]</p>
	{/if}
{/foreach}
<div class="panel panel-default panel--max">

	<form class="inline-block enable-discount">
		<input type="hidden" name="action" value="setting" />
		<label class="cr-styled">
			[[Enable Discount Codes]]&nbsp;&nbsp;
			<input type="checkbox" name="enable_promotion_codes" value="1" {if $GLOBALS.settings.enable_promotion_codes == 1}checked = checked{/if} onChange="javascript: form.submit();" />
			<i class="fa"></i>
		</label>
	</form>

	<form method="post" action="{$GLOBALS.site_url}/promotions/" class="panel-body panel-discount">
		<input type="hidden" name="action" id="action" value="" />
		<div class="bulk">
			<button class="btn btn-default bulk-action" data-action="activate">
				<i class="fa fa-eye" aria-hidden="true"></i> [[Activate]]
			</button>
			<button class="btn btn-default bulk-action" data-action="deactivate">
				<i class="fa fa-eye-slash" aria-hidden="true"></i> [[Deactivate]]
			</button>
			<button class="btn btn-default bulk-action" data-action="delete">
				<i class="fa fa-trash-o" aria-hidden="true"></i> [[Delete]]
			</button>
		</div>
		<div class="table-responsive">
			<table class="table table-striped with-bulk">
				<thead>
					<tr>
						<th class="text-center" style="width: 46px">
							<label class="cr-styled">
								<input type="checkbox" id="all_checkboxes_control">
								<i class="fa"></i>
							</label>
						</th>
						<th style="white-space: nowrap">[[Discount Code]]</th>
						<th>[[Discount]]</th>
						<th>[[Uses]]</th>
						<th>[[Start Date]]</th>
						<th>[[Expiry Date]]</th>
						<th>[[Status]]</th>
					</tr>
				</thead>
				<tbody>
					{foreach from=$promotions item=promotion name=promotion_block}
						<tr class="{cycle values = 'evenrow,oddrow'}">
							<td class="text-center">
								<label class="cr-styled">
									<input type="checkbox" name="sid[{$promotion.sid}]" value="1"/>
									<i class="fa"></i>
								</label>
							</td>
							<td><a href="{$GLOBALS.site_url}/edit-promotion-code/?sid={$promotion.sid}">{$promotion.code|escape}</a></td>
							{capture assign="discount"}{tr type="float"}{$promotion.discount}{/tr}{/capture}
							<td>{if $promotion.type == 'percentage'}{$discount}%{else}{currencyFormat amount=$discount}{/if}</td>
							<td>{$promotion.uses}{if $promotion.maximum_uses != 0}/{$promotion.maximum_uses}{/if}</td>
							<td>{$promotion.start_date|date}</td>
							<td>{$promotion.end_date|date}</td>
							<td>
								{if $promotion.active == 'used'}
									<span class="label label--pending">[[Used]]</span>
								{elseif $promotion.active == 1}
									<span class="label label--active">[[Active]]</span>
								{elseif $promotion.active == 2}
									<span class="label label--expired">[[Expired]]</span>
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
</div>
{javascript}
	<script language="JavaScript" type="text/javascript" src="{common_js}/pagination.js"></script>
	<script>
		$('.bulk-action').on('click', function() {
			var action = $(this).data('action');
			var tt = $('#sid').attr('val');
			if (action == 'delete') {
				if (confirm('[[Are you sure you want to delete this code?]]')) {
					submitDiscountForm(action, tt);
				}
			} else {
				submitDiscountForm(action);
			}
			return false;
		});

		function submitDiscountForm(action) {
			$("#action").val(action);
			$("#action").parent("form").submit();
		}
	</script>
{/javascript}