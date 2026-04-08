<?php
/* Smarty version 4.3.0, created on 2026-03-04 11:43:28
  from 'template_jobsquare_user:CxampphtdocsJobsquareMatemplatesJobsquareclassifiedssearch_results_jobs.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a81ae0075c17_48525371',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a3968a60b26beea1742bfb617da404678768fb4e' => 
    array (
      0 => 'template_jobsquare_user:CxampphtdocsJobsquareMatemplatesJobsquareclassifiedssearch_results_jobs.tpl',
      1 => 1772573841,
      2 => 'template_jobsquare_user',
    ),
  ),
  'includes' => 
  array (
    'template_jobsquare_user:error.tpl' => 1,
    'template_jobsquare_user:search_results_profile.tpl' => 1,
    'template_jobsquare_user:search_results_refine_block.tpl' => 1,
    'template_jobsquare_user:search_results_jobs_listings.tpl' => 1,
    'template_jobsquare_user:Bottom_Navigation_Bar.tpl' => 1,
  ),
),false)) {
function content_69a81ae0075c17_48525371 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\JobsquareMa\\system\\ext\\Smarty\\libs\\plugins\\modifier.count.php','function'=>'smarty_modifier_count',),));
?>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<link href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/templates/Jobsquare/assets/style/search-jobs.css" rel="stylesheet">
<?php echo '<script'; ?>
>document.body.classList.add('sj-page');<?php echo '</script'; ?>
>
<?php $_smarty_tpl->_assignInScope('site_name', $_smarty_tpl->tpl_vars['GLOBALS']->value['settings']['site_title']);?>

	         <?php if ($_smarty_tpl->tpl_vars['user_page_uri']->value) {?>
			        <?php if ($_smarty_tpl->tpl_vars['user_page_uri']->value == '/jobs/') {?>
			                  <?php $_block_plugin1 = isset($_smarty_tpl->smarty->registered_plugins['block']['title'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['title'][0][0] : null;
if (!is_callable(array($_block_plugin1, '_tpl_title'))) {
throw new SmartyException('block tag \'title\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('title', array());
$_block_repeat=true;
echo $_block_plugin1->_tpl_title(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
$_block_plugin2 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin2, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin2->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>$jobs_number Offres d'emploi et travail en Maroc<?php $_block_repeat=false;
echo $_block_plugin2->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_repeat=false;
echo $_block_plugin1->_tpl_title(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
							  <?php $_block_plugin3 = isset($_smarty_tpl->smarty->registered_plugins['block']['description'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['description'][0][0] : null;
if (!is_callable(array($_block_plugin3, '_tpl_description'))) {
throw new SmartyException('block tag \'description\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('description', array());
$_block_repeat=true;
echo $_block_plugin3->_tpl_description(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
$_block_plugin4 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin4, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin4->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>À la recherche d'un travail en Maroc ou à l'international? Jobsquare met à votre disposition des offres et annonces d'emploi mis à jour régulièrement<?php $_block_repeat=false;
echo $_block_plugin4->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_repeat=false;
echo $_block_plugin3->_tpl_description(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
								<?php $_block_plugin5 = isset($_smarty_tpl->smarty->registered_plugins['block']['keywords'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['keywords'][0][0] : null;
if (!is_callable(array($_block_plugin5, '_tpl_keywords'))) {
throw new SmartyException('block tag \'keywords\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('keywords', array());
$_block_repeat=true;
echo $_block_plugin5->_tpl_keywords(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
$_block_plugin6 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin6, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin6->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>agence emploi, annonces, bureau emploi, emploi à Tunis, intérim, emploi international,job, Offres emploi Maroc, recrutement<?php $_block_repeat=false;
echo $_block_plugin6->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_repeat=false;
echo $_block_plugin5->_tpl_keywords(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>


				      <?php } else { ?>

    				             <?php if ($_smarty_tpl->tpl_vars['user_page_uri']->value == '/categories/') {?>
								<?php $_smarty_tpl->_assignInScope('category_name', htmlspecialchars((string)$_smarty_tpl->tpl_vars['element']->value['caption'], ENT_QUOTES, 'UTF-8', true));?>
								<?php $_block_plugin7 = isset($_smarty_tpl->smarty->registered_plugins['block']['title'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['title'][0][0] : null;
if (!is_callable(array($_block_plugin7, '_tpl_title'))) {
throw new SmartyException('block tag \'title\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('title', array());
$_block_repeat=true;
echo $_block_plugin7->_tpl_title(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>	<?php $_block_plugin8 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin8, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin8->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>$jobs_number Offres d'emploi $category_name Maroc<?php $_block_repeat=false;
echo $_block_plugin8->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_repeat=false;
echo $_block_plugin7->_tpl_title(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
								<?php $_block_plugin9 = isset($_smarty_tpl->smarty->registered_plugins['block']['description'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['description'][0][0] : null;
if (!is_callable(array($_block_plugin9, '_tpl_description'))) {
throw new SmartyException('block tag \'description\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('description', array());
$_block_repeat=true;
echo $_block_plugin9->_tpl_description(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
$_block_plugin10 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin10, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin10->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>À la recherche d'un travail $category_name en Maroc ou à l'international? Jobsquare met à votre disposition des offres et annonces d'emploi $category_name mis à jour régulièrement<?php $_block_repeat=false;
echo $_block_plugin10->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_repeat=false;
echo $_block_plugin9->_tpl_description(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
								<?php $_block_plugin11 = isset($_smarty_tpl->smarty->registered_plugins['block']['keywords'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['keywords'][0][0] : null;
if (!is_callable(array($_block_plugin11, '_tpl_keywords'))) {
throw new SmartyException('block tag \'keywords\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('keywords', array());
$_block_repeat=true;
echo $_block_plugin11->_tpl_keywords(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
$_block_plugin12 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin12, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin12->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>annonces emploi $category_name Maroc, cherche emploi $category_name en Maroc, emploi intérim en $category_name Maroc, emploi  $category_name international Maroc, job Maroc, recrutement $category_name Maroc, Travail $category_name<?php $_block_repeat=false;
echo $_block_plugin12->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_repeat=false;
echo $_block_plugin11->_tpl_keywords(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>

								<?php } else { ?>

									<?php $_smarty_tpl->_assignInScope('location', htmlspecialchars((string)$_smarty_tpl->tpl_vars['element']->value['caption'], ENT_QUOTES, 'UTF-8', true));?>
									<?php $_block_plugin13 = isset($_smarty_tpl->smarty->registered_plugins['block']['title'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['title'][0][0] : null;
if (!is_callable(array($_block_plugin13, '_tpl_title'))) {
throw new SmartyException('block tag \'title\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('title', array());
$_block_repeat=true;
echo $_block_plugin13->_tpl_title(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
$_block_plugin14 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin14, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin14->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>$jobs_number Offres d'emploi à $location<?php $_block_repeat=false;
echo $_block_plugin14->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_repeat=false;
echo $_block_plugin13->_tpl_title(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
									<?php $_block_plugin15 = isset($_smarty_tpl->smarty->registered_plugins['block']['description'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['description'][0][0] : null;
if (!is_callable(array($_block_plugin15, '_tpl_description'))) {
throw new SmartyException('block tag \'description\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('description', array());
$_block_repeat=true;
echo $_block_plugin15->_tpl_description(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
$_block_plugin16 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin16, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin16->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>À la recherche d'un travail à $location ou à l'international? Jobsquare met à votre disposition des offres et annonces d'emploi à à $location  mis à jour régulièrement, travail à $location<?php $_block_repeat=false;
echo $_block_plugin16->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_repeat=false;
echo $_block_plugin15->_tpl_description(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
									<?php $_block_plugin17 = isset($_smarty_tpl->smarty->registered_plugins['block']['keywords'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['keywords'][0][0] : null;
if (!is_callable(array($_block_plugin17, '_tpl_keywords'))) {
throw new SmartyException('block tag \'keywords\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('keywords', array());
$_block_repeat=true;
echo $_block_plugin17->_tpl_keywords(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
$_block_plugin18 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin18, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin18->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>annonces emploi à $location, bureau emploi à $location, cherche emploi à $location, emploi à $location offre, emploi intérim à $location, emploi international à $location, emploi offre à $location, Recherche d'emploi à $location, Offres emploi à $location, recrutement à $location <?php $_block_repeat=false;
echo $_block_plugin18->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_repeat=false;
echo $_block_plugin17->_tpl_keywords(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>

								<?php }?>

	                <?php }?>
				 <?php } else { ?>
					  <?php $_block_plugin19 = isset($_smarty_tpl->smarty->registered_plugins['block']['title'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['title'][0][0] : null;
if (!is_callable(array($_block_plugin19, '_tpl_title'))) {
throw new SmartyException('block tag \'title\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('title', array());
$_block_repeat=true;
echo $_block_plugin19->_tpl_title(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
$_block_plugin20 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin20, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin20->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>$jobs_number Offres d'emploi et travail en Maroc<?php $_block_repeat=false;
echo $_block_plugin20->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_repeat=false;
echo $_block_plugin19->_tpl_title(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
							  <?php $_block_plugin21 = isset($_smarty_tpl->smarty->registered_plugins['block']['description'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['description'][0][0] : null;
if (!is_callable(array($_block_plugin21, '_tpl_description'))) {
throw new SmartyException('block tag \'description\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('description', array());
$_block_repeat=true;
echo $_block_plugin21->_tpl_description(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
$_block_plugin22 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin22, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin22->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>À la recherche d'un travail en Maroc ou à l'international? Jobsquare met à votre disposition des offres et annonces d'emploi mis à jour régulièrement<?php $_block_repeat=false;
echo $_block_plugin22->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_repeat=false;
echo $_block_plugin21->_tpl_description(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
								<?php $_block_plugin23 = isset($_smarty_tpl->smarty->registered_plugins['block']['keywords'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['keywords'][0][0] : null;
if (!is_callable(array($_block_plugin23, '_tpl_keywords'))) {
throw new SmartyException('block tag \'keywords\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('keywords', array());
$_block_repeat=true;
echo $_block_plugin23->_tpl_keywords(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
$_block_plugin24 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin24, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin24->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>agence emploi, annonces, bureau emploi, emploi à Tunis, intérim, emploi international,job, Offres emploi Maroc, recrutement<?php $_block_repeat=false;
echo $_block_plugin24->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_repeat=false;
echo $_block_plugin23->_tpl_keywords(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
               <?php }
$_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'search', null, null);?>
	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['module'][0], array( array('name'=>'classifieds','function'=>'search_form','form_template'=>'quick_search.tpl','listing_type_id'=>'Job','browse_request_data'=>$_smarty_tpl->tpl_vars['browse_request_data']->value,'searchId'=>$_smarty_tpl->tpl_vars['searchId']->value),$_smarty_tpl ) );?>

<?php $_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>

<?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/company/') {?>
	<?php $_smarty_tpl->_assignInScope('refineSearch', false);
}
if ($_smarty_tpl->tpl_vars['ERRORS']->value) {?>
	<?php $_smarty_tpl->_subTemplateRender("template_jobsquare_user:error.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
} else { ?>
	<?php if ($_smarty_tpl->tpl_vars['is_company_profile_page']->value) {?>
		<?php $_smarty_tpl->_subTemplateRender("template_jobsquare_user:search_results_profile.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
	<?php } else { ?>

		<div class="search-header <?php if (!$_smarty_tpl->tpl_vars['user_page_uri']->value) {?>hidden-xs-480<?php }?>"></div>
		<div class="quick-search__inner-pages <?php if (!$_smarty_tpl->tpl_vars['user_page_uri']->value) {?>hidden-xs-480<?php }?>">
			<?php echo $_smarty_tpl->smarty->ext->_capture->getBuffer($_smarty_tpl, 'search');?>

		</div>
		<div class="sj-results-area">
		<div class="container">

			<?php $_smarty_tpl->_assignInScope('jobs_number', $_smarty_tpl->tpl_vars['listing_search']->value['listings_number']);?>

						<div class="sj-results-header">
				<h1>
					<?php if ($_smarty_tpl->tpl_vars['user_page_uri']->value) {?>
						<?php if ($_smarty_tpl->tpl_vars['user_page_uri']->value == '/categories/') {?>
							<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['browse_navigation_elements']->value, 'element', false, NULL, 'nav_elements', array (
));
$_smarty_tpl->tpl_vars['element']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['element']->value) {
$_smarty_tpl->tpl_vars['element']->do_else = false;
?>
								<?php $_smarty_tpl->_assignInScope('category_name', htmlspecialchars((string)$_smarty_tpl->tpl_vars['element']->value['caption'], ENT_QUOTES, 'UTF-8', true));?>
								<span><?php echo $_smarty_tpl->tpl_vars['jobs_number']->value;?>
</span> <?php $_block_plugin25 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin25, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin25->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Offres d'emploi $category_name Maroc<?php $_block_repeat=false;
echo $_block_plugin25->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
							<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
						<?php } elseif ($_smarty_tpl->tpl_vars['user_page_uri']->value == '/jobs/') {?>
							<span><?php echo $_smarty_tpl->tpl_vars['jobs_number']->value;?>
</span> annonces trouv&eacute;es
						<?php } else { ?>
							<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['browse_navigation_elements']->value, 'element', false, NULL, 'nav_elements', array (
));
$_smarty_tpl->tpl_vars['element']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['element']->value) {
$_smarty_tpl->tpl_vars['element']->do_else = false;
?>
								<?php $_smarty_tpl->_assignInScope('location', htmlspecialchars((string)$_smarty_tpl->tpl_vars['element']->value['caption'], ENT_QUOTES, 'UTF-8', true));?>
								<span><?php echo $_smarty_tpl->tpl_vars['jobs_number']->value;?>
</span> <?php $_block_plugin26 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin26, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin26->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Offres d'emploi &agrave; $location<?php $_block_repeat=false;
echo $_block_plugin26->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
							<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
						<?php }?>
					<?php } else { ?>
						<span><?php echo $_smarty_tpl->tpl_vars['jobs_number']->value;?>
</span> annonces trouv&eacute;es
					<?php }?>
				</h1>
				<div class="sj-sort">
					Trier par :
					<select id="sj-sort-select">
						<option value="recent">Plus r&eacute;centes</option>
						<option value="relevant">Pertinence</option>
					</select>
					<?php if ($_smarty_tpl->tpl_vars['listing_type_id']->value != '') {?>
						<a class="sj-job-alert"
						   data-toggle="modal"
						   data-target="#apply-modal"
						   data-href='<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/guest-alerts/create/?searchId=<?php echo $_smarty_tpl->tpl_vars['searchId']->value;?>
'
						   data-title='<?php $_block_plugin27 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin27, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin27->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Create Job Alert<?php $_block_repeat=false;
echo $_block_plugin27->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>'>
							<span class="fa fa-bell-o"></span> Cr&eacute;er une alerte
						</a>
					<?php }?>
				</div>
			</div>

						<?php if (!empty($_smarty_tpl->tpl_vars['currentSearch']->value)) {?>
				<div class="sj-active-filters">
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['currentSearch']->value, 'fieldInfo', false, 'fieldID');
$_smarty_tpl->tpl_vars['fieldInfo']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['fieldID']->value => $_smarty_tpl->tpl_vars['fieldInfo']->value) {
$_smarty_tpl->tpl_vars['fieldInfo']->do_else = false;
?>
						<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['fieldInfo']->value['field'], 'fieldValue', false, 'fieldType');
$_smarty_tpl->tpl_vars['fieldValue']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['fieldType']->value => $_smarty_tpl->tpl_vars['fieldValue']->value) {
$_smarty_tpl->tpl_vars['fieldValue']->do_else = false;
?>
							<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['fieldValue']->value, 'val', false, 'realVal');
$_smarty_tpl->tpl_vars['val']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['realVal']->value => $_smarty_tpl->tpl_vars['val']->value) {
$_smarty_tpl->tpl_vars['val']->do_else = false;
?>
								<?php if ($_smarty_tpl->tpl_vars['val']->value != "0") {?>
									<div class="sj-active-filter">
										<?php $_block_plugin28 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin28, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin28->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['val']->value;
$_block_content28 = ob_get_clean();
$_block_repeat=false;
ob_start();
echo $_block_plugin28->translate(array(), $_block_content28, $_smarty_tpl, $_block_repeat);
echo htmlspecialchars((string)ob_get_clean(), ENT_QUOTES, 'UTF-8', true);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
										<a class="sj-remove" href="?searchId=<?php echo rawurlencode((string)$_smarty_tpl->tpl_vars['searchId']->value);?>
&amp;action=undo&amp;param=<?php echo $_smarty_tpl->tpl_vars['fieldID']->value;?>
&amp;type=<?php echo $_smarty_tpl->tpl_vars['fieldType']->value;?>
&amp;value=<?php echo rawurlencode((string)$_smarty_tpl->tpl_vars['realVal']->value);?>
">&times;</a>
									</div>
								<?php }?>
							<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
						<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
					<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
					<a class="sj-clear-all" href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/jobs/">Effacer tout</a>
				</div>
			<?php }?>

			<?php if ($_REQUEST['not_found']) {?>
				<div class="alert alert-info text-center" style="border-radius:12px; margin-bottom:20px;">
					<?php $_block_plugin29 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin29, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin29->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Sorry, that job is no longer available. Here are some results that may be similar to the job you were looking for.<?php $_block_repeat=false;
echo $_block_plugin29->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
				</div>
			<?php }?>

						<div class="sj-search-layout<?php if (!$_smarty_tpl->tpl_vars['refineSearch']->value) {?> sj-no-sidebar<?php }?>">

								<?php if ($_smarty_tpl->tpl_vars['refineSearch']->value) {?>
					<aside class="sj-filters">
						<div id="ajax-refine-search">
							<div class="refine-search__wrapper loading">
								<?php $_smarty_tpl->_subTemplateRender("template_jobsquare_user:search_results_refine_block.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
							</div>
						</div>
					</aside>
				<?php }?>

								<div>
					<?php if ($_smarty_tpl->tpl_vars['listings']->value) {?>
						<div class="sj-jobs-list">
							<?php $_smarty_tpl->_subTemplateRender("template_jobsquare_user:search_results_jobs_listings.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
						</div>

						<button type="button" class="load-more sj-load-more" <?php if ($_smarty_tpl->tpl_vars['listing_search']->value['current_page'] > 1) {?> data-page="<?php echo $_smarty_tpl->tpl_vars['listing_search']->value['current_page']+1;?>
" <?php } else { ?> data-page="2" <?php }?> data-backfilling="<?php if (count($_smarty_tpl->tpl_vars['listings']->value) < $_smarty_tpl->tpl_vars['listing_search']->value['listings_per_page'] && $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] != '/company/') {?>true<?php } else { ?>false<?php }?>" data-backfilling-page="1">
							Charger plus d'annonces
						</button>

												<?php $_smarty_tpl->_subTemplateRender("template_jobsquare_user:Bottom_Navigation_Bar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

					<?php } else { ?>
						<div class="alert alert-danger no-listings-found hidden" style="border-radius:12px;">
							<?php $_block_plugin30 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin30, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin30->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Sorry, we don't currently have any jobs for this search. Please try another search.<?php $_block_repeat=false;
echo $_block_plugin30->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
						</div>
						<button type="button" class="load-more sj-load-more" data-page="2" data-backfilling="<?php if (count($_smarty_tpl->tpl_vars['listings']->value) < $_smarty_tpl->tpl_vars['listing_search']->value['listings_per_page'] && $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] != '/company/') {?>true<?php } else { ?>false<?php }?>" data-backfilling-page="1">
							Charger plus d'annonces
						</button>
					<?php }?>

										<div class="sj-search-cta">
						<h3>Vous ne trouvez pas ce que vous cherchez ?</h3>
						<p>Cr&eacute;ez une alerte et recevez les nouvelles offres par email.</p>
						<a href="#" class="sj-cta-btn"
						   data-toggle="modal"
						   data-target="#apply-modal"
						   data-href='<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/guest-alerts/create/?searchId=<?php echo $_smarty_tpl->tpl_vars['searchId']->value;?>
'
						   data-title='<?php $_block_plugin31 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin31, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin31->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Create Job Alert<?php $_block_repeat=false;
echo $_block_plugin31->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>'>Cr&eacute;er une alerte emploi</a>
					</div>
				</div>

			</div>

		</div>
		</div>	<?php }
}?>

<?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/jobs/' && smarty_modifier_count($_smarty_tpl->tpl_vars['listings']->value) > 10) {?>
	<?php $_block_plugin32 = isset($_smarty_tpl->smarty->registered_plugins['block']['javascript'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['javascript'][0][0] : null;
if (!is_callable(array($_block_plugin32, '_tpl_javascript'))) {
throw new SmartyException('block tag \'javascript\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('javascript', array());
$_block_repeat=true;
echo $_block_plugin32->_tpl_javascript(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
		<?php echo '<script'; ?>
>
            $.get('?searchId=<?php echo $_smarty_tpl->tpl_vars['searchId']->value;?>
&action=search&featured=1', function(data) {
                var listings = $(data).find('.sj-job-card, .listing-item').slice(0,3);
                if (listings.length) {
                    $('.sj-jobs-list').prepend(listings);
                }
            });
		<?php echo '</script'; ?>
>
	<?php $_block_repeat=false;
echo $_block_plugin32->_tpl_javascript(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
}
$_block_plugin33 = isset($_smarty_tpl->smarty->registered_plugins['block']['javascript'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['javascript'][0][0] : null;
if (!is_callable(array($_block_plugin33, '_tpl_javascript'))) {
throw new SmartyException('block tag \'javascript\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('javascript', array());
$_block_repeat=true;
echo $_block_plugin33->_tpl_javascript(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
	<?php echo '<script'; ?>
>
		var listingPerPage = <?php echo $_smarty_tpl->tpl_vars['listing_search']->value['listings_per_page'];?>
;
		var listingNumber = '<?php echo $_smarty_tpl->tpl_vars['jobs_number']->value;?>
';
		$(document).ready(function() {
			// refine search
			var ajaxUrl = "<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/ajax/";
			var ajaxParams = {
				'action': 'get_refine_search_block',
				'listing_type[equal]': 'Job',
				'searchId': '<?php echo $_smarty_tpl->tpl_vars['searchId']->value;?>
',
				'showRefineFields': <?php echo $_smarty_tpl->tpl_vars['listing_search']->value['listings_number'];?>
 > 0
			};

			$.get(ajaxUrl, ajaxParams, function (data) {
				if (data.length > 0) {
					$('.current-search').remove();
					$('#ajax-refine-search').find('.refine-search__wrapper .refine-search__block').remove();
					$('#ajax-refine-search').find('.refine-search__wrapper').append(data);
					$('.refine-search__wrapper').removeClass('loading');

					$('.refine-search__item-radius.active').removeClass('active');
					var miles = $('.form-group__input input[type="hidden"]').val();
					$('#refine-block-radius .dropdown-toggle').text(miles + ' <?php $_block_plugin34 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin34, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin34->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['GLOBALS']->value['settings']['radius_search_unit'];
$_block_repeat=false;
echo $_block_plugin34->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>');
				}
			});

			if (listingNumber != '' && listingNumber < listingPerPage) {
				$('.load-more').trigger('click');
			}
		});

		$('.load-more').click(function() {
			var self = $(this);
			self.addClass('loading');
			if (self.data('backfilling')) {
				var page = self.data('backfilling-page');
				self.data('backfilling-page', parseInt(page) + 1);

				var ajaxUrl = "<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/ajax/";
				var ajaxParams = {
					'action' : 'request_for_listings',
					'searchId' : '<?php echo $_smarty_tpl->tpl_vars['searchId']->value;?>
',
					'page' : page
				};

				$.get(ajaxUrl, ajaxParams, function(data) {
					if (data.length > 0) {
						$('.no-listings-found').hide();
					} else {
						self.prop('disabled', true);
						$('.no-listings-found').removeClass('hidden');
					}
					$('.sj-jobs-list').append(data);
					if ($('.listing_item__backfilling').length < listingPerPage) {
						self.hide();
					}
					self.removeClass('loading');
				});
				return;
			}
            $.get('?searchId=<?php echo $_smarty_tpl->tpl_vars['searchId']->value;?>
&action=search&featured=1', function(data) {
                var listings = $(data).find('.sj-job-card, .listing-item').slice(0,3);
                if (listings.length) {
                    $('.sj-jobs-list').append(listings);
                }
            });

			$.get('?searchId=<?php echo $_smarty_tpl->tpl_vars['searchId']->value;?>
&action=search&page=' + self.data('page'), function(data) {
				var listings = $(data).find('.sj-job-card, .listing-item');
				self.removeClass('loading');
				if (listings.length) {
					$('.sj-jobs-list').append(listings);
					self.data('page', parseInt(self.data('page')) + 1);
				}
				if (listings.length !== listingPerPage) {
					if ('<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] != '/company/';?>
') {
						self.data('backfilling', true);
						$('.load-more').click();
					} else {
						self.hide();
					}
				}
			});
		});
	<?php echo '</script'; ?>
>
<?php $_block_repeat=false;
echo $_block_plugin33->_tpl_javascript(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
}
}
