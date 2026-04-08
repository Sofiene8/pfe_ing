<div class="switchable-buttons">
    <div class="btn-group" data-toggle="buttons">
        {foreach from=$list_values item=list_value}
            <label class="btn btn-default {if $list_value.id == $value || (!$value && $list_value@first)}active{/if}">
                <input type="radio" value="{$list_value.id}" name="{$id}" autocomplete="off" {if $list_value.id == $value || (!$value && $list_value@first)}checked{/if}> {tr}{$list_value.caption}{/tr|escape}
            </label>
        {/foreach}
    </div>
</div>
