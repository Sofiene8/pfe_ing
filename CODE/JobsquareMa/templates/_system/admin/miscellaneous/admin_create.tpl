<h3 class="text-center">[[Create admin account for $GLOBALS.settings.site_title]]</h3>
<br>
{include file='../users/field_errors.tpl'}
<input type="hidden" name="save" value="true" />
{foreach from=$form_fields item=form_field}
    <div class="form-group">
        <label>[[{$form_field.caption}]]{if $form_field.is_required}&nbsp;<span class="required">*</span>{/if}</label>
        {input property=$form_field.id}
    </div>
{/foreach}
<input type="submit" value="[[Create Account]]" id="loginButton" class="btn btn--primary"/>
