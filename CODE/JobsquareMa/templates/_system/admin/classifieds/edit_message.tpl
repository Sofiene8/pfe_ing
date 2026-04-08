{breadcrumbs}<a href="{$GLOBALS.site_url}/listing-fields/">[[Message]]</a> {/breadcrumbs}
<div class="page-title">
	<h1 class="title">[[Edit Message]]</h1>
</div>
{include file="field_errors.tpl"}



<div class="panel panel-default panel--max">
	<div class="panel-heading">
		<h3 class="panel-title">[[Message Info]]</h3>
	</div>
	<form id="fieldData" method="post" action="" class="panel-body form-horizontal">
		<input type="hidden" id="action" name="action" value="apply_info" />
		<input type="hidden" name="sid" value="{$message.sid}" />
		<div class="form-group" style="">
         <label class="col-md-2 control-label">
             Message &nbsp;<span class="required">*</span>
			 </label>
                <div class="col-md-7">
                 <input type="text" value="{$message.message}" class="inputString caption " name="message" id="message">
                 </div>
            </div>
		<div class="form-group">
			<div class="col-md-7 col-md-offset-2">
				<input type="submit" value="[[Save]]" class="btn btn--secondary"/>
			</div>
		</div>
	</form>
</div>