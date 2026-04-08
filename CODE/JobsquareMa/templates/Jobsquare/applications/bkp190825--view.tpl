{title}{$listing_title}{/title}

<a href="{$GLOBALS.site_url}/my-listings/job/" class="btn__back view-applicants-back">[[Back]]</a>

<h3 class="title__primary title__primary-small text-center title__bordered">{$listing_title}</h3>

{if $errors}
    {foreach from=$errors key=error_code item=error_message}
        {if $error_code == 'NO_SUCH_FILE'} <p class="alert alert-danger">[[No such file found in the system]]</p>
        {elseif $error_code == 'NO_SUCH_APPS'} <p class="alert alert-danger">[[No such application with this ID]]</p>
        {elseif $error_code == 'APPLICATIONS_NOT_FOUND'}
            {if $current_filter}
				<p class="alert alert-danger">{tr}There are no applications for "$listing_title"{/tr|escape}</p>
            {else}
				<p class="alert alert-danger">[[You have no applications so far.]]</p>
            {/if}
        {/if}
    {/foreach}
{/if}

<div class="applicants">

    {foreach from=$statuses key="status" item=count}
		<div class="applicant-status" data-status="{$status|escape}">
			<div class="applicant-status__header">
				<h4>[[{$status}]] <span class="count">({$count})</span></h4>
			</div>

			<div class="applicant-status__cards">

                {foreach item=application from=$applications}
                    {if $application.status == $status}
						<div class="applicant-card" data-app="{$application.id|escape}" {if $application.resume}data-resume="{$application.resume|escape}"{/if}>
							<article id="application-{$application.id}" class="media well">
								<div class="applicant-card__media">
							{if $application.deja_vu==1}
								  <div class="media-right text-right" style="float: right;">
								 {if $application.date_last_vu !="0000-00-00"}<div class="dejavu"> vu le: {$application.date_last_vu|date}</div>{/if}
								
								</div>
								{/if}
                                    {if $application.resumeInfo.Photo.file_url}
										<div class="media-left profile__img" style="background-image: url('{$application.resumeInfo.Photo.file_url}');"></div>
                                  {else}
								<div class="media-left profile__img" style="background-image: url('{$GLOBALS.site_url}/templates/Jobsquare/assets/images/sansphoto.jpg');"></div>
								  {/if}
							
									<div class="media-body">
										<div class="media-heading listing-item__title">
                                            <span class="app-track-link">

                                                {if $application.resume}
                                                    {if $application.resumeInfo}
														<a href="{$GLOBALS.site_url}{$application.resumeInfo|listing_url}">
                                                            {if $application.username}
                                                                {$application.username|escape}
                                                            {else}
                                                                {$application.resumeInfo.Title}
                                                            {/if}
                                                        </a>
                                                    {else}
														[[Not Available Anymore]]
                                                    {/if}
                                                {else}

                                                    <a href="?appsID={$application.id}&amp;filename={$application.file|escape:"url"}">{if $application.username}{$application.username|escape}{else}{$application.file}{/if}</a>
                                                {/if}
                                            </span>
										</div>
										<div class="listing-item__date">{$application.date|date}</div>
									</div>
								</div>
								<div class="applicant-card__comment" {if !$application.notes}style="display: none"{/if}>
									<span class="small">{$application.notes|escape}</span>
								</div>
							</article>
						</div>

                        {javascript}
							<div class="modal fade application-details__modal modal-{$application.id}" data-id="{$application.id}" tabindex="-1" role="dialog" aria-labelledby="message-modal-label">
								<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-body">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
											<div class="details-header">
                                                {if $application.resumeInfo.Photo.file_url}
													<div class="details-header__left">
														<div class="job-seeker__image">
															<div class="profile__image" style="background-image: url('{$application.resumeInfo.Photo.file_url}');" title="{$application.resumeInfo.user.FullName|escape}"></div>
														</div>
													</div>
													{else}
													
													<div class="details-header__left">
														<div class="job-seeker__image">
															<div class="profile__image" style="background-image: url('{$GLOBALS.site_url}/templates/Jobsquare/assets/images/sansphoto.jpg');" title="{$application.resumeInfo.user.FullName|escape}"></div>
														</div>
													</div>
                                                {/if}
												<div class="details-header__right">
													<h1 class="details-header__title">
                                                        {if $application.resume}
                                                            {if $application.resumeInfo}
                                                                {if $application.username}
                                                                    {$application.username|escape}
                                                                {else}
                                                                    {$application.resumeInfo.Title}
                                                                {/if}
                                                            {else}
																[[Not Available Anymore]]
                                                            {/if}
                                                        {else}
                                                            {$application.username|escape}
                                                        {/if}
													</h1>


													<ul class="listing-item__info clearfix">
                                                        {if $application.email}
															<li class="listing-item__info--item listing-item__info--item-email">
																<a href="mailto:{$application.email|escape}">
                                                                    {$application.email|escape}
																</a>
															</li>
                                                        {/if}
                                                        {if $application.resumeInfo && $application.resumeInfo.Phone}
														
															<li class="listing-item__info--item listing-item__info--item-phone">
																<a href="tel:{$application.resumeInfo.Phone}">{$application.resumeInfo.Phone}</a>
															</li>
                                                        {/if}
														{if $application.resumeInfo && $application.resumeInfo.OtherPhone}
														
															<li class="listing-item__info--item listing-item__info--item-phone">
																<a href="tel:{$application.resumeInfo.Phone}">{$application.resumeInfo.OtherPhone}</a>
															</li>
                                                        {/if}
													</ul>
													<ul class="listing-item__info clearfix">
														<li class="listing-item__info--item listing-item__info--item-date">
                                                            {$application.date|date}
														</li>
														<li class="listing-item__info--item listing-item__info--item--status">
															<select>
                                                                {foreach from=$statuses key='s' item='c'}
																	<option value="{$s|escape}" {if $application.status == $s}selected="selected"{/if}>{$s|escape}</option>
                                                                {/foreach}
															</select>
														</li>
													</ul>
												</div>
												<div class="clearfix"></div>
											</div>
											<div class="details-content">
                                                {if $application.comments != '' || $application.resumeInfo}
													<div class="col-sm-8">
                                                        {if $application.comments != ''}
															<h2 class="application-details__title">[[Cover letter]]</h2>
															<div class="application-details__cover-letter">{$application.comments|escape}</div>
                                                        {/if}

                                                        {if $application.resumeInfo}
															<div>
																<h2 class="application-details__title">[[Online Resume]]</h2>
																<div class="application-details__resume">
																</div>
															</div>
                                                        {/if}
													</div>
                                                {/if}

												<div class="{if $application.comments != '' || $application.resumeInfo}col-sm-4{else}col-sm-6{/if}">
													<div class="application-details__right">
                                                        {if $application.file}
															<div class="application-details__right-item application-details__right-item--file">
																<a class="btn listings-application-info--item application-details__right-item__file link" href="?appsID={$application.id}&amp;filename={$application.file|escape:'url'}">[[Resume file]]</a>
															</div>
                                                        {elseif $application.resumeInfo.Resume.file_url}
															<div class="application-details__right-item application-details__right-item--file">
																<a class="btn listings-application-info--item application-details__right-item__file link" href="?filename={$application.resumeInfo.Resume.saved_file_name|escape:'url'}&listing_id={$application.resumeInfo.id}">[[Resume file]]</a>
															</div>
                                                        {/if}
                                                        {if $application.user.li_profile_url}
															<div class="application-details__right-item application-details__right-item--linkedin">
																<a class="btn listings-application-info--item application-details__right-item__linkedin link" target="_blank" href="{$application.user.li_profile_url}">[[LinkedIn Profile]]</a>
															</div>
                                                        {/if}
                                                        {if $application.email}
															<div class="application-details__right-item profile__info-list__item profile__info-list__item-email">
																<a href="mailto:{$application.email|escape}" class="btn application-details__contact application-details__right-item__contact">
																	[[Contact Candidate]]
																</a>
															</div>
                                                        {/if}
														<div class="application-details__right-item application-details__right-item-notes">
															<div class="application-details__right-item__notes">[[Notes]]</div>
															<textarea name="notes">{$application.notes|escape}</textarea>
															<br>
															<button type="button" class="btn btn__blue update-notes">[[Save]]</button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
                        {/javascript}
                    {/if}
                {/foreach}
			</div>
		</div>
    {/foreach}
