<?php
/* Smarty version 4.3.0, created on 2026-03-04 11:43:28
  from 'template_jobsquare_user:Bottom_Navigation_Bar.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a81ae04b1287_61536938',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd0f47ae616a0af5522737674c876fff6ac1c39d6' => 
    array (
      0 => 'template_jobsquare_user:Bottom_Navigation_Bar.tpl',
      1 => 1772573847,
      2 => 'template_jobsquare_user',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69a81ae04b1287_61536938 (Smarty_Internal_Template $_smarty_tpl) {
?> <?php $_smarty_tpl->_assignInScope('num_results', $_smarty_tpl->tpl_vars['listing_search']->value['num_results']);?>
 <?php $_smarty_tpl->_assignInScope('current_page', $_smarty_tpl->tpl_vars['listing_search']->value['current_page']);?>
 <?php $_smarty_tpl->_assignInScope('first_page', $_smarty_tpl->tpl_vars['listing_search']->value['first_page']);?>
 <?php $_smarty_tpl->_assignInScope('last_page', $_smarty_tpl->tpl_vars['listing_search']->value['last_page']);?>
 <?php $_smarty_tpl->_assignInScope('total_pages', $_smarty_tpl->tpl_vars['listing_search']->value['total_pages']);?>

  <?php if ($_smarty_tpl->tpl_vars['total_pages']->value > 1) {?>
    <div class="sj-pagination">
      <?php if ($_smarty_tpl->tpl_vars['current_page']->value != 1) {?>
        <?php $_smarty_tpl->_assignInScope('previous_page', $_smarty_tpl->tpl_vars['current_page']->value-1);?>
        <a href="?searchId=<?php echo $_smarty_tpl->tpl_vars['searchId']->value;?>
&amp;action=search&amp;page=<?php echo $_smarty_tpl->tpl_vars['previous_page']->value;?>
" class="sj-page-btn sj-arrow">&larr;</a>
      <?php }?>

      <?php
$__section_counter_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['total_pages']->value+1) ? count($_loop) : max(0, (int) $_loop));
$__section_counter_0_start = min(1, $__section_counter_0_loop);
$__section_counter_0_total = min(($__section_counter_0_loop - $__section_counter_0_start), $__section_counter_0_loop);
$_smarty_tpl->tpl_vars['__smarty_section_counter'] = new Smarty_Variable(array());
if ($__section_counter_0_total !== 0) {
for ($__section_counter_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_counter']->value['index'] = $__section_counter_0_start; $__section_counter_0_iteration <= $__section_counter_0_total; $__section_counter_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_counter']->value['index']++){
?>
        <?php $_smarty_tpl->_assignInScope('page', (isset($_smarty_tpl->tpl_vars['__smarty_section_counter']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_counter']->value['index'] : null));?>
        <?php if ($_smarty_tpl->tpl_vars['page']->value >= $_smarty_tpl->tpl_vars['first_page']->value && $_smarty_tpl->tpl_vars['page']->value <= $_smarty_tpl->tpl_vars['last_page']->value) {?>
          <?php if ($_smarty_tpl->tpl_vars['page']->value == $_smarty_tpl->tpl_vars['current_page']->value) {?>
            <span class="sj-page-btn active"><?php echo $_smarty_tpl->tpl_vars['page']->value;?>
</span>
          <?php } else { ?>
            <a href="?searchId=<?php echo $_smarty_tpl->tpl_vars['searchId']->value;?>
&amp;action=search&amp;page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
" class="sj-page-btn"><?php echo $_smarty_tpl->tpl_vars['page']->value;?>
</a>
          <?php }?>
        <?php }?>
      <?php
}
}
?>

      <?php if ($_smarty_tpl->tpl_vars['current_page']->value < $_smarty_tpl->tpl_vars['total_pages']->value) {?>
        <?php $_smarty_tpl->_assignInScope('next_page', $_smarty_tpl->tpl_vars['current_page']->value+1);?>
        <a href="?searchId=<?php echo $_smarty_tpl->tpl_vars['searchId']->value;?>
&amp;action=search&amp;page=<?php echo $_smarty_tpl->tpl_vars['next_page']->value;?>
" class="sj-page-btn sj-arrow">&rarr;</a>
      <?php }?>
    </div>
  <?php }
}
}
