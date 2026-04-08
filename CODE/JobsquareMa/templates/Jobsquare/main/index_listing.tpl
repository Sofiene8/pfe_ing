{if (($GLOBALS.user_page_uri == '/add-listing/') & ( $listingTypeID=='Resume'||$smarty.get.listing_type_id =='Resume'))
	||($GLOBALS.user_page_uri == '/edit-resume/')
}
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<meta name="keywords" content="{$KEYWORDS|escape}">
	<meta name="description" content="{$DESCRIPTION|escape}">
	<meta name="viewport" content="width=device-width, height=device-height,
                                   initial-scale=1.0, maximum-scale=1.0,
                                   target-densityDpi=device-dpi">
	<link rel="alternate" type="application/rss+xml" title="[[Jobs]]" href="{$GLOBALS.site_url}/rss/">

	<title>{if $TITLE}{tr}{$TITLE}{/tr|escape} | {/if}{$GLOBALS.settings.site_title}</title>
	[[$HEAD]]
	<link href="{$GLOBALS.site_url}/templates/Jobsquare/assets/third-party/jquery-ui.css" rel="stylesheet">
	<link href="{$GLOBALS.site_url}/templates/Jobsquare/vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="{$GLOBALS.site_url}/system/ext/jquery/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">

	<link href="{$GLOBALS.site_url}/templates/Jobsquare/assets/style/styles.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
	<link href="{$GLOBALS.site_url}/templates/Jobsquare/assets/style/search-jobs.css" rel="stylesheet">
<style type="text/css">{$GLOBALS.theme_settings.custom_css}</style>
		
	<!-- Ajout pour nouveau style  Ched  -->


{if $GLOBALS.current_user.logged_in}


	{if $GLOBALS.current_user.group.id == "Employer"}
	<link href="{$GLOBALS.site_url}/templates/Jobsquare/assets/style/jobseeker/jobseeker.css" rel="stylesheet">
		{else }
		<link href="{$GLOBALS.site_url}/templates/Jobsquare/assets/style/jobseeker/resume.css" rel="stylesheet">
			{/if}
			
{/if}
		

		<!-- Ajout pour nouveau style  -->	
	
	{$GLOBALS.theme_settings.custom_js}
	
</head>
<body  class="tinyheader">  
{if (($GLOBALS.user_page_uri == '/add-listing/') & ( $listingTypeID=='Resume'||$listingTypeID=='Job'||$smarty.get.listing_type_id =='Resume'||$smarty.get.listing_type_id =='job'))}
  {if $listings}       
   {include file="../menu/headerresume.tpl"}
 
    {else}
	
	{/if}
	{else}
	  {include file="../menu/headerresume.tpl"}
	{/if}
	
	

	<div class="page-row container">
			<div class="display-item row">
				{block name='main_content'}
					{$MAIN_CONTENT}
				{/block}
			</div>
		</div>

	
{if $GLOBALS.user_page_uri == '/add-listing/'}
{else}
	{include file="../menu/footerresume.tpl"}
{/if}
	   
		
			
			
				
		
		




	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="{$GLOBALS.site_url}/templates/Jobsquare/assets/third-party/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="{$GLOBALS.site_url}/templates/Jobsquare/vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>

	<script src="{$GLOBALS.site_url}/templates/Jobsquare/assets/third-party/jquery-ui.min.js"></script>

	<script language="JavaScript" type="text/javascript" src="{common_js}/main.js"></script>
	<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/templates/Jobsquare/assets/third-party/jquery.form.min.js"></script>
	<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/system/ext/jquery/jquery.validate.min.js"></script>
	<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/templates/Jobsquare/common_js/autoupload_functions.js"></script>
	<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/system/ext/jquery/imagesize.js"></script>
	<link rel="Stylesheet" type="text/css" href="{$GLOBALS.site_url}/system/ext/jquery/css/jquery.multiselect.css" />
	<script language="JavaScript" type="text/javascript" src="{$GLOBALS.user_site_url}/system/ext/jquery/multilist/jquery.multiselect.min.js"></script>
	<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/templates/Jobsquare/common_js/multilist_functions.js"></script>
	<script>
		document.addEventListener("touchstart", function() { }, false);

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

	<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/system/ext/jquery/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
	{if isset( $GLOBALS.available_datepicker_localizations[$GLOBALS.current_language] )}
		<script type="text/javascript" src="{$GLOBALS.site_url}/system/ext/jquery/bootstrap-datepicker/i18n/bootstrap-datepicker.{$GLOBALS.current_language}.min.js" ></script>
	{/if}

	<script language="javascript" type="text/javascript">

		// Set global javascript value for page
		window.SJB_GlobalSiteUrl = '{$GLOBALS.site_url}';
		window.SJB_UserSiteUrl   = '{$GLOBALS.user_site_url}';

	</script>

	{* load scripts for used indeed *}
	{if $GLOBALS.user_page_uri == '/jobs/'}
		{if $GLOBALS.plugins.IndeedPlugin.active == 1}
			<script type="text/javascript" src="https://gdc.indeed.com/ads/apiresults.js"></script>
		{/if}
	{/if}

	{js}

	<script>
		function message(title, content) {
			var modal = $('#message-modal');
			modal.find('.modal-title').html(title);
			modal.find('.modal-body').html(content);
			modal.modal('show');
		}
	</script>
	<link rel="stylesheet" type="text/css" href="{$GLOBALS.site_url}/templates/Jobsquare/assets/style/cookieconsent.min.css" />
