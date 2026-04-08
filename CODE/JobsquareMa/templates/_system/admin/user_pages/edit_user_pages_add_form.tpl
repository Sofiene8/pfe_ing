{if $IS_NEW == 1}
    {breadcrumbs}<a href="{$GLOBALS.site_url}/user-pages/">[[Pages]]</a> / [[Add a New Page]]{/breadcrumbs}
	<div class="page-title">
		<h1 class="title">[[Add a New Page]]</h1>
	</div>
{else}
    {breadcrumbs}<a href="{$GLOBALS.site_url}/user-pages/">[[Pages]]</a> / [[Edit Page]]{/breadcrumbs}
	<div class="page-title">
		<h1 class="title">[[Edit Page]]</h1>
		<div class="page-title__buttons">
			<a href="{$GLOBALS.site_url}/..{$user_page.uri|escape}" target="_blank"  class="btn--bordered">[[View Page]]</a>
		</div>
	</div>
{/if}

{foreach from=$ERRORS key=ERROR item=ERROR_DATA}
	{if $ERROR == 'URI_NOT_SPECIFIED'}<p class="error">[[The page URL is not specified]]</p>{/if}
	{if $ERROR == 'ADD_ERROR'}<p class="error">[[Cannot add new Page]]</p>{/if}
	{if $ERROR == 'CHANGE_ERROR'}<p class="error">[[Cannot change data of the Page]]</p>{/if}
	{if $ERROR == 'PAGE_EXISTS'}<p class="error">[[Page with such URI is already exist]]</p>{/if}
	{if $ERROR == 'DELETE_PAGE'}<p class="error">[[Page URL is not defined]]</p>{/if}
	{if $ERROR == 'PAGE_ALREADY_EXISTS'}<p class="error">[[Page with such url already exists]]</p>{/if}
{/foreach}

<div class="panel panel-default panel--max">
	<form name="form1" method="post" class="panel-body form-horizontal">
		<input type="hidden" name="action" value="{$action}" />
		<input type="hidden" id="submit" name="submit" value="apply_page" />
		<input type="hidden" name="ID" value="{$user_page.ID}" />
		<div class="form-group">
			<label class="col-md-2 control-label">[[Page Title]]</label>
			<div class="col-md-7"><input type="text" name="title" value="{$user_page.title|escape}" /></div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">[[Page Content]]</label>
			<div class="col-md-7">
				{WYSIWYGEditor name='content' class='inputText' width="100%" height="150" type='ckeditor' value=$user_page.content conf="Admin"}
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">[[URL]] <span class="required">*</span></label>
			<div class="col-md-7">
				<div class="input-group">
					<span class="input-group-addon hidden-xs">{$GLOBALS.custom_domain_url}</span>
					<input type="text" name="uri" value="{if !$user_page.ID && !$user_page.uri}/{else}{$user_page.uri|escape}{/if}" />
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">[[Meta Description]]</label>
			<div class="col-md-7"><textarea name="description" cols="55" rows="4">{$user_page.description|escape}</textarea></div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">[[Meta Keywords]]</label>
			<div class="col-md-7"><input name="keywords" type="text" value="{$user_page.keywords|escape}"></div>
		</div>
		<div class="form-group">
			<div class="col-md-7 col-md-offset-2">
				<input type="submit" id="apply" value="[[Save]]" class="btn btn--primary" />
			</div>
		</div>
	</form>
</div>