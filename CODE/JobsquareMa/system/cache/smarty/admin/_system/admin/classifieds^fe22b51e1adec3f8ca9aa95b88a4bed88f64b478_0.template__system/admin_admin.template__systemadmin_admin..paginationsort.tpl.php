<?php
/* Smarty version 4.3.0, created on 2026-03-04 08:57:41
  from 'template__system/admin_admin:template__systemadmin_admin..paginationsort.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a7f4051be0f7_22523577',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fe22b51e1adec3f8ca9aa95b88a4bed88f64b478' => 
    array (
      0 => 'template__system/admin_admin:template__systemadmin_admin..paginationsort.tpl',
      1 => 1771678928,
      2 => 'template__system/admin_admin',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69a7f4051be0f7_22523577 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\JobsquareMa\\system\\ext\\Smarty\\libs\\plugins\\modifier.escape.php','function'=>'smarty_modifier_escape',),));
?>
<tr>
	<?php if ($_smarty_tpl->tpl_vars['paginationInfo']->value['isCheckboxes'] == true) {?>
		<th class="text-center">
			<label class="cr-styled">
				<input type="checkbox" id="all_checkboxes_control">
				<i class="fa"></i>
			</label>
		</th>
	<?php }?>
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['paginationInfo']->value['fields'], 'fieldInfo', false, 'fieldKey');
$_smarty_tpl->tpl_vars['fieldInfo']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['fieldKey']->value => $_smarty_tpl->tpl_vars['fieldInfo']->value) {
$_smarty_tpl->tpl_vars['fieldInfo']->do_else = false;
?>
		<?php if ($_smarty_tpl->tpl_vars['fieldInfo']->value['isVisible'] == true) {?>
			<th class="sorting">
				<?php if ($_smarty_tpl->tpl_vars['fieldInfo']->value['isSort'] == false) {?>
					<?php $_block_plugin43 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin43, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin43->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['fieldInfo']->value['name'];
$_block_repeat=false;
echo $_block_plugin43->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
				<?php } else { ?>
					<a href="?<?php if ($_smarty_tpl->tpl_vars['paginationInfo']->value['restore'] == 1) {?>restore=1&amp;<?php }?>sortingField=<?php echo $_smarty_tpl->tpl_vars['fieldKey']->value;?>
&amp;sortingOrder=<?php if ($_smarty_tpl->tpl_vars['paginationInfo']->value['sortingOrder'] == 'ASC' && $_smarty_tpl->tpl_vars['paginationInfo']->value['sortingField'] == $_smarty_tpl->tpl_vars['fieldKey']->value) {?>DESC<?php } else { ?>ASC<?php }?>&amp;itemsPerPage=<?php echo $_smarty_tpl->tpl_vars['paginationInfo']->value['itemsPerPage'];?>
&amp;page=1<?php if ($_smarty_tpl->tpl_vars['paginationInfo']->value['uniqueUrlParams']) {
if (is_array($_smarty_tpl->tpl_vars['paginationInfo']->value['uniqueUrlParams'])) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['paginationInfo']->value['uniqueUrlParams'], 'param', false, 'id');
$_smarty_tpl->tpl_vars['param']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['param']->value) {
$_smarty_tpl->tpl_vars['param']->do_else = false;
?>&<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
=<?php if ($_smarty_tpl->tpl_vars['param']->value['escape']) {
echo smarty_modifier_escape($_smarty_tpl->tpl_vars['param']->value['value'], ((string)$_smarty_tpl->tpl_vars['param']->value['escape']));
} else {
echo $_smarty_tpl->tpl_vars['param']->value['value'];
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
} else { ?>&<?php echo $_smarty_tpl->tpl_vars['paginationInfo']->value['uniqueUrlParams'];
}
}?>">
						<?php $_block_plugin44 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin44, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin44->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['fieldInfo']->value['name'];
$_block_repeat=false;
echo $_block_plugin44->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
						<?php if ($_smarty_tpl->tpl_vars['paginationInfo']->value['sortingField'] == $_smarty_tpl->tpl_vars['fieldKey']->value) {?>
							<div class="sorting-icons">
								<?php if ($_smarty_tpl->tpl_vars['paginationInfo']->value['sortingOrder'] == 'DESC') {?>
									<i class="fa fa-sort-amount-desc" aria-hidden="true"></i>
								<?php } else { ?>
									<i class="fa fa-sort-amount-asc" aria-hidden="true"></i>
								<?php }?>
							</div>
						<?php } else { ?>
							<div class="sorting-icons">
								<i class="fa fa-long-arrow-down" aria-hidden="true"></i>
								<i class="fa fa-long-arrow-up" aria-hidden="true"></i>
							</div>
						<?php }?>
					</a>
				<?php }?>
			</th>
		<?php }?>
	<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</tr><?php }
}
