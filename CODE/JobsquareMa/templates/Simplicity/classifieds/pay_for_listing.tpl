{foreach from=$errors item=message key=error}
	{if $error eq 'INVALID_LISTING_ID'}
		<p class="alert alert-error">[[Invalid listing ID is specified]]</p>
	{elseif $error eq 'LISTING_ALREADY_ACTIVE'}
		<p class="alert alert-info">[[Listing is already active.]]</p>
	{elseif $error eq 'WRONG_LISTING_ID_SPECIFIED'}
		<p class="alert alert-error">[[Listing does not exist]]</p>
	{/if}
{/foreach}