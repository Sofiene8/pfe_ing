{if $navCount == "0"}{else}
<div class="details-breadcrumbs">
	<p>{foreach from=$navArray item=navItem name=navForeach} {if $smarty.foreach.navForeach.iteration<$navCount }<a href="{$GLOBALS.site_url}{$navItem.uri}" alt="[[{$navItem.name}]]" title="[[{$navItem.name}]]">[[{$navItem.name}]]</a> &#187; {else} <span>[[{$navItem.name}]]</span> {/if} {/foreach} </p>
</div>
{/if}
