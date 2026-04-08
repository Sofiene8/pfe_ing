{title}[[Post {$listingType.name}]]{/title}
{breadcrumbs}
	<a href="{$GLOBALS.site_url}/manage-{$listingType.link}/">
		{if $listingType.id == 'Resume'}
			[[Resumes]]
		{else}
			[[{$listingType.name} Postings]]
		{/if}
	</a>
	/ [[Add New {$listingType.name}]]
{/breadcrumbs}
<div class="page-title">
	<h1 class="title">[[Add New {$listingType.name}]]</h1>
</div>

{include file='field_errors.tpl'}

<div class="panel panel-default panel--max">
	<form method="post" enctype="multipart/form-data" action="{$GLOBALS.site_url}/add-listing/" id="addListingForm"
		  class="form-horizontal inputForm panel-body" {if $form_fields.ApplicationSettings}onsubmit="return validateForm('addListingForm');"{/if}>
		<input type="hidden" name="action" value="add" />
		<input type="hidden" name="listing_type_id" value="{$listingType.id}" />
		<input type="hidden" id="listing_id" name="listing_id" value="{$listing_id}" />
		{set_token_field}
		{foreach from=$form_fields item=form_field}
			{if $form_field.id == 'youtube'}
				<div class="form-group">
					<label class="col-md-2 control-label">
						[[{$form_field.caption|escape}]]{if $form_field.is_required} <span class="required">*</span>{/if}
					</label>
					<div class="col-md-7">{input property=$form_field.id}</div>
				</div>
			{elseif ($listingType.id == "Job" || $listing.type.id == "Job") && $form_field.id == 'ApplicationSettings'}
				<div class="form-group">
					<label class="col-md-2 control-label">
						[[{$form_field.caption|escape}]] {if $form_field.is_required}<span class="required">*</span>{/if}
					</label>
					<div class="col-md-7">{input property=$form_field.id template='applicationSettings.tpl'}</div>
				</div>
			{elseif ($listingType.id == "Job" || $listing.type.id == "Job") && $form_field.id == 'expiration_date'}
				<div class="form-group">
					<label class="col-md-2 control-label">
						[[{$form_field.caption|escape}]] {if $form_field.is_required}<span class="required">*</span>{/if}
					</label>
					<div class="col-md-7">
						{input property=$form_field.id template='expiration_date.tpl'}
					</div>
				</div>
			{elseif $form_field.type == 'location'}
				<div class="form-group hidden">
					{input property=$form_field.id}
				</div>
			{elseif $form_field.type == 'complex'}
				<div class="form-group">
					<h3 class="complex-title">
						[[{$form_field.caption}]]
					</h3>
					{input property=$form_field.id}
				</div>
			{else}
				<div class="form-group">
					<label class="col-md-2 control-label">
						[[{$form_field.caption|escape}]] {if $form_field.is_required}<span class="required">*</span>{/if}
					</label>
					<div class="col-md-7">
						{if $form_field.id == 'username'}
							<div class="half">
								{input property=$form_field.id}
							</div>
						{else}
							{input property=$form_field.id}
						{/if}

						{if in_array($form_field.type, array('multilist'))}
							<div id="count-available-{$form_field.id}" class="mt-count-available"></div>
						{/if}
					</div>
				</div>
			{/if}
		{/foreach}
		<div class="form-group">
			<div class="col-md-7 col-md-offset-2">
				<input type="submit" value="[[Save]]" class="btn btn--primary" id="submitAdd"  />
			</div>
		</div>
	</form>
</div>
