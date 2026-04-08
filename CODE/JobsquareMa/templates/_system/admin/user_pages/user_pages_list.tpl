<div class="page-title page-title--wide">
	<h1 class="title">[[Pages]]</h1>
	<div class="page-title__buttons">
		<a href="{$GLOBALS.site_url}/user-pages/?action=new" class="btn btn--primary">[[Add a New Page]]</a>
	</div>
</div>
<div class="panel panel-default panel--wide">
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-striped">
				<thead>
					<tr>
						<th class="text-left" style="width: 100%" colspan="2">[[Title]]</th>
					</tr>
				</thead>
				<tbody>
                    {foreach from=$pages_list item=page name="foreach"}
                        <tr class="{cycle values="oddrow,evenrow"}">
                            <td class="text-left"><a href="?action=edit_page&amp;uri={$page.uri|escape:'url'}" title="[[Edit]]">{$page.title|escape}</a></td>
                            <td class="text-center">
								<a href="?action=delete_page&amp;uri={$page.uri|escape:'url'}"
								   onclick="return confirm('[[Are you sure you want to delete this page?]]')" title="[[Delete]]">
									<i class="ion-close-circled"></i>
								</a>
							</td>
                        </tr>
                    {/foreach}
				</tbody>
			</table>
		</div>
	</div>
</div>