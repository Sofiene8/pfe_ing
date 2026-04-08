<h1 class="title__primary title__centered">[[Create {$user_group_info.name} Profile]]</h1>
{module name="social" function="social_plugins"}
<div class="form-group notes text-center">
	{if $user_group_info.id == 'JobSeeker'}
		[[I already have a Job Seeker account.]]
	{else}
		[[I already have an Employer account.]]
	{/if}
	<a class="link" href="{$GLOBALS.user_site_url}/login/{if $smarty.request.return_url}?return_url={$smarty.request.return_url|escape:'url'}{/if}">[[Sign me in]]</a>
</div>
{include file="field_errors.tpl"}
<form class="form" method="post" action="" enctype="multipart/form-data" id="registr-form">
	<input type="hidden" name="action" value="register" />
	<input type="hidden" name="return_url" value="{$smarty.request.return_url|escape}" />
	{set_token_field}
	{foreach from=$form_fields item=form_field}
		{if $form_field.type == 'password' && $user_group_info.id == 'JobSeeker'}
			{input property=$form_field.id}
		{elseif $form_field.id == 'Location'}
		{elseif ($form_field.id == 'username' || $form_field.id == 'FullName' || $form_field.id == 'CompanyName'
			|| $form_field.id == 'WebSite' || $form_field.id == 'Phone' || $form_field.id == 'GooglePlace') && $user_group_info.id == 'Employer'}
			<div class="form-group form-group__half {$form_field.id|lower}">
				<label class="form-label">[[$form_field.caption]] {if $form_field.is_required}*{/if}</label>
				{input property=$form_field.id}
			</div>
		{elseif $form_field.id == 'password' && $user_group_info.id == 'Employer'}
			{input property=$form_field.id template="password_in_row.tpl"}
		{elseif $form_field.type == 'boolean'}
			<div class="form-group {$form_field.id|lower}">
				{input property=$form_field.id}
				<label class="form-label inline" for="{$form_field.id}">[[{$form_field.caption}]] {if $form_field.is_required}*{/if}</label>
			</div>
		{else}
			<div class="form-group {$form_field.id|lower}">
				<label class="form-label">[[$form_field.caption]] {if $form_field.is_required}*{/if}</label>
				{input property=$form_field.id}
			</div>
		{/if}
	{/foreach}
	<div class="form-group">
		<label class="form-label hidden-xs-480"></label>
		<div class="form--move-left">
            <div class="inline-block checkbox-field">
                <input type="checkbox" name="terms" checked="checked" id="terms" />
            </div>
			<span>
				<a class="link" target="_blank" href="{$GLOBALS.site_url}/terms-of-use/">[[I agree to the terms of use]] *</a>
			</span>
		</div>
	</div>
	<div class="form-group form-group__btns text-center">
		<input type="hidden" name="user_group_id" value="{$user_group_info.id}" />
		<input type="submit" class="btn btn__orange btn__bold" value="[[Register]]" />
	</div>
</form>
{javascript}
	<script type="text/javascript" language="JavaScript">
		function checkField( obj, name ) {
			if (obj.val() != "") {
				var options = {
					data: { isajaxrequest: 'true', type: name },
					success: showResponse
				};
				$("#registr-form").ajaxSubmit( options );
			}
			function showResponse(responseText, statusText, xhr, $form) {
				var mes = "";
				switch(responseText) {
					case 'NOT_VALID_EMAIL_FORMAT':
						obj.closest('.form-group').find('.form-label').addClass('form-label__error').text('[[Please enter valid email address]]');
						break;
					case 'NOT_UNIQUE_VALUE':
						obj.closest('.form-group').find('.form-label').addClass('form-label__error').text('[[This email address is already in use.]]');
						break;
					case '1':
						mes = "";
						if (name == 'username') {
							obj.closest('.form-group').find('.form-label').removeClass('form-label__error').text('Email {if $form_fields["username"].is_required}*{/if}');
						}
						else {
							obj.closest('.form-group').find('.form-label').removeClass('form-label__error').text(name + ' {if $form_fields[name].is_required}*{/if}');
						}
						break;
				}
				$("#am_" + name).text(mes);
			}
		};
	</script>
{/javascript}
