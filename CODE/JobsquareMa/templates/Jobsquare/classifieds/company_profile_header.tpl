{assign var="company_name" value=$userInfo.CompanyName}
{title}[[offres d'emploi  $company_name Maroc]]{/title}
{description}[[offres d'emploi  $company_name sur $site_name en Maroc]], [[$company_name recrute en Maroc, Travail chez $company_name en Maroc]]{/description}
{keywords}[[offres d'emploi  $company_name Maroc]], [[Maroc recrutement $company_name]], [[Maroc travail $company_name]]{/keywords}

<div class="details-header page-detail-annonce">
    <div class="container">
	
			<div class="details-breadcrumbs">
				<p><a href="{$GLOBALS.site_url}/companies/" alt="Entreprises Maroc" title="Recruteurs Maroc">Entreprises Maroc</a> > 
						Recrutement {$userInfo.CompanyName|escape}</p>
			</div>
        <div class="results">
            <a href="javascript:history.go(-1)"
               class="btn__back">
                [[Back]]
            </a>
        </div>
		<div class="top-annonce">
		  <div class="left-top-annonce">
        <h1 class="details-header__title">Recrutement {$userInfo.CompanyName|escape}</h1>
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
		   <div class="clear"></div>
		   </div>
    </div>
</div>

{javascript}
    <script>
        $(document).on('ready', function() {
            var website = $('.listing-item__info--item-website a');
            var href = website.attr('href');
            if (href && !href.match(/^http([s]?):\/\/.*/)) {
                website.attr('href', 'https://' + href);
            }
        });
    </script>
{/javascript}