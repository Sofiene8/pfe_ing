{assign "chars" array(' ', '/')}

<nav class="navigation">
	<ul class="list-unstyled">
		<li id="dashboard" {if $url == '/'}class="active"{/if}>
			<a href="{$GLOBALS.admin_site_url}">
				<i class="fa fa-tachometer"></i> <span class="nav-label">[[Dashboard]]</span>
			</a>
		</li>
		{foreach from=$left_admin_menu key="section" item="section_items" name='menu_block'}
			<li class="has-submenu nav__item {if $section_items.active}active{/if}" id="{$section_items.id|lower}">
                <a href="#"><i class="fa {$section_items.id|lower}"></i> <span class="nav-label">[[{$section}]]</span></a>
                <ul class="list-unstyled">
                    {foreach from=$section_items item="item"}
                        {if is_array($item)}
                            <li class="{if $item.active}active{/if}">
                                <a href="{$item.reference}" data-accordion="{$section_items.id|lower}" class="sub-{$item.title|lower|replace:$chars:''}">[[{$item.title}]]</a>
                            </li>
                        {/if}
                    {/foreach}
                </ul>
            </li>
		{/foreach}
		{if $acl->isAllowed('Settings and Configuration')}
			<li id="plugins" class="{if in_array($url, ['/system/miscellaneous/plugins/', '/system/miscellaneous/jobg8_settings/', '/social-media/linkedin', '/system/miscellaneous/plugins/', '/system/miscellaneous/fb_app_settings/'])}active{/if}">
				<a href="{$GLOBALS.admin_site_url}/system/miscellaneous/plugins/" data-accordion="plugins"><span class="nav-label"><i class="fa fa-plug"></i>[[Plugins]]</span></a>
			</li>
		{/if}
	</ul>
</nav>
<div class="packageVersion text-center">[[version]] {$GLOBALS.version.major}.{$GLOBALS.version.minor}.{$GLOBALS.version.build}</div>

{javascript}
	<script language="JavaScript" type="text/javascript" src="{$GLOBALS.user_site_url}/templates/_system/admin/assets/third-party/js/jquery.nicescroll.js"></script>

	<script>
		var $sideBar = $('aside.left-panel');
		var $navbarItem = $("aside.left-panel nav.navigation > ul > li > a");

		// mark left menu item as active if none marked
		// todo: refactor
		if ($('.left-panel nav .active').length == 0) {
			if (localStorage.getItem("currentMenu") !== null) {
				var openMenu = localStorage.getItem('currentMenu');
				$('#' + openMenu).addClass('active');
			}

			if (localStorage.getItem("currentSubMenu") !== null) {
				var openSubMenu = localStorage.getItem('currentSubMenu');
				$('.' + openSubMenu).closest('li').addClass('active');
			}
		}

		$('.navbar-toggle').on('click', function () {
			$sideBar.toggleClass('collapsed');
		});

		$('.has-submenu ul a').on('click', function() {
			localStorage.setItem('currentSubMenu', $(this).attr('class'));
		});

		$('[data-accordion]').on('click', function() {
			localStorage.setItem('currentMenu', $(this).data('accordion'));
		});

		$navbarItem.click(function (e) {
			if ($(this).closest('li').hasClass('has-submenu')) {
				e.preventDefault();
				$("aside.left-panel nav.navigation > ul > li > ul").slideUp(300);
				$("aside.left-panel nav.navigation > ul > li").removeClass('active');

				if (!$(this).next().is(":visible")) {
					$(this).next().slideToggle(300, function () {
						$("aside.left-panel:not(.collapsed)").getNiceScroll().resize();
					});
					$(this).closest('li').addClass('active');
				}
				return false;
			}
		});

		$("aside.left-panel").niceScroll({
			cursorcolor: '#8e909a',
			cursorborder: '0px solid #fff',
			cursoropacitymax: '0.5',
			cursorborderradius: '0px'
		});

	</script>
{/javascript}