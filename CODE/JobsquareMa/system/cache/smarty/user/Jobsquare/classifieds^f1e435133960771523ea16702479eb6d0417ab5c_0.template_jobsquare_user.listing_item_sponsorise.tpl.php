<?php
/* Smarty version 4.3.0, created on 2026-03-04 11:56:47
  from 'template_jobsquare_user:listing_item_sponsorise.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a81dff52b032_87213937',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f1e435133960771523ea16702479eb6d0417ab5c' => 
    array (
      0 => 'template_jobsquare_user:listing_item_sponsorise.tpl',
      1 => 1772573830,
      2 => 'template_jobsquare_user',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69a81dff52b032_87213937 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\JobsquareMa\\system\\ext\\Smarty\\libs\\plugins\\modifier.truncate.php','function'=>'smarty_modifier_truncate',),1=>array('file'=>'C:\\xampp\\htdocs\\JobsquareMa\\system\\ext\\Smarty\\libs\\plugins\\modifier.explode.php','function'=>'smarty_modifier_explode',),2=>array('file'=>'C:\\xampp\\htdocs\\JobsquareMa\\system\\ext\\Smarty\\libs\\plugins\\modifier.count.php','function'=>'smarty_modifier_count',),3=>array('file'=>'C:\\xampp\\htdocs\\JobsquareMa\\system\\ext\\Smarty\\libs\\plugins\\modifier.timeAgo.php','function'=>'smarty_modifier_timeAgo',),));
?>
<article id="<?php echo $_smarty_tpl->tpl_vars['listing']->value['id'];?>
" class=" col-md-6 joblist <?php if ($_smarty_tpl->tpl_vars['listing']->value['featured']) {?>listing-item__featured<?php }?> <?php if (!$_smarty_tpl->tpl_vars['listing']->value['user']['Logo']['file_url']) {?>listing-item__no-logo<?php }?>">
	<div class="">
		<div class="job-details col-xs-8">
			<div class="job-title"> <a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'listing_url' ][ 0 ], array( $_smarty_tpl->tpl_vars['listing']->value ));?>
?backPage=<?php echo $_smarty_tpl->tpl_vars['pageForBackButton']->value;?>
&searchID=<?php echo $_smarty_tpl->tpl_vars['searchId']->value;?>
" ><?php echo smarty_modifier_truncate(htmlspecialchars((string)$_smarty_tpl->tpl_vars['listing']->value['Title'], ENT_QUOTES, 'UTF-8', true),80);?>
</a> </div>
			<div class="company-name"> 
		<span class="name-c"><?php echo smarty_modifier_truncate(htmlspecialchars((string)$_smarty_tpl->tpl_vars['listing']->value['user']['CompanyName'], ENT_QUOTES, 'UTF-8', true),25);?>
</span>
			<?php if (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'location' ][ 0 ], array( $_smarty_tpl->tpl_vars['listing']->value ))) {?>
		<?php $_smarty_tpl->_assignInScope('location', call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'location' ][ 0 ], array( $_smarty_tpl->tpl_vars['listing']->value )));?>
		<?php $_smarty_tpl->_assignInScope('parts', smarty_modifier_explode(",",$_smarty_tpl->tpl_vars['location']->value));?>
		<?php $_smarty_tpl->_assignInScope('total', smarty_modifier_count($_smarty_tpl->tpl_vars['parts']->value));?>

			<span class="job-location">-<?php if ($_smarty_tpl->tpl_vars['parts']->value[$_smarty_tpl->tpl_vars['total']->value-2]) {
echo $_smarty_tpl->tpl_vars['parts']->value[$_smarty_tpl->tpl_vars['total']->value-2];?>
,<?php }
if ($_smarty_tpl->tpl_vars['parts']->value[$_smarty_tpl->tpl_vars['total']->value-1]) {
echo $_smarty_tpl->tpl_vars['parts']->value[$_smarty_tpl->tpl_vars['total']->value-1];
}?> </span>
			<?php }?>
				<?php $_smarty_tpl->_assignInScope('myDate', $_smarty_tpl->tpl_vars['listing']->value['activation_date']);?>
			<div class="post-date"> <?php if (smarty_modifier_timeAgo($_smarty_tpl->tpl_vars['myDate']->value) == "à l\'instant") {
} else { ?>Il'y a <?php }
echo smarty_modifier_timeAgo($_smarty_tpl->tpl_vars['myDate']->value);?>
</div>
			</div>
		</div>
		<?php if ($_smarty_tpl->tpl_vars['listing']->value['user']['Logo']['file_url'] && ($_smarty_tpl->tpl_vars['listing']->value['user']['featured'] == 1 || $_smarty_tpl->tpl_vars['listing']->value['featured'] == 1)) {?>
		<div class="company-logo col-xs-4"> <a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'listing_url' ][ 0 ], array( $_smarty_tpl->tpl_vars['listing']->value ));?>
?backPage=<?php echo $_smarty_tpl->tpl_vars['pageForBackButton']->value;?>
&searchID=<?php echo $_smarty_tpl->tpl_vars['searchId']->value;?>
"> <img class="img-responsive" src="<?php echo $_smarty_tpl->tpl_vars['listing']->value['user']['Logo']['file_url'];?>
" alt="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['listing']->value['user']['CompanyName'], ENT_QUOTES, 'UTF-8', true);?>
"> </a> </div>
		<?php }?> </div>
</article>
<?php }
}
