{*{debug}*}
<a href="{$GLOBALS.site_url}{$listing|listing_url}?backPage={$pageForBackButton}&searchID={$searchId}" class="job-card{if $listing.featured || $listing.user.featured} job-card--featured{/if}">
	{assign var="now" value=$smarty.now}
	{assign var="activation" value=$listing.activation_date|strtotime}
	{if ($now - $activation) < 86400}
		<span class="badge-new">NEW</span>
	{/if}
	<div class="job-card__title">{$listing.Title|escape|strip_tags|truncate:40:"..."}</div>
	<div class="job-card__company">
		{$listing.user.CompanyName|escape|strip_tags|truncate:25:"..."}
		{if $listing|location}
			<span class="dot"></span>
			{$listing|location}
		{/if}
	</div>
	<div class="job-card__meta">
		{if $listing|location}
			<span class="job-card__tag job-card__tag--location">{$listing|location}</span>
		{/if}
		{foreach from=$listing.EmploymentType item=list_value name="multifor"}
			{if $smarty.foreach.multifor.first && $list_value}
				<span class="job-card__tag job-card__tag--type">{tr}{$list_value}{/tr}</span>
			{/if}
		{/foreach}
		<span class="job-card__tag job-card__tag--date">{$listing.activation_date|date}</span>
	</div>
</a>
