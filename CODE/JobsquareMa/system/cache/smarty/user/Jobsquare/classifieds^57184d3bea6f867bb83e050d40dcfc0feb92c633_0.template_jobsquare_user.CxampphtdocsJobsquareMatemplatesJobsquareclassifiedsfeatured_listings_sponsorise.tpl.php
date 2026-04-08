<?php
/* Smarty version 4.3.0, created on 2026-03-04 11:43:18
  from 'template_jobsquare_user:CxampphtdocsJobsquareMatemplatesJobsquareclassifiedsfeatured_listings_sponsorise.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a81ad67ed4d5_77715503',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '57184d3bea6f867bb83e050d40dcfc0feb92c633' => 
    array (
      0 => 'template_jobsquare_user:CxampphtdocsJobsquareMatemplatesJobsquareclassifiedsfeatured_listings_sponsorise.tpl',
      1 => 1772573837,
      2 => 'template_jobsquare_user',
    ),
  ),
  'includes' => 
  array (
    'template_jobsquare_user:listing_item_sponsorise.tpl' => 1,
  ),
),false)) {
function content_69a81ad67ed4d5_77715503 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['listings']->value) {?>
<div class=" content-card offres-sponsorise">
	<section class="listing__featured<?php if ($_smarty_tpl->tpl_vars['listing_type']->value == "Training") {?>-training<?php }?>">
		
			<?php if ($_smarty_tpl->tpl_vars['listings']->value) {?>
				<h2 class="card-title">
					Offres <?php if ($_smarty_tpl->tpl_vars['listing_type']->value == "Training") {?>de formation<?php } else { ?>d'emploi<?php }?> similaires sponsoris&eacute;es
			</h2>
				<div class="listing-item__list  <?php if ($_smarty_tpl->tpl_vars['isbanner']->value == 1) {?>with-banner<?php }?>">
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['listings']->value, 'listing');
$_smarty_tpl->tpl_vars['listing']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['listing']->value) {
$_smarty_tpl->tpl_vars['listing']->do_else = false;
?>
						<?php $_smarty_tpl->_subTemplateRender("template_jobsquare_user:listing_item_sponsorise.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('listing'=>$_smarty_tpl->tpl_vars['listing']->value,'listing_type_id'=>$_smarty_tpl->tpl_vars['listing_type']->value), 0, true);
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
	
	</section>
		<div class="clear"></div>
	</div>

<?php }?>

<?php }
}
