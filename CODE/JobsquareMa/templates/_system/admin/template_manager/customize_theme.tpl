<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.0/spectrum.min.css">
<link rel="stylesheet" href="{$GLOBALS.user_site_url}/system/ext/CodeMirror/lib/codemirror.css">
{javascript}
	<script src="{$GLOBALS.user_site_url}/system/ext/CodeMirror/lib/codemirror.js"></script>
	<script src="{$GLOBALS.user_site_url}/system/ext/CodeMirror/lib/util/match-highlighter.js"></script>
	<script src="{$GLOBALS.user_site_url}/system/ext/CodeMirror/mode/css/css.js"></script>
	<script src="{$GLOBALS.user_site_url}/system/ext/CodeMirror/mode/javascript/javascript.js"></script>
	<script src="{$GLOBALS.user_site_url}/system/ext/CodeMirror/lib/util/search.js"></script>
	<script src="{$GLOBALS.user_site_url}/system/ext/CodeMirror/lib/util/searchcursor.js"></script>
	<script src="{$GLOBALS.user_site_url}/system/ext/CodeMirror/lib/util/dialog.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.0/spectrum.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			var cmOptions = {
				lineNumbers: true,
				matchBrackets: true,
				mode: "css",
				indentUnit: 5,
				indentWithTabs: true,
				enterMode: "keep",
				tabMode: "shift",
				theme: "default"
			};
			CodeMirror.fromTextArea(document.getElementById("custom_css"), cmOptions);

			cmOptions.mode = 'javascript';
			CodeMirror.fromTextArea(document.getElementById("custom_js"), cmOptions);

			cmOptions.mode = 'htmlmixed';
			$('.theme-banner textarea').each(function() {
				var editor = CodeMirror.fromTextArea(this, cmOptions);
				setTimeout(function() {
					editor.refresh();  //когда таба на banners add, кодмиррор не так как нужно инициализируется
				}, 1)
			});

			$('.spectrum').each(function() {
				$(this).spectrum({
					preferredFormat: "hex",
					showPalette: true,
					showInput: true,
					palette: [
						["#000","#444","#666","#999","#ccc","#eee","#f3f3f3","#fff"],
						["#f00","#f90","#ff0","#0f0","#0ff","#00f","#90f","#f0f"],
						["#f4cccc","#fce5cd","#fff2cc","#d9ead3","#d0e0e3","#cfe2f3","#d9d2e9","#ead1dc"],
						["#ea9999","#f9cb9c","#ffe599","#b6d7a8","#a2c4c9","#9fc5e8","#b4a7d6","#d5a6bd"],
						["#e06666","#f6b26b","#ffd966","#93c47d","#76a5af","#6fa8dc","#8e7cc3","#c27ba0"],
						["#c00","#e69138","#f1c232","#6aa84f","#45818e","#3d85c6","#674ea7","#a64d79"],
						["#900","#b45f06","#bf9000","#38761d","#134f5c","#0b5394","#351c75","#741b47"],
						["#600","#783f04","#7f6000","#274e13","#0c343d","#073763","#20124d","#4c1130"]
					]
				});
			});

			$(document).on('change', '.theme-banner__label input', function() {
				var self = $(this);
				self.closest('.theme-banner').find('.theme-banner__contents').hide();
				if (self.val() == 'code') {
					var banner = self.closest('.theme-banner');
					banner.find('.theme-banner__contents-code').show();
					banner.find('.CodeMirror').get(0).CodeMirror.refresh();
				} else {
					self.closest('.theme-banner').find('.theme-banner__contents-image').show();
				}
			});

			$('.theme-banner__contents .btn--danger').click(function() {
				var parent = $(this).closest('.theme-banner');
				parent.find('img').remove();
				parent.find('input[value="code"]').click().change();
				parent.find('input[type="text"]').val('');
			});

			var tab = '{$tab}';

			if (tab) {
				$('.nav-tabs').find('li.active a').attr('aria-expanded', 'false');
				$('.nav-tabs').find('li.active').removeClass('active');
				$('.nav-tabs a[href="' + tab + '"]').attr('aria-expanded', 'true');
				$('.nav-tabs a[href="' + tab + '"]').closest('li').addClass('active');
				$('.tab-content .tab-pane.active').removeClass('active');
				$('.tab-content ' + tab).addClass('active');
			}

			$(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function () {
				$('input[name="tab"]').val($(this).attr('href'));

				if ($(this).attr('href') == '#bannersTab') {
					$('#bannersTab .CodeMirror').each(function(i, el){
						el.CodeMirror.refresh(); //без резайся, комиррор не так как нужно инициализируется
					});
				}
			})
		});
	</script>
{/javascript}
<div class="page-title">
	<h1 class="title">[[Customize Theme]]</h1>
