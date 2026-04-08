<?php
/* Smarty version 4.3.0, created on 2026-02-28 23:48:25
  from 'template_jobsquare_user:CxampphtdocsJobsquareMatemplatesJobsquareclassifiedsmy_listings.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a37ec9e0ee12_68053698',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fa10ad3321c11f9463ab907d6e73efbc5fc9a68f' => 
    array (
      0 => 'template_jobsquare_user:CxampphtdocsJobsquareMatemplatesJobsquareclassifiedsmy_listings.tpl',
      1 => 1771680567,
      2 => 'template_jobsquare_user',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69a37ec9e0ee12_68053698 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 src="https://use.fontawesome.com/7e203bcaaf.js"><?php echo '</script'; ?>
>
<?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['current_user']['group']['id'] != "Employer") {?>

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
                    <a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/system/applications/view/">
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
                    <a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/edit-profile/">
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



				 <?php if ($_smarty_tpl->tpl_vars['percentage']->value) {?>
                   <?php $_block_plugin1 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin1, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin1->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Your resume is filled out by<?php $_block_repeat=false;
echo $_block_plugin1->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?> <?php echo $_smarty_tpl->tpl_vars['percentage']->value;?>
%
                    <?php if ($_smarty_tpl->tpl_vars['percentage']->value > 89) {?>
                    <a class="btn "
                        href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/my-resume-details/<?php echo $_smarty_tpl->tpl_vars['listingIDforPDF']->value;?>
/?action=download_pdf_version">
                        <i class="fa fa-download" aria-hidden="true"></i>Télécharger CV Jobsquare en PDF
                    </a>
                    <?php }
}?>
        </div>
    </div>
</div>


<?php }?>

<h1 class="my-account-title" style="display:none">
    <?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['current_user']['group']['id'] != "Employer") {?>

    <?php $_block_plugin2 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin2, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin2->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>My Account<?php $_block_repeat=false;
echo $_block_plugin2->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
    <!--<a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/my-listings/<?php echo mb_strtolower((string) $_smarty_tpl->tpl_vars['listingTypeID']->value, 'UTF-8');?>
/#offres"><i class="fa fa-hand-pointer-o" aria-hidden="true"></i> Offres similaires à mon profil</a>-->
    <?php }?>
</h1>





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

<div class="container container--small pt-50 row">
    <div class=" col-xs-12 col-md-3 mt-30"><?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['current_user']['group']['id'] == "Employer") {?><nav class="sidebar">

            <a class="sidebar__list-item <?php if ($_smarty_tpl->tpl_vars['listingTypeID']->value == 'job') {?>is-active <?php }?>"
                href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/my-listings/job/" aria-current="page"><?php $_block_plugin3 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin3, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin3->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Job Postings<?php $_block_repeat=false;
echo $_block_plugin3->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a>
            <a class="sidebar__list-item <?php if ($_smarty_tpl->tpl_vars['listingTypeID']->value == 'training') {?> is-active <?php }?>"
                href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/my-listings/training/"><?php $_block_plugin4 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin4, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin4->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Training Postings<?php $_block_repeat=false;
echo $_block_plugin4->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a>
            <a class="sidebar__list-item  <?php if ($_smarty_tpl->tpl_vars['currentPage']->value['order'] == 3) {?>is-active <?php }?>"
                href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/edit-profile/">Editer Mon Pofil</a>
            
        </nav><?php } else {
$_prefixVariable1 = !"Employer";
$_tmp_array = isset($_smarty_tpl->tpl_vars['GLOBALS']) ? $_smarty_tpl->tpl_vars['GLOBALS']->value : array();
if (!(is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess)) {
settype($_tmp_array, 'array');
}
$_tmp_array['current_user']['group']['id'] = $_prefixVariable1;
$_smarty_tpl->_assignInScope('GLOBALS', $_tmp_array);
if ($_prefixVariable1) {?>




        <?php $_block_plugin5 = isset($_smarty_tpl->smarty->registered_plugins['block']['title'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['title'][0][0] : null;
if (!is_callable(array($_block_plugin5, '_tpl_title'))) {
throw new SmartyException('block tag \'title\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('title', array());
$_block_repeat=true;
echo $_block_plugin5->_tpl_title(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
$_block_plugin6 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin6, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin6->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Job Postings<?php $_block_repeat=false;
echo $_block_plugin6->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_repeat=false;
echo $_block_plugin5->_tpl_title(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
} else { ?> <?php $_block_plugin7 = isset($_smarty_tpl->smarty->registered_plugins['block']['title'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['title'][0][0] : null;
if (!is_callable(array($_block_plugin7, '_tpl_title'))) {
throw new SmartyException('block tag \'title\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('title', array());
$_block_repeat=true;
echo $_block_plugin7->_tpl_title(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
$_block_plugin8 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin8, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin8->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>My Resume<?php $_block_repeat=false;
echo $_block_plugin8->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_repeat=false;
echo $_block_plugin7->_tpl_title(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?><nav class="sidebar">
            <a class="sidebar__list-item is-active <?php if ($_smarty_tpl->tpl_vars['listingTypeID']->value == 'resumes') {
}?>"
                href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/my-listings/<?php echo mb_strtolower((string) $_smarty_tpl->tpl_vars['listingTypeID']->value, 'UTF-8');?>
/#offres" aria-current="page"><?php $_block_plugin9 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin9, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin9->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>My
                Resume<?php $_block_repeat=false;
echo $_block_plugin9->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a>
            <a class="sidebar__list-item" href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/system/applications/view/"><?php $_block_plugin10 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin10, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin10->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>My Applications<?php $_block_repeat=false;
echo $_block_plugin10->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a>
            <a class="sidebar__list-item" href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/edit-profile/"><?php $_block_plugin11 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin11, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin11->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Account Settings<?php $_block_repeat=false;
echo $_block_plugin11->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a>
        </nav><?php }}?></div><?php if (!$_smarty_tpl->tpl_vars['listings']->value) {?><div
        class="col-xs-12 <?php if ($_smarty_tpl->tpl_vars['my_products']->value) {?>col-sm-6 test0 <?php } else { ?> col-md-9 my-account-listings-full<?php }?>">
        <div class="search-results my-account-listings " style="padding:initial">
            <div class="form-group__btn">
                <?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['current_user']['group']['id'] == "Employer") {?>
                <?php if ($_smarty_tpl->tpl_vars['listingTypeID']->value == 'training' || $_smarty_tpl->tpl_vars['listingTypeID']->value == 'Training') {?>
                <a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/add-listing/?listing_type_id=<?php echo $_smarty_tpl->tpl_vars['listingTypeID']->value;?>
"
                    class="btn add_new-btn bouton__orange" style="color:#108a00">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    <?php $_block_plugin12 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin12, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin12->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Post a <?php echo $_smarty_tpl->tpl_vars['listingTypeID']->value;
$_block_repeat=false;
echo $_block_plugin12->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a>
                <?php } else { ?>
                <a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/add-listing/?listing_type_id=<?php echo $_smarty_tpl->tpl_vars['listingTypeID']->value;?>
"
                    class="btn add_new-btn bouton__orange">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    <?php $_block_plugin13 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin13, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin13->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Post a <?php echo $_smarty_tpl->tpl_vars['listingTypeID']->value;
$_block_repeat=false;
echo $_block_plugin13->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a>
                <?php }?>
                <?php } else { ?>
                <a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/add-listing/?listing_type_id=Resume"
                    class="btn btn__blue btn__bold"><?php $_block_plugin14 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin14, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin14->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Create New Resume<?php $_block_repeat=false;
echo $_block_plugin14->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a>
                <?php }?>
            </div>
            <div class="alert alert-danger"><?php $_block_plugin15 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin15, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin15->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>You have no <?php echo $_smarty_tpl->tpl_vars['listingTypeID']->value;?>
s so far<?php $_block_repeat=false;
echo $_block_plugin15->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></div>
        </div>
    </div><?php } else { ?><div class="col-xs-12 <?php if ($_smarty_tpl->tpl_vars['my_products']->value) {?>col-sm-6 test1<?php } else { ?> col-md-9 my-account-listings-full<?php }?>">
        <div class="search-results my-account-listings" style="padding:initial">

            <?php $_smarty_tpl->_assignInScope('listings_number', $_smarty_tpl->tpl_vars['listing_search']->value['listings_number']);?>
            <?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['current_user']['group']['id'] == "Employer") {?>
            <h3 class="has-left-postings search-results__title">
                <?php echo $_smarty_tpl->tpl_vars['listings_number']->value;?>
 <?php $_block_plugin16 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin16, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin16->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['listingTypeID']->value;?>
 Postings<?php $_block_repeat=false;
echo $_block_plugin16->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></h3>
            <?php } else { ?>
            <h3 class="has-left-postings search-results__title"></h3>
            <?php }?>

            <div class="form-group__btn">
                <?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['current_user']['group']['id'] == "Employer") {?>

                <a style="font-size:20px; color:#2bade7"
                    href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/add-listing/?listing_type_id=<?php echo $_smarty_tpl->tpl_vars['listingTypeID']->value;?>
"
                    class="btn add_new-btn <?php if ($_smarty_tpl->tpl_vars['listingTypeID']->value == " job") {?>bouton__orange<?php } else { ?>bouton__violet<?php }?>">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    <?php $_block_plugin17 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin17, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin17->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Post a <?php echo $_smarty_tpl->tpl_vars['listingTypeID']->value;
$_block_repeat=false;
echo $_block_plugin17->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a>

                <?php } else { ?>
                <?php if (!$_smarty_tpl->tpl_vars['listings']->value) {?>
                <a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/add-listing/?listing_type_id=Resume" class="btn bouton__orange"><?php $_block_plugin18 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin18, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin18->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Create
                    New Resume<?php $_block_repeat=false;
echo $_block_plugin18->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a>
                <?php }?>
                <?php }?>
            </div>

            <?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['current_user']['group']['id'] == 'JobSeeker') {?>
            <?php if ($_smarty_tpl->tpl_vars['today_date_3month']->value > $_smarty_tpl->tpl_vars['update_date_3month']->value) {?>
            <div class="css-s2dgtn e128p6kr0 alert alert-danger alert-dismissible">

                
                <?php echo '<script'; ?>
 src="https://use.fontawesome.com/7e203bcaaf.js"><?php echo '</script'; ?>
>
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
                    jour date de plus de 3 mois! -<a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/edit-resume/Interests/<?php echo $_smarty_tpl->tpl_vars['listing']->value['id'];?>
"
                        style="color: rgb(177, 33, 33); font-weight: bold; text-decoration: underline;">Mettez votre CV
                        à jour maintenant</a>
                </div>
            </div>
            <?php }?>
            <?php }?>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['listings']->value, 'listing', false, NULL, 'listings_block', array (
));
$_smarty_tpl->tpl_vars['listing']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['listing']->value) {
$_smarty_tpl->tpl_vars['listing']->do_else = false;
?>
            <article
                class="media well listing-item  <?php if ($_smarty_tpl->tpl_vars['listingTypeID']->value == 'job') {?>listjob <?php if ($_smarty_tpl->tpl_vars['listing']->value['featured']) {?>listing-item__featured<?php }?> <?php } elseif ($_smarty_tpl->tpl_vars['listingTypeID']->value == 'training') {?>listtraining <?php if ($_smarty_tpl->tpl_vars['listing']->value['featured']) {?>listing-item__featured violet<?php }?> <?php } else { ?>listresume <?php }?> <?php if (time() > strtotime($_smarty_tpl->tpl_vars['listing']->value['expiration_date'])) {?>no-active<?php } else { ?>active<?php }?> ">


                <?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['current_user']['group']['id'] == 'Employer' && $_smarty_tpl->tpl_vars['listingTypeID']->value == 'job') {?>
                <?php if ($_smarty_tpl->tpl_vars['listing']->value['listing_alert_mesage']) {?>
                <div class="alertbleu css-b9pwbv e128p6kr0 alert alert-primary">
                    <div>
                        <span class="css-g50631 e4y08cy0">
                            <i size="20" class="css-tjx49 e19xi9jy0"><img
                                    src="https://www.jobsquare.ma/templates/Jobsquare/assets/images/icon-jobsquare.png"></i>
                        </span>


                        <span class="css-uzhbcc e4y08cy2">
                            <?php echo $_smarty_tpl->tpl_vars['listing']->value['listing_alert_mesage'];?>
</span>
                        <?php if (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'status' ][ 0 ], array( $_smarty_tpl->tpl_vars['listing']->value['active'] )) != 'active') {?>

                        <div class="css-1xr94rl">
                            <a href="<?php if ($_smarty_tpl->tpl_vars['listingTypeID']->value == 'resume') {
echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/edit-resume/Interests/<?php echo $_smarty_tpl->tpl_vars['listing']->value['id'];
} else {
echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/edit-<?php echo mb_strtolower((string) $_smarty_tpl->tpl_vars['listing']->value['type']['id'], 'UTF-8');?>
/?listing_id=<?php echo $_smarty_tpl->tpl_vars['listing']->value['id'];
}?>"
                                class="btns">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                Modifier maintenant</a>

                        </div>
                        <?php }?>
                    </div>
                </div>

                <?php }?>
                <?php }?>
               
                <div class="col-md-8">
                    <?php if ($_smarty_tpl->tpl_vars['listingTypeID']->value == 'resume') {?>
                    <?php if ($_smarty_tpl->tpl_vars['photoUrl']->value) {?>
                    <div class="job-seeker__image">
                        <div class="text-center profile__image">
                            <img class="profile__img" src="<?php echo $_smarty_tpl->tpl_vars['photoUrl']->value;?>
">
                        </div>
                    </div>
                    <?php } else { ?>


                    <div class="job-seeker__image">
                        <div class="text-center profile__image">
                            <img class="profile__img"
                                src="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/templates/Jobsquare/assets/images/sansphoto.jpg">
                        </div>
                    </div>
                    <?php }?>
                    <?php }?>
                    <div class="media-heading listing-item__title">

                        <a class="link"
                            href="<?php if ($_smarty_tpl->tpl_vars['listingTypeID']->value == 'resume') {
echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/edit-resume/Interests/<?php echo $_smarty_tpl->tpl_vars['listing']->value['id'];
} else {
echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/edit-<?php echo mb_strtolower((string) $_smarty_tpl->tpl_vars['listing']->value['type']['id'], 'UTF-8');?>
/?listing_id=<?php echo $_smarty_tpl->tpl_vars['listing']->value['id'];
}?>">
                            <span
                                class="<?php if ($_smarty_tpl->tpl_vars['listingTypeID']->value == 'job') {?> c-orange <?php } else { ?>violet<?php }?>"><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['listing']->value['Title'], ENT_QUOTES, 'UTF-8', true);?>
</span>
                        </a>
                        <span class="listing-item__info--item listing-item__info--status
																																					<?php if (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'status' ][ 0 ], array( $_smarty_tpl->tpl_vars['listing']->value['active'] )) == 'active') {?> listing-item__info--status-active
																																					<?php } elseif (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'status' ][ 0 ], array( $_smarty_tpl->tpl_vars['listing']->value['active'] )) == 'pending') {?> listing-item__info--status-pending
																																					<?php } elseif (time() > strtotime($_smarty_tpl->tpl_vars['listing']->value['expiration_date'])) {?>listing-item__info--status-no-active
																																					<?php } else { ?>listing-item__info--status-no-active<?php }?>
																																					">
                            <?php if (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'status' ][ 0 ], array( $_smarty_tpl->tpl_vars['listing']->value['active'] )) == 'active') {?>
                            <?php $_block_plugin19 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin19, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin19->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Active<?php $_block_repeat=false;
echo $_block_plugin19->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
                            <?php } elseif (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'status' ][ 0 ], array( $_smarty_tpl->tpl_vars['listing']->value['active'] )) == 'pending') {?>
                            <?php $_block_plugin20 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin20, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin20->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Pending Approval<?php $_block_repeat=false;
echo $_block_plugin20->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
                            <?php } elseif ($_smarty_tpl->tpl_vars['listing']->value['expiration_date'] && time() > strtotime($_smarty_tpl->tpl_vars['listing']->value['expiration_date'])) {?>
                            <?php $_block_plugin21 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin21, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin21->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Expired<?php $_block_repeat=false;
echo $_block_plugin21->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
                            <?php } else { ?>
                            <?php $_block_plugin22 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin22, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin22->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Hidden<?php $_block_repeat=false;
echo $_block_plugin22->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
                            <?php }?>
                        </span>

                    </div>
                    <div class="listing-item__info clearfix">
                        <!--<div class="listing-item__info--item-date visible-xs-480">
																											<div class="listing-item__views">
																												<?php echo $_smarty_tpl->tpl_vars['listing']->value['views'];?>
 <?php $_block_plugin23 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin23, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin23->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>views<?php $_block_repeat=false;
echo $_block_plugin23->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
																											</div>
																											<?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['current_user']['group']['id'] == 'Employer') {?>
																												<div class="listing-item__applies">
																													<?php if ($_smarty_tpl->tpl_vars['apps']->value[$_smarty_tpl->tpl_vars['listing']->value['id']] || !$_smarty_tpl->tpl_vars['listing']->value['application_redirects']) {?>
																														<?php if (!$_smarty_tpl->tpl_vars['apps']->value[$_smarty_tpl->tpl_vars['listing']->value['id']]) {?>
																															0 <?php $_block_plugin24 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin24, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin24->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>applicants<?php $_block_repeat=false;
echo $_block_plugin24->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
																														<?php } else { ?>
																															<a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/system/applications/view/?appJobId=<?php echo $_smarty_tpl->tpl_vars['listing']->value['id'];?>
" class="link">
																																<?php echo (($tmp = $_smarty_tpl->tpl_vars['apps']->value[$_smarty_tpl->tpl_vars['listing']->value['id']] ?? null)===null||$tmp==='' ? "-" ?? null : $tmp);?>
 <?php $_block_plugin25 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin25, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin25->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>applicants<?php $_block_repeat=false;
echo $_block_plugin25->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
																															</a>
																														<?php }?>
																													<?php }?>
																													<?php if ($_smarty_tpl->tpl_vars['listing']->value['application_redirects']) {?>
																														<?php if ($_smarty_tpl->tpl_vars['apps']->value[$_smarty_tpl->tpl_vars['listing']->value['id']]) {?>/<?php }?>
																														<?php echo $_smarty_tpl->tpl_vars['listing']->value['application_redirects'];?>
 <?php $_block_plugin26 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin26, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin26->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>apply clicks<?php $_block_repeat=false;
echo $_block_plugin26->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
																													<?php }?>
																												</div>
																											<?php }?>
																										</div>-->
                        <?php if ($_smarty_tpl->tpl_vars['listingTypeID']->value == 'resume') {?>
                        <a class="link" href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/edit-resume/Interests/<?php echo $_smarty_tpl->tpl_vars['listing']->value['id'];?>
">
                            <span class="<?php if ($_smarty_tpl->tpl_vars['listingTypeID']->value == 'job') {?> btns <?php } else { ?> btns bt2<?php }?>">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                Modifier votre CV</span>
                        </a>
                        <?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', "updateDate", null);
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'date' ][ 0 ], array( $_smarty_tpl->tpl_vars['update_date']->value ));
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
                        <?php }?>
                        <?php if (!empty($_smarty_tpl->tpl_vars['updateDate']->value) && $_smarty_tpl->tpl_vars['updateDate']->value != "30/11/-1") {?>

                        <div class="listing-item__info--item-date ">
                            <b>Derni&egrave;re mise &agrave; jour:
                            </b>
                            <span <?php if (($_smarty_tpl->tpl_vars['today_date_3month']->value < $_smarty_tpl->tpl_vars['update_date_3month']->value) && $_smarty_tpl->tpl_vars['percentage']->value > 89) {?> style="color: #83ca4e;"<?php }?>><?php echo $_smarty_tpl->tpl_vars['updateDate']->value;?>
</span>
                        </div>

                        <?php }?>
                        <div class="listing-item__info--item-date ">
                            <b>Date activation:
                            </b>
                            <span><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'date' ][ 0 ], array( $_smarty_tpl->tpl_vars['listing']->value['activation_date'] ));?>

                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div>
                        <?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['current_user']['group']['id'] == 'Employer') {?>
                        <a href="<?php if ($_smarty_tpl->tpl_vars['listingTypeID']->value == 'resume') {
echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/edit-resume/Interests/<?php echo $_smarty_tpl->tpl_vars['listing']->value['id'];
} else {
echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/edit-<?php echo mb_strtolower((string) $_smarty_tpl->tpl_vars['listing']->value['type']['id'], 'UTF-8');?>
/?listing_id=<?php echo $_smarty_tpl->tpl_vars['listing']->value['id'];
}?>"
                            class="btns">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                            Editer l&acute;offre</a>



                        <?php if (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'status' ][ 0 ], array( $_smarty_tpl->tpl_vars['listing']->value['active'] )) == 'active') {?>

                        <?php } elseif (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'status' ][ 0 ], array( $_smarty_tpl->tpl_vars['listing']->value['active'] )) == 'pending') {?>

                        <?php } elseif ($_smarty_tpl->tpl_vars['listing']->value['expiration_date'] && time() > strtotime($_smarty_tpl->tpl_vars['listing']->value['expiration_date'])) {?>
                        <a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/pay-for-listing/?listing_id=<?php echo $_smarty_tpl->tpl_vars['listing']->value['id'];?>
" class="btns">
                            <?php $_block_plugin27 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin27, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin27->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Make Visible<?php $_block_repeat=false;
echo $_block_plugin27->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
                        </a>
                        <?php } else { ?>

                        <?php }?>

                        <br>

                        <?php if ($_smarty_tpl->tpl_vars['apps']->value[$_smarty_tpl->tpl_vars['listing']->value['id']] || !$_smarty_tpl->tpl_vars['listing']->value['application_redirects']) {?>
                        <?php if ($_smarty_tpl->tpl_vars['apps']->value[$_smarty_tpl->tpl_vars['listing']->value['id']]) {?>
                        <a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/system/applications/view/?appJobId=<?php echo $_smarty_tpl->tpl_vars['listing']->value['id'];?>
" class="btns ">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                            Voir les canditatures</a>
                        <?php }?>
                        <?php }?>
                        <?php }?>
                    </div>
                    <div class="listing-item__views">
                        <?php echo $_smarty_tpl->tpl_vars['listing']->value['views'];?>
 <?php $_block_plugin28 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin28, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin28->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>views<?php $_block_repeat=false;
echo $_block_plugin28->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
                    </div>
                    <?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['current_user']['group']['id'] == 'Employer') {?>
                    <div class="listing-item__applies">
                        <?php if ($_smarty_tpl->tpl_vars['apps']->value[$_smarty_tpl->tpl_vars['listing']->value['id']] || !$_smarty_tpl->tpl_vars['listing']->value['application_redirects']) {?>
                        <?php if (!$_smarty_tpl->tpl_vars['apps']->value[$_smarty_tpl->tpl_vars['listing']->value['id']]) {?>
                        0 <?php $_block_plugin29 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin29, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin29->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>applicants<?php $_block_repeat=false;
echo $_block_plugin29->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
                        <?php } else { ?>
                        <a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/system/applications/view/?appJobId=<?php echo $_smarty_tpl->tpl_vars['listing']->value['id'];?>
" class="link">
                            <?php echo (($tmp = $_smarty_tpl->tpl_vars['apps']->value[$_smarty_tpl->tpl_vars['listing']->value['id']] ?? null)===null||$tmp==='' ? "-" ?? null : $tmp);?>
 <?php $_block_plugin30 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin30, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin30->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>applicants<?php $_block_repeat=false;
echo $_block_plugin30->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
                        </a>
                        <?php }?>
                        <?php }?>
                        <?php if ($_smarty_tpl->tpl_vars['listing']->value['application_redirects']) {?>
                        <?php if ($_smarty_tpl->tpl_vars['apps']->value[$_smarty_tpl->tpl_vars['listing']->value['id']]) {?>/<?php }?>
                        <?php echo $_smarty_tpl->tpl_vars['listing']->value['application_redirects'];?>
 <?php $_block_plugin31 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin31, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin31->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>apply clicks<?php $_block_repeat=false;
echo $_block_plugin31->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
                        <?php }?>
                    </div>

                    <?php }?>

                    <?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['current_user']['group']['id'] == "Employer") {?>
                    <?php if ($_smarty_tpl->tpl_vars['listingTypeID']->value == 'job') {?>
                    <?php if (call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'status' ][ 0 ], array( $_smarty_tpl->tpl_vars['listing']->value['active'] )) == 'active') {?>
                    <?php if (!$_smarty_tpl->tpl_vars['listing']->value['featured']) {?>
                    <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/products/?permission=post_job/" class="form boost">
                        <input type="hidden" name="action" value="view_product_detail">
                        <input type="hidden" name="event" value="add_product">
                        <input type="hidden" name="product_sid" value="38">
                        <input type="hidden" name="listing_id" value="<?php echo $_smarty_tpl->tpl_vars['listing']->value['id'];?>
">

                        <div class="form-group boost">
                            <input type="submit" name="proceed_to_boosting" value="Booster l'annonce"
                                class="btns btn-bleu">
                        </div>
                    </form>
                    <?php }?>
                    <?php }?>
                    <?php }?>
                    <?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['percentage']->value) {?>
                    <h4><?php $_block_plugin32 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin32, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin32->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Your resume is filled out by<?php $_block_repeat=false;
echo $_block_plugin32->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?> <?php echo $_smarty_tpl->tpl_vars['percentage']->value;?>
%</h4>
                    <?php if ($_smarty_tpl->tpl_vars['percentage']->value > 89) {?>
                    <a class="btn btn__blue "
                        href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/my-resume-details/<?php echo $_smarty_tpl->tpl_vars['listingIDforPDF']->value;?>
/?action=download_pdf_version">
                        Télécharger CV Jobsquare en PDF
                    </a>
                    <?php }?>
                    <div class="meter green nostripes">
                        <span id="progress" style="width: <?php echo $_smarty_tpl->tpl_vars['percentage']->value;?>
%;"></span>
                    </div>


                    <?php }?>
                </div>

            </article>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>


            <?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['current_user']['group']['id'] != 'Employer') {?>
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['module'][0], array( array('name'=>"classifieds",'function'=>"listings_user_profile",'items_count'=>"10",'listing_type'=>"Job",'listing_id'=>$_smarty_tpl->tpl_vars['listing']->value['id'],'title'=>$_smarty_tpl->tpl_vars['listing']->value['Title']),$_smarty_tpl ) );?>

            <?php }?>

            <button type="button"
                class="load-more btn btn__white <?php if ($_smarty_tpl->tpl_vars['listings_number']->value <= $_smarty_tpl->tpl_vars['listing_search']->value['listings_per_page']) {?>hidden<?php }?>"
                data-page="2">
                <?php $_block_plugin33 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin33, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin33->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Load more<?php $_block_repeat=false;
echo $_block_plugin33->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
            </button>
        </div>
    </div><?php }?>
    <?php if ($_smarty_tpl->tpl_vars['my_products']->value) {?><div class="col-sm-3 col-xs-12">
        <div class=" well my-account-products">
            <div class="profile__content">
                <h4><?php $_block_plugin34 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin34, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin34->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Purchased Products<?php $_block_repeat=false;
echo $_block_plugin34->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></h4>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['my_products']->value, 'contract');
$_smarty_tpl->tpl_vars['contract']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['contract']->value) {
$_smarty_tpl->tpl_vars['contract']->do_else = false;
?>
                <div class="contract-list" data-contract="<?php echo $_smarty_tpl->tpl_vars['contract']->value['id'];?>
">
                    <div class="contract-list--name">
                        <?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['contract']->value['product_info']['name'], ENT_QUOTES, 'UTF-8', true);?>

                        <!--<?php if ($_smarty_tpl->tpl_vars['contract']->value['product_info']['price']) {?> - <?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', 'contract_price', null);
$_block_plugin35 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin35, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array('type'=>'float'));
$_block_repeat=true;
echo $_block_plugin35->translate(array('type'=>'float'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['contract']->value['price'];
$_block_repeat=false;
echo $_block_plugin35->translate(array('type'=>'float'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['currencyFormat'][0], array( array('amount'=>$_smarty_tpl->tpl_vars['contract_price']->value),$_smarty_tpl ) );
}?>-->
                        <?php if ($_smarty_tpl->tpl_vars['contract']->value['product_info']['recurring']) {
$_block_plugin36 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin36, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin36->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>per <?php echo $_smarty_tpl->tpl_vars['contract']->value['product_info']['billing_cycle'];
$_block_repeat=false;
echo $_block_plugin36->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
}?>
                    </div>
                    <div class="contract-list--purchased"><?php $_block_plugin37 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin37, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin37->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Purchased<?php $_block_repeat=false;
echo $_block_plugin37->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>: <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'date' ][ 0 ], array( $_smarty_tpl->tpl_vars['contract']->value['creation_date'] ));?>
</div>
                    <?php if (!$_smarty_tpl->tpl_vars['contract']->value['product_info']['recurring']) {?>
                    <?php if ($_smarty_tpl->tpl_vars['contract']->value['expired_date']) {?><div class="contract-list--expires"><?php $_block_plugin38 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin38, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin38->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Expires<?php $_block_repeat=false;
echo $_block_plugin38->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>:
                        <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'date' ][ 0 ], array( $_smarty_tpl->tpl_vars['contract']->value['expired_date'] ));?>
</div><?php }?>
                    <?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['contract']->value['listingAmount']) {?>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['contract']->value['listingAmount'], 'stat');
$_smarty_tpl->tpl_vars['stat']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['stat']->value) {
$_smarty_tpl->tpl_vars['stat']->do_else = false;
?>
                    <div class="contract-list--listing-count"><?php echo $_smarty_tpl->tpl_vars['stat']->value['numPostings'];?>
/<?php $_block_plugin39 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin39, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin39->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['stat']->value['count'];
$_block_repeat=false;
echo $_block_plugin39->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
                        <!--<?php $_block_plugin40 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin40, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin40->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo strtolower($_smarty_tpl->tpl_vars['listingTypeName']->value);?>
s<?php $_block_repeat=false;
echo $_block_plugin40->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>-->
                        <?php $_block_plugin41 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin41, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin41->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>posted<?php $_block_repeat=false;
echo $_block_plugin41->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
                    </div>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    <?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['contract']->value['recurring']) {?>
                    <?php if ($_smarty_tpl->tpl_vars['contract']->value['recurring_status'] == 'active') {?>
                    <a href="#" class="contract-list--cancel link" data-toggle="modal"
                        data-target="#confirm-cancel"><?php $_block_plugin42 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin42, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin42->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Cancel<?php $_block_repeat=false;
echo $_block_plugin42->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a>
                    <?php } elseif ($_smarty_tpl->tpl_vars['contract']->value['recurring_status'] == 'canceled') {?>
                    <span class="label label-default"><?php $_block_plugin43 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin43, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin43->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Canceled<?php $_block_repeat=false;
echo $_block_plugin43->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></span>
                    <?php }?>
                    <?php }?>
                </div>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
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
                            <?php $_block_plugin44 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin44, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin44->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Are you sure you'd like to cancel your subscription?<?php $_block_repeat=false;
echo $_block_plugin44->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
                        </div>
                        <div class="form-group form-group__btns text-center">
                            <a href="#" class="confirm-cancel__yes btn btn__orange btn__bold">
                                <?php $_block_plugin45 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin45, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin45->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Yes<?php $_block_repeat=false;
echo $_block_plugin45->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
                            </a>
                            <button type="button" class="btn btn__white" data-dismiss="modal"><?php $_block_plugin46 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin46, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin46->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Cancel<?php $_block_repeat=false;
echo $_block_plugin46->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><?php }?>
    <?php if ($_smarty_tpl->tpl_vars['listingTypeID']->value == "resume") {?>
    <?php $_block_plugin47 = isset($_smarty_tpl->smarty->registered_plugins['block']['javascript'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['javascript'][0][0] : null;
if (!is_callable(array($_block_plugin47, '_tpl_javascript'))) {
throw new SmartyException('block tag \'javascript\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('javascript', array());
$_block_repeat=true;
echo $_block_plugin47->_tpl_javascript(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
    <?php echo '<script'; ?>
 type="text/javascript" language="JavaScript">var overall = <?php if ($_smarty_tpl->tpl_vars['listings_number']->value) {
echo $_smarty_tpl->tpl_vars['listings_number']->value;
} else { ?>0<?php }?>;
            $('.load-more').click(function () {
                var self = $(this);
                self.addClass('loading');
                $.get('?searchId=<?php echo $_smarty_tpl->tpl_vars['searchId']->value;?>
&action=search&page=' + self.data('page'), function (data) {
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
    <?php echo '</script'; ?>
>
    <?php $_block_repeat=false;
echo $_block_plugin47->_tpl_javascript(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
    <?php } else { ?>

    <?php $_block_plugin48 = isset($_smarty_tpl->smarty->registered_plugins['block']['javascript'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['javascript'][0][0] : null;
if (!is_callable(array($_block_plugin48, '_tpl_javascript'))) {
throw new SmartyException('block tag \'javascript\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('javascript', array());
$_block_repeat=true;
echo $_block_plugin48->_tpl_javascript(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
    <?php echo '<script'; ?>
 type="text/javascript" language="JavaScript">
            var overall = <?php if ($_smarty_tpl->tpl_vars['listings_number']->value) {
echo $_smarty_tpl->tpl_vars['listings_number']->value;
} else { ?>0<?php }?>;
                $('.load-more').click(function () {
                    var self = $(this);
                    self.addClass('loading');
                    $.get('?searchId=<?php echo $_smarty_tpl->tpl_vars['searchId']->value;?>
&action=search&page=' + self.data('page'), function (data) {
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
    <?php echo '</script'; ?>
>

    <?php echo '<script'; ?>
>


                var wrap = $("#my-account-title");

                wrap.on("scroll", function (e) {

                    if (this.scrollTop > 147) {
                        wrap.addClass("fix-search");
                    } else {
                        wrap.removeClass("fix-search");
                    }

                });<?php echo '</script'; ?>
>
    <?php $_block_repeat=false;
echo $_block_plugin48->_tpl_javascript(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
    <?php }?>
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

    <?php }
}
