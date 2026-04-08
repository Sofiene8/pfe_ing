<input type="text" value="{$value}" class="inputString {$id}" name="{$id}" id="{$id}" />
<script>
    function initService() {
        var input = /** @type {!HTMLInputElement} */(document.getElementById('{$id}'));
        var options = {
            componentRestrictions: {
                {if $GLOBALS.settings.location_limit}
                    country: '{$GLOBALS.settings.location_limit}'
                {/if}
            }
        };
        $(input).change(function() {
		//alert($('#{$id}').val());
			var location=$('#{$id}').val();
			var res = location.split(", ");
			var country="Maroc";
			var city="";
			var state="";
			if(res.length==1)
			{
				if(res[0].trim()=="Maroc" || res[0].trim()=="maroc" )
				{
					city="Casablanca";
					state="";
					country="Maroc";
				}
				else{
					city=res[0].trim();
					state="";
					country="Maroc";
				}
			}
			else if(res.length==2)
			{
				if(res[1].trim()=="Maroc" || res[1].trim()=="maroc" )
				{
					city=res[0].trim();
					state="";
					country="Maroc";
				}
				else{
					city=res[0].trim();
					state=res[1].trim();
					country="Maroc";	
				}
				
			}
			else if(res.length>=3){
					city=res[0].trim();
					state=res[1].trim();
					country=res[2].trim();
				
			}
            document.getElementById('City').value =city;
            document.getElementById('Country').value =country;
            document.getElementById('ZipCode').value ='';
            document.getElementById('State').value =state;
            document.getElementById('Latitude').value ='';
            document.getElementById('Longitude').value = '';
        });
      /*  var autocomplete = new google.maps.places.Autocomplete(input, options);
        autocomplete.addListener('place_changed', function() {
		
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                window.alert("Autocomplete's returned place contains no geometry");
                return;
            }
            // Get each component of the address from the place details
            // and fill the corresponding field on the form.
            for (var i = 0; i < place.address_components.length; i++) {
                var addressType = place.address_components[i].types[0];
                var val = place.address_components[i]['long_name'];
                switch (addressType) {
                    case 'locality':
                        document.getElementById('City').value = val;
                        break;
                    case 'country':
                        document.getElementById('Country').value = val;
                        break;
                    case 'postal_code':
                        document.getElementById('ZipCode').value = val;
                        break;
                    case 'administrative_area_level_1':
                        document.getElementById('State').value = val;
                        break;
                }
            }
            document.getElementById('Latitude').value = place.geometry.location.lat();
            document.getElementById('Longitude').value = place.geometry.location.lng();
        });*/
        $('#{$id}').keydown(function (e) {
            if (e.which == 13 && $('.pac-container:visible').length) {
                return false;
            }
        });
    }
</script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={$GLOBALS.settings.google_api_key}&libraries=places&callback=initService&language={$GLOBALS.current_language}" async defer></script>