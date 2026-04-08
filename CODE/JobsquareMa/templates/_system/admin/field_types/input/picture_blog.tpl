<div class="input-group input-group__file">
    <input type="text" value="{$value.file_name}" alt="" />
    <input type="file" name="{$id}"/>
    <span class="input-group-btn">
        {if $value.file_name ne null}
            <a href="#" class="btn btn-default btn-change btn-change__replace"><i class="fa fa-exchange" aria-hidden="true"></i>[[Change]]</a>
            <a href="#" class="btn btn-default btn-change btn-change__upload hidden"><i class="fa fa-upload" aria-hidden="true"></i>[[Upload]]</a>
            <a href="{$GLOBALS.site_url}/blog/?action=delete_image&amp;id={$postId}" class="btn btn--danger"><i class="fa fa-trash-o" aria-hidden="true"></i>[[Remove]]</a>
        {else}
            <a href="#" class="btn btn-default btn-change"><i class="fa fa-upload" aria-hidden="true"></i>[[Upload]]</a>
        {/if}
    </span>
</div>
<img src="{$value.file_url}" alt="" border="0" />