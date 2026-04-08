{if $listings}
<div class="similar-job plus_city_listing">
	<div class="col-md-4 city-listing">
	
	<h4>{$location}</h4>
					<ul>
			{if $listings}
				
		
					{foreach from=$listings item=listing}
						<li><a href="{$GLOBALS.site_url}{$listing|listing_url}?backPage={$pageForBackButton}&searchID={$searchId}" class="link">
			{$listing.Title|escape}	</a></li>
						
					{/foreach}
			
				
				
			{/if}
	</ul>
    </div>
		<div class="clear"></div>
					</div>
{/if}
