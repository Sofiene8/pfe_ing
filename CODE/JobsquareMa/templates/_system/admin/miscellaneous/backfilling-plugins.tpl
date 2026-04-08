
<div class="page-title">
	<h1 class="title">[[Job Backfilling]]</h1>
</div>

<div class="panel panel-default list-widget panel__enable_backfilling">
	<div class="panel-body">
		<label class="control-label">[[Enable job backfilling]] &nbsp;</label>
		<div class="control-label control__toggle">
			<div class="toggle toggle-success"></div>
		</div>
	</div>
</div>

<div class="backfilling-list {if !$GLOBALS.settings.enable_backfilling}hidden{/if}">
	<div>
		[[Please select your backfilling provider below.]]
	</div>
	<br>
    {foreach from=$errors item="error"}
		<p class="error">[[{$error}]]</p>
    {/foreach}
	<form method="post">
		<input type="hidden" name="action" value="save" />
        {foreach from=$groups item=plugins key=group}
            {foreach from=$plugins item=plugin key=key}
				<div class="panel panel-default list-widget panel__backfilling">
					<input type="hidden" name="" value="{$key|escape}" />
					<div class="panel-body">
					<span>
						<label class="cr-styled cr-styled__radio">
							<input type="radio" name="plugin" value="{$key|escape}" {if $plugin.active}checked="checked"{/if} />
							<i class="fa"></i>
							&nbsp;
							{capture name='img'}
								<img class="list-widget__img {if !$plugin.active}panel__backfilling--inactive{/if}" src="{image}{$plugin.name|lower}-logo.png" border="0" alt="{$plugin.name}"/>
                            {/capture}
							{if $plugin.active}
								<a href="?action=settings&amp;plugin={$plugin.name}" title="[[Edit ]] {$plugin.name|escape}">
									{$smarty.capture.img}
								</a>
							{else}
								{$smarty.capture.img}
							{/if}
						</label>
					</span>
                        {if $plugin.active}
							<a href="?action=settings&amp;plugin={$plugin.name}" class="btn btn--primary pull-right">
								[[Edit]]
							</a>
                        {/if}
					</div>
				</div>
            {/foreach}
        {/foreach}
	</form>
</div>

{javascript}
	<script>
        $(document).ready(function() {
            $('.toggle').toggles({if $GLOBALS.settings.enable_backfilling}{ on: true }{/if});
            $('.toggle').on('toggle', function(e, active) {
                $.get('', {
                    enable: active ? 1 : 0,
                    action: 'switch_backfilling'
                });
                $('.backfilling-list').toggleClass('hidden', !active);
            });
            $(document).on('change', '.panel__backfilling input:radio', function() {
                $(this).closest('.panel-body').addClass('loading');
			    $(this).closest('form').submit();
			});
        });
	</script>
{/javascript}