</div>
{javascript}
	<div class="modal fade contact-modal" id="contact-modal" tabindex="-1" role="dialog" aria-labelledby="contact-modal-label">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"></h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				</div>
				<div class="modal-body">
					<form class="form form-horizontal" method="post">
						<div class="alert alert-danger" style="display: none;">
							[[Oops. Something went wrong. Please contact website administrator to resolve the issue.]]
						</div>
						<input type="hidden" name="action" value="contact">
						<input type="hidden" name="id" value="">
						<div class="form-group">
							<label for="name" class="form-label">[[Subject]]</label>
							<input type="text" class="form-control" name="subject" value="" data-value="{$listing_title|escape}" />
						</div>
						<div class="form-group">
							<label for="name" class="form-label">[[Message]]</label>
							<textarea name="message"></textarea>
						</div>
						<div class="form-group form-group__btns text-center">
							<button type="submit" class="btn btn__orange btn__bold">
								[[Send]]
							</button>
							<button type="button" class="btn btn__white" data-dismiss="modal">[[Cancel]]</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/ismobilejs/0.4.1/isMobile.min.js"></script>
	<script>

        $('.application-details__contact').click(function(e) {
            e.preventDefault();
            var subject = $('#contact-modal input[type="text"]').first();
            subject.val(subject.data('value'));
            $('#contact-modal input[name="id"]').val($(this).closest('.modal').data('id'));
            $('#contact-modal .modal-title').html('[[Contact]] ' + $(this).closest('.modal').find('.details-header__title').html());
            $('#contact-modal').find('.alert').hide();
            $('.contact-modal').modal('show');
        });

        $('.contact-modal form').ajaxForm({
            success: function() {
                $('#contact-modal').modal('hide');
                $('#contact-modal textarea').val('');
            },
            error: function() {
                $('#contact-modal').find('.alert').show();
            }
        });

        $('#contact-modal').on('hidden.bs.modal', function () {
            setTimeout(function () {
                $('body').addClass('modal-open');
            }, 500)
        });

        $('.update-notes').click(function() {
            var notes = $(this).closest('div').find('textarea').val();
            $.post('', {
                'action': 'notes',
                'id': $(this).closest('.modal').data('id'),
                'notes': notes
            });
            var id = $(this).closest('.modal').data('id');
            if (notes != '') {
                $('#application-' + id).find('.applicant-card__comment').show();
                $('#application-' + id).find('.applicant-card__comment .small').text(notes);
            } else {
                $('#application-' + id).find('.applicant-card__comment').hide();
            }
        });

        if (!isMobile.any) {
            $('.applicant-status__cards').sortable({
                connectWith: $('.applicant-status__cards').not($(this)),
                items: '> .applicant-card',
                placeholder: 'ui-state-highlight',
                tolerance: 'pointer',
                start: function(e, ui) {
                    $(this).find('.applicant-card').addClass('prevent-click');
                },
                stop: function(e, ui) {
                    var status = $(ui.item).closest('.applicant-status').data('status');
                    var id = $(ui.item).data('app');
                    $.get('', {
                        'action': 'set_status',
                        'order': $(ui.item).index() + 1,
                        'id': id,
                        'status': status
                    });
                    $('.modal-' + id).find('.details-header select').val(status);
                    $('.applicant-status').each(function() {
                        $(this).find('.count').text('(' + $(this).find('.applicant-card').length + ')');
                    });
                    setTimeout(function(){
                        $('.applicant-card').removeClass('prevent-click');
                    }, 100)
                }
            });
        }

        $('.application-details__modal select').change(function() {
            var card = $(this).closest('.modal').data('id');
            card = $('.applicant-card[data-app="' + card + '"]');
            $('.applicant-status[data-status="' + $(this).val() + '"] .applicant-status__cards').append(card);
            $.get('', {
                'action': 'set_status',
                'order': card.index() + 1,
                'id': card.data('app'),
                'status': $(this).val()
            });

            $('.applicant-status').each(function() {
                $(this).find('.count').text('(' + $(this).find('.applicant-card').length + ')');
            });
        });

        $('.applicant-card').click(function (e) {
            if (!$(this).hasClass('prevent-click')) {
                e.preventDefault();
                var card = $(this);
                var modal = $('.modal-' + card.data('app'));
                var resume = card.data('resume');
                if (resume) {
                    $.get(window.SJB_UserSiteUrl + '/resume/' + resume + '/', function(data) {
                        modal.find('.application-details__resume').html(data);
                    }).fail(function() {
                    });
                }

                $.get('', {
                    'action': 'application_view',
                    'id': card.data('app')
                });

                modal.modal('show');
            }
        });

        $(document).ready(function() {
            $('.nav-pills').scrollLeft($('.nav-pills').width() / 2);
        });

	</script>

	{*<script type="text/javascript">*}
        {*{literal}*}
        {*(function(e,r){function n(e,r){e[r]=function(){e.push([r].concat(Array.prototype.slice.call(arguments,0)))}}function o(){var e=r.location.hostname.match(/[a-z0-9][a-z0-9\-]+\.[a-z\.]{2,6}$/i),n=e?e[0]:null,o="; domain=."+n+"; path=/; expires=" + new Date(new Date().setFullYear(new Date().getFullYear() + 1)).toUTCString();r.cookie=r.referrer&&-1===r.referrer.indexOf(n)?"jaco_referer="+r.referrer+o:"jaco_referer="+t+o}var a="JacoRecorder",t="none";!function(e,r,t,i){if(!t.__VERSION){e[a]=t;for(var c=["init","identify","startRecording","stopRecording","removeUserTracking","setUserInfo","trackEvent"],s=0;s<c.length;s++)n(t,c[s]);o(),t.__VERSION=2.1,t.__INIT_TIME=1*new Date;var f=r.createElement("script");f.async=!0,f.setAttribute("crossorigin","anonymous"),f.src=i;var d=r.getElementsByTagName("head")[0];d.appendChild(f)}}(e,r,e[a]||[],"https://recorder-assets.getjaco.com/recorder_v2.js")}).call(window,window,document);*}
        {*{/literal}*}
        {*window.JacoRecorder.init("82a6a5a7-ba72-4756-832b-5c94e3a3f6f6");*}
        {*window.JacoRecorder.identify('{$saas_identity|escape:'js'}');*}
	{*</script>*}
{/javascript}
