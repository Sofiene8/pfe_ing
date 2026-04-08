{*{debug}*}
<div class="sj-job-card{if $listing.featured} sj-featured{/if}" id="{$listing.id}">
    {if $listing.featured}
        <span class="sj-badge-new">NEW</span>
    {/if}

    {if $listing.featured == 1 || $listing.user.featured == 1}
        <div class="sj-card-logo">
            {if $listing.user.Logo.file_url}
                <a href="{$GLOBALS.site_url}{$listing|listing_url}?backPage={$pageForBackButton}&searchID={$searchId}">
                    <img src="{$listing.user.Logo.file_url}" alt="{$listing.user.CompanyName|escape:'html'}">
                </a>
            {else}
                {$listing.user.CompanyName|escape:'html'|truncate:4:"":true|upper}
            {/if}
        </div>
    {/if}

    <div class="sj-card-content">
        <div class="sj-card-title">
            <a href="{$GLOBALS.site_url}{$listing|listing_url}?backPage={$pageForBackButton}&searchID={$searchId}">
                {$listing.Title|escape}
            </a>
        </div>

        <div class="sj-card-company">
            <a href="{$GLOBALS.site_url}{$listing|listing_url}?backPage={$pageForBackButton}&searchID={$searchId}">
                {$listing.user.CompanyName|escape:'html'}
            </a>
            {if $listing|location}
                <span class="sj-sep">&middot;</span>
                {$listing|location}
            {/if}
        </div>

        <div class="sj-card-desc">
            {$listing.JobDescription|strip_tags|truncate:250:"..."}
        </div>

        <div class="sj-card-tags">
            {if $listing|location}
                <span class="sj-card-tag sj-loc">{$listing|location}</span>
            {/if}
            {foreach from=$listing.EmploymentType item=list_value name="multifor"}
                {if $smarty.foreach.multifor.first && $list_value}
                    <span class="sj-card-tag sj-type">{tr}{$list_value}{/tr}</span>
                {/if}
            {/foreach}
        </div>
    </div>

    <div class="sj-card-right">
        <span class="sj-card-date">
            {if !$listing.featured}{$listing.activation_date|date}{/if}
        </span>
        <a href="{$GLOBALS.site_url}{$listing|listing_url}?backPage={$pageForBackButton}&searchID={$searchId}" class="sj-card-btn">
            Voir Plus
        </a>
    </div>
</div>