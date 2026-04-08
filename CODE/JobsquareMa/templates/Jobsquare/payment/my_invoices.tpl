
<div class="container" style="margin-top:30px">
  <div class=" col-xs-12 col-md-3  mb-50">
    <nav class="sidebar"> <a class="sidebar__list-item {if $listingTypeID == 'job'}is-active {/if}"
                href="{$GLOBALS.site_url}/my-listings/job/" aria-current="page">[[Job Postings]]</a> <a class="sidebar__list-item {if $listingTypeID == 'training'} is-active {/if}"
                href="{$GLOBALS.site_url}/my-listings/training/">[[Training Postings]]</a> <a class="sidebar__list-item  {if $currentPage.order == 3}is-active {/if}"
                href="{$GLOBALS.site_url}/edit-profile/">Editer Mon Pofil</a> <a class="sidebar__list-item  {if $listingTypeID == 'resumes'}is-active {/if}"
                href="{$GLOBALS.site_url}/resumes/">Accès Cvthèque </a><a class="sidebar__list-item is-active " href="{$GLOBALS.site_url}/invoices/">Mes commandes </a> <a class="sidebar__list-item " href="{$GLOBALS.site_url}/recrutement/">Accompagnement RH ? </a> </nav>
  </div>
  <div class="col-xs-12 col-sm-9">
  <h2 class="cmd-title">Mes Commandes</h2>
    <div class="panel">
      <div class="table-responsive my_invoices_list">
        <table class="table table-striped with-bulk">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Date</th>
              <th scope="col">Offre</th>
              <th scope="col">Etat</th>
              <th scope="col">Détail</th>
            </tr>
          </thead>
          <tbody>
          
          {foreach from=$found_invoices item=invoice name=invoices_block}
          <tr>
            <th scope="row">{$invoice@iteration}</th>
            <td>{display property='date' object_sid=$invoice.sid}</td>
            <td class="td-wide"> {if $invoice.user}
              
              
              {$invoice.products}
              {/if} </td>
            <td> {if $invoice.status == 'Paid'} <span class="badge rounded-pill bg-success">Payé</span> {else} <span class="badge rounded-pill bg-warning text-dark">En Attente de paiement</span> {/if} </td>
            <td><span class="label_detail"><a href="{$GLOBALS.site_url}/details-invoice/?sid={$invoice.sid}">Détail</a> </span></td>
          </tr>
          {/foreach}
            </tbody>
          
        </table>
      </div>
    </div>
  </div>
</div>
