<?php
/* Smarty version 4.3.0, created on 2026-03-04 08:22:33
  from 'template_jobsquare_user:CxampphtdocsJobsquareMatemplatesJobsquareclassifiedsfeatured_listings_home.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a7ebc9a164b9_78601716',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fe9a96fd4453fb0f3fa79284e7fb2d0355b175a9' => 
    array (
      0 => 'template_jobsquare_user:CxampphtdocsJobsquareMatemplatesJobsquareclassifiedsfeatured_listings_home.tpl',
      1 => 1772573842,
      2 => 'template_jobsquare_user',
    ),
  ),
  'includes' => 
  array (
    'template_jobsquare_user:listing_item_home.tpl' => 1,
  ),
),false)) {
function content_69a7ebc9a164b9_78601716 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['listings']->value) {?>
	<section class="main-sections listing__featured<?php if ($_smarty_tpl->tpl_vars['listing_type']->value == "Training") {?>-training<?php }?>">
		<div class="container container-fluid listing">
			<?php if ($_smarty_tpl->tpl_vars['listings']->value) {?>
				<div class="section-header">
					<h2>Offres <?php if ($_smarty_tpl->tpl_vars['listing_type']->value == "Training") {?>de formation<?php } else { ?>d'emploi<?php }?> à la une</h2>
				</div>
				<div class="featured-jobs">
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['listings']->value, 'listing');
$_smarty_tpl->tpl_vars['listing']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['listing']->value) {
$_smarty_tpl->tpl_vars['listing']->do_else = false;
?>
						<?php $_smarty_tpl->_subTemplateRender("template_jobsquare_user:listing_item_home.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('listing'=>$_smarty_tpl->tpl_vars['listing']->value,'listing_type_id'=>$_smarty_tpl->tpl_vars['listing_type']->value), 0, true);
?>
					<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
				</div>
				<?php if ($_smarty_tpl->tpl_vars['isbanner']->value == 1) {?>
				<div class="banner banner--right">
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['module'][0], array( array('name'=>"banners",'function'=>"show_banners",'group'=>$_smarty_tpl->tpl_vars['group_banner']->value),$_smarty_tpl ) );?>

				</div>
				<?php }?>
			<?php }?>
		</div>
	</section>
	<div class="view-all-new">
		<?php if ($_smarty_tpl->tpl_vars['listing_type']->value == 'Training') {?>
			<a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/trainings/"><?php $_block_plugin35 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin35, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin35->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>View all trainings<?php $_block_repeat=false;
echo $_block_plugin35->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a>
		<?php } else { ?>
			<a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/jobs/"><?php $_block_plugin36 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin36, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin36->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>View all jobs<?php $_block_repeat=false;
echo $_block_plugin36->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a>
		<?php }?>
	</div>
<?php }
}
}
