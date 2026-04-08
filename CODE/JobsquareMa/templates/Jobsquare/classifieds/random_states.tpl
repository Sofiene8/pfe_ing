{if $states}
	{foreach from=$states item=state}
	<div class="browse-jobs col-lg-3 col-xs-6 animation"> <a class="img webp" href="{if $state.url}{$state.url}{else}states/{$state.name}/{/if}" style="background-image: url({$GLOBALS.site_url}/files/states/{$state.picture});">
				<div class="category-title"> <span>{$state.name} </span> </div>
				</a> </div>
			
			
	{/foreach}
{/if}

