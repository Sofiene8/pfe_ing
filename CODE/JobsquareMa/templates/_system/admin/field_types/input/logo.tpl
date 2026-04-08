{if $GLOBALS.is_ajax || $smarty.get.ajax_submit}
	{foreach from=$errors key=key item=error}
		{if $key === 'NOT_ACCEPTABLE_FILE_FORMAT'}
			<p class="error">[[Not supported file format]]</p>
		{elseif $key === 'UPLOAD_ERR_INI_SIZE'}
			<p class="error">[[File size shouldn't be larger than 5 MB.]]</p>
		{elseif $key === 'NOT_SUPPORTED_IMAGE_FORMAT'}
			<p class="error">[[Not supported file format]]</p>
		{else}
			<p class="error">[[{$key}]]</p>
		{/if}
	{/foreach}
	<div id="logo_field_content_{$id}">
		<div class="input-group input-group__file">
			<input type="text" value="{$value.file_name}" alt="" />

			<input type="file"
				   id="autoloadFileSelect_{$id}"
				   field_id="{$id}"
				   field_action="upload_profile_logo"
				   field_target="logo_field_content_{$id}"
				   class="autouploadField"
				   name="{$id}" />

			<span class="input-group-btn">
				{if $value.file_name ne null}
					<a href="#" class="btn btn-default btn-change btn-change__replace"><i class="fa fa-exchange" aria-hidden="true"></i>[[Change]]</a>
					<a href="#" class="btn btn-default btn-change btn-change__upload hidden"><i class="fa fa-upload" aria-hidden="true"></i>[[Upload]]</a>
					<a  field_id="{$id}"
						file_id="{$value.file_id}"
						user_sid="{$user_info.sid}"
						href="{$GLOBALS.user_site_url}/users/delete-uploaded-file/?field_id={$id}"
						class="delete_profile_logo btn btn--danger">
						<i class="fa fa-trash-o" aria-hidden="true"></i>[[Remove]]
					</a>
				{else}
					<a href="#" class="btn btn-default btn-change"><i class="fa fa-upload" aria-hidden="true"></i>[[Upload]]</a>
				{/if}
			</span>
		</div>
		<div id="profile_logo_{$id}" class="pull-left">
			<img src="{$value.file_url|escape}" alt="" border="0" />
		</div>
	</div>
{else}
	<div id="logo_field_content_{$id}">
		<div class="input-group input-group__file">
			<input type="text" value="{$value.file_name}" alt="" />

			<input type="file"
				   id="autoloadFileSelect_{$id}"
				   field_id="{$id}"
				   field_action="upload_profile_logo"
				   field_target="logo_field_content_{$id}"
				   class="autouploadField"
				   name="{$id}" />

			<span class="input-group-btn">
				{if $value.file_name ne null}
					<a href="#" class="btn btn-default btn-change btn-change__replace"><i class="fa fa-exchange" aria-hidden="true"></i>[[Change]]</a>
					<a href="#" class="btn btn-default btn-change btn-change__upload hidden"><i class="fa fa-upload" aria-hidden="true"></i>[[Upload]]</a>
					<a  field_id="{$id}"
						file_id="{$value.file_id}"
						user_sid="{$user_info.sid}"
						href="{$GLOBALS.user_site_url}/users/delete-uploaded-file/?field_id={$id}"
						class="delete_profile_logo btn btn--danger">
						<i class="fa fa-trash-o" aria-hidden="true"></i>[[Remove]]
					</a>
				{else}
					<a href="#" class="btn btn-default btn-change"><i class="fa fa-upload" aria-hidden="true"></i>[[Upload]]</a>
				{/if}
			</span>
		</div>
		<div id="profile_logo_{$id}" class="pull-left">
			<img src="{$value.file_url|escape}" alt="" border="0" />
		</div>
	</div>
{/if}