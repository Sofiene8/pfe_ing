{breadcrumbs}
    <a href="{$GLOBALS.site_url}/manage-users/{$userGroup.id|lower}/">
        [[{$userGroup.name} Profiles]]
    </a>
    /
    [[Import {$userGroup.name}s]]
{/breadcrumbs}
<div class="page-title">
    <h1 class="title">[[Import {$userGroup.name}s]]</h1>
</div>
{include file='import_users_errors.tpl'}
<p class="message">{$imported_users_count} [[users were successfully imported]]</p>