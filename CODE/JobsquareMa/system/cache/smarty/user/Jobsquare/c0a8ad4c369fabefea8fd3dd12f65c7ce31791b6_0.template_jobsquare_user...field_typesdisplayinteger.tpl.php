<?php
/* Smarty version 4.3.0, created on 2026-03-04 11:43:18
  from 'template_jobsquare_user:..field_typesdisplayinteger.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a81ad64ac7e7_61306600',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c0a8ad4c369fabefea8fd3dd12f65c7ce31791b6' => 
    array (
      0 => 'template_jobsquare_user:..field_typesdisplayinteger.tpl',
      1 => 1772573911,
      2 => 'template_jobsquare_user',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69a81ad64ac7e7_61306600 (Smarty_Internal_Template $_smarty_tpl) {
$_block_plugin27 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin27, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array('type'=>"int"));
$_block_repeat=true;
echo $_block_plugin27->translate(array('type'=>"int"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['value']->value;
$_block_content27 = ob_get_clean();
$_block_repeat=false;
ob_start();
echo $_block_plugin27->translate(array('type'=>"int"), $_block_content27, $_smarty_tpl, $_block_repeat);
echo htmlspecialchars((string)ob_get_clean(), ENT_QUOTES, 'UTF-8', true);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
}
}
