<?php
/* Smarty version 4.3.0, created on 2026-02-28 23:48:32
  from 'template_jobsquare_user:..field_typesinputinteger.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a37ed08fcd63_00095487',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '414a8eb67389e86b9c2bea28fcef73e34728e9f1' => 
    array (
      0 => 'template_jobsquare_user:..field_typesinputinteger.tpl',
      1 => 1771678926,
      2 => 'template_jobsquare_user',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69a37ed08fcd63_00095487 (Smarty_Internal_Template $_smarty_tpl) {
?><input type="text" class="inputInteger form-control <?php if ($_smarty_tpl->tpl_vars['complexField']->value) {?>complexField<?php }?>" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['value']->value, ENT_QUOTES, 'UTF-8', true);?>
" name="<?php if ($_smarty_tpl->tpl_vars['complexField']->value) {
echo $_smarty_tpl->tpl_vars['complexField']->value;?>
[<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
][<?php echo $_smarty_tpl->tpl_vars['complexStep']->value;?>
]<?php } else {
echo $_smarty_tpl->tpl_vars['id']->value;
}?>" /><?php }
}
