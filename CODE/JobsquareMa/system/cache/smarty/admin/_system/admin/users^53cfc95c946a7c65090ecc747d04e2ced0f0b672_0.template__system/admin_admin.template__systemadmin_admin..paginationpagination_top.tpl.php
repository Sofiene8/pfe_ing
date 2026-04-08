<?php
/* Smarty version 4.3.0, created on 2026-03-04 22:49:06
  from 'template__system/admin_admin:template__systemadmin_admin..paginationpagination_top.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a8b6e283ac26_52646373',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '53cfc95c946a7c65090ecc747d04e2ced0f0b672' => 
    array (
      0 => 'template__system/admin_admin:template__systemadmin_admin..paginationpagination_top.tpl',
      1 => 1771678928,
      2 => 'template__system/admin_admin',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69a8b6e283ac26_52646373 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\JobsquareMa\\system\\ext\\Smarty\\libs\\plugins\\modifier.escape.php','function'=>'smarty_modifier_escape',),));
$_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, "urlParams", null, null);
if (is_array($_smarty_tpl->tpl_vars['paginationInfo']->value['uniqueUrlParams'])) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['paginationInfo']->value['uniqueUrlParams'], 'param', false, 'id');
$_smarty_tpl->tpl_vars['param']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['param']->value) {
$_smarty_tpl->tpl_vars['param']->do_else = false;
?>&amp;<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
=<?php if ($_smarty_tpl->tpl_vars['param']->value['escape']) {
echo smarty_modifier_escape($_smarty_tpl->tpl_vars['param']->value['value'], ((string)$_smarty_tpl->tpl_vars['param']->value['escape']));
} else {
echo $_smarty_tpl->tpl_vars['param']->value['value'];
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
} else { ?>&amp;<?php echo $_smarty_tpl->tpl_vars['paginationInfo']->value['uniqueUrlParams'];
}
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
<div class="items-count"><strong><?php echo $_smarty_tpl->tpl_vars['paginationInfo']->value['itemsCount'];?>
</strong> <?php $_block_plugin19 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin19, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin19->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['paginationInfo']->value['item'], ENT_QUOTES, 'UTF-8', true);?>
 found<?php $_block_repeat=false;
echo $_block_plugin19->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></div>
<?php if ($_smarty_tpl->tpl_vars['paginationInfo']->value['actionsForSelect']) {?>
    <?php if (count($_smarty_tpl->tpl_vars['paginationInfo']->value['actionsForSelect']) == 1) {?>
        <div class="action-with-selected">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['paginationInfo']->value['actionsForSelect'], 'action', false, 'value');
$_smarty_tpl->tpl_vars['action']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['value']->value => $_smarty_tpl->tpl_vars['action']->value) {
$_smarty_tpl->tpl_vars['action']->do_else = false;
?>
                <input type="button" value="<?php $_block_plugin20 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin20, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin20->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['action']->value;
$_block_repeat=false;
echo $_block_plugin20->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>" class="<?php if ($_smarty_tpl->tpl_vars['value']->value == 'delete') {?>btn btn--danger<?php } else { ?>btn btn--secondary<?php }?>" onclick="<?php if ($_smarty_tpl->tpl_vars['paginationInfo']->value['popUp'] == true) {?>isPopUp('<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['paginationInfo']->value['translatedText']['chooseItem'], ENT_QUOTES, 'UTF-8', true);?>
', '<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['paginationInfo']->value['translatedText']['delete'], ENT_QUOTES, 'UTF-8', true);?>
');<?php } else { ?>goSingleButton('<?php echo $_smarty_tpl->tpl_vars['value']->value;?>
', '<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['paginationInfo']->value['translatedText']['chooseItem'], ENT_QUOTES, 'UTF-8', true);?>
', '<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['paginationInfo']->value['translatedText']['delete'], ENT_QUOTES, 'UTF-8', true);?>
');<?php }?>" />
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </div>
    <?php } else { ?>
        <div class="bulk">
            <?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == "/manage-invoices/") {?>
                <button class="btn btn-default bulk-action" name="selectedAction_<?php echo $_smarty_tpl->tpl_vars['layout']->value;?>
" data-action="paid">
                    <?php $_block_plugin21 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin21, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin21->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Mark paid<?php $_block_repeat=false;
echo $_block_plugin21->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
                </button>
                <button class="btn btn-default bulk-action" name="selectedAction_<?php echo $_smarty_tpl->tpl_vars['layout']->value;?>
" data-action="unpaid">
                    <?php $_block_plugin22 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin22, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin22->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Mark unpaid<?php $_block_repeat=false;
echo $_block_plugin22->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
                </button>
            <?php } else { ?>
                <button class="btn btn-default bulk-action" name="selectedAction_<?php echo $_smarty_tpl->tpl_vars['layout']->value;?>
" data-action="activate">
                    <i class="fa fa-eye" aria-hidden="true"></i> <?php $_block_plugin23 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin23, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin23->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Activate<?php $_block_repeat=false;
echo $_block_plugin23->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
                </button>
                <button class="btn btn-default bulk-action" name="selectedAction_<?php echo $_smarty_tpl->tpl_vars['layout']->value;?>
" data-action="deactivate">
                    <i class="fa fa-eye-slash" aria-hidden="true"></i> <?php $_block_plugin24 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin24, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin24->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Deactivate<?php $_block_repeat=false;
echo $_block_plugin24->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
                </button>
            <?php }?>
            <button class="btn btn-default bulk-action" name="selectedAction_<?php echo $_smarty_tpl->tpl_vars['layout']->value;?>
" data-action="delete">
                <i class="fa fa-trash-o" aria-hidden="true"></i> <?php $_block_plugin25 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin25, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin25->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Delete<?php $_block_repeat=false;
echo $_block_plugin25->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
            </button>
        </div>
    <?php }
}?>

<div class="pagination__right">
    <div class="number-per-page">
        <select id="itemsPerPage" name="itemsPerPage" onchange="window.location = '?<?php if ($_smarty_tpl->tpl_vars['paginationInfo']->value['restore'] == 1) {?>restore=1<?php }
if ($_smarty_tpl->tpl_vars['paginationInfo']->value['sortingField'] != null) {?>&amp;sortingField=<?php echo $_smarty_tpl->tpl_vars['paginationInfo']->value['sortingField'];
}
if ($_smarty_tpl->tpl_vars['paginationInfo']->value['sortingOrder'] != null) {?>&amp;sortingOrder=<?php echo $_smarty_tpl->tpl_vars['paginationInfo']->value['sortingOrder'];
}?>&amp;page=1<?php if ($_smarty_tpl->tpl_vars['paginationInfo']->value['uniqueUrlParams']) {
echo $_smarty_tpl->smarty->ext->_capture->getBuffer($_smarty_tpl, 'urlParams');
}?>&amp;itemsPerPage=' + this.value;" class="per-page">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['paginationInfo']->value['numberOfElementsPageSelect'], 'numberOfElement');
$_smarty_tpl->tpl_vars['numberOfElement']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['numberOfElement']->value) {
$_smarty_tpl->tpl_vars['numberOfElement']->do_else = false;
?>
                <option value="<?php echo $_smarty_tpl->tpl_vars['numberOfElement']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['paginationInfo']->value['itemsPerPage'] == $_smarty_tpl->tpl_vars['numberOfElement']->value) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['numberOfElement']->value;?>
</option>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </select>
        <?php $_block_plugin26 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin26, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin26->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>per page<?php $_block_repeat=false;
echo $_block_plugin26->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
    </div>
    <?php if (count($_smarty_tpl->tpl_vars['paginationInfo']->value['pages']) != 1) {?>
        <ul class="pagination row">
            <?php if ($_smarty_tpl->tpl_vars['paginationInfo']->value['currentPage'] == 1) {?>
                <li class="none">
                    <a href="#">&nbsp;<i class="fa fa-angle-left"></i></a>
                </li>
            <?php } else { ?>
                <li>
                    <a class="arrow-left"  href="?<?php if ($_smarty_tpl->tpl_vars['paginationInfo']->value['restore'] == 1) {?>restore=1<?php }?>&amp;page=<?php echo $_smarty_tpl->tpl_vars['paginationInfo']->value['currentPage']-1;?>
&amp;itemsPerPage=<?php echo $_smarty_tpl->tpl_vars['paginationInfo']->value['itemsPerPage'];
if ($_smarty_tpl->tpl_vars['paginationInfo']->value['uniqueUrlParams']) {
echo $_smarty_tpl->smarty->ext->_capture->getBuffer($_smarty_tpl, 'urlParams');
}?>">
                        &nbsp;<i class="fa fa-angle-left"></i>
                    </a>
                </li>
            <?php }?>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['paginationInfo']->value['pages'], 'page');
$_smarty_tpl->tpl_vars['page']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['page']->value) {
$_smarty_tpl->tpl_vars['page']->do_else = false;
?>
                <?php if ($_smarty_tpl->tpl_vars['page']->value == $_smarty_tpl->tpl_vars['paginationInfo']->value['currentPage']) {?>
                    <li class="active">
                        <a href="#"><?php echo $_smarty_tpl->tpl_vars['page']->value;?>
</a>
                    </li>
                <?php } else { ?>
                    <?php if ($_smarty_tpl->tpl_vars['page']->value == $_smarty_tpl->tpl_vars['paginationInfo']->value['totalPages'] && $_smarty_tpl->tpl_vars['paginationInfo']->value['currentPage'] < $_smarty_tpl->tpl_vars['paginationInfo']->value['totalPages']-3) {?> <li><span>...</span></li> <?php }?>
                    <li><a href="?page=<?php echo $_smarty_tpl->tpl_vars['page']->value;
if ($_smarty_tpl->tpl_vars['paginationInfo']->value['restore'] == 1) {?>&amp;restore=1<?php }
if ($_smarty_tpl->tpl_vars['paginationInfo']->value['sortingField'] != null) {?>&amp;sortingField=<?php echo $_smarty_tpl->tpl_vars['paginationInfo']->value['sortingField'];
}
if ($_smarty_tpl->tpl_vars['paginationInfo']->value['sortingOrder'] != null) {?>&amp;sortingOrder=<?php echo $_smarty_tpl->tpl_vars['paginationInfo']->value['sortingOrder'];
}?>&amp;itemsPerPage=<?php echo $_smarty_tpl->tpl_vars['paginationInfo']->value['itemsPerPage'];
if ($_smarty_tpl->tpl_vars['paginationInfo']->value['uniqueUrlParams']) {
echo $_smarty_tpl->smarty->ext->_capture->getBuffer($_smarty_tpl, 'urlParams');
}?>"><?php echo $_smarty_tpl->tpl_vars['page']->value;?>
</a></li>
                    <?php if ($_smarty_tpl->tpl_vars['page']->value == 1 && $_smarty_tpl->tpl_vars['paginationInfo']->value['currentPage'] > 4) {?> <li><span>...</span></li> <?php }?>
                <?php }?>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>


            <?php if ($_smarty_tpl->tpl_vars['paginationInfo']->value['currentPage'] == $_smarty_tpl->tpl_vars['paginationInfo']->value['totalPages']) {?>
                <li>
                    <a href="#">&nbsp;<i class="fa fa-angle-right"></i></a>
                </li>
            <?php } else { ?>
                <li>
                    <a class="arrow-right" href="?<?php if ($_smarty_tpl->tpl_vars['paginationInfo']->value['restore'] == 1) {?>restore=1<?php }?>&amp;page=<?php echo $_smarty_tpl->tpl_vars['paginationInfo']->value['currentPage']+1;?>
&amp;itemsPerPage=<?php echo $_smarty_tpl->tpl_vars['paginationInfo']->value['itemsPerPage'];
if ($_smarty_tpl->tpl_vars['paginationInfo']->value['uniqueUrlParams']) {
echo $_smarty_tpl->smarty->ext->_capture->getBuffer($_smarty_tpl, 'urlParams');
}?>">
                        &nbsp;<i class="fa fa-angle-right"></i>
                    </a>
                </li>
            <?php }?>
        </ul>
    <?php }?>
</div>

<div class="modal fade" id="action-modal" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <br/>
            </div>
            <div class="modal-body text-center">
            </div>
        </div>
    </div>
</div><?php }
}
