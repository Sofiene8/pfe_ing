<div class="page-title text-center">
	<h1 class="title">[[{$userGroupInfo.name} Profiles]]</h1>
	<div class="dropdown dropdown--filter">
		<a class="btn btn-dropdown dropdown-toggle" data-toggle="dropdown" class="" href="#" aria-expanded="false">
			<i class="fa fa-search" aria-hidden="true"></i>
			{if $userGroupInfo.id == 'Employer'}
				[[Filter Employers]]
			{else}
				[[Filter Job Seekers]]
			{/if}
			<span class="caret"></span>
		</a>
		<div class="dropdown-menu pro-menu fadeInUp animated" tabindex="5003" style="overflow: hidden; outline: none;">
			<form method="get" name="search_form" class="panel-body">
				{if $userGroupInfo.id == 'Employer'}
					<div class="col-xs-12 form-group">
						{search property="CompanyName" template="string.like.tpl"}
					</div>
				{/if}
				<div class="col-xs-12 form-group">
					{search property="username" template="string.like.tpl"}
				</div>
				<div class="col-xs-12 form-group">
					<select name="product[simple_equal]">
						<option value="">[[Any Product]]</option>
						{foreach from=$products item=product}
							<option value="{$product.sid}" {if $selectedProduct eq $product.sid}selected="selected"{/if}>[[{$product.name|escape}]]</option>
						{/foreach}
					</select>
				</div>
				<div class="col-xs-12 form-group">
					{search property="active"}
				</div>
				<div class="col-xs-12 form-group">
					<input type="hidden" name="action" value="search" />
					<input type="hidden" name="page" value="1" />
					<input type="submit" value="[[Filter]]" class="btn btn--primary col-xs-12" />
				</div>
			</form>
		</div>
	</div>
	<div class="page-title__buttons">
		<div class="btn-group">
			<a href="{$GLOBALS.site_url}/import-users/?user_group_id={$userGroupInfo.id}" class="btn btn--bordered">[[Import]]</a>
			<a href="{$GLOBALS.site_url}/export-users/?user_group_id={$userGroupInfo.id}" class="btn btn--bordered">[[Export]]</a>
		</div>
		<a href="{$GLOBALS.site_url}/add-user/{$userGroupInfo.id|lower}" class="btn btn--primary">[[Add New {$userGroupInfo.name}]]</a>
	</div>
</div>

