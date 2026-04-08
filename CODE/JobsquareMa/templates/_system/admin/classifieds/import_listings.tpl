{breadcrumbs}
	<a href="{$GLOBALS.site_url}/manage-{$listingType.id|lower}s/?restore=1">
		[[{$listingType.name} Postings]]
	</a>
	/
	[[Import {$listingType.name}s]]
{/breadcrumbs}
<div class="page-title">
	<h1 class="title">[[Import {$listingType.name}s]]</h1>
</div>
{include file="error.tpl"}
<div class="panel panel-default panel--max">
	<form method="post"  enctype="multipart/form-data" onsubmit="disableSubmitButton('submitImport');" class="panel-body form-horizontal">
		<input type="hidden" name="listing_type_id" value="{$listingType.id}">
		<div class="form-group">
			<label class="col-xs-12">[[System Import Values]]</label>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">[[Product:]]</label>
			<div class="col-md-7">
				<select name="product_sid">
					{foreach from=$products item=product}
						<option value="{$product.sid}">[[{$product.name|escape}]]</option>
					{/foreach}
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">[[Active Status:]]</label>
			<div class="col-md-7">
				<label class="cr-styled">
					<input type="checkbox" name="active" value="1" />
					<i class="fa"></i>
				</label>
			</div>
		</div>
		<div class="form-group">
		</div>
		<div class="form-group">
			<label class="col-xs-12">[[Data Import]]</label>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">[[File:]]</label>
			<div class="col-md-7">
				<input type="file" name="import_file" value="" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">[[File Type:]]</label>
			<div class="col-md-7">
				<select name="file_type">
					<option value="csv">CSV</option>
					<option value="xls">Excel</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">[[Fields Delimiter:]]</label>
			<div class="col-md-7">
				<select name="csv_delimiter" >
					<option value="semicolon">[[Semicolon]]</option>
					<option value="comma">[[Comma]]</option>
					<option value="tab">[[Tabulator]]</option>
				</select>
				<span data-toggle="tooltip" data-placement="auto left" title="[[For CSV-file only]]"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">[[Encoding:]]</label>
			<div class="col-md-7">
				<select name="encodingFromCharset" >
					<option value="UTF-8">[[Default]]</option>
					{foreach from=$charSets item=charSet}
						<option value="{$charSet}">{$charSet}</option>
					{/foreach}
				</select>
				<span data-toggle="tooltip" data-placement="auto left" title="[[For CSV-file only]]. [[Select appropriate encoding for your language  in case you have problems with import of certain symbols]]"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-7 col-md-offset-2">
				<input type="submit" name="action" value="[[Import]]" id="submitImport" class="btn btn--primary" />
			</div>
		</div>
	</form>
</div>
<script>
