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
<link href="https://fonts.googleapis.com/css?family=Arsenal:400,700|Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<link href="{$GLOBALS.site_url}/templates/Jobsquare/assets/third-party/jquery-ui.css" rel="stylesheet">

	<!-- Bootstrap -->
	<link href="{$GLOBALS.site_url}/templates/Jobsquare/vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

	<link href="{$GLOBALS.site_url}/templates/Jobsquare/assets/third-party/jquery.bxslider.css" rel="stylesheet">
	<link href="{$GLOBALS.site_url}/templates/Jobsquare/assets/style/styles.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400" rel="stylesheet">
	
	<style type="text/css">{$GLOBALS.theme_settings.custom_css}</style>
	{$GLOBALS.theme_settings.custom_js}
</head>
<body>
	{include file="../menu/header.tpl"}
	<section class="main-home-slider">
	<div class="container">
	<div class="slide">
   	{module name="banners" function="show_banners" group="Type1"}
			<div class="container text-center">
				
			</div>
	
	</div>
	</div>
	
	<div class="quick-search__frontpage">
		{$MAIN_CONTENT}
	</div></section>
	{module name="users" function="featured_profiles" items_count="20"}
	<section class="main-sections main-sections__middle-banner middle-banner">
		<div class="container container-fluid text-center middle-banner__wrapper">
			<div class="middle-banner__block--wrapper">
				[[{$GLOBALS.theme_settings.secondary_banner_text}]]
			</div>
		</div>
	</section>
	{module name="classifieds" function="latest_listings" items_count="5" listing_type="Job" group_banner="home_right_2"}
	{module name="classifieds" function="featured_listings_home" items_count="8" listing_type="Job" group_banner="home_right_1"}
	
	<div class="listebycategories test training_home_block">
    {module name="users" function="featured_profiles" items_count="20" template="featured_trainings_profiles.tpl" listingType="Training"}
    {module name="classifieds" function="featured_listings_home" items_count="8" listing_type="Training" group_banner="home_right_1"}
    {module name="classifieds" function="latest_listings" items_count="6" listing_type="Training" group_banner="home_right_2"}
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
			
						
								<ul class="list-unstyled browse-by__list">
									<li>
				<a href="https://www.jobsquare.ma/cities/jobs-in-tunis/">
					<span class="browse-by__item">Emploi à Tunis</span>
					
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/cities/jobs-in-sousse/">
					<span class="browse-by__item">Emploi à Sousse</span>
					
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/cities/jobs-in-sfax/">
					<span class="browse-by__item">Emploi à Sfax</span>
					
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/cities/jobs-in-centre-urbain-nord/">
					<span class="browse-by__item">Emploi à Centre Urbain Nord</span>
					
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/cities/jobs-in-les-berges-du-lac/">
					<span class="browse-by__item">Emploi à Les Berges du Lac</span>
					
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/cities/jobs-in-ariana/">
					<span class="browse-by__item">Emploi à Ariana</span>
					
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/cities/jobs-in-montplaisir/">
					<span class="browse-by__item">Emploi à Montplaisir</span>
					
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/cities/jobs-in-la-charguia-ii/">
					<span class="browse-by__item">Emploi à La Charguia II</span>
					
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/cities/jobs-in-les-berges-du-lac-ii/">
					<span class="browse-by__item">Emploi à Les Berges Du Lac II</span>
					
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/cities/jobs-in-charguia/">
					<span class="browse-by__item">Emploi à Charguia</span>
					
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/cities/jobs-in-nabeul%E2%80%8E/">
					<span class="browse-by__item">Emploi à Nabeul‎</span>
					
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/cities/jobs-in-le-kram/">
					<span class="browse-by__item">Emploi à Le Kram</span>
					 
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/cities/jobs-in-monastir/">
					<span class="browse-by__item">Emploi à Monastir</span>
					 
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/cities/jobs-in-la-soukra/">
					<span class="browse-by__item">Emploi à La Soukra</span>
					 
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/cities/jobs-in-ben-arous/">
					<span class="browse-by__item">Emploi à Ben Arous</span>
					 
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/cities/jobs-in-sahloul/">
					<span class="browse-by__item">Emploi à Sahloul</span>
					
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/cities/jobs-in-megrine/">
					<span class="browse-by__item">Emploi à Megrine</span>
					 
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/cities/jobs-in-manouba/">
					<span class="browse-by__item">Emploi à Manouba</span>
					
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/cities/jobs-in-zone-industrielle-el-mghira/">
					<span class="browse-by__item">Emploi à Zone Industrielle El Mghira</span>
					
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/cities/jobs-in-bizerte/">
					<span class="browse-by__item">Emploi à Bizerte</span>
					
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/cities/jobs-in-la-marsa/">
					<span class="browse-by__item">Emploi à La Marsa</span>
					
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/cities/jobs-in-lafayette/">
					<span class="browse-by__item">Emploi à Lafayette</span>
					
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/cities/jobs-in-el-menzah/">
					<span class="browse-by__item">Emploi à El Menzah</span>
					
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/cities/jobs-in-ennasr-2/">
					<span class="browse-by__item">Emploi à Ennasr 2</span>
					
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/cities/jobs-in-ennasr/">
					<span class="browse-by__item">Emploi à Ennasr</span>
				
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/cities/jobs-in-el-menzah-4/">
					<span class="browse-by__item">Emploi à El Menzah 4</span>
					
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/cities/jobs-in-hammamet/">
					<span class="browse-by__item">Emploi à Hammamet</span>
					
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/cities/jobs-in-soliman/">
					<span class="browse-by__item">Emploi à Soliman</span>
					
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/cities/jobs-in-ezzahra/">
					<span class="browse-by__item">Emploi à Ezzahra</span>
					
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/cities/jobs-in-hammam-sousse/">
					<span class="browse-by__item">Emploi à Hammam Sousse</span>
					
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/cities/jobs-in-technopole-el-ghazala/">
					<span class="browse-by__item">Emploi à Technopole  El Ghazala</span>
					
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/cities/jobs-in-el-agba/">
					<span class="browse-by__item">Emploi à El Agba</span>
					
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/cities/jobs-in-el-mourouj/">
					<span class="browse-by__item">Emploi à El Mourouj</span>
					
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/cities/jobs-in-gabes/">
					<span class="browse-by__item">Emploi à Gabes</span>
					
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/cities/jobs-in-grombalia/">
					<span class="browse-by__item">Emploi à Grombalia</span>
					
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/cities/jobs-in-mahdia/">
					<span class="browse-by__item">Emploi à Mahdia</span>
					
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/cities/jobs-in-bardo/">
					<span class="browse-by__item">Emploi à Bardo</span>
				
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/cities/jobs-in-el-menzah-9/">
					<span class="browse-by__item">Emploi à El Menzah 9</span>
					
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/cities/jobs-in-akouda/">
					<span class="browse-by__item">Emploi à Akouda</span>
					
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/cities/jobs-in-bouhjar/">
					<span class="browse-by__item">Emploi à Bouhjar</span>
				
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/cities/jobs-in-el-ghazala/">
					<span class="browse-by__item">Emploi à El Ghazala</span>
					
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/cities/jobs-in-msaken/">
					<span class="browse-by__item">Emploi à Msaken</span>
					
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/cities/jobs-in-cit%C3%A9-el-khadra/">
					<span class="browse-by__item">Emploi à Cité El Khadra</span>
				
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/cities/jobs-in-fouchana/">
					<span class="browse-by__item">Emploi à Fouchana</span>
				
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/cities/jobs-in-moknine/">
					<span class="browse-by__item">Emploi à Moknine</span>
					
				</a>
			</li>
			</ul>

							
													
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
		

							
								<ul class="list-unstyled browse-by__list">
									<li>
				<a href="https://www.jobsquare.ma/categories/705/informatique-jobs/">
					<span class="browse-by__item">Emploi Informatique</span>
					
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/categories/706/centres-d-appels-jobs/">
					<span class="browse-by__item">Emploi Centres d'appels</span>
					
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/categories/708/commerce-jobs/">
					<span class="browse-by__item">Emploi Commerce</span>
					
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/categories/707/ingenierie-jobs/">
					<span class="browse-by__item">Emploi Ingenierie</span>
					
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/categories/378/industrie-jobs/">
					<span class="browse-by__item">Emploi Industrie</span>
					
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/categories/709/marketing-jobs/">
					<span class="browse-by__item">Emploi Marketing</span>
					
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/categories/727/administration-jobs/">
					<span class="browse-by__item">Emploi Administration</span>
					
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/categories/759/comptabilité-jobs/">
					<span class="browse-by__item">Emploi Comptabilité</span>
					
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/categories/381/technologie-de-l-information-jobs/">
					<span class="browse-by__item">Emploi Technologie de l'inf...</span>
					
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/categories/386/design-jobs/">
					<span class="browse-by__item">Emploi Design</span>
					
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/categories/711/vente-jobs/">
					<span class="browse-by__item">Emploi Vente</span>
					
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/categories/718/gestion-jobs/">
					<span class="browse-by__item">Emploi Gestion</span>
					
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/categories/710/télécommunications-jobs/">
					<span class="browse-by__item">Emploi Télécommunications</span>
					
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/categories/387/finance-jobs/">
					<span class="browse-by__item">Emploi Finance</span>
					
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/categories/717/services-a-la-clientele-jobs/">
					<span class="browse-by__item">Emploi Services a la clientele</span>
				
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/categories/374/formation-jobs/">
					<span class="browse-by__item">Emploi Formation</span>
				
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/categories/383/automobile-jobs/">
					<span class="browse-by__item">Emploi Automobile</span>
				
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/categories/724/consulting-jobs/">
					<span class="browse-by__item">Emploi Consulting</span>
				
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/categories/969/electronique-jobs/">
					<span class="browse-by__item">Emploi Electronique</span>
				
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/categories/722/enseignement-jobs/">
					<span class="browse-by__item">Emploi Enseignement</span>
				
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/categories/968/mécanique-jobs/">
					<span class="browse-by__item">Emploi Mécanique</span>
					
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/categories/725/construction-jobs/">
					<span class="browse-by__item">Emploi Construction</span>
				
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/categories/375/achat-approvisionnement-jobs/">
					<span class="browse-by__item">Emploi Achat - Approvisionnement</span>
				
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/categories/385/developpement-des-affaires-jobs/">
					<span class="browse-by__item">Emploi Developpement des affaires</span>
				
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/categories/391/ressources-humaines-jobs/">
					<span class="browse-by__item">Emploi Ressources humaines</span>
				
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/categories/720/sante-jobs/">
					<span class="browse-by__item">Emploi Sante</span>
				
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/categories/966/electricité-jobs/">
					<span class="browse-by__item">Emploi Electricité</span>
				
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/categories/394/immobilier-jobs/">
					<span class="browse-by__item">Emploi Immobilier</span>
				
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/categories/976/agroalimentaire-jobs/">
					<span class="browse-by__item">Emploi Agroalimentaire</span>
					
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/categories/713/commerce-de-détail-jobs/">
					<span class="browse-by__item">Emploi Commerce de détail</span>
				
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/categories/716/pharmaceutiques-jobs/">
					<span class="browse-by__item">Emploi Pharmaceutiques</span>
				
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/categories/355/transport-jobs/">
					<span class="browse-by__item">Emploi Transport</span>
				
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/categories/719/installation-entretien-reparation-jobs/">
					<span class="browse-by__item">Emploi Installation-Entretien-Re...</span>
				
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/categories/723/distribution-jobs/">
					<span class="browse-by__item">Emploi Distribution</span>
				
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/categories/918/hôtellerie-et-tourisme-jobs/">
					<span class="browse-by__item">Emploi Hôtellerie et Tourisme</span>
				
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/categories/395/assurances-jobs/">
					<span class="browse-by__item">Emploi Assurances</span>
				
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/categories/1024/architecture-d-intérieur-jobs/">
					<span class="browse-by__item">Emploi Architecture  d’intérieur</span>
				
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/categories/977/stage-jobs/">
					<span class="browse-by__item">Emploi Stage</span>
				
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/categories/975/textile-jobs/">
					<span class="browse-by__item">Emploi Textile</span>
				
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/categories/715/controle-qualite-jobs/">
					<span class="browse-by__item">Emploi Controle Qualite</span>
				
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/categories/983/constrution-métallique-jobs/">
					<span class="browse-by__item">Emploi Constrution métallique</span>
				
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/categories/384/banque-jobs/">
					<span class="browse-by__item">Emploi Banque</span>
				
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/categories/972/mécatronique-jobs/">
					<span class="browse-by__item">Emploi Mécatronique</span>
				
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/categories/712/stratégie-planification-jobs/">
					<span class="browse-by__item">Emploi Stratégie-Planification</span>
				
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/categories/393/media-journalisme-jobs/">
					<span class="browse-by__item">Emploi Media-Journalisme</span>
				
				</a>
			</li>
																																																				</ul>
							
												
						


		
		</div>
