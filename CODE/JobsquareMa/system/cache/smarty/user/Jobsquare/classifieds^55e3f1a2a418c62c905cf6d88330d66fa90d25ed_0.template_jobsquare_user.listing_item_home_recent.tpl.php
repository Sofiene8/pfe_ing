<?php
/* Smarty version 4.3.0, created on 2026-03-04 08:22:33
  from 'template_jobsquare_user:listing_item_home_recent.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a7ebc98079d0_32380353',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '55e3f1a2a418c62c905cf6d88330d66fa90d25ed' => 
    array (
      0 => 'template_jobsquare_user:listing_item_home_recent.tpl',
      1 => 1772573846,
      2 => 'template_jobsquare_user',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69a7ebc98079d0_32380353 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\JobsquareMa\\system\\ext\\Smarty\\libs\\plugins\\modifier.truncate.php','function'=>'smarty_modifier_truncate',),));
?>
<a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'listing_url' ][ 0 ], array( $_smarty_tpl->tpl_vars['listing']->value ));?>
?backPage=<?php echo $_smarty_tpl->tpl_vars['pageForBackButton']->value;?>
&searchID=<?php echo $_smarty_tpl->tpl_vars['searchId']->value;?>
" class="job-card<?php if ($_smarty_tpl->tpl_vars['listing']->value['featured'] || $_smarty_tpl->tpl_vars['listing']->value['user']['featured']) {?> job-card--featured<?php }?>">
	<?php $_smarty_tpl->_assignInScope('now', time());?>
	<?php $_smarty_tpl->_assignInScope('activation', strtotime($_smarty_tpl->tpl_vars['listing']->value['activation_date']));?>
	<?php if (($_smarty_tpl->tpl_vars['now']->value-$_smarty_tpl->tpl_vars['activation']->value) < 86400) {?>
		<span class="badge-new">NEW</span>
	<?php }?>
	<div class="job-card__title"><?php echo smarty_modifier_truncate(preg_replace('!<[^>]*?>!', ' ', htmlspecialchars((string)$_smarty_tpl->tpl_vars['listing']->value['Title'], ENT_QUOTES, 'UTF-8', true) ?: ''),40,"...");?>
</div>
	<div class="job-card__company">
		<?php echo smarty_modifier_truncate(preg_replace('!<[^>]*?>!', ' ', htmlspecialchars((string)$_smarty_tpl->tpl_vars['listing']->value['user']['CompanyName'], ENT_QUOTES, 'UTF-8', true) ?: ''),25,"...");?>

		<?php if (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'location' ][ 0 ], array( $_smarty_tpl->tpl_vars['listing']->value ))) {?>
			<span class="dot"></span>
			<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'location' ][ 0 ], array( $_smarty_tpl->tpl_vars['listing']->value ));?>

		<?php }?>
	</div>
	<div class="job-card__meta">
		<?php if (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'location' ][ 0 ], array( $_smarty_tpl->tpl_vars['listing']->value ))) {?>
			<span class="job-card__tag job-card__tag--location"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'location' ][ 0 ], array( $_smarty_tpl->tpl_vars['listing']->value ));?>
</span>
		<?php }?>
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['listing']->value['EmploymentType'], 'list_value', false, NULL, 'multifor', array (
  'first' => true,
  'index' => true,
));
$_smarty_tpl->tpl_vars['list_value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['list_value']->value) {
$_smarty_tpl->tpl_vars['list_value']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_multifor']->value['index']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_multifor']->value['first'] = !$_smarty_tpl->tpl_vars['__smarty_foreach_multifor']->value['index'];
?>
			<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_multifor']->value['first']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_multifor']->value['first'] : null) && $_smarty_tpl->tpl_vars['list_value']->value) {?>
				<span class="job-card__tag job-card__tag--type"><?php $_block_plugin34 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin34, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin34->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['list_value']->value;
$_block_repeat=false;
echo $_block_plugin34->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></span>
			<?php }?>
		<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		<span class="job-card__tag job-card__tag--date"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'date' ][ 0 ], array( $_smarty_tpl->tpl_vars['listing']->value['activation_date'] ));?>
</span>
	</div>
</a>
<?php }
}
