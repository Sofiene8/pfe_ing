{title}
{$post.title}
{/title}
{keywords}
{$post.keywords}
{/keywords}
{description}
{if $post.description}
    {$post.description}
{else}
    {$post.text|strip_tags|truncate:165}
{/if}
{/description}

<div class="container container--small {if 'banner_right_side'|banner}with-banner{/if}">


 <a href="{$GLOBALS.user_site_url}/blog/" class="blog__back btn__back">[[Back]]</a>
        <h1 class="title__primary title__primary-small title__centered title__bordered">{$post.title|escape}</h1>
		<br><br>
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
       
        <div class="static-pages content-text static-pages__blog">

            <div  style="position: relative;
    margin: 0 25px 10px 0;
    font-weight: 500;">
                <a href="{$GLOBALS.user_site_url}/blog/">Blog</a> {if $post.breadcrumbsCategories}> {foreach from=$post.breadcrumbsCategories item=category}<a href="{$GLOBALS.user_site_url}/blog/{$category|pretty_url|escape}">{$category|escape}</a>{break} {/foreach}{/if} > {$post.title|escape}
            </div>
            <div class="blog__content--date">
                {$post.date|date}
            </div>
            {if $post.image}
                <div class="blog__content--image">
                    <img src="{$post.image}" />
                </div>
            {/if}
            {$post.text}

            <div class="social-share">
            <span class="social-share__title">
                [[Share]]:
            </span>
                <div class="social-share__icons">
                    <span class='st_facebook_large' displayText='Facebook'></span>
                    <span class='st_twitter_large' displayText='Tweet'></span>
                    <span class='st_googleplus_large' displayText='Google +'></span>
                    <span class='st_linkedin_large' displayText='LinkedIn'></span>
                    <span class='st_pinterest_large' displayText='Pinterest'></span>
                    <span class='st_email_large' displayText='Email'></span>
                </div>
            </div>
			
			
			<strong>Ces articles peuvent vous intéresser ...</strong>				
            {javascript}
                <script>
                    $.get('{$GLOBALS.user_site_url}/blog/{$post.breadcrumbsCategories[1]|pretty_url|escape}', function(data) {
                        var listings = $(data).find('.listing-item').slice(0,3);
                        if (listings.length) {
                            $('.static-pages__blog').after(listings);
                        }
                    });
                </script>
            {/javascript}
    </div>
    {if 'banner_right_side'|banner}
        <div class="banner banner--right">
            {'banner_right_side'|banner}
        </div>
    {/if}
</div></div>
{literal}
    <script type="text/javascript">var switchTo5x=true;</script>
    <script type="text/javascript" src="https://ws.sharethis.com/button/buttons.js"></script>
    <script type="text/javascript">stLight.options({publisher: "3f1014ed-afda-46f1-956a-a51d42078320", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
{/literal}