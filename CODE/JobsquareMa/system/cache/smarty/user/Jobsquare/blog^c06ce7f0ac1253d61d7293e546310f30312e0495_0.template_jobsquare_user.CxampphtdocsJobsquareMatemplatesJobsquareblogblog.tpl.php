<?php
/* Smarty version 4.3.0, created on 2026-02-27 11:11:27
  from 'template_jobsquare_user:CxampphtdocsJobsquareMatemplatesJobsquareblogblog.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a17bdf952354_93372344',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c06ce7f0ac1253d61d7293e546310f30312e0495' => 
    array (
      0 => 'template_jobsquare_user:CxampphtdocsJobsquareMatemplatesJobsquareblogblog.tpl',
      1 => 1771794714,
      2 => 'template_jobsquare_user',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69a17bdf952354_93372344 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\JobsquareMa\\system\\ext\\Smarty\\libs\\plugins\\modifier.count.php','function'=>'smarty_modifier_count',),));
?>
<div class="posts-list">
    <div class="blog <?php if ($_smarty_tpl->tpl_vars['categories']->value) {?>blog-with-categories<?php }?>">
        <div class="container container--small ">
            <div class="row">
                <?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'blog_posts', null, null);?>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['posts']->value, 'post');
$_smarty_tpl->tpl_vars['post']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['post']->value) {
$_smarty_tpl->tpl_vars['post']->do_else = false;
?>
                        <article class="media well listing-item listing-item__blog <?php if (!$_smarty_tpl->tpl_vars['post']->value['image']) {?>listing-item__no-logo<?php }?>">
                            <?php if ($_smarty_tpl->tpl_vars['post']->value['image']) {?>
                                <div class="media-left listing-item__logo">
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];
echo htmlspecialchars((string)call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'blog_url' ][ 0 ], array( $_smarty_tpl->tpl_vars['post']->value )), ENT_QUOTES, 'UTF-8', true);?>
">
                                        <img class="media-object profile__img-company" src="<?php echo $_smarty_tpl->tpl_vars['post']->value['image'];?>
" alt="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['post']->value['title'], ENT_QUOTES, 'UTF-8', true);?>
">
                                    </a>
                                </div>
                            <?php }?>
                            <div class="media-body">
                                <div class="media-heading listing-item__title">
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];
echo htmlspecialchars((string)call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'blog_url' ][ 0 ], array( $_smarty_tpl->tpl_vars['post']->value )), ENT_QUOTES, 'UTF-8', true);?>
" class="link"><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['post']->value['title'], ENT_QUOTES, 'UTF-8', true);?>
</a>
                                </div>
                                <div class="listing-item__info clearfix">
                                <span class="blog__content--date">
                                    <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'date' ][ 0 ], array( $_smarty_tpl->tpl_vars['post']->value['date'] ));?>

                                </span>
                                </div>
                                <div class="listing-item__desc">
                                    <?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['post']->value['text'] ?: '');?>

                                </div>
                            </div>
                        </article>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    <?php if (smarty_modifier_count($_smarty_tpl->tpl_vars['posts']->value) == 10) {?>
                        <button type="button" class="load-more btn btn__white" data-page="2">
                            <?php $_block_plugin1 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin1, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin1->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Load more<?php $_block_repeat=false;
echo $_block_plugin1->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
                        </button>
                    <?php }?>
                <?php $_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>

                <?php if ($_smarty_tpl->tpl_vars['categories']->value) {?>
				 <?php if (!$_smarty_tpl->tpl_vars['current_category']->value) {?> 
				  <h1 class="title__primary title__primary-small title__centered title__bordered"><?php $_block_plugin2 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin2, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin2->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Actualités emploi et conseils RH Maroc<?php $_block_repeat=false;
echo $_block_plugin2->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></h1>
				 <?php } else { ?>
				  <h1 class="title__primary title__primary-small title__centered title__bordered"><?php $_block_plugin3 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin3, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin3->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['categories']->value, 'category');
$_smarty_tpl->tpl_vars['category']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['category']->key => $_smarty_tpl->tpl_vars['category']->value) {
$_smarty_tpl->tpl_vars['category']->do_else = false;
$__foreach_category_1_saved = $_smarty_tpl->tpl_vars['category'];
if ($_smarty_tpl->tpl_vars['current_category']->value == $_smarty_tpl->tpl_vars['category']->key) {
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['category']->value, ENT_QUOTES, 'UTF-8', true);?>
 <?php }
$_smarty_tpl->tpl_vars['category'] = $__foreach_category_1_saved;
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?> <?php $_block_repeat=false;
echo $_block_plugin3->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></h1>
				 <?php }?>
                   
                    <link rel="alternate" type="application/rss+xml" href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/blog/rss/" title="<?php $_block_plugin4 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin4, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin4->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Blog<?php $_block_repeat=false;
echo $_block_plugin4->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>" />
                   <div  style="position: relative;
    margin: 0 25px 10px 0;
    font-weight: 500;">
               <?php if ($_smarty_tpl->tpl_vars['current_category']->value) {?> <a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['user_site_url'];?>
/blog/">Blog</a> <?php if ($_smarty_tpl->tpl_vars['current_category']->value) {?> >    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['categories']->value, 'category');
$_smarty_tpl->tpl_vars['category']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['category']->key => $_smarty_tpl->tpl_vars['category']->value) {
$_smarty_tpl->tpl_vars['category']->do_else = false;
$__foreach_category_2_saved = $_smarty_tpl->tpl_vars['category'];
if ($_smarty_tpl->tpl_vars['current_category']->value == $_smarty_tpl->tpl_vars['category']->key) {?><a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['user_site_url'];?>
/blog/<?php echo htmlspecialchars((string)call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'pretty_url' ][ 0 ], array( $_smarty_tpl->tpl_vars['category']->value )), ENT_QUOTES, 'UTF-8', true);?>
"><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['category']->value, ENT_QUOTES, 'UTF-8', true);?>
</a> <?php }?> <?php
$_smarty_tpl->tpl_vars['category'] = $__foreach_category_2_saved;
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}?> <?php }?>
            </div>

				   <div class="col-sm-3 col-xs-12 pull-left">
                        <div class="blog__categories refine-search__block">
                            <h4><?php $_block_plugin5 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin5, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin5->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Actualités et conseils RH <?php $_block_repeat=false;
echo $_block_plugin5->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></h4>
                            <div class="blog__categories__list blog__categories__list--desktop">
                                <a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['user_site_url'];?>
/blog/" class="refine-search__item <?php if (!$_smarty_tpl->tpl_vars['current_category']->value) {?>active<?php }?>">
                                    <span class="refine-search__value"><?php $_block_plugin6 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin6, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin6->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Tous les articles<?php $_block_repeat=false;
echo $_block_plugin6->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></span>
                                </a>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['categories']->value, 'category');
$_smarty_tpl->tpl_vars['category']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['category']->key => $_smarty_tpl->tpl_vars['category']->value) {
$_smarty_tpl->tpl_vars['category']->do_else = false;
$__foreach_category_3_saved = $_smarty_tpl->tpl_vars['category'];
?>
                                    <a class="refine-search__item <?php if ($_smarty_tpl->tpl_vars['current_category']->value == $_smarty_tpl->tpl_vars['category']->key) {?>active<?php }?>" href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['user_site_url'];?>
/blog/<?php echo rawurlencode((string)$_smarty_tpl->tpl_vars['category']->key);?>
/"><span class="refine-search__value"><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['category']->value, ENT_QUOTES, 'UTF-8', true);?>
</span></a>
                                <?php
$_smarty_tpl->tpl_vars['category'] = $__foreach_category_3_saved;
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </div>
                            <div class="blog__categories__list blog__categories__list--mobile">
                                <select class="blog__categories__list--select">
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['user_site_url'];?>
/blog/" <?php if ($_smarty_tpl->tpl_vars['current_category']->value) {
} else { ?>selected<?php }?>><?php $_block_plugin7 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin7, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin7->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Tous les articles<?php $_block_repeat=false;
echo $_block_plugin7->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></option>
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['categories']->value, 'category');
$_smarty_tpl->tpl_vars['category']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['category']->key => $_smarty_tpl->tpl_vars['category']->value) {
$_smarty_tpl->tpl_vars['category']->do_else = false;
$__foreach_category_4_saved = $_smarty_tpl->tpl_vars['category'];
?>
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['user_site_url'];?>
/blog/<?php echo rawurlencode((string)$_smarty_tpl->tpl_vars['category']->key);?>
/" <?php if ($_smarty_tpl->tpl_vars['current_category']->value == $_smarty_tpl->tpl_vars['category']->key) {?>selected<?php }?>><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['category']->value, ENT_QUOTES, 'UTF-8', true);?>
</option>
                                    <?php
$_smarty_tpl->tpl_vars['category'] = $__foreach_category_4_saved;
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                </select>
                            </div>
                        </div>

                                                                                                                                                            </div>
                    <div class="col-sm-9 col-xs-12 pull-right">
                        <?php echo $_smarty_tpl->smarty->ext->_capture->getBuffer($_smarty_tpl, 'blog_posts');?>

                    </div>
                <?php } else { ?>
                                                                                                                                                                                                                                                                                <h1 class="title__primary title__primary-small title__centered title__bordered"><?php $_block_plugin8 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin8, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin8->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Blog<?php $_block_repeat=false;
echo $_block_plugin8->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></h1>
                        <link rel="alternate" type="application/rss+xml" href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/blog/rss/" title="<?php $_block_plugin9 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin9, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin9->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Blog<?php $_block_repeat=false;
echo $_block_plugin9->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>" />
                        <?php echo $_smarty_tpl->smarty->ext->_capture->getBuffer($_smarty_tpl, 'blog_posts');?>

                                    <?php }?>
            </div>
        </div>
    </div>
</div>
<?php $_block_plugin10 = isset($_smarty_tpl->smarty->registered_plugins['block']['javascript'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['javascript'][0][0] : null;
if (!is_callable(array($_block_plugin10, '_tpl_javascript'))) {
throw new SmartyException('block tag \'javascript\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('javascript', array());
$_block_repeat=true;
echo $_block_plugin10->_tpl_javascript(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
    <?php echo '<script'; ?>
>
        $('.load-more').click(function() {
            var self = $(this);
            self.addClass('loading');
            $.get('?&page=' + self.data('page'), function(data) {
                self.removeClass('loading');
                var posts = $(data).find('.listing-item__blog');
                if (posts.length < 10) {
                    self.hide();
                }
                if (posts.length) {
                    $('.listing-item__blog').last().after(posts);
                    self.data('page', parseInt(self.data('page')) + 1);
                }
            });
        });
        $('.btn-secondary.dropdown-toggle').text($('.dropdown-menu .badge').text());
        var currentOption = $('.blog__categories__list--select option:selected').val();
        $('.blog__categories__list--select').on('change', function() {
            var newOption = $('.blog__categories__list--select option:selected').val();
            if (currentOption != newOption) {
                window.location = newOption;
            }
        })
    <?php echo '</script'; ?>
>
<?php $_block_repeat=false;
echo $_block_plugin10->_tpl_javascript(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
}
}
