<html>
<head>
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400&display=swap" rel="stylesheet">
<style>       
     
	  
	  .bloc { border-top: 1px solid #0055d9; border-left: 1px solid #cccccc;   border-right: 1px solid #cccccc;    border-bottom: 1px solid #cccccc; margin-bottom:20px; padding-top:10px; text-align:justify; padding:10px; }
	  .bloc-info { margin-bottom:10px; text-align:center;   }
	  .blocimg  { height:50px; overflow:hidden; border-radius:50px ; position: relative; text-align:center;
    display: block;}
	  
	  h3 {
    color: #0055d9;
    font-weight: 500;
    font-size: 14px;
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
.main-table { font-size:10px; font-family: 'Open Sans', sans-serif;
}
	.rounded { border-radius:10px}
	</style>

</head>
<body>


<table class="main-table" >

<tr>
<td  width="30%" valign="top">
{if $listing.Photo.file_url}
				<div class="blocimg" >
				<img width="100" src="{$listing.Photo.file_url}"  class="rounded"/>
				</div>
{/if}
<div class="bloc-info" >
<table><tr><td align="center">
<h3 >{$listing.user.FullName}</h3><br>
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
         <img style="height: 12px; " src="{$GLOBALS.site_url}/templates/Jobsquare/assets/images/mail.png" />&nbsp;&nbsp;&nbsp;&nbsp;{$listing.user.username}<br>
            {if $listing.Phone}
				<img style="height: 12px; "  src="{$GLOBALS.site_url}/templates/Jobsquare/assets/images/phone.png" />&nbsp;&nbsp;&nbsp;&nbsp;{$listing.Phone}<br>
            {/if}
			
            {if $listing|location}
				<img style="height: 12px; "  src="{$GLOBALS.site_url}/templates/Jobsquare/assets/images/map.png" />&nbsp;&nbsp;&nbsp;&nbsp;{$listing|location}<br>
            {/if}

            {if $listing.EmploymentType}
				<img style="height: 12px; "  src="{$GLOBALS.site_url}/templates/Jobsquare/assets/images/clock.png" />&nbsp;&nbsp;&nbsp;&nbsp;{display property='EmploymentType'}<br>
            {/if}
			
			
			
			 {if $listing.Licence}<br>
			 Permis de conduire {/if}{if $listing.Motorized}-Motorisé{/if}<br>	
			 
			 </div>



<div class="bloc">
<br>
{if $listing.JobCategory}
				
				
					{foreach from=$listing.JobCategory item=list_value name="multifor"}
					<div>&nbsp;&nbsp;<img style="height: 10px;"  src="{$GLOBALS.site_url}/templates/Jobsquare/assets/images/check.png" />&nbsp;&nbsp;{$list_value}</div>
                        {if $smarty.foreach.multifor.index % 2 == 1 && !$smarty.foreach.foo.last}
							
                        {/if}
                    {/foreach}
					
            {/if}

</div>


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
<td width="3%"></td>
<td width="67%" border-top="1" valign="top">




<div class="bloc" >
{if $listing.Skills}
	{*<table cellpadding="15">*}
	<tr  style="border-top: 1px solid #0055d9; margin-bottom:10px">
		<th >
		<h3  >[[{$form_fields.Skills.caption|escape}]]</h3></th>
		
	</tr>
	<tr>
		<td >{display property='Skills'}</td>
	</tr>
	{*</table>*}
{/if}

</div>

<div class="bloc" >
{if $listing.WorkExperience}
	{*<table cellpadding="15" >*}
		<tr style="border-top: 1px solid #0055d9; margin-bottom:10px">
			<th  style="background-color:#1F2F42; border-bottom: 1px solid #1F2F42;"><h3   >[[{$form_fields.WorkExperience.caption|escape}]]</h3></th>
			<th  style=" border-bottom: 1px solid #1F2F42;"></th>

		</tr>
		<tr>
			<td colspan="2">{display property='WorkExperience' template="complex_for_pdf.tpl"}</td>
		</tr>
	{*</table>*}
{/if}


</div>





<div class="bloc">

{if $listing.Education}
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
{/if}

</div>






<div class="bloc" style="font-size:11px;">

 {if $listing.Linkedin_link || $listing.Facebook_link || $listing.Twitter_link || $listing.Behance_link || $listing.Instagram_link || $listing.GitHub_link || $listing.StackOverflow_link || $listing.YouTube_link || $listing.Blog_link || $listing.Website_link || $listing.Other_link}
	{*<table cellpadding="15">*}
	<tr>
		<th ><h3 >Présence en ligne</h3></th>
		
	</tr>
	
		{if $listing.Linkedin_link}<tr><td><span class="linkedin">Linkedin:</span>{$listing.Linkedin_link}</td></tr>{/if}
		{if $listing.Facebook_link}<tr><td><span class="facebook">Facebook:</span>{$listing.Facebook_link}</td></tr>{/if}
		{if $listing.Twitter_link}<tr><td><span class="twitter">Twitter:</span>{$listing.Twitter_link}</td></tr>{/if}
		{if $listing.Behance_link}<tr><td><span class="behance">Behance:</span>{$listing.Behance_link}</td></tr>{/if}
		{if $listing.Instagram_link}<tr><td><span class="instagram">Instagram:</span>{$listing.Instagram_link}</td></tr>{/if}
		{if $listing.GitHub_link}<tr><td><span class="github">GitHub:</span>{$listing.GitHub_link}</td></tr>{/if}
		{if $listing.StackOverflow_link}<tr><td><span class="stackoverflow">StackOver flow:</span>{$listing.StackOverflow_link}</td></tr>{/if}
		{if $listing.YouTube_link}<tr><td><span class="youtube">YouTube:</span>{$listing.YouTube_link}</td></tr>{/if}
		{if $listing.Blog_link}<tr><td><span class="blog">Blog:</span>{$listing.Blog_link}</td></tr>{/if}
		{if $listing.Website_link}<tr><td><span class="siteperso">Site web personnel:</span>{$listing.Website_link}</td></tr>{/if}
		{if $listing.Other_link}<tr><td><span>Autre:</span>{$listing.Other_link}</td></tr>{/if}
	
	{*</table>*}
	
	
{/if}</div>

</td>
</tr></table>

</body>
</html>