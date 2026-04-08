{if $listing_type_sid || $listing_field_info.listing_type_sid != 0}
    {breadcrumbs}<a href="{$GLOBALS.site_url}/custom-fields/">[[Custom Fields]]</a> / <a href="{$GLOBALS.site_url}/edit-listing-type/?sid={$listing_type_sid}">[[$listing_type_info.name Fields]]</a> / [[Edit]] {$listing_field_info.caption|escape}{/breadcrumbs}
{/if}
<div class="page-title">
    <h1 class="title">[[Edit]] {$listing_field_info.caption|escape}</h1>

    {if $field_type eq 'complex'}
        <div class="page-title__buttons">
            <a href="{$GLOBALS.site_url}/edit-listing-field/edit-fields/?field_sid={$field_sid}" class="btn btn--primary">[[Edit Fields]]</a>
        </div>
    {/if}
</div>

{include file="errors.tpl" errors=$errors}
<div class="panel panel-default panel--max">
    <form id="fieldData" method="post" action="" class="panel-body form-horizontal">
        <input type="hidden" id="action" name="action" value="apply_info" />
        <input type="hidden" name="sid" value="{$field_sid}" />
        <input type="hidden" name="listing_type_sid" value="{$listing_type_sid}" />
        {foreach from=$form_fields key=field_name item=form_field}
            <div class="form-group" style="{if $form_field.id == 'type' || $form_field.id == 'id' || $form_field.id == 'template'}display: none;{/if}">
                <label class="col-md-2 control-label">
                    {if $form_field.id == 'default_value'}
                        <div id='defaultCaption' style='display: block;'>[[{$form_field.caption}]]</div>
                    {else}
                        [[{$form_field.caption}]]
                    {/if}
                    {if $form_field.is_required}&nbsp;<span class="required">*</span>{/if}
                </label>
                <div class="col-md-7">
                    {if $field_name eq 'choiceLimit'}
                        {input property=$form_field.id}<br />
                        <span data-toggle="tooltip" data-placement="auto left" title="[[Set empty or 0 for unlimited selection]]"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
                    {elseif $field_name == 'display_as' && ($field_type == 'list' || $field_type == 'multilist')}
                        {input property=$form_field.id template="list_empty.tpl"}
                    {else}
                        {if $field_name eq 'height' || $field_name eq 'width'}
                            <div class="numerical-block">
                                {input property=$form_field.id}
                            </div>
                        {else}
                            {input property=$form_field.id}
                        {/if}
                    {/if}
                </div>
            </div>
            {if $form_field.comment}
                <div class="form-group">
                    <div class="col-md-7 col-md-offset-2" style="font-size:12px;" colspan="3">[[{$form_field.comment}]]</div>
                </div>
            {/if}
        {/foreach}
        {if $field_type == 'list' || $field_type == 'multilist'}
            <div class="form-group">
                <div class="col-md-7 col-md-offset-2">
                    {module name="classifieds" function="edit_list" field_sid=$field_sid}
                </div>
            </div>
        {/if}
        <div class="form-group">
            <div class="col-md-7 col-md-offset-2">
                <input type="submit" value="[[Save]]" class="btn btn--primary save-btn"/>
            </div>
        </div>
    </form>
</div>
