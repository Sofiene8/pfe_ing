{*{debug}*}
<article id="{$listing.id}" class=" col-md-12 joblist-for-resume-profile {if $listing.featured}listing-item__featured{/if} {if not $listing.user.Logo.file_url}listing-item__no-logo{/if}">
	<div class="">
		<div class="job-details col-md-10 ">
		{if $listing.user.Logo.file_url && ($listing.user.featured == 1 || $listing.featured == 1)}
		<div class="company-logo col-md-4"> <a href="{$GLOBALS.site_url}{$listing|listing_url}?backPage={$pageForBackButton}&searchID={$searchId}"> <img class="img-responsive" src="{$listing.user.Logo.file_url}" alt="{$listing.user.CompanyName|escape:'html'}"> </a> </div>
		{/if} 
		<div class=" col-md-8">
			<div class="job-title"> <a href="{$GLOBALS.site_url}{$listing|listing_url}?backPage={$pageForBackButton}&searchID={$searchId}" >{$listing.Title|escape:'html'|truncate:80}</a> </div>
			<div class="company-name"> 
		<span class="name-c">{$listing.user.CompanyName|escape:'html'|truncate:25}</span>
			{if $listing|location}
		{assign var="location" value=$listing|location}
		{assign var="parts" value=","|explode:$location}
		{assign var="total" value=$parts|@count}

			<span class="job-location">-{if $parts[$total-2]}{$parts[$total-2]},{/if}{if $parts[$total-1]}{$parts[$total-1]}{/if} </span>
			{/if}
				{assign var="myDate" value= $listing.activation_date}
			<div class="post-date"> {if $myDate|timeAgo eq "à l\'instant"}{else}Il'y a {/if}{$myDate|timeAgo}</div>
			</div>
			</div>
			
		</div>
		
		
		<div class=" col-md-2 text-right">
		<a class="btns" href="{$GLOBALS.site_url}{$listing|listing_url}?backPage={$pageForBackButton}&searchID={$searchId}" >
		<i class="fa fa-eye" aria-hidden="true"></i> Détails</a> 
		</div> 
		
		

		</div>
</article>