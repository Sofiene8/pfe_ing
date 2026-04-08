 
 {if $listingTypeID eq "Resume"|| "Job" ||  "Training" }


{assign var="LocationValues" value=$value}
{foreach from=$form_fields item=form_field}
    {if $form_field.id == "ZipCode" ||$form_field.id == "gouvernorat" ||$form_field.id == "pays" ||$form_field.id == "City"}
	<div class="form-group">
		<label {if $listingTypeID eq "Resume"} class="custom-selectbox__label"{else} class="form-label"{/if}>{tr}{$form_field.caption}{/tr|escape} {if $form_field.is_required}*{/if}</label>
		{if $form_field.type =='list'}
		{input property=$form_field.id parent=$parentID template="list.location.tpl"}
		{elseif $form_field.type =='string'}
		{if $form_field.id == "City"}
		{input property=$form_field.id parent=$parentID template="string_city.location.tpl"}
		{else}
		
		{input property=$form_field.id parent=$parentID template="string.location.tpl"}
		{/if}
		
		{else}
		{if in_array($form_field.type, array('multilist'))}
			<div id="count-available-{$form_field.id}" class="mt-count-available"></div>
		{/if}
		{/if}
	</div>
{elseif $form_field.id == "State" ||$form_field.id == "Country" || $form_field.id == "ville"}

		{input property=$form_field.id parent=$parentID template="hidden.location.tpl"}
		{/if}
		
	{/foreach}
{assign var="parentID" value=false scope=global}	
		
{else}


{assign var="LocationValues" value=$value}
{foreach from=$form_fields item=form_field}
	<div class="form-group {if $form_field.hidden || true}hidden{/if}">
		<label class="form-label">{tr}{$form_field.caption}{/tr|escape} {if $form_field.is_required}*{/if}</label>
		{input property=$form_field.id parent=$parentID template="string.location.tpl"}
		{if in_array($form_field.type, array('multilist'))}
			<div id="count-available-{$form_field.id}" class="mt-count-available"></div>
		{/if}
	</div>
{/foreach}
{assign var="parentID" value=false scope=global}



	{/if}