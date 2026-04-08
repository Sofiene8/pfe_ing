{if $listings}
<div class=" content-card offres-sponsorise">
	<section class="listing__featured{if $listing_type eq "Training"}-training{/if}">
		
			{if $listings}
				<h2 class="card-title">
					Offres {if $listing_type eq "Training"}de formation{else}d'emploi{/if} similaires sponsoris&eacute;es
			</h2>
				<div class="listing-item__list  {if $isbanner==1}with-banner{/if}">
					{foreach from=$listings item=listing}
						{include file="listing_item_sponsorise.tpl" listing=$listing listing_type_id=$listing_type}
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
	
	</section>
		<div class="clear"></div>
	</div>

{/if}

