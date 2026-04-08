<html>
<head>
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400&display=swap" rel="stylesheet">
<style>       
     
	  
	  .bloc { border-top: 1px solid #0055d9; border-left: 0.05em solid #ececec;   border-right: 0.05em solid #ececec;    border-bottom: 0.05em solid #ececec; margin-bottom:20px; padding-top:10px; text-align:justify; padding:10px; }
	  .bloc-info { margin-bottom:10px; text-align:center;   }
	  .blocimg  { height:50px; overflow:hidden; border-radius:50px ; position: relative; text-align:center;
    display: block;}
	  
	  h3 {
    color: #0055d9;
    font-weight: 500;
    font-size: 13px; text-align:left;
}
    
		  .titre-cv {
    color: #0055d9;
    font-weight: 500;
    font-size: 13px; text-align:center;
}
    
	  strong, h4 {
    color: #413f50;
    font-weight: 500;
    font-size: 12px;
}
    	.bleu { color: #0055d9;}
		ul { padding-left:10px; margin-left:10px}
		
		
.linkedin { color:#2d7aaf; }
.facebook { color:#395aa1; }
.twitter { color:#1077b1; }
.youtube { color:#e04b37; }
.behance { color:#000000; }
.instagram { color:#8134af; }
.github { color:#1a1e22; }
.stackoverflow { color:#ec7c23; }
.blog { color:#e78130; }
.siteperso { color:#333333; }
.main-table { font-size:10px; font-family: 'Open Sans', sans-serif; font-weight: 300;}
	.rounded { border-radius:10px}
	.trait { border-bottom:1px slid #ccc}
	</style>

</head>
<body>


<table class="main-table" >

<tr>
<td  width="35%" valign="top">
{if $listing.Photo.file_url}
<div class="blocimg" >
<img width="100" src="{$listing.Photo.file_url}"  class="rounded"/>
</div>
{/if}
<div class="bloc-info" >
<table><tr><td align="center">
<div class="titre-cv" >{$listing.user.FullName}</div><br>
{$listing.Title|escape}<br>
{foreach from=$form_fields item=list_value}
    {if !$list_value.is_reserved}
	
	{if  $list_value.id == 'id_Resume_careerlevel'}
	{*<table cellpadding="15">*}
				
				<tr>
					<td colspan="2">{display property=$list_value.id}<br> <span class="bleu">{display property='Experience'}</span></td>
				</tr>
{*</table>*}
	{/if}{/if}{/foreach}
	</td></tr></table>
</div>
<div class="bloc">

<br>
         <div>&nbsp;&nbsp;<img style="height: 12px; " src="{$GLOBALS.site_url}/templates/Jobsquare/assets/images/mail.png" />&nbsp;&nbsp;{$listing.user.username}</div>
            {if $listing.Phone}
				<div>&nbsp;&nbsp;<img style="height: 12px; "  src="{$GLOBALS.site_url}/templates/Jobsquare/assets/images/phone.png" />&nbsp;&nbsp;{$listing.Phone}</div>
            {/if}
		 {if $listing.OtherPhone} <div> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$listing.OtherPhone}</div>{/if}
            
			{if $listing|location}
			
			{assign var=Emplacement value=$listing.Location}
			<div>&nbsp;&nbsp;<img style="height: 12px; "  src="{$GLOBALS.site_url}/templates/Jobsquare/assets/images/map.png" />&nbsp;&nbsp;{$listing|location}{if $Emplacement.ZipCode},  {$Emplacement.ZipCode}{/if}</div>
			<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{if $Emplacement.State}{$Emplacement.State}{/if}{if $Emplacement.City}, {$Emplacement.City}{/if}{if $Emplacement.Country}, {$Emplacement.Country}{/if}</div>
           
{/if}

            {if $listing.EmploymentType}
				<div>&nbsp;&nbsp;<img style="height: 12px; "  src="{$GLOBALS.site_url}/templates/Jobsquare/assets/images/clock.png" />&nbsp;&nbsp;{display property='EmploymentType'}</div>
            {/if}
			
			
			
			 {if $listing.Licence||$listing.Motorized }<br>
			<div>&nbsp;&nbsp;&nbsp;&nbsp;{if $listing.Licence}Permis de conduire {/if}{if $listing.Motorized}-Motorisé{/if}</div>
			 {/if}
			 </div>


{if $listing.JobCategory}
<div class="bloc">

<br>

{*<table cellpadding="15">*}
				<tr>
					<th  style=" border-bottom: 1px solid red;"><h3  >
				Intéressé par:
</h3></th></tr>
				
					{foreach from=$listing.JobCategory item=list_value name="multifor"}
					<tr>
					<td >&nbsp;&nbsp;<img style="height: 10px;"  src="{$GLOBALS.site_url}/templates/Jobsquare/assets/images/check.png" />&nbsp;&nbsp;{$list_value}</td>
                        {if $smarty.foreach.multifor.index % 2 == 1 && !$smarty.foreach.foo.last}
							
                        {/if}
						</tr>
                    {/foreach}
					{*</table>*}
					


</div>
            {/if}

<div class="bloc">


{foreach from=$form_fields item=list_value}
    {if !$list_value.is_reserved}
	
	{if  $list_value.id == 'id_Resume_careerlevel'}
	
			
        {elseif !$list_value.id != 'Location' && {display property=$list_value.id}}
	
			{*<table cellpadding="15">*}
				<tr>
					<th  style=" border-bottom: 1px solid red;"><h3  >[[{$list_value.caption|escape}]]</h3></th>
					<th  style=" border-bottom: 1px solid red;"></th>

				</tr>
				<tr>
					<td colspan="2">{display property=$list_value.id}</td>
				</tr>
			{*</table>*}
				
			
			
        {/if}
    {/if}
{/foreach}


</div>
</td>
<td width="2%"></td>
<td width="63%" border-top="1" valign="top">





{if $listing.Skills}
<div class="bloc" >
	{*<table cellpadding="15">*}
	<tr  style="border-top: 1px solid #0055d9; margin-bottom:10px">
		<th >
		<h3  >[[{$form_fields.Skills.caption|escape}]]</h3></th>
		
	</tr>
	<tr>
		<td >{display property='Skills'}</td>
	</tr>
	{*</table>*}
	</div>
{/if}




{if $listing.WorkExperience}
<div class="bloc" >
	{*<table cellpadding="15" >*}
		<tr style="border-top: 1px solid #0055d9; margin-bottom:10px">
			<th  style="background-color:#1F2F42; border-bottom: 1px solid #1F2F42;"><h3   >[[{$form_fields.WorkExperience.caption|escape}]]</h3></th>
			<th  style=" border-bottom: 1px solid #1F2F42;"></th>

		</tr>
		<tr>
			<td colspan="2">{display property='WorkExperience' template="complex_for_pdf.tpl"}</td>
		</tr>
		
	{*</table>*}
	
</div>
{/if}









{if $listing.Education}
<div class="bloc">
	{*<table cellpadding="15">*}
		<tr style="border-top: 1px solid #0055d9; margin-bottom:10px">
			<th  style="background-color:#1F2F42; border-bottom: 1px solid #1F2F42;"><h3  >[[{$form_fields.Education.caption|escape}]]s</h3></th>
			<th  style=" border-bottom: 1px solid #1F2F42;"></th>
		</tr>
		<tr>
			<td colspan="2">
                {display property='Education' template="complex_for_pdf.tpl"}
			</td>
		</tr>

	{*</table>*}
	</div>
{/if}










 {if $listing.Linkedin_link || $listing.Facebook_link || $listing.Twitter_link || $listing.Behance_link || $listing.Instagram_link || $listing.GitHub_link || $listing.StackOverflow_link || $listing.YouTube_link || $listing.Blog_link || $listing.Website_link || $listing.Other_link}
	<div class="bloc" style="font-size:11px;">
	{*<table cellpadding="15">*}
	<tr>
		<th ><h3 >Présence en ligne</h3></th>
		
	</tr><tr><td>
	
		{if $listing.Linkedin_link}<span class="linkedin"><img style="height: 12px; "  src="{$GLOBALS.site_url}/templates/Jobsquare/assets/images/icon-linkedin.png" /> </span>{$listing.Linkedin_link}<br>{/if}
		{if $listing.Facebook_link}<span class="facebook"><img style="height: 12px; "  src="{$GLOBALS.site_url}/templates/Jobsquare/assets/images/icon-facebook.png" /> </span>{$listing.Facebook_link}<br>{/if}
		{if $listing.Twitter_link}<span class="twitter"><img style="height: 12px; "  src="{$GLOBALS.site_url}/templates/Jobsquare/assets/images/icon-twitter.png" /> </span>{$listing.Twitter_link}<br>{/if}
		{if $listing.Behance_link}<span class="behance"><img style="height: 12px; "  src="{$GLOBALS.site_url}/templates/Jobsquare/assets/images/icon-behance.png" /> </span>{$listing.Behance_link}<br>{/if}
		{if $listing.Instagram_link}<span class="instagram"><img style="height: 12px; "  src="{$GLOBALS.site_url}/templates/Jobsquare/assets/images/icon-instagram.png" /> </span>{$listing.Instagram_link}<br>{/if}
		{if $listing.GitHub_link}<span class="github"><img style="height: 12px; "  src="{$GLOBALS.site_url}/templates/Jobsquare/assets/images/icon-github.png" /> </span>{$listing.GitHub_link}<br>{/if}
		{if $listing.StackOverflow_link}<span class="stackoverflow"><img style="height: 12px; "  src="{$GLOBALS.site_url}/templates/Jobsquare/assets/images/icon-stackoverflow.png" /> </span>{$listing.StackOverflow_link}<br>{/if}
		{if $listing.YouTube_link}<span class="youtube"><img style="height: 12px; "  src="{$GLOBALS.site_url}/templates/Jobsquare/assets/images/icon-youtube.png" /> </span>{$listing.YouTube_link}<br>{/if}
		{if $listing.Blog_link}<span class="blog"><img style="height: 12px; "  src="{$GLOBALS.site_url}/templates/Jobsquare/assets/images/icon-blog.png" /> </span>{$listing.Blog_link}<br>{/if}
		{if $listing.Website_link}<span class="siteperso">Site web personnel: </span>{$listing.Website_link}<br>{/if}
		{if $listing.Other_link}<span>Autre: </span>{$listing.Other_link}{/if}
		
		
		
		
		
	</td></tr>
	{*</table>*}
	
	</div>
{/if}

</td>
</tr></table>

</body>
</html>