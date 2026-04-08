{if $value.file_url}
	{if $listing.id && $value.saved_file_name}
		<a href="?filename={$value.saved_file_name|escape:'url'}&amp;listing_id={$listing.id|escape:'url'}" style="word-break: break-all;">{$value.file_name|escape}</a>
	{else}
		<a href="{$value.file_url|escape:'url'}" style="word-break: break-all;">{$value.file_name|escape}</a>
	{/if}
{/if}
