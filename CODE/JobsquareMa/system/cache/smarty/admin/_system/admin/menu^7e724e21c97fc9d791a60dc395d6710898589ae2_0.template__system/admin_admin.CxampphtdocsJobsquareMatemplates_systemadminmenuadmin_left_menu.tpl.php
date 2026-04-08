<?php
/* Smarty version 4.3.0, created on 2026-03-04 08:22:46
  from 'template__system/admin_admin:CxampphtdocsJobsquareMatemplates_systemadminmenuadmin_left_menu.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a7ebd67b1715_36531519',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7e724e21c97fc9d791a60dc395d6710898589ae2' => 
    array (
      0 => 'template__system/admin_admin:CxampphtdocsJobsquareMatemplates_systemadminmenuadmin_left_menu.tpl',
      1 => 1771678928,
      2 => 'template__system/admin_admin',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69a7ebd67b1715_36531519 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\JobsquareMa\\system\\ext\\Smarty\\libs\\plugins\\modifier.replace.php','function'=>'smarty_modifier_replace',),));
$_smarty_tpl->_assignInScope('chars', array(' ','/'));?>

<nav class="navigation">
	<ul class="list-unstyled">
		<li id="dashboard" <?php if ($_smarty_tpl->tpl_vars['url']->value == '/') {?>class="active"<?php }?>>
			<a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['admin_site_url'];?>
">
				<i class="fa fa-tachometer"></i> <span class="nav-label"><?php $_block_plugin26 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin26, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin26->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Dashboard<?php $_block_repeat=false;
echo $_block_plugin26->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></span>
			</a>
		</li>
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['left_admin_menu']->value, 'section_items', false, 'section', 'menu_block', array (
));
$_smarty_tpl->tpl_vars['section_items']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['section']->value => $_smarty_tpl->tpl_vars['section_items']->value) {
$_smarty_tpl->tpl_vars['section_items']->do_else = false;
?>
			<li class="has-submenu nav__item <?php if ($_smarty_tpl->tpl_vars['section_items']->value['active']) {?>active<?php }?>" id="<?php echo mb_strtolower((string) $_smarty_tpl->tpl_vars['section_items']->value['id'], 'UTF-8');?>
">
                <a href="#"><i class="fa <?php echo mb_strtolower((string) $_smarty_tpl->tpl_vars['section_items']->value['id'], 'UTF-8');?>
"></i> <span class="nav-label"><?php $_block_plugin27 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin27, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin27->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['section']->value;
$_block_repeat=false;
echo $_block_plugin27->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></span></a>
                <ul class="list-unstyled">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['section_items']->value, 'item');
$_smarty_tpl->tpl_vars['item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->do_else = false;
?>
                        <?php if (is_array($_smarty_tpl->tpl_vars['item']->value)) {?>
                            <li class="<?php if ($_smarty_tpl->tpl_vars['item']->value['active']) {?>active<?php }?>">
                                <a href="<?php echo $_smarty_tpl->tpl_vars['item']->value['reference'];?>
" data-accordion="<?php echo mb_strtolower((string) $_smarty_tpl->tpl_vars['section_items']->value['id'], 'UTF-8');?>
" class="sub-<?php echo smarty_modifier_replace(mb_strtolower((string) $_smarty_tpl->tpl_vars['item']->value['title'], 'UTF-8'),$_smarty_tpl->tpl_vars['chars']->value,'');?>
"><?php $_block_plugin28 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin28, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin28->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['item']->value['title'];
$_block_repeat=false;
echo $_block_plugin28->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a>
                            </li>
                        <?php }?>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </ul>
            </li>
		<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		<?php if ($_smarty_tpl->tpl_vars['acl']->value->isAllowed('Settings and Configuration')) {?>
			<li id="plugins" class="<?php if (in_array($_smarty_tpl->tpl_vars['url']->value,array('/system/miscellaneous/plugins/','/system/miscellaneous/jobg8_settings/','/social-media/linkedin','/system/miscellaneous/plugins/','/system/miscellaneous/fb_app_settings/'))) {?>active<?php }?>">
				<a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['admin_site_url'];?>
/system/miscellaneous/plugins/" data-accordion="plugins"><span class="nav-label"><i class="fa fa-plug"></i><?php $_block_plugin29 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin29, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin29->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Plugins<?php $_block_repeat=false;
echo $_block_plugin29->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></span></a>
			</li>
		<?php }?>
	</ul>
</nav>
<div class="packageVersion text-center"><?php $_block_plugin30 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin30, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin30->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>version<?php $_block_repeat=false;
echo $_block_plugin30->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?> <?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['version']['major'];?>
.<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['version']['minor'];?>
.<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['version']['build'];?>
</div>

<?php $_block_plugin31 = isset($_smarty_tpl->smarty->registered_plugins['block']['javascript'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['javascript'][0][0] : null;
if (!is_callable(array($_block_plugin31, '_tpl_javascript'))) {
throw new SmartyException('block tag \'javascript\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('javascript', array());
$_block_repeat=true;
echo $_block_plugin31->_tpl_javascript(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
	<?php echo '<script'; ?>
 language="JavaScript" type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['user_site_url'];?>
/templates/_system/admin/assets/third-party/js/jquery.nicescroll.js"><?php echo '</script'; ?>
>

	<?php echo '<script'; ?>
>
		var $sideBar = $('aside.left-panel');
		var $navbarItem = $("aside.left-panel nav.navigation > ul > li > a");

		// mark left menu item as active if none marked
		// todo: refactor
		if ($('.left-panel nav .active').length == 0) {
			if (localStorage.getItem("currentMenu") !== null) {
				var openMenu = localStorage.getItem('currentMenu');
				$('#' + openMenu).addClass('active');
			}

			if (localStorage.getItem("currentSubMenu") !== null) {
				var openSubMenu = localStorage.getItem('currentSubMenu');
				$('.' + openSubMenu).closest('li').addClass('active');
			}
		}

		$('.navbar-toggle').on('click', function () {
			$sideBar.toggleClass('collapsed');
		});

		$('.has-submenu ul a').on('click', function() {
			localStorage.setItem('currentSubMenu', $(this).attr('class'));
		});

		$('[data-accordion]').on('click', function() {
			localStorage.setItem('currentMenu', $(this).data('accordion'));
		});

		$navbarItem.click(function (e) {
			if ($(this).closest('li').hasClass('has-submenu')) {
				e.preventDefault();
				$("aside.left-panel nav.navigation > ul > li > ul").slideUp(300);
				$("aside.left-panel nav.navigation > ul > li").removeClass('active');

				if (!$(this).next().is(":visible")) {
					$(this).next().slideToggle(300, function () {
						$("aside.left-panel:not(.collapsed)").getNiceScroll().resize();
					});
					$(this).closest('li').addClass('active');
				}
				return false;
			}
		});

		$("aside.left-panel").niceScroll({
			cursorcolor: '#8e909a',
			cursorborder: '0px solid #fff',
			cursoropacitymax: '0.5',
			cursorborderradius: '0px'
		});

	<?php echo '</script'; ?>
>
<?php $_block_repeat=false;
echo $_block_plugin31->_tpl_javascript(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
}
}
