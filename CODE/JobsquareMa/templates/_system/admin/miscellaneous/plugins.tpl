
<div class="page-title">
	<h1 class="title">[[Plugins]]</h1>
</div>

{foreach from=$errors item="error"}
	<p class="error">[[{$error}]]</p>
    {foreachelse}
    {if $saved}
		<p class="message">[[Saved Successfully]]</p>
    {/if}
{/foreach}

{foreach from=$groups item=plugins key=group}
    {foreach from=$plugins item=plugin key=key}
		<form method="post" class="panel panel-default list-widget">
			<input type="hidden" name="action" value="save" />
			<input type="hidden" name="plugin" value="{$key|escape}" />
			<div class="panel-heading">
				<h3 class="panel-title {if $plugin.active == 0 && $plugin.settings == 1}inactive{/if}">
                    {if $plugin.socialMedia}
						<a href="{$GLOBALS.site_url}/social-media/">
							<i class="ion-ios7-locked"></i> <span class="list-widget__caption">[[Social Login]]</span>
						</a>
                    {else}
						<a href="?action=settings&amp;plugin={$plugin.name}">
							<img class="list-widget__img" src="{image}{$plugin.name|lower}-logo.png" border="0" alt="{$plugin.name}"/>
						</a>
                    {/if}
				</h3>
				<div class="list-widget__description">
                    {$plugin.description}
				</div>
			</div>
			<div class="panel-body">
				<div class="row">
                    {if !$plugin.active && $plugin.name == 'FacebookApplicationPlugin' && !$acl->isFeatureAllowed('Facebook app')}
						<div class="alert alert-danger">
							<p>[[Facebook app is not available for your current plan.]]</p>
							<p>[[It allows you to create your own Facebook jobs tab and turn your fans into candidates. <a href="https://www.smartjobboard.com/facebook-application/" target="_blank">Learn more.</a>]]</p>
							<p><a href="{$upgradeUrl}" class="btn btn--primary">[[Upgrade your account now]]</a></p>
						</div>
                    {elseif !$plugin.active && $plugin.name == 'JobG8IntegrationPlugin' && !$acl->isFeatureAllowed('Jobg8')}
						<div class="alert alert-danger">
							<p>[[Jobg8 integration is not available for your current plan.]]</p>
							<p><a href="{$upgradeUrl}" class="btn btn--primary">[[Upgrade your account now]]</a></p>
						</div>
                    {else}
						<div class="col-xs-12 col-sm-12 col-md-6 list-widget__status">
                            {if $plugin.active}
								<span class="label label--active">[[Active]]</span>
                            {else}
								<span class="label label--inactive">[[Not Active]]</span>
                            {/if}
						</div>
						<div class="col-xs-12 col-sm-12 col-md-6 list-widget__tools">
                            {if $plugin.active}
								<input type="hidden" value="0" name="active" />
								<button type="submit" class="btn btn-default">
									<i class="fa fa-eye-slash" aria-hidden="true"></i>
									[[Deactivate]]
								</button>
								<a href="{if $plugin.socialMedia}{$GLOBALS.site_url}/social-media/{else}?action=settings&amp;plugin={$plugin.name}{/if}" class="btn btn--primary">[[Edit]]</a>
                            {else}
								<input type="hidden" value="1" name="active" />
								<button type="submit" class="btn btn-default">
									<i class="fa fa-eye" aria-hidden="true"></i>
									[[Activate]]
								</button>
                            {/if}
						</div>
                    {/if}
				</div>
			</div>
		</form>
    {/foreach}
{/foreach}
