{if $template_name eq ""}
	{if $ERROR ne "MODULE_DOES_NOT_EXIST"}
		{if $ERROR eq "CANNOT_COPY_THEME"}
		<p class="error">[[Access denied]]</p>
		{/if}
		<div class="panel panel-default panel--wide">
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>[[Template Name]]</th>
								<th class="actions">[[Actions]]</th>
							</tr>
						</thead>
						<tbody>
							{assign var="counter" value=0}
							{foreach from=$template_list item="template_info"}
								{assign var="counter" value=$counter+1}
								<tr class="{if $counter is odd}oddrow{else}evenrow{/if}">
									<td style="width: 100%;">{$template_info.fileName}</td>
									<td style="white-space: nowrap; min-width: 145px;">
										<a href="?module_name={$module_name}&template_name={$template_info.fileName}" title="[[Edit]]" class="btn btn--secondary">[[Edit]]</a>
										{if $template_info.themeTemplate}
											<a title="[[Delete]]" onclick="return confirm('[[Template deletion may affect the front-end pages work. Are you sure you want to delete this Template?]]');" href="?action=delete&module_name={$module_name}&template_name={$template_info.fileName}" class="btn btn--danger">[[Delete]]</a>
										{/if}
									</td>
								</tr>
							{foreachelse}
								<tr><td colspan="2">[[This module does not have any templates]]</td></tr>
							{/foreach}
						</tbody>
					</table>
				</div>
			</div>
		</div>
	{/if}
{else}
	{module name="template_manager" function="edit_template"}
{/if}