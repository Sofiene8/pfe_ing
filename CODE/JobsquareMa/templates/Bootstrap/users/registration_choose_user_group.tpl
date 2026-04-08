	<h1 class="title__primary title__primary-small title__centered title__bordered">[[Create an account]]</h1>
<div class="form form__modal">

	{include file="errors.tpl"}
<p>[[Choose account type]]:</p>
	{foreach from=$user_groups_info item=user_group_info}
		<p><a href="?user_group_id={$user_group_info.id}">[[$user_group_info.name]]</a></p>
	{/foreach}
</div>