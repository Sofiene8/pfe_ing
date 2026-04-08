<h1>[[Migrate 4.2 to 5.0]]</h1>

{breadcrumbs}[[Migrate 4.2 to 5.0]]{/breadcrumbs}
{foreach from=$errors item=error}
	<p class="error">{$error}</p>
{/foreach}
<br>
<form method="post">
	{if $step == 0}
		<p class="notice">
			Existing users, applications and listings will be deleted permanently
		</p>
		<br>
		<p>
			Upload the <a href="?download=1">script</a> in to the root folder of the source job board
			[[and then specify its URL (e.g. http://demo.smartjobboard.com)]]
		</p>
		<input type="text" name="from" value="{$from|escape}" class="inputString"/>
		<div style="clear: both;"></div>
		<input type="hidden" name="step" value="{$step+1}">
		<p><button class="grayButton">[[Next]]</button></p>
	{/if}
	{if $step == 2}
		<div class="import-fields">
			<h2>[[Please select additional fields you wish to import]]</h2>
			<div>
				<h2>[[Job fields]]</h2>
				{foreach from=$extra_fields[6] item='field'}
					<p>
						<label>
							<input type="checkbox" name="import_field[6][]" value="{$field.id}" />
							{if $field.id == 'Salary'}
								Salary + Salary Type
							{else}
								{$field.caption}
							{/if}
						</label>
					</p>
				{/foreach}
			</div>
			<div>
				<h2>[[Resume fields]]</h2>
				{foreach from=$extra_fields[7] item='field'}
					<p>
						<label>
							<input type="checkbox" name="import_field[7][]" value="{$field.id}" />
							{if $field.id == 'DesiredSalary'}
								Desired Salary + Salary Type
							{else}
								{$field.caption}
							{/if}
						</label>
					</p>
				{/foreach}
			</div>
		</div>
		<input type="hidden" name="from" value="{$from|escape}" />
		<div style="clear: both;"></div>
		<input type="hidden" name="step" value="{$step+1}">
		<p>
			<button class="grayButton">[[Migrate]]</button>
		</p>
	{elseif $step == 3}
		<p class="message">
			[[Migration completed successfully]]
		</p>
	{/if}

</form>
<style>
	.import-fields {
		width: 500px;
	}
	.import-fields > div {
		width: 250px;
		float: left;
	}
</style>