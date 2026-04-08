{title}[[Post a {$listingTypeID|escape}]]{/title}



{if $currentPage.order == 1}

	
	{foreach from=$form_fields item=form_field}
		{$form_field=$form_field scope=global}
	      {if $form_field.id == 'id_Resume_careerlevel'}
	
							{assign var=Resume_CareerLevel value=$form_field}
         {elseif $form_field.id == "EmploymentType"}	
					{assign var=EmploymentType value=$form_field}
		{elseif $form_field.id == "Title"}	
					{assign var=DesiredTitle value=$form_field}
		{elseif $form_field.id == "JobCategory"}	
					{assign var=JobCategory value=$form_field}
		{elseif $form_field.id == "salary"}	
					{assign var=salary value=$form_field}
		{elseif $form_field.id == "id_Resume_CurrentStatus"}	
					{assign var=id_Resume_CurrentStatus value=$form_field}
		{elseif $form_field.id == "Experience"}	
					{assign var=Experience value=$form_field}
		{elseif $form_field.id == "access_type"}	
					{assign var=ResumeAccessType value=$form_field}
		{/if} 
      	 	
	{/foreach}
	
	
	
	<div id="resumesteps" class="resumesteps">
		<div class="css-1gd7wsf e14sx70q0">
			<div class="css-1ckssea e1w8elkt0">
				<div class="css-vrm4cl ex0woer0">
				
					<div class="css-fxcazt ex0woer6">
						<div class="css-gdpa5c ex0woer1">
							<div class="css-1ubp74e ex0woer2">1</div>
							<span class="css-shrb6e ex0woer4">Intérêts Professionnels</span>
						</div>
					</div>
					<div class="css-fxcazt ex0woer6">
						<div class="css-gdpa5c ex0woer1">
							<div class="css-u96hfe ex0woer2">2</div>
							<span class="css-bexpki ex0woer4">Informations  Générales</span>
						</div>
					</div>
					<div class="css-3vogbp ex0woer6">
						<div class="css-gdpa5c ex0woer1">
							<div class="css-u96hfe ex0woer2">3</div>
							<span class="css-bexpki ex0woer4">Informations  Professionnelles</span>
						</div>
					</div>
				</div>
			</div>
			<div class="css-1wtdjp1 exkztdf0">
				<div step="Step 1/3" title="Intérêts professionnel" class="css-174not0 eyxoizq0">
					<h1 class="step" style="font-weight: normal; font-size: 14px; letter-spacing: -0.6px; line-height: 12px;">Etape [[{$currentPage.order}]]/3</h1>
					<h1 style="margin: 4px 0px 8px; font-weight: lighter; font-size: 30px; letter-spacing: -0.7px; line-height: 32px;">Intérêts professionnel</h1>
					<h1 style="font-weight: normal; font-size: 14px; letter-spacing: -0.6px; line-height: 12px;">Ces informations nous permettent de vous recommander de meilleures opportunités.</h1>
				</div>
				<div class="alertorange"><div><span class="css-g50631 e4y08cy0"><i size="20" class="css-tjx49 e19xi9jy0"><img src="{$GLOBALS.site_url}/templates/Jobsquare/assets/images/icon-jobsquare.png" /></i></span>Devenez visible par les recruteurs Jobsquare.ma. Complétez votre profil pour commencer.</div></div>
				
			<form method="post" action="{$GLOBALS.site_url}/add-listing/{$listingTypeID|escape}/{$currentPage.page_id}/{$listingSID}"
				  enctype="multipart/form-data" {if $form_fields.ApplicationSettings}onsubmit="return validateForm('add-listing-form');"{/if}
				  id="add-listing-form" class="form">
				<input type="hidden" name="productSID" value="{$productSID|escape}">
				<input type="hidden" name="contract_id" value="{$contract_id}" />
				<input type="hidden" name="listing_type_id" value="{$listingTypeID|escape}" />
				<input type="hidden" id="listing_id" name="listing_id" value="{$listing_id}" />
				{if ($contract_id eq 0)}<input type="hidden" name="proceed_to_posting" value="done" />{/if}
				{set_token_field}
				
				    {if $redirectBackToJobID}				
					
				   <div class="css-1scoqbg e128p6kr0">
					  <div>[[Pour pouvoir postuler, veuillez mettre à jour votre CV Jobsquare. Vous devez avoir au minimum un CV complet à 90%.]]
					  </div>
				  </div>
				  {else}
				  {include file='field_errors.tpl'}
				  {/if}
					<div class=" resume-bloc">
						<h2 class=" resume_main-title">Quel est votre niveau d'experience Professionnel?</h2>
						<div class="css-19f4r6z eh8qwvv0">
							<div class="css-i0bwc4 e67rya20">
							{input property=$Resume_CareerLevel.id}
							</div>
						</div>
					</div>
					
					<div class=" resume-bloc ">
						<span class="css-tukd06 e1gqe2o92">
							<h2 class=" resume_main-title">À quel (s) type (s) d'emploi êtes-vous ouvert (e)?</h2>
							<span class="css-wgn4vk e1gqe2o91">
							<span> — </span>
								<span class="css-1ugyivz e1gqe2o94">Type d'emploi désiré</span>
							</span>
				
						  
						</span>
					<div class="css-pbed7v e8my37z0">
						<div class="css-14nywfj">
							{input property=$EmploymentType.id}
								
						</div>
					</div>
				</div>
			<div class=" resume-bloc ">
				<span class="css-tukd06 e1gqe2o92">
					<h2 class=" resume_main-title">Quel est le nom de poste / fonction  qui décrit ce que vous recherchez?</h2>
					<span class="css-wgn4vk e1gqe2o91">
						<span> — </span><span class="css-1ugyivz e1gqe2o94">Titre du poste désiré</span>
					</span>
				</span>
				   {input property=$DesiredTitle.id}
				
			</div>
			<div class=" resume-bloc ">
				<span class="css-tukd06 e1gqe2o92">
					<h2 class=" resume_main-title">Quels sont les domaines d'activites qui vous intéressent?</h2>
					<span class="css-wgn4vk e1gqe2o91">
						<span> — </span>
							<span class="css-1ugyivz e1gqe2o94">Max 5</span>
						</span>
					</span>
					
					<div class="custom-selectbox">
						<div class="Select custom-selectbox__select  is-clearable is-searchable Select--multi">
							<div class="Select-control">
								
									{input property=$JobCategory.id}
							</div>
						</div> 
					</div>
				</div>
				<div class=" resume-bloc ">
					<span class="css-tukd06 e1gqe2o92">
						<h2 class=" resume_main-title">Quel est le salaire minimum que vous accepteriez?</h2>
						<span class="css-wgn4vk e1gqe2o91">
							<span> — </span>
							<span class="css-1ugyivz e1gqe2o94">Ajoutez un salaire net (c-à-d, Le montant final que vous voulez recevoir après les taxes).
							</span>
						</span>
					</span>
					<div class="css-bl1ilx e14ozvww0">
						<div class="css-1f2c5hb e14ozvww1">
							<div class="text-field-wrapper css-znsm0t">
								<div class="css-1ac03ny">
												
									{input property=$salary.id}
									<span class="css-wgn4vk e1gqe2o91">
						<span> NB: </span>
							<span class="css-1ugyivz e1gqe2o94">Le montant en Dinars Marocn</span>
						</span>
					</span>
								</div>
							</div>
						</div>
						
					</div>
					
				</div>
				<div class=" resume-bloc ">
					<span class="css-tukd06 e1gqe2o92">
						<h2 class=" resume_main-title">Quel est votre statut actuel? </h2>
						<span class="css-wgn4vk e1gqe2o91">
							<span> — </span>
							<span class="css-1ugyivz e1gqe2o94">Pourquoi vous êtes à la recherche d'un emploi?
							</span>
						</span>
					</span>
					<div class="custom-selectbox">
						<div class="Select custom-selectbox__select  is-clearable is-searchable Select--single">
							<div class="Select-control">
								{input property=$id_Resume_CurrentStatus.id}
							</div>
						</div> 
					</div>
					<div class="css-1yq7fu5 e1v8ucbs0">
					{input property=$ResumeAccessType.id}
						
						<div class="css-1isemmb">
							<h1 type="H6" class="css-i1y1z6 ehwvnb90">Laissez les entreprises me trouver sur Jobsquare.ma. (Recommandé)</h1>
							<p class="css-d9v5op e1v8ucbs1">En activant cette option, vous augmenterez vos chances de vous faire chasser par les entreprises qui recherchent dans notre base de données.</p>
						</div>
						
					</div>
					
				</div>
				
	  
					<div class="css-7oyirr">
						<input type="hidden" name="action_add" id="hidden_action_add" value=""/>
						<input type="submit" name="preview_listing" value="Sauvegarder et continuer" class="css-txeug1 e1eq3cmo0" id="listingPreview"/>
					<a href="{$GLOBALS.site_url}/add-listing/{$listingTypeID|escape}/Interests/{$listingSID}" style="background-color: white; border: 1px solid rgb(235, 237, 240);" class="css-wzp6tc e1eq3cmo0">Retour</a>
					</div>
			
			
			</form>
		</div>
	</div>
	<div class="css-1t08rlo evbdj4a0">
		<div class="Toastify"></div>
	</div>
	<div></div>
