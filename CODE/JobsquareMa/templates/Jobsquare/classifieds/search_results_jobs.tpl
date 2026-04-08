<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<link href="{$GLOBALS.site_url}/templates/Jobsquare/assets/style/search-jobs.css" rel="stylesheet">
<script>document.body.classList.add('sj-page');</script>
{assign var="site_name" value=$GLOBALS.settings.site_title}

	         {if $user_page_uri}
			        {if $user_page_uri == '/jobs/'}
			                  {title}[[$jobs_number Offres d'emploi et travail en Maroc]]{/title}
							  {description}[[À la recherche d'un travail en Maroc ou à l'international? Jobsquare met à votre disposition des offres et annonces d'emploi mis à jour régulièrement]]{/description}
								{keywords}[[agence emploi, annonces, bureau emploi, emploi à Tunis, intérim, emploi international,job, Offres emploi Maroc, recrutement]]{/keywords}


				      {else}

    				             {if $user_page_uri == '/categories/'}
								{assign var="category_name" value=$element.caption|escape}
								{title}	[[$jobs_number Offres d'emploi $category_name Maroc]]{/title}
								{description}[[À la recherche d'un travail $category_name en Maroc ou à l'international? Jobsquare met à votre disposition des offres et annonces d'emploi $category_name mis à jour régulièrement]]{/description}
								{keywords}[[annonces emploi $category_name Maroc, cherche emploi $category_name en Maroc, emploi intérim en $category_name Maroc, emploi  $category_name international Maroc, job Maroc, recrutement $category_name Maroc, Travail $category_name]]{/keywords}

								{else}

									{assign var="location" value=$element.caption|escape}
									{title}[[$jobs_number Offres d'emploi à $location]]{/title}
									{description}[[À la recherche d'un travail à $location ou à l'international? Jobsquare met à votre disposition des offres et annonces d'emploi à à $location  mis à jour régulièrement, travail à $location]]{/description}
									{keywords}[[annonces emploi à $location, bureau emploi à $location, cherche emploi à $location, emploi à $location offre, emploi intérim à $location, emploi international à $location, emploi offre à $location, Recherche d'emploi à $location, Offres emploi à $location, recrutement à $location ]]{/keywords}

								{/if}

	                {/if}
				 {else}
					  {title}[[$jobs_number Offres d'emploi et travail en Maroc]]{/title}
							  {description}[[À la recherche d'un travail en Maroc ou à l'international? Jobsquare met à votre disposition des offres et annonces d'emploi mis à jour régulièrement]]{/description}
								{keywords}[[agence emploi, annonces, bureau emploi, emploi à Tunis, intérim, emploi international,job, Offres emploi Maroc, recrutement]]{/keywords}
               {/if}
{capture name=search}
	{module name='classifieds' function='search_form' form_template='quick_search.tpl' listing_type_id='Job' browse_request_data=$browse_request_data searchId=$searchId}
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
		<div class="sj-results-area">
		<div class="container">

			{assign var="jobs_number" value=$listing_search.listings_number}

			{* ============ NEW DESIGN: RESULTS HEADER ============ *}
			<div class="sj-results-header">
				<h1>
					{if $user_page_uri}
						{if $user_page_uri == '/categories/'}
							{foreach from=$browse_navigation_elements item=element name="nav_elements"}
								{assign var="category_name" value=$element.caption|escape}
								<span>{$jobs_number}</span> [[Offres d'emploi $category_name Maroc]]
							{/foreach}
						{elseif $user_page_uri == '/jobs/'}
							<span>{$jobs_number}</span> annonces trouv&eacute;es
						{else}
							{foreach from=$browse_navigation_elements item=element name="nav_elements"}
								{assign var="location" value=$element.caption|escape}
								<span>{$jobs_number}</span> [[Offres d'emploi &agrave; $location]]
							{/foreach}
						{/if}
					{else}
						<span>{$jobs_number}</span> annonces trouv&eacute;es
					{/if}
				</h1>
				<div class="sj-sort">
					Trier par :
					<select id="sj-sort-select">
						<option value="recent">Plus r&eacute;centes</option>
						<option value="relevant">Pertinence</option>
					</select>
					{if $listing_type_id != ''}
						<a class="sj-job-alert"
						   data-toggle="modal"
						   data-target="#apply-modal"
						   data-href='{$GLOBALS.site_url}/guest-alerts/create/?searchId={$searchId}'
						   data-title='[[Create Job Alert]]'>
							<span class="fa fa-bell-o"></span> Cr&eacute;er une alerte
						</a>
					{/if}
				</div>
			</div>

			{* ============ ACTIVE FILTERS ============ *}
			{if !empty($currentSearch)}
				<div class="sj-active-filters">
					{foreach from=$currentSearch item="fieldInfo" key="fieldID"}
						{foreach from=$fieldInfo.field item="fieldValue" key="fieldType"}
							{foreach from=$fieldValue item="val" key="realVal"}
								{if $val != "0"}
									<div class="sj-active-filter">
										{tr}{$val}{/tr|escape}
										<a class="sj-remove" href="?searchId={$searchId|escape:'url'}&amp;action=undo&amp;param={$fieldID}&amp;type={$fieldType}&amp;value={$realVal|escape:'url'}">&times;</a>
									</div>
								{/if}
							{/foreach}
						{/foreach}
					{/foreach}
					<a class="sj-clear-all" href="{$GLOBALS.site_url}/jobs/">Effacer tout</a>
				</div>
			{/if}

			{if $smarty.request.not_found}
				<div class="alert alert-info text-center" style="border-radius:12px; margin-bottom:20px;">
					[[Sorry, that job is no longer available. Here are some results that may be similar to the job you were looking for.]]
				</div>
			{/if}

			{* ============ MAIN GRID LAYOUT ============ *}
			<div class="sj-search-layout{if !$refineSearch} sj-no-sidebar{/if}">

				{* ============ SIDEBAR FILTERS ============ *}
				{if $refineSearch}
					<aside class="sj-filters">
						<div id="ajax-refine-search">
							<div class="refine-search__wrapper loading">
								{include file="search_results_refine_block.tpl"}
							</div>
						</div>
					</aside>
				{/if}

				{* ============ JOB RESULTS ============ *}
				<div>
					{if $listings}
						<div class="sj-jobs-list">
							{include file="search_results_jobs_listings.tpl"}
						</div>

						<button type="button" class="load-more sj-load-more" {if $listing_search.current_page > 1} data-page="{$listing_search.current_page+1}" {else} data-page="2" {/if} data-backfilling="{if count($listings) < $listing_search.listings_per_page && $GLOBALS.user_page_uri ne '/company/'}true{else}false{/if}" data-backfilling-page="1">
							Charger plus d'annonces
						</button>

						{* ============ PAGINATION ============ *}
						{include file="Bottom_Navigation_Bar.tpl"}

					{else}
						<div class="alert alert-danger no-listings-found hidden" style="border-radius:12px;">
							[[Sorry, we don't currently have any jobs for this search. Please try another search.]]
						</div>
						<button type="button" class="load-more sj-load-more" data-page="2" data-backfilling="{if count($listings) < $listing_search.listings_per_page && $GLOBALS.user_page_uri ne '/company/'}true{else}false{/if}" data-backfilling-page="1">
							Charger plus d'annonces
						</button>
					{/if}

					{* ============ BOTTOM CTA ============ *}
					<div class="sj-search-cta">
						<h3>Vous ne trouvez pas ce que vous cherchez ?</h3>
						<p>Cr&eacute;ez une alerte et recevez les nouvelles offres par email.</p>
						<a href="#" class="sj-cta-btn"
						   data-toggle="modal"
						   data-target="#apply-modal"
						   data-href='{$GLOBALS.site_url}/guest-alerts/create/?searchId={$searchId}'
						   data-title='[[Create Job Alert]]'>Cr&eacute;er une alerte emploi</a>
					</div>
				</div>

			</div>

		</div>
		</div>{* /sj-results-area *}
	{/if}
{/if}

{if $GLOBALS.user_page_uri == '/jobs/' && $listings|count > 10}
	{javascript}
		<script>
            $.get('?searchId={$searchId}&action=search&featured=1', function(data) {
                var listings = $(data).find('.sj-job-card, .listing-item').slice(0,3);
                if (listings.length) {
                    $('.sj-jobs-list').prepend(listings);
                }
            });
		</script>
	{/javascript}
{/if}
{javascript}
	<script>
		var listingPerPage = {$listing_search.listings_per_page};
		var listingNumber = '{$jobs_number}';
		$(document).ready(function() {
			// refine search
			var ajaxUrl = "{$GLOBALS.site_url}/ajax/";
			var ajaxParams = {
				'action': 'get_refine_search_block',
				'listing_type[equal]': 'Job',
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
					$('.sj-jobs-list').append(data);
					if ($('.listing_item__backfilling').length < listingPerPage) {
						self.hide();
					}
					self.removeClass('loading');
				});
				return;
			}
            $.get('?searchId={$searchId}&action=search&featured=1', function(data) {
                var listings = $(data).find('.sj-job-card, .listing-item').slice(0,3);
                if (listings.length) {
                    $('.sj-jobs-list').append(listings);
                }
            });

			$.get('?searchId={$searchId}&action=search&page=' + self.data('page'), function(data) {
				var listings = $(data).find('.sj-job-card, .listing-item');
				self.removeClass('loading');
				if (listings.length) {
					$('.sj-jobs-list').append(listings);
					self.data('page', parseInt(self.data('page')) + 1);
				}
				if (listings.length !== listingPerPage) {
					if ('{$GLOBALS.user_page_uri ne '/company/'}') {
						self.data('backfilling', true);
						$('.load-more').click();
					} else {
						self.hide();
					}
				}
			});
		});
	</script>
{/javascript}