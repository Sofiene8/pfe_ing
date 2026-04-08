<?php
/* Smarty version 4.3.0, created on 2026-03-04 22:49:06
  from 'template__system/admin_admin:..field_typessearchstring.like.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a8b6e271e4c1_58608273',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5bc5e6ba8a0d0e144501c1e08517d50b68435797' => 
    array (
      0 => 'template__system/admin_admin:..field_typessearchstring.like.tpl',
      1 => 1771678928,
      2 => 'template__system/admin_admin',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69a8b6e271e4c1_58608273 (Smarty_Internal_Template $_smarty_tpl) {
?><input type="text" name="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
[like]" <?php if ($_smarty_tpl->tpl_vars['url']->value == "/manage-users/employer/" || $_smarty_tpl->tpl_vars['url']->value == "/manage-users/jobseeker/") {?>placeholder="<?php if ($_smarty_tpl->tpl_vars['id']->value == 'CompanyName') {
$_block_plugin10 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin10, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin10->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Company Name<?php $_block_repeat=false;
echo $_block_plugin10->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
} elseif ($_smarty_tpl->tpl_vars['id']->value == 'username') {
$_block_plugin11 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin11, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin11->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Email<?php $_block_repeat=false;
echo $_block_plugin11->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
}?>"<?php }?>
        <?php if ($_smarty_tpl->tpl_vars['url']->value == "/guest-alerts/") {?>placeholder="<?php $_block_plugin12 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin12, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin12->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Email<?php $_block_repeat=false;
echo $_block_plugin12->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>"<?php }?>
        <?php if ($_smarty_tpl->tpl_vars['url']->value == "/manage-invoices/") {
if ($_smarty_tpl->tpl_vars['id']->value == 'username') {
}?>placeholder="<?php $_block_plugin13 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin13, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin13->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Email<?php $_block_repeat=false;
echo $_block_plugin13->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>"<?php }?>
        value="<?php if (is_array($_smarty_tpl->tpl_vars['value']->value)) {
if ($_smarty_tpl->tpl_vars['value']->value['like']) {
echo $_smarty_tpl->tpl_vars['value']->value['like'];
} elseif ($_smarty_tpl->tpl_vars['value']->value['equal']) {
echo $_smarty_tpl->tpl_vars['value']->value['equal'];
}
} else {
echo $_smarty_tpl->tpl_vars['value']->value;
}?>" /><?php }
}
