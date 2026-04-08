<script language="JavaScript" type="text/javascript" src="{common_js}/pagination.js"></script>
<div class="page-title">
    <h1 class="title">[[Blog Posts]]</h1>
    <div class="page-title__buttons">
        <a href="{$GLOBALS.site_url}/blog/?action=add" class="btn btn--primary">[[Add Blog Post]]</a>
    </div>
</div>
{include file='../classifieds/field_errors.tpl'}
<div class="panel panel-default panel--max clearfix">
    <form method="post" action="{$GLOBALS.site_url}/blog/" name="resultsForm">
        <input type="hidden" name="action" id="action_name" value="">
        <div class="table__pagination table__pagination--header">
            {include file="../pagination/pagination_top.tpl" layout="header"}
        </div>
        <div class="table-responsive">
            <table width="100%" class="table table-striped with-bulk">
                <thead>
                    {include file="../pagination/sort.tpl"}
                </thead>
                <tbody>
                    {foreach from=$posts item=item name=blog_posts}
                        <tr class="{cycle values = 'evenrow,oddrow'}">
                            <td class="text-center" style="width: 46px;">
                                <label class="cr-styled">
                                    <input type="checkbox" name="posts[{$item.sid}]" value="1" id="checkbox_{$smarty.foreach.blog_posts.iteration}">
                                    <i class="fa"></i>
                                </label>
                            </td>
                            <td class="td-wide"><a href="{$GLOBALS.site_url}/blog/?action=edit&id={$item.sid}" title="{$item.title|escape}">{$item.title|escape}</a></td>
                            <td>{$item.date|date}</td>
                            <td>
                                {if $item.active == 1}
                                    <span class="label label--active">[[Active]]</span>
                                {else}
                                    <span class="label label--inactive">[[Not Active]]</span>
                                {/if}
                            </td>
                        </tr>
                    {/foreach}
                </tbody>
            </table>
        </div>
        <div class="table__pagination table__pagination--footer">
            {include file="../pagination/pagination.tpl" layout="footer"}
        </div>
    </form>
</div>

{javascript}
    <script>
        $('.bulk-action').on('click', function() {
            var action = $(this).data('action');
            if (action == 'delete') {
                if (confirm('{$paginationInfo.translatedText.delete}')) {
                    submitForm(action);
                }
            } else {
                submitForm(action);
            }
            return false;
        });
    </script>
{/javascript}