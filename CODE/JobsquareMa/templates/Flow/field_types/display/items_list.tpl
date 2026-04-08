{if $names.$complexStep}
	{$names[$complexStep]}
{else}
	{foreach from=$products item=list_value}
		{if $list_value.sid == $value}
			{tr}{$list_value.name}{/tr}
		{/if}
	{/foreach}
{/if}