</div>
{elseif $currentPage.order == 2}


	{foreach from=$form_fields item=form_field}
		{$form_field=$form_field scope=global}
			
	      {if $form_field.id == 'Objective'}
				{assign var=Objective value=$form_field}
         {elseif $form_field.id == "Photo"}	
				{assign var=Photo value=$form_field}
		{elseif $form_field.id == "Phone"}	
					{assign var=Phone value=$form_field}
		{elseif $form_field.id == "Motorized"}	
					{assign var=Motorized value=$form_field}
					{elseif $form_field.id == "GooglePlace"}	
					{assign var=GooglePlace value=$form_field}
		{elseif $form_field.id == "OtherPhone"}	
					{assign var=OtherPhone value=$form_field}
		{elseif $form_field.id == "Licence"}	
					{assign var=Licence value=$form_field}
		
		{elseif $form_field.id == "access_type"}	
					{assign var=ResumeAccessType value=$form_field}			

		{elseif $form_field.id == "Location"}	
					{assign var=Location value=$form_field}
		{/if} 
      	 	
	{/foreach}


 <div id="resumesteps" class="resumesteps">
	<div class="css-1gd7wsf e14sx70q0">
		<div class="css-1ckssea e1w8elkt0">
			<div class="css-vrm4cl ex0woer0">
				<div class="css-1pssweo ex0woer6">
					<div class="css-gdpa5c ex0woer1">
						<div class="css-1ubp74e ex0woer2">
							<img src="{$GLOBALS.site_url}/templates/Jobsquare/assets/images/stepdone.svg" alt="icon" class="css-1haac7k ex0woer3">
						</div>
						<a href="{$GLOBALS.site_url}/add-listing/{$listingTypeID|escape}/Interests/{$listingSID}"><span class="css-bexpki ex0woer4">Intérêts Professionnels</span></a>
					</div>
				</div>
			<div class="css-fxcazt ex0woer6">
				<div class="css-gdpa5c ex0woer1">
					<div class="css-1ubp74e ex0woer2">2</div>
						<span class="css-shrb6e ex0woer4">Informations  Générales</span>
					</div>
				</div>
			<div class="css-3vogbp ex0woer6">
				<div class="css-gdpa5c ex0woer1">
					<div class="css-u96hfe ex0woer2">3</div>
					<span class="css-bexpki ex0woer4">Informations  Professionnel</span>
				</div>
			</div>
		</div>
	</div>
	<div class="css-1wtdjp1 exkztdf0">
	<div step="Step 2/3" title="Informations  Générales" class="css-174not0 eyxoizq0">
		<h1 class="step" style="font-weight: normal; font-size: 14px; letter-spacing: -0.6px; line-height: 12px;">Etape [[{$currentPage.order}]]/3</h1>
		<h1 style="margin: 4px 0px 8px; font-weight: lighter; font-size: 30px; letter-spacing: -0.7px; line-height: 32px;">Informations  Générales</h1>
		<h1 style="font-weight: normal; font-size: 14px; letter-spacing: -0.6px; line-height: 12px;">Donner plus des détails sur vous-même, Laisser les entreprises vous connaitre.</h1>
	</div>
	<form method="post" action="{$GLOBALS.site_url}/add-listing/{$listingTypeID|escape}/{$currentPage.page_id}/{$listingSID}"
				  enctype="multipart/form-data" {if $form_fields.ApplicationSettings}onsubmit="return validateForm('add-listing-form');"{/if}
				  id="add-listing-form" class="form">
				<input type="hidden" name="productSID" value="{$productSID|escape}">
				<input type="hidden" name="contract_id" value="{$contract_id}" />
				<input type="hidden" name="listing_type_id" value="{$listingTypeID|escape}" />
				<input type="hidden" id="listing_id" name="listing_id" value="{$listing_id}" />
				{if ($contract_id eq 0)}<input type="hidden" name="proceed_to_posting" value="done" />{/if}
				{set_token_field}
				
				  
				  {include file='field_errors.tpl'}
				 
		<div class="userphoto">
	<div class="text-field-wrapper css-znsm0t">
	<label for="fname" class="css-ybizro ebed2s31">Photo de profil</label>
	<div class="css-1ac03ny">
					
						{input property=$Photo.id}
	</div>

		</div>
		</div>
		<br>
		
	<div class="resume-bloc">
			<h2 class=" resume_main-title">Vos informations personnelles</h2>
			<div class="css-rpi6b5 e6pv2vl0">
			<!--<div class="text-field-wrapper css-znsm0t">
				<label for="fname" class="css-ybizro ebed2s31">Photo</label>
					<div class="css-1ac03ny">
					
						{input property=$Photo.id}
					</div>
			</div>-->
			
			    <div class="css-rpi6b5 e6pv2vl0 " style="margin-top: 20px;">
				           
							<div class="text-field-wrapper css-znsm0t  ">
								<div class="css-1ac03ny ">
									   <span class="css-tukd06 e1gqe2o92">
						<label class="custom-selectbox__label">Objectifs et Motivations(Lettre de Motivation) </h1>
						
				              	</span>			
									{input property=$Objective.id}
									
				
								</div>
							</div>
				</div>
			
		</div>
		
	
	
