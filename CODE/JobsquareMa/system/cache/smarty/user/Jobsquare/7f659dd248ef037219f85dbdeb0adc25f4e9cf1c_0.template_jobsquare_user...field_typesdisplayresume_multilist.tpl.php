<?php
/* Smarty version 4.3.0, created on 2026-03-04 11:43:18
  from 'template_jobsquare_user:..field_typesdisplayresume_multilist.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a81ad64d1d77_04785056',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7f659dd248ef037219f85dbdeb0adc25f4e9cf1c' => 
    array (
      0 => 'template_jobsquare_user:..field_typesdisplayresume_multilist.tpl',
      1 => 1772573912,
      2 => 'template_jobsquare_user',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69a81ad64d1d77_04785056 (Smarty_Internal_Template $_smarty_tpl) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['value']->value, 'list_value', false, NULL, 'multifor', array (
  'last' => true,
  'iteration' => true,
  'total' => true,
));
$_smarty_tpl->tpl_vars['list_value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['list_value']->value) {
$_smarty_tpl->tpl_vars['list_value']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_multifor']->value['iteration']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_multifor']->value['last'] = $_smarty_tpl->tpl_vars['__smarty_foreach_multifor']->value['iteration'] === $_smarty_tpl->tpl_vars['__smarty_foreach_multifor']->value['total'];
?>
	<?php if ($_smarty_tpl->tpl_vars['display_list_values']->value[$_smarty_tpl->tpl_vars['list_value']->value]) {?>
		<?php $_block_plugin28 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin28, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin28->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['display_list_values']->value[$_smarty_tpl->tpl_vars['list_value']->value];
$_block_content28 = ob_get_clean();
$_block_repeat=false;
ob_start();
echo $_block_plugin28->translate(array(), $_block_content28, $_smarty_tpl, $_block_repeat);
echo htmlspecialchars((string)ob_get_clean(), ENT_QUOTES, 'UTF-8', true);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
if (!(isset($_smarty_tpl->tpl_vars['__smarty_foreach_multifor']->value['last']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_multifor']->value['last'] : null)) {?>, <?php }?>
	<?php } else { ?>
		<?php $_block_plugin29 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin29, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin29->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['list_value']->value;
$_block_content29 = ob_get_clean();
$_block_repeat=false;
ob_start();
echo $_block_plugin29->translate(array(), $_block_content29, $_smarty_tpl, $_block_repeat);
echo htmlspecialchars((string)ob_get_clean(), ENT_QUOTES, 'UTF-8', true);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
if (!(isset($_smarty_tpl->tpl_vars['__smarty_foreach_multifor']->value['last']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_multifor']->value['last'] : null)) {?>, <?php }?>
	<?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
}
