<?php
/* Smarty version 4.3.0, created on 2026-03-04 11:43:18
  from 'template_jobsquare_user:CxampphtdocsJobsquareMatemplatesJobsquareclassifiedsdisplay_job.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a81ad6450716_85106364',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '29353bdb9ac43a886b677dc7c19fa033badf6cf9' => 
    array (
      0 => 'template_jobsquare_user:CxampphtdocsJobsquareMatemplatesJobsquareclassifiedsdisplay_job.tpl',
      1 => 1772573836,
      2 => 'template_jobsquare_user',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69a81ad6450716_85106364 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\JobsquareMa\\system\\ext\\Smarty\\libs\\plugins\\modifier.replace.php','function'=>'smarty_modifier_replace',),1=>array('file'=>'C:\\xampp\\htdocs\\JobsquareMa\\system\\ext\\Smarty\\libs\\plugins\\modifier.explode.php','function'=>'smarty_modifier_explode',),2=>array('file'=>'C:\\xampp\\htdocs\\JobsquareMa\\system\\ext\\Smarty\\libs\\plugins\\modifier.count.php','function'=>'smarty_modifier_count',),3=>array('file'=>'C:\\xampp\\htdocs\\JobsquareMa\\system\\ext\\Smarty\\libs\\plugins\\modifier.truncate.php','function'=>'smarty_modifier_truncate',),4=>array('file'=>'C:\\xampp\\htdocs\\JobsquareMa\\system\\ext\\Smarty\\libs\\plugins\\modifier.timeAgo.php','function'=>'smarty_modifier_timeAgo',),));
?>

<?php echo '<script'; ?>
 src="https://use.fontawesome.com/7e203bcaaf.js"><?php echo '</script'; ?>
>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
/* ============ VARIABLES ============ */
.listing-results {
  --jd-red: #ec2b4d;
  --jd-red-dark: #d43d5e;
  --jd-red-light: #fdf2f5;
  --jd-green: #009688;
  --jd-green-light: #fdecef;
  --jd-dark: #1a1d2e;
  --jd-gray: #6b7280;
  --jd-gray-light: #f5f6f8;
  --jd-border: #e8eaed;
}

/* ============ HIDE NAVBAR BOTTOM LINE + SPACING ============ */
.navbar.navbar-default.menu_principal { box-shadow: none !important; border-bottom: none !important; }
.menu-bar { margin-top: 24px; }

/* ============ RESET OLD STYLES ============ */
.listing-results .details-header.page-detail-annonce { background: transparent !important; padding: 0 !important; margin: 0 !important; border: none !important; }
.listing-results .details-header .container { max-width: 1200px; margin: 0 auto; background: transparent !important; padding: 0 !important; }
.listing-results .top-annonce.tpan { display: none !important; }
.listing-results #stickytop { display: none !important; }
.listing-results .detail-offre { background: transparent !important; border: none !important; box-shadow: none !important; padding: 0 !important; margin: 0 !important; }
.listing-results .detail-offre.notfeatured { background: transparent !important; }
.listing-results .row { margin: 0; }
.listing-results .col-md-9 { width: 100%; padding: 0; float: none; }
.listing-results .col-md-3 { width: 100%; padding: 0; float: none; }
.listing-results .profilecompany.content-card { display: none !important; }

/* ============ STICKY BAR ============ */
.jd-sticky-bar {
  position: fixed; top: 0; left: 0; right: 0; z-index: 1050;
  background: rgba(255,255,255,0.97);
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
  border-bottom: 1.5px solid var(--jd-border);
  padding: 10px 48px;
  display: flex; align-items: center; justify-content: space-between;
  transform: translateY(-100%);
  transition: transform 0.3s;
  font-family: 'DM Sans', sans-serif;
}
.jd-sticky-bar.jd-visible { transform: translateY(0); }
.jd-sticky-left { display: flex; align-items: center; gap: 14px; }
.jd-sticky-logo {
  width: 36px; height: 36px; border-radius: 8px;
  background: var(--jd-gray-light); border: 1px solid var(--jd-border);
  display: flex; align-items: center; justify-content: center;
  overflow: hidden;
}
.jd-sticky-logo img { width: 100%; height: 100%; object-fit: cover; }
.jd-sticky-title { font-size: 14px; font-weight: 700; color: var(--jd-dark); }
.jd-sticky-meta { font-size: 12px; color: var(--jd-gray); }
.jd-sticky-right { display: flex; gap: 8px; align-items: center; }
.jd-sticky-btn-apply {
  padding: 8px 24px; border: none; border-radius: 8px;
  background: var(--jd-red); color: white; font-size: 13px;
  font-weight: 700; font-family: 'DM Sans', sans-serif; cursor: pointer;
}
.jd-sticky-btn-apply:hover { background: var(--jd-red-dark); }
.jd-sticky-btn-share {
  padding: 8px 14px; border: 1.5px solid var(--jd-border); border-radius: 8px;
  background: #fff; color: var(--jd-gray); font-size: 14px; cursor: pointer;
}

/* ============ LAYOUT ============ */
.jd-page {
  max-width: 1200px; margin: 0 auto; padding: 24px;
  font-family: 'DM Sans', sans-serif;
}
.jd-layout {
  display: grid; grid-template-columns: 1fr 300px; gap: 20px;
}

/* ============ BREADCRUMB ============ */
.jd-breadcrumb {
  font-size: 13px; color: var(--jd-gray); margin-bottom: 16px;
}
.jd-breadcrumb a { color: var(--jd-dark); text-decoration: none; }
.jd-breadcrumb a:hover { text-decoration: underline; color: var(--jd-red);  }

/* ============ HEADER CARD ============ */
.jd-header {
  background: #fff; border-radius: 14px;
  border: 1.5px solid var(--jd-border); overflow: hidden;
  grid-column: 1 / -1;
}
.jd-header-accent {
  height: 4px;
  /*background: linear-gradient(90deg, var(--jd-red) 0%, var(--jd-red-dark) 100%);*/
}
.jd-header-inner { padding: 28px 32px; display: flex; gap: 22px; }
.jd-company-logo {
  width: 68px; height: 68px; border-radius: 14px;
  background: var(--jd-gray-light); border: 1.5px solid var(--jd-border);
  display: flex; align-items: center; justify-content: center;
  overflow: hidden; flex-shrink: 0;
}
.jd-company-logo img { width: 100%; height: 100%; object-fit: contain; }
.jd-header-info { flex: 1; }
.jd-title {
  font-size: 22px; font-weight: 700; line-height: 1.3;
  margin-bottom: 8px; color: var(--jd-dark);
}
.jd-meta {
  display: flex; align-items: center; gap: 8px;
  font-size: 14px; color: var(--jd-gray); margin-bottom: 18px; flex-wrap: wrap;
}
.jd-meta a { color: var(--jd-red); text-decoration: none; font-weight: 600; }
.jd-meta a:hover { text-decoration: underline; }
.jd-meta .jd-sep { color: #ddd; }
.jd-meta .jd-verified {
  display: inline-flex; align-items: center; gap: 3px;
  color: #0055D9; font-size: 12px;
}
.jd-actions { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }
.jd-btn-apply {
  padding: 11px 30px; border: none; border-radius: 10px;
  background: var(--jd-red); color: white; font-size: 14px; font-weight: 700;
  font-family: 'DM Sans', sans-serif; cursor: pointer; transition: all 0.2s;
  text-decoration: none; display: inline-block; text-align: center;
}
.jd-btn-apply:hover { background: var(--jd-red-dark); transform: translateY(-1px); box-shadow: 0 6px 16px rgba(231,76,111,0.25); color: white; text-decoration: none; }
.jd-btn-sec {
  padding: 10px 16px; border: 1.5px solid var(--jd-border); border-radius: 10px;
  background: #fff; color: var(--jd-gray); font-size: 13px; font-family: 'DM Sans', sans-serif; cursor: pointer; transition: 0.2s;
}
.jd-btn-sec:hover { border-color: var(--jd-red); color: var(--jd-red); }
.jd-first-badge { font-size: 12px; color: var(--jd-green); font-weight: 600; margin-left: 4px; }

.jd-header-bottom {
  padding: 10px 32px; background: var(--jd-gray-light);
  border-top: 1px solid var(--jd-border);
  display: flex; justify-content: space-between;
  font-size: 12px; color: var(--jd-gray);
}
.jd-header-bottom strong { color: var(--jd-dark); }

/* share container inside header */
.jd-share-container { position: relative; display: inline-block; }
.jd-share-icons {
  display: none; position: absolute; top: 100%; right: 0; z-index: 10;
  background: #fff; border: 1.5px solid var(--jd-border); border-radius: 10px;
  padding: 8px 12px; gap: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.08);
  margin-top: 4px; white-space: nowrap;
}
.jd-share-icons.jd-show { display: flex; }
.jd-share-icons a { color: var(--jd-gray); font-size: 18px; transition: 0.2s; text-decoration: none; }
.jd-share-icons a:hover { color: var(--jd-red); }

