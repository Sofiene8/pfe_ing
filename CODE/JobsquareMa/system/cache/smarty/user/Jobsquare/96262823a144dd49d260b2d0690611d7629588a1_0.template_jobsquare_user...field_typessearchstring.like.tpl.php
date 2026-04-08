<?php
/* Smarty version 4.3.0, created on 2026-02-27 11:09:14
  from 'template_jobsquare_user:..field_typessearchstring.like.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a17b5ae1d984_66326008',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '96262823a144dd49d260b2d0690611d7629588a1' => 
    array (
      0 => 'template_jobsquare_user:..field_typessearchstring.like.tpl',
      1 => 1771678926,
      2 => 'template_jobsquare_user',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69a17b5ae1d984_66326008 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\JobsquareMa\\system\\ext\\Smarty\\libs\\plugins\\modifier.replace.php','function'=>'smarty_modifier_replace',),));
?>
<input type="text" name="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
[like]"  placeholder="<?php $_block_plugin8 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin8, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin8->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Company Name<?php $_block_repeat=false;
echo $_block_plugin8->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>" id="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" class="form-control" value="<?php if ($_smarty_tpl->tpl_vars['value']->value['like']) {
echo $_smarty_tpl->tpl_vars['value']->value['like'];
} elseif ($_smarty_tpl->tpl_vars['value']->value['multi_like_and'][0]) {
echo $_smarty_tpl->tpl_vars['value']->value['multi_like_and'][0];
} else {
echo $_smarty_tpl->tpl_vars['value']->value['equal'];
}?>"/>
<?php if ($_smarty_tpl->tpl_vars['parentID']->value) {?>
	<?php $_smarty_tpl->_assignInScope('id', smarty_modifier_replace($_smarty_tpl->tpl_vars['id']->value,$_smarty_tpl->tpl_vars['parentID']->value,''));?>
	<?php $_smarty_tpl->_assignInScope('id', smarty_modifier_replace($_smarty_tpl->tpl_vars['id']->value,'_',''));
}
}
}
