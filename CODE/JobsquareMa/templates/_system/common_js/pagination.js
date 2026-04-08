function goSingleButton(action, textChooseItem, textToDelete) {
	if ($("input:checked").length > 0) {
		if (((action == "delete" || action == "remove") && confirm(textToDelete)) || action != "delete") {
			submitForm(action);
		}
	} else {
		$("#actionWarning").dialog("destroy");
		$("#actionWarning").attr({ title: "" });
		$("#actionWarning").html(textChooseItem).dialog({ width: 300 });
	}
}

function go(button, textToDelete, textChooseAction, textChooseItem) {
	if (isActionEmpty(button, textChooseAction, textChooseItem) == true) {
		var action = $("#selectedAction_" + button).val();
		if (((action == "delete" || action == "remove") && confirm(textToDelete)) || action != "delete") {
			submitForm(action);
		}
	}
}

function submitForm(action) {
	$("#action_name").attr("value", action);
	$("#action_name").parent("form").submit();
}

function isActionEmpty(button, textChooseAction, textChooseItem) {
	var inputChecked = $("input:checked").length;
	var actionChecked = $("#selectedAction_" + button).val();
	if (inputChecked > 0 && actionChecked != "") {
		return true;
	} else {
		var htmlMessage = "";
		if (actionChecked == "") {
			htmlMessage += textChooseAction;
		}
		if (inputChecked == 0) {
			htmlMessage += textChooseItem;
		}

		$('#action-modal').modal('show').find('.modal-body').html(htmlMessage);

		$("#selectedAction_" + button).val('');
	}
}

