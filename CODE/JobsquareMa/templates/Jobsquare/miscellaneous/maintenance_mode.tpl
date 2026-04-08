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
<link href="https://fonts.googleapis.com/css?family=Arsenal:400,700|Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<link href="{$GLOBALS.site_url}/templates/Jobsquare/assets/third-party/jquery-ui.css" rel="stylesheet">
	<link href="{$GLOBALS.site_url}/templates/Jobsquare/vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="{$GLOBALS.site_url}/system/ext/jquery/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">

	<link href="{$GLOBALS.site_url}/templates/Jobsquare/assets/style/styles.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400" rel="stylesheet">
	
	<style type="text/css">{$GLOBALS.theme_settings.custom_css}</style>
	

		<!-- Ajout pour nouveau style  -->	
	{$GLOBALS.theme_settings.custom_js}
</head>



	
<body  class="index homeindex">


<nav class="navbar navbar-default">
	<div class="container container-fluid">
		<div class="logo navbar-header">
			<a class="logo__text navbar-brand" href="{$GLOBALS.site_url}">
				<img src="{$GLOBALS.site_url}/templates/Jobsquare/assets/images/{$GLOBALS.theme_settings.logo|escape:'url'}" alt="Emploi Maroc, Formation Maroc, Travail Maroc" title="Emploi Maroc, Formation Maroc, Travail Maroc"/>
				<span class="slogan">Le portail de l'emploi en Maroc </span>
			</a>
		</div>
	

		<div class="collapse navbar-collapse" id="navbar-collapse">
			<div class="visible-sm visible-xs">
				{capture name='nav_menu'}
					{module name='template_manager' function='navigation_menu'}
				{/capture}
				{$smarty.capture.nav_menu}
						
			</div>
			                
		
	</div>
</nav>
	

		<div class="page-row page-row-expanded">
			
				
				{block name='main_content'}
			<div class="container container-fluid">
			
			<h1> Site en Maintenance</h1><br>
<p>Jobsquare.ma est  le site<strong> Numéro 1 d'emploi en Maroc</strong>, leader sur le marché de <strong> recrutement en ligne, depuis sa création en 2006</strong>. <br>
Proposant des offres d&rsquo;emploi dans toutes les régions et à l&rsquo;étranger, mis à jour quotidiennement. Notre site d'emploi vous offre plus de chances à décrocher le Travail qui correspond le mieux à votre profil.<br>
Jobsquare dédie, par ailleurs, un espace pour les recruteurs qui cherchent des profils performants dans leurs secteurs d&rsquo;activité. .<br>
Jobsquare, le portail Marocn de l&rsquo;emploi, accompagne les candidats comme les recruteurs pour un avenir meilleur&nbsp;!</p>
</div>
				{/block}
				
			</div>
	

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