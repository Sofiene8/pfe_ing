{if $listings}
	<section class="main-sections main-sections__listing__latest listing__latest">
        <h4 class="listing__title">[[Latest Jobs]]</h4>
        <div class="listing-item__list {if 'banner_right_side'|banner}with-banner{/if}">
            {foreach from=$listings item=listing}
                {include file="listing_item.tpl" listing=$listing}
            {/foreach}
        </div>
	</section>
	<div class="view-all text-center">
		<a href="{$GLOBALS.site_url}/jobs/" class="btn view-all__btn btn__white">[[View all jobs]]</a>
	</div>
{/if}
