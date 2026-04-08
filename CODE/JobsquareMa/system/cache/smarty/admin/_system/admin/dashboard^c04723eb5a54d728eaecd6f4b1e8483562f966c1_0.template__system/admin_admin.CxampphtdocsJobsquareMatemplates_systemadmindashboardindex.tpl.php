<?php
/* Smarty version 4.3.0, created on 2026-03-04 08:22:46
  from 'template__system/admin_admin:CxampphtdocsJobsquareMatemplates_systemadmindashboardindex.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a7ebd6518750_48214717',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c04723eb5a54d728eaecd6f4b1e8483562f966c1' => 
    array (
      0 => 'template__system/admin_admin:CxampphtdocsJobsquareMatemplates_systemadmindashboardindex.tpl',
      1 => 1771678927,
      2 => 'template__system/admin_admin',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69a7ebd6518750_48214717 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="page-title">
	<h1 class="title"><?php $_block_plugin1 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin1, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin1->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Dashboard<?php $_block_repeat=false;
echo $_block_plugin1->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></h1>
	<div class="stats page-title__buttons">
		<div class="btn-group">
			<button type="button" class="btn btn-default choose-period active" data-target="#today">
				<?php $_block_plugin2 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin2, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin2->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Today<?php $_block_repeat=false;
echo $_block_plugin2->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
			</button>
			<button type="button" class="btn btn-default choose-period" data-target="#this-week" href="#">
				<?php $_block_plugin3 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin3, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin3->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Last 7 days<?php $_block_repeat=false;
echo $_block_plugin3->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
			</button>
			<button type="button" class="btn btn-default choose-period" data-target="#this-month" href="#">
				<?php $_block_plugin4 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin4, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin4->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Last 30 days<?php $_block_repeat=false;
echo $_block_plugin4->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
			</button>
			<button type="button" class="btn btn-default choose-period" data-target="#total" href="#">
				<?php $_block_plugin5 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin5, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin5->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Total<?php $_block_repeat=false;
echo $_block_plugin5->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
			</button>
		</div>
	</div>
</div>

<div id="dashboard" class="dashboard">
	<div class="tab-contents" class="row">
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['applicationsInfo']->value, 'item', false, 'i');
$_smarty_tpl->tpl_vars['item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['i']->value => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->do_else = false;
?>
			<div id="<?php if ($_smarty_tpl->tpl_vars['i']->value == 'Today') {?>today<?php } elseif ($_smarty_tpl->tpl_vars['i']->value == 'Last 7 days') {?>this-week<?php } elseif ($_smarty_tpl->tpl_vars['i']->value == 'Last 30 days') {?>this-month<?php } elseif ($_smarty_tpl->tpl_vars['i']->value == 'Total') {?>total<?php }?>" class="tab-pane fade in <?php if ($_smarty_tpl->tpl_vars['i']->value == 'Today') {?>active<?php }?>">
				<div class="row">
				<?php ob_start();
echo $_SESSION['admin']['sid'];
$_prefixVariable1 = ob_get_clean();
if ($_prefixVariable1 == 1) {?>
					<div class="col-xs-12 col-sm-12 col-md-4">
						<div class="widget-panel widget-style-2 white-bg">
							<i class="fa fa-usd" aria-hidden="true"></i>
							<h2 class="m-0 counter">
								<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', "paymentAmount", null);
$_block_plugin6 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin6, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array('type'=>"float"));
$_block_repeat=true;
echo $_block_plugin6->translate(array('type'=>"float"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['invoicesInfo']->value[$_smarty_tpl->tpl_vars['i']->value];
$_block_repeat=false;
echo $_block_plugin6->translate(array('type'=>"float"), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
								<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['currencyFormat'][0], array( array('amount'=>$_smarty_tpl->tpl_vars['paymentAmount']->value),$_smarty_tpl ) );?>

							</h2>
							<div><?php $_block_plugin7 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin7, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin7->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Sales<?php $_block_repeat=false;
echo $_block_plugin7->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></div>
						</div>
					</div>
					
						<?php } else { ?>
					<div class="col-xs-12 col-sm-12 col-md-4">
						<div class="widget-panel widget-style-2 white-bg">
							<i class="fa fa-usd" aria-hidden="true"></i>
							<h2 class="m-0 counter">
								0,00 DT
							</h2>
							<div><?php $_block_plugin8 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin8, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin8->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Sales<?php $_block_repeat=false;
echo $_block_plugin8->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></div>
						</div>
					</div>
					
						<?php }?>	
					
					
					
					<div class="col-xs-12 col-sm-12 col-md-4">
						<div class="widget-panel widget-style-2 white-bg">
							<i class="fa fa-briefcase" aria-hidden="true"></i>
							<h2 class="m-0 counter">
								<?php echo $_smarty_tpl->tpl_vars['listingsInfo']->value['Job']['periods'][$_smarty_tpl->tpl_vars['i']->value];?>

							</h2>
							<div><?php $_block_plugin9 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin9, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin9->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Jobs Posted<?php $_block_repeat=false;
echo $_block_plugin9->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4">
						<div class="widget-panel widget-style-2 white-bg">
							<div class="icon-img">
								<img src="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['image'][0], array( array(),$_smarty_tpl ) );?>
employers-icon.svg" border="0" alt=""/>
							</div>
							<h2 class="m-0 counter">
								<?php echo $_smarty_tpl->tpl_vars['groupsInfo']->value['Employer'][$_smarty_tpl->tpl_vars['i']->value];?>

							</h2>
							<div><?php $_block_plugin10 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin10, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin10->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Employer Profiles Created<?php $_block_repeat=false;
echo $_block_plugin10->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-4">
						<div class="widget-panel widget-style-2 white-bg">
							<i class="fa fa-user" aria-hidden="true"></i>
							<h2 class="m-0 counter">
								<?php $_block_plugin11 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin11, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin11->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['groupsInfo']->value['Job Seeker'][$_smarty_tpl->tpl_vars['i']->value];
$_block_repeat=false;
echo $_block_plugin11->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
							</h2>
							<div><?php $_block_plugin12 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin12, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin12->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Job Seeker Profiles Created<?php $_block_repeat=false;
echo $_block_plugin12->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4">
						<div class="widget-panel widget-style-2 white-bg">
							<i class="fa fa-paper-plane-o" aria-hidden="true"></i>
							<h2 class="m-0 counter">
								<?php echo $_smarty_tpl->tpl_vars['applicationsInfo']->value[$_smarty_tpl->tpl_vars['i']->value];?>

							</h2>
							<div><?php $_block_plugin13 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin13, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin13->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Applications Sent<?php $_block_repeat=false;
echo $_block_plugin13->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4">
						<div class="widget-panel widget-style-2 white-bg">
							<i class="ion-ios7-email"></i>
							<h2 class="m-0 counter">
								<?php echo $_smarty_tpl->tpl_vars['jobAlertsInfo']->value[$_smarty_tpl->tpl_vars['i']->value];?>

							</h2>
							<div><?php $_block_plugin14 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin14, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin14->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Job Alerts Created<?php $_block_repeat=false;
echo $_block_plugin14->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></div>
						</div>
					</div>
				</div>
			</div>
		<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	</div>
</div>
<?php $_block_plugin15 = isset($_smarty_tpl->smarty->registered_plugins['block']['javascript'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['javascript'][0][0] : null;
if (!is_callable(array($_block_plugin15, '_tpl_javascript'))) {
throw new SmartyException('block tag \'javascript\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('javascript', array());
$_block_repeat=true;
echo $_block_plugin15->_tpl_javascript(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
	<?php echo '<script'; ?>
 type="text/javascript">
		$(document).ready(function() {
			$('.choose-period').click(function(e) {
				e.preventDefault();
				$('.choose-period.active').removeClass('active');

				var target = $(this).data('target');
				$('.tab-pane.active').removeClass('active');
				$(this).addClass('active');
				$(target).addClass('active');
			});
		});
	<?php echo '</script'; ?>
>
<?php $_block_repeat=false;
echo $_block_plugin15->_tpl_javascript(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
}
}
