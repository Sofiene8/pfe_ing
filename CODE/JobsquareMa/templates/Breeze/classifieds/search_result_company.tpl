<div class="container {if 'banner_right_side'|banner}with-banner__companies{/if}">
	<div class="row details-body details-body__search">
		{if $ERRORS}
			{include file="error.tpl"}
		{else}
            <div class="container">
                {capture name='right_panel'}{strip}
                    {module name="users" function="featured_profiles" items_count="10"}
                    {if 'banner_right_side'|banner}
                        <div class="section banner banner--right banner--companies">
                            {'banner_right_side'|banner}
                        </div>
                        <div class="clearfix"></div>
                    {/if}
                {/strip}{/capture}
                <div class="search-results col-xs-12 col-sm-9 main-col {if $smarty.capture.right_panel}pull-left{else}search-results__centered{/if}">
                    <h1 class="search-results__title">[[$companies_number Companies]]</h1>
                    <div class="search-results search-results__companies featured-companies text-center clearfix">
                        {foreach from=$found_users_sids item=user_sid name=users_block}
                            {display property='CompanyName' object_sid=$user_sid assign=CompanyName}

                            <article class="media well listing-item listing-item__companies" aria-hidden="false">
                                <div class="media-left listing-item__logo">
                                    <a href="{$GLOBALS.site_url}/company/{$user_sid}/{$CompanyName|unescape|pretty_url}/" title="{$CompanyName}" class="listing-item__logo--wrapper">
                                        {if {display property='Logo' object_sid=$user_sid}}
                                            {display property='Logo' object_sid=$user_sid}
                                        {else}
                                            <div class="company__no-image"></div>
                                        {/if}
                                    </a>
                                </div>
                                <div class="media-body">
                                    <div class="media-heading listing-item__title {if $listing.featured}listing-item__featured-bg{/if}">
                                        <a href="{$GLOBALS.site_url}/company/{$user_sid}/{$CompanyName|unescape|pretty_url}/" title="{$CompanyName}" class="link">
                                            {display property='CompanyName' object_sid=$user_sid}
                                        </a>
                                    </div>
                                    {display property='CompanyDescription' object_sid=$user_sid assign='CompanyDescription'}
                                    <div class="listing-item__desc {if !$CompanyDescription}no-description{/if}">
                                        {$CompanyDescription|strip_tags}
                                    </div>
                                    <div class="listing-item__info clearfix">
                                        <span class="listing-item__info--item listing-item__info--item-companies-jobs">
                                            {display property='countListings' object_sid=$user_sid assign="jobs_number"}
                                            <a href="{$GLOBALS.site_url}/company/{$user_sid}/{$CompanyName|unescape|pretty_url}/#all-vacancy">[[$jobs_number job(s)]]</a>
                                        </span>
                                        {if {display property='GooglePlace' object_sid=$user_sid}}
                                            <span class="listing-item__info--item listing-item__info--item-location">
                                                {display property='GooglePlace' object_sid=$user_sid}
                                            </span>
                                        {/if}
                                    </div>
                                </div>
                            </article>

                        {/foreach}
                    </div>
                    <button type="button" class="load-more load-more__companies btn btn__white {if $companies_number > {$companies_per_page}}show{else}hidden{/if}" data-page="2">
                        [[Load more]]
                    </button>
                </div>
                {if $smarty.capture.right_panel}
                    <div class="col-sm-3 col-xs-12 sidebar-col pull-right">
                        {$smarty.capture.right_panel}
                    </div>
                {/if}
            </div>
		{/if}
	</div>
</div>

{javascript}
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={$GLOBALS.settings.google_api_key}&libraries=places&callback=initService&language={$GLOBALS.current_language}" async defer></script>
	<script>
		var listingPerPage = {$companies_per_page};
		$('.load-more').click(function() {
			var self = $(this);
			self.addClass('loading');
			$.get('?searchId={$searchId|escape}&action=search&page=' + self.data('page'), function(data) {
				self.removeClass('loading');
				var listings = $(data).find('.listing-item__companies');
				if (listings.length) {
					$('.listing-item__companies').last().after(listings);
					self.data('page', parseInt(self.data('page')) + 1);
				}
				if (listings.length !== listingPerPage) {
					self.removeClass('show').addClass('hidden');
				}
			});
		});

        document.addEventListener("touchstart", function() { }, false);

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

    </script>
{/javascript}