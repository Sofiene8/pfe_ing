<div class="inline-block checkbox-field">
    <input type="hidden" class="{if $complexField}complexField{/if}" name="{if $complexField}{$complexField}[{$id}][{$complexStep}]{else}{$id}{/if}" value="0" />
    <input type="checkbox" class="inline-block {if $complexField}complexField{/if}" name="{if $complexField}{$complexField}[{$id}][{$complexStep}]{else}{$id}{/if}" id="{$id}" {if $value} checked="checked" {elseif (!$listing.id && $id=='email_notify')}checked="checked" {/if} value="1" />
</div>