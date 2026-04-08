
<nav class="navbar navbar-default">
	<div class="container container-fluid">
		<div class="logo navbar-header">
			<a class="logo__text navbar-brand" href="{$GLOBALS.site_url}">
				<img src="{$GLOBALS.site_url}/templates/Jobsquare/assets/images/{$GLOBALS.theme_settings.logo|escape:'url'}" alt="Emploi Maroc, Formation Maroc, Travail Maroc" title="Emploi Maroc, Formation Maroc, Travail Maroc"/>
				<span class="slogan">Le portail de l'emploi au Maroc </span>
			</a>
		</div>
	{if $GLOBALS.user_page_uri != '/job-preview/' && $GLOBALS.user_page_uri != '/my-job-details/' && $GLOBALS.user_page_uri != '/login/' && $GLOBALS.user_page_uri != '/registration/' && $GLOBALS.user_page_uri != '/job/' && $GLOBALS.user_page_uri != '/jobs/' && $GLOBALS.user_page_uri != '/training/' && $GLOBALS.user_page_uri != '/system/applications/view/' && $GLOBALS.user_page_uri != '/resumes/'}
	<div class="banner banner--top">
		{module name="banners" function="show_banners" group="Top_Site"}
	</div>
	{/if}
		<div class="burger-button__wrapper burger-button__wrapper__js visible-sm visible-xs"
			 data-target="#navbar-collapse" data-toggle="collapse">
			<div class="burger-button"></div>
		</div>
		<div class="collapse navbar-collapse" id="navbar-collapse">
			<div class="visible-sm visible-xs">
				{capture name='nav_menu'}
					{module name='template_manager' function='navigation_menu'}
				{/capture}
				{$smarty.capture.nav_menu}
			</div>
			<ul class="nav navbar-nav navbar-right">
				{if $GLOBALS.current_user.logged_in}
					<li class="navbar__item"><a class="navbar__link logout_btn" href="{$GLOBALS.site_url}/logout/"> [[Logout]]</a></li>
					<li class="navbar__item navbar__item__filled">
						{if $GLOBALS.current_user.group.id == "Employer"}
							<a class="navbar__link btn__blue signup_btn" href="{$GLOBALS.site_url}/my-listings/job/">[[My Account]]</a>
						{else}
							<a class="navbar__link btn__blue signup_btn" href="{$GLOBALS.site_url}/my-listings/resume/">[[My Account]]</a>
						{/if}
					</li>
				{else}
					<li class="navbar__item navbar__item {if $url == '/login/'}active{/if}">
						<a class="navbar__link navbar__login login_btn" href="{$GLOBALS.site_url}/login/">[[Sign in]]</a>
					</li>
					<li class="navbar__item navbar__item__filled "><a class="navbar__link  btn__blue signup_btn" href="{$GLOBALS.site_url}/registration/?user_group_id=Employer">Employeur?</a></li>
				{/if}
			</ul>
		</div>
	</div>
