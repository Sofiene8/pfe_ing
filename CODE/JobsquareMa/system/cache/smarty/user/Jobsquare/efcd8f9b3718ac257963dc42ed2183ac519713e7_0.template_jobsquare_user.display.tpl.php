<?php
/* Smarty version 4.3.0, created on 2026-03-04 11:43:28
  from 'template_jobsquare_user:display.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a81ae05570a9_69947310',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'efcd8f9b3718ac257963dc42ed2183ac519713e7' => 
    array (
      0 => 'template_jobsquare_user:display.tpl',
      1 => 1772573824,
      2 => 'template_jobsquare_user',
    ),
  ),
  'includes' => 
  array (
    'template_jobsquare_user:../menu/header_search_resumes.tpl' => 1,
    'template_jobsquare_user:../menu/headerjob.tpl' => 1,
    'template_jobsquare_user:../menu/header.tpl' => 1,
    'template_jobsquare_user:../menu/footer.tpl' => 1,
  ),
),false)) {
function content_69a81ae05570a9_69947310 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
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
    <link rel="alternate" type="application/rss+xml" title="<?php $_block_plugin46 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin46, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin46->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Jobs<?php $_block_repeat=false;
echo $_block_plugin46->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>" href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/rss/">

    <title><?php if ($_smarty_tpl->tpl_vars['TITLE']->value) {
$_block_plugin47 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin47, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin47->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['TITLE']->value;
$_block_content47 = ob_get_clean();
$_block_repeat=false;
ob_start();
echo $_block_plugin47->translate(array(), $_block_content47, $_smarty_tpl, $_block_repeat);
echo htmlspecialchars((string)ob_get_clean(), ENT_QUOTES, 'UTF-8', true);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?> | <?php }
echo $_smarty_tpl->tpl_vars['GLOBALS']->value['settings']['site_title'];?>
</title>
	 <?php $_block_plugin48 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin48, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array('metadata'=>$_smarty_tpl->tpl_vars['METADATA']->value['HEAD']));
$_block_repeat=true;
echo $_block_plugin48->translate(array('metadata'=>$_smarty_tpl->tpl_vars['METADATA']->value['HEAD']), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['HEAD']->value;
$_block_repeat=false;
echo $_block_plugin48->translate(array('metadata'=>$_smarty_tpl->tpl_vars['METADATA']->value['HEAD']), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">    <link href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/templates/Jobsquare/assets/third-party/jquery-ui.css" rel="stylesheet">
    <link href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/templates/Jobsquare/vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/templates/Jobsquare/assets/style/styles.css" rel="stylesheet">
   
    <style type="text/css"><?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['theme_settings']['custom_css'];?>
</style>
    <?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['theme_settings']['custom_js'];?>

</head>
<body 
<?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/jobs/') {?> class="tinyheader page-recherche" 
<?php } elseif ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/training/') {?> class="tinyheader page-training" 
<?php } elseif ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '') {?> class="body_home_page" 
 <?php } elseif ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/resumes/') {?> class="tinyheader page-resume" 
<?php } else { ?> class="pageinterne" <?php }?> 
>


   <?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/resumes/') {?> 
   <?php $_smarty_tpl->_subTemplateRender("template_jobsquare_user:../menu/header_search_resumes.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
} elseif ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/jobs/') {?>
   <?php $_smarty_tpl->_subTemplateRender("template_jobsquare_user:../menu/headerjob.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
} else { ?>
   <?php $_smarty_tpl->_subTemplateRender("template_jobsquare_user:../menu/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
   <?php }?>
    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['module'][0], array( array('name'=>'flash_messages','function'=>'display'),$_smarty_tpl ) );?>

		
			
			
    <div class="page-row page-row-expanded">
        <div class="display-item<?php if (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'banner' ][ 0 ], array( 'banner_right_side' ))) {?> with-banner<?php }?>">
            <?php echo $_smarty_tpl->tpl_vars['MAIN_CONTENT']->value;?>

            <div id="apply-modal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">Modal Window</h4>
                        </div>
                        <div class="modal-body">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $_smarty_tpl->_subTemplateRender("template_jobsquare_user:../menu/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

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
 language="javascript" type="text/javascript">

        // Set global javascript value for page
        window.SJB_GlobalSiteUrl = '<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
';
        window.SJB_UserSiteUrl   = '<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['user_site_url'];?>
';

        $("#apply-modal")
                .on('show.bs.modal', function(event){
                    var button = $(event.relatedTarget);
                    var titleData = button.data('title');
                    $(this).find('.modal-title').text(titleData);
                    if (button.data('applied')) {
                        $(this).find('.modal-body').html('<p class="alert alert-danger"><?php $_block_plugin49 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin49, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin49->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>You already applied to this job<?php $_block_repeat=false;
echo $_block_plugin49->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></p>');
                    } else {
                        $(this).find('.modal-body').load(button.data('href'), function() {
                            $(this).find('.form-control').focus().select()
                        });
                    }
                })
                .on('shown.bs.modal', function(){
                    $(this).find('.form-control').first().focus().select();
                });

        $('.toggle--refine-search').on('click', function(e) {
            e.preventDefault();
            $(this).toggleClass('collapsed');
            $('.refine-search__wrapper').toggleClass('show');
            $(document).mouseup(function (e) {
                var container = $(".refine-search");
                if (!container.is(e.target) && container.has(e.target).length === 0) {
                    $('.toggle--refine-search').removeClass('collapsed');
                    $('.refine-search__wrapper').removeClass('show');
                }
            });
        });

        $('#apply-modal').on('click', '.email-frequency__btn-js', function(){
            $('.email-frequency__btn-js').each(function(){
                $(this).removeClass('active');
            });
            $(this).addClass('active');
        })
    <?php echo '</script'; ?>
>

    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['js'][0], array( array(),$_smarty_tpl ) );?>

</body>
</html>
<?php }
}
