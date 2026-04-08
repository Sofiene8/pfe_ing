<script language="JavaScript" type="text/javascript">
<!--//

var ModulesFunctions = new Array();
{foreach from=$LIST_FUNCTIONS key=KEY_MOD item=VALUE_ARRAY_FUNC}
	ModulesFunctions["{$KEY_MOD}"]=[[-1,'Choose function:']{foreach from=$VALUE_ARRAY_FUNC key=KEY_FUNC item=VALUE_FUNC},[{$KEY_FUNC},'{$VALUE_FUNC}']{/foreach}];
{/foreach}

var Params = new Array();
{foreach from=$LIST_PARAMS key=KEY_MOD item=VALUE_ARRAY_FUNC}
  {foreach from=$VALUE_ARRAY_FUNC key=KEY_FUNC item=VALUE_ARRAY_PARAM}
     Params["{$KEY_MOD}", "{$KEY_FUNC}"]=[[-1,'reserved']{foreach from=$VALUE_ARRAY_PARAM key=KEY_PARAM item=VALUE_PARAM},[{$KEY_PARAM},'{$VALUE_PARAM}']{/foreach}];
  {/foreach}
{/foreach}



function loadFunctionsForModule(form) {
    document.getElementById("table_params").innerHTML = '';

	module_value = form.modules.options[form.modules.selectedIndex].text;
	form.functions.options.length=0;
	for (var i = 0; i < ModulesFunctions[module_value].length; i++) {
		newOpt = document.createElement("option");
		newOpt.text = ModulesFunctions[module_value][i][1];
		form.functions.options.add(newOpt);
	}
}

function loadParamsForFunction() {
  document.getElementById("table_params").innerHTML = '<p>{tr}There are no parameters for this function{/tr}</p>';
  cbModules=document.getElementById("modules");
  cbFunctions=document.getElementById("functions");
  module_value = cbModules[cbModules.selectedIndex].text;
  function_value = cbFunctions[cbFunctions.selectedIndex].text;


  if ( (module_value != "Choose module:") && (function_value != "Choose function:") ) {
     strHTML = '';
     for (var i = 1; i < Params[module_value,function_value].length; i++) {
        str_key = 'value_param' + (i-1);

        strHTML = strHTML + "<div class='form-group'><label class='control-label col-md-2'>"+ Params[module_value,function_value][i][1] +
         		  "=</label><div class='col-md-7'><input type='text' name='"+ Params[module_value,function_value][i][1] +"' id='"+ str_key +"' value='' class='text' size=15> </div></div>";
     } //for
     if (strHTML != '') {
     	strHTML = '<div name="table_parameters">'+ strHTML + '</div>';
     	document.getElementById("table_params").innerHTML = strHTML;
     }
  } //if
}

function insertStr() {
	editor.focus();
	var cbModules = document.getElementById("modules");
	var cbFunctions = document.getElementById("functions");
	var module_value = cbModules[cbModules.selectedIndex].text;
	var function_value = cbFunctions[cbFunctions.selectedIndex].text;

	if ((module_value != "Choose module:") && (function_value != "Choose function:")) {
		var str_param = '';
		var i = 0;
		while (1 == 1) {
			var param = document.getElementById("value_param" + i);
			if (param == null) {
				break;
			}
			var key_param = param.name;
			var value_param = trim(param.value);
			if (value_param != '') {
				if (str_param == '') {
					str_param = key_param + "=\"" + value_param + "\"";
				} else {
					str_param = str_param + " " + key_param + "=\"" + value_param + "\"";
				}
			}
			i++;
		}
		var editorCursor = editor.getCursor();
		var currentLine = editor.getLine(editorCursor.line);
		var scroll = editor.getScrollInfo();
		if (str_param != '') {
			str_param = " " + str_param;
		}
		var str_ins = "{ module name=\"" + module_value + "\" function=\"" + function_value + "\"" + str_param + "}";
		currentLine = currentLine.substr(0, editorCursor.ch) + str_ins + currentLine.substr(editorCursor.ch);
		editor.setLine(editorCursor.line, currentLine);
		editor.scrollTo(scroll.x, scroll.y);
		editor.save();
	}
}

