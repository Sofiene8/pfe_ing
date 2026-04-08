{foreach item='error' from=$errors}
    {if $error == 'PRODUCT_IS_ONLY_ONCE_AVAILABLE'}
        <div class="alert alert-danger">[[You cannot subscribe for a Trial Product again because you have already subscribed for it.]]</div>
    {/if}
{/foreach}
{if $availableProducts}
    <h1 class="title__primary title__centered title__margin">
        {if $permission}
            [[Select Product]]
        {else}
            [[Pricing]]
        {/if}
    </h1>
    <div class="row product-items-wrapper {if 'banner_right_side'|banner}with-banner{/if}">
        {foreach from=$availableProducts item=product key=id name=pr}
            {assign var="wrongGroup" value=$GLOBALS.current_user.logged_in && $GLOBALS.current_user.user_group_sid != $product.user_group_sid}
            <div class="well product-item">
                <div class="product-item__content">
                    <h3 class="product-item__title">[[{$product.name|escape}]]</h3>
                    <div class="product-item__description content-text">
                        [[{$product.detailed_description}]]
                    </div>
                </div>
                {if !$listing_id && ($permission == 'post_job' || $permission == 'post_resume')}
                    <form method="post" action="{$GLOBALS.site_url}/add-listing/?listing_type_id={$product.listing_type_id}" class="form">
                        <input type="hidden" name="productSID" value="{$product.sid}" />
                        <input type="hidden" name="listing_type_id" value="{$product.listing_type_id}" />
                        <div class="form-group">
                            {capture assign="productPrice"}{tr type="float"}{$product.price}{/tr}{/capture}
                            <div class="product-item__price">
                                {currencyFormat amount=$productPrice} {if $product.recurring}[[per {$product.billing_cycle}]]{/if}
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <input type="submit" name="proceed_to_posting" value="[[Post a {$product.listing_type_id}]]" class="btn btn__blue"  {if $wrongGroup}disabled{/if} />
                        </div>
                    </form>
                {else}
                    <form method="post" action="" class="form">
                        <input type="hidden" name="action" value="view_product_detail" />
                        <input type="hidden" name="event" value="add_product" />
                        <input type="hidden" name="product_sid" value="{$product.sid}" />
                        <input type="hidden" name="listing_id" value="{$listing_id}" />
                        <div class="form-group">
                            {capture assign="productPrice"}{tr type="float"}{$product.price}{/tr}{/capture}
                            <div class="product-item__price">
                                {currencyFormat amount=$productPrice} {if $product.recurring}[[per {$product.billing_cycle}]]{/if}
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <input type="submit" value="[[Buy]]" class="btn btn__blue" {if $wrongGroup}disabled{/if} />
                        </div>
                    </form>
                {/if}
            </div>
        {/foreach}
    </div>
{else}
    <div class="alert alert-warning">
        {if $permission == 'post_job'}
            [[Sorry. You don't have permissions to post jobs.]]
        {elseif $permission == 'post_resume'}
            [[Sorry. You don't have permissions to post resume.]]
        {elseif $permission == 'resume_access'}
            [[Sorry. You don't have permissions to search resumes.]]
        {else}
            [[Sorry. There are no are no products available.]]
        {/if}
    </div>
{/if}