{breadcrumbs}[[Refine Search Settings]]{/breadcrumbs}
<div class="page-title">
    <h1 class="title">[[Refine Search Settings]]</h1>
</div>

<form method="post" action="" class="form-inline" style="margin-bottom: 25px;">
	<input type="hidden" name="action" value="save_setting" />
	<div class="form-group with-tooltip">
        [[Items Limit]]:
        <div class="input-group m-t-10">
            <input type="text" name="refine_search_items_limit" value="{$refine_search_items_limit|escape}" />
            <span class="input-group-btn">
                <input type="submit" value="[[Save]]" class="btn btn--secondary"/>
            </span>
        </div>
        <span class="tooltip__refine-search" data-toggle="tooltip" data-placement="auto left" title="[[Specify the limit for the number of items to be displayed in Refine Search blocks]]"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
    </div>
</form>

<div class="errors">
</div>

{foreach from=$listingTypes item=listingType}
    <div class="panel panel-default panel--wide">
        <form method="post" action="" class="panel-heading panel-heading__refine-search">
            <input type="hidden" name="action" value="save_setting" />
            <input type="hidden" name="listing_type_id" value="{$listingType.id}" />
            <input type="hidden" name="turn_on_refine_search_{$listingType.id}" value="0">
            <h3 class="panel-title inline-block refine-search__title">[[{$listingType.id} Search]]</h3>
            <label class="cr-styled">
                <input type="checkbox" name="turn_on_refine_search_{$listingType.id}"  value="1" {if $listingType.setting}checked{/if} onchange='form.submit();' />
                <i class="fa"></i>
                [[Enable Refine Search]]
            </label>
        </form>
        <form method="post" action="" class="refine-block {if !$listingType.setting}hidden{/if}">
            <div class="panel-body {if !$listingType.setting}hidden{/if}">
                <div class="table-responsive">
                    <table class="table table-striped table__refine-search">
                        {foreach from=$listingType.saved_fields item=saved_fields name=items_block}
                            <tr>
                                <td class="sortable-handle">...</td>
                                <td width="100%">
                                    [[{$saved_fields.caption|escape}]]
                                    <input type="hidden" name="refine_fields[]" value="{$saved_fields.id}" />
                                </td>
                                <td nowrap="nowrap"><a href="?field_id={$saved_fields.id}&action=delete" onclick='return confirm("[[Are you sure you want to delete this field?]]")' title="[[Delete]]"><i class="ion-close-circled"></i></a></td>
                            </tr>
                        {/foreach}
                    </table>
                </div>
            </div>
            <input type="hidden" name="action" value="save" />
            <input type="hidden" name="listing_type_sid" value="{$listingType.sid}" />
            <input type="hidden" name="field_id" />
            <div class="btn-group dropdown">
                <button type="button" class="btn btn-success">[[Add]]</button>
                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="caret"></i></button>
                <ul class="dropdown-menu" role="menu">
                    {foreach from=$listingType.fields item=fields}
                        <li><a href="#" data-value="{$fields.sid}">[[{$fields.caption|escape}]]</a></li>
                    {/foreach}
                    {if $listingType.user_fields.id}
                        <li><a href="#" data-value="user_{$listingType.user_fields.sid}">{$listingType.user_fields.caption}</a></li>
                    {/if}
                </ul>
            </div>
        </form>
    </div>
    <br/>
{/foreach}

{javascript}
    <script type="text/javascript">
        $('.refine-block .dropdown-menu a').on('click', function() {
            $('input[name="field_id"]').val($(this).data('value'));
            $(this).closest('.refine-block').submit();
        });
        $(document).ready(function() {
            $('tbody').sortable({
                helper: function(e, ui) {
                    ui.width(ui.width());
                    return ui;
                },
                handle: '.sortable-handle',
                update: function() {
                    $(this).closest('.refine-block').ajaxSubmit({
                        data: {
                            action: 'reorder'
                        },
                        success: function() {
                            $('.errors').empty();
                        },
                        error: function() {
                            $('.errors').empty();
                            $('.errors').append('<div class="alert alert-danger">[[Oops... Something went wrong. Please try again!]]</div>');
                        }
                    });
                }
            });

            $('.sortable-handle').disableSelection();
        });
    </script>
{/javascript}