{breadcrumbs}
	<a href="{$GLOBALS.site_url}/manage-{$listingType.id|lower}s/?restore=1">
		[[{$listingType.name} Postings]]
	</a>
	/
	[[Import {$listingType.name}s]]
{/breadcrumbs}
<div class="page-title">
	<h1 class="title">[[Import {$listingType.name}s]]</h1>
</div>
{if $imported_listings_count}
	<p class="message">[[$imported_listings_count listings were successfully imported.]]</p>
{/if}
{if !empty($nonExistentUsers)}
	{assign var="notImportedListingsCount" value=$nonExistentUsers|count}
	<p class="error">[[$notImportedListingsCount listings were not imported.]]</p>
	{foreach from=$nonExistentUsers item="username"}
		<p class="error">[[User '$username' not found.]]</p>
	{/foreach}
{/if}
