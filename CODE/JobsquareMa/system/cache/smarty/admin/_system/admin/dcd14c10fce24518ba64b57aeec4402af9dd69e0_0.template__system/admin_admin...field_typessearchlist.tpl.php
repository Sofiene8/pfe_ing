<?php
/* Smarty version 4.3.0, created on 2026-03-04 08:57:40
  from 'template__system/admin_admin:..field_typessearchlist.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a7f404c42ae5_44082678',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dcd14c10fce24518ba64b57aeec4402af9dd69e0' => 
    array (
      0 => 'template__system/admin_admin:..field_typessearchlist.tpl',
      1 => 1771678928,
      2 => 'template__system/admin_admin',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69a7f404c42ae5_44082678 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\JobsquareMa\\system\\ext\\Smarty\\libs\\plugins\\modifier.replace.php','function'=>'smarty_modifier_replace',),));
if ($_smarty_tpl->tpl_vars['parentID']->value) {?>
	<?php $_smarty_tpl->_assignInScope('locationName', smarty_modifier_replace($_smarty_tpl->tpl_vars['id']->value,$_smarty_tpl->tpl_vars['parentID']->value,''));?>
	<?php $_smarty_tpl->_assignInScope('locationName', smarty_modifier_replace($_smarty_tpl->tpl_vars['locationName']->value,'_',''));?>
<select name='<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
[multi_like][]' class="searchList" <?php if ($_smarty_tpl->tpl_vars['parentID']->value && !$_smarty_tpl->tpl_vars['list_values']->value && !$_smarty_tpl->tpl_vars['enabled']->value) {?> disabled="disabled" <?php }?> <?php if ($_smarty_tpl->tpl_vars['parentID']->value && $_smarty_tpl->tpl_vars['locationName']->value == "Country") {?> onchange = "get<?php echo $_smarty_tpl->tpl_vars['parentID']->value;?>
States(this.value)" <?php }?>>
	<?php if ($_smarty_tpl->tpl_vars['id']->value != 'email_frequency') {?>
		<option value=""><?php $_block_plugin18 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin18, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin18->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Any<?php $_block_repeat=false;
echo $_block_plugin18->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?> <?php $_block_plugin19 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin19, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin19->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['caption']->value;
$_block_content19 = ob_get_clean();
$_block_repeat=false;
ob_start();
echo $_block_plugin19->translate(array(), $_block_content19, $_smarty_tpl, $_block_repeat);
echo htmlspecialchars((string)ob_get_clean(), ENT_QUOTES, 'UTF-8', true);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></option>
	<?php }?>
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list_values']->value, 'list_value');
$_smarty_tpl->tpl_vars['list_value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['list_value']->value) {
$_smarty_tpl->tpl_vars['list_value']->do_else = false;
?>
		<option value='<?php echo $_smarty_tpl->tpl_vars['list_value']->value['id'];?>
' <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['value']->value['multi_like'], 'value_id');
$_smarty_tpl->tpl_vars['value_id']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['value_id']->value) {
$_smarty_tpl->tpl_vars['value_id']->do_else = false;
if ($_smarty_tpl->tpl_vars['list_value']->value['id'] == $_smarty_tpl->tpl_vars['value_id']->value) {?>selected="selected"<?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['value']->value['multi_like_and'], 'value_id');
$_smarty_tpl->tpl_vars['value_id']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['value_id']->value) {
$_smarty_tpl->tpl_vars['value_id']->do_else = false;
if ($_smarty_tpl->tpl_vars['list_value']->value['id'] == $_smarty_tpl->tpl_vars['value_id']->value) {?>selected="selected"<?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?> ><?php $_block_plugin20 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin20, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array('mode'=>"raw"));
$_block_repeat=true;
echo $_block_plugin20->translate(array('mode'=>"raw"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['list_value']->value['caption'];
$_block_content20 = ob_get_clean();
$_block_repeat=false;
ob_start();
echo $_block_plugin20->translate(array('mode'=>"raw"), $_block_content20, $_smarty_tpl, $_block_repeat);
echo htmlspecialchars((string)ob_get_clean(), ENT_QUOTES, 'UTF-8', true);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></option>
	<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</select>
<?php } else { ?>
<select name='<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
[equal]'>
	<?php if ($_smarty_tpl->tpl_vars['id']->value != 'data_source') {?>
		<option value=""><?php $_block_plugin21 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin21, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin21->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Any<?php $_block_repeat=false;
echo $_block_plugin21->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?> <?php $_block_plugin22 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin22, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin22->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['caption']->value;
$_block_content22 = ob_get_clean();
$_block_repeat=false;
ob_start();
echo $_block_plugin22->translate(array(), $_block_content22, $_smarty_tpl, $_block_repeat);
echo htmlspecialchars((string)ob_get_clean(), ENT_QUOTES, 'UTF-8', true);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></option>
	<?php } elseif ($_smarty_tpl->tpl_vars['id']->value == 'data_source') {?>
		<option value=""><?php $_block_plugin23 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin23, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin23->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Select<?php $_block_repeat=false;
echo $_block_plugin23->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?> <?php $_block_plugin24 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin24, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin24->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['caption']->value;
$_block_content24 = ob_get_clean();
$_block_repeat=false;
ob_start();
echo $_block_plugin24->translate(array(), $_block_content24, $_smarty_tpl, $_block_repeat);
echo htmlspecialchars((string)ob_get_clean(), ENT_QUOTES, 'UTF-8', true);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></option>
	<?php }?>
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list_values']->value, 'list_value');
$_smarty_tpl->tpl_vars['list_value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['list_value']->value) {
$_smarty_tpl->tpl_vars['list_value']->do_else = false;
?>
		<option value='<?php echo $_smarty_tpl->tpl_vars['list_value']->value['id'];?>
' <?php if ($_smarty_tpl->tpl_vars['list_value']->value['id'] === $_smarty_tpl->tpl_vars['value']->value['equal']) {?>selected="selected"<?php }?> ><?php $_block_plugin25 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin25, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin25->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['list_value']->value['caption'];
$_block_content25 = ob_get_clean();
$_block_repeat=false;
ob_start();
echo $_block_plugin25->translate(array(), $_block_content25, $_smarty_tpl, $_block_repeat);
echo htmlspecialchars((string)ob_get_clean(), ENT_QUOTES, 'UTF-8', true);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></option>
	<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</select>
<?php }
}
}
