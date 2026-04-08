<style>
.container.container--small  {
    background: whitesmoke;
}

</style>
<div class="checkoutpage">
<h1 class="title__primary title__primary-small title__centered title__bordered">[[Checkout]]</h1>


	<div class="checkout-container {if 'banner_right_side'|banner}with-banner{/if}">
	<div class="row">
		<div class="sidebar col-xs-10 col-xs-offset-1 col-sm-offset-0">
			<div class="sidebar__content">
				<div class="checkout-sidebar__title form-group">
					<strong>[[Your order]]</strong>
				</div>
				<div class="checkout-product__name form-group">
					{foreach name="product_names_loop" item="product" from=$products}
						<strong class="checkout-product__title">[[{$product.name|paymentTranslate}]]</strong>{if !$smarty.foreach.product_names_loop.last}, {/if}
					{/foreach}
					<span class="pull-right checkout-product__price">
						{capture assign="subtotal"}{tr type="float"}{$product.price}{/tr}{/capture}
						{capture assign="product_price"}{tr type="float"}{$product.primaryPrice}{/tr}{/capture}
						<strong>{currencyFormat amount=$product_price}</strong>
					</span>
				</div>
				{if $promotionCodeInfo}
					<div class="text-right form-group">
						<a href="#" id="delete-promocode" class="checkout-sidebar__delete-discount"></a>
						{capture assign="promoCodeDiscount"}{tr type="float"}{$promotionCodeInfo.discount}{/tr}{/capture}
						{$promotionCodeInfo.code|escape} ({if $promotionCodeInfo.type == 'percentage'}{$promoCodeDiscount}%{else}{currencyFormat amount=$promoCodeDiscount}{/if}):
					<span style="color: #cc0000"> -
						<span>
							{capture assign="discountTotalAmount"}{tr type="float"}{$discountTotalAmount}{/tr}{/capture}
							{currencyFormat amount=$discountTotalAmount}
						</span>
					</span>
					</div>
				{/if}
				<div class="text-right form-group">
					[[Subtotal]]:
					{currencyFormat amount=$subtotal}
				</div>
				{if $tax.tax_amount}
					<p class="text-right form-group">
						[[Tax]]:
						{capture assign="tax"}{tr type="float"}{$tax.tax_amount}{/tr}{/capture}
						{currencyFormat amount=$tax}
					</p>
				{/if}
				<div class="text-right form-group">
					Timbre Fiscal:
						{capture assign="timbre"}{tr type="float"}1,000{/tr}{/capture}
					{currencyFormat amount=$timbre}
				</div>
				<div class="text-right form-group">
					[[Total]]:
					{capture assign="total"}{tr type="float"}{$total_price}{/tr}{/capture}
					<strong class="red">{currencyFormat amount=$total}</strong>
				</div>
			</div>
		</div>
	<div class="pull-left checkout">
		<form class="form" action="" method="post" enctype="multipart/form-data" name="shoppingCartForm" onsubmit="disableSubmitButton('shopping-cart__checkout');">
			<div class="form-group">
				<h3>[[How would you like to pay]] ?</h3>
				{foreach from=$gateways item="item" name="gateways"}
			<label>
					<input type="radio" id="payment-gateway__selector_{$item.id}"  name="gateway" value="{$item.id}" {if $selected_gateway == $item.id || $item.id=='smt'}checked="checked"{/if}>[[{$item.caption}]]</label>
					
				<!--<select name="gateway" id="payment-gateway__selector" class="form-control" >
						{foreach from=$gateways item="gateway" name="gateways"}
					
							<option value="{$gateway.id}" {if $selected_gateway == $gateway.id}selected="selected"{/if}>[[{$gateway.caption}]]</option>
						{/foreach}
					</select>-->
			{if $item.id eq 'smt'}
			<div class="cartes" id="cartes">
		<div class="paiement-block text-center">
			<!--s<h3>Paiement sécurisé</h3>-->
			
			<img  alt="visa" src="/templates/Jobsquare/assets/images/visa.png"> 
			<img alt="mastercard" src="/templates/Jobsquare/assets/images/mastercard.png"> 
			<img src="/templates/Jobsquare/assets/images/cib.png" alt="CIB"> 
			<img alt="master secure" src="/templates/Jobsquare/assets/images/master-secure.png"> 
			<img alt="verified visa" src="/templates/Jobsquare/assets/images/verified-by-visa.png"></div>
			</div>
			{/if}
			{/foreach}
			
			
				</div>

				<input type="hidden" name="action" value="checkout" />
				<input type="hidden" name="total_price" value="{$total_price}" />
				<input type="hidden" name="discount_total_amount" value="{$discountTotalAmount}" />

				{foreach from=$errors item=field_caption key=error}
					{if $error eq 'EMPTY_VALUE'}
						{assign var="field_caption" value=$field_caption|tr}
						<p class="alert alert-danger col-xs-12">[[Please enter '$field_caption']]</p>
					{elseif $error eq 'NOT_VALID'}
						<p class="alert alert-danger col-xs-12">[[{$field_caption}]]</p>
					{/if}
				{/foreach}
				{if $applied_products}
					<p class="alert alert-success col-xs-12">
						[[You have successfully applied your discount!]]<br/>
					</p>
					<p class="alert alert-info col-xs-12">
						[[You have received a discount of]]
						{if $code_info.type == 'percentage'}
							<strong>{$code_info.discount}%</strong>
						{else}
							{capture assign="discount"}{tr type="float"}{$code_info.discount}{/tr}{/capture}
							<strong>{currencyFormat amount=$discount}</strong>
						{/if}
					</p>
				{/if}
			<!--	{if $GLOBALS.settings.enable_promotion_codes == 1 && !$promotionCodeAlreadyUsed}
					<div class="form-group">
						<label for="inputPromotionCode" class="form-label">[[Discount code]]</label>
						<input type="text" name="promotion_code" id="inputPromotionCode" class="form-control" value="" />
						<input type="submit" name="applyPromoCode" value="[[Apply Discount]]" id="applyPromoCode" class="btn__apply-discount btn btn__blue" />
					</div>
				{/if}