/* ============ CONTENT CARD ============ */
.jd-content {
  background: #fff; border-radius: 14px;
  border: 1.5px solid var(--jd-border); padding: 32px;
}
.jd-section { margin-bottom: 26px; padding-bottom: 26px; border-bottom: 1px solid var(--jd-border); }
.jd-section:last-child { margin-bottom: 0; padding-bottom: 0; border-bottom: none; }
.jd-section-title {
  font-size: 15px; font-weight: 700; margin-bottom: 12px;
  display: flex; align-items: center; gap: 10px; color: var(--jd-dark);
}
.jd-section-title .jd-icon {
  width: 28px; height: 28px; border-radius: 7px;
  background: var(--jd-red-light);
  display: inline-flex; align-items: center; justify-content: center;
  font-size: 13px; flex-shrink: 0;
}
.jd-section p, .jd-section .details-body__content { font-size: 14px; color: #444; line-height: 1.8; }
.jd-section .details-body__content ul { list-style: none; padding: 0; }
.jd-section .details-body__content ul li {
  font-size: 14px; color: #444; line-height: 1.75;
  padding: 4px 0 4px 20px; position: relative;
}
.jd-section .details-body__content ul li::before {
  content: ''; position: absolute; left: 0; top: 12px;
  width: 6px; height: 6px; border-radius: 50%;
  background: var(--jd-red); opacity: 0.4;
}

/* Info grid */
.jd-info-grid {
  display: grid; grid-template-columns: 1fr 1fr; gap: 12px;
  margin-bottom: 8px;
}
.jd-info-box {
  padding: 12px 16px;
  background: var(--jd-gray-light);
  border-radius: 8px;
  border: 1px solid var(--jd-border);
}
.jd-info-box .jd-label { font-size: 11px; color: var(--jd-gray); text-transform: uppercase; letter-spacing: 0.3px; margin-bottom: 4px; }
.jd-info-box .jd-value { font-size: 14px; font-weight: 600; color: var(--jd-green); }

/* Keywords */
.jd-keywords { display: flex; gap: 6px; flex-wrap: wrap; }
.jd-keyword {
  font-size: 12px; font-weight: 500; padding: 4px 12px;
  background: var(--jd-gray-light); border: 1px solid var(--jd-border);
  border-radius: 20px; color: var(--jd-gray); cursor: pointer; transition: 0.2s;
  text-decoration: none; display: inline-block;
}
.jd-keyword:hover { border-color: var(--jd-red); color: var(--jd-red); background: var(--jd-red-light); text-decoration: none; }

/* Bottom CTA */
.jd-bottom-cta {
  margin-top: 20px; padding: 22px;
  background: var(--jd-gray-light); border-radius: 12px; text-align: center;
}
.jd-bottom-cta p { font-size: 14px; color: var(--jd-gray); margin-bottom: 10px; }

/* ============ SIDEBAR ============ */
.jd-sidebar { display: flex; flex-direction: column; gap: 14px; }
.jd-side-card {
  background: #fff; border-radius: 14px;
  border: 1.5px solid var(--jd-border); padding: 20px;
}
.jd-side-card h3, .jd-side-card .card-title {
  font-size: 12px; font-weight: 700; text-transform: uppercase;
  letter-spacing: 0.5px; color: var(--jd-gray);
  margin-bottom: 12px; padding-bottom: 10px;
  border-bottom: 1.5px solid var(--jd-border);
}

/* Company sidebar card */
.jd-company-side { text-align: center; }
.jd-company-side .jd-logo-lg {
  width: 52px; height: 52px; border-radius: 12px;
  background: var(--jd-gray-light); border: 1.5px solid var(--jd-border);
  margin: 0 auto 10px; overflow: hidden;
  display: flex; align-items: center; justify-content: center;
}
.jd-company-side .jd-logo-lg img { width: 100%; height: 100%; object-fit: contain; }
.jd-company-side .jd-name { font-size: 16px; font-weight: 700; margin-bottom: 3px; color: var(--jd-dark); }
.jd-company-side .jd-loc { font-size: 12px; color: var(--jd-gray); margin-bottom: 14px; }
.jd-company-side .jd-desc {
  font-size: 13px; color: #555; line-height: 1.6;
  text-align: left; margin-bottom: 14px;
  padding-top: 12px; border-top: 1px solid var(--jd-border);
}
.jd-company-side .jd-link {
  display: inline-block; padding: 8px 18px;
  border: 1.5px solid var(--jd-red); border-radius: 8px;
  color: var(--jd-red); font-size: 13px; font-weight: 600;
  text-decoration: none; transition: 0.2s;
}
.jd-company-side .jd-link:hover { background: var(--jd-red); color: #fff; }

/* Sidebar module overrides */
.jd-side-card .similar-job, .jd-side-card .most-searched { margin: 0; padding: 0; }
.jd-side-card .similar-job .listing-compact, .jd-side-card .most-searched .listing-compact { border: none; margin: 0; }
.jd-side-card .content-card { background: transparent !important; border: none !important; box-shadow: none !important; padding: 0 !important; margin: 0 !important; }
.jd-side-card a { color: var(--jd-red); transition: 0.2s; }
.jd-side-card a:hover { color: var(--jd-red-dark); }

/* Reset old city/category listing styles in sidebar */
.jd-side-card .similar-job { background: transparent !important; border: none !important; padding: 0 !important; margin: 0 !important; min-height: auto !important; width: 100% !important; }
.jd-side-card .similar-job.plus_city_listing { border: none !important; }
.jd-side-card .city-listing, .jd-side-card .categoy-listing { width: 100% !important; padding: 0 !important; float: none !important; }
.jd-side-card .city-listing ul, .jd-side-card .categoy-listing ul { list-style: none !important; padding: 0 !important; margin: 0 !important; }
.jd-side-card .city-listing ul li,
.jd-side-card .categoy-listing ul li,
.jd-side-card .city-listing ul li:nth-child(odd),
.jd-side-card .city-listing ul li:nth-child(even),
.jd-side-card .categoy-listing ul li:nth-child(odd),
.jd-side-card .categoy-listing ul li:nth-child(even) {
  background: none !important; border-left: none !important; padding: 4px 0 4px 14px !important;
  margin: 0 !important; list-style: none !important; color: var(--jd-dark) !important;
  position: relative;
}
.jd-side-card .city-listing ul li::before,
.jd-side-card .categoy-listing ul li::before {
  content: '\2022'; position: absolute; left: 0; color: var(--jd-red); opacity: 0.5;
}
.jd-side-card .city-listing ul li a,
.jd-side-card .categoy-listing ul li a {
  color: var(--jd-dark) !important; font-size: 13px !important; text-decoration: none !important;
  transition: padding-left 0.2s;
}
.jd-side-card .city-listing ul li a:hover,
.jd-side-card .categoy-listing ul li a:hover { padding-left: 4px; }
.jd-side-card .city-listing h4,
.jd-side-card .categoy-listing h4 {
  font-size: 12px; font-weight: 700; text-transform: uppercase;
  letter-spacing: 0.5px; color: var(--jd-green);
  margin: 0 0 12px; padding-bottom: 10px;
  border-bottom: 1.5px solid var(--jd-border);
}
.jd-side-card .col-md-4 { width: 100% !important; padding: 0 !important; float: none !important; }

/* Featured listings in sidebar - single column */
.jd-side-card .featured-jobs { grid-template-columns: 1fr; gap: 10px; margin-bottom: 0; }
.jd-side-card .featured-card { padding: 12px 14px; font-size: 13px; }
.jd-side-card .featured-card::before { margin-right: 10px; }
.jd-side-card .featured-info__title { font-size: 13px !important; }
.jd-side-card .featured-btn { padding: 5px 12px; font-size: 11px; }
.jd-side-card h4 { font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; color: var(--jd-green); margin: 0 0 12px; padding-bottom: 10px; border-bottom: 1.5px solid var(--jd-border); }
.jd-side-card .featured-card {
    padding: 0;
    font-size: 13px;
    border: none;
}
.job-card__tag {
    font-size: 12px;
    padding: 3px;
}
/* CTA cards */
.jd-cta-dark {
  background: var(--jd-dark) !important; border-color: var(--jd-dark) !important; color: #fff; text-align: center;
}
.jd-cta-dark .card-title { color:  var(--jd-green) !important; border-bottom-color: rgba(255,255,255,0.08) !important; }
.jd-cta-dark p { font-size: 13px; color: rgba(255,255,255,0.55); line-height: 1.6; margin-bottom: 12px; }
.jd-cta-dark .jd-cta-btn {
  display: inline-block; padding: 9px 22px;
  background: var(--jd-green); color: #fff; border-radius: 8px;
  text-decoration: none; font-size: 13px; font-weight: 700;
}
.jd-cta-dark .jd-cta-btn:hover { background: var(--jd-red-dark); color: #fff; }

.jd-cta-light {
  border-color: var(--jd-red) !important; border-style: dashed !important; text-align: center;
}
.jd-cta-light .card-title { color: var(--jd-red) !important; border-bottom: none !important; text-transform: none !important; letter-spacing: 0 !important; font-size: 15px !important; margin-bottom: 6px !important; }
.jd-cta-light p { font-size: 13px; color: var(--jd-gray); }
.jd-cta-light a { color: var(--jd-red); font-weight: 600; }

/* Below-grid blocks */
.jd-below-grid {
  max-width: 1200px; margin: 0 auto; padding: 0 24px 40px;
}
.jd-below-grid .content-card { background: #fff; border-radius: 14px; border: 1.5px solid var(--jd-border); padding: 20px; margin-bottom: 16px; }
.jd-below-grid .listing__featured,
.jd-below-grid .listing__featured-training { background: transparent; }
.jd-below-grid .listing__featured .container,
.jd-below-grid .listing__featured-training .container { max-width: 100%; padding: 0; margin: 0; }
.jd-below-grid .section-header h2 {
  font-size: 18px; font-weight: 700; color: var(--jd-dark);
  margin-bottom: 16px; font-family: 'DM Sans', sans-serif;
}
.jd-below-grid .featured-jobs { margin-bottom: 12px; }
.jd-below-grid .view-more, .jd-below-grid .view-more-training {
  text-align: center; margin-top: 8px; margin-bottom: 20px;
}
.jd-below-grid .see-more-jobs, .jd-below-grid .see-more-trainings {
  color: var(--jd-red); font-weight: 600; font-size: 14px; text-decoration: none;
}
.jd-below-grid .see-more-jobs:hover, .jd-below-grid .see-more-trainings:hover { text-decoration: underline; }

/* ============ PREVIEW MODE ============ */
.jd-preview-btns { margin-bottom: 16px; }
.jd-preview-btns form { display: flex; gap: 10px; }
.jd-preview-btns .btn { border-radius: 10px; }

/* ============ RESPONSIVE ============ */
@media (max-width: 768px) {
  .jd-layout { grid-template-columns: 1fr; }
  .jd-header { grid-column: 1; }
  .jd-header-inner { flex-direction: column; padding: 20px; }
  .jd-info-grid { grid-template-columns: 1fr; }
  .jd-sticky-bar { padding: 8px 16px; }
  .jd-page { padding: 12px; }
  .jd-content { padding: 20px; }
  .jd-header-bottom { flex-direction: column; gap: 4px; }
}

/* ============ HIDE OLD ELEMENTS ============ */
.listing-results .job-top-wrapper.stikydetail { display: none !important; }
.listing-results .infos_job_details .col-md-4 { width: auto; float: none; padding: 0; }
.listing-results .infos_job_details { display: none !important; }
.listing-results .details-body__title { display: none !important; }
.listing-results .bootstrap-tagsinput { display: none !important; }
.listing-results .details-breadcrumbs { display: none !important; }
.listing-results .btn__back { display: none !important; }
.listing-results .results.text-left { display: none !important; }

/*************/

.job-card .job-card__tag {
    font-size: 11px;
    padding: 4px 10px;
    border-radius: 6px;
    font-weight: 500;
}

</style>

<link rel="stylesheet" href="../../system/ext/dist/app.css">
<?php $_block_plugin1 = isset($_smarty_tpl->smarty->registered_plugins['block']['title'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['title'][0][0] : null;
if (!is_callable(array($_block_plugin1, '_tpl_title'))) {
throw new SmartyException('block tag \'title\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('title', array());
$_block_repeat=true;
echo $_block_plugin1->_tpl_title(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?> Offre d'emploi <?php echo $_smarty_tpl->tpl_vars['listing']->value['Title'];?>
 <?php $_block_repeat=false;
echo $_block_plugin1->_tpl_title(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin2 = isset($_smarty_tpl->smarty->registered_plugins['block']['keywords'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['keywords'][0][0] : null;
if (!is_callable(array($_block_plugin2, '_tpl_keywords'))) {
throw new SmartyException('block tag \'keywords\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('keywords', array());
$_block_repeat=true;
echo $_block_plugin2->_tpl_keywords(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?> offre d'emploi <?php echo $_smarty_tpl->tpl_vars['listing']->value['Title'];?>
, offres d'emploi <?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['listing']->value['user']['CompanyName'], ENT_QUOTES, 'UTF-8', true);?>
, recrutement chez <?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['listing']->value['user']['CompanyName'], ENT_QUOTES, 'UTF-8', true);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['display'][0], array( array('property'=>'id_Job_MotsCls','assign'=>'tags'),$_smarty_tpl ) );
if ($_smarty_tpl->tpl_vars['tags']->value != '') {?>, <?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['tags']->value,',',', ');
}?>
<!--<?php $_smarty_tpl->_assignInScope('tab', smarty_modifier_explode(",",$_smarty_tpl->tpl_vars['tags']->value));
if (smarty_modifier_count($_smarty_tpl->tpl_vars['tab']->value) > 0 && $_smarty_tpl->tpl_vars['tab']->value[0] != '') {?>,
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tab']->value, 'tag', false, 'key');
$_smarty_tpl->tpl_vars['tag']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['tag']->value) {
$_smarty_tpl->tpl_vars['tag']->do_else = false;
if ($_smarty_tpl->tpl_vars['tag']->value != '') {
echo htmlspecialchars((string)trim($_smarty_tpl->tpl_vars['tag']->value), ENT_QUOTES, 'UTF-8', true);?>
, <?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}?>-->
   <?php $_block_repeat=false;
echo $_block_plugin2->_tpl_keywords(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
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
ob_start();?> <?php echo smarty_modifier_truncate(preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['listing']->value['JobDescription'] ?: ''),165);?>
 <?php $_block_repeat=false;
echo $_block_plugin3->_tpl_description(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin4 = isset($_smarty_tpl->smarty->registered_plugins['block']['head'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['head'][0][0] : null;
if (!is_callable(array($_block_plugin4, '_tpl_head'))) {
throw new SmartyException('block tag \'head\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('head', array());
$_block_repeat=true;
echo $_block_plugin4->_tpl_head(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['module'][0], array( array('name'=>"miscellaneous",'function'=>"opengraph_meta",'listing'=>$_smarty_tpl->tpl_vars['listing']->value),$_smarty_tpl ) );?>

<?php $_block_repeat=false;
echo $_block_plugin4->_tpl_head(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>

<?php if ($_REQUEST['isBoughtNow']) {?>
	<div class="alert alert-bought-now text-center content-text"> <?php if (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'status' ][ 0 ], array( $_smarty_tpl->tpl_vars['listing']->value['active'] )) == 'pending') {?>
	<?php $_block_plugin5 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin5, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin5->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Your job will be published as soon as it is reviewed and approved.<?php $_block_repeat=false;
echo $_block_plugin5->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
	<?php } else { ?>
	<?php $_block_plugin6 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin6, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin6->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>You have successfully posted your job.<?php $_block_repeat=false;
echo $_block_plugin6->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?> <br/>
	<a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/my-listings/job/" class="link"><?php $_block_plugin7 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin7, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin7->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>View your job stats in "My Account" section<?php $_block_repeat=false;
echo $_block_plugin7->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
		<?php }?> <a href="#" class="alert__close"> </a> </div>
<?php }?>

<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['form_fields']->value, 'list_value');
$_smarty_tpl->tpl_vars['list_value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['list_value']->value) {
$_smarty_tpl->tpl_vars['list_value']->do_else = false;
?>
   <?php if ($_smarty_tpl->tpl_vars['list_value']->value['id'] == 'id_Job_Vacancies') {?>
    <?php ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['display'][0], array( array('property'=>$_smarty_tpl->tpl_vars['list_value']->value['id']),$_smarty_tpl ) );
$_prefixVariable1 = ob_get_clean();
$_smarty_tpl->_assignInScope('id_Job_position', $_prefixVariable1);?>
   <?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['display'][0], array( array('property'=>'id_Job_ExperienceNeeded','assign'=>'Job_ExperienceNeeded'),$_smarty_tpl ) );?>

<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['display'][0], array( array('property'=>'id_Job_CareerLevel','assign'=>'Job_CareerLevel'),$_smarty_tpl ) );?>

<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['display'][0], array( array('property'=>'EmploymentType','assign'=>'EmploymentType'),$_smarty_tpl ) );?>

<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['display'][0], array( array('property'=>'id_Job_Rmunrationpropose','assign'=>'Rmunrationpropose'),$_smarty_tpl ) );?>

<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['display'][0], array( array('property'=>'id_Job_Niveaudtudes','assign'=>'Job_Niveaudtudes'),$_smarty_tpl ) );?>

<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['display'][0], array( array('property'=>'id_Job_Langue','assign'=>'Job_Langue'),$_smarty_tpl ) );?>

<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['display'][0], array( array('property'=>'id_Job_Genre','assign'=>'Job_Genre'),$_smarty_tpl ) );?>


<?php if (!$_smarty_tpl->tpl_vars['resumeListingSID']->value) {
if ((isset($_smarty_tpl->tpl_vars['listing']->value['ApplicationSettings']['add_parameter'])) && $_smarty_tpl->tpl_vars['listing']->value['ApplicationSettings']['add_parameter'] == 2) {
$_smarty_tpl->_assignInScope('isApplied', false);
if ($_smarty_tpl->tpl_vars['listing']->value['user']['isJobg8'] && $_smarty_tpl->tpl_vars['listing']->value['jobType'] == 'APPLICATION') {
$_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', 'applyBtn_onClick', null);
echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/apply-now-external/?listing_id=<?php echo $_smarty_tpl->tpl_vars['listing']->value['id'];
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);
} else {
$_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', 'url', null);
echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/apply-now/?listing_id=<?php echo $_smarty_tpl->tpl_vars['listing']->value['id'];?>
&ajaxRelocate=1
<?php $_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);
}
} else {
$_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', 'url', null);
echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/apply-now/?listing_id=<?php echo $_smarty_tpl->tpl_vars['listing']->value['id'];?>
&ajaxRelocate=1
<?php $_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);
}
$_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', 'modalTitle', null);
$_smarty_tpl->_assignInScope('job_title', htmlspecialchars((string)$_smarty_tpl->tpl_vars['listing']->value['Title'], ENT_QUOTES, 'UTF-8', true));
$_smarty_tpl->_assignInScope('company_name', htmlspecialchars((string)$_smarty_tpl->tpl_vars['listing']->value['user']['CompanyName'], ENT_QUOTES, 'UTF-8', true));
$_block_plugin8 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin8, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin8->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Apply to $job_title at $company_name<?php $_block_repeat=false;
echo $_block_plugin8->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);
}?>

<div class="listing-results">

<div class="jd-sticky-bar" id="jdStickyBar">
  <div class="jd-sticky-left">
    <?php if ($_smarty_tpl->tpl_vars['listing']->value['user']['Logo']['file_url']) {?>
    <div class="jd-sticky-logo"><img src="<?php echo $_smarty_tpl->tpl_vars['listing']->value['user']['Logo']['file_url'];?>
" alt=""></div>
    <?php }?>
    <div>
      <div class="jd-sticky-title"><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['listing']->value['Title'], ENT_QUOTES, 'UTF-8', true);?>
</div>
      <div class="jd-sticky-meta"><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['listing']->value['user']['CompanyName'], ENT_QUOTES, 'UTF-8', true);?>
 <?php if (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'location' ][ 0 ], array( $_smarty_tpl->tpl_vars['listing']->value ))) {?>· <?php $_smarty_tpl->_assignInScope('location', call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'location' ][ 0 ], array( $_smarty_tpl->tpl_vars['listing']->value )));
$_smarty_tpl->_assignInScope('parts', smarty_modifier_explode(",",$_smarty_tpl->tpl_vars['location']->value));
$_smarty_tpl->_assignInScope('total', smarty_modifier_count($_smarty_tpl->tpl_vars['parts']->value));
if ($_smarty_tpl->tpl_vars['parts']->value[$_smarty_tpl->tpl_vars['total']->value-2]) {
echo $_smarty_tpl->tpl_vars['parts']->value[$_smarty_tpl->tpl_vars['total']->value-2];?>
,<?php }
if ($_smarty_tpl->tpl_vars['parts']->value[$_smarty_tpl->tpl_vars['total']->value-1]) {
echo $_smarty_tpl->tpl_vars['parts']->value[$_smarty_tpl->tpl_vars['total']->value-1];
}
}?></div>
    </div>
  </div>
  <div class="jd-sticky-right">
    <?php if (!$_smarty_tpl->tpl_vars['resumeListingSID']->value) {?>
    <?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['current_user']['user_group_sid'] == '36' || $_smarty_tpl->tpl_vars['GLOBALS']->value['current_user']['logged_in'] == false) {?>
    <?php if ($_smarty_tpl->tpl_vars['isActive']->value) {?>
    <button type="button" class="jd-sticky-btn-apply"
      data-toggle="modal"
      data-target="#apply-modal"
      data-href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
"
      data-applied='<?php if ($_smarty_tpl->tpl_vars['isApplied']->value) {?>applied<?php }?>'
      data-title="<?php echo $_smarty_tpl->tpl_vars['modalTitle']->value;?>
">Postuler</button>
    <?php }?>
    <?php }?>
    <?php }?>
  </div>
