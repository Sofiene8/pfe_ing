{assign var="complexField" value=$id scope=global} {* nwy: Если не очистить переменную то в последующих полях начинаются проблемы (некоторые воспринимаются как комплексные)*}
{if $complexField == "Education"}

	{foreach from=$complexElements key="complexElementKey" item="complexElementItem"}
        {if {display property='ED_DegreeSpecialty' complexParent=$complexField complexStep=$complexElementKey}}
            <h4>{display property='ED_DegreeSpecialty' complexParent=$complexField complexStep=$complexElementKey}</h4><br>
        {/if}
        {if {display property="ED_From" complexParent=$complexField complexStep=$complexElementKey} || {display property='ED_To' complexParent=$complexField complexStep=$complexElementKey}}
			<img style="height: 12px; " src="{$GLOBALS.site_url}/templates/Jobsquare/assets/images/calendar-pdf.png">&nbsp;
            {display property="ED_From" complexParent=$complexField complexStep=$complexElementKey format="%b %Y"} - {if {display property='ED_To' complexParent=$complexField complexStep=$complexElementKey format="%b %Y"}}{display property='ED_To' complexParent=$complexField complexStep=$complexElementKey format="%b %Y"}{else}Aujourd'hui{/if}

        {/if}
        {if {display property='ED_UniversityInstitution' complexParent=$complexField complexStep=$complexElementKey}}
			&nbsp;&nbsp; | &nbsp;&nbsp;
            {display property='ED_UniversityInstitution' complexParent=$complexField complexStep=$complexElementKey}<br>
        {/if}
		<br>
	{/foreach}

{elseif $complexField == "WorkExperience"}

	{foreach from=$complexElements key="complexElementKey" item="complexElementItem"}
		{if {display property='WE_JobTitle' complexParent=$complexField complexStep=$complexElementKey}}
			<h4>{display property='WE_JobTitle' complexParent=$complexField complexStep=$complexElementKey}</h4><br>
		{/if}
		{if {display property="WE_From" complexParent=$complexField complexStep=$complexElementKey} || {display property='WE_To' complexParent=$complexField complexStep=$complexElementKey}}
					<img style="height: 12px; " src="{$GLOBALS.site_url}/templates/Jobsquare/assets/images/calendar-pdf.png" />&nbsp;
						{display property="WE_From" complexParent=$complexField complexStep=$complexElementKey format="%b %Y"} - {if {display property='WE_To' complexParent=$complexField complexStep=$complexElementKey format="%b %Y"}}{display property='WE_To' complexParent=$complexField complexStep=$complexElementKey format="%b %Y"}{else}Aujourd'hui{/if}


				{/if}
				{if {display property='WE_Company' complexParent=$complexField complexStep=$complexElementKey}}
					 à <strong>{display property='WE_Company' complexParent=$complexField complexStep=$complexElementKey}</strong>
				{/if}

			{if {display property='WE_Description' complexParent=$complexField complexStep=$complexElementKey}}
				{display property='WE_Description' complexParent=$complexField complexStep=$complexElementKey}<br>
			{/if}
			<div style="border-bottom:1px solid #f7f7f7;"></div>
<div>&nbsp;</div>
	{/foreach}
{else}
	{foreach from=$complexElements key="complexElementKey" item="complexElementItem"}
		<div class="complexField">
			{foreach from=$form_fields key=k item=form_field}
				{capture name="displayPropertyValue"}{display property=$form_field.id complexParent=$complexField complexStep=$complexElementKey}{/capture}
				{if $smarty.capture.displayPropertyValue}
					<fieldset>
						<span class="strong"> {tr}{$form_field.caption}{/tr|escape}:&nbsp;</span>
						{$smarty.capture.displayPropertyValue}
					</fieldset>
				{/if}
			{/foreach}
		</div>
	{/foreach}

{/if}
{assign var="complexField" value=false scope=global} {* nwy: Если не очистить переменную то в последующих полях начинаются проблемы (некоторые воспринимаются как комплексные)*}
