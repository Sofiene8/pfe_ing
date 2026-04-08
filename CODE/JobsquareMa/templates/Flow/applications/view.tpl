{title}[[Applicants]]{/title}
<h1 class="my-account-title">[[My Account]]</h1>
<div class="my-account-list">
    <ul class="nav nav-pills">
        <li class="presentation"><a href="{$GLOBALS.site_url}/my-listings/job/">[[Job Postings]]</a></li>
        <li class="presentation active"> <a href="{$GLOBALS.site_url}/system/applications/view/">[[Applicants]]</a></li>
        <li class="presentation"> <a href="{$GLOBALS.site_url}/edit-profile/">[[Company Profile]]</a></li>
    </ul>
</div>
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
<div class="details-body__left applicants">

    <form method="post" name="applicationFilter" action="" id="applicationFilter" class="clearfix">
        <input type="hidden" name="orderBy" value="{$orderBy|escape:'html'}" />
        <input type="hidden" name="order" value="{$order}" />
        <input type="hidden" name="appsPerPage" value="{$appsPerPage}" />
        <div class="col-xs-12 col-sm-6">
            <h3 class="title__primary title__primary-small">[[Applicants]]</h3>
        </div>
        <div class="col-xs-12 col-sm-6 app-job-filter">
            <select name="appJobId" class="form-control">
                <option value="">[[All Jobs]]</option>
                {foreach from=$appJobs item=appJob}
                    <option value="{$appJob.id}"{if $appJob.id == $current_filter} selected="selected"{/if}>{$appJob.title|escape}</option>
                {/foreach}
            </select>
        </div>
        <input type="submit" value="[[Filter]]" class="btn btn-default hidden filter-button" />
    </form>
    <div id="applicants-list">
        {foreach item=application from=$applications name=applications}
            <article id="application-{$application.id}" class="media well listing-item {if $listing.type.id eq 'Job'}listing-item__jobs{elseif $listing.type.id eq 'Resume'}listing-item__resumes{/if}">
                {if $application.resumeInfo.Photo.file_url}
                    <div class="media-left listing-item__logo listing-item__resumes">
                        <div class="job-seeker__image">
                            <a class="link profile__image" href="{$GLOBALS.site_url}{$application.resumeInfo|listing_url}">
                                <img class="media-object profile__img" src="{$application.resumeInfo.Photo.file_url}" />
                            </a>
                        </div>
                    </div>
                {/if}
                <div class="media-body">
                    <div class="media-heading listing-item__title">
                        <span class="app-track-link">
                            {if $application.resume}
                                {if $application.resumeInfo}
                                    <a href="{$GLOBALS.site_url}{$application.resumeInfo|listing_url}">
                                        {$application.username|escape}
                                    </a>
                                {else}
                                    [[Not Available Anymore]]
                                {/if}
                            {else}
                                <a href="?appsID={$application.id}&amp;filename={$application.file|escape:"url"}">{$application.username|escape}</a>
                            {/if}
                        </span> <br />
                    </div>
                    <div class="listing-item__info clearfix">
                        <span class="listing-item__info--item listing-item__info--item-company">
                            {$application.job.Title|escape}
                        </span>
                    </div>
                    <div class="listings-application-info clearfix">
                        <div class="listing-item__date visible-xs-480">{$application.date|date}</div>
                        <a class="listings-application-info--item link" href="mailto:{$application.email}">{$application.email}</a>
                        {if $application.file}
                            <a class="listings-application-info--item link" href="?appsID={$application.id}&amp;filename={$application.file|escape:"url"}">[[Resume file]]</a>
                        {/if}
                        {if $application.resumeInfo.Resume.file_name}
                            <a class="listings-application-info--item link" href="{$GLOBALS.site_url}{$application.resumeInfo|listing_url}?filename={$application.resumeInfo.Resume.saved_file_name|escape:'url'}">[[Resume file]]</a>
                        {/if}
                        {if $application.comments}
                            <span class="listings-application-info--item">
                                <a class="link" onclick="showCoverLetter('{$application.id}')" href="#">[[Cover letter]]</a>
                                <div id="coverLetter_{$application.id}" style="display: none">
                                    {$application.comments|escape}
                                </div>
                            </span>
                        {/if}
                    </div>
                </div>
                <div class="media-right text-right hidden-xs-480 relative">
                    <div class="listing-item__date">{$application.date|date}</div>
                    <button type="button" class="listing-item__trash" title="[[Remove]]" data-id="{$application.id}"></button>
                </div>
            </article>
        {/foreach}
        <button type="button" class="load-more btn btn__white {if $applications|@count < $appsPerPage}hidden{/if}" data-page="2">
            [[Load more]]
        </button>
    </div>
</div>

<div class="modal fade confirm-delete" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="message-modal-label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div class="form">
                    <div class="form-group text-center">
                        [[This application will be removed permanently. Are you sure?]]
                    </div>
                    <div class="form-group form-group__btns text-center">
                        <a href="#" class="btn btn__orange btn__bold">
                            [[Yes]]
                        </a>
                        <button type="button" class="btn btn__white" data-dismiss="modal">[[Cancel]]</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{javascript}
	<script>
		function showCoverLetter(id) {
			message('[[Cover letter]]', $("#coverLetter_" + id).html());
		}

        $('.form-control').change(function () {
            $('.filter-button').trigger('click');
        });

        var listingPerPage = {$appsPerPage};
        $('.load-more').click(function() {
            var self = $(this);
            self.addClass('loading');
            $.get('?appJobId={$current_filter}&action=search&page=' + self.data('page'), function(data) {
                self.removeClass('loading');
                var listings = $(data).find('.listing-item');
                if (listings.length) {
                    $('.listing-item').last().after(listings);
                    self.data('page', parseInt(self.data('page')) + 1);
                }

                if ($(data).find('.listing-item').length < listingPerPage) {
                   self.hide();
                }
            });
        });

        $(document).ready(function() {
            $('.nav-pills').scrollLeft($('.nav-pills').width() / 2);
        });

        $('.listing-item__trash').click(function() {
            $('#confirm-delete')
                    .data('id', $(this).data('id'))
                    .modal('show');
        });

        $('#confirm-delete .btn__orange').click(function(e) {
            e.preventDefault();
            var modal = $('#confirm-delete');
            modal.addClass('loading');
            $.get('{$GLOBALS.user_site_url}/system/applications/view/', {
                action: 'delete',
                id: modal.data('id')
            }).done(function() {
                $('#application-' + modal.data('id')).remove();
                modal.modal('hide');
                modal.removeClass('loading');
            }).fail(function() {
                modal.removeClass('loading');
            });
        });
	</script>
{/javascript}