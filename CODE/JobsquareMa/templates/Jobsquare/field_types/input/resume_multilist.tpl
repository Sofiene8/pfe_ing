{if $id == "EmploymentType"}
{assign var=totalEmptype value=0} 
 {assign var=selectedval value=""}
 {assign var=Isselectedval value=0}
 

{foreach from=$list_values item=list_value}
     
	 {foreach from=$value item=value_id }
			 
			 {if $list_value.id == $value_id}
				
					{if $selectedval == ""}
						   {assign var="selectedval" value=$value_id}  
						   
						
					{else}		
						 
						   {assign var="selectedval" value="`$selectedval`,`$value_id`"}   			
						 
					 
					
					{/if}
					  {assign var=Isselectedval value=1}
		
			{break}
			{else}
				   {assign var=Isselectedval value=0}		 
						 
			 {/if}
	 {/foreach}
             {if $Isselectedval ==1 }
                   
                   <button  id="Emptype{$totalEmptype}" type="button" role="checkbox" class="boxed-checkbox btn btn-lg"  aria-checked="true" >
								<span id="spanEmptype{$totalEmptype}"  class="css-hq5oth">{tr mode="raw"}{$list_value.caption}{/tr|escape:'html'}</span>
								<i size="20" style="margin-left: 10px;" class="css-tjx49 e19xi9jy0">
									<svg id="svgEmptype{$totalEmptype}" width="20" height="20" preserveAspectRatio="none" viewBox="0 0 24 24">
									  

									  <path fill="#0055D9" d="M18.933 7.438a.456.456 0 01.067.187.456.456 0 01-.067.188l-8.38 10c-.135.125-.236.187-.303.187-.112 0-.224-.052-.337-.156l-4.745-4.25-.1-.094A.456.456 0 015 13.312c0-.02.022-.072.067-.156l.068-.062a63.944 63.944 0 011.48-1.438c.135-.125.225-.187.27-.187.09 0 .202.062.336.187l2.692 2.438 6.731-8.031c.045-.042.112-.063.202-.063.067 0 .146.02.236.063l1.85 1.375z"></path>
  								


								</svg>
								</i>
							</button>
							
							{else}
							<button id="Emptype{$totalEmptype}" type="button" role="checkbox" class="boxed-checkbox btn btn-lg"  aria-checked="false">
								<span id="spanEmptype{$totalEmptype}" class="css-1lylxjf">{tr mode="raw"}{$list_value.caption}{/tr|escape:'html'}</span>
								<i size="20" style="margin-left: 10px;" class="css-tjx49 e19xi9jy0">
									<svg id="svgEmptype{$totalEmptype}" width="20" height="20" preserveAspectRatio="none" viewBox="0 0 24 24">
										<path fill="#4D6182" d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6z"></path>
									</svg>
								</i>
							</button>										
		
			{/if}
			
	
		<input  name="Emptypeval{$totalEmptype}" id="Emptypeval{$totalEmptype}" type="hidden" value="{$list_value.id}">
              	{assign var=totalEmptype value=$totalEmptype+1} 
			
{/foreach}
<input  name="{if $complexField}{$complexField}[{$id}][{$complexStep}]{else}{$id}{/if}" id="{if $complexField}{$complexField}[{$id}][{$complexStep}]{else}{$id}{/if}" type="hidden" value="{$selectedval}">
{for $foo=0 to {$totalEmptype}}
{javascript}
    <script  type="text/javascript">
	
	    $("#Emptype{$foo}" ).click(function() {
           
     var Strstr= document.getElementById('EmploymentType').value;
	 var values_selected = Strstr.split(',');
     var clickedval=document.getElementById('Emptypeval{$foo}').value;
	    if (Strstr) {
			Strstr="";
			
				
				for (var i = 0; i < values_selected.length; i++) {
                      if(clickedval!=values_selected[i])
					  {
						  if(Strstr)
						  {
							Strstr=Strstr+","+values_selected[i];
						  }
						  else
						  {
							  Strstr=values_selected[i];
						  }
					  
					  
					  }
					}
			
			
		}
					  if($("#Emptype{$foo}").attr('aria-checked') == 'true')
						{		
 					     
					
							$("#Emptype{$foo}").attr('aria-checked',false);
						    $("#Emptype{$foo}").removeClass('selected');
	               	        $("#spanEmptype{$foo}").removeClass('css-hq5oth');
						    $("#spanEmptype{$foo}").addClass('css-1lylxjf');
							 $("#svgEmptype{$foo}").replaceWith( "<svg id=\"svgEmptype{$foo}\" width=\"20\" height=\"20\" preserveAspectRatio=\"none\" viewBox=\"0 0 24 24\"><path fill=\"#4D6182\" d=\"M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6z\"></path></svg>" );	
					    	
						}
						else
						{
						
					        $("#Emptype{$foo}").attr('aria-checked',true);
							$("#Emptype{$foo}").addClass("selected");
						    $("#spanEmptype{$foo}").removeClass('css-1lylxjf');
						  $("#spanEmptype{$foo}").addClass('css-hq5oth');
							$("#svgEmptype{$foo}").replaceWith( "<svg id=\"svgEmptype{$foo}\" width=\"20\" height=\"20\" preserveAspectRatio=\"none\" viewBox=\"0 0 24 24\"><path fill=\"#0055D9\" d=\"M18.933 7.438a.456.456 0 01.067.187.456.456 0 01-.067.188l-8.38 10c-.135.125-.236.187-.303.187-.112 0-.224-.052-.337-.156l-4.745-4.25-.1-.094A.456.456 0 015 13.312c0-.02.022-.072.067-.156l.068-.062a63.944 63.944 0 011.48-1.438c.135-.125.225-.187.27-.187.09 0 .202.062.336.187l2.692 2.438 6.731-8.031c.045-.042.112-.063.202-.063.067 0 .146.02.236.063l1.85 1.375z\"></path></svg>" );	
						  
						  if (Strstr) {
								 Strstr=Strstr+","+clickedval;	
							}
							else
							{
								 Strstr=clickedval;	
							}
						}
	    document.getElementById('EmploymentType').value=Strstr;
	
			});
		
	
	 

 </script>
{/javascript}
	{/for}

{else}




<input type="hidden" name="{if $complexField}{$complexField}[{$id}][{$complexStep}]{else}{$id}{/if}" value=""/>
<select multiple="multiple" style="display: none;" class="form-control fieldType{$id} {if $complexField}complexField{/if}" name="{if $complexField}{$complexField}[{$id}][{$complexStep}][]{else}{$id}[]{/if}">
	{foreach from=$list_values item=list_value}
		<option  value="{$list_value.id}" {foreach from=$value item=value_id}{if $list_value.id == $value_id}selected="selected"{/if}{/foreach} >{tr mode="raw"}{$list_value.caption}{/tr|escape:"html"}</option>
	{/foreach}
</select>
{javascript}
<script type="text/javascript">
	$(document).ready(function() {
		var limit = {if !empty($choiceLimit)}{$choiceLimit}{else}null{/if};
		var name = "{if $complexField}{$complexField}[{$id}][{$complexStep}][]{else}{$id}[]{/if}";
		var fieldId = "{$id}";
		var options = {
			selectedList: 5,
			selectedText: "# {tr}selected{/tr|escape}",
			noneSelectedText: "{tr}Click to select{/tr|escape}",
			checkAllText: "",
			uncheckAllText: "",
			header: true,
			height: 'auto'
		};
		$("select[name='" + name + "']").getCustomMultiList(options, fieldId, limit);
	});
</script>
{/javascript}


	{/if}