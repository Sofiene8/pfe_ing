{if $currentSearch.GooglePlace.field}
	<div class="refine-search__block clearfix">
		<span class="btn__refine-search">
			[[Search within]]
		</span>
		<div class="refine-search__item-list collapse in clearfix dropdown" id="refine-block-radius">
			<a href="#" class="refine-search__item dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
				50 [[{$GLOBALS.settings.radius_search_unit}]]
			</a>
			<div class="dropdown-menu">
				<a class="refine-search__item refine-search__item-radius" href="#" data-value="10">
					<span class="refine-search__value">10 [[{$GLOBALS.settings.radius_search_unit}]]</span>
				</a>
				<a class="refine-search__item refine-search__item-radius" href="#" data-value="20">
					<span class="refine-search__value">20 [[{$GLOBALS.settings.radius_search_unit}]]</span>
				</a>
				<a class="refine-search__item refine-search__item-radius" href="#" data-value="50">
					<span class="refine-search__value">50 [[{$GLOBALS.settings.radius_search_unit}]]</span>
				</a>
				<a class="refine-search__item refine-search__item-radius" href="#" data-value="100">
					<span class="refine-search__value">100 [[{$GLOBALS.settings.radius_search_unit}]]</span>
				</a>
				<a class="refine-search__item refine-search__item-radius" href="#" data-value="200">
					<span class="refine-search__value">200 [[{$GLOBALS.settings.radius_search_unit}]]</span>
				</a>
			</div>
		</div>
	</div>
{/if}

{capture name="trLess"}[[Less]]{/capture}
{capture name="trMore"}[[More]]{/capture}
{if !empty($refineFields)}
	{capture name="urlParams"}searchId={$searchId|escape:'url'}&amp;action=refine{/capture}
	{foreach from=$refineFields item=refineField}
		{if $refineField.show && $refineField.count_results}
			<div class="refine-search__block clearfix">
				<span class="btn__refine-search">
					{assign var="field_caption" value=$refineField.caption|tr}
					{tr}Refine by $field_caption{/tr|escape}
				</span>
				<div class="refine-search__item-list collapse in clearfix" id="refine-block-{$refineField.field_name}">
					{foreach from=$refineField.search_result item=val name=fieldValue}
						{capture name="refineFieldCriteria"}{$refineField.field_name}{if in_array($refineField.type, array('string'))}[multi_like_and]{else}[multi_like]{/if}[]={if $val.sid}{$val.sid}{else}{$val.value|escape:'url'}{/if}{/capture}
						{if $smarty.foreach.fieldValue.iteration == 7}
							<div class="less-more" style="display: none">
						{/if}
						<a class="refine-search__item" href="?{$smarty.capture.urlParams}&amp;{$smarty.capture.refineFieldCriteria}">
							<span class="refine-search__value">{tr}{$val.value}{/tr|escape}</span>
							<span class="refine-search__count pull-right">{if empty($refineField.criteria)}&nbsp;{$val.count}{/if}</span>
						</a>
					{/foreach}
					{if $smarty.foreach.fieldValue.total >= 7}
						</div><a href="#" class="less-more__btn link">{$smarty.capture.trMore}</a>
					{/if}
				</div>
			</div>
		{/if}
	{/foreach}
{/if}
{if !$GLOBALS.is_ajax}
	<div id="refine-block-preloader"></div>
{/if}
{javascript}
	<script>
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