</nav>
<nav class="menu-bar hidden-xs hidden-sm">
	<a href="{$GLOBALS.site_url}/jobs/" class="menu-link{if $GLOBALS.user_page_uri == '/jobs/' || $GLOBALS.user_page_uri == '/job/'} active{/if}">Offres d'emploi</a>
	<a href="{$GLOBALS.site_url}/trainings/" class="menu-link{if $GLOBALS.user_page_uri == '/trainings/' || $GLOBALS.user_page_uri == '/training/'} active{/if}">Formations</a>
	<a href="{$GLOBALS.site_url}/companies/" class="menu-link{if $GLOBALS.user_page_uri == '/companies/'} active{/if}">Entreprises</a>
	<div class="menu-dropdown">
		<a href="#" class="menu-link">Emploi par métier <span class="arrow">&#9662;</span></a>
		<ul class="menu-dropdown-content">
			<li><a href="{$GLOBALS.site_url}/categories/2021/informatique-technologies-jobs/">Emploi Informatique</a></li>
			<li><a href="{$GLOBALS.site_url}/categories/2008/centres-d-appels-relation-client-jobs/">Emploi Centres d'appels</a></li>
			<li><a href="{$GLOBALS.site_url}/categories/2022/ingenierie-technique-jobs/">Emploi Ingénierie</a></li>
			<li><a href="{$GLOBALS.site_url}/categories/2009/commerce-vente-jobs/">Emploi Commerce</a></li>
			<li><a href="{$GLOBALS.site_url}/categories/2023/marketing-communication-jobs/">Emploi Marketing</a></li>
			<li><a href="{$GLOBALS.site_url}/categories/2006/banque-finance-jobs/">Emploi Finance</a></li>
			<li><a href="{$GLOBALS.site_url}/categories/2010/comptabilite-audit-jobs/">Emploi Comptabilité</a></li>
			<li><a href="{$GLOBALS.site_url}/categories/2002/administration-secretariat-jobs/">Emploi Administration</a></li>
			<li><a href="{$GLOBALS.site_url}/categories/2018/hotellerie-tourisme-jobs/">Emploi Hôtellerie et Tourisme</a></li>
			<li><a href="{$GLOBALS.site_url}/categories/2026/ressources-humaines-jobs/">Emploi Ressources humaines</a></li>
			<li><a href="{$GLOBALS.site_url}/categories/2005/automobile-aeronautique-jobs/">Emploi Automobile</a></li>
			<li><a href="{$GLOBALS.site_url}/categories/2019/immobilier-jobs/">Emploi Immobilier</a></li>
			<li><a href="{$GLOBALS.site_url}/categories/2020/industrie-production-jobs/">Emploi Industrie</a></li>
			<li><a href="{$GLOBALS.site_url}/categories/2007/btp-construction-jobs/">Emploi BTP</a></li>
			<li><a href="{$GLOBALS.site_url}/categories/2013/distribution-logistique-jobs/">Emploi Logistique</a></li>
		</ul>
	</div>
	<div class="menu-dropdown">
		<a href="#" class="menu-link">Emploi par Ville <span class="arrow">&#9662;</span></a>
		<ul class="menu-dropdown-content">
			<li><a href="{$GLOBALS.site_url}/regions/emploi-casablanca-settat/">Emploi à Casablanca</a></li>
			<li><a href="{$GLOBALS.site_url}/regions/emploi-rabat-sale-kenitra/">Emploi à Rabat</a></li>
			<li><a href="{$GLOBALS.site_url}/regions/emploi-tanger-tetouan/">Emploi à Tanger</a></li>
			<li><a href="{$GLOBALS.site_url}/regions/emploi-marrakech-safi/">Emploi à Marrakech</a></li>
			<li><a href="{$GLOBALS.site_url}/regions/emploi-fes-meknes/">Emploi à Fès</a></li>
			<li><a href="{$GLOBALS.site_url}/regions/emploi-souss-massa/">Emploi à Agadir</a></li>
			<li><a href="{$GLOBALS.site_url}/regions/emploi-oriental/">Emploi à Oujda</a></li>
			<li><a href="{$GLOBALS.site_url}/regions/emploi-beni-mellal-khenifra/">Emploi à Béni Mellal</a></li>
			<li><a href="{$GLOBALS.site_url}/regions/emploi-draa-tafilalet/">Emploi à Ouarzazate</a></li>
			<li><a href="{$GLOBALS.site_url}/regions/emploi-laayoune-sakia/">Emploi à Laâyoune</a></li>
			<li><a href="{$GLOBALS.site_url}/regions/emploi-dakhla-oued-ed-dahab/">Emploi à Dakhla</a></li>
		</ul>
	</div>
	<a href="{$GLOBALS.site_url}/blog/" class="menu-link{if $GLOBALS.user_page_uri == '/blog/'} active{/if}">Blog</a>
	<a href="{$GLOBALS.site_url}/contact/" class="menu-link{if $GLOBALS.user_page_uri == '/contact/'} active{/if}">Contact</a>
</nav>