<?php
/* Smarty version 4.3.0, created on 2026-03-04 08:22:33
  from 'template_jobsquare_user:CxampphtdocsJobsquareMatemplatesJobsquareclassifiedslatest_listings.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a7ebc95f5ed4_72566321',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9552e1b6eb253117668c1105e9672c4264b6f20d' => 
    array (
      0 => 'template_jobsquare_user:CxampphtdocsJobsquareMatemplatesJobsquareclassifiedslatest_listings.tpl',
      1 => 1772573830,
      2 => 'template_jobsquare_user',
    ),
  ),
  'includes' => 
  array (
    'template_jobsquare_user:listing_item_home_recent.tpl' => 1,
  ),
),false)) {
function content_69a7ebc95f5ed4_72566321 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['listings']->value) {?>
	<section class="main-sections main-sections__listing__latest listing__latest<?php if ($_smarty_tpl->tpl_vars['listing_type']->value == "Training") {?>-training<?php }?>">
		<div class="container container-fluid listing">
			<div class="section-header">
				<h2>Dernières Offres <?php if ($_smarty_tpl->tpl_vars['listing_type']->value == "Training") {?>de formation<?php } else { ?>d'emploi<?php }?></h2>
				<a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/<?php if ($_smarty_tpl->tpl_vars['listing_type']->value == 'Training') {?>trainings<?php } else { ?>jobs<?php }?>/">Voir tout →</a>
			</div>
			<div class="jobs-grid">
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['listings']->value, 'listing');
$_smarty_tpl->tpl_vars['listing']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['listing']->value) {
$_smarty_tpl->tpl_vars['listing']->do_else = false;
?>
					<?php $_smarty_tpl->_subTemplateRender("template_jobsquare_user:listing_item_home_recent.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('listing'=>$_smarty_tpl->tpl_vars['listing']->value,'listing_type_id'=>$_smarty_tpl->tpl_vars['listing_type']->value), 0, true);
?>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			</div>
		</div>
	</section>
<?php }
}
}
