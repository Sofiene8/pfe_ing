<?php
/* Smarty version 4.3.0, created on 2026-02-28 23:48:18
  from 'template_jobsquare_user:CxampphtdocsJobsquareMatemplatesJobsquaresocialsocial_plugins.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a37ec2a327d4_16318746',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7e0853eb5fb9a3e68bb67c849b7f5813143416a1' => 
    array (
      0 => 'template_jobsquare_user:CxampphtdocsJobsquareMatemplatesJobsquaresocialsocial_plugins.tpl',
      1 => 1771678926,
      2 => 'template_jobsquare_user',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69a37ec2a327d4_16318746 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['networks']->value) {?>
	<div class="social-registration">
		<span class="social-registration__buttons">
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['networks']->value, 'network', false, 'network_id');
$_smarty_tpl->tpl_vars['network']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['network_id']->value => $_smarty_tpl->tpl_vars['network']->value) {
$_smarty_tpl->tpl_vars['network']->do_else = false;
?>
				<a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/login/?network=<?php echo $_smarty_tpl->tpl_vars['network_id']->value;
if ($_smarty_tpl->tpl_vars['user_group_id']->value) {?>&amp;user_group_id=<?php echo $_smarty_tpl->tpl_vars['user_group_id']->value;
}?>" class="social-registration__<?php echo $_smarty_tpl->tpl_vars['network_id']->value;?>
" title="<?php $_block_plugin16 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin16, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin16->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Sign in with <?php echo $_smarty_tpl->tpl_vars['network']->value->getName();
$_block_repeat=false;
echo $_block_plugin16->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>">
					<?php if ($_smarty_tpl->tpl_vars['network_id']->value != 'linkedin') {?>
						<?php $_block_plugin17 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin17, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin17->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Sign in with <?php echo $_smarty_tpl->tpl_vars['network']->value->getName();
$_block_repeat=false;
echo $_block_plugin17->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
                    <?php }?>
				</a>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		</span>
	</div>
<?php }
}
}
