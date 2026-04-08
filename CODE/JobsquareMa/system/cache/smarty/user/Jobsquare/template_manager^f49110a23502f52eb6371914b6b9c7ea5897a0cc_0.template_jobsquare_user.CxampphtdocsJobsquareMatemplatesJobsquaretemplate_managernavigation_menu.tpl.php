<?php
/* Smarty version 4.3.0, created on 2026-03-04 08:22:33
  from 'template_jobsquare_user:CxampphtdocsJobsquareMatemplatesJobsquaretemplate_managernavigation_menu.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a7ebc92b9881_97828488',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f49110a23502f52eb6371914b6b9c7ea5897a0cc' => 
    array (
      0 => 'template_jobsquare_user:CxampphtdocsJobsquareMatemplatesJobsquaretemplate_managernavigation_menu.tpl',
      1 => 1772573775,
      2 => 'template_jobsquare_user',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69a7ebc92b9881_97828488 (Smarty_Internal_Template $_smarty_tpl) {
?><ul class="nav navbar-nav navbar-left">
    
	
	<?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/jobs/' || $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/job/' || $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/registration/' || $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/login/') {?>
	&nbsp;
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['menuItems']->value, 'menuItem');
$_smarty_tpl->tpl_vars['menuItem']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['menuItem']->value) {
$_smarty_tpl->tpl_vars['menuItem']->do_else = false;
?>
	<?php if ($_smarty_tpl->tpl_vars['menuItem']->value['fixed_url'] == '#') {?>
	  <li class="navbar__item <?php if ($_smarty_tpl->tpl_vars['url']->value == $_smarty_tpl->tpl_vars['menuItem']->value['url']) {?>active<?php }
if ($_REQUEST['listing_type_id'] == 'Job' && $_smarty_tpl->tpl_vars['menuItem']->value['url'] == '/add-listing/?listing_type_id=Job') {?>active<?php }
if ($_smarty_tpl->tpl_vars['menuItem']->value['children']) {?> dropdown<?php }?>">
            <a class="navbar__link" href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['menuItem']->value['fixed_url'], ENT_QUOTES, 'UTF-8', true);?>
"><span><?php $_block_plugin20 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin20, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin20->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['menuItem']->value['name'];
$_block_repeat=false;
echo $_block_plugin20->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></span></a>
            <?php if ($_smarty_tpl->tpl_vars['menuItem']->value['children']) {?>
                <ul class="dropdown-menu">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['menuItem']->value['children'], 'sub_item');
$_smarty_tpl->tpl_vars['sub_item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['sub_item']->value) {
$_smarty_tpl->tpl_vars['sub_item']->do_else = false;
?>
                        <li class="navbar__item <?php if ($_smarty_tpl->tpl_vars['url']->value == $_smarty_tpl->tpl_vars['sub_item']->value['url']) {?>active<?php }
if ($_REQUEST['listing_type_id'] == 'Job' && $_smarty_tpl->tpl_vars['sub_item']->value['url'] == '/add-listing/?listing_type_id=Job') {?>active<?php }?>">
                            <a class="navbar__link" href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['sub_item']->value['fixed_url'], ENT_QUOTES, 'UTF-8', true);?>
"><span><?php $_block_plugin21 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin21, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin21->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['sub_item']->value['name'];
$_block_repeat=false;
echo $_block_plugin21->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></span></a>
                        </li>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </ul>
				</li>
            <?php }?>
			   <?php }?>
         <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		 
	<?php } elseif ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/training/') {?>
	&nbsp;
	
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['menuItems']->value, 'menuItem');
$_smarty_tpl->tpl_vars['menuItem']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['menuItem']->value) {
$_smarty_tpl->tpl_vars['menuItem']->do_else = false;
?>
	<?php if ($_smarty_tpl->tpl_vars['menuItem']->value['url'] == '/jobs/' || $_smarty_tpl->tpl_vars['menuItem']->value['url'] == '/trainings/') {?>
	  <li class="navbar__item <?php if ($_smarty_tpl->tpl_vars['url']->value == $_smarty_tpl->tpl_vars['menuItem']->value['url']) {?>active<?php }
if ($_REQUEST['listing_type_id'] == 'Job' && $_smarty_tpl->tpl_vars['menuItem']->value['url'] == '/add-listing/?listing_type_id=Job') {?>active<?php }
if ($_smarty_tpl->tpl_vars['menuItem']->value['children']) {?> dropdown<?php }?>">
            <a class="navbar__link" href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['menuItem']->value['fixed_url'], ENT_QUOTES, 'UTF-8', true);?>
"><span><?php $_block_plugin22 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin22, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin22->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['menuItem']->value['name'];
$_block_repeat=false;
echo $_block_plugin22->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></span></a>
            <?php if ($_smarty_tpl->tpl_vars['menuItem']->value['children']) {?>
                <ul class="dropdown-menu">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['menuItem']->value['children'], 'sub_item');
$_smarty_tpl->tpl_vars['sub_item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['sub_item']->value) {
$_smarty_tpl->tpl_vars['sub_item']->do_else = false;
?>
                        <li class="navbar__item <?php if ($_smarty_tpl->tpl_vars['url']->value == $_smarty_tpl->tpl_vars['sub_item']->value['url']) {?>active<?php }
if ($_REQUEST['listing_type_id'] == 'Job' && $_smarty_tpl->tpl_vars['sub_item']->value['url'] == '/add-listing/?listing_type_id=Job') {?>active<?php }?>">
                            <a class="navbar__link" href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['sub_item']->value['fixed_url'], ENT_QUOTES, 'UTF-8', true);?>
"><span><?php $_block_plugin23 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin23, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin23->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['sub_item']->value['name'];
$_block_repeat=false;
echo $_block_plugin23->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></span></a>
                        </li>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </ul>
				</li>
            <?php }?>
			   <?php }?>
         <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?> 
    <?php } elseif ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/edit-resume/' || $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/resume/' || ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/my-listings/'&$_smarty_tpl->tpl_vars['GLOBALS']->value['current_user']['group']['id'] != "Employer") || ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/system/applications/view/'&$_smarty_tpl->tpl_vars['GLOBALS']->value['current_user']['group']['id'] != "Employer") || ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/edit-profile/'&$_smarty_tpl->tpl_vars['GLOBALS']->value['current_user']['group']['id'] != "Employer")) {?>
	
	&nbsp;
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['menuItems']->value, 'menuItem');
$_smarty_tpl->tpl_vars['menuItem']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['menuItem']->value) {
$_smarty_tpl->tpl_vars['menuItem']->do_else = false;
?>
	<?php if ($_smarty_tpl->tpl_vars['menuItem']->value['fixed_url'] == '#') {?>
	  <li class="navbar__item <?php if ($_smarty_tpl->tpl_vars['url']->value == $_smarty_tpl->tpl_vars['menuItem']->value['url']) {?>active<?php }
if ($_REQUEST['listing_type_id'] == 'Job' && $_smarty_tpl->tpl_vars['menuItem']->value['url'] == '/add-listing/?listing_type_id=Job') {?>active<?php }
if ($_smarty_tpl->tpl_vars['menuItem']->value['children']) {?> dropdown<?php }?>">
            <a class="navbar__link" href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['menuItem']->value['fixed_url'], ENT_QUOTES, 'UTF-8', true);?>
"><span><?php $_block_plugin24 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin24, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin24->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['menuItem']->value['name'];
$_block_repeat=false;
echo $_block_plugin24->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></span></a>
            <?php if ($_smarty_tpl->tpl_vars['menuItem']->value['children']) {?>
                <ul class="dropdown-menu">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['menuItem']->value['children'], 'sub_item');
$_smarty_tpl->tpl_vars['sub_item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['sub_item']->value) {
$_smarty_tpl->tpl_vars['sub_item']->do_else = false;
?>
                        <li class="navbar__item <?php if ($_smarty_tpl->tpl_vars['url']->value == $_smarty_tpl->tpl_vars['sub_item']->value['url']) {?>active<?php }
if ($_REQUEST['listing_type_id'] == 'Job' && $_smarty_tpl->tpl_vars['sub_item']->value['url'] == '/add-listing/?listing_type_id=Job') {?>active<?php }?>">
                            <a class="navbar__link" href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['sub_item']->value['fixed_url'], ENT_QUOTES, 'UTF-8', true);?>
"><span><?php $_block_plugin25 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin25, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin25->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['sub_item']->value['name'];
$_block_repeat=false;
echo $_block_plugin25->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></span></a>
                        </li>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </ul>
				</li>
            <?php }?>
			   <?php }?>
         <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		<?php } elseif (($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/add-listing/' || $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/my-listings/' || $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/edit-job/' || $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/clone-job/' || $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/job-preview/' || $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/edit-profile/' || $_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/resumes/')) {?>
	
	&nbsp;
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['menuItems']->value, 'menuItem');
$_smarty_tpl->tpl_vars['menuItem']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['menuItem']->value) {
$_smarty_tpl->tpl_vars['menuItem']->do_else = false;
?>
		<?php if ($_smarty_tpl->tpl_vars['menuItem']->value['url'] == '/jobs/' || $_smarty_tpl->tpl_vars['menuItem']->value['url'] == '/trainings/' || $_smarty_tpl->tpl_vars['menuItem']->value['url'] == '/companies/') {?>
	  <li class="navbar__item <?php if ($_smarty_tpl->tpl_vars['url']->value == $_smarty_tpl->tpl_vars['menuItem']->value['url']) {?>active<?php }
if ($_REQUEST['listing_type_id'] == 'Job' && $_smarty_tpl->tpl_vars['menuItem']->value['url'] == '/add-listing/?listing_type_id=Job') {?>active<?php }
if ($_smarty_tpl->tpl_vars['menuItem']->value['children']) {?> dropdown<?php }?>">
            <a class="navbar__link" href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['menuItem']->value['fixed_url'], ENT_QUOTES, 'UTF-8', true);?>
"><span><?php $_block_plugin26 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin26, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin26->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['menuItem']->value['name'];
$_block_repeat=false;
echo $_block_plugin26->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></span></a>
            <?php if ($_smarty_tpl->tpl_vars['menuItem']->value['children']) {?>
                <ul class="dropdown-menu">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['menuItem']->value['children'], 'sub_item');
$_smarty_tpl->tpl_vars['sub_item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['sub_item']->value) {
$_smarty_tpl->tpl_vars['sub_item']->do_else = false;
?>
                        <li class="navbar__item <?php if ($_smarty_tpl->tpl_vars['url']->value == $_smarty_tpl->tpl_vars['sub_item']->value['url']) {?>active<?php }
if ($_REQUEST['listing_type_id'] == 'Job' && $_smarty_tpl->tpl_vars['sub_item']->value['url'] == '/add-listing/?listing_type_id=Job') {?>active<?php }?>">
                            <a class="navbar__link" href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['sub_item']->value['fixed_url'], ENT_QUOTES, 'UTF-8', true);?>
"><span><?php $_block_plugin27 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin27, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin27->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['sub_item']->value['name'];
$_block_repeat=false;
echo $_block_plugin27->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></span></a>
                        </li>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </ul>
				</li>
            <?php }?>
			   <?php }?>
         <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?> 
		 <?php } elseif ((($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/products/')&$_smarty_tpl->tpl_vars['GLOBALS']->value['current_user']['group']['id'] == "Employer") || (($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/shopping-cart/')&$_smarty_tpl->tpl_vars['GLOBALS']->value['current_user']['group']['id'] == "Employer")) {?>
		
		&nbsp;
	<?php } else { ?>
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['menuItems']->value, 'menuItem');
$_smarty_tpl->tpl_vars['menuItem']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['menuItem']->value) {
$_smarty_tpl->tpl_vars['menuItem']->do_else = false;
?>
        <li class="navbar__item <?php if ($_smarty_tpl->tpl_vars['url']->value == $_smarty_tpl->tpl_vars['menuItem']->value['url']) {?>active<?php }
if ($_REQUEST['listing_type_id'] == 'Job' && $_smarty_tpl->tpl_vars['menuItem']->value['url'] == '/add-listing/?listing_type_id=Job') {?>active<?php }
if ($_smarty_tpl->tpl_vars['menuItem']->value['children']) {?> dropdown<?php }?>">
            <a class="navbar__link" href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['menuItem']->value['fixed_url'], ENT_QUOTES, 'UTF-8', true);?>
"><span><?php $_block_plugin28 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin28, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin28->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['menuItem']->value['name'];
$_block_repeat=false;
echo $_block_plugin28->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></span></a>
            <?php if ($_smarty_tpl->tpl_vars['menuItem']->value['children']) {?>
                <ul class="dropdown-menu">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['menuItem']->value['children'], 'sub_item');
$_smarty_tpl->tpl_vars['sub_item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['sub_item']->value) {
$_smarty_tpl->tpl_vars['sub_item']->do_else = false;
?>
                        <li class="navbar__item <?php if ($_smarty_tpl->tpl_vars['url']->value == $_smarty_tpl->tpl_vars['sub_item']->value['url']) {?>active<?php }
if ($_REQUEST['listing_type_id'] == 'Job' && $_smarty_tpl->tpl_vars['sub_item']->value['url'] == '/add-listing/?listing_type_id=Job') {?>active<?php }?>">
                            <a class="navbar__link" href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['sub_item']->value['fixed_url'], ENT_QUOTES, 'UTF-8', true);?>
"><span><?php $_block_plugin29 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin29, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin29->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['sub_item']->value['name'];
$_block_repeat=false;
echo $_block_plugin29->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></span></a>
                        </li>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </ul>
            <?php }?>
        </li>
	
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		<?php }?>
</ul>

<?php $_block_plugin30 = isset($_smarty_tpl->smarty->registered_plugins['block']['javascript'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['javascript'][0][0] : null;
if (!is_callable(array($_block_plugin30, '_tpl_javascript'))) {
throw new SmartyException('block tag \'javascript\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('javascript', array());
$_block_repeat=true;
echo $_block_plugin30->_tpl_javascript(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
    <?php echo '<script'; ?>
>
        $('.navbar__link').on('click', function(e) {
            if ($(this).attr('href') == '' || $(this).attr('href') == 'https://' ||
                    $(this).attr('href') == 'https://' || $(this).attr('href') == '#') {
                e.preventDefault();
            }
        });

        $('.dropdown > a').on('touchstart', function (e) {
            var link = $(this);
            if (link.hasClass('hover')) {
                return true;
            } else {
                link.addClass('hover');
                $('.dropdown > a').not(this).removeClass('hover');
                e.preventDefault();
                return false;
            }
        });

        $(document).on('click', function (e) {
            var dropdown = $('.navbar__link.hover').closest('.navbar__item');

            if (!dropdown.is(e.target) && dropdown.has(e.target).length === 0) {
                dropdown.find('.navbar__link.hover').removeClass('hover');
            }
        });
    <?php echo '</script'; ?>
>
<?php $_block_repeat=false;
echo $_block_plugin30->_tpl_javascript(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
}
}
