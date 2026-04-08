{breadcrumbs}<a href="{$GLOBALS.site_url}/system/miscellaneous/plugins/">[[Plugins]]</a> / <a href="{$GLOBALS.site_url}{$GLOBALS.user_page_uri}">[[JobG8 Integration Plugin Settings]]</a> / [[Mapping]]{/breadcrumbs}
<div class="page-title">
	<h1 class="title">[[Mapping]]</h1>
</div>
{if $errors}
	{foreach from=$errors item="error"}
		<p id="mapping-error" class="error">{$error}</p>
	{/foreach}
{/if}
<div id="mapping-instruction" class="panel panel-default panel--max">
	<div class="panel-heading">
		<h3 class="panel-title">
			[[Mapping Instructions]]
		</h3>
	</div>
	<p>[[To make sure that Jobg8 field values fit your job board fields you should do mapping. Use this mapping tool in order to map Jobg8 field values with your job board field values.<br/><br/>In the first column you see Jobg8 field values. You need to select the best match for these values from the second column where your field values are displayed. The selected values will be used for posting of Jobg8 jobs on your site instead of Jobg8 values. Do not forget to press ‘Save’ button after you have mapped all the fields.<br/><br/>If you want to change the mapping field you should enter the ID of this field (not caption) in ‘SJB field:’ and click ‘Change Field’ button. In case you do not want Jobg8 jobs with certain field values to be posted on your site you can deactivate this field by unchecking it in the first column.]]</p>
</div>
<form method="post" class="mapping">
	<input type="hidden" name="action" value="mapping" />
	<input type="hidden" id="type" name="type" value="" />
	<input type="hidden" id="mappingField" name="mappingField" value="" />
	<input type="hidden" id="submit" name="submit" value="" />
	<input type="hidden" id="changeMappingField" name="changeMappingField" value="" />
	<div class="panel panel-default panel--accordion panel--max" id="category">
		<div class="panel-heading">
			<h4 class="panel-title">
				<a data-toggle="collapse" href="#collapse" aria-expanded="false" class="collapsed">
					[[Click for categories mapping]]
				</a>
			</h4>
		</div>
		<div id="collapse" class="panel-collapse collapse panel-body form-horizontal" aria-expanded="false" style="height: 0px;">
			<div class="form-group">
				<div class="col-md-2 control-label">
					[[JobG8 categories]]
				</div>
				<div class="col-md-7 change-field">
					<div class="input-group">
						<input type="text" class="mapping-field" value="{$categoryMappingFieldID}" />
						<div class="input-group-addon">
							[[SJB field]]
						</div>
					</div>
					<br/>
					<input type="submit" class="btn btn--secondary"  value="{if $categoryMappingFieldID}[[Change Field]]{else}[[Set Field]]{/if}" />
				</div>
			</div>
			{foreach from=$categoryMappingFieldValues item="categoryMappingFieldValue"}
				<div class="form-group">
					<div class="control-label col-md-2">
						<input type="hidden" name="allow[{$categoryMappingFieldValue.sid}]" value="0" />
						<label class="cr-styled">
							<input type="checkbox" name="allow[{$categoryMappingFieldValue.sid}]" value="1" {if $categoryMappingFieldValue.allow}checked="checked"{/if} />
							<i class="fa"></i>
							[[{$categoryMappingFieldValue.jobg8_field_value}]]
						</label>
					</div>
					<div class="col-md-7">
						<input type="hidden" name="category[{$categoryMappingFieldValue.sid}][]" value="" />
						<select multiple="multiple">
							<option disabled hidden></option>
							{foreach from=$sjbCategories item="sjbCategory"}
								<option value="{$sjbCategory.id}" {if in_array($sjbCategory.id, explode(',', $categoryMappingFieldValue.sjb_field_value))}selected="selected"{/if}>{tr}{$sjbCategory.caption}{/tr|escape:'html'}</option>
							{/foreach}
						</select>
					</div>
				</div>
			{/foreach}
			<div class="form-group">
				<div class="col-md-7 col-md-offset-2 mappingActions">
					<input type="submit" class="btn btn--primary" value="[[Save]]" />
				</div>
			</div>
		</div>
	</div>

	<div class="panel panel-default panel--accordion panel--max" id="employment">
		<div class="panel-heading">
			<h4 class="panel-title">
				<a data-toggle="collapse" href="#collapse2" aria-expanded="false" class="collapsed">
					[[Click for employment types mapping]]
				</a>
			</h4>
		</div>
		<div id="collapse2" class="panel-collapse collapse panel-body form-horizontal" aria-expanded="false" style="height: 0px;">
			<div class="form-group">
				<div class="control-label col-md-2">[[JobG8 employment types]]</div>
				<div class="col-md-7 change-field">
					<div class="input-group">
						<input type="text" class="mapping-field" value="{$employmentMappingFieldID}" />
						<div class="input-group-addon">
							[[SJB field]]
						</div>
					</div>
					<br/>
					<input type="submit" class="btn btn--secondary"  value="{if $employmentMappingFieldID}[[Change Field]]{else}[[Set Field]]{/if}" />
				</div>
			</div>
			{foreach from=$employmentMappingFieldValues item="employmentMappingFieldValue"}
				<div class="form-group">
					<div class="col-md-2 control-label">
						<input type="hidden" name="allow[{$employmentMappingFieldValue.sid}]" value="0" />
						<label class="cr-styled">
							<input type="checkbox" name="allow[{$employmentMappingFieldValue.sid}]" value="1" {if $employmentMappingFieldValue.allow}checked="checked"{/if} />
							<i class="fa"></i>
							[[{$employmentMappingFieldValue.jobg8_field_value}]]
						</label>
					</div>
					<div class="col-md-7">
						<input type="hidden" name="employment[{$employmentMappingFieldValue.sid}][]" value="" />
						<select>
							{foreach from=$sjbEmploymentTypes item="sjbEmploymentType"}
								<option value="{$sjbEmploymentType.id}" {if in_array($sjbEmploymentType.id, explode(',', $employmentMappingFieldValue.sjb_field_value))}selected="selected"{/if}>{tr}{$sjbEmploymentType.caption}{/tr|escape:'html'}</option>
							{/foreach}
						</select>
					</div>
				</div>
			{/foreach}
			<div class="form-group">
				<div class="col-md-7 col-md-offset-2 mappingActions">
					<input type="submit" class="btn btn--primary" value="[[Save]]" />
				</div>
			</div>
		</div>
	</div>
</form>

<script type="text/javascript">
	$('input[type="submit"]').click(function() {
		var mappingType = $(this).closest('.panel').attr('id');
		$('#type').val(mappingType);
		if ($(this).parent().is('div.mappingActions')) {
			$('#'+ mappingType).find('select').each(function() {
				$(this).prev("input[type='hidden']").val($(this).val());
			});
			$('#submit').val('apply');
		} else {
			$('#changeMappingField').val(1);
			$('#mappingField').val($(this).closest('.change-field').find('.mapping-field').val());
		}
	});
	
	function ignoreMappingField() {
		var mappingField = $(this).closest('.control-label').next().children('select');
		if ($(this).is(':checked')) {
			mappingField.attr("disabled", false);
		} else {
			mappingField.attr("disabled", true);
		}
	}
	
	$("input[type='checkbox']").each(ignoreMappingField).click(ignoreMappingField);
</script>