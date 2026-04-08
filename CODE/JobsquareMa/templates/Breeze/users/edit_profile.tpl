{include file='field_errors.tpl'}
{if $action eq "delete_profile" && !$errors}
	<p class="alert alert-success">[[You have successfully deleted your profile!]]</p>
{else}
	{capture name="trCancel"}[[Cancel]]{/capture}
	{capture name="trDeleteProfile"}[[Delete profile]]{/capture}
    <h1 class="my-account-title title__primary title__centered">[[My Account]]</h1>
	<div class="my-account-list">
		<ul class="nav nav-pills">
			{if $GLOBALS.current_user.group.id == "Employer"}
				{title}[[Company Profile]]{/title}
				<li class="presentation"><a href="{$GLOBALS.site_url}/my-listings/job/">[[Job Postings]]</a></li>
				<li class="presentation"> <a href="{$GLOBALS.site_url}/system/applications/view/">[[Applicants]]</a></li>
				<li class="presentation active"> <a href="{$GLOBALS.site_url}/edit-profile/">[[Company Profile]]</a></li>
			{else}
				{title}[[Account Settings]]{/title}
				<li class="presentation"><a href="{$GLOBALS.site_url}/my-listings/resume/">[[My Resumes]]</a></li>
				<li class="presentation"> <a href="{$GLOBALS.site_url}/system/applications/view/">[[My Applications]]</a></li>
				<li class="presentation active"> <a href="{$GLOBALS.site_url}/edit-profile/">[[Account Settings]]</a></li>
			{/if}
		</ul>
	</div>

	{if $form_is_submitted && !$errors}
		<p class="alert alert-success">[[You have successfully changed your profile info!]]</p>
	{/if}
    <div id="delete-profile" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h3 class="modal-title">[[Are you sure you want to delete your profile?]]</h3>
				</div>
				<div class="modal-body">
					<form action="" method="post" id="reason-to-unregister-form" class="form">
						<input type="hidden" name="command" value="unregister-user" />
						<div class="form-group text-center">
							[[Your profile will be deleted permanently.]]
						</div>
						<div class="form-group form-group__btns text-center">
							<button type="submit" class="btn btn__orange btn__bold">
								{$smarty.capture.trDeleteProfile|escape:"quotes"}
							</button>
							<button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn__white">
								[[Cancel]]
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<form method="post" action="" enctype="multipart/form-data" class="form edit-profile">
		<input type="hidden" name="action" value="save_info"/>
		{set_token_field}
		{foreach from=$form_fields item=form_field}
			{if $form_field.type == 'password' && $GLOBALS.current_user.group.id == 'JobSeeker'}
				{input property=$form_field.id}
			{elseif $form_field.id == 'Location'}
			{elseif ($form_field.id == 'username' || $form_field.id == 'FullName' || $form_field.id == 'CompanyName'
			|| $form_field.id == 'WebSite' || $form_field.id == 'Phone' || $form_field.id == 'GooglePlace') && $GLOBALS.current_user.group.id == 'Employer'}
				<div class="form-group form-group__half {$form_field.id|lower}">
					<label class="form-label">[[$form_field.caption]] {if $form_field.is_required}*{/if}</label>
					{input property=$form_field.id}
				</div>
			{elseif $form_field.id == 'password' && $GLOBALS.current_user.group.id == 'Employer'}
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
		<div class="form-group form-group__btns text-center">
			<button type="submit" class="btn btn__orange btn__bold">
				[[Save]]
			</button>
			<button type="button"
				   data-toggle="modal"
				   data-target="#delete-profile"
				   class="btn btn__orange btn__bold">
				{$smarty.capture.trDeleteProfile|escape:"quotes"}
			</button>
		</div>
	</form>
{/if}

{javascript}
	<script>
		$(document).ready(function() {
			var offset = $('.nav-pills li').last().offset();
			$('.nav-pills').scrollLeft(offset.left);
		});
	</script>
{/javascript}