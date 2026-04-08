{if !isset($extraInfo.listing_duration)}
	{$extraInfo.listing_duration = (isset($contract['listing_duration'])) ? $contract['listing_duration'] : $productInfo['listing_duration']}
{/if}

{if $extraInfo.listing_duration}
	{if $listing['activation_date']}
		{$maxExpirationDate = strftime("{$GLOBALS.current_language_data.date_format}", strtotime("+{$extraInfo.listing_duration} day", strtotime($listing['activation_date'])))}
	{else}
		{$maxExpirationDate = strftime("{$GLOBALS.current_language_data.date_format}", strtotime("+{$extraInfo.listing_duration} day"))}
	{/if}
{/if}
{capture name='date_value'}{if $mysql_date}{tr type="date"}{$mysql_date}{/tr}{elseif !$value}{$maxExpirationDate}{else}{tr type="date"}{$value}{/tr}{/if}{/capture}
<input {if $expired}disabled="disabled"{else}readonly{/if} type="text" id="{$id}" value="{$smarty.capture.date_value}" class="form-control input-date" name="{$id}"/>
{if $expired}
	<input type="hidden" id="{$id}" value="{$smarty.capture.date_value}" class="form-control input-date" name="{$id}"/>
{/if}
<img class="ui-datepicker-trigger" src="{$GLOBALS.user_site_url}/templates/Bootstrap/assets/images/icon-calendar.svg" alt="..." title="...">
{javascript}
	<script type="text/javascript">
		var dFormat = '{$GLOBALS.current_language_data.date_format}';
		var maxExpirationDate = '{$maxExpirationDate}';
		var id = '{$id}';

		dFormat = dFormat.replace('%m', 'mm');
		dFormat = dFormat.replace('%d', 'dd');
		dFormat = dFormat.replace('%Y', 'yyyy');

        {if not $expired}
            $('#' + id).datepicker({
                language: '{$GLOBALS.current_language}',
                autoclose: true,
                todayHighlight: true,
                format: dFormat,
                startDate: '+0d',
                endDate: maxExpirationDate
            });
        {/if}

		if (!maxExpirationDate && !'{$smarty.capture.date_value|escape:'javascript'}') {
			$('#' + id).datepicker('setDate', '+1y');
		}

		$('.ui-datepicker-trigger').on('click', function () {
			$(this).closest('.form-group').find('.form-control').focus();
		});
	</script>
{/javascript}