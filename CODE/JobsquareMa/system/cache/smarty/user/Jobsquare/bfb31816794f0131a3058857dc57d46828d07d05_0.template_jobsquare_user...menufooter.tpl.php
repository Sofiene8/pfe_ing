<?php
/* Smarty version 4.3.0, created on 2026-03-04 08:22:34
  from 'template_jobsquare_user:..menufooter.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a7ebca2ae6f6_77029908',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bfb31816794f0131a3058857dc57d46828d07d05' => 
    array (
      0 => 'template_jobsquare_user:..menufooter.tpl',
      1 => 1772573775,
      2 => 'template_jobsquare_user',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69a7ebca2ae6f6_77029908 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\JobsquareMa\\system\\ext\\Smarty\\libs\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?>
<div class="page-row hidden-print">
	<?php if (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'banner' ][ 0 ], array( 'banner_bottom' ))) {?>
		<div class="banner banner--bottom <?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/job/' || $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/job-preview/') {?>banner--job-details<?php }?>">
			<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'banner' ][ 0 ], array( 'banner_bottom' ));?>

		</div>
	<?php }?>

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
				<a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/">Accueil</a>
				<a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/pages/about-us/">À propos</a>
				<a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/pages/contact-us/">Contact</a>
				<a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/pages/terms-and-conditions/">Termes & Conditions</a>
			</div>

			<!-- Employeur -->
			<div class="footer-col">
				<h4>Employeur</h4>
				<a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/add-listing/Job/">Publier une annonce</a>
				<a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/resumes/">Trouver un CV</a>
					<a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/login/">Connexion</a>
			</div>

			<!-- Candidat -->
			<div class="footer-col">
				<h4>Candidat</h4>
				<a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/jobs/">Trouver un emploi</a>
				<a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/trainings/">Trouver une formation</a>
				<a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/my-listings/resume/">Déposer mon CV</a>
				<a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/login/">Connexion</a>
			</div>

			</div>

		<!-- Bottom -->
		<div class="footer-bottom">
			<?php $_smarty_tpl->_assignInScope('current_year', smarty_modifier_date_format(time(),"%Y"));?>
			<span>&copy; 2025-<?php echo $_smarty_tpl->tpl_vars['current_year']->value;?>
 Jobsquare.ma — Tous droits réservés</span>
			<div class="footer-bottom-links">
				<a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/pages/privacy-policy/">Confidentialité</a>
				<a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/pages/terms-and-conditions/">CGU</a>
				<a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/sitemap.xml">Plan du site</a>
			</div>
			<div class="footer-flag">
				&#127474;&#127462; Le site N°1 de l'Emploi au Maroc
			</div>
		</div>

	</footer>

	<?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['settings']['google_TrackingID']) {?>
	<?php echo '<script'; ?>
 async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['settings']['google_TrackingID'];?>
"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
>

		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());
		gtag('config', '<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['settings']['google_TrackingID'];?>
');

	<?php echo '</script'; ?>
>
	<?php }?>
</div>

<!-- Back to top -->
<button class="back-top" onclick="window.scrollTo({top:0, behavior:'smooth'})">
	<span class="back-top-arrow">&uarr;</span>
	<span class="back-top-label">Top</span>
</button><?php }
}
