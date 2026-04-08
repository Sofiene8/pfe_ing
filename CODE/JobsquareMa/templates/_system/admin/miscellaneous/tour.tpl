<div class="modal fade modal-tour" id="modal-tour" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title text-center">[[Welcome to Smartjobboard!]]</h2>
            </div>
            <div class="modal-body">
                {assign var="admin_name" value='there'}
                {if $smarty.session.admin.name}
                    {assign var="admin_name" value=$smarty.session.admin.name}
                {/if}
                <p>[[Hi $admin_name,]]</p>
                <p>[[Thank you for taking the time to try Smartjobboard!]]</p>
                <p>[[We created this quick tour to guide you through the process of setting up your job board in 5 easy steps.]]</p>
                <br/>
                <div class="alert alert-success">
                    [[NOTE: You can access your job board front-end by clicking the
                    <a href="{if $GLOBALS.settings.domain|escape}https://{$GLOBALS.settings.domain|escape}{$GLOBALS.base_url}{else}{$GLOBALS.user_site_url}{/if}" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i></a> icon at the top-left, or opening this link:
                    <br/><a class="link" href="{if $GLOBALS.settings.domain|escape}https://{$GLOBALS.settings.domain|escape}{$GLOBALS.base_url}{else}{$GLOBALS.user_site_url}{/if}" target="_blank">{if $GLOBALS.settings.domain|escape}https://{$GLOBALS.settings.domain|escape}{$GLOBALS.base_url}{else}{$GLOBALS.user_site_url}{/if}</a>]]
                </div>
                <div class="modal-tour__bottom">
                    <button type="button" class="btn btn--primary btn__start-tour">[[Start the tour!]]</button>
                    <a href="#" class="skip-it" data-dismiss="modal">[[Skip it]]</a>
                </div>
            </div>
        </div>
    </div>
</div>

<a href="#" class="btn show-tour">
    [[<< Show tour]]
</a>

<div class="tour">
    <div class="tour-menu">
        <div class="text-right">
            <a href="#" class="hide-tour">[[Hide tour >>]]</a>
        </div>

        <div class="panel-group" id="tour-collapse">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">
                        <button data-toggle="collapse" data-parent="#tour-collapse" data-target=".step-1" aria-expanded="false" class="collapsed">
                            [[Customize the look of your job board]]
                        </button>
                    </div>
                </div>
                <div class="panel-collapse collapse step-1 {if $step == '1'}in{/if}" data-step="1" aria-expanded="false">
                    <div class="panel-body">
                        <div class="form-group">
                            <a href="{$GLOBALS.admin_site_url}/edit-themes/" class="btn btn--bordered"
                               data-submenu="sub-themes"
                               data-accordion="appearance">[[Select Theme]]</a>
                        </div>
                        <div class="form-group">
                            <a href="{$GLOBALS.admin_site_url}/customize-theme/" class="btn btn--bordered"
                               data-submenu="sub-customizetheme"
                               data-accordion="appearance">[[Customize Theme]]</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">
                        <button data-toggle="collapse" data-parent="#tour-collapse" data-target=".step-2" class="collapsed" aria-expanded="false">
                            [[Connect your custom domain name]]
                        </button>
                    </div>
                </div>
                <div class="panel-collapse collapse step-2 {if $step == '2'}in{/if}" data-step="2" aria-expanded="false">
                    <div class="panel-body">
                        <div class="form-group">
                            <a href="{$GLOBALS.admin_site_url}/settings/" class="btn btn--bordered"
                               data-submenu="sub-systemsettings"
                               data-accordion="settings">[[Set up domain name]]</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">
                        <button data-toggle="collapse" data-parent="#tour-collapse" data-target=".step-3" class="collapsed" aria-expanded="false">
                            [[Accept payments online]]
                        </button>
                    </div>
                </div>
                <div class="panel-collapse collapse step-3 {if $step == '3'}in{/if}" data-step="3" aria-expanded="false">
                    <div class="panel-body">
                        <div class="form-group">
                            <a href="{$GLOBALS.admin_site_url}/products/employer/" class="btn btn--bordered"
                               data-submenu="sub-employerproducts"
                               data-accordion="ecommerce">[[Add Employer Products]]</a>
                        </div>
                        <div class="form-group">
                            <a href="{$GLOBALS.admin_site_url}/system/payment/gateways/" class="btn btn--bordered"
                               data-submenu="sub-paymentmethods"
                               data-accordion="ecommerce">[[Set up Payment Methods]]</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">
                        <button data-toggle="collapse" data-parent="#tour-collapse" data-target=".step-4" class="collapsed" aria-expanded="false">
                            [[Add companies and jobs]]
                        </button>
                    </div>
                </div>
                <div class="panel-collapse collapse step-4 {if $step == '4'}in{/if}" data-step="4" aria-expanded="false">
                    <div class="panel-body">
                        <div class="form-group">
                            <a href="{$GLOBALS.admin_site_url}/manage-users/employer/" class="btn btn--bordered"
                               data-submenu="sub-employerprofiles"
                               data-accordion="job_board">[[Add Companies]]</a>
                        </div>
                        <div class="form-group">
                            <a href="{$GLOBALS.admin_site_url}/manage-jobs/" class="btn btn--bordered"
                               data-submenu="sub-jobpostings"
                               data-accordion="job_board">[[Create Jobs]]</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">
                        <button data-toggle="collapse" data-parent="#tour-collapse" data-target=".step-5" class="collapsed" aria-expanded="false">
                            [[Backfill your job board with jobs]]
                        </button>
                    </div>
                </div>
                <div class="panel-collapse collapse step-5 {if $step == '5'}in{/if}" data-step="5" aria-expanded="false">
                    <div class="panel-body">
                        <p>[[You can easily backfill your website with jobs from Indeed.]]</p>
                        <div class="form-group">
                            <a href="{$GLOBALS.admin_site_url}/backfilling/?action=settings&plugin=IndeedPlugin" class="btn btn--bordered"
                               data-submenu="sub-jobbackfilling"
                               data-accordion="settings">[[Set up Indeed Backfilling]]</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center">
            <button class="btn btn--primary btn__finish-tour">[[Finish Tour]]</button>
        </div>
    </div>
</div>

{javascript}
    <script>
        var modalDismissed = true;

        try {
            // safari does't support local storage in private mode
            // so we try it first
            if (!localStorage.getItem('tour_offered')) {
                localStorage.setItem('tour_offered', 'true');
                $('#modal-tour').modal('show');
            }

            {if $tour_accepted}
                $('#modal-tour').modal('hide');
                $('.show-tour').addClass('shown');
                if (localStorage.getItem('tour_visible') == 'true') {
                    $('.tour').addClass('shown');
                }
            {/if}
        } catch (e) {
        }

        $('.btn__start-tour').on('click', function() {
            modalDismissed = false;
            $(this).closest('.modal').modal('hide');
            $('.tour, .show-tour').addClass('shown');
            $.get(SJB_AdminSiteUrl + '/system/miscellaneous/guided_tour/', { action: 'start' });
            localStorage.setItem('tour_visible', 'true');
        });

        $('#modal-tour').on('hide.bs.modal', function () {
            if (modalDismissed) {
                $('.tour, .show-tour').addClass('shown');
                $.get(SJB_AdminSiteUrl + '/system/miscellaneous/guided_tour/', { action: 'start' });
                localStorage.setItem('tour_visible', 'true');
            }
        });

        $('.skip-it').on('click', function() {
            modalDismissed = false;
            $.get(SJB_AdminSiteUrl + '/system/miscellaneous/guided_tour/', { action: 'skipped' });
        });

        $('.hide-tour').on('click', function(e) {
            e.preventDefault();
            $('.tour').removeClass('shown');
            localStorage.setItem('tour_visible', 'false');
        });

        $('.show-tour').on('click', function(e) {
            e.preventDefault();
            $('.tour').addClass('shown');
            localStorage.setItem('tour_visible', 'true');
        });

        $('.btn__finish-tour').on('click', function() {
            $('.tour, #modal-tour, .show-tour').remove();
            $.get(SJB_AdminSiteUrl + '/system/miscellaneous/guided_tour/', { action: 'finished' });
        });

        $('#tour-collapse .collapse').on('shown.bs.collapse', function () {
            $.get(SJB_AdminSiteUrl + '/system/miscellaneous/guided_tour/', { action: 'step', step: $(this).data('step') });
        });

        // mark left menu item as active
        // todo: refactor
        $('.tour .panel-body .btn').on('click', function() {
            localStorage.setItem('currentSubMenu', $(this).data('submenu'));
            localStorage.setItem('currentMenu', $(this).data('accordion'));
        });

        if ($('.btn.show-tour').is(':visible')) {
            $('.tour').addClass('active-tour');
        } else {
            $('.tour').removeClass('active-tour');
        }
    </script>
{/javascript}