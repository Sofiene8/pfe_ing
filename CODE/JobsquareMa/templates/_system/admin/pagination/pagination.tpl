{capture name="urlParams"}{if is_array($paginationInfo.uniqueUrlParams)}{foreach from=$paginationInfo.uniqueUrlParams key=id item=param}&amp;{$id}={if $param.escape}{$param.value|escape:"{$param.escape}"}{else}{$param.value}{/if}{/foreach}{else}&amp;{$paginationInfo.uniqueUrlParams}{/if}
{/capture}
<div class="items-count"><strong>{$paginationInfo.itemsCount}</strong> [[{$paginationInfo.item|escape} found]]</div>

<div class="pagination__right">
	<div class="number-per-page">
		<select id="itemsPerPage" name="itemsPerPage" onchange="window.location = '?{if $paginationInfo.restore == 1}restore=1{/if}{if $paginationInfo.sortingField ne null}&amp;sortingField={$paginationInfo.sortingField}{/if}{if $paginationInfo.sortingOrder ne null}&amp;sortingOrder={$paginationInfo.sortingOrder}{/if}&amp;page=1{if $paginationInfo.uniqueUrlParams}{$smarty.capture.urlParams}{/if}&amp;itemsPerPage=' + this.value;" class="per-page">
			{foreach from=$paginationInfo.numberOfElementsPageSelect item=numberOfElement}
				<option value="{$numberOfElement}" {if $paginationInfo.itemsPerPage == $numberOfElement}selected{/if}>{$numberOfElement}</option>
			{/foreach}
		</select>
		[[per page]]
	</div>

	{if count($paginationInfo.pages) != 1}
		<ul class="pagination">
			{if $paginationInfo.currentPage == 1}
				<li class="none">
					<a href="#">&nbsp;<i class="fa fa-angle-left"></i></a>
				</li>
			{else}
				<li>
					<a class="arrow-left"  href="?{if $paginationInfo.restore == 1}restore=1{/if}&amp;page={$paginationInfo.currentPage-1}&amp;itemsPerPage={$paginationInfo.itemsPerPage}{if $paginationInfo.uniqueUrlParams}{$smarty.capture.urlParams}{/if}">
						&nbsp;<i class="fa fa-angle-left"></i>
					</a>
				</li>
			{/if}
			{foreach from=$paginationInfo.pages item=page}
				{if $page == $paginationInfo.currentPage}
					<li class="active">
						<a href="#">{$page}</a>
					</li>
				{else}
					{if $page == $paginationInfo.totalPages && $paginationInfo.currentPage < $paginationInfo.totalPages-3} <li><span>...</span></li> {/if}
					<li><a href="?page={$page}{if $paginationInfo.restore == 1}&amp;restore=1{/if}{if $paginationInfo.sortingField ne null}&amp;sortingField={$paginationInfo.sortingField}{/if}{if $paginationInfo.sortingOrder ne null}&amp;sortingOrder={$paginationInfo.sortingOrder}{/if}&amp;itemsPerPage={$paginationInfo.itemsPerPage}{if $paginationInfo.uniqueUrlParams}{$smarty.capture.urlParams}{/if}">{$page}</a></li>
					{if $page == 1 && $paginationInfo.currentPage > 4} <li><span>...</span></li> {/if}
				{/if}
			{/foreach}


			{if $paginationInfo.currentPage == $paginationInfo.totalPages}
				<li>
					<a href="#">&nbsp;<i class="fa fa-angle-right"></i></a>
				</li>
			{else}
				<li>
					<a class="arrow-right" href="?{if $paginationInfo.restore == 1}restore=1{/if}&amp;page={$paginationInfo.currentPage + 1}&amp;itemsPerPage={$paginationInfo.itemsPerPage}{if $paginationInfo.uniqueUrlParams}{$smarty.capture.urlParams}{/if}">
						&nbsp;<i class="fa fa-angle-right"></i>
					</a>
				</li>
			{/if}
		</ul>
	{/if}
</div>

{if $layout == 'header'}
	<div id="actionWarning" style="display: none"></div>
{/if}
