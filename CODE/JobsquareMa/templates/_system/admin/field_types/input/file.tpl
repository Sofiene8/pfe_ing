{if $GLOBALS.is_ajax || $smarty.get.ajax_submit}
	{foreach from=$errors key=key item=error}
		{if $key == 'NOT_ACCEPTABLE_FILE_FORMAT'}
			<p class="error">{$fomr_field.caption}: [[File format is not supported]]</p>
		{elseif $key == 'UPLOAD_ERR_INI_SIZE' || $key == 'MAX_FILE_SIZE_EXCEEDED'}
			<p class="error">[[File size shouldn't be larger than 5 MB.]]</p>
		{else}
			<p class="error">{$key}</p>
		{/if}
	{/foreach}
	<div id="file_{$id}">
		{if $value.file_name ne null}
			{$value.file_name|escape:'html'} ({$filesize|string_format:"%.2f"} {$size_token})
			| <a class="delete_file"
				 form_token="{$form_token}"
				 listing_id="{if $listing_id}{$listing_id}{else}{$listing.id}{/if}"
				 field_id="{$id}"
				 file_id="{$value.file_id}"
		{/if}
	</div>

	<input type="file"
		   field_id="{$id}"
		   field_action="upload_file"
		   field_target="file_field_content_{$id}"
		   listing_id="{if $listing_id}{$listing_id}{else}{$listing.id}{/if}"
		   name="{$id}"
		   id="input_file_{$id}"
		   {if $value.file_name ne null}style="display:none;"{/if} />
{else}
	<div class="input-group input-group__file" id="file_field_content_{$id}">
		<div class="errors"></div>
		{if $value.saved_file_name}
			<a class="form-control" href="?listing_id={$listing.id}&amp;filename={$value.saved_file_name|escape:'url'}&amp;field_id={$id}">{$value.file_name|escape}</a>
		{else}
			<a class="form-control" href="{$value.file_url}" style="pointer-events: none;">{$value.file_name|escape:'html'}</a>
		{/if}

		<input type="file"
			   field_id="{$id}"
			   field_action="upload_file"
			   field_target="file_field_content_{$id}"
			   listing_id="{if $listing_id}{$listing_id}{else}{$listing.id}{/if}"
			   name="{$id}"
			   id="input_file_{$id}" />
		<span class="input-group-btn">
			{if $value.file_name ne null}
				<a href="#" class="btn btn-default btn-change btn-change__replace btn-change__replace-file"><i class="fa fa-exchange" aria-hidden="true"></i>[[Change]]</a>
				<a href="#" class="btn btn-default btn-change btn-change__upload btn-change__replace-file hidden"><i class="fa fa-upload" aria-hidden="true"></i>[[Upload]]</a>
				{if $user_info}
					<a class="delete_file btn btn--danger deletebutton-file"
					   form_token="{$form_token}"
					   listing_id="{if $listing_id}{$listing_id}{else}{$listing.id}{/if}"
					   field_id="{$id}"
					   file_id="{$value.file_id}"
					   data-is-classifieds="{if $is_classifieds}true{else}false{/if}">
						<i class="fa fa-trash-o" aria-hidden="true"></i>[[Remove]]
					</a>
				{else}
					<a class="delete_file btn btn--danger deletebutton-file"
					   form_token="{$form_token}"
					   listing_id="{if $listing_id}{$listing_id}{else}{$listing.id}{/if}"
					   field_id="{$id}"
					   file_id="{$value.file_id}"
					   data-is-classifieds="{if $is_classifieds}true{else}false{/if}">
						<i class="fa fa-trash-o" aria-hidden="true"></i>[[Remove]]
					</a>
				{/if}
			{else}
				<a href="#" class="btn btn-default btn-change btn-change__upload btn-change__replace-file"><i class="fa fa-upload" aria-hidden="true"></i>[[Upload]]</a>
			{/if}
		</span>
	</div>

	{javascript}
		<script type="text/javascript">
			// check temporary uploaded data of field
			$(function() {
				getFileFieldData('{$id}', '{if $listing_id}{$listing_id}{else}{$listing.id}{/if}', '{if $listing.type.id}{$listing.type.id}{/if}', '{$form_token}');
			});
		</script>
	{/javascript}

{/if}