<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="../../system/ext/dist/bootstrap-tagsinput.css">
<link rel="stylesheet" href="../../system/ext/dist/app.css">
<script src="../../system/ext/dist/bootstrap-tagsinput.min.js"></script>
<script src="../../system/ext/dist/bootstrap-tagsinput-angular.min.js"></script>

{breadcrumbs}
	<a href="{$GLOBALS.site_url}/manage-{$listingType.link}/?restore=1">
		{if $listingType.id == 'Job'}[[{$listingType.name} Postings]]{else}[[Resumes]]{/if}
	</a>
	/ [[Edit {$listingType.name}]]
{/breadcrumbs}
<div class="page-title">
	<h1 class="title">[[Edit {$listingType.name}]]</h1>
</div>

{include file='field_errors.tpl'}
<p>[[Fields marked with an asterisk (<span class="required">*</span>) are mandatory]]</p>

<div class="panel panel-default panel--max">
	<form method="post" enctype="multipart/form-data" action="" {if isset($form_fields.ApplicationSettings)}onsubmit="return validateForm('editListingForm');"{/if} id='editListingForm' class="panel-body">
		<input type="hidden" id="action" name="action" value="apply_info"/>
		<input type="hidden" name="listing_id" value="{$listing.id}"/>
		{set_token_field}
		<div class="form-horizontal">
			{foreach from=$form_fields item=form_field}
				{if $form_field.id == 'status'}
				{elseif !isset($form_fields.Resume) && $form_field.id =='ApplicationSettings'}
					<div class="form-group">
						<label class="col-md-2 control-label">[[$form_field.caption]]{if $form_field.is_required} <span class="required">*</span>{/if}</label>
						<div class="col-md-7">{input property=$form_field.id template='applicationSettings.tpl'}</div>
					</div>
				{elseif !isset($form_fields.Resume) && $form_field.id == 'expiration_date'}
					<div class="form-group">
						<label class="col-md-2 control-label">[[$form_field.caption]]{if $form_field.is_required} <span class="required">*</span>{/if}</label>
						<div class="col-md-7">{input property=$form_field.id template='expiration_date.tpl'}</div>
					</div>
				{elseif $form_field.type == 'location'}
					<div class="form-group hidden">
						{input property=$form_field.id}
					</div>
				{elseif $form_field.type == 'complex'}
					<div class="form-group">
						<h3 class="complex-title">
							[[{$form_field.caption|escape}]]
						</h3>
						{input property=$form_field.id}
					</div>
				{else}
					<div class="form-group">
						<label class="col-md-2 control-label">[[{$form_field.caption|escape}]]{if $form_field.is_required} <span class="required">*</span>{/if}</label>
						<div class="col-md-7">
							{if $form_field.id == 'username'}
                                <div class="half">
                                    {input property=$form_field.id}
                                </div>

                            {else}
								{input property=$form_field.id}
							{/if}
							
							{if in_array($form_field.type, array('multilist'))}
								<div id="count-available-{$form_field.id}" class="mt-count-available"></div>
							{/if}
						</div>
					</div>
				{/if}
			{/foreach}

			<div class="form-group">
				<div class="col-md-7 col-md-offset-2">
					<input type="submit" value="[[Save]]" class="btn btn--primary" />
				</div>
			</div>
		</div>
	</form>
</div>
