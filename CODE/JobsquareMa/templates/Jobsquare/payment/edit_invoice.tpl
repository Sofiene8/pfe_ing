

<div class="container" style="margin-top:30px">
  <div class=" col-xs-12 col-md-3  mb-50">
    <nav class="sidebar"> <a class="sidebar__list-item {if $listingTypeID == 'job'}is-active {/if}"
                href="{$GLOBALS.site_url}/my-listings/job/" aria-current="page">[[Job Postings]]</a> <a class="sidebar__list-item {if $listingTypeID == 'training'} is-active {/if}"
                href="{$GLOBALS.site_url}/my-listings/training/">[[Training Postings]]</a> <a class="sidebar__list-item  {if $currentPage.order == 3}is-active {/if}"
                href="{$GLOBALS.site_url}/edit-profile/">Editer Mon Pofil</a> <a class="sidebar__list-item  {if $listingTypeID == 'resumes'}is-active {/if}"
                href="{$GLOBALS.site_url}/resumes/">Accès Cvthèque </a><a class="sidebar__list-item is-active " href="{$GLOBALS.site_url}/invoices/">Mes commandes </a> <a class="sidebar__list-item " href="{$GLOBALS.site_url}/recrutement/">Accompagnement RH ? </a>  </nav>
  </div>
  <div class="col-xs-12 col-sm-9">
  <h2 class="cmd-title">Mes Commandes</h2>
  
    <div class="panel panel-default panel--wide">
      <div class="panel-heading">
        <h3 class="panel-title">[[Commande# {$invoice_sid}]]  
          {if {display property="status"} == 'Unpaid'}
            <span class="badge rounded-pill bg-warning text-dark">En Attente de paiement</span>
          {elseif {display property="status"} == 'Paid'}
            <span class="badge rounded-pill bg-success">Payé</span>
            
              <a href="{$GLOBALS.site_url}/details-invoice/?sid={$invoice_sid}&download_pdf=1"
   class="pull-right text-right underline"
   onclick="showPdfLoading(this); return true;">
   <i class="fa fa-file-pdf-o"></i> Télécharger Facture
</a>
          
          {/if}
        </h3>
	    </div>
     <form method="post" method="post" enctype="multipart/form-data" class="panel-body" id="invoiceForm">
        <input type="hidden" name="action" value="save" id="action">
      <input type="hidden" name="sid" value="{$invoice_sid}"/>
        <div class="table-responsive">
          <table class="table table-clear table__invoice">
          {if $status == 'Paid'}
            <tr>
              <td class="text-left"><img src="{$GLOBALS.site_url}/img/Logo-tanitoss.png" class="text-left"></td>
              
              <td class="text-right">
              <small class="text-right"><strong>Tanit Online Services SARL</strong><br>
                Adresse : 01, Résidence EL Habib EL Mourouj 5, Ben Arous 2074<br>
                Email : chedly.elkhelifi@tanitoss.com<br>
                Tél : 79 493 684<br>
                MF : 973157/GAM000</small></td>
              
            </tr>
          {/if}

			<tr>
             <td colspan="2"><hr></td>
             
            </tr>
            <tr >
              <td class="text-right" colspan="2"><h2 class="text-right" style="color: #ee810b;">{if $status == 'Paid'}Facture {$invoice_number}</h2>{/if}
                <br>
                {display property="date"}</td>
            </tr>
            <tr >
              <td class="text-left" colspan="2"> {if $user}
                <p><strong> Client: <a href="{$GLOBALS.site_url}/edit-user/?user_sid={$user.sid}"> {if $user.CompanyName}{$user.CompanyName|escape}{else}{$user.FullName|escape}{/if} </a></strong> <br>
                  {if $user.GooglePlace} <strong>Adresse:</strong>{$user.GooglePlace|escape}
                  {/if} <br>
                  {if $user.Phone} <strong>MF:</strong>{$user.CommercialRegister|escape}
                  {/if} </p>
                {else} <span class="invoice-washy">[[User deleted]]</span> {/if} </td>
            </tr>
            <tr>
              <td colspan="2"><table class="details" width="100%" cellpadding="0" cellspacing="0">
                  <tr>
                    <th>Désignation</th>
                    
                    <th width="20%">Montant HT (DT)</th>
                  </tr>
                  <tr>
                    <td><strong>{$itemsname}</strong><br>
                    </td>
                 
                    <td align="right">{display property='sub_total' assign="subtotal"}{currencyFormat amount=$subtotal} </td>
                  </tr>
                </table></td>
            </tr>
            <tr>
              <td colspan="2"><table class="totals" align="right" cellpadding="0" cellspacing="0">
                  <tr>
                    <td>Total HT</td>
                    <td class="with_border bt-0" align="right">{display property='sub_total' assign="subtotal"}{currencyFormat amount=$subtotal} </td>
                  </tr>
                  <tr {if !$include_tax}class="hidden"{/if}>
                    <td>TVA (19%)</td>
                    <td class="with_border" align="right"> {capture assign='tax_amount'}{tr type='float'}{$tax.tax_amount}{/tr}{/capture} {currencyFormat amount=$tax_amount} </td>
                  </tr>
                  <tr>
                    <td>Timbre fiscal</td>
                    <td class="with_border" align="right">{currencyFormat amount=1} <sup>*</sup></td>
                  </tr>
                  <tr class="grand-total">
                    <td>Total TTC</td>
                    <td class="with_border bg_gris"  align="right"><strong>{assign var="total" value=$total}
                      
                      {currencyFormat amount=$total}</strong></td>
                  </tr>
                </table></td>
            </tr>
            <tr>
              <td colspan="2" class="text"> La présente facture est arrêtée à la somme de : <strong>{$totalWords}</strong><br><small>* Sauf erreur ou omission de notre part</small></td>
            </tr>



			<tr>
             <td colspan="2"><hr></td>
             
            </tr>

            {if $status == 'Paid'}
			      <tr>
              <td colspan="2" class="bg_orange text-center">Tanit Online Services SARL: 01 Résidence EL Habib EL Mourouj 5, Tél : 79 493 684,  MF : 973157/GAM000</td>
            </tr>
            {/if}
            
          </table>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
function showPdfLoading(link) {
    if (!link || link.dataset.loading === "1") {
        return;
    }

    link.dataset.loading = "1";
    link.dataset.originalHtml = link.innerHTML;

    link.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Génération...';
    link.style.pointerEvents = 'none';

    // Failsafe restore (in case user blocks download)
    setTimeout(function () {
        if (link.dataset.originalHtml) {
            link.innerHTML = link.dataset.originalHtml;
            link.style.pointerEvents = '';
            link.dataset.loading = "0";
        }
    }, 10000);
}
</script>
