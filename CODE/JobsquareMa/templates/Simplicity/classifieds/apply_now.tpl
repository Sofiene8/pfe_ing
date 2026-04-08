<div>
	{if $requires_redirect}
		<div class="form">
			<div class="form-group text-center">
				[[You're about to be taken to another website to complete your application.]]
			</div>
			<div class="form-group form-group__btns text-center">
				<a target="_blank" href="{$GLOBALS.site_url}/system/classifieds/application_redirect/?listing_id={$listing_id}" class="btn btn__orange btn__bold application-redirect">
					[[Continue]]
				</a>
				<button type="button" class="btn btn__white" data-dismiss="modal">[[Cancel]]</button>
			</div>
		</div>
	{elseif $is_applied}
		<p class="alert alert-danger">[[You already applied to this job]]</p>
	{else}
		{if $is_data_submitted && !$errors}
			<p class="alert alert-success">[[Thank you! Your application has been sent.]]</p>
		{else}
			{foreach from=$errors key=error_code item=error_message}
				<p class="alert alert-danger">
					{if $error_code === 'APPLY_INPUT_ERROR' || $error_code === 'APPLY_ERROR'}
						[[Resume file is required]]
					{else}
						[[{$error_message}]]
					{/if}
					{break}
				</p>
			{/foreach}
			<form method="post" enctype="multipart/form-data" action="{$GLOBALS.site_url}/apply-now/" id="apply-form" class="form">
				<input type="hidden" name="is_data_submitted" value="1">
				<input type="hidden" name="listing_id" value="{$listing_id|escape}">
				{if $resumes|@count == 1}
					<input type="hidden" class="hidden hidden-resume" name="id_resume" value="{$resumes[0].id|escape}"/>
				{/if}
				<div class="form-group text-center">
					<label class="form-label">[[Your name]]</label>
					<input type="text" name="name" value="{if $request.name}{$request.name|escape}{else}{$GLOBALS.current_user.FullName|escape}{/if}" class="form-control">
				</div>
				<div class="form-group text-center">
					<label class="form-label">[[Your email]]</label>
					<input type="email" name="email" value="{if $request.email}{$request.email|escape}{else}{$GLOBALS.current_user.username|escape}{/if}" class="form-control">
				</div>
				{if $GLOBALS.current_user.logged_in && $resumes|@count > 0 && $GLOBALS.current_user.group.id == 'JobSeeker'}
					<div class="form-group">
						<label class="form-label">[[Select your resume]]</label>
						<select class="form-control" name="id_resume">
							<option value="0">[[Select your resume]]</option>
							{foreach from=$resumes item=resume key=i}
								<option {if $resume.id == $request.id_resume}selected="selected"{elseif $i == 0}selected="selected"{/if} value="{$resume.id}">{$resume.Title}</option>
							{/foreach}
						</select>
					</div>
				{else}
					<div class="form-group">
						<label class="form-label">[[Upload your resume]]</label>
						<input type="file" name="file_tmp" class="form-control"/>
					</div>
					{if $topresume}
						<div class="form-group">
							<div class="inline-block checkbox-field">
								<input type="hidden" class="" name="topresume" value="0">
								<input type="checkbox" class="inline-block " name="topresume" id="topresume" value="1" {if $smarty.request.topresume}checked="checked"{/if}>
							</div>
							<label class="form-label inline" for="topresume">[[FREE resume evaluation by a professional resume expert from TopResume]]</label>
						</div>
					{/if}
				{/if}
				<div class="form-group">
					<label class="form-label">[[Cover letter]]</label>
					<textarea class="form-control" name="comments" rows="5">{$request.comments|escape}</textarea>
				</div>
				<div class="form-group text-center">
					<input class="btn__submit-modal btn btn__orange btn__bold" type="submit" value="[[Send application]]" onclick="return applySubmit();"/>
				</div>
			</form>
		{/if}
	{/if}
</div>
<script type="text/javascript">
	function applySubmit() {
		var options = {
			target: '.modal-body',
			url:  $('#apply-form').attr('action'),
		};
		$('#apply-form').ajaxSubmit(options);
		return false;
	}
	$('.application-redirect').click(function() {
		$('#apply-modal').modal('hide');
	});
</script>
