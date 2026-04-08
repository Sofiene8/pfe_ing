<?php
/* Smarty version 4.3.0, created on 2026-02-28 23:48:32
  from 'template_jobsquare_user:..field_typesinputlist.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a37ed09255b4_72964313',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4afbb824de7fe14a0c7880bb0ffe04292f08e786' => 
    array (
      0 => 'template_jobsquare_user:..field_typesinputlist.tpl',
      1 => 1771678926,
      2 => 'template_jobsquare_user',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69a37ed09255b4_72964313 (Smarty_Internal_Template $_smarty_tpl) {
?><!--<select class="form-control" name="<?php if ($_smarty_tpl->tpl_vars['parentID']->value) {
echo $_smarty_tpl->tpl_vars['parentID']->value;?>
[<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
]<?php } else {
echo $_smarty_tpl->tpl_vars['id']->value;
}?>" <?php if ($_smarty_tpl->tpl_vars['parentID']->value && !$_smarty_tpl->tpl_vars['list_values']->value && !$_smarty_tpl->tpl_vars['enabled']->value) {?> disabled="disabled" <?php }?> <?php if ($_smarty_tpl->tpl_vars['parentID']->value && $_smarty_tpl->tpl_vars['id']->value == "Country") {?> onchange = "get<?php echo $_smarty_tpl->tpl_vars['parentID']->value;?>
States(this.value)" <?php }?> >
	-->
	<select class="form-control" name="<?php if ($_smarty_tpl->tpl_vars['parentID']->value) {
echo $_smarty_tpl->tpl_vars['id']->value;
} else {
echo $_smarty_tpl->tpl_vars['id']->value;
}?>" <?php if ($_smarty_tpl->tpl_vars['parentID']->value && !$_smarty_tpl->tpl_vars['list_values']->value && !$_smarty_tpl->tpl_vars['enabled']->value) {?> disabled="disabled" <?php }?> <?php if ($_smarty_tpl->tpl_vars['parentID']->value && $_smarty_tpl->tpl_vars['id']->value == "Country") {?> onchange = "get<?php echo $_smarty_tpl->tpl_vars['parentID']->value;?>
States(this.value)" <?php }?> >
	
	<?php if ($_smarty_tpl->tpl_vars['id']->value !== 'email_frequency') {?><option value=""><?php $_block_plugin48 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin48, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin48->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Select<?php $_block_repeat=false;
echo $_block_plugin48->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?> <?php $_block_plugin49 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin49, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin49->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['caption']->value;
$_block_content49 = ob_get_clean();
$_block_repeat=false;
ob_start();
echo $_block_plugin49->translate(array(), $_block_content49, $_smarty_tpl, $_block_repeat);
echo htmlspecialchars((string)ob_get_clean(), ENT_QUOTES, 'UTF-8', true);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></option><?php }?>
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list_values']->value, 'list_value');
$_smarty_tpl->tpl_vars['list_value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['list_value']->value) {
$_smarty_tpl->tpl_vars['list_value']->do_else = false;
?>
		<option value="<?php echo $_smarty_tpl->tpl_vars['list_value']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['list_value']->value['id'] == $_smarty_tpl->tpl_vars['value']->value) {?>selected="selected"<?php }?> ><?php $_block_plugin50 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin50, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array('mode'=>"raw"));
$_block_repeat=true;
echo $_block_plugin50->translate(array('mode'=>"raw"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['list_value']->value['caption'];
$_block_content50 = ob_get_clean();
$_block_repeat=false;
ob_start();
echo $_block_plugin50->translate(array('mode'=>"raw"), $_block_content50, $_smarty_tpl, $_block_repeat);
echo htmlspecialchars((string)ob_get_clean(), ENT_QUOTES, 'UTF-8', true);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></option>
	<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</select>
<?php }
}
