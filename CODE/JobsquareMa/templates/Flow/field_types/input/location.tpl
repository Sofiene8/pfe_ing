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