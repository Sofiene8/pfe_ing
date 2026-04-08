<?php
/* Smarty version 4.3.0, created on 2026-03-04 11:43:18
  from 'template_jobsquare_user:listing_item_interne.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a81ad685e016_45964458',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '248f526dfae4cec5e2861b5bc3812855a5531216' => 
    array (
      0 => 'template_jobsquare_user:listing_item_interne.tpl',
      1 => 1772573843,
      2 => 'template_jobsquare_user',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69a81ad685e016_45964458 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\JobsquareMa\\system\\ext\\Smarty\\libs\\plugins\\modifier.explode.php','function'=>'smarty_modifier_explode',),1=>array('file'=>'C:\\xampp\\htdocs\\JobsquareMa\\system\\ext\\Smarty\\libs\\plugins\\modifier.count.php','function'=>'smarty_modifier_count',),));
?>
<a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'listing_url' ][ 0 ], array( $_smarty_tpl->tpl_vars['listing']->value ));?>
?backPage=<?php echo $_smarty_tpl->tpl_vars['pageForBackButton']->value;?>
&searchID=<?php echo $_smarty_tpl->tpl_vars['searchId']->value;?>
" class="featured-card">
	<div class="featured-info">
		<div class="featured-info__title"><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['listing']->value['Title'], ENT_QUOTES, 'UTF-8', true);?>
</div>
		<div class="featured-info__details">
			<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['listing']->value['user']['CompanyName'], ENT_QUOTES, 'UTF-8', true);?>

			<?php if (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'location' ][ 0 ], array( $_smarty_tpl->tpl_vars['listing']->value ))) {?>
				<span class="dot"></span>
				<?php $_smarty_tpl->_assignInScope('location', call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'location' ][ 0 ], array( $_smarty_tpl->tpl_vars['listing']->value )));?>
				<?php $_smarty_tpl->_assignInScope('parts', smarty_modifier_explode(",",$_smarty_tpl->tpl_vars['location']->value));?>
				<?php $_smarty_tpl->_assignInScope('total', smarty_modifier_count($_smarty_tpl->tpl_vars['parts']->value));?>
				<?php if ($_smarty_tpl->tpl_vars['parts']->value[$_smarty_tpl->tpl_vars['total']->value-2]) {
echo $_smarty_tpl->tpl_vars['parts']->value[$_smarty_tpl->tpl_vars['total']->value-2];?>
,<?php }
if ($_smarty_tpl->tpl_vars['parts']->value[$_smarty_tpl->tpl_vars['total']->value-1]) {
echo $_smarty_tpl->tpl_vars['parts']->value[$_smarty_tpl->tpl_vars['total']->value-1];
}?>
			<?php }?>
		</div>
	</div>
	<span class="featured-btn">Voir Plus</span>
</a><?php }
}
