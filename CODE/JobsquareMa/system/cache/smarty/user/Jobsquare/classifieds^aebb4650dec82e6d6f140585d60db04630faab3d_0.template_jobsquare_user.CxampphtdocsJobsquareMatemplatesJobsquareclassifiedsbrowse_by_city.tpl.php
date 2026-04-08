<?php
/* Smarty version 4.3.0, created on 2026-03-04 08:22:33
  from 'template_jobsquare_user:CxampphtdocsJobsquareMatemplatesJobsquareclassifiedsbrowse_by_city.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a7ebc9e81df7_30181023',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'aebb4650dec82e6d6f140585d60db04630faab3d' => 
    array (
      0 => 'template_jobsquare_user:CxampphtdocsJobsquareMatemplatesJobsquareclassifiedsbrowse_by_city.tpl',
      1 => 1772573852,
      2 => 'template_jobsquare_user',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69a7ebc9e81df7_30181023 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\JobsquareMa\\system\\ext\\Smarty\\libs\\plugins\\modifier.regex_replace.php','function'=>'smarty_modifier_regex_replace',),1=>array('file'=>'C:\\xampp\\htdocs\\JobsquareMa\\system\\ext\\Smarty\\libs\\plugins\\modifier.truncate.php','function'=>'smarty_modifier_truncate',),));
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
/cities/jobs-in-<?php echo smarty_modifier_regex_replace(htmlentities(mb_convert_encoding((string)$_smarty_tpl->tpl_vars['item']->value['caption'], 'UTF-8', 'UTF-8'), ENT_QUOTES, 'UTF-8', true),"/[-\/]/",'');?>
/">
					<span class="browse-by__item">Emploi à <?php $_block_plugin38 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin38, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin38->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo smarty_modifier_truncate(htmlspecialchars((string)$_smarty_tpl->tpl_vars['item']->value['caption'], ENT_QUOTES, 'UTF-8', true),28,"...",true);
$_block_repeat=false;
echo $_block_plugin38->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
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
		<li class="browse-by__list-empty"><?php $_block_plugin39 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin39, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin39->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Sorry, we don't currently have any jobs for this search. Please try another search.<?php $_block_repeat=false;
echo $_block_plugin39->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></li>
	<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</ul>
<?php }
}
