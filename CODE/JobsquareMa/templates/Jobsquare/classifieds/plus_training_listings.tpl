{if $listings}
<div class=" content-card training-block">
	<h2 class="card-title">Offres de formation en Maroc </h2>
	<div class="listing-trainings">
		<ul>
			{if $listings}
			
			
			{foreach from=$listings item=listing}
			<li><a href="{$GLOBALS.site_url}{$listing|listing_url}?backPage={$pageForBackButton}&searchID={$searchId}" class="link"> {$listing.Title|escape} </a></li>
			{/foreach}
			
			
			
			{/if}
		</ul>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
</div>
{/if} 