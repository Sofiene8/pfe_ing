<h3 class="change-password">[[Password Recovery]]</h3>
{include file='../users/field_errors.tpl'}
{foreach from=$form_fields item=form_field}
    <div class="form-group">
        <label>[[{$form_field.caption}]]{if $form_field.is_required}&nbsp;<span class="required">*</span>{/if}</label>
        {input property=$form_field.id template="recovery-password.tpl"}
    </div>
{/foreach}
<input type="submit" value="[[Reset My Password]]" class="btn btn--primary"/>