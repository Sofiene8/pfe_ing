<ul class="nav navbar-nav navbar-left">
    
	
	{if $GLOBALS.user_page_uri == '/jobs/' || $GLOBALS.user_page_uri == '/job/' || $GLOBALS.user_page_uri == '/registration/'|| $GLOBALS.user_page_uri == '/login/'}
	&nbsp;
	{foreach from=$menuItems item='menuItem'}
	{if  $menuItem.fixed_url=='#'}
	  <li class="navbar__item {if $url == $menuItem.url}active{/if}{if $smarty.request.listing_type_id == 'Job' && $menuItem.url == '/add-listing/?listing_type_id=Job'}active{/if}{if $menuItem.children} dropdown{/if}">
            <a class="navbar__link" href="{$menuItem.fixed_url|escape}"><span>[[{$menuItem.name}]]</span></a>
            {if $menuItem.children}
                <ul class="dropdown-menu">
                    {foreach from=$menuItem.children item='sub_item'}
                        <li class="navbar__item {if $url == $sub_item.url}active{/if}{if $smarty.request.listing_type_id == 'Job' && $sub_item.url == '/add-listing/?listing_type_id=Job'}active{/if}">
                            <a class="navbar__link" href="{$sub_item.fixed_url|escape}"><span>[[{$sub_item.name}]]</span></a>
                        </li>
                    {/foreach}
                </ul>
				</li>
            {/if}
			   {/if}
         {/foreach}
		 
	{elseif $GLOBALS.user_page_uri == '/training/'}
	&nbsp;
	
	{foreach from=$menuItems item='menuItem'}
	{if  $menuItem.url=='/jobs/'||$menuItem.url=='/trainings/'}
	  <li class="navbar__item {if $url == $menuItem.url}active{/if}{if $smarty.request.listing_type_id == 'Job' && $menuItem.url == '/add-listing/?listing_type_id=Job'}active{/if}{if $menuItem.children} dropdown{/if}">
            <a class="navbar__link" href="{$menuItem.fixed_url|escape}"><span>[[{$menuItem.name}]]</span></a>
            {if $menuItem.children}
                <ul class="dropdown-menu">
                    {foreach from=$menuItem.children item='sub_item'}
                        <li class="navbar__item {if $url == $sub_item.url}active{/if}{if $smarty.request.listing_type_id == 'Job' && $sub_item.url == '/add-listing/?listing_type_id=Job'}active{/if}">
                            <a class="navbar__link" href="{$sub_item.fixed_url|escape}"><span>[[{$sub_item.name}]]</span></a>
                        </li>
                    {/foreach}
                </ul>
				</li>
            {/if}
			   {/if}
         {/foreach} 
    {elseif $GLOBALS.user_page_uri == '/edit-resume/' || $GLOBALS.user_page_uri == '/resume/'|| ($GLOBALS.user_page_uri == '/my-listings/' & $GLOBALS.current_user.group.id != "Employer")|| ($GLOBALS.user_page_uri == '/system/applications/view/' & $GLOBALS.current_user.group.id != "Employer") || ($GLOBALS.user_page_uri == '/edit-profile/' & $GLOBALS.current_user.group.id != "Employer") }
	
	&nbsp;
	{foreach from=$menuItems item='menuItem'}
	{if  $menuItem.fixed_url=='#'}
	  <li class="navbar__item {if $url == $menuItem.url}active{/if}{if $smarty.request.listing_type_id == 'Job' && $menuItem.url == '/add-listing/?listing_type_id=Job'}active{/if}{if $menuItem.children} dropdown{/if}">
            <a class="navbar__link" href="{$menuItem.fixed_url|escape}"><span>[[{$menuItem.name}]]</span></a>
            {if $menuItem.children}
                <ul class="dropdown-menu">
                    {foreach from=$menuItem.children item='sub_item'}
                        <li class="navbar__item {if $url == $sub_item.url}active{/if}{if $smarty.request.listing_type_id == 'Job' && $sub_item.url == '/add-listing/?listing_type_id=Job'}active{/if}">
                            <a class="navbar__link" href="{$sub_item.fixed_url|escape}"><span>[[{$sub_item.name}]]</span></a>
                        </li>
                    {/foreach}
                </ul>
				</li>
            {/if}
			   {/if}
         {/foreach}
		{elseif ($GLOBALS.user_page_uri == '/add-listing/' || $GLOBALS.user_page_uri == '/my-listings/' || $GLOBALS.user_page_uri == '/edit-job/' || $GLOBALS.user_page_uri == '/clone-job/'|| $GLOBALS.user_page_uri == '/job-preview/'|| $GLOBALS.user_page_uri == '/edit-profile/' || $GLOBALS.user_page_uri == '/resumes/')}
	
	&nbsp;
	{foreach from=$menuItems item='menuItem'}
		{if  $menuItem.url=='/jobs/'||$menuItem.url=='/trainings/'|| $menuItem.url == '/companies/'}
	  <li class="navbar__item {if $url == $menuItem.url}active{/if}{if $smarty.request.listing_type_id == 'Job' && $menuItem.url == '/add-listing/?listing_type_id=Job'}active{/if}{if $menuItem.children} dropdown{/if}">
            <a class="navbar__link" href="{$menuItem.fixed_url|escape}"><span>[[{$menuItem.name}]]</span></a>
            {if $menuItem.children}
                <ul class="dropdown-menu">
                    {foreach from=$menuItem.children item='sub_item'}
                        <li class="navbar__item {if $url == $sub_item.url}active{/if}{if $smarty.request.listing_type_id == 'Job' && $sub_item.url == '/add-listing/?listing_type_id=Job'}active{/if}">
                            <a class="navbar__link" href="{$sub_item.fixed_url|escape}"><span>[[{$sub_item.name}]]</span></a>
                        </li>
                    {/foreach}
                </ul>
				</li>
            {/if}
			   {/if}
         {/foreach} 
		 {elseif (( $GLOBALS.user_page_uri == '/products/')& $GLOBALS.current_user.group.id == "Employer")|| (( $GLOBALS.user_page_uri == '/shopping-cart/')& $GLOBALS.current_user.group.id == "Employer")}
		
		&nbsp;
	{else}
		{foreach from=$menuItems item='menuItem'}
        <li class="navbar__item {if $url == $menuItem.url}active{/if}{if $smarty.request.listing_type_id == 'Job' && $menuItem.url == '/add-listing/?listing_type_id=Job'}active{/if}{if $menuItem.children} dropdown{/if}">
            <a class="navbar__link" href="{$menuItem.fixed_url|escape}"><span>[[{$menuItem.name}]]</span></a>
            {if $menuItem.children}
                <ul class="dropdown-menu">
                    {foreach from=$menuItem.children item='sub_item'}
                        <li class="navbar__item {if $url == $sub_item.url}active{/if}{if $smarty.request.listing_type_id == 'Job' && $sub_item.url == '/add-listing/?listing_type_id=Job'}active{/if}">
                            <a class="navbar__link" href="{$sub_item.fixed_url|escape}"><span>[[{$sub_item.name}]]</span></a>
                        </li>
                    {/foreach}
                </ul>
            {/if}
        </li>
	
    {/foreach}
		{/if}
</ul>

{javascript}
    <script>
        $('.navbar__link').on('click', function(e) {
            if ($(this).attr('href') == '' || $(this).attr('href') == 'https://' ||
                    $(this).attr('href') == 'https://' || $(this).attr('href') == '#') {
                e.preventDefault();
            }
        });

        $('.dropdown > a').on('touchstart', function (e) {
            var link = $(this);
            if (link.hasClass('hover')) {
                return true;
            } else {
                link.addClass('hover');
                $('.dropdown > a').not(this).removeClass('hover');
                e.preventDefault();
                return false;
            }
        });

        $(document).on('click', function (e) {
            var dropdown = $('.navbar__link.hover').closest('.navbar__item');

            if (!dropdown.is(e.target) && dropdown.has(e.target).length === 0) {
                dropdown.find('.navbar__link.hover').removeClass('hover');
            }
        });
    </script>
{/javascript}