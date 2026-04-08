{breadcrumbs}<a href="{$GLOBALS.site_url}/custom-fields/">[[Custom Fields]]</a> / <a href="{$GLOBALS.site_url}/edit-listing-type/?sid={$listing_type_sid}">[[$listing_type_info.name Fields]]</a> / [[Add New $listing_type_info.name Field]]{/breadcrumbs}
<div class="page-title">
	<h1 class="title">[[Add New $listing_type_info.name Field]]</h1>
</div>
{include file="field_errors.tpl" errors=$errors}
<div class="panel panel-default panel--max">
	<form method="post" action="" class="panel-body form-horizontal">
		<input type="hidden" name="action" value="add" />
		<input type="hidden" name="listing_type_sid" value="{$listing_type_sid}" />
		{foreach from=$form_fields key=field_name item=form_field}
			<div class="form-group" style="{if $form_field.id == 'id'}display: none;{/if}">
				<label class="col-md-2 control-label">[[{$form_field.caption}]]{if $form_field.is_required}&nbsp;<span class="required">*</span>{/if}</label>
				<div class="col-md-7">{input property=$form_field.id}</div>
			</div>
		{/foreach}
		<div class="form-group">
			<div class="col-md-7 col-md-offset-2"><input type="submit" value="[[Save]]" class="btn btn--primary"/></div>
		</div>
	</form>
</div>
<script>
	$('#caption').change(function() {
		var prefix = 'id_{$listing_type_info.id}_';
		var val = prefix + $(this).val();
		val = val.replace(/[^\w]/g, '');
		if (val.length > 50) { // too long
			val = prefix;
		}
		if (val == prefix) { // too long or invalid chars
			var possible = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
			for (var i = 0; i < 7; i++)
				val += possible.charAt(Math.floor(Math.random() * possible.length));
		}
		$('#id').val(val);
	}).change();
</script>