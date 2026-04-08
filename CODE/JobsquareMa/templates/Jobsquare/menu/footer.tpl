<div class="page-row hidden-print">
	{if 'banner_bottom'|banner}
		<div class="banner banner--bottom {if $GLOBALS.user_page_uri == '/job/' || $GLOBALS.user_page_uri == '/job-preview/'}banner--job-details{/if}">
			{'banner_bottom'|banner}
		</div>
	{/if}

	<footer class="footer">
		<div class="footer-accent"></div>

		<div class="footer-main">

			<!-- Brand -->
			<div class="footer-brand">
				<div class="footer-logo"><span>Job</span>square</div>
				<p class="footer-tagline">Le portail de l'emploi au Maroc.<br>Trouvez votre prochain emploi ou recrutez les meilleurs talents.</p>
				<div class="social-links">
					<a href="#" class="social-link" title="Facebook">f</a>
					<a href="#" class="social-link" title="LinkedIn">in</a>
					<a href="#" class="social-link" title="Instagram">ig</a>
				</div>
			</div>

			<!-- Jobsquare -->
			<div class="footer-col">
				<h4>Jobsquare</h4>
				<a href="{$GLOBALS.site_url}/">Accueil</a>
				<a href="{$GLOBALS.site_url}/pages/about-us/">À propos</a>
				<a href="{$GLOBALS.site_url}/pages/contact-us/">Contact</a>
				<a href="{$GLOBALS.site_url}/pages/terms-and-conditions/">Termes & Conditions</a>
			</div>

			<!-- Employeur -->
			<div class="footer-col">
				<h4>Employeur</h4>
				<a href="{$GLOBALS.site_url}/add-listing/Job/">Publier une annonce</a>
				<a href="{$GLOBALS.site_url}/resumes/">Trouver un CV</a>
					<a href="{$GLOBALS.site_url}/login/">Connexion</a>
			</div>

			<!-- Candidat -->
			<div class="footer-col">
				<h4>Candidat</h4>
				<a href="{$GLOBALS.site_url}/jobs/">Trouver un emploi</a>
				<a href="{$GLOBALS.site_url}/trainings/">Trouver une formation</a>
				<a href="{$GLOBALS.site_url}/my-listings/resume/">Déposer mon CV</a>
				<a href="{$GLOBALS.site_url}/login/">Connexion</a>
			</div>

			</div>

		<!-- Bottom -->
		<div class="footer-bottom">
			{assign var="current_year" value=$smarty.now|date_format:"%Y"}
			<span>&copy; 2025-{$current_year} Jobsquare.ma — Tous droits réservés</span>
			<div class="footer-bottom-links">
				<a href="{$GLOBALS.site_url}/pages/privacy-policy/">Confidentialité</a>
				<a href="{$GLOBALS.site_url}/pages/terms-and-conditions/">CGU</a>
				<a href="{$GLOBALS.site_url}/sitemap.xml">Plan du site</a>
			</div>
			<div class="footer-flag">
				&#127474;&#127462; Le site N°1 de l'Emploi au Maroc
			</div>
		</div>

	</footer>

	{if $GLOBALS.settings.google_TrackingID}
	<script async src="https://www.googletagmanager.com/gtag/js?id={$GLOBALS.settings.google_TrackingID}"></script>
	<script>
{literal}
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());
		gtag('config', '{/literal}{$GLOBALS.settings.google_TrackingID}{literal}');
{/literal}
	</script>
	{/if}
</div>

<!-- Back to top -->
<button class="back-top" onclick="window.scrollTo({ldelim}top:0, behavior:'smooth'{rdelim})">
	<span class="back-top-arrow">&uarr;</span>
	<span class="back-top-label">Top</span>
</button>