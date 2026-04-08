<?php
/* Smarty version 4.3.0, created on 2026-03-04 08:22:33
  from 'template_jobsquare_user:CxampphtdocsJobsquareMatemplatesJobsquareclassifiedsrandom_secteurs.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a7ebc9f07b38_27919009',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cb4478ee5b199193be071ab291e7b27231c97be6' => 
    array (
      0 => 'template_jobsquare_user:CxampphtdocsJobsquareMatemplatesJobsquareclassifiedsrandom_secteurs.tpl',
      1 => 1772573833,
      2 => 'template_jobsquare_user',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69a7ebc9f07b38_27919009 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['secteurs']->value) {?>
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['secteurs']->value, 'state');
$_smarty_tpl->tpl_vars['state']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['state']->value) {
$_smarty_tpl->tpl_vars['state']->do_else = false;
?>
	<div class="browse-jobs col-lg-3 col-xs-6 animation"> <a class="img webp" href="<?php if ($_smarty_tpl->tpl_vars['state']->value['url']) {
echo $_smarty_tpl->tpl_vars['state']->value['url'];
} else { ?>#<?php }?>" style="background-image: url(<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/files/secteurs/<?php echo $_smarty_tpl->tpl_vars['state']->value['picture'];?>
);">
				<div class="category-title"> <span><?php echo $_smarty_tpl->tpl_vars['state']->value['name'];?>
 </span> </div>
				</a> </div>
			
			
	<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}?>

<?php }
}
