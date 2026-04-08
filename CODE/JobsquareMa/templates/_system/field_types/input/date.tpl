{if $complexField}
	<input type="text" class="form-control form-control__visible" value="{$value|date_format:"%m.%Y"|escape}" />
{/if}
<input {if $complexField}type="hidden"{else}type="text"{/if} class="form-control input-date" name="{if $complexField}{$complexField}[{$id}][{$complexStep}]{else}{$id}{/if}" value="{if $mysql_date && !$complexField}{$mysql_date|date|escape:'html'}{else}{$value|date|escape:'html'}{/if}" />
<img class="ui-datepicker-trigger" src="{$GLOBALS.user_site_url}/templates/Bootstrap/assets/images/icon-calendar.svg" alt="..." title="...">
{*{$value|@var_dump}*}
{*{$mysql_date|@var_dump}*}
{javascript}
	<script type="text/javascript">
		var dFormat = '{$GLOBALS.current_language_data.date_format}';

		console.log(dFormat);
		dFormat = dFormat.replace('%m', "mm");
		dFormat = dFormat.replace('%d', "dd");
		dFormat = dFormat.replace('%Y', "yyyy");
        console.log(dFormat);
		$('.input-date:not(.form-control__visible)').datepicker({
			language: '{$GLOBALS.current_language}',
			format: dFormat,
			autoclose: true,
			todayHighlight: true,
			startDate: new Date(1940, 1 - 1, 1),
			endDate: '+10y',
		});

		$('.ui-datepicker-trigger').on('click', function () {
			$(this).closest('.form-group').find('.form-control').focus();
		});
	</script>
{/javascript}