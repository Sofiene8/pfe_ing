{breadcrumbs}<a href="{$GLOBALS.site_url}/system/miscellaneous/plugins/">[[Plugins]]</a> / [[JobG8 Integration Plugin Settings]]{/breadcrumbs}
<div class="page-title">
	<h1 class="title">[[JobG8 Integration Plugin Settings]]</h1>
</div>

{if empty($GLOBALS.settings.jobg8Installed)}
	<p><a href="{$GLOBALS.site_url}{$GLOBALS.user_page_uri}?action=install" class="btn btn--secondary">[[Installation]]</a></p>
{else}
	<form method="post">
		<input type="hidden" name="action" value="saveSettings">
		<input type="hidden" id="submit" name="submit" value="apply">
		<div class="panel panel-default panel--max">
			<div class="panel-heading">
				<h3 class="panel-title">[[Receiving Jobs]]</h3>
			</div>
			<p>[[To make sure that Jobg8 field values fit your job board fields you should do mapping. Use this mapping tool in order to map Jobg8 fields with your job board fields.]]</p>
			<a href="{$GLOBALS.site_url}{$GLOBALS.user_page_uri}?action=mapping" class="btn btn--secondary">[[Mapping]]</a>
		</div>
		<div class="jobG8PostingJobsTypeBlock panel panel-default panel--max">
			<div class="panel-heading">
				<h3 class="panel-title">[[Posting  Jobs]]</h3>
			</div>
			<div class="form-horizontal">
				{foreach from=$settings.types item=jobPostingTypeSettings key=jobPostingTypeId name=jobPostingTypeSettings}
					<div class="form-group">
						{assign var="settingId" value="jobG8Buy{$jobPostingTypeId}Status"}
						<label class="control-label col-md-2">
							[[Buy $jobPostingTypeId]]:
						</label>
						<div class="col-md-7">
							<select id="{$settingId}" class="jobG8PostingJobsTypeSwitches" data-id="{$smarty.foreach.jobPostingTypeSettings.index}" name="{$settingId}">
								<option value="0" {if $savedSettings.$settingId == '0'}selected="selected" {/if}>[[disabled]]</option>
								<option value="1" {if $savedSettings.$settingId == '1'}selected="selected" {/if}>[[enabled]]</option>
							</select>
						</div>
					</div>
				{/foreach}
				{foreach from=$settings.common item=setting}
					<div class="form-group">
						<label class="col-md-2 control-label">[[$setting.caption]]</label>
						<div class="col-md-7">
							{if $setting.type == 'list'}
								<select name="{$setting.id}" style="max-width: none !important;">
									{foreach item="item" from=$setting.list_values}
										<option value="{$item.id|escape}" {if $savedSettings.{$setting.id} == $item.id}selected="selected"{/if}>{$item.caption|escape}</option>
									{/foreach}
								</select>
							{else}
								<input type="text" name="{$setting.id}" value="{$savedSettings.{$setting.id}}" />
							{/if}
						</div>
					</div>
				{/foreach}
			</div>
		</div>

		<div id="settingsPane">
			<ul class="nav nav-tabs">
				<li class="active">
					<a href="#buyApplicationsTab" data-toggle="tab" aria-expanded="true">[[Buy Applications]]</a>
				</li>
				<li>
					<a href="#buyTrafficTab" data-toggle="tab" aria-expanded="false">[[Buy Traffic]]</a>
				</li>
			</ul>
			<div class="tab-content">
				{foreach from=$settings.types item=jobPostingTypeSettings key=jobPostingTypeId name=settings}
					<div id="buy{$jobPostingTypeId}Tab" class="tab-pane clearfix {if $smarty.foreach.settings.first}active{/if}">
						<div class="table-responsive">
							<table  class="table table-striped" width="100%" id="jobg8-plugin">
								<tr class="headrow">
									<td>[[Name]]</td>
									<td style="min-width: 300px;">[[Value]]</td>
								</tr>
								{foreach from=$jobPostingTypeSettings item=pluginSettings}
									{assign var='settingID' value=$pluginSettings.id}
									{if $pluginSettings.type == 'separator'}
										<tr class="separator">
											<td colspan="2">
												{if $pluginSettings.caption}<strong>[[{$pluginSettings.caption}]]</strong>{else}&nbsp;{/if}
												{if $pluginSettings.comment}<br /><small>[[{$pluginSettings.comment}]]</small>{/if}
											</td>
										</tr>
									{else}
										{assign var="jobg8_company_list" value="{$jobPostingTypeId|lower}_jobg8_company_list"}
										{assign var="jobg8_company_name_filter" value="{$jobPostingTypeId|lower}_jobg8_company_name_filter"}
										{assign var="jobg8_product_list" value="{$jobPostingTypeId|lower}_jobg8_product_list"}
										{assign var="jobg8_product_filter" value="{$jobPostingTypeId|lower}_jobg8_product_filter"}
										{assign var="jobg8_job_category_list" value="{$jobPostingTypeId|lower}_jobg8_job_category_list"}
										{assign var="jobg8_job_category_filter" value="{$jobPostingTypeId|lower}_jobg8_job_category_filter"}
										{if $pluginSettings.id == $jobg8_company_list}
										{elseif $pluginSettings.id == $jobg8_company_name_filter}
											{foreach from=$jobPostingTypeSettings item='current'}
												{if $current.id == $jobg8_company_list}{assign var='companyList' value=$current}{/if}
											{/foreach}
											<tr class="{cycle values = 'evenrow,oddrow'}">
												<td class="filter-description">
													<input type="hidden" name="{$settingID}" value="0" />
													<label class="cr-styled">
														<input type="checkbox" name="{$settingID}" value="1" {if $savedSettings.$settingID}checked="checked" {/if} />
														<i class="fa"></i>
														[[{$pluginSettings.caption}]]
													</label>
												</td>
												<td style="min-width: 300px;">
													<textarea name="{$companyList.id}">{$savedSettings.$jobg8_company_list}</textarea>
												</td>
											</tr>
										{elseif $pluginSettings.id == $jobg8_product_list}
										{elseif $pluginSettings.id == $jobg8_product_filter}
											{foreach from=$jobPostingTypeSettings item='current'}
												{if $current.id == $jobg8_product_list}{assign var='productList' value=$current}{/if}
											{/foreach}
											<tr class="{cycle values = 'evenrow,oddrow'}">
												<td class="filter-description">
													<input type="hidden" name="{$settingID}" value="0" />
													<label class="cr-styled">
														<input type="checkbox" name="{$settingID}" value="1" {if $savedSettings.$settingID}checked="checked" {/if} />
														<i class="fa"></i>
														[[{$pluginSettings.caption}]]
													</label>
												</td>
												<td style="position: relative">
													{assign var='selectedItems' value=$savedSettings.$jobg8_product_list}
													<select name="{$productList.id}[]" multiple="multiple">
														{foreach from=$productList.list_values item='list'}
															<option value="{$list.id}" {if in_array($list.id, explode(',', $selectedItems))}selected{/if}>{$list.caption|escape}</option>
														{/foreach}
													</select>
													{if $productList.comment}
														<span class="tooltip-job8" data-toggle="tooltip" data-placement="auto left" title='[[{$productList.comment}]]'><i class="fa fa-question-circle" aria-hidden="true"></i></span>
													{/if}
												</td>
											</tr>
										{elseif $pluginSettings.id == $jobg8_job_category_list}
										{elseif $pluginSettings.id == $jobg8_job_category_filter}
											{foreach from=$jobPostingTypeSettings item='current'}
												{if $current.id == $jobg8_job_category_list}{assign var='categoryList' value=$current}{/if}
											{/foreach}
											<tr class="{cycle values = 'evenrow,oddrow'}">
												<td class="filter-description" style="width: 100%">
													<input type="hidden" name="{$settingID}" value="0" />
													<label class="cr-styled">
														<input type="checkbox" name="{$settingID}" value="1" {if $savedSettings.$settingID}checked="checked" {/if} />
														<i class="fa"></i>
														[[{$pluginSettings.caption}]]
													</label>
												</td>
												<td style="position: relative">
													{assign var='selectedItems' value=$savedSettings.$jobg8_job_category_list}
													<select name="{$categoryList.id}[]" multiple="multiple">
														{foreach from=$categoryList.list_values item='list'}
															<option value="{$list.id}" {if in_array($list.id, explode(',', $selectedItems))}selected{/if}>{$list.caption|escape}</option>
														{/foreach}
													</select>
													{if $categoryList.comment}
														<span class="tooltip-job8" data-toggle="tooltip" data-placement="auto left" title='[[{$categoryList.comment}]]'><i class="fa fa-question-circle" aria-hidden="true"></i></span>
													{/if}
												</td>
											</tr>
										{else}
											<tr class="{cycle values = 'evenrow,oddrow'}">
												<td>[[{$pluginSettings.caption}]]</td>
												<td>{$pluginSetting.tabName.id}
													{if $pluginSettings.type == 'boolean'}
														<input type="hidden" name="{$settingID}" value="0" /><input type="checkbox" name="{$settingID}" value="1" {if $savedSettings.$settingID}checked="checked" {/if} />
													{elseif  $pluginSettings.type == 'string'}
														<input type="text" name="{$pluginSettings.id}" value="{$savedSettings.$settingID}" />
													{elseif  $pluginSettings.type == 'text'}
														<textarea name="{$pluginSettings.id}" style="height: 150px;">{$savedSettings.$settingID}</textarea>
													{elseif  $pluginSettings.type == 'list'}
														<select name="{$pluginSettings.id}">
															{foreach from=$pluginSettings.list_values item=list}
																<option value="{$list.id}" {if $savedSettings.$settingID == $list.id}selected="selected" {/if}>{$list.caption|escape}</option>
															{/foreach}
														</select>
													{elseif  $pluginSettings.type == 'multilist'}
														<select name="{$pluginSettings.id}[]" multiple="multiple">
															{assign var=selectedItems value=$savedSettings.$settingID}
															{foreach from=$pluginSettings.list_values item=list}
																<option value="{$list.id}" {if in_array($list.id, explode(',', $selectedItems))}selected{/if}>{$list.caption|escape}</option>
															{/foreach}
														</select>
													{/if}
													{if $pluginSettings.comment}
														<br/><small>[[{$pluginSettings.comment}]]</small>
													{/if}
												</td>
											</tr>
										{/if}
									{/if}
								{/foreach}
								<tr>
									<td colspan="2">
										<div class="form-group" style="margin-top: 10px;">
											<input type="submit" class="btn btn--primary" value="[[Save]]" />
										</div>
									</td>
								</tr>
							</table>
						</div>
					</div>
				{/foreach}
			</div>
		</div>
	</form>
{/if}