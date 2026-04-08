<!DOCTYPE html>
<html lang="fr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Jobsquare.ma [[Admin Panel]]{if $TITLE} | {$TITLE|escape}{/if}</title>
	<meta name="viewport" content="width=device-width, height=device-height,
                                   initial-scale=1.0, maximum-scale=1.0,
                                   target-densityDpi=device-dpi">
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,700,500' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="{$GLOBALS.user_site_url}/templates/_system/admin/assets/third-party/css/animate.css?v={$GLOBALS.v}" />
	<link rel="stylesheet" type="text/css" href="{$GLOBALS.user_site_url}/templates/_system/admin/assets/third-party/css/toggles.css?v={$GLOBALS.v}" />
	<link rel="stylesheet" type="text/css" href="{$GLOBALS.user_site_url}/templates/_system/admin/assets/style/style.css?v={$GLOBALS.v}" />
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/1.5.2/css/ionicons.css" />
	<link href="{$GLOBALS.user_site_url}/system/ext/jquery/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">

	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="{$GLOBALS.user_site_url}/system/ext/jquery/css/jquery.multiselect.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
	<script language="JavaScript" type="text/javascript" src="{common_js}/main.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script language="JavaScript" type="text/javascript" src="{common_js}/autoupload_functions.js"></script>
	<script language="JavaScript" type="text/javascript" src="{$GLOBALS.user_site_url}/system/ext/jquery/multilist/jquery.multiselect.min.js"></script>
	<script language="JavaScript" type="text/javascript" src="{common_js}/multilist_functions.js"></script>
	<script language="JavaScript" type="text/javascript" src="{$GLOBALS.user_site_url}/templates/_system/admin/assets/third-party/js/toggles.min.js"></script>

	<script language="JavaScript" type="text/javascript" src="{$GLOBALS.user_site_url}/system/ext/jquery/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
	{if isset( $GLOBALS.available_datepicker_localizations[$GLOBALS.current_language] )}
		<script type="text/javascript" src="{$GLOBALS.user_site_url}/system/ext/jquery/bootstrap-datepicker/i18n/bootstrap-datepicker.{$GLOBALS.current_language}.min.js" ></script>
	{/if}
	<script>
		var langSettings = {
			thousands_separator : '{$GLOBALS.current_language_data.thousands_separator}',
			decimal_separator : '{$GLOBALS.current_language_data.decimal_separator}',
			decimals : '{$GLOBALS.current_language_data.decimals}',
			currencySign: '{currencySign}',
			showCurrencySign: 1,
			currencySignLocation: '{$GLOBALS.current_language_data.currencySignLocation}',
			rightToLeft: {$GLOBALS.current_language_data.rightToLeft}
		};
	</script>
	<script language="JavaScript" type="text/javascript" src="{common_js}/floatnumbers_functions.js"></script>
	{capture name="displayProgressBar"}<img style="vertical-align: middle;" src="{$GLOBALS.user_site_url}/system/ext/jquery/progbar.gif" alt="[[Please wait ...]]" /> [[Please wait ...]]{/capture}
    <script language="JavaScript" type="text/javascript">

		// Set global javascript value for page
		window.SJB_GlobalSiteUrl = '{$GLOBALS.site_url}';
		window.SJB_AdminSiteUrl  = '{$GLOBALS.admin_site_url}';
		window.SJB_UserSiteUrl   = '{$GLOBALS.user_site_url}';

		currentSjbVersion = {
			major: "{$GLOBALS.version.major}",
			minor: "{$GLOBALS.version.minor}",
			build: "{$GLOBALS.version.build}"
		};

		

		$.extend($.ui.dialog.prototype.options, {
			modal: true
		});

	</script>
