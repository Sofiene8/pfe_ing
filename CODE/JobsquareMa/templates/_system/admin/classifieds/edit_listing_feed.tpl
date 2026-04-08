{breadcrumbs}<a href="{$GLOBALS.site_url}/listing-feeds/">[[RSS/XML Feeds]]</a> / [[Customize {$feed.name} Feed]]{/breadcrumbs}
<div class="page-title">
	<h1 class="title">[[Customize {$feed.name} Feed]]</h1>
</div>
<p>[[Please use filtering criteria below to filter jobs that will appear in your feed.]]</p>

<div class="panel panel-default panel--max">
	<form class="custom-feed__form panel-body form-horizontal">
		<div class="form-group">
			<label class="col-md-2 control-label">[[Keywords]]</label>
			<div class="col-md-7">
				<input type="text" name="keywords" value=""/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">[[Categories]]</label>
			<div class="col-md-7">
				<select name="categories" multiple="multiple">
					{foreach item='item' from=$categories}
						<option value="{$item.id}">{$item.caption|escape}</option>
					{/foreach}
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">[[Job Type]]</label>
			<div class="col-md-7">
				<select name="job_type">
					<option value=""></option>
					{foreach item='item' from=$job_types}
						<option value="{$item.id}">{$item.caption|escape}</option>
					{/foreach}
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">[[Location]]</label>
			<div class="col-md-7">
				<div class="row">
					<div class="col-xs-12 col-sm-6">
						<input type="text" name="location" value=""/>
					</div>
					<div class="col-xs-12 col-sm-6">
						<select name="radius">
							{foreach item='value' from=$radius.values}
								<option value="{$value}" {if $value == $radius.default}selected="selected"{/if}>[[within]] {$value} {$GLOBALS.settings.radius_search_unit}</option>
							{/foreach}
						</select>
					</div>
				</div>
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-2 control-label">[[Featured Jobs]]</label>
			<div class="col-md-7">
				<label class="cr-styled">
					<input type="checkbox" name="featured" value="1"/>
					<i class="fa"></i>
				</label>
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-2 control-label">[[Products]]</label>
			<div class="col-md-7">
				<select name="products" multiple="multiple">
					{foreach item='item' from=$products}
						<option value="{$item.sid}">{$item.name|escape}</option>
					{/foreach}
				</select>
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-2 control-label">[[Exclude Imported Jobs]]</label>
			<div class="col-md-7">
				<label class="cr-styled">
					<input type="checkbox" name="exclude_imported" value="1" {if $feed.id == 'indeed'}disabled checked{/if}/>
					<i class="fa"></i>
				</label>
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-2 control-label">[[Jobs Limit]]</label>
			<div class="col-md-7">
				<select name="limit">
					{foreach item='limit' from=$limits.values}
						<option value="{$limit}" {if $limits.default == $limit}selected="selected"{/if}>{$limit} [[jobs]]</option>
					{/foreach}
				</select>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-7 col-md-offset-2 text-center">
				<div style="background: #F3F5F6; padding: 15px;">
					<h2 style="margin: 0;">[[Custom Feed URL:]]</h2>
					<p class="custom-feed__url" data-url="{$GLOBALS.custom_domain_url}/feeds/{$feed.id}.xml">
						{$GLOBALS.custom_domain_url}/feeds/{$feed.id}.xml
					</p>
					<input type="text" class="custom-feed__text">
					<button type="button" class="custom-feed__copy btn btn--primary">[[Copy Feed URL]]</button>
				</div>
			</div>
		</div>
	</form>
</div>

<script>
	$(document).ready(function() {
		$('.custom-feed__url').click(function() {
			var range = document.createRange();
			range.selectNodeContents(this);
			var sel = window.getSelection();
			sel.removeAllRanges();
			sel.addRange(range);
		});
		$('.custom-feed__copy').click(function() {
			$('.custom-feed__text').val($.trim($('.custom-feed__url').text()));
			$('.custom-feed__text').select();
			document.execCommand('copy');
			$(this).focus();
		});
		$('.custom-feed__form :input').bind('keydown change', function() {
			setTimeout(function() {
				var urlElement = $('.custom-feed__url');
				var formData = $('.custom-feed__form').serializeArray();
				var data = {};
				$.each(formData, function() {
					if (this.name == 'limit' && this.value == '{$limits.default}') {
						return;
					}
					if (this.name == 'radius' && this.value == '{$radius.default}') {
						return;
					}
					if ($.trim(this.value) == '') {
						return;
					}
					if (!data[this.name]) {
						data[this.name] = this.value;
					} else {
						data[this.name] += ',' + this.value;
					}
				});
				var url = urlElement.data('url') + '?' + $.param(data);
				url = url.replace(/%2C/g, ',');
				urlElement.text(url);
			}, 0);
		});

		var options = {
			selectedList: 3,
			selectedText: "# {tr}selected{/tr|escape:'html'}",
			noneSelectedText: "{tr}Click to select{/tr|escape:'html'}",
			checkAllText: "{tr}Select all{/tr|escape:'html'}",
			uncheckAllText: "{tr}Deselect all{/tr|escape:'html'}",
			header: true,
			height: 'auto',
			minWidth: 209
		};
		$('select[name="categories"]').getCustomMultiList(options, 'categories');
		$('select[name="products"]').getCustomMultiList(options, 'products');
	});
</script>