</div>
<div class="resume-bloc">
	
		<h2 class=" resume_main-title">Votre emplacement</h2>
	
	<div class="css-rpi6b5 e6pv2vl0">
		<div class="custom-selectbox">
			
			<div class="css-rpi6b5 e6pv2vl0">
				<div class="text-field-wrapper css-znsm0t">
					
					<div class="css-1ac03ny">
						{input property=$Location.id}
					</div>
				</div>
		    </div>
			
			<div class="css-rpi6b5 e6pv2vl0">
				<div class="text-field-wrapper css-znsm0t">
					<label class="custom-selectbox__label">Adresse</label>
					<span class="css-wgn4vk e1gqe2o91">
							<span> — </span>
							<span class="css-1ugyivz e1gqe2o94">Rue, Appt, Résidence, cité ...
							</span>
						</span>
				
					<div class="css-1ac03ny">
						{input property=$GooglePlace.id}
					</div>
				</div>
		    </div>
			
		</div>
	</div>
	
		
		<div class="css-1yq7fu5 e1v8ucbs0">
					{input property=$Licence.id}
						
						<div class="css-1isemmb">
							<h1 type="H6" class="css-i1y1z6 ehwvnb90">Avez-vous un permis de conduire valide? </h1>
							<p class="css-d9v5op e1v8ucbs1">Si vous choisissez de mentionner votre permis de conduire sur votre CV, réfléchissez bien au préalable à ce que cela apporte à votre candidature et si cela est bien nécessaire pour le poste que vous cherchez.</p>
						</div>
						
		</div>
		<div class="css-1yq7fu5 e1v8ucbs0">
					{input property=$Motorized.id}
						
						<div class="css-1isemmb">
							<h1 type="H6" class="css-i1y1z6 ehwvnb90">Êtes - vous motorisé?</h1>
							<p class="css-d9v5op e1v8ucbs1">Prenez d’abord le temps de regarder les avantages et inconvénients à mettre en avant votre scooter, moto ou voiture sur votre CV.</p>
						</div>
						
		</div>
		
	</div>
	<div class="resume-bloc">
		
			<h2 class=" resume_main-title">Informations de contact</h2>
		
		<div class="css-rpi6b5 e6pv2vl0">
			<div class="text-field-wrapper css-znsm0t">
				<label for="mnumber" class="css-ybizro ebed2s31">Numéro de portable</label>
				<div class="css-1ac03ny">
					{input property=$Phone.id}
				</div>
			</div>
		</div>
		<div class="css-rpi6b5 e6pv2vl0">
			<div class="text-field-wrapper css-znsm0t">
				<label for="ophone" class="css-ybizro ebed2s31">Autre télephone
					<span class="css-y7u1of">— Optionnel</span>
				</label>
				<div class="css-1ac03ny">
					{input property=$OtherPhone.id}
				</div>
			</div>
		</div>
	</div>
	<div class="css-7oyirr">
	  <input type="hidden" name="action_add" id="hidden_action_add" value=""/>
		<button type="submit" class="css-1kqwv1a e1eq3cmo0">Sauvegarder et continuer</button>
		
	</div>
