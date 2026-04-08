<?php
/* Smarty version 4.3.0, created on 2026-03-04 08:57:46
  from 'template_jobsquare_user:index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a7f40a7e3346_58375858',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '03a719c0880b4063350a9c7105d95003574b6b34' => 
    array (
      0 => 'template_jobsquare_user:index.tpl',
      1 => 1772573826,
      2 => 'template_jobsquare_user',
    ),
  ),
  'includes' => 
  array (
    'template_jobsquare_user:../menu/headerjob.tpl' => 1,
    'template_jobsquare_user:../menu/header.tpl' => 1,
    'template_jobsquare_user:../menu/footer.tpl' => 1,
  ),
),false)) {
function content_69a7f40a7e3346_58375858 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
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
	<link rel="alternate" type="application/rss+xml" title="<?php $_block_plugin1 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin1, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin1->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Jobs<?php $_block_repeat=false;
echo $_block_plugin1->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>" href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/rss/">

	<title><?php if ($_smarty_tpl->tpl_vars['TITLE']->value) {
$_block_plugin2 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin2, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin2->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['TITLE']->value;
$_block_content2 = ob_get_clean();
$_block_repeat=false;
ob_start();
echo $_block_plugin2->translate(array(), $_block_content2, $_smarty_tpl, $_block_repeat);
echo htmlspecialchars((string)ob_get_clean(), ENT_QUOTES, 'UTF-8', true);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?> | <?php }
echo $_smarty_tpl->tpl_vars['GLOBALS']->value['settings']['site_title'];?>
</title>
	<?php $_block_plugin3 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin3, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array('metadata'=>$_smarty_tpl->tpl_vars['METADATA']->value['HEAD']));
$_block_repeat=true;
echo $_block_plugin3->translate(array('metadata'=>$_smarty_tpl->tpl_vars['METADATA']->value['HEAD']), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['HEAD']->value;
$_block_repeat=false;
echo $_block_plugin3->translate(array('metadata'=>$_smarty_tpl->tpl_vars['METADATA']->value['HEAD']), ob_get_clean(), $_smarty_tpl, $_block_repeat);
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
	<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
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

		<!-- Ajout pour nouveau style  -->	
	<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['theme_settings']['custom_js'];?>

</head>



	
<body 
<?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['current_user']['group']['id'] == "Employer") {?> id="jobseeker"<?php }?> 
<?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/edit-profile/') {?> class="tinyheader head2 page-edit-profile"
<?php } elseif ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/job-preview/') {?>  class="tinyheader head2 page-job-preview"
<?php } elseif ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/registration/') {?>  class="tinyheader head2 page-registration"
<?php } elseif ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/login/') {?>  class="tinyheader head2 page-login"
<?php } elseif ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/jobs/') {?>  class="tinyheader head2 page-jobs"
<?php } elseif ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/training/') {?>   class="tinyheader head2 page-training"
<?php } elseif ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/my-listings/') {?> class="tinyheader head2 page-my-listings"
<?php } elseif ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/edit-job/') {?> class="tinyheader head2 page-edit-job"
<?php } elseif ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/clone-job/') {?> class="tinyheader head2 page-edit-clone-job" 
<?php } elseif ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/blog/') {?> class="index homeindex blog_page" 
<?php } elseif ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/contact/') {?> class="index homeindex contact_page" 
<?php } elseif ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/recrutement/') {?> class="tinyheader head2 recrutement_page" 
<?php } elseif ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/invoices/') {?> class="tinyheader head2 invoices_page" 
<?php } elseif ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/details-invoice/') {?> class="tinyheader head2 invoices_page" 
<?php } elseif ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/system/applications/view/') {?> class="tinyheader head2 recrutement_page" 
<?php } else { ?>
 class="index homeindex" <?php }?> 
 >

<?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/job-preview/' || $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/registration/' || $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/login/' || $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/jobs/' || $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/training/' || $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/edit-job/' || $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/edit-profile/' || $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/clone-job/' || $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/recrutement/' || $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/my-listings/' || $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/invoices/' || $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/details-invoice/' || $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/edit-profile/') {?>
  
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
					<button type="button" class="btn btn-default" data-dismiss="modal"><?php $_block_plugin4 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin4, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin4->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Close<?php $_block_repeat=false;
echo $_block_plugin4->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
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
			<div class="display-item pages">
			<?php }?>
				<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_104101711769a7f40a790759_63645922', 'main_content');
?>

			</div>
		</div>
	<?php } else { ?>
		<div class="page-row page-row-expanded">
			<?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] != '/edit-profile/' && $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] != '/my-listings/' && $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] != '/blog/' && $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] != '/contact/' && $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] != '/login/' && $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] != '/registration/' && $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] != '/add-listing/' && $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] != '/password-recovery/' && $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] != '/applications/') {?>
			<div class="container container--small <?php if (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'banner' ][ 0 ], array( 'banner_right_side' ))) {?>with-banner<?php }?> <?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/employer-products/' || $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/jobseeker-products/') {?>with-banner__products<?php }?>">
			<?php }?>
				<?php if (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'banner' ][ 0 ], array( 'banner_right_side' ))) {?>
					<div class="with-banner__wrapper">
				<?php }?>
				<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_78311904469a7f40a7a3921_02633626', 'main_content');
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
if ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/my-listings/' || $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/edit-job/' || $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/clone-job/') {
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
	<style>
	body#jobseeker.tinyheader.head2.page-edit-profile  .navbar .navbar-right .navbar__item .navbar__link.btn__blue {
    background: transparent;
    border: 1px solid transparent;
    border-radius: 5px;
	color:#eb800e;
}
		body#jobseeker.tinyheader.head2.page-edit-profile .my-account-title {
    text-align: center;

    color: #fff;
    background: #166bd9;
   
}
		body#jobseeker.tinyheader.head2.page-edit-profile .my-account-title a {
visibility:hidden; display: none;
   
}


.mt-10 { margin-top:10px}
.mt-20 { margin-top:20px}
.mt-30 { margin-top:30px}
.mt-40 { margin-top:40px}
.mt-50 { margin-top:50px}


.mb-10 { margin-bottom:10px}
.mb-20 { margin-bottom:20px}
.mb-30 { margin-bottom:30px}
.mb-40 { margin-bottom:40px}
.mb-50 { margin-bottom:50px}
.pt-150 { padding-top:150px}
.pb-150 { padding-bottom:150px}
.contact_page .slogan, .blog_page .slogan , .homeindex  .slogan{
   
    font-size: 12px;
    left: 39px;
    top: 43px;
   
}

 .homeindex .container--small , .page-edit-profile .container--small{
    
    background: transparent!important;
   
}

.recrutement_page .content-text { /* color:#fff*/ ; font-size:16px}

