
{breadcrumbs}<a href="{$GLOBALS.site_url}/listing-fields/">[[Governorat]]</a> {/breadcrumbs}
<div class="page-title">
	<h1 class="title">[[Edit Governorat]]</h1>
</div>
{include file="field_errors.tpl"}



<div class="panel panel-default panel--max">
	<div class="panel-heading">
		<h3 class="panel-title">[[Governorat Info]]</h3>
	</div>
	<form id="fieldData" method="post" action="" class="panel-body form-horizontal" enctype="multipart/form-data">
		<input type="hidden" id="action" name="action" value="apply_info" />
		<input type="hidden" name="sid" value="{$state.sid}" />
		<div class="form-group" style="">
         <label class="col-md-2 control-label">
             Governorat &nbsp;<span class="required">*</span>
			 </label>
                <div class="col-md-7">
                 <input type="text" value="{$state.name}" required class="inputString caption " name="state" id="state">
                 </div>
            </div>
				<div class="form-group" style="">
         <label class="col-md-2 control-label">
             URL &nbsp;<span class="required">*</span>
			 </label>
                <div class="col-md-7">
                 <input type="text" value="{$state.url}" required class="inputString caption " name="url" id="url">
                 </div>
            </div>
				<div class="form-group" style="">
         <label class="col-md-2 control-label">
             Description &nbsp;
			 </label>
                <div class="col-md-7">
                
                 {capture name="wysiwygName"}description{/capture}
{capture name="wysiwygClass"}inputText{/capture}
{assign var='wysiwygType' value='tinymce'}
                                                         
{WYSIWYGEditor name=$smarty.capture.wysiwygName class=$smarty.capture.wysiwygClass width="40%" height="100" type=$wysiwygType value=$state.description conf="Admin"}		 
				 			 
				 </div>
            </div>
			<div class="form-group" style="">
         <label class="col-md-2 control-label">
             Image &nbsp;<span class="required">*</span>
			 </label>
                <div class="col-md-7">
                 <input type="file" value="{$state.picture}" class="inputString caption " name="picture" id="picture">
				<br>
				 {if $state.picture}<img src="{$GLOBALS.site_url}/../files/states/{$state.picture}" width="50" height="50"/>{/if}
                 </div>
            </div>
				<div class="form-group" style="">
         <label class="col-md-2 control-label">
             Afficher sur le front
			 </label>
                <div class="col-md-7">
                 <input type="checkbox" value="1" class="inputString caption " name="display" id="display"{if $state.display==1}checked{/if}>
                 </div>
            </div>
		<div class="form-group">
			<div class="col-md-7 col-md-offset-2">
				<input type="submit" value="[[Save]]" class="btn btn--secondary"/>
			</div>
		</div>
	</form>
</div>