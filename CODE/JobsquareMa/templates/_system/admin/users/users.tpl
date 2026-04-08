<script language="JavaScript" type="text/javascript" src="{common_js}/pagination.js"></script>
<script type="text/javascript">
	var parentReload = false;

	function isPopUp(button, textChooseAction, textChooseItem, textToDelete) {
		if (isActionEmpty(button, textChooseAction, textChooseItem)) {
			var action = $("#selectedAction_" + button).val();
			switch (action) {
				case "delete":
					if (confirm(textToDelete)) {
						submitForm("delete");
					}
					break;
				default:
					submitForm(action);
					break;
			}
		}
		$("#selectedAction_" + button).val('');
	}

	function viewListingBlock() {
        $("#product_select option").each(function () {
        	$("#block_"+this.value).css('display', 'none');
          });
	
        $("#product_select option:selected").each(function () {
           $("#block_"+this.value).css('display', 'block');
         });
	}
	</script>

{if $errors}
	{foreach from=$errors item="error"}
		<p class="error">[[$error]]</p>
	{/foreach}
{/if}
<div class="panel panel-default panel--max clearfix">
	<div class="table__pagination table__pagination--header">
		{include file="../pagination/pagination_top.tpl" layout="header"}
	</div>
	<form method="post" name="users_form" class="clearfix">
		<input type="hidden" name="action_name" id="action_name" value="" />
		{*<input type="hidden" name="product_to_change" id="product_to_change" value="" />*}
		<input type="hidden" name="number_of_listings" id="number_of_listings" value="" />
		<div class="table-responsive">
			<table width="100%" class="table table-striped with-bulk">
				<thead>
					{include file="../pagination/sort.tpl"}
				</thead>
				{foreach from=$found_users item=user name=users_block}
					<tr>
						<td class="text-center">
							<label class="cr-styled">
								<input type="checkbox" name="users[{$user.sid}]" value="1" id="checkbox_{$smarty.foreach.users_block.iteration}" />
								<i class="fa"></i>
							</label>
						</td>
						{if $userGroupInfo.id == 'Employer'}
							<td class="td-wide"><a href="{$GLOBALS.site_url}/edit-user/?user_sid={$user.sid}" title="Edit">{$user.CompanyName|escape	}</a></td>
							<td class="td-wide"><a href="{$GLOBALS.site_url}/edit-user/?user_sid={$user.sid}" title="Edit">{$user.username|escape}</a></td>
							<td class="td-wide">
								{$user|location|escape}
							</td>
						{elseif $userGroupInfo.id == 'JobSeeker'}
							<td class="td-wide"><a href="{$GLOBALS.site_url}/edit-user/?user_sid={$user.sid}" title="Edit">{$user.FullName|escape}</a></td>
							<td class="td-wide"><a href="{$GLOBALS.site_url}/edit-user/?user_sid={$user.sid}" title="Edit">{$user.username|escape}</a></td>
						{/if}

						<td>{$user.registration_date|date:null:true}</td>
						<td>
							{if $user.active|status == 'active'}
								<span class="label label--active">[[Active]]</span>
							{elseif $user.active|status == 'pending'}
								<span class="label label--pending">[[Pending Approval]]</span>
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