</div>

<div class="jd-page">

<div class="jd-breadcrumb hidden-xs">
  <a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
" alt="Emploi Maroc" title="Emploi Maroc">Emploi Maroc</a> &raquo; <a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];
echo $_smarty_tpl->tpl_vars['breadCrumbs_link']->value;?>
" alt="<?php $_block_plugin9 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin9, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin9->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['breadCrumbs_html']->value;
$_block_repeat=false;
echo $_block_plugin9->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>" title="<?php $_block_plugin10 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin10, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin10->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['breadCrumbs_html']->value;
$_block_repeat=false;
echo $_block_plugin10->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>"><?php $_block_plugin11 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin11, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin11->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['breadCrumbs_html']->value;
$_block_repeat=false;
echo $_block_plugin11->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a> &raquo; <?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['listing']->value['Title'], ENT_QUOTES, 'UTF-8', true);?>

</div>

<?php if ($_smarty_tpl->tpl_vars['url']->value == "/my-job-details/".((string)$_smarty_tpl->tpl_vars['listing']->value['id'])."/") {?>
<a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/edit-<?php echo $_smarty_tpl->tpl_vars['listing']->value['type']['id'];?>
/?listing_id=<?php echo $_smarty_tpl->tpl_vars['listing']->value['id'];?>
" class="jd-btn-sec" style="margin-bottom:16px;display:inline-block"> &laquo; <?php $_block_plugin12 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin12, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin12->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Back<?php $_block_repeat=false;
echo $_block_plugin12->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?> </a>
<?php $_block_plugin13 = isset($_smarty_tpl->smarty->registered_plugins['block']['javascript'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['javascript'][0][0] : null;
if (!is_callable(array($_block_plugin13, '_tpl_javascript'))) {
throw new SmartyException('block tag \'javascript\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('javascript', array());
$_block_repeat=true;
echo $_block_plugin13->_tpl_javascript(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo '<script'; ?>
 type="text/javascript">
if (window.history && window.history.pushState) {
	window.history.pushState('forward', null, '');
	$(window).on('popstate', function() {
		window.location.href = '<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/edit-<?php echo $_smarty_tpl->tpl_vars['listing']->value['type']['id'];?>
/?listing_id=<?php echo $_smarty_tpl->tpl_vars['listing']->value['id'];?>
';
	});
}
<?php echo '</script'; ?>
>
<?php $_block_repeat=false;
echo $_block_plugin13->_tpl_javascript(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
}?>

<div class="jd-layout">

<div class="jd-header" id="jdHeader">
  <div class="jd-header-accent"></div>
  <div class="jd-header-inner">
    <?php if (($_smarty_tpl->tpl_vars['listing']->value['user']['featured'] == 1 || $_smarty_tpl->tpl_vars['listing']->value['featured'] == 1) && $_smarty_tpl->tpl_vars['listing']->value['user']['Logo']['file_url']) {?>
    <div class="jd-company-logo">
      <a href="<?php if ($_smarty_tpl->tpl_vars['listing']->value['user']['isJobg8']) {
echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/company/<?php echo $_smarty_tpl->tpl_vars['listing']->value['user']['id'];?>
/<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'pretty_url' ][ 0 ], array( $_smarty_tpl->tpl_vars['listing']->value['CompanyName'] ));?>
/<?php } else {
echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/company/<?php echo $_smarty_tpl->tpl_vars['listing']->value['user']['id'];?>
/<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'pretty_url' ][ 0 ], array( $_smarty_tpl->tpl_vars['listing']->value['user']['CompanyName'] ));?>
/<?php }?>">
        <img src="<?php echo $_smarty_tpl->tpl_vars['listing']->value['user']['Logo']['file_url'];?>
" alt="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['listing']->value['user']['CompanyName'], ENT_QUOTES, 'UTF-8', true);?>
">
      </a>
    </div>
    <?php }?>
    <div class="jd-header-info">
      <h1 class="jd-title"><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['listing']->value['Title'], ENT_QUOTES, 'UTF-8', true);?>
