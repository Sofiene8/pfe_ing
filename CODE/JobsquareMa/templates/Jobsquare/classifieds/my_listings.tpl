<script src="https://use.fontawesome.com/7e203bcaaf.js"></script>
{if $GLOBALS.current_user.group.id != "Employer"}

 <div class="container my-listing-header-block hidden-content" style="margin-top:30px">

        <div class="row">
            <div class="col-md-12">
                <h1 class="heading-my-liting-block">Etes vous prêt pour saisir 
                    <br>
                  des meilleurs opportunités ?
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p>Trouvez l'emploi qui vous correspond et Optimisez votre CV en ligne pour vous démarquer et saisir l'emploi idéal.
                </p>

            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="btn-block expert-btn">
                    <a href="#">
                        <h2>Mon cv</h2>

                        <svg data-v-e07ebb40="" width="15" height="15" viewbox="0 0 15 15" fill="#ffffff"
                            xmlns="https://www.w3.org/2000/svg" data-qa="arrow" class="vertical-align-middle ml-2x">
                            <path data-v-e07ebb40=""
                                d="M7 0.5L5.775 1.725L10.675 6.625H0L0 8.375H10.675L5.775 13.275L7 14.5L14 7.5L7 0.5Z">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>


            <div class="col-md-4">
                <div class="btn-block emploi-btn">
                    <a href="{$GLOBALS.site_url}/system/applications/view/">
                        <h2>
                            Suivi de mes réponses</h2>
                        <svg data-v-e07ebb40="" width="15" height="15" viewbox="0 0 15 15" fill="#ffffff"
                            xmlns="https://www.w3.org/2000/svg" data-qa="arrow" class="vertical-align-middle ml-2x">
                            <path data-v-e07ebb40=""
                                d="M7 0.5L5.775 1.725L10.675 6.625H0L0 8.375H10.675L5.775 13.275L7 14.5L14 7.5L7 0.5Z">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="btn-block formation-btn">
                    <a href="{$GLOBALS.site_url}/edit-profile/">
                        <h2>
                           Mon profil</h2>


                        <svg data-v-e07ebb40="" width="15" height="15" viewbox="0 0 15 15" fill="#ffffff"
                            xmlns="https://www.w3.org/2000/svg" data-qa="arrow" class="vertical-align-middle ml-2x">
                            <path data-v-e07ebb40=""
                                d="M7 0.5L5.775 1.725L10.675 6.625H0L0 8.375H10.675L5.775 13.275L7 14.5L14 7.5L7 0.5Z">
                            </path>
                        </svg>

                    </a>
                </div>
            </div>
        </div>
    </div>

   

<div class="my-fixed-account-footer row hidden-content">
    <div class="container">
        <div class="col-md-6 col-xs-12">
            <p>
Télécharger CV Jobsquare en PDF</p>

        </div>
        
        <div class="col-md-6 col-xs-12 text-right">



				 {if $percentage}
                   [[Your resume is filled out by]] {$percentage}%
                    {if $percentage > 89}
                    <a class="btn "
                        href="{$GLOBALS.site_url}/my-resume-details/{$listingIDforPDF}/?action=download_pdf_version">
                        <i class="fa fa-download" aria-hidden="true"></i>Télécharger CV Jobsquare en PDF
                    </a>
                    {/if}{/if}
        </div>
    </div>
</div>


{/if}

<h1 class="my-account-title" style="display:none">
    {if $GLOBALS.current_user.group.id != "Employer"}

    [[My Account]]
    <!--<a href="{$GLOBALS.site_url}/my-listings/{$listingTypeID|lower}/#offres"><i class="fa fa-hand-pointer-o" aria-hidden="true"></i> Offres similaires à mon profil</a>-->
    {/if}
</h1>




{literal}
<style>
 .hidden-content { display:none}

 .resume_block .quick-search__wrapper {
    margin: 10px 0px;
    background: #ffffff;
    padding: 16px;
    box-shadow: none!important;
    max-width: 100%;
    border: #e8f1f9 2px solid;
    border-radius: 25px;
    padding: 0;
}

 .resume_block .form-inline .form-control {
    display: inline-block;
    width: auto;
    vertical-align: middle;
    background: transparent;
    border: none;
    margin: 1px 15px 0px 25px;
    min-width: 220px;
}
.tinyheader .listresume a.btn.btn__blue {
   
    border-radius: 25px;
   
}
 .resume_block  .quick-search__find {
    background: none;
    text-indent: 0em;
    overflow: hidden;
    background: none;
    border: none;
    font-family: 'Open Sans';
    font-weight: 400;
    letter-spacing: 0.32px;
    text-transform: none;
    font-size: 16px;
	color: #0055d9;
	text-align: right;
}
 .resume_block  .quick-search__find:hover {
    background: none;
    
	color: #ee810c;
	text-align: right;
}

 .my_latest_job_listing {}
