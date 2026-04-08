{breadcrumbs}
	<a href="{$GLOBALS.site_url}/show-import/">[[Job Auto Import]]</a> / [[Create New Source]]
	{if $id > 0} / [[Add new Data Source - step one]]{/if}
{/breadcrumbs}
<div class="page-title">
	<h1 class="title">[[Create New Source]]</h1>
</div>

<script type="text/javascript">
	$(function() {
		$(".help_div").click( function() {
			$(".help_inner").slideToggle("slow");
			});
	});
</script>


{if $errors}
	{foreach from=$errors item=error}
		<p class="error">[[{$error}]]</p>
	{/foreach}
{/if}

<div class="panel panel-default panel--accordion panel--wide">
	<div class="panel-heading">
		<h4 class="panel-title">
			<a data-toggle="collapse" href="#collapse" aria-expanded="false" class="collapsed">
				[[Please paste XML code of one posting item from the source to be imported. For example]]
			</a>
		</h4>
	</div>
	<div id="collapse" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
		<div class="panel-body">
<pre>
	&lt;jobs&gt;
		...
		<span style="color: #000">
		&lt;job&gt;
			&lt;jobtitle&gt;Director Application Development&lt;/jobtitle&gt;
			&lt;company&gt;The ExMScGraw-Hill Companies&lt;/company&gt;
			&lt;city&gt;New York&lt;/city&gt;
			&lt;state&gt;NY&lt;/state&gt;
			&lt;country&gt;US&lt;/country&gt;
			&lt;source&gt;The ExMScGraw-Hill Companies&lt;/source&gt;
			&lt;date&gt;Fri, 27 Mar 2009 03:36:37 GMT&lt;/date&gt;
			&lt;url&gt;https://www.somesite.com/viewjobs?j=9320f73ca0f9fc53&lt;/url&gt;
			&lt;latitude&gt;40.704235&lt;/latitude&gt;
			&lt;longitude&gt;-73.91793&lt;/longitude&gt;
			&lt;jobkey&gt;9320f73ca0f9fc53&lt;/jobkey&gt;
		&lt;/job&gt;
		</span>
		...
	&lt;/jobs&gt;
</pre>
		</div>
	</div>
</div>
<div class="panel panel-default panel--accordion panel--accordion panel--wide">
	<form method="post" action="{$GLOBALS.site_url}/add-import/" class="panel-body form-horizontal">
		<input type="hidden" name="add_level" value="2">
		<div class="form-group">
			<label class="control-label col-md-2">[[XML code]]</label>
			<div class="col-md-7"><textarea rows="20" cols="79" name="xml">{$xml}</textarea></div>
		</div>
		<div class="form-group">
			<div class="col-md-7 col-md-offset-2">
				<input type="submit" value="[[Next]]" class="btn btn--primary" />
			</div>
		</div>
	</form>
</div>