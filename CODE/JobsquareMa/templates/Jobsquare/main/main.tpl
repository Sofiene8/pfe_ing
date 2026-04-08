<!DOCTYPE html>
<html lang="fr">
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
	<meta property="og:title" content="{if $GLOBALS.settings.home_page_title}{$GLOBALS.settings.home_page_title}{else}{$GLOBALS.settings.site_title}{/if}" />
	<meta property="og:image" content="{$GLOBALS.site_url}/templates/Jobsquare/assets/images/{$GLOBALS.theme_settings.logo|escape:'url'}" />
	
	<link rel="alternate" type="application/rss+xml" title="[[Jobs]]" href="{$GLOBALS.site_url}/rss/">

	<title>{if $GLOBALS.settings.home_page_title}{$GLOBALS.settings.home_page_title}{else}{$GLOBALS.settings.site_title}{/if}</title>
	[[$HEAD]]
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">	<link href="{$GLOBALS.site_url}/templates/Jobsquare/assets/third-party/jquery-ui.css" rel="stylesheet">

	<!-- Bootstrap -->
	<link href="{$GLOBALS.site_url}/templates/Jobsquare/vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

	<link href="{$GLOBALS.site_url}/templates/Jobsquare/assets/third-party/jquery.bxslider.css" rel="stylesheet">
	<link href="{$GLOBALS.site_url}/templates/Jobsquare/assets/style/styles.css" rel="stylesheet">


	
	<style type="text/css">{$GLOBALS.theme_settings.custom_css}</style>
	{$GLOBALS.theme_settings.custom_js}
</head>
<body>
	{include file="../menu/header.tpl"}
	<section class="main-home-slider">
	
	<div class="">
		
	<div class="slide">
   	{module name="banners" function="show_banners" group="Type1"}
		<div class="quick-search__frontpage">
		{$MAIN_CONTENT}
			</div>	
	</div>
	</div>
	
</section>
	{module name="users" function="featured_profiles" items_count="50"}
	<section class="main-sections main-sections__middle-banner middle-banner">
		<div class="container container-fluid text-center middle-banner__wrapper">
			<div class="middle-banner__block--wrapper">
				[[{$GLOBALS.theme_settings.secondary_banner_text}]]
			</div>
		</div>
	</section>
	{module name="classifieds" function="latest_listings" items_count="9" listing_type="Job" group_banner="home_right_2"}
	{module name="classifieds" function="featured_listings_home" items_count="8" listing_type="Job" group_banner="home_right_1"}
	
	<div class="listebycategories test training_home_block">

	{if $GLOBALS.theme_settings.jobs_by_category || $GLOBALS.theme_settings.jobs_by_city || $GLOBALS.theme_settings.jobs_by_state || $GLOBALS.theme_settings.jobs_by_country}
		{assign var="isFirstBrowse" value=true}
		<section class="main-sections">
		{if $GLOBALS.theme_settings.jobs_by_city}
	
		
		
		<div class="location "><div class="container">
	 <h2>Parcourir les offres d'emploi par ville</h2> <div class="line"></div> 
			<div class="row">
			 {module name="classifieds" function="random_states" Type="Job"}
		
		</div>
		<div class="row list_categorie">
			
			{if $GLOBALS.theme_settings.jobs_by_city}
							
								{module name="classifieds" function="browse" columns=3 browseUrl="/cities/" browse_template="browse_by_city.tpl"}
							
							
						{/if}										
		</div>
		
		</div></div>
		{/if}
		{if $GLOBALS.theme_settings.jobs_by_category}

<div class="categories ">
	<div class="container">
	 <h2>Parcourir les offres d'emploi par catégorie</h2> <div class="line"></div>
			<div class="row">
			 {module name="classifieds" function="random_secteurs" Type="Job"}
		</div>
		<div class="row list_categorie">
		

	{module name="classifieds" function="browse" columns=3 browseUrl="/categories/" browse_template="browse_by_category.tpl"}

		
		</div>
</div>

</div>
	{/if}
{if $GLOBALS.theme_settings.jobs_by_state}



<div class="location">
	<div class="container">
	 <h2>Parcourir les offres d'emploi par Région</h2> <div class="line"></div>
			
		<div class="row list_categorie">
		
	     
{if $GLOBALS.theme_settings.jobs_by_state}
								{module name="classifieds" function="browse" columns=3 browseUrl="/states/" browse_template="browse_by_state.tpl"}
						
						{/if}
						


		
		</div>
