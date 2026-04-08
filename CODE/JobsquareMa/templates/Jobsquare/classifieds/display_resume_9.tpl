{title} {$listing.Title} {/title}
{keywords} {$listing.Title} {/keywords}
{description} {$listing.Skills|strip_tags|truncate:165} {/description}

{* todo: Показывать алерт если юзер пришел из чекаута *}
{if $smarty.request.isBoughtNow}
	<div class="alert alert-bought-now text-center content-text">
		[[You have successfully posted your resume.]] <br/>
		<a href="{$GLOBALS.site_url}/my-listings/resume/" class="link">[[Edit your resume in "My Account" section]]</a>
		<a href="#" class="alert__close"></a>
	</div>
{/if}

{if $errors}
	<div>
		{foreach from=$errors key=error_code item=error_message}
			<p class="alert alert-danger">
				{if $error_code == 'NO_SUCH_FILE'} [[No such file found in the system]]{/if}
			</p>
		{/foreach}
	</div>
{else}

	{foreach from=$form_fields item=form_field}
	   
		
	      {if $form_field.id == 'id_Resume_careerlevel'}
					{assign var=id_Resume_careerlevel value=$form_field}
         {elseif $form_field.id == "EmploymentType"}	
					{assign var=EmploymentType value=$form_field}
	
		{elseif $form_field.id == "salary"}	
					{assign var=salary value=$form_field}
		{elseif $form_field.id == "id_Resume_CurrentStatus"}	
					{assign var=id_Resume_CurrentStatus value=$form_field}
	
				{/if} 

      	 	    {if $form_field.id == 'Objective'}
				{assign var=Objective value=$form_field}
   
		
		{elseif $form_field.id == "Motorized"}	
					{assign var=Motorized value=$form_field}
					{elseif $form_field.id == "GooglePlace"}	
					{assign var=GooglePlace value=$form_field}
		{elseif $form_field.id == "OtherPhone"}	
					{assign var=OtherPhone value=$form_field}
		{elseif $form_field.id == "Licence"}	
					{assign var=Licence value=$form_field}
	 	
		
		{/if} 
      	 	
		
         {if $form_field.id == "id_Job_Langue"}	
				{assign var=id_Job_Langue value=$form_field}
		{elseif $form_field.id == "Skills"}	
					{assign var=Skills value=$form_field}
		{elseif $form_field.id == "Education"}	
					{assign var=Education value=$form_field}
		{elseif $form_field.id == "Study"}	
					{assign var=Study value=$form_field}
		{elseif $form_field.id == "WorkExperience"}	
					{assign var=WorkExperience value=$form_field}
		{elseif $form_field.id == "Experience"}	
					{assign var=Experience value=$form_field}

		{/if} 
	{/foreach}
	

		{assign var=Emplacement value=$listing.Location}

	
	<!-- Menu Vertical Edit CV a gauche-->
	
	
	
  
					<!--Back -->

						<div class="container page-resume">
								   
							<div class=" text-right">
								{if $url == "/my-resume-details/{$listing.id}/"}
									<a href="{$GLOBALS.site_url}/edit-{$listing.type.id}/?listing_id={$listing.id}"
									   class="btn__back btn__back_resume">
										[[Back]]
									</a>
									{javascript}
										<script type="text/javascript">
											if (window.history && window.history.pushState) {
												window.history.pushState('forward', null, '');
												$(window).on('popstate', function() {
													window.location.href = '{$GLOBALS.site_url}/edit-{$listing.type.id}/?listing_id={$listing.id}';
												});
											}
										</script>
									{/javascript}
								{else}
									{if $backPage && is_numeric($searchID)}
										<a href="{$GLOBALS.site_url}/resumes/?searchID={$searchID}&action=search&listings_per_page={$backPage * 20}#{$listing.id}"
										   class="btn__back btn__back_resume">
											[[Back]]
										</a>
									{else}
										<a href="javascript:history.go(-1)"
										   class="btn__back btn__back_resume">
											[[Back]]
										</a>
									{/if}
								{/if}
							</div>
						
						   
						</div>
				
				<!--Back -->
	
		{if $is_my_resume}	
{if $GLOBALS.current_user.logged_in}
	 {if $GLOBALS.current_user.group.id != "Employer"}
 	<div class="container page-row  page-resume ">
	<div class="display-item">
