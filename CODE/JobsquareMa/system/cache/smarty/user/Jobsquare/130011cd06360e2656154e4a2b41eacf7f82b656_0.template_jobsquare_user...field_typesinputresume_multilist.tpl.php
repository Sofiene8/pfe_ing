<?php
/* Smarty version 4.3.0, created on 2026-02-28 23:48:32
  from 'template_jobsquare_user:..field_typesinputresume_multilist.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a37ed0883ff9_15784646',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '130011cd06360e2656154e4a2b41eacf7f82b656' => 
    array (
      0 => 'template_jobsquare_user:..field_typesinputresume_multilist.tpl',
      1 => 1771678926,
      2 => 'template_jobsquare_user',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69a37ed0883ff9_15784646 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['id']->value == "EmploymentType") {
$_smarty_tpl->_assignInScope('totalEmptype', 0);?> 
 <?php $_smarty_tpl->_assignInScope('selectedval', '');?>
 <?php $_smarty_tpl->_assignInScope('Isselectedval', 0);?>
 

<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list_values']->value, 'list_value');
$_smarty_tpl->tpl_vars['list_value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['list_value']->value) {
$_smarty_tpl->tpl_vars['list_value']->do_else = false;
?>
     
	 <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['value']->value, 'value_id');
$_smarty_tpl->tpl_vars['value_id']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['value_id']->value) {
$_smarty_tpl->tpl_vars['value_id']->do_else = false;
?>
			 
			 <?php if ($_smarty_tpl->tpl_vars['list_value']->value['id'] == $_smarty_tpl->tpl_vars['value_id']->value) {?>
				
					<?php if ($_smarty_tpl->tpl_vars['selectedval']->value == '') {?>
						   <?php $_smarty_tpl->_assignInScope('selectedval', $_smarty_tpl->tpl_vars['value_id']->value);?>  
						   
						
					<?php } else { ?>		
						 
						   <?php $_smarty_tpl->_assignInScope('selectedval', ((string)$_smarty_tpl->tpl_vars['selectedval']->value).",".((string)$_smarty_tpl->tpl_vars['value_id']->value));?>   			
						 
					 
					
					<?php }?>
					  <?php $_smarty_tpl->_assignInScope('Isselectedval', 1);?>
		
			<?php break 1;?>
			<?php } else { ?>
				   <?php $_smarty_tpl->_assignInScope('Isselectedval', 0);?>		 
						 
			 <?php }?>
	 <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
             <?php if ($_smarty_tpl->tpl_vars['Isselectedval']->value == 1) {?>
                   
                   <button  id="Emptype<?php echo $_smarty_tpl->tpl_vars['totalEmptype']->value;?>
" type="button" role="checkbox" class="boxed-checkbox btn btn-lg"  aria-checked="true" >
								<span id="spanEmptype<?php echo $_smarty_tpl->tpl_vars['totalEmptype']->value;?>
"  class="css-hq5oth"><?php $_block_plugin37 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin37, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array('mode'=>"raw"));
$_block_repeat=true;
echo $_block_plugin37->translate(array('mode'=>"raw"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['list_value']->value['caption'];
$_block_content37 = ob_get_clean();
$_block_repeat=false;
ob_start();
echo $_block_plugin37->translate(array('mode'=>"raw"), $_block_content37, $_smarty_tpl, $_block_repeat);
echo htmlspecialchars((string)ob_get_clean(), ENT_QUOTES, 'UTF-8', true);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></span>
								<i size="20" style="margin-left: 10px;" class="css-tjx49 e19xi9jy0">
									<svg id="svgEmptype<?php echo $_smarty_tpl->tpl_vars['totalEmptype']->value;?>
" width="20" height="20" preserveAspectRatio="none" viewBox="0 0 24 24">
									  

									  <path fill="#0055D9" d="M18.933 7.438a.456.456 0 01.067.187.456.456 0 01-.067.188l-8.38 10c-.135.125-.236.187-.303.187-.112 0-.224-.052-.337-.156l-4.745-4.25-.1-.094A.456.456 0 015 13.312c0-.02.022-.072.067-.156l.068-.062a63.944 63.944 0 011.48-1.438c.135-.125.225-.187.27-.187.09 0 .202.062.336.187l2.692 2.438 6.731-8.031c.045-.042.112-.063.202-.063.067 0 .146.02.236.063l1.85 1.375z"></path>
  								


								</svg>
								</i>
							</button>
							
							<?php } else { ?>
							<button id="Emptype<?php echo $_smarty_tpl->tpl_vars['totalEmptype']->value;?>
" type="button" role="checkbox" class="boxed-checkbox btn btn-lg"  aria-checked="false">
								<span id="spanEmptype<?php echo $_smarty_tpl->tpl_vars['totalEmptype']->value;?>
" class="css-1lylxjf"><?php $_block_plugin38 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin38, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array('mode'=>"raw"));
$_block_repeat=true;
echo $_block_plugin38->translate(array('mode'=>"raw"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['list_value']->value['caption'];
$_block_content38 = ob_get_clean();
$_block_repeat=false;
ob_start();
echo $_block_plugin38->translate(array('mode'=>"raw"), $_block_content38, $_smarty_tpl, $_block_repeat);
echo htmlspecialchars((string)ob_get_clean(), ENT_QUOTES, 'UTF-8', true);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></span>
								<i size="20" style="margin-left: 10px;" class="css-tjx49 e19xi9jy0">
									<svg id="svgEmptype<?php echo $_smarty_tpl->tpl_vars['totalEmptype']->value;?>
" width="20" height="20" preserveAspectRatio="none" viewBox="0 0 24 24">
										<path fill="#4D6182" d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6z"></path>
									</svg>
								</i>
							</button>										
		
			<?php }?>
			
	
		<input  name="Emptypeval<?php echo $_smarty_tpl->tpl_vars['totalEmptype']->value;?>
" id="Emptypeval<?php echo $_smarty_tpl->tpl_vars['totalEmptype']->value;?>
" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['list_value']->value['id'];?>
">
              	<?php $_smarty_tpl->_assignInScope('totalEmptype', $_smarty_tpl->tpl_vars['totalEmptype']->value+1);?> 
			
<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
<input  name="<?php if ($_smarty_tpl->tpl_vars['complexField']->value) {
echo $_smarty_tpl->tpl_vars['complexField']->value;?>
[<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
][<?php echo $_smarty_tpl->tpl_vars['complexStep']->value;?>
]<?php } else {
echo $_smarty_tpl->tpl_vars['id']->value;
}?>" id="<?php if ($_smarty_tpl->tpl_vars['complexField']->value) {
echo $_smarty_tpl->tpl_vars['complexField']->value;?>
[<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
][<?php echo $_smarty_tpl->tpl_vars['complexStep']->value;?>
]<?php } else {
echo $_smarty_tpl->tpl_vars['id']->value;
}?>" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['selectedval']->value;?>
">
<?php ob_start();
echo $_smarty_tpl->tpl_vars['totalEmptype']->value;
$_prefixVariable1 = ob_get_clean();
$_smarty_tpl->tpl_vars['foo'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['foo']->step = 1;$_smarty_tpl->tpl_vars['foo']->total = (int) ceil(($_smarty_tpl->tpl_vars['foo']->step > 0 ? $_prefixVariable1+1 - (0) : 0-($_prefixVariable1)+1)/abs($_smarty_tpl->tpl_vars['foo']->step));
if ($_smarty_tpl->tpl_vars['foo']->total > 0) {
for ($_smarty_tpl->tpl_vars['foo']->value = 0, $_smarty_tpl->tpl_vars['foo']->iteration = 1;$_smarty_tpl->tpl_vars['foo']->iteration <= $_smarty_tpl->tpl_vars['foo']->total;$_smarty_tpl->tpl_vars['foo']->value += $_smarty_tpl->tpl_vars['foo']->step, $_smarty_tpl->tpl_vars['foo']->iteration++) {
$_smarty_tpl->tpl_vars['foo']->first = $_smarty_tpl->tpl_vars['foo']->iteration === 1;$_smarty_tpl->tpl_vars['foo']->last = $_smarty_tpl->tpl_vars['foo']->iteration === $_smarty_tpl->tpl_vars['foo']->total;
$_block_plugin39 = isset($_smarty_tpl->smarty->registered_plugins['block']['javascript'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['javascript'][0][0] : null;
if (!is_callable(array($_block_plugin39, '_tpl_javascript'))) {
throw new SmartyException('block tag \'javascript\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('javascript', array());
$_block_repeat=true;
echo $_block_plugin39->_tpl_javascript(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
    <?php echo '<script'; ?>
  type="text/javascript">
	
	    $("#Emptype<?php echo $_smarty_tpl->tpl_vars['foo']->value;?>
" ).click(function() {
           
     var Strstr= document.getElementById('EmploymentType').value;
	 var values_selected = Strstr.split(',');
     var clickedval=document.getElementById('Emptypeval<?php echo $_smarty_tpl->tpl_vars['foo']->value;?>
').value;
	    if (Strstr) {
			Strstr="";
			
				
				for (var i = 0; i < values_selected.length; i++) {
                      if(clickedval!=values_selected[i])
					  {
						  if(Strstr)
						  {
							Strstr=Strstr+","+values_selected[i];
						  }
						  else
						  {
							  Strstr=values_selected[i];
						  }
					  
					  
					  }
					}
			
			
		}
					  if($("#Emptype<?php echo $_smarty_tpl->tpl_vars['foo']->value;?>
").attr('aria-checked') == 'true')
						{		
 					     
					
							$("#Emptype<?php echo $_smarty_tpl->tpl_vars['foo']->value;?>
").attr('aria-checked',false);
						    $("#Emptype<?php echo $_smarty_tpl->tpl_vars['foo']->value;?>
").removeClass('selected');
	               	        $("#spanEmptype<?php echo $_smarty_tpl->tpl_vars['foo']->value;?>
").removeClass('css-hq5oth');
						    $("#spanEmptype<?php echo $_smarty_tpl->tpl_vars['foo']->value;?>
").addClass('css-1lylxjf');
							 $("#svgEmptype<?php echo $_smarty_tpl->tpl_vars['foo']->value;?>
").replaceWith( "<svg id=\"svgEmptype<?php echo $_smarty_tpl->tpl_vars['foo']->value;?>
\" width=\"20\" height=\"20\" preserveAspectRatio=\"none\" viewBox=\"0 0 24 24\"><path fill=\"#4D6182\" d=\"M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6z\"></path></svg>" );	
					    	
						}
						else
						{
						
					        $("#Emptype<?php echo $_smarty_tpl->tpl_vars['foo']->value;?>
").attr('aria-checked',true);
							$("#Emptype<?php echo $_smarty_tpl->tpl_vars['foo']->value;?>
").addClass("selected");
						    $("#spanEmptype<?php echo $_smarty_tpl->tpl_vars['foo']->value;?>
").removeClass('css-1lylxjf');
						  $("#spanEmptype<?php echo $_smarty_tpl->tpl_vars['foo']->value;?>
").addClass('css-hq5oth');
							$("#svgEmptype<?php echo $_smarty_tpl->tpl_vars['foo']->value;?>
").replaceWith( "<svg id=\"svgEmptype<?php echo $_smarty_tpl->tpl_vars['foo']->value;?>
\" width=\"20\" height=\"20\" preserveAspectRatio=\"none\" viewBox=\"0 0 24 24\"><path fill=\"#0055D9\" d=\"M18.933 7.438a.456.456 0 01.067.187.456.456 0 01-.067.188l-8.38 10c-.135.125-.236.187-.303.187-.112 0-.224-.052-.337-.156l-4.745-4.25-.1-.094A.456.456 0 015 13.312c0-.02.022-.072.067-.156l.068-.062a63.944 63.944 0 011.48-1.438c.135-.125.225-.187.27-.187.09 0 .202.062.336.187l2.692 2.438 6.731-8.031c.045-.042.112-.063.202-.063.067 0 .146.02.236.063l1.85 1.375z\"></path></svg>" );	
						  
						  if (Strstr) {
								 Strstr=Strstr+","+clickedval;	
							}
							else
							{
								 Strstr=clickedval;	
							}
						}
	    document.getElementById('EmploymentType').value=Strstr;
	
			});
		
	
	 

 <?php echo '</script'; ?>
>
<?php $_block_repeat=false;
echo $_block_plugin39->_tpl_javascript(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
	<?php }
}
?>

<?php } else { ?>




<input type="hidden" name="<?php if ($_smarty_tpl->tpl_vars['complexField']->value) {
echo $_smarty_tpl->tpl_vars['complexField']->value;?>
[<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
][<?php echo $_smarty_tpl->tpl_vars['complexStep']->value;?>
]<?php } else {
echo $_smarty_tpl->tpl_vars['id']->value;
}?>" value=""/>
<select multiple="multiple" style="display: none;" class="form-control fieldType<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
 <?php if ($_smarty_tpl->tpl_vars['complexField']->value) {?>complexField<?php }?>" name="<?php if ($_smarty_tpl->tpl_vars['complexField']->value) {
echo $_smarty_tpl->tpl_vars['complexField']->value;?>
[<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
][<?php echo $_smarty_tpl->tpl_vars['complexStep']->value;?>
][]<?php } else {
echo $_smarty_tpl->tpl_vars['id']->value;?>
[]<?php }?>">
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list_values']->value, 'list_value');
$_smarty_tpl->tpl_vars['list_value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['list_value']->value) {
$_smarty_tpl->tpl_vars['list_value']->do_else = false;
?>
		<option  value="<?php echo $_smarty_tpl->tpl_vars['list_value']->value['id'];?>
" <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['value']->value, 'value_id');
$_smarty_tpl->tpl_vars['value_id']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['value_id']->value) {
$_smarty_tpl->tpl_vars['value_id']->do_else = false;
if ($_smarty_tpl->tpl_vars['list_value']->value['id'] == $_smarty_tpl->tpl_vars['value_id']->value) {?>selected="selected"<?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?> ><?php $_block_plugin40 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin40, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array('mode'=>"raw"));
$_block_repeat=true;
echo $_block_plugin40->translate(array('mode'=>"raw"), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['list_value']->value['caption'];
$_block_content40 = ob_get_clean();
$_block_repeat=false;
ob_start();
echo $_block_plugin40->translate(array('mode'=>"raw"), $_block_content40, $_smarty_tpl, $_block_repeat);
echo htmlspecialchars((string)ob_get_clean(), ENT_QUOTES, 'UTF-8', true);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></option>
	<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</select>
<?php $_block_plugin41 = isset($_smarty_tpl->smarty->registered_plugins['block']['javascript'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['javascript'][0][0] : null;
if (!is_callable(array($_block_plugin41, '_tpl_javascript'))) {
throw new SmartyException('block tag \'javascript\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('javascript', array());
$_block_repeat=true;
echo $_block_plugin41->_tpl_javascript(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo '<script'; ?>
 type="text/javascript">
	$(document).ready(function() {
		var limit = <?php if (!empty($_smarty_tpl->tpl_vars['choiceLimit']->value)) {
echo $_smarty_tpl->tpl_vars['choiceLimit']->value;
} else { ?>null<?php }?>;
		var name = "<?php if ($_smarty_tpl->tpl_vars['complexField']->value) {
echo $_smarty_tpl->tpl_vars['complexField']->value;?>
[<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
][<?php echo $_smarty_tpl->tpl_vars['complexStep']->value;?>
][]<?php } else {
echo $_smarty_tpl->tpl_vars['id']->value;?>
[]<?php }?>";
		var fieldId = "<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
";
		var options = {
			selectedList: 5,
			selectedText: "# <?php $_block_plugin42 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin42, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin42->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>selected<?php $_block_content42 = ob_get_clean();
$_block_repeat=false;
ob_start();
echo $_block_plugin42->translate(array(), $_block_content42, $_smarty_tpl, $_block_repeat);
echo htmlspecialchars((string)ob_get_clean(), ENT_QUOTES, 'UTF-8', true);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>",
			noneSelectedText: "<?php $_block_plugin43 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin43, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin43->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Click to select<?php $_block_content43 = ob_get_clean();
$_block_repeat=false;
ob_start();
echo $_block_plugin43->translate(array(), $_block_content43, $_smarty_tpl, $_block_repeat);
echo htmlspecialchars((string)ob_get_clean(), ENT_QUOTES, 'UTF-8', true);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>",
			checkAllText: "",
			uncheckAllText: "",
			header: true,
			height: 'auto'
		};
		$("select[name='" + name + "']").getCustomMultiList(options, fieldId, limit);
	});
<?php echo '</script'; ?>
>
<?php $_block_repeat=false;
echo $_block_plugin41->_tpl_javascript(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>


	<?php }
}
}
