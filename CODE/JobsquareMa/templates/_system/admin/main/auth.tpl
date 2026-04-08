<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
		"https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, height=device-height,
									   initial-scale=1.0, maximum-scale=1.0,
									   target-densityDpi=device-dpi">
		<title>Jobsquare.ma [[Admin Panel]]</title>
		<link rel="stylesheet" type="text/css" href="{$GLOBALS.user_site_url}/templates/_system/admin/assets/style/style.css?v={$GLOBALS.v}" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	</head>
	<body id="auth" {if $action == 'activate'}class="activate-admin"{elseif $action == 'password_recovery'}class="password-recover"{/if}>
		<div id="loginForm">
			<div class="panel panel-default panel__auth">
				<div class="panel-heading text-center">
					<img src="{image}logo.svg" border="0" alt="" /><br/>
				</div>

				{module name='flash_messages' function='display'}
				<div class="panel-body">
					<form method="post" action="">
						{$form_hidden_params}
						{foreach from=$errors item=error key=errorCode}
							{if $errorCode === "LOGIN_PASS_NOT_CORRECT"}
								<p class="error">[[The username or password you entered is incorrect]]</p>
							{/if}
						{/foreach}
						{if $action == 'login'}
							<div class="form-group">
								<label>[[Username]]</label>
								<input type="text" name="username" />
							</div>
							<div class="form-group">
								<label>[[Password]]</label>
								<input type="password" name="password" />
							</div>

							<input type="submit" value="[[Login]]" id="loginButton" class="btn btn--primary"/>
							<br/>
							<a class="forget-password" href="{$GLOBALS.admin_site_url}/?action=password_recovery">[[Forgot your password?]]</a>
						{elseif $action == 'activate'}
							{include file='../miscellaneous/admin_create.tpl'}
						{elseif $action == 'password_recovery'}
							<h3>[[Password Recovery]]</h3>
							<p>
								[[Please type your email address and we will send you a link to reset your password asap!]]
							</p>
							{include file='../users/field_errors.tpl'}
							<div class="form-group">
								<label>[[Email]]</label>
								<input type="text" name="email" value="{$email|escape}" />
							</div>
							<input type="submit" value="[[Reset My Password]]" class="btn btn--primary"/>
							<br>
							<br>
							<p>
								<a href="{$GLOBALS.admin_site_url}/">[[< Back to login]]</a>
							</p>
						{elseif $action == 'password_recover'}
							{include file='../miscellaneous/admin_recover.tpl'}
						{/if}
					</form>
				</div>
			</div>
		</div>

		<div id="copyright" {if isset($error)}class="page-error"{/if}>
			<div>Jobsquare.ma [[version]] 8</div>
			[[Copyright]]  {$smarty.now|date_format:"%Y"} &copy; Jobsquare.ma [[All rights reserved]]
		</div>
	</body>
	<script type="text/javascript">
		$(document).ready(function() {
			$('input[name=username]').focus().select();
		});
	</script>
</html>
