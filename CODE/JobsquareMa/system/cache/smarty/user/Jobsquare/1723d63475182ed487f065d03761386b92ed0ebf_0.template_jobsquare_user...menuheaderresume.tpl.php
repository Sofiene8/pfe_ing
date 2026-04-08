<?php
/* Smarty version 4.3.0, created on 2026-02-28 23:48:32
  from 'template_jobsquare_user:..menuheaderresume.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a37ed0a118f0_08813729',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1723d63475182ed487f065d03761386b92ed0ebf' => 
    array (
      0 => 'template_jobsquare_user:..menuheaderresume.tpl',
      1 => 1771968528,
      2 => 'template_jobsquare_user',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69a37ed0a118f0_08813729 (Smarty_Internal_Template $_smarty_tpl) {
?><nav class="navbar navbar-default">
	<div class="container container-fluid">
		<div class="logo navbar-header">
			<a class="logo__text navbar-brand" href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
">
				<img src="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/templates/Jobsquare/assets/images/<?php echo rawurlencode((string)$_smarty_tpl->tpl_vars['GLOBALS']->value['theme_settings']['logo']);?>
" alt="Emploi Maroc, Formation Maroc, Travail Maroc" title="Emploi Maroc, Formation Maroc, Travail Maroc"/>
				<span class="slogan">Le portail de l'emploi au Maroc </span>
			</a>
		</div>
		<div class="burger-button__wrapper burger-button__wrapper__js visible-sm visible-xs"
			 data-target="#navbar-collapse" data-toggle="collapse">
			<div class="burger-button"></div>
		</div>
		<div class="collapse navbar-collapse" id="navbar-collapse">
			<div class="visible-sm visible-xs">
				<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'nav_menu', null, null);?>
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['module'][0], array( array('name'=>'template_manager','function'=>'navigation_menu'),$_smarty_tpl ) );?>

				<?php $_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
				<?php echo $_smarty_tpl->smarty->ext->_capture->getBuffer($_smarty_tpl, 'nav_menu');?>

			</div>
			<ul class="nav navbar-nav navbar-right">
				<?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['current_user']['logged_in']) {?>
					<li class="navbar__item"><a class="navbar__link logout_btn" href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/logout/"> <?php $_block_plugin59 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin59, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin59->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Logout<?php $_block_repeat=false;
echo $_block_plugin59->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a></li>
					<li class="navbar__item navbar__item__filled">
						<?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['current_user']['group']['id'] == "Employer") {?>
							<a class="navbar__link btn__blue signup_btn" href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/my-listings/job/"><?php $_block_plugin60 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin60, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin60->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>My Account<?php $_block_repeat=false;
echo $_block_plugin60->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a>
						<?php } else { ?>
							<a class="navbar__link btn__blue signup_btn" href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/my-listings/resume/"><?php $_block_plugin61 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin61, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin61->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>My Account<?php $_block_repeat=false;
echo $_block_plugin61->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a>
						<?php }?>
					</li>
				<?php } else { ?>
					<li class="navbar__item navbar__item <?php if ($_smarty_tpl->tpl_vars['url']->value == '/login/') {?>active<?php }?>">
						<a class="navbar__link navbar__login login_btn" href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/login/"><?php $_block_plugin62 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin62, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin62->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Sign in<?php $_block_repeat=false;
echo $_block_plugin62->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a>
					</li>
					<li class="navbar__item navbar__item__filled "><a class="navbar__link  btn__orange signup_btn" href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/registration/"><?php $_block_plugin63 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin63, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin63->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Sign up<?php $_block_repeat=false;
echo $_block_plugin63->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a></li>
					<li class="navbar__item navbar__item__filled "><a class="navbar__link  btn__blue signup_btn" href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/registration/?user_group_id=Employer">Employeur?</a></li>
				<?php }?>
			</ul>
		</div>
	</div>
</nav>
<nav class="menu-bar hidden-xs hidden-sm">
	<a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/jobs/" class="menu-link<?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/jobs/' || $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/job/') {?> active<?php }?>">Offres d'emploi</a>
	<a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/trainings/" class="menu-link<?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/trainings/' || $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/training/') {?> active<?php }?>">Formations</a>
	<a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/companies/" class="menu-link<?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/companies/') {?> active<?php }?>">Entreprises</a>
	<div class="menu-dropdown">
		<a href="#" class="menu-link">Emploi par métier <span class="arrow">&#9662;</span></a>
		<ul class="menu-dropdown-content">
			<li><a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/categories/2021/informatique-technologies-jobs/">Emploi Informatique</a></li>
			<li><a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/categories/2008/centres-d-appels-relation-client-jobs/">Emploi Centres d'appels</a></li>
			<li><a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/categories/2022/ingenierie-technique-jobs/">Emploi Ingénierie</a></li>
			<li><a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/categories/2009/commerce-vente-jobs/">Emploi Commerce</a></li>
			<li><a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/categories/2023/marketing-communication-jobs/">Emploi Marketing</a></li>
			<li><a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/categories/2006/banque-finance-jobs/">Emploi Finance</a></li>
			<li><a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/categories/2010/comptabilite-audit-jobs/">Emploi Comptabilité</a></li>
			<li><a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/categories/2002/administration-secretariat-jobs/">Emploi Administration</a></li>
			<li><a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/categories/2018/hotellerie-tourisme-jobs/">Emploi Hôtellerie et Tourisme</a></li>
			<li><a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/categories/2026/ressources-humaines-jobs/">Emploi Ressources humaines</a></li>
			<li><a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/categories/2005/automobile-aeronautique-jobs/">Emploi Automobile</a></li>
			<li><a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/categories/2019/immobilier-jobs/">Emploi Immobilier</a></li>
			<li><a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/categories/2020/industrie-production-jobs/">Emploi Industrie</a></li>
			<li><a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/categories/2007/btp-construction-jobs/">Emploi BTP</a></li>
			<li><a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/categories/2013/distribution-logistique-jobs/">Emploi Logistique</a></li>
		</ul>
	</div>
	<div class="menu-dropdown">
		<a href="#" class="menu-link">Emploi par Ville <span class="arrow">&#9662;</span></a>
		<ul class="menu-dropdown-content">
			<li><a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/regions/emploi-casablanca-settat/">Emploi à Casablanca</a></li>
			<li><a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/regions/emploi-rabat-sale-kenitra/">Emploi à Rabat</a></li>
			<li><a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/regions/emploi-tanger-tetouan/">Emploi à Tanger</a></li>
			<li><a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/regions/emploi-marrakech-safi/">Emploi à Marrakech</a></li>
			<li><a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/regions/emploi-fes-meknes/">Emploi à Fès</a></li>
			<li><a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/regions/emploi-souss-massa/">Emploi à Agadir</a></li>
			<li><a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/regions/emploi-oriental/">Emploi à Oujda</a></li>
			<li><a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/regions/emploi-beni-mellal-khenifra/">Emploi à Béni Mellal</a></li>
			<li><a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/regions/emploi-draa-tafilalet/">Emploi à Ouarzazate</a></li>
			<li><a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/regions/emploi-laayoune-sakia/">Emploi à Laâyoune</a></li>
			<li><a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/regions/emploi-dakhla-oued-ed-dahab/">Emploi à Dakhla</a></li>
		</ul>
	</div>
	<a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/blog/" class="menu-link<?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/blog/') {?> active<?php }?>">Blog</a>
	<a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/contact/" class="menu-link<?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/contact/') {?> active<?php }?>">Contact</a>
</nav><?php }
}
