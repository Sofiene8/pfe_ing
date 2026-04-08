<div>
	{if $ERROR eq 'NOT_LOGIN'}
		{module name="users" function="login"}
	{elseif $ERROR eq 'ACCESS_DENIED' || $ERROR eq 'NOT_OWNER'}
		{if $permission}
			{module name="payment" function="user_products" permission=$permission}
		{else}
			<p class="alert alert-danger">[[You don't have permissions to access this page.]]</p>
		{/if}
	{/if}
</div>