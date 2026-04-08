<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<meta name="keywords" content="{if $GLOBALS.settings.home_page_keywords}{$GLOBALS.settings.home_page_keywords|escape}{else}{$KEYWORDS|escape}{/if}">
	<meta name="description" content="{if $GLOBALS.settings.home_page_description}{$GLOBALS.settings.home_page_description|escape}{else}{$DESCRIPTION|escape}{/if}">
	<meta name="viewport" content="width=device-width, height=device-height,
                                   initial-scale=1.0, maximum-scale=1.0,
                                   target-densityDpi=device-dpi">
	<link rel="alternate" type="application/rss+xml" title="[[Jobs]]" href="{$GLOBALS.site_url}/rss/">

	<title>{if $GLOBALS.settings.home_page_title}{$GLOBALS.settings.home_page_title}{else}{$GLOBALS.settings.site_title}{/if}</title>

	<link href="{$GLOBALS.site_url}/templates/Breeze/assets/third-party/jquery-ui.css" rel="stylesheet">

	<!-- Bootstrap -->
	<link href="{$GLOBALS.site_url}/templates/Breeze/vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

	<link href="{$GLOBALS.site_url}/templates/Breeze/assets/third-party/jquery.bxslider.css" rel="stylesheet">
	<link href="{$GLOBALS.site_url}/templates/Breeze/assets/style/styles.css" rel="stylesheet">

	[[$HEAD]]
	<style type="text/css">{$GLOBALS.theme_settings.custom_css}</style>
	{$GLOBALS.theme_settings.custom_js}
</head>
<body>
	{include file="../menu/header.tpl"}
	<div class="main-banner">
		<div class="main-banner__wrapper">
			<div class="container">
				{module name="classifieds" function="count_listings"}
			</div>
		</div>
	</div>
	<div class="quick-search__frontpage">
		{$MAIN_CONTENT}
	</div>
    <section class="main-sections main-sections__main-wrapper">
        <div class="container">
            <div class="col-xs-12 col-sm-9 main-col">
                {module name="classifieds" function="latest_listings" items_count="10" listing_type="Job" featured_first="true"}
            </div>
            <div class="col-xs-12 col-sm-3 sidebar-col">
                <section class="main-sections main-sections__secondary__banner">
                    <div class="secondary-banner secondary-banner__wrapper">
                        [[{$GLOBALS.theme_settings.secondary_banner_text}]]
                    </div>
                </section>
                {module name="users" function="featured_profiles" items_count="10"}
                {if $GLOBALS.theme_settings.jobs_by_category}
                    <section class="main-sections main-sections__jobs-by jobs-by">
                        <div class="jobs-by__wrapper">
                            <div class="jobs-by__title">[[Jobs by Category]]</div>
                            {module name="classifieds" function="browse" columns=3 browseUrl="/categories/" browse_template="browse_by_category.tpl" recordsNumToDisplay="20"}
                        </div>
                    </section>
                    {assign var="isFirstBrowse" value=false}
                {/if}
                {if $GLOBALS.theme_settings.jobs_by_city}
                    <section class="main-sections main-sections__jobs-by jobs-by">
                        <div class="jobs-by__wrapper">
                            <div class="jobs-by__title">[[Jobs by City]]</div>
                            {module name="classifieds" function="browse" columns=3 browseUrl="/cities/" browse_template="browse_by_city.tpl" recordsNumToDisplay="20"}
                        </div>
                    </section>
                    {assign var="isFirstBrowse" value=false}
                {/if}
                {if $GLOBALS.theme_settings.jobs_by_state}
                    <section class="main-sections main-sections__jobs-by jobs-by">
                        <div class="jobs-by__wrapper">
                            <div class="jobs-by__title">[[Jobs by State]]</div>
                            {module name="classifieds" function="browse" columns=3 browseUrl="/states/" browse_template="browse_by_state.tpl" recordsNumToDisplay="20"}
                        </div>
                    </section>
                    {assign var="isFirstBrowse" value=false}
                {/if}
                {if $GLOBALS.theme_settings.jobs_by_country}
                    <section class="main-sections main-sections__jobs-by jobs-by">
                        <div class="jobs-by__wrapper">
                            <div class="jobs-by__title">[[Jobs by Country]]</div>
                            {module name="classifieds" function="browse" columns=3 browseUrl="/countries/" browse_template="browse_by_country.tpl" recordsNumToDisplay="20"}
                        </div>
                    </section>
                    {assign var="isFirstBrowse" value=false}
                {/if}

                <section class="main-sections main-sections__alert">
                    <div class="alert__block alert__block-form">
                        <div class="alert__block subscribe__description">
                            [[{$GLOBALS.theme_settings.bottom_section_html}]]
                        </div>
                        <form action="{$GLOBALS.site_url}/guest-alerts/create/" method="post" id="create-alert" class="alert__form">
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
                </section>

                {if 'banner_right_side'|banner}
                    <div class="banner banner--right">
                        {'banner_right_side'|banner}
                    </div>
                {/if}

            </div>
        </div>
    </section>
	{include file="../menu/footer.tpl"}

	<script src="{$GLOBALS.site_url}/templates/Breeze/assets/third-party/jquery.min.js"></script>
	<script src="{$GLOBALS.site_url}/templates/Breeze/vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="{$GLOBALS.site_url}/templates/Breeze/assets/third-party/jquery.bxslider.min.js"></script>

	<script language="JavaScript" type="text/javascript" src="{common_js}/main.js"></script>
	<script language="JavaScript" type="text/javascript" src="{common_js}/multilist_functions.js"></script>
	<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/templates/Breeze/assets/third-party/jquery.form.min.js"></script>
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={$GLOBALS.settings.google_api_key}&libraries=places&callback=initService&language={$GLOBALS.current_language}" async defer></script>
	{javascript}
		<script language="javascript" type="text/javascript">
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

			$(document).ready(function() {
				$('.nav-pills li').on('click', function() {
					var current = $('.nav-pills').scrollLeft();
					var left = $(this).position().left;

					if ( $( this ).is(':first-child') ) {
						$('.nav-pills').scrollLeft(0);
					} else {
						$('.nav-pills').animate({
							scrollLeft: current + left - 15
						}, 300);
					}
				});
			});
		</script>
	{/javascript}
	{js}
</body>
</html>