</h1>
      <div class="jd-meta">
        <a href="<?php if ($_smarty_tpl->tpl_vars['listing']->value['user']['isJobg8']) {
echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/company/<?php echo $_smarty_tpl->tpl_vars['listing']->value['user']['id'];?>
/<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'pretty_url' ][ 0 ], array( $_smarty_tpl->tpl_vars['listing']->value['CompanyName'] ));?>
/<?php } else {
echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/company/<?php echo $_smarty_tpl->tpl_vars['listing']->value['user']['id'];?>
/<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'pretty_url' ][ 0 ], array( $_smarty_tpl->tpl_vars['listing']->value['user']['CompanyName'] ));?>
/<?php }?>"><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['listing']->value['user']['CompanyName'], ENT_QUOTES, 'UTF-8', true);?>
</a>
        <?php if ($_smarty_tpl->tpl_vars['listing']->value['user']['featured'] == 1 || $_smarty_tpl->tpl_vars['listing']->value['featured'] == 1) {?>
        <span class="jd-verified">
          <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><defs><path d="M7.851 1.465a.253.253 0 0 1 .038.104.253.253 0 0 1-.038.105L3.196 7.229c-.075.07-.13.104-.168.104-.063 0-.125-.029-.187-.086L.205 4.885l-.056-.052A.253.253 0 0 1 .11 4.73c0-.011.013-.04.038-.087l.037-.034c.349-.348.623-.614.823-.799.074-.07.124-.104.15-.104.049 0 .111.035.186.104l1.496 1.354L6.58.701c.024-.023.061-.034.111-.034A.32.32 0 0 1 6.823.7l1.028.764Z" id="v_a"></path></defs><g fill="none" fill-rule="evenodd"><path d="m14.686 6.089.218-2.096-1.925-.857a.278.278 0 0 1-.141-.141l-.857-1.926-2.096.22a.28.28 0 0 1-.192-.052L7.987 0 6.28 1.237a.28.28 0 0 1-.191.051L3.992 1.07l-.856 1.926a.276.276 0 0 1-.141.14l-1.926.858.22 2.096a.278.278 0 0 1-.052.191L0 7.987l1.237 1.706c.04.056.058.124.051.192l-.219 2.096 1.926.857a.278.278 0 0 1 .14.14l.857 1.926 2.097-.219.027-.001c.059 0 .116.018.163.053l1.708 1.237 1.706-1.237a.277.277 0 0 1 .192-.052l2.096.22.857-1.926a.277.277 0 0 1 .14-.141l1.926-.857-.218-2.096a.277.277 0 0 1 .051-.192l1.237-1.706-1.237-1.707a.277.277 0 0 1-.051-.191Z" fill="#0055D9"></path><use fill="#FFF" fill-rule="nonzero" xlink:href="#v_a" transform="translate(4 4)"></use></g></svg>
        </span>
        <?php }?>
        <?php if (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'location' ][ 0 ], array( $_smarty_tpl->tpl_vars['listing']->value ))) {?>
        <span class="jd-sep">&middot;</span>
        <span class="job-card__tag job-card__tag--location">
        <?php $_smarty_tpl->_assignInScope('location', call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'location' ][ 0 ], array( $_smarty_tpl->tpl_vars['listing']->value )));?>
        <?php $_smarty_tpl->_assignInScope('parts', smarty_modifier_explode(",",$_smarty_tpl->tpl_vars['location']->value));?>
        <?php $_smarty_tpl->_assignInScope('total', smarty_modifier_count($_smarty_tpl->tpl_vars['parts']->value));?>
        <?php if ($_smarty_tpl->tpl_vars['parts']->value[$_smarty_tpl->tpl_vars['total']->value-2]) {
echo $_smarty_tpl->tpl_vars['parts']->value[$_smarty_tpl->tpl_vars['total']->value-2];?>
,<?php }
if ($_smarty_tpl->tpl_vars['parts']->value[$_smarty_tpl->tpl_vars['total']->value-1]) {
echo $_smarty_tpl->tpl_vars['parts']->value[$_smarty_tpl->tpl_vars['total']->value-1];
}?>
        <?php }?></span>
        <?php $_smarty_tpl->_assignInScope('myDate', $_smarty_tpl->tpl_vars['listing']->value['activation_date']);?>
        <span class="jd-sep">&middot;</span>
        <span class="job-card__tag job-card__tag--date">
        <?php if (smarty_modifier_timeAgo($_smarty_tpl->tpl_vars['myDate']->value) == "à l\'instant") {
} else { ?>Il y a <?php }
echo smarty_modifier_timeAgo($_smarty_tpl->tpl_vars['myDate']->value);?>
</span>
      </div>

            <?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] != '/job-preview/' && $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] != '/my-job-details/') {?>
      <div class="jd-actions">
        <?php if (!$_smarty_tpl->tpl_vars['resumeListingSID']->value) {?>
        <?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['current_user']['user_group_sid'] == '36' || $_smarty_tpl->tpl_vars['GLOBALS']->value['current_user']['logged_in'] == false) {?>
        <?php if ($_smarty_tpl->tpl_vars['isActive']->value) {?>
        <button type="button" class="jd-btn-apply"
          href="<?php echo $_smarty_tpl->tpl_vars['applyBtn_onClick']->value;?>
"
          data-toggle="modal"
          data-target="#apply-modal"
          data-href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
"
          data-applied='<?php if ($_smarty_tpl->tpl_vars['isApplied']->value) {?>applied<?php }?>'
          data-title="<?php echo $_smarty_tpl->tpl_vars['modalTitle']->value;?>
">Postuler maintenant</button>
        <?php }?>
        <?php }?>
        <?php }?>

        <div class="jd-share-container">
          <button class="jd-btn-sec jd-share-toggle"><i class="fa-solid fa-share"></i> Partager</button>
          <div class="jd-share-icons">
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/job/<?php echo $_smarty_tpl->tpl_vars['listing']->value['id'];?>
" target="_blank"><i class="fab fa-facebook"></i></a>
            <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/job/<?php echo $_smarty_tpl->tpl_vars['listing']->value['id'];?>
