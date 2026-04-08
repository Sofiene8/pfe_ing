{breadcrumbs}[[Social Media]]{/breadcrumbs}
<div class="page-title">
	<h1 class="title">[[Social Media]]</h1>
</div>

{foreach from=$errors item="error"}
	<p class="error">{$error}</p>
{/foreach}
<div id="social-media">
	<form method="post">
		<table id="network-list">
			<thead>
				<tr>
					<th>[[Network Name]]</th>
				</tr>
			</thead>
			<tbody>
				{foreach from=$socNetworks item=socNetwork key=key}
					<tr class="{cycle values = 'evenrow,oddrow'}">
						<td><a href="{$GLOBALS.site_url}/social-media/{$key}"><img src="{image}/social-{$key}-mini-icon.png" border="0" />{$socNetwork.name}</a></td>
					</tr>
				{/foreach}
			</tbody>
		</table>
	</form>
</div>