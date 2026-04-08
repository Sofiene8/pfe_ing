{assign var="complexField" value=$id scope=global} {* nwy: Если не очистить переменную то в последующих полях начинаются проблемы (некоторые воспринимаются как комплексные)*}
<div id='complexFields_{$complexField}' class="complex">
    {foreach from=$complexElements key="complexElementKey" item="complexElementItem"}
            {if $complexElementKey != 1}
            <div id='complexFieldsAdd_{$complexField}_{$complexElementKey}' class="complex">
        {/if}
        {foreach from=$form_fields item=form_field}
            {if ($listing_type_id == "Job" || $listing.type.id == "Job") && $form_field.id =='ApplicationSettings'}
                <div class="form-group">
                    <label class="col-md-2 inputName control-label">
                        {tr}{$form_field.caption}{/tr|escape:'html'}{if $form_field.is_required}*{/if}
                    </label>
                    <div class="col-md-7 inputField">
                        {input property=$form_field.id template='applicationSettings.tpl' complexParent=$complexField complexStep=$complexElementKey}
                    </div>
                </div>
            {else}
                <div class="form-group">
                    <div class="col-md-2 inputName control-label">
                        {tr}{$form_field.caption}{/tr|escape:'html'}{if $form_field.is_required}*{/if}
                    </div>
                    <div class="col-md-7 inputField">
                        {input property=$form_field.id complexParent=$complexField complexStep=$complexElementKey}
                    </div>
                </div>
            {/if}
        {/foreach}
        {if $complexElementKey == 1}
            </div><div id='complexFieldsAdd_{$complexField}'>
        {else}
            <div class="form-group"><div class="col-md-7 col-md-offset-2"><a href='' class="btn btn--danger remove" onclick='removeComplexField_{$complexField}({$complexElementKey}); return false;' >[[Remove]]</a></div></div></div>
        {/if}
    {/foreach}
</div>
<div class="form-group form-gorup__complex">
    <div class="col-md-7 col-md-offset-2">
        {assign var="field_caption" value=$caption|tr}
        <a href='#' class="btn btn--secondary add" onclick='addComplexField_{$complexField}(); return false;' >[[Add {$field_caption|escape}]]</a>
    </div>
</div>

<script>

    var i_{$complexField} = {$complexElementKey} + 1;

    var dFormat = '{$GLOBALS.current_language_data.date_format}';
    dFormat = dFormat.replace('%m', "mm");
    dFormat = dFormat.replace('%d', "dd");
    dFormat = dFormat.replace('%Y', "yyyy");

    $('.form-control__visible').datepicker({
        language: '{$GLOBALS.current_language}',
        autoclose: true,
        format: 'mm.yyyy',
        startView: 1,
        minViewMode: 1,
        startDate: new Date(1940, 1 - 1, 1),
        endDate: '+10y',
    });

    $('.form-control__visible').on('change', function() {
        $(this).next().val($(this).data('datepicker').getFormattedDate(dFormat));
    });

    function addComplexField_{$complexField}() {
        tinymce.remove();
        var id = "complexFieldsAdd_{$complexField}_" + i_{$complexField};
        var oldField = $('#complexFields_{$complexField}');
		var oldMultiLists = oldField.find("select[multiple]").multiselect("destroy");

        var newField = oldField.clone();

        $("<div id='" + id + "' />").appendTo("#complexFieldsAdd_{$complexField}");
        newField.append('<div class="form-group"><div class="col-md-7 col-md-offset-2"><a class="remove btn btn--danger" href="" onclick="removeComplexField_{$complexField}(' + i_{$complexField} + '); return false;">[[Remove]]</a></div></div>');

        var str = newField.html();
        re = /\[1]/g;
        var newStr = str.replace(re, '['+i_{$complexField}+']');
        newField.html(newStr);
        newField.find('.inputField textarea').each(function(){
            $(this).val('');
        });
        newField.appendTo('#' + id);
        tinymce.init(tinyconfig);

		oldMultiLists.each(function() {
			var oldMultiListName = $(this).attr("name");
			var newMultiListName = oldMultiListName.replace('[1]', '['+i_{$complexField}+']');
			var multiListId = oldMultiListName.replace('{$complexField}[', '').replace('][1][]', '');
			var options = {
				selectedList: 3,
				selectedText: "# {tr}selected{/tr|escape}",
				noneSelectedText: "{tr}Click to select{/tr|escape}",
				checkAllText: "{tr}Select all{/tr|escape}",
				uncheckAllText: "{tr}Deselect all{/tr|escape}",
				header: true,
				height: 'auto',
				minWidth: 209
			};
			newField.find("select[name='" + newMultiListName + "']").val('').getCustomMultiList(options, multiListId, null);
			oldField.find("select[name='" + oldMultiListName + "']").getCustomMultiList(options, multiListId, null);
		});

        $('#' + id + ' input[type=text]').val('');
        $("#" + id + " .form-control__visible").next().val('');

        $('.form-control__visible').datepicker({
            language: '{$GLOBALS.current_language}',
            autoclose: true,
            format: 'mm.yyyy',
            startView: 1,
            minViewMode: 1,
            startDate: new Date(1940, 1 - 1, 1),
            endDate: '+10y'
        });

        $('.form-control__visible').on('change', function() {
            $(this).next().val($(this).data('datepicker').getFormattedDate(dFormat));
        });

        i_{$complexField}++;
    }

    function removeComplexField_{$complexField}(id) {
        $('#complexFieldsAdd_{$complexField}_' + id).remove();
    }
</script>

{assign var="complexField" value=false scope=global} {* nwy: Если не очистить переменную то в последующих полях начинаются проблемы (некоторые воспринимаются как комплексные)*}
