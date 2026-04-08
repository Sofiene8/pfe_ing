<div>
	{if $ERROR eq 'NOT_LOGIN'}
		{module name="users" function="login"}
	{elseif $ERROR eq 'ACCESS_DENIED' || $ERROR eq 'NOT_OWNER'}
		<p class="error">[[You don't have permissions to access this page.]]</p>
	{/if}
</div>