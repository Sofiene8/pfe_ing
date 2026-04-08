{breadcrumbs}
    <a href="{$GLOBALS.site_url}/blog/">[[Blog]]</a> / [[Add Blog Post]]
{/breadcrumbs}

<div class="page-title">
    <h1 class="title">[[Add Blog Post]]</h1>
</div>

{include file='../classifieds/field_errors.tpl'}
<div class="panel panel-default panel--max">
    <form method="post" action="" enctype="multipart/form-data" class="panel-body form-horizontal">
        <input type="hidden" name="action" value="add" />
        <input type="hidden" name="form_submit" value="add_blog_post" />
        {foreach from=$form_fields item=form_field}
            <div class="form-group">
                <label class="col-md-2 control-label">[[{$form_field.caption}]]<span class="required">&nbsp;{if $form_field.is_required}*{/if}</span></label>
                <div class="col-md-7">
                    {if $form_field.id == 'date'}
                        <div class="quarter">
                            {input property=$form_field.id}
                        </div>
                    {else}
                        {input property=$form_field.id}
                    {/if}
                </div>
            </div>
        {/foreach}
        <div class="form-group">
            <div class="col-md-7 col-md-offset-2">
                <input type="submit" name="form_submit" value="[[Save]]" class="btn btn--primary"/>
            </div>
        </div>
    </form>
</div>
