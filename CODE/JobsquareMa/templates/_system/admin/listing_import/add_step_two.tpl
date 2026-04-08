{breadcrumbs}
	<a href="{$GLOBALS.site_url}/show-import/">[[Job Auto Import]]</a>
	{if $id > 0}
		/ [[Edit Data Source]]
	{else}
		/ [[Add New Data Source - Step Two]]
	{/if}
{/breadcrumbs}
<div class="page-title">
	<h1 class="title">[[Data source parameters]]</h1>
</div>

{if $errors}
	{foreach from=$errors key=key item=error}
		{if $key === 'UPLOAD_ERR_INI_SIZE' || $error === 'UPLOAD_ERR_INI_SIZE'}
			<p class="error">[[File size shouldn't be larger than 5 MB.]]</p>
		{elseif $error === 'NOT_VALID_VALUE'}
			<p class="error">'[[{$key}]]' [[invalid value]]</p>
		{elseif $error === 'NOT_SUPPORTED_IMAGE_FORMAT'}
			<p class="error">'[[{$key}]]' - [[Image format is not supported]]</p>
		{elseif $error === 'UPLOAD_ERR_NO_FILE'}
			<p class="error">'[[{$key}]]' [[file not specified]]</p>
		{else}
			<p class="error">[[{$error}]]</p>
		{/if}
	{/foreach}
{/if}
<form action="{$GLOBALS.site_url}/{if $editImport == 1}edit-import{else}add-import{/if}/{if $id > 0}?id={$id}{/if}"
	  method="post" id="manage_form" enctype="multipart/form-data">
	<div class="panel panel-default panel--max">
		<input type="hidden" name="xml" value="{$xml}">
		<input type="hidden" name="add_level" value="3">
		<input type="hidden" id="form_action" name="form_action" value="apply_info"/>
		<div class="form-horizontal">
			<div class="form-group">
				<label class="control-label col-md-2">[[Data Source Name]]</label>
				<div class="col-md-7">
					<input type="text" name="parser_name" id="parser_name" value="{$form_name|escape}">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2">[[Data Source URL]]</label>
				<div class="col-md-7"><input type="text" name="parser_url" id="parser_url" value="{$form_url|escape}"></div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2">[[Listings type]]</label>
				<div class="col-md-7">
					<label style="padding-top: 7px;">{$type_name}</label>
					<input type="hidden" name="type_id" value="{$type_id}">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2">[[Listings will be created on behalf of]]</label>
				<div class="col-md-7">
					<label class="cr-styled cr-styled__radio" style="margin-right: 15px;">
						<input type='radio' name='selectUserType' id='selectUserTypeU' value='username' {if $add_new_user == 0}checked{/if}/>
						<i class="fa"></i>
						[[This user (enter user email)]]
					</label>
					<label class="cr-styled cr-styled__radio">
						<input type='radio' name='selectUserType' id='selectUserTypeG' value='group' {if $add_new_user == 1}checked{/if} />
						<i class="fa"></i>
						[[User from XML data source (user will be imported automatically)]]
						<input type="hidden" name="parser_user" id="parser_user_group" {if $add_new_user == 0} disabled="disabled" {/if} value="41">
					</label>
					<input type="text" name="parser_user" id="parser_user_username" value="{if $add_new_user == 0}{$form_user|escape:'html'}{/if}" {if $add_new_user == 1}disabled="disabled"{/if} />
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2">[[Post under product]]</label>
				<div class="col-md-7">
					<div id="loading" style="display:none; position: absolute;">
						<img class="progBarImg" src="{$GLOBALS.user_site_url}/system/ext/jquery/progbar.gif" alt="[[Please wait ...]]" /> [[Please wait ...]]
					</div>
					<select id="postUnderProduct" name="postUnderProduct">
						<option value="">[[Select Product]]</option>
						{if !empty($products)}
							{foreach from=$products item=product}
								<option value="{$product.sid}" {if $selectedProduct == $product.sid}selected="selected"{/if}>[[{$product.name}]]</option>
							{/foreach}
						{/if}
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2">[[Description]]</label>
				<div class="col-md-7">
					<textarea name="form_description">{$form_description|escape:'html'}</textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2">[[Expired Listings from XML Feed will be]]</label>
				<div class="col-md-7">
					<label class="cr-styled cr-styled__radio" style="margin-right: 15px; margin-top: 7px;">
						<input type="radio" id="snapshot_import_type" name="import_type" value="snapshot" {if $import_type == 'snapshot'}checked="checked"{/if} />
						<i class="fa"></i>
						[[Deleted]]
					</label>
					<label class="cr-styled cr-styled__radio" style="margin-top: 7px;">
						<input type="radio" id="increment_import_type" name="import_type" value="increment" {if $import_type == 'increment'}checked="checked"{/if} />
						<i class="fa"></i>
						[[Left till expiration]]
					</label>
				</div>
			</div>
		</div>
	</div>

	<div class="panel panel-default panel--max panel__job-import">
		<div class="panel-body">
			<table class="table table-striped table__job-import">
				<tr>
					<td colspan='2'>
						<table class="" id="manage_table">
							<thead>
								<tr>
									<th width='34%' class='text-center'><strong>[[Posting Fields]] </strong></th>
									<th width='34%' class='text-center'><strong>[[Default Value]] </strong></th>
									<th class='text-center'><strong>[[XML Data Fields]]</strong></th>
								</tr>
							</thead>
							<tbody>
							<tr>
								<td valign="top" colspan='3' class="td-header">
									<table class="table">
										<tr>
											<td class="td-header"><div class="droppable2" ><div style='line-height: 34px; height: 34px;'><strong>external_id</strong></div></div></td>
											<td class="td-wide td-header">&nbsp;</td>
											<td class="td-header" align='right'>
												<div class="droppable">
													<div class="xml-data-fields">
														<select name='external_id' id='external_id'>
															<option value=''>[[Select field]]</option>
															{foreach from=$tree key=main_key item=one}
																<option value='{$one.key}' {if $external_id == $one.key }selected{/if}>{$main_key|replace:"_dog_":"@"|replace:"_":" - "}</option>
															{/foreach}
														</select>
													</div>
												</div>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td valign="top" colspan='2'>
									<table width="100%">
										{foreach from=$fields item=fild}
											{if $fild.id != 'external_id'}
											<tr>
												<td class="td_height"><div class="droppable2"><div class="draggable" title="[[Drag and drop to the appropriate XML field]]" id="{$fild.id}">[[{$fild.caption|escape}]]</div></div></td>
												{assign var="fieldId" value=$fild.id}
												<td class="td_height td-wide">
													<div id='defaultValue_{$fieldId}'>
														<input type="text" name='default_value[{$fieldId}]' id='id_{$fieldId}' placeholder="[[{$fild.caption|escape}]]" value="{$default_value.$fieldId|escape}"  />
													</div>
												</td>
											</tr>
											{/if}
										{/foreach}
									</table>
								</td>

								<td valign="top">
									<table class="table">
										{foreach from=$tree key=main_key item=one}
											<tr>
												<td class="td_height" align="right" style="white-space: nowrap">
													&nbsp;[[{$main_key|replace:"_dog_":"@"|replace:"_":" - "}]]
												</td>
												<td class="td_height"><div class="droppable" id="{$one.key}"></td>
											</tr>
										{/foreach}
									</table>
								</td>
							</tr>
						</tbody>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="2"><div id="user_fields"></div></td>
				</tr>
				<tr>
					<td colspan=2 align="center">
						<input type="submit" value="[[Save]]" class="btn btn--primary"/>
					</td>
				</tr>
			</table>
		</div>
	</div>
</form>
{capture name="selectProduct"}[[Select Product]]{/capture}

{javascript}
	<script type="text/javascript">

		function in_array(what, where) {
			for(var i=0; i<where.length; i++) {
				if (what == where[i]) {
					return i;
				}
			}
			return -1;
		}

		var id = {$id};

		{if $selected}
		var selected = new Array();
		{foreach from=$selected item=one}
		selected.push('{$one}');
		{/foreach}

		var a_selected = new Array();
		{foreach from=$a_selected item=one}
		a_selected.push('{$one}');
		{/foreach}
		{/if}

		$(function() {
			if (id > 0){
				$(".draggable").each(function(i){
					var drag = $(this);
					var isset = in_array(drag.attr('id'), selected);
					if (isset >= 0){
						var drop = $("#"+a_selected[isset] + ".droppable");
						var input = "<input type='hidden' name='mapped[]' value='"+drop.attr('id')+':'+drag.attr('id')+"'>";
						$("#defaultValue_"+drag.attr('id')).css("display", "none");
						drop.html(input);
						drop.append(drag);
					}
				});
			}

			$("#manage_form").submit( function() { // check input data
				if ($.trim($("#parser_name").val()).length == 0) {
					alert('[[Please, select name for parser]]'); return false; }

				var external_id = $("#external_id");
				if (external_id.val() != '') {
					var iner = "<input type='hidden' name='mapped[]' value='"+external_id.val()+'_external_id:'+external_id.attr('id')+"'>";
					$(this).append(iner);
				}

				if ($('#selectUserTypeU').prop('checked') === true && $.trim($("#parser_user_username").val()).length == 0) {
					alert('[[Please, enter valid user name]]'); return false;
				}
				else if ($('#selectUserTypeG').prop('checked') === true && $.trim($("#parser_user_group").val()).length == 0) {
					alert('[[Please, select user group]]');return false;
				}
				if ($('#postUnderProduct').val() == '') {
					alert('[[Please select a product]]'); return false;
				}
				if ($.trim($("#parser_url").val()).length == 0) {
					alert('[[Please, enter url for import]]'); return false; }
				return true;
			});

			$(".draggable").draggable({
				revert: 'invalid',
				cursor: 'move'
			});

			$(".droppable2").droppable({
				activeClass: 'ui-state-highlight2',
				hoverClass: 'ui-state-drophover2',
				accept: '.draggable',
				drop: function(event, ui) {
					$(ui.draggable).css("top", $(this).position().top + 5);
					$(ui.draggable).css("left", $(this).position().left +5);
				}
			});

			$(".droppable").droppable({
				activeClass: 'ui-state-highlight',
				hoverClass: 'ui-state-drophover',
				accept: '.draggable',
				out: function(event, ui) {
					if ($(this).children("input").val() == $(this).attr('id')+':'+ui.draggable.attr('id')) {
						$(this).children("input").remove();
						$("#defaultValue_"+ui.draggable.attr('id')).css("display", "block");
					}
				},
				drop: function(event, ui) {
					if ($(this).children("input").size() > 0)
					{
						alert('[[Field can access only one item]]');
						//ui.draggable.draggable('option', 'revert', true);
						//ui.draggable.draggable('option', 'revert', 'invalid');
					}
					else
					{
						var iner = "<input type='hidden' name='mapped[]' value='"+$(this).attr('id')+':'+ui.draggable.attr('id')+"'>";
						$("#defaultValue_"+ui.draggable.attr('id')).css("display", "none");
						//$("#id_"+ui.draggable.html()).val('');
						$(this).append(iner);
					}
					$(ui.draggable).css("top", $(this).position().top + 5);
					$(ui.draggable).css("left", $(this).position().left +5);
				}
			});
		});

		$("#selectUserTypeU").click(function() {
			$("#parser_user_group").prop("disabled", true);
			$("#parser_user_username").prop("disabled", false);
			$("#user_fields").hide();
		});

		$("#selectUserTypeG").click(function() {
			$("#parser_user_username").prop("disabled", true);
			$("#parser_user_username").val('');
			$("#parser_user_group").prop("disabled", false).change();
			$("#user_fields").show();
		});

		if($("#selectUserTypeG").prop('checked') === true) {
			var url = '{$GLOBALS.site_url}/listing-import/user-fields/';
			$.post(url, { "user_group_sid": $("#parser_user_group").val(), 'id':{$id}, 'xml':'{$xmlToUser|base64_encode}'}, function(data){
				$("#user_fields").html(data);
			});
		}

		function getProducts()
		{
			var parser_user = $(this).val();
			if ($(this).attr('id') != 'parser_user_group' || $(this).is(':disabled')) {
				parser_user = $("#parser_user_username").val();
			} else {
				var url = '{$GLOBALS.site_url}/listing-import/user-fields/';
				$.post(url, { "user_group_sid": $("#parser_user_group").val(), 'id':{$id}, 'xml':'{$xmlToUser|base64_encode}'}, function(data){
					$("#user_fields").html(data);
				});
			}
			var user_type = $("input[name='selectUserType']:checked").val();
			var url = '{$GLOBALS.site_url}/edit-import/';
			if (parser_user) {
				$.ajax({
					url: url,
					type: 'POST',
					data: { 'user_type': user_type, 'parser_user': parser_user},
					beforeSend: function() {
						$("#loading").show();
						$('#postUnderProduct').hide();
					},
					success: function(data){
						$("#loading").hide();
						var response = $.parseJSON(data);
						var defaultValue = '<option value="">{$smarty.capture.selectProduct|escape:"javascript"}</option>';
						if (response.error == '' && $.isArray(response.products)) {
							$('#postUnderProduct').empty();
							$("#postUnderProduct").append(defaultValue);
							$.each(response.products, function(index, value) {
								$("#postUnderProduct").append('<option value="'+value.sid+'">'+value.name+'</option>');
							});
							$('#postUnderProduct').show();
							if ("{$selectedProduct}" != '') {
								$("#postUnderProduct").val("{$selectedProduct}");
							}
						} else if (response.error != '') {
							alert(response.error);
							$('#postUnderProduct').empty();
							$("#postUnderProduct").append(defaultValue);
							$('#postUnderProduct').show();
						}
					}
				});
			}
		}
		$("document").ready(function(){
			$("#parser_user_group").change(getProducts).change();
			$("#parser_user_username").change(getProducts);
		});
	</script>
{/javascript}