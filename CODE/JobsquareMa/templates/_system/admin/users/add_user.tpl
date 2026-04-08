{breadcrumbs}
	<a href="{$GLOBALS.site_url}/manage-users/{$user_group.id|lower}/?restore=1">
		[[{$user_group.name} Profiles]]
	</a>
	/
	[[Add a New {$user_group.name}]]
{/breadcrumbs}
<div class="page-title">
	<h1 class="title">[[Add {$user_group.name}]]</h1>
</div>
{include file="field_errors.tpl"}

<div class="panel panel-default panel--max">
	<form method="post" enctype="multipart/form-data" action="{$GLOBALS.site_url}/add-user/{$user_group.id|lower}/" onsubmit="disableSubmitButton('submitAdd');" class="panel-body form-horizontal">
		{set_token_field}
		<input type="hidden" name="action" value="add">
		<input type="hidden" name="user_group_id" value="{$user_group.id}">
		{foreach from=$form_fields item=form_field}
			<div class="form-group" {if $form_field.id == 'Location'}style="display: none;"{/if}>
				<label class="col-md-2 control-label">[[{$form_field.caption|escape}]]{if $form_field.is_required}&nbsp;<span class="required">*</span>{/if}</label>
				<div class="col-md-7">
					{if $form_field.id == 'Phone'}
						<div class="half">
							{input property=$form_field.id}
						</div>
					{else}
						{input property=$form_field.id}
					{/if}
					{if in_array($form_field.type, array('multilist'))}
						<div id="count-available-{$form_field.id}" class="mt-count-available"></div>
					{/if}
				</div>
			</div>
		{/foreach}
		<div class="form-group">
			<div class="col-md-7 col-md-offset-2">
				<input type="submit" value="[[Save]]" class="btn btn--primary" id="submitAdd" />
			</div>
		</div>
	</form>
</div>