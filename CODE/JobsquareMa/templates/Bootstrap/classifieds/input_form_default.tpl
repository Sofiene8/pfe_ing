{foreach from=$form_fields item=form_field}
	{$form_field=$form_field scope=global}
	{if $form_field.id == 'youtube'}
		<div class="form-group">
			<label class="form-label">[[{$form_field.caption}]] {if $form_field.is_required}*{/if}</label>
			{input property=$form_field.id}
		</div>
	{elseif ($listing_type_id == "Resume" || $listing.type.id == "Resume") && $form_field.id == "anonymous"}
		<div class="form-group">
			<label class="form-label">[[{$form_field.caption}]] {if $form_field.is_required}*{/if}</label>
			{input property=$form_field.id}
		</div>
	{elseif ($listingTypeID == "Job" || $listing.type.id == "Job") && $form_field.id == 'ApplicationSettings'}
		<div class="form-group">
			<label class="form-label">[[{$form_field.caption}]] {if $form_field.is_required}*{/if}</label>
			{input property=$form_field.id template='applicationSettings.tpl'}
		</div>
	{elseif ($listingTypeID == "Job" || $listing.type.id == "Job") && $form_field.id == 'expiration_date'}
		<div class="form-group form-group__half">
			<label class="form-label">[[{$form_field.caption}]] {if $form_field.is_required}*{/if}</label>
			{input property=$form_field.id template='expiration_date.tpl'}
		</div>
	{elseif $form_field.type == 'location'}
		{input property=$form_field.id}
	{elseif $form_field.id == 'EmploymentType'}
		<div class="form-group form-group__half">
			<label class="form-label">[[{$form_field.caption}]] {if $form_field.is_required}*{/if}</label>
			{input property=$form_field.id}
		</div>
	{elseif $form_field.id == 'JobCategory'}
		<div class="form-group form-group__half">
			<label class="form-label">
				[[{$form_field.caption}]]
				{if $form_field.is_required}*{/if}
			</label>
			{input property=$form_field.id}
		</div>
	{elseif $form_field.id == 'access_type' || $form_field.type == 'boolean'}
		<div class="form-group">
			{input property=$form_field.id}
			<label class="form-label inline" for="{$form_field.id}">[[{$form_field.caption}]] {if $form_field.is_required}*{/if}</label>
		</div>
	{elseif $form_field.id == 'Phone' && $GLOBALS.current_user.group.id == 'JobSeeker'}
		<div class="form-group form-group__half">
			<label class="form-label">[[{$form_field.caption}]] {if $form_field.is_required}*{/if}</label>
			{input property=$form_field.id}
		</div>
	{elseif $form_field.id == 'GooglePlace' && $GLOBALS.current_user.group.id == 'JobSeeker'}
		<div class="form-group form-group__half">
			<label class="form-label">[[{$form_field.caption}]] {if $form_field.is_required}*{/if}</label>
			{input property=$form_field.id}
		</div>
	{else}
		<div class="form-group {if $form_field.type == 'complex'}form-group__complex{/if}">
			{if $form_field.type == 'complex'}
				<h3 class="title__secondary">[[{$form_field.caption}]] {if $form_field.is_required}*{/if}</h3>
				{input property=$form_field.id}
			{else}
				<label class="form-label">
					[[{$form_field.caption}]]
					{if $form_field.is_required}*{/if}
				</label>
				{input property=$form_field.id}
			{/if}
		</div>
	{/if}
{/foreach}
