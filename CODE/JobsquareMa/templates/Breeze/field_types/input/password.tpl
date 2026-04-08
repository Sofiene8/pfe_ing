<div class="form-group">
    <label class="form-label" for="{$id}[original]">[[Password]] {if $form_fields.password.is_required}*{/if}</label>
    <input type="password" name="{$id}[original]" class="form-control" />
</div>
<div class="form-group">
    <label class="form-label" for="{$id}[confirmed]">[[Confirm Password]] {if $form_fields.password.is_required}*{/if}</label>
    <input type="password" name="{$id}[confirmed]" class="form-control" />
</div>