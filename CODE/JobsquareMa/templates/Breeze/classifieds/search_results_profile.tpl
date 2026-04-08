<div class="container">
    <div class="row">
        <div class="search-results col-xs-12 col-sm-9 main-col">
            <div class="results text-left">
                <a href="javascript:history.go(-1)"
                   class="btn__back">
                    [[Back]]
                </a>
            </div>
            {include file="company_profile_header.tpl"}
            <!-- Nav tabs -->
            <div class="company-profile-info__tabs-list">
                <ul class="nav nav-tabs company-profile-info__tabs-list--tabs" role="tablist">
                    {assign var="jobs_number" value=$listing_search.listings_number}
                    <li role="presentation" class="active">
                        <a href="#about-info" aria-controls="about-info" role="tab" data-toggle="tab">[[Company Description]]</a>
                    </li>
                    <li role="presentation">
                        <a href="#all-vacancy" aria-controls="all-vacancy" role="tab" data-toggle="tab">[[Jobs]] ([[$jobs_number]])</a>
                    </li>
                </ul>
            </div>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="about-info">
                    {include file="company_profile.tpl"}
                </div>
                <div role="tabpanel" class="tab-pane fade" id="all-vacancy">
                    <div class="companies-jobs-list">
                        {if $listings}
                            <div class="search-results listing">
                                {include file="search_results_jobs_listings.tpl"}
                                <button type="button" class="load-more btn btn__white {if $listing_search.listings_number <= $listing_search.listings_per_page}hidden{/if}" data-backfilling="false" data-page="2">
                                    [[Load more]]
                                </button>
                            </div>
                        {/if}
                    </div>
                </div>
            </div>

        </div>
        <div class="col-sm-3 col-xs-12 sidebar-col">
            <section class="main-sections main-sections__alert">
                <div class="alert__block alert__block-form">
                    <div class="alert__block subscribe__description">
                        {assign var="company_name" value=$userInfo.CompanyName}
                        <h3>[[Email me jobs from $company_name]]</h3>
                    </div>
                    <form action="{$GLOBALS.site_url}/guest-alerts/create/" method="post" id="create-alert" class="alert__form">
                        <input type="hidden" name="action" value="save" />
                        <input type="hidden" name="searchId" value="{$searchId|escape}" />
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
            </section>
            {if 'banner_right_side'|banner}
                <div class="banner banner--right">
                    {'banner_right_side'|banner}
                </div>
            {/if}
        </div>
    </div>
</div>


{javascript}
    <script>
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
        $(function() {
            // Javascript to enable link to tab
            var hash = document.location.hash;
            if (hash) {
                $('.nav-tabs a[href='+hash+']').tab('show');
            }

            // Change hash for page-reload
            $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
                window.location.hash = e.target.hash;
            });
        });

    </script>
{/javascript}