<script src="{$GLOBALS.site_url}/templates/Jobsquare/assets/third-party/cookieconsent.min.js" data-cfasync="false"></script>
<script>
window.addEventListener("load", function(){
window.cookieconsent.initialise({
  "palette": {
    "popup": {
      "background": "#000"
    },
    "button": {
      "background": "#f1d600"
    }
  }
})});
</script>
<script>
window.addEventListener("load", function(){
window.cookieconsent.initialise({
  "palette": {
    "popup": {
      "background": "#413D3C"
    },
    "button": {
      "background": "#eb800e"
    }
  }
})});
</script>
	
	
</body>
</html>
{else}
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<meta name="keywords" content="{$KEYWORDS|escape}">
	<meta name="description" content="{$DESCRIPTION|escape}">
	<meta name="viewport" content="width=device-width, height=device-height,
                                   initial-scale=1.0, maximum-scale=1.0,
                                   target-densityDpi=device-dpi">
	<link rel="alternate" type="application/rss+xml" title="[[Jobs]]" href="{$GLOBALS.site_url}/rss/">

	<title>{if $TITLE}{tr}{$TITLE}{/tr|escape} | {/if}{$GLOBALS.settings.site_title}</title>
	[[$HEAD]]
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">	<link href="{$GLOBALS.site_url}/templates/Jobsquare/assets/third-party/jquery-ui.css" rel="stylesheet">
	<link href="{$GLOBALS.site_url}/templates/Jobsquare/vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="{$GLOBALS.site_url}/system/ext/jquery/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">

	<link href="{$GLOBALS.site_url}/templates/Jobsquare/assets/style/styles.css" rel="stylesheet">
	<link href="{$GLOBALS.site_url}/templates/Jobsquare/assets/style/search-jobs.css" rel="stylesheet">


	<style type="text/css">{$GLOBALS.theme_settings.custom_css}</style>

	<!-- Ajout pour nouveau style  Ched  -->


{if $GLOBALS.current_user.group.id == "Employer"}
	<link href="{$GLOBALS.site_url}/templates/Jobsquare/assets/style/jobseeker/jobseeker.css" rel="stylesheet">
		{else}
		<link href="{$GLOBALS.site_url}/templates/Jobsquare/assets/style/jobseeker/resume.css" rel="stylesheet">
			{/if}
		<!-- Ajout pour nouveau style  -->	
		<!-- Ajout pour nouveau style  -->	
		
		
		
	{$GLOBALS.theme_settings.custom_js}
</head>
<body {if $GLOBALS.user_page_uri == '/job-preview/'|| $GLOBALS.user_page_uri == '/registration/'|| $GLOBALS.user_page_uri == '/login/' || $GLOBALS.user_page_uri == '/jobs/'|| $GLOBALS.user_page_uri == '/training/'|| $GLOBALS.user_page_uri == '/add-listing/'  } class="tinyheader head1" {else} class="index" {/if} >
	
