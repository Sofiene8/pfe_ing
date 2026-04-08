<label class="cr-styled" onclick="return false;">
    <input type="hidden" class="" name="{$id}" value="0" />
    <input type="checkbox" class="" name="{$id}" id="{$id}" {if $value}checked="checked" {/if} value="1" onchange="return false;" />
    <i class="fa"></i>
</label>
{if $comment}
    <br><span class="small">[[{$comment}]]</span>
{/if}