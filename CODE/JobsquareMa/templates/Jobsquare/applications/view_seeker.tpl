<script src="https://use.fontawesome.com/7e203bcaaf.js"></script>
{title}[[My Applications]]{/title}
{capture assign='trListingTypeName'}Resumes{/capture}
</div>

<div class="container container--small suivie_reponse ">
<div class="row">
<div class=" col-xs-12 col-md-3 mt-30">
 <nav class="sidebar" >
       <a class="sidebar__list-item " href="{$GLOBALS.site_url}/my-listings/resume">[[My Resumes]]</a>
       <a class="sidebar__list-item is-active" href="{$GLOBALS.site_url}/system/applications/view/">[[My Applications]]</a>
      <a class="sidebar__list-item " href="{$GLOBALS.site_url}/edit-profile/">[[Account Settings]]</a>
    </nav>
</div>
<div class="search-results my-account-listings  col-md-9 col-xs-12 ">
    {if $applications}
        {foreach item=application from=$applications name=applications}
            <article class="joblist-for-resume-profile media well listing-item {if $listing.type.id eq 'Job'}listing-item__jobs{elseif $listing.type.id eq 'Resume'}listing-item__resumes{/if}">
                
				{assign var="expiration_date" value=$application.job.expiration_date|date_format:"%d/%m/%y"}
					{assign var="date_now" value= $smarty.now|date_format:"%d/%m/%y"}
                <div class="col-md-8">
				
				
				{if $application.resumeInfo.Photo.file_url}
                    <div class="media-left listing-item__logo">
                        <a href="{$GLOBALS.site_url}{$listing|listing_url}">
                            <img class="media-object" src="{$application.resumeInfo.Photo.file_url}" />
                        </a>
                    </div>
					
                {/if}
                    <div class="media-heading job-title">
					
                        <a href="{$GLOBALS.site_url}{$application.job|listing_url}">{$application.job.Title|escape}</a>
                    </div>
                    <div class="listing-item__date visible-xs-480">[Applied]]: {$application.date|date}</div>
                    <div class="listings-application-info clearfix">
                        <div><span class="name-c">
                            {$application.company.CompanyName|escape}
                        </span>
                        {if $application.job|location}
                            <span class="job-location">
                                , {$application.job|location|escape}
                            </span>
                        {/if}
						</div>
					
						<div class="listing-item__views">
							Vu par :<span class="orange"> {$application.job.views}</span>{if $application.job.views==1} personne {else} personnes{/if}
						</div>
						<div class="listing-item__applies">
						
								{if $application.candidats}
									{if !$application.candidats}
										<span class="orange">0</span> [[applicants]]
									{else}
										
											{if $application.candidats==1}
											<span class="orange">{$application.candidats|default:"-"}</span> candidat a participé
											{else}
											<span class="orange">{$application.candidats|default:"-"}</span> [[applicants]] ont participé
											{/if}
										
									{/if}
								{/if}
								
							</div>
                    </div>
                </div>
                <div class="text-right col-md-4">
					<div>
						{if {$application.job.id_Job_Vacancies|intval}>1}
											<span class="red">{$application.job.id_Job_Vacancies|intval}</span> postes ouverts<br />
											{else}
											<span class="red">1</span> poste ouvert<br />
											
											{/if}
											
							</div>
                    <div class="listing-item__date">Postulé le: {$application.date|date}</div>
					
				
					{if $expiration_date}
					
					{if $smarty.now|date_format:"%Y/%m/%d %H:%M" > $application.job.expiration_date|date_format:"%Y/%m/%d %H:%M" }<span class="red">Offre cloturé</span>
					{else}

					{if $application.status}
					<div class="etat">	{if ($application.job.user.featured == 1 || $application.job.featured == 1)&& $application.status eq 'Disqualifié'}&nbsp;{else}Etat de candidature:{/if}{if $application.status eq 'Nouveau'} <span class="orange"> En attente</span> {elseif $application.status eq 'Sélectionné' || $application.status eq 'Interview'} <span class="vert"> Pré-Sélectionné</span>{elseif $application.status eq 'Disqualifié'}{if $application.job.user.featured == 1 || $application.job.featured == 1}&nbsp;{else}<span class="red"> Disqualifié</span>{/if}{else} {$application.status}{/if}</div>
					{/if}
					{/if}
					{else}
					{if $application.status}
						 <div class="etat">	{if ($application.job.user.featured == 1 || $application.job.featured == 1)&& $application.status eq 'Disqualifié'}&nbsp;{else}Etat de candidature:{/if}{if $application.status eq 'Nouveau'} <span class="orange"> En attente</span> {elseif $application.status eq 'Sélectionné' || $application.status eq 'Interview'} <span class="vert"> Pré-Sélectionné</span>{elseif $application.status eq 'Disqualifié'}{if $application.job.user.featured == 1 || $application.job.featured == 1}&nbsp;{else}<span class="red"> Disqualifié</span>{/if}{else} {$application.status}{/if}</div>
						 {/if}
						 {/if}
							
						</div>
            </article>
        {/foreach}
    {else}
        <div id="applicants-list">
            <div class="alert alert-danger">
                [[You haven't applied to any job yet.]]
            </div>
        </div>
    {/if}
</div></div>
{javascript}
    <script>
        function modifyNote(noteId, url) {
            $.get(url, function(data) {
                $("#formNote_" + noteId).html(data);
                $("#trNote_" + noteId).css("display", "table-row").css("border-bottom","1px solid #B2B2B2");
                $("#trAppl_" + noteId).css("border-bottom","0px");
                $("#tdCheckbox_" + noteId).attr("rowspan", "2");
            });
        }

        function showCoverLetter(id) {
            message('[[Cover letter]]', $("#coverLetter_" + id).text());
        }

        $(document).ready(function() {
            $('.nav-pills').scrollLeft($('.nav-pills').width() / 2);
        });
    </script>
{/javascript}