<?php
/* Smarty version 4.3.0, created on 2026-02-27 14:04:47
  from 'template_jobsquare_user:..miscellaneouscontact_form_index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a1a47f20f9b6_77849777',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '652232dc73522e6ceec4ed2a657023faf210c2ee' => 
    array (
      0 => 'template_jobsquare_user:..miscellaneouscontact_form_index.tpl',
      1 => 1771678926,
      2 => 'template_jobsquare_user',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69a1a47f20f9b6_77849777 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_205151884169a1a47f209248_92744520', 'main_content');
$_smarty_tpl->inheritance->endChild($_smarty_tpl, '../main/index.tpl');
}
/* {block 'main_content'} */
class Block_205151884169a1a47f209248_92744520 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'main_content' => 
  array (
    0 => 'Block_205151884169a1a47f209248_92744520',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php 
$_smarty_tpl->inheritance->callParent($_smarty_tpl, $this, '{$smarty.block.parent}');
?>

	<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['module'][0], array( array('name'=>'miscellaneous','function'=>'contact_form'),$_smarty_tpl ) );?>

<?php
}
}
/* {/block 'main_content'} */
}