.tinyheader  .my_latest_job_listing .listing-item {
    border: none;
    border-bottom: 1px solid #ccc;
    box-shadow: none!important;
    margin-bottom: 0!important;
    margin-top: 0;
}
.tinyheader  .my_latest_job_listing .listing-item:hover {
   
    border-bottom: 1px solid #0055d9;
	background:#e8f1f9;
    box-shadow: none!important;
}

 .listresume {    background: #e8f1f9;}
 .my_latest_job_listing  .listing__title {
    font-family: Rza, Rza-fallback, Georgia, serif;
    font-size: 28px;
    font-weight: 400;
    letter-spacing: -1px;
    line-height: 40px;
    text-size-adjust: 100%;
    word-break: break-word;
    color: #0055d9;
    text-align: left;
    border-bottom: 2px solid #0055d9;
}

 .my_latest_job_listing .listing-item__employment-type {
    white-space: nowrap;
    margin-bottom: 5px;
    font-size: 14px;
    display: inline-block;
    padding: 7px 15px;
    color: #0055d9;
    background: #e8f1f9;
    border: #e8f1f9;
    border-radius: 15px;
}

 .my_latest_job_listing article:hover .listing-item__employment-type {
    white-space: nowrap;
    margin-bottom: 5px;
    font-size: 14px;
    display: inline-block;
    padding: 7px 15px;
    color: #fff;
    background: #0055d9;
    border: #0055d9;
    border-radius: 15px;
}
    .resume-title {
        display: flex;
        flex-wrap: wrap;
        width: 100%;
        align-items: center;
        justify-content: space-between;
    }

    .resume-title h1 {
        font-family: Rza, Rza-fallback, Georgia, serif;
        font-size: 36px;
        font-weight: 400;
        letter-spacing: -1px;
        line-height: 40px;
        text-size-adjust: 100%;
        word-break: break-word;
        color: #0055d9;
    }

    .tinyheader .page-row-expanded {
        background: #ffffff !important;
        height: auto;
    }

    body {
        background: #ffffff !important;

    }

    .my-listing-header-block {
        display: ;
        background: #e8f1f9;
        padding: 30px;
        border-radius: 7px;
        margin: 20px auto;
    }

    .my-listing-header-block h1.heading-my-liting-block {
        font-family: Rza, Rza-fallback, Georgia, serif;
        font-size: 62px;
        font-weight: 400;
        letter-spacing: -1px;
        line-height: 62px;
        text-size-adjust: 100%;
        word-break: break-word;
        color: #0055d9;
        margin-bottom: 30px;
        margin-top: 0;
    }

    .btn-block {
        border-radius: 7px;
        padding: 20px;
    }

    .btn-block h2 {
        color: #fff;
        font-family: "Neue Montreal", "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 28px;
        font-weight: 500;
        letter-spacing: -0.072px;
        line-height: 36px;
        text-align: left;
        text-size-adjust: 100%;
        text-wrap: wrap;
        vertical-align: baseline;
        white-space-collapse: collapse;
        margin-top: 0;
        margin-bottom: 0
    }

    .btn-block p {

        margin-bottom: 30px
    }

    .btn-block svg {
        position: absolute;
        bottom: 30px;
        right: 40px;
    }

    .btn-block a {
        color: #fff
    }

    .btn-block.expert-btn {
        background: #ee810c
    }

    .btn-block.resume-btn {
        background: #0055d9
    }

    .btn-block.emploi-btn {
        background: #2bade7
    }

    .btn-block.formation-btn {
        background: #108a00
    }

    .btn-block:hover {
        background: #fff
    }

    .btn-block.resume-btn:hover {
        background: #e8f1f9
    }

    .btn-block.expert-btn:hover h2,
    .btn-block.expert-btn:hover a,
    .btn-block.expert-btn:hover svg {
        color: #ee810c;
        fill: #ee810c;
    }

    .btn-block.resume-btn:hover h2,
    .btn-block.resume-btn:hover a,
    .btn-block.resume-btn:hover svg {
        color: #0055d9;
        fill: #0055d9;
    }


    .btn-block.emploi-btn:hover h2,
    .btn-block.emploi-btn:hover a,
    .btn-block.emploi-btn:hover svg {
        color: #2bade7;
        fill: #2bade7;
    }

    .btn-block.formation-btn:hover h2,
    .btn-block.formation-btn:hover a,
    .btn-block.formation-btn:hover svg {
        color: #108a00;
        fill: #108a00;
    }


    .my-fixed-account-footer {

        padding: 15px;
        position: fixed;
        display: ;
        bottom: 0;
        width: 100%;
        z-index: 999;
        background: #0055d9;
        color: #fff;

    }

    .my-fixed-account-footer p {
        margin: 0;
        line-height: 30px;
    }


    .my-fixed-account-footer a.btn-product-emploi {
        font-size: 14px;
        font-weight: 400;
        padding: 7px 9px;
        margin: 5px 15px 10px 0;
        line-height: 30px;
        border: 2px solid #2bade7;
        border-radius: 3px;
        background: #2bade7;
        color: #fff;
        vertical-align: middle;
        white-space: nowrap;
    }


    .my-fixed-account-footer a.btn-formation.btn-product-training {
        font-size: 14px;
        font-weight: 400;
        padding: 7px 8px;
        margin: 5px 15px 5px 0;
        line-height: 30px;
        border: 2px solid #108a00;
        border-radius: 3px;
        background: #108a00;
        color: #fff;
        vertical-align: middle;
        white-space: nowrap;
    }
   .my-fixed-account-footer a.btn {
    font-size: 14px;
    font-weight: 400;
    padding: 7px 20px;
    margin: 0px 15px;
    line-height: 30px;
    border: 2px solid #ee810c;
    border-radius: 3px;
    background: #ee810c;
    color: #fff;
    vertical-align: middle;
    white-space: nowrap;
    border-radius: 25px;
}
    .my-listing-header-block p {
        font-size: 16px
    }

    .paiement_block {}

    .paiement_block img {
        width: 49px;
        height: 31px;
        border-radius: 6px
    }

    @media(max-width: 767px) {
        .my-listing-header-block p {
            font-size: 14px
        }

        #jobseeker .tinyheader.head2.page-my-listings {
            padding-bottom: 100px
        }

        .my-listing-header-block {
            padding: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .my-fixed-account-footer {
            padding: 5px 0;

        }

        .my-fixed-account-footer .container {

            flex-direction: column;
        }

        .my-listing-header-block h1.heading-my-liting-block {

            font-size: 33px;


            line-height: 35px;

            margin-bottom: 20px;

        }

        .btn-block {
            border-radius: 7px;
            padding: 20px;
            margin-bottom: 20px;
        }


        .btn-block h2 {

            font-size: 21px;
            line-height: 24px;
        }

        .my-fixed-account-footer a.btn-product-emploi,
        .my-fixed-account-footer a.btn-formation.btn-product-training {

            padding: 0 9px;
            margin: 5px 0 10px;
            line-height: 25px;


            vertical-align: middle;
            white-space: nowrap;
            display: block;
            width: 100%;
            text-align: center;
        }


        .my-fixed-account-footer p {

            display: none;
        }

        .btn-block svg {
            position: absolute;
            bottom: 20px;
            right: 40px;
        }

    }

    .listresume.no-active:before,
    .listresume.no-active:after {
        display: none
    }
</style>
{/literal}
<div class="container container--small pt-50 row">
    <div class=" col-xs-12 col-md-3 mt-30">{if $GLOBALS.current_user.group.id == "Employer"}<nav class="sidebar">

            <a class="sidebar__list-item {if $listingTypeID == 'job'}is-active {/if}"
                href="{$GLOBALS.site_url}/my-listings/job/" aria-current="page">[[Job Postings]]</a>
            <a class="sidebar__list-item {if $listingTypeID == 'training'} is-active {/if}"
                href="{$GLOBALS.site_url}/my-listings/training/">[[Training Postings]]</a>
            <a class="sidebar__list-item  {if $currentPage.order == 3}is-active {/if}"
                href="{$GLOBALS.site_url}/edit-profile/">Editer Mon Pofil</a>
            
        </nav>{elseif $GLOBALS.current_user.group.id =! "Employer"}




        {title}[[Job Postings]]{/title}{else} {title}[[My Resume]]{/title}<nav class="sidebar">
            <a class="sidebar__list-item is-active {if $listingTypeID == 'resumes'}{/if}"
                href="{$GLOBALS.site_url}/my-listings/{$listingTypeID|lower}/#offres" aria-current="page">[[My
                Resume]]</a>
            <a class="sidebar__list-item" href="{$GLOBALS.site_url}/system/applications/view/">[[My Applications]]</a>
            <a class="sidebar__list-item" href="{$GLOBALS.site_url}/edit-profile/">[[Account Settings]]</a>
        </nav>{/if}</div>{if not $listings}<div
        class="col-xs-12 {if $my_products}col-sm-6 test0 {else} col-md-9 my-account-listings-full{/if}">
        <div class="search-results my-account-listings " style="padding:initial">
            <div class="form-group__btn">
                {if $GLOBALS.current_user.group.id == "Employer"}
                {if $listingTypeID == 'training' || $listingTypeID == 'Training'}
                <a href="{$GLOBALS.site_url}/add-listing/?listing_type_id={$listingTypeID}"
                    class="btn add_new-btn bouton__orange" style="color:#108a00">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    [[Post a {$listingTypeID}]]</a>
                {else}
                <a href="{$GLOBALS.site_url}/add-listing/?listing_type_id={$listingTypeID}"
                    class="btn add_new-btn bouton__orange">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    [[Post a {$listingTypeID}]]</a>
                {/if}
                {else}
                <a href="{$GLOBALS.site_url}/add-listing/?listing_type_id=Resume"
                    class="btn btn__blue btn__bold">[[Create New Resume]]</a>
                {/if}
            </div>
            <div class="alert alert-danger">[[You have no {$listingTypeID}s so far]]</div>
        </div>
    </div>{else}<div class="col-xs-12 {if $my_products}col-sm-6 test1{else} col-md-9 my-account-listings-full{/if}">
        <div class="search-results my-account-listings" style="padding:initial">

            {assign var="listings_number" value=$listing_search.listings_number}
            {if $GLOBALS.current_user.group.id == "Employer"}
            <h3 class="has-left-postings search-results__title">
                {$listings_number} [[{$listingTypeID} Postings]]</h3>
            {else}
            <h3 class="has-left-postings search-results__title">{*[[You have $listings_number Resume(s)]]*}</h3>
            {/if}

            <div class="form-group__btn">
                {if $GLOBALS.current_user.group.id == "Employer"}

                <a style="font-size:20px; color:#2bade7"
                    href="{$GLOBALS.site_url}/add-listing/?listing_type_id={$listingTypeID}"
                    class="btn add_new-btn {if $listingTypeID == " job"}bouton__orange{else}bouton__violet{/if}">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    [[Post a {$listingTypeID}]]</a>

                {else}
                {if !$listings}
                <a href="{$GLOBALS.site_url}/add-listing/?listing_type_id=Resume" class="btn bouton__orange">[[Create
                    New Resume]]</a>
                {/if}
                {/if}
            </div>

            {if $GLOBALS.current_user.group.id == 'JobSeeker'}
            {if $today_date_3month > $update_date_3month}
            <div class="css-s2dgtn e128p6kr0 alert alert-danger alert-dismissible">

                {literal}
                <script src="https://use.fontawesome.com/7e203bcaaf.js"></script>{/literal}
                <button type="button" class="css-1v52m5x e128p6kr1 close" data-dismiss="alert">
                    <i size="16" class="css-b80bsd e19xi9jy0">
                        <svg width="16" height="16" preserveaspectratio="none" viewbox="0 0 24 24">
                            <path fill="#B12121"
                                d="M14.238 12L20 17.762 17.763 20 12 14.237 6.238 20 4 17.763 9.764 12 4 6.236l2.236-2.235h.002l5.763 5.762L17.764 4l2.235 2.236v.002L14.238 12z">
                            </path>
                        </svg>
                    </i>
                </button>
                <div>
                    N'attendez plus pour valoriser vos talents et publiez vos nouvelles informations. La dernière mise à
                    jour date de plus de 3 mois! -<a href="{$GLOBALS.site_url}/edit-resume/Interests/{$listing.id}"
                        style="color: rgb(177, 33, 33); font-weight: bold; text-decoration: underline;">Mettez votre CV
                        à jour maintenant</a>
                </div>
            </div>
            {/if}
            {/if}
            {foreach from=$listings item=listing name=listings_block}
            <article
                class="media well listing-item  {if $listingTypeID == 'job'}listjob {if $listing.featured}listing-item__featured{/if} {elseif $listingTypeID == 'training'}listtraining {if $listing.featured}listing-item__featured violet{/if} {else}listresume {/if} {if $smarty.now > $listing.expiration_date|strtotime}no-active{else}active{/if} ">


                {if $GLOBALS.current_user.group.id == 'Employer' && $listingTypeID == 'job'}
                {if $listing.listing_alert_mesage}
                <div class="alertbleu css-b9pwbv e128p6kr0 alert alert-primary">
                    <div>
                        <span class="css-g50631 e4y08cy0">
                            <i size="20" class="css-tjx49 e19xi9jy0"><img
                                    src="https://www.jobsquare.ma/templates/Jobsquare/assets/images/icon-jobsquare.png"></i>
                        </span>


                        <span class="css-uzhbcc e4y08cy2">
                            {$listing.listing_alert_mesage}</span>
                        {if $listing.active|status != 'active'}

                        <div class="css-1xr94rl">
                            <a href="{if $listingTypeID == 'resume'}{$GLOBALS.site_url}/edit-resume/Interests/{$listing.id}{else}{$GLOBALS.site_url}/edit-{$listing.type.id|lower}/?listing_id={$listing.id}{/if}"
                                class="btns">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                Modifier maintenant</a>

                        </div>
                        {/if}
                    </div>
                </div>

                {/if}
                {/if}
               
                <div class="col-md-8">
                    {if $listingTypeID == 'resume'}
                    {if $photoUrl}
                    <div class="job-seeker__image">
                        <div class="text-center profile__image">
                            <img class="profile__img" src="{$photoUrl}">
                        </div>
                    </div>
                    {else}


                    <div class="job-seeker__image">
                        <div class="text-center profile__image">
                            <img class="profile__img"
                                src="{$GLOBALS.site_url}/templates/Jobsquare/assets/images/sansphoto.jpg">
                        </div>
                    </div>
                    {/if}
                    {/if}
                    <div class="media-heading listing-item__title">

                        <a class="link"
                            href="{if $listingTypeID == 'resume'}{$GLOBALS.site_url}/edit-resume/Interests/{$listing.id}{else}{$GLOBALS.site_url}/edit-{$listing.type.id|lower}/?listing_id={$listing.id}{/if}">
                            <span
                                class="{if $listingTypeID == 'job'} c-orange {else}violet{/if}">{$listing.Title|escape}</span>
                        </a>
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

                    </div>
                    <div class="listing-item__info clearfix">
                        <!--<div class="listing-item__info--item-date visible-xs-480">
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
																										</div>-->
                        {if $listingTypeID == 'resume'}
                        <a class="link" href="{$GLOBALS.site_url}/edit-resume/Interests/{$listing.id}">
                            <span class="{if $listingTypeID == 'job'} btns {else} btns bt2{/if}">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                Modifier votre CV</span>
                        </a>
                        {capture assign="updateDate"}{$update_date|date}{/capture}
                        {/if}
                        {if !empty($updateDate)&& $updateDate!="30/11/-1"}

                        <div class="listing-item__info--item-date ">
                            <b>Derni&egrave;re mise &agrave; jour:
                            </b>
                            <span {if ($today_date_3month < $update_date_3month) && $percentage>
                                89} style="color: #83ca4e;"{/if}>{$updateDate}</span>
                        </div>

                        {/if}
                        <div class="listing-item__info--item-date ">
                            <b>Date activation:
                            </b>
                            <span>{$listing.activation_date|date}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div>
                        {if $GLOBALS.current_user.group.id == 'Employer'}
                        <a href="{if $listingTypeID == 'resume'}{$GLOBALS.site_url}/edit-resume/Interests/{$listing.id}{else}{$GLOBALS.site_url}/edit-{$listing.type.id|lower}/?listing_id={$listing.id}{/if}"
                            class="btns">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                            Editer l&acute;offre</a>



                        {if $listing.active|status == 'active'}

                        {elseif $listing.active|status == 'pending'}

                        {elseif $listing.expiration_date && $smarty.now > $listing.expiration_date|strtotime}
                        <a href="{$GLOBALS.site_url}/pay-for-listing/?listing_id={$listing.id}" class="btns">
                            [[Make Visible]]
                        </a>
                        {else}

                        {/if}

                        <br>

                        {if $apps[$listing.id] || !$listing.application_redirects}
                        {if $apps[$listing.id]}
                        <a href="{$GLOBALS.site_url}/system/applications/view/?appJobId={$listing.id}" class="btns ">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                            Voir les canditatures</a>
                        {/if}
                        {/if}
                        {/if}
                    </div>
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

                    
                    {if $percentage}
                    <h4>[[Your resume is filled out by]] {$percentage}%</h4>
                    {if $percentage > 89}
                    <a class="btn btn__blue "
                        href="{$GLOBALS.site_url}/my-resume-details/{$listingIDforPDF}/?action=download_pdf_version">
                        Télécharger CV Jobsquare en PDF
                    </a>
                    {/if}
                    <div class="meter green nostripes">
                        <span id="progress" style="width: {$percentage}%;"></span>
                    </div>


                    {/if}
                </div>

            </article>
            {/foreach}


            {if $GLOBALS.current_user.group.id != 'Employer'}
            {module name="classifieds" function="listings_user_profile" items_count="10" listing_type="Job"
            listing_id=$listing.id title=$listing.Title}
            {/if}

            <button type="button"
                class="load-more btn btn__white {if $listings_number <= $listing_search.listings_per_page}hidden{/if}"
                data-page="2">
                [[Load more]]
            </button>
        </div>
    </div>{/if}
    {if $my_products}<div class="col-sm-3 col-xs-12">
        <div class=" well my-account-products">
            <div class="profile__content">
                <h4>[[Purchased Products]]</h4>
                {foreach from=$my_products item=contract}
                <div class="contract-list" data-contract="{$contract.id}">
                    <div class="contract-list--name">
                        {$contract.product_info.name|escape}
                        <!--{if $contract.product_info.price} - {capture assign='contract_price'}{tr type='float'}{$contract.price}{/tr}{/capture}{currencyFormat amount=$contract_price}{/if}-->
                        {if $contract.product_info.recurring}[[per {$contract.product_info.billing_cycle}]]{/if}
                    </div>
                    <div class="contract-list--purchased">[[Purchased]]: {$contract.creation_date|date}</div>
                    {if !$contract.product_info.recurring}
                    {if $contract.expired_date}<div class="contract-list--expires">[[Expires]]:
                        {$contract.expired_date|date}</div>{/if}
                    {/if}
                    {if $contract.listingAmount}
                    {foreach item='stat' from=$contract.listingAmount}
                    <div class="contract-list--listing-count">{$stat.numPostings}/[[{$stat.count}]]
                        <!--[[{$listingTypeName|strtolower}s]]-->
                        [[posted]]
                    </div>
                    {/foreach}
                    {/if}
                    {if $contract.recurring}
                    {if $contract.recurring_status == 'active'}
                    <a href="#" class="contract-list--cancel link" data-toggle="modal"
                        data-target="#confirm-cancel">[[Cancel]]</a>
                    {elseif $contract.recurring_status == 'canceled'}
                    <span class="label label-default">[[Canceled]]</span>
                    {/if}
                    {/if}
                </div>
                {/foreach}
            </div>
        </div>
    </div>
    <div class="modal fade confirm-cancel" id="confirm-cancel" tabindex="-1" role="dialog"
        aria-labelledby="message-modal-label">
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
    </div>{/if}
    {if $listingTypeID == "resume"}
    {javascript}
    <script type="text/javascript" language="JavaScript">var overall = {if $listings_number}{$listings_number}{else}0{/if};
            $('.load-more').click(function () {
                var self = $(this);
                self.addClass('loading');
                $.get('?searchId={$searchId}&action=search&page=' + self.data('page'), function (data) {
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
            $('.contract-list--cancel').click(function () {
                $('#confirm-cancel').data('contract', $(this).closest('.contract-list').data('contract'));
            });
            $('.confirm-cancel__yes').click(function () {
                window.location.href = SJB_UserSiteUrl + '/system/payment/cancel_recurring/?contract=' + $('#confirm-cancel').data('contract');
            });


            $(document).ready(function () {
                var perc = { $percentage };
                if (perc < 40) {
                    $("#progress").css('background', 'red');
                } else if (perc < 60) {
                    $("#progress").css('background', 'orange');
                } else if (perc < 80) {
                    $("#progress").css('background', 'yellow');
                } else {
                    $("#progress").css('background', '#a5c242');
                }

                $("#progress").css("width", perc + "%");
            });
    </script>
    {/javascript}
    {else}

    {javascript}
    <script type="text/javascript" language="JavaScript">
            var overall = {if $listings_number}{$listings_number}{else}0{/if};
                $('.load-more').click(function () {
                    var self = $(this);
                    self.addClass('loading');
                    $.get('?searchId={$searchId}&action=search&page=' + self.data('page'), function (data) {
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
                $('.contract-list--cancel').click(function () {
                    $('#confirm-cancel').data('contract', $(this).closest('.contract-list').data('contract'));
                });
                $('.confirm-cancel__yes').click(function () {
                    window.location.href = SJB_UserSiteUrl + '/system/payment/cancel_recurring/?contract=' + $('#confirm-cancel').data('contract');
                });
    </script>

    <script>


                var wrap = $("#my-account-title");

                wrap.on("scroll", function (e) {

                    if (this.scrollTop > 147) {
                        wrap.addClass("fix-search");
                    } else {
                        wrap.removeClass("fix-search");
                    }

                });</script>
    {/javascript}
    {/if}
    <style>
        .job-seeker__image {
            width: 125px;
            height: 125px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 26px 0px auto;
            float: left;
        }




        .detailListText {
            margin: 0 0 0 20px;
        }

        .checkBoxLeft {
            position: absolute;
            left: 10px;
            top: 28%;
            width: 18px;
            height: 18px;
            background: #d9d9d9;
            border-radius: 3px;
        }

        .hidden-checkbox {
            display: none;
        }

        .not-checked {
            background-position: 18px 0;
            background-color: #d9d9d9;
        }

        .checked {
            background-position: 0 0;
            background-color: #6496bc;
        }

        .meter {
            width: 50%;
            height: 20px;
            position: relative;
            margin: -17px 0 20px 0;
            background: #9a9a9a;
        }

        .meter>span {
            display: block;
            height: 100%;
            // -webkit-border-top-right-radius: 20px;
            // -webkit-border-bottom-right-radius: 20px;
            // -moz-border-radius-topright: 20px;
            // -moz-border-radius-bottomright: 20px;
            // border-top-right-radius: 20px;
            // border-bottom-right-radius: 20px;
            // -webkit-border-top-left-radius: 20px;
            // -webkit-border-bottom-left-radius: 20px;
            // -moz-border-radius-topleft: 20px;
            // -moz-border-radius-bottomleft: 20px;
            // border-top-left-radius: 20px;
            // border-bottom-left-radius: 20px;
            // background-color: rgb(43, 194, 83);
            // background-image: -webkit-gradient(linear, left bottom, left top, color-stop(0, rgb(43, 194, 83)), color-stop(1, rgb(84, 240, 84)));
            // background-image: -moz-linear-gradient(center bottom, rgb(43, 194, 83) 37%, rgb(84, 240, 84) 69%);
            // -webkit-box-shadow: inset 0 2px 9px rgba(255, 255, 255, 0.3), inset 0 -2px 6px rgba(0, 0, 0, 0.4);
            // -moz-box-shadow: inset 0 2px 9px rgba(255, 255, 255, 0.3), inset 0 -2px 6px rgba(0, 0, 0, 0.4);
            // box-shadow: inset 0 2px 9px rgba(255, 255, 255, 0.3), inset 0 -2px 6px rgba(0, 0, 0, 0.4);
            // position: relative;
            // overflow: hidden;
        }

        .meter>span:after,
        .animate>span>span {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;

        }
.meter>span:after, .animate>span>span {
   
    background: #8bc34a;
}
        .animate>span:after {
            display: none;
        }
    </style>


    {literal}

    <style>
      
        .my-account-listings .has-left-postings {

            font-size: 18px;


        }

        .my-account-listings .form-group__btn .btn.bouton__orange.add_new-btn {
            font-size: 16px;
            margin-top: 10px;
            background: transparent;
            color: #eb800e;
            border-bottom: 1px solid #eb800e;
            border-radius: 3px;
            border: transparent 0px solid !important;
            text-decoration: underline !important;
        }

        .sidebar {
            width: 100%
        }

        .no-active {
            position: relative
        }

        .no-active:before {
            content: "";
            height: 100%;
            width: 100%;
            background: linear-gradient(45deg, #ccc 1%, #fff 1%, #fff 49%, #ccc 49%, #ccc 51%, #fff 51%, #fff 99%, #ccc 99%);
            background-size: 6px 6px;
            background-position: 50px 50px;
            position: absolute;
            top: 0px;
            left: 0px;
        }

        .mylisting .edito {
            padding: 0;


            border: 1px dotted transparent;
            background: transparent;
            color: #fff;
            margin-bottom: 0;

        }

        .well.my-account-products {
            background: aliceblue;
            border-radius: 6px;
            margin-top: 15px
        }

        .my-account-products h4 {
            text-align: left;
            color: #6e6c6f;
            font-size: 16px;
        }

        .mt-10 {
            margin-top: 10px
        }

        .mt-20 {
            margin-top: 20px
        }

        .mt-30 {
            margin-top: 30px
        }

        .mt-40 {
            margin-top: 40px
        }

        .mt-50 {
            margin-top: 50px
        }

        .my-account-title a.btn-formation,
        #my-account-title a.btn-formation,
        #callback_payment a.btn-formation {
            padding: 8px 10px;
            /* background: transparent;
						      border: 1px solid #fff;*/
            margin: 5px 5px 5px 0px;

        }

        .tinyheader a.btns {

            white-space: nowrap;
        }

        .my-account-title a .fa,
        #my-account-title a .fa,
        #callback_payment a.fa {
            padding-right: 0px;
        }

        .my-account-title a,
        #my-account-title a,
        #callback_payment a {
            font-size: 14px;
            font-weight: 400;
            padding: 7px 10px;
            margin: 5px 15px 5px 0px;
            line-height: 30px;
            border: 2px solid #2bade7;
            border-radius: 3px;
            background: #2bade7;
            color: #fff;
            vertical-align: middle;

        }

        #jobseeker .btn-bleu {
            background: #166bd9;
            border: 1px solid #166bd9;
            border-radius: 3px;
            color: #fff;
            padding: 7px 15px;
            font-size: 13px;
            text-transform: none;
            font-weight: 400;
            width: 100%;
            margin-top: 5px;
        }

        #my-account-title {
            text-align: left;
            background: #166bd9 !important;
            padding: 20px;
        }

        .pt-50 {
            padding-top: 50px
        }

        .alertbleu {
            position: relative;
            padding: .75rem 1.25rem;
            margin-bottom: 1rem;
            border: 1px solid #166bd9 !important;
            border-radius: .25rem;

            color: #004085;
            background-color: transparent;
            border-color: red;
        }

        .alertbleu a.btns {
            border: none;
            background: #e7f3ff;
            color: #056fe7;
            width: 100%;
            display: block;
            text-align: center;
            padding: 0px;
            margin-top: 10px;
        }

        .alertvert {
            position: relative;
            padding: .75rem 1.25rem;
            margin-bottom: 1rem;
            border: 1px solid #366fe7;
            border-radius: .25rem;

            color: #004085;
            font-size: 14px;
        }

        .alertvert input.btns {
            border: none;
            background: #166bd9;
            color: #ffffff;
            width: 100%;
            display: block;
            text-align: center;
            padding: 0px;
            margin-top: 10px;
            max-width: 214px;
            float: right;
            line-height: 30px;

        }

        .my-account-listings .form-group__btn .btn.bouton__orange {
            color: #fff;
            font-size: 16px;
            background: #eb800e;
            border-radius: 3px;
            font-size: 14px;
            padding: 7px 15px;
        }


        #my-account-title a.btn-product-emploi {
            font-size: 14px;
            font-weight: 400;
            padding: 7px 9px;
            margin: 5px 15px 5px 0px;
            line-height: 30px;
            border: 2px solid #2bade7;
            border-radius: 3px;
            background: #2bade7;
            color: #fff;
            vertical-align: middle;
        }

        #my-account-title a.btn-formation.btn-product-training {

            font-size: 14px;
            font-weight: 400;
            padding: 7px 8px;
            margin: 5px 15px 5px 0px;
            line-height: 30px;
            border: 2px solid #108a00;
            border-radius: 3px;
            background: #108a00;
            color: #fff;
            vertical-align: middle;
        }


        .my-account-listings .form-group__btn .btn.bouton__violet {
            background: none;
            color: #108a00;
            font-size: 16px;
            margin-top: 8px;
        }


        .listing-item__info--item:before {

            display: none;

        }

        .listing-item__info--item:last-child {
            padding-right: 5px;
            margin-right: 5px;
        }


        .page-my-listings .container--small {

            background: transparent;
            padding-top: 0 !important
        }


        .page-my-listings .my-account-listings .listing-item:first-of-type {
            margin-top: 0;
        }
    </style>

    {/literal}