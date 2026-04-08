
{assign var="complexField" value='items' scope=global} {* nwy: Если не очистить переменную то в последующих полях начинаются проблемы (некоторые воспринимаются как комплексные)*}
	<tr>
		<td colspan="4"></td>
	</tr>
	<tr>
		<th class="text-left invoice__th">[[Item]]</th>
		<th class="text-left invoice__th">[[Price]]</th>
	</tr>

	{foreach from=$complexElements key="complexElementKey" item="complexElementItem"}
		<tr id='complexFields_{$complexField}'>
			{foreach from=$form_fields item=form_field}
				{if $form_field.id == 'products'}
					<td class="text-left invoice__td">
						{if $value.names.$complexElementKey}
							{$value.names.$complexElementKey}
						{else}
							{display property=$form_field.id complexParent=$complexField complexStep=$complexElementKey template="items_list.tpl"}
						{/if}
					</td>
				{elseif $form_field.id != 'custom_info' && $form_field.id != 'qty' && $form_field.id != 'price'}
					<td class="text-left">
						{display property=$form_field.id complexParent=$complexField complexStep=$complexElementKey assign="item_amount"} {currencyFormat amount=$item_amount}
					</td>
				{/if}
			{/foreach}
		</tr>
	{/foreach}

{assign var="complexField" value=false scope=global} {* nwy: Если не очистить переменную то в последующих полях начинаются проблемы (некоторые воспринимаются как комплексные)*}
