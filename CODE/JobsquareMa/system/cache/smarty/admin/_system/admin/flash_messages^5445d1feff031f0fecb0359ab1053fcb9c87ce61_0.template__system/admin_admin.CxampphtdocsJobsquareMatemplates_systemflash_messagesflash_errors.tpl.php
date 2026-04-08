<?php
/* Smarty version 4.3.0, created on 2026-03-04 08:22:37
  from 'template__system/admin_admin:CxampphtdocsJobsquareMatemplates_systemflash_messagesflash_errors.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a7ebcdec2454_77201859',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5445d1feff031f0fecb0359ab1053fcb9c87ce61' => 
    array (
      0 => 'template__system/admin_admin:CxampphtdocsJobsquareMatemplates_systemflash_messagesflash_errors.tpl',
      1 => 1771678928,
      2 => 'template__system/admin_admin',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69a7ebcdec2454_77201859 (Smarty_Internal_Template $_smarty_tpl) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['messagesArray']->value, 'messages', false, 'type');
$_smarty_tpl->tpl_vars['messages']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['type']->value => $_smarty_tpl->tpl_vars['messages']->value) {
$_smarty_tpl->tpl_vars['messages']->do_else = false;
?>
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['messages']->value, 'message');
$_smarty_tpl->tpl_vars['message']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['message']->value) {
$_smarty_tpl->tpl_vars['message']->do_else = false;
?>
		<?php if (is_array($_smarty_tpl->tpl_vars['message']->value)) {?>
			<?php $_smarty_tpl->_assignInScope('messageId', $_smarty_tpl->tpl_vars['message']->value['messageId']);?>
		<?php } else { ?>
			<?php $_smarty_tpl->_assignInScope('messageId', $_smarty_tpl->tpl_vars['message']->value);?>
		<?php }?>
		
		<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', 'messageValue', null);?>
						<?php if ($_smarty_tpl->tpl_vars['messageId']->value == 'EMPTY_VALUE') {?>
				<?php $_smarty_tpl->_assignInScope('field_caption', call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'tr' ][ 0 ], array( $_smarty_tpl->tpl_vars['message']->value['fieldCaption'] )));?>
				<?php $_block_plugin15 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin15, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin15->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Please enter '$field_caption'<?php $_block_repeat=false;
echo $_block_plugin15->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>

						<?php } elseif ($_smarty_tpl->tpl_vars['messageId']->value == 'ERROR_SEND_ACTIVATION_EMAIL') {?>
				<?php $_block_plugin16 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin16, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin16->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Failed to send activation email<?php $_block_repeat=false;
echo $_block_plugin16->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
			
						<?php } elseif ($_smarty_tpl->tpl_vars['messageId']->value == "CANT_CREATE_EXPORT_FILES") {?>
				<?php $_block_plugin17 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin17, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin17->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Cannot create export files<?php $_block_repeat=false;
echo $_block_plugin17->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
			<?php } elseif ($_smarty_tpl->tpl_vars['messageId']->value == "EMPTY_EXPORT_PROPERTIES") {?>
				<?php $_block_plugin18 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin18, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin18->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>There are no selected properties. Select at least one property to export.<?php $_block_repeat=false;
echo $_block_plugin18->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
			<?php } elseif ($_smarty_tpl->tpl_vars['messageId']->value == 'EMPTY_EXPORT_DATA') {?>
				<?php $_block_plugin19 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin19, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin19->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>There is no data to export. Change your search criteria.<?php $_block_repeat=false;
echo $_block_plugin19->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
			<?php } elseif ($_smarty_tpl->tpl_vars['messageId']->value == 'ERROR_ADD_BANNER_GROUP') {?>
				<?php $_block_plugin20 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin20, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin20->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>System error while adding new banner group<?php $_block_repeat=false;
echo $_block_plugin20->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
			<?php } else { ?>
				<?php $_block_plugin21 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin21, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array('metadata'=>$_smarty_tpl->tpl_vars['METADATA']->value['messageId']));
$_block_repeat=true;
echo $_block_plugin21->translate(array('metadata'=>$_smarty_tpl->tpl_vars['METADATA']->value['messageId']), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['messageId']->value;
$_block_repeat=false;
echo $_block_plugin21->translate(array('metadata'=>$_smarty_tpl->tpl_vars['METADATA']->value['messageId']), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
			<?php }?>
		<?php $_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
		
		<p class="<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['messageValue']->value;?>
</p>
	<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
}
