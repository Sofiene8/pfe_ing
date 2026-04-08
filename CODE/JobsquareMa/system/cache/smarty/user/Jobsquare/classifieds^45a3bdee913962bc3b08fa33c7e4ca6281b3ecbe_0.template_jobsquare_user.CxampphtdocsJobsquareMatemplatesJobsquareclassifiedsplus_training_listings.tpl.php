<?php
/* Smarty version 4.3.0, created on 2026-03-04 11:43:18
  from 'template_jobsquare_user:CxampphtdocsJobsquareMatemplatesJobsquareclassifiedsplus_training_listings.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a81ad6911913_05491774',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '45a3bdee913962bc3b08fa33c7e4ca6281b3ecbe' => 
    array (
      0 => 'template_jobsquare_user:CxampphtdocsJobsquareMatemplatesJobsquareclassifiedsplus_training_listings.tpl',
      1 => 1772573832,
      2 => 'template_jobsquare_user',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69a81ad6911913_05491774 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['listings']->value) {?>
<div class=" content-card training-block">
	<h2 class="card-title">Offres de formation en Maroc </h2>
	<div class="listing-trainings">
		<ul>
			<?php if ($_smarty_tpl->tpl_vars['listings']->value) {?>
			
			
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['listings']->value, 'listing');
$_smarty_tpl->tpl_vars['listing']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['listing']->value) {
$_smarty_tpl->tpl_vars['listing']->do_else = false;
?>
			<li><a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'listing_url' ][ 0 ], array( $_smarty_tpl->tpl_vars['listing']->value ));?>
?backPage=<?php echo $_smarty_tpl->tpl_vars['pageForBackButton']->value;?>
&searchID=<?php echo $_smarty_tpl->tpl_vars['searchId']->value;?>
" class="link"> <?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['listing']->value['Title'], ENT_QUOTES, 'UTF-8', true);?>
 </a></li>
			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			
			
			
			<?php }?>
		</ul>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
</div>
<?php }?> <?php }
}
