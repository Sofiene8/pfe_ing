<?php
/* Smarty version 4.3.0, created on 2026-02-28 23:48:32
  from 'template_jobsquare_user:..field_typesinputlet_employers_find_my_resume.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a37ed094bec3_10398530',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '648dac1d5f0c581e17505c4e26df1402897d9b37' => 
    array (
      0 => 'template_jobsquare_user:..field_typesinputlet_employers_find_my_resume.tpl',
      1 => 1771678926,
      2 => 'template_jobsquare_user',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69a37ed094bec3_10398530 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['id']->value == "access_type") {?>
<div id="btnaccess_type" class="switch-button <?php if ($_smarty_tpl->tpl_vars['value']->value == 'everyone') {?>is-active<?php }?>" onclick="SetAccessType()">
							<div class="switch-button__container">
								<div class="switch-button__circle"></div>
							</div>
</div>
<input type="hidden" name="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" id="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['value']->value == 'everyone') {?>value="everyone"<?php } else { ?>value="no_one"<?php }?>  />

<?php $_block_plugin51 = isset($_smarty_tpl->smarty->registered_plugins['block']['javascript'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['javascript'][0][0] : null;
if (!is_callable(array($_block_plugin51, '_tpl_javascript'))) {
throw new SmartyException('block tag \'javascript\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('javascript', array());
$_block_repeat=true;
echo $_block_plugin51->_tpl_javascript(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
    <?php echo '<script'; ?>
  type="text/javascript">
	
	      function SetAccessType() {                  
                  

				  var elem = document.getElementById('btnaccess_type');
				
				   		
                       
						 if(document.getElementById('access_type').value=='everyone')
						 {				 
						   elem.classList.remove("is-active");
				        
						      document.getElementById('access_type').value='no_one';
						 }
						 else
					     {
							  elem.classList.remove("is-active");
				              elem.classList.add("is-active");
							    document.getElementById('access_type').value='everyone';
						 }
				 
				
           
                
          
        }
    <?php echo '</script'; ?>
>
<?php $_block_repeat=false;
echo $_block_plugin51->_tpl_javascript(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
} else { ?>

<div class="inline-block checkbox-field">
    <input type="hidden" name="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" value="no_one" />
    <input type="checkbox" class="inline-block" name="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" id="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['value']->value == 'everyone') {?>checked="checked" <?php }?> value="everyone" />
</div>

<?php }
}
}