</head>
<body>
	<aside class="left-panel" tabindex="5000" style="overflow: hidden; outline: none;">
		<div class="left-panel__top">
			<div class="logo">
				<a href="{$GLOBALS.admin_site_url}" class="logo-expanded text-center">
					<img class="logo__img" src="{image}logo.svg" border="0" alt=""/>
				</a>
			</div>
		</div>
		{module name="menu" function="show_left_menu"}
	</aside>
	<section class="content">
		<header class="top-head container-fluid">
			<button type="button" class="navbar-toggle pull-left visible-sm visible-xs">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>

			<nav class="navbar-default clearfix" role="navigation">
				<ul class="nav navbar-nav navbar-right top-menu top-right-menu">
					<li class="navbar-nav__icon">
						<a href="{if $GLOBALS.settings.domain|escape}https://{$GLOBALS.settings.domain|escape}{$GLOBALS.base_url}{else}{$GLOBALS.user_site_url}{/if}" class="view-frontend" target="_blank" title="[[View your job board]]">
							<i class="fa fa-external-link" aria-hidden="true"></i>
						</a>
					</li>
				
					<li class="dropdown text-right pull-right navbar-nav__icon">
						<a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="false">
							<i class="fa fa-user" aria-hidden="true"></i>
							<i class="fa fa-caret-down" aria-hidden="true"></i>
						</a>
						<ul class="dropdown-menu pro-menu fadeInUp animated" tabindex="5003" style="overflow: hidden; outline: none;">
							
							<li>
								{if $smarty.session.admin.owner}
									<a href="{$billingUrl}">[[My Account]]</a>
								{else}
									<a href="{$GLOBALS.site_url}/admins/?action=edit&amp;sid={$smarty.session.admin.sid}">[[My Account]]</a>
								{/if}
							</li>
							<li><a href="{$GLOBALS.site_url}/system/users/logout/">[[Log out]]</a></li>
						</ul>
					</li>
					<li class="pull-right help-center navbar-nav__icon">
						<a href="#" target="_blank" title="[[Help Center]]">
							<i class="fa fa-life-ring" aria-hidden="true"></i>
						</a>
					</li>
				</ul>
			</nav>
		</header>

		<div class="update-info">
			<a href="{$GLOBALS.site_url}/update-to-new-version/">[[New update available]]</a>
			<span class="update-info-close">X</span>
		</div>
		{module name="miscellaneous" function="guided_tour"}
		<div class="wrapper container-fluid wrapper--main">
			{if $GLOBALS.user_page_uri !== "/" && $ADMIN_BREADCRUMBS}
				<div class="breacrumb__wrapper clearfix">
					<ol id="breadCrumbs" class="breadcrumb clearfix">
						<li>[[{$ADMIN_BREADCRUMBS}]]</li>
					</ol>
				</div>
			{/if}
			{module name='flash_messages' function='display'}
			{$MAIN_CONTENT}
		</div>
	</section>

	<script data-pace-options='{ "restartOnRequestAfter": false, "restartOnPushState": false }' src="{$GLOBALS.user_site_url}/templates/_system/admin/assets/third-party/js/pace.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
            var dFormat = '{$GLOBALS.settings.date_format}';

            dFormat = dFormat.replace('%m', "mm");
            dFormat = dFormat.replace('%d', "dd");
            dFormat = dFormat.replace('%Y', "yyyy");

            console.log(dFormat);
            $(".input__datepicker").datepicker({
                language: '{$GLOBALS.current_language}',
                format: dFormat,
                autoclose: true,
                todayHighlight: true,
                startDate: new Date(1940, 1 - 1, 1),
                endDate: '+10y',
            });

            $('.ui-datepicker-trigger').on('click', function () {
                $(this).prev().focus();
            });

			var is_touch_device = ("ontouchstart" in window) || window.DocumentTouch && document instanceof DocumentTouch;
			var tooltipPlacement = '';

			if ($(window).width() >= 992 && (!$('.tooltip-job8').length)) {
				tooltipPlacement = 'auto top';
			} else {
				tooltipPlacement = 'auto left';
			}

			$('[data-toggle="tooltip"]').tooltip({
				trigger: is_touch_device ? "click" : "manual",
				html: true,
				placement: tooltipPlacement
			}).on("mouseenter", function() {
				var _this = this;
				$(this).tooltip("show");
				$(this).siblings(".tooltip").on("mouseleave", function() {
					$(_this).tooltip("hide");
				});
			}).on("mouseleave", function() {
				var _this = this;
				setTimeout(function() {
					if (!$(".tooltip:hover").length) {
						$(_this).tooltip("hide")
					}
				}, 200);
			});

		});
	</script>
	{js}
</body>
</html>
