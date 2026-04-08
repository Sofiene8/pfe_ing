{breadcrumbs}<a href="{$GLOBALS.site_url}/system/miscellaneous/plugins/">[[Plugins]]</a> / [[TopResume]]{/breadcrumbs}
<div class="page-title page-title--wide">
	<h1 class="title">[[TopResume Integration]]</h1>
	<div class="clearfix"></div>
	<div class="page-title__buttons">
		<p>
			[[TopResume is the largest resume and CV service in the world.]]
			[[They provide job seekers with a FREE resume critique and the opportunity to then purchase a paid resume re-write service.]]
		</p>
		<p>
			[[Using this plug-in you will be able to offer a FREE resume critique from TopResume when job seekers create and upload a resume.]]
			[[You will then earn <strong>20% commission</strong> on all paid resume services.]]
		</p>

		<p>
			[[To begin using this plug-in, please submit an application for TopResume.]]
		</p>
		<div>
			<a data-toggle="modal" data-target="#topresume-apply-modal" href="#" class="btn btn--primary">[[Apply for a TopResume Partnership Here]]</a>
		</div>
	</div>
</div>

<div class="modal fade" id="topresume-apply-modal" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">
					[[Apply for TopResume Partnership]]
				</h4>
			</div>
			<div class="modal-body">
				<form method="post" action="" enctype="multipart/form-data" class="panel-body form-horizontal application--form">
					<input type="hidden" name="action" value="apply" />

					{if $message}
						<p class="message">[[{$message}]]</p>
					{/if}

					{include '../classifieds/field_errors.tpl'}
					{foreach from=$form_fields item=form_field}
						<div class="form-group">
							<label class="col-md-4 control-label">[[{$form_field.caption}]]<span class="required">&nbsp;{if $form_field.is_required}*{/if}</span></label>
							<div class="col-md-7">
								{input property=$form_field.id}
							</div>
						</div>
					{/foreach}
					<div class="form-group">
						<div class="col-md-7 col-md-offset-4">
							<input type="submit" value="[[Submit Application]]" class="btn btn--primary"/>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<form method="post" enctype="multipart/form-data" action="" class="form-horizontal">
	<input type="hidden" name="action" value="save" />
	<div class="panel-group">
		<div class="panel panel-default panel--wide">
			<div class="panel-heading" style="margin-bottom: 0; padding-bottom: 0;">
				<h4 class="panel-title">
					[[TopResume Partner Credentials]]
				</h4>
			</div>
			<div class="panel-collapse">
				<div class="panel-body">
					<div class="form-group">
						<label class="col-md-2 control-label">[[Partner Key]]</label>
						<div class="col-md-7">
							<input type="text" name="key" value="{$settings.topresume_key|escape}" alt="" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">[[Secret Key]]</label>
						<div class="col-md-7">
							<input type="text" name="secret" value="{$settings.topresume_secret|escape}" alt="" />
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-7 col-md-offset-2">
							<input type="submit" name="submit" value="[[Save]]" class="btn btn--primary" />
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</form>
<div class="response"></div>

{javascript}
	<script>
		$(document).on('submit', '.application--form', function(e) {
			e.preventDefault();
			$('#topresume-apply-modal .modal-body').addClass('loading');
			$(this).ajaxSubmit({
				success: function(data) {
					if ($(data).find('.message').length > 0) {
						$('.application--form').replaceWith($(data).find('.message'));
					} else {
						$('.application--form').replaceWith($(data).find('.application--form'));
					}
					$('#topresume-apply-modal .modal-body').removeClass('loading');
				},
				error: function() {
					$('#topresume-apply-modal .modal-body').removeClass('loading');
				}
			});
		});
	</script>
{/javascript}