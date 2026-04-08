<input type="text" class="tag-input" name="{$id}" value="{$value|escape}"/>

{if $comment}
	<small>[[{$comment}]].</small>
{/if}
{javascript skip_duplicate=true}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.4/css/selectize.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.4/js/standalone/selectize.min.js"></script>

    <script>
		$(document).ready(function() {
			$('.tag-input').selectize({
				options: [
                	{foreach from=array_unique(array_merge($blog_categories, explode(',', $value))) item=blog_category}
						{ 'text': {$blog_category|json_encode}, 'value': {$blog_category|json_encode} }{if !$blog_category@last},{/if}
					{/foreach}
                ],
                plugins: ['remove_button'],
                placeholder: 'Add Category',
                createOnBlur: true,
				persist: false,
                closeAfterSelect: true,
				create: true
			})
		});
	</script>
{/javascript}

<style>
	div.selectize-input.items.not-full.has-options.has-items {
		padding-top: 5px !important;
		padding-bottom: 2px !important;
	}
	div.selectize-input.items.not-full.has-options {
		padding-top: 5px !important;
		padding-bottom: 5px !important;
	}
	.selectize-input input {
		height: 22px;
	}
	.selectize-input {
		border-radius: 2px !important;
		background-color: #fafafa !important;
		box-shadow: none !important;
	}
	.selectize-control.plugin-remove_button [data-value] .remove {
		border-left: none !important;
	}
	.selectize-control.multi .selectize-input>div {
		border-radius: 2px;
		background-color: #e7e7e7 !important;
	}
</style>