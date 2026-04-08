<?php
/* Smarty version 4.3.0, created on 2026-02-27 11:09:14
  from 'template_jobsquare_user:searchFormByCompany.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a17b5adf5ce1_50193570',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a7cd7374cbd280f8032c1f05119a3462b300ec89' => 
    array (
      0 => 'template_jobsquare_user:searchFormByCompany.tpl',
      1 => 1771678925,
      2 => 'template_jobsquare_user',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69a17b5adf5ce1_50193570 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="quick-search__inner-pages company_quick_search">
	<div class="container container-fluid quick-search">
		<div class="quick-search__wrapper well">
			<form action="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/companies/" class="form-inline row">
				<input type="hidden" name="action" value="search" />
				<div class="form-group form-group__input <?php if (!$_smarty_tpl->tpl_vars['GLOBALS']->value['settings']['search_by_location']) {?>full<?php }?>">
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['search'][0], array( array('property'=>'CompanyName','template'=>"string.like.tpl"),$_smarty_tpl ) );?>

				</div>
				<?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['settings']['search_by_location']) {?>
					<div class="form-group form-group__input">
						<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['search'][0], array( array('property'=>'GooglePlace','template'=>'google_place.tpl'),$_smarty_tpl ) );?>

					</div>
				<?php }?>
				<div class="form-group form-group__btn">
					<button type="submit" class="quick-search__find btn btn__orange btn__bold"><?php $_block_plugin7 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin7, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin7->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Find Companies<?php $_block_repeat=false;
echo $_block_plugin7->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php }
}