{if $GLOBALS.user_page_uri == '/job-preview/' || $GLOBALS.user_page_uri == '/registration/' || $GLOBALS.user_page_uri == '/login/'  || $GLOBALS.user_page_uri == '/jobs/'|| $GLOBALS.user_page_uri == '/training/'|| $GLOBALS.user_page_uri == '/add-listing/' }
  
   {include file="../menu/headerjob.tpl"}
	{else}
	  {include file="../menu/header.tpl"}
	{/if}

	<div id="loading"></div>

	<div class="modal fade" id="message-modal" tabindex="-1" role="dialog" aria-labelledby="message-modal-label">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
					<h4 class="modal-title" id="message-modal-label">Modal title</h4>
				</div>
				<div class="modal-body">

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">[[Close]]</button>
				</div>
			</div>
		</div>
	</div>

	<div class="flash-messages">
		{module name='flash_messages' function='display'}
	</div>

    {if $GLOBALS.user_page_uri == '/categories/' || $GLOBALS.user_page_uri == '/states/'
    || $GLOBALS.user_page_uri == '/countries/' || $GLOBALS.user_page_uri == '/cities/'
    || $GLOBALS.user_page_uri == '/job-preview/' || $GLOBALS.user_page_uri == '/resume-preview/' || $GLOBALS.user_page_uri == '/training-preview/'}
		<div class="page-row page-row-expanded">
			{if $GLOBALS.user_page_uri == '/resume-preview/'}
			<div class="display-item resumepage">
			{else}
			<div class="display-item ">
			{/if}
				{block name='main_content'}
					{$MAIN_CONTENT}
				{/block}
				<div class="clear clearfix"></div>
			</div><div class="clear clearfix"></div>
		</div><div class="clear clearfix"></div>
	{else}
		<div class="page-row page-row-expanded">
			{if $GLOBALS.user_page_uri != '/edit-profile/' && $GLOBALS.user_page_uri != '/my-listings/' && $GLOBALS.user_page_uri != '/blog/'  && $GLOBALS.user_page_uri != '/contact/'
			&& $GLOBALS.user_page_uri != '/login/' && $GLOBALS.user_page_uri != '/registration/' && $GLOBALS.user_page_uri != '/add-listing/' && $GLOBALS.user_page_uri != '/password-recovery/' && $GLOBALS.user_page_uri != '/applications/'}
			<div class="container container--small {if 'banner_right_side'|banner}with-banner{/if} {if $GLOBALS.user_page_uri == '/employer-products/' || $GLOBALS.user_page_uri == '/jobseeker-products/'}with-banner__products{/if}">
			{/if}
				{if 'banner_right_side'|banner}
					<div class="with-banner__wrapper">
				{/if}
				{block name='main_content'}
					{$MAIN_CONTENT}
				{/block}
				{if 'banner_right_side'|banner}
					</div>
                    <div class="banner banner--right">
                        {'banner_right_side'|banner}
                    </div>
				{/if}
			</div>
		</div>
	{/if}
{if $GLOBALS.user_page_uri == '/add-listing/'}
{else}
	{include file="../menu/footer.tpl"}
{/if}
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="{$GLOBALS.site_url}/templates/Jobsquare/assets/third-party/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="{$GLOBALS.site_url}/templates/Jobsquare/vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>

	<script src="{$GLOBALS.site_url}/templates/Jobsquare/assets/third-party/jquery-ui.min.js"></script>

	<script language="JavaScript" type="text/javascript" src="{common_js}/main.js"></script>
	<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/templates/Jobsquare/assets/third-party/jquery.form.min.js"></script>
	<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/system/ext/jquery/jquery.validate.min.js"></script>
	<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/templates/Jobsquare/common_js/autoupload_functions.js"></script>
	<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/system/ext/jquery/imagesize.js"></script>
	<link rel="Stylesheet" type="text/css" href="{$GLOBALS.site_url}/system/ext/jquery/css/jquery.multiselect.css" />
	<script language="JavaScript" type="text/javascript" src="{$GLOBALS.user_site_url}/system/ext/jquery/multilist/jquery.multiselect.min.js"></script>
	<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/templates/Jobsquare/common_js/multilist_functions.js"></script>
	<script>
		document.addEventListener("touchstart", function() { }, false);

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

	<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/system/ext/jquery/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
	{if isset( $GLOBALS.available_datepicker_localizations[$GLOBALS.current_language] )}
		<script type="text/javascript" src="{$GLOBALS.site_url}/system/ext/jquery/bootstrap-datepicker/i18n/bootstrap-datepicker.{$GLOBALS.current_language}.min.js" ></script>
	{/if}

	<script language="javascript" type="text/javascript">

		// Set global javascript value for page
		window.SJB_GlobalSiteUrl = '{$GLOBALS.site_url}';
		window.SJB_UserSiteUrl   = '{$GLOBALS.user_site_url}';

	</script>

	{* load scripts for used indeed *}
	{if $GLOBALS.user_page_uri == '/jobs/'}
		{if $GLOBALS.plugins.IndeedPlugin.active == 1}
			<script type="text/javascript" src="https://gdc.indeed.com/ads/apiresults.js"></script>
		{/if}
	{/if}

	{js}

	<script>
		function message(title, content) {
			var modal = $('#message-modal');
			modal.find('.modal-title').html(title);
			modal.find('.modal-body').html(content);
			modal.modal('show');
		}
	</script>
	<link rel="stylesheet" type="text/css" href="{$GLOBALS.site_url}/templates/Jobsquare/assets/style/cookieconsent.min.css" />
<script src="{$GLOBALS.site_url}/templates/Jobsquare/assets/third-party/cookieconsent.min.js" data-cfasync="false"></script>
<script>
window.addEventListener("load", function(){
window.cookieconsent.initialise({
  "palette": {
    "popup": {
      "background": "#000"
    },
    "button": {
      "background": "#f1d600"
    }
  }
})});
</script>
<script>
window.addEventListener("load", function(){
window.cookieconsent.initialise({
  "palette": {
    "popup": {
      "background": "#413D3C"
    },
    "button": {
      "background": "#eb800e"
    }
  }
})});
</script>
	
	
</body>

</html>
{/if}