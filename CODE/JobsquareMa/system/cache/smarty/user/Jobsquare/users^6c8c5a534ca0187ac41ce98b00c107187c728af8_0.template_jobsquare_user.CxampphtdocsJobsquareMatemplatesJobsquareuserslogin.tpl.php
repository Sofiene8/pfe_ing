<?php
/* Smarty version 4.3.0, created on 2026-02-28 23:48:18
  from 'template_jobsquare_user:CxampphtdocsJobsquareMatemplatesJobsquareuserslogin.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a37ec29c2986_78127492',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6c8c5a534ca0187ac41ce98b00c107187c728af8' => 
    array (
      0 => 'template_jobsquare_user:CxampphtdocsJobsquareMatemplatesJobsquareuserslogin.tpl',
      1 => 1771678926,
      2 => 'template_jobsquare_user',
    ),
  ),
  'includes' => 
  array (
    'template_jobsquare_user:../users/errors.tpl' => 1,
  ),
),false)) {
function content_69a37ec29c2986_78127492 (Smarty_Internal_Template $_smarty_tpl) {
?>

<style>
.tinyheader.head2.page-login .page-row-expanded {
  
    background: #ffffff;
}
.registration-page .content-card {
    background-color: #fff;
    border: 1px solid #ffffff;
    padding: 20px 25px;
    margin-top: 15px;
}
</style>

<div class="registration-page px"> <?php if ($_smarty_tpl->tpl_vars['ajaxRelocate']->value) {?> 
	<?php echo '<script'; ?>
 type="text/javascript">
		function loginSubmit() {
			var options = {
				target: "#apply-modal .modal-body",
				url:  $("#login-form").attr("action"),
				success: function(response) {
					if ($('<div />').append(response).find('.alert-danger').length == 0) {
						$('#apply-modal .modal-title').html($('#apply-modal .modal-title').data('title'));
						$.ajax(top.location.href, {
							success: function(data) {
								$('.nav.navbar-nav.navbar-right').replaceWith(
										$('<div />').append(data).find('.nav.navbar-nav.navbar-right')
								);
							},
							crossDomain: true
						});
					}
				}
			};
			$("#login-form").ajaxSubmit(options);
			return false;
		}

		$(document).ready(function() {
			var title = $('#apply-modal .modal-title');
			if (!title.data('title')) {
				title.data('title', title.html());
			}
			title.html($('.title__primary').html());
			$('.title__primary').remove();
		});
	<?php echo '</script'; ?>
> 
	<?php }?>
	
	<?php $_smarty_tpl->_subTemplateRender("template_jobsquare_user:../users/errors.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('errors'=>$_smarty_tpl->tpl_vars['errors']->value), 0, false);
?>
	<div class="container  content-card ">
		<div class="col-md-6">
			<div class="left-section-wrp loginpage" >
				<h1 class="col-md-12" ><?php $_block_plugin1 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin1, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin1->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Sign in<?php $_block_repeat=false;
echo $_block_plugin1->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></h1>
				<form class="form " action="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/login/" method="post" id="login-form" <?php if ($_smarty_tpl->tpl_vars['ajaxRelocate']->value) {?> onsubmit="return loginSubmit()" <?php }?> novalidate>
					<input type="hidden" name="return_url" value="<?php echo $_smarty_tpl->tpl_vars['return_url']->value;?>
" />
					<input type="hidden" name="action" value="login" />
					<?php if ($_smarty_tpl->tpl_vars['proceedToPosting']->value) {?>
					<input type="hidden" name="proceed_to_posting" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['proceedToPosting']->value, ENT_QUOTES, 'UTF-8', true);?>
" />
					<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['productSID']->value) {?>
					<input type="hidden" name="productSID" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['productSID']->value, ENT_QUOTES, 'UTF-8', true);?>
" />
					<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['listingTypeID']->value) {?>
					<input type="hidden" name="listing_type_id" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['listingTypeID']->value, ENT_QUOTES, 'UTF-8', true);?>
" />
					<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['ajaxRelocate']->value) {?>
					<input type="hidden" name="ajaxRelocate" value="1" />
					<?php }?>
					<div class="form-group">
						<label class="form-label">Email: </label>
						<input type="email" name="username" class="form-control" placeholder="<?php $_block_plugin2 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin2, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin2->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Email<?php $_block_repeat=false;
echo $_block_plugin2->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>"/>
					</div>
					<div class="form-group">
						<label class="form-label">Mot de passe: </label>
						<input type="password" name="password" class="form-control" placeholder="<?php $_block_plugin3 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin3, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin3->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Password<?php $_block_repeat=false;
echo $_block_plugin3->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>"/>
					</div>
					<table width="100%">
						<tr valign="middle"><!--<td>
		<div class="form-group text-left">
			<input type="checkbox" name="keep" id="keep"/>
			<label for="keep" class="form-label checkbox-label"> <?php $_block_plugin4 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin4, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin4->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Keep me signed in<?php $_block_repeat=false;
echo $_block_plugin4->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></label>
		</div></td>-->
							<td><div class="form-group form-group__btns" style="margin-bottom:0">
									<input type="submit" value="<?php $_block_plugin5 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin5, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin5->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Sign in<?php $_block_repeat=false;
echo $_block_plugin5->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>" class="btn btn__orange btn__bold" id="bouton-con"/>
								</div></td>
							<td><span class="or-join">ou &nbsp;</span><a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/registration/">Rejoignez-nous</a></td>
							<td class="text-right"><div class="form-group form-group__btns" style="padding-top: 29px;"><a class="link small-link" href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/password-recovery/"><?php $_block_plugin6 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin6, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin6->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Forgot Your Password?<?php $_block_repeat=false;
echo $_block_plugin6->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a></div></td>
						</tr>
					</table>
				<!--	<div class="form-group login-help text-center">
						<div> <a class="link" href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/registration/?user_group_id=Employer<?php if ($_smarty_tpl->tpl_vars['return_url']->value && !$_smarty_tpl->tpl_vars['skip_registration_return']->value) {?>&return_url=<?php echo rawurlencode((string)$_smarty_tpl->tpl_vars['return_url']->value);
}?>"><?php $_block_plugin7 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin7, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin7->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Employer Registration<?php $_block_repeat=false;
echo $_block_plugin7->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a>&nbsp;|&nbsp; <a class="link" href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/registration/?user_group_id=JobSeeker<?php if ($_smarty_tpl->tpl_vars['return_url']->value && !$_smarty_tpl->tpl_vars['skip_registration_return']->value) {?>&return_url=<?php echo rawurlencode((string)$_smarty_tpl->tpl_vars['return_url']->value);
}?>"><?php $_block_plugin8 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin8, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin8->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Job Seeker Registration<?php $_block_repeat=false;
echo $_block_plugin8->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a> </div>
					</div>-->
				</form>
			</div>
		</div>
		<div class="col-md-6">
			<div class="connexion-social text-center " id="information" style="    padding-top: 50px;">
				<h3> <span class="glyphicon glyphicon-heart" aria-hidden="true"></span> Se connecter via les réseaux sociaux </h3>
			</div>
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['module'][0], array( array('name'=>"social",'function'=>"social_plugins"),$_smarty_tpl ) );?>
 </div>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
</div>
<?php }
}
