<?php
/* Smarty version 4.3.0, created on 2026-03-04 08:57:45
  from 'template__system/admin_admin:CxampphtdocsJobsquareMatemplates_systemadmintemplate_managercustomize_theme.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a7f409ea8127_09919493',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b133fb052ece4a19f18a4af061bbc722c5148e40' => 
    array (
      0 => 'template__system/admin_admin:CxampphtdocsJobsquareMatemplates_systemadmintemplate_managercustomize_theme.tpl',
      1 => 1771678928,
      2 => 'template__system/admin_admin',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69a7f409ea8127_09919493 (Smarty_Internal_Template $_smarty_tpl) {
?><link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.0/spectrum.min.css">
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['user_site_url'];?>
/system/ext/CodeMirror/lib/codemirror.css">
<?php $_block_plugin1 = isset($_smarty_tpl->smarty->registered_plugins['block']['javascript'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['javascript'][0][0] : null;
if (!is_callable(array($_block_plugin1, '_tpl_javascript'))) {
throw new SmartyException('block tag \'javascript\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('javascript', array());
$_block_repeat=true;
echo $_block_plugin1->_tpl_javascript(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['user_site_url'];?>
/system/ext/CodeMirror/lib/codemirror.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['user_site_url'];?>
/system/ext/CodeMirror/lib/util/match-highlighter.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['user_site_url'];?>
/system/ext/CodeMirror/mode/css/css.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['user_site_url'];?>
/system/ext/CodeMirror/mode/javascript/javascript.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['user_site_url'];?>
/system/ext/CodeMirror/lib/util/search.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['user_site_url'];?>
/system/ext/CodeMirror/lib/util/searchcursor.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['user_site_url'];?>
/system/ext/CodeMirror/lib/util/dialog.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.0/spectrum.min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 type="text/javascript">
		$(document).ready(function() {
			var cmOptions = {
				lineNumbers: true,
				matchBrackets: true,
				mode: "css",
				indentUnit: 5,
				indentWithTabs: true,
				enterMode: "keep",
				tabMode: "shift",
				theme: "default"
			};
			CodeMirror.fromTextArea(document.getElementById("custom_css"), cmOptions);

			cmOptions.mode = 'javascript';
			CodeMirror.fromTextArea(document.getElementById("custom_js"), cmOptions);

			cmOptions.mode = 'htmlmixed';
			$('.theme-banner textarea').each(function() {
				var editor = CodeMirror.fromTextArea(this, cmOptions);
				setTimeout(function() {
					editor.refresh();  //когда таба на banners add, кодмиррор не так как нужно инициализируется
				}, 1)
			});

			$('.spectrum').each(function() {
				$(this).spectrum({
					preferredFormat: "hex",
					showPalette: true,
					showInput: true,
					palette: [
						["#000","#444","#666","#999","#ccc","#eee","#f3f3f3","#fff"],
						["#f00","#f90","#ff0","#0f0","#0ff","#00f","#90f","#f0f"],
						["#f4cccc","#fce5cd","#fff2cc","#d9ead3","#d0e0e3","#cfe2f3","#d9d2e9","#ead1dc"],
						["#ea9999","#f9cb9c","#ffe599","#b6d7a8","#a2c4c9","#9fc5e8","#b4a7d6","#d5a6bd"],
						["#e06666","#f6b26b","#ffd966","#93c47d","#76a5af","#6fa8dc","#8e7cc3","#c27ba0"],
						["#c00","#e69138","#f1c232","#6aa84f","#45818e","#3d85c6","#674ea7","#a64d79"],
						["#900","#b45f06","#bf9000","#38761d","#134f5c","#0b5394","#351c75","#741b47"],
						["#600","#783f04","#7f6000","#274e13","#0c343d","#073763","#20124d","#4c1130"]
					]
				});
			});

			$(document).on('change', '.theme-banner__label input', function() {
				var self = $(this);
				self.closest('.theme-banner').find('.theme-banner__contents').hide();
				if (self.val() == 'code') {
					var banner = self.closest('.theme-banner');
					banner.find('.theme-banner__contents-code').show();
					banner.find('.CodeMirror').get(0).CodeMirror.refresh();
				} else {
					self.closest('.theme-banner').find('.theme-banner__contents-image').show();
				}
			});

			$('.theme-banner__contents .btn--danger').click(function() {
				var parent = $(this).closest('.theme-banner');
				parent.find('img').remove();
				parent.find('input[value="code"]').click().change();
				parent.find('input[type="text"]').val('');
			});

			var tab = '<?php echo $_smarty_tpl->tpl_vars['tab']->value;?>
';

			if (tab) {
				$('.nav-tabs').find('li.active a').attr('aria-expanded', 'false');
				$('.nav-tabs').find('li.active').removeClass('active');
				$('.nav-tabs a[href="' + tab + '"]').attr('aria-expanded', 'true');
				$('.nav-tabs a[href="' + tab + '"]').closest('li').addClass('active');
				$('.tab-content .tab-pane.active').removeClass('active');
				$('.tab-content ' + tab).addClass('active');
			}

			$(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function () {
				$('input[name="tab"]').val($(this).attr('href'));

				if ($(this).attr('href') == '#bannersTab') {
					$('#bannersTab .CodeMirror').each(function(i, el){
						el.CodeMirror.refresh(); //без резайся, комиррор не так как нужно инициализируется
					});
				}
			})
		});
	<?php echo '</script'; ?>
>
<?php $_block_repeat=false;
echo $_block_plugin1->_tpl_javascript(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
<div class="page-title">
	<h1 class="title"><?php $_block_plugin2 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin2, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin2->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Customize Theme<?php $_block_repeat=false;
echo $_block_plugin2->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></h1>
</div>
<form method="post" action="" enctype="multipart/form-data" class="customize-form">
	<input type="hidden" name="action" value="save" />
	<input type="hidden" name="tab" value="<?php echo $_smarty_tpl->tpl_vars['tab']->value;?>
" />
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['errors']->value, 'error');
$_smarty_tpl->tpl_vars['error']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['error']->value) {
$_smarty_tpl->tpl_vars['error']->do_else = false;
?>
		<p class="error">
			<?php $_block_plugin3 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin3, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin3->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo $_smarty_tpl->tpl_vars['error']->value;
$_block_repeat=false;
echo $_block_plugin3->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
		</p>
	<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	<div id="customize-theme-pane">
		<ul class="nav nav-tabs">
			<li class="active">
				<a href="#generalTab" data-toggle="tab" aria-expanded="true"><?php $_block_plugin4 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin4, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin4->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>General Settings<?php $_block_repeat=false;
echo $_block_plugin4->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a>
			</li>
			<li>
				<a href="#homeTab" data-toggle="tab" aria-expanded="false">
					<?php $_block_plugin5 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin5, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin5->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Home Page<?php $_block_repeat=false;
echo $_block_plugin5->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
				</a>
			</li>
			<li>
				<a href="#bannersTab" data-toggle="tab" aria-expanded="false"><?php $_block_plugin6 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin6, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin6->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Banners Ads<?php $_block_repeat=false;
echo $_block_plugin6->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a>
			</li>
		</ul>
		<div class="tab-content">
			<div id="generalTab" class="tab-pane active">
				<div class="form-horizontal">
					<?php if ((isset($_smarty_tpl->tpl_vars['theme_settings']->value['logo']))) {?>
						<div class="form-group">
							<label class="col-md-2 control-label" ><?php $_block_plugin7 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin7, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin7->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Logo<?php $_block_repeat=false;
echo $_block_plugin7->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></label>
							<div class="col-md-7">
								<div class="input-group input-group__file">
									<input type="text" value="<?php echo rawurlencode((string)$_smarty_tpl->tpl_vars['theme_settings']->value['logo']);?>
" alt="" />
									<input type="file" name="logo" class=""/>
									<span class="input-group-btn">
										<a href="#" class="btn btn-default btn-change"><i class="fa fa-exchange" aria-hidden="true"></i><?php $_block_plugin8 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin8, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin8->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Change<?php $_block_repeat=false;
echo $_block_plugin8->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a>
									</span>
								</div>
								<img src="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['user_site_url'];?>
/templates/<?php echo $_smarty_tpl->tpl_vars['settings']->value['TEMPLATE_USER_THEME'];?>
/assets/images/<?php echo rawurlencode((string)$_smarty_tpl->tpl_vars['theme_settings']->value['logo']);?>
?v=<?php echo time();?>
" />
							</div>
						</div>
					<?php }?>
					<?php if ((isset($_smarty_tpl->tpl_vars['theme_settings']->value['favicon']))) {?>
						<div class="form-group">
							<label class="col-md-2 control-label" ><?php $_block_plugin9 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin9, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin9->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Favicon<?php $_block_repeat=false;
echo $_block_plugin9->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></label>
							<div class="col-md-7">
								<div class="input-group input-group__file">
									<input type="text" value="<?php echo rawurlencode((string)$_smarty_tpl->tpl_vars['theme_settings']->value['favicon']);?>
" alt="" />
									<input type="file" name="favicon" />
									<span class="input-group-btn">
										<a href="#" class="btn btn-default btn-change"><i class="fa fa-exchange" aria-hidden="true"></i><?php $_block_plugin10 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin10, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin10->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Change<?php $_block_repeat=false;
echo $_block_plugin10->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a>
									</span>
								</div>
								<img src="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['user_site_url'];?>
/templates/<?php echo $_smarty_tpl->tpl_vars['settings']->value['TEMPLATE_USER_THEME'];?>
/assets/images/<?php echo rawurlencode((string)$_smarty_tpl->tpl_vars['theme_settings']->value['favicon']);?>
?v=<?php echo time();?>
" />
							</div>
						</div>
					<?php }?>
					<?php if ((isset($_smarty_tpl->tpl_vars['theme_settings']->value['button_color_1'])) || (isset($_smarty_tpl->tpl_vars['theme_settings']->value['button_color_2'])) || (isset($_smarty_tpl->tpl_vars['theme_settings']->value['button_color_3']))) {?>
						<div class="form-group">
							<label class="col-md-2 control-label" ><?php $_block_plugin11 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin11, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin11->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Colors<?php $_block_repeat=false;
echo $_block_plugin11->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></label>
							<div class="col-md-7">
								<?php if ((isset($_smarty_tpl->tpl_vars['theme_settings']->value['button_color_1']))) {?>
									<div class="inline-block">
										<input class="spectrum" type="text" name="button_color_1" value="<?php echo $_smarty_tpl->tpl_vars['theme_settings']->value['button_color_1'];?>
" />
										&nbsp;<?php $_block_plugin12 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin12, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin12->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Main Color<?php $_block_repeat=false;
echo $_block_plugin12->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
									</div>
								<?php }?>
								<?php if ((isset($_smarty_tpl->tpl_vars['theme_settings']->value['button_color_2']))) {?>
									<div class="inline-block">
										<input class="spectrum" type="text" name="button_color_2" value="<?php echo $_smarty_tpl->tpl_vars['theme_settings']->value['button_color_2'];?>
" />
										&nbsp;<?php $_block_plugin13 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin13, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin13->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Accent Color 1<?php $_block_repeat=false;
echo $_block_plugin13->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
									</div>
								<?php }?>
								<?php if ((isset($_smarty_tpl->tpl_vars['theme_settings']->value['button_color_3']))) {?>
									<div class="inline-block">
										<input class="spectrum" type="text" name="button_color_3" value="<?php echo $_smarty_tpl->tpl_vars['theme_settings']->value['button_color_3'];?>
" />
										&nbsp;<?php $_block_plugin14 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin14, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin14->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Accent Color 2<?php $_block_repeat=false;
echo $_block_plugin14->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
									</div>
								<?php }?>
							</div>
						</div>
					<?php }?>
					<?php if ((isset($_smarty_tpl->tpl_vars['theme_settings']->value['font']))) {?>
						<div class="form-group">
							<label class="col-md-2 control-label" ><?php $_block_plugin15 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin15, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin15->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Font<?php $_block_repeat=false;
echo $_block_plugin15->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></label>
							<div class="col-md-7">
								<select name="font">
									<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['fonts']->value, 'font', false, 'fontId');
$_smarty_tpl->tpl_vars['font']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['fontId']->value => $_smarty_tpl->tpl_vars['font']->value) {
$_smarty_tpl->tpl_vars['font']->do_else = false;
?>
										<option value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['fontId']->value, ENT_QUOTES, 'UTF-8', true);?>
" <?php if ($_smarty_tpl->tpl_vars['fontId']->value == $_smarty_tpl->tpl_vars['theme_settings']->value['font']) {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['font']->value['caption'];?>
</option>
									<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
								</select>
							</div>
						</div>
					<?php }?>
					<?php if ((isset($_smarty_tpl->tpl_vars['theme_settings']->value['font2']))) {?>
						<div class="form-group">
							<label class="col-md-2 control-label"><?php $_block_plugin16 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin16, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin16->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Header Font<?php $_block_repeat=false;
echo $_block_plugin16->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></label>
							<div class="col-md-7">
								<select name="font2">
									<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['fonts']->value, 'font', false, 'fontId');
$_smarty_tpl->tpl_vars['font']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['fontId']->value => $_smarty_tpl->tpl_vars['font']->value) {
$_smarty_tpl->tpl_vars['font']->do_else = false;
?>
										<option value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['fontId']->value, ENT_QUOTES, 'UTF-8', true);?>
" <?php if ($_smarty_tpl->tpl_vars['fontId']->value == $_smarty_tpl->tpl_vars['theme_settings']->value['font2']) {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['font']->value['caption'];?>
</option>
									<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
								</select>
							</div>
						</div>
					<?php }?>
					<?php if ((isset($_smarty_tpl->tpl_vars['theme_settings']->value['footer']))) {?>
						<div class="form-group">
							<label class="col-md-2 control-label" ><?php $_block_plugin17 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin17, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin17->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Footer<?php $_block_repeat=false;
echo $_block_plugin17->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></label>
							<div class="col-md-7">
								<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['WYSIWYGEditor'][0], array( array('name'=>'footer','class'=>'inputText','width'=>"100%",'height'=>"150",'type'=>'tinymce','value'=>$_smarty_tpl->tpl_vars['theme_settings']->value['footer'],'conf'=>"Admin"),$_smarty_tpl ) );?>

							</div>
						</div>
					<?php }?>
					<?php if ((isset($_smarty_tpl->tpl_vars['theme_settings']->value['custom_css']))) {?>
						<div class="form-group">
							<label class="col-md-2 control-label" ><?php $_block_plugin18 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin18, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin18->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Custom CSS<?php $_block_repeat=false;
echo $_block_plugin18->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></label>
							<div class="col-md-7">
								<textarea id="custom_css" name="custom_css"><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['theme_settings']->value['custom_css'], ENT_QUOTES, 'UTF-8', true);?>
</textarea>
							</div>
						</div>
					<?php }?>
					<?php if ((isset($_smarty_tpl->tpl_vars['theme_settings']->value['custom_js']))) {?>
						<div class="form-group">
							<label class="col-md-2 control-label" ><?php $_block_plugin19 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin19, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin19->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Custom JS<?php $_block_repeat=false;
echo $_block_plugin19->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></label>
							<div class="col-md-7">
								<textarea id="custom_js" name="custom_js"><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['theme_settings']->value['custom_js'], ENT_QUOTES, 'UTF-8', true);?>
</textarea>
							</div>
						</div>
					<?php }?>
				</div>
			</div>
			<div id="homeTab" class="tab-pane">
				<div class="form-horizontal">
					<?php if ((isset($_smarty_tpl->tpl_vars['theme_settings']->value['main_banner']))) {?>
						<div class="form-group">
							<label class="col-md-2 control-label" ><?php $_block_plugin20 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin20, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin20->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Main Banner<?php $_block_repeat=false;
echo $_block_plugin20->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></label>
							<div class="col-md-7">
								<?php if ($_smarty_tpl->tpl_vars['settings']->value['TEMPLATE_USER_THEME'] == "Bootstrap") {?>
									<span class="banner-tooltip" data-toggle="tooltip" data-placement="auto left" title="<?php $_block_plugin21 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin21, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin21->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Recommended size 1350x380 px<?php $_block_repeat=false;
echo $_block_plugin21->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
								<?php } elseif ($_smarty_tpl->tpl_vars['settings']->value['TEMPLATE_USER_THEME'] == "Flow") {?>
									<span class="banner-tooltip" data-toggle="tooltip" data-placement="auto left" title="<?php $_block_plugin22 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin22, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin22->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Recommended size 1350x550 px<?php $_block_repeat=false;
echo $_block_plugin22->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
								<?php }?>
								<div class="input-group input-group__file">
									<input type="text" value="<?php echo rawurlencode((string)$_smarty_tpl->tpl_vars['theme_settings']->value['main_banner']);?>
" alt="" />
									<input type="file" name="main_banner" />
									<span class="input-group-btn">
										<a href="#" class="btn btn-default btn-change"><i class="fa fa-exchange" aria-hidden="true"></i><?php $_block_plugin23 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin23, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin23->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Change<?php $_block_repeat=false;
echo $_block_plugin23->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a>
									</span>
								</div>
								<img class="customize-banner-img" src="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['user_site_url'];?>
/templates/<?php echo $_smarty_tpl->tpl_vars['settings']->value['TEMPLATE_USER_THEME'];?>
/assets/images/<?php echo rawurlencode((string)$_smarty_tpl->tpl_vars['theme_settings']->value['main_banner']);?>
?v=<?php echo time();?>
" />
							</div>
						</div>
					<?php }?>
					<?php if ((isset($_smarty_tpl->tpl_vars['theme_settings']->value['main_banner_text']))) {?>
						<div class="form-group">
							<label class="col-md-2 control-label"><?php $_block_plugin24 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin24, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin24->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Main Banner Text<?php $_block_repeat=false;
echo $_block_plugin24->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></label>
							<div class="col-md-7">
								<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['WYSIWYGEditor'][0], array( array('name'=>'main_banner_text','class'=>'inputText','width'=>"100%",'height'=>"150",'type'=>'tinymce','value'=>$_smarty_tpl->tpl_vars['theme_settings']->value['main_banner_text'],'conf'=>"Admin"),$_smarty_tpl ) );?>

							</div>
						</div>
					<?php }?>
					<?php if ((isset($_smarty_tpl->tpl_vars['theme_settings']->value['secondary_banner']))) {?>
						<div class="form-group">
							<label class="col-md-2 control-label"><?php $_block_plugin25 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin25, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin25->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Secondary Banner<?php $_block_repeat=false;
echo $_block_plugin25->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></label>
							<div class="col-md-7">
								<?php if ($_smarty_tpl->tpl_vars['settings']->value['TEMPLATE_USER_THEME'] == "Bootstrap") {?>
									<span class="banner-tooltip" data-toggle="tooltip" data-placement="auto left" title="<?php $_block_plugin26 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin26, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin26->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Recommended size 1350x390 px<?php $_block_repeat=false;
echo $_block_plugin26->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
								<?php } elseif ($_smarty_tpl->tpl_vars['settings']->value['TEMPLATE_USER_THEME'] == "Flow") {?>
									<span class="banner-tooltip" data-toggle="tooltip" data-placement="auto left" title="<?php $_block_plugin27 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin27, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin27->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Recommended size 1350x505 px<?php $_block_repeat=false;
echo $_block_plugin27->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
								<?php }?>
								<div class="input-group input-group__file">
									<input type="text" value="<?php echo rawurlencode((string)$_smarty_tpl->tpl_vars['theme_settings']->value['secondary_banner']);?>
" alt="" />
									<input type="file" name="secondary_banner" />
									<span class="input-group-btn">
										<a href="#" class="btn btn-default btn-change"><i class="fa fa-exchange" aria-hidden="true"></i><?php $_block_plugin28 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin28, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin28->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Change<?php $_block_repeat=false;
echo $_block_plugin28->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a>
									</span>
								</div>
								<img class="customize-banner-img" src="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['user_site_url'];?>
/templates/<?php echo $_smarty_tpl->tpl_vars['settings']->value['TEMPLATE_USER_THEME'];?>
/assets/images/<?php echo rawurlencode((string)$_smarty_tpl->tpl_vars['theme_settings']->value['secondary_banner']);?>
?v=<?php echo time();?>
" />
							</div>
						</div>
					<?php }?>
					<?php if ((isset($_smarty_tpl->tpl_vars['theme_settings']->value['secondary_banner_text']))) {?>
						<div class="form-group">
							<label class="col-md-2 control-label" ><?php $_block_plugin29 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin29, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin29->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Secondary Banner Text<?php $_block_repeat=false;
echo $_block_plugin29->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></label>
							<div class="col-md-7">
								<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['WYSIWYGEditor'][0], array( array('name'=>'secondary_banner_text','class'=>'inputText','width'=>"100%",'height'=>"150",'type'=>'tinymce','value'=>$_smarty_tpl->tpl_vars['theme_settings']->value['secondary_banner_text'],'conf'=>"Admin"),$_smarty_tpl ) );?>

							</div>
						</div>
					<?php }?>
					<?php if ((isset($_smarty_tpl->tpl_vars['theme_settings']->value['bottom_section_html']))) {?>
						<div class="form-group">
							<label class="col-md-2 control-label" ><?php $_block_plugin30 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin30, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin30->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Bottom Section HTML<?php $_block_repeat=false;
echo $_block_plugin30->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></label>
							<div class="col-md-7">
								<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['WYSIWYGEditor'][0], array( array('name'=>'bottom_section_html','class'=>'inputText','width'=>"100%",'height'=>"150",'type'=>'tinymce','value'=>$_smarty_tpl->tpl_vars['theme_settings']->value['bottom_section_html'],'conf'=>"Admin"),$_smarty_tpl ) );?>

							</div>
						</div>
					<?php }?>
					<?php if ((isset($_smarty_tpl->tpl_vars['theme_settings']->value['jobs_by_category']))) {?>
						<div class="form-group">
							<label class="col-md-2 control-label" ><?php $_block_plugin31 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin31, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin31->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Display Jobs by<?php $_block_repeat=false;
echo $_block_plugin31->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></label>
							<div class="col-md-7">
								<div class="inline-block">
									<input type="hidden" name="jobs_by_category" value="0">
									<label class="cr-styled">
										<input type="checkbox" name="jobs_by_category" value="1" <?php if ($_smarty_tpl->tpl_vars['theme_settings']->value['jobs_by_category']) {?>checked="checked"<?php }?> >
										<i class="fa"></i>
										<?php $_block_plugin32 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin32, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin32->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Category<?php $_block_repeat=false;
echo $_block_plugin32->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
									</label>
								</div>
								<div class="inline-block">
									<input type="hidden" name="jobs_by_city" value="0">
									<label class="cr-styled">
										<input type="checkbox" name="jobs_by_city" value="1" <?php if ($_smarty_tpl->tpl_vars['theme_settings']->value['jobs_by_city']) {?>checked="checked"<?php }?> >
										<i class="fa"></i>
										<?php $_block_plugin33 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin33, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin33->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>City<?php $_block_repeat=false;
echo $_block_plugin33->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
									</label>
								</div>
								<div class="inline-block">
									<input type="hidden" name="jobs_by_state" value="0">
									<label class="cr-styled">
										<input type="checkbox" name="jobs_by_state" value="1" <?php if ($_smarty_tpl->tpl_vars['theme_settings']->value['jobs_by_state']) {?>checked="checked"<?php }?> >
										<i class="fa"></i>
										<?php $_block_plugin34 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin34, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin34->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>State<?php $_block_repeat=false;
echo $_block_plugin34->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
									</label>
								</div>
								<div class="inline-block">
									<input type="hidden" name="jobs_by_country" value="0">
									<label class="cr-styled">
										<input type="checkbox" name="jobs_by_country" value="1" <?php if ($_smarty_tpl->tpl_vars['theme_settings']->value['jobs_by_country']) {?>checked="checked"<?php }?> >
										<i class="fa"></i>
										<?php $_block_plugin35 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin35, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin35->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Country<?php $_block_repeat=false;
echo $_block_plugin35->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
									</label>
								</div>
							</div>
						</div>
					<?php }?>
				</div>
			</div>
			<div id="bannersTab" class="tab-pane">
				<div class="form-horizontal">
					<div class="form-group">
						<label class="col-md-2 control-label" ><?php $_block_plugin36 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin36, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin36->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Top Banner<?php $_block_repeat=false;
echo $_block_plugin36->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></label>
						<div class="col-md-7 theme-banner">
							<span data-toggle="tooltip" data-placement="auto left" title="<?php $_block_plugin37 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin37, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin37->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Appears at the top of all pages. Suggested size: 728x90<?php $_block_repeat=false;
echo $_block_plugin37->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
							<label class="theme-banner__label">
								<label class="cr-styled cr-styled__radio">
									<input type="radio" name="banner_top_type" <?php if ($_smarty_tpl->tpl_vars['theme_settings']->value['banner_top_type'] != 'img') {?>checked<?php }?> value="code">
									<i class="fa"></i>
									<?php $_block_plugin38 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin38, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin38->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Html code<?php $_block_repeat=false;
echo $_block_plugin38->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
								</label>
							</label>
							<label class="theme-banner__label">
								<label class="cr-styled cr-styled__radio">
									<input type="radio" name="banner_top_type" <?php if ($_smarty_tpl->tpl_vars['theme_settings']->value['banner_top_type'] == 'img') {?>checked<?php }?> value="img">
									<i class="fa"></i>
									<?php $_block_plugin39 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin39, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin39->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Image<?php $_block_repeat=false;
echo $_block_plugin39->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
								</label>
							</label>
							<div class="theme-banner__contents theme-banner__contents-code" style="<?php if ($_smarty_tpl->tpl_vars['settings']->value['banner_top_type'] == 'img') {?>display: none;<?php }?>">
								<textarea id="banner_top_code" name="banner_top_code"><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['theme_settings']->value['banner_top_code'], ENT_QUOTES, 'UTF-8', true);?>
</textarea>
							</div>
							<div class="theme-banner__contents theme-banner__contents-image" style="<?php if ($_smarty_tpl->tpl_vars['theme_settings']->value['banner_top_type'] != 'img') {?>display: none;<?php }?>">
								<div class="input-group input-group__file">
									<input type="text" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['theme_settings']->value['banner_top_img'], ENT_QUOTES, 'UTF-8', true);?>
" alt="" />
									<input type="file" name="banner_top_img"/>
									<span class="input-group-btn">
										<?php if ($_smarty_tpl->tpl_vars['theme_settings']->value['banner_top_img']) {?>
											<a href="#" class="btn btn-default btn-change btn-change__replace"><i class="fa fa-exchange" aria-hidden="true"></i><?php $_block_plugin40 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin40, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin40->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Change<?php $_block_repeat=false;
echo $_block_plugin40->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a>
											<a href="#" class="btn btn-default btn-change btn-change__upload hidden"><i class="fa fa-upload" aria-hidden="true"></i><?php $_block_plugin41 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin41, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin41->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Upload<?php $_block_repeat=false;
echo $_block_plugin41->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a>
											<a href="#" class="btn btn--danger"><i class="fa fa-trash-o" aria-hidden="true"></i><?php $_block_plugin42 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin42, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin42->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Remove<?php $_block_repeat=false;
echo $_block_plugin42->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a>
										<?php } else { ?>
											<a href="#" class="btn btn-default btn-change"><i class="fa fa-upload" aria-hidden="true"></i><?php $_block_plugin43 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin43, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin43->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Upload<?php $_block_repeat=false;
echo $_block_plugin43->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a>
										<?php }?>
									</span>
								</div>
								<?php if ($_smarty_tpl->tpl_vars['theme_settings']->value['banner_top_img']) {?>
									<img class="theme-banner__preview-image" src="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['user_site_url'];?>
/files/banners/<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['theme_settings']->value['banner_top_img'], ENT_QUOTES, 'UTF-8', true);?>
"/>
								<?php }?>
								<div class="banner-link">
									<span class="help-block">
                                   		<small><?php $_block_plugin44 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin44, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin44->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Banner Link<?php $_block_repeat=false;
echo $_block_plugin44->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></small>
							 		</span>
									<input type="text" name="banner_top_link" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['theme_settings']->value['banner_top_link'], ENT_QUOTES, 'UTF-8', true);?>
" />
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">
							<?php $_block_plugin45 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin45, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin45->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Bottom Banners<?php $_block_repeat=false;
echo $_block_plugin45->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
						</label>
						<div class="theme-banner col-md-7">
							<span data-toggle="tooltip" data-placement="auto left" title="<?php $_block_plugin46 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin46, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin46->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Appears at the bottom of all pages. Suggested size: 728x90<?php $_block_repeat=false;
echo $_block_plugin46->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
							<label class="theme-banner__label">
								<label class="cr-styled cr-styled__radio">
									<input type="radio" name="banner_bottom_type" <?php if ($_smarty_tpl->tpl_vars['theme_settings']->value['banner_bottom_type'] != 'img') {?>checked<?php }?> value="code">
									<i class="fa"></i>
									<?php $_block_plugin47 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin47, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin47->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Html code<?php $_block_repeat=false;
echo $_block_plugin47->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
								</label>
							</label>
							<label class="theme-banner__label">
								<label class="cr-styled cr-styled__radio">
									<input type="radio" name="banner_bottom_type" <?php if ($_smarty_tpl->tpl_vars['theme_settings']->value['banner_bottom_type'] == 'img') {?>checked<?php }?> value="img">
									<i class="fa"></i>
									<?php $_block_plugin48 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin48, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin48->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Image<?php $_block_repeat=false;
echo $_block_plugin48->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
								</label>
							</label>
							<div class="theme-banner__contents theme-banner__contents-code" style="<?php if ($_smarty_tpl->tpl_vars['theme_settings']->value['banner_bottom_type'] == 'img') {?>display: none;<?php }?>">
								<textarea id="banner_bottom_code" name="banner_bottom_code"><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['theme_settings']->value['banner_bottom_code'], ENT_QUOTES, 'UTF-8', true);?>
</textarea>
							</div>
							<div class="theme-banner__contents theme-banner__contents-image" style="<?php if ($_smarty_tpl->tpl_vars['theme_settings']->value['banner_bottom_type'] != 'img') {?>display: none;<?php }?>">
								<div class="input-group input-group__file">
									<input type="text" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['theme_settings']->value['banner_bottom_img'], ENT_QUOTES, 'UTF-8', true);?>
" alt="" />
									<input type="file" name="banner_bottom_img"/>
									<span class="input-group-btn">
										<?php if ($_smarty_tpl->tpl_vars['theme_settings']->value['banner_bottom_img']) {?>
											<a href="#" class="btn btn-default btn-change btn-change__replace"><i class="fa fa-exchange" aria-hidden="true"></i><?php $_block_plugin49 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin49, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin49->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Change<?php $_block_repeat=false;
echo $_block_plugin49->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a>
											<a href="#" class="btn btn-default btn-change btn-change__upload hidden"><i class="fa fa-upload" aria-hidden="true"></i><?php $_block_plugin50 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin50, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin50->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Upload<?php $_block_repeat=false;
echo $_block_plugin50->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a>
											<a href="#" class="btn btn--danger"><i class="fa fa-trash-o" aria-hidden="true"></i><?php $_block_plugin51 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin51, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin51->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Remove<?php $_block_repeat=false;
echo $_block_plugin51->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a>
										<?php } else { ?>
											<a href="#" class="btn btn-default btn-change"><i class="fa fa-upload" aria-hidden="true"></i><?php $_block_plugin52 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin52, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin52->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Upload<?php $_block_repeat=false;
echo $_block_plugin52->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a>
										<?php }?>
									</span>
								</div>
								<?php if ($_smarty_tpl->tpl_vars['theme_settings']->value['banner_bottom_img']) {?>
									<img class="theme-banner__preview-image" src="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['user_site_url'];?>
/files/banners/<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['theme_settings']->value['banner_bottom_img'], ENT_QUOTES, 'UTF-8', true);?>
"/>
								<?php }?>
								<div class="banner-link">
									<span class="help-block">
                                   		<small><?php $_block_plugin53 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin53, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin53->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Banner Link<?php $_block_repeat=false;
echo $_block_plugin53->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></small>
							 		</span>
									<input type="text" name="banner_bottom_link" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['theme_settings']->value['banner_bottom_link'], ENT_QUOTES, 'UTF-8', true);?>
" />
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">
							<?php $_block_plugin54 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin54, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin54->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Right Side Banner<?php $_block_repeat=false;
echo $_block_plugin54->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
						</label>
						<div class="theme-banner col-md-7">
							<span data-toggle="tooltip" data-placement="auto left" title="<?php $_block_plugin55 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin55, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin55->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Appears at the right side of all pages. Suggested size: 120x600<?php $_block_repeat=false;
echo $_block_plugin55->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
							<label class="theme-banner__label">
								<label class="cr-styled cr-styled__radio">
									<input type="radio" name="banner_right_side_type" <?php if ($_smarty_tpl->tpl_vars['theme_settings']->value['banner_right_side_type'] != 'img') {?>checked<?php }?> value="code">
									<i class="fa"></i>
									<?php $_block_plugin56 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin56, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin56->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Html code<?php $_block_repeat=false;
echo $_block_plugin56->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
								</label>
							</label>
							<label class="theme-banner__label">
								<label class="cr-styled cr-styled__radio">
									<input type="radio" name="banner_right_side_type" <?php if ($_smarty_tpl->tpl_vars['theme_settings']->value['banner_right_side_type'] == 'img') {?>checked<?php }?> value="img">
									<i class="fa"></i>
									<?php $_block_plugin57 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin57, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin57->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Image<?php $_block_repeat=false;
echo $_block_plugin57->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
								</label>
							</label>
							<div class="theme-banner__contents theme-banner__contents-code" style="<?php if ($_smarty_tpl->tpl_vars['theme_settings']->value['banner_right_side_type'] == 'img') {?>display: none;<?php }?>">
								<textarea id="banner_right_side_code" name="banner_right_side_code"><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['theme_settings']->value['banner_right_side_code'], ENT_QUOTES, 'UTF-8', true);?>
</textarea>
							</div>
							<div class="theme-banner__contents theme-banner__contents-image" style="<?php if ($_smarty_tpl->tpl_vars['theme_settings']->value['banner_right_side_type'] != 'img') {?>display: none;<?php }?>">
								<div class="input-group input-group__file">
									<input type="text" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['theme_settings']->value['banner_right_side_img'], ENT_QUOTES, 'UTF-8', true);?>
" alt="" />
									<input type="file" name="banner_right_side_img"/>
									<span class="input-group-btn">
										<?php if ($_smarty_tpl->tpl_vars['theme_settings']->value['banner_right_side_img']) {?>
											<a href="#" class="btn btn-default btn-change btn-change__replace"><i class="fa fa-exchange" aria-hidden="true"></i><?php $_block_plugin58 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin58, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin58->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Change<?php $_block_repeat=false;
echo $_block_plugin58->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a>
											<a href="#" class="btn btn-default btn-change btn-change__upload hidden"><i class="fa fa-upload" aria-hidden="true"></i><?php $_block_plugin59 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin59, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin59->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Upload<?php $_block_repeat=false;
echo $_block_plugin59->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a>
											<a href="#" class="btn btn--danger"><i class="fa fa-trash-o" aria-hidden="true"></i><?php $_block_plugin60 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin60, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin60->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Remove<?php $_block_repeat=false;
echo $_block_plugin60->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a>
										<?php } else { ?>
											<a href="#" class="btn btn-default btn-change"><i class="fa fa-upload" aria-hidden="true"></i><?php $_block_plugin61 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin61, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin61->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Upload<?php $_block_repeat=false;
echo $_block_plugin61->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a>
										<?php }?>
									</span>
								</div>
								<?php if ($_smarty_tpl->tpl_vars['theme_settings']->value['banner_right_side_img']) {?>
									<img class="theme-banner__preview-image" src="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['user_site_url'];?>
/files/banners/<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['theme_settings']->value['banner_right_side_img'], ENT_QUOTES, 'UTF-8', true);?>
"/>
								<?php }?>
								<div class="banner-link">
									<span class="help-block">
                                   		<small><?php $_block_plugin62 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin62, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin62->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Banner Link<?php $_block_repeat=false;
echo $_block_plugin62->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></small>
							 		</span>
									<input type="text" name="banner_right_side_link" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['theme_settings']->value['banner_right_side_link'], ENT_QUOTES, 'UTF-8', true);?>
" />
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">
							<?php $_block_plugin63 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin63, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin63->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Inline Banner<?php $_block_repeat=false;
echo $_block_plugin63->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
						</label>
						<div class="theme-banner col-md-7">
							<span data-toggle="tooltip" data-placement="auto left" title="<?php $_block_plugin64 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin64, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin64->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Appears inside job and resume search results. Suggested size: 600x250<?php $_block_repeat=false;
echo $_block_plugin64->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
							<label class="theme-banner__label">
								<label class="cr-styled cr-styled__radio">
									<input type="radio" name="banner_inline_type" <?php if ($_smarty_tpl->tpl_vars['theme_settings']->value['banner_inline_type'] != 'img') {?>checked<?php }?> value="code">
									<i class="fa"></i>
									<?php $_block_plugin65 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin65, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin65->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Html code<?php $_block_repeat=false;
echo $_block_plugin65->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
								</label>
							</label>
							<label class="theme-banner__label">
								<label class="cr-styled cr-styled__radio">
									<input type="radio" name="banner_inline_type" <?php if ($_smarty_tpl->tpl_vars['theme_settings']->value['banner_inline_type'] == 'img') {?>checked<?php }?> value="img">
									<i class="fa"></i>
									<?php $_block_plugin66 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin66, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin66->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Image<?php $_block_repeat=false;
echo $_block_plugin66->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
								</label>
							</label>
							<div class="theme-banner__contents theme-banner__contents-code" style="<?php if ($_smarty_tpl->tpl_vars['theme_settings']->value['banner_inline_type'] == 'img') {?>display: none;<?php }?>">
								<textarea id="banner_inline_code" name="banner_inline_code"><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['theme_settings']->value['banner_inline_code'], ENT_QUOTES, 'UTF-8', true);?>
</textarea>
							</div>
							<div class="theme-banner__contents theme-banner__contents-image" style="<?php if ($_smarty_tpl->tpl_vars['theme_settings']->value['banner_inline_type'] != 'img') {?>display: none;<?php }?>">
								<div class="input-group input-group__file">
									<input type="text" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['theme_settings']->value['banner_inline_img'], ENT_QUOTES, 'UTF-8', true);?>
" alt="" />
									<input type="file" name="banner_inline_img"/>
									<span class="input-group-btn">
										<?php if ($_smarty_tpl->tpl_vars['theme_settings']->value['banner_inline_img']) {?>
											<a href="#" class="btn btn-default btn-change btn-change__replace"><i class="fa fa-exchange" aria-hidden="true"></i><?php $_block_plugin67 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin67, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin67->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Change<?php $_block_repeat=false;
echo $_block_plugin67->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a>
											<a href="#" class="btn btn-default btn-change btn-change__upload hidden"><i class="fa fa-upload" aria-hidden="true"></i><?php $_block_plugin68 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin68, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin68->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Upload<?php $_block_repeat=false;
echo $_block_plugin68->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a>
											<a href="#" class="btn btn--danger"><i class="fa fa-trash-o" aria-hidden="true"></i><?php $_block_plugin69 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin69, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin69->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Remove<?php $_block_repeat=false;
echo $_block_plugin69->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a>
										<?php } else { ?>
											<a href="#" class="btn btn-default btn-change"><i class="fa fa-upload" aria-hidden="true"></i><?php $_block_plugin70 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin70, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin70->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Upload<?php $_block_repeat=false;
echo $_block_plugin70->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></a>
										<?php }?>
									</span>
								</div>
								<?php if ($_smarty_tpl->tpl_vars['theme_settings']->value['banner_inline_img']) {?>
									<img class="theme-banner__preview-image" src="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['user_site_url'];?>
/files/banners/<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['theme_settings']->value['banner_inline_img'], ENT_QUOTES, 'UTF-8', true);?>
"/>
								<?php }?>
								<div class="banner-link">
									<span class="help-block">
                                   		<small><?php $_block_plugin71 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin71, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin71->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Banner Link<?php $_block_repeat=false;
echo $_block_plugin71->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></small>
							 		</span>
									<input type="text" name="banner_inline_link" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['theme_settings']->value['banner_inline_link'], ENT_QUOTES, 'UTF-8', true);?>
" />
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-7 col-md-offset-2">
					<button class="btn btn--primary"><?php $_block_plugin72 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin72, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin72->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Save<?php $_block_repeat=false;
echo $_block_plugin72->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></button>
				</div>
			</div>
		</div>
	</div>
</form><?php }
}
