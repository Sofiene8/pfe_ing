<script type="text/javascript">
<!--
	function viewPermission(el, value)
    {
    	var amountDiv = '#' + el.name + '_amountPermissions';
    	var typeDiv = '#' + el.name + '_typePermissions';
    	var messageDiv = '#' + el.name + '_messagePermissions';

    	if (el.tagName == 'INPUT') {
    		if (el.checked) {
    			$(amountDiv).show();
    			$(typeDiv).hide();
    		}
    		else {
    			$(amountDiv).hide();  
    			$(typeDiv).show();
    		}
    	}
    	else {
        	switch (el.value) {
        		case 'inherit':
            		$(amountDiv).hide();
            		$(typeDiv).hide();
            		break;
        		case 'allow':
            		$(amountDiv).show();
            		$(typeDiv).hide();
            		break;
        		case 'deny':
        			$(amountDiv).hide();
        			$(typeDiv).show();
            		break;
        	}
    	}
    	if ($(typeDiv).css('display') == 'block') {
    		if ($(typeDiv +' input[type=radio]:checked').val() == "message")
        		$(messageDiv).show();	
    		else
    			$(messageDiv).hide();	
        }
    	else {
    		$(messageDiv).hide();
    	}
	}

    $(document).ready(function () {
        $(".permissionSelect").each(function () {
        	viewPermission(this, this.value);
        });
    });

	function viewMessage(p_name)
    {
		var typeDiv = '#' + p_name + '_typePermissions';
		var messageDiv = '#' + p_name + '_messagePermissions';
		if ($(typeDiv +' input[type=radio]:checked').val() == "message")
			$(messageDiv).show();	
		else
			$(messageDiv).hide();
	}

//-->
</script>

{breadcrumbs}
    {if $type == 'user'}
    	<a href="{$GLOBALS.site_url}/manage-users/{$userGroupInfo.id|lower}/">[[Manage {if $userGroupInfo.id == 'Employer' || $userGroupInfo.id == 'JobSeeker'}{$userGroupInfo.name}s{else}'{$userGroupInfo.name}' Users{/if}]]</a> &#187; <a href="{$GLOBALS.site_url}/edit-user/?user_sid={$role}">[[Edit {$userGroupInfo.name}]]</a> / [[View Permissions]]
    {/if}
{/breadcrumbs}
<div class="page-title">
	<h1 class="title">
		{if $type == "user"}
			[[View]]
		{else}
			[[Manage]]
		{/if}
	</h1>
</div>
<div style="width: 700px;	display: block;">
	<form method="post" action="{$GLOBALS.site_url}/system/users/acl/">
		<input type="hidden" id="action" name="action" value="apply_info" />
		<input type="hidden" name="type" value="{$type}" />
		<input type="hidden" name="role" value="{$role}" />
		<h3>[[General permissions]]</h3>
		{include file="acl_group_permissions.tpl" group="general"}
		
		{foreach item=listingType from=$listingTypes}
			<h3>[[{$listingType.name} permissions]]</h3>
			{include file="acl_group_permissions.tpl" group=$listingType.id}
		{/foreach}
	
		{if $type != 'user'}
			<br/>
            <div class="pull-right">
                <input type="submit" value="[[Save]]" class="btn btn--primary" />
            </div>
		{/if}
	</form>
</div>