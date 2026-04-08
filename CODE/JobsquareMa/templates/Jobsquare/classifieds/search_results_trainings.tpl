{assign var="site_name" value=$GLOBALS.settings.site_title}
{title}[[Annonces et offres de formations en Maroc]]{/title}
{description}[[Annonces et offres de formations en Maroc : Jobsquare vous propose toutes les formations professionnelles et continues en Maroc]]{/description}
{keywords}[[Annonces formations Maroc, bureau de formation en Maroc, cabinet de formation Maroc, cabinets de formation Maroc,  Formation Maroc, offres de formation Maroc, faculté privé Maroc, enseignement superieur, cours, diplômes ]]{/keywords}


{capture name=search}
	{module name='classifieds' function='search_form' form_template='quick_search_trainings.tpl' listing_type_id='Training' browse_request_data=$browse_request_data searchId=$searchId}
{/capture}

{if $GLOBALS.user_page_uri == '/company/'}
	{assign var='refineSearch' value=false}
{/if}
{if $ERRORS}
	{include file="error.tpl"}
{else}
	{if $is_company_profile_page}
		{include file="search_results_profile.tpl"}
	{else}
		<div class="search-header {if !$user_page_uri}hidden-xs-480{/if}"></div>
		<div class="quick-search__inner-pages {if !$user_page_uri}hidden-xs-480{/if}">
			{$smarty.capture.search}
		</div>
		<div class=" container container-training">
		
		 	<div class="bannersearchtop" >{module name="banners" function="show_banners" group="search_training_left"}</div>
			<div class="details-body details-body__search {if $refineSearch}row{else}no-refine-search{/if}{if 'banner_right_side'|banner} with-banner{/if}">
				{if $smarty.request.not_found}
					<div class="col-xs-12">
						<div class="alert alert-info text-center">
							[[Désolé, cette formation n'est plus disponible. Voici quelques résultats qui peuvent être similaires à la formation que vous recherchiez.]]
						</div>
					</div>
				{/if}
				<div class="search-results__top clearfix">
					{assign var="trainings_number" value=$listing_search.listings_number}
					{if $user_page_uri}
						{foreach from=$browse_navigation_elements item=element name="nav_elements"}
							<h1 class="search-results__title {if $user_page_uri}browse-by__title {else}col-sm-offset-3 col-xs-offset-0{/if}">
								{if $user_page_uri == '/categories/'}
									{assign var="category_name" value=$element.caption|escape}
									[[$trainings_number $category_name trainings]]
								{else}
									{assign var="location" value=$element.caption|escape}
									[[$trainings_number trainings found in $location]]
								{/if}
							</h1>
						{/foreach}
					{else}
						<h1 class="search-results__title {if $user_page_uri}browse-by__title {else}col-sm-offset-3 col-xs-offset-0{/if}">
							[[$trainings_number trainings found]]
						</h1>
					{/if}
					{if $listing_type_id != ''}
							<a class="job-alert alert-training pull-right"
						   data-toggle="modal"
						   data-target="#apply-modal"
						   data-href='{$GLOBALS.site_url}/guest-alerts/create/?searchId={$searchId}'
						   data-title='[[Créer une alerte de formation]]'>
							<span class="fa fa fa-bell-o">&nbsp;</span> M’avertir dès qu’une formation similaire est publié	<!-- [[Email me trainings like this]] -->
						</a>
					{/if}
				</div>
				{if $refineSearch}<div class="quick-search__inner-pages visible-xs-480">
								{$smarty.capture.search}
							</div><br />
					<div id="ajax-refine-search" class="col-sm-3 col-xs-12 refine-search">
						<a class="toggle--refine-search visible-xs" role="button" data-toggle="collapse" href="#" aria-expanded="true">
							[[Refine Search]] [[{$refineField.caption}]]
						</a>
						<div class="refine-search__wrapper loading">
							
							{include file="search_results_refine_block.tpl"}
						</div>
						
					</div>
				{/if}
				<div class="search-results {if $refineSearch}col-xs-12 col-sm-9{/if}{if $user_page_uri} search-results__small{/if}">
					{if $listings}
					       <div class="pagination-top">
				         {include file="Bottom_Navigation_Bar.tpl"}
						 </div>
						{include file="search_results_trainings_listings.tpl"}
						<button type="button" class="load-more btn btn__white" data-page="2" >
							[[Load more]]
						</button>
							 <div class="pagination-bottom">
					    {include file="Bottom_Navigation_Bar.tpl"}
						 </div>
					{else}
						<div class="alert alert-danger no-listings-found hidden">
							[[Sorry, we don't currently have any jobs for this search. Please try another search.]]
						</div>
						{*<button type="button" class="load-more btn btn__white" data-page="2" data-backfilling="{if count($listings) < $listing_search.listings_per_page && $GLOBALS.user_page_uri ne '/company/'}true{else}false{/if}" data-backfilling-page="1">*}
							{*[[Load more]]*}
						</button>
					{/if}
				</div>
			</div>
			{if 'banner_right_side'|banner}
				<div class="banner banner--right banner--search">
					{'banner_right_side'|banner}
				</div>
			{/if}
		</div>
	{/if}
{/if}

{*{if $GLOBALS.user_page_uri == '/trainings/' || $browse_request_data}*}
	{*{javascript}*}
		{*<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={$GLOBALS.settings.google_api_key}&libraries=places&callback=initService&language={$GLOBALS.current_language}" async defer></script>*}
	{*{/javascript}*}
{*{/if}*}

{if $GLOBALS.user_page_uri == '/trainings/' && $listings|count > 10}}
    {javascript}
		<script>
            $.get('?searchId={$searchId}&action=search&featured=1', function(data) {
                var listings = $(data).find('.listing-item').slice(0,3);
                if (listings.length) {
                    $('.listing-item').first().before(listings);
                }
            });
		</script>
    {/javascript}
{/if}
{javascript}
	<script>
		var listingPerPage = {$listing_search.listings_per_page};
		var listingNumber = '{$trainings_number}';
		$(document).ready(function() {
			// refine search
			var ajaxUrl = "{$GLOBALS.site_url}/ajax/";
			var ajaxParams = {
				'action': 'get_refine_search_block',
				'listing_type[equal]': 'Training',
				'searchId': '{$searchId}',
				'showRefineFields': {$listing_search.listings_number} > 0
			};

			$.get(ajaxUrl, ajaxParams, function (data) {
				if (data.length > 0) {
					$('.current-search').remove();
					$('#ajax-refine-search').find('.refine-search__wrapper .refine-search__block').remove();
					$('#ajax-refine-search').find('.refine-search__wrapper').append(data);
					$('.refine-search__wrapper').removeClass('loading');

					$('.refine-search__item-radius.active').removeClass('active');
					var miles = $('.form-group__input input[type="hidden"]').val();
					$('#refine-block-radius .dropdown-toggle').text(miles + ' [[{$GLOBALS.settings.radius_search_unit}]]');
				}
			});

			if (listingNumber != '' && listingNumber < listingPerPage) {
				$('.load-more').trigger('click');
			}
		});


		$('.load-more').click(function() {
			var self = $(this);
			self.addClass('loading');
			if (self.data('backfilling')) {
				var page = self.data('backfilling-page');
				self.data('backfilling-page', parseInt(page) + 1);

				// request to listings providers
				var ajaxUrl = "{$GLOBALS.site_url}/ajax/";
				var ajaxParams = {
					'action' : 'request_for_listings',
					'searchId' : '{$searchId}',
					'page' : page
				};

				$.get(ajaxUrl, ajaxParams, function(data) {
					if (data.length > 0) {
						$('.no-listings-found').hide();
					} else {
						self.prop('disabled', true);
						$('.no-listings-found').removeClass('hidden');
					}
					self.before(data);
					if ($('.listing_item__backfilling').length < listingPerPage) {
						self.hide();
					}
					self.removeClass('loading');
				});
				return;
			}

			$.get('?searchId={$searchId}&action=search&page=' + self.data('page'), function(data) {
				var listings = $(data).find('.listing-item');
				self.removeClass('loading');
				if (listings.length) {
					$('.listing-item').last().after(listings);
					self.data('page', parseInt(self.data('page')) + 1);
				}
				if (listings.length !== listingPerPage) {
					if ('{$GLOBALS.user_page_uri ne '/company/'}') {
//						self.data('backfilling', true);
						$('.load-more').click();
					} else {
						self.hide();
					}
				}
			});
		});
	</script>
{/javascript}