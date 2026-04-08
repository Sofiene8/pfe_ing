<div class="btn-group admin-fields__permissions" data-toggle="buttons">
    <label class="btn btn-default {if !$value || $value == 'Full Admin Access'}active{/if}">
        <input type="radio" value="Full Admin Access" name="{$id}" autocomplete="off" {if !$value || $value == 'Full Admin Access'}checked{/if}> [[Full Admin Access]]
    </label>
    <label class="btn btn-default {if $value == 'Limited Access'}active{/if}">
        <input type="radio" value="Limited Access" name="{$id}" autocomplete="off" {if $value == 'Limited Access'}checked{/if}> [[Limited Access]]
    </label>
</div>

{javascript}
    <script>
        $(document).ready(function() {
            $('.admin-fields__permissions').find('input').change(function() {
                $(this).closest('.form-group').next('.form-group').toggle(
                    $(this).val() == 'Limited Access' && $(this).is(':checked')
                );
            }).change();
        });
    </script>
{/javascript}