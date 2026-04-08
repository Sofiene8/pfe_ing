<?php
/* Smarty version 4.3.0, created on 2026-02-28 23:48:18
  from 'template_jobsquare_user:..userserrors.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a37ec29f55f2_52926311',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8fd52cc5f033e96ff1fbc7aa69ded13fccf4aa24' => 
    array (
      0 => 'template_jobsquare_user:..userserrors.tpl',
      1 => 1771678926,
      2 => 'template_jobsquare_user',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69a37ec29f55f2_52926311 (Smarty_Internal_Template $_smarty_tpl) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['errors']->value, 'errmess', false, 'error');
$_smarty_tpl->tpl_vars['errmess']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['error']->value => $_smarty_tpl->tpl_vars['errmess']->value) {
$_smarty_tpl->tpl_vars['errmess']->do_else = false;
?>
	<p class="error alert alert-danger">
		<?php if ($_smarty_tpl->tpl_vars['error']->value == 'NO_SUCH_USER') {?>
			<?php $_block_plugin9 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin9, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin9->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Wrong email or password. Let's try again!<?php $_block_repeat=false;
echo $_block_plugin9->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
		<?php } elseif ($_smarty_tpl->tpl_vars['error']->value == 'USER_NOT_ACTIVE') {?>
			<?php $_block_plugin10 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin10, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin10->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Your account is not active<?php $_block_repeat=false;
echo $_block_plugin10->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
		<?php } elseif ($_smarty_tpl->tpl_vars['error']->value == 'SOCIAL_ACCESS_ERROR') {?>
			<?php if (!empty($_smarty_tpl->tpl_vars['errmess']->value)) {?>
				<?php if ($_smarty_tpl->tpl_vars['errmess']->value == 'oAuth Problem: user_refused') {?>
					<?php $_block_plugin11 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin11, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin11->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Access is refused.<?php $_block_repeat=false;
echo $_block_plugin11->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
				<?php } else { ?>
					<?php $_smarty_tpl->_assignInScope('socialNetwork', $_smarty_tpl->tpl_vars['errmess']->value);?>
					<?php $_block_plugin12 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin12, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin12->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>The $socialNetwork Plugin is set up incorrectly. Please check this issue with the website Administrator.<?php $_block_repeat=false;
echo $_block_plugin12->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
				<?php }?>
			<?php }?>
		<?php } elseif ($_smarty_tpl->tpl_vars['error']->value == 'NO_SUCH_USER_GROUP_IN_THE_SYSTEM') {?>
			<?php $_block_plugin13 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin13, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin13->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Registration form cannot be displayed. There is no such User Group in the system.<?php $_block_repeat=false;
echo $_block_plugin13->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
		<?php } else { ?>
			<?php $_block_plugin14 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin14, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array('metadata'=>$_smarty_tpl->tpl_vars['METADATA']->value['error']));
$_block_repeat=true;
echo $_block_plugin14->translate(array('metadata'=>$_smarty_tpl->tpl_vars['METADATA']->value['error']), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['error']->value;
$_block_repeat=false;
echo $_block_plugin14->translate(array('metadata'=>$_smarty_tpl->tpl_vars['METADATA']->value['error']), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?> <?php $_block_plugin15 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin15, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array('metadata'=>$_smarty_tpl->tpl_vars['METADATA']->value['errmess']));
$_block_repeat=true;
echo $_block_plugin15->translate(array('metadata'=>$_smarty_tpl->tpl_vars['METADATA']->value['errmess']), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['errmess']->value;
$_block_repeat=false;
echo $_block_plugin15->translate(array('metadata'=>$_smarty_tpl->tpl_vars['METADATA']->value['errmess']), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
		<?php }?>
	</p>
<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
}