body.recrutement_page  {
  /*  background: #ee810c;*/

}

body.page-edit-profile  h1.my-account-title , body.page-my-listings  h1.my-account-title, h1.view_seeker.my-account-title {
   
    color: #ffffff;
    background: #0055d9;
    
}


.my-account-listings .listing-item:first-of-type {
    margin-top: 30px;
}
.text-smaller { font-size:14px}

.recrutement_page .container--small {
    
    background: transparent;
   
}
.Btn--TrGreen {
    display: inline-block;
	 background-color: #f6f6f6;
    border: 1px solid #32b173;
    color: #32b173;
	padding:15px 25px; font-size:22px;
	position:relative;
	margin-bottom:15px
	

}
.Btn--TrGreen:before {
    content: "";
    height: 100%;
    left: 0;
    position: absolute;
    top: 0;
    transform: scaleX(0);
    transform-origin: left;
    transition: transform .45s;
    width: 100%;
    will-change: transform;
    background-color: #32b173; z-index:0
}
.Btn--TrGreen:hover {
   color: #fff;
}

.Btn--TrGreen:hover:before {
    transform: scaleX(1); color: #fff;
}



.Btn--TrGreen span {
    padding-right: 24px;
    position: relative;
	z-index:1
}


.Btn--TrGreen span:after {
	   background-image: url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxOCIgaGVpZ2h0PSIxNSI+PGcgZmlsbD0ibm9uZSIgZmlsbC1ydWxlPSJldmVub2RkIiBzdHJva2U9IiMzMkIxNzMiPjxwYXRoIHN0cm9rZS1saW5lY2FwPSJzcXVhcmUiIGQ9Im0xLjk5OCA3LjE3IDEzLjgwOS0uMDAxIi8+PHBhdGggZD0ibTEwLjY0OSAxMi43MDYgNS4yODYtNS40NS01LjIzLTUuMzkzIi8+PC9nPjwvc3ZnPg==);

    transition: transform .45s .3s;
    background-position: right top -2px;
    background-size: 100%;
    content: "";
    height: 17px;
    position: absolute;
    right: 0;
    top: 8px;
    width: 20px;
	color: #32b173; 
	z-index:2;
}
.Btn--TrGreen:hover span:after {

	   	   background-image: url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxOCIgaGVpZ2h0PSIxNSI+PGcgZmlsbD0ibm9uZSIgZmlsbC1ydWxlPSJldmVub2RkIiBzdHJva2U9IiNmZmYiPjxwYXRoIHN0cm9rZS1saW5lY2FwPSJzcXVhcmUiIGQ9Im0xLjk5OCA3LjE3IDEzLjgwOS0uMDAxIi8+PHBhdGggZD0ibTEwLjY0OSAxMi43MDYgNS4yODYtNS40NS01LjIzLTUuMzkzIi8+PC9nPjwvc3ZnPg==);

color: #fff; 

    transform: translateX(8px);
	color: #fff; 
}

.recrutement_page .title{
    color: #00423e; font-size: 45px;
    line-height: 48px;
}

.recrutement_page .t2{
  margin-bottom: 72px
}


.menu_principal .nav.navbar-nav.navbar-left li:nth-child(4), 
.menu_principal .nav.navbar-nav.navbar-left li:nth-child(5),
.menu_principal .nav.navbar-nav.navbar-left li:nth-child(6),
.menu_principal .nav.navbar-nav.navbar-left li:nth-child(7),
.menu_principal .nav.navbar-nav.navbar-left li:nth-child(8)
 { display:none}

 @media (max-width: 767px) {
    .recrutement_page .title {
       
        font-size: 32px;
        line-height: 36px;
    }

	.pb-150 {
    padding-bottom: 50px;
}
.pt-150 {
    padding-top: 50px;
}
.page-my-listings .slogan {
    font-size: 13px;
    left: 42px;
    top: 50px;
}

}
	</style>
	
</body>
</html><?php }
/* {block 'main_content'} */
class Block_104101711769a7f40a790759_63645922 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'main_content' => 
  array (
    0 => 'Block_104101711769a7f40a790759_63645922',
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
class Block_78311904469a7f40a7a3921_02633626 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'main_content' => 
  array (
    0 => 'Block_78311904469a7f40a7a3921_02633626',
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
