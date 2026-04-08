{breadcrumbs}
	<a href="{$GLOBALS.site_url}/system/miscellaneous/plugins/">[[Plugins]]</a> / [[Social Login]]
{/breadcrumbs}
<div class="page-title">
	<h1 class="title">[[Social Login]]</h1>
</div>

<div class="messages">
    {foreach from=$errors item="error"}
		<p class="error">
			[[{$error}]]
		</p>
    {/foreach}
    {if $saved}
		<p class="message">
			[[Your changes have been successfully saved]]
		</p>
    {/if}
</div>

<form method="post" class="social-settings form-horizontal">
	<input type="hidden" name="action" value="save_settings" />
    {foreach from=$networks key='network' item='item'}
		<div class="panel-group" id="accordion-{$network}">
			<div class="panel panel-default panel__social">
				<div class="panel-heading" style="margin-bottom: 0; padding-bottom: 0;">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion-{$network}" href="#accordion__panel-{$network}" class="collapsed" aria-expanded="false">
							<img src="{image}{$network}-login-logo.png" />
							<span>[[{$network}]]</span>
							<span class="pull-right hidden-xs">
								{if $settings.{$item[0].id}}
									<span class="label label--active label__social">[[Active]]</span>
								{else}
									<span class="label label--inactive label__social">[[Not Active]]</span>
                                {/if}
							</span>
						</a>
					</h4>
				</div>
				<div id="accordion__panel-{$network}" class="panel-collapse collapse">
					<div class="panel-body">
                        {foreach from=$item item='networkSettings' name='networkSettings'}
							<div class="form-group">
                                {assign var=setting_name value=$networkSettings.id}
								<label class="col-md-3 control-label">
									[[{$networkSettings.caption}]]
									<span class="pull-right required">&nbsp;{if $networkSettings.is_required}*{/if}</span>
								</label>

								<div class="col-md-9">
                                    {$pluginSetting.tabName.id}
                                    {if $networkSettings.type == 'boolean'}
										<input type="hidden" name="{$setting_name}" value="0" />
										<label class="cr-styled">
											<input type="checkbox" id="{$networkSettings.id}" name="{$setting_name}" value="1" {if $settings.$setting_name}checked="checked" {/if} />
											<i class="fa"></i>
										</label>
                                    {elseif $networkSettings.type == 'string'}
										<div class="numerical-block">
											<input type="text" name="{$networkSettings.id}" value="{$settings.$setting_name|escape}" id="{$networkSettings.id}" />
										</div>
                                    {/if}
                                    {if $networkSettings.comment}
										<span data-toggle="tooltip" data-placement="auto left" title='[[{$networkSettings.comment}]]'><i class="fa fa-question-circle" aria-hidden="true"></i></span>
                                    {/if}
								</div>
							</div>
                        {/foreach}
					</div>
				</div>
			</div>
		</div>
    {/foreach}
	<div class="form-group">
		<div class="col-md-7">
			<input type="submit" class="btn btn--primary" value="[[Save]]"/>
		</div>
	</div>
</form>

{javascript}
	<script>
        $('form.social-settings').ajaxForm({
            success: function(data) {
                data = $('<div>' + data + '</div>');
                $('.messages').replaceWith(
                    data.find('.messages')
                );
                $('.social-settings .panel-group').each(function() {
                    $(this).find('.label__social').replaceWith(
                        data.find('#' + $(this).attr('id')).find('.label__social')
                    );
                });
                $('body').scrollTop(0);
            }
        });
	</script>
{/javascript}