" target="_blank"><i class="fab fa-linkedin"></i></a>
            <a href="https://twitter.com/intent/tweet?url=<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/job/<?php echo $_smarty_tpl->tpl_vars['listing']->value['id'];?>
" target="_blank"><i class="fab fa-x-twitter"></i></a>
            <a href="https://api.whatsapp.com/send?text=<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/job/<?php echo $_smarty_tpl->tpl_vars['listing']->value['id'];?>
" target="_blank"><i class="fab fa-whatsapp"></i></a>
          </div>
        </div>

        <?php if ($_smarty_tpl->tpl_vars['count_applicants']->value < 5) {?>
        <?php if (!$_smarty_tpl->tpl_vars['resumeListingSID']->value) {?>
        <?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['current_user']['user_group_sid'] == '36' || $_smarty_tpl->tpl_vars['GLOBALS']->value['current_user']['logged_in'] == false) {?>
        <?php if ($_smarty_tpl->tpl_vars['isActive']->value) {?>
        <span class="jd-first-badge">Soyez le 1<sup>er</sup> à postuler</span>
        <?php }
}
}?>
        <?php }?>
      </div>
      <?php }?>

            <?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/job-preview/' || $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/my-job-details/') {?>
      <div class="jd-preview-btns" style="margin-top:14px">
        <form action="<?php echo $_smarty_tpl->tpl_vars['referer']->value;?>
" method="post">
          <input type="hidden" name="from-preview" value="1" />
          <input type="submit" name="edit_temp_listing" value="<?php $_block_plugin14 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin14, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin14->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Edit<?php $_block_repeat=false;
echo $_block_plugin14->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>" class="jd-btn-sec" id="listing-preview" />
          <?php if ($_smarty_tpl->tpl_vars['contract_id']->value == 0 && !$_smarty_tpl->tpl_vars['checkouted']->value) {?>
          <input type="hidden" name="proceed_to_checkout" />
          <input type="submit" name="action_add" value="<?php $_block_plugin15 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin15, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin15->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Post<?php $_block_repeat=false;
echo $_block_plugin15->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>" class="jd-btn-apply" />
          <?php } else { ?>
          <input type="submit" name="action_add" value="<?php $_block_plugin16 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin16, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin16->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Post<?php $_block_repeat=false;
echo $_block_plugin16->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>" class="jd-btn-apply" />
          <?php }?>
        </form>
      </div>
      <?php }?>
    </div>
  </div>
  <div class="jd-header-bottom">
    <span>Postes vacants : <strong><?php ob_start();
