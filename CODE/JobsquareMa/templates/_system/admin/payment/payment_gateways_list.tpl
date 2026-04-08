<div class="page-title">
	<h1 class="title">[[Payment Methods]]</h1>
</div>
{if $gatewaySaved}<p class="message">[[Your changes were successfully saved]]</p>{/if}
{foreach from=$gateways item=gateway}
	<div class="panel panel-default panel--gateways list-widget">
		<div class="panel-heading">
			<h3 class="panel-title {if !$gateway.active}inactive{/if}">
				{if $gateway.id == 'invoice'}
					<a href="{$GLOBALS.site_url}/configure-gateway/?gateway={$gateway.id}" title="set up gateway"> {$gateway.name} </a>
				{elseif $gateway.id == 'paypal_pro' || $gateway.id == 'paypal_standard' || $gateway.id == 'paypal_express'}
					<a href="{$GLOBALS.site_url}/configure-gateway/?gateway={$gateway.id}" title="set up gateway">
						<img class="list-widget__img" src="{image}paypal-logo.png" border="0" alt="{$gateway.name}"/>
						<span class="list-widget__caption"> - {$gateway.name}</span>
					</a>
				{else}
					<a href="{$GLOBALS.site_url}/configure-gateway/?gateway={$gateway.id}">
						<img class="list-widget__img" src="{image}{$gateway.id}-logo.png" border="0" alt="{$gateway.name}"/>
					</a>
				{/if}
			</h3>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-6 list-widget__status">
					{if $gateway.active == 1}
						<span class="label label--active">[[Active]]</span>
					{else}
						<span class="label label--inactive">[[Not Active]]</span>
					{/if}
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 list-widget__tools">
					{if $gateway.active}
						<a href="?action=deactivate&gateway={$gateway.id}" class="btn btn-default">
							<i class="fa fa-eye-slash" aria-hidden="true"></i>
							[[Deactivate]]
						</a>
						<a class="btn btn--primary" href="{$GLOBALS.site_url}/configure-gateway/?gateway={$gateway.id}" title="set up gateway">[[Edit]]</a>
					{else}
						<a href="{$GLOBALS.site_url}/configure-gateway/?gateway={$gateway.id}&action=activate&gateway={$gateway.id}" class="btn btn-default">
							<i class="fa fa-eye" aria-hidden="true"></i>
							[[Activate]]
						</a>
					{/if}
				</div>
			</div>
		</div>
	</div>
{/foreach}