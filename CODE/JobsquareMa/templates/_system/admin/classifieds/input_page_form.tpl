<script type="text/javascript">
    $(function() {
        var action = '{$action}';
        if (action == 'new') {
            $('#save').val('[[Add]]');
        }
    });
</script>

{breadcrumbs}<a href="{$GLOBALS.site_url}/custom-fields/">[[Custom Fields]]</a> / [[Edit $listingTypeInfo.name Fields]]{/breadcrumbs}

<div class="errors">
    {foreach from=$errors item=error key=field_caption}
        {if $error eq 'EMPTY_VALUE'}
          {assign var="field_caption" value=$field_caption|tr}
            <p class="error">[[Please enter '$field_caption']]</p>
        {elseif $error eq 'NOT_UNIQUE_VALUE'}
            <p class="error">'{$field_caption}' [[this value is already used in the system]]</p>
        {elseif $error eq 'NOT_FLOAT_VALUE'}
            <p class="error">'{$field_caption}' [[is not a float value]]</p>
        {elseif $error eq 'NOT_VALID_ID_VALUE'}
            <p class="error">[[Please enter valid]] [[{$field_caption}]]</p>
        {elseif $error eq 'CAN_NOT_EQUAL_NULL'}
            <p class="error">'{$field_caption}' [[can not equal "0"]]</p>
        {/if}
    {/foreach}
</div>

{if $action == 'edit'}
    <div class="page-title page-title--wide">
        <h1 class="title">[[Edit {$pageInfo.page_name} Fields]]</h1>
        <div class="page-title__buttons">
            <a href="{$GLOBALS.site_url}/add-listing-type-field/?listing_type_sid={$listingTypeInfo.sid}" class="btn btn--primary">[[Add New $listingTypeInfo.name Field]]</a>
        </div>
    </div>
    <div class="panel panel-default panel--wide">
        <form method="post" action="" name="fields_items_form" id="fields_items_form" class="panel-body">
            <input type="hidden" name="field_action" value="save_order" />
            <input type="hidden" name="page_sid" value="{$pageSID}" />
            <div class="table-responsive">
                <table id="fields_table" class="table table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>[[Caption]]</th>
                            <th>[[Type]]</th>
                            <th>[[Required]]</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        {foreach from=$fieldsOnPage item=fieldOnPage name=fieldList}
                            {if $fieldOnPage.id != 'Location'}
                                <tr>
                                    <td class="sortable-handle">...</td>
                                    <td>
                                        <a href="{$GLOBALS.site_url}/edit-listing-type-field/?sid={$fieldOnPage.sid}&amp;listing_type_sid={$listingTypeInfo.sid}" title="[[{$fieldOnPage.caption|escape}]]">[[{$fieldOnPage.caption|escape}]]</a>
                                        <input type="hidden" name="item_order[{$fieldOnPage.sid}]" value="1">
                                    </td>
                                    <td>
                                        [[{$fieldOnPage.typeCaption}]]
                                    </td>
                                    <td>
                                        {if $fieldOnPage.is_required}[[Yes]]{else}[[No]]{/if}
                                    </td>
                                    <td  align="center" valign="top">
                                        {if not $fieldOnPage.is_reserved}
                                            <a href="{$GLOBALS.site_url}/delete-listing-type-field/?sid={$fieldOnPage.sid}" onclick='return confirm("[[Remove the field?]]")' title="[[Remove]]">
                                                <i class="ion-close-circled"></i>
                                            </a>
                                        {/if}
                                    </td>
                                </tr>
                            {/if}
                        {/foreach}
                    </tbody>
                </table>
            </div>
        </form>
    </div>
	<script>
        $(function() {
            $('tbody').sortable({
                helper: function(e, ui) {
                    ui.children().each(function() {
                        $(this).width($(this).width());
                    });
                    return ui;
                },
                handle: '.sortable-handle',
                update: function() {
                    $('#fields_items_form').ajaxSubmit({
                        error: function() {
                            $('.errors').empty();
                            $('.errors').append('<div class="alert alert-danger">[[Oops... Something went wrong. Please try again!]]</div>');
                        },
                        success: function() {
                            $('.errors').empty();
                        }
                    });
                }
            });
        });
	</script>
{/if}