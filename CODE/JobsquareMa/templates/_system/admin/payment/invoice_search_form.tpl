<div class="page-title text-center">
	<h1 class="title">[[Orders]]</h1>
	<div class="dropdown dropdown--filter">
		<a class="btn btn-dropdown dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
			<i class="fa fa-search" aria-hidden="true"></i>
			[[Click to modify search criteria]]
			<span class="caret"></span>
		</a>
		<div class="dropdown-menu pro-menu fadeInUp animated" tabindex="5003" style="overflow: hidden; outline: none;">
			<form method="get" name="search_form" class="panel-body">
				<div class="form-group col-xs-12">
					<div class="input-group">
						<span class="input-group-addon" style="width: 80px;">[[From]]</span>
						{search property="date" template="date.from.tpl"}
					</div>
				</div>
				<div class="form-group col-xs-12">
					<div class="input-group">
						<span class="input-group-addon" style="width: 80px;">[[To]]</span>
						{search property="date" template="date.to.tpl"}
					</div>
				</div>
				<div class="form-group col-xs-12">
					{search property="username" template="string.like.tpl"}
				</div>
				<div class="form-group col-xs-12">
					{search property="sid"}
				</div>
				<div class="form-group col-xs-12">
					{search property="payment_method"}
				</div>
				<div class="form-group col-xs-12">
					{search property="status"}
				</div>
				<div class="form-group col-xs-12">
					<input type="hidden" name="action" value="search" />
					<input type="hidden" name="page" value="1" />
					<input type="submit" value="[[Search]]" class="btn btn--primary col-xs-12" />
				</div>
			</form>
		</div>
	</div>
</div>

