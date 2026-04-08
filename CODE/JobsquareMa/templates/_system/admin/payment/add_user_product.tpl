<script type="text/javascript">
	function formSubmit() {
		var options = {
		  target: "#user-product .modal-body",
		  url:  $("#addProductForm").attr("action")
		};

		$("#addProductForm").ajaxSubmit(options);

		return false;
	}

	{if $contract_added == 1}
		$("#user-produc").modal('hide');
		parent.document.location.reload();
	{/if}
</script>

{if $errors}
    {foreach from=$errors key=error_code item=error_message}
		<p class="error">
			{if $error_code == 'UNDEFINED_PRODUCT_SID'} [[Product ID is not defined]]{/if}
		</p>
	{/foreach}
{/if}

<form action="{$GLOBALS.site_url}/add-user-product/" method="POST" id="addProductForm" onsubmit='return formSubmit();'>
	[[Select Product:]]
	<select name="product_sid" id="product_sid">
		{foreach from=$products item=product}
			<option value="{$product.sid}">[[{$product.name|escape}]]</option>
		{/foreach}
	</select>
	<br/>
	<input type="hidden" name="user_sid" value="{$user_sid}" />
	<input type="hidden" name="action" value="add_product" />
	<input type="submit" id="add" name="add" value="[[Add]]" class="btn btn--secondary" />
</form>