<div class=" col-md-3">
<nav class="sidebar">

	<a class="sidebar__list-item {if $currentPage.order == 1}is-active {/if}"  href="{$GLOBALS.site_url}/edit-resume/Interests/{$listing.id}">Intérêts Professionnels</a>
		<a class="sidebar__list-item {if $currentPage.order == 2}is-active {/if}" href="{$GLOBALS.site_url}/edit-resume/General//{$listing.id}" aria-current="page">Informations  Générales</a>
	<a class="sidebar__list-item  {if $currentPage.order == 3}is-active {/if}" href="{$GLOBALS.site_url}/edit-resume/Professional/{$listing.id}"> Informations  Professionnelles</a>
	<a class="sidebar__list-item  {if $currentPage.order == 4}is-active {/if}" href="{$GLOBALS.site_url}/edit-resume/Experience/{$listing.id}">Experience </a>
	<a class="sidebar__list-item  {if $currentPage.order == 5}is-active {/if}" href="{$GLOBALS.site_url}/edit-resume/Education/{$listing.id}">Education </a>
	<a class="sidebar__list-item  {if $currentPage.order == 6}is-active {/if}" href="{$GLOBALS.site_url}/edit-resume/PresenceOnline/{$listing.id}">Présence en ligne </a>
	<a class="sidebar__list-item  {if $currentPage.order == 7}is-active {/if}" href="{$GLOBALS.site_url}/edit-resume/Downloads/{$listing.id}">Documents </a>
	<a class="sidebar__list-item  {if $currentPage.order == 8}is-active {/if}" href="{$GLOBALS.site_url}/edit-resume/CVModels/{$listing.id}">Modèle CV Jobsquare</a>
	<a class="sidebar__list-item  {if $GLOBALS.user_page_uri == '/resume/'}is-active {/if}" href=" {if $GLOBALS.user_page_uri == '/resume/'}#{else}{$GLOBALS.site_url}/resume/{$listing.id}{/if}">Visualiser CV</a>
			
	</nav>
{capture assign="updateDate"}{$update_date|date}{/capture}
	{if !empty($updateDate)&& $updateDate!="30/11/-1"}
	
	<div class="pc-improve-profile-container css-8qkzbz e1l5ldaa0" {if ($today_date_3month >= $update_date_3month)}background-color: #f8d7da; border-color: #f5c6cb;"{/if} >
	<div class="jobseeker-sidebar__profile-stats profile-stats jobseeker-sidebar__item">		
	<div class="listing-item__info--item-date "><b>{if ($today_date_3month >= $update_date_3month)}Votre Cv n'est plus &agrave; jour!! {/if}Derni&egrave;re mise &agrave; jour</b>: 
		<span {if ($today_date_3month < $update_date_3month) && $percentage > 89}  style="color: #83ca4e;"{elseif ($today_date_3month >= $update_date_3month)}style="color: #721c24; background-color: #f8d7da; border-color: #f5c6cb;"{/if} >{$updateDate}</span>
	</div>
		
		
			
</div>
</div>
{/if}
	<div class="pc-improve-profile-container css-8qkzbz e1l5ldaa0" >
	<div class="jobseeker-sidebar__profile-stats profile-stats jobseeker-sidebar__item">
	
	<h3 class="profile-stats__title">Améliorer votre CV</h3>
	<p class="profile-stats__profile-views"><b>{$listing.views}</b> Employeur{if $listing.views>1}s ont consulté{else} a consulté{/if} votre CV</p>
	<!--<div class="progress-bar" progress="{$percentage}" color="#FFAB00">
	<div class="progress-bar__inner" style="width: {$percentage}%; background: rgb(255, 171, 0);"></div>
	</div>-->
	<div class="meter green nostripes"> <span id="progress" style="width: {$percentage}%; background: rgb(165, 194, 66);display:block;height:15px;"></span></div>
	<p class="profile-stats__profile-strength">Votre CV est rempli à {$percentage}%</p>

	</div>