</div>
<form method="post" action="" enctype="multipart/form-data" class="customize-form">
	<input type="hidden" name="action" value="save" />
	<input type="hidden" name="tab" value="{$tab}" />
	{foreach from=$errors item=error}
		<p class="error">
			[[{$error}]]
		</p>
	{/foreach}
	<div id="customize-theme-pane">
		<ul class="nav nav-tabs">
			<li class="active">
				<a href="#generalTab" data-toggle="tab" aria-expanded="true">[[General Settings]]</a>
			</li>
			<li>
				<a href="#homeTab" data-toggle="tab" aria-expanded="false">
					[[Home Page]]
				</a>
			</li>
			<li>
				<a href="#bannersTab" data-toggle="tab" aria-expanded="false">[[Banners Ads]]</a>
			</li>
		</ul>
		<div class="tab-content">
			<div id="generalTab" class="tab-pane active">
				<div class="form-horizontal">
					{if isset($theme_settings.logo)}
						<div class="form-group">
							<label class="col-md-2 control-label" >[[Logo]]</label>
							<div class="col-md-7">
								<div class="input-group input-group__file">
									<input type="text" value="{$theme_settings.logo|escape:'url'}" alt="" />
									<input type="file" name="logo" class=""/>
									<span class="input-group-btn">
										<a href="#" class="btn btn-default btn-change"><i class="fa fa-exchange" aria-hidden="true"></i>[[Change]]</a>
									</span>
								</div>
								<img src="{$GLOBALS.user_site_url}/templates/{$settings.TEMPLATE_USER_THEME}/assets/images/{$theme_settings.logo|escape:'url'}?v={$smarty.now}" />
							</div>
						</div>
					{/if}
					{if isset($theme_settings.favicon)}
						<div class="form-group">
							<label class="col-md-2 control-label" >[[Favicon]]</label>
							<div class="col-md-7">
								<div class="input-group input-group__file">
									<input type="text" value="{$theme_settings.favicon|escape:'url'}" alt="" />
									<input type="file" name="favicon" />
									<span class="input-group-btn">
										<a href="#" class="btn btn-default btn-change"><i class="fa fa-exchange" aria-hidden="true"></i>[[Change]]</a>
									</span>
								</div>
								<img src="{$GLOBALS.user_site_url}/templates/{$settings.TEMPLATE_USER_THEME}/assets/images/{$theme_settings.favicon|escape:'url'}?v={$smarty.now}" />
							</div>
						</div>
					{/if}
					{if isset($theme_settings.button_color_1) || isset($theme_settings.button_color_2) || isset($theme_settings.button_color_3)}
						<div class="form-group">
							<label class="col-md-2 control-label" >[[Colors]]</label>
							<div class="col-md-7">
								{if isset($theme_settings.button_color_1)}
									<div class="inline-block">
										<input class="spectrum" type="text" name="button_color_1" value="{$theme_settings.button_color_1}" />
										&nbsp;[[Main Color]]
									</div>
								{/if}
								{if isset($theme_settings.button_color_2)}
									<div class="inline-block">
										<input class="spectrum" type="text" name="button_color_2" value="{$theme_settings.button_color_2}" />
										&nbsp;[[Accent Color 1]]
									</div>
								{/if}
								{if isset($theme_settings.button_color_3)}
									<div class="inline-block">
										<input class="spectrum" type="text" name="button_color_3" value="{$theme_settings.button_color_3}" />
										&nbsp;[[Accent Color 2]]
									</div>
								{/if}
							</div>
						</div>
					{/if}
					{if isset($theme_settings.font)}
						<div class="form-group">
							<label class="col-md-2 control-label" >[[Font]]</label>
							<div class="col-md-7">
								<select name="font">
									{foreach from=$fonts item=font key=fontId}
										<option value="{$fontId|escape}" {if $fontId == $theme_settings.font}selected="selected"{/if}>{$font.caption}</option>
									{/foreach}
								</select>
							</div>
						</div>
					{/if}
					{if isset($theme_settings.font2)}
						<div class="form-group">
							<label class="col-md-2 control-label">[[Header Font]]</label>
							<div class="col-md-7">
								<select name="font2">
									{foreach from=$fonts item=font key=fontId}
										<option value="{$fontId|escape}" {if $fontId == $theme_settings.font2}selected="selected"{/if}>{$font.caption}</option>
									{/foreach}
								</select>
							</div>
						</div>
					{/if}
					{if isset($theme_settings.footer)}
						<div class="form-group">
							<label class="col-md-2 control-label" >[[Footer]]</label>
							<div class="col-md-7">
								{WYSIWYGEditor name='footer' class='inputText' width="100%" height="150" type='tinymce' value=$theme_settings.footer conf="Admin"}
							</div>
						</div>
					{/if}
					{if isset($theme_settings.custom_css)}
						<div class="form-group">
							<label class="col-md-2 control-label" >[[Custom CSS]]</label>
							<div class="col-md-7">
								<textarea id="custom_css" name="custom_css">{$theme_settings.custom_css|escape}</textarea>
							</div>
						</div>
					{/if}
					{if isset($theme_settings.custom_js)}
						<div class="form-group">
							<label class="col-md-2 control-label" >[[Custom JS]]</label>
							<div class="col-md-7">
								<textarea id="custom_js" name="custom_js">{$theme_settings.custom_js|escape}</textarea>
							</div>
						</div>
					{/if}
				</div>
			</div>
			<div id="homeTab" class="tab-pane">
				<div class="form-horizontal">
					{if isset($theme_settings.main_banner)}
						<div class="form-group">
							<label class="col-md-2 control-label" >[[Main Banner]]</label>
							<div class="col-md-7">
								{if $settings.TEMPLATE_USER_THEME == "Bootstrap"}
									<span class="banner-tooltip" data-toggle="tooltip" data-placement="auto left" title="[[Recommended size 1350x380 px]]"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
								{elseif $settings.TEMPLATE_USER_THEME == "Flow"}
									<span class="banner-tooltip" data-toggle="tooltip" data-placement="auto left" title="[[Recommended size 1350x550 px]]"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
								{/if}
								<div class="input-group input-group__file">
									<input type="text" value="{$theme_settings.main_banner|escape:'url'}" alt="" />
									<input type="file" name="main_banner" />
									<span class="input-group-btn">
										<a href="#" class="btn btn-default btn-change"><i class="fa fa-exchange" aria-hidden="true"></i>[[Change]]</a>
									</span>
								</div>
								<img class="customize-banner-img" src="{$GLOBALS.user_site_url}/templates/{$settings.TEMPLATE_USER_THEME}/assets/images/{$theme_settings.main_banner|escape:'url'}?v={$smarty.now}" />
							</div>
						</div>
					{/if}
					{if isset($theme_settings.main_banner_text)}
						<div class="form-group">
							<label class="col-md-2 control-label">[[Main Banner Text]]</label>
							<div class="col-md-7">
								{WYSIWYGEditor name='main_banner_text' class='inputText' width="100%" height="150" type='tinymce' value=$theme_settings.main_banner_text conf="Admin"}
							</div>
						</div>
					{/if}
					{if isset($theme_settings.secondary_banner)}
						<div class="form-group">
							<label class="col-md-2 control-label">[[Secondary Banner]]</label>
							<div class="col-md-7">
								{if $settings.TEMPLATE_USER_THEME == "Bootstrap"}
									<span class="banner-tooltip" data-toggle="tooltip" data-placement="auto left" title="[[Recommended size 1350x390 px]]"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
								{elseif $settings.TEMPLATE_USER_THEME == "Flow"}
									<span class="banner-tooltip" data-toggle="tooltip" data-placement="auto left" title="[[Recommended size 1350x505 px]]"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
								{/if}
								<div class="input-group input-group__file">
									<input type="text" value="{$theme_settings.secondary_banner|escape:'url'}" alt="" />
									<input type="file" name="secondary_banner" />
									<span class="input-group-btn">
										<a href="#" class="btn btn-default btn-change"><i class="fa fa-exchange" aria-hidden="true"></i>[[Change]]</a>
									</span>
								</div>
								<img class="customize-banner-img" src="{$GLOBALS.user_site_url}/templates/{$settings.TEMPLATE_USER_THEME}/assets/images/{$theme_settings.secondary_banner|escape:'url'}?v={$smarty.now}" />
							</div>
						</div>
					{/if}
					{if isset($theme_settings.secondary_banner_text)}
						<div class="form-group">
							<label class="col-md-2 control-label" >[[Secondary Banner Text]]</label>
							<div class="col-md-7">
								{WYSIWYGEditor name='secondary_banner_text' class='inputText' width="100%" height="150" type='tinymce' value=$theme_settings.secondary_banner_text conf="Admin"}
							</div>
						</div>
					{/if}
					{if isset($theme_settings.bottom_section_html)}
						<div class="form-group">
							<label class="col-md-2 control-label" >[[Bottom Section HTML]]</label>
							<div class="col-md-7">
								{WYSIWYGEditor name='bottom_section_html' class='inputText' width="100%" height="150" type='tinymce' value=$theme_settings.bottom_section_html conf="Admin"}
							</div>
						</div>
					{/if}
					{if isset($theme_settings.jobs_by_category)}
						<div class="form-group">
							<label class="col-md-2 control-label" >[[Display Jobs by]]</label>
							<div class="col-md-7">
								<div class="inline-block">
									<input type="hidden" name="jobs_by_category" value="0">
									<label class="cr-styled">
										<input type="checkbox" name="jobs_by_category" value="1" {if $theme_settings.jobs_by_category}checked="checked"{/if} >
										<i class="fa"></i>
										[[Category]]
									</label>
								</div>
								<div class="inline-block">
									<input type="hidden" name="jobs_by_city" value="0">
									<label class="cr-styled">
										<input type="checkbox" name="jobs_by_city" value="1" {if $theme_settings.jobs_by_city}checked="checked"{/if} >
										<i class="fa"></i>
										[[City]]
									</label>
								</div>
								<div class="inline-block">
									<input type="hidden" name="jobs_by_state" value="0">
									<label class="cr-styled">
										<input type="checkbox" name="jobs_by_state" value="1" {if $theme_settings.jobs_by_state}checked="checked"{/if} >
										<i class="fa"></i>
										[[State]]
									</label>
								</div>
								<div class="inline-block">
									<input type="hidden" name="jobs_by_country" value="0">
									<label class="cr-styled">
										<input type="checkbox" name="jobs_by_country" value="1" {if $theme_settings.jobs_by_country}checked="checked"{/if} >
										<i class="fa"></i>
										[[Country]]
									</label>
								</div>
							</div>
						</div>
					{/if}
				</div>
			</div>
			<div id="bannersTab" class="tab-pane">
				<div class="form-horizontal">
					<div class="form-group">
						<label class="col-md-2 control-label" >[[Top Banner]]</label>
						<div class="col-md-7 theme-banner">
							<span data-toggle="tooltip" data-placement="auto left" title="[[Appears at the top of all pages. Suggested size: 728x90]]"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
							<label class="theme-banner__label">
								<label class="cr-styled cr-styled__radio">
									<input type="radio" name="banner_top_type" {if $theme_settings.banner_top_type != 'img'}checked{/if} value="code">
									<i class="fa"></i>
									[[Html code]]
								</label>
							</label>
							<label class="theme-banner__label">
								<label class="cr-styled cr-styled__radio">
									<input type="radio" name="banner_top_type" {if $theme_settings.banner_top_type == 'img'}checked{/if} value="img">
									<i class="fa"></i>
									[[Image]]
								</label>
							</label>
							<div class="theme-banner__contents theme-banner__contents-code" style="{if $settings.banner_top_type == 'img'}display: none;{/if}">
								<textarea id="banner_top_code" name="banner_top_code">{$theme_settings.banner_top_code|escape}</textarea>
							</div>
							<div class="theme-banner__contents theme-banner__contents-image" style="{if $theme_settings.banner_top_type != 'img'}display: none;{/if}">
								<div class="input-group input-group__file">
									<input type="text" value="{$theme_settings.banner_top_img|escape}" alt="" />
									<input type="file" name="banner_top_img"/>
									<span class="input-group-btn">
										{if $theme_settings.banner_top_img}
											<a href="#" class="btn btn-default btn-change btn-change__replace"><i class="fa fa-exchange" aria-hidden="true"></i>[[Change]]</a>
											<a href="#" class="btn btn-default btn-change btn-change__upload hidden"><i class="fa fa-upload" aria-hidden="true"></i>[[Upload]]</a>
											<a href="#" class="btn btn--danger"><i class="fa fa-trash-o" aria-hidden="true"></i>[[Remove]]</a>
										{else}
											<a href="#" class="btn btn-default btn-change"><i class="fa fa-upload" aria-hidden="true"></i>[[Upload]]</a>
										{/if}
									</span>
								</div>
								{if $theme_settings.banner_top_img}
									<img class="theme-banner__preview-image" src="{$GLOBALS.user_site_url}/files/banners/{$theme_settings.banner_top_img|escape}"/>
								{/if}
								<div class="banner-link">
									<span class="help-block">
                                   		<small>[[Banner Link]]</small>
							 		</span>
									<input type="text" name="banner_top_link" value="{$theme_settings.banner_top_link|escape}" />
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">
							[[Bottom Banners]]
						</label>
						<div class="theme-banner col-md-7">
							<span data-toggle="tooltip" data-placement="auto left" title="[[Appears at the bottom of all pages. Suggested size: 728x90]]"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
							<label class="theme-banner__label">
								<label class="cr-styled cr-styled__radio">
									<input type="radio" name="banner_bottom_type" {if $theme_settings.banner_bottom_type != 'img'}checked{/if} value="code">
									<i class="fa"></i>
									[[Html code]]
								</label>
							</label>
							<label class="theme-banner__label">
								<label class="cr-styled cr-styled__radio">
									<input type="radio" name="banner_bottom_type" {if $theme_settings.banner_bottom_type == 'img'}checked{/if} value="img">
									<i class="fa"></i>
									[[Image]]
								</label>
							</label>
							<div class="theme-banner__contents theme-banner__contents-code" style="{if $theme_settings.banner_bottom_type == 'img'}display: none;{/if}">
								<textarea id="banner_bottom_code" name="banner_bottom_code">{$theme_settings.banner_bottom_code|escape}</textarea>
							</div>
							<div class="theme-banner__contents theme-banner__contents-image" style="{if $theme_settings.banner_bottom_type != 'img'}display: none;{/if}">
								<div class="input-group input-group__file">
									<input type="text" value="{$theme_settings.banner_bottom_img|escape}" alt="" />
									<input type="file" name="banner_bottom_img"/>
									<span class="input-group-btn">
										{if $theme_settings.banner_bottom_img}
											<a href="#" class="btn btn-default btn-change btn-change__replace"><i class="fa fa-exchange" aria-hidden="true"></i>[[Change]]</a>
											<a href="#" class="btn btn-default btn-change btn-change__upload hidden"><i class="fa fa-upload" aria-hidden="true"></i>[[Upload]]</a>
											<a href="#" class="btn btn--danger"><i class="fa fa-trash-o" aria-hidden="true"></i>[[Remove]]</a>
										{else}
											<a href="#" class="btn btn-default btn-change"><i class="fa fa-upload" aria-hidden="true"></i>[[Upload]]</a>
										{/if}
									</span>
								</div>
								{if $theme_settings.banner_bottom_img}
									<img class="theme-banner__preview-image" src="{$GLOBALS.user_site_url}/files/banners/{$theme_settings.banner_bottom_img|escape}"/>
								{/if}
								<div class="banner-link">
									<span class="help-block">
                                   		<small>[[Banner Link]]</small>
							 		</span>
									<input type="text" name="banner_bottom_link" value="{$theme_settings.banner_bottom_link|escape}" />
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">
							[[Right Side Banner]]
						</label>
						<div class="theme-banner col-md-7">
							<span data-toggle="tooltip" data-placement="auto left" title="[[Appears at the right side of all pages. Suggested size: 120x600]]"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
							<label class="theme-banner__label">
								<label class="cr-styled cr-styled__radio">
									<input type="radio" name="banner_right_side_type" {if $theme_settings.banner_right_side_type != 'img'}checked{/if} value="code">
									<i class="fa"></i>
									[[Html code]]
								</label>
							</label>
							<label class="theme-banner__label">
								<label class="cr-styled cr-styled__radio">
									<input type="radio" name="banner_right_side_type" {if $theme_settings.banner_right_side_type == 'img'}checked{/if} value="img">
									<i class="fa"></i>
									[[Image]]
								</label>
							</label>
							<div class="theme-banner__contents theme-banner__contents-code" style="{if $theme_settings.banner_right_side_type == 'img'}display: none;{/if}">
								<textarea id="banner_right_side_code" name="banner_right_side_code">{$theme_settings.banner_right_side_code|escape}</textarea>
							</div>
							<div class="theme-banner__contents theme-banner__contents-image" style="{if $theme_settings.banner_right_side_type != 'img'}display: none;{/if}">
								<div class="input-group input-group__file">
									<input type="text" value="{$theme_settings.banner_right_side_img|escape}" alt="" />
									<input type="file" name="banner_right_side_img"/>
									<span class="input-group-btn">
										{if $theme_settings.banner_right_side_img}
											<a href="#" class="btn btn-default btn-change btn-change__replace"><i class="fa fa-exchange" aria-hidden="true"></i>[[Change]]</a>
											<a href="#" class="btn btn-default btn-change btn-change__upload hidden"><i class="fa fa-upload" aria-hidden="true"></i>[[Upload]]</a>
											<a href="#" class="btn btn--danger"><i class="fa fa-trash-o" aria-hidden="true"></i>[[Remove]]</a>
										{else}
											<a href="#" class="btn btn-default btn-change"><i class="fa fa-upload" aria-hidden="true"></i>[[Upload]]</a>
										{/if}
									</span>
								</div>
								{if $theme_settings.banner_right_side_img}
									<img class="theme-banner__preview-image" src="{$GLOBALS.user_site_url}/files/banners/{$theme_settings.banner_right_side_img|escape}"/>
								{/if}
								<div class="banner-link">
									<span class="help-block">
                                   		<small>[[Banner Link]]</small>
							 		</span>
									<input type="text" name="banner_right_side_link" value="{$theme_settings.banner_right_side_link|escape}" />
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">
							[[Inline Banner]]
						</label>
						<div class="theme-banner col-md-7">
							<span data-toggle="tooltip" data-placement="auto left" title="[[Appears inside job and resume search results. Suggested size: 600x250]]"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
							<label class="theme-banner__label">
								<label class="cr-styled cr-styled__radio">
									<input type="radio" name="banner_inline_type" {if $theme_settings.banner_inline_type != 'img'}checked{/if} value="code">
									<i class="fa"></i>
									[[Html code]]
								</label>
							</label>
							<label class="theme-banner__label">
								<label class="cr-styled cr-styled__radio">
									<input type="radio" name="banner_inline_type" {if $theme_settings.banner_inline_type == 'img'}checked{/if} value="img">
									<i class="fa"></i>
									[[Image]]
								</label>
							</label>
							<div class="theme-banner__contents theme-banner__contents-code" style="{if $theme_settings.banner_inline_type == 'img'}display: none;{/if}">
								<textarea id="banner_inline_code" name="banner_inline_code">{$theme_settings.banner_inline_code|escape}</textarea>
							</div>
							<div class="theme-banner__contents theme-banner__contents-image" style="{if $theme_settings.banner_inline_type != 'img'}display: none;{/if}">
								<div class="input-group input-group__file">
									<input type="text" value="{$theme_settings.banner_inline_img|escape}" alt="" />
									<input type="file" name="banner_inline_img"/>
									<span class="input-group-btn">
										{if $theme_settings.banner_inline_img}
											<a href="#" class="btn btn-default btn-change btn-change__replace"><i class="fa fa-exchange" aria-hidden="true"></i>[[Change]]</a>
											<a href="#" class="btn btn-default btn-change btn-change__upload hidden"><i class="fa fa-upload" aria-hidden="true"></i>[[Upload]]</a>
											<a href="#" class="btn btn--danger"><i class="fa fa-trash-o" aria-hidden="true"></i>[[Remove]]</a>
										{else}
											<a href="#" class="btn btn-default btn-change"><i class="fa fa-upload" aria-hidden="true"></i>[[Upload]]</a>
										{/if}
									</span>
								</div>
								{if $theme_settings.banner_inline_img}
									<img class="theme-banner__preview-image" src="{$GLOBALS.user_site_url}/files/banners/{$theme_settings.banner_inline_img|escape}"/>
								{/if}
								<div class="banner-link">
									<span class="help-block">
                                   		<small>[[Banner Link]]</small>
							 		</span>
									<input type="text" name="banner_inline_link" value="{$theme_settings.banner_inline_link|escape}" />
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-7 col-md-offset-2">
					<button class="btn btn--primary">[[Save]]</button>
				</div>
			</div>
		</div>
	</div>
</form>