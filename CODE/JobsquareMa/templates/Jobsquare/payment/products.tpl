<style>
.container.container--small  {
    background: whitesmoke;
}


.navbar {
    min-height: 50px;
   
}

.slogan {
    font-size: 10px;
    left: 20px;
    top: 30px;
    color: #c5c5c5;
}
 .navbar-brand {
    height: 42px;
    padding-left: 0;
}

.logo {
    margin-right: 0px !important;
    padding-top: 0px;
}

.navbar .container-fluid {
    
    margin-top: 0;
}

.navbar-right {
    float: right!important;
    margin-right: -15px;
    text-align: right;
    margin-top: 0;
}


.logo .logo__text img {
    max-height: 45px;
}
.navbar .navbar-right {
    margin-top: 0;
   
}
.pricing-page.training .product-item__title {
    color: #108a00!important;
}
.pricing-page.training .product-items-wrapper .product-item {
    border: 1px solid #108a00;
}
.pricing-page.training .product-item#div_31 {
    border: 1px solid #7fd992;
    background: #f5fff8;
}
.pricing-page.training .product-item#div_31 .product-item__description.content-text div:before {
   
    color:#7fd992;
  
}
.pricing-page.training .edito {
    border: 1px dashed #7fd992;
    background: #f5fff8;
}
</style>
<div class="pricing-page {if $permission == 'post_training'}training{/if}">
{foreach item='error' from=$errors}
    {if $error == 'PRODUCT_IS_ONLY_ONCE_AVAILABLE'}
        <div class="alert alert-danger">[[You cannot subscribe for a Trial Product again because you have already subscribed for it.]]</div>
    {/if}
{/foreach}
{if $availableProducts}
    <h1 class="title__primary title__primary-small title__centered title__margin title__bordered">
        {if $permission}
            [[Select Product]]
        {else}
            [[Products]]
        {/if}
    </h1>
<div id="my-account-title">
{if $GLOBALS.current_user.logged_in && $GLOBALS.current_user.user_group_sid != 36}
<div class="edito"><p>Employeurs, consultants, recruteurs et agences de placement Vous êtes les bienvenus sur notre portail d'emploi qui est <strong>simple, Sécurisé & très efficace.</strong><br>
  Pour <strong class="rouge">plus de visibilité</strong>, Jobsquare.ma vous offre la possibilité de <strong class="green">commander</strong> en ligne.</p>

 
		


