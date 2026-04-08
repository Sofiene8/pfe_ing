{breadcrumbs}
    <a href="{$GLOBALS.admin_site_url}/admins/">[[Site Admins]]</a> / [[Add New Admin]]
{/breadcrumbs}

<div class="page-title">
    <h1 class="title">[[Add New Admin]]</h1>
</div>

{include file='../users/field_errors.tpl'}
<div class="panel panel-default panel--max">
    <form method="post" enctype="multipart/form-data" class="panel-body form-horizontal">
        {set_token_field}
        <input type="hidden" name="save" value="true" />
        <input type="hidden" name="action" value="new" />
        {foreach from=$form_fields item=form_field}
            <div class="form-group">
                <label class="col-md-2 control-label">[[{$form_field.caption}]]{if $form_field.is_required}&nbsp;<span class="required">*</span>{/if}</label>
                <div class="col-md-7">
                    {input property=$form_field.id}
                </div>
            </div>
        {/foreach}
        <div class="form-group">
            <div class="col-md-7 col-md-offset-2">
                <input type="submit" id="apply" value="[[Send Invite]]" class="btn btn--primary" />
            </div>
        </div>
    </form>
</div>
