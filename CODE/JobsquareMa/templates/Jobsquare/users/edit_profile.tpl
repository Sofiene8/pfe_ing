<script src="https://use.fontawesome.com/7e203bcaaf.js"></script>
{include file='field_errors.tpl'}
{if $action eq "delete_profile" && !$errors}
	<p class="alert alert-success">[[You have successfully deleted your profile!]]</p>
{else}
	{capture name="trCancel"}[[Cancel]]{/capture}
	{capture name="trDeleteProfile"}[[Delete profile]]{/capture}
	

	<div class="container container--small mb-50">
		<div class="col-xs-12 col-md-3" >
	   		<nav class="sidebar mt-20" >
				{if $GLOBALS.current_user.group.id == "Employer"}
					{title}[[Company Profile]]{/title}
					<li class="sidebar__list-item"><a href="{$GLOBALS.site_url}/my-listings/job/">[[Job Postings]]</a></li>
					<li class="sidebar__list-item {if $listingTypeID == 'training'} is-active{/if}"><a href="{$GLOBALS.site_url}/my-listings/training/">[[Training Postings]]</a></li>
	
					{*<li class="sidebar__list-item "> <a href="{$GLOBALS.site_url}/system/applications/view/">[[Applicants]]</a></li>*}
					<li class="sidebar__list-item  is-active"> <a href="{$GLOBALS.site_url}/edit-profile/">Editer Mon Pofil</a></li>
					
				{else}
					{title}[[Account Settings]]{/title}
					<li class="sidebar__list-item "><a href="{$GLOBALS.site_url}/my-listings/resume/">[[My Resumes]]</a></li>
					<li class="sidebar__list-item "> <a href="{$GLOBALS.site_url}/system/applications/view/">[[My Applications]]</a></li>
					<li class="sidebar__list-item  is-active"> <a href="{$GLOBALS.site_url}/edit-profile/">[[Account Settings]]</a></li>
				{/if}
			</nav>
			
		</div>
		
	

		
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
		<div class="col-xs-9">
				{if $form_is_submitted && !$errors}
					<p class="alert alert-success">[[You have successfully changed your profile info!]]</p>
				{/if}
			</div>
		<form method="post" action="" enctype="multipart/form-data" class="form edit-profile col-xs-9 ">
			<input type="hidden" name="action" value="save_info"/>
			{set_token_field}
			{foreach from=$form_fields item=form_field}
    {if $form_field.type == 'password' && $GLOBALS.current_user.group.id == 'JobSeeker'}
        {input property=$form_field.id}
    {elseif $form_field.id == 'Location'||$form_field.id == 'PrivateSpace'||$form_field.id == 'CounterCvAccess'}
    {* Skip these fields *}
    {elseif $form_field.id == 'CompanyDescription'}
		{if $GLOBALS.current_user.featured == 1}
            <div class="form-group {$form_field.id|lower}">
                <label class="form-label">[[$form_field.caption]] {if $form_field.is_required}*{/if}</label>
                {input property=$form_field.id}
            </div>
        {/if}
    {* Skip Company Description field *}
    {elseif ($form_field.id == 'username' || $form_field.id == 'FullName' || $form_field.id == 'CompanyName'
    || $form_field.id == 'WebSite' || $form_field.id == 'Phone' || $form_field.id == 'GooglePlace') && $GLOBALS.current_user.group.id == 'Employer'}
        <div class="form-group form-group__half {$form_field.id|lower}">
            <label class="form-label">[[$form_field.caption]] {if $form_field.is_required}*{/if}</label>
            {input property=$form_field.id}
        </div>
    {elseif $form_field.id == 'password' && $GLOBALS.current_user.group.id == 'Employer'}
        {input property=$form_field.id template="password_in_row.tpl"}
    {elseif $form_field.caption == 'rne' || $form_field.caption == 'checked' || $form_field.caption == 'patente'}
    {* Skip these fields *}
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
			<div class="form-group form-group__btns text-center" style="display:flex; gap: 15px; align-items:center; justify-content:flex-end">
    <a data-toggle="modal"
       data-target="#delete-profile"
       class="btn btn-danger-custom" href="#">
        {$smarty.capture.trDeleteProfile|escape:"quotes"}
    </a>
    <button type="submit" class="btn btn-validate">
        Valider
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
{literal}
<style>
.form .form-label {
    color: #166bd9;
    font-weight: 500;
}
#editListingForm.form {
    /* width: 100%; */
    /* max-width: 100%; */
}
/* Bouton Danger (Supprimer) */
.btn-danger-custom {
    background-color: #f8f9fa; /* Gris clair */
    border: 2px solid #dc3545; /* Bordure rouge */
    color: #dc3545; /* Texte rouge */
    padding: 8px 20px;
    border-radius: 6px;
    font-weight: 600;
    text-decoration: none;
    display: inline-block;
    transition: all 0.3s ease;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.btn-danger-custom:hover {
    background-color: #dc3545; /* Rouge au survol */
    color: white;
    border-color: #c82333;
    box-shadow: 0 4px 8px rgba(220, 53, 69, 0.2);
    text-decoration: none;
}

/* Bouton Valider en bleu */
.btn-validate {
    background-color: #2bade7; /* Bleu comme demandé */
    border: 2px solid #2bade7;
    color: white;
    padding: 8px 25px;
    border-radius: 6px;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 2px 4px rgba(43, 173, 231, 0.2);
}

.btn-validate:hover {
    background-color: #1a9bcf; /* Bleu plus foncé au survol */
    border-color: #1a9bcf;
    box-shadow: 0 4px 8px rgba(43, 173, 231, 0.3);
    color: white;
}

.btn-validate:active {
    background-color: #1588b8;
    border-color: #1588b8;
    transform: translateY(1px);
}

/* État focus pour accessibilité */
.btn-danger-custom:focus,
.btn-validate:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(43, 173, 231, 0.25);
}

.btn-danger-custom:focus {
    box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.25);
}
</style>

{/literal}