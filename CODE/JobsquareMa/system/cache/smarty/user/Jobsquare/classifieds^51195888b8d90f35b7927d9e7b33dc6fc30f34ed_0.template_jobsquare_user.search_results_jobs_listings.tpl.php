<?php
/* Smarty version 4.3.0, created on 2026-03-04 11:43:28
  from 'template_jobsquare_user:search_results_jobs_listings.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a81ae0157aa5_39924236',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '51195888b8d90f35b7927d9e7b33dc6fc30f34ed' => 
    array (
      0 => 'template_jobsquare_user:search_results_jobs_listings.tpl',
      1 => 1772573842,
      2 => 'template_jobsquare_user',
    ),
  ),
  'includes' => 
  array (
    'template_jobsquare_user:listing_item.tpl' => 1,
  ),
),false)) {
function content_69a81ae0157aa5_39924236 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\JobsquareMa\\system\\ext\\Smarty\\libs\\plugins\\modifier.truncate.php','function'=>'smarty_modifier_truncate',),));
$_smarty_tpl->_assignInScope('index', $_smarty_tpl->tpl_vars['listing_search']->value['current_page']*$_smarty_tpl->tpl_vars['listing_search']->value['listings_per_page']-$_smarty_tpl->tpl_vars['listing_search']->value['listings_per_page']);
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['listings']->value, 'listing', true, NULL, 'listings', array (
  'first' => true,
  'index' => true,
));
$_smarty_tpl->tpl_vars['listing']->iteration = 0;
$_smarty_tpl->tpl_vars['listing']->index = -1;
$_smarty_tpl->tpl_vars['listing']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['listing']->value) {
$_smarty_tpl->tpl_vars['listing']->do_else = false;
$_smarty_tpl->tpl_vars['listing']->iteration++;
$_smarty_tpl->tpl_vars['listing']->index++;
$_smarty_tpl->tpl_vars['listing']->last = $_smarty_tpl->tpl_vars['listing']->iteration === $_smarty_tpl->tpl_vars['listing']->total;
$_smarty_tpl->tpl_vars['__smarty_foreach_listings']->value['index']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_listings']->value['first'] = !$_smarty_tpl->tpl_vars['__smarty_foreach_listings']->value['index'];
$__foreach_listing_12_saved = $_smarty_tpl->tpl_vars['listing'];
?>
	<?php if ($_smarty_tpl->tpl_vars['listing']->value['api']) {?>
		<?php if ($_REQUEST['page'] == '1' && (isset($_smarty_tpl->tpl_vars['__smarty_foreach_listings']->value['first']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_listings']->value['first'] : null)) {?>
			<?php echo $_smarty_tpl->tpl_vars['listing']->value['code'];?>

		<?php }?>

		<div class="sj-job-card listing_item__backfilling" id="api-<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_listings']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_listings']->value['index'] : null);?>
">
			<div class="sj-card-logo" style="font-size:12px; font-weight:700; color:var(--sj-dark);">
				<?php if ($_smarty_tpl->tpl_vars['listing']->value['CompanyName']) {
echo mb_strtoupper((string) smarty_modifier_truncate(htmlspecialchars((string)$_smarty_tpl->tpl_vars['listing']->value['CompanyName'], ENT_QUOTES, 'UTF-8', true),4,'',true) ?? '', 'UTF-8');
}?>
			</div>
			<div class="sj-card-content">
				<div class="sj-card-title">
					<a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['listing']->value['url'];?>
" <?php echo $_smarty_tpl->tpl_vars['listing']->value['target'];?>
 <?php echo $_smarty_tpl->tpl_vars['listing']->value['onmousedown'];?>
 <?php echo $_smarty_tpl->tpl_vars['listing']->value['onclick'];?>
><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['listing']->value['Title'], ENT_QUOTES, 'UTF-8', true);?>
</a>
				</div>
				<div class="sj-card-company">
					<?php if ($_smarty_tpl->tpl_vars['listing']->value['CompanyName']) {?>
						<span><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['listing']->value['CompanyName'], ENT_QUOTES, 'UTF-8', true);?>
</span>
					<?php }?>
					<?php if (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'location' ][ 0 ], array( $_smarty_tpl->tpl_vars['listing']->value ))) {?>
						<span class="sj-sep">&middot;</span>
						<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'location' ][ 0 ], array( $_smarty_tpl->tpl_vars['listing']->value ));?>

					<?php }?>
				</div>
				<div class="sj-card-desc">
					<?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['listing']->value['JobDescription'] ?: '');?>

				</div>
				<div class="sj-card-tags">
					<?php if (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'location' ][ 0 ], array( $_smarty_tpl->tpl_vars['listing']->value ))) {?>
						<span class="sj-card-tag sj-loc"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'location' ][ 0 ], array( $_smarty_tpl->tpl_vars['listing']->value ));?>
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
							<span class="sj-card-tag sj-type"><?php $_block_plugin44 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin44, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin44->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['list_value']->value;
$_block_repeat=false;
echo $_block_plugin44->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></span>
						<?php }?>
					<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
				</div>
			</div>
			<div class="sj-card-right">
				<span class="sj-card-date">
					<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'date' ][ 0 ], array( $_smarty_tpl->tpl_vars['listing']->value['activation_date'] ));?>

				</span>
				<a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['listing']->value['url'];?>
" <?php echo $_smarty_tpl->tpl_vars['listing']->value['target'];?>
 class="sj-card-btn">Voir Plus</a>
			</div>
		</div>
	<?php } else { ?>
		<?php $_smarty_tpl->_subTemplateRender("template_jobsquare_user:listing_item.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('listing'=>$_smarty_tpl->tpl_vars['listing']->value), 0, true);
?>
		<?php if (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'banner' ][ 0 ], array( 'banner_inline' ))) {?>
			<?php if ($_smarty_tpl->tpl_vars['listing']->index == 9) {?>
				<div class="banner banner--inline">
					<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'banner' ][ 0 ], array( 'banner_inline' ));?>

				</div>
			<?php } elseif ($_smarty_tpl->tpl_vars['listing']->index < 10 && $_smarty_tpl->tpl_vars['listing']->last) {?>
				<div class="banner banner--inline">
					<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'banner' ][ 0 ], array( 'banner_inline' ));?>

				</div>
			<?php }?>
		<?php }?>
	<?php }
$_smarty_tpl->tpl_vars['listing'] = $__foreach_listing_12_saved;
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
}
