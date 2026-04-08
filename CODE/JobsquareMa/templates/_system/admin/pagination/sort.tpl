<tr>
	{if $paginationInfo.isCheckboxes == true}
		<th class="text-center">
			<label class="cr-styled">
				<input type="checkbox" id="all_checkboxes_control">
				<i class="fa"></i>
			</label>
		</th>
	{/if}
	{foreach  from=$paginationInfo.fields key=fieldKey item=fieldInfo}
		{if $fieldInfo.isVisible == true}
			<th class="sorting">
				{if $fieldInfo.isSort == false}
					[[{$fieldInfo.name}]]
				{else}
					<a href="?{if $paginationInfo.restore == 1}restore=1&amp;{/if}sortingField={$fieldKey}&amp;sortingOrder={if $paginationInfo.sortingOrder == 'ASC' && $paginationInfo.sortingField == $fieldKey}DESC{else}ASC{/if}&amp;itemsPerPage={$paginationInfo.itemsPerPage}&amp;page=1{if $paginationInfo.uniqueUrlParams}{if is_array($paginationInfo.uniqueUrlParams)}{foreach from=$paginationInfo.uniqueUrlParams key=id item=param}&{$id}={if $param.escape}{$param.value|escape:"{$param.escape}"}{else}{$param.value}{/if}{/foreach}{else}&{$paginationInfo.uniqueUrlParams}{/if}{/if}">
						[[{$fieldInfo.name}]]
						{if $paginationInfo.sortingField == $fieldKey}
							<div class="sorting-icons">
								{if $paginationInfo.sortingOrder == 'DESC'}
									<i class="fa fa-sort-amount-desc" aria-hidden="true"></i>
								{else}
									<i class="fa fa-sort-amount-asc" aria-hidden="true"></i>
								{/if}
							</div>
						{else}
							<div class="sorting-icons">
								<i class="fa fa-long-arrow-down" aria-hidden="true"></i>
								<i class="fa fa-long-arrow-up" aria-hidden="true"></i>
							</div>
						{/if}
					</a>
				{/if}
			</th>
		{/if}
	{/foreach}
</tr>