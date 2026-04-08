{if $id=='listing_alert_mesage'}

<input id="message_id" value="{$value}" class="message_hidden_value abc" type="hidden" name="message_id">
<input id="{if $parentID}{$parentID}_{$id}{else}{$id}{/if}" type="text" value="{$value}" class="messageSelection inputString {if $complexField}complexField{/if}" name="{if $complexField}{$complexField}[{$id}][{$complexStep}]{elseif $parentID}{$parentID}[{$id}]{else}{$id}{/if}" onkeypress="getmessagesList(this);"/>

{/if}
{javascript}
<script type="text/javascript">
function getmessagesList(id) {

    // Auto complete
    var options = {
        minLength: 0,
        source: function( request, response ) {
            var message = $(id).val();
			//var message_sid =$("#listing_alert_mesage option:selected").val();
			
			//var state_sid = $('#state').value;
			//alert("gggggggggg"+message);
		/*	 $.post('', {
                'action': 'autocompleteCities',
                'city_name': city_name,
                'state_sid':state_sid,
            },*/
       $.ajax( {
         
          method: 'post',
          dataType: "json",
          data: {
		   'action': 'autocompleteMessages',
            term: request.term,
            'message':message,
          },
          success: function( data ) {
		  
            response( data );

          }
        });
      },
       focus: function( event, ui ) {
		    $(this).parent().parent().find(".message_hidden_value").val(ui.item.value); 
           $(this).val(ui.item.label);
           return false;
       },
       select: function( event, ui ) {
            $(this).parent().parent().find(".message_hidden_value").val(ui.item.value); 
            $(this).val(ui.item.label);

            $(this).unbind("change");
            return false;
       }
   }

   $('body').on('keypress.autocomplete', '.messageSelection', function() {
       $(this).autocomplete(options);
   });

}
</script>
{/javascript}
