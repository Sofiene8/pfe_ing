<?php
/* Smarty version 4.3.0, created on 2026-03-04 08:22:34
  from 'template_jobsquare_user:CxampphtdocsJobsquareMatemplatesJobsquareclassifiedsbrowse_by_state.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a7ebca2350a2_21370678',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '01e62decdcb57c803e6d90577b4b48b5c25d5191' => 
    array (
      0 => 'template_jobsquare_user:CxampphtdocsJobsquareMatemplatesJobsquareclassifiedsbrowse_by_state.tpl',
      1 => 1772573849,
      2 => 'template_jobsquare_user',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69a7ebca2350a2_21370678 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\JobsquareMa\\system\\ext\\Smarty\\libs\\plugins\\modifier.truncate.php','function'=>'smarty_modifier_truncate',),));
$_smarty_tpl->_assignInScope('i', 1);?>
<ul class="list-unstyled browse-by__list">
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['browseItems']->value, 'item');
$_smarty_tpl->tpl_vars['item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->do_else = false;
?>
		<?php if ($_smarty_tpl->tpl_vars['item']->value['count'] > 0 && $_smarty_tpl->tpl_vars['i']->value <= $_smarty_tpl->tpl_vars['recordsNumToDisplay']->value) {?>
			<?php $_smarty_tpl->_assignInScope('i', $_smarty_tpl->tpl_vars['i']->value+1);?>
			<li>
				<a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/states/jobs-in-<?php echo rawurlencode((string)$_smarty_tpl->tpl_vars['item']->value['caption']);?>
/">
					<span class="browse-by__item">Emploi <?php $_block_plugin42 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin42, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin42->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo smarty_modifier_truncate(htmlspecialchars((string)$_smarty_tpl->tpl_vars['item']->value['caption'], ENT_QUOTES, 'UTF-8', true),28,"...",true);
$_block_repeat=false;
echo $_block_plugin42->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></span>
					<span class="count">(<?php echo $_smarty_tpl->tpl_vars['item']->value['count'];?>
)</span>
				</a>
			</li>
		<?php }?>
	<?php
}
if ($_smarty_tpl->tpl_vars['item']->do_else) {
?>
		<li class="browse-by__list-empty"><?php $_block_plugin43 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin43, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin43->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Sorry, we don't currently have any jobs for this search. Please try another search.<?php $_block_repeat=false;
echo $_block_plugin43->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></li>
	<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</ul>
<?php }
}
