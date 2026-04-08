{breadcrumbs}<a href="{$GLOBALS.site_url}/custom-fields/">[[Custom Fields]]</a> / <a href="{$GLOBALS.site_url}/edit-user-profile/?user_group_sid={$user_group_sid}">[[Edit {$user_group_info.name} Fields]]</a> / [[{$user_profile_field_info.caption|escape}]]{/breadcrumbs}
<div class="page-title">
	<h1 class="title">[[Edit {$user_group_info.name} Profile Field Info]]</h1>
</div>
{include file="field_errors.tpl"}

<div class="panel panel-default panel--max">
	<form id="fieldData" method="post" enctype="multipart/form-data" class="form-horizontal panel-body">
		<input type="hidden" id="action" name="action" value="apply">
		<input type="hidden" name="sid" value="{$user_profile_field_sid}">
		<input type="hidden" name="user_group_sid" value="{$user_group_sid}">
		{foreach from=$form_fields key=field_name item=form_field}
			<div class="form-group" id="tr_{$field_name}" style="{if $form_field.id == 'type' || $form_field.id == 'id'
				|| ($form_field.id == 'second_width' && $field_type == 'logo') || ($form_field.id == 'second_height' && $field_type == 'logo')
				|| ($form_field.id == 'width' && $field_type == 'logo') || ($form_field.id == 'height' && $field_type == 'logo')}display: none;{/if}">
				<label class="control-label col-md-2" id="td_caption_{$field_name}">
					[[{$form_field.caption}]] {if $form_field.is_required}&nbsp;<span class="required">*</span>{/if}
				</label>
				<div class="col-md-7">
					{if $field_name eq 'choiceLimit'}
						{input property=$form_field.id}<br />
						<small>[[Set empty or 0 for unlimited selection]]</small>
					{elseif $field_name == 'display_as' && ($field_type == 'list' || $field_type == 'multilist')}
						{input property=$form_field.id template="list_empty.tpl"}
					{else}
						{if $form_field.id == 'width' || $form_field.id == 'height'}
							<div class="numerical-block">
								{input property=$form_field.id}
							</div>
						{else}
							{input property=$form_field.id}
						{/if}
					{/if}
				</div>
			</div>
		{/foreach}
		{if $field_type == 'list' || $field_type == 'multilist'}
			<div class="form-group">
				<div class="col-md-7 col-md-offset-2">
					{module name="users" function="edit_list" field_sid=$user_profile_field_sid}
				</div>
			</div>
		{/if}
		<div class="form-group">
			<div class="col-md-7 col-md-offset-2">
				<input type="submit" value="[[Save]]" class="btn btn--primary"/>
			</div>
		</div>
	</form>
</div>