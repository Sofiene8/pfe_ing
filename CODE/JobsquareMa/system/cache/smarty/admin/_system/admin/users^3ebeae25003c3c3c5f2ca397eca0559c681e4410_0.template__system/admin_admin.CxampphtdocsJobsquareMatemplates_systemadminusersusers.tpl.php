<?php
/* Smarty version 4.3.0, created on 2026-03-04 22:49:06
  from 'template__system/admin_admin:CxampphtdocsJobsquareMatemplates_systemadminusersusers.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a8b6e27d5757_64669981',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3ebeae25003c3c3c5f2ca397eca0559c681e4410' => 
    array (
      0 => 'template__system/admin_admin:CxampphtdocsJobsquareMatemplates_systemadminusersusers.tpl',
      1 => 1771678928,
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
function content_69a8b6e27d5757_64669981 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 language="JavaScript" type="text/javascript" src="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['common_js'][0], array( array(),$_smarty_tpl ) );?>
/pagination.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">
	var parentReload = false;

	function isPopUp(button, textChooseAction, textChooseItem, textToDelete) {
		if (isActionEmpty(button, textChooseAction, textChooseItem)) {
			var action = $("#selectedAction_" + button).val();
			switch (action) {
				case "delete":
					if (confirm(textToDelete)) {
						submitForm("delete");
					}
					break;
				default:
					submitForm(action);
					break;
			}
		}
		$("#selectedAction_" + button).val('');
	}

	function viewListingBlock() {
        $("#product_select option").each(function () {
        	$("#block_"+this.value).css('display', 'none');
          });
	
        $("#product_select option:selected").each(function () {
           $("#block_"+this.value).css('display', 'block');
         });
	}
	<?php echo '</script'; ?>
>

<?php if ($_smarty_tpl->tpl_vars['errors']->value) {?>
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['errors']->value, 'error');
$_smarty_tpl->tpl_vars['error']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['error']->value) {
$_smarty_tpl->tpl_vars['error']->do_else = false;
?>
		<p class="error"><?php $_block_plugin14 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin14, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array('metadata'=>$_smarty_tpl->tpl_vars['METADATA']->value['error']));
$_block_repeat=true;
echo $_block_plugin14->translate(array('metadata'=>$_smarty_tpl->tpl_vars['METADATA']->value['error']), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['error']->value;
$_block_repeat=false;
echo $_block_plugin14->translate(array('metadata'=>$_smarty_tpl->tpl_vars['METADATA']->value['error']), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></p>
	<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}?>
<div class="panel panel-default panel--max clearfix">
	<div class="table__pagination table__pagination--header">
		<?php $_smarty_tpl->_subTemplateRender("template__system/admin_admin:../pagination/pagination_top.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('layout'=>"header"), 0, false);
?>
	</div>
	<form method="post" name="users_form" class="clearfix">
		<input type="hidden" name="action_name" id="action_name" value="" />
				<input type="hidden" name="number_of_listings" id="number_of_listings" value="" />
		<div class="table-responsive">
			<table width="100%" class="table table-striped with-bulk">
				<thead>
					<?php $_smarty_tpl->_subTemplateRender("template__system/admin_admin:../pagination/sort.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
				</thead>
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['found_users']->value, 'user', false, NULL, 'users_block', array (
  'iteration' => true,
));
$_smarty_tpl->tpl_vars['user']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['user']->value) {
$_smarty_tpl->tpl_vars['user']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_users_block']->value['iteration']++;
?>
					<tr>
						<td class="text-center">
							<label class="cr-styled">
								<input type="checkbox" name="users[<?php echo $_smarty_tpl->tpl_vars['user']->value['sid'];?>
]" value="1" id="checkbox_<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_users_block']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_users_block']->value['iteration'] : null);?>
" />
								<i class="fa"></i>
							</label>
						</td>
						<?php if ($_smarty_tpl->tpl_vars['userGroupInfo']->value['id'] == 'Employer') {?>
							<td class="td-wide"><a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/edit-user/?user_sid=<?php echo $_smarty_tpl->tpl_vars['user']->value['sid'];?>
" title="Edit"><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['user']->value['CompanyName'], ENT_QUOTES, 'UTF-8', true);?>
</a></td>
							<td class="td-wide"><a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/edit-user/?user_sid=<?php echo $_smarty_tpl->tpl_vars['user']->value['sid'];?>
" title="Edit"><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['user']->value['username'], ENT_QUOTES, 'UTF-8', true);?>
</a></td>
							<td class="td-wide">
								<?php echo htmlspecialchars((string)call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'location' ][ 0 ], array( $_smarty_tpl->tpl_vars['user']->value )), ENT_QUOTES, 'UTF-8', true);?>

							</td>
						<?php } elseif ($_smarty_tpl->tpl_vars['userGroupInfo']->value['id'] == 'JobSeeker') {?>
							<td class="td-wide"><a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/edit-user/?user_sid=<?php echo $_smarty_tpl->tpl_vars['user']->value['sid'];?>
" title="Edit"><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['user']->value['FullName'], ENT_QUOTES, 'UTF-8', true);?>
</a></td>
							<td class="td-wide"><a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/edit-user/?user_sid=<?php echo $_smarty_tpl->tpl_vars['user']->value['sid'];?>
" title="Edit"><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['user']->value['username'], ENT_QUOTES, 'UTF-8', true);?>
</a></td>
						<?php }?>

						<td><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'date' ][ 0 ], array( $_smarty_tpl->tpl_vars['user']->value['registration_date'],null,true ));?>
</td>
						<td>
							<?php if (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'status' ][ 0 ], array( $_smarty_tpl->tpl_vars['user']->value['active'] )) == 'active') {?>
								<span class="label label--active"><?php $_block_plugin15 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin15, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin15->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Active<?php $_block_repeat=false;
echo $_block_plugin15->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></span>
							<?php } elseif (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'status' ][ 0 ], array( $_smarty_tpl->tpl_vars['user']->value['active'] )) == 'pending') {?>
								<span class="label label--pending"><?php $_block_plugin16 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin16, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin16->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Pending Approval<?php $_block_repeat=false;
echo $_block_plugin16->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></span>
							<?php } else { ?>
								<span class="label label--inactive"><?php $_block_plugin17 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin17, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin17->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Not Active<?php $_block_repeat=false;
echo $_block_plugin17->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></span>
							<?php }?>
						</td>
					</tr>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			</table>
		</div>
	</form>
	<div class="table__pagination table__pagination--footer">
		<?php $_smarty_tpl->_subTemplateRender("template__system/admin_admin:../pagination/pagination.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('layout'=>"footer"), 0, false);
?>
	</div>
</div>

<?php $_block_plugin18 = isset($_smarty_tpl->smarty->registered_plugins['block']['javascript'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['javascript'][0][0] : null;
if (!is_callable(array($_block_plugin18, '_tpl_javascript'))) {
throw new SmartyException('block tag \'javascript\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('javascript', array());
$_block_repeat=true;
echo $_block_plugin18->_tpl_javascript(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
	<?php echo '<script'; ?>
>
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
	<?php echo '</script'; ?>
>
<?php $_block_repeat=false;
echo $_block_plugin18->_tpl_javascript(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
}
}
