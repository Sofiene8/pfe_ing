<div class="input-group input-group__file">
    <input type="text" value="{$value.file_name}" alt="" />
    <input type="file" name="{$id}"/>
    <span class="input-group-btn">
        {if $value.file_name ne null}
            <a href="#" class="btn btn-default btn-change btn-change__replace"><i class="fa fa-exchange" aria-hidden="true"></i>[[Change]]</a>
            <a href="#" class="btn btn-default btn-change btn-change__upload hidden"><i class="fa fa-upload" aria-hidden="true"></i>[[Upload]]</a>
            {if $user_info}
                <a class="delete_file btn btn--danger"
                   form_token="{$form_token}"
                   listing_id="{if $listing_id}{$listing_id}{else}{$listing.id}{/if}"
                   field_id="{$id}"
                   file_id="{$value.file_id}"
                   data-is-classifieds="{if $is_classifieds}true{else}false{/if}">
                    <i class="fa fa-trash-o" aria-hidden="true"></i>[[Remove]]
                </a>
            {else}
                <a class="delete_file btn btn--danger"
                   form_token="{$form_token}"
                   listing_id="{if $listing_id}{$listing_id}{else}{$listing.id}{/if}"
                   field_id="{$id}"
                   file_id="{$value.file_id}"
                   data-is-classifieds="{if $is_classifieds}true{else}false{/if}">
                    <i class="fa fa-trash-o" aria-hidden="true"></i>[[Remove]]
                </a>
            {/if}
        {else}
            <a href="#" class="btn btn-default btn-change btn-change__upload"><i class="fa fa-upload" aria-hidden="true"></i>[[Upload]]</a>
        {/if}
    </span>
</div>
<div id="file_{$id}">
    <img src="{$value.file_url}" alt="" border="0" />
</div>
