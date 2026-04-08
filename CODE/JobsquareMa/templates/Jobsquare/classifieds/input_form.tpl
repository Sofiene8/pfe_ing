{title}[[Post a {$listingTypeID|escape}]]{/title}
{if $nextPage || $prevPage}
	<div class="bread-crumb">
		{foreach from=$pages item=page name=page_block}
			<div class="input-form-bc">{if $page.sid == $pageSID}<b>&gt;&nbsp;[[{$page.page_name}]]</b>{else}{if $page.order <= $currentPage.order}<a href="{$GLOBALS.site_url}/add-listing/{$listingTypeID|escape}/{$page.page_id}/{$listingSID}">&gt;&nbsp;[[{$page.page_name}]]</a>{else}&gt;&nbsp;[[{$page.page_name}]]{/if}{/if}{if !$smarty.foreach.page_block.last}{/if}&nbsp;</div>
		{/foreach}
	</div>
{/if}

{if $listingTypeID == 'job' || $listingTypeID == 'Job'}
	<h1 class="title__primary title__primary-small title__centered title__bordered">[[Post a Job]]</h1>
{else}
{if $listingTypeID == 'training' ||  $listingTypeID == 'Training'}
	<h1 class="title__primary title__primary-small title__centered title__bordered">[[Post a training]]</h1>
{else}
    {if $redirectBackToJobID}
		<p class="alert alert-success">[[Pour pouvoir postuler, veuillez mettre à jour votre CV Jobsquare. Vous devez avoir au minimum un CV complet à 90%.]]</p>
    {/if}
	<h1 class="title__primary title__primary-small title__centered title__bordered">[[Create New Resume]]</h1>

{/if}
{/if}

<div>[[{$currentPage.description}]]</div>

{include file='field_errors.tpl'}
<form method="post" action="{$GLOBALS.site_url}/add-listing/{$listingTypeID|escape}/{$currentPage.page_id}/{$listingSID}"
	  enctype="multipart/form-data" {if $form_fields.ApplicationSettings}onsubmit="return validateForm('add-listing-form');"{/if}
	  id="add-listing-form" class="form">
	<input type="hidden" name="productSID" value="{$productSID|escape}">
	<input type="hidden" name="contract_id" value="{$contract_id}" />
	<input type="hidden" name="listing_type_id" value="{$listingTypeID|escape}" />
	<input type="hidden" id="listing_id" name="listing_id" value="{$listing_id}" />
	{if ($contract_id eq 0)}<input type="hidden" name="proceed_to_posting" value="done" />{/if}
	{set_token_field}
	<div class="row">
		{include file="input_form_default.tpl"}

		<div class="form-group form-group__btns text-center">
			<input type="hidden" name="action_add" id="hidden_action_add" value=""/>
			<input type="submit" name="preview_listing" value="[[Preview]]" class="btn btn__orange btn__bold" id="listingPreview"/>
		</div>
	</div>
</form>