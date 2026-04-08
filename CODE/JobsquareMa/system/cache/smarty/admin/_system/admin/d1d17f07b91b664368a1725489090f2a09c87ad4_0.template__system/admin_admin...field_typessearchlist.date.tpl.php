<?php
/* Smarty version 4.3.0, created on 2026-03-04 08:57:40
  from 'template__system/admin_admin:..field_typessearchlist.date.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a7f404b2d111_25543366',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd1d17f07b91b664368a1725489090f2a09c87ad4' => 
    array (
      0 => 'template__system/admin_admin:..field_typessearchlist.date.tpl',
      1 => 1771678928,
      2 => 'template__system/admin_admin',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69a7f404b2d111_25543366 (Smarty_Internal_Template $_smarty_tpl) {
?><select name='<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
[multi_like][]' class="searchList">
	<option value=""><?php $_block_plugin10 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin10, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin10->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Any<?php $_block_repeat=false;
echo $_block_plugin10->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?> <?php $_block_plugin11 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin11, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin11->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Date<?php $_block_repeat=false;
echo $_block_plugin11->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></option>
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list_values']->value, 'list_value');
$_smarty_tpl->tpl_vars['list_value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['list_value']->value) {
$_smarty_tpl->tpl_vars['list_value']->do_else = false;
?>
		<option value="<?php echo $_smarty_tpl->tpl_vars['list_value']->value['id'];?>
" <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['value']->value['multi_like'], 'value_id');
$_smarty_tpl->tpl_vars['value_id']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['value_id']->value) {
$_smarty_tpl->tpl_vars['value_id']->do_else = false;
if ($_smarty_tpl->tpl_vars['list_value']->value['id'] == $_smarty_tpl->tpl_vars['value_id']->value) {?>selected="selected"<?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?> ><?php $_block_plugin12 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin12, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array('mode'=>"raw"));
$_block_repeat=true;
echo $_block_plugin12->translate(array('mode'=>"raw"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?> <?php echo $_smarty_tpl->tpl_vars['list_value']->value['caption'];?>
 <?php $_block_content12 = ob_get_clean();
$_block_repeat=false;
ob_start();
echo $_block_plugin12->translate(array('mode'=>"raw"), $_block_content12, $_smarty_tpl, $_block_repeat);
echo htmlspecialchars((string)ob_get_clean(), ENT_QUOTES, 'UTF-8', true);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></option>
	<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</select><?php }
}