echo intval($_smarty_tpl->tpl_vars['id_Job_position']->value);
$_prefixVariable2 = ob_get_clean();
if ($_prefixVariable2 > 1) {
echo intval($_smarty_tpl->tpl_vars['id_Job_position']->value);?>
 postes ouverts<?php } else { ?>1 poste ouvert<?php }?></strong></span>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['form_fields']->value, 'list_value');
$_smarty_tpl->tpl_vars['list_value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['list_value']->value) {
$_smarty_tpl->tpl_vars['list_value']->do_else = false;
?>
    <?php if ($_smarty_tpl->tpl_vars['list_value']->value['caption'] == 'Date d\'expiration') {?>
    <?php ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['display'][0], array( array('property'=>$_smarty_tpl->tpl_vars['list_value']->value['id']),$_smarty_tpl ) );
$_prefixVariable3 = ob_get_clean();
if ($_prefixVariable3) {?>
    <span>Expire le <strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['display'][0], array( array('property'=>$_smarty_tpl->tpl_vars['list_value']->value['id']),$_smarty_tpl ) );?>
</strong></span>
    <?php }?>
    <?php }?>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
  </div>
</div>

<div class="jd-content">

    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['form_fields']->value, 'list_value');
$_smarty_tpl->tpl_vars['list_value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['list_value']->value) {
$_smarty_tpl->tpl_vars['list_value']->do_else = false;
?>
  <?php if ($_smarty_tpl->tpl_vars['list_value']->value['caption'] != 'Location' && $_smarty_tpl->tpl_vars['list_value']->value['id'] != 'Title' && $_smarty_tpl->tpl_vars['list_value']->value['id'] != 'ApplicationSettings' && $_smarty_tpl->tpl_vars['list_value']->value['id'] != 'JobCategory' && $_smarty_tpl->tpl_vars['list_value']->value['id'] != 'EmploymentType' && $_smarty_tpl->tpl_vars['list_value']->value['id'] != 'id_Job_Experience' && $_smarty_tpl->tpl_vars['list_value']->value['id'] != 'id_Job_CareerLevel' && $_smarty_tpl->tpl_vars['list_value']->value['id'] != 'id_Job_Vacancies' && $_smarty_tpl->tpl_vars['list_value']->value['id'] != 'id_Job_Langue' && $_smarty_tpl->tpl_vars['list_value']->value['id'] != 'id_Job_Niveaudtude' && $_smarty_tpl->tpl_vars['list_value']->value['id'] != 'id_Job_Rmunrationpropose' && $_smarty_tpl->tpl_vars['list_value']->value['id'] != 'id_Job_Genre' && $_smarty_tpl->tpl_vars['list_value']->value['id'] != 'email_notify') {?>

  <?php if ($_smarty_tpl->tpl_vars['list_value']->value['caption'] == 'Date d\'expiration') {?>
      <?php } elseif ($_smarty_tpl->tpl_vars['list_value']->value['id'] == 'id_Job_MotsCls') {?>
        <div class="jd-section">
      <h2 class="jd-section-title"><span class="jd-icon">&#128204;</span> Informations cl&eacute;s</h2>
      <div class="jd-info-grid">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['form_fields']->value, 'info_value');
$_smarty_tpl->tpl_vars['info_value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['info_value']->value) {
$_smarty_tpl->tpl_vars['info_value']->do_else = false;
?>
        <?php if ($_smarty_tpl->tpl_vars['info_value']->value['id'] == 'EmploymentType' || $_smarty_tpl->tpl_vars['info_value']->value['id'] == 'id_Job_Experience' || $_smarty_tpl->tpl_vars['info_value']->value['id'] == 'id_Job_CareerLevel' || $_smarty_tpl->tpl_vars['info_value']->value['id'] == 'id_Job_Vacancies' || $_smarty_tpl->tpl_vars['info_value']->value['id'] == 'id_Job_Langue' || $_smarty_tpl->tpl_vars['info_value']->value['id'] == 'id_Job_Niveaudtude' || $_smarty_tpl->tpl_vars['info_value']->value['id'] == 'id_Job_Rmunrationpropose' || $_smarty_tpl->tpl_vars['info_value']->value['id'] == 'id_Job_Genre') {?>
        <?php if ($_smarty_tpl->tpl_vars['info_value']->value['id'] == 'id_Job_Vacancies') {?>
          <div class="jd-info-box">
            <div class="jd-label">Postes vacants</div>
            <div class="jd-value"><?php ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['display'][0], array( array('property'=>$_smarty_tpl->tpl_vars['info_value']->value['id']),$_smarty_tpl ) );
$_prefixVariable4 = ob_get_clean();
if ($_prefixVariable4 > 1) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['display'][0], array( array('property'=>$_smarty_tpl->tpl_vars['info_value']->value['id']),$_smarty_tpl ) );?>
 postes ouverts<?php } else { ?>1 poste ouvert<?php }?></div>
          </div>
        <?php } else { ?>
          <?php ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['display'][0], array( array('property'=>$_smarty_tpl->tpl_vars['info_value']->value['id']),$_smarty_tpl ) );
$_prefixVariable5 = ob_get_clean();
if ($_prefixVariable5) {?>
          <div class="jd-info-box">
            <div class="jd-label"><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['info_value']->value['caption'], ENT_QUOTES, 'UTF-8', true);?>
</div>
            <div class="jd-value"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['display'][0], array( array('property'=>$_smarty_tpl->tpl_vars['info_value']->value['id']),$_smarty_tpl ) );?>
</div>
          </div>
          <?php }?>
        <?php }?>
        <?php }?>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
      </div>
    </div>
        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['display'][0], array( array('property'=>'id_Job_MotsCls','assign'=>'tags'),$_smarty_tpl ) );?>

    <?php $_smarty_tpl->_assignInScope('parts', smarty_modifier_explode(",",$_smarty_tpl->tpl_vars['tags']->value));?>
    <?php if (smarty_modifier_count($_smarty_tpl->tpl_vars['parts']->value) > 0 && $_smarty_tpl->tpl_vars['parts']->value[0] != '') {?>
    <div class="jd-section">
      <h2 class="jd-section-title"><span class="jd-icon">&#127991;&#65039;</span> Mots-cl&eacute;s</h2>
      <div class="jd-keywords">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['parts']->value, 'tag', false, 'key');
$_smarty_tpl->tpl_vars['tag']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['tag']->value) {
$_smarty_tpl->tpl_vars['tag']->do_else = false;
?>
        <a class="jd-keyword" href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/jobs/?listing_type%5Bequal%5D=Job&action=search&keywords%5Ball_words%5D=<?php echo trim($_smarty_tpl->tpl_vars['tag']->value);?>
&GooglePlace%5Blocation%5D%5Bvalue%5D=&GooglePlace%5Blocation%5D%5Bradius%5D=50"><?php echo trim($_smarty_tpl->tpl_vars['tag']->value);?>
</a>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
      </div>
    </div>
    <?php }?>
  <?php } else { ?>
    <?php ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['display'][0], array( array('property'=>$_smarty_tpl->tpl_vars['list_value']->value['id']),$_smarty_tpl ) );
$_prefixVariable6 = ob_get_clean();
if ($_prefixVariable6) {?>
    <div class="jd-section">
      <h2 class="jd-section-title"><span class="jd-icon">&#128203;</span> <?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['list_value']->value['caption'], ENT_QUOTES, 'UTF-8', true);?>
</h2>
      <div class="details-body__content content-text"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['display'][0], array( array('property'=>$_smarty_tpl->tpl_vars['list_value']->value['id']),$_smarty_tpl ) );?>
