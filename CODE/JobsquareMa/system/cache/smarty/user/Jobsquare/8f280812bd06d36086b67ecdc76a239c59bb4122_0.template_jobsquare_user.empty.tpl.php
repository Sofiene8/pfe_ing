<?php
/* Smarty version 4.3.0, created on 2026-03-04 11:43:29
  from 'template_jobsquare_user:empty.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a81ae10ae7c9_11536880',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8f280812bd06d36086b67ecdc76a239c59bb4122' => 
    array (
      0 => 'template_jobsquare_user:empty.tpl',
      1 => 1772573826,
      2 => 'template_jobsquare_user',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69a81ae10ae7c9_11536880 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'messages', null, null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['module'][0], array( array('name'=>'flash_messages','function'=>'display'),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);
echo trim($_smarty_tpl->smarty->ext->_capture->getBuffer($_smarty_tpl, 'messages'));
echo $_smarty_tpl->tpl_vars['MAIN_CONTENT']->value;
}
}
