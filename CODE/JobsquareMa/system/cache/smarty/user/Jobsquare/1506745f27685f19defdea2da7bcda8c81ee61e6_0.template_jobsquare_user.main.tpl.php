<?php
/* Smarty version 4.3.0, created on 2026-03-04 08:22:32
  from 'template_jobsquare_user:main.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a7ebc8edfc13_41871831',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1506745f27685f19defdea2da7bcda8c81ee61e6' => 
    array (
      0 => 'template_jobsquare_user:main.tpl',
      1 => 1772573825,
      2 => 'template_jobsquare_user',
    ),
  ),
  'includes' => 
  array (
    'template_jobsquare_user:../menu/header.tpl' => 1,
    'template_jobsquare_user:../menu/footer.tpl' => 1,
  ),
),false)) {
function content_69a7ebc8edfc13_41871831 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<meta name="keywords" content="<?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['settings']['home_page_keywords']) {
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['GLOBALS']->value['settings']['home_page_keywords'], ENT_QUOTES, 'UTF-8', true);
} else {
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['KEYWORDS']->value, ENT_QUOTES, 'UTF-8', true);
}?>">
	<meta name="description" content="<?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['settings']['home_page_description']) {
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['GLOBALS']->value['settings']['home_page_description'], ENT_QUOTES, 'UTF-8', true);
} else {
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['DESCRIPTION']->value, ENT_QUOTES, 'UTF-8', true);
}?>">
	<meta name="viewport" content="width=device-width, height=device-height,
                                   initial-scale=1.0, maximum-scale=1.0,
                                   target-densityDpi=device-dpi">
	<meta property="og:title" content="<?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['settings']['home_page_title']) {
echo $_smarty_tpl->tpl_vars['GLOBALS']->value['settings']['home_page_title'];
} else {
echo $_smarty_tpl->tpl_vars['GLOBALS']->value['settings']['site_title'];
}?>" />
	<meta property="og:image" content="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/templates/Jobsquare/assets/images/<?php echo rawurlencode((string)$_smarty_tpl->tpl_vars['GLOBALS']->value['theme_settings']['logo']);?>
" />
	
	<link rel="alternate" type="application/rss+xml" title="<?php $_block_plugin7 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin7, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin7->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Jobs<?php $_block_repeat=false;
echo $_block_plugin7->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>" href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/rss/">

	<title><?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['settings']['home_page_title']) {
echo $_smarty_tpl->tpl_vars['GLOBALS']->value['settings']['home_page_title'];
} else {
echo $_smarty_tpl->tpl_vars['GLOBALS']->value['settings']['site_title'];
}?></title>
	<?php $_block_plugin8 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin8, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array('metadata'=>$_smarty_tpl->tpl_vars['METADATA']->value['HEAD']));
$_block_repeat=true;
echo $_block_plugin8->translate(array('metadata'=>$_smarty_tpl->tpl_vars['METADATA']->value['HEAD']), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['HEAD']->value;
$_block_repeat=false;
echo $_block_plugin8->translate(array('metadata'=>$_smarty_tpl->tpl_vars['METADATA']->value['HEAD']), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">	<link href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/templates/Jobsquare/assets/third-party/jquery-ui.css" rel="stylesheet">

	<!-- Bootstrap -->
	<link href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/templates/Jobsquare/vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

	<link href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/templates/Jobsquare/assets/third-party/jquery.bxslider.css" rel="stylesheet">
	<link href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/templates/Jobsquare/assets/style/styles.css" rel="stylesheet">


	
	<style type="text/css"><?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['theme_settings']['custom_css'];?>
</style>
	<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['theme_settings']['custom_js'];?>

</head>
<body>
	<?php $_smarty_tpl->_subTemplateRender("template_jobsquare_user:../menu/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
	<section class="main-home-slider">
	
	<div class="">
		
	<div class="slide">
   	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['module'][0], array( array('name'=>"banners",'function'=>"show_banners",'group'=>"Type1"),$_smarty_tpl ) );?>

		<div class="quick-search__frontpage">
		<?php echo $_smarty_tpl->tpl_vars['MAIN_CONTENT']->value;?>

			</div>	
	</div>
	</div>
	
</section>
	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['module'][0], array( array('name'=>"users",'function'=>"featured_profiles",'items_count'=>"50"),$_smarty_tpl ) );?>

	<section class="main-sections main-sections__middle-banner middle-banner">
		<div class="container container-fluid text-center middle-banner__wrapper">
			<div class="middle-banner__block--wrapper">
				<?php $_block_plugin9 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin9, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin9->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['GLOBALS']->value['theme_settings']['secondary_banner_text'];
$_block_repeat=false;
echo $_block_plugin9->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
			</div>
		</div>
	</section>
	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['module'][0], array( array('name'=>"classifieds",'function'=>"latest_listings",'items_count'=>"9",'listing_type'=>"Job",'group_banner'=>"home_right_2"),$_smarty_tpl ) );?>

	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['module'][0], array( array('name'=>"classifieds",'function'=>"featured_listings_home",'items_count'=>"8",'listing_type'=>"Job",'group_banner'=>"home_right_1"),$_smarty_tpl ) );?>

	
	<div class="listebycategories test training_home_block">

	<?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['theme_settings']['jobs_by_category'] || $_smarty_tpl->tpl_vars['GLOBALS']->value['theme_settings']['jobs_by_city'] || $_smarty_tpl->tpl_vars['GLOBALS']->value['theme_settings']['jobs_by_state'] || $_smarty_tpl->tpl_vars['GLOBALS']->value['theme_settings']['jobs_by_country']) {?>
		<?php $_smarty_tpl->_assignInScope('isFirstBrowse', true);?>
		<section class="main-sections">
		<?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['theme_settings']['jobs_by_city']) {?>
	
		
		
		<div class="location "><div class="container">
	 <h2>Parcourir les offres d'emploi par ville</h2> <div class="line"></div> 
			<div class="row">
			 <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['module'][0], array( array('name'=>"classifieds",'function'=>"random_states",'Type'=>"Job"),$_smarty_tpl ) );?>

		
		</div>
		<div class="row list_categorie">
			
			<?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['theme_settings']['jobs_by_city']) {?>
							
								<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['module'][0], array( array('name'=>"classifieds",'function'=>"browse",'columns'=>3,'browseUrl'=>"/cities/",'browse_template'=>"browse_by_city.tpl"),$_smarty_tpl ) );?>

							
							
						<?php }?>										
		</div>
		
		</div></div>
		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['theme_settings']['jobs_by_category']) {?>

<div class="categories ">
	<div class="container">
	 <h2>Parcourir les offres d'emploi par catégorie</h2> <div class="line"></div>
			<div class="row">
			 <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['module'][0], array( array('name'=>"classifieds",'function'=>"random_secteurs",'Type'=>"Job"),$_smarty_tpl ) );?>

		</div>
		<div class="row list_categorie">
		

	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['module'][0], array( array('name'=>"classifieds",'function'=>"browse",'columns'=>3,'browseUrl'=>"/categories/",'browse_template'=>"browse_by_category.tpl"),$_smarty_tpl ) );?>


		
		</div>
</div>

</div>
	<?php }
if ($_smarty_tpl->tpl_vars['GLOBALS']->value['theme_settings']['jobs_by_state']) {?>



<div class="location">
	<div class="container">
	 <h2>Parcourir les offres d'emploi par Région</h2> <div class="line"></div>
			
		<div class="row list_categorie">
		
	     
<?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['theme_settings']['jobs_by_state']) {?>
								<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['module'][0], array( array('name'=>"classifieds",'function'=>"browse",'columns'=>3,'browseUrl'=>"/states/",'browse_template'=>"browse_by_state.tpl"),$_smarty_tpl ) );?>

						
						<?php }?>
						


		
		</div>
</div>
</div>
	<?php }?>
					
		</section>
	<?php }?>
	<!-- ===== BLOC ALERTE EMAIL ===== -->
	<section class="alert-section">
		<div class="alert-left">
			<h2>Recevez les <span>offres</span> par email</h2>
			<p>Soyez alerté des nouvelles opportunités. Désabonnement en un clic.</p>
		</div>
		<form action="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/guest-alerts/create/" method="post" id="create-alert" class="alert-form">
			<input type="hidden" name="action" value="save" />
			<input type="email" name="email" placeholder="✉  <?php $_block_plugin10 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin10, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin10->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Your email<?php $_block_repeat=false;
echo $_block_plugin10->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>">
			<select name="email_frequency">
				<option value="daily"><?php $_block_plugin11 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin11, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin11->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Daily<?php $_block_repeat=false;
echo $_block_plugin11->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></option>
				<option value="weekly"><?php $_block_plugin12 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin12, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin12->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Weekly<?php $_block_repeat=false;
echo $_block_plugin12->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></option>
				<option value="monthly"><?php $_block_plugin13 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin13, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin13->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Monthly<?php $_block_repeat=false;
echo $_block_plugin13->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></option>
			</select>
			<input type="submit" name="save" value="<?php $_block_plugin14 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin14, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin14->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Create alert<?php $_block_repeat=false;
echo $_block_plugin14->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>" class="alert-btn" onclick="return createAlert();">
		</form>
	</section></div>

	<!-- ===== BLOC SEO ===== -->
	<section class="seo-section">
		<div class="seo-header">
			<h2><span>Jobsquare.ma</span> — Le Portail N°1 de l'Emploi au Maroc</h2>
			<p>Trouvez le poste qui vous correspond, partout au Maroc</p>
		</div>

		<div class="seo-grid">
			<div class="seo-card">
				<h3><span class="icon">🔍</span> Des opportunités dans tous les secteurs</h3>
				<p>Industrie automobile à Tanger, finance à Casablanca, technologies à Rabat, tourisme à Marrakech et Agadir, agroalimentaire dans le Souss, artisanat à Fès... Jobsquare.ma vous donne un <a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/jobs/">accès direct aux meilleures offres d'emploi au Maroc</a>.</p>
			</div>

			<div class="seo-card">
				<h3><span class="icon">📄</span> Boostez votre candidature</h3>
				<p>Créez et <a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/my-listings/resume/">optimisez votre CV en ligne</a> en quelques minutes. Activez les alertes emploi, postulez en un clic. Plus votre profil est complet, plus vous êtes visible auprès des recruteurs.</p>
			</div>

			<div class="seo-card">
				<h3><span class="icon">🏢</span> Employeurs : recrutez les meilleurs profils</h3>
				<p>Publiez vos offres et accédez à une base de candidats qualifiés couvrant les 12 régions du Maroc. Que vous soyez une startup à Rabat ou une PME industrielle à Tanger, notre plateforme vous connecte aux talents.</p>
			</div>

			<div class="seo-card">
				<h3><span class="icon">🎓</span> Jeunes diplômés et stages PFE</h3>
				<p>Jobsquare.ma accompagne les étudiants et jeunes diplômés dans leur insertion professionnelle. Retrouvez des stages PFE, contrats ANAPEC et premiers emplois dans tous les secteurs.</p>
			</div>
		</div>

		<div class="seo-cta">
			<p><strong>Rejoignez Jobsquare.ma</strong> — Casablanca, Rabat, Tanger, Marrakech, Fès, Agadir, Meknès, Oujda et toutes les régions du Royaume.</p>
			<a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/registration/">S'inscrire gratuitement</a>
		</div>
	</section>
	
	
	<?php $_smarty_tpl->_subTemplateRender("template_jobsquare_user:../menu/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/templates/Jobsquare/assets/third-party/jquery.min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/templates/Jobsquare/vendor/twbs/bootstrap/dist/js/bootstrap.min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/templates/Jobsquare/assets/third-party/jquery.bxslider.min.js"><?php echo '</script'; ?>
>

	<?php echo '<script'; ?>
 language="JavaScript" type="text/javascript" src="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['common_js'][0], array( array(),$_smarty_tpl ) );?>
/main.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 language="JavaScript" type="text/javascript" src="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['common_js'][0], array( array(),$_smarty_tpl ) );?>
/multilist_functions.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 language="JavaScript" type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/templates/Jobsquare/assets/third-party/jquery.form.min.js"><?php echo '</script'; ?>
>
		<?php $_block_plugin15 = isset($_smarty_tpl->smarty->registered_plugins['block']['javascript'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['javascript'][0][0] : null;
if (!is_callable(array($_block_plugin15, '_tpl_javascript'))) {
throw new SmartyException('block tag \'javascript\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('javascript', array());
$_block_repeat=true;
echo $_block_plugin15->_tpl_javascript(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
		<?php echo '<script'; ?>
 language="javascript" type="text/javascript">
			document.addEventListener("touchstart", function() { }, false);

			function createAlert() {
				var options = {
					target: '.alert__messages',
					url:  $('#create-alert').attr('action'),
					success: function(data) {
						if (data) {
							$('#create-alert').find('.form-control[name="email"]').text('').val('');
							$('#create-alert').find('.btn').blur();
						}
						$('.alert__messages').find('#create-alert').remove();
					}
				};
				$('#create-alert').ajaxSubmit(options);
				return false;
			}

			$(document).ready(function() {
				$('.nav-pills li').on('click', function() {
					var current = $('.nav-pills').scrollLeft();
					var left = $(this).position().left;

					if ( $( this ).is(':first-child') ) {
						$('.nav-pills').scrollLeft(0);
					} else {
						$('.nav-pills').animate({
							scrollLeft: current + left - 15
						}, 300);
					}
				});
			});
		<?php echo '</script'; ?>
>
	<?php $_block_repeat=false;
echo $_block_plugin15->_tpl_javascript(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['js'][0], array( array(),$_smarty_tpl ) );?>

	
	<style>
	/*.quick-search__wrapper {
 
    background: #166bd9!important;
  
    border-color: #166bd9!important;
}
*/