</form>
</div>
</div>
<div class="css-1t08rlo evbdj4a0">
<div class="Toastify"></div>
</div>
<div>
</div>
</div>
    


{elseif $currentPage.order == 3}


	{foreach from=$form_fields item=form_field}
		{$form_field=$form_field scope=global}
		
	      {if $form_field.id == 'Objective'}
				{assign var=Objective value=$form_field}
         {elseif $form_field.id == "id_Job_Langue"}	
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
		{elseif $form_field.id == "Resume"}	
					{assign var=Resume value=$form_field}
		{/if} 
      	 	
	{/foreach}
					
					
<div id="resumesteps" class="resumesteps">
	<div class="css-1gd7wsf e14sx70q0">
		<div class="css-1ckssea e1w8elkt0">
			<div class="css-vrm4cl ex0woer0">
				<div class="css-1pssweo ex0woer6">
					<div class="css-gdpa5c ex0woer1">
						<div class="css-1ubp74e ex0woer2">
							<img src="{$GLOBALS.site_url}/templates/Jobsquare/assets/images/stepdone.svg" alt="icon" class="css-1haac7k ex0woer3">
						</div>
						<a href="{$GLOBALS.site_url}/add-listing/{$listingTypeID|escape}/General/{$listingSID}"><span class="css-bexpki ex0woer4">Informations  Générales</span></a>
					</div>
				</div>
				<div class="css-1pssweo ex0woer6">
					<div class="css-gdpa5c ex0woer1">
						<div class="css-1ubp74e ex0woer2">
							<img src="{$GLOBALS.site_url}/templates/Jobsquare/assets/images/stepdone.svg" alt="icon" class="css-1haac7k ex0woer3">
							</div>
							<a href="{$GLOBALS.site_url}/add-listing/{$listingTypeID|escape}/Interests/{$listingSID}"><span class="css-bexpki ex0woer4">Intérêts Professionnels</span></a>
						</div>
					</div>
				<div class="css-3vogbp ex0woer6">
					<div class="css-gdpa5c ex0woer1">
						<div class="css-1ubp74e ex0woer2">3</div>
							<span class="css-shrb6e ex0woer4">Informations  Professionnelles</span>
						</div>
					</div>
				</div>
			</div>
		<div class="css-1wtdjp1 exkztdf0">
			<div step="Step 3/3" title="Professional Info" class="css-174not0 eyxoizq0">
				<h1 class="step" style="font-weight: normal; font-size: 14px; letter-spacing: -0.6px; line-height: 12px;">Etape 3/3</h1>
				<h1 style="margin: 4px 0px 8px; font-weight: lighter; font-size: 30px; letter-spacing: -0.7px; line-height: 32px;">Informations  Professionnelles</h1>
				<h1 style="font-weight: normal; font-size: 14px; letter-spacing: -0.6px; line-height: 12px;">Parlez aux entreprises de votre expérience professionnelle.</h1>
			</div>
			
		<form method="post" action="{$GLOBALS.site_url}/add-listing/{$listingTypeID|escape}/{$currentPage.page_id}/{$listingSID}"
				  enctype="multipart/form-data" {if $form_fields.ApplicationSettings}onsubmit="return validateForm('add-listing-form');"{/if}
				  id="add-listing-form" class="form">
				<input type="hidden" name="productSID" value="{$productSID|escape}">
				<input type="hidden" name="contract_id" value="{$contract_id}" />
				<input type="hidden" name="listing_type_id" value="{$listingTypeID|escape}" />
				<input type="hidden" id="listing_id" name="listing_id" value="{$listing_id}" />
				{if ($contract_id eq 0)}<input type="hidden" name="proceed_to_posting" value="done" />{/if}
				{set_token_field}
				
				  
				  {include file='field_errors.tpl'}
				  
					<div class="  resume-bloc " style="overflow: hidden;">
					   
						<span class="css-tukd06 e1gqe2o92"><h2 class=" resume_main-title">Quel est le nombre d'années de votre expérience?</h2></span>
						<div class="css-19f4r6z eh8qwvv0">
							<div class="css-i0bwc4 e67rya20">
							{input property=$Experience.id}
							</div>
						</div>
					
					
					 <div style="margin-top:20px;padding-top:20px;">
							<span class="css-tukd06 e1gqe2o92">
								<h1 style="font-size: 18px; font-weight: bold; line-height: 24px;">Détails de l'expérience</h1>
							</span>
							<div>
						      <span class="css-wgn4vk e1gqe2o91">
									<span> — </span>
									<span class="css-1ugyivz e1gqe2o94">
										<b>Important:</b> Classez vos expériences de la plus récente à la plus ancienne.
									</span>
								  </span>
								    </div>
								  <div>
								  
                                <span class="css-wgn4vk e1gqe2o91">
									<span> — </span>
									<span class="css-1ugyivz e1gqe2o94">
										Ajouter votre expérience <b>la plus récente</b> (votre dernière expérience ou votre expérience actuelle).  Puis cliquez sur le bouton <b>Ajouter une nouvelle Expérience</b> pour ajouter d'autres.
									</span>
								  </span>
								  </div>
				     </div>
					 	<div style="padding-top: 20px;" class="form-group form-group__complex">
							
										


    							{input property=$WorkExperience.id}
							  </div>
						
				
					</div>
				 
				
				
			<div class="section-validation-error  resume-bloc " style="overflow: hidden;">
						<span class="css-tukd06 e1gqe2o92"><h2 class=" resume_main-title">Quel est votre niveau d'étude actuel?</h2>
							<span class="css-wgn4vk e1gqe2o91">
								<span> — </span>
								<span class="css-1ugyivz e1gqe2o94">Si vous étudiez actuellement, sélectionnez votre prochain diplôme.</span>
							</span>
						</span>
						<div class="css-i0bwc4 e67rya20">
								{input property=$Study.id}
						</div>
						<div style="margin-top:20px;padding-top:20px;">
							<span class="css-tukd06 e1gqe2o92">
								<h1 style="font-size: 18px; font-weight: bold; line-height: 24px;">Détails des études</h1>
							</span>
							
							     <div>
						      <span class="css-wgn4vk e1gqe2o91">
									<span> — </span>
									<span class="css-1ugyivz e1gqe2o94">
										<b>Important:</b> Classez vos études de la plus récente à la plus ancienne.
									</span>
								  </span>
								    </div>
								  <div>
                                <span class="css-wgn4vk e1gqe2o91">
									<span> — </span>
									<span class="css-1ugyivz e1gqe2o94">
										Ajouter votre <b>dernier diplôme </b> (votre dernière formation ou niveau d'étude actuelle).  Puis cliquez sur le bouton <b>Ajouter une nouvelle Etude</b> pour ajouter d'autres.
									</span>
								  </span>
								  </div>
							
							<div class="css-j7qwjs e6pv2vl2 ">
								<div class="form-group form-group__complex css-x10blp e6pv2vl1"  >
									{input property=$Education.id}
									
								</div>
								
							</div>
						
				         </div>
			</div>
			<div class=" resume-bloc ">
				<div class="css-1qm1lh eclq2bk0">
					<h2 class=" resume_main-title">Quelles langues connaissez-vous?
						<span class="css-wgn4vk e1gqe2o91">— Vous pouvez ajouter plusieurs</span>
					</h2>
				</div>
				
				<div name="talentLanguageForm">
					<div class="css-eio8xc e6pv2vl3">
						
							{input property=$id_Job_Langue.id}
						
					</div>
					</div>
				<div>
			</div>
			<div class="container mt-30">
				<div class="col-6"></div>
			</div>
			<div class="container mt-30">
				<div class="col-6"></div>
			</div>
		</div>
		<div class=" resume-bloc ">
			<span class="css-tukd06 e1gqe2o92">
				<h2 class=" resume_main-title">De quelles compétences, outils, technologies et domaines d'expertise disposez-vous?</h2>
				<span class="css-wgn4vk e1gqe2o91">
					<span> — </span>
					<span class="css-1ugyivz e1gqe2o94">Prenez le temps de comprendre quelles sont les compétences essentielles pour le poste auquel vous postulez.</span>
				</span>
			</span>
			<div type="full-width" class="css-41u6q2 e6pv2vl0">
				<div class="custom-selectbox"> 
					  {input property=$Skills.id}
				</div>
			</div>
		</div>
	<div class="upload-cv  resume-bloc">
		<span class="css-qijrzv e12vjvm81">
			<h1 class="css-esj582 e12vjvm83">Télécharger votre CV</h1>
			<span class="css-djskp8 e12vjvm82">
				<span class="css-16ghou"> — Optionnelle</span>
			</span>
		</span>
		<span class="css-vzfgfo">Fichiers accepter: <b>.docx</b>, <b>.doc</b> or <b>.pdf</b>, avec une taille maximale de 5MB</span>
		<div class="css-6n7j50" style="position: relative;" aria-disabled="false">
			
		  {input property=$Resume.id}
		  </div>
	</div>
	<div class="css-7oyirr">
	<input type="hidden" name="action_add" id="hidden_action_add" value=""/>
		<button type="submit" class="css-1kqwv1a e1eq3cmo0">Valider et Commencer</button>
		<a href="{$GLOBALS.site_url}/add-listing/{$listingTypeID|escape}/Interests/{$listingSID}" style="background-color: white; border: 1px solid rgb(235, 237, 240);" class="css-wzp6tc e1eq3cmo0">Retour</a>
	</div>
</form>
</div>
</div>
<div class="css-1t08rlo evbdj4a0">
	<div class="Toastify">
</div>
</div>
<div>
</div>
</div>
{/if}
