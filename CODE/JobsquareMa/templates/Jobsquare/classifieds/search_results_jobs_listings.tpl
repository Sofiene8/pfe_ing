{assign var='index' value=$listing_search.current_page*$listing_search.listings_per_page-$listing_search.listings_per_page}
{foreach from=$listings item=listing name=listings}
	{if $listing.api}
		{if $smarty.request.page == '1' && $smarty.foreach.listings.first}
			{$listing.code}
		{/if}

		<div class="sj-job-card listing_item__backfilling" id="api-{$smarty.foreach.listings.index}">
			<div class="sj-card-logo" style="font-size:12px; font-weight:700; color:var(--sj-dark);">
				{if $listing.CompanyName}{$listing.CompanyName|escape:'html'|truncate:4:"":true|upper}{/if}
			</div>
			<div class="sj-card-content">
				<div class="sj-card-title">
					<a target="_blank" href="{$listing.url}" {$listing.target} {$listing.onmousedown} {$listing.onclick}>{$listing.Title|escape:'html'}</a>
				</div>
				<div class="sj-card-company">
					{if $listing.CompanyName}
						<span>{$listing.CompanyName|escape:'html'}</span>
					{/if}
					{if $listing|location}
						<span class="sj-sep">&middot;</span>
						{$listing|location}
					{/if}
				</div>
				<div class="sj-card-desc">
					{$listing.JobDescription|strip_tags}
				</div>
				<div class="sj-card-tags">
					{if $listing|location}
						<span class="sj-card-tag sj-loc">{$listing|location}</span>
					{/if}
					{foreach from=$listing.EmploymentType item=list_value name="multifor"}
						{if $smarty.foreach.multifor.first && $list_value}
							<span class="sj-card-tag sj-type">{tr}{$list_value}{/tr}</span>
						{/if}
					{/foreach}
				</div>
			</div>
			<div class="sj-card-right">
				<span class="sj-card-date">
					{$listing.activation_date|date}
				</span>
				<a target="_blank" href="{$listing.url}" {$listing.target} class="sj-card-btn">Voir Plus</a>
			</div>
		</div>
	{else}
		{include file="listing_item.tpl" listing=$listing}
		{if 'banner_inline'|banner}
			{if $listing@index == 9}
				<div class="banner banner--inline">
					{'banner_inline'|banner}
				</div>
			{elseif $listing@index < 10 && $listing@last}
				<div class="banner banner--inline">
					{'banner_inline'|banner}
				</div>
			{/if}
		{/if}
	{/if}
{/foreach}