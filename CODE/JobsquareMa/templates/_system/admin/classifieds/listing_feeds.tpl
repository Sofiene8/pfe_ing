<div class="page-title">
	<h1 class="title">[[RSS/XML Feeds]]</h1>
</div>
<p>[[XML/RSS feeds allow you to broadcast job postings from your job board to other websites (e.g. Indeed, Trovit and etc.)]]</p>
{include file="field_errors.tpl"}
{foreach from=$errors item=error}
	<p class="error">[[{$error.message}]]</p>
{/foreach}

{foreach from=$feeds item=feed}
	<div class="panel panel-default list-widget">
		<div class="panel-heading">
			<h3 class="panel-title">
				<a href="{$GLOBALS.site_url}/listing-feeds/?action=edit&amp;id={$feed.sid}">
					{if $feed.id == 'rss'}
						<i class="fa fa-rss" aria-hidden="true"></i>
						<span class="list-widget__caption">- [[{$feed.name}]]</span>
					{else}
						<img class="list-widget__img" src="{image}{$feed.id}-logo.png" alt="{$feed.id}" />
					{/if}
				</a>
			</h3>

			<div class="list-widget__description">
				<div class="alert alert-info">
					<a href="{$GLOBALS.custom_domain_url}/feeds/{$feed.id}.xml" target="_blank" title="[[Link to this XML feed]]">{$GLOBALS.custom_domain_url}/feeds/{$feed.id}.xml</a>
				</div>
				{if $feed.description}
					[[{$feed.description}]]
				{/if}
			</div>
		</div>
		<div class="panel-body">
			<div class="list-widget__tools">
				<a href="{$GLOBALS.site_url}/listing-feeds/?action=edit&amp;id={$feed.sid}" class="btn btn--primary">[[Customize Feed]]</a>
			</div>
		</div>
	</div>
{/foreach}

<div class="panel panel-default list-widget">
	<div class="panel-heading">
		<h3 class="panel-title">
			<span class="list-widget__caption">[[Sitemap]]</span>
		</h3>

		<div class="list-widget__description">
			<div class="alert alert-info">
				<a href="{$GLOBALS.custom_domain_url}/sitemap.xml" target="_blank" title="[[Link to this XML feed]]">{$GLOBALS.custom_domain_url}/sitemap.xml</a>
			</div>
			[[You'll need to submit your sitemap to Google search console at]]
			<a href="https://www.google.com/webmasters/tools/" target="_blank">
				[[https://www.google.com/webmasters/tools/.]]
			</a>
		</div>
	</div>
</div>

<div class="panel panel-default list-widget">
	<div class="panel-heading">
		<h3 class="panel-title">
			<span class="list-widget__caption">[[Blog Posts RSS]]</span>
		</h3>

		<div class="list-widget__description">
			<div class="alert alert-info">
				<a href="{$GLOBALS.custom_domain_url}/blog/rss/" target="_blank" title="[[Link to this XML feed]]">{$GLOBALS.custom_domain_url}/blog/rss/</a>
			</div>
			[[Your 10 latest blog posts in RSS format.]]
		</div>
	</div>
</div>