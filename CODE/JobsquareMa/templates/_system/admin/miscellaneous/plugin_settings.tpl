{if $plugin.group == 'Job Backfilling'}
	{breadcrumbs}<a href="{$GLOBALS.site_url}/backfilling/">[[Job Backfilling]]</a> / {$plugin.name|replace:'Plugin':''} [[Settings]]{/breadcrumbs}
{else}
	{breadcrumbs}<a href="{$GLOBALS.site_url}/system/miscellaneous/plugins/">[[Plugins]]</a> / {$plugin.name|replace:'Plugin':''} [[Settings]]{/breadcrumbs}
{/if}
<div class="page-title">
	<h1 class="title">{$plugin.name|replace:'Plugin':''} [[Settings]]</h1>
</div>
{foreach from=$errors item='error'}
	<p class="error">[[{$error}]]</p>
{/foreach}
{foreach from=$messages item='message'}
	<p class="message">[[{$message}]]</p>
{/foreach}

<form method="post" class="form-horizontal panel-body">
	<input type="hidden" name="action" value="save_settings">
	<input type="hidden" name="plugin" value="{$plugin.name}">
	<input type="hidden" name="submit" value="apply">
	<div class="panel panel-default panel--max">
		{foreach from=$settings item=pluginSettings name=pluginSettings}
			{assign var=setting_name value=$pluginSettings.id}
			{if $pluginSettings.type == 'separator'}
				<div class="form-group">
					<div class="col-md-7 col-md-offset-2">
						{if $pluginSettings.caption}<strong>[[{$pluginSettings.caption}]]</strong>{else}&nbsp;{/if}
					</div>
				</div>
			{elseif $pluginSettings.type == 'panel_separator'}
				</div>
				<div class="panel panel-default panel--max">
					<div class="panel-heading">
						<h3 class="panel-title">{$pluginSettings.caption}</h3>
					</div>
			{else}
				<div class="form-group">
					<label class="col-md-2 control-label">
						[[{$pluginSettings.caption}]]
						{if $pluginSettings.is_required}<span class="required">*</span>{/if}
					</label>
					<div class="col-md-7">
						{$pluginSetting.tabName.id}
						{if $pluginSettings.type == 'boolean'}
							<input type="hidden" name="{$setting_name}" value="0" />
							<label class="cr-styled">
								<input type="checkbox" id="checkbox_{$smarty.foreach.pluginSettings.iteration}" name="{$setting_name}" value="1" {if $savedSettings.$setting_name}checked="checked" {/if} />
								<i class="fa"></i>
							</label>
						{elseif  $pluginSettings.type == 'string'}
							<input type="text" name="{$pluginSettings.id}" {if $pluginSettings.class}class="{$pluginSettings.class}"{/if} value="{$savedSettings.$setting_name|escape}" />
						{elseif  $pluginSettings.type == 'text'}
							<textarea name="{$pluginSettings.id}" style="width: 250px; height: 150px;">{$savedSettings.$setting_name|escape}</textarea>
						{elseif  $pluginSettings.type == 'integer'}
							<input type="text" class="inputInteger" value="{$savedSettings.$setting_name}" name="{$pluginSettings.id}" />
						{elseif  $pluginSettings.type == 'list'}
							<select class="searchList" name="{$pluginSettings.id}">
								{if !$pluginSettings.required}
									<option value=""></option>
								{/if}
								{foreach from=$pluginSettings.list_values item=list}
									<option value="{$list.id}" {if $savedSettings.$setting_name == $list.id}selected="selected" {/if}>[[{$list.caption}]]</option>
								{/foreach}
							</select>
						{elseif  $pluginSettings.type == 'multilist'}
							<input type="hidden" name="{$pluginSettings.id}" value=""/>
							<select name="{$pluginSettings.id}[]" multiple="multiple">
								{assign var=selectedItems value=$savedSettings.$setting_name}
								{foreach from=$pluginSettings.list_values item=list}
									<option value="{$list.id}" {if in_array($list.id, explode(',', $selectedItems))}selected{/if}>[[{$list.caption}]]</option>
								{/foreach}
							</select>
							{javascript}
								<script type="text/javascript">
									$(document).ready(function() {
										var options = {
											selectedList: 3,
											selectedText: "# {tr}selected{/tr|escape}",
											noneSelectedText: "{tr}Click to select{/tr|escape}",
											checkAllText: "{tr}Select all{/tr|escape}",
											uncheckAllText: "{tr}Deselect all{/tr|escape}",
											header: true,
											height: 'auto'
										};
										$("select[name='{$pluginSettings.id}[]']").getCustomMultiList(options, '{$pluginSettings.id}', null);
									});
								</script>
							{/javascript}
                        {/if}
						{if $pluginSettings.comment}
							<span data-toggle="tooltip" data-placement="auto left" title='[[{$pluginSettings.comment}]]'><i class="fa fa-question-circle" aria-hidden="true"></i></span>
						{/if}
					</div>
				</div>
			{/if}
		{/foreach}
		{if $plugin.name == "MailChimpPlugin"}
			<div class="form-group">
				<div class="col-md-7 col-md-offset-2">
					[[Important: On Mailchimp list settings please do not change the tag of the First Name field ("FNAME")]].
				</div>
			</div>
		{/if}
	</div>
	<div class="form-group">
		<div class="col-md-7">
			<input type="submit" class="btn btn--primary" value="[[Save]]" />
		</div>
	</div>
</form>
