{*{debug}*}
<a href="{$GLOBALS.site_url}{$listing|listing_url}?backPage={$pageForBackButton}&searchID={$searchId}" class="featured-card">
	<div class="featured-info">
		<div class="featured-info__title">{$listing.Title|escape}</div>
		<div class="featured-info__details">
			{$listing.user.CompanyName|escape:'html'}
			{if $listing|location}
				<span class="dot"></span>
				{assign var="location" value=$listing|location}
				{assign var="parts" value=","|explode:$location}
				{assign var="total" value=$parts|@count}
				{if $parts[$total-2]}{$parts[$total-2]},{/if}{if $parts[$total-1]}{$parts[$total-1]}{/if}
			{/if}
		</div>
	</div>
	<span class="featured-btn">Voir Plus</span>
</a>