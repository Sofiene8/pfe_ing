{assign var="company_name" value=$userInfo.CompanyName}
{title}[[Jobs at $company_name]]{/title}
{description}[[Jobs at $company_name on $site_name]]{/description}


<div class="search-results col-xs-12 company-profile-info">
    <div class="company-profile-info__header">
        <div class="media-left listing-item__logo">
            <div class="listing-item__logo--wrapper">
                {if {display property='Logo' object_sid=$user_sid}}
                    {display property='Logo' object_sid=$user_sid}
                {else}
                    <div class="company__no-image"></div>
                {/if}
            </div>
        </div>
        <div class="media-body">
            <div class="media-heading listing-item__title">
                {$userInfo.CompanyName|escape}
            </div>
            <ul class="listing-item__info">
                {if $userInfo|location}
                    <li class="listing-item__info--item listing-item__info--item-location">
                        {$userInfo|location}
                    </li>
                {/if}
                {if $userInfo.WebSite}
                    <li class="listing-item__info--item listing-item__info--item-website">
                        <a href="{$userInfo.WebSite|escape}" target="_blank">
                            {$userInfo.WebSite|escape}
                        </a>
                    </li>
                {/if}
            </ul>
        </div>
    </div>
</div>
{javascript}
    <script>
        $(document).on('ready', function() {
            var website = $('.listing-item__info--item-website a');
            var href = website.attr('href');
            if (href && !href.match(/^http([s]?):\/\/.*/)) {
                website.attr('href', 'http://' + href);
            }
        });
    </script>
{/javascript}