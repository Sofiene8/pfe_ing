<?php
/* Smarty version 4.3.0, created on 2026-02-28 23:48:32
  from 'template_jobsquare_user:..field_typesinputmultilist.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a37ed08d5488_66154494',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f585d7260d83aaf20877bec3bfbb7910168aa145' => 
    array (
      0 => 'template_jobsquare_user:..field_typesinputmultilist.tpl',
      1 => 1771678926,
      2 => 'template_jobsquare_user',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69a37ed08d5488_66154494 (Smarty_Internal_Template $_smarty_tpl) {
?><input type="hidden" name="<?php if ($_smarty_tpl->tpl_vars['complexField']->value) {
echo $_smarty_tpl->tpl_vars['complexField']->value;?>
[<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
][<?php echo $_smarty_tpl->tpl_vars['complexStep']->value;?>
]<?php } else {
echo $_smarty_tpl->tpl_vars['id']->value;
}?>" value=""/>
<select multiple="multiple" style="display: none;" class="form-control fieldType<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
 <?php if ($_smarty_tpl->tpl_vars['complexField']->value) {?>complexField<?php }?>" name="<?php if ($_smarty_tpl->tpl_vars['complexField']->value) {
echo $_smarty_tpl->tpl_vars['complexField']->value;?>
[<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
][<?php echo $_smarty_tpl->tpl_vars['complexStep']->value;?>
][]<?php } else {
echo $_smarty_tpl->tpl_vars['id']->value;?>
[]<?php }?>">
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list_values']->value, 'list_value');
$_smarty_tpl->tpl_vars['list_value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['list_value']->value) {
$_smarty_tpl->tpl_vars['list_value']->do_else = false;
?>
		<option  value="<?php echo $_smarty_tpl->tpl_vars['list_value']->value['id'];?>
" <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['value']->value, 'value_id');
$_smarty_tpl->tpl_vars['value_id']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['value_id']->value) {
$_smarty_tpl->tpl_vars['value_id']->do_else = false;
if ($_smarty_tpl->tpl_vars['list_value']->value['id'] == $_smarty_tpl->tpl_vars['value_id']->value) {?>selected="selected"<?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?> ><?php $_block_plugin44 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin44, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array('mode'=>"raw"));
$_block_repeat=true;
echo $_block_plugin44->translate(array('mode'=>"raw"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['list_value']->value['caption'];
$_block_content44 = ob_get_clean();
$_block_repeat=false;
ob_start();
echo $_block_plugin44->translate(array('mode'=>"raw"), $_block_content44, $_smarty_tpl, $_block_repeat);
echo htmlspecialchars((string)ob_get_clean(), ENT_QUOTES, 'UTF-8', true);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></option>
	<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</select>
<?php $_block_plugin45 = isset($_smarty_tpl->smarty->registered_plugins['block']['javascript'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['javascript'][0][0] : null;
if (!is_callable(array($_block_plugin45, '_tpl_javascript'))) {
throw new SmartyException('block tag \'javascript\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('javascript', array());
$_block_repeat=true;
echo $_block_plugin45->_tpl_javascript(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo '<script'; ?>
 type="text/javascript">
	$(document).ready(function() {
		var limit = <?php if (!empty($_smarty_tpl->tpl_vars['choiceLimit']->value)) {
echo $_smarty_tpl->tpl_vars['choiceLimit']->value;
} else { ?>null<?php }?>;
		var name = "<?php if ($_smarty_tpl->tpl_vars['complexField']->value) {
echo $_smarty_tpl->tpl_vars['complexField']->value;?>
[<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
][<?php echo $_smarty_tpl->tpl_vars['complexStep']->value;?>
][]<?php } else {
echo $_smarty_tpl->tpl_vars['id']->value;?>
[]<?php }?>";
		var fieldId = "<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
";
		var options = {
			selectedList: 5,
			selectedText: "# <?php $_block_plugin46 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin46, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin46->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>selected<?php $_block_content46 = ob_get_clean();
$_block_repeat=false;
ob_start();
echo $_block_plugin46->translate(array(), $_block_content46, $_smarty_tpl, $_block_repeat);
echo htmlspecialchars((string)ob_get_clean(), ENT_QUOTES, 'UTF-8', true);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>",
			noneSelectedText: "<?php $_block_plugin47 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin47, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin47->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Click to select<?php $_block_content47 = ob_get_clean();
$_block_repeat=false;
ob_start();
echo $_block_plugin47->translate(array(), $_block_content47, $_smarty_tpl, $_block_repeat);
echo htmlspecialchars((string)ob_get_clean(), ENT_QUOTES, 'UTF-8', true);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>",
			checkAllText: "",
			uncheckAllText: "",
			header: true,
			height: 'auto'
		};
		$("select[name='" + name + "']").getCustomMultiList(options, fieldId, limit);
	});
<?php echo '</script'; ?>
>
<?php $_block_repeat=false;
echo $_block_plugin45->_tpl_javascript(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
}
}
