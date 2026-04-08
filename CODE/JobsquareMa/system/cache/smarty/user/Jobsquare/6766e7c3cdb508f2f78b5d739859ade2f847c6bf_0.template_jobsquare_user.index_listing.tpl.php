<?php
/* Smarty version 4.3.0, created on 2026-02-28 23:48:32
  from 'template_jobsquare_user:index_listing.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a37ed09cac91_13871331',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6766e7c3cdb508f2f78b5d739859ade2f847c6bf' => 
    array (
      0 => 'template_jobsquare_user:index_listing.tpl',
      1 => 1772316208,
      2 => 'template_jobsquare_user',
    ),
  ),
  'includes' => 
  array (
    'template_jobsquare_user:../menu/headerresume.tpl' => 2,
    'template_jobsquare_user:../menu/footerresume.tpl' => 1,
    'template_jobsquare_user:../menu/headerjob.tpl' => 1,
    'template_jobsquare_user:../menu/header.tpl' => 1,
    'template_jobsquare_user:../menu/footer.tpl' => 1,
  ),
),false)) {
function content_69a37ed09cac91_13871331 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
if ((($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/add-listing/')&($_smarty_tpl->tpl_vars['listingTypeID']->value == 'Resume' || $_GET['listing_type_id'] == 'Resume')) || ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/edit-resume/')) {?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<meta name="keywords" content="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['KEYWORDS']->value, ENT_QUOTES, 'UTF-8', true);?>
">
	<meta name="description" content="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['DESCRIPTION']->value, ENT_QUOTES, 'UTF-8', true);?>
">
	<meta name="viewport" content="width=device-width, height=device-height,
                                   initial-scale=1.0, maximum-scale=1.0,
                                   target-densityDpi=device-dpi">
	<link rel="alternate" type="application/rss+xml" title="<?php $_block_plugin52 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin52, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin52->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Jobs<?php $_block_repeat=false;
echo $_block_plugin52->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>" href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/rss/">

	<title><?php if ($_smarty_tpl->tpl_vars['TITLE']->value) {
$_block_plugin53 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin53, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin53->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['TITLE']->value;
$_block_content53 = ob_get_clean();
$_block_repeat=false;
ob_start();
echo $_block_plugin53->translate(array(), $_block_content53, $_smarty_tpl, $_block_repeat);
echo htmlspecialchars((string)ob_get_clean(), ENT_QUOTES, 'UTF-8', true);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?> | <?php }
echo $_smarty_tpl->tpl_vars['GLOBALS']->value['settings']['site_title'];?>
</title>
	<?php $_block_plugin54 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin54, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array('metadata'=>$_smarty_tpl->tpl_vars['METADATA']->value['HEAD']));
$_block_repeat=true;
echo $_block_plugin54->translate(array('metadata'=>$_smarty_tpl->tpl_vars['METADATA']->value['HEAD']), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['HEAD']->value;
$_block_repeat=false;
echo $_block_plugin54->translate(array('metadata'=>$_smarty_tpl->tpl_vars['METADATA']->value['HEAD']), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
	<link href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/templates/Jobsquare/assets/third-party/jquery-ui.css" rel="stylesheet">
	<link href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/templates/Jobsquare/vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/system/ext/jquery/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">

	<link href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/templates/Jobsquare/assets/style/styles.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
	<link href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/templates/Jobsquare/assets/style/search-jobs.css" rel="stylesheet">
<style type="text/css"><?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['theme_settings']['custom_css'];?>
</style>
		
	<!-- Ajout pour nouveau style  Ched  -->


<?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['current_user']['logged_in']) {?>


	<?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['current_user']['group']['id'] == "Employer") {?>
	<link href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/templates/Jobsquare/assets/style/jobseeker/jobseeker.css" rel="stylesheet">
		<?php } else { ?>
		<link href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/templates/Jobsquare/assets/style/jobseeker/resume.css" rel="stylesheet">
			<?php }?>
			
<?php }?>
		

		<!-- Ajout pour nouveau style  -->	
	
	<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['theme_settings']['custom_js'];?>

	
</head>
<body  class="tinyheader">  
<?php if ((($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/add-listing/')&($_smarty_tpl->tpl_vars['listingTypeID']->value == 'Resume' || $_smarty_tpl->tpl_vars['listingTypeID']->value == 'Job' || $_GET['listing_type_id'] == 'Resume' || $_GET['listing_type_id'] == 'job'))) {?>
  <?php if ($_smarty_tpl->tpl_vars['listings']->value) {?>       
   <?php $_smarty_tpl->_subTemplateRender("template_jobsquare_user:../menu/headerresume.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
 
    <?php } else { ?>
	
	<?php }?>
	<?php } else { ?>
	  <?php $_smarty_tpl->_subTemplateRender("template_jobsquare_user:../menu/headerresume.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
	<?php }?>
	
	

	<div class="page-row container">
			<div class="display-item row">
				<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_6027127969a37ed097f9d8_38904493', 'main_content');
?>

			</div>
		</div>

	
<?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/add-listing/') {
} else { ?>
	<?php $_smarty_tpl->_subTemplateRender("template_jobsquare_user:../menu/footerresume.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}?>
	   
		
			
			
				
		
		




	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/templates/Jobsquare/assets/third-party/jquery.min.js"><?php echo '</script'; ?>
>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/templates/Jobsquare/vendor/twbs/bootstrap/dist/js/bootstrap.min.js"><?php echo '</script'; ?>
>

	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/templates/Jobsquare/assets/third-party/jquery-ui.min.js"><?php echo '</script'; ?>
>

	<?php echo '<script'; ?>
 language="JavaScript" type="text/javascript" src="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['common_js'][0], array( array(),$_smarty_tpl ) );?>
/main.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 language="JavaScript" type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/templates/Jobsquare/assets/third-party/jquery.form.min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 language="JavaScript" type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/system/ext/jquery/jquery.validate.min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 language="JavaScript" type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/templates/Jobsquare/common_js/autoupload_functions.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 language="JavaScript" type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/system/ext/jquery/imagesize.js"><?php echo '</script'; ?>
>
	<link rel="Stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/system/ext/jquery/css/jquery.multiselect.css" />
	<?php echo '<script'; ?>
 language="JavaScript" type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['user_site_url'];?>
/system/ext/jquery/multilist/jquery.multiselect.min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 language="JavaScript" type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/templates/Jobsquare/common_js/multilist_functions.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
>
		document.addEventListener("touchstart", function() { }, false);

		var langSettings = {
			thousands_separator : '<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['current_language_data']['thousands_separator'];?>
',
			decimal_separator : '<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['current_language_data']['decimal_separator'];?>
',
			decimals : '<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['current_language_data']['decimals'];?>
',
			currencySign: '<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['currencySign'][0], array( array(),$_smarty_tpl ) );?>
',
			showCurrencySign: 1,
			currencySignLocation: '<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['current_language_data']['currencySignLocation'];?>
',
			rightToLeft: <?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['current_language_data']['rightToLeft'];?>

		};
	<?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 language="JavaScript" type="text/javascript" src="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['common_js'][0], array( array(),$_smarty_tpl ) );?>
/floatnumbers_functions.js"><?php echo '</script'; ?>
>

	<?php echo '<script'; ?>
 language="JavaScript" type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/system/ext/jquery/bootstrap-datepicker/bootstrap-datepicker.min.js"><?php echo '</script'; ?>
>
	<?php if ((isset($_smarty_tpl->tpl_vars['GLOBALS']->value['available_datepicker_localizations'][$_smarty_tpl->tpl_vars['GLOBALS']->value['current_language']]))) {?>
		<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/system/ext/jquery/bootstrap-datepicker/i18n/bootstrap-datepicker.<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['current_language'];?>
.min.js" ><?php echo '</script'; ?>
>
	<?php }?>

	<?php echo '<script'; ?>
 language="javascript" type="text/javascript">

		// Set global javascript value for page
		window.SJB_GlobalSiteUrl = '<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
';
		window.SJB_UserSiteUrl   = '<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['user_site_url'];?>
';

	<?php echo '</script'; ?>
>

		<?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/jobs/') {?>
		<?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['plugins']['IndeedPlugin']['active'] == 1) {?>
			<?php echo '<script'; ?>
 type="text/javascript" src="https://gdc.indeed.com/ads/apiresults.js"><?php echo '</script'; ?>
>
		<?php }?>
	<?php }?>

	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['js'][0], array( array(),$_smarty_tpl ) );?>


	<?php echo '<script'; ?>
>
		function message(title, content) {
			var modal = $('#message-modal');
			modal.find('.modal-title').html(title);
			modal.find('.modal-body').html(content);
			modal.modal('show');
		}
	<?php echo '</script'; ?>
>
	<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/templates/Jobsquare/assets/style/cookieconsent.min.css" />
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/templates/Jobsquare/assets/third-party/cookieconsent.min.js" data-cfasync="false"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
window.addEventListener("load", function(){
window.cookieconsent.initialise({
  "palette": {
    "popup": {
      "background": "#000"
    },
    "button": {
      "background": "#f1d600"
    }
  }
})});
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
window.addEventListener("load", function(){
window.cookieconsent.initialise({
  "palette": {
    "popup": {
      "background": "#413D3C"
    },
    "button": {
      "background": "#eb800e"
    }
  }
})});
<?php echo '</script'; ?>
>
	
	
</body>
</html>
<?php } else { ?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<meta name="keywords" content="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['KEYWORDS']->value, ENT_QUOTES, 'UTF-8', true);?>
">
	<meta name="description" content="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['DESCRIPTION']->value, ENT_QUOTES, 'UTF-8', true);?>
">
	<meta name="viewport" content="width=device-width, height=device-height,
                                   initial-scale=1.0, maximum-scale=1.0,
                                   target-densityDpi=device-dpi">
	<link rel="alternate" type="application/rss+xml" title="<?php $_block_plugin55 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin55, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin55->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Jobs<?php $_block_repeat=false;
echo $_block_plugin55->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>" href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/rss/">

	<title><?php if ($_smarty_tpl->tpl_vars['TITLE']->value) {
$_block_plugin56 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin56, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin56->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['TITLE']->value;
$_block_content56 = ob_get_clean();
$_block_repeat=false;
ob_start();
echo $_block_plugin56->translate(array(), $_block_content56, $_smarty_tpl, $_block_repeat);
echo htmlspecialchars((string)ob_get_clean(), ENT_QUOTES, 'UTF-8', true);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?> | <?php }
echo $_smarty_tpl->tpl_vars['GLOBALS']->value['settings']['site_title'];?>
</title>
	<?php $_block_plugin57 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin57, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array('metadata'=>$_smarty_tpl->tpl_vars['METADATA']->value['HEAD']));
$_block_repeat=true;
echo $_block_plugin57->translate(array('metadata'=>$_smarty_tpl->tpl_vars['METADATA']->value['HEAD']), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['HEAD']->value;
$_block_repeat=false;
echo $_block_plugin57->translate(array('metadata'=>$_smarty_tpl->tpl_vars['METADATA']->value['HEAD']), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">	<link href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/templates/Jobsquare/assets/third-party/jquery-ui.css" rel="stylesheet">
	<link href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/templates/Jobsquare/vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/system/ext/jquery/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">

	<link href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/templates/Jobsquare/assets/style/styles.css" rel="stylesheet">
	<link href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/templates/Jobsquare/assets/style/search-jobs.css" rel="stylesheet">


	<style type="text/css"><?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['theme_settings']['custom_css'];?>
</style>

	<!-- Ajout pour nouveau style  Ched  -->


<?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['current_user']['group']['id'] == "Employer") {?>
	<link href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/templates/Jobsquare/assets/style/jobseeker/jobseeker.css" rel="stylesheet">
		<?php } else { ?>
		<link href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/templates/Jobsquare/assets/style/jobseeker/resume.css" rel="stylesheet">
			<?php }?>
		<!-- Ajout pour nouveau style  -->	
		<!-- Ajout pour nouveau style  -->	
		
		
		
	<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['theme_settings']['custom_js'];?>

</head>
<body <?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/job-preview/' || $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/registration/' || $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/login/' || $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/jobs/' || $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/training/' || $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/add-listing/') {?> class="tinyheader head1" <?php } else { ?> class="index" <?php }?> >
	
<?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/job-preview/' || $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/registration/' || $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/login/' || $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/jobs/' || $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/training/' || $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/add-listing/') {?>
  
   <?php $_smarty_tpl->_subTemplateRender("template_jobsquare_user:../menu/headerjob.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
	<?php } else { ?>
	  <?php $_smarty_tpl->_subTemplateRender("template_jobsquare_user:../menu/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
	<?php }?>

	<div id="loading"></div>

	<div class="modal fade" id="message-modal" tabindex="-1" role="dialog" aria-labelledby="message-modal-label">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
					<h4 class="modal-title" id="message-modal-label">Modal title</h4>
				</div>
				<div class="modal-body">

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"><?php $_block_plugin58 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin58, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin58->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Close<?php $_block_repeat=false;
echo $_block_plugin58->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></button>
				</div>
			</div>
		</div>
	</div>

	<div class="flash-messages">
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['module'][0], array( array('name'=>'flash_messages','function'=>'display'),$_smarty_tpl ) );?>

	</div>

    <?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/categories/' || $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/states/' || $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/countries/' || $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/cities/' || $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/job-preview/' || $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/resume-preview/' || $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/training-preview/') {?>
		<div class="page-row page-row-expanded">
			<?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/resume-preview/') {?>
			<div class="display-item resumepage">
			<?php } else { ?>
			<div class="display-item ">
			<?php }?>
				<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_36175737469a37ed09a84d4_26003307', 'main_content');
?>

				<div class="clear clearfix"></div>
			</div><div class="clear clearfix"></div>
		</div><div class="clear clearfix"></div>
	<?php } else { ?>
		<div class="page-row page-row-expanded">
			<?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] != '/edit-profile/' && $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] != '/my-listings/' && $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] != '/blog/' && $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] != '/contact/' && $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] != '/login/' && $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] != '/registration/' && $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] != '/add-listing/' && $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] != '/password-recovery/' && $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] != '/applications/') {?>
			<div class="container container--small <?php if (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'banner' ][ 0 ], array( 'banner_right_side' ))) {?>with-banner<?php }?> <?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/employer-products/' || $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/jobseeker-products/') {?>with-banner__products<?php }?>">
			<?php }?>
				<?php if (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'banner' ][ 0 ], array( 'banner_right_side' ))) {?>
					<div class="with-banner__wrapper">
				<?php }?>
				<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_116210868469a37ed09b3fe7_69913628', 'main_content');
?>

				<?php if (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'banner' ][ 0 ], array( 'banner_right_side' ))) {?>
					</div>
                    <div class="banner banner--right">
                        <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'banner' ][ 0 ], array( 'banner_right_side' ));?>

                    </div>
				<?php }?>
			</div>
		</div>
	<?php }
if ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/add-listing/') {
} else { ?>
	<?php $_smarty_tpl->_subTemplateRender("template_jobsquare_user:../menu/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}?>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/templates/Jobsquare/assets/third-party/jquery.min.js"><?php echo '</script'; ?>
>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/templates/Jobsquare/vendor/twbs/bootstrap/dist/js/bootstrap.min.js"><?php echo '</script'; ?>
>

	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/templates/Jobsquare/assets/third-party/jquery-ui.min.js"><?php echo '</script'; ?>
>

	<?php echo '<script'; ?>
 language="JavaScript" type="text/javascript" src="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['common_js'][0], array( array(),$_smarty_tpl ) );?>
/main.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 language="JavaScript" type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/templates/Jobsquare/assets/third-party/jquery.form.min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 language="JavaScript" type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/system/ext/jquery/jquery.validate.min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 language="JavaScript" type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/templates/Jobsquare/common_js/autoupload_functions.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 language="JavaScript" type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/system/ext/jquery/imagesize.js"><?php echo '</script'; ?>
>
	<link rel="Stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/system/ext/jquery/css/jquery.multiselect.css" />
	<?php echo '<script'; ?>
 language="JavaScript" type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['user_site_url'];?>
/system/ext/jquery/multilist/jquery.multiselect.min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 language="JavaScript" type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/templates/Jobsquare/common_js/multilist_functions.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
>
		document.addEventListener("touchstart", function() { }, false);

		var langSettings = {
			thousands_separator : '<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['current_language_data']['thousands_separator'];?>
',
			decimal_separator : '<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['current_language_data']['decimal_separator'];?>
',
			decimals : '<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['current_language_data']['decimals'];?>
',
			currencySign: '<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['currencySign'][0], array( array(),$_smarty_tpl ) );?>
',
			showCurrencySign: 1,
			currencySignLocation: '<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['current_language_data']['currencySignLocation'];?>
',
			rightToLeft: <?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['current_language_data']['rightToLeft'];?>

		};
	<?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 language="JavaScript" type="text/javascript" src="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['common_js'][0], array( array(),$_smarty_tpl ) );?>
/floatnumbers_functions.js"><?php echo '</script'; ?>
>

	<?php echo '<script'; ?>
 language="JavaScript" type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/system/ext/jquery/bootstrap-datepicker/bootstrap-datepicker.min.js"><?php echo '</script'; ?>
>
	<?php if ((isset($_smarty_tpl->tpl_vars['GLOBALS']->value['available_datepicker_localizations'][$_smarty_tpl->tpl_vars['GLOBALS']->value['current_language']]))) {?>
		<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/system/ext/jquery/bootstrap-datepicker/i18n/bootstrap-datepicker.<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['current_language'];?>
.min.js" ><?php echo '</script'; ?>
>
	<?php }?>

	<?php echo '<script'; ?>
 language="javascript" type="text/javascript">

		// Set global javascript value for page
		window.SJB_GlobalSiteUrl = '<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
';
		window.SJB_UserSiteUrl   = '<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['user_site_url'];?>
';

	<?php echo '</script'; ?>
>

		<?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/jobs/') {?>
		<?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['plugins']['IndeedPlugin']['active'] == 1) {?>
			<?php echo '<script'; ?>
 type="text/javascript" src="https://gdc.indeed.com/ads/apiresults.js"><?php echo '</script'; ?>
>
		<?php }?>
	<?php }?>

	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['js'][0], array( array(),$_smarty_tpl ) );?>


	<?php echo '<script'; ?>
>
		function message(title, content) {
			var modal = $('#message-modal');
			modal.find('.modal-title').html(title);
			modal.find('.modal-body').html(content);
			modal.modal('show');
		}
	<?php echo '</script'; ?>
>
	<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/templates/Jobsquare/assets/style/cookieconsent.min.css" />
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/templates/Jobsquare/assets/third-party/cookieconsent.min.js" data-cfasync="false"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
window.addEventListener("load", function(){
window.cookieconsent.initialise({
  "palette": {
    "popup": {
      "background": "#000"
    },
    "button": {
      "background": "#f1d600"
    }
  }
})});
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
window.addEventListener("load", function(){
window.cookieconsent.initialise({
  "palette": {
    "popup": {
      "background": "#413D3C"
    },
    "button": {
      "background": "#eb800e"
    }
  }
})});
<?php echo '</script'; ?>
>
	
	
</body>

</html>
<?php }
}
/* {block 'main_content'} */
class Block_6027127969a37ed097f9d8_38904493 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'main_content' => 
  array (
    0 => 'Block_6027127969a37ed097f9d8_38904493',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

					<?php echo $_smarty_tpl->tpl_vars['MAIN_CONTENT']->value;?>

				<?php
}
}
/* {/block 'main_content'} */
/* {block 'main_content'} */
class Block_36175737469a37ed09a84d4_26003307 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'main_content' => 
  array (
    0 => 'Block_36175737469a37ed09a84d4_26003307',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

					<?php echo $_smarty_tpl->tpl_vars['MAIN_CONTENT']->value;?>

				<?php
}
}
/* {/block 'main_content'} */
/* {block 'main_content'} */
class Block_116210868469a37ed09b3fe7_69913628 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'main_content' => 
  array (
    0 => 'Block_116210868469a37ed09b3fe7_69913628',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

					<?php echo $_smarty_tpl->tpl_vars['MAIN_CONTENT']->value;?>

				<?php
}
}
/* {/block 'main_content'} */
}
