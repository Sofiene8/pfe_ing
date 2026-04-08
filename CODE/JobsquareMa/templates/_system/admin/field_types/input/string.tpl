<!--<input type="text" value="{$value}" class="inputString {$id} {if $complexField}complexField{/if}" name="{if $complexField}{$complexField}[{$id}][{$complexStep}]{elseif $parentID}{$parentID}[{$id}]{else}{$id}{/if}" id="{$id}" {if $id=='id_Job_MotsCls'} data-role="tagsinput"{/if} /> 
-->
<input type="text" value="{$value}" class="inputString {$id} {if $complexField}complexField{/if}" name="{if $complexField}{$complexField}[{$id}][{$complexStep}]{else}{$id}{/if}" id="{$id}" {if $id=='id_Job_MotsCls'} data-role="tagsinput"{/if} /> 