.main-home-slider { padding:0px 0px 0px; background:#f9f9f9}

.featured-companies .bx-wrapper .bx-viewport {
    /*height: 190px !important;*/
}
.logo .logo__text img {
    display: inline-block;
    max-width: 100%;
    max-height: 65px;
}



@media (min-width: 992px)
{
	.logo {

    padding-bottom: 5px;
}

}




.listing__latest .listing__title {
    color: #777777;
    font-size: 32px;
    font-weight: 400;
}

.well.listing-item__jobs:hover {
    border: 1px solid  #009688; box-shadow:none 
}
.listing__featured-training .well.listing-item__jobs:hover, .listing__latest-training .well.listing-item__jobs:hover {
    border: 1px solid #b72f9a; box-shadow:none 
}
.listing__featured-training .featured-companies__title {
   
    color: #b72f9a;
   
    color: #b72f9a;
    
}

.logo {
    margin-right: 45px !important;
    padding-top: 0px;
}
.navbar .navbar-right .signup_btn, .navbar .navbar-right .logout_btn, .navbar .navbar-right .navbar__item:first-child .navbar__link.logout_btn { font-size:15px}

.listing-item__desc {
    color: #202020;
    font-weight: 400;
}

.training_home_block .featured-companies__title {
 
    color: #bc2f9a;
 
    color: #bc2f9a;
   
}

.training_home_block .featured-companies__slider--prev, .training_home_block .featured-companies__slider--next {
  
    background-color: #bc2f9a;
}


.listing__featured .listing__title , .listing .listing__title{

    text-align: left;
	margin-bottom: 16px;
    font-weight: 400;
    font-size: 22px;
    color: #333;
}

section.main-sections.listing__latest-training {
    padding: 20px 0px 50px;
    
}

.listebycategories.test.training_home_block {
    /*background-color: rgb(188 47 154 / 3%);*/
}
</style>
	
</body>
</html><?php }
}
