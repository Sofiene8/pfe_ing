<?php
/* Smarty version 4.3.0, created on 2026-02-27 11:09:14
  from 'template_jobsquare_user:CxampphtdocsJobsquareMatemplatesJobsquareclassifiedssearch_result_company.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a17b5ae6fea0_74124382',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e90959260dddbdb185bb07cffa30776dcb6b3f5a' => 
    array (
      0 => 'template_jobsquare_user:CxampphtdocsJobsquareMatemplatesJobsquareclassifiedssearch_result_company.tpl',
      1 => 1771678925,
      2 => 'template_jobsquare_user',
    ),
  ),
  'includes' => 
  array (
    'template_jobsquare_user:error.tpl' => 1,
  ),
),false)) {
function content_69a17b5ae6fea0_74124382 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="page-detail-annonce">
	
<div class="container <?php if (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'banner' ][ 0 ], array( 'banner_right_side' ))) {?>with-banner__companies<?php }?> page-detail-annonce">
	<div class="row details-body details-body__search">
		<?php if ($_smarty_tpl->tpl_vars['ERRORS']->value) {?>
			<?php $_smarty_tpl->_subTemplateRender("template_jobsquare_user:error.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
		<?php } else { ?>
			<div class="search-results__top search-results__top-company clearfix">
				<h1 class="title__primary title__primary-small title__centered">
				<!-- $companies_number --> Recrutement Maroc: Les <?php $_block_plugin9 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin9, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin9->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Companies<?php $_block_repeat=false;
echo $_block_plugin9->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?> 
				</h1>
			</div>
			<div class="search-results search-results__companies featured-companies text-center clearfix">
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['found_users_sids']->value, 'user_sid', false, NULL, 'users_block', array (
));
$_smarty_tpl->tpl_vars['user_sid']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['user_sid']->value) {
$_smarty_tpl->tpl_vars['user_sid']->do_else = false;
?>
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['display'][0], array( array('property'=>'State.Code','object_sid'=>$_smarty_tpl->tpl_vars['user_sid']->value,'parent'=>'Location','assign'=>'State'),$_smarty_tpl ) );?>

					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['display'][0], array( array('property'=>'City','object_sid'=>$_smarty_tpl->tpl_vars['user_sid']->value,'parent'=>'Location','assign'=>'City'),$_smarty_tpl ) );?>

					<div class="featured-company" aria-hidden="false">
						<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['display'][0], array( array('property'=>'CompanyName','object_sid'=>$_smarty_tpl->tpl_vars['user_sid']->value,'assign'=>'CompanyName'),$_smarty_tpl ) );?>

						<a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/company/<?php echo $_smarty_tpl->tpl_vars['user_sid']->value;?>
/<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'pretty_url' ][ 0 ], array( htmlspecialchars_decode($_smarty_tpl->tpl_vars['CompanyName']->value, ENT_QUOTES) ));?>
/" title="<?php echo $_smarty_tpl->tpl_vars['CompanyName']->value;?>
">
							<div class="panel panel-default featured-company__panel">
								<div class="panel-body featured-company__panel-body text-center">
									<?php ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['display'][0], array( array('property'=>'Logo','object_sid'=>$_smarty_tpl->tpl_vars['user_sid']->value),$_smarty_tpl ) );
$_prefixVariable1 = ob_get_clean();
if ($_prefixVariable1) {?>
										<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['display'][0], array( array('property'=>'Logo','object_sid'=>$_smarty_tpl->tpl_vars['user_sid']->value),$_smarty_tpl ) );?>

									<?php } else { ?>
										<div class="company__no-image"></div>
									<?php }?>
								</div>
								<div class="panel-footer featured-company__panel-footer">
									<div class="featured-companies__name">
										<span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['display'][0], array( array('property'=>'CompanyName','object_sid'=>$_smarty_tpl->tpl_vars['user_sid']->value),$_smarty_tpl ) );?>
</span>
									</div>
									<div class="featured-companies__jobs">
										<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['display'][0], array( array('property'=>'countListings','object_sid'=>$_smarty_tpl->tpl_vars['user_sid']->value,'assign'=>"jobs_number"),$_smarty_tpl ) );?>

										<?php $_block_plugin10 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin10, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin10->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>$jobs_number job(s)<?php $_block_repeat=false;
echo $_block_plugin10->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
									</div>
								</div>
							</div>
						</a>
					</div>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			</div>
			<button type="button" class="load-more load-more__companies btn btn__white <?php ob_start();
echo $_smarty_tpl->tpl_vars['companies_per_page']->value;
$_prefixVariable2 = ob_get_clean();
if ($_smarty_tpl->tpl_vars['companies_number']->value > $_prefixVariable2) {?>show<?php } else { ?>hidden<?php }?>" data-page="2">
				<?php $_block_plugin11 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin11, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin11->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Load more<?php $_block_repeat=false;
echo $_block_plugin11->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
			</button>
		<?php }?>
	</div>
	<?php if (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'banner' ][ 0 ], array( 'banner_right_side' ))) {?>
		<div class="banner banner--right banner--companies">
			<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'banner' ][ 0 ], array( 'banner_right_side' ));?>

		</div>
	<?php }?>
</div>
</div>
<?php $_block_plugin12 = isset($_smarty_tpl->smarty->registered_plugins['block']['javascript'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['javascript'][0][0] : null;
if (!is_callable(array($_block_plugin12, '_tpl_javascript'))) {
throw new SmartyException('block tag \'javascript\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('javascript', array());
$_block_repeat=true;
echo $_block_plugin12->_tpl_javascript(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
		<?php echo '<script'; ?>
>
		var listingPerPage = <?php echo $_smarty_tpl->tpl_vars['companies_per_page']->value;?>
;
		$('.load-more').click(function() {
			var self = $(this);
			self.addClass('loading');
			$.get('?searchId=<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['searchId']->value, ENT_QUOTES, 'UTF-8', true);?>
&action=search&page=' + self.data('page'), function(data) {
				self.removeClass('loading');
				var listings = $(data).find('.featured-company');
				if (listings.length) {
					$('.featured-company').last().after(listings);
					self.data('page', parseInt(self.data('page')) + 1);
				}
				if (listings.length !== listingPerPage) {
					self.removeClass('show').addClass('hidden');
				}
			});
		});
	<?php echo '</script'; ?>
>
<?php $_block_repeat=false;
echo $_block_plugin12->_tpl_javascript(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
}
}
