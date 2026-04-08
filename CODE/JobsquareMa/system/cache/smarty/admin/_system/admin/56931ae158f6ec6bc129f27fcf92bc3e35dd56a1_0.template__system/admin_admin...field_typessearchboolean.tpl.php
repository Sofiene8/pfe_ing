<?php
/* Smarty version 4.3.0, created on 2026-03-04 08:57:40
  from 'template__system/admin_admin:..field_typessearchboolean.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a7f404cb0bf4_56415188',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '56931ae158f6ec6bc129f27fcf92bc3e35dd56a1' => 
    array (
      0 => 'template__system/admin_admin:..field_typessearchboolean.tpl',
      1 => 1771678927,
      2 => 'template__system/admin_admin',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69a7f404cb0bf4_56415188 (Smarty_Internal_Template $_smarty_tpl) {
?><label class="cr-styled">
    <input type="checkbox" name="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
[equal]" <?php if ($_smarty_tpl->tpl_vars['value']->value['equal'] == '1') {?>checked="checked"<?php }?> value="1"/>
    <i class="fa"></i>
</label><?php }
}
