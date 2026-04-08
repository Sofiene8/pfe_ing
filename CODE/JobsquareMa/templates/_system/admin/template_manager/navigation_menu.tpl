<form method="post" action="">
	<div class="page-title page-title--wide">
		<h1 class="title">
			[[Navigation Menu]]
		</h1>
		<div class="page-title__buttons">
			<button type="button" class="btn btn--primary add-menu-item">[[Add Menu Item]]</button>
		</div>
	</div>
	<p>[[Drag items up/down to reorder and left/right to create sub-menu items.]]</p>
	<div class="panel panel-default panel--wide panel__navigation">
		<div class="panel-body">
			<div class="dd submenu">
				<div class="submenu__inner">
					<ol class="dd-list">
						{foreach from=$menuItems item='menuItem'}
							{include file='navigation_menu_item.tpl' item=$menuItem level=0}
						{/foreach}
					</ol>
				</div>
			</div>
			<button class="btn btn--primary" style="margin-right: 10px;">[[Save]]</button>
		</div>
	</div>
</form>

<li class="dd-item prototype" data-id="{$item.id}">
	<div class="dd-handle sortable-handle">...</div>
	<div class="dd-content clearfix">
		<input class="dd-content__item" type="text" name="menu_item[]" value="{$item.name|escape}"/>
		<input type="hidden" name="parent[]" value="{$item.parent}" />
		<select class="page-selector dd-content__item">
			{foreach from=$system_pages item='page' key='uri'}
				<option value="{$uri|escape}">{$page}</option>
			{/foreach}
			{foreach from=$pages item='page'}
				<option value="{$page.uri|escape}">{$page.title}</option>
			{/foreach}
			<option value="" selected="selected">[[External Page]]</option>
		</select>
		<span class="external-link dd-content__item">
			<input type="text" name="link[]" value="https://"/>
		</span>
		<i class="ion-close-circled"></i>
	</div>
</li>

{javascript}
	<link rel="stylesheet" type="text/css" href="{$GLOBALS.user_site_url}/templates/_system/admin/assets/third-party/css/jquery.nestable.css?v={$GLOBALS.v}" />
	<script src="{$GLOBALS.user_site_url}/templates/_system/admin/assets/third-party/js/jquery.nestable.js"></script>
	<script>
		$(document).ready(function() {
			$(document).on('click', '.ion-close-circled', function() {
				$(this).closest('li').remove();
			});

			var init = false;

			$(document).on('change', '.page-selector', function() {
				var row = $(this).closest('.dd-content');
				row.find('.external-link').toggle($(this).val() == '');

				if (init) {
					row.find('.external-link').find('input').val($(this).val() == '' ? 'https://' : $(this).val());
					if ($(this).val() != '') {
						row.find('[name="menu_item[]"]').val($(this).find('option:selected').text());
					} else {
						row.find('[name="menu_item[]"]').val('');
					}
				}
			});
			$(document).find('.page-selector').change();
			init = true;

			var setParents = function() {
				$('input[name="parent[]"]').each(function() {
					if ($(this).parents('li').length > 1) {
						$(this).val($('.dd li').index($(this).closest('ol').closest('li')) + 1);
					} else {
						$(this).val('0');
					}
				});
			};

			$('.add-menu-item').click(function() {
				$('.dd > .submenu__inner > .dd-list').append($('.prototype').clone().removeClass('prototype'));
				setParents();
			});

			$('.dd').nestable({
				autoscroll: true,
				maxDepth: 2,
				callback: setParents
			});
		});
	</script>
{/javascript}