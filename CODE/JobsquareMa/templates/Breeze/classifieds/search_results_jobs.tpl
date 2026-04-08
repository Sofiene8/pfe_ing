{assign var="site_name" value=$GLOBALS.settings.site_title}
{description}[[jobs from $site_name]]{/description}

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
		<div class="container">
			<div class="details-body details-body__search clearfix">
				{if $smarty.request.not_found}
					<div class="col-xs-12">
						<div class="alert alert-info text-center">
							[[Sorry, that job is no longer available. Here are some results that may be similar to the job you were looking for.]]
						</div>
					</div>
				{/if}
                {if !$user_page_uri}
                    <div class="col-sm-3 col-xs-12 sidebar-col pull-right">
                        {if $listing_type_id != ''}
                            <div class="alert__block alert__block-form">
                                <div class="alert__block subscribe__description">
                                    <h3 class="hide-title">[[Email me jobs like this]]</h3>
                                    <a class="toggle--alert-block--form visible-xs" role="button" data-toggle="collapse" href="#" aria-expanded="true">
                                        [[Email me jobs like this]]
                                    </a>
                                </div>
                                <div class="alert__form--wrapper">
                                    <form action="{$GLOBALS.site_url}/guest-alerts/create/" method="post" id="create-alert" class="alert__form">
                                        <input type="hidden" name="searchId" value="{$searchId}">
                                        <input type="hidden" name="action" value="save" />
                                        <div class="alert__messages">
                                        </div>
                                        <div class="form-group alert__form__input">
                                            <input type="email" class="form-control" name="email" value="" placeholder="[[Your email]]">
                                        </div>
                                        <div class="form-group alert__form__input">
                                            <select class="form-control" name="email_frequency">
                                                <option value="daily">[[Daily]]</option>
                                                <option value="weekly">[[Weekly]]</option>
                                                <option value="monthly">[[Monthly]]</option>
                                            </select>
                                        </div>
                                        <div class="form-group alert__form__input text-center">
                                            <input type="submit" name="save" value="[[Create alert]]" class="btn__submit-modal btn btn__orange btn__bold" onclick="return createAlert();">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        {/if}
                        {if $refineSearch}
                            <div id="ajax-refine-search" class="refine-search clearfix">
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
                        {if 'banner_right_side'|banner}
                            <div class="banner banner--right banner--search">
                                {'banner_right_side'|banner}
                            </div>
                        {/if}
                    </div>
                {/if}
				<div class="search-results col-xs-12 col-sm-9 main-col{if $user_page_uri} search-results__small{else} pull-left{/if} {if !$listings}no-results{/if} {if 'banner_right_side'|banner}has-right-banner{/if}">
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

                    {assign var="jobs_number" value=$listing_search.listings_number}
                    {if $user_page_uri}
                        {foreach from=$browse_navigation_elements item=element name="nav_elements"}
                            <h1 class="search-results__title {if $user_page_uri}browse-by__title{/if}">
                                {if $user_page_uri == '/categories/'}
                                    {assign var="category_name" value=$element.caption|escape}
                                    [[$jobs_number $category_name jobs]]
                                {else}
                                    {assign var="location" value=$element.caption|escape}
                                    [[$jobs_number jobs found in $location]]
                                {/if}
                            </h1>
                        {/foreach}
                    {else}
                        <h1 class="search-results__title {if $user_page_uri}browse-by__title{/if}">
                            [[$jobs_number jobs found]]
                        </h1>
                    {/if}
					{if $listings}
						{include file="search_results_jobs_listings.tpl"}
						<button type="button" class="load-more btn btn__white" data-page="2" data-backfilling="{if count($listings) < $listing_search.listings_per_page && $GLOBALS.user_page_uri ne '/company/'}true{else}false{/if}" data-backfilling-page="1">
							[[Load more]]
						</button>
					{else}
						<div class="no-listings-found hidden">
							[[Sorry, we don't currently have any jobs for this search. Please try another search.]]
						</div>
						<button type="button" class="load-more btn btn__white" data-page="2" data-backfilling="{if count($listings) < $listing_search.listings_per_page && $GLOBALS.user_page_uri ne '/company/'}true{else}false{/if}" data-backfilling-page="1">
							[[Load more]]
						</button>
					{/if}
				</div>
                {if $user_page_uri}
                    {if 'banner_right_side'|banner}
                        <div class="banner banner--right banner--search">
                            {'banner_right_side'|banner}
                        </div>
                    {/if}
                {/if}
			</div>
		</div>
	{/if}
{/if}

{if $GLOBALS.user_page_uri == '/jobs/' || $browse_request_data}
	{javascript}
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={$GLOBALS.settings.google_api_key}&libraries=places&callback=initService&language={$GLOBALS.current_language}" async defer></script>
	{/javascript}
{/if}

{javascript}
	<script>
		var listingPerPage = {$listing_search.listings_per_page};
		var listingNumber = '{$jobs_number}';

        function goBack() {
            window.history.back();
        }

        function createAlert() {
            var options = {
                target: '.alert__messages',
                url:  $('#create-alert').attr('action'),
                success: function(data) {
                    if (data) {
                        $('#create-alert').find('.form-control[name="email"]').text('').val('');
                        $('#create-alert').find('.btn').blur();
                    }
                    $('.alert__messages').find('#create-alert').remove();
                }
            };
            $('#create-alert').ajaxSubmit(options);
            return false;
        }

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