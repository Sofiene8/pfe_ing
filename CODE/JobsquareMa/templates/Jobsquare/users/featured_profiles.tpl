{if $profiles}
	<section class="main-sections main-sections__featured-companies home-nbr">
		<div class="container container-fluid featured-companies">
		<!--<div class="row"><h4 class="featured-companies__title text-center"><strong>{$listings_types.Job}</strong> [[Live Jobs]] </h4></div>-->
			<div class="row">
				
				<div class="col-md-12">
<ul class="featured-companies__slider featured-companies__slider__js featured-trainings__slider__js">
				{foreach from=$profiles item=profile name=profile_block}
				{if $profile.id}
					<li class="featured-company">
						<a href="{$GLOBALS.site_url}/company/{$profile.id}/{$profile.CompanyName|pretty_url}/" title="{$profile.CompanyName|escape}">
							<div class="panel panel-default featured-company__panel">
								<div class="panel-body featured-company__panel-body">
									{if $profile.Logo.thumb_file_url}
										<img class="featured-company__image" src="{$profile.Logo.thumb_file_url}" alt="{$profile.WebSite}" title="{$profile.CompanyName|truncate:23}"/>
                                    {elseif $profile.Logo.file_url}
										<img class="featured-company__image" src="{$profile.Logo.file_url}" alt="{$profile.WebSite}" title="{$profile.CompanyName|truncate:23}"/>
									{else}
										<div class="company__no-image" title="{$profile.CompanyName}"></div>
									{/if}
								</div>
								<div class="panel-footer featured-company__panel-footer">
									<div class="featured-companies__name">
										<span>{$profile.CompanyName}</span>
									</div>
									<div class="featured-companies__jobs">
										{assign var="jobs_number" value=$profile.countListings}
										[[$jobs_number job(s)]]
									</div>
								</div>
							</div>
						</a>


						
					</li>
						{/if}
				{/foreach}
			</ul>
			<span class="featured-companies__slider--arrows featured-companies__slider--prev profile_slider_prev"></span>
			<span class="featured-companies__slider--arrows featured-companies__slider--next profile_slider_next"></span>


				</div>

			
			</div>
		</div>
	</section>

	{javascript}
		<script type="text/javascript">
			var oneSlide = {
				auto: true,
				infiniteLoop: true,
				minSlides: 1,
				maxSlides: 1,
				slideWidth: 200,
				moveSlides: 1,
				pager: false,
				useCSS: true,
				responsive: true,
				nextSelector: '.profile_slider_next',
				prevSelector: '.profile_slider_prev',
				nextText: '',
				prevText: ''
			};
			var twoSlides = {
				auto: true,
				infiniteLoop: true,
				minSlides: 1,
				maxSlides: 3,
				slideWidth: 190,
				moveSlides: 1,
				pager: false,
				useCSS: true,
				responsive: true,
				nextSelector: '.profile_slider_next',
				prevSelector: '.profile_slider_prev',
				nextText: '',
				prevText: ''
			};
			var threeSlides = {
				auto: true,
				infiniteLoop: true,
				minSlides: 1,
				maxSlides: 5,
				slideWidth: 190,
				moveSlides: 1,
				pager: false,
				useCSS: true,
				responsive: true,
				nextSelector: '.profile_slider_next',
				prevSelector: '.profile_slider_prev',
				nextText: '',
				prevText: ''
			};
			var slider;
			if ($(document).width() > 680 && $(document).width() <= 1200) {
				slider = $('.featured-trainings__slider__js').bxSlider(twoSlides);
			}
			else if ($(document).width() <= 680) {
				slider = $('.featured-trainings__slider__js').bxSlider(oneSlide);
			}
			else {
				slider = $('.featured-trainings__slider__js').bxSlider(threeSlides);
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


$('.featured-companies__slider').bxSlider({
  touchEnabled: false,
  onSlideAfter: function() {
    setTimeout(() => {
      $('.bx-slider a').css('pointer-events', 'pointer');
    }); 
  }
});
		</script>
		<style>

.featured-companies .featured-company > a {
    display: block;
    border: 1px solid #f5f5f5;
    box-shadow: none;
    pointer-events: auto !important;
}
		</style>
	{/javascript}
{/if}