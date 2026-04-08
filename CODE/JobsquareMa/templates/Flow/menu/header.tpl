{if 'banner_top'|banner}
	<div class="banner banner--top">
		{'banner_top'|banner}
	</div>
{/if}
<nav class="navbar navbar-default {if 'banner_top'|banner}with-banner{/if}">
	<div class="container container-fluid">
		<div class="logo navbar-header">
			<a class="logo__text navbar-brand" href="{$GLOBALS.site_url}">
				<img src="{$GLOBALS.site_url}/templates/Flow/assets/images/{$GLOBALS.theme_settings.logo|escape:'url'}" />
			</a>
		</div>
		<div class="burger-button__wrapper burger-button__wrapper__js visible-sm visible-xs"
			 data-target="#navbar-collapse" data-toggle="collapse">
			<div class="burger-button"></div>
		</div>
		<div class="collapse navbar-collapse" id="navbar-collapse">
			<div class="visible-sm visible-xs">
				{capture name='nav_menu'}
					{module name='template_manager' function='navigation_menu'}
				{/capture}
				{$smarty.capture.nav_menu}
			</div>
			<ul class="nav navbar-nav navbar-right">
				{if $GLOBALS.current_user.logged_in}
					<li class="navbar__item"><a class="navbar__link" href="{$GLOBALS.site_url}/logout/"> [[Logout]]</a></li>
					<li class="navbar__item navbar__item__filled">
                        {if $GLOBALS.current_user.group.id == "Employer"}
                            <a class="navbar__link btn__blue" href="{$GLOBALS.site_url}/my-listings/job/">[[My Account]]</a>
                        {else}
                            <a class="navbar__link btn__blue" href="{$GLOBALS.site_url}/my-listings/resume/">[[My Account]]</a>
                        {/if}
                    </li>
				{else}
					<li class="navbar__item navbar__item {if $url == '/login/'}active{/if}">
						<a class="navbar__link navbar__login" href="{$GLOBALS.site_url}/login/">[[Sign in]]</a>
					</li>
					<li class="navbar__item navbar__item__filled"><a class="navbar__link  btn__blue" href="{$GLOBALS.site_url}/registration/">[[Sign up]]</a></li>
				{/if}
			</ul>
			<div class="visible-md visible-lg">
				{$smarty.capture.nav_menu}
			</div>
		</div>
	</div>
</nav>