
{if $id == "gouvernorat"}

<select class="form-control"  name="{if $parentID}{$parentID}[{$id}]{else}{$id}{/if}" id="state"  >
	{if $id !== 'email_frequency'}<option value="">[[Select]] {tr}{$caption}{/tr|escape:'html'}</option>{/if}
	{foreach from=$states item=list_value}
	
		<!--<option value="{$list_value.id}" {if $list_value.id == $value}selected="selected"{/if} >{tr mode="raw"}{$list_value.caption}{/tr|escape:'html'}</option>-->
<option value="{$list_value.sid}" {if $list_value.sid== $gouvernorat}selected="selected"{/if} >{tr mode="raw"}{$list_value.name}{/tr|escape:'html'}</option>
	{/foreach}
</select>
{elseif $id == "pays"}
<select class="form-control" name="{if $parentID}{$parentID}[{$id}]{else}{$id}{/if}" id="country" >
	<!--{if $id !== 'email_frequency'}<option value="">[[Select]] {tr}{$caption}{/tr|escape:'html'}</option>{/if}-->
	{foreach from=$countries item=list_value}
		<!--<option value="{$list_value.id}" {if $list_value.id == $value}selected="selected"{/if} >{tr mode="raw"}{$list_value.caption}{/tr|escape:'html'}</option>-->
<option value="{$list_value.sid}" {if $list_value.sid == $pays}selected="selected"{/if} >{tr mode="raw"}{$list_value.name}{/tr|escape:'html'}</option>
	{/foreach}
</select>


{else}

<select class="form-control" name="{if $parentID}{$parentID}[{$id}]{else}{$id}{/if}" {if $parentID && !$list_values && !$enabled} disabled="disabled" {/if} {if $parentID && $id == "Country"}onchange = "get{$parentID}States(this.value)"{/if} >
	{if $id !== 'email_frequency'}<option value="">[[Select]] {tr}{$caption}{/tr|escape:'html'}</option>{/if}
	{foreach from=$list_values item=list_value}
		<!--<option value="{$list_value.id}" {if $list_value.id == $value}selected="selected"{/if} >{tr mode="raw"}{$list_value.caption}{/tr|escape:'html'}</option>-->
<option value="{$list_value.caption}" {if $list_value.caption == $value}selected="selected"{/if} >{tr mode="raw"}{$list_value.caption}{/tr|escape:'html'}</option>
	{/foreach}
</select>
{/if}


{javascript}
<script type="text/javascript">
$('#state').on('change', function() {
var state_name = $("#state option:selected").text();
$('#state_name').val(state_name);
  
});
$('#country').on('change', function() {
  //alert( this.value );
 var country_name = $("#country option:selected").text();
$('#country_name').val(country_name);
});
</script>
{/javascript}


