<div class="panel-group" id="accordion">
	<div class="panel panel-default panel--max">
		<div class="panel-heading" style="margin-bottom: 0; padding-bottom: 0;">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#accordion__panel" {if !$smarty.request.list_visible}aria-expanded="false" class="collapsed"{else}aria-expanded="true"{/if}>
					[[List Items]]
				</a>
			</h4>
		</div>
		<div id="accordion__panel" class="panel-collapse collapse {if $smarty.request.list_visible}in{/if}">
			<div class="panel-body">
				<div class="table-responsive__list-editing">
					<table class="table table-striped table__fields-list">
						<tbody class="tbody--sort">
							{foreach from=$list_items item=list_value key=sid name=items_block}
								<tr>
									<td class="sortable-handle">...</td>
									<td class="td-wide">
										<input name="item_value[][{$sid}]" type="text" value="{$list_value|escape}" />
									</td>
									<td>
										<i class="ion-close-circled"></i>
									</td>
								</tr>
							{/foreach}
						</tbody>
						<tbody>
							<tr>
								<td></td>
								<td>
									<div class="input-group">
										<input name="list_item_value" class="textField list-item__input" />
										<input name="list_visible" type="hidden" value="{if $smarty.request.list_visible}visible{/if}" />
											<span class="input-group-btn">
												<input type="button" value="[[Add]]" class="btn btn--secondary list-item__add" />
											</span>
									</div>
								</td>
								<td></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
{javascript}
	<script type="text/javascript">
		$(document).ready(function() {
			$('.tbody--sort').sortable({
				helper: function(e, ui) {
					ui.children().each(function() {
						$(this).width($(this).width());
					});
					return ui;
				},
				handle: '.sortable-handle'
			});
			$(document).on('click', '.ion-close-circled', function() {
				var row = $(this).closest('tr');
				row.hide();
				row.find('input').val('');
			});

			var addNewItem = function() {
				var input = $('.list-item__input');
				if (input.val()) {
					var row = $('<tr><td class="sortable-handle">...</td><td><input name="item_value[][new]" type="text" value="" /></td><td><i class="ion-close-circled"></i></td></tr>');
					row.find('input[type="text"]').val(input.val());
					row.appendTo('.tbody--sort');
					input.val('');
				}
			};
            $('.list-item__add').on('click', addNewItem);
            $('.list-item__input').on('keypress', function(e) {
            	if (e.keyCode == 13) {
					e.preventDefault();
					addNewItem();
				}
			});

            $('#accordion')
				.on('hide.bs.collapse', function () {
					$('input[name="list_visible"]').val('');
				})
				.on('show.bs.collapse', function () {
					$('input[name="list_visible"]').val('visible');
				});
		});
	</script>
{/javascript}