{title} Offre de formation {$listing.Title} {/title}
{keywords} {$listing.Title} {/keywords}
{description} {$listing.JobDescription|strip_tags|truncate:165} {/description}
{head}
	{module name="miscellaneous" function="opengraph_meta" listing=$listing}
{/head}

{* todo: Показывать алерт если юзер пришел из чекаута *}
{if $smarty.request.isBoughtNow}
	<div class="alert alert-bought-now text-center content-text cloud"> {if $listing.active|status == 'pending'}
	[[Votre formation sera publiée dès qu'elle sera examinée et approuvée.]]
	{else}
	[[Vous avez posté votre formation avec succès.]] <br/>
	<a href="{$GLOBALS.site_url}/my-listings/training/" class="link">[[Affichez vos statistiques de formation dans la section "Mon Compte" ]]
		{/if} <a href="#" class="alert__close"></a> </div>
{/if}
<div class="container listing-results">
	<div class="row">
		<div class="details-header page-detail-annonce ">
			<div class="container training_info">
				<div class="details-breadcrumbs col-md-9"> <a href="{$GLOBALS.site_url}/trainings/" alt="Formation Maroc" title="Formation Maroc">Formation Maroc</a> > {$listing.Title|escape} </div>
				<div class="results text-left col-md-3"> {if $url == "/my-training-details/{$listing.id}/"} <a href="{$GLOBALS.site_url}/edit-{$listing.type.id}/?listing_id={$listing.id}"
					   class="btn__back"> [[Back]] </a> {javascript} 
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
					{if $backPage && is_numeric($searchID)} <a href="{$GLOBALS.site_url}/trainings/?searchID={$searchID}&action=search&listings_per_page={$backPage * 20}#{$listing.id}"
						   class="btn__back"> [[Back]] </a> {else} <a href="javascript:history.go(-1)"
						   class="btn__back"> [[Back]] </a> {/if}
					{/if} </div>
					<div class="clear"></div>
			</div>
		</div>
		<div class=" training_info col-md-9">
			<div class="top-annonce">
				<div class="left-top-annonce col-md-8">
					<h1 class="details-header__title ">{$listing.Title|escape}</h1>
					<ul class="offredetails">
						<li class="item-company"> {$listing.user.CompanyName|escape} </li>
						{if $listing|location}
						<li class="item-location"> - {$listing|location} </li>
						{/if}

					{assign var="myDate" value= $listing.activation_date}
					<li class="item-date"> - {if $myDate|timeAgo eq "à l\'instant"}{else} Il'y a {/if}{$myDate|timeAgo}</li>
						
					</ul>
				</div>
				<div class="col-md-4"> {if $listing.user.Logo.file_url} <a href="{if $listing.user.isJobg8}{$GLOBALS.site_url}/company/{$listing.user.id}/{$listing.CompanyName|pretty_url}/{else}{$GLOBALS.site_url}/company/{$listing.user.id}/{$listing.user.CompanyName|pretty_url}/{/if}"> <img class="profile__img profile__img-company" src="{$listing.user.Logo.file_url}" alt="" /> </a> {/if} </div>
				<div class="job-top-wrapper">
					<div class="clearfix">
						<div class="job-left-side"> {if $isActive} <a class="btn details-footer__btn-apply btn__orange btn__bold c-violet"
							href="{$applyBtn_onClick}"
							data-toggle="modal"
							data-target="#apply-modal"
							data-href="{$url}"
							data-applied='{if $isApplied}applied{/if}'
							data-title="{$modalTitle}"> [[Apply Now Training]] </a> {/if} </div>
						<div class="job-right-side">
							<div class="job-numbers">
								<div class="be-second-to-apply"><span class="glyphicon glyphicon-arrow-up visible-xs-inline"></span> <span class="glyphicon glyphicon-arrow-left  visible-sm-inline visible-md-inline visible-lg-inline"></span><span>N'attendez pas pour vous garantir cette formation !</span></div>
							</div>
						</div>
					</div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="detail-offre ">
				<h3 class="details-body__title">[[{$form_fields.JobDescription.caption|strip_tags}]]</h3>
				<div class="details-body__content content-text">{display property='JobDescription'}</div>
				{foreach from=$form_fields item=list_value}
				{if !$list_value.is_reserved || $list_value.id == "Duree"}
				{if {display property=$list_value.id}}
				<h3 class="details-body__title">{$list_value.caption|escape}</h3>
				<div class="details-body__content content-text">{display property=$list_value.id}</div>
				{/if}
				{/if}
				{/foreach} </div>
			<div class="company-info-card content-card card-small hidden-xs hidden-sm"> {assign var="company_name" value=$listing.user.CompanyName|escape}
				<div class="profile__info">
					<div class="card-title">[[About $company_name]]</div>
					<div class="company-brief">{$listing.user.CompanyDescription}</div>
					<div> <a class="companylink" href="{$GLOBALS.site_url}/company/{$listing.user.id}/{$listing.user.CompanyName|pretty_url}/">&raquo; [[Company Profile]]</a> <br />{if $listing.user.PrivateSpace} <a target="_blanc" class="companylink" href="{if $listing.user.PrivateSpace|strstr:'https://'||$listing.user.PrivateSpace|strstr:'https://'||$listing.user.PrivateSpace|strstr:'www.'}{$listing.user.PrivateSpace}{elseif $listing.user.PrivateSpace eq ''}#{else}{$GLOBALS.site_url}/entreprise/{$listing.user.PrivateSpace}{/if}">&raquo; Site de l'entreprise</a> {/if} </div>
					<div class="job-type"> <span class="main-label">Categories: </span> {display property='EmploymentType' assign='EmploymentType'}
						{if $EmploymentType} <span class="job-type__value">{$EmploymentType}</span> {/if}
						{display property='id_Training_Categories' template="multilist_job_category.tpl"} </div>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="company-info-card content-card card-small hidden-xs hidden-sm"> {assign var="company_name" value=$listing.user.CompanyName|escape}
				<div class="profile__info">
					<div class="card-title">[[About $company_name]]</div>
					<div class="company-brief">{$listing.user.CompanyDescription|strip_tags|truncate:320}</div>
					<div> <a class="btn__profile" href="{$GLOBALS.site_url}/company/{$listing.user.id}/{$listing.user.CompanyName|pretty_url}/">&raquo; [[Company Profile]]</a><br /> {if $listing.user.PrivateSpace} <a target="_blanc" class="btn__profile" href="{if $listing.user.PrivateSpace|strstr:'https://'||$listing.user.PrivateSpace|strstr:'https://'||$listing.user.PrivateSpace|strstr:'www.'}{$listing.user.PrivateSpace}{elseif $listing.user.PrivateSpace eq ''}#{else}{$GLOBALS.site_url}/entreprise/{$listing.user.PrivateSpace}{/if}">&raquo; Site de l'entreprise</a> {/if} </div>
				</div>
			</div>
			<div class="similar-job"> {module name="classifieds" function="plus_featured_listings" items_count="5" listing_type="Job" listing_id=$listing.id}
			<div class="clear"></div>
</div>
					{module name="classifieds" function="plus_training_listings" items_count="10" listing_type="Training" listing_id=$listing.id} 
	
			
			
			
			</div>
	</div>
	<div class="clear"></div>
</div>
</div>
</div>
<div class="details-footer  {if $GLOBALS.user_page_uri == '/training-preview/'}job-preview{/if}">
	<div class="container"> {if $GLOBALS.user_page_uri == '/training-preview/'}
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
		{else}
		{if isset($listing.ApplicationSettings.add_parameter) && $listing.ApplicationSettings.add_parameter == 2}
		{assign var='isApplied' value=false}
		{if $listing.user.isJobg8 && $listing.jobType == 'APPLICATION'}
		{capture assign='applyBtn_onClick'}{$GLOBALS.site_url}/apply-now-external/?listing_id={$listing.id}{/capture}
		{else}
		{if !$GLOBALS.settings.loggedin_apply || $GLOBALS.current_user.logged_in}
		{capture assign='applyBtn_onClick'}{$GLOBALS.site_url}/system/classifieds/application_redirect/?listing_id={$listing.id}{/capture}
		{else}
		{capture assign='url'}
		{$GLOBALS.site_url}/apply-now/?listing_id={$listing.id}&ajaxRelocate=1
		{/capture}
		{/if}
		{/if}
		{else}
		{capture assign='url'}
		{$GLOBALS.site_url}/apply-now/?listing_id={$listing.id}&ajaxRelocate=1
		{/capture}
		{/if}
		{capture assign='modalTitle'}
		{assign var="job_title" value=$listing.Title|escape}
		{assign var="company_name" value=$listing.user.CompanyName|escape}
		[[Apply to $job_title at $company_name]]
		{/capture}
		{/if}
		{if $isActive}
		<div class="col-md-4">
		 <a class="btn details-footer__btn-apply btn__orange btn__bold c-violet"
				href="{$applyBtn_onClick}"
				data-toggle="modal"
				data-target="#apply-modal"
		   		data-href="{$url}"
		   		data-applied='{if $isApplied}applied{/if}'
				data-title="{$modalTitle}"> [[Apply Now Training]] </a> 
				</div>
				{else} <br>
		<span> <span><b> Désolé, cette formation n'est plus disponible.</b></span></span> {/if}
		<div class="social-share pull-right"> <span class="social-share__title"> [[Share this training]]: </span> {if !$myListing}
			<div class="social-share__icons"> <span class='st_facebook_large' displayText='Facebook'></span> <span class='st_twitter_large' displayText='Tweet'></span> <span class='st_googleplus_large' displayText='Google +'></span> <span class='st_linkedin_large' displayText='LinkedIn'></span> <span class='st_pinterest_large' displayText='Pinterest'></span> <span class='st_email_large' displayText='Email'></span> </div>
			{/if} </div>
	</div>
</div>
{literal} 
<script type="text/javascript">var switchTo5x=true;</script> 
<script type="text/javascript" src="https://ws.sharethis.com/button/buttons.js"></script> 
<script type="text/javascript">stLight.options({publisher: "3f1014ed-afda-46f1-956a-a51d42078320", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script> 
{/literal}
{javascript} 
<script type="text/javascript">
		dockDetailsFooter();
		$(window).on('resize orientationchange', function(){
			dockDetailsFooter();
		});

		function dockDetailsFooter() {
			$(".details-footer").affix({
				offset: {
					bottom: function () {
						return (this.bottom = $('.footer').outerHeight(true))
					}
				}
			});
		}
		$('.details-footer__btn-apply').on('click', function(e) {
			if ($(this).attr('href') != '') {
				e.preventDefault();
				e.stopPropagation();
				window.open($(this).attr('href'));
			}
		});

		$('.alert__close').on('click', function(e) {
			e.preventDefault();
			$(this).closest('.alert').hide();
		});
	</script> 
{/javascript} 