<script type="text/javascript">
	function in_array(what, where)
	{
		for(var i=0; i<where.length; i++) {
			if (what == where[i])
				return i;
		}
		return -1;
	}

	var id = {$id};

	var selecteduser = [];
	{foreach from=$selecteduser item=one}
		selecteduser.push('{$one}');
	{/foreach}

	var a_selecteduser = [];
	{foreach from=$a_selecteduser item=one}
		a_selecteduser.push('{$one}');
	{/foreach}

	$(function() {
		if (id > 0){
			$(".draggableuser").each(function(i){
				var drag = $(this);
				var isset = in_array(drag.attr('id'), selecteduser);
				  if (isset >= 0)
				  {
					  var drop = $("#user_"+a_selecteduser[isset] + ".droppableuser");
					  var input = "<input type='hidden' class='mapped_user' name='mapped_user[]' value='"+drop.attr('id')+':'+drag.attr('id')+"'>";
					  $("#defaultValueUser_"+drag.attr('id')).css("display", "none");
					  drop.html(input);
					  drop.append(drag);
				  }
			});
		}

		$(".draggableuser").draggable({
			revert: 'invalid',
			cursor: 'move'
		});

		$(".droppable2user").droppable({
			activeClass: 'ui-state-highlight2',
			hoverClass: 'ui-state-drophover2',
			accept: '.draggableuser',
			drop: function(event, ui) {
				$(ui.draggable).css("top", $(this).position().top + 5);
				$(ui.draggable).css("left", $(this).position().left +5);
			}
		});

		$(".droppableuser").droppable({
			activeClass: 'ui-state-highlight',
			hoverClass: 'ui-state-drophover',
			accept: '.draggableuser',
			out: function(event, ui) {
				if ($(this).children("input").val() == $(this).attr('id')+':'+ui.draggable.attr('id')) {
					$(this).children("input").remove();
					$("#defaultValueUser_"+ui.draggable.attr('id')).css("display", "block");
				}
			},
			drop: function(event, ui) {
				if ($(this).children("input").size() > 0) {
					alert('Field can access only one item');
				} else {
					var iner = "<input type='hidden' class='mapped_user' name='mapped_user[]' value='"+$(this).attr('id')+':'+ui.draggable.attr('id')+"'>";
					$("#defaultValueUser_"+ui.draggable.attr('id')).css("display", "none");
					//$("#iduser_"+ui.draggable.html()).val('');
					$(this).append(iner);
				}
				$(ui.draggable).css("top", $(this).position().top + 5);
				$(ui.draggable).css("left", $(this).position().left +5);
			}
		});

	});
</script>

<table class="manage_table">
	<thead>
		<tr>
			<th width="34%" class="text-center"><strong>[[User Profile Fields]]</strong></th>
			<th width="34%" class="text-center"><strong>[[Default Value]]</strong></th>
			<th class="text-center"	><strong>[[XML Data Fields]]</strong></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td valign="top" colspan='3' class="td-header">
				<table width="100%">
					<tr>
						<td class="td-header"><div class="droppable2Username" ><div style='line-height: 34px; height: 34px;'><strong>[[email]]</strong></div></td>
						<td class="td-wide td-header">&nbsp;</td>
						<td align='right' class="td-header">
							<div class="droppableusername">
								<div class="xml-data-fields">
									<select name='username' style="width: 190px;">
											{foreach from=$tree key=main_key item=one}
												<option value='{$one.key}' {if $username == $one.key }selected{/if}>{$main_key|replace:"_dog_":"@"|replace:"_":" - "}</option>
											{/foreach}
									</select>
								</div>
							</div>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td valign="top" colspan='2'>
				<table width="100%">
					{foreach from=$fields item=field}
					<tr>
						<td class="td_height">
							<div class="droppable2user">
								<div class="draggableuser" title="[[Drag and drop to the appropriate XML field]]" id="{$field.id}">
									[[{$field.caption|escape}]]
								</div>
							</div>
						</td>
						{assign var="idField" value=$field.id}
						<td class="td_height td-wide">
							<div id='defaultValueUser_{$field.id}'>
								<input placeholder="[[{$field.caption|escape}]]" type="text" name='user_default_value[{$field.id}]' id='iduser_{$field.id}' value="[[{$user_default_value.$idField|escape}]]"  />
							</div>
						</td>
					</tr>
					{/foreach}
				</table>
			</td>
			<td valign="top">
				<table width="100%">
					{foreach from=$tree key=main_key item=one}
						<tr>
							<td class="td_height" align="right" style="white-space: nowrap">{$main_key|replace:"_dog_":"@"|replace:"_":" - "} </td>
							<td class="td_height"><div class="droppableuser" id="user_{$one.key}"></td>
						</tr>
					{/foreach}
				</table>
			</td>
		</tr>
	</tbody>
</table>

