<?php
/* Smarty version 4.3.0, created on 2026-02-28 22:09:18
  from 'template_jobsquare_user:CxampphtdocsJobsquareMatemplatesJobsquareclassifiedsbrowseCompany.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a3678ecb4268_56686015',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c05f3ae2a34d5a398c50c4e984f9086f1a063c1b' => 
    array (
      0 => 'template_jobsquare_user:CxampphtdocsJobsquareMatemplatesJobsquareclassifiedsbrowseCompany.tpl',
      1 => 1772316422,
      2 => 'template_jobsquare_user',
    ),
  ),
  'includes' => 
  array (
    'template_jobsquare_user:searchFormByCompany.tpl' => 1,
  ),
),false)) {
function content_69a3678ecb4268_56686015 (Smarty_Internal_Template $_smarty_tpl) {
?><link href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/templates/Jobsquare/assets/style/search-jobs.css" rel="stylesheet">
<div class="search-header"></div>
<?php $_smarty_tpl->_assignInScope('site_name', $_smarty_tpl->tpl_vars['GLOBALS']->value['settings']['site_title']);
$_block_plugin1 = isset($_smarty_tpl->smarty->registered_plugins['block']['title'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['title'][0][0] : null;
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
ob_start();?>Offres de travail des entreprises en Maroc<?php $_block_repeat=false;
echo $_block_plugin2->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_repeat=false;
echo $_block_plugin1->_tpl_title(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin3 = isset($_smarty_tpl->smarty->registered_plugins['block']['description'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['description'][0][0] : null;
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
ob_start();?>Retrouvez les entreprises qui proposent du travail en Maroc! Jobsquare le bureau de recrutement en Maroc qui accompagne les candidats comme les employeurs.<?php $_block_repeat=false;
echo $_block_plugin4->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_repeat=false;
echo $_block_plugin3->_tpl_description(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin5 = isset($_smarty_tpl->smarty->registered_plugins['block']['keywords'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['keywords'][0][0] : null;
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
ob_start();?>recherche de profils en Maroc, Offre de travail Maroc,recrutement Maroc<?php $_block_repeat=false;
echo $_block_plugin6->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_repeat=false;
echo $_block_plugin5->_tpl_keywords(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_smarty_tpl->_subTemplateRender("template_jobsquare_user:searchFormByCompany.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
