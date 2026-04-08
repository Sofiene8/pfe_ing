{if $ajaxRelocate}
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

<form class="form form__modal" action="{$GLOBALS.site_url}/login/" method="post" id="login-form" {if $ajaxRelocate} onsubmit="return loginSubmit()" {/if} novalidate>
	<input type="hidden" name="return_url" value="{$return_url}" />
	<input type="hidden" name="action" value="login" />
	{if $proceedToPosting}<input type="hidden" name="proceed_to_posting" value="{$proceedToPosting}" />{/if}
	{if $productSID}<input type="hidden" name="productSID" value="{$productSID}" />{/if}
	{if $listingTypeID}<input type="hidden" name="listing_type_id" value="{$listingTypeID|escape}" />{/if}
	{if $ajaxRelocate}<input type="hidden" name="ajaxRelocate" value="1" />{/if}
	<h1 class="title__primary title__primary-small title__centered title__bordered">[[Sign in]]</h1>
	{module name="social" function="social_plugins"}
	<div class="form-group">
		<input type="email" name="username" class="form-control" placeholder="[[Email]]"/>
	</div>
	<div class="form-group">
		<input type="password" name="password" class="form-control" placeholder="[[Password]]"/>
	</div>
	<div class="form-group text-center">
		<input type="checkbox" name="keep" id="keep"/>
		<label for="keep" class="form-label checkbox-label"> [[Keep me signed in]]</label>
	</div>
	<div class="form-group form-group__btns text-center">
		<input type="submit" value="[[Sign in]]" class="btn btn__orange btn__bold" />
	</div>
	<div class="form-group login-help text-center">
		<a class="link" href="{$GLOBALS.site_url}/password-recovery/">[[Forgot Your Password?]]</a>
		<div>
			<a class="link" href="{$GLOBALS.site_url}/registration/?user_group_id=Employer{if $return_url && !$skip_registration_return}&return_url={$return_url|escape:'url'}{/if}">[[Employer Registration]]</a>&nbsp;|&nbsp;
			<a class="link" href="{$GLOBALS.site_url}/registration/?user_group_id=JobSeeker{if $return_url && !$skip_registration_return}&return_url={$return_url|escape:'url'}{/if}">[[Job Seeker Registration]]</a>
		</div>
	</div>
</form>
