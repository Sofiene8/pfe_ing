<form action="#" id="sps-payment-form" method="GET">
    <a id="sps_submit_button"  href="{$action}" class="btn btn-primary disabled" style="margin-left: 20%;margin-top: 10px;">{$callToAction}</a>
</form>

<script language="javascript">
    document.addEventListener("DOMContentLoaded", function(event) {

        var checkboxList = document.getElementsByName('conditions_to_approve[terms-and-conditions]');
        if (checkboxList.length > 0 ) {
            var checkbox = checkboxList[0];
            checkbox.addEventListener("change", toggleSubmit);
        }
        function toggleSubmit(){
            var isChecked = checkbox.checked;
            if(isChecked){
                document.getElementById("sps_submit_button").classList.remove("disabled");
            }else{
                document.getElementById("sps_submit_button").classList.add("disabled");
            }
        }
    });
</script>