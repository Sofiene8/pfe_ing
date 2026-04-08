{description}[[Resumes from]] {$GLOBALS.settings.site_title}{/description}
<!--<h1 class="my-account-title">[[My Account]]</h1>-->
<div class="my-account-list">
	<ul class="nav nav-pills">
		{if $GLOBALS.current_user.group.id == "Employer"}
			{title}[[Job Postings]]{/title}
			{*<li class="presentation{if $listingTypeID == 'job'} active{/if}"><a href="{$GLOBALS.site_url}/my-listings/job/">[[Job Postings]]</a>
			
<li class="presentation{if $listingTypeID == 'training'} active{/if}"><a href="{$GLOBALS.site_url}/my-listings/training/">[[Training Postings]]</a></li>*}
		
			
			{*<li class="presentation"> <a href="{$GLOBALS.site_url}/system/applications/view/">[[Applicants]]</a></li>*}
			{*<li class="presentation"> <a href="{$GLOBALS.site_url}/edit-profile/">[[Company Profile]]</a></li>
			<li class="presentation active"><a href="{$GLOBALS.site_url}/resumes/">Accès Cvthèque</a></li>	*}
	
		{/if}
	</ul>
</div>
{capture name=search}
	{module name='classifieds' function='search_form' form_template='search_form_resumes.tpl' listing_type_id='Resume' searchId=$searchId}
{/capture}

