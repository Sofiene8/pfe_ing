{if $id  == "Motorized"}
<div id="btnMotorized" class="switch-button {if $value == 1}is-active{/if}" onclick="SetMotorized()">
							<div class="switch-button__container">
								<div class="switch-button__circle"></div>
							</div>
</div>
<input type="hidden" name="{$id}" id="{$id}" {if $value == 1}value="1"{else}value="0"{/if}  />

{javascript}
    <script  type="text/javascript">
	
	      function SetMotorized() {                  
                  

				  var elem = document.getElementById('btnMotorized');
				
				   		
                       
						 if(document.getElementById('Motorized').value==1)
						 {				 
						   elem.classList.remove("is-active");
				        
						      document.getElementById('Motorized').value=0;
						 }
						 else
					     {
							  elem.classList.remove("is-active");
				              elem.classList.add("is-active");
							    document.getElementById('Motorized').value=1;
						 }
				 
				
           
                
          
        }
    </script>
{/javascript}
{elseif $id  == "Licence"}

<div id="btnLicence" class="switch-button {if $value == 1}is-active{/if}" onclick="SetLicence()">
							<div class="switch-button__container">
								<div class="switch-button__circle"></div>
							</div>
</div>
<input type="hidden" name="{$id}" id="{$id}" {if $value == 1}value="1"{else}value="0"{/if}  />

{javascript}
    <script  type="text/javascript">
	
	      function SetLicence() {                  
                  

				  var elem = document.getElementById('btnLicence');
				
				   		
                       
						 if(document.getElementById('Licence').value==1)
						 {				 
						   elem.classList.remove("is-active");
				        
						      document.getElementById('Licence').value=0;
						 }
						 else
					     {
							  elem.classList.remove("is-active");
				              elem.classList.add("is-active");
							    document.getElementById('Licence').value=1;
						 }
				 
				
           
                
          
        }
    </script>
{/javascript}

	{else}

<div class="inline-block checkbox-field">
    <input type="hidden" class="{if $complexField}complexField{/if}" name="{if $complexField}{$complexField}[{$id}][{$complexStep}]{else}{$id}{/if}" value="0" />
    <input type="checkbox" class="inline-block {if $complexField}complexField{/if}" onchange="changeDate(this,{$complexStep},'{$complexField}');" name="{if $complexField}{$complexField}[{$id}][{$complexStep}]{else}{$id}{/if}" id="{$id}" {if $value}checked="checked" {/if} value="1" />
</div>
{/if}