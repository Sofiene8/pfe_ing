<div class="quarter">
	<input type="text" id="{$id}" readonly value="{tr type="date"}{if $mysql_date}{$mysql_date}{else}{$value}{/if}{/tr}" class="input_date" name="{$id}"/>
	<img class="ui-datepicker-trigger" src="{image}icon-calendar.svg" alt="..." title="...">
</div>
{javascript}
	<script type="text/javascript">
		var dFormat = '{$GLOBALS.current_language_data.date_format}';
		var id = '{$id}';
		dFormat = dFormat.replace('%m', 'mm');
		dFormat = dFormat.replace('%d', 'dd');
		dFormat = dFormat.replace('%Y', 'yyyy');

		var dp = $('#' + id).datepicker({
			language: '{$GLOBALS.current_language}',
			autoclose: true,
			todayHighlight: true,
			format: dFormat,
			startDate: '+0d',
			endDate: '+10y'
		});

		if (dp.val() == '') {
			dp.datepicker('setDate', '+1m');
		}
	</script>
{/javascript}