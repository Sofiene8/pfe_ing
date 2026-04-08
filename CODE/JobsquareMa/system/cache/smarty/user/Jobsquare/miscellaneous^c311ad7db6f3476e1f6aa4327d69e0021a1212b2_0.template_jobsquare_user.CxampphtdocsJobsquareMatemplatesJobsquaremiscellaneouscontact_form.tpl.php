<?php
/* Smarty version 4.3.0, created on 2026-02-27 14:04:47
  from 'template_jobsquare_user:CxampphtdocsJobsquareMatemplatesJobsquaremiscellaneouscontact_form.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a1a47f3fbd15_97511097',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c311ad7db6f3476e1f6aa4327d69e0021a1212b2' => 
    array (
      0 => 'template_jobsquare_user:CxampphtdocsJobsquareMatemplatesJobsquaremiscellaneouscontact_form.tpl',
      1 => 1771974752,
      2 => 'template_jobsquare_user',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69a1a47f3fbd15_97511097 (Smarty_Internal_Template $_smarty_tpl) {
?>
<style>
.contact_page {
    background: #fff !important;
}
.contact_page .page-row-expanded {
    background: #f5f5f5;
    padding-top: 40px;
    padding-bottom: 40px;
}
.contact_page .static-pages {
    max-width: 700px;
    margin: 0 auto;
    padding: 0 15px;
}
</style>

 <?php if ($_smarty_tpl->tpl_vars['message_sent']->value == false) {?>
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['field_errors']->value, 'value', false, 'key');
$_smarty_tpl->tpl_vars['value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->do_else = false;
?>
		<?php if ($_smarty_tpl->tpl_vars['key']->value == 'EMAIL') {?>
    <div class="alert alert-danger"><?php $_block_plugin6 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin6, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin6->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Please enter valid email address<?php $_block_repeat=false;
echo $_block_plugin6->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></div>
<?php } elseif ($_smarty_tpl->tpl_vars['key']->value == 'NAME') {?>
<div class="alert alert-danger"><?php $_block_plugin7 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin7, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin7->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Please provide your full name.<?php $_block_repeat=false;
echo $_block_plugin7->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></div>
<?php } elseif ($_smarty_tpl->tpl_vars['key']->value == 'COMMENTS') {?>
<div class="alert alert-danger"><?php $_block_plugin8 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin8, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin8->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Please include your comments.<?php $_block_repeat=false;
echo $_block_plugin8->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></div>
<?php }?>
	<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
<div class="row static-pages content-text">
  <div class="col-md-8 col-md-offset-2">
    <h1 class="text-center">Contactez-nous</h1>
    <p class="introcontact text-center">
      Que vous soyez à la recherche d’un emploi ou de nouveaux talents,
      remplissez le formulaire pour en savoir plus sur nos solutions
    </p>
    <div class="formcontact">
      <form method="post" action="" onSubmit="disableSubmitButton('submit-contact');" class="form col-xs-12 col-lg-11 col-md-11 col-sm-11">
        <div class="form-group form-group margin">
          <h2> Besoin d’aide ou d’informations ? </h2>
          <p>Remplissez le formulaire et notre équipe vous répondra rapidement.</p>
        </div>
        <input type="hidden" name="action" value="send_message" />
        <div class="form-group form-group margin">
          <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8', true);?>
" placeholder="<?php $_block_plugin9 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin9, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin9->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Full Name<?php $_block_repeat=false;
echo $_block_plugin9->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>" />
        </div>
        <div class="form-group form-group margin ">
          <input placeholder="<?php $_block_plugin10 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin10, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin10->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Email<?php $_block_repeat=false;
echo $_block_plugin10->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>:" type="text" name="email" class="form-control" value="<?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['current_user']['logged_in']) {
echo htmlspecialchars((string)(($tmp = $_smarty_tpl->tpl_vars['email']->value ?? null)===null||$tmp==='' ? $_smarty_tpl->tpl_vars['GLOBALS']->value['current_user']['username'] ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);
} else {
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['email']->value, ENT_QUOTES, 'UTF-8', true);
}?>" />
        </div>
        <div class="form-group">
          <textarea placeholder="<?php $_block_plugin11 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin11, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin11->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Comments<?php $_block_repeat=false;
echo $_block_plugin11->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>:" cols="20" rows="5" class="form-control" name="comments"><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['comments']->value, ENT_QUOTES, 'UTF-8', true);?>
</textarea>
        </div>
        <div class="form-group form-group__btns text-center">
          <input class="btn btn__bold btn__orange" type="submit" value="<?php $_block_plugin12 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin12, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin12->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Submit<?php $_block_repeat=false;
echo $_block_plugin12->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>" id="submit-contact"/>
        </div>
      </form>
      <div class="clear"></div>
    </div>
  </div>
</div>
<?php } else { ?>
<div class="row static-pages content-text">
  <div class="alert alert-success" role="alert"><?php $_block_plugin13 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin13, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin13->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Thank you very much for your message. We will respond to you as soon as possible.<?php $_block_repeat=false;
echo $_block_plugin13->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></div>
</div>
<?php }?> <?php }
}
