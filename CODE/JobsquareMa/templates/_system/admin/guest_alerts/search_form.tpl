<div class="page-title text-center">
	<h1 class="title">[[Job Alerts]]</h1>
	<div class="dropdown dropdown--filter">
		<a class="btn btn-dropdown dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
			<i class="fa fa-search" aria-hidden="true"></i>
			[[Filter Job Alerts]]
			<span class="caret"></span>
		</a>
		<div class="dropdown-menu pro-menu fadeInUp animated" tabindex="5003" style="overflow: hidden; outline: none;">
			<form method="get" name="search_form" class="panel-body">
				<div class="col-xs-12 form-group">{search property="email" template="string.like.tpl"}</div>
				<div class="col-xs-12 form-group">{search property="email_frequency"}</div>
				<div class="col-xs-12 form-group">{search property="signed_up"}</div>
				<div class="col-xs-12 form-group">{search property="status"}</div>
				<div class="col-xs-12 form-group">
					<input type="hidden" name="action" value="search" />
					<input type="hidden" name="page" value="1" />
					<input type="submit" value="[[Search]]" class="btn btn--primary col-xs-12" />
				</div>
			</form>
		</div>
	</div>
	<div class="page-title__buttons">
		<form method="post" action="{$GLOBALS.site_url}/guest-alerts/export/">
			<input type="hidden" name="sorting_field" value="{$paginationInfo.sortingField}"/>
			<input type="hidden" name="sorting_order" value="{$paginationInfo.sortingOrder}"/>
			<input type="submit" name="export" value="[[Export Job Alerts]]" class="btn btn--primary" /> &nbsp;
			<select name="type" class="job-alert__type-select">
				<option value="csv">CSV</option>
				<option value="xls">XLS</option>
			</select>
		</form>
	</div>
</div>
