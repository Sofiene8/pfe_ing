{breadcrumbs}
  <a href="{$GLOBALS.site_url}/edit-listing-type/?sid={$type_sid}">[[{$type_info.name} Fields]]</a>
	/ <a href="{$GLOBALS.site_url}/edit-listing-type-field/?sid={$field_sid}">[[{$field_info.caption|escape}]]</a>
	/ <a href='{$GLOBALS.site_url}/edit-listing-field/edit-fields/?field_sid={$field_sid}'>[[Edit Fields]]</a>
	/ [[Edit Listing Field]]
{/breadcrumbs}
<div class="page-title">
	<h1 class="title">[[Edit Listing Field]]</h1>
</div>

{include file="field_errors.tpl"}
<div class="panel panel-default panel--max">
	<div class="panel-heading">
		<h3 class="panel-title">[[Listing Field Info]]</h3>
	</div>
	<form method="post" action="" class="panel-body form-horizontal">
		<input type="hidden" name="action" value="add" />
		<input type="hidden" name="sid" value="{$sid}" />
		<input type="hidden" name="field_sid" value="{$field_sid}" />
		{foreach from=$form_fields key=field_name item=form_field}
			<div class="form-group" {if in_array($field_name, array('id', 'type'))}style="display: none;"{/if}>
				<label class="control-label col-md-2">
					{if $form_field.id == 'default_value'}
						<div id='defaultCaption' style='display: block;'>[[{$form_field.caption}]]</div>
					{else}
						[[{$form_field.caption}]]
					{/if}
					{if $form_field.is_required}&nbsp;<span class="required">*</span>{/if}
				</label>

				<div class="col-md-7">
					{input property=$form_field.id}
				</div>
			</div>
			{if $form_field.comment}
				<div class="form-group">
					<div class="col-md-7 col-md-offset-2">{$form_field.comment}</div>
				</div>
			{/if}
		{/foreach}
		<div class="form-group">
			<input type="hidden" name="old_listing_field_id" value="{$listing_field_info.id}" />
			<input type="hidden" name="apply" value="yes" />
			<div class="col-md-7 col-md-offset-2">
				<input type="submit" name="submit_form" value="[[Save]]" class="btn btn--primary"/>
			</div>
		</div>
	</form>
</div>