</div>
    </div>
    <?php }?>
  <?php }?>

  <?php }?>
  <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

    <?php if (!$_smarty_tpl->tpl_vars['resumeListingSID']->value) {?>
  <?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['current_user']['user_group_sid'] == '36' || $_smarty_tpl->tpl_vars['GLOBALS']->value['current_user']['logged_in'] == false) {?>
  <?php if ($_smarty_tpl->tpl_vars['isActive']->value) {?>
  <!--<div class="jd-bottom-cta">
    <p>Cette offre vous int&eacute;resse ?</p>
    <button type="button" class="jd-btn-apply"
      href="<?php echo $_smarty_tpl->tpl_vars['applyBtn_onClick']->value;?>
"
      data-toggle="modal"
      data-target="#apply-modal"
      data-href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
"
      data-applied='<?php if ($_smarty_tpl->tpl_vars['isApplied']->value) {?>applied<?php }?>'
      data-title="<?php echo $_smarty_tpl->tpl_vars['modalTitle']->value;?>
">Postuler maintenant</button>
  </div>-->
  <?php }?>
  <?php }?>
  <?php }?>

</div>

<?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] != '/job-preview/' && $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] != '/my-job-details/') {?>
<div class="jd-sidebar">

    <?php if ($_smarty_tpl->tpl_vars['listing']->value['user']['featured'] == 1) {?>
  <div class="jd-side-card jd-company-side">
    <?php if ($_smarty_tpl->tpl_vars['listing']->value['user']['Logo']['file_url']) {?>
    <div class="jd-logo-lg">
      <a href="<?php if ($_smarty_tpl->tpl_vars['listing']->value['user']['isJobg8']) {
echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/company/<?php echo $_smarty_tpl->tpl_vars['listing']->value['user']['id'];?>
/<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'pretty_url' ][ 0 ], array( $_smarty_tpl->tpl_vars['listing']->value['CompanyName'] ));?>
/<?php } else {
echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/company/<?php echo $_smarty_tpl->tpl_vars['listing']->value['user']['id'];?>
/<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'pretty_url' ][ 0 ], array( $_smarty_tpl->tpl_vars['listing']->value['user']['CompanyName'] ));?>
/<?php }?>">
        <img src="<?php echo $_smarty_tpl->tpl_vars['listing']->value['user']['Logo']['file_url'];?>
" alt="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['listing']->value['user']['CompanyName'], ENT_QUOTES, 'UTF-8', true);?>
">
      </a>
    </div>
    <?php }?>
    <div class="jd-name"><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['listing']->value['user']['CompanyName'], ENT_QUOTES, 'UTF-8', true);?>
</div>
    <?php if (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'location' ][ 0 ], array( $_smarty_tpl->tpl_vars['listing']->value ))) {?><div class="jd-loc"><?php $_smarty_tpl->_assignInScope('location', call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'location' ][ 0 ], array( $_smarty_tpl->tpl_vars['listing']->value )));
$_smarty_tpl->_assignInScope('parts', smarty_modifier_explode(",",$_smarty_tpl->tpl_vars['location']->value));
$_smarty_tpl->_assignInScope('total', smarty_modifier_count($_smarty_tpl->tpl_vars['parts']->value));
if ($_smarty_tpl->tpl_vars['parts']->value[$_smarty_tpl->tpl_vars['total']->value-2]) {
echo $_smarty_tpl->tpl_vars['parts']->value[$_smarty_tpl->tpl_vars['total']->value-2];?>
,<?php }
if ($_smarty_tpl->tpl_vars['parts']->value[$_smarty_tpl->tpl_vars['total']->value-1]) {
echo $_smarty_tpl->tpl_vars['parts']->value[$_smarty_tpl->tpl_vars['total']->value-1];
}?></div><?php }?>
    <p class="jd-desc"><?php echo smarty_modifier_truncate(preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['listing']->value['user']['CompanyDescription'] ?: ''),180);?>
</p>
    <a class="jd-link" href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/company/<?php echo $_smarty_tpl->tpl_vars['listing']->value['user']['id'];?>
/<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'pretty_url' ][ 0 ], array( $_smarty_tpl->tpl_vars['listing']->value['user']['CompanyName'] ));?>
/">Voir les offres &rarr;</a>
  </div>
  <?php }?>

    <div class="jd-side-card">
    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['module'][0], array( array('name'=>"classifieds",'function'=>"plus_city_listings",'items_count'=>"5",'listing_type'=>"Job",'listing_id'=>$_smarty_tpl->tpl_vars['listing']->value['id']),$_smarty_tpl ) );?>

  </div>

    <div class="jd-side-card">
    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['module'][0], array( array('name'=>"classifieds",'function'=>"plus_category_listings",'items_count'=>"9",'listing_type'=>"Job",'listing_id'=>$_smarty_tpl->tpl_vars['listing']->value['id']),$_smarty_tpl ) );?>

  </div>

    <div class="jd-side-card">
    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['module'][0], array( array('name'=>"classifieds",'function'=>"plus_featured_listings",'items_count'=>"4",'listing_type'=>"Job",'listing_id'=>$_smarty_tpl->tpl_vars['listing']->value['id']),$_smarty_tpl ) );?>

  </div>

    <div class="jd-side-card jd-cta-dark">
    <div class="card-title">D&eacute;couvrez plus d'emplois</div>
    <p>Rejoignez Jobsquare et d&eacute;couvrez toutes les entreprises qui recrutent au Maroc.</p>
    <a class="jd-cta-btn" href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/registration/?user_group_id=JobSeeker">Rejoignez-nous</a>
  </div>

    <div class="jd-side-card jd-cta-light">
    <div class="card-title">Employeur ?</div>
    <p>Inscrivez-vous et <a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/registration/?user_group_id=Employer">publiez vos offres</a> gratuitement.</p>
  </div>

    <?php if ($_smarty_tpl->tpl_vars['listing']->value['user']['featured'] != 1 && $_smarty_tpl->tpl_vars['listing']->value['featured'] != 1) {?>
  <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['module'][0], array( array('name'=>"banners",'function'=>"show_banners",'group'=>"Dispaly_right"),$_smarty_tpl ) );?>

  <?php }?>

</div>
<?php }?>

</div></div>
<?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] != '/job-preview/' && $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] != '/my-job-details/') {?>
<div class="jd-below-grid">
  <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['module'][0], array( array('name'=>"classifieds",'function'=>"featured_listings_sponsorise",'items_count'=>"2",'listing_type'=>"Job",'listing_id'=>$_smarty_tpl->tpl_vars['listing']->value['id']),$_smarty_tpl ) );?>

  <div class="content-card offres-emploi-similaire">
    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['module'][0], array( array('name'=>"classifieds",'function'=>"featured_listings_interne",'items_count'=>"10",'listing_type'=>"Job",'listing_id'=>$_smarty_tpl->tpl_vars['listing']->value['id']),$_smarty_tpl ) );?>

  </div>
  <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['module'][0], array( array('name'=>"classifieds",'function'=>"plus_training_listings",'items_count'=>"10",'listing_type'=>"Training",'listing_id'=>$_smarty_tpl->tpl_vars['listing']->value['id']),$_smarty_tpl ) );?>

</div>
<?php }?>

<div class="jd-breadcrumb hidden-md hidden-lg" style="padding:10px">
  <a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
">Emploi Maroc</a> &raquo; <a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];
echo $_smarty_tpl->tpl_vars['breadCrumbs_link']->value;?>
"><?php $_block_plugin17 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin17, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin17->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['breadCrumbs_html']->value;
$_block_repeat=false;
echo $_block_plugin17->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a> &raquo; <?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['listing']->value['Title'], ENT_QUOTES, 'UTF-8', true);?>

</div>

</div>
<div class="details-footer <?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/job-preview/') {?>job-preview<?php }?>" id="footerjob">
	<div class="container"> <?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/job-preview/') {?>
		<div class="form-group job-preview__btns col-xs-12">
			<form action="<?php echo $_smarty_tpl->tpl_vars['referer']->value;?>
" method="post">
				<input type="hidden" name="from-preview" value="1" />
				<input type="submit" name="edit_temp_listing" value="<?php $_block_plugin18 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin18, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin18->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Edit<?php $_block_repeat=false;
