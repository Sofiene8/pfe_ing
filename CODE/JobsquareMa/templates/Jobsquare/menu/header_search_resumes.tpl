{literal}<style>
.tinyheader.page-resume #ajax-refine-search {
    color: #353535;
    font-family: "Open Sans",Helvetica,Verdana,sans-serif;
    background: #f3f3f3;
    border: 1px solid #d2d2d2;
    padding: 0px;
    display: block;
    width: 100%; margin-top:-5px
}
.tinyheader.page-resume .refine-search__block {
    margin-bottom: 25px;
   /* width: 300px;*/
    float: left;
}


.refine-search .btn__refine-search select,  .refine-search .btn__refine-search input {
    color: #9f9b9b;
    height: 39px;
    border: 1px solid #bdc9da;
	border-radius:3px
}

.tinyheader.page-resume .col-sm-9 {
    width: 100%;
}

.tinyheader.page-resume .logo .logo__text img {
    display: inline-block;
    max-width: 166px;
    /* max-height: 100%; */
}

.tinyheader.page-resume .container {
   max-width: calc(100% - 20px);
    margin-top: 5px;
}


.tinyheader.page-resume .page-row-expanded {
    height: 100%;
    background: #ffffff;
}

.tinyheader.page-resume  .topcvtheque {

background: transparent;     height: auto;}


.tinyheader.page-resume  .search-header { display:none}

.tinyheader.page-resume   .refine-search__wrapper {
    min-height: auto;
    padding-top: 10px;
    background: transparent;
    padding: 0;
    margin-top: 0;
}

.tinyheader.page-resume    .refine-search .btn__refine-search {
    color: #9f9b9b;
    width: 250px;
    border: 1px solid #bdc9da;
    border-radius: 3px;
    /* line-height: 35px; */
    padding: 5px;
}
.tinyheader.page-resume    .refine-search a.btn__refine-search {
border: none;
    margin-bottom: 0;
    color: #313131;
    font-size: 14px;
    visibility: hidden;
    display: none;
}


.tinyheader.page-resume    .refine-search .btn__refine-search[aria-expanded="true"]:before {
    border-width: 0;
    border-color: transparent;
    min-width: 1px;
    margin: 0;
 
}


.tinyheader.page-resume   .quick-search__inner-pages {
   background: #f0f2f5;
    box-shadow: inset 0px 3px 4px rgb(0 0 0 / 10%);
}


.tinyheader.page-resume   .quick-search__wrapper {
    margin: 10px 0px;
    background: transparent;
    padding: 16px;
    box-shadow: none!important;
    max-width: 100%;
    border-color: transparent;
}


.tinyheader.page-resume .col-sm-9 {
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    float: none; clear: both;
}

.tinyheader.page-resume #resume_filter{
    max-width: 1200px;
    margin: 0 auto;
}
.tinyheader.page-resume  .quick-search .form-control {
    padding: 3px 12px 0;     border-color: #9f9b9b; background:#fff
}


.tinyheader.page-resume  .quick-search .row {
    text-align: center;
    max-width: 1200px;
    margin: 0 auto;
}


.tinyheader.page-resume .topcvtheque #results {
   
    font-size: 14px;
    color: #0055d9;
}


.tinyheader.page-resume  .my-account-list {
 display:none
}


.tinyheader.page-resume   .quick-search__find {
    text-indent: 0;
    font-weight: 400;
    font-family: 'Open Sans',sans-serif;
    font-size: 14px;
    letter-spacing: 0px;
    background: #0055d9;
    border: transparent;
   
}
.tinyheader.page-resume .navbar {
  
    border-bottom: none;
}


.tinyheader.page-resume ::placeholder {
  color: #333;
text-align:left
}


.tinyheader.page-resume .display-item .container.block-recherche-resume {
    max-width: 1260px;
    margin-top: 5px;
    margin: 5px auto;
}

.tinyheader.page-resume .container.block-recherche-resume h1 {

    color: #ed810a; margin-bottom:0;

}

.tinyheader.page-resume .display-item .current-search { max-width:1200px; margin : 0 auto; padding:0}

.tinyheader.page-resume  .display-item .container {margin: 0; max-width:100%; border:0;}

.tinyheader.page-resume .cv-number { color:#0055d9}


.tinyheader.page-resume  .refine-search .badge {
    background-color: #6b7a88;
    border-radius: 3px;
    line-height: 17px;
    height: 30px;
}

@media (max-width: 767px) {
	
	.tinyheader.page-resume {
  
    padding-top: 100px;
}
	.tinyheader.page-resume  .footer {
   
    display: none;
}

.col-md-9 .container.container-fluid.quick-search { display:none}
.tinyheader.page-resume .quick-search__inner-pages {
    background: #0055d9!important;
   
}

.tinyheader.page-resume .container.block-recherche-resume h1 {
    color: #ffffff!important;
  
}
.tinyheader.page-resume .cv-number {
    color: #ffffff!important;
}


.tinyheader.page-resume   .quick-search__find {

    background: #ee810c!important;
  
    color: white!important;
    line-height: 16px;
    padding: 0;
}
}



@media (max-width: 767px) {

   


    .tinyheader.page-resume .cv-number {
        color: #ffffff!important;
        margin-bottom: 15px!important;
        display: block;
    }
}
</style>

{/literal}
<nav class="navbar navbar-default pagefiltreresume ">
	<div class="container container-fluid">
		<div class="logo navbar-header">
			<a class="logo__text navbar-brand" href="{$GLOBALS.site_url}">
				<img src="{$GLOBALS.site_url}/templates/Jobsquare/assets/images/{$GLOBALS.theme_settings.logo|escape:'url'}" alt="Emploi Maroc, Formation Maroc, Travail Maroc" title="Emploi Maroc, Formation Maroc, Travail Maroc"/>
				<span class="slogan">Le portail de l'emploi au Maroc </span>
			</a>
		</div>
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
					<li class="navbar__item navbar__item__filled "><a class="navbar__link  btn__blue signup_btn" href="{$GLOBALS.site_url}/registration/">[[Sign up]]</a></li>
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

{literal}
<style>
.tinyheader.page-resume #ajax-refine-search {
  
    background: #ebf3ff!important;
  padding: 10px 0px;
}
</style>

{/literal}