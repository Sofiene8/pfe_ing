{breadcrumbs}<a href="{$GLOBALS.site_url}/promotions/">[[Discounts]]</a> / [[Add a New Discount Code]]{/breadcrumbs}

<div class="page-title">
	<h1 class="title">[[Add a New Discount Code]]</h1>
</div>

{include file='../classifieds/errors.tpl'}

<div class="panel panel-default panel--max">
	<div class="panel-heading">
		<h3 class="panel-title">[[Add a New Discount Code]]</h3>
	</div>
	<form method="post" enctype="multipart/form-data" class="panel-body form-horizontal">
		<input type="hidden" name="event" value="save_code">
		{foreach from=$form_fields item=form_field}
			{if $form_field.id == 'discount'}
				<div class="form-group">
					<label class="col-md-2 control-label">[[$form_field.caption]]{if $form_field.is_required}&nbsp;<span class="required">*</span>{/if}</label>
					<div class="col-md-7">
						<div class="numerical-block numerical-block__discount">{input property=$form_field.id}</div>
						<div class="numerical-block__property">{input property=type}</div>
					</div>
				</div>
			{* not show 'type' field in other place *}
			{elseif $form_field.id != 'type'}
				<div class="form-group">
					<label class="col-md-2 control-label">[[$form_field.caption]]{if $form_field.is_required}&nbsp;<span class="required">*</span>{/if}</label>
					<div class="col-md-7">
						{if $form_field.id == 'maximum_uses'}
							<div class="numerical-block">
								{input property=$form_field.id}
							</div>
						{else}
							{input property=$form_field.id}
						{/if}
						{if $form_field.comment}
							<span data-toggle="tooltip" data-placement="auto left" title="[[{$form_field.comment}]]"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
						{/if}

					</div>
				</div>
			{/if}
		{/foreach}
		<div class="form-group">
			<div class="col-md-7 col-md-offset-2"><input type="submit" class="btn btn--primary" value="[[Save]]" /></div>
		</div>
	</form>
</div>