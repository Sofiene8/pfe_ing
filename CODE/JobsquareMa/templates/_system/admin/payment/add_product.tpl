{breadcrumbs}
	<a href="{$GLOBALS.site_url}/products/{$userGroup.id|lower}/">[[{$userGroup.name} Products]]</a> / [[Add New Product]]
{/breadcrumbs}
<div class="page-title">
	<h1 class="title">[[Add New Product]]</h1>
</div>
<div class="panel panel-default panel--max">
	{include file="../users/field_errors.tpl"}
	<form method="post" action="{$GLOBALS.site_url}/add-product/" id="productForm" class="panel-body form-horizontal">
		<input type="hidden" id="action" name="action" value="save" />
		<input type="hidden" id="listing_type_sid" name="listing_type_sid" value="{$listing_type_sid}" />
		{foreach from=$form_fields item=form_fields_info key=page_id}
			{foreach from=$form_fields_info item=form_field}
				{if $form_field.id == 'availability_from'}
					<div class="form-group">
						<label class="col-md-2 control-label">
							[[$form_field.caption]]{if $form_field.is_required}&nbsp;<span class="required">*</span>{/if}
						</label>
						<div class="col-md-7">
							<div class="quarter form-range">
								<div class="input-group">
									<span class="input-group-addon">[[from]]</span>
									{input property=$form_field.id}
								</div>
							</div>
							<div class="quarter form-range">
								<div class="input-group">
									<span class="input-group-addon">[[to]]</span>
									{input property=availability_to}
								</div>
							</div>
							{if $form_field.comment}
								<span data-toggle="tooltip" data-placement="auto left" title="[[{$form_field.comment}]]"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
							{/if}
						</div>
					</div>
				{elseif $form_field.id == 'expiration_period'}
					<div class="form-group">
						<label class="col-md-2 control-label">[[Product expires in]]</label>
						<div class="col-md-7 products">
							<div class="numerical-block">
								<div class="input-group">
									{input property=$form_field.id}
									<span class="input-group-addon">[[days]]</span>
								</div>
							</div>
							[[after purchase]]
							{if $form_field.comment}
								<span data-toggle="tooltip" data-placement="auto left" title="[[{$form_field.comment}]]"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
							{/if}
						</div>
					</div>
				{elseif $form_field.id == 'period'}
					<div class="form-group">
						<label class="col-md-2 control-label">
							[[$form_field.caption]]
							{foreach from=$form_fields_info item=formFieldReq}{if $formFieldReq.id == 'period_name' && $formFieldReq.is_required}&nbsp;<span class="required">*</span>{/if}{/foreach}
						</label>
						<div class="form-group">
							<div class="product-input-field">
								<div class="form-group">
									{input property=$form_field.id}
								</div>
								<div class="form-group">
									{input property=period_name template="list_period.tpl"}
								</div>
							</div>
						</div>
					</div>
				{elseif $form_field.id == 'period_name' || $form_field.id == 'availability_to' || ($recurring && $form_field.id == 'billing_cycle')}
				{* *}
				{elseif $form_field.id == 'price'}
					<div class="form-group">
						<label class="col-md-2 control-label">[[$form_field.caption]]{if $form_field.is_required}&nbsp;<span class="required">*</span>{/if}</label>
						<div class="col-md-7">
							<div class="numerical-block">
								<div class="input-group">
									{input property=$form_field.id}
									<span class="input-group-addon">{currencySign}</span>
								</div>
							</div>
							{if $recurring}
								<div class="billing-cycle-field">
									{input property='billing_cycle'}
								</div>
							{/if}
						</div>
					</div>
				{elseif $form_field.id == 'listing_duration'}
					<div class="form-group post-listing-field">
						<label class="col-md-2 control-label">[[$form_field.caption]]{if $form_field.is_required}&nbsp;<span class="required">*</span>{/if}</label>
						<div class="col-md-7">
							<div class="numerical-block">
								<div class="input-group">
									{input property=$form_field.id}
									<span class="input-group-addon">[[days]]</span>
								</div>
							</div>
							{if $form_field.comment}
								<span data-toggle="tooltip" data-placement="auto left" title="[[{$form_field.comment}]]"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
							{/if}
						</div>
					</div>
				{else}
					<div {if $form_field.id == 'user_group_sid' || $form_field.id == 'listing_type_sid' || $form_field.id == 'recurring'}style="display:none;"{else}class="form-group {if in_array($form_field.id, array('number_of_listings', 'featured'))}post-listing-field{/if}"{/if}>
						<label class="col-md-2 control-label">[[$form_field.caption]]{if $form_field.is_required}&nbsp;<span class="required">*</span>{/if}</label>
						<div class="col-md-7">
							{if $form_field.id == 'number_of_listings'}
								<div class="numerical-block">
									{input property=$form_field.id} {if $form_field.id == 'width' || $form_field.id == 'height'} [[pixels]]{/if}
								</div>
							{else}
								{input property=$form_field.id} {if $form_field.id == 'width' || $form_field.id == 'height'} [[pixels]]{/if}
							{/if}
							{if $form_field.comment}
								<span data-toggle="tooltip" data-placement="auto left" title="[[{$form_field.comment}]]"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
							{/if}
						</div>
					</div>
				{/if}
			{/foreach}
		{/foreach}
		<div class="form-group">
			<div class="col-md-7 col-md-offset-2">
				<input type="submit" class="btn btn--primary" value="[[Save]]" id="saveProduct" />
			</div>
		</div>
	</form>
</div>

{javascript}
	<script type="text/javascript">
        $('[name="post_job"], [name="post_resume"], [name="post_training"]').change(function() {
			$('.post-listing-field').toggle(this.checked);
			if ($('[name="post_resume"]').length) {
				$('[name="number_of_listings"]')
						.val(1)
						.closest('.post-listing-field').hide();
			}
		}).change();


		$(function() {
			$("#saveProduct").click(function(){
				return validatePeriod();
			});
		});

		function validatePeriod()
		{
			var period_name = $("#period_name").val();
			if (period_name == 'unlimited') {
				$("#period").prop('disabled', false);
				$("#period").val('');
			}
			return true;
		}
	</script>
{/javascript}