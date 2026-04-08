<div class="page-title text-center">
	<h1 class="title">[[{$listingsType.name}s]]</h1>
	<div class="dropdown dropdown--filter">
		<a class="btn btn-dropdown dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
			<i class="fa fa-search" aria-hidden="true"></i>
			[[Filter Resumes]]
			<span class="caret"></span>
		</a>
		<div class="dropdown-menu pro-menu fadeInUp animated" tabindex="5003" style="overflow: hidden; outline: none;">
			<form method="post" name="search_form" class="panel-body">
				<input type="hidden" name="action" value="search" />
				<input type="hidden" name="page" value="1" />
				<div class="col-xs-12 form-group">
					<input type="text" placeholder="[[Keywords]]" value="{if $idKeyword}{$idKeyword|escape:'html'}{/if}" name="idKeyword" id="idkeyword">
				</div>
				<div class="col-xs-12 form-group">
					<input type="text" value="{if $companyName}{$companyName|escape:'html'}{/if}" name="company_name[like]" placeholder="[[Job Seeker Email]]"/>
				</div>
				<div class="col-xs-12 form-group">
					{search property="PostingDate" template='list.date.tpl'}
				</div>
				<div class="col-xs-12 form-group">
					{search property="active"}
				</div>
				<div class="col-xs-12 form-group">
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
		<a href="{$GLOBALS.site_url}/add-listing/?listing_type_id={$listingsType.id|lower}" class="btn btn--primary">[[Add New {$listingsType.name}]]</a>
	</div>
</div>