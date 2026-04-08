<?php
/* Smarty version 4.3.0, created on 2026-03-04 08:22:33
  from 'template_jobsquare_user:CxampphtdocsJobsquareMatemplatesJobsquareusersfeatured_profiles.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a7ebc94ba685_49626896',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4d152fa60c9ac403dacb4ac224d6593667685e0a' => 
    array (
      0 => 'template_jobsquare_user:CxampphtdocsJobsquareMatemplatesJobsquareusersfeatured_profiles.tpl',
      1 => 1772573863,
      2 => 'template_jobsquare_user',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69a7ebc94ba685_49626896 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\JobsquareMa\\system\\ext\\Smarty\\libs\\plugins\\modifier.truncate.php','function'=>'smarty_modifier_truncate',),));
if ($_smarty_tpl->tpl_vars['profiles']->value) {?>
	<section class="main-sections main-sections__featured-companies home-nbr">
		<div class="container container-fluid featured-companies">
		<!--<div class="row"><h4 class="featured-companies__title text-center"><strong><?php echo $_smarty_tpl->tpl_vars['listings_types']->value['Job'];?>
</strong> <?php $_block_plugin31 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin31, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin31->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Live Jobs<?php $_block_repeat=false;
echo $_block_plugin31->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?> </h4></div>-->
			<div class="row">
				
				<div class="col-md-12">
<ul class="featured-companies__slider featured-companies__slider__js featured-trainings__slider__js">
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['profiles']->value, 'profile', false, NULL, 'profile_block', array (
));
$_smarty_tpl->tpl_vars['profile']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['profile']->value) {
$_smarty_tpl->tpl_vars['profile']->do_else = false;
?>
				<?php if ($_smarty_tpl->tpl_vars['profile']->value['id']) {?>
					<li class="featured-company">
						<a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/company/<?php echo $_smarty_tpl->tpl_vars['profile']->value['id'];?>
/<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'pretty_url' ][ 0 ], array( $_smarty_tpl->tpl_vars['profile']->value['CompanyName'] ));?>
/" title="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['profile']->value['CompanyName'], ENT_QUOTES, 'UTF-8', true);?>
">
							<div class="panel panel-default featured-company__panel">
								<div class="panel-body featured-company__panel-body">
									<?php if ($_smarty_tpl->tpl_vars['profile']->value['Logo']['thumb_file_url']) {?>
										<img class="featured-company__image" src="<?php echo $_smarty_tpl->tpl_vars['profile']->value['Logo']['thumb_file_url'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['profile']->value['WebSite'];?>
" title="<?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['profile']->value['CompanyName'],23);?>
"/>
                                    <?php } elseif ($_smarty_tpl->tpl_vars['profile']->value['Logo']['file_url']) {?>
										<img class="featured-company__image" src="<?php echo $_smarty_tpl->tpl_vars['profile']->value['Logo']['file_url'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['profile']->value['WebSite'];?>
" title="<?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['profile']->value['CompanyName'],23);?>
"/>
									<?php } else { ?>
										<div class="company__no-image" title="<?php echo $_smarty_tpl->tpl_vars['profile']->value['CompanyName'];?>
"></div>
									<?php }?>
								</div>
								<div class="panel-footer featured-company__panel-footer">
									<div class="featured-companies__name">
										<span><?php echo $_smarty_tpl->tpl_vars['profile']->value['CompanyName'];?>
</span>
									</div>
									<div class="featured-companies__jobs">
										<?php $_smarty_tpl->_assignInScope('jobs_number', $_smarty_tpl->tpl_vars['profile']->value['countListings']);?>
										<?php $_block_plugin32 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin32, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin32->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>$jobs_number job(s)<?php $_block_repeat=false;
echo $_block_plugin32->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
									</div>
								</div>
							</div>
						</a>


						
					</li>
						<?php }?>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			</ul>
			<span class="featured-companies__slider--arrows featured-companies__slider--prev profile_slider_prev"></span>
			<span class="featured-companies__slider--arrows featured-companies__slider--next profile_slider_next"></span>


				</div>

			
			</div>
		</div>
	</section>

	<?php $_block_plugin33 = isset($_smarty_tpl->smarty->registered_plugins['block']['javascript'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['javascript'][0][0] : null;
if (!is_callable(array($_block_plugin33, '_tpl_javascript'))) {
throw new SmartyException('block tag \'javascript\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('javascript', array());
$_block_repeat=true;
echo $_block_plugin33->_tpl_javascript(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
		<?php echo '<script'; ?>
 type="text/javascript">
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
		<?php echo '</script'; ?>
>
		<style>

.featured-companies .featured-company > a {
    display: block;
    border: 1px solid #f5f5f5;
    box-shadow: none;
    pointer-events: auto !important;
}
		</style>
	<?php $_block_repeat=false;
echo $_block_plugin33->_tpl_javascript(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
}
}
}