</div>
</div>
{/if}
{/if}
{/if}
<!---->

	

<div id="resumesteps" class="resumesteps resume-info col-md-9">

{if $is_my_resume}
	{if $today_date_3month > $update_date_3month}
<div class="css-s2dgtn e128p6kr0 alert alert-danger alert-dismissible">
<!--<span class="css-g50631 e4y08cy0">
<i size="20"><img src="https://85.25.214.227/projects/TanitV8//templates/Jobsquare/assets/images/icon-jobsquare.png"></i>
	</span>-->
<button type="button" class="css-1v52m5x e128p6kr1 close"  data-dismiss="alert">
<i size="16" class="css-b80bsd e19xi9jy0">
<svg width="16" height="16" preserveAspectRatio="none" viewBox="0 0 24 24"><path fill="#B12121" d="M14.238 12L20 17.762 17.763 20 12 14.237 6.238 20 4 17.763 9.764 12 4 6.236l2.236-2.235h.002l5.763 5.762L17.764 4l2.235 2.236v.002L14.238 12z"></path></svg></i></button>
<div> N'attendez plus pour valoriser vos talents et publiez vos nouvelles informations. La dernière mise à jour date de plus de 3 mois! -<a href="{$GLOBALS.site_url}/edit-resume/Interests/{$listing.id}" style="color: rgb(177, 33, 33); font-weight: bold; text-decoration: underline;">Mettez votre CV à jour maintenant</a>
</div></div>
 
	{/if}
	{/if}
 

		<div class="resume-info">
			
			<div class="css-1wtdjp1 exkztdf0">
			

					<div class=" resume-bloc ">
					
						{if $is_my_resume}
						<div class="section-title">
						
						<h2 class="resume_main-title">{$listing.user.FullName}</h2>
					<span class="desc_title"> — {$listing.Title|escape}</span>
					 {if $listing.id_Resume_careerlevel}
					   <span class="resume_main-title"> - {display property='id_Resume_careerlevel'}
								
								{if $listing.Experience}

								<span class="css-wgn4vk e1gqe2o91">
									<span> - </span>
									<span class="css-1ugyivz e1gqe2o94">{display property='Experience'}
									</span>
								</span>
								
								 {/if}
								 </span>
								  {/if}
						</div>
						
						
						{else}
						<div class="section-title">
						<h2 class="resume_main-title">{$listing.Title|escape}</h2>
						 {if $listing.id_Resume_careerlevel}
					   <span class="resume_main-title"> - {display property='id_Resume_careerlevel'}
								
								{if $listing.Experience}

								<span class="css-wgn4vk e1gqe2o91">
									<span> - </span>
									<span class="css-1ugyivz e1gqe2o94">{display property='Experience'}
									</span>
								</span>
								
								 {/if}
								 </span>
								  {/if}
						</div>
							{/if}
						<div class=" ">
							<div class="inner-bloc ">
							
									 
			                 <span class="boxeresumecontact col-md-9">
									<div   class="resumecontact selected" >
										
											
											
											<ul class="listing-item__info clearfix inline-block">
													
											<li>
												   <h3 class="details-body__title">Informations personelles
															 </h3>
												 
													</li>
													{if $listing.user.birth}
													<li>
														
														<label class="custom-selectbox__label">Date de naissance</label>
														<span class="css-wgn4vk e1gqe2o91">
																<span> : </span>
																<span class="css-1ugyivz e1gqe2o94">{$listing.user.birth|date}	
																</span>
															</span>
														
													
													</li>
												{/if}
													{if $listing.user.Gender}
													<li>
														
														<label class="custom-selectbox__label">Civilit&eacute;</label>
														<span class="css-wgn4vk e1gqe2o91">
																<span> : </span>
																<span class="css-1ugyivz e1gqe2o94">{$listing.user.Gender}	
																</span>
															</span>
														
													
													</li>
												{/if}
												
													
													
													
											 	{if $Emplacement.City}
													<li>
														
														<label class="custom-selectbox__label">Ville</label>
														<span class="css-wgn4vk e1gqe2o91">
																<span> : </span>
																<span class="css-1ugyivz e1gqe2o94">{$Emplacement.City}	
																</span>
															</span>
														
													
													</li>
												{/if}
											  	{if $Emplacement.State}
													<li>
														
														<label class="custom-selectbox__label">Gouvernorat</label>
														<span class="css-wgn4vk e1gqe2o91">
																<span> : </span>
																<span class="css-1ugyivz e1gqe2o94">{$Emplacement.State}
																</span>
															</span>
																												
													</li>
												{/if}
												
											 
												{if $listing|location}
													<li>
														
														<label class="custom-selectbox__label">Adresse</label>
														<span class="css-wgn4vk e1gqe2o91">
																<span> : </span>
																<span class="css-1ugyivz e1gqe2o94">{$listing|location}{if $Emplacement.ZipCode},  {$Emplacement.ZipCode}{/if}
																</span>
															</span>
														
														
													</li>
												{/if}
												{if $Emplacement.Country}
													<li>
														
														<label class="custom-selectbox__label">Pays</label>
														<span class="css-wgn4vk e1gqe2o91">
																<span> : </span>
																<span class="css-1ugyivz e1gqe2o94">{$Emplacement.Country}
																</span>
															</span>
																												
													</li>
												{/if}
												{if $listing.activation_date}
												<li class="listing-item__info--item">
												
												   <label class="custom-selectbox__label">Membre depuis le</label>
														<span class="css-wgn4vk e1gqe2o91">
																<span> : </span>
																<span class="css-1ugyivz e1gqe2o94">{$listing.activation_date|date}
																</span>
															</span>
															</li>
															{/if}
														   	{if $listing.update_date}
												<li class="listing-item__info--item">
												
												   <label class="custom-selectbox__label">Derni&egrave;re mise &agrave; jour:</label>
														<span class="css-wgn4vk e1gqe2o91">
																<span> : </span>
																<span class="css-1ugyivz e1gqe2o94">{$listing.update_date|date}
																</span>
															</span>
															</li>
															{/if}
															<li class="listing-item__info--item">
														 {if $listing.Licence}
														 
														  <span class="css-wgn4vk e1gqe2o91">
																
																<span class="css-1ugyivz e1gqe2o94">Permis de conduire
																</span>
															</span>
														 {/if}
														 
														 {if $listing.Motorized}
														  <span class="css-wgn4vk e1gqe2o91">
																<span> — </span>
																<span class="css-1ugyivz e1gqe2o94">Motorisé
																</span>
															</span>
														 {/if}
												  </li>
													
											</ul>
											
											
										
										
											
									</div>
								</span>
																
							
								{if $listing.Photo.file_url}
									<div class="job-seeker__image col-md-3">
										<div class="text-center profile__image">
											<img class="profile__img" src="{$listing.Photo.file_url}" alt="{$listing.user.FullName|escape}">
										</div>
									</div>
								{/if}
						
							<div class="clear"></div>
							
							</div>
						</div>
					
					</div>
					
					  <!---   Bloc coordonnées--->
					
					
					<div class=" resume-bloc hidden-to-jobseeker ">
						<div class=" ">
							<div class="inner-bloc ">											 
			                 
																
							
								
									{if $is_my_resume}
									 
														<ul class="profile__info-list">
															{if $listing.Phone}
															   
															
																			<li class="profile__info-list__item-phone">
																				<span class="boxedSingleItemContact css-1gapyfo">
																					<div   class="boxedSingleItemContact" >
																						<div class="panel-body">
																					<a href="tel:{$listing.Phone}">{$listing.Phone}</a>
																					  </div>
																					</div>
																				 </span>
																               {if $listing.OtherPhone}
																				
																									<span class="boxedSingleItemContact css-1gapyfo">
																										<div   class="boxedSingleItemContact" >
																											<div class="panel-body ">
																												<a href="tel:{$listing.Phone}">{$listing.OtherPhone}</a>
																											</div>
																										</div>
																									 </span>
																			
																				{/if}
															
																				
																					<span class="boxedSingleItemContact css-1gapyfo">
																										<div   class="boxedSingleItemContact" >
																											<div class="panel-body">
																											<a href="mailto:{$listing.user.username}">{$listing.user.username}</a>
																											</div>
																										</div>
																									 </span>
																				
																				
																				
																				</li>
																	 
															{/if}
															
													
																
    													
															{if $listing.Resume.file_url}
																<li class="profile__info-list__item profile__info-list__item-resume">
																
																				<div class="show-data">	<a href="?filename={$listing.Resume.saved_file_name|escape:'url'}">Télécharger CV</a></div>
																		
																</li>
															{/if}
															
																{if $percentage > 89}
															<a class="btn btn__blue" href="{$GLOBALS.site_url}/my-resume-details/{$listing.id}/?action=download_pdf_version">
																Télécharger CV Jobsquare en PDF
															</a>
														{/if}
														</ul>
											
					{else}
				
							<div class="show-data"> <a href="Javascript:autosuggest('{$listing|listing_url}','{$listing.id}' );" class="see-cv"><i class="fa fa-eye"></i> Cliquez ici pour visualiser les coordonnées </a></div>
					{javascript}
					<script>
						function createObject() 
						{
							var request_type;
							var browser = navigator.appName;
							if(browser == "Microsoft Internet Explorer"){
							request_type = new ActiveXObject("Microsoft.XMLHTTP");
							}else{
								request_type = new XMLHttpRequest();
							}
								return request_type;
						}

						var http = createObject();

						function autosuggest(url, listing_id , type) 
						{

						// Set te random number to add to URL request
						nocache = Math.random();
						http.open('get', '{$GLOBALS.site_url}'+url+'?voircv=1&listing_id='+listing_id);
						http.onreadystatechange = autosuggestReply( url,listing_id ) ;
						http.send(null);
						}
						function autosuggestReply( url,listing_id )  {
							return function(){
								var response = http.responseText;
								if(http.readyState == 4&&  response != ""){
									
									if(response == 1)
									{
										window.location.replace('{$GLOBALS.site_url}'+url);
									}
									else if(response == 2)
									{
										window.location.replace('{$GLOBALS.site_url}'+url);
									}
									else
									alert("Il vous reste 0 CV à consulter ");
								}
							}
						}
					</script>
					{/javascript}
					{/if}
							<div class="clear"></div>
							
							</div>
						</div>
					
					</div>
						
					  <!---  Bloc Expérience --->						
					
				<div class=" resume-bloc ">
						
						<div >
																							
									{if $listing.Objective}
									 <h3 class="details-body__title">{$Objective.caption|escape}</h3>
									<div class="details-body__content content-text">{display property='Objective'}</div>
									{/if}
									
									{if $listing.Education}
										<h3 class="details-body__title">Etudes et Formations : {display property='Study'}</h3> 
										<div class="details-body__content content-text">{display property='Education'}</div>
									{/if}
									
									{if $listing.WorkExperience}
										<h3 class="details-body__title">[[{$form_fields.WorkExperience.caption|escape}]]: {display property='Experience'}</h3>
										<div class="details-body__content content-text">{display property='WorkExperience'}</div>
									{/if} 
									{if $listing.Skills}
													
										<h3 class="details-body__title">[[{$form_fields.Skills.caption|escape}]]</h3>
										<div class="details-body__content content-text">{display property='Skills'}</div>
									{/if}
									{if $listing.id_Job_Langue}
									   <h3 class="details-body__title">Langue(s)</h3>
										<div class="details-body__content content-text">{display property='id_Job_Langue'}</div>
											{/if}
								   
												   
								   
						</div>									
						
				</div>
			
		        <!--- FIn Bloc intérets profesionnel --->
					
					  <!---  Bloc intérets profesionnel --->						
					
				<div class=" resume-bloc ">
						{if $listing.EmploymentType}
						<div>
						<span class="css-tukd06 e1gqe2o92">
						<div class="section-title">
							<h3 class="details-body__title">Type d'emploi désiré:</h3>								
							</span>
				  
									<div class="details-body__content content-text">{display property='EmploymentType'}</div>
							
						</span>
						</div>
						{/if}
						{if $listing.id_Resume_CurrentStatus}
						<div>
						<span class="css-tukd06 e1gqe2o92">
							<div class="details-body__title"><h3 class="resume_main-title">Statut actuel:</h3>	</div>							
							
				  
									<div class="details-body__content content-text">{display property='id_Resume_CurrentStatus'}</div>
							
						</span>
						</div>
						 {/if}
						
			          	 {if $listing.salary}
						<div>
						<span class="css-tukd06 e1gqe2o92">
						<div class="details-body__title">
							<h3 class="resume_main-title">Salaire Minimum:</h3>								
							</div>
				  
									<div class="details-body__content content-text">{display property='salary'}  DT/mois</div>
							
						</span>
						</div>
						 {/if}
						  	<div class="job-type">
						<div class="section-title">
								<h3 class="resume_main-title">Les domaines d'activites qui m'intéressent:</h3>
						</div>
						
						
					
				        {display property='JobCategory' template="multilist_job_category.tpl"}
						</div>	
				</div>
				</div>
		        <!--- FIn Bloc intérets profesionnel --->
			
	  	
		<div class=" resume-bloc hidden-to-jobseeker ">
						<div class=" ">
							<div class="inner-bloc ">
						{if $is_my_resume}													
					{if $listing.diploma_file.saved_file_name || $listing.cin_file.saved_file_name|| $listing.book_file.saved_file_name}
					 <h3 class="details-body__title">Documents</h3>
					 <br>
						<ul class="listing-item__info clearfix inline-block">					
						{if $listing.diploma_file.saved_file_name}
					<li class="profile__info-list__item profile__info-list__item-resume">
					
					<div class="show-data">	<a class="link" href="?filename={$listing.diploma_file.saved_file_name|escape:'url'}">Télécharger Diplome</a></div>
							
					</li>
					{/if}
					<!--{if $listing.cin_file.saved_file_name}
		
		
					<li class="profile__info-list__item profile__info-list__item-resume">
					
					<div class="show-data">	<a class="link" href="?filename={$listing.cin_file.saved_file_name|escape:'url'}">Télécharger CIN</a></div>
							
					</li>
					{/if}-->
					{if $listing.book_file.saved_file_name}
					<li class="profile__info-list__item profile__info-list__item-resume">
					
					<div class="show-data">	<a class="link" href="?filename={$listing.book_file.saved_file_name|escape:'url'}">Télécharger catalogue de réalisation(Book)</a></div>
							
					</li>
					</ul>
					{/if}
					{/if}
					
					{else}
				
							<div class="show-data"> <a href="Javascript:autosuggest('{$listing|listing_url}','{$listing.id}' );" class="see-cv"><i class="fa fa-eye"></i> Cliquez ici pour visualiser les coordonnées </a></div>
					
					
					{/if}
					</div>
					</div>
		</div>
		
		
		
		
		
		
		{if $listing.Linkedin_link || $listing.Facebook_link || $listing.Twitter_link || $listing.Behance_link || $listing.Instagram_link || $listing.GitHub_link || $listing.StackOverflow_link || $listing.YouTube_link || $listing.Blog_link || $listing.Website_link || $listing.Other_link}
		
					  <!---   Bloc presence en ligne--->
					
					
					<div class=" resume-bloc hidden-to-jobseeker ">
						<div class=" ">
						<h3 class="details-body__title">Présence en ligne</h3>
							<div class="inner-bloc ">											 
			                 
																
							
								
									{if $is_my_resume}
									 
														<ul class="profile__info-list">
															{if $listing.Linkedin_link}
															   
																<li>
															
															<label class="custom-selectbox__label">Linkedin</label>
															<span class="css-wgn4vk e1gqe2o91">
																	<span> : </span>
																	<span class="css-1ugyivz e1gqe2o94"><a href="{$listing.Linkedin_link}">{$listing.Linkedin_link}</a>
																	</span>
																</span>
															
														
																</li>
																	{/if}		
																               {if $listing.Facebook_link}
																				
																<li>
															
															<label class="custom-selectbox__label">Facebook</label>
															<span class="css-wgn4vk e1gqe2o91">
																	<span> : </span>
																	<span class="css-1ugyivz e1gqe2o94"><a href="{$listing.Facebook_link}">{$listing.Facebook_link}</a>
																	</span>
																</span>
															
														
																</li>
																				{/if}
															
																				 {if $listing.Twitter_link}
																					<li>
															
																<label class="custom-selectbox__label">Twitter</label>
																<span class="css-wgn4vk e1gqe2o91">
																		<span> : </span>
																		<span class="css-1ugyivz e1gqe2o94"><a href="{$listing.Twitter_link}">{$listing.Twitter_link}</a>
																		</span>
																	</span>
																
															
																	</li>
																				{/if}
																			
																 {if $listing.Behance_link}
																					<li>
															
																<label class="custom-selectbox__label">Behance</label>
																<span class="css-wgn4vk e1gqe2o91">
																		<span> : </span>
																		<span class="css-1ugyivz e1gqe2o94"><a href="{$listing.Behance_link}">{$listing.Behance_link}</a>
																		</span>
																	</span>
																
															
																	</li>
																				{/if}

															{if $listing.Instagram_link}
																					<li>
															
																<label class="custom-selectbox__label">Instagram</label>
																<span class="css-wgn4vk e1gqe2o91">
																		<span> : </span>
																		<span class="css-1ugyivz e1gqe2o94"><a href="{$listing.Instagram_link}">{$listing.Instagram_link}</a>
																		</span>
																	</span>
																
															
																	</li>
																				{/if}

															{if $listing.GitHub_link}
																					<li>
															
																<label class="custom-selectbox__label">GitHub</label>
																<span class="css-wgn4vk e1gqe2o91">
																		<span> : </span>
																		<span class="css-1ugyivz e1gqe2o94"><a href="{$listing.GitHub_link}">{$listing.GitHub_link}</a>
																		</span>
																	</span>
																
															
																	</li>
																	{/if}																				
																	 
															{if $listing.StackOverflow_link}
																					<li>
															
																<label class="custom-selectbox__label">Stack Overflow</label>
																<span class="css-wgn4vk e1gqe2o91">
																		<span> : </span>
																		<span class="css-1ugyivz e1gqe2o94"><a href="{$listing.StackOverflow_link}">{$listing.StackOverflow_link}</a>
																		</span>
																	</span>
																
															
																	</li>
																	{/if}	
																{if $listing.YouTube_link}
																					<li>
															
																<label class="custom-selectbox__label">YouTube</label>
																<span class="css-wgn4vk e1gqe2o91">
																		<span> : </span>
																		<span class="css-1ugyivz e1gqe2o94"><a href="{$listing.YouTube_link}">{$listing.YouTube_link}</a>
																		</span>
																	</span>
																
															
																	</li>
																	{/if}	
														{if $listing.Blog_link}
																					<li>
															
																<label class="custom-selectbox__label">Blog</label>
																<span class="css-wgn4vk e1gqe2o91">
																		<span> : </span>
																		<span class="css-1ugyivz e1gqe2o94"><a href="{$listing.Blog_link}">{$listing.Blog_link}</a>
																		</span>
																	</span>
																
															
																	</li>
																	{/if}																		
																	 
																	 
																{if $listing.Website_link}
																					<li>
															
																<label class="custom-selectbox__label">Site web personnel</label>
																<span class="css-wgn4vk e1gqe2o91">
																		<span> : </span>
																		<span class="css-1ugyivz e1gqe2o94"><a href="{$listing.Website_link}">{$listing.Website_link}</a>
																		</span>
																	</span>
																
															
																	</li>
																	{/if}		
																{if $listing.Other_link}
																					<li>
															
																<label class="custom-selectbox__label">Autre</label>
																<span class="css-wgn4vk e1gqe2o91">
																		<span> : </span>
																		<span class="css-1ugyivz e1gqe2o94"><a href="{$listing.Other_link}">{$listing.Other_link}</a>
																		</span>
																	</span>
																
															
																	</li>
																	{/if}																			
															
															
													
																
    													
															
														</ul>
											
					{else}
				
							<div class="show-data"> <a href="Javascript:autosuggest('{$listing|listing_url}','{$listing.id}' );" class="see-cv"><i class="fa fa-eye"></i> Cliquez ici pour visualiser les coordonnées </a></div>
					{javascript}
					<script>
						function createObject() 
						{
							var request_type;
							var browser = navigator.appName;
							if(browser == "Microsoft Internet Explorer"){
							request_type = new ActiveXObject("Microsoft.XMLHTTP");
							}else{
								request_type = new XMLHttpRequest();
							}
								return request_type;
						}

						var http = createObject();

						function autosuggest(url, listing_id , type) 
						{

						// Set te random number to add to URL request
						nocache = Math.random();
						http.open('get', '{$GLOBALS.site_url}'+url+'?voircv=1&listing_id='+listing_id);
						http.onreadystatechange = autosuggestReply( url,listing_id ) ;
						http.send(null);
						}
						function autosuggestReply( url,listing_id )  {
							return function(){
								var response = http.responseText;
								if(http.readyState == 4&&  response != ""){
									
									if(response == 1)
									{
										window.location.replace('{$GLOBALS.site_url}'+url);
									}
									else if(response == 2)
									{
										window.location.replace('{$GLOBALS.site_url}'+url);
									}
									else
									alert("Il vous reste 0 CV à consulter ");
								}
							}
						}
					</script>
					{/javascript}
					{/if}
							<div class="clear"></div>
							
							</div>
						</div>
					
					</div>
						
						{/if}
			
		</div>
	</div>
	<div class="css-1t08rlo evbdj4a0">
		<div class="Toastify"></div>
	</div>
	<div></div>
