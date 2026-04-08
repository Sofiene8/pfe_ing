{breadcrumbs}<a href="{$GLOBALS.site_url}/show-import/">[[Job Auto Import]]</a> / [[Save Data Source]]{/breadcrumbs}
<div class="page-title">
	<h1 class="title">[[External data source]]</h1>
</div>
<p>[[Final step for add parser]].</p>

{if $errors}
	{foreach from=$errors item=error}
		<p class="error">[[{$error}]]</p>
	{/foreach}
	<form method="post" action="{$GLOBALS.site_url}/add-import/">
		<input type="hidden" name="add_level" value="2"/>
		<input type="hidden" name="xml" value="{$xml}"/>
		<input type="hidden" name="parser_name" id="parser_name" value="{$form_name}"/>
		<input type="hidden" name="parser_url" id="parser_url" width="100%" value="{$form_url}"/>
		<input type="hidden" name="parser_user" id="parser_user" value="{$form_user}"/>
		<input type="hidden" name="parser_days" id="parser_days" value="{$form_days}"/>
        <div class="pull-right"><input type="submit" value="[[Back]]" class="btn btn--primary" /></div>
	</form>
{else}	

{/if}