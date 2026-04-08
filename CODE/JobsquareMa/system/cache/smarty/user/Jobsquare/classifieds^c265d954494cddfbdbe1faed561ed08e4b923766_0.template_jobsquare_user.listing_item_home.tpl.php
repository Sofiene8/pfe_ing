<?php
/* Smarty version 4.3.0, created on 2026-03-04 08:22:33
  from 'template_jobsquare_user:listing_item_home.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a7ebc9b13c06_80541527',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c265d954494cddfbdbe1faed561ed08e4b923766' => 
    array (
      0 => 'template_jobsquare_user:listing_item_home.tpl',
      1 => 1772573845,
      2 => 'template_jobsquare_user',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69a7ebc9b13c06_80541527 (Smarty_Internal_Template $_smarty_tpl) {
?><a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'listing_url' ][ 0 ], array( $_smarty_tpl->tpl_vars['listing']->value ));?>
?backPage=<?php echo $_smarty_tpl->tpl_vars['pageForBackButton']->value;?>
&searchID=<?php echo $_smarty_tpl->tpl_vars['searchId']->value;?>
" class="featured-card">
	<div class="featured-info">
		<div class="featured-info__title"><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['listing']->value['Title'], ENT_QUOTES, 'UTF-8', true);?>
</div>
		<div class="featured-info__details">
			<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['listing']->value['user']['CompanyName'], ENT_QUOTES, 'UTF-8', true);?>

			<?php if (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'location' ][ 0 ], array( $_smarty_tpl->tpl_vars['listing']->value ))) {?>
				<span class="dot"></span>
				<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'location' ][ 0 ], array( $_smarty_tpl->tpl_vars['listing']->value ));?>

			<?php }?>
		</div>
	</div>
	<span class="featured-btn"><?php $_block_plugin37 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin37, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin37->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Voir Plus<?php $_block_repeat=false;
echo $_block_plugin37->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></span>
</a>
<?php }
}
