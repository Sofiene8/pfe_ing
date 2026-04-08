<?php
/* Smarty version 4.3.0, created on 2026-02-27 10:28:30
  from 'template_jobsquare_user:error.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a171ce7e69f1_35303794',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2a96a1e5332201dd9b8ac3e028f5c807f44f2aa0' => 
    array (
      0 => 'template_jobsquare_user:error.tpl',
      1 => 1771678925,
      2 => 'template_jobsquare_user',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69a171ce7e69f1_35303794 (Smarty_Internal_Template $_smarty_tpl) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ERRORS']->value, 'error_message', false, 'error');
$_smarty_tpl->tpl_vars['error_message']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['error']->value => $_smarty_tpl->tpl_vars['error_message']->value) {
$_smarty_tpl->tpl_vars['error_message']->do_else = false;
?>
	<?php if ($_smarty_tpl->tpl_vars['error']->value == "INVALID_REQUEST") {?>
		<p class="alert alert-danger"><?php echo $_smarty_tpl->tpl_vars['error_message']->value;?>
</p>
	<?php } elseif ($_smarty_tpl->tpl_vars['error']->value == "INVALID_DATA") {?>
		<p class="alert alert-danger"><?php echo $_smarty_tpl->tpl_vars['error_message']->value;?>
</p>
	<?php } elseif ($_smarty_tpl->tpl_vars['error']->value == "PARAMETERS_MISSED") {?>
		<?php $_block_plugin16 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin16, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin16->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>The key parameters are not specified<?php $_block_repeat=false;
echo $_block_plugin16->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
	<?php } elseif ($_smarty_tpl->tpl_vars['error']->value == "MYSQL_ERROR") {?>
		<?php echo $_smarty_tpl->tpl_vars['error_message']->value;?>

	<?php } elseif ($_smarty_tpl->tpl_vars['error']->value == "NOT_LOGGED_IN") {?>
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['module'][0], array( array('name'=>"users",'function'=>"login"),$_smarty_tpl ) );?>

	<?php } elseif ($_smarty_tpl->tpl_vars['error']->value == 'DEFAULT_VALUE_NOT_SET') {?>
		<p class="alert alert-danger">Default value for <?php echo $_smarty_tpl->tpl_vars['error_message']->value;?>
 is not set</p>
	<?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
}
