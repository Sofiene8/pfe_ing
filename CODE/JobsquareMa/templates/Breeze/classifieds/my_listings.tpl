<h1 class="my-account-title title__primary title__centered">[[My Account]]</h1>
<div class="my-account-list">
    <ul class="nav nav-pills">
        {if $GLOBALS.current_user.group.id == "Employer"}
            {title}[[Job Postings]]{/title}
            <li class="presentation active"><a href="{$GLOBALS.site_url}/my-listings/{$listingTypeID|lower}/">[[Job Postings]]</a>
            </li>
            <li class="presentation"> <a href="{$GLOBALS.site_url}/system/applications/view/">[[Applicants]]</a></li>
            <li class="presentation"> <a href="{$GLOBALS.site_url}/edit-profile/">[[Company Profile]]</a></li>
        {else}
            {title}[[My Resumes]]{/title}
            <li class="presentation active"><a href="{$GLOBALS.site_url}/my-listings/{$listingTypeID|lower}/">[[My Resumes]]</a></li>
            <li class="presentation"> <a href="{$GLOBALS.site_url}/system/applications/view/">[[My Applications]]</a></li>
            <li class="presentation"> <a href="{$GLOBALS.site_url}/edit-profile/">[[Account Settings]]</a></li>
        {/if}
    </ul>
