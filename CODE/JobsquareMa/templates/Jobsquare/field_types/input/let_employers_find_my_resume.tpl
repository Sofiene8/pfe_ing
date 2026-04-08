{if $id  == "access_type"}
<div id="btnaccess_type" class="switch-button {if $value == 'everyone'}is-active{/if}" onclick="SetAccessType()">
							<div class="switch-button__container">
								<div class="switch-button__circle"></div>
							</div>
</div>
<input type="hidden" name="{$id}" id="{$id}" {if $value == 'everyone'}value="everyone"{else}value="no_one"{/if}  />

{javascript}
    <script  type="text/javascript">
	
	      function SetAccessType() {                  
                  

				  var elem = document.getElementById('btnaccess_type');
				
				   		
                       
						 if(document.getElementById('access_type').value=='everyone')
						 {				 
						   elem.classList.remove("is-active");
				        
						      document.getElementById('access_type').value='no_one';
						 }
						 else
					     {
							  elem.classList.remove("is-active");
				              elem.classList.add("is-active");
							    document.getElementById('access_type').value='everyone';
						 }
				 
				
           
                
          
        }
    </script>
{/javascript}
{else}

<div class="inline-block checkbox-field">
    <input type="hidden" name="{$id}" value="no_one" />
    <input type="checkbox" class="inline-block" name="{$id}" id="{$id}" {if $value == 'everyone'}checked="checked" {/if} value="everyone" />
</div>

{/if}