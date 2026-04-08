{breadcrumbs}<a href="{$GLOBALS.site_url}/listing-fields/">[[Listing Fields]]</a> / [[{$listing_field_info.caption|escape}]]{/breadcrumbs}
<div class="page-title">
	<h1 class="title">[[Edit Listing Field Info]]</h1>
</div>
{include file="field_errors.tpl"}

{if $field_type eq 'complex'}
    <p><a href="{$GLOBALS.site_url}/edit-listing-field/edit-fields/?field_sid={$field_sid}" class="btn btn--primary">[[Edit Fields]]</a></p>
{/if}

<div class="panel panel-default panel--max">
	<div class="panel-heading">
		<h3 class="panel-title">[[Listing Field Info]]</h3>
	</div>
	<form id="fieldData" method="post" action="" class="panel-body form-horizontal">
		<input type="hidden" id="action" name="action" value="apply_info" />
		<input type="hidden" name="sid" value="{$field_sid}" />
		{foreach from=$form_fields key=field_name item=form_field}
			<div class="form-group" id="tr_{$field_name}" {if $form_field.id == 'id'}style="display: none;"{/if}>
				<label id="td_caption_{$field_name}" class="control-label col-md-2">
					{if $form_field.id == 'default_value'}
						<div id="defaultCaption">[[{$form_field.caption}]]</div>
					{else}
						[[{$form_field.caption}]]
					{/if}
					{if $form_field.is_required}&nbsp;<span class="required">*</span>{/if}
				</label>
				<div class="col-md-7">
					{if $field_name eq 'choiceLimit'}
						{input property=$form_field.id}
						<span data-toggle="tooltip" data-placement="auto left" title="[[Set empty or 0 for unlimited selection]]"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
					{elseif $field_name == 'display_as' && ($field_type == 'list' || $field_type == 'multilist')}
						{input property=$form_field.id template="list_empty.tpl"}
					{else}
						{input property=$form_field.id}
					{/if}
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
			<div class="col-md-7 col-md-offset-2">
				<input type="submit" value="[[Save]]" class="btn btn--secondary"/>
			</div>
		</div>
	</form>
</div>