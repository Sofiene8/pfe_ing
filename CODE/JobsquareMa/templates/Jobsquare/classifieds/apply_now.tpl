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
            [[Le CV est obligatoire]]
        {elseif $error_code === 'PHONE_REQUIRED'}
            [[Le numéro de téléphone est obligatoire]]
        {elseif $error_code === 'EMAIL_INVALID'}
            [[Veuillez saisir une adresse e-mail valide]]
        {elseif $error_code === 'NOT_SUPPORTED_FILE_FORMAT'}
            [[Format de fichier non pris en charge]]
        {elseif $error_code === 'FILE_SIZE'}
            [[La taille du fichier ne doit pas dépasser 5 Mo]]
        {elseif $error_code === 'APPLY_APPLIED_ERROR'}
            [[Vous avez déjà postulé à cette offre]]
        {else}
            [[{$error_message}]]
        {/if}
    </p>
    {break}
{/foreach}

<form method="post" enctype="multipart/form-data" action="{$GLOBALS.site_url}/apply-now/" id="apply-form" class="form">
    <input type="hidden" name="is_data_submitted" value="1">
    <input type="hidden" name="listing_id" value="{$listing_id|escape}">

    {if $resumes|@count == 1}
        <input type="hidden" class="hidden hidden-resume" name="id_resume" value="{$resumes[0].id|escape}"/>
    {/if}

    <div class="form-group text-center">
        <label class="form-label">[[Votre nom]]</label>
        <input type="text" name="name" value="{if $request.name}{$request.name|escape}{else}{$GLOBALS.current_user.FullName|escape}{/if}" class="form-control">
    </div>

    <div class="form-group text-center">
        <label class="form-label">[[Votre e-mail]]</label>
        <input type="email" name="email" value="{if $request.email}{$request.email|escape}{else}{$GLOBALS.current_user.username|escape}{/if}" class="form-control">
    </div>

    <div class="form-group text-center">
        <label class="form-label">[[Numéro de téléphone]]</label>
        <input type="tel"
               name="phone"
               required
               value="{if $request.phone}{$request.phone|escape}{elseif $default_phone}{$default_phone|escape}{/if}"
               class="form-control"
               placeholder="ex. 55555555">
    </div>

    {* --- Toggles de mise à jour du profil --- *}
    {if $GLOBALS.current_user.logged_in}
        {if !$has_profile_phone}
            {* Profil sans téléphone -> proposer d’enregistrer (coché par défaut) *}
            <div class="form-group">
                <input type="hidden" name="update_profile_phone" value="0">
                <label class="inline-block">
                    <input type="checkbox" name="update_profile_phone" value="1" checked="checked">
                    [[Enregistrer ce numéro dans mon profil]]
                </label>
            </div>
        {else}
            {* Profil avec téléphone -> NE PAS modifier par défaut *}
            <div class="form-group">
                <input type="hidden" name="keep_profile_phone" value="0">
                <label class="inline-block">
                    <input type="checkbox" name="keep_profile_phone" value="1" checked="checked">
                    [[Ne pas modifier mon numéro de profil]]
                </label>
            </div>
        {/if}
    {/if}

    {if $GLOBALS.current_user.logged_in && $resumes|@count > 0 && $GLOBALS.current_user.group.id == 'JobSeeker'}
        <div class="form-group">
            <label class="form-label">[[Sélectionnez votre CV]]</label>
            <select class="form-control" name="id_resume">
                <option value="0">[[Sélectionnez votre CV]]</option>
                {foreach from=$resumes item=resume key=i}
                    <option {if $resume.id == $request.id_resume}selected="selected"{elseif $i == 0}selected="selected"{/if} value="{$resume.id}">{$resume.Title}</option>
                {/foreach}
            </select>
        </div>
        <div class="form-group">
            <label class="form-label">[[Téléversez votre CV]]</label>
            <input type="file" name="file_tmp" class="form-control"/>
        </div>
    {else}
        <div class="form-group">
            <label class="form-label">[[Téléversez votre CV]]</label>
            <input type="file" name="file_tmp" class="form-control"/>
        </div>
        {if $topresume}
            <div class="form-group">
                <div class="inline-block checkbox-field">
                    <input type="hidden" name="topresume" value="0">
                    <input type="checkbox" class="inline-block" name="topresume" id="topresume" value="1" {if $smarty.request.topresume}checked="checked"{/if}>
                </div>
                {if $GLOBALS.settings.topresume_audience == 'international'}
                    {assign var='job_board_audience' value='CVNow'}
                {else}
                    {assign var='job_board_audience' value='TopResume'}
                {/if}
                <label class="form-label inline" for="topresume">[[Évaluation GRATUITE du CV par un expert $job_board_audience]]</label>
            </div>
        {/if}
    {/if}

    <div class="form-group">
        <label class="form-label">[[Lettre de motivation]]</label>
        <textarea class="form-control" name="comments" rows="5">{$request.comments|escape}</textarea>
    </div>

    <div class="form-group text-center">
        <input class="btn__submit-modal btn btn__orange btn__bold" type="submit" value="[[Envoyer la candidature]]" onclick="return applySubmit();"/>
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
