
<table cellpadding="5" border="0">
	<tr>
		<td width="70%"><h3 style="color: #1F2F42;">{$listing.user.FullName}</h3>
		<br>
		<div class="b2">&nbsp;<img style="height: 14px; " src="{$GLOBALS.site_url}/templates/Jobsquare/assets/images/mail.png" />&nbsp;&nbsp;&nbsp;&nbsp;{$listing.user.username}<br>
            {if $listing.Phone}
				<img style="height: 14px; " src="{$GLOBALS.site_url}/templates/Jobsquare/assets/images/phone.png" />&nbsp;&nbsp;&nbsp;&nbsp;{$listing.Phone}<br>
            {/if}
			<img style="height: 14px; " src="{$GLOBALS.site_url}/templates/Jobsquare/assets/images/workBlue.png" />&nbsp;&nbsp;&nbsp;&nbsp;{$listing.Title|escape}<br>
            {if $listing|location}
				<img style="height: 14px; " src="{$GLOBALS.site_url}/templates/Jobsquare/assets/images/map.png" />&nbsp;&nbsp;&nbsp;&nbsp;{$listing|location}<br>
            {/if}

            {if $listing.EmploymentType}
				<img style="height: 14px; " src="{$GLOBALS.site_url}/templates/Jobsquare/assets/images/clock.png" />&nbsp;&nbsp;&nbsp;&nbsp;{display property='EmploymentType'}<br>
            {/if}
			
			
			
			 {if $listing.Licence}<img style="height: 14px; " src="{$GLOBALS.site_url}/templates/Jobsquare/assets/images/clock.png" />&nbsp;&nbsp;&nbsp;&nbsp;Permis de conduire {/if}{if $listing.Motorized}-Motorisé{/if}<br>	</div>
		
		
		</td>
		<td width="30%" rowspan="2">
            {if $listing.Photo.file_url}
				<div class="b1" style="width:100px; height:100%; overflow:hidden; border-radius:50%"><img width="250" src="{$listing.Photo.file_url}" ></div>
{/if}
		</td>
	</tr>
	
	<tr>
		<td>
				 
						
            {if $listing.JobCategory}
				<br>
				<table>
					<tr>
					{foreach from=$listing.JobCategory item=list_value name="multifor"}
							<td><img style="height: 14px; " src="{$GLOBALS.site_url}/templates/Jobsquare/assets/images/check.png" />&nbsp;&nbsp;&nbsp;&nbsp;{tr}{$list_value}{/tr|escape}</td>
                        {if $smarty.foreach.multifor.index % 2 == 1 && !$smarty.foreach.foo.last}
							</tr><tr>
                        {/if}
                    {/foreach}
					</tr>
				</table>
            {/if}
		</td>

	</tr>
</table>
<table cellpadding="7">
{if $listing.Skills}
	{*<table cellpadding="15">*}
	<tr>
		<th style="min-width:10%;background-color:#1F2F42; border-bottom: 1px solid #1F2F42;"><h3 style="color: white;">[[{$form_fields.Skills.caption|escape}]]</h3></th>
		<th style=" border-bottom: 1px solid #1F2F42;"></th>
	</tr>
	<tr>
		<td colspan="2">{display property='Skills'}</td>
	</tr>
	{*</table>*}
{/if}
{if $listing.WorkExperience}
	{*<table cellpadding="15">*}
		<tr>
			<th  style="background-color:#1F2F42; border-bottom: 1px solid #1F2F42;"><h3 style="color: white;">[[{$form_fields.WorkExperience.caption|escape}]]</h3></th>
			<th  style=" border-bottom: 1px solid #1F2F42;"></th>

		</tr>
		<tr>
			<td colspan="2">{display property='WorkExperience' template="complex_for_pdf.tpl"}</td>
		</tr>
	{*</table>*}
{/if}

