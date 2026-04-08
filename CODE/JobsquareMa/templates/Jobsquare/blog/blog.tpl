<div class="posts-list">
    <div class="blog {if $categories}blog-with-categories{/if}">
        <div class="container container--small ">
            <div class="row">
                {capture name='blog_posts'}
                    {foreach from=$posts item='post'}
                        <article class="media well listing-item listing-item__blog {if not $post.image}listing-item__no-logo{/if}">
                            {if $post.image}
                                <div class="media-left listing-item__logo">
                                    <a href="{$GLOBALS.site_url}{$post|blog_url|escape}">
                                        <img class="media-object profile__img-company" src="{$post.image}" alt="{$post.title|escape}">
                                    </a>
                                </div>
                            {/if}
                            <div class="media-body">
                                <div class="media-heading listing-item__title">
                                    <a href="{$GLOBALS.site_url}{$post|blog_url|escape}" class="link">{$post.title|escape}</a>
                                </div>
                                <div class="listing-item__info clearfix">
                                <span class="blog__content--date">
                                    {$post.date|date}
                                </span>
                                </div>
                                <div class="listing-item__desc">
                                    {$post.text|strip_tags}
                                </div>
                            </div>
                        </article>
                    {/foreach}
                    {if $posts|@count == 10}
                        <button type="button" class="load-more btn btn__white" data-page="2">
                            [[Load more]]
                        </button>
                    {/if}
                {/capture}

                {if $categories}
				 {if !$current_category} 
				  <h1 class="title__primary title__primary-small title__centered title__bordered">[[Actualités emploi et conseils RH Maroc]]</h1>
				 {else}
				  <h1 class="title__primary title__primary-small title__centered title__bordered">[[ {foreach from=$categories item='category'}{if $current_category == $category@key}{$category|escape} {/if}{/foreach} ]]</h1>
				 {/if}
                   
                    <link rel="alternate" type="application/rss+xml" href="{$GLOBALS.site_url}/blog/rss/" title="[[Blog]]" />
                   <div  style="position: relative;
    margin: 0 25px 10px 0;
    font-weight: 500;">
               {if $current_category} <a href="{$GLOBALS.user_site_url}/blog/">Blog</a> {if $current_category} >    {foreach from=$categories item='category'}{if $current_category == $category@key}<a href="{$GLOBALS.user_site_url}/blog/{$category|pretty_url|escape}">{$category|escape}</a> {/if} {/foreach}{/if} {/if}
            </div>

				   <div class="col-sm-3 col-xs-12 pull-left">
                        <div class="blog__categories refine-search__block">
                            <h4>[[Actualités et conseils RH ]]</h4>
                            <div class="blog__categories__list blog__categories__list--desktop">
                                <a href="{$GLOBALS.user_site_url}/blog/" class="refine-search__item {if !$current_category}active{/if}">
                                    <span class="refine-search__value">[[Tous les articles]]</span>
                                </a>
                                {foreach from=$categories item='category'}
                                    <a class="refine-search__item {if $current_category == $category@key}active{/if}" href="{$GLOBALS.user_site_url}/blog/{$category@key|escape:'url'}/"><span class="refine-search__value">{$category|escape}</span></a>
                                {/foreach}
                            </div>
                            <div class="blog__categories__list blog__categories__list--mobile">
                                <select class="blog__categories__list--select">
                                    <option value="{$GLOBALS.user_site_url}/blog/" {if $current_category}{else}selected{/if}>[[Tous les articles]]</option>
                                    {foreach from=$categories item='category'}
                                        <option value="{$GLOBALS.user_site_url}/blog/{$category@key|escape:'url'}/" {if $current_category == $category@key}selected{/if}>{$category|escape}</option>
                                    {/foreach}
                                </select>
                            </div>
                        </div>

                        {*{if 'banner_right_side'|banner}*}
                            {*<div class="banner banner--right">*}
                                {*{'banner_right_side'|banner}*}
                            {*</div>*}
                        {*{/if}*}
                    </div>
                    <div class="col-sm-9 col-xs-12 pull-right">
                        {$smarty.capture.blog_posts}
                    </div>
                {else}
                    {*{if 'banner_right_side'|banner}*}
                        {*<div class="with-banner__wrapper">*}
                            {*<h1 class="title__primary title__primary-small title__centered title__bordered">[[Blog]]</h1>*}
                            {*<link rel="alternate" type="application/rss+xml" href="{$GLOBALS.site_url}/blog/rss/" title="[[Blog]]" />*}
                            {*{$smarty.capture.blog_posts}*}
                        {*</div>*}
                        {*<div class="banner banner--right">*}
                            {*{'banner_right_side'|banner}*}
                        {*</div>*}
                    {*{else}*}
                        <h1 class="title__primary title__primary-small title__centered title__bordered">[[Blog]]</h1>
                        <link rel="alternate" type="application/rss+xml" href="{$GLOBALS.site_url}/blog/rss/" title="[[Blog]]" />
                        {$smarty.capture.blog_posts}
                    {*{/if}*}
                {/if}
            </div>
        </div>
    </div>
</div>
{javascript}
    <script>
        $('.load-more').click(function() {
            var self = $(this);
            self.addClass('loading');
            $.get('?&page=' + self.data('page'), function(data) {
                self.removeClass('loading');
                var posts = $(data).find('.listing-item__blog');
                if (posts.length < 10) {
                    self.hide();
                }
                if (posts.length) {
                    $('.listing-item__blog').last().after(posts);
                    self.data('page', parseInt(self.data('page')) + 1);
                }
            });
        });
        $('.btn-secondary.dropdown-toggle').text($('.dropdown-menu .badge').text());
        var currentOption = $('.blog__categories__list--select option:selected').val();
        $('.blog__categories__list--select').on('change', function() {
            var newOption = $('.blog__categories__list--select option:selected').val();
            if (currentOption != newOption) {
                window.location = newOption;
            }
        })
    </script>
{/javascript}