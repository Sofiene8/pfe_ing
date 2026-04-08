<!--<select class="searchList {if $complexField}complexField{/if}" name="{if $complexField}{$complexField}[{$id}][{$complexStep}]{elseif $parentID}{$parentID}[{$id}]{else}{$id}{/if}" id="{if $complexField}{$complexField}[{$id}][{$complexStep}]{elseif $parentID}{$parentID}[{$id}]{else}{$id}{/if}" {if ($parentID && !$list_values && !$enabled) || $disable} disabled="disabled" {/if} {if $parentID && $id == "Country"} onchange = "get{$parentID}States(this.value)" {/if} >
	-->
	<select class="searchList {if $complexField}complexField{/if}" name="{if $complexField}{$complexField}[{$id}][{$complexStep}]{else}{$id}{/if}" id="{if $complexField}{$complexField}[{$id}][{$complexStep}]{elseif $parentID}{$parentID}[{$id}]{else}{$id}{/if}" {if ($parentID && !$list_values && !$enabled) || $disable} disabled="disabled" {/if} {if $parentID && $id == "Country"} onchange = "get{$parentID}States(this.value)" {/if} >

	{if $listingFieldInfo.parent_sid && ($listingFieldInfo.id == 'Country' || $listingFieldInfo.id  == 'State') && $id == 'display_as'}
	{elseif $userFieldInfo.parent_sid && ($userFieldInfo.id == 'Country' || $userFieldInfo.id  == 'State') && $id == 'display_as'}
	{else}
		<option value="">[[Select]] {$caption|escape}</option>
	{/if}
	{foreach from=$list_values item=list_value}
		<!--<option value='{$list_value.id}' {if $list_value.id == $value || (!$value && $list_value@first && !$is_required)}selected="selected"{/if} >{tr}{$list_value.caption}{/tr|escape}</option>-->
		<option value='{$list_value.id}' {if $list_value.id == $value}selected="selected"{/if} >{tr}{$list_value.caption}{/tr|escape}</option>
	{/foreach}
</select>
