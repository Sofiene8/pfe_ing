<?php
/* Smarty version 4.3.0, created on 2026-03-04 08:57:46
  from 'template_jobsquare_user:CxampphtdocsJobsquareMatemplatesJobsquareflash_messagesflash_errors.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a7f40a9d3b32_04287319',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0115957a4275315ea26baaf61ca852bf929fd14f' => 
    array (
      0 => 'template_jobsquare_user:CxampphtdocsJobsquareMatemplatesJobsquareflash_messagesflash_errors.tpl',
      1 => 1772573855,
      2 => 'template_jobsquare_user',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69a7f40a9d3b32_04287319 (Smarty_Internal_Template $_smarty_tpl) {
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
				<?php $_block_plugin5 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin5, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin5->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Please enter '$field_caption'<?php $_block_repeat=false;
echo $_block_plugin5->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
			<?php } else { ?>
				<?php $_block_plugin6 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin6, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array('metadata'=>$_smarty_tpl->tpl_vars['METADATA']->value['messageId']));
$_block_repeat=true;
echo $_block_plugin6->translate(array('metadata'=>$_smarty_tpl->tpl_vars['METADATA']->value['messageId']), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['messageId']->value;
$_block_repeat=false;
echo $_block_plugin6->translate(array('metadata'=>$_smarty_tpl->tpl_vars['METADATA']->value['messageId']), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
			<?php }?>
		<?php $_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
		
		<p class="<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
 alert alert-danger"><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['messageValue']->value, ENT_QUOTES, 'UTF-8', true);?>
</p>
	<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
}
