{breadcrumbs}<a href="{$GLOBALS.site_url}/manage-banner-groups/">[[Banners]]</a> &#187; '{$bannerGroup.id}' [[Group]]{/breadcrumbs}
<div class="page-title">
    <h1 class="title">'{$bannerGroup.id}' [[Group]]</h1>
  
</div>


{if $errors }
	{foreach from=$errors item=error}
		<p class="error">[[{$error}]]</p>
	{/foreach} 
{/if}
<div class="panel panel-default panel--wide panel__custom-fields">
<fieldset>
	<legend>[[Edit Banner Group]]</legend>

	<form method="post" enctype="multipart/form-data">
		<table>
			<input type="hidden" name="action" value="edit" />
			<input type="hidden" id="submit" name="submit" value="save_banner" />
			<input type="hidden" name="groupSID" value="{$bannerGroup.sid}" />
			<tr>
				<td valign="top">[[Group ID]]</td>
				<td><input type="text" name="groupID" maxlength="20" value="{$bannerGroup.id}" /></td>
			</tr>
			<tr>
				<td valign="top">[[Number of Banners to Display At Once]]</td>
				<td><input type="text" name="number_banners_display_at_once" maxlength="20" value="{$bannerGroup.number_banners_display_at_once}" /></td>
			</tr>
			<tr>
				<td colspan="2" align="right">
					<div class="floatRight">
						<input type="submit" id="apply" value="[[Apply]]" class="btn btn-default"/>
						<input type="submit" name="send" value="[[Save]]" class="btn btn-default" />
					</div>
				</td>
			</tr>
		</table>
	</form>
</fieldset>
<div class="banner-clue">
	[[Please insert the following code to the templates where you want this banner group to appear]]:<br>
	<span>{ldelim}module name="banners" function="show_banners" group="{$bannerGroup.id}"{rdelim}</span>
</div>
</div>
<script>
	$('#apply').click(
		function(){
			$('#submit').attr('value', 'apply');
		}
	);
</script>