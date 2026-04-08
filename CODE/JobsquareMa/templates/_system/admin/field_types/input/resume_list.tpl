{if $id == "id_Resume_careerlevel"}
{assign var=totalCareerlevel value=0} 
{foreach from=$list_values item=list_value}
 
            		 
			 <span class="boxedSingleItem css-1gapyfo">
									<div id="Careerlevel{$totalCareerlevel}"tabindex="0" class="{if $list_value.id == $value}selected{/if}"  onclick="Setlevel({$totalCareerlevel},{$list_value.id})">
										<div class="panel-body">
											<p class="title">{tr mode="raw"}{$list_value.caption}{/tr|escape:'html'}</p>
											
										</div>
									</div>
								</span>
							
			 
				{assign var=totalCareerlevel value=$totalCareerlevel+1} 	
		     {if $list_value.id == $value}
			 {assign var=selectedval value=$list_value.id} 
			  {/if}		
{/foreach}
	
<input  name="{if $parentID}{$parentID}[{$id}]{else}{$id}{/if}" id="{if $parentID}{$parentID}[{$id}]{else}{$id}{/if}" type="hidden" value="{$selectedval}">
{javascript}
    <script  type="text/javascript">
	
	      function Setlevel(id,val) {                  
                  

				  var elem = document.getElementById('Careerlevel'+id);
				   elem.classList.remove("selected");
				   elem.classList.add("selected");
				   
				  for (i = 0; i < {$totalCareerlevel}	; i++) { 
                         var elem1 = document.getElementById('Careerlevel'+i);
						 if(i!=id)
						 {				 
						 
						 
				               elem1.classList.remove("selected");
						 }
				  
				   
					} 
				   document.getElementById('id_Resume_careerlevel').value=val;
           
                
          
        }
    </script>
{/javascript}
{elseif $id == "Experience"}
{assign var=totalExperience value=0} 
{foreach from=$list_values item=list_value}
 
            		 
			 <span class="boxedSingleItem css-1gapyfo">
									<div id="Experience{$totalExperience}"tabindex="0" class="{if $list_value.id == $value}selected{/if}"  onclick="SetExperience({$totalExperience},{$list_value.id})">
										<div class="panel-body">
											<p class="title">{tr mode="raw"}{$list_value.caption}{/tr|escape:'html'}</p>
											
										</div>
									</div>
								</span>
							
			 
				{assign var=totalExperience value=$totalExperience+1} 	
		     {if $list_value.id == $value}
			 {assign var=selectedval value=$list_value.id} 
			  {/if}		
{/foreach}
	
<input  name="{if $parentID}{$parentID}[{$id}]{else}{$id}{/if}" id="{if $parentID}{$parentID}[{$id}]{else}{$id}{/if}" type="hidden" value="{$selectedval}">
{javascript}
    <script  type="text/javascript">
	
	      function SetExperience(id,val) {                  
                  

				  var elem = document.getElementById('Experience'+id);
				   elem.classList.remove("selected");
				   elem.classList.add("selected");
				   
				  for (i = 0; i < {$totalExperience}	; i++) { 
                         var elem1 = document.getElementById('Experience'+i);
						 if(i!=id)
						 {				 
						 
						 
				               elem1.classList.remove("selected");
						 }
				  
				   
					} 
				   document.getElementById('Experience').value=val;
           
                
          
        }
    </script>
{/javascript}
	
	
	{else}


<select class="form-control" name="{if $parentID}{$parentID}[{$id}]{else}{$id}{/if}" {if $parentID && !$list_values && !$enabled} disabled="disabled" {/if} {if $parentID && $id == "Country"} onchange = "get{$parentID}States(this.value)" {/if} >
	{if $id !== 'email_frequency'}<option value="">[[Select]] {tr}{$caption}{/tr|escape:'html'}</option>{/if}
	{foreach from=$list_values item=list_value}
		<option value="{$list_value.id}" {if $list_value.id == $value}selected="selected"{/if} >{tr mode="raw"}{$list_value.caption}{/tr|escape:'html'}</option>
	{/foreach}
</select>
{/if}