<?php
/* Smarty version 4.3.0, created on 2026-02-27 11:06:05
  from 'template_jobsquare_user:CxampphtdocsJobsquareMatemplatesJobsquareclassifiedsquick_search_trainings.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a17a9d1968f3_38618645',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a1acef5490f533b0c8924228fa40df0d5c9a6823' => 
    array (
      0 => 'template_jobsquare_user:CxampphtdocsJobsquareMatemplatesJobsquareclassifiedsquick_search_trainings.tpl',
      1 => 1771678925,
      2 => 'template_jobsquare_user',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69a17a9d1968f3_38618645 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="container container-fluid quick-search-training">
	<div class="quick-search__wrapper well">
		<form action="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/trainings/" class="form-inline row">
			<input type="hidden" name="listing_type[equal]" value="Training" />
			<?php if ($_smarty_tpl->tpl_vars['searchId']->value) {?>
				<input type="hidden" name="searchId" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['searchId']->value, ENT_QUOTES, 'UTF-8', true);?>
" />
			<?php }?>
			<input type="hidden" name="action" value="search" />
			<div class="form-group form-group__input <?php if (!$_smarty_tpl->tpl_vars['GLOBALS']->value['settings']['search_by_location']) {?>full<?php }?>">
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['search'][0], array( array('property'=>'keywords'),$_smarty_tpl ) );?>

			</div>
			<?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['settings']['search_by_location']) {?>
				<div class="form-group form-group__input">
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['search'][0], array( array('property'=>'GooglePlace','template'=>'google_place.tpl'),$_smarty_tpl ) );?>

				</div>
			<?php }?>
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['browse_request_data']->value, 'browse_item');
$_smarty_tpl->tpl_vars['browse_item']->index = -1;
$_smarty_tpl->tpl_vars['browse_item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['browse_item']->key => $_smarty_tpl->tpl_vars['browse_item']->value) {
$_smarty_tpl->tpl_vars['browse_item']->do_else = false;
$_smarty_tpl->tpl_vars['browse_item']->index++;
$_smarty_tpl->tpl_vars['browse_item']->first = !$_smarty_tpl->tpl_vars['browse_item']->index;
$__foreach_browse_item_1_saved = $_smarty_tpl->tpl_vars['browse_item'];
?>
				<?php if ($_smarty_tpl->tpl_vars['browse_item']->first) {?>
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['browse_item']->value, 'criteria');
$_smarty_tpl->tpl_vars['criteria']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['criteria']->key => $_smarty_tpl->tpl_vars['criteria']->value) {
$_smarty_tpl->tpl_vars['criteria']->do_else = false;
$__foreach_criteria_2_saved = $_smarty_tpl->tpl_vars['criteria'];
?>
						<?php if (is_array($_smarty_tpl->tpl_vars['criteria']->value)) {?>
							<input type="hidden" name="<?php echo $_smarty_tpl->tpl_vars['browse_item']->key;?>
[<?php echo $_smarty_tpl->tpl_vars['criteria']->key;?>
][]" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['criteria']->value[0], ENT_QUOTES, 'UTF-8', true);?>
">
						<?php } else { ?>
							<input type="hidden" name="<?php echo $_smarty_tpl->tpl_vars['browse_item']->key;?>
[<?php echo $_smarty_tpl->tpl_vars['criteria']->key;?>
]" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['criteria']->value, ENT_QUOTES, 'UTF-8', true);?>
">
						<?php }?>
					<?php
$_smarty_tpl->tpl_vars['criteria'] = $__foreach_criteria_2_saved;
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
				<?php }?>
			<?php
$_smarty_tpl->tpl_vars['browse_item'] = $__foreach_browse_item_1_saved;
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			<div class="form-group form-group__btn">
				<button type="submit" class="quick-search__find btn btn__orange btn__bold "><?php $_block_plugin20 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin20, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin20->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Find Trainings<?php $_block_repeat=false;
echo $_block_plugin20->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></button>
			</div>
		</form>
	</div>
</div><?php }
}
