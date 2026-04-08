<?php
/* Smarty version 4.3.0, created on 2026-03-04 08:57:41
  from 'template__system/admin_admin:CxampphtdocsJobsquareMatemplates_systemadminclassifiedsdisplay_results.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a7f405075c13_68370322',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cc4b079ecf3fcc563f1e715aed886430328f315b' => 
    array (
      0 => 'template__system/admin_admin:CxampphtdocsJobsquareMatemplates_systemadminclassifiedsdisplay_results.tpl',
      1 => 1771678927,
      2 => 'template__system/admin_admin',
    ),
  ),
  'includes' => 
  array (
    'template__system/admin_admin:../pagination/pagination_top.tpl' => 1,
    'template__system/admin_admin:../pagination/sort.tpl' => 1,
    'template__system/admin_admin:../pagination/pagination.tpl' => 1,
  ),
),false)) {
function content_69a7f405075c13_68370322 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 language="JavaScript" type="text/javascript" src="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['common_js'][0], array( array(),$_smarty_tpl ) );?>
/pagination.js"><?php echo '</script'; ?>
>
<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, "confirmToDelete", null, null);
$_block_plugin26 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin26, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin26->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Are you sure you want to delete this <?php echo mb_strtolower((string) $_smarty_tpl->tpl_vars['listingsType']->value['name'], 'UTF-8');?>
?<?php $_block_repeat=false;
echo $_block_plugin26->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
<div class="panel panel-default panel--max clearfix">
	<div class="table__pagination table__pagination--header">
		<?php $_smarty_tpl->_subTemplateRender("template__system/admin_admin:../pagination/pagination_top.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('layout'=>"header"), 0, false);
?>
	</div>

	<form method="post" action="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/listing-actions/" name="resultsForm" class="clearfix">
		<input type="hidden" name="action_name" id="action_name" value="">
		<input type="hidden" name="listingTypeId" value="<?php echo $_smarty_tpl->tpl_vars['listingsType']->value['id'];?>
">
		<div class="table-responsive">
			<table width="100%" class="table table-striped with-bulk">
				<thead>
					<?php $_smarty_tpl->_subTemplateRender("template__system/admin_admin:../pagination/sort.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
				</thead>
				<tbody>
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['listings']->value, 'listing', false, NULL, 'listings_block', array (
  'iteration' => true,
));
$_smarty_tpl->tpl_vars['listing']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['listing']->value) {
$_smarty_tpl->tpl_vars['listing']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_listings_block']->value['iteration']++;
?>
					<tr>
						<td class="text-center">
							<label class="cr-styled">
								<input type="checkbox" name="listings[<?php echo $_smarty_tpl->tpl_vars['listing']->value['id'];?>
]" value="1" id="checkbox_<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_listings_block']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_listings_block']->value['iteration'] : null);?>
" />
								<i class="fa"></i>
							</label>
						</td>
						<td class="td-wide"><a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/edit-listing/?listing_id=<?php echo $_smarty_tpl->tpl_vars['listing']->value['id'];?>
"><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['listing']->value['Title'], ENT_QUOTES, 'UTF-8', true);?>
</a></td>
						<td class="td-wide">
							<a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/edit-user/?user_sid=<?php echo $_smarty_tpl->tpl_vars['listing']->value['user']['sid'];?>
">
								<?php if ($_smarty_tpl->tpl_vars['listing']->value['type']['id'] == 'Job' || $_smarty_tpl->tpl_vars['listing']->value['type']['id'] == 'Training') {?>
									<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['listing']->value['user']['CompanyName'], ENT_QUOTES, 'UTF-8', true);?>

																	<?php } else { ?>
									<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['listing']->value['user']['FullName'], ENT_QUOTES, 'UTF-8', true);?>

								<?php }?>
							</a>
						</td>
						<?php if ($_smarty_tpl->tpl_vars['listing']->value['type']['id'] == 'Job') {?>
							<td class="td-wide"><?php $_block_plugin27 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin27, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin27->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['listing']->value['product']['name'], ENT_QUOTES, 'UTF-8', true);
$_block_repeat=false;
echo $_block_plugin27->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></td>
						<?php }?>
						<td><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'date' ][ 0 ], array( $_smarty_tpl->tpl_vars['listing']->value['activation_date'],null,true ));?>
</td>
						<?php if ($_smarty_tpl->tpl_vars['listing']->value['type']['id'] == 'Job') {?>
							<td>
								<?php if ($_smarty_tpl->tpl_vars['listing']->value['applications'] || !$_smarty_tpl->tpl_vars['listing']->value['application_redirects']) {?>
									<span class="nowrap">
										<?php if ($_smarty_tpl->tpl_vars['listing']->value['applications']) {?>
											<a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/system/applications/view/?user_sid=<?php echo $_smarty_tpl->tpl_vars['listing']->value['user']['id'];?>
&amp;appJobId=<?php echo $_smarty_tpl->tpl_vars['listing']->value['id'];?>
">
												<?php echo $_smarty_tpl->tpl_vars['listing']->value['applications'];?>
 <?php $_block_plugin28 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin28, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin28->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>applications<?php $_block_repeat=false;
echo $_block_plugin28->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
											</a>
										<?php } else { ?>
											<?php echo $_smarty_tpl->tpl_vars['listing']->value['applications'];?>
 <?php $_block_plugin29 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin29, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin29->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>applications<?php $_block_repeat=false;
echo $_block_plugin29->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
										<?php }?>
									</span>
								<?php }?>
								<?php if ($_smarty_tpl->tpl_vars['listing']->value['application_redirects']) {?>
									<span class="nowrap"><?php if ($_smarty_tpl->tpl_vars['listing']->value['applications']) {?>/<?php }?> <?php echo $_smarty_tpl->tpl_vars['listing']->value['application_redirects'];?>
 <?php $_block_plugin30 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin30, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin30->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>apply clicks<?php $_block_repeat=false;
echo $_block_plugin30->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></span>
								<?php }?>
							</td>
						<?php }?>
						<td>
							<?php if ($_smarty_tpl->tpl_vars['listing']->value['views']) {?>
								<span class="nowrap"><?php echo $_smarty_tpl->tpl_vars['listing']->value['views'];?>
 Views</span>
														
							<?php } else { ?>
								<span class="nowrap">0 View</span>
							<?php }?>
						</td>
						<td>
							<?php if (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'status' ][ 0 ], array( $_smarty_tpl->tpl_vars['listing']->value['active'] )) == 'active') {?>
								<span class="label label--active"><?php $_block_plugin31 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin31, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin31->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Active<?php $_block_repeat=false;
echo $_block_plugin31->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></span>
							<?php } elseif (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'status' ][ 0 ], array( $_smarty_tpl->tpl_vars['listing']->value['active'] )) == 'pending') {?>
								<span class="label label--pending"><?php $_block_plugin32 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin32, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin32->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Pending Approval<?php $_block_repeat=false;
echo $_block_plugin32->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></span>
							<?php } else { ?>
								<span class="label label--inactive"><?php $_block_plugin33 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin33, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin33->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Not Active<?php $_block_repeat=false;
echo $_block_plugin33->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></span>
							<?php }?>
						</td>
					</tr>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
				</tbody>
			</table>
		</div>
	</form>
	<div class="table__pagination table__pagination--footer">
		<?php $_smarty_tpl->_subTemplateRender("template__system/admin_admin:../pagination/pagination.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('layout'=>"footer"), 0, false);
?>
	</div>
</div>

<?php $_block_plugin34 = isset($_smarty_tpl->smarty->registered_plugins['block']['javascript'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['javascript'][0][0] : null;
if (!is_callable(array($_block_plugin34, '_tpl_javascript'))) {
throw new SmartyException('block tag \'javascript\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('javascript', array());
$_block_repeat=true;
echo $_block_plugin34->_tpl_javascript(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
	<?php echo '<script'; ?>
 type="text/javascript">
		$('.bulk-action').on('click', function() {
			var action = $(this).data('action');
			if (action == 'delete') {
				if (confirm('<?php echo $_smarty_tpl->tpl_vars['paginationInfo']->value['translatedText']['delete'];?>
')) {
					submitForm(action);
				}
			} else {
				submitForm(action);
			}
			return false;
		});

		function isPopUp(button, textChooseAction, textChooseItem, textToDelete) {
			if (isActionEmpty(button, textChooseAction, textChooseItem)) {
				var action = $("#selectedAction_" + button).val();
				switch (action) {
					case "delete":
						if (confirm(textToDelete)) {
							submitForm(action);
						}
						break;
					default:
						submitForm(action);
						break;
				}
			}
		}

	<?php echo '</script'; ?>
>
<?php $_block_repeat=false;
echo $_block_plugin34->_tpl_javascript(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
}
}
