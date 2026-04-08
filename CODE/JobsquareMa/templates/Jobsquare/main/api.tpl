<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->


    <meta name="keywords" content="{$KEYWORDS|escape}">
    <meta name="description" content="{$DESCRIPTION|escape}">
    <meta name="viewport" content="width=device-width, height=device-height,
                                   initial-scale=1.0, maximum-scale=1.0,
                                   target-densityDpi=device-dpi">
    <link rel="alternate" type="application/rss+xml" title="[[Jobs]]" href="{$GLOBALS.site_url}/rss/">


    <title>{if $TITLE}{tr}{$TITLE}{/tr|escape} | {/if}{$GLOBALS.settings.site_title}</title>
    [[$HEAD]]
<link href="https://fonts.googleapis.com/css?family=Arsenal:400,700|Source+Sans+Pro:300,400,600,700" rel="stylesheet">
    <link href="{$GLOBALS.site_url}/templates/Jobsquare/assets/third-party/jquery-ui.css" rel="stylesheet">
    <link href="{$GLOBALS.site_url}/templates/Jobsquare/vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{$GLOBALS.site_url}/system/ext/jquery/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">




    <link href="{$GLOBALS.site_url}/templates/Jobsquare/assets/style/styles.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400" rel="stylesheet">
   
    <style type="text/css">{$GLOBALS.theme_settings.custom_css}</style>
    <!-- Ajout pour nouveau style  Ched  -->
{if $GLOBALS.current_user.logged_in}




    {if $GLOBALS.current_user.group.id == "Employer"}
    <link href="{$GLOBALS.site_url}/templates/Jobsquare/assets/style/jobseeker/jobseeker.css" rel="stylesheet">
        {else }
        <link href="{$GLOBALS.site_url}/templates/Jobsquare/assets/style/jobseeker/resume.css" rel="stylesheet">
            {/if}
           
{/if}
        <!-- Ajout pour nouveau style  -->  


        <!-- Ajout pour nouveau style  -->  
    {$GLOBALS.theme_settings.custom_js}
</head>






   
<body class="tinyheader head2 page-my-listings">
    {include file="../menu/headerjob.tpl"}
    {include file="./api.html"}
   
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="{$GLOBALS.site_url}/templates/Jobsquare/assets/third-party/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{$GLOBALS.site_url}/templates/Jobsquare/vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>


    <script src="{$GLOBALS.site_url}/templates/Jobsquare/assets/third-party/jquery-ui.min.js"></script>


    <script language="JavaScript" type="text/javascript" src="{common_js}/main.js"></script>
    <script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/templates/Jobsquare/assets/third-party/jquery.form.min.js"></script>
    <script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/system/ext/jquery/jquery.validate.min.js"></script>
    <script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/templates/Jobsquare/common_js/autoupload_functions.js"></script>
    <script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/system/ext/jquery/imagesize.js"></script>
    <link rel="Stylesheet" type="text/css" href="{$GLOBALS.site_url}/system/ext/jquery/css/jquery.multiselect.css" />
    <script language="JavaScript" type="text/javascript" src="{$GLOBALS.user_site_url}/system/ext/jquery/multilist/jquery.multiselect.min.js"></script>
    <script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/templates/Jobsquare/common_js/multilist_functions.js"></script>
    <script>
        document.addEventListener("touchstart", function() { }, false);


        var langSettings = {
            thousands_separator : '{$GLOBALS.current_language_data.thousands_separator}',
            decimal_separator : '{$GLOBALS.current_language_data.decimal_separator}',
            decimals : '{$GLOBALS.current_language_data.decimals}',
            currencySign: '{currencySign}',
            showCurrencySign: 1,
            currencySignLocation: '{$GLOBALS.current_language_data.currencySignLocation}',
            rightToLeft: {$GLOBALS.current_language_data.rightToLeft}
        };
    </script>
    <script language="JavaScript" type="text/javascript" src="{common_js}/floatnumbers_functions.js"></script>


    <script language="JavaScript" type="text/javascript" src="{$GLOBALS.site_url}/system/ext/jquery/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    {if isset( $GLOBALS.available_datepicker_localizations[$GLOBALS.current_language] )}
        <script type="text/javascript" src="{$GLOBALS.site_url}/system/ext/jquery/bootstrap-datepicker/i18n/bootstrap-datepicker.{$GLOBALS.current_language}.min.js" ></script>
    {/if}


    <script language="javascript" type="text/javascript">


        // Set global javascript value for page
        window.SJB_GlobalSiteUrl = '{$GLOBALS.site_url}';
        window.SJB_UserSiteUrl   = '{$GLOBALS.user_site_url}';


    </script>


   




    {js}




    <link rel="stylesheet" type="text/css" href="{$GLOBALS.site_url}/templates/Jobsquare/assets/style/cookieconsent.min.css" />
<script src="{$GLOBALS.site_url}/templates/Jobsquare/assets/third-party/cookieconsent.min.js" data-cfasync="false"></script>




<style>
    .mt-10 { margin-top:10px}
.mt-20 { margin-top:20px}
.mt-30 { margin-top:30px}
.mt-40 { margin-top:40px}
.mt-50 { margin-top:50px}




.mb-10 { margin-bottom:10px}
.mb-20 { margin-bottom:20px}
.mb-30 { margin-bottom:30px}
.mb-40 { margin-bottom:40px}
.mb-50 { margin-bottom:50px}
.pt-150 { padding-top:150px}
.pb-150 { padding-bottom:150px}










.menu_principal .nav.navbar-nav.navbar-left li:nth-child(4),
.menu_principal .nav.navbar-nav.navbar-left li:nth-child(5),
.menu_principal .nav.navbar-nav.navbar-left li:nth-child(6),
.menu_principal .nav.navbar-nav.navbar-left li:nth-child(7),
.menu_principal .nav.navbar-nav.navbar-left li:nth-child(8)
 { display:none}


      body {
            font-family: 'Source Sans Pro', Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            line-height: 1.6;
        }
       
</style>
</body>
</html>

