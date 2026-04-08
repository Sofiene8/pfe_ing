{if $listings}
<div class="similar-job plus_category_listing">
	<div class="col-md-4 categoy-listing">
		<h4>{$category}</h4>
		<ul>
			{if $listings}
			
			
			{foreach from=$listings item=listing}
			<li><a href="{$GLOBALS.site_url}{$listing|listing_url}?backPage={$pageForBackButton}&searchID={$searchId}" class="link"> - {$listing.Title|escape} </a></li>
			{/foreach}
			
			
			
			{/if}
		</ul>
	</div>
	<div class="clear"></div>
</div>
{/if} 