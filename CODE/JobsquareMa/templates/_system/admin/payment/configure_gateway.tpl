{breadcrumbs}<a href="{$GLOBALS.site_url}/system/payment/gateways/">[[Payment Methods]]</a> / {$gateway.caption|escape}{/breadcrumbs}
<div class="page-title">
	<h1 class="title">[[Configure]] {$gateway.caption|escape}</h1>
</div>
<p>
	{if $gateway}
		{if $gateway.active}
			[[This gateway is currently active. Click here to <a href="?action=deactivate&gateway=$gateway.id">deactivate </a>it.]]
		{else}
			[[This gateway is currently inactive. Click here to <a href="?action=activate&gateway=$gateway.id">activate </a>it.]]
		{/if}
	{/if}
</p>
{foreach from=$errors key=error item=error_data}
	{if $error == "NOT_IMPLEMENTED"}<p class="error">[[There is something not yet implemented in the system]]</p>{/if}
	{if $error == "API_LOGIN_ID_IS_NOT_SET"}<p class="error">[[API Login ID is not set]]</p>{/if}
	{if $error == "TRANSACTION_KEY_IS_NOT_SET"}<p class="error">[[Transaction Key is not set]]</p>{/if}
	{if $error == "MD5_HASH_IS_NOT_SET"}<p class="error">[[MD5-Hash is not set]]</p>{/if}
	{if $error == "PAYMENT_ID_IS_NOT_SET"}<p class="error">[[Payment ID is not set]]</p>{/if}
	{if $error == "NONEXISTED_PAYMENT_ID_SPECIFIED"}<p class="error">[[Specified payment ID does not exist]]</p>{/if}
	{if $error == "PAYMENT_IS_NOT_PENDING"}<p class="error">[[Payment status is not pending]]</p>{/if}
	{if $error == "EMAIL_IS_NOT_SET"}<p class="error">[[Email address is not set]]</p>{/if}
	{if $error == "NOT_VERIFIED"}<p class="error">[[Payment procedure is not verified]]</p>{/if}
	{if $error == "USER_NAME_IS_NOT_SET"}<p class="error">[[Please enter your first name]]</p>{/if}
	{if $error == "USER_PASSWORD_IS_NOT_SET"}<p class="error">[[User password is not set]]</p>{/if}
	{if $error == "USER_SIGNATURE_IS_NOT_SET"}<p class="error">[[User signature is not set]]</p>{/if}
	{if $error == 'SETTINGS_SAVED_WITH_PROBLEMS'}<p class="error">[[Gateway settings saved with problems, please try again]]</p>{/if}
	{if $error == 'SECRET_KEY_EMPTY'}<p class="error">[[Please enter Secret Key]]</p>{/if}
	{if $error == 'PUB_KEY_EMPTY'}<p class="error">[[Please enter Publishable Key]]</p>{/if}
	{if $error == 'API_USERNAME_EMPTY'}<p class="error">[[Please enter API Username]]</p>{/if}
	{if $error == 'API_PASSWORD_EMPTY'}<p class="error">[[Please enter API Password]]</p>{/if}
	{if $error == 'API_SIGNATURE_EMPTY'}<p class="error">[[Please enter API Signature]]</p>{/if}
{/foreach}
{module name='flash_messages' function='display'}
{if $gatewaySaved}<p class="message">[[Your changes were successfully saved]]<p>{/if}
{if $form_fields}
	<div class="panel panel-default panel--max">
		<form method="post" class="panel-body form-horizontal">
			{foreach from=$form_fields key=field_id item=field_info}
				<div class="form-group" {if $field_id == 'id'}style="display: none;"{/if}>
					<label class="col-md-2 control-label">[[{$field_info.caption}]]{if $field_info.is_required}&nbsp;<span class="required">*</span>{/if}</label>
					<div class="col-md-7">
						{if $field_id == "country"}{input property=$field_id template="list_empty.tpl"}{else}{input property=$field_id}{/if}
						{if $field_info.comment}{$field_info.comment}{/if}
					</div>
				</div>
			{/foreach}
			<div class="form-group">
				<div class="col-md-7 col-md-offset-2">
					<input type="hidden" name="gateway" value="{$gateway.id}" />
					<input type="hidden" id="submit" name="submit" value="apply_gateway"/>
					<input type="submit" value="[[Save]]" class="btn btn--primary"/>
				</div>
			</div>
		</form>
	</div>
{/if}

