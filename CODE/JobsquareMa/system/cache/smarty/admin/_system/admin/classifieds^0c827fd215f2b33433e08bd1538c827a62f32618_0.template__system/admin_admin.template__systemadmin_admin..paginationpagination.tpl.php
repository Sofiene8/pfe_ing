<?php
/* Smarty version 4.3.0, created on 2026-03-04 08:57:41
  from 'template__system/admin_admin:template__systemadmin_admin..paginationpagination.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a7f405242cb0_00688568',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0c827fd215f2b33433e08bd1538c827a62f32618' => 
    array (
      0 => 'template__system/admin_admin:template__systemadmin_admin..paginationpagination.tpl',
      1 => 1771678928,
      2 => 'template__system/admin_admin',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69a7f405242cb0_00688568 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\JobsquareMa\\system\\ext\\Smarty\\libs\\plugins\\modifier.escape.php','function'=>'smarty_modifier_escape',),));
$_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, "urlParams", null, null);
if (is_array($_smarty_tpl->tpl_vars['paginationInfo']->value['uniqueUrlParams'])) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['paginationInfo']->value['uniqueUrlParams'], 'param', false, 'id');
$_smarty_tpl->tpl_vars['param']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['param']->value) {
$_smarty_tpl->tpl_vars['param']->do_else = false;
?>&amp;<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
=<?php if ($_smarty_tpl->tpl_vars['param']->value['escape']) {
echo smarty_modifier_escape($_smarty_tpl->tpl_vars['param']->value['value'], ((string)$_smarty_tpl->tpl_vars['param']->value['escape']));
} else {
echo $_smarty_tpl->tpl_vars['param']->value['value'];
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
} else { ?>&amp;<?php echo $_smarty_tpl->tpl_vars['paginationInfo']->value['uniqueUrlParams'];
}
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
<div class="items-count"><strong><?php echo $_smarty_tpl->tpl_vars['paginationInfo']->value['itemsCount'];?>
</strong> <?php $_block_plugin45 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin45, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin45->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['paginationInfo']->value['item'], ENT_QUOTES, 'UTF-8', true);?>
 found<?php $_block_repeat=false;
echo $_block_plugin45->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></div>

<div class="pagination__right">
	<div class="number-per-page">
		<select id="itemsPerPage" name="itemsPerPage" onchange="window.location = '?<?php if ($_smarty_tpl->tpl_vars['paginationInfo']->value['restore'] == 1) {?>restore=1<?php }
if ($_smarty_tpl->tpl_vars['paginationInfo']->value['sortingField'] != null) {?>&amp;sortingField=<?php echo $_smarty_tpl->tpl_vars['paginationInfo']->value['sortingField'];
}
if ($_smarty_tpl->tpl_vars['paginationInfo']->value['sortingOrder'] != null) {?>&amp;sortingOrder=<?php echo $_smarty_tpl->tpl_vars['paginationInfo']->value['sortingOrder'];
}?>&amp;page=1<?php if ($_smarty_tpl->tpl_vars['paginationInfo']->value['uniqueUrlParams']) {
echo $_smarty_tpl->smarty->ext->_capture->getBuffer($_smarty_tpl, 'urlParams');
}?>&amp;itemsPerPage=' + this.value;" class="per-page">
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['paginationInfo']->value['numberOfElementsPageSelect'], 'numberOfElement');
$_smarty_tpl->tpl_vars['numberOfElement']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['numberOfElement']->value) {
$_smarty_tpl->tpl_vars['numberOfElement']->do_else = false;
?>
				<option value="<?php echo $_smarty_tpl->tpl_vars['numberOfElement']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['paginationInfo']->value['itemsPerPage'] == $_smarty_tpl->tpl_vars['numberOfElement']->value) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['numberOfElement']->value;?>
</option>
			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		</select>
		<?php $_block_plugin46 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin46, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin46->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>per page<?php $_block_repeat=false;
echo $_block_plugin46->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
	</div>

	<?php if (count($_smarty_tpl->tpl_vars['paginationInfo']->value['pages']) != 1) {?>
		<ul class="pagination">
			<?php if ($_smarty_tpl->tpl_vars['paginationInfo']->value['currentPage'] == 1) {?>
				<li class="none">
					<a href="#">&nbsp;<i class="fa fa-angle-left"></i></a>
				</li>
			<?php } else { ?>
				<li>
					<a class="arrow-left"  href="?<?php if ($_smarty_tpl->tpl_vars['paginationInfo']->value['restore'] == 1) {?>restore=1<?php }?>&amp;page=<?php echo $_smarty_tpl->tpl_vars['paginationInfo']->value['currentPage']-1;?>
&amp;itemsPerPage=<?php echo $_smarty_tpl->tpl_vars['paginationInfo']->value['itemsPerPage'];
if ($_smarty_tpl->tpl_vars['paginationInfo']->value['uniqueUrlParams']) {
echo $_smarty_tpl->smarty->ext->_capture->getBuffer($_smarty_tpl, 'urlParams');
}?>">
						&nbsp;<i class="fa fa-angle-left"></i>
					</a>
				</li>
			<?php }?>
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['paginationInfo']->value['pages'], 'page');
$_smarty_tpl->tpl_vars['page']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['page']->value) {
$_smarty_tpl->tpl_vars['page']->do_else = false;
?>
				<?php if ($_smarty_tpl->tpl_vars['page']->value == $_smarty_tpl->tpl_vars['paginationInfo']->value['currentPage']) {?>
					<li class="active">
						<a href="#"><?php echo $_smarty_tpl->tpl_vars['page']->value;?>
</a>
					</li>
				<?php } else { ?>
					<?php if ($_smarty_tpl->tpl_vars['page']->value == $_smarty_tpl->tpl_vars['paginationInfo']->value['totalPages'] && $_smarty_tpl->tpl_vars['paginationInfo']->value['currentPage'] < $_smarty_tpl->tpl_vars['paginationInfo']->value['totalPages']-3) {?> <li><span>...</span></li> <?php }?>
					<li><a href="?page=<?php echo $_smarty_tpl->tpl_vars['page']->value;
if ($_smarty_tpl->tpl_vars['paginationInfo']->value['restore'] == 1) {?>&amp;restore=1<?php }
if ($_smarty_tpl->tpl_vars['paginationInfo']->value['sortingField'] != null) {?>&amp;sortingField=<?php echo $_smarty_tpl->tpl_vars['paginationInfo']->value['sortingField'];
}
if ($_smarty_tpl->tpl_vars['paginationInfo']->value['sortingOrder'] != null) {?>&amp;sortingOrder=<?php echo $_smarty_tpl->tpl_vars['paginationInfo']->value['sortingOrder'];
}?>&amp;itemsPerPage=<?php echo $_smarty_tpl->tpl_vars['paginationInfo']->value['itemsPerPage'];
if ($_smarty_tpl->tpl_vars['paginationInfo']->value['uniqueUrlParams']) {
echo $_smarty_tpl->smarty->ext->_capture->getBuffer($_smarty_tpl, 'urlParams');
}?>"><?php echo $_smarty_tpl->tpl_vars['page']->value;?>
</a></li>
					<?php if ($_smarty_tpl->tpl_vars['page']->value == 1 && $_smarty_tpl->tpl_vars['paginationInfo']->value['currentPage'] > 4) {?> <li><span>...</span></li> <?php }?>
				<?php }?>
			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>


			<?php if ($_smarty_tpl->tpl_vars['paginationInfo']->value['currentPage'] == $_smarty_tpl->tpl_vars['paginationInfo']->value['totalPages']) {?>
				<li>
					<a href="#">&nbsp;<i class="fa fa-angle-right"></i></a>
				</li>
			<?php } else { ?>
				<li>
					<a class="arrow-right" href="?<?php if ($_smarty_tpl->tpl_vars['paginationInfo']->value['restore'] == 1) {?>restore=1<?php }?>&amp;page=<?php echo $_smarty_tpl->tpl_vars['paginationInfo']->value['currentPage']+1;?>
&amp;itemsPerPage=<?php echo $_smarty_tpl->tpl_vars['paginationInfo']->value['itemsPerPage'];
if ($_smarty_tpl->tpl_vars['paginationInfo']->value['uniqueUrlParams']) {
echo $_smarty_tpl->smarty->ext->_capture->getBuffer($_smarty_tpl, 'urlParams');
}?>">
						&nbsp;<i class="fa fa-angle-right"></i>
					</a>
				</li>
			<?php }?>
		</ul>
	<?php }?>
</div>

<?php if ($_smarty_tpl->tpl_vars['layout']->value == 'header') {?>
	<div id="actionWarning" style="display: none"></div>
<?php }
}
}
