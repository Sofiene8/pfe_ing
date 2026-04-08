<div class="page-title">
	<h1 class="title">[[Themes]]</h1>
</div>
{if $ERROR eq "ALREADY_EXISTS"}
	<p class="error">[[Theme already exists]].</p>
{elseif $ERROR eq "EMPTY_NAME"}
	<p class="error">[[Please enter a name of the New Theme]]</p>
{/if}
<div class="active-theme">
	<div class="active-theme__left">
		<div class="theme-name">
			{foreach from=$themes item="theme_name" key="theme_system_name"}
				{if $theme eq $theme_system_name}
					[[{$theme_name}]]
				{/if}
			{/foreach}
		</div>
		<div class="theme-tools">
			<a href="{if $GLOBALS.settings.domain}https://{$GLOBALS.settings.domain}{$GLOBALS.base_url}{else}{$GLOBALS.user_site_url}{/if}" class="btn btn--primary theme-tools__btn" target="_blank">[[Preview Theme]]</a>
			<a href="{$GLOBALS.admin_site_url}/customize-theme/" class="btn btn--primary theme-tools__btn">[[Customize Theme]]</a>
		</div>
	</div>
	<div class="active-theme__right">
		<img src="{$GLOBALS.user_site_url}/templates/{$theme}/assets/images/thumb.png" alt="{$GLOBALS.settings.TEMPLATE_USER_THEME}" />
	</div>
</div>

<div class="theme__lists__title">
	[[Change Theme]]
</div>

<div class="theme__lists">
	{foreach from=$themes item="theme_name" key="theme_system_name"}
		{assign var="counter" value=$counter+1}
		<div class="theme__item {if $theme eq $theme_system_name}current{/if}">
			<span class="theme__item__name">{$theme_name} {if $theme eq $theme_system_name}<strong>- [[Current]]</strong>{/if}</span>
			<div class="theme-img__wrapper">
				<a href="?theme={$theme_system_name}" class="theme__link"></a>
				<img src="{$GLOBALS.user_site_url}/templates/{$theme_system_name}/assets/images/thumb.png" id="pic" />
			</div>
			<div class="theme__center">
				<a href="?theme={$theme_system_name}" class="btn btn--primary">[[Make current]]</a>
			</div>
		</div>
	{/foreach}
</div>