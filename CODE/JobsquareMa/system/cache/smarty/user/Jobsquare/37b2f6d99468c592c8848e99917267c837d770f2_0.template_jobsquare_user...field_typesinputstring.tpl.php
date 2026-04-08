<?php
/* Smarty version 4.3.0, created on 2026-02-28 23:48:32
  from 'template_jobsquare_user:..field_typesinputstring.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a37ed08ab5f9_94830194',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '37b2f6d99468c592c8848e99917267c837d770f2' => 
    array (
      0 => 'template_jobsquare_user:..field_typesinputstring.tpl',
      1 => 1771678926,
      2 => 'template_jobsquare_user',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69a37ed08ab5f9_94830194 (Smarty_Internal_Template $_smarty_tpl) {
?><input id="<?php if ($_smarty_tpl->tpl_vars['parentID']->value) {
echo $_smarty_tpl->tpl_vars['parentID']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['id']->value;
} else {
echo $_smarty_tpl->tpl_vars['id']->value;
}?>" type="text" value="<?php echo $_smarty_tpl->tpl_vars['value']->value;?>
" class="form-control <?php if ($_smarty_tpl->tpl_vars['complexField']->value) {?>complexField<?php }?>" name="<?php if ($_smarty_tpl->tpl_vars['complexField']->value) {
echo $_smarty_tpl->tpl_vars['complexField']->value;?>
[<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
][<?php echo $_smarty_tpl->tpl_vars['complexStep']->value;?>
]<?php } elseif ($_smarty_tpl->tpl_vars['parentID']->value) {
echo $_smarty_tpl->tpl_vars['id']->value;
} else {
echo $_smarty_tpl->tpl_vars['id']->value;
}?>" <?php if ($_smarty_tpl->tpl_vars['id']->value == 'id_Job_MotsCls') {?> data-role="tagsinput"<?php }?>/>
<?php }
}
