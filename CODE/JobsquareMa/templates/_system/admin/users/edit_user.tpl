<form id="login" name="login" target="_blank" action="{if $GLOBALS.settings.force_custom_domain}{$GLOBALS.custom_domain_url}{else}{$GLOBALS.user_site_url}{/if}/login/" method="post">
	<input type="hidden" name="action" value="login" />
	<input type="hidden" name="as_user" />
	<input type="hidden" name="username" value="{$user_info.username|escape}" />
	<input type="hidden" name="session" value="{session_id()|escape}" />
</form>

{breadcrumbs}
	<a href="{$GLOBALS.site_url}/manage-users/{$user_group_info.id|lower}/?restore=1">
		[[{$user_group_info.name} Profiles]]
	</a>
	/
	[[Edit {$user_group_info.name}]]
{/breadcrumbs}
<div class="page-title">
	<h1 class="title">[[Edit {$user_group_info.name}]]</h1>
	<div class="page-title__buttons">
		<button type="button" name="button" value="[[Login]]" class="btn--bordered login-as">
			[[Login]]
		</button>
		{if $user_group_info.id == 'Employer'}
			<a href="{$GLOBALS.site_url}/manage-jobs/?company_name[like]={$user_info.username|escape:'url'}" class="btn btn--primary">[[View Jobs]]</a>
		{else}
			<a href="{$GLOBALS.site_url}/manage-resumes/?company_name[like]={$user_info.username|escape:'url'}" class="btn btn--primary">[[View Resumes]]</a>
		{/if}
		<a href="{$GLOBALS.site_url}/user-products/?user_sid={$user_info.sid}" class="btn btn--primary">[[{$user_group_info.name} Products]]</a>
	</div>
</div>

<div class="form-group clearfix">

</div>
{include file='field_errors.tpl'}
<div class="panel panel-default panel--max">
	<form method="post" enctype="multipart/form-data" class="panel-body form-horizontal">
		{set_token_field}
		<input type="hidden" id="action_name" name="action_name" value="apply_info" />
		{foreach from=$form_fields item=form_field}
			<div class="form-group" {if $form_field.id == 'Location'}style="display: none;"{/if}>
				<label class="col-md-2 control-label">[[{$form_field.caption|escape}]]{if $form_field.is_required}&nbsp;<span class="required">*</span>{/if}</label>
				<div class="col-md-7">
					{input property=$form_field.id}
					{if in_array($form_field.type, array('multilist'))}
						<div id="count-available-{$form_field.id}" class="mt-count-available"></div>
					{/if}
				</div>
			</div>
		{/foreach}
		<div class="form-group">
			<label class="col-md-2 control-label">IP</label>
			<div class="col-md-7"><label style="padding-top: 7px;">{$user_info.ip}</label></div>
		</div>
		<div class="form-group">
			<div class="col-md-7 col-md-offset-2">
				<input type="hidden" name="user_sid" value="{$user_info.sid}" />
				<input type="submit" value="[[Save]]" class="btn btn--primary" />
			</div>
		</div>
	</form>
</div>

{javascript}
	<script>
		$('.login-as').on('click', function() {
			$('#login').submit();
		});
	</script>
{/javascript}