{if $gateway.id == "2checkout"}
	<div class="panel panel-default panel--max">
		<div class="panel-body">
			[[Log in to your Admin Vendor area in 2Checkout]]
			<br />
			<br />
			[[Go to Notification &#187; Settings section]]
			<br />
			<br />
			[[Enter the following URL to the Global URL field:]] {$GLOBALS.user_site_url}/system/payment/notifications/2checkout/
			<br />
			<br />
			[[Press the Apply button.]]
		</div>
	</div>
{/if}
{if $gateway.id == "authnet_sim"}
	<div class="panel panel-default panel--max">
		<div class="panel-body">
			<a target="_blank" href="https://reseller.authorize.net/application/?resellerId=29761">[[Sign up for Authorize .Net account here]]</a>
			<br/>
			<br/>
			[[Silent Post URL description:]]
			<br/>
			[[The Silent Post URL is a location on your Web server where the payment gateway can "carbon copy" the transaction response. This allows you to use transaction response information for other purposes separately without affecting the amount of time it takes to respond to the payment gateway with a custom receipt page from the Relay Response URL.]]
			<br/>
			<br/>
			[[To configure the Silent Post URL:]]<br />
			<strong>1)</strong> [[Log on to the Merchant Interface at]] <a href="https://account.authorize.net" target="_blank">https://account.authorize.net</a> <br />
			<strong>2)</strong> [[Click Settings under Account in the main menu on the left]]<br />
			<strong>3)</strong> [[Click Silent Post URL in the Transaction Format Settings section]]<br />
			<strong>4)</strong> [[Enter the secondary URL to which you would like the payment gateway to copy the transaction response]] {$GLOBALS.user_site_url}/system/payment/notifications/authnet_sim/<br />
			<strong>5)</strong> [[Click Submit]]<br />
			<strong>6)</strong> [[Go to Settings &#187; API Login ID and Transaction Key. There you will get the 'Current API Login ID' and the 'Current Transaction Key' (copy them).]]<br />
			<strong>7)</strong> [[Also go to Settings &#187; MD5-Hash. And enter any desired value for the MD5-Hash. (copy it).]]<br />
			<strong>8)</strong> [[Then you need to go to your SmartJobBoard Admin Panel &#187; Payments &#187; Authorize.Net SIM (edit) and specify there the API Login ID, Transaction Key and MD5-Hash.]]
		</div>
	</div>
{/if}
{if $gateway.id == "stripe"}
	<div class="panel panel-default panel--max">
		<div class="panel-body">
			[[Create your stripe account on]] <a href="https://stripe.com/" target="_blank">https://stripe.com/</a>
			<br/>
			<br/>
			[[Customers never leave your site]]
			<br/>
			<br/>
			[[2.9% + 30¢ per successful charge]]
			<br/>
			<br/>
			[[Your API key settings can be found on your]] <a href="https://dashboard.stripe.com/account/apikeys" target="_blank">[[Stripe account page.]]</a>
		</div>
	</div>
{/if}
{if $gateway.id == 'paypal_express'}
	<div class="panel panel-default panel--max">
		<div class="panel-body">
			<p>[[You can get you API credentials in your PayPal Account > Tools > Business Setup > Option A > Get your API Credentials > View API Signature.]]</p>
			<a class="btn btn--primary" target="_blank" href="https://developer.paypal.com/docs/classic/api/apiCredentials/">[[Learn More]]</a>
		</div>
	</div>
{/if}
{if $gateway.id == 'paypal_standard'}
	<div class="panel panel-default panel--max">
		<div class="panel-body">
			[[Please make sure you have "Payment Data Transfer" (PDT) setting turned off in your PayPal account.]]
		</div>
	</div>
{/if}
