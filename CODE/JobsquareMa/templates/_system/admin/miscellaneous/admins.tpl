<div class="page-title">
    <h1 class="title">[[Site Admins]]</h1>
    <div class="page-title__buttons">
        <a href="{$GLOBALS.admin_site_url}/admins/?action=new" class="btn btn--primary">[[Add New Admin]]</a>
    </div>
</div>

{module name='flash_messages' function='display'}

<div class="panel panel-default panel--max clearfix">
    <div class="table-responsive">
        <table width="100%" class="table table-striped">
            <thead>
                <tr>
                    <th>[[Name]]</th>
                    <th>[[Email]]</th>
                    <th>[[Permissions]]</th>
                    <th>[[Status]]</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                {foreach from=$admins item="admin"}
                    <tr>
                        <td><a href="{$GLOBALS.admin_site_url}/admins/?action=edit&amp;sid={$admin.sid}">{$admin.name|escape}</a></td>
                        <td><a href="{$GLOBALS.admin_site_url}/admins/?action=edit&amp;sid={$admin.sid}">{$admin.email|escape}</a></td>
                        <td>
                            {if $admin.owner}
                                [[Owner]]
                            {else}
                                {$admin.permissions_type}
                            {/if}
                        </td>
                        <td><span class="label {if $admin.status == 'Active'}label--active{elseif $admin.status == 'Pending'}label--pending{else}label--inactive{/if}">{$admin.status}</span></td>
                        <td>
                            {if !$admin.owner}
                                <a href="{$GLOBALS.admin_site_url}/admins/?action=delete&amp;sid={$admin.sid}" title="[[Delete]]" onclick="return confirm('[[Are you sure you want to delete this site admin?]]');">
                                    <i class="ion-close-circled"></i>
                                </a>
                            {/if}
                        </td>
                    </tr>
                {/foreach}
            </tbody>
        </table>
    </div>
</div>
