{description}[[Resumes from]] {$GLOBALS.settings.site_title}{/description}

{capture name=search}
	{module name='classifieds' function='search_form' form_template='search_form_resumes.tpl' listing_type_id='Resume' searchId=$searchId}
{/capture}

{if $ERRORS}
	{include file="error.tpl"}
{else}
    <div class="search-header {if !$user_page_uri}hidden-xs-480{/if}"></div>
    <div class="quick-search__inner-pages {if !$user_page_uri}hidden-xs-480{/if}">
		{$smarty.capture.search}
	</div>
	<div class="container">
		<div class="details-body details-body__search {if !$refineSearch}no-refine-search{/if}{if 'banner_right_side'|banner} with-banner{/if} clearfix">
            {if $refineSearch}
                <div class="col-sm-3 col-xs-12 sidebar-col pull-right">
                    <div id="ajax-refine-search" class="refine-search">
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
                    {if 'banner_right_side'|banner}
                        <div class="banner banner--right banner--search">
                            {'banner_right_side'|banner}
                        </div>
                    {/if}
                </div>
            {/if}
			<div class="search-results search-results__resumes {if $refineSearch}col-xs-12 col-sm-9 main-col{/if} {if !$listings}no-results{/if} pull-left">
                {if !empty($currentSearch)}
                    <div class="current-search__top">
                        {capture name="urlParams"}searchId={$searchId|escape:'url'}&amp;action=undo{/capture}
                        {foreach from=$currentSearch item="fieldInfo" key="fieldID"}
                            {foreach from=$fieldInfo.field item="fieldValue" key="fieldType"}
                                {foreach from=$fieldValue item="val" key="realVal"}
                                    <a class="badge" href="?{$smarty.capture.urlParams}&amp;param={$fieldID}&amp;type={$fieldType}&amp;value={$realVal|escape:'url'}">{tr}{$val}{/tr|escape}</a>
                                {/foreach}
                            {/foreach}
                        {/foreach}
                    </div>
                {/if}

                <h1 class="search-results__title">
                    {assign var="resumes_number" value=$listing_search.listings_number}
                    [[$resumes_number resumes found]]
                </h1>
				{if $listings}
					{assign var='index' value=$listing_search.current_page*$listing_search.listings_per_page-$listing_search.listings_per_page}
					{foreach from=$listings item=listing name=listings}
						<article class="media well listing-item {if $listing.featured}listing-item__featured{/if} {if !$listing.Photo.file_url}listing-item__no-logo{/if}">
							{if $listing.Photo.file_url}
                                <div class="media-left listing-item__logo listing-item__resumes">
                                    <div class="listing-item__logo--wrapper">
										<a class="profile__image" href="{$GLOBALS.site_url}{$listing|listing_url}">
											<img class="media-object profile__img" src="{$listing.Photo.file_url}" alt="{$listing.user.CompanyName|escape:'html'}">
										</a>
									</div>
								</div>
							{/if}
							<div class="media-body">
                                <div class="listing-item__date">
                                    {$listing.activation_date|date}
                                </div>
								<div class="media-heading listing-item__title {if $listing.featured}listing-item__featured-bg{/if}">
									<a href="{$GLOBALS.site_url}{$listing|listing_url}" class="strong">
										{$listing.user.FullName|escape}
									</a>
                                    {if $listing.featured}<span class="listing-item__title--featured pull-right">[[Featured]]</span>{/if}
								</div>
                                <div class="listing-item__desc listing-item__desc-job-seeker {if !$listing.Skills}no-skills{/if}">
                                    {$listing.Skills|strip_tags}
                                </div>
								<div class="listing-item__info clearfix">
									{if $listing.Title}
										<span class="listing-item__info--item listing-item__info--item-company">
											{$listing.Title|escape}
										</span>
									{/if}
									{if $listing|location}
										<span class="listing-item__info--item listing-item__info--item-location">
											{$listing|location}
										</span>
									{/if}
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
					<div class="no-listings-found">
						[[Sorry, we don't currently have any resumes for this search. Please try another search.]]
					</div>
				{/if}
				<button type="button" class="load-more btn btn__white {if count($listings) < $listing_search.listings_per_page}hidden{/if}" data-page="2">
					[[Load more]]
				</button>
			</div>
		</div>
	</div>
{/if}
{javascript}
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={$GLOBALS.settings.google_api_key}&libraries=places&callback=initService&language={$GLOBALS.current_language}" async defer></script>
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
				}
				if (listings.length !== listingPerPage) {
					self.hide();
					$('.load-more').click();
				}
			});
		});
	</script>
{/javascript}