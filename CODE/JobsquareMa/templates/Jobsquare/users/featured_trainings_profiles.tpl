{if $profiles}
	<section class="main-sections main-sections__featured-companies ">
		<div class="container container-fluid featured-companies">
			<h4 class="featured-companies__title text-center "><strong>{$listings_types.Training}</strong> [[Live Trainings]]</h4>
			<ul class="featured-companies__slider slider__js__trainings">
				{foreach from=$profiles item=profile name=profile_block}
					<li class="featured-company">
						<a href="{$GLOBALS.site_url}/company/{$profile.id}/{$profile.CompanyName|pretty_url}/" title="{$profile.CompanyName|escape}">
							<div class="panel panel-default featured-company__panel featured-company-trainings">
								<div class="panel-body featured-company__panel-body">
									{if $profile.Logo.thumb_file_url}
										<img class="featured-company__image" src="{$profile.Logo.thumb_file_url}" alt="{$profile.WebSite}" title="{$profile.CompanyName|truncate:23}"/>
                                    {elseif $profile.Logo.file_url}
										<img class="featured-company__image" src="{$profile.Logo.file_url}" alt="{$profile.WebSite}" title="{$profile.CompanyName|truncate:23}"/>
									{else}
										<div class="company__no-image" title="{$profile.CompanyName}"></div>
									{/if}
								</div>
								<div class="panel-footer featured-company__panel-footer featured-company-trainings">
									<div class="featured-companies__name featured-company-trainings">
										<span>{$profile.CompanyName}</span>
									</div>
									<div class="featured-companies__jobs featured-company-trainings">
										{assign var="jobs_number" value=$profile.countListings}
										[[$jobs_number training(s)]]
									</div>
								</div>
							</div>
						</a>
					</li>
				{/foreach}
			</ul>
			<span class="featured-companies__slider--arrows featured-companies__slider--prev training_slider_prev"></span>
			<span class="featured-companies__slider--arrows featured-companies__slider--next training_slider_next"></span>
		</div>
	</section>

	{javascript}
		<script type="text/javascript">
			var oneSlide = {
				auto: true,
				infiniteLoop: true,
				minSlides: 1,
				maxSlides: 1,
				slideWidth: 306,
				moveSlides: 1,
				pager: false,
				useCSS: true,
				responsive: true,
				nextSelector: '.training_slider_next',
				prevSelector: '.training_slider_prev',
				nextText: '',
				prevText: ''
			};
			var twoSlides = {
				auto: true,
				infiniteLoop: true,
				minSlides: 1,
				maxSlides: 2,
				slideWidth: 306,
				moveSlides: 1,
				pager: false,
				useCSS: true,
				responsive: true,
				nextSelector: '.training_slider_next',
				prevSelector: '.training_slider_prev',
				nextText: '',
				prevText: ''
			};
			var threeSlides = {
				auto: true,
				infiniteLoop: true,
				minSlides: 1,
				maxSlides: 3,
				slideWidth: 306,
				moveSlides: 1,
				pager: false,
				useCSS: true,
				responsive: true,
				nextSelector: '.training_slider_next',
				prevSelector: '.training_slider_prev',
				nextText: '',
				prevText: ''
			};
			var slider;
			if ($(document).width() > 680 && $(document).width() <= 1200) {
				slider = $('.slider__js__trainings').bxSlider(twoSlides);
			}
			else if ($(document).width() <= 680) {
				slider = $('.slider__js__trainings').bxSlider(oneSlide);
			}
			else {
				slider = $('.slider__js__trainings').bxSlider(threeSlides);
			}
			$(window).on('resize orientationchange', function() {
				if ($(document).width() > 680 && $(document).width() <= 1200) {
					slider.destroySlider();
					slider.reloadSlider(twoSlides);
				}
				if($(document).width() <= 680) {
					slider.destroySlider();
					slider.reloadSlider(oneSlide);
				}
				if ($(document).width() > 1200){
					slider.destroySlider();
					slider.reloadSlider(threeSlides);
				}
			});
		</script>
	{/javascript}
{/if}