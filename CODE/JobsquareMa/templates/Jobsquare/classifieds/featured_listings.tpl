{if $listings}
	<section class="main-sections listing__featured{if $listing_type eq "Training"}-training{/if}">
		<div class="container container-fluid listing">
			{if $listings}
				<h4 class="listing__title {if $isbanner==1}with-banner{/if}">
					Offres {if $listing_type eq "Training"}de formation{else}d'emploi{/if} à la une
				</h4>
				<div class="line"></div>
				<div class="listing-item__list {if $isbanner==1}with-banner{/if}">
					{foreach from=$listings item=listing}
						{include file="listing_item.tpl" listing=$listing listing_type_id=$listing_type}
					{/foreach}
				</div>
				{* {if 'banner_right_side'|banner}
					<div class="banner banner--right">
						{'banner_right_side'|banner}
					</div>
				{/if}
				*}
				{if $isbanner==1}
				<div class="banner banner--right">
				{module name="banners" function="show_banners" group=$group_banner}
				</div>
				{/if}
			{/if}
		</div>
	</section>
{/if}

