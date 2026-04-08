{breadcrumbs}
	<a href="{$GLOBALS.site_url}/edit-email-templates/">[[Email Templates]]</a> /
	[[Edit]] "[[{$tplInfo.name}]]" [[Template]]
{/breadcrumbs}
<div class="page-title">
	<h1 class="title">[[Edit]] "[[{$tplInfo.name}]]" [[Template]]</h1>
</div>

<p>[[Fields marked with an asterisk (<span class="required">*</span>) are mandatory]]</p>

{include file='../users/field_errors.tpl'}

<div class="panel panel-default panel--max">
	<form method="post" enctype="multipart/form-data" action="" id="email-template-edit" class="panel-body form-horizontal">
		<input type="hidden" id="action" name="action" value="apply_info"/>
		{foreach from=$form_fields item=form_field}
			<div class="form-group" {if $form_field.id == 'name'}style="display: none;"{/if}>
				<label class="col-md-2 control-label">[[{$form_field.caption}]]<span class="required">&nbsp;{if $form_field.is_required}*{/if}</span></label>
				<div class="col-md-7">
					{if $form_field.id eq 'file'}{input property=$form_field.id template="file_et.tpl"}{else}{input property=$form_field.id}{/if}
				</div>
			</div>
		{/foreach}
		<div class="form-group">
			<div class="col-md-7 col-md-offset-2">
				<input type="submit" name="apply" value="[[Save]]" class="btn btn--primary"/>
			</div>
		</div>
	</form>
</div>