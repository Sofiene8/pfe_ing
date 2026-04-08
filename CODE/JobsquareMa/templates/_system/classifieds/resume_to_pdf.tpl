
<table cellpadding="5" border="0">
	<tr>
		<td width="70%"><h3 style="color: #1F2F42;">{$listing.user.FullName}</h3></td>
		<td width="30%" rowspan="2">
            {if $listing.Photo.file_url}
				<img width="250" src="{$listing.Photo.file_url}">
            {/if}
		</td>
	</tr>
	<tr>
		<td>
			&nbsp;<img style="height: 14px; " src="{$GLOBALS.site_url}/templates/Jobsquare/assets/images/mail.png" />&nbsp;&nbsp;&nbsp;&nbsp;{$listing.user.username}<br>
            {if $listing.Phone}
				<img style="height: 14px; " src="{$GLOBALS.site_url}/templates/Jobsquare/assets/images/phone.png" />&nbsp;&nbsp;&nbsp;&nbsp;{$listing.Phone}<br>
            {/if}
			<img style="height: 14px; " src="{$GLOBALS.site_url}/templates/Jobsquare/assets/images/workBlue.png" />&nbsp;&nbsp;&nbsp;&nbsp;{$listing.Title|escape}<br>
            {if $listing|location}
				<img style="height: 14px; " src="{$GLOBALS.site_url}/templates/Jobsquare/assets/images/map.png" />&nbsp;&nbsp;&nbsp;&nbsp;{$listing|location}<br>
            {/if}

            {if $listing.EmploymentType}
				<img style="height: 14px; " src="{$GLOBALS.site_url}/templates/Jobsquare/assets/images/clock.png" />&nbsp;&nbsp;&nbsp;&nbsp;{$listing.EmploymentType}<br>
            {/if}
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
			<th  style="background-color:#1F2F42; border-bottom: 1px solid #1F2F42;"><h3 style="color: white;">[[{$form_fields.Education.caption|escape}]]</h3></th>
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
        {if !$list_value.id != 'Location' && {display property=$list_value.id}}
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
</table>