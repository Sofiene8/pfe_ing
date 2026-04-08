{title} [[Invoice]] #{$invoice_sid}{/title}
{keywords} [[Invoice]] {/keywords}
{description} [[Invoice]] {/description}
<div class="container">
	<br>
	<div class="col-lg-8 col-lg-offset-2">
		{display property="status" assign=status}
		{display property="payment_method" assign=payment_method}
		<div>
			<img class="invoice__logo" src="{$GLOBALS.user_site_url}/templates/{$GLOBALS.settings.TEMPLATE_USER_THEME}/assets/images/{$theme_settings.logo|escape:'url'}" border="0" />
		</div>
		<div class="pull-right">
			<strong>[[Invoice]] &#35;:&nbsp;{$invoice_sid}</strong><br/>
			{display property="date"}<br/>
		</div>
		<div class="clearfix"></div>
		<div class="col-xs-6">
			<hr>
			<strong>[[Bill To]]</strong>
			<p>
				{if $user.CompanyName}
					<p>{$user.CompanyName}</p>
					<p>{$user.FullName}</p>
					<p>{$user|location}</p>
					<p>{$user.Phone}</p>
				{else}
					{$user.username}
				{/if}
			</p>
		</div>
		<div class="col-xs-6">
			<hr>
			<strong>[[Send Payment To]]</strong>
			<p>{$GLOBALS.settings.send_payment_to|escape}</p>
		</div>
		<div class="clearfix"></div>
		<br>
		<table id="invoice-table" class="table table-bordered col-sm-6 col-xs-12">
			<tbody>
			<tr class="invoice-table-head">
				<th width="80%">[[Description]]</th>
				<th width="20%" class="text-right">[[Amount]]</th>
			</tr>
			{display property="items" template="items_complex.tpl"}
			</tbody>
		</table>
		{if $gateway && $gateway.payment_instructions}
			<p>
				{$gateway.payment_instructions}
			</p>
		{/if}
	</div>
</div>
