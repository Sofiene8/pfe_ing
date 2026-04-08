{breadcrumbs}<a href="{$GLOBALS.site_url}/custom-fields/">[[Custom Fields]]</a> / [[Edit {$user_group_info.name} Fields]]{/breadcrumbs}
<div class="page-title page-title--wide">
	<h1 class="title">[[Edit {$user_group_info.name} Fields]]</h1>

	<div class="page-title__buttons">
		<a href="{$GLOBALS.site_url}/add-user-profile-field/?user_group_sid={$user_group_sid}" class="btn btn--primary">[[Add {$user_group_info.name} Field]]</a>
	</div>
</div>

<div class="errors"></div>

{foreach from=$errors key=error item=message}
	{if $error eq "USER_GROUP_SID_NOT_SET"}
		<p class="error">[[User group SID is not set]]</p>
	{/if}
{foreachelse}
	<div class="panel panel-default panel--wide clearfix">
		<form method="post" action="" name="fields_items_form" id="fields_items_form" class="panel-body">
			<input type="hidden" name="field_action" id="field_action" value="save_order" />
			<input type="hidden" name="user_group_sid" value="{$user_group_sid}" />
			<div class="table-responsive">
				<table id="fields_table" class="table table-striped with-bulk">
					<thead>
						<tr>
							<th></th>
							<th>[[Caption]]</th>
							<th>[[Type]]</th>
							<th>[[Required]]</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
					{foreach from=$user_profile_fields item=user_profile_field name=fields_block}
						{if $user_profile_field.id != 'Location'}
							<tr class="{cycle values = 'evenrow,oddrow'}">
								<td class="sortable-handle">...</td>
								<td>
									<a href="{$GLOBALS.site_url}/edit-user-profile-field/?sid={$user_profile_field.sid}&amp;user_group_sid={$user_group_sid}" title="[[Edit]]">[[{$user_profile_field.caption|escape}]]</a>
									<input type="hidden" name="item_order[{$user_profile_field.sid}]" value="1">
								</td>
								<td>{$user_profile_field.typeCaption}</td>
								<td>{if $user_profile_field.is_required}[[Yes]]{else}[[No]]{/if}</td>
								<td>
									{if !$user_profile_field.is_reserved}
										<a href="{$GLOBALS.site_url}/delete-user-profile-field/?sid={$user_profile_field.sid}&amp;user_group_sid={$user_group_sid}" onclick="return confirm('[[Are you sure you want to delete this field?]]')" title="[[Delete]]">
											<i class="ion-close-circled"></i>
										</a>
									{/if}
								</td>
							</tr>
						{/if}
					{/foreach}
				</table>
			</div>
		</form>
	</div>
{/foreach}

<script>
	$(function() {
		$('tbody').sortable({
			helper: function(e, ui) {
				ui.children().each(function() {
					$(this).width($(this).width());
				});
				return ui;
			},
			handle: '.sortable-handle',
			update: function() {
				$('#fields_items_form').ajaxSubmit({
					error: function() {
						$('.errors').empty();
						$('.errors').append('<div class="alert alert-danger">[[Oops... Something went wrong. Please try again!]]</div>');
					},
					success: function() {
						$('.errors').empty();
					}
				});
			}
		});
	});
</script>
