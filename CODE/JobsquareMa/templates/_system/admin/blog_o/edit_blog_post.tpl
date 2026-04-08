{breadcrumbs}
    <a href="{$GLOBALS.site_url}/blog/">[[Blog]]</a>
    / [[Edit Blog Post]]
{/breadcrumbs}
<div class="page-title">
    <h1 class="title">[[Edit Blog Post]]</h1>
    <div class="page-title__buttons">
        <a href="{$GLOBALS.user_site_url}/blog/{$postId}/{{display property = 'title'}|pretty_url}/" title="[[View]]" class="btn btn--bordered" target="_blank">[[View]]</a>
    </div>
</div>
{include file='../classifieds/field_errors.tpl'}
<div class="panel panel-default panel--max">
    <form method="post" action="" enctype="multipart/form-data" class="panel-body form-horizontal">
        <input type="hidden" name="id" value="{$postId}" />
        <input type="hidden" name="action" value="edit" />
        <input type="hidden" id="submit" name="form_submit" value="save_blog_post"/>
        {foreach from=$form_fields item=form_field}
            {if $form_field.id == 'image'}
                <div class="form-group">
                    <label class="col-md-2 control-label">[[{$form_field.caption}]]<span>&nbsp;{if $form_field.is_required}*{/if}</span></label>
                    <div class="col-md-7">{input property=$form_field.id template="picture_blog.tpl"}</div>
                </div>
            {else}
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
            {/if}
        {/foreach}
        <div class="form-group">
            <div class="col-md-7 col-md-offset-2">
                <input type="submit" name="form_submit" value="[[Save]]" class="btn btn--primary"/>
            </div>
        </div>
    </form>
</div>