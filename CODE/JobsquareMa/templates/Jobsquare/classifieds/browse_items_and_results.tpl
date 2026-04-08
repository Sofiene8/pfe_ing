{include file="error.tpl"}
{if empty($listings)}
	<div class="container container--small">
		<div class="search-results__top clearfix" style="padding: 40px 0; text-align: center;">
			<h1 class="title__primary title__primary-small title__centered title__bordered">[[Aucune offre disponible pour le moment]]</h1>
			<p style="margin-top: 15px;">[[Consultez nos autres offres d'emploi]]</p>
			<a href="{$GLOBALS.site_url}/jobs/" class="btn btn__blue" style="margin-top: 10px;">[[Voir toutes les offres]]</a>
		</div>
	</div>
{elseif $listing_type == 'Resume'}
	{include file="search_results_resumes.tpl"}
{else}
	{include file="search_results_jobs.tpl"}
{/if}

{assign var="site_name" value=$GLOBALS.settings.site_title}
{*must be after search results tags*}
{foreach from=$browse_navigation_elements item=element name="nav_elements"}
	{if $user_page_uri == '/categories/'}
		{assign var="category_name" value=$element.caption|capitalize:true}
		{title}[[Offres d'emploi $category_name Maroc]]{/title}
		{description}[[ À la recherche d'un emploi $category_name en Maroc? Jobsquare, le portail de l'emploi sélectionne pour vous différents postes qui peuvent convenir à votre profil en $category_name!]]{/description}
		{keywords}[[Emploi $category_name Maroc, annonces emploi $category_name Maroc, cherche emploi en $category_name Offres emploi Maroc, recrutement $category_name Maroc, travail $category_name Maroc]]{/keywords}

	{else}
		{assign var="location" value=$element.caption|capitalize:true}
		{title}[[Offres d'emploi à $location]]{/title}
		{description}[[Retrouvez une sélection d'emploi à $location sur le portail de l'emploi Jobsquare. Cabinets de recrutement à $location,travail à $location sur Jobsquare.ma le partenaire de votre carrière professionnelle.]]{/description}
		{keywords}[[agence emploi $location, annonces emploi $location, bureau emploi $location, cherche emploi à $location, emploi à $location offre, emploi intérim $location, recrutement $location, emploi offre $location, Recherche de travail à $location, recherche d'emploi $location, annonce job $location, job $location, recrutement $location]]{/keywords}

	{/if}
{/foreach}