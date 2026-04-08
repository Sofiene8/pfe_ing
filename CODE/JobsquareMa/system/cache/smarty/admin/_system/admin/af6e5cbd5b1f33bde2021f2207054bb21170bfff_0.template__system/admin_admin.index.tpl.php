<?php
/* Smarty version 4.3.0, created on 2026-03-04 08:22:46
  from 'template__system/admin_admin:index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a7ebd66def73_73575723',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'af6e5cbd5b1f33bde2021f2207054bb21170bfff' => 
    array (
      0 => 'template__system/admin_admin:index.tpl',
      1 => 1771678928,
      2 => 'template__system/admin_admin',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69a7ebd66def73_73575723 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="fr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Jobsquare.ma <?php $_block_plugin16 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin16, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin16->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Admin Panel<?php $_block_repeat=false;
echo $_block_plugin16->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
if ($_smarty_tpl->tpl_vars['TITLE']->value) {?> | <?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['TITLE']->value, ENT_QUOTES, 'UTF-8', true);
}?></title>
	<meta name="viewport" content="width=device-width, height=device-height,
                                   initial-scale=1.0, maximum-scale=1.0,
                                   target-densityDpi=device-dpi">
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,700,500' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['user_site_url'];?>
/templates/_system/admin/assets/third-party/css/animate.css?v=<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['v'];?>
" />
	<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['user_site_url'];?>
/templates/_system/admin/assets/third-party/css/toggles.css?v=<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['v'];?>
" />
	<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['user_site_url'];?>
/templates/_system/admin/assets/style/style.css?v=<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['v'];?>
" />
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/1.5.2/css/ionicons.css" />
	<link href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['user_site_url'];?>
/system/ext/jquery/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">

	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['user_site_url'];?>
/system/ext/jquery/css/jquery.multiselect.css" />
	<?php echo '<script'; ?>
 src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 language="JavaScript" type="text/javascript" src="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['common_js'][0], array( array(),$_smarty_tpl ) );?>
/main.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 language="JavaScript" type="text/javascript" src="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['common_js'][0], array( array(),$_smarty_tpl ) );?>
/autoupload_functions.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 language="JavaScript" type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['user_site_url'];?>
/system/ext/jquery/multilist/jquery.multiselect.min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 language="JavaScript" type="text/javascript" src="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['common_js'][0], array( array(),$_smarty_tpl ) );?>
/multilist_functions.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 language="JavaScript" type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['user_site_url'];?>
/templates/_system/admin/assets/third-party/js/toggles.min.js"><?php echo '</script'; ?>
>

	<?php echo '<script'; ?>
 language="JavaScript" type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['user_site_url'];?>
/system/ext/jquery/bootstrap-datepicker/bootstrap-datepicker.min.js"><?php echo '</script'; ?>
>
	<?php if ((isset($_smarty_tpl->tpl_vars['GLOBALS']->value['available_datepicker_localizations'][$_smarty_tpl->tpl_vars['GLOBALS']->value['current_language']]))) {?>
		<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['user_site_url'];?>
/system/ext/jquery/bootstrap-datepicker/i18n/bootstrap-datepicker.<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['current_language'];?>
.min.js" ><?php echo '</script'; ?>
>
	<?php }?>
	<?php echo '<script'; ?>
>
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
	<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, "displayProgressBar", null, null);?><img style="vertical-align: middle;" src="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['user_site_url'];?>
/system/ext/jquery/progbar.gif" alt="<?php $_block_plugin17 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin17, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin17->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Please wait ...<?php $_block_repeat=false;
echo $_block_plugin17->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>" /> <?php $_block_plugin18 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin18, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin18->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Please wait ...<?php $_block_repeat=false;
echo $_block_plugin18->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
    <?php echo '<script'; ?>
 language="JavaScript" type="text/javascript">

		// Set global javascript value for page
		window.SJB_GlobalSiteUrl = '<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
';
		window.SJB_AdminSiteUrl  = '<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['admin_site_url'];?>
';
		window.SJB_UserSiteUrl   = '<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['user_site_url'];?>
';

		currentSjbVersion = {
			major: "<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['version']['major'];?>
",
			minor: "<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['version']['minor'];?>
",
			build: "<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['version']['build'];?>
"
		};

		

		$.extend($.ui.dialog.prototype.options, {
			modal: true
		});

	<?php echo '</script'; ?>
>
</head>
<body>
	<aside class="left-panel" tabindex="5000" style="overflow: hidden; outline: none;">
		<div class="left-panel__top">
			<div class="logo">
				<a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['admin_site_url'];?>
" class="logo-expanded text-center">
					<img class="logo__img" src="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['image'][0], array( array(),$_smarty_tpl ) );?>
logo.svg" border="0" alt=""/>
				</a>
			</div>
		</div>
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['module'][0], array( array('name'=>"menu",'function'=>"show_left_menu"),$_smarty_tpl ) );?>

	</aside>
	<section class="content">
		<header class="top-head container-fluid">
			<button type="button" class="navbar-toggle pull-left visible-sm visible-xs">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>

			<nav class="navbar-default clearfix" role="navigation">
				<ul class="nav navbar-nav navbar-right top-menu top-right-menu">
					<li class="navbar-nav__icon">
						<a href="<?php if (htmlspecialchars((string)$_smarty_tpl->tpl_vars['GLOBALS']->value['settings']['domain'], ENT_QUOTES, 'UTF-8', true)) {?>https://<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['GLOBALS']->value['settings']['domain'], ENT_QUOTES, 'UTF-8', true);
echo $_smarty_tpl->tpl_vars['GLOBALS']->value['base_url'];
} else {
echo $_smarty_tpl->tpl_vars['GLOBALS']->value['user_site_url'];
}?>" class="view-frontend" target="_blank" title="<?php $_block_plugin19 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin19, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin19->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>View your job board<?php $_block_repeat=false;
echo $_block_plugin19->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>">
							<i class="fa fa-external-link" aria-hidden="true"></i>
						</a>
					</li>
				
					<li class="dropdown text-right pull-right navbar-nav__icon">
						<a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="false">
							<i class="fa fa-user" aria-hidden="true"></i>
							<i class="fa fa-caret-down" aria-hidden="true"></i>
						</a>
						<ul class="dropdown-menu pro-menu fadeInUp animated" tabindex="5003" style="overflow: hidden; outline: none;">
							
							<li>
								<?php if ($_SESSION['admin']['owner']) {?>
									<a href="<?php echo $_smarty_tpl->tpl_vars['billingUrl']->value;?>
"><?php $_block_plugin20 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin20, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin20->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>My Account<?php $_block_repeat=false;
echo $_block_plugin20->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a>
								<?php } else { ?>
									<a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/admins/?action=edit&amp;sid=<?php echo $_SESSION['admin']['sid'];?>
"><?php $_block_plugin21 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin21, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin21->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>My Account<?php $_block_repeat=false;
echo $_block_plugin21->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a>
								<?php }?>
							</li>
							<li><a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/system/users/logout/"><?php $_block_plugin22 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin22, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin22->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Log out<?php $_block_repeat=false;
echo $_block_plugin22->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a></li>
						</ul>
					</li>
					<li class="pull-right help-center navbar-nav__icon">
						<a href="#" target="_blank" title="<?php $_block_plugin23 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin23, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin23->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Help Center<?php $_block_repeat=false;
echo $_block_plugin23->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>">
							<i class="fa fa-life-ring" aria-hidden="true"></i>
						</a>
					</li>
				</ul>
			</nav>
		</header>

		<div class="update-info">
			<a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/update-to-new-version/"><?php $_block_plugin24 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin24, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin24->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>New update available<?php $_block_repeat=false;
echo $_block_plugin24->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a>
			<span class="update-info-close">X</span>
		</div>
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['module'][0], array( array('name'=>"miscellaneous",'function'=>"guided_tour"),$_smarty_tpl ) );?>

		<div class="wrapper container-fluid wrapper--main">
			<?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] !== "/" && $_smarty_tpl->tpl_vars['ADMIN_BREADCRUMBS']->value) {?>
				<div class="breacrumb__wrapper clearfix">
					<ol id="breadCrumbs" class="breadcrumb clearfix">
						<li><?php $_block_plugin25 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin25, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin25->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['ADMIN_BREADCRUMBS']->value;
$_block_repeat=false;
echo $_block_plugin25->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></li>
					</ol>
				</div>
			<?php }?>
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['module'][0], array( array('name'=>'flash_messages','function'=>'display'),$_smarty_tpl ) );?>

			<?php echo $_smarty_tpl->tpl_vars['MAIN_CONTENT']->value;?>

		</div>
	</section>

	<?php echo '<script'; ?>
 data-pace-options='{ "restartOnRequestAfter": false, "restartOnPushState": false }' src="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['user_site_url'];?>
/templates/_system/admin/assets/third-party/js/pace.min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 type="text/javascript">
		$(document).ready(function() {
            var dFormat = '<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['settings']['date_format'];?>
';

            dFormat = dFormat.replace('%m', "mm");
            dFormat = dFormat.replace('%d', "dd");
            dFormat = dFormat.replace('%Y', "yyyy");

            console.log(dFormat);
            $(".input__datepicker").datepicker({
                language: '<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['current_language'];?>
',
                format: dFormat,
                autoclose: true,
                todayHighlight: true,
                startDate: new Date(1940, 1 - 1, 1),
                endDate: '+10y',
            });

            $('.ui-datepicker-trigger').on('click', function () {
                $(this).prev().focus();
            });

			var is_touch_device = ("ontouchstart" in window) || window.DocumentTouch && document instanceof DocumentTouch;
			var tooltipPlacement = '';

			if ($(window).width() >= 992 && (!$('.tooltip-job8').length)) {
				tooltipPlacement = 'auto top';
			} else {
				tooltipPlacement = 'auto left';
			}

			$('[data-toggle="tooltip"]').tooltip({
				trigger: is_touch_device ? "click" : "manual",
				html: true,
				placement: tooltipPlacement
			}).on("mouseenter", function() {
				var _this = this;
				$(this).tooltip("show");
				$(this).siblings(".tooltip").on("mouseleave", function() {
					$(_this).tooltip("hide");
				});
			}).on("mouseleave", function() {
				var _this = this;
				setTimeout(function() {
					if (!$(".tooltip:hover").length) {
						$(_this).tooltip("hide")
					}
				}, 200);
			});

		});
	<?php echo '</script'; ?>
>
	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['js'][0], array( array(),$_smarty_tpl ) );?>

</body>
</html>
<?php }
}
