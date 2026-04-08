	{if $id == "Country"}
	<input type="hidden" name="{if $parentID}{$parentID}[{$id}]{else}{$id}{/if}" id="country_name" value="{if $value}{$value}{else} Maroc{/if}"/>
	{elseif $id == "State"}
	<input type="hidden"  name="{if $parentID}{$parentID}[{$id}]{else}{$id}{/if}" id="state_name" value="{$value}"/>
{elseif $id == "ville"}
	<input id="city" value="{$ville}" class="city_hidden_value abc" type="hidden" name="{if $parentID}{$parentID}[{$id}]{else}{$id}{/if}">
		{/if}