//-->
</script>
{if $ERROR}
	{if $ERROR eq "MODULE_DOES_NOT_EXIST"}
		<p class="error">{tr}There is no such module{/tr}.</p>
	{elseif $ERROR eq "TEMPLATE_DOES_NOT_EXIST"}
		<p class="error">{tr}There is no such template{/tr}.</p>
	{elseif $ERROR eq "CANNOT_FETCH_TEMPLATE"}
		<p class="error">{tr}Cannot fetch template{/tr} "{$template_name}"</p>
	{elseif $ERROR eq "TEMPLATE_IS_NOT_WRITEABLE"}
		<p class="error">{tr}Template is not writeable.{/tr}</p>
	{else}
		<p class="error">{$ERROR}</p>
	{/if}
{else}
    <link rel="stylesheet" href="{$GLOBALS.user_site_url}/system/ext/CodeMirror/lib/codemirror.css">
    <link rel="stylesheet" href="{$GLOBALS.user_site_url}/system/ext/CodeMirror/mode/smartyhtmlmixed/smartyhtmlmixed.css">
	{javascript}
		<script src="{$GLOBALS.user_site_url}/system/ext/CodeMirror/lib/codemirror.js"></script>
		<script src="{$GLOBALS.user_site_url}/system/ext/CodeMirror/lib/util/match-highlighter.js"></script>
		<script src="{$GLOBALS.user_site_url}/system/ext/CodeMirror/mode/javascript/javascript.js"></script>
		<script src="{$GLOBALS.user_site_url}/system/ext/CodeMirror/mode/xml/xml.js"></script>
		<script src="{$GLOBALS.user_site_url}/system/ext/CodeMirror/mode/css/css.js"></script>
		<script src="{$GLOBALS.user_site_url}/system/ext/CodeMirror/mode/smarty/smarty.js"></script>
		<script src="{$GLOBALS.user_site_url}/system/ext/CodeMirror/mode/smartyhtmlmixed/smartyhtmlmixed.js"></script>
		<script src="{$GLOBALS.user_site_url}/system/ext/CodeMirror/lib/util/search.js"></script>
		<script src="{$GLOBALS.user_site_url}/system/ext/CodeMirror/lib/util/searchcursor.js"></script>
		<script src="{$GLOBALS.user_site_url}/system/ext/CodeMirror/lib/util/dialog.js"></script>
	{/javascript}

	<form action="" method="POST" id="form1">
		<div class="panel panel-default panel--accordion panel--max">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" href="#collapse" aria-expanded="false" class="collapsed">
						{tr}Click to insert module function{/tr}
					</a>
				</h4>
			</div>
			<div id="collapse" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
				<div class="panel-body form-horizontal">
					<div class="panel panel-default panel--max">
						<div class="form-group">
							<label class="control-label col-md-2">{tr}Module{/tr}</label>
							<div class="col-md-7">
								<select size="1" name="module" id="modules" onchange="loadFunctionsForModule(this.form)" language="Javascript">
									<option selected>{tr}Choose module{/tr}:</option>
									{foreach from=$LIST_MODULES key=KEY_MOD item=VALUE_MOD}
										<option> {$VALUE_MOD} </option>
									{/foreach}
								</select>

							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Function</label>
							<div class="col-md-7">
								<select size="1" name="function" id="functions" onchange="loadParamsForFunction()" language="Javascript">
									<option selected>{tr}Choose function{/tr}:</option>
									{foreach from=$LIST_FUNCTIONS[$user_page.module] key=KEY_FUNC item=VALUE_FUNC}
										<option> {$VALUE_FUNC} </option>
									{/foreach}
								</select>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-xs-12 text-left">{tr}Parameters{/tr}:</label>
					</div>
					<div id="table_params"></div>
					<div class="form-group">
						<div class="col-md-7">
							<input type="button" class="btn btn--primary" name="btnInsStr" value="{tr}Insert{/tr}" size=5  onclick="insertStr(this.form)" LANGUAGE="Javascript">
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="panel panel-default panel--max clearfix">
			<div class="table-responsive">
				<table width="100%" class="table table-clear">
					<tr>
						<td class="text-left"><textarea id="template_content" name="template_content" style="width:100%;height:400px">{$template_content|escape}</textarea></td>
					</tr>
					<tr>
						<td class="text-left">
							<input type="submit" value="{tr}Save{/tr}" class="btn btn--primary" />
						</td>
					</tr>
				</table>
			</div>
		</div>
		{javascript}
            <script type="text/javascript">
                    var editor = CodeMirror.fromTextArea(document.getElementById("template_content"), {
                        lineNumbers: true,
                        matchBrackets: true,
                        mode: "smartymixed",
                        indentUnit: 5,
                        indentWithTabs: true,
                        enterMode: "keep",
                        tabMode: "shift",
                        theme: "default"
                    });
            </script>
		{/javascript}

		<!--<input type="button" name="btnInsStr" value=" Insert" size=5  onclick="insertStr(this.form)" LANGUAGE="Javascript">-->

		<input type="hidden" name="template_name" value="{$template_name}">
		<input type="hidden" name="module_name" value="{$module_name}">
		<input type="hidden" id="action" name="action" value="apply_template">
	</form>
{/if}