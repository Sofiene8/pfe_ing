<?php
/* Smarty version 4.3.0, created on 2026-03-04 08:22:32
  from 'template_jobsquare_user:..field_typessearchtext.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a7ebc8d4c727_73416856',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '391808186b400e5d90d1f74736a62b63bf40ea1b' => 
    array (
      0 => 'template_jobsquare_user:..field_typessearchtext.tpl',
      1 => 1772573914,
      2 => 'template_jobsquare_user',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69a7ebc8d4c727_73416856 (Smarty_Internal_Template $_smarty_tpl) {
?><input type="text" value="<?php if ($_smarty_tpl->tpl_vars['id']->value == 'keywords') {
echo $_smarty_tpl->tpl_vars['value']->value['all_words'];
} else {
echo $_smarty_tpl->tpl_vars['value']->value['like'];
}?>" class="form-control <?php if ($_smarty_tpl->tpl_vars['id']->value == 'keywords') {?>form-control__centered<?php }?>" name="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
[<?php if ($_smarty_tpl->tpl_vars['id']->value == 'keywords') {?>all_words<?php } else { ?>like<?php }?>]" id="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['id']->value == 'keywords') {?>placeholder="<?php $_block_plugin2 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin2, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin2->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Keywords<?php $_block_repeat=false;
echo $_block_plugin2->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>"<?php }?> /><?php }
}
