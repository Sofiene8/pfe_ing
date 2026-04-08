{if $profiles}
	<section class="main-sections main-sections__featured-companies">
        <div class="featured-companies featured-companies__wrapper">
            <h4 class="featured-companies__title">[[Featured Companies]]</h4>
            <ul class="featured-companies__slider">
                {foreach from=$profiles item=profile name=profile_block}
                    <li class="featured-company clearfix">
                        <a href="{$GLOBALS.site_url}/company/{$profile.id}/{$profile.CompanyName|pretty_url}/" title="{$profile.CompanyName|escape}" class="clearfix">
                            <div class="pull-left">
                                <div class="featured-company__logo ">
                                    <div class="featured-company__image--wrapper">
                                        {if $profile.Logo.thumb_file_url}
                                            <img class="media-object featured-company__image" src="{$profile.Logo.thumb_file_url}" alt="{$profile.WebSite}" title="{$profile.CompanyName|truncate:23}"/>
                                        {else}
                                            <div class="company__no-image" title="{$profile.CompanyName}"></div>
                                        {/if}
                                    </div>
                                </div>
                            </div>
                            <div class="featured-company__info pull-right clearfix">
                                <div class="featured-companies__name" title="{$profile.CompanyName}">
                                    {$profile.CompanyName}
                                </div>
                                <div class="featured-companies__jobs">
                                    {assign var="jobs_number" value=$profile.countListings}
                                    [[$jobs_number job(s)]]
                                </div>
                            </div>
                        </a>
                    </li>
                {/foreach}
            </ul>
        </div>
	</section>
{/if}