<input type="hidden" class="" name="{$id}" value="0" />
<label class="cr-styled">
    <input type="checkbox" class="" name="{$id}" id="{$id}" {if $value}checked="checked" {/if} value="1" />
    <i class="fa"></i>
</label>
{if $comment}
    <br><span class="small">[[{$comment}]]</span>
{/if}