</div>

</div>
	{/if}
{if $GLOBALS.theme_settings.jobs_by_state}



<div class="location">
	<div class="container">
	 <h2>Parcourir les offres d'emploi par Région</h2> <div class="line"></div>
			
		<div class="row list_categorie">
		
	     
						
								<ul class="list-unstyled browse-by__list">
									<li>
				<a href="https://www.jobsquare.ma/states/jobs-in-tunis/">
					<span class="browse-by__item">Emploi Tunis</span>
				
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/states/jobs-in-sousse/">
					<span class="browse-by__item">Emploi Sousse</span>
					
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/states/jobs-in-ariana/">
					<span class="browse-by__item">Emploi Ariana</span>
					
				</a>
			</li>
										
											<li>
				<a href="https://www.jobsquare.ma/states/jobs-in-sfax/">
					<span class="browse-by__item">Emploi Sfax</span>
				
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/states/jobs-in-monastir/">
					<span class="browse-by__item">Emploi Monastir</span>
				
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/states/jobs-in-nabeul/">
					<span class="browse-by__item">Emploi Nabeul</span>
				
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/states/jobs-in-bizerte/">
					<span class="browse-by__item">Emploi Bizerte</span>
				
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/states/jobs-in-manouba/">
					<span class="browse-by__item">Emploi Manouba</span>
				
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/states/jobs-in-fouchana/">
					<span class="browse-by__item">Emploi Fouchana</span>
				
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/states/jobs-in-mahdia/">
					<span class="browse-by__item">Emploi Mahdia</span>
				
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/states/jobs-in-zaghouan/">
					<span class="browse-by__item">Emploi Zaghouan</span>
				
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/states/jobs-in-m%C3%A9denine/">
					<span class="browse-by__item">Emploi Médenine</span>
			
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/states/jobs-in-hammamet/">
					<span class="browse-by__item">Emploi Hammamet</span>
				
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/states/jobs-in-gab%C3%A8s/">
					<span class="browse-by__item">Emploi Gabès</span>
				
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/states/jobs-in-kairouan/">
					<span class="browse-by__item">Emploi Kairouan</span>
				
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/states/jobs-in-b%C3%A9ja/">
					<span class="browse-by__item">Emploi Béja</span>
			
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/states/jobs-in-paris/">
					<span class="browse-by__item">Emploi Paris</span>
				
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/states/jobs-in-qu%C3%A9bec/">
					<span class="browse-by__item">Emploi Québec</span>
				
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/states/jobs-in-bruxelles/">
					<span class="browse-by__item">Emploi Bruxelles</span>
				
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/states/jobs-in-hammem-sousse/">
					<span class="browse-by__item">Emploi Hammem Sousse</span>
				
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/states/jobs-in-jendouba/">
					<span class="browse-by__item">Emploi Jendouba</span>
				
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/states/jobs-in-la-manouba/">
					<span class="browse-by__item">Emploi La Manouba</span>
			
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/states/jobs-in-tozeur/">
					<span class="browse-by__item">Emploi Tozeur</span>
				
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/states/jobs-in-alg%C3%A9rie/">
					<span class="browse-by__item">Emploi Algérie</span>
				
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/states/jobs-in-djerba-midoun/">
					<span class="browse-by__item">Emploi Djerba Midoun</span>
			
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/states/jobs-in-gouvernorat%20de%20l%27ariana/">
					<span class="browse-by__item">Emploi Gouvernorat de l'Ariana</span>
			
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/states/jobs-in-gouvernorat-de-sousse/">
					<span class="browse-by__item">Emploi Gouvernorat de Sousse</span>
				
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/states/jobs-in-gouvernorat-de-tunis/">
					<span class="browse-by__item">Emploi Gouvernorat de Tunis</span>
				
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/states/jobs-in-la-marsa/">
					<span class="browse-by__item">Emploi La Marsa</span>
				
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/states/jobs-in-midoun/">
					<span class="browse-by__item">Emploi Midoun</span>
				
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/states/jobs-in-sahline/">
					<span class="browse-by__item">Emploi Sahline</span>
				
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/states/jobs-in-siliana/">
					<span class="browse-by__item">Emploi Siliana</span>
				
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/states/jobs-in-skikda/">
					<span class="browse-by__item">Emploi Skikda</span>
					
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/states/jobs-in-soukra/">
					<span class="browse-by__item">Emploi Soukra</span>
					
				</a>
			</li>
											<li>
				<a href="https://www.jobsquare.ma/states/jobs-in-tataouine/">
					<span class="browse-by__item">Emploi Tataouine</span>
				
				</a>
			</li>
			</ul>

						
												
			
						


		
		</div>