echo $_block_plugin18->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>" class="btn btn-apply btn-primary btn-lg btn-block" id="listing-preview" />
				<?php if ($_smarty_tpl->tpl_vars['contract_id']->value == 0 && !$_smarty_tpl->tpl_vars['checkouted']->value) {?>
				<input type="hidden" name="proceed_to_checkout" />
				<input type="submit" name="action_add" value="<?php $_block_plugin19 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin19, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin19->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Post<?php $_block_repeat=false;
echo $_block_plugin19->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>" class="btn btn-apply btn-primary btn-lg btn-block" />
				<?php } else { ?>
				<input type="submit" name="action_add" value="<?php $_block_plugin20 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin20, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin20->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Post<?php $_block_repeat=false;
echo $_block_plugin20->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>" class="btn btn-apply btn-primary btn-lg btn-block" />
				<?php }?>
			</form>
		</div>
		<?php } else { ?>
		<?php if (!$_smarty_tpl->tpl_vars['resumeListingSID']->value) {?>
		<?php if ((isset($_smarty_tpl->tpl_vars['listing']->value['ApplicationSettings']['add_parameter'])) && $_smarty_tpl->tpl_vars['listing']->value['ApplicationSettings']['add_parameter'] == 2) {?>
		<?php $_smarty_tpl->_assignInScope('isApplied', false);?>
		<?php if ($_smarty_tpl->tpl_vars['listing']->value['user']['isJobg8'] && $_smarty_tpl->tpl_vars['listing']->value['jobType'] == 'APPLICATION') {?>
		<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', 'applyBtn_onClick', null);
echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/apply-now-external/?listing_id=<?php echo $_smarty_tpl->tpl_vars['listing']->value['id'];
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
		<?php } else { ?>
		<?php if (!$_smarty_tpl->tpl_vars['GLOBALS']->value['settings']['loggedin_apply'] || $_smarty_tpl->tpl_vars['GLOBALS']->value['current_user']['logged_in']) {?>
		<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', 'applyBtn_onClick', null);
echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/system/classifieds/application_redirect/?listing_id=<?php echo $_smarty_tpl->tpl_vars['listing']->value['id'];
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
		<?php } else { ?>
		<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', 'url', null);?>
		<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/apply-now/?listing_id=<?php echo $_smarty_tpl->tpl_vars['listing']->value['id'];?>
&ajaxRelocate=1
		<?php $_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
		<?php }?>
		<?php }?>
		<?php } else { ?>
		<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', 'url', null);?>
		<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/apply-now/?listing_id=<?php echo $_smarty_tpl->tpl_vars['listing']->value['id'];?>
&ajaxRelocate=1
		<?php $_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
		<?php }?>
		<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', 'modalTitle', null);?>
		<?php $_smarty_tpl->_assignInScope('job_title', htmlspecialchars((string)$_smarty_tpl->tpl_vars['listing']->value['Title'], ENT_QUOTES, 'UTF-8', true));?>
		<?php $_smarty_tpl->_assignInScope('company_name', htmlspecialchars((string)$_smarty_tpl->tpl_vars['listing']->value['user']['CompanyName'], ENT_QUOTES, 'UTF-8', true));?>
		<?php $_block_plugin21 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin21, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin21->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Apply to $job_title at $company_name<?php $_block_repeat=false;
echo $_block_plugin21->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
		<?php $_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
		<?php }?>
		<?php }?>
				<?php if (!$_smarty_tpl->tpl_vars['resumeListingSID']->value) {?>
		<?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['current_user']['user_group_sid'] == '36' || $_smarty_tpl->tpl_vars['GLOBALS']->value['current_user']['logged_in'] == false) {?>
		<?php if ($_smarty_tpl->tpl_vars['isActive']->value) {?>
		<div class="col-md-4"><a class="btn btn-apply btn-primary btn-lg btn-block"
					href="<?php echo $_smarty_tpl->tpl_vars['applyBtn_onClick']->value;?>
"
					data-toggle="modal"
					data-target="#apply-modal"
					data-href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
"
					data-applied='<?php if ($_smarty_tpl->tpl_vars['isApplied']->value) {?>applied<?php }?>'
					data-title="<?php echo $_smarty_tpl->tpl_vars['modalTitle']->value;?>
"> <?php $_block_plugin22 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin22, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin22->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Apply Now<?php $_block_repeat=false;
echo $_block_plugin22->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?> </a></div>
		<?php } else { ?> <br>
		<span> <span><b> Désolé, cette offre n'est plus disponible.</b></span></span>
		<?php }?>
		<?php }?>
		<?php } else { ?>
		<?php if ($_smarty_tpl->tpl_vars['resumeListingSID']->value == 'createResume') {?>
		<div class="col-md-4"><a target="_self" class="btn btn-apply btn-primary btn-lg btn-block" href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/add-listing/?listing_type_id=Resume&redirectBackToJobID=<?php echo $_smarty_tpl->tpl_vars['listing']->value['id'];?>
&productSID=8&proceed_to_posting=1"><?php $_block_plugin23 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin23, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin23->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Apply Now<?php $_block_repeat=false;
echo $_block_plugin23->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a></div>
		<?php } else { ?>
		<div class="col-md-4"><a target="_self" class="btn btn-apply btn-primary btn-lg btn-block" href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/edit-resume/?listing_id=<?php echo $_smarty_tpl->tpl_vars['resumeListingSID']->value;?>
&redirectBackToJobID=<?php echo $_smarty_tpl->tpl_vars['listing']->value['id'];?>
"><?php $_block_plugin24 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin24, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin24->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Apply Now<?php $_block_repeat=false;
echo $_block_plugin24->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a></div>
		<?php }?>

		<?php }?>
		<div class="social-share pull-right"> <span class="social-share__title"> <?php $_block_plugin25 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin25, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin25->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Share this job<?php $_block_repeat=false;
echo $_block_plugin25->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>: </span> <?php if (!$_smarty_tpl->tpl_vars['myListing']->value) {?>
			<div class="social-share__icons"> <span class='st_facebook_large' displayText='Facebook'></span> <span class='st_twitter_large' displayText='Tweet'></span> <span class='st_googleplus_large' displayText='Google +'></span> <span class='st_linkedin_large' displayText='LinkedIn'></span> <span class='st_pinterest_large' displayText='Pinterest'></span> <span class='st_email_large' displayText='Email'></span> </div>
			<?php }?> </div>
	</div>
</div>

<?php echo '<script'; ?>
 type="text/javascript">var switchTo5x=true;<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="https://ws.sharethis.com/button/buttons.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">stLight.options({publisher: "3f1014ed-afda-46f1-956a-a51d42078320", doNotHash: false, doNotCopy: false, hashAddressBar: false});<?php echo '</script'; ?>
>

<?php $_block_plugin26 = isset($_smarty_tpl->smarty->registered_plugins['block']['javascript'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['javascript'][0][0] : null;
if (!is_callable(array($_block_plugin26, '_tpl_javascript'))) {
throw new SmartyException('block tag \'javascript\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('javascript', array());
$_block_repeat=true;
echo $_block_plugin26->_tpl_javascript(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo '<script'; ?>
 type="text/javascript">
		dockDetailsFooter();
		$(window).on('resize orientationchange', function(){
			dockDetailsFooter();
		});

		function dockDetailsFooter() {
			$(".details-footer").affix({
				offset: {
					bottom: function () {
						return (this.bottom = $('.footer').outerHeight(true))
					}
				}
			});
		}
        <?php if (!$_smarty_tpl->tpl_vars['resumeListingSID']->value) {?>
		$('.details-footer .btn-apply').on('click', function(e) {
			if ($(this).attr('href') != '') {
				e.preventDefault();
				e.stopPropagation();
				window.open($(this).attr('href'));
			}
		});
        <?php }?>

		$('.alert__close').on('click', function(e) {
			e.preventDefault();
			$(this).closest('.alert').hide();
		});

		// Sticky bar
		var jdStickyBar = document.getElementById('jdStickyBar');
		var jdHeader = document.getElementById('jdHeader');
		if (jdStickyBar && jdHeader) {
			window.addEventListener('scroll', function() {
				if (jdHeader.getBoundingClientRect().bottom < 0) {
					jdStickyBar.classList.add('jd-visible');
				} else {
					jdStickyBar.classList.remove('jd-visible');
				}
			});
		}

		// Share toggle
		$(document).on('click', '.jd-share-toggle', function(e) {
			e.stopPropagation();
			$(this).siblings('.jd-share-icons').toggleClass('jd-show');
		});
		$(document).on('click', function() {
			$('.jd-share-icons').removeClass('jd-show');
		});
	<?php echo '</script'; ?>
>
<?php $_block_repeat=false;
echo $_block_plugin26->_tpl_javascript(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
}
}
