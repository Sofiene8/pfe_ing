<div class="page-title">
	<h1 class="title">[[Update control]]</h1>
</div>
{if $zip_extension_loaded == true}

	<p class="note alert alert-info">
	[[Please enter your Client Area access details. You got these access details to our system when you purchased your license.]]
	</p>

	{foreach from=$errors item=error key=error_code}
		<p class="error">
			[[{$error}]]
		</p>
	{/foreach}

	<div class="panel panel-default panel--max">
		<form method="post" action="{$GLOBALS.site_url}/update-to-new-version/" class="panel-body form-horizontal">
			<div class="form-group">
				<label class="col-md-2 control-label">[[SJB Client Area Login]]</label>
				<div class="col-md-7">
					<input type="text" name="auth_username">
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-2 control-label">[[Password]]</label>
				<div class="col-md-7"><input type="password" name="auth_password"></div>
			</div>

			<div class="form-group">
				<label class="col-md-2 control-label">
					[[Update Type]]
				</label>
				<div class="col-md-7">
					<label class="cr-styled cr-styled__radio">
						<input type="radio" id="way_to_updateAuto" name="way_to_update" value="autoUpdate" {if !isset($wayToUpdate) or $wayToUpdate eq 'autoUpdate'}checked="checked"{/if} />
						<i class="fa"></i>
						[[Auto]]
					</label>
					<label class="cr-styled cr-styled__radio">
						<input type="radio" id="way_to_updateArch" name="way_to_update" value="makeArchive" {if $wayToUpdate eq 'makeArchive'}checked="checked"{/if} />
						<i class="fa"></i>
						[[Get Archived Files]]
					</label>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-7 col-md-offset-2">
					{capture assign="trContinue"}[[Continue]]{/capture}
					<input class="btn btn--primary" type="submit" name="update_to_version" value="[[{$trContinue|escape:'html'}]]" />
				</div>
			</div>
		</form>
	</div>

{else}
	{foreach from=$errors item=error key=error_code}
		<p class="error">
			[[{$error}]]
		</p>
	{/foreach}
{/if}