</div>
</div>
	{/if}
					
		</section>
	{/if}
	<section class="main-sections main-sections__alert alert">
		<div class="container container-fluid">
			<div class="alert__block subscribe__description">
				[[{$GLOBALS.theme_settings.bottom_section_html}]]
			</div>
			<div class="alert__block alert__block-form">
				<form action="{$GLOBALS.site_url}/guest-alerts/create/" method="post" id="create-alert" class="well alert__form">
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
		
	</section></div>
	<section class="main-sections description-site">
 <div class="container container-fluid">
  <p>Jobsquare.ma  est  le premier site <strong>d'emploi au Maroc</strong>, leader sur le marché de <strong> recrutement en ligne, depuis sa création en 2006</strong>. <br>
   Proposant des offres d&rsquo;emploi dans toutes les régions et à l&rsquo;étranger, mis à  jour quotidiennement. Notre site d'emploi vous offre plus de chances à  décrocher le Travail qui correspond le mieux à votre profil.  Mettez à jours votre Cv en ligne, <a href="https://www.jobsquare.ma/jobs/">chercher un Travail</a>, c'est aussi bien<a href="https://www.jobsquare.ma/my-listings/resume/"> rédiger votre CV</a>,   mettre en avant votre expérience et vos atouts.<br>
   Si vous êtes à  la recherche d&rsquo;un <strong>travail</strong> dans l&rsquo;une des régions du <strong>Maroc</strong> ou  ailleurs, Jobsquare.ma  vous propose, en permanence, des annonces d'emploi pour des postes vacants  dans votre domaine d&rsquo;activité. Les <a href="https://www.jobsquare.ma/categories/705/informatique-jobs/">entreprises informatique</a> au Maroc ou  Offshore , les <strong><a href="https://www.jobsquare.ma/categories/706/centres-d-appels-jobs/">centres d&rsquo;appels</a></strong>  et les <strong>bureaux et cabinets de recrutement  et d'intérim sont les  <a href="https://www.jobsquare.ma/companies/">recruteurs</a> les  plus actifs  sur le site</strong>.<br>
   Jobsquare dédie,  par ailleurs, un espace pour les recruteurs qui cherchent des profils performants  dans leurs secteurs d&rsquo;activité. Vous trouverez aussi des<a href="https://www.jobsquare.ma/trainings"> <strong>annonces de  formations au Maroc</strong></a>.<br>
   Jobsquare, le  portail marocain de l&rsquo;emploi, accompagne les candidats comme les recruteurs  pour un avenir meilleur&nbsp;!</p>
   </div>
 </section>
	
	
	{include file="../menu/footer.tpl"}

	<script src="{$GLOBALS.site_url}/templates/Jobsquare/assets/third-party/jquery.min.js"></script>
	<script src="{$GLOBALS.site_url}/templates/Jobsquare/vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="{$GLOBALS.site_url}/templates/Jobsquare/assets/third-party/jquery.bxslider.min.js"></script>

	<script language="JavaScript" type="text/javascript" src="{common_js}/main.js"></script>
	<script language="JavaScript" type="text/javascript" src="{common_js}/multilist_functions.js"></script>
	<script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/templates/Jobsquare/assets/third-party/jquery.form.min.js"></script>
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
	{literal}
	<style>
	/*.quick-search__wrapper {
 
    background: #166bd9!important;
  
    border-color: #166bd9!important;
}
*/

.main-home-slider { padding:10px 0px 0px; background:#f9f9f9}

.featured-companies .bx-wrapper .bx-viewport {
    height: 190px !important;
}
.logo .logo__text img {
    display: inline-block;
    max-width: 100%;
    max-height: 65px;
}


.slogan {
    color: #6e6c6e;
    font-size: 14px;
    font-weight: 400;
    left: 34px;
    letter-spacing: 0;
    position: absolute;
    top: 42px;
    visibility: visible;
    text-transform: none;
    line-height: 24px;
    text-transform: none;
    white-space: nowrap;
    letter-spacing: -0.3px;
}

@media (min-width: 992px)
{
	.logo {

    padding-bottom: 5px;
}

}


.navbar .navbar-right {
    margin-top: -5px;
    padding: 0;
    margin-right: 0;
}

.navbar .container-fluid {
   
    margin-top: 20px;
}


.listing__latest .listing__title {
    color: #777777;
    font-size: 32px;
    font-weight: 400;
}
.well.listing-item__jobs {
    border: 1px solid #c1bfbf;  
}
.well.listing-item__jobs:hover {
    border: 1px solid #2bade7; box-shadow:none 
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
    font-weight: lighter;
    font-size: 30px;
    color: #4D6182;
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