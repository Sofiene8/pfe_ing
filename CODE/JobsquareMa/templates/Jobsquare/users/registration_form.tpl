<div class="registration-page">
<div class="container  content-card ">
	<div id="signup-header">
		<div class="col-sm-6 col-xs-12 "> {if $user_group_info.id == 'JobSeeker'}
			<h1> [[Create {$user_group_info.name} Profile]]</h1>
			{else}
			<h1> [[Create {$user_group_info.name} Profile]]</h1>
			{/if}
			<h2>&Ccedil;a prend uniquement 5 secondes :)</h2>
		</div>
		<div class="col-sm-6">
			<div class="  radiochoice">
				<label >Je cherche </label>
				<a href="{$GLOBALS.site_url}/registration/?user_group_id=JobSeeker">
				<input type="radio"  name="group1-radio" {if $user_group_info.id == 'JobSeeker'} checked="" {/if}>
				 Un emploi
				</a>  
				<a href="{$GLOBALS.site_url}/registration/?user_group_id=Employer">
				<input type="radio" name="group1-radio" {if $user_group_info.id != 'JobSeeker'} checked="" {/if}>
				 &Agrave; publier des annonces 
				</a>  </div>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class=" col-md-6  f-right">
		<div class=" signup-form-header"> </div>
		{include file="field_errors.tpl"}
		<form class="form" method="post" action="" enctype="multipart/form-data" id="registr-form">
			<input type="hidden" name="action" value="register" />
			<input type="hidden" name="return_url" value="{$smarty.request.return_url|escape}" />
			{set_token_field}
			{foreach from=$form_fields item=form_field}
			{if $form_field.type == 'password' && $user_group_info.id == 'JobSeeker'}
			{input property=$form_field.id}
			{elseif $form_field.id == 'Location'||$form_field.id == 'PrivateSpace'||$form_field.id == 'CounterCvAccess'}
			{elseif ($form_field.id == 'username' || $form_field.id == 'FullName' || $form_field.id == 'CompanyName'
			|| $form_field.id == 'WebSite' || $form_field.id == 'Phone' || $form_field.id == 'GooglePlace') && $user_group_info.id == 'Employer'}
			<div class="form-group form-group__half {$form_field.id|lower}">
				<label class="form-label">[[$form_field.caption]] {if $form_field.is_required}*{/if}</label>
				{input property=$form_field.id} </div>
			{elseif $form_field.id == 'password' && $user_group_info.id == 'Employer'}
			{input property=$form_field.id template="password_in_row.tpl"}
	
			
			{elseif $form_field.type == 'boolean'}
			<div class="form-group {$form_field.id|lower}"> {input property=$form_field.id}
				<label class="form-label inline" for="{$form_field.id}">[[{$form_field.caption}]] {if $form_field.is_required}*{/if}</label>
			</div>
			{else}
			<div class="form-group {$form_field.id|lower}">
				<label class="form-label">[[$form_field.caption]] {if $form_field.is_required}*{/if}</label>
				{input property=$form_field.id} </div>
			{/if}
			{/foreach}
			<div class="form-group">
				<label class="form-label hidden-xs-480"></label>
				<div class="form--move-left">
					<div class="inline-block checkbox-field">
						<input type="checkbox" name="terms" checked="checked" id="terms" />
					</div>
					<span class="form-label inline"> <a class="link" target="_blank" href="{$GLOBALS.site_url}/terms-of-use/">[[I agree to the terms of use]] *</a> </span> </div>
			</div>
			<div class="form-group form-group__btns text-center">
				<input type="hidden" name="user_group_id" value="{$user_group_info.id}" />
				<input type="submit" class="register btn btn__orange btn__bold" value="[[Register]]" />
			</div>
		</form>
		{javascript} 
		<script type="text/javascript" language="JavaScript">
		function checkField( obj, name ) {
			if (obj.val() != "") {
				var options = {
					data: { isajaxrequest: 'true', type: name },
					success: showResponse
				};
				$("#registr-form").ajaxSubmit( options );
			}
			function showResponse(responseText, statusText, xhr, $form) {
				var mes = "";
				switch(responseText) {
					case 'NOT_VALID_EMAIL_FORMAT':
						obj.closest('.form-group').find('.form-label').addClass('form-label__error').text('[[Please enter valid email address]]');
						break;
					case 'NOT_UNIQUE_VALUE':
						obj.closest('.form-group').find('.form-label').addClass('form-label__error').text('[[This email address is already in use.]]');
						break;
					case '1':
						mes = "";
						if (name == 'username') {
							obj.closest('.form-group').find('.form-label').removeClass('form-label__error').text('Email {if $form_fields["username"].is_required}*{/if}');
						}
						else {
							obj.closest('.form-group').find('.form-label').removeClass('form-label__error').text(name + ' {if $form_fields[name].is_required}*{/if}');
						}
						break;
				}
				$("#am_" + name).text(mes);
			}
		};
		</script> 
		{/javascript}
		<div class="clear"></div>
		<div class="text-center form-group "> <a class="link" href="{$GLOBALS.user_site_url}/login/{if $smarty.request.return_url}?return_url={$smarty.request.return_url|escape:'url'}{/if}">Vous avez déjà un compte? se connecter</a> </div>
	</div>
	
	
	<div class=" col-md-6"> {if $user_group_info.id == 'JobSeeker'}
		<div class="left-section-wrp">
			<div id="information">
				<h3><span class="bulb"></span>Créer un profil Jobsquare vous aidera à </h3>
				<ul>
					<li> Recevoir des alertes pour les meilleurs emplois </li>
					<li> Rechercher des emplois à l'aide de filtres avancés </li>
					<li> Ajouter votre CV et soyez vu par les meilleurs employeurs </li>
				</ul>
				<h3 > <span class="glyphicon glyphicon-heart" aria-hidden="true"></span> Se connecter via les réseaux sociaux </h3>
				{module name="social" function="social_plugins"}
				<div class="clear"></div>
				<p class="employer-title">Employeur qui cherche à recruter?</p>
				<p class="employer-click-here"> Si vous représentez une entreprise / organisation et souhaitez embaucher, <a href="{$GLOBALS.user_site_url}/registration/?user_group_id=Employer"> créez un compte employeur </a>pour publier des offres d'emploi et rechercher des CV. </p>
			</div>
		</div>
		{else}
		<div class="left-section-wrp">
			<div id="information">
				<h3><span class="bulb"></span>Créer un profil Jobsquare vous aidera à </h3>
				<ul>
					<li> Accéder à la plus grande base de données de talents professionnels Marocns </li>
					<li> Contrôler votre processus d'embauche du début à la fin </li>
					<li> Gagner du temps en contactant les bons candidats </li>
				</ul>
				<h3 > <span class="glyphicon glyphicon-heart" aria-hidden="true"></span> Se connecter via les réseaux sociaux </h3>
				{module name="social" function="social_plugins"}
				<div class="clear"></div>
				<p class="employer-title">Chercheur d'emploi ? </p>
				<p class="employer-click-here"> Si vous êtes à la recherche d'un emploi, rendez-vous à la rubrique <a href="{$GLOBALS.user_site_url}/registration/?user_group_id=JobSeeker">Inscription</a> d'un demandeur d'emploi </p>
			</div>
		</div>
		{/if} </div>
	<div class="clear"></div>
</div>
