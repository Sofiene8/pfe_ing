<article class="media well listing-item listing-item__jobs {if $listing.featured}listing-item__featured{/if} {if not $listing.user.Logo.file_url}listing-item__no-logo{/if}">
    <div class="media-left listing-item__logo">
        {if $listing.user.Logo.file_url}
            <a href="{$GLOBALS.site_url}{$listing|listing_url}" class="listing-item__logo--wrapper">
                <img class="media-object profile__img-company" src="{$listing.user.Logo.file_url}" alt="{$listing.user.CompanyName|escape:'html'}">
            </a>
        {/if}
    </div>
    <div class="media-body">
        <div class="listing-item__date">
            {$listing.activation_date|date}
        </div>
        <div class="media-heading listing-item__title {if $listing.featured}listing-item__featured-bg{/if}">
            <a href="{$GLOBALS.site_url}{$listing|listing_url}" class="link">{$listing.Title|escape}</a>
            {if $listing.featured}<span class="listing-item__title--featured pull-right">[[Featured]]</span>{/if}
        </div>
        <div class="listing-item__desc {if !$listing.JobDescription}no-description{/if}">
            {$listing.JobDescription|strip_tags}
        </div>
        <div class="listing-item__info clearfix">
            {if $listing.user.CompanyName}
                <span class="listing-item__info--item listing-item__info--item-company">
                    {$listing.user.CompanyName|escape:'html'}
                </span>
            {/if}
            {if $listing|location}
                <span class="listing-item__info--item listing-item__info--item-location">
                    {$listing|location}
                </span>
            {/if}
            {foreach from=$listing.EmploymentType item=list_value name="multifor"}
                {if $smarty.foreach.multifor.first && $list_value}
                    <span class="listing-item__info--item listing-item__info--item-employment-type">{tr}{$list_value}{/tr}</span>
                {/if}
            {/foreach}
        </div>
    </div>
</article>