</div>
{if not $listings}
    <div class="search-results my-account-listings col-xs-12 {if $my_products}col-sm-9{else}my-account-listings-full{/if}">
        <div class="form-group__btn">
            {if $GLOBALS.current_user.group.id == "Employer"}
                <a href="{$GLOBALS.site_url}/add-listing/?listing_type_id=Job" class="btn btn__orange btn__bold">[[Post a Job]]</a>
            {else}
                <a href="{$GLOBALS.site_url}/add-listing/?listing_type_id=Resume" class="btn btn__orange btn__bold">[[Create New Resume]]</a>
            {/if}
        </div>
        <div class="alert alert-danger">[[You have no {$listingTypeID}s so far]]</div>
    </div>
{else}
    <div class="search-results my-account-listings col-xs-12 {if $my_products}col-sm-9{else}my-account-listings-full{/if}">
        <h3 class="has-left-postings search-results__title">
            {assign var="listings_number" value=$listing_search.listings_number}
            {if $GLOBALS.current_user.group.id == "Employer"}
                {$listings_number} [[Job Postings]]
            {else}
                [[You have $listings_number Resume(s)]]
            {/if}
        </h3>
        <div class="form-group__btn">
            {if $GLOBALS.current_user.group.id == "Employer"}
                <a href="{$GLOBALS.site_url}/add-listing/?listing_type_id=Job" class="btn btn__orange btn__bold">[[Post a Job]]</a>
            {else}
                <a href="{$GLOBALS.site_url}/add-listing/?listing_type_id=Resume" class="btn btn__orange btn__bold">[[Create New Resume]]</a>
            {/if}
        </div>

        <div class="col-xs-12">
            {foreach from=$listings item=listing name=listings_block}
                <article class="media well listing-item {if $listing.type.id eq 'Job'}listing-item__jobs{elseif $listing.type.id eq 'Resume'}listing-item__resumes{/if}">
                    <div class="media-body">
                        <div class="media-heading listing-item__title">
                            <a class="link" href="{$GLOBALS.site_url}/edit-{$listing.type.id|lower}/?listing_id={$listing.id}"><span class="strong">{$listing.Title|escape}</span></a>
                        </div>
                    </div>
                    <div class="media-right text-right hidden-xs-480">
                        <div class="listing-item__views">
                            {$listing.views} [[views]]
                        </div>
                        {if $GLOBALS.current_user.group.id == 'Employer'}
                            <div class="listing-item__applies">
                                {if $apps[$listing.id] || !$listing.application_redirects}
                                    {if !$apps[$listing.id]}
                                        0 [[applicants]]
                                    {else}
                                        <a href="{$GLOBALS.site_url}/system/applications/view/?appJobId={$listing.id}" class="link">
                                            {$apps[$listing.id]|default:"-"} [[applicants]]
                                        </a>
                                    {/if}
                                {/if}
                                {if $listing.application_redirects}
                                    {if $apps[$listing.id]}/{/if}
                                    {$listing.application_redirects} [[apply clicks]]
                                {/if}
                            </div>
                        {/if}
                    </div>
                    <div class="listing-item__info clearfix">
                        <div class="listing-item__info--item-date visible-xs-480">
                            <div class="listing-item__views">
                                {$listing.views} [[views]]
                            </div>
                            {if $GLOBALS.current_user.group.id == 'Employer'}
                                <div class="listing-item__applies">
                                    {if $apps[$listing.id] || !$listing.application_redirects}
                                        {if !$apps[$listing.id]}
                                            0 [[applicants]]
                                        {else}
                                            <a href="{$GLOBALS.site_url}/system/applications/view/?appJobId={$listing.id}" class="link">
                                                {$apps[$listing.id]|default:"-"} [[applicants]]
                                            </a>
                                        {/if}
                                    {/if}
                                    {if $listing.application_redirects}
                                        {if $apps[$listing.id]}/{/if}
                                        {$listing.application_redirects} [[apply clicks]]
                                    {/if}
                                </div>
                            {/if}
                        </div>
                        <span class="listing-item__info--item listing-item__info--status
                                    {if $listing.active|status == 'active'} listing-item__info--status-active
                                    {elseif $listing.active|status == 'pending'} listing-item__info--status-pending
                                    {elseif $smarty.now > $listing.expiration_date|strtotime}listing-item__info--status-no-active
                                    {else}listing-item__info--status-no-active{/if}
                                    ">
                            {if $listing.active|status == 'active'}
                                [[Active]]
                            {elseif $listing.active|status == 'pending'}
                                [[Pending Approval]]
                            {elseif $listing.expiration_date && $smarty.now > $listing.expiration_date|strtotime}
                                [[Expired]]
                            {else}
                                [[Hidden]]
                            {/if}
                        </span>
                        <div class="listing-item__info--item-date">
                            {$listing.activation_date|date} -
                            {capture assign="expDate"}{$listing.expiration_date|date}{/capture}
                            {if !empty($expDate)}{$expDate}{else}[[Never Expire]]{/if}
                        </div>
                    </div>
                </article>
            {/foreach}
        </div>
        <button type="button" class="load-more btn btn__white {if $listings_number <= $listing_search.listings_per_page}hidden{/if}" data-page="2">
            [[Load more]]
        </button>
    </div>
{/if}
{if $my_products}
    <div class="col-sm-3 col-xs-12 well my-account-products">
        <div class="profile__content">
            <h4>[[Purchased Products]]</h4>
            {foreach from=$my_products item=contract}
                <div class="contract-list" data-contract="{$contract.id}">
                    <div class="contract-list--name">
                        {$contract.product_info.name|escape}{if $contract.product_info.price} - {capture assign='contract_price'}{tr type='float'}{$contract.price}{/tr}{/capture}{currencyFormat amount=$contract_price}{/if} {if $contract.product_info.recurring}[[per {$contract.product_info.billing_cycle}]]{/if}
                    </div>
                    <div class="contract-list--purchased">[[Purchased]]: {$contract.creation_date|date}</div>
                    {if !$contract.product_info.recurring}
                        {if $contract.expired_date}<div class="contract-list--expires">[[Expires]]: {$contract.expired_date|date}</div>{/if}
                    {/if}
                    {if $contract.listingAmount}
                        {foreach item='stat' from=$contract.listingAmount}
                            <div class="contract-list--listing-count">[[{$stat.count}]]/{$stat.numPostings} [[{$listingTypeName|strtolower}s]] [[posted]]</div>
                        {/foreach}
                    {/if}
                    {if $contract.recurring}
                        {if $contract.recurring_status == 'active'}
                            <a href="#" class="contract-list--cancel link" data-toggle="modal" data-target="#confirm-cancel">[[Cancel]]</a>
                        {elseif $contract.recurring_status == 'canceled'}
                            <span class="label label-default">[[Canceled]]</span>
                        {/if}
                    {/if}
                </div>
            {/foreach}
        </div>
    </div>

    <div class="modal fade confirm-cancel" id="confirm-cancel" tabindex="-1" role="dialog" aria-labelledby="message-modal-label">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <div class="form">
                        <div class="form-group text-center">
                            [[Are you sure you'd like to cancel your subscription?]]
                        </div>
                        <div class="form-group form-group__btns text-center">
                            <a href="#" class="confirm-cancel__yes btn btn__orange btn__bold">
                                [[Yes]]
                            </a>
                            <button type="button" class="btn btn__white" data-dismiss="modal">[[Cancel]]</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{/if}
{javascript}
    <script type="text/javascript" language="JavaScript">
        var overall = {if $listings_number}{$listings_number}{else}0{/if};
        $('.load-more').click(function() {
            var self = $(this);
            self.addClass('loading');
            $.get('?searchId={$searchId}&action=search&page=' + self.data('page'), function(data) {
                self.removeClass('loading');
                var listings = $(data).find('.listing-item');
                if (listings.length) {
                    $('.listing-item').last().after(listings);
                    self.data('page', parseInt(self.data('page')) + 1);
                    if ($('.listing-item').length >= overall) {
                        self.hide();
                    }
                }
            });
        });
        $('.contract-list--cancel').click(function() {
            $('#confirm-cancel').data('contract', $(this).closest('.contract-list').data('contract'));
        });
        $('.confirm-cancel__yes').click(function() {
            window.location.href = SJB_UserSiteUrl + '/system/payment/cancel_recurring/?contract=' + $('#confirm-cancel').data('contract');
        });
    </script>
{/javascript}