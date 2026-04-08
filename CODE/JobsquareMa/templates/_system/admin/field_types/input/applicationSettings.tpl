{javascript}
<script type="text/javascript">
	function displayInput(disableId) {
		$("[id^='ApplicationSettings']")
				.prop('disabled', true)
				.closest('div').hide();
		var appSettingsDiv = document.getElementById(disableId);
		$("[id!=" + disableId + "][id^='ApplicationSettings']").val('');
		appSettingsDiv.disabled = false;
		$(appSettingsDiv).closest('div').show();
	}

	function validateForm(formName) {
		var form = document.getElementById(formName);
		var appSettingsRadio		= form.elements['{$id}[add_parameter]'];
		var appSettingsEmailValue	= form.elements["{$id}_1"].value;
		var appSettingsWebValue		= form.elements["{$id}_2"].value;
		for(var i = 0; i < appSettingsRadio.length; i++) {
			if(appSettingsRadio[i].checked && appSettingsRadio[i].value == 1) {
				var exp = /^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
				if ((appSettingsEmailValue != '') && !(appSettingsEmailValue.match(exp))) {
					message('[[Error]]', '[["How to Apply" wrong email format]]');
					return false;
				}
			} else if(appSettingsRadio[i].checked && appSettingsRadio[i].value == 2) {
				if (appSettingsWebValue == '') {
					message('[[Error]]', '[["How to Apply" by url is empty]]');
					return false;
				} else if( !( appSettingsWebValue.match(/https?:\/\//)) ) {
					form.elements["{$id}_2"].value = 'https://' + appSettingsWebValue;
					return true;
				}
			}
		}
		return true;
	}

	function getUrl(name) {
		var url = document.getElementById(name);
		if (url.value != '') {
			if (!(url.value.match(/https?:\/\//)) ) {
				url.value = 'https://' + url.value;
			}
			window.open(url.value, "target");
		} else {
			alert('[["Application Settings" url is empty]]');
		}
	}

	function message(title, content) {
		var modal = $('#message-modal');
		modal.find('.modal-title').html(title);
		modal.find('.modal-body').html(content);
		modal.modal('show');
	}
</script>
{/javascript}

<div class="modal fade" id="message-modal" tabindex="-1" role="dialog" aria-labelledby="message-modal-label">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
				<h4 class="modal-title" id="message-modal-label">Modal title</h4>
			</div>
			<div class="modal-body">

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">[[Close]]</button>
			</div>
		</div>
	</div>
</div>
<div id="application-settings" class="form-horizontal">
	<label class="cr-styled cr-styled__radio" style="margin-right: 15px">
		<input id="via-email" class="inputRadio" name="{$id}[add_parameter]" value="1" {if $value.add_parameter == 1 || $value.add_parameter == ''}checked="checked"{/if} onclick="displayInput('{$id}_1');" type="radio" />
		<i class="fa"></i>
		[[By Email]]
	</label>
	<label class="cr-styled cr-styled__radio">
		<input id="via-site" class="inputRadio" name="{$id}[add_parameter]" value="2" {if $value.add_parameter == 2}checked="checked"{/if} onclick="displayInput('{$id}_2');" type="radio" />
		<i class="fa"></i>
		[[By URL]]
	</label>
	<div class="row">
		<div class="col-xs-12" valign="top" colspan="2">
			<div class="application-settings__email with-tooltip" {if $value.add_parameter == 2}style="display: none;"{/if}>
				<input value="{if $value.add_parameter == 1}{$value.value|escape:'html'}{/if}" class="inputString"  name="{$id}[value]" {if $value.add_parameter == 2}disabled="disabled"{/if} id="{$id}_1" type="text" />
				<span data-toggle="tooltip" data-placement="auto left" title="[[Send applications to this e-mail]]"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
			</div>
			<div class="application-settings__site with-tooltip" {if $value.add_parameter != 2}style="display: none;"{/if}>
				<input value="{if $value.add_parameter == 2}{$value.value|escape:'html'}{/if}" class="inputString " name="{$id}[value]" id="{$id}_2" {if $value.add_parameter != 2}disabled="disabled"{/if} type="text" />
				<span data-toggle="tooltip" data-placement="auto left" title="[[Use the following format:]] https://yoursite.com"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
			</div>
		</div>
	</div>
</div>
