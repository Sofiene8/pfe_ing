
{literal}
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
{/literal}
<div class="registration-page px"> {if $ajaxRelocate} 
	<script type="text/javascript">
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
	</script> 
	{/if}
	
	{include file="../users/errors.tpl" errors=$errors}
	<div class="container  content-card ">
		<div class="col-md-6">
			<div class="left-section-wrp loginpage" >
				<h1 class="col-md-12" >[[Sign in]]</h1>
				<form class="form " action="{$GLOBALS.site_url}/login/" method="post" id="login-form" {if $ajaxRelocate} onsubmit="return loginSubmit()" {/if} novalidate>
					<input type="hidden" name="return_url" value="{$return_url}" />
					<input type="hidden" name="action" value="login" />
					{if $proceedToPosting}
					<input type="hidden" name="proceed_to_posting" value="{$proceedToPosting|escape}" />
					{/if}
					{if $productSID}
					<input type="hidden" name="productSID" value="{$productSID|escape}" />
					{/if}
					{if $listingTypeID}
					<input type="hidden" name="listing_type_id" value="{$listingTypeID|escape}" />
					{/if}
					{if $ajaxRelocate}
					<input type="hidden" name="ajaxRelocate" value="1" />
					{/if}
					<div class="form-group">
						<label class="form-label">Email: </label>
						<input type="email" name="username" class="form-control" placeholder="[[Email]]"/>
					</div>
					<div class="form-group">
						<label class="form-label">Mot de passe: </label>
						<input type="password" name="password" class="form-control" placeholder="[[Password]]"/>
					</div>
					<table width="100%">
						<tr valign="middle"><!--<td>
		<div class="form-group text-left">
			<input type="checkbox" name="keep" id="keep"/>
			<label for="keep" class="form-label checkbox-label"> [[Keep me signed in]]</label>
		</div></td>-->
							<td><div class="form-group form-group__btns" style="margin-bottom:0">
									<input type="submit" value="[[Sign in]]" class="btn btn__orange btn__bold" id="bouton-con"/>
								</div></td>
							<td><span class="or-join">ou &nbsp;</span><a href="{$GLOBALS.site_url}/registration/">Rejoignez-nous</a></td>
							<td class="text-right"><div class="form-group form-group__btns" style="padding-top: 29px;"><a class="link small-link" href="{$GLOBALS.site_url}/password-recovery/">[[Forgot Your Password?]]</a></div></td>
						</tr>
					</table>
				<!--	<div class="form-group login-help text-center">
						<div> <a class="link" href="{$GLOBALS.site_url}/registration/?user_group_id=Employer{if $return_url && !$skip_registration_return}&return_url={$return_url|escape:'url'}{/if}">[[Employer Registration]]</a>&nbsp;|&nbsp; <a class="link" href="{$GLOBALS.site_url}/registration/?user_group_id=JobSeeker{if $return_url && !$skip_registration_return}&return_url={$return_url|escape:'url'}{/if}">[[Job Seeker Registration]]</a> </div>
					</div>-->
				</form>
			</div>
		</div>
		<div class="col-md-6">
			<div class="connexion-social text-center " id="information" style="    padding-top: 50px;">
				<h3> <span class="glyphicon glyphicon-heart" aria-hidden="true"></span> Se connecter via les réseaux sociaux </h3>
			</div>
			{module name="social" function="social_plugins"} </div>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
</div>