{if $ERRORS}
	{include file="error.tpl"}
{else}
 {assign var="mescv" value=$listing_search.mescv}
  {assign var="moncvtheque" value=$listing_search.moncvtheque}
  
	<div class="search-header hidden-xs-480"></div>
	<div class="quick-search__inner-pages ">
	<div class="container block-recherche-resume">
	<div class="col-md-3"><h1>CVthèque</h1><span class="cv-number">{assign var="resumes_number" value=$listing_search.listings_number}
					[[$resumes_number resumes found]]</span></div>
		<div class="col-md-9">{$smarty.capture.search}</div></div>
		
	</div>
	<div class="container">
		<div class="details-body details-body__search clearfix {if $refineSearch}row{else}no-refine-search{/if}{if 'banner_right_side'|banner} with-banner{/if}">
			
			{if $refineSearch}
				<div id="ajax-refine-search" class="col-sm-3 col-xs-12 refine-search">
					<a class="toggle--refine-search visible-xs" role="button" data-toggle="collapse" href="#" aria-expanded="true">
						[[Refine Search]] [[{$refineField.caption}]]
					</a>
					<div class="refine-search__wrapper loading">
						<div class="quick-search__inner-pages visible-xs-480">
							{$smarty.capture.search}
						</div>
						{include file="search_results_refine_block.tpl"}
					</div>
					
				</div>
			{/if}
			<div class="search-results search-results__resumes {if $refineSearch}col-sm-9 col-xs-12{/if}">
			
				{if $listings}
				
				
					
				   <div class="pagination-top">
				         {include file="Bottom_Navigation_Bar.tpl"}
						 </div>
			
					{assign var='index' value=$listing_search.current_page*$listing_search.listings_per_page-$listing_search.listings_per_page}
					{foreach from=$listings item=listing name=listings}
						
					
						
						   <article id="{$listing.id}" class="media col-md-4 listing-item {if $listing.featured}listing-item__featured{/if}">
						   <div class="box-resume">
							{if $listing.Photo.file_url}
								<div class="media-left listing-item__logo listing-item__resumes">
									<div class="job-seeker__image">
										<a class="profile__image" href="{$GLOBALS.site_url}{$listing|listing_url}?backPage={$pageForBackButton}&searchID={$searchId}">
											<img class="media-object profile__img" src="{$listing.Photo.file_url}" alt="{$listing.user.CompanyName|escape:'html'}">
										</a>
									</div>
								</div>
								{else}
								<!--<div class="media-left listing-item__logo listing-item__resumes">
									<div class="job-seeker__image">
										<a class="profile__image" href="{$GLOBALS.site_url}{$listing|listing_url}?backPage={$pageForBackButton}&searchID={$searchId}">
											<img class="media-object profile__img" src="{$GLOBALS.site_url}/templates/Jobsquare/assets/images/sansphoto.jpg" alt="{$listing.user.CompanyName|escape:'html'}">
										</a>
									</div>
								</div>-->
							{/if}
							<div class="media-body">
								<!--<div class="media-heading listing-item__title">
									<a href="{$GLOBALS.site_url}{$listing|listing_url}?backPage={$pageForBackButton}&searchID={$searchId}" class="strong">
										{$listing.user.FullName|escape}
									</a>
								</div>--> 
								<div class="listing-item__info clearfix">
									{if $listing.Title}
										<span class="listing-item__info--item listing-item__info--item-company">
											<a href="{$GLOBALS.site_url}{$listing|listing_url}?backPage={$pageForBackButton}&searchID={$searchId}">	{$listing.Title|escape}</a>
										</span>
									{/if}
                                    
									{if $listing|location}
										<span class="listing-item__info--item listing-item__info--item-location">
											{$listing|location}
										</span>
									{/if}
								</div>
								{if $listing.id|in_array:$mescv} <div class="dejavu">Déja sélectionné</div>{/if}
							<!--	<div class="media-right text-right">
								{if $listing.id|in_array:$mescv} <div class="dejavu">Déja sélectionné</div>{/if}
									<a href="{$GLOBALS.site_url}{$listing|listing_url}?backPage={$pageForBackButton}&searchID={$searchId}" class="link"><span class="listing-item__employment-type">Voir Plus</span></a>
								
								</div>-->
								<div class="listing-item__desc listing-item__desc-job-seeker hidden-sm hidden-xs">
									{$listing.Skills|strip_tags|truncate:150:"..."}
								</div>
							</div>
							<div class="listing-item__desc visible-sm visible-xs listing-item__desc-job-seeker">
								{$listing.Skills|strip_tags|truncate:150:"..."}
							</div>
							</div>
						</article>
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
						
					{/foreach}
				{else}
					<div class="alert alert-danger no-listings-found">
						[[Sorry, we don't currently have any resumes for this search. Please try another search.]]
					</div>
				{/if}
				<button type="button" class="load-more btn btn__white {if count($listings) < $listing_search.listings_per_page}hidden{/if}" data-page="2">
					[[Load more]]
				</button>
				
				 <div class="pagination-bottom">
					    {include file="Bottom_Navigation_Bar.tpl"}
						 </div>
					
			</div>
		</div>
		{if 'banner_right_side'|banner}
			<div class="banner banner--right banner--search">
				{'banner_right_side'|banner}
			</div>
		{/if}
	</div>
{/if}
{javascript}
		<script type="text/javascript" language="JavaScript">
		$(document).ready(function() {
			var ajaxUrl = "{$GLOBALS.site_url}/ajax/";
			var ajaxParams = {
				'action' : 'get_refine_search_block',
				'listing_type[equal]' : 'Resume',
				'searchId' : '{$searchId}',
				'showRefineFields' : {$listing_search.listings_number} > 0
			};

			$.get(ajaxUrl, ajaxParams, function(data) {
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
		});

		var listingPerPage = {$listing_search.listings_per_page};
		$('.load-more').click(function() {
			var self = $(this);
			self.addClass('loading');
			$.get('?searchId={$searchId}&action=search&page=' + self.data('page'), function(data) {
				self.removeClass('loading');
				var listings = $(data).find('.listing-item');
				if (listings.length) {
					$('.listing-item').last().after(listings);
					self.data('page', parseInt(self.data('page')) + 1);
					$('.pagination-bottom').hide();
				}
				if (listings.length !== listingPerPage) {
					self.hide();
					$('.load-more').click();
				}
			});
		});
	</script>

	<style>
	
	.tinyheader.page-resume .quick-search__inner-pages {
    background: #0055d9!important;
   
}

.tinyheader.page-resume .container.block-recherche-resume h1 {
    color: #ffffff!important;
  
}
.tinyheader.page-resume .cv-number {
    color: #ffffff!important;
}


.tinyheader.page-resume   .quick-search__find {

    background: #ee810c!important;
  
    color: white!important;
    line-height: 16px;
    padding: 0;
}

.box-resume { padding:10px; }
.tinyheader.page-resume .listing-item__info .listing-item__info--item-location {
 
    font-size: .8em;
   
}

.tinyheader.page-resume .listing-item__info .listing-item__info--item-location {
   
    padding-left: 0px;
}


.box-resume {
    padding: 10px;
    border: 1px solid #ccc;
    min-height: 140px;
}

.tinyheader.page-resume .listing-item__info .listing-item__info--item {
 
    font-size: 0.85em;
	display: block;
	font-weight: 400;
}

.tinyheader.page-resume .media-body {
    width: 100%;
    max-width: 350px;
}
.search-results__resumes .btn {
    clear: both;
}
	</style>
{/javascript}