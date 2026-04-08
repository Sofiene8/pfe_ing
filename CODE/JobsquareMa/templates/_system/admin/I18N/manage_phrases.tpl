{javascript}
	<script language="JavaScript" type="text/javascript" src="{common_js}/pagination.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('select[name="i18n_default_language"]').change(function() {
				$('.default-language-form').submit();
			});

			$('.save-phrases').click(function() {
				$('.messages *').hide();
				var phrases = [];
				$('.translated input').each(function() {
					phrases.push(
						{
							'name': $(this).attr('name'),
							'value': $(this).val()
						}
					);
				});
				$.post('{$GLOBALS.site_url}/edit-phrase/', {
						phrases: phrases
					}, function(data) {
						if (data != 'ok') {
							$('.phrases-update-error').show();
						} else {
							$('.phrases-update-success').show();
						}
					}
				);
			});
		});
	</script>
{/javascript}

<div class="page-title">
	<h1 class="title">[[Edit Language]]</h1>
	<div class="page-title__buttons">
		<button type="button" class="btn btn--primary save-phrases">[[Save]]</button>
	</div>
</div>
<div class="panel panel-default panel--max">
	<div class="form-horizontal edit-language">
		<div class="form-group">
			<label class="col-md-2 control-label">[[Default Language]]</label>
			<div class="col-md-7">
				<form class="default-language-form" action="" method="post">
					<select name="i18n_default_language">
						{foreach from=$languages item=language}
							<option value="{$language.id}"{if $settings.i18n_default_language == $language.id} selected="selected"{/if}>{$language.caption}</option>
						{/foreach}
					</select>
				</form>
			</div>
		</div>
		<form method="post" action="{$GLOBALS.site_url}/manage-phrases/" class="panel-body">
			<input type="hidden" name="curr_lang" id="curr_lang" value="{$criteria.language}" />
			<div class="form-group">
				<label class="col-md-2 control-label">
					[[Filter Phrases]]
				</label>
				<div class="col-md-7">
					<input type="hidden" name="action" value="search_phrases" />
					<input type="hidden" name="page" value="1" />
					<div class="input-group">
						<input type="text" name="phrase_id" value="{$criteria.phrase_id|escape}" />
						<span class="input-group-btn"><input type="submit" name="show" value="[[Filter]]" class="btn btn--primary" /></span>
					</div>
				</div>
			</div>
			<div class="form-group" style="display: none;">
				<label class="col-md-2 control-label">[[Domain]]:</label>
				<div class="col-md-7">
					<select name="domain">
						<option value="">[[Any]]</option>
						{foreach from=$domains item=domain}
							<option value="{$domain}"{if $criteria.domain == $domain} selected="selected"{/if}>{$domain}</option>
						{/foreach}
					</select>
				</div>
			</div>
			<div class="form-group" style="display: none;">
				<label class="col-md-2 control-label">[[Language]]:</label>
				<div class="col-md-7">
					<select name="language">
						{foreach from=$languages item=language}
							<option value="{$language.id}"
									{if $criteria.language == $language.id}
								selected="selected"
									{assign var='chosen_language_id' value=$language.id}
									{assign var='chosen_language_caption' value=$language.caption}
									{/if}>{$language.caption}</option>
						{/foreach}
					</select>
				</div>
			</div>
		</form>
	</div>
</div>

<div class="messages">
	{if $errors}
		{include file="errors.tpl" errors=$errors}
	{/if}
	<p class="phrases-update-success message" style="display: none;">[[Your changes have been successfully saved]]</p>
	<p class="phrases-update-error error" style="display: none;">
		[[Unable to update phrases]]
	</p>
</div>

<div class="panel panel-default panel--max manage-phrases clearfix">
	<div class="table__pagination table__pagination--header">
		{include file="../pagination/pagination.tpl" layout="header"}
	</div>
	<div class="table-responsive">
		<table width="100%" class="table table-striped table__languages">
			<thead>
				<tr>
					<th width="50%" class="text-left">[[Phrase ID]]</th>
					<th width="50%">{$chosen_language_caption}</th>
				</tr>
			</thead>
			{if !empty($found_phrases)}
				{foreach from=$found_phrases item=phrase}
					{if $phrase.domain != $domain}
						<tr>
							<th colspan="2" class="text-left">{$phrase.domain}</th>
						</tr>
					{/if}
					<tr class="{cycle values = 'evenrow,oddrow'}">
						<td class="text-left">{$phrase.id|escape}</td>
						<td class="translated">
							<input type="text" name="{$phrase.id|escape}" value="{$phrase.translations.$chosen_language_id|escape}" />
						</td>
					</tr>
					{assign var=domain value=$phrase.domain}
				{/foreach}
			{/if}
		</table>
	</div>
	<div class="table__pagination table__pagination--footer">
		{include file="../pagination/pagination.tpl" layout="footer"}
	</div>
</div>