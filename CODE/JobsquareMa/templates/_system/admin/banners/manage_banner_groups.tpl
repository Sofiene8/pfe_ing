{breadcrumbs}[[Banners]]{/breadcrumbs}
<div class="page-title">
    <h1 class="title">[[Banners Groups]]</h1>
  
</div>

{foreach from=$errors item=error}
	[[{$error}]]
{/foreach} 
<p><a href="{$GLOBALS.site_url}/add-banner-group/" class="btn btn--primary">[[Add a new group]]</a></p>
<div class="panel panel-default panel--wide panel__custom-fields">
<table>
	<thead>
		<tr>
			<th>[[Group ID]]</th>
			<th colspan="3" class="actions">[[Actions]]</th>
		</tr>
	</thead>
	{foreach from=$bannerGroups item=group}
		<tr class="{cycle values = 'evenrow,oddrow'}">
			<td><a href="{$GLOBALS.site_url}/edit-banner-group/?groupSID={$group.sid|escape}" title="[[Edit]]">{$group.id}</a></td>
			<td><a href="{$GLOBALS.site_url}/edit-banner-group/?groupSID={$group.sid|escape}" title="[[Edit]]" class="btn btn-default">[[Edit]]</a></td>
			<td>&nbsp;</td>
			<td>
				{capture name="delete_confirm_script"} return confirm('[[Do you want to delete]] \'{$group.id|escape:"javascript"}\' [[banner group]]? \n ([[All banners in group will be deleted]])') {/capture}
				<a href="?action=delete_banner_group&amp;groupSID={$group.sid|escape}" onclick="{$smarty.capture.delete_confirm_script|escape:"html"}" title="[[Delete]]" class="btn btn--danger">[[Delete]]</a>
			</td>
		</tr>
	{/foreach}
</table>
</div>