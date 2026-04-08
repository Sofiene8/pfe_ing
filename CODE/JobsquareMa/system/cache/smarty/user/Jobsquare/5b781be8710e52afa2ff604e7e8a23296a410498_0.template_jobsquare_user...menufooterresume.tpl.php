<?php
/* Smarty version 4.3.0, created on 2026-02-28 23:48:32
  from 'template_jobsquare_user:..menufooterresume.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a37ed0a4b5d3_93984749',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5b781be8710e52afa2ff604e7e8a23296a410498' => 
    array (
      0 => 'template_jobsquare_user:..menufooterresume.tpl',
      1 => 1771761305,
      2 => 'template_jobsquare_user',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69a37ed0a4b5d3_93984749 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="page-row hidden-print">
	<?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['settings']['google_TrackingID']) {?>
	<?php echo '<script'; ?>
 async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['settings']['google_TrackingID'];?>
"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
>

		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());
		gtag('config', '<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['settings']['google_TrackingID'];?>
');

	<?php echo '</script'; ?>
>
	<?php }?>
</div><?php }
}
