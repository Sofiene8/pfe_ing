<div class="page-row hidden-print">
	{if $GLOBALS.settings.google_TrackingID}
	<script async src="https://www.googletagmanager.com/gtag/js?id={$GLOBALS.settings.google_TrackingID}"></script>
	<script>
{literal}
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());
		gtag('config', '{/literal}{$GLOBALS.settings.google_TrackingID}{literal}');
{/literal}
	</script>
	{/if}
</div>