{if $listing.Education}
	{*<table cellpadding="15">*}
		<tr>
			<th  style="background-color:#1F2F42; border-bottom: 1px solid #1F2F42;"><h3 style="color: white;">[[{$form_fields.Education.caption|escape}]]s</h3></th>
			<th  style=" border-bottom: 1px solid #1F2F42;"></th>
		</tr>
		<tr>
			<td colspan="2">
                {display property='Education' template="complex_for_pdf.tpl"}
			</td>
		</tr>

	{*</table>*}
{/if}
{foreach from=$form_fields item=list_value}
    {if !$list_value.is_reserved}
	
	{if  $list_value.id == 'id_Resume_careerlevel'}
	{*<table cellpadding="15">*}
				<tr>
					<th  style="background-color:#1F2F42; border-bottom: 1px solid #1F2F42;"><h3 style="color: white;">[[{$list_value.caption|escape}]]</h3></th>
					<th  style=" border-bottom: 1px solid #1F2F42;"></th>

				</tr>
				<tr>
					<td colspan="2">{display property=$list_value.id}- {display property='Experience'}</td>
				</tr>
			{*</table>*}
        {elseif !$list_value.id != 'Location' && {display property=$list_value.id}}
			{*<table cellpadding="15">*}
				<tr>
					<th  style="background-color:#1F2F42; border-bottom: 1px solid #1F2F42;"><h3 style="color: white;">[[{$list_value.caption|escape}]]</h3></th>
					<th  style=" border-bottom: 1px solid #1F2F42;"></th>

				</tr>
				<tr>
					<td colspan="2">{display property=$list_value.id}</td>
				</tr>
			{*</table>*}
				
			
			
        {/if}
    {/if}
{/foreach}
 {if $listing.salary}
							{*<table cellpadding="15">*}
				<tr>
					<th  style="background-color:#1F2F42; border-bottom: 1px solid #1F2F42;"><h3 style="color: white;">Salaire Minimum</h3></th>
					<th  style=" border-bottom: 1px solid #1F2F42;"></th>

				</tr>
				<tr>
					<td colspan="2">{display property='salary'}  DT/mois</td>
				</tr>
			{*</table>*}
						 {/if}
{if $listing.Linkedin_link || $listing.Facebook_link || $listing.Twitter_link || $listing.Behance_link || $listing.Instagram_link || $listing.GitHub_link || $listing.StackOverflow_link || $listing.YouTube_link || $listing.Blog_link || $listing.Website_link || $listing.Other_link}
	{*<table cellpadding="15">*}
	<tr>
		<th style="min-width:10%;background-color:#1F2F42; border-bottom: 1px solid #1F2F42;"><h3 style="color: white;">Présence en ligne</h3></th>
		<th style=" border-bottom: 1px solid #1F2F42;"></th>
	</tr>
	
		{if $listing.Linkedin_link}<tr><td colspan="2">Linkedin:{$listing.Linkedin_link}</td></tr>{/if}
		{if $listing.Facebook_link}<tr><td colspan="2">Facebook:{$listing.Facebook_link}</td></tr>{/if}
		{if $listing.Twitter_link}<tr><td colspan="2">Twitter:{$listing.Twitter_link}</td></tr>{/if}
		{if $listing.Behance_link}<tr><td colspan="2">Behance:{$listing.Behance_link}</td></tr>{/if}
		{if $listing.Instagram_link}<tr><td colspan="2">Instagram:{$listing.Instagram_link}</td></tr>{/if}
		{if $listing.GitHub_link}<tr><td colspan="2">GitHub:{$listing.GitHub_link}</td></tr>{/if}
		{if $listing.StackOverflow_link}<tr><td colspan="2">StackOver flow:{$listing.StackOverflow_link}</td></tr>{/if}
		{if $listing.YouTube_link}<tr><td colspan="2">YouTube:{$listing.YouTube_link}</td></tr>{/if}
		{if $listing.Blog_link}<tr><td colspan="2">Blog:{$listing.Blog_link}</td></tr>{/if}
		{if $listing.Website_link}<tr><td colspan="2">Site web personnel:{$listing.Website_link}</td></tr>{/if}
		{if $listing.Other_link}<tr><td colspan="2">Autre:{$listing.Other_link}</td></tr>{/if}
	
	{*</table>*}
	
	
{/if}


</table>