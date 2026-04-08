<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.js"></script>
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap.min.css">-->
<link rel="stylesheet" href="../system/ext/dist/bootstrap-tagsinput.css">
<link rel="stylesheet" href="../system/ext/dist/app.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="../system/ext/dist/bootstrap-tagsinput.min.js"></script>

<a href="javascript:history.go(-1)" class="btn__back edit-listing-back">[[Back]]</a>
<h1 class="title__primary title__primary-small title__centered title__bordered">[[Edit {$listingTypeID}]]</h1>
{if $errors}
	{foreach from=$errors item="error_data" key="error_id"}
		<div class="alert alert-danger">
			{if $error_id == 'MAX_FILE_SIZE_EXCEEDED'}
				[[File size shouldn't be larger than 5 MB.]]
			{elseif $error_id == 'NOT_OWNER_OF_LISTING'}
				[[You're not the owner of this posting]]
			{elseif $error_id == 'NO_SUCH_FILE'}[[No such file found in the system]]
			{else}
				{$error_id} {$error_data}
			{/if}
		</div>
	{/foreach}
{else}
	{include file='field_errors.tpl'}
<div class="row">
		<div class=" col-xs-12 col-md-3">
	   	<nav class="sidebar mt-20" >
				{if $GLOBALS.current_user.group.id == "Employer"}
					{title}[[Company Profile]]{/title}
					<li class="sidebar__list-item"><a href="{$GLOBALS.site_url}/my-listings/job/">[[Job Postings]]</a></li>
					<li class="sidebar__list-item {if $listingTypeID == 'training'} is-active{/if}"><a href="{$GLOBALS.site_url}/my-listings/training/">[[Training Postings]]</a></li>
	
					{*<li class="sidebar__list-item "> <a href="{$GLOBALS.site_url}/system/applications/view/">[[Applicants]]</a></li>*}
					<li class="sidebar__list-item  is-active"> <a href="{$GLOBALS.site_url}/edit-profile/">Editer Mon Pofil</a></li>
					

							 {if $GLOBALS.current_user.group.id == "Employer"}
						{if $GLOBALS.current_user.featured != 1}
							<li class="sidebar__list-item">
<a href="{$GLOBALS.site_url}/products/?permission=post_job&packs=1" class="btns btn-bleu btn-promouvoir"  style=" display:block"> <i class="fa fa-bullhorn" aria-hidden="true"></i> Promouvoir </a>
					</li>
					{/if}{/if}		
				{else}
					{title}[[Account Settings]]{/title}
					<li class="sidebar__list-item "><a href="{$GLOBALS.site_url}/my-listings/resume/">[[My Resumes]]</a></li>
					<li class="sidebar__list-item "> <a href="{$GLOBALS.site_url}/system/applications/view/">[[My Applications]]</a></li>
					<li class="sidebar__list-item  is-active"> <a href="{$GLOBALS.site_url}/edit-profile/">[[Account Settings]]</a></li>
				{/if}


			</nav>
	</div>
	<form method="post" action="" enctype="multipart/form-data" {if isset($listing.ApplicationSettings)}onsubmit="return validateForm('editListingForm');"{/if} id="editListingForm" class="form col-xs-9 ">
		<input type="hidden" name="action" value="save_info" />
		<input type="hidden" name="listing_id" id="listing_id" value="{$listing.id}" />

		{set_token_field}

        <div class="col-xs-12 col-sm-9 edit-listing--form">
            {foreach from=$pages item=form_fields key=page name=editBlock}
                {include file="input_form_default.tpl"}
            {/foreach}
            <div class="form-group form-group__btns text-center clearfix">
                <input type="submit" value="[[Save]]" class="btn btn__orange btn__bold" />
            </div>
        </div>
        <div class="col-sm-3 col-xs-12 edit-listing--action pull-right">
            <div class="form-group form-group__btns text-center">
                <input type="submit" name="preview_listing" value="[[View {$listingTypeID}]]" class="btn btn__blue btn__bold" id="listingPreview"/>
				{if $original_listing.active|status != 'pending'}
					{if $original_listing.active}
						<a class="btn btn__blue btn__bold" href="{$GLOBALS.site_url}/my-listings/{$listingTypeID|lower}/?action=deactivate&amp;listings[{$original_listing.sid}]=1">
							[[Rendre Cacher]]
						</a>
					{else}
						<a class="btn btn__blue btn__bold" href="{$GLOBALS.site_url}/pay-for-listing/?listing_id={$original_listing.sid}">
							[[Make Visible]]
						</a>
					{/if}
				{/if}
                {if $listingTypeID != 'Resume'}
				
				  
				     <a href="{$GLOBALS.site_url}/clone-{$listingTypeID|lower}/?clisting_id={$original_listing.sid}" class="btn btn__blue btn__bold" >[[dupliquer ]]</a>
				  
				<button type="button" class="btn btn__orange btn__bold btn__delete-listing" data-toggle="modal" data-target="#confirm-delete">[[Delete ]]</button>
              
				  {/if}
                {if $percentage > 89}
					<a class="btn btn__blue btn__bold" href="{$GLOBALS.site_url}/my-resume-details/{$original_listing.sid}/?action=download_pdf_version">
						[[Download PDF]]
					</a>
                {/if}
            </div>
        </div>
		
	</form>
</div>
	<div class="modal fade confirm-delete" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="message-modal-label">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				</div>
				<div class="modal-body">
					<div class="form">
						<div class="form-group text-center">
						{if $listingTypeID == 'training' ||  $listingTypeID == 'Training'}
						[[Votre formation sera supprimée d'une manière definitive . Êtes-vous sûr?]]
						{else}
							[[Your {$listingTypeID|lower} will be removed permanently. Are you sure?]]
							{/if}
						</div>
						<div class="form-group form-group__btns text-center">
							<a href="{$GLOBALS.site_url}/my-listings/{$listingTypeID|lower}/?action=delete&amp;listings[{$original_listing.sid}]=1" class="btn btn__orange btn__bold">
								[[Delete {$listingTypeID}]]
							</a>
							<button type="button" class="btn btn__white" data-dismiss="modal">[[Cancel]]</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
{/if}
{literal}
<style>

#editListingForm.form.col-xs-9 {
    width: min-content;
    max-width: 100%;
    min-width: 75%;
}


.edit-listing--action {

    padding: 0;
}
</style>

{/literal}