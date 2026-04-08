<div class="input-group">
    {capture assign='blog_url'}{$GLOBALS.custom_domain_url}/blog{/capture}
    {if strlen($blog_url) > 25}
        {assign var='blog_url' value=preg_replace('|(.{20}).*(/blog)|', '$1...$2', $blog_url)}
    {/if}
    <span class="input-group-addon hidden-xs" title="{$GLOBALS.custom_domain_url}/blog">{$blog_url}</span>
    <input type="text" value="{$value}" class="inputString {$id}" name="{$id}" id="{$id}" />
</div>
