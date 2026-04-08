{capture name="input_text_field_from"}
    <div class="quarter form-range">
        <div class="input-group">
            <span class="input-group-addon">[[from]]</span>
            <input type="text" name="{$id}[not_less]" value="{$value.not_less|date_format:{$GLOBALS.current_language_data.date_format}}" id="{$id}_notless" class="input__datepicker"/>
            <img class="ui-datepicker-trigger" src="{image}icon-calendar.svg" alt="..." title="...">
        </div>
    </div>
{/capture}
{capture name="input_text_field_to"}
    <div class="quarter form-range">
        <div class="input-group">
            <span class="input-group-addon">[[to]]</span>
            <input type="text" name="{$id}[not_more]" value="{$value.not_more|date_format:{$GLOBALS.current_language_data.date_format}}" id="{$id}_notmore" class="input__datepicker"/>
            <img class="ui-datepicker-trigger" src="{image}icon-calendar.svg" alt="..." title="...">
        </div>
    </div>
{/capture}

{assign var="input_text_field_from" value="`$smarty.capture.input_text_field_from`"}
{assign var="input_text_field_to" value="`$smarty.capture.input_text_field_to`"}
{$input_text_field_from} {$input_text_field_to}
<div class="col-xs-12">{$GLOBALS.current_language_data.date_format}</div>