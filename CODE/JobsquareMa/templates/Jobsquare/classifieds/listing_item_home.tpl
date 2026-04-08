{*{debug}*}
<a href="{$GLOBALS.site_url}{$listing|listing_url}?backPage={$pageForBackButton}&searchID={$searchId}" class="featured-card">
	<div class="featured-info">
		<div class="featured-info__title">{$listing.Title|escape}</div>
		<div class="featured-info__details">
			{$listing.user.CompanyName|escape:'html'}
			{if $listing|location}
				<span class="dot"></span>
				{$listing|location}
			{/if}
		</div>
	</div>
	<span class="featured-btn">{tr}Voir Plus{/tr}</span>
</a>
