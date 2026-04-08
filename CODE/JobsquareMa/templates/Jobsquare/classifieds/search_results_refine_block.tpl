{if $GLOBALS.user_page_uri == '/resumes/'}
{if !empty($CounterCvAccess) && $listing_type =="Resume"}
<input type="hidden" id="CounterCvAccess" name="CounterCvAccess" value="{if $CounterCvAccess != -1}{$CounterCvAccess}{else}0{/if}">
<div class="topcvtheque">
	<div id="results"> Il vous reste <span class="count" id="countcv">{if $CounterCvAccess != -1 }{$CounterCvAccess}{else}0{/if}</span> CV à consulter </div>
	<i class="fa fa-caret-down"></i>
</div>
{/if}
{/if}

{if !empty($currentSearch)}
	<div class="current-search" style="display:none;">
		<div class="current-search__title">[[Current Search]]</div>
		{capture name="urlParams"}searchId={$searchId|escape:'url'}&amp;action=undo{/capture}
		{foreach from=$currentSearch item="fieldInfo" key="fieldID"}
			{foreach from=$fieldInfo.field item="fieldValue" key="fieldType"}
				{foreach from=$fieldValue item="val" key="realVal"}
				{if $val !="0"}
					<a class="badge" href="?{$smarty.capture.urlParams}&amp;param={$fieldID}&amp;type={$fieldType}&amp;value={$realVal|escape:'url'}">{tr}{$val}{/tr|escape} <span style="font-weight:300">X</span></a>
				{/if}
				{/foreach}
			{/foreach}
		{/foreach}
	</div>
{/if}

{if !empty($refineFields)}
	{capture name="trLess"}[[Less]]{/capture}
	{capture name="trMore"}Plus &rarr;{/capture}

	{capture name="urlParams"}searchId={$searchId|escape:'url'}&amp;action=refine{/capture}

	<form id="resume_filter">
		<input type="hidden" name="action" value="refine">
		<input type="hidden" name="searchId" value="{$searchId|escape:'url'}">

	{* ============ NEW FILTER CARDS FOR JOB PAGE ============ *}
	{if $listing_type =="Job"}
		{foreach from=$refineFields item=refineField}
			{if $refineField.show && $refineField.count_results}
				<div class="sj-filter-card refine-search__block">
					<h3>
						{assign var="field_caption" value=$refineField.caption|tr}
						{tr}{$field_caption}{/tr|escape}
						<span class="sj-toggle" data-target="#sj-refine-{$refineField.field_name}">&#9662;</span>
					</h3>
					<div id="sj-refine-{$refineField.field_name}">
						{foreach from=$refineField.search_result item=val name=fieldValue}
							{capture name="refineFieldCriteria"}{$refineField.field_name}{if in_array($refineField.type, array('string'))}[multi_like_and]{else}[multi_like]{/if}[]={if $val.sid}{$val.sid}{else}{$val.value|escape:'url'}{/if}{/capture}
							{if $smarty.foreach.fieldValue.iteration == 7}
								<div class="sj-less-more" style="display: none">
							{/if}
							<a href="?{$smarty.capture.urlParams}&amp;{$smarty.capture.refineFieldCriteria}" class="sj-filter-option-link" style="text-decoration:none; color:inherit;">
								<label class="sj-filter-option">
									<input type="checkbox" onclick="window.location.href=this.closest('a').href; return false;">
									{tr}{$val.value}{/tr|escape}
									{if $val.count != 0}<span class="sj-count">{if empty($refineField.criteria)}{$val.count}{/if}</span>{/if}
								</label>
							</a>
						{/foreach}
						{if $smarty.foreach.fieldValue.total >= 7}
							</div><button type="button" class="sj-show-more sj-less-more-btn">{$smarty.capture.trMore}</button>
						{/if}
					</div>
				</div>
			{/if}
		{/foreach}
	{/if}

	{* ============ RESUME FILTERS (unchanged) ============ *}
	{foreach from=$refineFields item=refineField}
		{if $refineField.show && $refineField.count_results}
			{if $listing_type =="Resume"}
			<div class="col-md-4">
				<div class="refine-search__block">
					<a class="btn__refine-search" role="button" data-toggle="collapse" href="#refine-block-{$refineField.field_name}" aria-expanded="true" aria-controls="refine-block-{$refineField.field_name}">
						{assign var="field_caption" value=$refineField.caption|tr}
						{tr}Refine by $field_caption{/tr|escape}
					</a>
					<select name="{$refineField.field_name}{if in_array($refineField.type, array('string'))}[multi_like_and]{else}[multi_like]{/if}[]" class="btn__refine-search" onchange="this.form.submit();">
					<option value="0">{assign var="field_caption" value=$refineField.caption|tr}
						{tr}Refine by $field_caption{/tr|escape}</option>
					{foreach from=$refineField.search_result item=val name=fieldValue}
						{capture name="refineFieldCriteria"}{$refineField.field_name}{if in_array($refineField.type, array('string'))}[multi_like_and]{else}[multi_like]{/if}[]={if $val.sid}{$val.sid}{else}{$val.value|escape:'url'}{/if}{/capture}
						<option value="{if in_array($refineField.type, array('string'))}{$val.value}{else}{$val.sid}{/if}">
						{tr}{$val.value}{/tr|escape}
						</option>
					{/foreach}
					</select>
				</div>
			</div>
			{/if}
		{/if}
	{/foreach}
	</form>

	{if $listing_type =="Resume"}
	{/if}
{/if}
{if !$GLOBALS.is_ajax}
	<div id="refine-block-preloader"></div>
{/if}
{javascript}
	<script>
		/* Toggle show more/less for filter options */
		$(document).on('click', '.sj-less-more-btn', function(e) {
			e.preventDefault();
			var btn = $(this);
			btn.prev('.sj-less-more').slideToggle('normal', function() {
				if ($(this).css('display') == 'block') {
					btn.html('{$smarty.capture.trLess|escape}');
				} else {
					btn.html('{$smarty.capture.trMore|escape}');
				}
			});
		});

		/* Toggle filter card collapse */
		$(document).on('click', '.sj-toggle', function() {
			var target = $(this).data('target');
			$(target).slideToggle(200);
			$(this).toggleClass('collapsed');
		});

		/* Old less-more for resume filters */
		$(document).on('click', '.less-more__btn', function(e) {
			e.preventDefault();
			var butt = $(this);
			butt.toggleClass('collapse');
			$(this).prev('.less-more').slideToggle('normal', function() {
				if ($(this).css('display') == 'block') {
					butt.html('{$smarty.capture.trLess|escape}');
				} else {
					butt.html('{$smarty.capture.trMore|escape}');
				}
			});
		});
	</script>
{/javascript}