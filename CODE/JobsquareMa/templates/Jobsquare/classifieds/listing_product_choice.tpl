{title}[[Post a {$listingTypeID}]]{/title}
<h1 class="title__primary title__primary-small title__centered title__bordered"> [[Select Product]]</h1>
<form id="listing-product-choice-form" method="post" action="">
	{foreach from=$products_info item="product" name="products" key="contract_id" }
		<p>
			<input type="radio" value="{$product.contract_id}" name="contract_id" id="product-{$contract_id}" />
			<label for="product-{$contract_id}"><span class="strong">[[{$product.product_name|escape}]]</span></label>
			      {if !$product.product_info.recurring}
							{if $product.expired_date}<br><span>[[Expire le ]]: {$product.expired_date|date}</span>{/if}
						{/if}			
						
			
		</p>
	{/foreach}
	<input type="hidden" name="listing_id" value="{$listing_id}" />
		<input type="hidden" name="clisting_id" value="{$clistingId}" />
	<input type="hidden" name="listing_type_id" value="{$listingTypeID|escape}" />
	<div id="listing-product-choice-message"></div>
	<div class="form-group form-group__btns">
		<input type="submit" value="[[Next]]" class="btn btn__orange btn__bold" />
	</div>
</form>
