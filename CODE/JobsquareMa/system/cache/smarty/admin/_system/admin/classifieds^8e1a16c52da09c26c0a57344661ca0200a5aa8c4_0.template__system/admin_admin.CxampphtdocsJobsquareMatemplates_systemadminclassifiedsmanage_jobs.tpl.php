<?php
/* Smarty version 4.3.0, created on 2026-03-04 08:57:40
  from 'template__system/admin_admin:CxampphtdocsJobsquareMatemplates_systemadminclassifiedsmanage_jobs.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a7f404ab7765_34090911',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8e1a16c52da09c26c0a57344661ca0200a5aa8c4' => 
    array (
      0 => 'template__system/admin_admin:CxampphtdocsJobsquareMatemplates_systemadminclassifiedsmanage_jobs.tpl',
      1 => 1771678927,
      2 => 'template__system/admin_admin',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69a7f404ab7765_34090911 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="page-title text-center">
	<h1 class="title"><?php $_block_plugin1 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin1, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin1->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Job Postings<?php $_block_repeat=false;
echo $_block_plugin1->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></h1>
	<div class="dropdown dropdown--filter">
		<a class="btn btn-dropdown dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
			<i class="fa fa-search" aria-hidden="true"></i>
			<?php $_block_plugin2 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin2, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin2->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Filter <?php echo $_smarty_tpl->tpl_vars['listingsType']->value['id'];?>
s<?php $_block_repeat=false;
echo $_block_plugin2->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
			<span class="caret"></span>
		</a>
		<div class="dropdown-menu pro-menu fadeInUp animated" tabindex="5003" style="overflow: hidden; outline: none;">
			<form method="post" name="search_form" class="panel-body">
				<input type="hidden" name="action" value="search" />
				<input type="hidden" name="page" value="1" />

				<div class="form-group col-xs-12">
					<input type="text" placeholder="<?php $_block_plugin3 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin3, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin3->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Keywords<?php $_block_repeat=false;
echo $_block_plugin3->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>" value="<?php if ($_smarty_tpl->tpl_vars['idKeyword']->value) {
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['idKeyword']->value, ENT_QUOTES, 'UTF-8', true);
}?>" name="idKeyword" id="idkeyword">
				</div>
				<div class="form-group col-xs-12">
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['search'][0], array( array('property'=>"PostingDate",'template'=>'list.date.tpl'),$_smarty_tpl ) );?>

				</div>
				<div class="form-group col-xs-12">
					<input type="text" value="<?php if ($_smarty_tpl->tpl_vars['companyName']->value) {
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['companyName']->value, ENT_QUOTES, 'UTF-8', true);
}?>" name="company_name[like]" placeholder="<?php $_block_plugin4 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin4, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin4->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Company name or email<?php $_block_repeat=false;
echo $_block_plugin4->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>" />
				</div>
				<div class="form-group col-xs-12">
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['search'][0], array( array('property'=>"product_info_sid",'template'=>"list.like.tpl"),$_smarty_tpl ) );?>

				</div>
				<div class="form-group col-xs-12">
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['search'][0], array( array('property'=>"active"),$_smarty_tpl ) );?>

				</div>
				<div class="form-group col-xs-12">
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['search'][0], array( array('property'=>"featured"),$_smarty_tpl ) );?>
 <?php $_block_plugin5 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin5, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin5->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Featured<?php $_block_repeat=false;
echo $_block_plugin5->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
				</div>
				<div class="form-group col-xs-12">
					<button type="submit" value="Find" class="btn btn--primary col-xs-12"><?php $_block_plugin6 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin6, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin6->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Filter<?php $_block_repeat=false;
echo $_block_plugin6->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></button>
				</div>
			</form>
		</div>
	</div>
	<div class="page-title__buttons">
		<div class="btn-group">
			<a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/import-listings/?listing_type_id=<?php echo $_smarty_tpl->tpl_vars['listingsType']->value['id'];?>
" class="btn btn--bordered"><?php $_block_plugin7 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin7, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin7->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Import<?php $_block_repeat=false;
echo $_block_plugin7->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a>
			<a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/export-listings/?listing_type_id=<?php echo $_smarty_tpl->tpl_vars['listingsType']->value['id'];?>
" class="btn btn--bordered"><?php $_block_plugin8 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin8, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin8->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Export<?php $_block_repeat=false;
echo $_block_plugin8->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a>
		</div>
		<a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/add-listing/?listing_type_id=<?php echo $_smarty_tpl->tpl_vars['listingsType']->value['id'];?>
" class="btn btn--primary"><?php $_block_plugin9 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin9, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin9->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Add New <?php echo $_smarty_tpl->tpl_vars['listingsType']->value['name'];
$_block_repeat=false;
echo $_block_plugin9->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a>
	</div>
</div><?php }
}
