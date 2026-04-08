{breadcrumbs}<a href="{$GLOBALS.site_url}/show-import/">[[Job Auto Import]]</a> / [[Result Execute Data Source]]{/breadcrumbs}
<div class="page-title">
	<h1 class="title">[[External data source]]</h1>
</div>

<div class="panel panel-default panel--wide">
	<div class="panel-body">
		<p>[[Result job from import]].</p>

		{if count($errors) > 0}
			{foreach from=$errors item=error}
				<p class="error">[[{$error}]]</p>
			{/foreach}
		{else}
			<p>[[Import completed]].</p>
			{foreach from=$result.errors item=error}
				<p class="error">[[Error]]: [[Backend!]][[{$error}]]</p>
			{/foreach}
		{/if}
	</div>
</div>