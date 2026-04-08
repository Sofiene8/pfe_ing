<?php
/* Smarty version 4.3.0, created on 2026-03-04 08:22:32
  from 'template_jobsquare_user:..field_typessearchgoogle_place.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a7ebc8daedc2_92705349',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9401d0628dd82b7d6cfb525aaae9db39c14f0aa1' => 
    array (
      0 => 'template_jobsquare_user:..field_typessearchgoogle_place.tpl',
      1 => 1772573916,
      2 => 'template_jobsquare_user',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69a7ebc8daedc2_92705349 (Smarty_Internal_Template $_smarty_tpl) {
?><input type="text" name="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
[location][value]" id="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['value']->value['location']['value'];?>
" placeholder="<?php $_block_plugin3 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin3, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin3->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Location<?php $_block_content3 = ob_get_clean();
$_block_repeat=false;
ob_start();
echo $_block_plugin3->translate(array(), $_block_content3, $_smarty_tpl, $_block_repeat);
echo htmlspecialchars((string)ob_get_clean(), ENT_QUOTES, 'UTF-8', true);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>"/>
<!--<input type="text" name="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
[location][value]" id="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" class="form-control form-control__google-location" value="<?php echo $_smarty_tpl->tpl_vars['value']->value['location']['value'];?>
" placeholder="<?php $_block_plugin4 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin4, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin4->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Location<?php $_block_content4 = ob_get_clean();
$_block_repeat=false;
ob_start();
echo $_block_plugin4->translate(array(), $_block_content4, $_smarty_tpl, $_block_repeat);
echo htmlspecialchars((string)ob_get_clean(), ENT_QUOTES, 'UTF-8', true);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>"/>-->
<input type="hidden" name="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
[location][radius]" value="<?php if ($_smarty_tpl->tpl_vars['value']->value['location']['radius']) {
echo $_smarty_tpl->tpl_vars['value']->value['location']['radius'];
} else { ?>50<?php }?>" id="radius" class="hidden-radius"/>
<?php $_block_plugin5 = isset($_smarty_tpl->smarty->registered_plugins['block']['javascript'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['javascript'][0][0] : null;
if (!is_callable(array($_block_plugin5, '_tpl_javascript'))) {
throw new SmartyException('block tag \'javascript\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('javascript', array());
$_block_repeat=true;
echo $_block_plugin5->_tpl_javascript(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
    <?php echo '<script'; ?>
>
      /*   function initService() {
            var input =($('.form-control__google-location'));
            var options = {
                componentRestrictions: {
                    <?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['settings']['location_limit']) {?>
                        country: '<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['settings']['location_limit'];?>
'
                    <?php }?>
                }
            };

            for(var i=0; i<input.length; i++){
                new google.maps.places.Autocomplete(input[i], options);
            }

        }

       $('#ajax-refine-search').on('click', '.refine-search__item-radius', function(e) {
            e.preventDefault();
            var radiusValue = $(this).data('value');

            $('.hidden-radius').each(function() {
                $(this).val(radiusValue);
            });

            $('#refine-block-radius .dropdown-toggle').text($(this).data('value') + ' <?php $_block_plugin6 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin6, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin6->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['GLOBALS']->value['settings']['radius_search_unit'];
$_block_repeat=false;
echo $_block_plugin6->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>');
            $('.quick-search__wrapper').find('form').submit();
        });

        $('#<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
').keydown(function (e) {
            if (e.which == 13 && $('.pac-container:visible').length) {
                return false;
            }
        });*/
    <?php echo '</script'; ?>
>
<?php $_block_repeat=false;
echo $_block_plugin5->_tpl_javascript(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
}
}
