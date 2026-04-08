{breadcrumbs}
    <a href="{$GLOBALS.site_url}/blog/">[[Blog]]</a>
    / [[Edit Blog Post]]
{/breadcrumbs}
<div class="page-title">
    <h1 class="title">[[Edit Blog Post]]</h1>
    <div class="page-title__buttons">
        {*<a href="{$GLOBALS.user_site_url}{$post_info|blog_url|escape}" title="[[View]]" class="btn btn--bordered" target="_blank">[[View]]</a>*}
    </div>
</div>
{include file='../classifieds/field_errors.tpl'}
<div class="panel panel-default panel--max">
    <form method="post" action="" enctype="multipart/form-data" class="panel-body form-horizontal">
        <input type="hidden" name="id" value="{$post_info.sid}" />
        <input type="hidden" name="action" value="edit" />
        <input type="hidden" id="submit" name="form_submit" value="save_blog_post"/>

        <div class="form-group">
            <label class="col-md-2 control-label">[[Title]]<span class="required">&nbsp;*</span></label>
            <div class="col-md-7">
                {input property='title'}
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">[[Content]]</label>
            <div class="col-md-7">
                {*{input property='text' template='text_tall.tpl'}*}
                {input property='text' template='text.tpl'}
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">[[Categories]]</label>
            <div class="col-md-7">
                {input property='categories'}
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">[[Image]]</label>
            <div class="col-md-7">{input property='image' template="picture_blog.tpl"}</div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">[[Date]]</label>
            <div class="col-md-7">
                <div class="quarter">
                    {input property='date'}
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">[[Active]]</label>
            <div class="col-md-7">
                {input property='active'}
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">[[URL]]</label>
            <div class="col-md-7">
                {input property='url'}
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">[[Meta Description]]</label>
            <div class="col-md-7">
                {input property='description'}
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">[[Meta Keywords]]</label>
            <div class="col-md-7">
                {input property='keywords'}
            </div>
        </div>
        {*<div class="form-group">*}
            {*<label class="col-md-2 control-label"></label>*}
            {*<div class="col-md-7">*}
                {*<div class="panel-group" id="accordion">*}
                    {*<input name="list_visible" type="hidden" value="{if $smarty.request.list_visible || in_array('Blog post with such url already exists', $errors)}visible{/if}" />*}
                    {*<div class="panel panel-default panel--max panel--seo">*}
                        {*<div class="panel-heading">*}
                            {*<h4 class="panel-title">*}
                                {*<a data-toggle="collapse" data-parent="#accordion" href="#accordion__panel" {if !$smarty.request.list_visible || !in_array('Blog post with such url already exists', $errors)}aria-expanded="false" class="collapsed"{else}aria-expanded="true"{/if}>*}
                                    {*[[SEO Settings]]*}
                                {*</a>*}
                            {*</h4>*}
                        {*</div>*}
                        {*<div id="accordion__panel" class="panel-collapse collapse {if $smarty.request.list_visible || in_array('Blog post with such url already exists', $errors)}in{/if}">*}
                            {*<div class="panel-body">*}
                                {**}
                            {*</div>*}
                        {*</div>*}
                    {*</div>*}
                {*</div>*}
            {*</div>*}
        {*</div>*}
        <div class="form-group">
            <div class="col-md-7 col-md-offset-2">
                <input type="submit" name="form_submit" value="[[Save]]" class="btn btn--primary"/>
            </div>
        </div>
    </form>
</div>

{javascript}
    <script>
        $(document).ready(function() {
            $('#accordion')
                .on('hide.bs.collapse', function () {
                    $('input[name="list_visible"]').val('');
                })
                .on('show.bs.collapse', function () {
                    $('input[name="list_visible"]').val('visible');
                });
        });
    </script>
{/javascript}