</div>
<div class="clear clearfix"></div>
</div>

<div class="clear clearfix"></div>
</div>

<!----	 Fin de nouveau model ... -->
<div class="listing-results">
	 

	<div class="page-detail-annonce">
	<div class="container page-detail-annonce">
		<div class="row details-body details-body__resume">
			
			
			{if $GLOBALS.user_page_uri == '/resume-preview/'}
				<div class="form-group job-preview__btns col-xs-12">
					<form action="{$referer}" method="post">
						<input type="hidden" name="from-preview" value="1" />
						<input type="submit" name="edit_temp_listing" value="[[Edit]]" class="btn btn__orange btn__bold" id="listing-preview" />
						{if $contract_id == 0 && !$checkouted}
							<input type="hidden" name="proceed_to_checkout" />
							<input type="submit" name="action_add" value="[[Post]]" class="btn btn__orange btn__bold" />
						{else}
							<input type="submit" name="action_add" value="[[Post]]" class="btn btn__orange btn__bold" />
						{/if}
					</form>
				</div>
			{/if}
		</div>
	</div>
{/if}
</div>






{javascript}
	<script type="text/javascript">
		$('.alert__close').on('click', function(e) {
			e.preventDefault();
			$(this).closest('.alert').hide();
		});
	</script>
{/javascript}