<div class="paiement-block text-center">
					<!--s<h3>Paiement sécurisé</h3>-->
					
					<img  alt="visa" src="/templates/Jobsquare/assets/images/visa.png"> 
					<img alt="mastercard" src="/templates/Jobsquare/assets/images/mastercard.png"> 
					<img src="/templates/Jobsquare/assets/images/cib.png" alt="CIB"> 
					<img alt="master secure" src="/templates/Jobsquare/assets/images/master-secure.png"> 
					<img alt="verified visa" src="/templates/Jobsquare/assets/images/verified-by-visa.png">
					
		</div>
  </div>
  {/if}
    <div class="row product-items-wrapper {if 'banner_right_side'|banner}with-banner{/if}">
        {foreach from=$availableProducts item=product key=id name=pr}
            {assign var="wrongGroup" value=$GLOBALS.current_user.logged_in && $GLOBALS.current_user.user_group_sid != $product.user_group_sid}
			
			
			
		
			  {foreach from=$my_products item=my_product}
				{if $product.sid==$my_product.product_info.sid && $product.price le 0.00}
				
				{assign var="my_product" value=1}
				{break}
				{/if}
			{/foreach}
		
		{if $my_product!=1}
			{if !$wrongGroup&&$product.sid!=17&&$product.sid!=22&&$product.sid!=26&&$product.sid!=38}
				{if $packs == 1}
				{if !$listing_id && ($permission == 'post_job')}
				{if $product.sid==28||$product.sid==29||$product.sid==30}
				<div class="well product-item" id="div_{$product.sid}">
                <div class="product-item__content">
                    <h3 class="product-item__title">[[{$product.name|escape}]]</h3>
                    <div class="product-item__description content-text">
                        [[{$product.detailed_description}]]
                    </div>
                </div>
                {if !$listing_id && ($permission == 'post_job' || $permission == 'post_resume')}
			  
                
				 <form method="post" action="" class="form">
				  <input type="hidden" name="action" value="view_product_detail" />
                        <input type="hidden" name="event" value="add_product" />
                        <input type="hidden" name="product_sid" value="{$product.sid}" />
                        <input type="hidden" name="listing_id" value="{$listing_id}" />
				 
						
                        <div class="form-group">
                            {capture assign="productPrice"}{tr type="float"}{$product.price}{/tr}{/capture}
                            <div class="product-item__price">
                               {if $product.price>0.00} {currencyFormat amount=$productPrice} {if $product.recurring}<span>[[per {$product.billing_cycle}]]</span>{/if}<sup>HT</sup>{else}Gratuit{/if}
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <input type="submit" name="proceed_to_posting" value="{if $product.price>0.00}[[Buy]]{else}[[Post a {$product.listing_type_id}]]{/if}" {if $product.price>0.00}  class="btn-vert" {else} class="btn-bleu" {/if}  {if $wrongGroup}disabled{/if} />
                        </div>
                    </form>
             
                {/if}
            </div>
			
				{elseif !$listing_id && ($permission == 'post_training')}
				{if $product.sid==31}
				<div class="well product-item" id="div_{$product.sid}">
                <div class="product-item__content">
                    <h3 class="product-item__title">[[{$product.name|escape}]]</h3>
                    <div class="product-item__description content-text">
                        [[{$product.detailed_description}]]
                    </div>
                </div>
              	{if !$listing_id && ($permission == 'post_training')}
                    <form method="post" action="" class="form">
                        <input type="hidden" name="action" value="view_product_detail" />
                        <input type="hidden" name="event" value="add_product" />
                        <input type="hidden" name="product_sid" value="{$product.sid}" />
                        <input type="hidden" name="listing_id" value="{$listing_id}" />
                        <div class="form-group">
                            {capture assign="productPrice"}{tr type="float"}{$product.price}{/tr}{/capture}
                            <div class="product-item__price">
                            {if $product.price>0.00} {currencyFormat amount=$productPrice} {if $product.recurring}<span>[[per {$product.billing_cycle}]]</span>{/if}<sup>HT</sup>{else}Gratuit{/if}
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <input type="submit" 
							value="{if $product.price>0.00}[[Buy]]{else}[[Post a {$product.listing_type_id}]]{/if}" 
							{if $product.price>0.00}  class="btn-vert" {else} class="btn-bleu" {/if} {if $wrongGroup}disabled{/if} 
							
							/>
                        </div>
                    </form>
                {/if}
            </div>
				{/if}

				{/if}
				{/if}
				{else}
			<div class="well product-item" id="div_{$product.sid}">
                <div class="product-item__content">
                    <h3 class="product-item__title">[[{$product.name|escape}]]</h3>
                    <div class="product-item__description content-text">
                        [[{$product.detailed_description}]]
                    </div>
                </div>
                {if !$listing_id && ($permission == 'post_job' || $permission == 'post_resume')}
			  
                
				 <form method="post" action="" class="form">
				  <input type="hidden" name="action" value="view_product_detail" />
                        <input type="hidden" name="event" value="add_product" />
                        <input type="hidden" name="product_sid" value="{$product.sid}" />
                        <input type="hidden" name="listing_id" value="{$listing_id}" />
				 
						
                        <div class="form-group">
                            {capture assign="productPrice"}{tr type="float"}{$product.price}{/tr}{/capture}
                            <div class="product-item__price">
                               {if $product.price>0.00} {currencyFormat amount=$productPrice} {if $product.recurring}<span>[[per {$product.billing_cycle}]]</span>{/if}<sup>HT</sup>{else}Gratuit{/if}
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <input type="submit" name="proceed_to_posting" value="{if $product.price>0.00}[[Buy]]{else}[[Post a {$product.listing_type_id}]]{/if}" {if $product.price>0.00}  class="btn-vert" {else} class="btn-bleu" {/if}  {if $wrongGroup}disabled{/if} />
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
                            {if $product.price>0.00} {currencyFormat amount=$productPrice} {if $product.recurring}<span>[[per {$product.billing_cycle}]]</span>{/if}<sup>HT</sup>{else}Gratuit{/if}
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <input type="submit" 
							value="{if $product.price>0.00}[[Buy]]{else}[[Post a {$product.listing_type_id}]]{/if}" 
							{if $product.price>0.00}  class="btn-vert" {else} class="btn-bleu" {/if} {if $wrongGroup}disabled{/if} 
							
							/>
                        </div>
                    </form>
                {/if}
            </div>
			{/if}
			{/if}
			{/if}
				{assign var="my_product" value=0}
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

</div>