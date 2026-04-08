<?php
/* Smarty version 4.3.0, created on 2026-02-27 10:28:30
  from 'template_jobsquare_user:CxampphtdocsJobsquareMatemplatesJobsquareclassifiedsbrowse_items_and_results.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a171ce7c5874_42176702',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ac688c89b2c37d15a68e57ccfe406c8172b965a4' => 
    array (
      0 => 'template_jobsquare_user:CxampphtdocsJobsquareMatemplatesJobsquareclassifiedsbrowse_items_and_results.tpl',
      1 => 1771800277,
      2 => 'template_jobsquare_user',
    ),
  ),
  'includes' => 
  array (
    'template_jobsquare_user:error.tpl' => 1,
    'template_jobsquare_user:search_results_resumes.tpl' => 1,
    'template_jobsquare_user:search_results_jobs.tpl' => 1,
  ),
),false)) {
function content_69a171ce7c5874_42176702 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\JobsquareMa\\system\\ext\\Smarty\\libs\\plugins\\modifier.capitalize.php','function'=>'smarty_modifier_capitalize',),));
$_smarty_tpl->_subTemplateRender("template_jobsquare_user:error.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
if (empty($_smarty_tpl->tpl_vars['listings']->value)) {?>
	<div class="container container--small">
		<div class="search-results__top clearfix" style="padding: 40px 0; text-align: center;">
			<h1 class="title__primary title__primary-small title__centered title__bordered"><?php $_block_plugin1 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin1, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin1->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Aucune offre disponible pour le moment<?php $_block_repeat=false;
echo $_block_plugin1->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></h1>
			<p style="margin-top: 15px;"><?php $_block_plugin2 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin2, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin2->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Consultez nos autres offres d'emploi<?php $_block_repeat=false;
echo $_block_plugin2->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></p>
			<a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/jobs/" class="btn btn__blue" style="margin-top: 10px;"><?php $_block_plugin3 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin3, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin3->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Voir toutes les offres<?php $_block_repeat=false;
echo $_block_plugin3->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a>
		</div>
	</div>
<?php } elseif ($_smarty_tpl->tpl_vars['listing_type']->value == 'Resume') {?>
	<?php $_smarty_tpl->_subTemplateRender("template_jobsquare_user:search_results_resumes.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
} else { ?>
	<?php $_smarty_tpl->_subTemplateRender("template_jobsquare_user:search_results_jobs.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}?>

<?php $_smarty_tpl->_assignInScope('site_name', $_smarty_tpl->tpl_vars['GLOBALS']->value['settings']['site_title']);
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['browse_navigation_elements']->value, 'element', false, NULL, 'nav_elements', array (
));
$_smarty_tpl->tpl_vars['element']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['element']->value) {
$_smarty_tpl->tpl_vars['element']->do_else = false;
?>
	<?php if ($_smarty_tpl->tpl_vars['user_page_uri']->value == '/categories/') {?>
		<?php $_smarty_tpl->_assignInScope('category_name', smarty_modifier_capitalize($_smarty_tpl->tpl_vars['element']->value['caption'],true));?>
		<?php $_block_plugin4 = isset($_smarty_tpl->smarty->registered_plugins['block']['title'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['title'][0][0] : null;
if (!is_callable(array($_block_plugin4, '_tpl_title'))) {
throw new SmartyException('block tag \'title\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('title', array());
$_block_repeat=true;
echo $_block_plugin4->_tpl_title(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
$_block_plugin5 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin5, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin5->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Offres d'emploi $category_name Maroc<?php $_block_repeat=false;
echo $_block_plugin5->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_repeat=false;
echo $_block_plugin4->_tpl_title(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
		<?php $_block_plugin6 = isset($_smarty_tpl->smarty->registered_plugins['block']['description'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['description'][0][0] : null;
if (!is_callable(array($_block_plugin6, '_tpl_description'))) {
throw new SmartyException('block tag \'description\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('description', array());
$_block_repeat=true;
echo $_block_plugin6->_tpl_description(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
$_block_plugin7 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin7, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin7->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?> À la recherche d'un emploi $category_name en Maroc? Jobsquare, le portail de l'emploi sélectionne pour vous différents postes qui peuvent convenir à votre profil en $category_name!<?php $_block_repeat=false;
echo $_block_plugin7->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_repeat=false;
echo $_block_plugin6->_tpl_description(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
		<?php $_block_plugin8 = isset($_smarty_tpl->smarty->registered_plugins['block']['keywords'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['keywords'][0][0] : null;
if (!is_callable(array($_block_plugin8, '_tpl_keywords'))) {
throw new SmartyException('block tag \'keywords\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('keywords', array());
$_block_repeat=true;
echo $_block_plugin8->_tpl_keywords(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
$_block_plugin9 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin9, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin9->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Emploi $category_name Maroc, annonces emploi $category_name Maroc, cherche emploi en $category_name Offres emploi Maroc, recrutement $category_name Maroc, travail $category_name Maroc<?php $_block_repeat=false;
echo $_block_plugin9->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_repeat=false;
echo $_block_plugin8->_tpl_keywords(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>

	<?php } else { ?>
		<?php $_smarty_tpl->_assignInScope('location', smarty_modifier_capitalize($_smarty_tpl->tpl_vars['element']->value['caption'],true));?>
		<?php $_block_plugin10 = isset($_smarty_tpl->smarty->registered_plugins['block']['title'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['title'][0][0] : null;
if (!is_callable(array($_block_plugin10, '_tpl_title'))) {
throw new SmartyException('block tag \'title\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('title', array());
$_block_repeat=true;
echo $_block_plugin10->_tpl_title(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
$_block_plugin11 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin11, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin11->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Offres d'emploi à $location<?php $_block_repeat=false;
echo $_block_plugin11->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_repeat=false;
echo $_block_plugin10->_tpl_title(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
		<?php $_block_plugin12 = isset($_smarty_tpl->smarty->registered_plugins['block']['description'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['description'][0][0] : null;
if (!is_callable(array($_block_plugin12, '_tpl_description'))) {
throw new SmartyException('block tag \'description\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('description', array());
$_block_repeat=true;
echo $_block_plugin12->_tpl_description(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
$_block_plugin13 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin13, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin13->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Retrouvez une sélection d'emploi à $location sur le portail de l'emploi Jobsquare. Cabinets de recrutement à $location,travail à $location sur Jobsquare.ma le partenaire de votre carrière professionnelle.<?php $_block_repeat=false;
echo $_block_plugin13->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_repeat=false;
echo $_block_plugin12->_tpl_description(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
		<?php $_block_plugin14 = isset($_smarty_tpl->smarty->registered_plugins['block']['keywords'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['keywords'][0][0] : null;
if (!is_callable(array($_block_plugin14, '_tpl_keywords'))) {
throw new SmartyException('block tag \'keywords\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('keywords', array());
$_block_repeat=true;
echo $_block_plugin14->_tpl_keywords(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
$_block_plugin15 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin15, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin15->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>agence emploi $location, annonces emploi $location, bureau emploi $location, cherche emploi à $location, emploi à $location offre, emploi intérim $location, recrutement $location, emploi offre $location, Recherche de travail à $location, recherche d'emploi $location, annonce job $location, job $location, recrutement $location<?php $_block_repeat=false;
echo $_block_plugin15->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_repeat=false;
echo $_block_plugin14->_tpl_keywords(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>

	<?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
}
