{if $id == "modele_color"}
{assign var=totalColorModel value=0} 
{foreach from=$list_values item=list_value}
 
            		 
			 <span class="boxedSingleItem css-1gapyfo">
									<div id="ColorId{$totalColorModel}"tabindex="0" class="{if $list_value.id == $value}selected{/if}"  onclick="Setlevel({$totalColorModel},{$list_value.id})">
										<div class="panel-body">
											<p class="title">{tr mode="raw"}{$list_value.caption}{/tr|escape:'html'}</p>
											
										</div>
									</div>
								</span>
							
			 
				{assign var=totalColorModel value=$totalColorModel+1} 	
		     {if $list_value.id == $value}
			 {assign var=selectedval value=$list_value.id} 
			  {/if}		
{/foreach}
	
<input  name="{if $parentID}{$parentID}[{$id}]{else}{$id}{/if}" id="{if $parentID}{$parentID}[{$id}]{else}{$id}{/if}" type="hidden" value="{$selectedval}">
{javascript}
    <script  type="text/javascript">
	
	      function Setlevel(id,val) {                  
                  

				  var elem = document.getElementById('ColorId'+id);
				   elem.classList.remove("selected");
				   elem.classList.add("selected");
				   
				  for (i = 0; i < {$totalColorModel}	; i++) { 
                         var elem1 = document.getElementById('ColorId'+i);
						 if(i!=id)
						 {				 
						 
						 
				               elem1.classList.remove("selected");
						 }
				  
				   
					} 
				   document.getElementById('modele_color').value=val;
           
                
          
        }
    </script>
{/javascript}
