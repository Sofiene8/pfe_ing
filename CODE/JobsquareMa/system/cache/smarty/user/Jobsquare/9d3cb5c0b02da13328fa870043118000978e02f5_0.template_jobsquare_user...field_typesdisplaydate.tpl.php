<?php
/* Smarty version 4.3.0, created on 2026-03-04 11:43:18
  from 'template_jobsquare_user:..field_typesdisplaydate.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a81ad65ed112_83409431',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9d3cb5c0b02da13328fa870043118000978e02f5' => 
    array (
      0 => 'template_jobsquare_user:..field_typesdisplaydate.tpl',
      1 => 1772573912,
      2 => 'template_jobsquare_user',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69a81ad65ed112_83409431 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['format']->value) {?>
    <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'date' ][ 0 ], array( $_smarty_tpl->tpl_vars['value']->value,$_smarty_tpl->tpl_vars['format']->value ));?>

<?php } else { ?>
    <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'date' ][ 0 ], array( $_smarty_tpl->tpl_vars['value']->value ));?>

<?php }
}
}
