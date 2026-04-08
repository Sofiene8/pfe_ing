<div class="page-title text-center">
	<h1 class="title">[[Job Postings]]</h1>
	<div class="dropdown dropdown--filter">
		<a class="btn btn-dropdown dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
			<i class="fa fa-search" aria-hidden="true"></i>
			[[Filter {$listingsType.id}s]]
			<span class="caret"></span>
		</a>
		<div class="dropdown-menu pro-menu fadeInUp animated" tabindex="5003" style="overflow: hidden; outline: none;">
			<form method="post" name="search_form" class="panel-body">
				<input type="hidden" name="action" value="search" />
				<input type="hidden" name="page" value="1" />

				<div class="form-group col-xs-12">
					<input type="text" placeholder="[[Keywords]]" value="{if $idKeyword}{$idKeyword|escape:'html'}{/if}" name="idKeyword" id="idkeyword">
				</div>
				<div class="form-group col-xs-12">
					{search property="PostingDate" template='list.date.tpl'}
				</div>
				<div class="form-group col-xs-12">
					<input type="text" value="{if $companyName}{$companyName|escape:'html'}{/if}" name="company_name[like]" placeholder="[[Company name or email]]" />
				</div>
				<div class="form-group col-xs-12">
					{search property="product_info_sid" template="list.like.tpl"}
				</div>
				<div class="form-group col-xs-12">
					{search property="active"}
				</div>
				<div class="form-group col-xs-12">
					{search property="featured"} [[Featured]]
				</div>
				<div class="form-group col-xs-12">
					<button type="submit" value="Find" class="btn btn--primary col-xs-12">[[Filter]]</button>
				</div>
			</form>
		</div>
	</div>
	<div class="page-title__buttons">
		<div class="btn-group">
			<a href="{$GLOBALS.site_url}/import-listings/?listing_type_id={$listingsType.id}" class="btn btn--bordered">[[Import]]</a>
			<a href="{$GLOBALS.site_url}/export-listings/?listing_type_id={$listingsType.id}" class="btn btn--bordered">[[Export]]</a>
		</div>
		<a href="{$GLOBALS.site_url}/add-listing/?listing_type_id={$listingsType.id}" class="btn btn--primary">[[Add New {$listingsType.name}]]</a>
	</div>
</div>