</div>
</div>
	{/if}
					
		</section>
	{/if}
	<!-- ===== BLOC ALERTE EMAIL ===== -->
	<section class="alert-section">
		<div class="alert-left">
			<h2>Recevez les <span>offres</span> par email</h2>
			<p>Soyez alerté des nouvelles opportunités. Désabonnement en un clic.</p>
		</div>
		<form action="{$GLOBALS.site_url}/guest-alerts/create/" method="post" id="create-alert" class="alert-form">
			<input type="hidden" name="action" value="save" />
			<input type="email" name="email" placeholder="✉  [[Your email]]">
			<select name="email_frequency">
				<option value="daily">[[Daily]]</option>
				<option value="weekly">[[Weekly]]</option>
				<option value="monthly">[[Monthly]]</option>
			</select>
			<input type="submit" name="save" value="[[Create alert]]" class="alert-btn" onclick="return createAlert();">
		</form>
	</section></div>

	<!-- ===== BLOC SEO ===== -->
	<section class="seo-section">
		<div class="seo-header">
			<h2><span>Jobsquare.ma</span> — Le Portail N°1 de l'Emploi au Maroc</h2>
			<p>Trouvez le poste qui vous correspond, partout au Maroc</p>
		</div>

		<div class="seo-grid">
			<div class="seo-card">
				<h3><span class="icon">🔍</span> Des opportunités dans tous les secteurs</h3>
				<p>Industrie automobile à Tanger, finance à Casablanca, technologies à Rabat, tourisme à Marrakech et Agadir, agroalimentaire dans le Souss, artisanat à Fès... Jobsquare.ma vous donne un <a href="{$GLOBALS.site_url}/jobs/">accès direct aux meilleures offres d'emploi au Maroc</a>.</p>
			</div>

			<div class="seo-card">
				<h3><span class="icon">📄</span> Boostez votre candidature</h3>
				<p>Créez et <a href="{$GLOBALS.site_url}/my-listings/resume/">optimisez votre CV en ligne</a> en quelques minutes. Activez les alertes emploi, postulez en un clic. Plus votre profil est complet, plus vous êtes visible auprès des recruteurs.</p>
			</div>

			<div class="seo-card">
				<h3><span class="icon">🏢</span> Employeurs : recrutez les meilleurs profils</h3>
				<p>Publiez vos offres et accédez à une base de candidats qualifiés couvrant les 12 régions du Maroc. Que vous soyez une startup à Rabat ou une PME industrielle à Tanger, notre plateforme vous connecte aux talents.</p>
			</div>

			<div class="seo-card">
				<h3><span class="icon">🎓</span> Jeunes diplômés et stages PFE</h3>
				<p>Jobsquare.ma accompagne les étudiants et jeunes diplômés dans leur insertion professionnelle. Retrouvez des stages PFE, contrats ANAPEC et premiers emplois dans tous les secteurs.</p>
			</div>
		</div>

		<div class="seo-cta">
			<p><strong>Rejoignez Jobsquare.ma</strong> — Casablanca, Rabat, Tanger, Marrakech, Fès, Agadir, Meknès, Oujda et toutes les régions du Royaume.</p>
			<a href="{$GLOBALS.site_url}/registration/">S'inscrire gratuitement</a>
		</div>
	</section>
	
	
	{include file="../menu/footer.tpl"}

	<script src="{$GLOBALS.site_url}/templates/Jobsquare/assets/third-party/jquery.min.js"></script>
	<script src="{$GLOBALS.site_url}/templates/Jobsquare/vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="{$GLOBALS.site_url}/templates/Jobsquare/assets/third-party/jquery.bxslider.min.js"></script>

	<script language="JavaScript" type="text/javascript" src="{common_js}/main.js"></script>
	<script language="JavaScript" type="text/javascript" src="{common_js}/multilist_functions.js"></script>
	<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/templates/Jobsquare/assets/third-party/jquery.form.min.js"></script>
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
	{literal}
	<style>
	/*.quick-search__wrapper {
 
    background: #166bd9!important;
  
    border-color: #166bd9!important;
}
*/

.main-home-slider { padding:0px 0px 0px; background:#f9f9f9}

.featured-companies .bx-wrapper .bx-viewport {
    /*height: 190px !important;*/
}
.logo .logo__text img {
    display: inline-block;
    max-width: 100%;
    max-height: 65px;
}



@media (min-width: 992px)
{
	.logo {

    padding-bottom: 5px;
}

}




.listing__latest .listing__title {
    color: #777777;
    font-size: 32px;
    font-weight: 400;
}

.well.listing-item__jobs:hover {
    border: 1px solid  #009688; box-shadow:none 
}
.listing__featured-training .well.listing-item__jobs:hover, .listing__latest-training .well.listing-item__jobs:hover {
    border: 1px solid #b72f9a; box-shadow:none 
}
.listing__featured-training .featured-companies__title {
   
    color: #b72f9a;
   
    color: #b72f9a;
    
}

.logo {
    margin-right: 45px !important;
    padding-top: 0px;
}
.navbar .navbar-right .signup_btn, .navbar .navbar-right .logout_btn, .navbar .navbar-right .navbar__item:first-child .navbar__link.logout_btn { font-size:15px}

.listing-item__desc {
    color: #202020;
    font-weight: 400;
}

.training_home_block .featured-companies__title {
 
    color: #bc2f9a;
 
    color: #bc2f9a;
   
}

.training_home_block .featured-companies__slider--prev, .training_home_block .featured-companies__slider--next {
  
    background-color: #bc2f9a;
}


.listing__featured .listing__title , .listing .listing__title{

    text-align: left;
	margin-bottom: 16px;
    font-weight: 400;
    font-size: 22px;
    color: #333;
}

section.main-sections.listing__latest-training {
    padding: 20px 0px 50px;
    
}

.listebycategories.test.training_home_block {
    /*background-color: rgb(188 47 154 / 3%);*/
}
</style>
	{/literal}
</body>
</html>