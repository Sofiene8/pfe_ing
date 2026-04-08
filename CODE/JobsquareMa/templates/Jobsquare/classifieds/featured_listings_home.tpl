{if $listings}
	<section class="main-sections listing__featured{if $listing_type eq "Training"}-training{/if}">
		<div class="container container-fluid listing">
			{if $listings}
				<div class="section-header">
					<h2>Offres {if $listing_type eq "Training"}de formation{else}d'emploi{/if} à la une</h2>
				</div>
				<div class="featured-jobs">
					{foreach from=$listings item=listing}
						{include file="listing_item_home.tpl" listing=$listing listing_type_id=$listing_type}
					{/foreach}
				</div>
				{if $isbanner==1}
				<div class="banner banner--right">
				{module name="banners" function="show_banners" group=$group_banner}
				</div>
				{/if}
			{/if}
		</div>
	</section>
	<div class="view-all-new">
		{if $listing_type == 'Training' }
			<a href="{$GLOBALS.site_url}/trainings/">[[View all trainings]]</a>
		{else}
			<a href="{$GLOBALS.site_url}/jobs/">[[View all jobs]]</a>
		{/if}
	</div>
{/if}