-->
				<div class="form-group">
					<input class="btn btn-bleu" type="submit" id="shopping-cart__checkout" value="[[Place Order]]" />
				</div>
				
			
			
		</div>
			<div class="note" id="note" style="display:none">			
<p>Jobsquare offre la possibilité à ses clients d'utiliser le virement bancaire ou le versement Espèce pour valider leurs commandes.
</p>
<p>Dès que nous avons la confirmation que la somme due a bien été versée sur le compte, et qu'elle correspond exactement à votre commande, nous activons votre service.</p>

<p class="heavy"><u>Voici nos coordonnées :</u><br><br>
<strong>Nom : </strong> Skills Provider Square <br>
<strong>Domiciliation:</strong> Amen Bank El mourouj 4 Maroc<br>
<strong>RIB:</strong>  07 077 0135 101101853 45<br>
<strong>IBAN:</strong> TN 59 07 077 0135101101853 45<br>
<strong>Code BIC:</strong> CFCTTNTTXXX<br></p>

<p>Attention, le paiement par virement bancaire entraîne systématiquement un traitement minimum de trois jours. Si vous faites un virement depuis l'étranger, les frais de la transaction sont à la charge du client.</p>
<p>Afin de valider votre paiement, veuillez nous envoyer par email à l’adresse preuve.paiement@tanitoss.com votre preuve de paiement et indiquer votre N° de BC dans le sujet du mail. Les formats des pièces jointes acceptés sont : .pdf .png .gif .jpg et .bmp (6Mo maximum)</p>
				
				
				<div class="form-group pull-right">
					<input class="btn btn-bleu" type="submit" id="shopping-cart__checkout" value="Terminer votre commande" />
				</div>
				
				<div class="row">&nbsp;</div>
				</div>
				</form>
	</div>
</div>

{javascript}
	{foreach from=$gateways item="gateway"}
		{if $gateway.proceed_requirements}
			{$gateway.proceed_requirements}
		{/if}
	{/foreach}
	<script language="javascript" type="text/javascript">
		$(document).ready(function() {
			$('#delete-promocode').click(function(event) {
				event.preventDefault();
				$('input[name="action"]').val('deletePromoCode');
				$('form[name="shoppingCartForm"]').submit();
			});

			$('#shopping-cart__checkout').click(function(e) {
			var gateway = $('input:radio[name=gateway]:checked').val();
			//	var gateway = $('#payment-gateway__selector').val();
				{foreach from=$gateways item="gateway"}
					{if $gateway.proceed_script}
						if (gateway == '{$gateway.id}') {
							{$gateway.proceed_script}
							e.preventDefault();
						}
					{/if}
				{/foreach}
			});
		});
	/*	
	$('#payment-gateway__selector').on('change', function() {
	
				var gateway = $(this).val();
				
				if(gateway=='smt')
				{ 
			
				$('#note').hide();
				$('#cartes').show();
				}
				else if(gateway=='invoice'){
				$('#cartes').hide();
				$('#note').show();
				}
				
			});	
	*/
			$('input:radio[name=gateway]').on('click', function() {
	
				var gateway = $('input:radio[name=gateway]:checked').val();
				  
				if(gateway=='smt')
				{ 
		
				$('#note').hide();
				//$('#cartes').show();
				}
				else if(gateway=='invoice'){
				//$('#cartes').hide();
				$('input:radio[name=gateway][value="smt"]').attr('checked',false);
				
				$('#note').show();
				 $('html, body').animate({
    scrollTop: $("#note").offset().top
  }, 1000)
				}
				
			});	
	</script>
{/javascript}
</div>