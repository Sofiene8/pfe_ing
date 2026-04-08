{if $listings}
<div class="offres-sponsorises">
	<section class="listing__featured">
		
			
				<h2 class="offres-profil" id="offres">	Offres d'emploi qui correspondent le mieux à mon profil	</h2>
				<div class="listing-item__list  {if $isbanner==1}with-banner{/if}">
					{foreach from=$listings item=listing}
						{include file="listing_user_item.tpl" listing=$listing listing_type_id=$listing_type}
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
				
			
	</section>
	
		<div class="clear"></div>
	</div>

{/if}

