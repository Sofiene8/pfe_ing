<?php
/* Smarty version 4.3.0, created on 2026-03-04 11:43:29
  from 'template_jobsquare_user:CxampphtdocsJobsquareMatemplatesJobsquareclassifiedssearch_results_refine_block.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a81ae184e320_06813835',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6ffbc47916ca0c20ea46e18a0ffffe9a7c6d526b' => 
    array (
      0 => 'template_jobsquare_user:CxampphtdocsJobsquareMatemplatesJobsquareclassifiedssearch_results_refine_block.tpl',
      1 => 1772573830,
      2 => 'template_jobsquare_user',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69a81ae184e320_06813835 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/resumes/') {
if (!empty($_smarty_tpl->tpl_vars['CounterCvAccess']->value) && $_smarty_tpl->tpl_vars['listing_type']->value == "Resume") {?>
<input type="hidden" id="CounterCvAccess" name="CounterCvAccess" value="<?php if ($_smarty_tpl->tpl_vars['CounterCvAccess']->value != -1) {
echo $_smarty_tpl->tpl_vars['CounterCvAccess']->value;
} else { ?>0<?php }?>">
<div class="topcvtheque">
	<div id="results"> Il vous reste <span class="count" id="countcv"><?php if ($_smarty_tpl->tpl_vars['CounterCvAccess']->value != -1) {
echo $_smarty_tpl->tpl_vars['CounterCvAccess']->value;
} else { ?>0<?php }?></span> CV à consulter </div>
	<i class="fa fa-caret-down"></i>
</div>
<?php }
}?>

<?php if (!empty($_smarty_tpl->tpl_vars['currentSearch']->value)) {?>
	<div class="current-search" style="display:none;">
		<div class="current-search__title"><?php $_block_plugin1 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin1, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin1->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Current Search<?php $_block_repeat=false;
echo $_block_plugin1->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></div>
		<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, "urlParams", null, null);?>searchId=<?php echo rawurlencode((string)$_smarty_tpl->tpl_vars['searchId']->value);?>
&amp;action=undo<?php $_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['currentSearch']->value, 'fieldInfo', false, 'fieldID');
$_smarty_tpl->tpl_vars['fieldInfo']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['fieldID']->value => $_smarty_tpl->tpl_vars['fieldInfo']->value) {
$_smarty_tpl->tpl_vars['fieldInfo']->do_else = false;
?>
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['fieldInfo']->value['field'], 'fieldValue', false, 'fieldType');
$_smarty_tpl->tpl_vars['fieldValue']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['fieldType']->value => $_smarty_tpl->tpl_vars['fieldValue']->value) {
$_smarty_tpl->tpl_vars['fieldValue']->do_else = false;
?>
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['fieldValue']->value, 'val', false, 'realVal');
$_smarty_tpl->tpl_vars['val']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['realVal']->value => $_smarty_tpl->tpl_vars['val']->value) {
$_smarty_tpl->tpl_vars['val']->do_else = false;
?>
				<?php if ($_smarty_tpl->tpl_vars['val']->value != "0") {?>
					<a class="badge" href="?<?php echo $_smarty_tpl->smarty->ext->_capture->getBuffer($_smarty_tpl, 'urlParams');?>
&amp;param=<?php echo $_smarty_tpl->tpl_vars['fieldID']->value;?>
&amp;type=<?php echo $_smarty_tpl->tpl_vars['fieldType']->value;?>
&amp;value=<?php echo rawurlencode((string)$_smarty_tpl->tpl_vars['realVal']->value);?>
"><?php $_block_plugin2 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin2, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin2->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['val']->value;
$_block_content2 = ob_get_clean();
$_block_repeat=false;
ob_start();
echo $_block_plugin2->translate(array(), $_block_content2, $_smarty_tpl, $_block_repeat);
echo htmlspecialchars((string)ob_get_clean(), ENT_QUOTES, 'UTF-8', true);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?> <span style="font-weight:300">X</span></a>
				<?php }?>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	</div>
<?php }?>

<?php if (!empty($_smarty_tpl->tpl_vars['refineFields']->value)) {?>
	<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, "trLess", null, null);
$_block_plugin3 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin3, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin3->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Less<?php $_block_repeat=false;
echo $_block_plugin3->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
	<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, "trMore", null, null);?>Plus &rarr;<?php $_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>

	<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, "urlParams", null, null);?>searchId=<?php echo rawurlencode((string)$_smarty_tpl->tpl_vars['searchId']->value);?>
&amp;action=refine<?php $_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>

	<form id="resume_filter">
		<input type="hidden" name="action" value="refine">
		<input type="hidden" name="searchId" value="<?php echo rawurlencode((string)$_smarty_tpl->tpl_vars['searchId']->value);?>
">

		<?php if ($_smarty_tpl->tpl_vars['listing_type']->value == "Job") {?>
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['refineFields']->value, 'refineField');
$_smarty_tpl->tpl_vars['refineField']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['refineField']->value) {
$_smarty_tpl->tpl_vars['refineField']->do_else = false;
?>
			<?php if ($_smarty_tpl->tpl_vars['refineField']->value['show'] && $_smarty_tpl->tpl_vars['refineField']->value['count_results']) {?>
				<div class="sj-filter-card refine-search__block">
					<h3>
						<?php $_smarty_tpl->_assignInScope('field_caption', call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'tr' ][ 0 ], array( $_smarty_tpl->tpl_vars['refineField']->value['caption'] )));?>
						<?php $_block_plugin4 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin4, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin4->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['field_caption']->value;
$_block_content4 = ob_get_clean();
$_block_repeat=false;
ob_start();
echo $_block_plugin4->translate(array(), $_block_content4, $_smarty_tpl, $_block_repeat);
echo htmlspecialchars((string)ob_get_clean(), ENT_QUOTES, 'UTF-8', true);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
						<span class="sj-toggle" data-target="#sj-refine-<?php echo $_smarty_tpl->tpl_vars['refineField']->value['field_name'];?>
">&#9662;</span>
					</h3>
					<div id="sj-refine-<?php echo $_smarty_tpl->tpl_vars['refineField']->value['field_name'];?>
">
						<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['refineField']->value['search_result'], 'val', false, NULL, 'fieldValue', array (
  'iteration' => true,
  'total' => true,
));
$_smarty_tpl->tpl_vars['val']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['val']->value) {
$_smarty_tpl->tpl_vars['val']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_fieldValue']->value['iteration']++;
?>
							<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, "refineFieldCriteria", null, null);
echo $_smarty_tpl->tpl_vars['refineField']->value['field_name'];
if (in_array($_smarty_tpl->tpl_vars['refineField']->value['type'],array('string'))) {?>[multi_like_and]<?php } else { ?>[multi_like]<?php }?>[]=<?php if ($_smarty_tpl->tpl_vars['val']->value['sid']) {
echo $_smarty_tpl->tpl_vars['val']->value['sid'];
} else {
echo rawurlencode((string)$_smarty_tpl->tpl_vars['val']->value['value']);
}
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
							<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_fieldValue']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_fieldValue']->value['iteration'] : null) == 7) {?>
								<div class="sj-less-more" style="display: none">
							<?php }?>
							<a href="?<?php echo $_smarty_tpl->smarty->ext->_capture->getBuffer($_smarty_tpl, 'urlParams');?>
&amp;<?php echo $_smarty_tpl->smarty->ext->_capture->getBuffer($_smarty_tpl, 'refineFieldCriteria');?>
" class="sj-filter-option-link" style="text-decoration:none; color:inherit;">
								<label class="sj-filter-option">
									<input type="checkbox" onclick="window.location.href=this.closest('a').href; return false;">
									<?php $_block_plugin5 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin5, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin5->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['val']->value['value'];
$_block_content5 = ob_get_clean();
$_block_repeat=false;
ob_start();
echo $_block_plugin5->translate(array(), $_block_content5, $_smarty_tpl, $_block_repeat);
echo htmlspecialchars((string)ob_get_clean(), ENT_QUOTES, 'UTF-8', true);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
									<?php if ($_smarty_tpl->tpl_vars['val']->value['count'] != 0) {?><span class="sj-count"><?php if (empty($_smarty_tpl->tpl_vars['refineField']->value['criteria'])) {
echo $_smarty_tpl->tpl_vars['val']->value['count'];
}?></span><?php }?>
								</label>
							</a>
						<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
						<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_fieldValue']->value['total']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_fieldValue']->value['total'] : null) >= 7) {?>
							</div><button type="button" class="sj-show-more sj-less-more-btn"><?php echo $_smarty_tpl->smarty->ext->_capture->getBuffer($_smarty_tpl, 'trMore');?>
</button>
						<?php }?>
					</div>
				</div>
			<?php }?>
		<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	<?php }?>

		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['refineFields']->value, 'refineField');
$_smarty_tpl->tpl_vars['refineField']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['refineField']->value) {
$_smarty_tpl->tpl_vars['refineField']->do_else = false;
?>
		<?php if ($_smarty_tpl->tpl_vars['refineField']->value['show'] && $_smarty_tpl->tpl_vars['refineField']->value['count_results']) {?>
			<?php if ($_smarty_tpl->tpl_vars['listing_type']->value == "Resume") {?>
			<div class="col-md-4">
				<div class="refine-search__block">
					<a class="btn__refine-search" role="button" data-toggle="collapse" href="#refine-block-<?php echo $_smarty_tpl->tpl_vars['refineField']->value['field_name'];?>
" aria-expanded="true" aria-controls="refine-block-<?php echo $_smarty_tpl->tpl_vars['refineField']->value['field_name'];?>
">
						<?php $_smarty_tpl->_assignInScope('field_caption', call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'tr' ][ 0 ], array( $_smarty_tpl->tpl_vars['refineField']->value['caption'] )));?>
						<?php $_block_plugin6 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin6, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin6->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Refine by $field_caption<?php $_block_content6 = ob_get_clean();
$_block_repeat=false;
ob_start();
echo $_block_plugin6->translate(array(), $_block_content6, $_smarty_tpl, $_block_repeat);
echo htmlspecialchars((string)ob_get_clean(), ENT_QUOTES, 'UTF-8', true);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
					</a>
					<select name="<?php echo $_smarty_tpl->tpl_vars['refineField']->value['field_name'];
if (in_array($_smarty_tpl->tpl_vars['refineField']->value['type'],array('string'))) {?>[multi_like_and]<?php } else { ?>[multi_like]<?php }?>[]" class="btn__refine-search" onchange="this.form.submit();">
					<option value="0"><?php $_smarty_tpl->_assignInScope('field_caption', call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'tr' ][ 0 ], array( $_smarty_tpl->tpl_vars['refineField']->value['caption'] )));?>
						<?php $_block_plugin7 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin7, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin7->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Refine by $field_caption<?php $_block_content7 = ob_get_clean();
$_block_repeat=false;
ob_start();
echo $_block_plugin7->translate(array(), $_block_content7, $_smarty_tpl, $_block_repeat);
echo htmlspecialchars((string)ob_get_clean(), ENT_QUOTES, 'UTF-8', true);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></option>
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['refineField']->value['search_result'], 'val', false, NULL, 'fieldValue', array (
  'iteration' => true,
  'total' => true,
));
$_smarty_tpl->tpl_vars['val']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['val']->value) {
$_smarty_tpl->tpl_vars['val']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_fieldValue']->value['iteration']++;
?>
						<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, "refineFieldCriteria", null, null);
echo $_smarty_tpl->tpl_vars['refineField']->value['field_name'];
if (in_array($_smarty_tpl->tpl_vars['refineField']->value['type'],array('string'))) {?>[multi_like_and]<?php } else { ?>[multi_like]<?php }?>[]=<?php if ($_smarty_tpl->tpl_vars['val']->value['sid']) {
echo $_smarty_tpl->tpl_vars['val']->value['sid'];
} else {
echo rawurlencode((string)$_smarty_tpl->tpl_vars['val']->value['value']);
}
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
						<option value="<?php if (in_array($_smarty_tpl->tpl_vars['refineField']->value['type'],array('string'))) {
echo $_smarty_tpl->tpl_vars['val']->value['value'];
} else {
echo $_smarty_tpl->tpl_vars['val']->value['sid'];
}?>">
						<?php $_block_plugin8 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin8, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin8->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['val']->value['value'];
$_block_content8 = ob_get_clean();
$_block_repeat=false;
ob_start();
echo $_block_plugin8->translate(array(), $_block_content8, $_smarty_tpl, $_block_repeat);
echo htmlspecialchars((string)ob_get_clean(), ENT_QUOTES, 'UTF-8', true);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
						</option>
					<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
					</select>
				</div>
			</div>
			<?php }?>
		<?php }?>
	<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	</form>

	<?php if ($_smarty_tpl->tpl_vars['listing_type']->value == "Resume") {?>
	<?php }
}
if (!$_smarty_tpl->tpl_vars['GLOBALS']->value['is_ajax']) {?>
	<div id="refine-block-preloader"></div>
<?php }
$_block_plugin9 = isset($_smarty_tpl->smarty->registered_plugins['block']['javascript'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['javascript'][0][0] : null;
if (!is_callable(array($_block_plugin9, '_tpl_javascript'))) {
throw new SmartyException('block tag \'javascript\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('javascript', array());
$_block_repeat=true;
echo $_block_plugin9->_tpl_javascript(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
	<?php echo '<script'; ?>
>
		/* Toggle show more/less for filter options */
		$(document).on('click', '.sj-less-more-btn', function(e) {
			e.preventDefault();
			var btn = $(this);
			btn.prev('.sj-less-more').slideToggle('normal', function() {
				if ($(this).css('display') == 'block') {
					btn.html('<?php echo htmlspecialchars((string)$_smarty_tpl->smarty->ext->_capture->getBuffer($_smarty_tpl, 'trLess'), ENT_QUOTES, 'UTF-8', true);?>
');
				} else {
					btn.html('<?php echo htmlspecialchars((string)$_smarty_tpl->smarty->ext->_capture->getBuffer($_smarty_tpl, 'trMore'), ENT_QUOTES, 'UTF-8', true);?>
');
				}
			});
		});

		/* Toggle filter card collapse */
		$(document).on('click', '.sj-toggle', function() {
			var target = $(this).data('target');
			$(target).slideToggle(200);
			$(this).toggleClass('collapsed');
		});

		/* Old less-more for resume filters */
		$(document).on('click', '.less-more__btn', function(e) {
			e.preventDefault();
			var butt = $(this);
			butt.toggleClass('collapse');
			$(this).prev('.less-more').slideToggle('normal', function() {
				if ($(this).css('display') == 'block') {
					butt.html('<?php echo htmlspecialchars((string)$_smarty_tpl->smarty->ext->_capture->getBuffer($_smarty_tpl, 'trLess'), ENT_QUOTES, 'UTF-8', true);?>
');
				} else {
					butt.html('<?php echo htmlspecialchars((string)$_smarty_tpl->smarty->ext->_capture->getBuffer($_smarty_tpl, 'trMore'), ENT_QUOTES, 'UTF-8', true);?>
');
				}
			});
		});
	<?php echo '</script'; ?>
>
<?php $_block_repeat=false;
echo $_block_plugin9->_tpl_javascript(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
}
}
