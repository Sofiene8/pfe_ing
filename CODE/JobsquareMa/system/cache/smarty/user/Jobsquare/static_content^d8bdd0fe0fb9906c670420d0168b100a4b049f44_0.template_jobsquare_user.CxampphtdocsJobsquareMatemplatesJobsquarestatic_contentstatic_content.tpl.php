<?php
/* Smarty version 4.3.0, created on 2026-02-27 14:04:47
  from 'template_jobsquare_user:CxampphtdocsJobsquareMatemplatesJobsquarestatic_contentstatic_content.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a1a47f1e4d21_62249336',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd8bdd0fe0fb9906c670420d0168b100a4b049f44' => 
    array (
      0 => 'template_jobsquare_user:CxampphtdocsJobsquareMatemplatesJobsquarestatic_contentstatic_content.tpl',
      1 => 1771678926,
      2 => 'template_jobsquare_user',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69a1a47f1e4d21_62249336 (Smarty_Internal_Template $_smarty_tpl) {
?>
 <?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/recrutement/') {
} else { ?>
<h1 class="title__primary title__primary-small title__centered static_content "><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['TITLE']->value, ENT_QUOTES, 'UTF-8', true);?>
</h1><?php }?>

 <?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/recrutement/') {?><div class="container recrutement_page pt-150 pb-150"><?php } else { ?><div class="container container--small"><?php }
if ($_smarty_tpl->tpl_vars['staticContent']->value) {?>
 <?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/recrutement/') {?> <div class=" content-text"><?php } else { ?> <div class="static-pages content-text"><?php }?>


        <?php echo $_smarty_tpl->tpl_vars['staticContent']->value;?>

    </div>
<?php }?>

<?php $_block_plugin1 = isset($_smarty_tpl->smarty->registered_plugins['block']['javascript'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['javascript'][0][0] : null;
if (!is_callable(array($_block_plugin1, '_tpl_javascript'))) {
throw new SmartyException('block tag \'javascript\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('javascript', array());
$_block_repeat=true;
echo $_block_plugin1->_tpl_javascript(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
    <?php echo '<script'; ?>
>
        $(document).ready(function() {
            $('table').each(function() {
                $(this).wrap('<div class="table-responsive"/>')
            });
        });
    <?php echo '</script'; ?>
>
<?php $_block_repeat=false;
echo $_block_plugin1->_tpl_javascript(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
}
}
