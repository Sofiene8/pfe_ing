{breadcrumbs}<a href="{$GLOBALS.site_url}/users/?restore=1">[[Users]]</a> / [[Edit User Info]]{/breadcrumbs}
<div class="page-title">
	<h1 class="title">[[Edit User Info]]</h1>
</div>
{foreach from=$errors item=message key=error}
	{if $error eq 'PARAMETERS_MISSED'}
		<p class="error">[[The key parameters are not specified]]</p>
	{elseif $error eq 'WRONG_PARAMETERS_SPECIFIED'}
		<p class="error">[[Wrong parameters specified]]</p>
	{/if}{foreachelse}
	<p>[[File deleted successfully]]</p>
	<a href="{$GLOBALS.site_url}/edit-user/?user_sid={$user_sid}">[[Back to edit profile]]</a>
{/foreach}