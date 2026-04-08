<?php
/* Smarty version 4.3.0, created on 2026-02-28 23:48:32
  from 'template_jobsquare_user:..field_typesinputresume_list.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a37ed083d242_80220497',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '703c7d1d53f78404f1009bbb323c3ad812708acb' => 
    array (
      0 => 'template_jobsquare_user:..field_typesinputresume_list.tpl',
      1 => 1771678926,
      2 => 'template_jobsquare_user',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69a37ed083d242_80220497 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['id']->value == "id_Resume_careerlevel") {
$_smarty_tpl->_assignInScope('totalCareerlevel', 0);?> 
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list_values']->value, 'list_value');
$_smarty_tpl->tpl_vars['list_value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['list_value']->value) {
$_smarty_tpl->tpl_vars['list_value']->do_else = false;
?>
 
            		 
			 <span class="boxedSingleItem css-1gapyfo">
									<div id="Careerlevel<?php echo $_smarty_tpl->tpl_vars['totalCareerlevel']->value;?>
"tabindex="0" class="<?php if ($_smarty_tpl->tpl_vars['list_value']->value['id'] == $_smarty_tpl->tpl_vars['value']->value) {?>selected<?php }?>"  onclick="Setlevel(<?php echo $_smarty_tpl->tpl_vars['totalCareerlevel']->value;?>
,<?php echo $_smarty_tpl->tpl_vars['list_value']->value['id'];?>
)">
										<div class="panel-body">
											<p class="title"><?php $_block_plugin30 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin30, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array('mode'=>"raw"));
$_block_repeat=true;
echo $_block_plugin30->translate(array('mode'=>"raw"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['list_value']->value['caption'];
$_block_content30 = ob_get_clean();
$_block_repeat=false;
ob_start();
echo $_block_plugin30->translate(array('mode'=>"raw"), $_block_content30, $_smarty_tpl, $_block_repeat);
echo htmlspecialchars((string)ob_get_clean(), ENT_QUOTES, 'UTF-8', true);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></p>
											
										</div>
									</div>
								</span>
							
			 
				<?php $_smarty_tpl->_assignInScope('totalCareerlevel', $_smarty_tpl->tpl_vars['totalCareerlevel']->value+1);?> 	
		     <?php if ($_smarty_tpl->tpl_vars['list_value']->value['id'] == $_smarty_tpl->tpl_vars['value']->value) {?>
			 <?php $_smarty_tpl->_assignInScope('selectedval', $_smarty_tpl->tpl_vars['list_value']->value['id']);?> 
			  <?php }?>		
<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	
<input  name="<?php if ($_smarty_tpl->tpl_vars['parentID']->value) {
echo $_smarty_tpl->tpl_vars['parentID']->value;?>
[<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
]<?php } else {
echo $_smarty_tpl->tpl_vars['id']->value;
}?>" id="<?php if ($_smarty_tpl->tpl_vars['parentID']->value) {
echo $_smarty_tpl->tpl_vars['parentID']->value;?>
[<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
]<?php } else {
echo $_smarty_tpl->tpl_vars['id']->value;
}?>" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['selectedval']->value;?>
">
<?php $_block_plugin31 = isset($_smarty_tpl->smarty->registered_plugins['block']['javascript'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['javascript'][0][0] : null;
if (!is_callable(array($_block_plugin31, '_tpl_javascript'))) {
throw new SmartyException('block tag \'javascript\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('javascript', array());
$_block_repeat=true;
echo $_block_plugin31->_tpl_javascript(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
    <?php echo '<script'; ?>
  type="text/javascript">
	
	      function Setlevel(id,val) {                  
                  

				  var elem = document.getElementById('Careerlevel'+id);
				   elem.classList.remove("selected");
				   elem.classList.add("selected");
				   
				  for (i = 0; i < <?php echo $_smarty_tpl->tpl_vars['totalCareerlevel']->value;?>
	; i++) { 
                         var elem1 = document.getElementById('Careerlevel'+i);
						 if(i!=id)
						 {				 
						 
						 
				               elem1.classList.remove("selected");
						 }
				  
				   
					} 
				   document.getElementById('id_Resume_careerlevel').value=val;
           
                
          
        }
    <?php echo '</script'; ?>
>
<?php $_block_repeat=false;
echo $_block_plugin31->_tpl_javascript(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
} elseif ($_smarty_tpl->tpl_vars['id']->value == "Experience") {
$_smarty_tpl->_assignInScope('totalExperience', 0);?> 
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list_values']->value, 'list_value');
$_smarty_tpl->tpl_vars['list_value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['list_value']->value) {
$_smarty_tpl->tpl_vars['list_value']->do_else = false;
?>
 
            		 
			 <span class="boxedSingleItem css-1gapyfo">
									<div id="Experience<?php echo $_smarty_tpl->tpl_vars['totalExperience']->value;?>
"tabindex="0" class="<?php if ($_smarty_tpl->tpl_vars['list_value']->value['id'] == $_smarty_tpl->tpl_vars['value']->value) {?>selected<?php }?>"  onclick="SetExperience(<?php echo $_smarty_tpl->tpl_vars['totalExperience']->value;?>
,<?php echo $_smarty_tpl->tpl_vars['list_value']->value['id'];?>
)">
										<div class="panel-body">
											<p class="title"><?php $_block_plugin32 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin32, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array('mode'=>"raw"));
$_block_repeat=true;
echo $_block_plugin32->translate(array('mode'=>"raw"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['list_value']->value['caption'];
$_block_content32 = ob_get_clean();
$_block_repeat=false;
ob_start();
echo $_block_plugin32->translate(array('mode'=>"raw"), $_block_content32, $_smarty_tpl, $_block_repeat);
echo htmlspecialchars((string)ob_get_clean(), ENT_QUOTES, 'UTF-8', true);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></p>
											
										</div>
									</div>
								</span>
							
			 
				<?php $_smarty_tpl->_assignInScope('totalExperience', $_smarty_tpl->tpl_vars['totalExperience']->value+1);?> 	
		     <?php if ($_smarty_tpl->tpl_vars['list_value']->value['id'] == $_smarty_tpl->tpl_vars['value']->value) {?>
			 <?php $_smarty_tpl->_assignInScope('selectedval', $_smarty_tpl->tpl_vars['list_value']->value['id']);?> 
			  <?php }?>		
<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	
<input  name="<?php if ($_smarty_tpl->tpl_vars['parentID']->value) {
echo $_smarty_tpl->tpl_vars['parentID']->value;?>
[<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
]<?php } else {
echo $_smarty_tpl->tpl_vars['id']->value;
}?>" id="<?php if ($_smarty_tpl->tpl_vars['parentID']->value) {
echo $_smarty_tpl->tpl_vars['parentID']->value;?>
[<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
]<?php } else {
echo $_smarty_tpl->tpl_vars['id']->value;
}?>" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['selectedval']->value;?>
">
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
	
	      function SetExperience(id,val) {                  
                  

				  var elem = document.getElementById('Experience'+id);
				   elem.classList.remove("selected");
				   elem.classList.add("selected");
				   
				  for (i = 0; i < <?php echo $_smarty_tpl->tpl_vars['totalExperience']->value;?>
	; i++) { 
                         var elem1 = document.getElementById('Experience'+i);
						 if(i!=id)
						 {				 
						 
						 
				               elem1.classList.remove("selected");
						 }
				  
				   
					} 
				   document.getElementById('Experience').value=val;
           
                
          
        }
    <?php echo '</script'; ?>
>
<?php $_block_repeat=false;
echo $_block_plugin33->_tpl_javascript(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
	
	
	<?php } else { ?>


<select class="form-control" name="<?php if ($_smarty_tpl->tpl_vars['parentID']->value) {
echo $_smarty_tpl->tpl_vars['parentID']->value;?>
[<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
]<?php } else {
echo $_smarty_tpl->tpl_vars['id']->value;
}?>" <?php if ($_smarty_tpl->tpl_vars['parentID']->value && !$_smarty_tpl->tpl_vars['list_values']->value && !$_smarty_tpl->tpl_vars['enabled']->value) {?> disabled="disabled" <?php }?> <?php if ($_smarty_tpl->tpl_vars['parentID']->value && $_smarty_tpl->tpl_vars['id']->value == "Country") {?> onchange = "get<?php echo $_smarty_tpl->tpl_vars['parentID']->value;?>
States(this.value)" <?php }?> >
	<?php if ($_smarty_tpl->tpl_vars['id']->value !== 'email_frequency') {?><option value=""><?php $_block_plugin34 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin34, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin34->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Select<?php $_block_repeat=false;
echo $_block_plugin34->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?> <?php $_block_plugin35 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin35, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin35->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['caption']->value;
$_block_content35 = ob_get_clean();
$_block_repeat=false;
ob_start();
echo $_block_plugin35->translate(array(), $_block_content35, $_smarty_tpl, $_block_repeat);
echo htmlspecialchars((string)ob_get_clean(), ENT_QUOTES, 'UTF-8', true);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></option><?php }?>
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list_values']->value, 'list_value');
$_smarty_tpl->tpl_vars['list_value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['list_value']->value) {
$_smarty_tpl->tpl_vars['list_value']->do_else = false;
?>
		<option value="<?php echo $_smarty_tpl->tpl_vars['list_value']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['list_value']->value['id'] == $_smarty_tpl->tpl_vars['value']->value) {?>selected="selected"<?php }?> ><?php $_block_plugin36 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin36, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array('mode'=>"raw"));
$_block_repeat=true;
echo $_block_plugin36->translate(array('mode'=>"raw"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['list_value']->value['caption'];
$_block_content36 = ob_get_clean();
$_block_repeat=false;
ob_start();
echo $_block_plugin36->translate(array('mode'=>"raw"), $_block_content36, $_smarty_tpl, $_block_repeat);
echo htmlspecialchars((string)ob_get_clean(), ENT_QUOTES, 'UTF-8', true);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></option>
	<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</select>
<?php }
}
}
