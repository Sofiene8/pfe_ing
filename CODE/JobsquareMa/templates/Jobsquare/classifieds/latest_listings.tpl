{if $listings}
	<section class="main-sections main-sections__listing__latest listing__latest{if $listing_type eq "Training"}-training{/if}">
		<div class="container container-fluid listing">
			<div class="section-header">
				<h2>Dernières Offres {if $listing_type eq "Training"}de formation{else}d'emploi{/if}</h2>
				<a href="{$GLOBALS.site_url}/{if $listing_type eq 'Training'}trainings{else}jobs{/if}/">Voir tout →</a>
			</div>
			<div class="jobs-grid">
				{foreach from=$listings item=listing}
					{include file="listing_item_home_recent.tpl" listing=$listing listing_type_id=$listing_type}
				{/foreach}
			</div>
		</div>
	</section>
{/if}
