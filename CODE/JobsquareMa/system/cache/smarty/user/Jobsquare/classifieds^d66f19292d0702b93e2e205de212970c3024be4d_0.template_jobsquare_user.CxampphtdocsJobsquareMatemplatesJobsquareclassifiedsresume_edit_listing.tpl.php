<?php
/* Smarty version 4.3.0, created on 2026-02-28 23:48:32
  from 'template_jobsquare_user:CxampphtdocsJobsquareMatemplatesJobsquareclassifiedsresume_edit_listing.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_69a37ed07a6764_65893988',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd66f19292d0702b93e2e205de212970c3024be4d' => 
    array (
      0 => 'template_jobsquare_user:CxampphtdocsJobsquareMatemplatesJobsquareclassifiedsresume_edit_listing.tpl',
      1 => 1771758513,
      2 => 'template_jobsquare_user',
    ),
  ),
  'includes' => 
  array (
    'template_jobsquare_user:field_errors.tpl' => 8,
  ),
),false)) {
function content_69a37ed07a6764_65893988 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\JobsquareMa\\system\\ext\\Smarty\\libs\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),1=>array('file'=>'C:\\xampp\\htdocs\\JobsquareMa\\system\\ext\\Smarty\\libs\\plugins\\modifier.truncate.php','function'=>'smarty_modifier_truncate',),));
?>


<?php $_block_plugin1 = isset($_smarty_tpl->smarty->registered_plugins['block']['title'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['title'][0][0] : null;
if (!is_callable(array($_block_plugin1, '_tpl_title'))) {
throw new SmartyException('block tag \'title\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('title', array());
$_block_repeat=true;
echo $_block_plugin1->_tpl_title(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
$_block_plugin2 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin2, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin2->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Edit a <?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['listingTypeID']->value, ENT_QUOTES, 'UTF-8', true);
$_block_repeat=false;
echo $_block_plugin2->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_repeat=false;
echo $_block_plugin1->_tpl_title(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin3 = isset($_smarty_tpl->smarty->registered_plugins['block']['javascript'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['javascript'][0][0] : null;
if (!is_callable(array($_block_plugin3, '_tpl_javascript'))) {
throw new SmartyException('block tag \'javascript\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('javascript', array());
$_block_repeat=true;
echo $_block_plugin3->_tpl_javascript(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
       
	   :root {
    --primary: #2563eb;
    --primary-light: #dbeafe;
    --primary-dark: #1d4ed8;
    --secondary: #8b5cf6;
    --success: #10b981;
    --warning: #f59e0b;
    --danger: #ef4444;
    --dark: #1f2937;
    --light: #f9fafb;
    --gray-50: #f9fafb;
    --gray-100: #f3f4f6;
    --gray-200: #e5e7eb;
    --gray-300: #d1d5db;
    --gray-400: #9ca3af;
    --gray-500: #6b7280;
    --gray-600: #4b5563;
    --gray-700: #374151;
    --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    --radius: 12px;
    --radius-sm: 8px;
    --radius-lg: 16px;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Quick Tips Banner */
.quick-tips-banner {
    background: linear-gradient(135deg, #fff5f0 0%, #feeee0 100%);
    border-radius: 12px;
    padding: 20px 25px;
    margin: 20px 0;
    border: 2px solid #fdd0ba;
}

.tips-header {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 15px;
    color: #f59e0b;
    font-weight: 600;
    font-size: 1.1rem;
}

.tips-header i {
    color: #f59e0b;
}

.tip-item {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    color: #0c4a6e;
    font-size: 14px;
    line-height: 1.5;
    margin-bottom: 5px;
}

.tip-item i {
    color: #10b981;
    margin-top: 2px;
    flex-shrink: 0;
}

/* Experience Cards Container */
.experience-cards {
    display: flex;
    flex-direction: column;
    gap: 20px;
    margin: 25px 0;
}

/* Individual Experience Card */
.experience-card {
    
    gap: 20px;
    background: white;
    border: 1px solid #e5e7eb;
    border-radius: 4px;
    padding: 25px;
    position: relative;
    transition: all 0.3s ease;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

.experience-card:hover {
    border-color: #0055d9;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

/* Firm Icon - Large on left */
.firm-img {
    flex-shrink: 0;
    display: flex;
    align-items: flex-start;
    padding-top: 5px;
}

.firm-img i {
    font-size: 48px;
    color: #0055d9;
    background: #eff6ff;
    width: 70px;
    height: 70px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 12px;
}

/* Card Content */
.card-content-wrapper {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.card-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 15px;
}

.job-title {
    font-size: 14px;
    font-weight: 600;
    color: #0055d9;
    margin-bottom: 5px;
}

.company-info {
    color: #6b7280;
    display: flex;
    align-items: center;
    gap: 5px;
}

.company-info i {
    font-size: 0.9rem;
    color: #9ca3af;
}

.period {
    background: #dbeafe;
    color: #1d4ed8;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 500;
    white-space: nowrap;
}

/* Card Content and Actions */
.card-content {
    margin-bottom: 15px;
}

.job-description {
    color: #4b5563;
    line-height: 1.6;
    margin-bottom: 15px;
}

.card-actions {
    display: flex;
    gap: 10px;
    margin-top: auto;
}

/* Buttons */
.btn {
    padding: 8px 16px;
    border-radius: 4px;
    border: none;
    font-weight: 500;
    font-family: inherit;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size:14px;
	justify-content: center;
}

.btn-outline {
    background: transparent;
    color: #0055d9;
    border: 2px solid #0055d9;
	font-size:13px;
}

.btn-outline:hover {
    background: #0055d9;
    color: white;
}

.btn-secondary {
    background: #f3f4f6;
    color: #b02c2c;
    border: 1px solid #d1d5db;
    font-size: 13px;
}

.btn-secondary:hover {
    background: #e5e7eb;
    border-color: #9ca3af;
}

.btn-primary {
    background: #0055d9;
    color: white;
}

.btn-primary:hover {
    background: #2563eb;
}

/* Add Experience Button */
.add-experience-btn {
    
    border: 2px dashed #0055d9;
    border-radius: 12px;
    padding: 30px;
    display: flex;
    align-items: center;
	flex-direction:column;
    gap: 15px;
    cursor: pointer;
    transition: all 0.3s ease;
    color: #6b7280;
    text-align: center;
    margin-top: 20px;
 background: #f0f9ff;
}

.add-experience-btn:hover {
	background: white;
    border-color: #666;
    color: #666;
}


.add-icon {
    width: 50px;
    height: 50px;
    background: #0055d9;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    transition: all 0.3s ease;
	  color: white;
}

.add-experience-btn:hover .add-icon {
    background: #333;
    color: white;
}

/* Modal Styles */
.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    z-index: 1000;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.modal-content {
    background: white;
    border-radius: 12px;
    width: 100%;
    max-width: 600px;
    max-height: 90vh;
    overflow-y: auto;
}

.modal-header {
padding: 20px;
    border-bottom: 1px solid #e5e7eb;
    display: flex;
    justify-content: flex-start;
    align-items: center;
}

.modal-title {
    font-size: 1.3rem;
    font-weight: 600;
    color: #0055d9;
}

.modal-body {
    padding: 20px;
}

.modal-footer {
    padding: 15px 20px;
    border-top: 1px solid #e5e7eb;
    display: flex;
    justify-content: flex-end;
    gap: 10px;
}

.modal-close {
    background: none;
    border: none;
    font-size: 1.5rem;
    cursor: pointer;
    color: #6b7280;
    padding: 5px;
}

.modal-close:hover {
    color: #374151;
}

/* Form Styles */
.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 500;
    color: #374151;
   font-size:14px;
}

.form-group input,
.form-group textarea,
.form-group select {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    font-family: inherit;
    font-size: 14px;
    transition: all 0.3s ease;
    box-sizing: border-box;
}

.form-group input:focus,
.form-group textarea:focus,
.form-group select:focus {
    outline: none;
    border-color: #0055d9;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.form-group textarea {
    resize: vertical;
    min-height: 100px;
}

/* Checkbox Group */
.checkbox-group {
    margin: 10px 0 20px;
}

.checkbox-label {
    display: flex;
    align-items: center;
    gap: 8px;
    font-weight: 500;
    cursor: pointer;
    font-size:14px;
}

.checkbox-label input[type="checkbox"] {
    margin: 0;
    width: 16px;
    height: 16px;
}

/* Dates Row */
.dates-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 30px;
    margin-bottom: 20px;
}

.date-title {
    font-weight: 600;
    margin-bottom: 8px;
    font-size:13px;
    color: #0055d9;
}

.date-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
}

.date-grid select {
    width: 100%;
    min-height: 42px;
}

/* End Date Disabled State */
.end-date-disabled {
    opacity: 0.5;
    pointer-events: none;
}

.end-date-disabled h3,
.end-date-disabled label {
    color: #999;
}

.end-date-disabled select {
    background-color: #f2f2f2;
    cursor: not-allowed;
}

/* No Experiences State */
.no-experiences {
    text-align: center;
    padding: 40px;
    color: #666;
    font-style: italic;
}

.no-experiences i {
    font-size: 48px;
    margin-bottom: 20px;
    color: #ddd;
}

/* Hidden SJB Field */
.sjb-work-experience-field {
    position: absolute !important;
    left: -9999px !important;
    opacity: 0 !important;
    width: 1px !important;
    height: 1px !important;
    overflow: hidden !important;
    pointer-events: none !important;
}

.sjb-work-experience-field * {
    position: absolute !important;
    left: -9999px !important;
    opacity: 0 !important;
}

/* Responsive Styles */
@media (max-width: 768px) {
    .experience-card {
        flex-direction: column;
        gap: 15px;
    }
    
    .firm-img {
        align-self: flex-start;
    }
    
    .card-header {
        flex-direction: column;
        gap: 10px;
    }
    
    .period {
        align-self: flex-start;
    }
    
    .dates-row {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .add-experience-btn {
        flex-direction: column;
        text-align: center;
        gap: 10px;
    }
    
    .modal-content {
        margin: 10px;
    }
}

@media (max-width: 480px) {
    .card-actions {
        flex-direction: column;
    }
    
    .date-grid {
        grid-template-columns: 1fr;
    }
}
.dates-row .form-col {
    background: aliceblue;
    padding: 10px;
    border-radius: 4px;
}

.dates-row .form-col .form-group label {
    margin-bottom: 8px;
    font-weight: 500;
    color: #939394ff;
    font-size: 13px;
}

.date-validation-alert {
    margin-top: 15px;
    animation: fadeInDown 0.3s ease;
}

.alert-card {
    display: flex;
    align-items: flex-start;
    padding: 15px;
    border-radius: 8px;
    border: 1px solid;
    position: relative;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.alert-error {
    background-color: rgba(220, 53, 69, 0.08);
    border-color: rgba(220, 53, 69, 0.3);
    color: #721c24;
}

.alert-warning {
    background-color: rgba(255, 193, 7, 0.08);
    border-color: rgba(255, 193, 7, 0.3);
    color: #856404;
}

.alert-success {
    background-color: rgba(40, 167, 69, 0.08);
    border-color: rgba(40, 167, 69, 0.3);
    color: #155724;
}

.alert-icon {
    flex-shrink: 0;
    margin-right: 12px;
    font-size: 20px;
}

.alert-content {
    flex-grow: 1;
}

.alert-title {
    font-weight: 600;
    font-size: 14px;
    margin-bottom: 4px;
}

.alert-message {
    font-size: 13px;
    line-height: 1.4;
    opacity: 0.9;
}

.alert-close {
    background: none;
    border: none;
    color: inherit;
    opacity: 0.7;
    cursor: pointer;
    padding: 0;
    margin-left: 10px;
    font-size: 14px;
    transition: opacity 0.2s;
    flex-shrink: 0;
}

.alert-close:hover {
    opacity: 1;
}

/* Highlight invalid date fields */
.date-invalid {
    border-color: #dc3545 !important;
    background-color: rgba(220, 53, 69, 0.05) !important;
}

.date-invalid:focus {
    box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
}

@keyframes fadeInDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes shake {
    0%, 100% { transform: translateX(0); }
    10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
    20%, 40%, 60%, 80% { transform: translateX(5px); }
}

.alert-shake {
    animation: shake 0.5s ease;
}
    </style>
<?php $_block_repeat=false;
echo $_block_plugin3->_tpl_javascript(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
	<!--Back -->

						<div class="container">
								   
							<div class=" text-right">
								<?php if ($_smarty_tpl->tpl_vars['url']->value == "/my-resume-details/".((string)$_smarty_tpl->tpl_vars['listing']->value['id'])."/") {?>
									<a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/edit-<?php echo $_smarty_tpl->tpl_vars['listing']->value['type']['id'];?>
/?listing_id=<?php echo $_smarty_tpl->tpl_vars['listing']->value['id'];?>
"
									   class="btn__back btn__back_resume">
										 &raquo; <?php $_block_plugin4 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin4, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin4->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Back<?php $_block_repeat=false;
echo $_block_plugin4->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
									</a>
									<?php $_block_plugin5 = isset($_smarty_tpl->smarty->registered_plugins['block']['javascript'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['javascript'][0][0] : null;
if (!is_callable(array($_block_plugin5, '_tpl_javascript'))) {
throw new SmartyException('block tag \'javascript\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('javascript', array());
$_block_repeat=true;
echo $_block_plugin5->_tpl_javascript(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>
										<?php echo '<script'; ?>
 type="text/javascript">
											if (window.history && window.history.pushState) {
												window.history.pushState('forward', null, '');
												$(window).on('popstate', function() {
													window.location.href = '<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/edit-<?php echo $_smarty_tpl->tpl_vars['listing']->value['type']['id'];?>
/?listing_id=<?php echo $_smarty_tpl->tpl_vars['listing']->value['id'];?>
';
												});
											}
										<?php echo '</script'; ?>
>
									<?php $_block_repeat=false;
echo $_block_plugin5->_tpl_javascript(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
								<?php } else { ?>
									<?php if ($_smarty_tpl->tpl_vars['backPage']->value && is_numeric($_smarty_tpl->tpl_vars['searchID']->value)) {?>
										<a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/resumes/?searchID=<?php echo $_smarty_tpl->tpl_vars['searchID']->value;?>
&action=search&listings_per_page=<?php echo $_smarty_tpl->tpl_vars['backPage']->value*20;?>
#<?php echo $_smarty_tpl->tpl_vars['listing']->value['id'];?>
"
										   class="btn__back btn__back_resume ">
											&laquo; <?php $_block_plugin6 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin6, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin6->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Back<?php $_block_repeat=false;
echo $_block_plugin6->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
										</a>
									<?php } else { ?>
										<a href="javascript:history.go(-1)"
										   class="btn__back btn__back_resume">
											&laquo; <?php $_block_plugin7 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin7, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin7->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Back<?php $_block_repeat=false;
echo $_block_plugin7->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
										</a>
									<?php }?>
								<?php }?>
							</div>
						
						   
						</div>
				
				<!--Back -->

<!-- Menu Vertical Edit CV a gauche-->
<div class=" col-md-3">
<nav class="sidebar">

	<a class="sidebar__list-item <?php if ($_smarty_tpl->tpl_vars['currentPage']->value['order'] == 1) {?>is-active <?php }?>" href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/edit-resume/Interests/<?php echo $_smarty_tpl->tpl_vars['listingSID']->value;?>
" aria-current="page">Intérêts Professionnels</a>
		<a class="sidebar__list-item <?php if ($_smarty_tpl->tpl_vars['currentPage']->value['order'] == 2) {?>is-active <?php }?>"  href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/edit-resume/General/<?php echo $_smarty_tpl->tpl_vars['listingSID']->value;?>
">Informations  Générales</a>
	<a class="sidebar__list-item  <?php if ($_smarty_tpl->tpl_vars['currentPage']->value['order'] == 3) {?>is-active <?php }?>" href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/edit-resume/Professional/<?php echo $_smarty_tpl->tpl_vars['listingSID']->value;?>
">Informations  Professionnelles</a>
	<a class="sidebar__list-item  <?php if ($_smarty_tpl->tpl_vars['currentPage']->value['order'] == 4) {?>is-active <?php }?>" href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/edit-resume/Experience/<?php echo $_smarty_tpl->tpl_vars['listingSID']->value;?>
">Experience </a>
	<a class="sidebar__list-item  <?php if ($_smarty_tpl->tpl_vars['currentPage']->value['order'] == 5) {?>is-active <?php }?>" href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/edit-resume/Education/<?php echo $_smarty_tpl->tpl_vars['listingSID']->value;?>
">Education </a>
	<a class="sidebar__list-item  <?php if ($_smarty_tpl->tpl_vars['currentPage']->value['order'] == 6) {?>is-active <?php }?>" href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/edit-resume/PresenceOnline/<?php echo $_smarty_tpl->tpl_vars['listingSID']->value;?>
">Présence en ligne </a>
	<a class="sidebar__list-item  <?php if ($_smarty_tpl->tpl_vars['currentPage']->value['order'] == 7) {?>is-active <?php }?>" href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/edit-resume/Downloads/<?php echo $_smarty_tpl->tpl_vars['listingSID']->value;?>
">Documents</a>
<!--<a class="sidebar__list-item  <?php if ($_smarty_tpl->tpl_vars['currentPage']->value['order'] == 8) {?>is-active <?php }?>" href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/edit-resume/CVModels/<?php echo $_smarty_tpl->tpl_vars['listingSID']->value;?>
">Modèle CV Jobsquare</a>-->
   <a class="sidebar__list-item  <?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/resume/') {?>is-active <?php }?>" href=" <?php if ($_smarty_tpl->tpl_vars['GLOBALS']->value['user_page_uri'] == '/resume/') {?>#<?php } else {
echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/resume/<?php echo $_smarty_tpl->tpl_vars['listingSID']->value;
}?>">Visualiser CV</a>
			
	</nav>
	
	
	
	<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', "updateDate", null);
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'date' ][ 0 ], array( $_smarty_tpl->tpl_vars['update_date']->value ));
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
	<?php if (!empty($_smarty_tpl->tpl_vars['updateDate']->value) && $_smarty_tpl->tpl_vars['updateDate']->value != "30/11/-1") {?>
	
	<div class="pc-improve-profile-container css-8qkzbz e1l5ldaa0" <?php if (($_smarty_tpl->tpl_vars['today_date_3month']->value >= $_smarty_tpl->tpl_vars['update_date_3month']->value)) {?>background-color: #f8d7da; border-color: #f5c6cb;"<?php }?> >
	<div class="jobseeker-sidebar__profile-stats profile-stats jobseeker-sidebar__item">		
	<div class="listing-item__info--item-date ">
	<?php if (!empty($_smarty_tpl->tpl_vars['date_add']->value)) {?>
	<b>Membre depuis</b>:<br><span><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'date' ][ 0 ], array( $_smarty_tpl->tpl_vars['date_add']->value ));?>
</span>
	<?php }?>
	</div>
	<div class="listing-item__info--item-date ">
	<b><?php if (($_smarty_tpl->tpl_vars['today_date_3month']->value >= $_smarty_tpl->tpl_vars['update_date_3month']->value)) {?>Votre Cv n'est plus &agrave; jour!! <?php }?>Derni&egrave;re mise &agrave; jour</b>: 
		<span <?php if (($_smarty_tpl->tpl_vars['today_date_3month']->value < $_smarty_tpl->tpl_vars['update_date_3month']->value) && $_smarty_tpl->tpl_vars['percentage']->value > 89) {?>  style="color: #83ca4e;"<?php } elseif (($_smarty_tpl->tpl_vars['today_date_3month']->value >= $_smarty_tpl->tpl_vars['update_date_3month']->value)) {?>style="color: #721c24; background-color: #f8d7da; border-color: #f5c6cb;"<?php }?> ><?php echo $_smarty_tpl->tpl_vars['updateDate']->value;?>
</span>
	</div>
		
		
			
</div>
</div>
<?php }?>
	<div class="pc-improve-profile-container css-8qkzbz e1l5ldaa0" >
	<div class="jobseeker-sidebar__profile-stats profile-stats jobseeker-sidebar__item">
	
	<h3 class="profile-stats__title">Améliorer votre CV</h3>
	<p class="profile-stats__profile-views"><b><?php echo $_smarty_tpl->tpl_vars['views']->value;?>
</b> Employeur<?php if ($_smarty_tpl->tpl_vars['views']->value > 1) {?>s ont consulté<?php } else { ?> a consulté<?php }?> votre CV</p>
	<!--<div class="progress-bar" progress="<?php echo $_smarty_tpl->tpl_vars['percentage']->value;?>
" color="#FFAB00">
	<div class="progress-bar__inner" style="width: <?php echo $_smarty_tpl->tpl_vars['percentage']->value;?>
%; background: rgb(255, 171, 0);"></div>
	</div>-->
	<div class="meter green nostripes"> <span id="progress" style="width: <?php echo $_smarty_tpl->tpl_vars['percentage']->value;?>
%; background: rgb(165, 194, 66);display:block;height:15px;"></span></div>
	<p class="profile-stats__profile-strength">Votre CV est rempli à <?php echo $_smarty_tpl->tpl_vars['percentage']->value;?>
%</p>

	</div>
</div>

</div>
<!---->
<div class="resumesteps resume-info col-md-9">
<?php if ($_smarty_tpl->tpl_vars['today_date_3month']->value > $_smarty_tpl->tpl_vars['update_date_3month']->value) {?>
	
<div class="css-s2dgtn e128p6kr0 alert alert-danger alert-dismissible">
<!--<span class="css-g50631 e4y08cy0">
<i size="20"><img src="https://85.25.214.227/projects/TanitV8//templates/Jobsquare/assets/images/icon-jobsquare.png"></i>
	</span>-->
<button type="button" class="css-1v52m5x e128p6kr1 close"  data-dismiss="alert">
<i size="16" class="css-b80bsd e19xi9jy0">
<svg width="16" height="16" preserveAspectRatio="none" viewBox="0 0 24 24"><path fill="#B12121" d="M14.238 12L20 17.762 17.763 20 12 14.237 6.238 20 4 17.763 9.764 12 4 6.236l2.236-2.235h.002l5.763 5.762L17.764 4l2.235 2.236v.002L14.238 12z"></path></svg></i></button>
<div>  N'attendez plus pour valoriser vos talents et publiez vos nouvelles informations. La dernière mise à jour date de plus de 3 mois! -<a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/edit-resume/Interests/<?php echo $_smarty_tpl->tpl_vars['listing']->value['id'];?>
" style="color: rgb(177, 33, 33); font-weight: bold; text-decoration: underline;">Mettez votre CV à jour maintenant</a>
</div></div>
 
<?php }?>

<div class="css-1vh6i3x exkztdf0">
<div class="css-b9pwbv e128p6kr0">
<div><span class="css-g50631 e4y08cy0">
<i size="20" class="css-tjx49 e19xi9jy0"><img src="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/templates/Jobsquare/assets/images/icon-jobsquare.png" /></i>
</span>
<span class="css-2m6wmx e4y08cy1">CV Jobsquare</span>
<span class="css-uzhbcc e4y08cy2"> Récupérez votre CV en PDF prêt à l'emploi</span>
<div class="css-1xr94rl">
<?php if ($_smarty_tpl->tpl_vars['percentage']->value > 89) {?>
<a class="css-1ez1kl4 e1eq3cmo0" href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/my-resume-details/<?php echo $_smarty_tpl->tpl_vars['listingSID']->value;?>
/?action=download_pdf_version">
<?php $_block_plugin8 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin8, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin8->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Download PDF<?php $_block_repeat=false;
echo $_block_plugin8->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
</a>
<?php }?>
</div>
</div>
</div>
</div>
</div>


 <?php if ($_smarty_tpl->tpl_vars['currentPage']->value['order'] == 1) {?>

	
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['form_fields']->value, 'form_field');
$_smarty_tpl->tpl_vars['form_field']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['form_field']->value) {
$_smarty_tpl->tpl_vars['form_field']->do_else = false;
?>
		<?php $_smarty_tpl->_assignInScope('form_field', $_smarty_tpl->tpl_vars['form_field']->value ,false ,32);?>
	      <?php if ($_smarty_tpl->tpl_vars['form_field']->value['id'] == 'id_Resume_careerlevel') {?>
	
							<?php $_smarty_tpl->_assignInScope('Resume_CareerLevel', $_smarty_tpl->tpl_vars['form_field']->value);?>
         <?php } elseif ($_smarty_tpl->tpl_vars['form_field']->value['id'] == "EmploymentType") {?>	
					<?php $_smarty_tpl->_assignInScope('EmploymentType', $_smarty_tpl->tpl_vars['form_field']->value);?>
		<?php } elseif ($_smarty_tpl->tpl_vars['form_field']->value['id'] == "Title") {?>	
					<?php $_smarty_tpl->_assignInScope('DesiredTitle', $_smarty_tpl->tpl_vars['form_field']->value);?>
		<?php } elseif ($_smarty_tpl->tpl_vars['form_field']->value['id'] == "JobCategory") {?>	
					<?php $_smarty_tpl->_assignInScope('JobCategory', $_smarty_tpl->tpl_vars['form_field']->value);?>
		<?php } elseif ($_smarty_tpl->tpl_vars['form_field']->value['id'] == "salary") {?>	
					<?php $_smarty_tpl->_assignInScope('salary', $_smarty_tpl->tpl_vars['form_field']->value);?>
		<?php } elseif ($_smarty_tpl->tpl_vars['form_field']->value['id'] == "id_Resume_CurrentStatus") {?>	
					<?php $_smarty_tpl->_assignInScope('id_Resume_CurrentStatus', $_smarty_tpl->tpl_vars['form_field']->value);?>
		<?php } elseif ($_smarty_tpl->tpl_vars['form_field']->value['id'] == "Experience") {?>	
					<?php $_smarty_tpl->_assignInScope('Experience', $_smarty_tpl->tpl_vars['form_field']->value);?>
		<?php } elseif ($_smarty_tpl->tpl_vars['form_field']->value['id'] == "access_type") {?>	
					<?php $_smarty_tpl->_assignInScope('ResumeAccessType', $_smarty_tpl->tpl_vars['form_field']->value);?>
		<?php }?> 
      	 	
	<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	

	<div id="resumesteps" class="resumesteps resume-info col-md-9">
		<div class=" ">
			
			<div class="css-1wtdjp1 exkztdf0">
			
				<form method="post" action="" enctype="multipart/form-data" <?php if ((isset($_smarty_tpl->tpl_vars['listing']->value['ApplicationSettings']))) {?>onsubmit="return validateForm('editListingForm');"<?php }?> id="editListingForm" class="form">
						<input type="hidden" name="action" value="save_info" />
						
						<input type="hidden" name="listing_id" id="listing_id" value="<?php echo $_smarty_tpl->tpl_vars['listing']->value['id'];?>
" />

						<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['set_token_field'][0], array( array(),$_smarty_tpl ) );?>

				
				    <?php if ($_smarty_tpl->tpl_vars['redirectBackToJobID']->value) {?>				
					
				   <div class="css-1scoqbg e128p6kr0">
					  <div><?php $_block_plugin9 = isset($_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['tr'][0][0] : null;
if (!is_callable(array($_block_plugin9, 'translate'))) {
throw new SmartyException('block tag \'tr\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('tr', array());
$_block_repeat=true;
echo $_block_plugin9->translate(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Pour pouvoir postuler, veuillez mettre à jour votre CV Jobsquare. Vous devez avoir au minimum un CV complet à 90%.<?php $_block_repeat=false;
echo $_block_plugin9->translate(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>
					  </div>
				  </div>
				  <?php } else { ?>
				  <?php $_smarty_tpl->_subTemplateRender('template_jobsquare_user:field_errors.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
				  <?php }?>
					<div class=" resume-bloc ">
						<div class="section-title"><h2 class="resume_main-title">Quel est votre niveau d'experience Professionnelle?</h2></div>
						<div class=" eh8qwvv0">
							<div class="inner-bloc e67rya20">
							<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['input'][0], array( array('property'=>$_smarty_tpl->tpl_vars['Resume_CareerLevel']->value['id']),$_smarty_tpl ) );?>

							</div>
						</div>
					</div>
					
					<div class=" resume-bloc ">
						<div class="section-title">
							<h2 class="resume_main-title">À quel (s) type (s) d'emploi êtes-vous ouvert (e)?</h2>
							
								
								 <span class="desc_title"> — Type d'emploi désiré</span>
						
				
						  
						</div>
					<div class="css-pbed7v e8my37z0">
						<div class="css-14nywfj">
							<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['input'][0], array( array('property'=>$_smarty_tpl->tpl_vars['EmploymentType']->value['id']),$_smarty_tpl ) );?>

								
						</div>
					</div>
				</div>
			<div class="section-validation-error resume-bloc ">
				<div class="section-title">
					<h2 class="resume_main-title">Quel est le nom de poste / fonction  qui décrit ce que vous recherchez?</h2>
					 <span class="desc_title"> — Titre du poste désiré</span>
					
				</div>
				   <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['input'][0], array( array('property'=>$_smarty_tpl->tpl_vars['DesiredTitle']->value['id']),$_smarty_tpl ) );?>

				
			</div>
			<div class="section-validation-error resume-bloc ">
				<div class="section-title">
					<h2 class="resume_main-title">Quels sont les domaines d'activites qui vous intéressent?</h2>
					 <span class="desc_title"> — Max 5</span>
						
					</div>
					
					<div class="custom-selectbox">
						<div class="Select custom-selectbox__select  is-clearable is-searchable Select--multi">
							<div class="Select-control">
								
									<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['input'][0], array( array('property'=>$_smarty_tpl->tpl_vars['JobCategory']->value['id']),$_smarty_tpl ) );?>

							</div>
						</div> 
					</div>
				</div>
				<div class="section-validation-error resume-bloc ">
					<div class="section-title">
						<h2 class="resume_main-title">Quel est le salaire minimum que vous accepteriez?</h2>
						 <span class="desc_title"> — Ajoutez un salaire net (c-à-d, Le montant final que vous voulez recevoir après les taxes).
							
						</span>
					</div>
					<div class="css-bl1ilx e14ozvww0">
						<div class="css-1f2c5hb e14ozvww1">
							<div class="text-field-wrapper css-znsm0t">
								<div class="css-1ac03ny">
												
									<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['input'][0], array( array('property'=>$_smarty_tpl->tpl_vars['salary']->value['id']),$_smarty_tpl ) );?>

									<span class="css-wgn4vk e1gqe2o91">
						<span> NB: </span>
							<span class="css-1ugyivz e1gqe2o94">Le montant en Dinars Marocn</span>
						</span>
					
								</div>
							</div>
						</div>
						
					</div>
					
				</div>
				<div class="section-validation-error resume-bloc ">
					<div class="section-title">
						<h2 class="resume_main-title">Quel est votre statut actuel? </h2>
						 <span class="desc_title"> — Pourquoi vous êtes à la recherche d'un emploi?
							
						</span>
					</div>
					<div class="custom-selectbox">
						<div class="Select custom-selectbox__select  is-clearable is-searchable Select--single">
							<div class="Select-control">
								<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['input'][0], array( array('property'=>$_smarty_tpl->tpl_vars['id_Resume_CurrentStatus']->value['id']),$_smarty_tpl ) );?>

							</div>
						</div> 
					</div>
					<div class="css-1yq7fu5 e1v8ucbs0">
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['input'][0], array( array('property'=>$_smarty_tpl->tpl_vars['ResumeAccessType']->value['id']),$_smarty_tpl ) );?>

						
						<div class="css-1isemmb">
							<h1 type="H6" class="css-i1y1z6 ehwvnb90">Laissez les entreprises me trouver sur Jobsquare.ma. (Recommandé)</h1>
							<p class="css-d9v5op e1v8ucbs1">En activant cette option, vous augmenterez vos chances de vous faire chasser par les entreprises qui recherchent dans notre base de données.</p>
						</div>
						
					</div>
					
				</div>
				
	  
					<div class="css-7oyirr">
						<input type="hidden" name="action_add" id="hidden_action_add" value=""/>
						<input type="submit" name="preview_listing" value="Sauvegarder et continuer" class="css-txeug1 e1eq3cmo0" id="listingPreview"/>
					
				</div>
			
			
			</form>
		</div>
	</div>
	<div class="css-1t08rlo evbdj4a0">
		<div class="Toastify"></div>
	</div>
	<div></div>
</div>
   <?php } elseif ($_smarty_tpl->tpl_vars['currentPage']->value['order'] == 2) {?>


	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['form_fields']->value, 'form_field');
$_smarty_tpl->tpl_vars['form_field']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['form_field']->value) {
$_smarty_tpl->tpl_vars['form_field']->do_else = false;
?>
		<?php $_smarty_tpl->_assignInScope('form_field', $_smarty_tpl->tpl_vars['form_field']->value ,false ,32);?>
			
	      <?php if ($_smarty_tpl->tpl_vars['form_field']->value['id'] == 'Objective') {?>
				<?php $_smarty_tpl->_assignInScope('Objective', $_smarty_tpl->tpl_vars['form_field']->value);?>
         <?php } elseif ($_smarty_tpl->tpl_vars['form_field']->value['id'] == "Photo") {?>	
				<?php $_smarty_tpl->_assignInScope('Photo', $_smarty_tpl->tpl_vars['form_field']->value);?>
		<?php } elseif ($_smarty_tpl->tpl_vars['form_field']->value['id'] == "Phone") {?>	
					<?php $_smarty_tpl->_assignInScope('Phone', $_smarty_tpl->tpl_vars['form_field']->value);?>
		<?php } elseif ($_smarty_tpl->tpl_vars['form_field']->value['id'] == "Motorized") {?>	
					<?php $_smarty_tpl->_assignInScope('Motorized', $_smarty_tpl->tpl_vars['form_field']->value);?>
					<?php } elseif ($_smarty_tpl->tpl_vars['form_field']->value['id'] == "GooglePlace") {?>	
					<?php $_smarty_tpl->_assignInScope('GooglePlace', $_smarty_tpl->tpl_vars['form_field']->value);?>
		<?php } elseif ($_smarty_tpl->tpl_vars['form_field']->value['id'] == "OtherPhone") {?>	
					<?php $_smarty_tpl->_assignInScope('OtherPhone', $_smarty_tpl->tpl_vars['form_field']->value);?>
		<?php } elseif ($_smarty_tpl->tpl_vars['form_field']->value['id'] == "Licence") {?>	
					<?php $_smarty_tpl->_assignInScope('Licence', $_smarty_tpl->tpl_vars['form_field']->value);?>
		
		<?php } elseif ($_smarty_tpl->tpl_vars['form_field']->value['id'] == "access_type") {?>	
					<?php $_smarty_tpl->_assignInScope('ResumeAccessType', $_smarty_tpl->tpl_vars['form_field']->value);?>			

		<?php } elseif ($_smarty_tpl->tpl_vars['form_field']->value['id'] == "Location") {?>	
					<?php $_smarty_tpl->_assignInScope('Location', $_smarty_tpl->tpl_vars['form_field']->value);?>
		<?php }?> 
      	 	
	<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>


 <div id="resumesteps" class="resumesteps resume-info col-md-9">
	<div class="e14sx70q0">
		
	<div class="css-1wtdjp1 exkztdf0">
	
		
				<form method="post" action="" enctype="multipart/form-data" <?php if ((isset($_smarty_tpl->tpl_vars['listing']->value['ApplicationSettings']))) {?>onsubmit="return validateForm('editListingForm');"<?php }?> id="editListingForm" class="form">
						<input type="hidden" name="action" value="save_info" />
						<input type="hidden" name="listing_id" id="listing_id" value="<?php echo $_smarty_tpl->tpl_vars['listing']->value['id'];?>
" />

						<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['set_token_field'][0], array( array(),$_smarty_tpl ) );?>

				  
				  <?php $_smarty_tpl->_subTemplateRender('template_jobsquare_user:field_errors.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
	<div class="userphoto  resume-bloc ">
	<div class="text-field-wrapper css-znsm0t">
	<h2 class="resume_main-title">Photo de profil <span class="css-wgn4vk e1gqe2o91">- Inserez une photo de profil garentie une meilleur visibilité de votre CV, un CV sans photo de profil risque d'être negligé par les recruteurs.</span> </h2>
	<div class="css-1ac03ny">
					
						<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['input'][0], array( array('property'=>$_smarty_tpl->tpl_vars['Photo']->value['id']),$_smarty_tpl ) );?>

	</div>

		</div>
		</div>
		<br>
	<!--<div class="userphoto">
		<div class="userphoto__img">
		<div class="text-field-wrapper css-znsm0t">
	<?php if ($_smarty_tpl->tpl_vars['Photo']->value['id']) {?>
	
	<label for="fname" class="css-ybizro ebed2s31">Photo de profil</label>
	<div class="css-1ac03ny">
					
						<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['input'][0], array( array('property'=>$_smarty_tpl->tpl_vars['Photo']->value['id']),$_smarty_tpl ) );?>

	</div>
		
	<?php } else { ?>
	<div size="100" color="#808EA5" class="css-9zn6s3 e1vygdsj0">
	<div>M</div>
	</div>
	<?php }?>
		</div>
	</div>
	<div class="userphoto__content">
	<div class="css-13tiaj0 eclq2bk0">
	<h2 class="css-1li3g6j eclq2bk1">Photo de profil</h2>
	</div>
	<span class="userphoto__description">Vous pouvez télécharger une photo .jpg, .png ou .gif d'une taille maximale de 5 Mo.</span>

	<div class="userphoto__cta"><input type="file" accept=".jpg, .jpeg, .png, .gif" name="Photo" id="input_file_Photo" class="css-tgm4fq e161llcf0">
	<label class="userphoto__upload-btn css-1kqwv1a e161llcf1" for="profile-photo-file">Upload Your Photo</label>
	</div>
	
	</div>
	</div>
	-->
	
	
	<div class="section-validation-error resume-bloc ">
			<div class="section-title"><h2 class="resume_main-title">Vos informations personnelles</h2></div>
			<div class="css-rpi6b5 e6pv2vl0">
			
			    <div class="css-rpi6b5 e6pv2vl0 " style="margin-top: 20px;">
				           
							<div class="text-field-wrapper css-znsm0t  ">
								<div class="css-1ac03ny ">
									   <span class="css-tukd06 e1gqe2o92">
						<label class="custom-selectbox__label">Objectifs et Motivations (Lettre de Motivation) </h1>
						
				              	</span>			
									<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['input'][0], array( array('property'=>$_smarty_tpl->tpl_vars['Objective']->value['id']),$_smarty_tpl ) );?>

									
				
								</div>
							</div>
				</div>
			
		</div>
		
	
	
</div>
<div class=" resume-bloc ">
	<div class="section-title">
		<h2 class="resume_main-title">Votre emplacement</h2>
	</div>
	<div class="css-rpi6b5 e6pv2vl0">
		<div class="custom-selectbox">
			
			<div class="css-rpi6b5 e6pv2vl0">
				<div class="text-field-wrapper css-znsm0t">
					
					<div class="css-1ac03ny">
						<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['input'][0], array( array('property'=>$_smarty_tpl->tpl_vars['Location']->value['id']),$_smarty_tpl ) );?>

					</div>
				</div>
		    </div>
			
			<div class="css-rpi6b5 e6pv2vl0">
				<div class="text-field-wrapper css-znsm0t">
				<div class="form-group">
					<label class="custom-selectbox__label">Adresse</label>
					 <span class="desc_title"> — Rue, Appt, Résidence, cité ...
							
						</span>
				
					<div class="css-1ac03ny">
						<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['input'][0], array( array('property'=>$_smarty_tpl->tpl_vars['GooglePlace']->value['id']),$_smarty_tpl ) );?>

					</div>
					</div>
				</div>
		    </div>
			
		</div>
	</div>
	
		
		<div class="css-1yq7fu5 e1v8ucbs0">
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['input'][0], array( array('property'=>$_smarty_tpl->tpl_vars['Licence']->value['id']),$_smarty_tpl ) );?>

						
						<div class="css-1isemmb">
							<h1 type="H6" class="css-i1y1z6 ehwvnb90">Avez-vous un permis de conduire valide? </h1>
							<p class="css-d9v5op e1v8ucbs1">Si vous choisissez de mentionner votre permis de conduire sur votre CV, réfléchissez bien au préalable à ce que cela apporte à votre candidature et si cela est bien nécessaire pour le poste que vous cherchez.</p>
						</div>
						
		</div>
		<div class="css-1yq7fu5 e1v8ucbs0">
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['input'][0], array( array('property'=>$_smarty_tpl->tpl_vars['Motorized']->value['id']),$_smarty_tpl ) );?>

						
						<div class="css-1isemmb">
							<h1 type="H6" class="css-i1y1z6 ehwvnb90">Êtes - vous motorisé?</h1>
							<p class="css-d9v5op e1v8ucbs1">Prenez d’abord le temps de regarder les avantages et inconvénients à mettre en avant votre scooter, moto ou voiture sur votre CV.</p>
						</div>
						
		</div>
		
	</div>
	<div class="section-validation-error resume-bloc ">
		<div class="section-title">
			<h2 class="resume_main-title">Informations de contact</h2>
		</div>
		<div class="css-rpi6b5 e6pv2vl0">
			<div class="text-field-wrapper css-znsm0t">
			<div class="form-group">
				<label for="mnumber" class="css-ybizro ebed2s31">Numéro de portable</label>
				<div class="css-1ac03ny">
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['input'][0], array( array('property'=>$_smarty_tpl->tpl_vars['Phone']->value['id']),$_smarty_tpl ) );?>

				</div>
				</div>
			</div>
		</div>
		<div class="css-rpi6b5 e6pv2vl0">
			<div class="text-field-wrapper css-znsm0t">
			<div class="form-group">
				<label for="ophone" class="css-ybizro ebed2s31">Autre télephone
					<span class="css-y7u1of">— Optionnel</span>
				</label>
				<div class="css-1ac03ny">
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['input'][0], array( array('property'=>$_smarty_tpl->tpl_vars['OtherPhone']->value['id']),$_smarty_tpl ) );?>

				</div>
				</div>
			</div>
		</div>
	</div>
	<div class="css-7oyirr">
	  <input type="hidden" name="action_add" id="hidden_action_add" value=""/>
		<button type="submit" class="css-1kqwv1a e1eq3cmo0">Sauvegarder et continuer</button>
	<a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/edit-resume/Interests/<?php echo $_smarty_tpl->tpl_vars['listingSID']->value;?>
" style="background-color: white; border: 1px solid rgb(235, 237, 240);" class="css-wzp6tc e1eq3cmo0">Retour</a>
	</div>
</form>
</div>
</div>
<div class="css-1t08rlo evbdj4a0">
<div class="Toastify"></div>
</div>
<div>
</div>
</div>
<?php } elseif ($_smarty_tpl->tpl_vars['currentPage']->value['order'] == 3) {?>


	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['form_fields']->value, 'form_field');
$_smarty_tpl->tpl_vars['form_field']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['form_field']->value) {
$_smarty_tpl->tpl_vars['form_field']->do_else = false;
?>
		<?php $_smarty_tpl->_assignInScope('form_field', $_smarty_tpl->tpl_vars['form_field']->value ,false ,32);?>
		
	      <?php if ($_smarty_tpl->tpl_vars['form_field']->value['id'] == 'Objective') {?>
				<?php $_smarty_tpl->_assignInScope('Objective', $_smarty_tpl->tpl_vars['form_field']->value);?>
         <?php } elseif ($_smarty_tpl->tpl_vars['form_field']->value['id'] == "id_Job_Langue") {?>	
				<?php $_smarty_tpl->_assignInScope('id_Job_Langue', $_smarty_tpl->tpl_vars['form_field']->value);?>
		<?php } elseif ($_smarty_tpl->tpl_vars['form_field']->value['id'] == "Skills") {?>	
					<?php $_smarty_tpl->_assignInScope('Skills', $_smarty_tpl->tpl_vars['form_field']->value);?>
		<?php } elseif ($_smarty_tpl->tpl_vars['form_field']->value['id'] == "Education") {?>	
					<?php $_smarty_tpl->_assignInScope('Education', $_smarty_tpl->tpl_vars['form_field']->value);?>
		<?php } elseif ($_smarty_tpl->tpl_vars['form_field']->value['id'] == "Study") {?>	
					<?php $_smarty_tpl->_assignInScope('Study', $_smarty_tpl->tpl_vars['form_field']->value);?>
		<?php } elseif ($_smarty_tpl->tpl_vars['form_field']->value['id'] == "WorkExperience") {?>	
					<?php $_smarty_tpl->_assignInScope('WorkExperience', $_smarty_tpl->tpl_vars['form_field']->value);?>
		<?php } elseif ($_smarty_tpl->tpl_vars['form_field']->value['id'] == "Experience") {?>	
					<?php $_smarty_tpl->_assignInScope('Experience', $_smarty_tpl->tpl_vars['form_field']->value);?>
		<?php } elseif ($_smarty_tpl->tpl_vars['form_field']->value['id'] == "Resume") {?>	
					<?php $_smarty_tpl->_assignInScope('Resume', $_smarty_tpl->tpl_vars['form_field']->value);?>
		<?php }?> 
      	 	
	<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
					
					
<div id="resumesteps" class="resumesteps resume-info col-md-9">
	<div class="e14sx70q0">
	
		<div class="css-1wtdjp1 exkztdf0">
			
			
		
				<form method="post" action="" enctype="multipart/form-data" <?php if ((isset($_smarty_tpl->tpl_vars['listing']->value['ApplicationSettings']))) {?>onsubmit="return validateForm('editListingForm');"<?php }?> id="editListingForm" class="form">
						<input type="hidden" name="action" value="save_info" />
						<input type="hidden" name="listing_id" id="listing_id" value="<?php echo $_smarty_tpl->tpl_vars['listing']->value['id'];?>
" />

						<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['set_token_field'][0], array( array(),$_smarty_tpl ) );?>

				
				  
				  <?php $_smarty_tpl->_subTemplateRender('template_jobsquare_user:field_errors.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
			
				
			
			<div class="resume-bloc ">
				<div class="section-title">
					<h2 class="resume_main-title">Quelles langues connaissez-vous?
						<span class="css-wgn4vk e1gqe2o91">— Vous pouvez ajouter plusieurs</span>
					</h2>
				</div>
				
				<div name="talentLanguageForm">
					<div class="css-eio8xc e6pv2vl3">
						
							<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['input'][0], array( array('property'=>$_smarty_tpl->tpl_vars['id_Job_Langue']->value['id']),$_smarty_tpl ) );?>

						
					</div>
					</div>
				<div>
			</div>
			<div class="container mt-30">
				<div class="col-6"></div>
			</div>
			<div class="container mt-30">
				<div class="col-6"></div>
			</div>
		</div>
		<div class="resume-bloc ">
			<div class="section-title">
				<h2 class="resume_main-title">De quelles compétences, outils, technologies et domaines d'expertise disposez-vous?</h2>
				 <span class="desc_title"> — Prenez le temps de comprendre quelles sont les compétences essentielles pour le poste auquel vous postulez.
				</span>
			</div>
			<div type="full-width" class="css-41u6q2 e6pv2vl0">
				<div class="custom-selectbox"> 
					  <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['input'][0], array( array('property'=>$_smarty_tpl->tpl_vars['Skills']->value['id']),$_smarty_tpl ) );?>

				</div>
			</div>
		</div>
	<div class="upload-cv resume-bloc ">
		<div class="section-title">
			<h1 class="css-esj582 e12vjvm83">Télécharger votre CV</h1>
			<span class="css-djskp8 e12vjvm82">
				<span class="css-16ghou"> — Optionnelle</span>
			</span>
		</div>
		<span class="css-vzfgfo">Fichiers accepter: <b>.docx</b>, <b>.doc</b> or <b>.pdf</b>, avec une taille maximale de 5MB</span>
		<div class="css-6n7j50" style="position: relative;" aria-disabled="false">
			
		  <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['input'][0], array( array('property'=>$_smarty_tpl->tpl_vars['Resume']->value['id']),$_smarty_tpl ) );?>

		  </div>
	</div>
	<div class="css-7oyirr">
	<input type="hidden" name="action_add" id="hidden_action_add" value=""/>
		<button type="submit" class="css-1kqwv1a e1eq3cmo0">Valider </button>
		<a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/edit-resume/General/<?php echo $_smarty_tpl->tpl_vars['listingSID']->value;?>
" style="background-color: white; border: 1px solid rgb(235, 237, 240);" class="css-wzp6tc e1eq3cmo0">Retour</a>
	</div>
</form>
</div>
</div>
<div class="css-1t08rlo evbdj4a0">
	<div class="Toastify">
</div>
</div>
<div>
</div>
</div>


<?php } elseif ($_smarty_tpl->tpl_vars['currentPage']->value['order'] == 4) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['form_fields']->value, 'form_field');
$_smarty_tpl->tpl_vars['form_field']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['form_field']->value) {
$_smarty_tpl->tpl_vars['form_field']->do_else = false;
?>
    <?php $_smarty_tpl->_assignInScope('form_field', $_smarty_tpl->tpl_vars['form_field']->value ,false ,32);?>
    <?php if ($_smarty_tpl->tpl_vars['form_field']->value['id'] == "WorkExperience") {?>
        <?php $_smarty_tpl->_assignInScope('WorkExperience', $_smarty_tpl->tpl_vars['form_field']->value);?>
        <?php $_smarty_tpl->_assignInScope('experienceConfig', $_smarty_tpl->tpl_vars['form_field']->value);?>
    <?php } elseif ($_smarty_tpl->tpl_vars['form_field']->value['id'] == "Experience") {?>
        <?php $_smarty_tpl->_assignInScope('Experience', $_smarty_tpl->tpl_vars['form_field']->value);?>
    <?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

<div id="resumesteps" class="resumesteps resume-info col-md-9">
    <div class="e14sx70q0">
        <div class="css-1wtdjp1 exkztdf0">
            <form method="post" action="" enctype="multipart/form-data"
                <?php if ((isset($_smarty_tpl->tpl_vars['listing']->value['ApplicationSettings']))) {?>onsubmit="return validateForm('editListingForm');"<?php }?>
                id="editListingForm" class="form">
                <input type="hidden" name="action" value="save_info" />
                <input type="hidden" name="listing_id" id="listing_id" value="<?php echo $_smarty_tpl->tpl_vars['listing']->value['id'];?>
" />
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['set_token_field'][0], array( array(),$_smarty_tpl ) );?>

                <?php $_smarty_tpl->_subTemplateRender('template_jobsquare_user:field_errors.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

                <div class="resume-bloc">
                    <div class="section-title">
                        <h2 class="resume_main-title">Quel est le nombre d'années de votre expérience?</h2>
                    </div>
                    <div class="eh8qwvv0">
                        <div class="inner-bloc e67rya20">
                            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['input'][0], array( array('property'=>$_smarty_tpl->tpl_vars['Experience']->value['id']),$_smarty_tpl ) );?>

                        </div>
                    </div>
                </div>

                <div class="resume-bloc">
                    <div class="section-title">
                        <h2 class="resume_main-title">Détails de l'expérience</h2>
                    </div>

                    <!-- Instructions -->
                    <div class="quick-tips-banner">
                        <div class="tips-header">
                            <i class="fas fa-bolt"></i>
                            <span>Instructions importantes</span>
                        </div>
                        <div class="tips-content">
                            <div class="tip-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Classez vos expériences de la plus récente à la plus ancienne</span>
                            </div>
                            <div class="tip-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Ajoutez d'abord votre expérience la plus récente</span>
                            </div>
                        </div>
                    </div>

                    <!-- Container pour les cartes d'expérience -->
                    <div class="experience-cards" id="experienceCardsContainer">
                        <?php if ($_smarty_tpl->tpl_vars['existingExperiences']->value && is_array($_smarty_tpl->tpl_vars['existingExperiences']->value)) {?>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['existingExperiences']->value, 'exp', false, 'index');
$_smarty_tpl->tpl_vars['exp']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['index']->value => $_smarty_tpl->tpl_vars['exp']->value) {
$_smarty_tpl->tpl_vars['exp']->do_else = false;
?>
                                <?php if (is_array($_smarty_tpl->tpl_vars['exp']->value)) {?>
									<div class="firm-img"><i class="fas fa-building"></i></div>
                                    <div class="experience-card" data-index="<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
">
                                        <div class="card-header">
                                            <div>
                                                <div class="job-title"><?php echo (($tmp = $_smarty_tpl->tpl_vars['exp']->value['WE_JobTitle'] ?? null)===null||$tmp==='' ? 'Poste non spécifié' ?? null : $tmp);?>
</div>
                                                <div class="company-info">
                                                    <span><?php echo (($tmp = $_smarty_tpl->tpl_vars['exp']->value['WE_Company'] ?? null)===null||$tmp==='' ? 'Entreprise non spécifiée' ?? null : $tmp);?>
</span>
                                                </div>
                                            </div>
                                            <div class="period">
                                                <?php if ((isset($_smarty_tpl->tpl_vars['exp']->value['WE_From']))) {?>
                                                    <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['exp']->value['WE_From'],"%Y-%m");?>

                                                <?php }?>
                                                <?php if ((isset($_smarty_tpl->tpl_vars['exp']->value['WE_To'])) && $_smarty_tpl->tpl_vars['exp']->value['WE_To']) {?>
                                                    - <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['exp']->value['WE_To'],"%Y-%m");?>

                                                <?php } elseif ((isset($_smarty_tpl->tpl_vars['exp']->value['WE_Iworkhere'])) && $_smarty_tpl->tpl_vars['exp']->value['WE_Iworkhere'] == 1) {?>
                                                    - Présent
                                                <?php }?>
                                            </div>
                                        </div>
                                        <?php if ((isset($_smarty_tpl->tpl_vars['exp']->value['WE_Description']))) {?>
                                            <div class="card-content">
                                                <p class="job-description"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['exp']->value['WE_Description'],200);?>
</p>
                                            </div>
                                        <?php }?>
                                        <div class="card-actions">
                                            <button type="button" class="btn btn-outline" onclick="editExperience(<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
)">
                                                <i class="fas fa-edit"></i> Modifier
                                            </button>
                                            <button type="button" class="btn btn-secondary" onclick="deleteExperience(<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
)">
                                                <i class="fas fa-trash"></i> Supprimer
                                            </button>
                                        </div>
                                    </div>
                                <?php }?>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        <?php } else { ?>
                            <div class="no-experiences" style="text-align: center; padding: 40px; color: #666; font-style: italic;">
                                <i class="fas fa-briefcase" style="font-size: 48px; margin-bottom: 20px; color: #ddd;"></i><br>
                                Aucune expérience ajoutée pour le moment
                            </div>
                        <?php }?>
                    </div>

                    <!-- Bouton pour ajouter une expérience -->
                    <div class="add-experience-btn" onclick="showExperienceModal()">
                        <div class="add-icon">
                            <i class="fas fa-plus"></i>
                        </div>
                        <div>
                            <div style="font-weight: 600;color: #0055d9; font-size: 18px; margin-bottom: 5px;">Ajouter une expérience</div>
                            <div style="font-size: 0.9rem;">Cliquez pour ajouter une nouvelle expérience professionnelle</div>
                        </div>
                    </div>

                    <!-- SMARTJOBBOARD FIELD - KEPT VISIBLE BUT HIDDEN WITH CSS -->
                    <div class="sjb-work-experience-field" >
                        
                    </div>
                </div>

                <!-- Submit buttons -->
                <div class="css-7oyirr">
                    <input type="hidden" name="action_add" id="hidden_action_add" value=""/>
                    <button type="submit" class="css-1kqwv1a e1eq3cmo0" onclick="return prepareFormBeforeSubmit()">Valider</button>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/edit-resume/Professional/<?php echo $_smarty_tpl->tpl_vars['listingSID']->value;?>
" class="css-wzp6tc e1eq3cmo0">
                        <i class="fas fa-arrow-left"></i> Retour
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal pour ajouter/modifier une expérience -->
<div class="modal" id="experienceModal" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="modal-title" id="modalTitle">Ajouter une Expérience</h2>
            <button class="modal-close" onclick="closeModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
			<div class="date-validation-alert" id="dateValidationAlert" style="display: none;">
    			<div class="alert-card alert-error">
        			<div class="alert-icon">
            			<i class="fas fa-exclamation-circle"></i>
        			</div>
        			<div class="alert-content">
            			<div class="alert-title">Erreur de validation des dates</div>
            			<div class="alert-message" id="dateErrorMsg">La date de fin doit être postérieure à la date de début</div>
        			</div>
        			<button class="alert-close" onclick="hideDateAlert('experience')">
            			<i class="fas fa-times"></i>
        			</button>
    			</div>
			</div>
            <form id="experienceForm">
                <div class="form-group">
                    <label>Nom de l'entreprise *</label>
                    <input type="text" id="company_name" name="company_name" required>
                </div>
                <div class="form-group">
                    <label>Poste occupé *</label>
                    <input type="text" id="job_title" name="job_title" required>
                </div>
				<div class="form-group checkbox-group">
    				<label class="checkbox-label">
        				<input type="checkbox" id="current_job" onchange="toggleCurrentJob()">
        				<span>Je travaille encore dans ce poste</span>
    				</label>
				</div>
				
				
				<div class="form-row dates-row">
    				<div class="form-col">
        				<div class="date-title">Date de début *</div>
        				<div class="date-grid">
            				<div class="form-group">
                				<label>Mois</label>
                				<select id="start_month" required>
                    				<option value="">Mois</option>
                    				<option value="01">Janvier</option>
                    				<option value="02">Février</option>
                    				<option value="03">Mars</option>
                    				<option value="04">Avril</option>
                    				<option value="05">Mai</option>
                    				<option value="06">Juin</option>
                    				<option value="07">Juillet</option>
                    				<option value="08">Août</option>
                    				<option value="09">Septembre</option>
                    				<option value="10">Octobre</option>
                    				<option value="11">Novembre</option>
                    				<option value="12">Décembre</option>
                				</select>
            				</div>
            				<div class="form-group">
                				<label>Année</label>
                				<select id="start_year" required></select>
            				</div>
        				</div>
    				</div>
    				<div class="form-col end-date-col" id="endDateCol">
        				<div class="date-title">Date de fin</div>
        				<div class="date-grid">
            				<div class="form-group">
                				<label>Mois</label>
                				<select id="end_month">
                    				<option value="">Mois</option>
                    				<option value="01">Janvier</option>
                    				<option value="02">Février</option>
                    				<option value="03">Mars</option>
                    				<option value="04">Avril</option>
                    				<option value="05">Mai</option>
                    				<option value="06">Juin</option>
                    				<option value="07">Juillet</option>
                    				<option value="08">Août</option>
                    				<option value="09">Septembre</option>
                    				<option value="10">Octobre</option>
                    				<option value="11">Novembre</option>
                    				<option value="12">Décembre</option>
                				</select>
            				</div>
            				<div class="form-group">
                				<label>Année</label>
                				<select id="end_year"></select>
            				</div>
        				</div>
    				</div>
				</div>
                
                <div class="form-group">
                    <label>Description *</label>
                    <textarea id="description" name="description" rows="4" required></textarea>
                </div>
                
                <input type="hidden" id="experienceIndex" value="-1">
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="closeModal()">Annuler</button>
            <button type="button" class="btn btn-primary" onclick="saveExperience()">
                <i class="fas fa-check"></i> Enregistrer
            </button>
        </div>
    </div>
</div>




/* **************************** */
<?php } elseif ($_smarty_tpl->tpl_vars['currentPage']->value['order'] == 5) {?>

<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['form_fields']->value, 'form_field');
$_smarty_tpl->tpl_vars['form_field']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['form_field']->value) {
$_smarty_tpl->tpl_vars['form_field']->do_else = false;
?>
    <?php $_smarty_tpl->_assignInScope('form_field', $_smarty_tpl->tpl_vars['form_field']->value ,false ,32);?>
    <?php if ($_smarty_tpl->tpl_vars['form_field']->value['id'] == "Education") {?>
        <?php $_smarty_tpl->_assignInScope('Education', $_smarty_tpl->tpl_vars['form_field']->value);?>
    <?php } elseif ($_smarty_tpl->tpl_vars['form_field']->value['id'] == "Study") {?>
        <?php $_smarty_tpl->_assignInScope('Study', $_smarty_tpl->tpl_vars['form_field']->value);?>
    <?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

<div id="resumesteps" class="resumesteps resume-info col-md-9">
    <div class="e14sx70q0">
        <div class="css-1wtdjp1 exkztdf0">

            <form method="post"
                  action=""
                  enctype="multipart/form-data"
                  id="editListingForm"
                  class="form"
                  onsubmit="return prepareFormBeforeSubmit();">

                <input type="hidden" name="action" value="save_info" />
                <input type="hidden" name="listing_id" value="<?php echo $_smarty_tpl->tpl_vars['listing']->value['id'];?>
" />
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['set_token_field'][0], array( array(),$_smarty_tpl ) );?>

                <?php $_smarty_tpl->_subTemplateRender('template_jobsquare_user:field_errors.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

                <!-- ================= CURRENT STUDY LEVEL ================= -->
                <div class="resume-bloc">
                    <div class="section-title">
                        <h2 class="resume_main-title">
                            Quel est votre niveau d'étude actuel ?
                        </h2>
                        <span class="desc_title">
                            — Si vous étudiez actuellement, sélectionnez votre prochain diplôme
                        </span>
                    </div>

                    <div class="inner-bloc e67rya20">
                        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['input'][0], array( array('property'=>$_smarty_tpl->tpl_vars['Study']->value['id']),$_smarty_tpl ) );?>

                    </div>
                </div>

                <!-- ================= EDUCATION DETAILS ================= -->

                <div class="resume-bloc">
					<div class="quick-tips-banner">
                        <div class="tips-header">
                            <i class="fas fa-bolt"></i>
                            <span>Instructions importantes</span>
                        </div>
                        <div class="tips-content">
                            <div class="tip-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Classez vos études de la plus récente à la plus ancienne</span>
                            </div>
                            <div class="tip-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Ajoutez d'abord votre <b>dernier diplôme</b></span>
                            </div>
                        </div>
                    </div>
                    <!-- ===== EDUCATION CARDS ===== -->
                    <div class="experience-cards" id="educationCardsContainer">
                        <?php if ($_smarty_tpl->tpl_vars['existingEducations']->value && is_array($_smarty_tpl->tpl_vars['existingEducations']->value)) {?>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['existingEducations']->value, 'edu', false, 'index');
$_smarty_tpl->tpl_vars['edu']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['index']->value => $_smarty_tpl->tpl_vars['edu']->value) {
$_smarty_tpl->tpl_vars['edu']->do_else = false;
?>
                                <?php if (is_array($_smarty_tpl->tpl_vars['edu']->value)) {?>
                                    <div class="experience-card" data-index="<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
">
                                        <div class="card-header">
                                            <div>
                                                <div class="job-title">
                                                    <?php echo (($tmp = $_smarty_tpl->tpl_vars['edu']->value['ED_DegreeSpecialty'] ?? null)===null||$tmp==='' ? 'Diplôme non spécifié' ?? null : $tmp);?>

                                                </div>
                                                <div class="company-info">
                                                    <i class="fas fa-university"></i>
                                                    <span>
                                                        <?php echo (($tmp = $_smarty_tpl->tpl_vars['edu']->value['ED_UniversityInstitution'] ?? null)===null||$tmp==='' ? 'Établissement non spécifié' ?? null : $tmp);?>

                                                    </span>
                                                </div>
                                            </div>

                                            <div class="period">
                                                <?php if ($_smarty_tpl->tpl_vars['edu']->value['ED_From']) {?>
                                                    <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['edu']->value['ED_From'],"%Y-%m");?>

                                                <?php }?>
                                                <?php if ($_smarty_tpl->tpl_vars['edu']->value['ED_To']) {?>
                                                    - <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['edu']->value['ED_To'],"%Y-%m");?>

                                                <?php } elseif ($_smarty_tpl->tpl_vars['edu']->value['WE_Istudyhere'] == 1) {?>
                                                    - Présent
                                                <?php }?>
                                            </div>
                                        </div>

                                        <div class="card-actions">
                                            <button type="button"
                                                    class="btn btn-outline"
                                                    onclick="showModal('education', <?php echo $_smarty_tpl->tpl_vars['index']->value;?>
)">
                                                <i class="fas fa-edit"></i> Modifier
                                            </button>
                                            <button type="button"
                                                    class="btn btn-secondary"
                                                    onclick="deleteItem('education', <?php echo $_smarty_tpl->tpl_vars['index']->value;?>
)">
                                                <i class="fas fa-trash"></i> Supprimer
                                            </button>
                                        </div>
                                    </div>
                                <?php }?>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        <?php } else { ?>
                            <div class="no-experiences" style="text-align:center;padding:40px;color:#777;">
                                <i class="fas fa-graduation-cap"
                                   style="font-size:48px;color:#ddd;"></i><br>
                                Aucune étude ajoutée pour le moment
                            </div>
                        <?php }?>
                    </div>

                    <!-- ===== ADD STUDY BUTTON ===== -->
                    <div class="add-experience-btn" onclick="showModal('education')">
                        <div class="add-icon">
                            <i class="fas fa-plus"></i>
                        </div>
                        <div>
                            <div style="font-weight: 600;color: #0055d9; font-size: 18px; margin-bottom: 5px;">Ajouter une étude</div>
                            <div style="font-size:0.9rem;">
                                Cliquez pour ajouter une nouvelle formation
                            </div>
                        </div>
                    </div>
					
                    <!-- ===== SMARTJOBBOARD HIDDEN FIELD ===== -->
                    <div class="sjb-education-field"></div>
                </div>

                <!-- ================= SUBMIT ================= -->
                <div class="css-7oyirr">
                    <input type="hidden" name="action_add" id="hidden_action_add" value="" />
                    <button type="submit" class="css-1kqwv1a e1eq3cmo0">
                        Valider
                    </button>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/edit-resume/Experience/<?php echo $_smarty_tpl->tpl_vars['listingSID']->value;?>
"
                       class="css-wzp6tc e1eq3cmo0"
                       style="background:#fff;border:1px solid #ebedf0;">
                        Retour
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>
<!-- ================= EDUCATION MODAL ================= -->
<div class="modal" id="educationModal" style="display: none;">
    <div class="modal-content">

        <!-- ===== MODAL HEADER ===== -->
        <div class="modal-header">
            <h2 class="modal-title" id="educationModalTitle">
                Ajouter une étude
            </h2>
            <button type="button" class="modal-close" onclick="closeModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- ===== MODAL BODY ===== -->
        <div class="modal-body">
			<div class="date-validation-alert" id="dateValidationAlert" style="display: none;">
    			<div class="alert-card alert-error">
        			<div class="alert-icon">
            			<i class="fas fa-exclamation-circle"></i>
        			</div>
        			<div class="alert-content">
            		<div class="alert-title">Erreur de validation des dates</div>
            			<div class="alert-message" id="dateErrorMsg">La date de fin doit être postérieure à la date de début</div>
        			</div>
        			<button class="alert-close" onclick="hideDateAlert('education')">
            			<i class="fas fa-times"></i>
        			</button>
    			</div>
			</div>
            <form id="educationForm">

                <!-- DEGREE / SPECIALTY -->
                <div class="form-group">
                    <label>Diplôme / Spécialité *</label>
                    <input type="text"
                           id="edu_degree"
                           name="edu_degree"
                           required>
                </div>

                <!-- INSTITUTION -->
                <div class="form-group">
                    <label>Établissement *</label>
                    <input type="text"
                           id="edu_institution"
                           name="edu_institution"
                           required>
                </div>

                <!-- CURRENT STUDY -->
                <div class="form-group checkbox-group">
                    <label class="checkbox-label">
                        <input type="checkbox"
                               id="edu_current"
                               name="edu_current">
                        <span>J'étudie actuellement ici</span>
                    </label>
                </div>

                <!-- DATES -->
                <div class="form-row dates-row">
    				<div class="form-col" >
        				<div class="date-title">Date de début *</div>
        				<div class="date-grid">
            				<div class="form-group">
                				<label>Mois</label>
                				<select id="start_month" required>
                    				<option value="">Mois</option>
                    				<option value="01">Janvier</option>
                    				<option value="02">Février</option>
                    				<option value="03">Mars</option>
                    				<option value="04">Avril</option>
                    				<option value="05">Mai</option>
                    				<option value="06">Juin</option>
                    				<option value="07">Juillet</option>
                    				<option value="08">Août</option>
                    				<option value="09">Septembre</option>
                    				<option value="10">Octobre</option>
                    				<option value="11">Novembre</option>
                    				<option value="12">Décembre</option>
                				</select>
            				</div>
            				<div class="form-group">
                				<label>Année</label>
                				<select id="start_year" required></select>
            				</div>
        				</div>
    				</div>
    				<div class="form-col end-date-col" id="endDateCol">
        				<div class="date-title">Date de fin</div>
        				<div class="date-grid">
            				<div class="form-group">
                				<label>Mois</label>
                				<select id="end_month">
                    				<option value="">Mois</option>
                    				<option value="01">Janvier</option>
                    				<option value="02">Février</option>
                    				<option value="03">Mars</option>
                    				<option value="04">Avril</option>
                    				<option value="05">Mai</option>
                    				<option value="06">Juin</option>
                    				<option value="07">Juillet</option>
                    				<option value="08">Août</option>
                    				<option value="09">Septembre</option>
                    				<option value="10">Octobre</option>
                    				<option value="11">Novembre</option>
                    				<option value="12">Décembre</option>
                				</select>
            				</div>
            				<div class="form-group">
                				<label>Année</label>
                				<select id="end_year"></select>
            				</div>
        				</div>
    				</div>
				</div>

                <!-- HIDDEN INDEX -->
                <input type="hidden" id="educationIndex" value="-1">

            </form>
        </div>

        <!-- ===== MODAL FOOTER ===== -->
        <div class="modal-footer">
            <button type="button"
                    class="btn btn-secondary"
                    onclick="closeModal()">
                Annuler
            </button>

            <button type="button"
                    class="btn btn-primary">
                <i class="fas fa-check"></i>
                Enregistrer
            </button>
        </div>

    </div>
</div>



	<?php } elseif ($_smarty_tpl->tpl_vars['currentPage']->value['order'] == 6) {?>


	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['form_fields']->value, 'form_field');
$_smarty_tpl->tpl_vars['form_field']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['form_field']->value) {
$_smarty_tpl->tpl_vars['form_field']->do_else = false;
?>
		<?php $_smarty_tpl->_assignInScope('form_field', $_smarty_tpl->tpl_vars['form_field']->value ,false ,32);?>
		
	    
			<?php if ($_smarty_tpl->tpl_vars['form_field']->value['id'] == "Linkedin_link") {?>	
					<?php $_smarty_tpl->_assignInScope('Linkedin', $_smarty_tpl->tpl_vars['form_field']->value);?>
					<?php } elseif ($_smarty_tpl->tpl_vars['form_field']->value['id'] == "Facebook_link") {?>	
					<?php $_smarty_tpl->_assignInScope('Facebook', $_smarty_tpl->tpl_vars['form_field']->value);?>
					<?php } elseif ($_smarty_tpl->tpl_vars['form_field']->value['id'] == "Twitter_link") {?>	
					<?php $_smarty_tpl->_assignInScope('Twitter', $_smarty_tpl->tpl_vars['form_field']->value);?>
					<?php } elseif ($_smarty_tpl->tpl_vars['form_field']->value['id'] == "Behance_link") {?>	
					<?php $_smarty_tpl->_assignInScope('Behance', $_smarty_tpl->tpl_vars['form_field']->value);?>
					<?php } elseif ($_smarty_tpl->tpl_vars['form_field']->value['id'] == "Instagram_link") {?>	
					<?php $_smarty_tpl->_assignInScope('Instagram', $_smarty_tpl->tpl_vars['form_field']->value);?>
					<?php } elseif ($_smarty_tpl->tpl_vars['form_field']->value['id'] == "GitHub_link") {?>	
					<?php $_smarty_tpl->_assignInScope('GitHub', $_smarty_tpl->tpl_vars['form_field']->value);?>
					<?php } elseif ($_smarty_tpl->tpl_vars['form_field']->value['id'] == "StackOverflow_link") {?>	
					<?php $_smarty_tpl->_assignInScope('StackOverflow', $_smarty_tpl->tpl_vars['form_field']->value);?>
					<?php } elseif ($_smarty_tpl->tpl_vars['form_field']->value['id'] == "YouTube_link") {?>	
					<?php $_smarty_tpl->_assignInScope('YouTube', $_smarty_tpl->tpl_vars['form_field']->value);?>
					<?php } elseif ($_smarty_tpl->tpl_vars['form_field']->value['id'] == "Blog_link") {?>	
					<?php $_smarty_tpl->_assignInScope('Blog', $_smarty_tpl->tpl_vars['form_field']->value);?>
					<?php } elseif ($_smarty_tpl->tpl_vars['form_field']->value['id'] == "Website_link") {?>	
					<?php $_smarty_tpl->_assignInScope('Website', $_smarty_tpl->tpl_vars['form_field']->value);?>
					<?php } elseif ($_smarty_tpl->tpl_vars['form_field']->value['id'] == "Other_link") {?>	
					<?php $_smarty_tpl->_assignInScope('Other', $_smarty_tpl->tpl_vars['form_field']->value);?>
						<?php }?>
      	 	
	<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
					
					
<div id="resumesteps" class="resumesteps resume-info col-md-9">
	<div class="e14sx70q0">
		
		<div class="css-1wtdjp1 exkztdf0">
		
			<form method="post" action="" enctype="multipart/form-data" <?php if ((isset($_smarty_tpl->tpl_vars['listing']->value['ApplicationSettings']))) {?>onsubmit="return validateForm('editListingForm');"<?php }?> id="editListingForm" class="form">
						<input type="hidden" name="action" value="save_info" />
						
						<input type="hidden" name="listing_id" id="listing_id" value="<?php echo $_smarty_tpl->tpl_vars['listing']->value['id'];?>
" />

						<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['set_token_field'][0], array( array(),$_smarty_tpl ) );?>

				  
				  <?php $_smarty_tpl->_subTemplateRender('template_jobsquare_user:field_errors.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
 <div class=" resume-bloc ">
	<div class="section-title">
		<h2 class="resume_main-title">Votre Présence en ligne</h2>
	</div>
	<div class="css-rpi6b5 e6pv2vl0">
		<div class="custom-selectbox">
			
			<div class="css-rpi6b5 e6pv2vl0">
				<div class="text-field-wrapper css-znsm0t">
					<label class="custom-selectbox__label"><?php echo $_smarty_tpl->tpl_vars['Linkedin']->value['caption'];?>
</label>
					<div class="css-1ac03ny">
						<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['input'][0], array( array('property'=>$_smarty_tpl->tpl_vars['Linkedin']->value['id']),$_smarty_tpl ) );?>

					</div>
				</div>
		    </div>
			
			<div class="css-rpi6b5 e6pv2vl0">
				<div class="text-field-wrapper css-znsm0t">
					<label class="custom-selectbox__label"><?php echo $_smarty_tpl->tpl_vars['Facebook']->value['caption'];?>
</label>
					<div class="css-1ac03ny">
						<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['input'][0], array( array('property'=>$_smarty_tpl->tpl_vars['Facebook']->value['id']),$_smarty_tpl ) );?>

					</div>
				</div>
		    </div>
			<div class="css-rpi6b5 e6pv2vl0">
				<div class="text-field-wrapper css-znsm0t">
					<label class="custom-selectbox__label"><?php echo $_smarty_tpl->tpl_vars['Twitter']->value['caption'];?>
</label>
					<div class="css-1ac03ny">
						<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['input'][0], array( array('property'=>$_smarty_tpl->tpl_vars['Twitter']->value['id']),$_smarty_tpl ) );?>

					</div>
				</div>
		    </div>
				<div class="css-rpi6b5 e6pv2vl0">
				<div class="text-field-wrapper css-znsm0t">
					<label class="custom-selectbox__label"><?php echo $_smarty_tpl->tpl_vars['Instagram']->value['caption'];?>
</label>
					<div class="css-1ac03ny">
						<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['input'][0], array( array('property'=>$_smarty_tpl->tpl_vars['Instagram']->value['id']),$_smarty_tpl ) );?>

					</div>
				</div>
		    </div>
			<div class="css-rpi6b5 e6pv2vl0">
				<div class="text-field-wrapper css-znsm0t">
					<label class="custom-selectbox__label"><?php echo $_smarty_tpl->tpl_vars['Behance']->value['caption'];?>
</label>
					<div class="css-1ac03ny">
						<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['input'][0], array( array('property'=>$_smarty_tpl->tpl_vars['Behance']->value['id']),$_smarty_tpl ) );?>

					</div>
				</div>
		    </div>
			
			<div class="css-rpi6b5 e6pv2vl0">
				<div class="text-field-wrapper css-znsm0t">
					<label class="custom-selectbox__label"><?php echo $_smarty_tpl->tpl_vars['GitHub']->value['caption'];?>
</label>
					<div class="css-1ac03ny">
						<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['input'][0], array( array('property'=>$_smarty_tpl->tpl_vars['GitHub']->value['id']),$_smarty_tpl ) );?>

					</div>
				</div>
		    </div>
			
			<div class="css-rpi6b5 e6pv2vl0">
				<div class="text-field-wrapper css-znsm0t">
					<label class="custom-selectbox__label"><?php echo $_smarty_tpl->tpl_vars['StackOverflow']->value['caption'];?>
</label>
					<div class="css-1ac03ny">
						<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['input'][0], array( array('property'=>$_smarty_tpl->tpl_vars['StackOverflow']->value['id']),$_smarty_tpl ) );?>

					</div>
				</div>
		    </div>
			
			<div class="css-rpi6b5 e6pv2vl0">
				<div class="text-field-wrapper css-znsm0t">
					<label class="custom-selectbox__label"><?php echo $_smarty_tpl->tpl_vars['YouTube']->value['caption'];?>
</label>
					<div class="css-1ac03ny">
						<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['input'][0], array( array('property'=>$_smarty_tpl->tpl_vars['YouTube']->value['id']),$_smarty_tpl ) );?>

					</div>
				</div>
		    </div>
			
			<div class="css-rpi6b5 e6pv2vl0">
				<div class="text-field-wrapper css-znsm0t">
					<label class="custom-selectbox__label"><?php echo $_smarty_tpl->tpl_vars['Blog']->value['caption'];?>
</label>
					<div class="css-1ac03ny">
						<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['input'][0], array( array('property'=>$_smarty_tpl->tpl_vars['Blog']->value['id']),$_smarty_tpl ) );?>

					</div>
				</div>
		    </div>
			<div class="css-rpi6b5 e6pv2vl0">
				<div class="text-field-wrapper css-znsm0t">
					<label class="custom-selectbox__label"><?php echo $_smarty_tpl->tpl_vars['Website']->value['caption'];?>
</label>
					<div class="css-1ac03ny">
						<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['input'][0], array( array('property'=>$_smarty_tpl->tpl_vars['Website']->value['id']),$_smarty_tpl ) );?>

					</div>
				</div>
		    </div>
			<div class="css-rpi6b5 e6pv2vl0">
				<div class="text-field-wrapper css-znsm0t">
					<label class="custom-selectbox__label"><?php echo $_smarty_tpl->tpl_vars['Other']->value['caption'];?>
</label>
					<div class="css-1ac03ny">
						<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['input'][0], array( array('property'=>$_smarty_tpl->tpl_vars['Other']->value['id']),$_smarty_tpl ) );?>

					</div>
				</div>
		    </div>
			
			
		</div>
	</div>
	
				
	</div>
	
	<div class="css-7oyirr">
	<input type="hidden" name="action_add" id="hidden_action_add" value=""/>
		<button type="submit" class="css-1kqwv1a e1eq3cmo0">Valider</button>
		<a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/edit-resume/Education/<?php echo $_smarty_tpl->tpl_vars['listingSID']->value;?>
" style="background-color: white; border: 1px solid rgb(235, 237, 240);" class="css-wzp6tc e1eq3cmo0">Retour</a>
	</div>
	
</form>
</div>
</div>
<div class="css-1t08rlo evbdj4a0">
	<div class="Toastify">
</div>
</div>
<div>
</div>
</div>





	<?php } elseif ($_smarty_tpl->tpl_vars['currentPage']->value['order'] == 7) {?>


	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['form_fields']->value, 'form_field');
$_smarty_tpl->tpl_vars['form_field']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['form_field']->value) {
$_smarty_tpl->tpl_vars['form_field']->do_else = false;
?>
		<?php $_smarty_tpl->_assignInScope('form_field', $_smarty_tpl->tpl_vars['form_field']->value ,false ,32);?>
		
	    
					<?php if ($_smarty_tpl->tpl_vars['form_field']->value['id'] == "diploma_file") {?>	
					<?php $_smarty_tpl->_assignInScope('diploma_file', $_smarty_tpl->tpl_vars['form_field']->value);?>
					<?php } elseif ($_smarty_tpl->tpl_vars['form_field']->value['id'] == "cin_file") {?>	
					<?php $_smarty_tpl->_assignInScope('cin_file', $_smarty_tpl->tpl_vars['form_field']->value);?>
					<?php } elseif ($_smarty_tpl->tpl_vars['form_field']->value['id'] == "book_file") {?>	
					<?php $_smarty_tpl->_assignInScope('book_file', $_smarty_tpl->tpl_vars['form_field']->value);?>
					
						<?php }?>
      	 	
	<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
					
					
<div id="resumesteps" class="resumesteps resume-info col-md-9">
	<div class="e14sx70q0">
		
		<div class="css-1wtdjp1 exkztdf0">
		
			<form method="post" action="" enctype="multipart/form-data" <?php if ((isset($_smarty_tpl->tpl_vars['listing']->value['ApplicationSettings']))) {?>onsubmit="return validateForm('editListingForm');"<?php }?> id="editListingForm" class="form">
						<input type="hidden" name="action" value="save_info" />
						
						<input type="hidden" name="listing_id" id="listing_id" value="<?php echo $_smarty_tpl->tpl_vars['listing']->value['id'];?>
" />

						<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['set_token_field'][0], array( array(),$_smarty_tpl ) );?>

				  
				  <?php $_smarty_tpl->_subTemplateRender('template_jobsquare_user:field_errors.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
 <div class=" resume-bloc ">
	<div class="section-title">
		<h2 class="resume_main-title">Documents utiles</h2>
	</div>
	<div class="css-rpi6b5 e6pv2vl0">
		<div class="custom-selectbox">
			
			<div class="upload-cv css-6hend0 e1581u7e0">
		<span class="css-qijrzv e12vjvm81">
			<h1 class="css-esj582 e12vjvm83">Télécharger votre diplôme</h1>
			<span class="css-djskp8 e12vjvm82">
				<span class="css-16ghou"> — Optionnelle</span>
			</span>
		</span>
		<span class="css-vzfgfo">Fichiers accepter: <b>.jpg</b>, <b>.jpeg</b>, <b>.png</b> or <b>.pdf</b>, avec une taille maximale de 5MB</span>
		<div class="css-6n7j50" style="position: relative;" aria-disabled="false">
			
		  <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['input'][0], array( array('property'=>$_smarty_tpl->tpl_vars['diploma_file']->value['id']),$_smarty_tpl ) );?>

		  </div>
	</div>

			 </div>
			 
			 <!--
			 	<div class="css-rpi6b5 e6pv2vl0">
		<div class="custom-selectbox">
			
			<div class="upload-cv css-6hend0 e1581u7e0">
		<span class="css-qijrzv e12vjvm81">
			<h1 class="css-esj582 e12vjvm83">Télécharger votre CIN</h1>
			<span class="css-djskp8 e12vjvm82">
				<span class="css-16ghou"> — Optionnelle</span>
			</span>
		</span>
		<span class="css-vzfgfo">Fichiers accepter: <b>.jpg</b>, <b>.jpeg</b>, <b>.png</b> or <b>.pdf</b>, avec une taille maximale de 5MB</span>
		<div class="css-6n7j50" style="position: relative;" aria-disabled="false">
			
		  <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['input'][0], array( array('property'=>$_smarty_tpl->tpl_vars['cin_file']->value['id']),$_smarty_tpl ) );?>

		  </div>
	</div>

			 </div>
			  </div>
			  -->
			  	<div class="css-rpi6b5 e6pv2vl0">
		<div class="custom-selectbox">
			
			<div class="upload-cv css-6hend0 e1581u7e0">
		<span class="css-qijrzv e12vjvm81">
			<h1 class="css-esj582 e12vjvm83">Télécharger votre catalogue de réalisation(Book)</h1>
			<span class="css-djskp8 e12vjvm82">
				<span class="css-16ghou"> — Optionnelle</span>
			</span>
		</span>
		<span class="css-vzfgfo">Fichiers accepter: <b>.jpg</b>, <b>.jpeg</b>, <b>.png</b> or <b>.pdf</b>, avec une taille maximale de 5MB</span>
		<div class="css-6n7j50" style="position: relative;" aria-disabled="false">
			
		  <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['input'][0], array( array('property'=>$_smarty_tpl->tpl_vars['book_file']->value['id']),$_smarty_tpl ) );?>

		  </div>
	</div>

			 </div>
			  </div>
			  
			  
			  
			  </div>
			  
			  
			  
			   </div>
			   
	<div class="css-7oyirr">
	<input type="hidden" name="action_add" id="hidden_action_add" value=""/>
		<button type="submit" class="css-1kqwv1a e1eq3cmo0">Valider</button>
		<a href="<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/edit-resume/PresenceOnline/<?php echo $_smarty_tpl->tpl_vars['listingSID']->value;?>
" style="background-color: white; border: 1px solid rgb(235, 237, 240);" class="css-wzp6tc e1eq3cmo0">Retour</a>
	</div>
	
</form>
</div>
</div>
<div class="css-1t08rlo evbdj4a0">
	<div class="Toastify">
</div>
</div>		   
			    </div>
				
				
<?php } elseif ($_smarty_tpl->tpl_vars['currentPage']->value['order'] == 8) {?>


	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['form_fields']->value, 'form_field');
$_smarty_tpl->tpl_vars['form_field']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['form_field']->value) {
$_smarty_tpl->tpl_vars['form_field']->do_else = false;
?>
		<?php $_smarty_tpl->_assignInScope('form_field', $_smarty_tpl->tpl_vars['form_field']->value ,false ,32);?>
		
	    
					<?php if ($_smarty_tpl->tpl_vars['form_field']->value['id'] == "resume_modele_sid") {?>	
					<?php $_smarty_tpl->_assignInScope('resume_modele_sid', $_smarty_tpl->tpl_vars['form_field']->value);?>
					<?php } elseif ($_smarty_tpl->tpl_vars['form_field']->value['id'] == "modele_color") {?>	
					<?php $_smarty_tpl->_assignInScope('modele_color', $_smarty_tpl->tpl_vars['form_field']->value);?>
				
					
						<?php }?>
      	 	
	<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
					

<div id="resumesteps" class="resumesteps resume-info template-cv  col-md-9" >
	<div class="e14sx70q0">
		
		<div class="css-1wtdjp1 exkztdf0">
		
			

						<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['set_token_field'][0], array( array(),$_smarty_tpl ) );?>

				  
				  <?php $_smarty_tpl->_subTemplateRender('template_jobsquare_user:field_errors.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
 <div class=" resume-bloc ">
	<div class="section-title">
		<h2 class="resume_main-title">Choisissez un modèle de CV Jobsquare</h2>
			<form method="post" action="" enctype="multipart/form-data" <?php if ((isset($_smarty_tpl->tpl_vars['listing']->value['ApplicationSettings']))) {?>onsubmit="return validateForm('editListingForm');" id="editListingForm"<?php }?>>
			<input type="hidden" name="action" value="save_info" />
			<input type="hidden" name="action_add" id="hidden_action_add" value=""/>
			<input type="hidden" name="listing_id" id="listing_id" value="<?php echo $_smarty_tpl->tpl_vars['listing']->value['id'];?>
" />
						
			<input type="submit" value="Choisir le modèle par défaut" <?php if ($_smarty_tpl->tpl_vars['resumeModel']->value['sid'] != 0) {?>class="active"<?php } else { ?>class="disabled" disabled<?php }?>>
			<p>
			<input type="hidden" value="0" name="resume_modele_sid">
			<input type="hidden" value="0" name="modele_color">
			<br>
			</p>
			</form>
	</div>
	<div style="width: 100%; display: table;">
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['resumeModels']->value, 'model');
$_smarty_tpl->tpl_vars['model']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['model']->value) {
$_smarty_tpl->tpl_vars['model']->do_else = false;
?>
			  
		 	<div class="css-rpi6b5 e6pv2vl0">
			<div class="custom-selectbox">
		
			<div class="col-md-4 <?php if ($_smarty_tpl->tpl_vars['resumeModel']->value['sid'] && $_smarty_tpl->tpl_vars['resumeModel']->value['sid'] == $_smarty_tpl->tpl_vars['model']->value['sid']) {?>selected<?php }?>">
			<form method="post" action="" enctype="multipart/form-data" <?php if ((isset($_smarty_tpl->tpl_vars['listing']->value['ApplicationSettings']))) {?>onsubmit="return validateForm('editListingForm');"<?php }?> id="editListingForm<?php echo $_smarty_tpl->tpl_vars['model']->value['sid'];?>
" class="form ">
						<input type="hidden" name="action" value="save_info" />
						<input type="hidden" name="action_add" id="hidden_action_add" value=""/>
						<input type="hidden" name="listing_id" id="listing_id" value="<?php echo $_smarty_tpl->tpl_vars['listing']->value['id'];?>
" />
						<!--<input type="hidden" name="preview_listing" id="preview_listing" value="1" />-->
						
			<div class="background-img-template background-img-template-<?php echo $_smarty_tpl->tpl_vars['model']->value['sid'];?>
" id="cv-<?php echo $_smarty_tpl->tpl_vars['model']->value['sid'];?>
-miniature" <?php if ($_smarty_tpl->tpl_vars['resumeColor']->value['sid'] && $_smarty_tpl->tpl_vars['resumeModel']->value['sid'] == $_smarty_tpl->tpl_vars['model']->value['sid']) {?>  style="background-image:url('<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/files/cvmodels/<?php echo $_smarty_tpl->tpl_vars['resumeColor']->value['image'];?>
');" <?php } else { ?> style="background-image:url('<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
/files/cvmodels/cv-<?php echo $_smarty_tpl->tpl_vars['model']->value['sid'];?>
-<?php echo $_smarty_tpl->tpl_vars['model']->value['default_color'];?>
.png');"<?php }?>>
			<?php if ($_smarty_tpl->tpl_vars['resumeModel']->value['sid'] && $_smarty_tpl->tpl_vars['resumeModel']->value['sid'] == $_smarty_tpl->tpl_vars['model']->value['sid']) {?>
			<input type="submit" value="Enregistrer" class="hiddenhover visible">
			<?php } else { ?>
			<input type="submit" value="Choisir ce CV" class="hiddenhover">
			<?php }?>
			<div <?php if ($_smarty_tpl->tpl_vars['resumeModel']->value['sid'] && $_smarty_tpl->tpl_vars['resumeModel']->value['sid'] == $_smarty_tpl->tpl_vars['model']->value['sid']) {?>class="checkedcv"<?php }?>></div>
			</div>
			<p>
			<input type="hidden" value="<?php if ($_smarty_tpl->tpl_vars['resumeColor']->value['sid'] && $_smarty_tpl->tpl_vars['resumeModel']->value['sid'] == $_smarty_tpl->tpl_vars['model']->value['sid']) {
echo $_smarty_tpl->tpl_vars['resumeColor']->value['sid'];
} else {
echo $_smarty_tpl->tpl_vars['model']->value['default_color_sid'];
}?>" name="cv-color-selected">
			<input type="hidden" value="<?php if ($_smarty_tpl->tpl_vars['resumeModel']->value['sid'] && $_smarty_tpl->tpl_vars['resumeModel']->value['sid'] == $_smarty_tpl->tpl_vars['model']->value['sid']) {
echo $_smarty_tpl->tpl_vars['resumeModel']->value['sid'];
} else {
echo $_smarty_tpl->tpl_vars['model']->value['sid'];
}?>" name="resume_modele_sid">
			<input type="hidden" value="<?php if ($_smarty_tpl->tpl_vars['resumeColor']->value['sid'] && $_smarty_tpl->tpl_vars['resumeModel']->value['sid'] == $_smarty_tpl->tpl_vars['model']->value['sid']) {
echo $_smarty_tpl->tpl_vars['resumeColor']->value['sid'];
} else {
echo $_smarty_tpl->tpl_vars['model']->value['default_color_sid'];
}?>" name="modele_color">
			<br>
			</p>
			
			
			<p class="cv-template-color" id="cv-<?php echo $_smarty_tpl->tpl_vars['model']->value['sid'];?>
-color-selector" style="margin-bottom:0">
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['model']->value['colors'], 'color', false, 'index');
$_smarty_tpl->tpl_vars['color']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['index']->value => $_smarty_tpl->tpl_vars['color']->value) {
$_smarty_tpl->tpl_vars['color']->do_else = false;
?>
			<span class="cv-color">
			<a class="change-color-<?php echo $_smarty_tpl->tpl_vars['color']->value['color'];?>
  <?php if ($_smarty_tpl->tpl_vars['color']->value['sid'] == $_smarty_tpl->tpl_vars['resumeColor']->value['sid'] && $_smarty_tpl->tpl_vars['resumeModel']->value['sid'] == $_smarty_tpl->tpl_vars['model']->value['sid']) {?>selected <?php } else {
if ($_smarty_tpl->tpl_vars['color']->value['sid'] == $_smarty_tpl->tpl_vars['model']->value['default_color_sid'] && $_smarty_tpl->tpl_vars['resumeModel']->value['sid'] != $_smarty_tpl->tpl_vars['model']->value['sid']) {?> selected<?php }
}?>" data-color-index="<?php echo $_smarty_tpl->tpl_vars['color']->value['sid'];?>
" style="background:<?php echo $_smarty_tpl->tpl_vars['color']->value['code'];?>
">
			<span class="dashicons dashicons-yes"></span></a>
			</span>
			
			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			
			</p><p></p>
			
			</form>
			</div>  
			  
			  
			  
			  </div>
			   </div>
			  <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			  
			  
			  
			  
			  
			   </div>
			   
	
</div>
</div>
</div>

<div class="css-1t08rlo evbdj4a0">
	<div class="Toastify">
</div>
</div>		   
 </div>
<?php }?>



<?php $_block_plugin10 = isset($_smarty_tpl->smarty->registered_plugins['block']['javascript'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['javascript'][0][0] : null;
if (!is_callable(array($_block_plugin10, '_tpl_javascript'))) {
throw new SmartyException('block tag \'javascript\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('javascript', array());
$_block_repeat=true;
echo $_block_plugin10->_tpl_javascript(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo '<script'; ?>
 type="text/javascript">
$(document).ready(function(e){
	$('body').on('click','.cv-template-color a:not(.selected)',function(){
	//$('.cv-template-color a:not(.selected)').on('click', function() {
	
	var color=$(this).attr('class').split('-')[2];
	$(this).closest('.cv-template-color').find('a.selected').removeClass('selected');
	$(this).addClass('selected');
	var cv_num=$(this).closest('.cv-template-color').attr('id').replace('-color-selector','');
	$('#'+cv_num+'-miniature').css('background-image','url("<?php echo $_smarty_tpl->tpl_vars['GLOBALS']->value['site_url'];?>
files/cvmodels/'+cv_num+'-'+color.trim()+'.png")');
	var color_index=$(this).attr('data-color-index');
	var cv_index=cv_num.split('-')[1];
	
	$('#editListingForm'+cv_index+' input[name="cv-color-selected"').val(color_index);
	$('#editListingForm'+cv_index+' input[name="resume_modele_sid"').val(cv_index);
	$('#editListingForm'+cv_index+' input[name="modele_color"').val(color_index);
	
	})});
  $(document).ready(function() {
            var perc = <?php echo $_smarty_tpl->tpl_vars['percentage']->value;?>
;
            if (perc < 40) {
                $("#progress").css('background', 'red');
            } else if (perc < 60) {
                $("#progress").css('background', 'orange');
            } else if (perc < 80) {
                $("#progress").css('background', 'yellow');
            } else {
                $("#progress").css('background', '#a5c242');
            }

            $("#progress").css("width", perc + "%");
        });
    <?php echo '</script'; ?>
>
<?php $_block_repeat=false;
echo $_block_plugin10->_tpl_javascript(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
$_block_plugin11 = isset($_smarty_tpl->smarty->registered_plugins['block']['javascript'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['javascript'][0][0] : null;
if (!is_callable(array($_block_plugin11, '_tpl_javascript'))) {
throw new SmartyException('block tag \'javascript\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('javascript', array());
$_block_repeat=true;
echo $_block_plugin11->_tpl_javascript(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo '<script'; ?>
>

// ======================= GLOBAL CONFIGURATION =======================
var FORM_CONFIG = {
    experience: {
        container: 'experienceCardsContainer',
        sjbContainer: '.sjb-work-experience-field',
        rootKey: 'WorkExperience',
        fields: {
            title: 'WE_JobTitle',
            org: 'WE_Company',
            from: 'WE_From',
            to: 'WE_To',
            current: 'WE_Iworkhere',
            desc: 'WE_Description'
        },
        modalConfig: {
            modalId: 'experienceModal',
            formId: 'experienceForm',
            titleId: 'modalTitle',
            dataArray: 'experiences',
            editTitle: 'Modifier une Expérience',
            addTitle: 'Ajouter une Expérience',
            cardIcon: 'fas fa-building',
            fields: {
                titleField: { id: 'job_title', label: 'Poste occupé *' },
                orgField: { id: 'company_name', label: 'Nom de l\'entreprise *' },
                currentCheckbox: { id: 'current_job', label: 'Je travaille encore dans ce poste' },
                startMonth: { id: 'start_month', label: 'Mois' },
                startYear: { id: 'start_year', label: 'Année' },
                endMonth: { id: 'end_month', label: 'Mois' },
                endYear: { id: 'end_year', label: 'Année' },
                description: { id: 'description', label: 'Description *' },
                dateColId: 'endDateCol'
            },
            mapToSJB: {
                title: 'job_title',
                org: 'company_name',
                desc: 'description',
                current: 'is_current',
                startDate: 'start_date',
                endDate: 'end_date'
            }
        }
    },

    education: {
        container: 'educationCardsContainer',
        sjbContainer: '.sjb-education-field',
        rootKey: 'Education',
        fields: {
            title: 'ED_DegreeSpecialty',
            org: 'ED_UniversityInstitution',
            from: 'ED_From',
            to: 'ED_To',
            current: 'WE_Istudyhere',
            desc: null
        },
        modalConfig: {
            modalId: 'educationModal',
            formId: 'educationForm',
            titleId: 'educationModalTitle',
            dataArray: 'educations',
            editTitle: 'Modifier une étude',
            addTitle: 'Ajouter une étude',
            cardIcon: 'fas fa-university',
            fields: {
                titleField: { id: 'edu_degree', label: 'Diplôme / Spécialité *' },
                orgField: { id: 'edu_institution', label: 'Établissement *' },
                currentCheckbox: { id: 'edu_current', label: 'J\'étudie actuellement ici' },
                startMonth: { id: 'start_month', label: 'Mois' },
                startYear: { id: 'start_year', label: 'Année' },
                endMonth: { id: 'end_month', label: 'Mois' },
                endYear: { id: 'end_year', label: 'Année' },
                description: null,
                dateColId: 'endDateCol'
            },
            mapToSJB: {
                title: 'edu_degree',
                org: 'edu_institution',
                desc: null,
                current: 'is_current',
                startDate: 'start_date',
                endDate: 'end_date'
            }
        }
    }
};

// ======================= GLOBAL VARIABLES =======================
var experiences = [];
var educations = [];
var currentEditIndex = -1;
var currentEditType = null;

// ======================= validation =========================
function validateDates(type) {
    var config = FORM_CONFIG[type];
    var modalConfig = config.modalConfig;
    
    var startMonth = document.getElementById(modalConfig.fields.startMonth.id);
    var startYear = document.getElementById(modalConfig.fields.startYear.id);
    var endMonth = document.getElementById(modalConfig.fields.endMonth.id);
    var endYear = document.getElementById(modalConfig.fields.endYear.id);
    var currentCheckbox = document.getElementById(modalConfig.fields.currentCheckbox.id);
    
    // If current job/study, no end date needed
    if (currentCheckbox && currentCheckbox.checked) {
        return true;
    }
    
    // Check if dates are selected
    if (!startMonth.value || !startYear.value || !endMonth.value || !endYear.value) {
        return true; // Let other validation handle missing fields
    }
    
    // Convert to dates
    var startDate = new Date(startYear.value + '-' + startMonth.value.padStart(2, '0') + '-01');
    var endDate = new Date(endYear.value + '-' + endMonth.value.padStart(2, '0') + '-01');
    
    // Check if end date is before start date
    return endDate >= startDate;
}

// ======================= SHOW ERROR CARD =======================
function showDateError(type) {
    var config = FORM_CONFIG[type];
    var modalConfig = config.modalConfig;
    var modal = document.getElementById(modalConfig.modalId);
    
    // Create or get alert container
    var alertContainer = modal.querySelector('.date-validation-alert');
    if (!alertContainer) {
        alertContainer = document.createElement('div');
        alertContainer.className = 'date-validation-alert';
        alertContainer.innerHTML = 
            '<div class="alert-card alert-error">' +
                '<div class="alert-icon">' +
                    '<i class="fas fa-exclamation-circle"></i>' +
                '</div>' +
                '<div class="alert-content">' +
                    '<div class="alert-title">Erreur de date</div>' +
                    '<div class="alert-message">La date de fin doit être postérieure à la date de début</div>' +
                '</div>' +
                '<button class="alert-close" onclick="this.parentElement.parentElement.remove()">' +
                    '<i class="fas fa-times"></i>' +
                '</button>' +
            '</div>';
        
        // Insert after the dates row
        var datesRow = modal.querySelector('.dates-row');
        if (datesRow && datesRow.parentNode) {
            datesRow.parentNode.insertBefore(alertContainer, datesRow.nextSibling);
        }
    } else {
        // Show existing alert
        alertContainer.style.display = 'block';
    }
    
    // Highlight date fields in red
    highlightDateFields(type, true);
}

// ======================= HIGHLIGHT FIELDS =======================
function highlightDateFields(type, showError) {
    var config = FORM_CONFIG[type];
    var modalConfig = config.modalConfig;
    
    var fields = [
        modalConfig.fields.startMonth.id,
        modalConfig.fields.startYear.id,
        modalConfig.fields.endMonth.id,
        modalConfig.fields.endYear.id
    ];
    
    fields.forEach(function(fieldId) {
        var field = document.getElementById(fieldId);
        if (field) {
            if (showError) {
                field.classList.add('date-error');
            } else {
                field.classList.remove('date-error');
            }
        }
    });
}


// ======================= GENERIC MODAL FUNCTIONS =======================
function showModal(type, index) {
    currentEditIndex = typeof index === 'number' ? index : -1;
    currentEditType = type;
    
    var config = FORM_CONFIG[type];
    if (!config) {
       
        return;
    }
    
    var modalConfig = config.modalConfig;
    var modal = document.getElementById(modalConfig.modalId);
    if (!modal) {
        
        return;
    }
    
    // Show modal
    modal.style.display = 'flex';
    
    // Set modal title
    var titleElement = document.getElementById(modalConfig.titleId);
    if (titleElement) {
        titleElement.textContent = currentEditIndex >= 0 ? modalConfig.editTitle : modalConfig.addTitle;
    }
    
    // Get data array
    var dataArray = getDataArray(type);
    
    if (currentEditIndex >= 0 && dataArray && dataArray[currentEditIndex]) {
        // Edit mode: populate form with existing data
        var item = dataArray[currentEditIndex];
        
        populateForm(type, item);
    } else {
        // Add mode: clear form
        clearForm(type);
    }
    
    // Setup year dropdowns
    setupYearDropdowns(type);
    
    // Initialize current toggle
    initializeCurrentToggle(type);
}

function populateForm(type, item) {
    var config = FORM_CONFIG[type];
    var modalConfig = config.modalConfig;
    
    // Populate title field
    var titleField = document.getElementById(modalConfig.fields.titleField.id);
    if (titleField) {
        titleField.value = item.title || item[modalConfig.mapToSJB.title] || '';
    }
    
    // Populate organization field
    var orgField = document.getElementById(modalConfig.fields.orgField.id);
    if (orgField) {
        orgField.value = item.org || item[modalConfig.mapToSJB.org] || '';
    }
    
    // Populate description (if exists)
    if (modalConfig.fields.description) {
        var descField = document.getElementById(modalConfig.fields.description.id);
        if (descField && modalConfig.mapToSJB.desc) {
            descField.value = item.desc || item[modalConfig.mapToSJB.desc] || '';
        }
    }
    
    // Populate current checkbox
    var currentCheckbox = document.getElementById(modalConfig.fields.currentCheckbox.id);
    if (currentCheckbox) {
        currentCheckbox.checked = item.current === '1' || item.current === 1 || item[modalConfig.mapToSJB.current] === '1' || item[modalConfig.mapToSJB.current] === 1;
    }
    
    // Parse start date
    var startDate = item.start_date || item[modalConfig.mapToSJB.startDate] || item.from;
    if (startDate) {
        var startParts = startDate.split('-');
        if (startParts.length >= 2) {
            var startMonth = document.getElementById(modalConfig.fields.startMonth.id);
            var startYear = document.getElementById(modalConfig.fields.startYear.id);
            if (startMonth) startMonth.value = startParts[1] || '';
            if (startYear) startYear.value = startParts[0] || '';
        }
    }
    
    // Parse end date
    var endDate = item.end_date || item[modalConfig.mapToSJB.endDate] || item.to;
    var isCurrent = item.current === '1' || item.current === 1 || item[modalConfig.mapToSJB.current] === '1' || item[modalConfig.mapToSJB.current] === 1;
    
    if (endDate && !isCurrent) {
        var endParts = endDate.split('-');
        if (endParts.length >= 2) {
            var endMonth = document.getElementById(modalConfig.fields.endMonth.id);
            var endYear = document.getElementById(modalConfig.fields.endYear.id);
            if (endMonth) endMonth.value = endParts[1] || '';
            if (endYear) endYear.value = endParts[0] || '';
        }
    } else {
        var endMonth = document.getElementById(modalConfig.fields.endMonth.id);
        var endYear = document.getElementById(modalConfig.fields.endYear.id);
        if (endMonth) endMonth.value = '';
        if (endYear) endYear.value = '';
    }
    
    // Toggle current state
    toggleCurrent(type);
}

function clearForm(type) {
    var config = FORM_CONFIG[type];
    var modalConfig = config.modalConfig;
    
    var form = document.getElementById(modalConfig.formId);
    if (form) {
        form.reset();
    }
    
    // Clear end date fields
    var endMonth = document.getElementById(modalConfig.fields.endMonth.id);
    var endYear = document.getElementById(modalConfig.fields.endYear.id);
    if (endMonth) endMonth.value = '';
    if (endYear) endYear.value = '';
    
    // Uncheck current checkbox
    var currentCheckbox = document.getElementById(modalConfig.fields.currentCheckbox.id);
    if (currentCheckbox) {
        currentCheckbox.checked = false;
    }
    
    currentEditIndex = -1;
}

function closeModal() {
    // Hide all modals
    for (var key in FORM_CONFIG) {
        if (FORM_CONFIG.hasOwnProperty(key)) {
            var config = FORM_CONFIG[key];
            var modal = document.getElementById(config.modalConfig.modalId);
            if (modal) {
                modal.style.display = 'none';
            }
        }
    }
    
    currentEditIndex = -1;
    currentEditType = null;
}

function toggleCurrent(type) {
    if (!type) type = currentEditType;
    if (!type) return;

    var config = FORM_CONFIG[type];
    var modalConfig = config.modalConfig;

    var currentCheckbox = document.getElementById(modalConfig.fields.currentCheckbox.id);
    var dateCol = document.getElementById(modalConfig.fields.dateColId);
    
    if (!currentCheckbox || !dateCol) return;

    var endMonth = document.getElementById(modalConfig.fields.endMonth.id);
    var endYear  = document.getElementById(modalConfig.fields.endYear.id);

    if (currentCheckbox.checked) {
       
        dateCol.classList.add('end-date-disabled');

        if (endMonth) endMonth.value = '';
        if (endYear) endYear.value = '';

        highlightDateFields(type, false);
        hideDateAlert(type);
    } else {
       
        dateCol.classList.remove('end-date-disabled');
    }
}

function initializeCurrentToggle(type) {
    var config = FORM_CONFIG[type];
    var modalConfig = config.modalConfig;
    
    var currentCheckbox = document.getElementById(modalConfig.fields.currentCheckbox.id);
    if (currentCheckbox) {
        currentCheckbox.onchange = function() { toggleCurrent(type); };
        toggleCurrent(type);
    }
}

// ======================= DATA MANAGEMENT FUNCTIONS =======================
function saveItem(type) {
    if (!type) type = currentEditType;
    if (!type) return;
    
    var config = FORM_CONFIG[type];
    var modalConfig = config.modalConfig;
    
    // Get form values
    var titleField = document.getElementById(modalConfig.fields.titleField.id);
    var orgField = document.getElementById(modalConfig.fields.orgField.id);
    var currentCheckbox = document.getElementById(modalConfig.fields.currentCheckbox.id);
    var startMonth = document.getElementById(modalConfig.fields.startMonth.id);
    var startYear = document.getElementById(modalConfig.fields.startYear.id);
    var endMonth = document.getElementById(modalConfig.fields.endMonth.id);
    var endYear = document.getElementById(modalConfig.fields.endYear.id);
    
    // Remove any existing date error (do this FIRST)
    highlightDateFields(type, false);
    var modal = document.getElementById(modalConfig.modalId);
    var alertContainer = modal ? modal.querySelector('.date-validation-alert') : null;
    if (alertContainer) {
        alertContainer.style.display = 'none';
    }
    
    // Basic validation
    if (!titleField || !titleField.value.trim()) {
        alert('Veuillez remplir le champ ' + modalConfig.fields.titleField.label);
        titleField.focus();
        return;
    }
    
    if (!orgField || !orgField.value.trim()) {
        alert('Veuillez remplir le champ ' + modalConfig.fields.orgField.label);
        orgField.focus();
        return;
    }
    
    if (!startMonth || !startMonth.value || !startYear || !startYear.value) {
        alert('Veuillez sélectionner la date de début');
        return;
    }
    
    // Date validation - Check if end date is after start date
    if (!validateDates(type)) {
        showDateError(type);
        return;
    }
    
    // For experience: description is required
    if (type === 'experience') {
        var descriptionField = document.getElementById('description');
        if (!descriptionField || !descriptionField.value.trim()) {
            alert('Veuillez remplir la description');
            descriptionField.focus();
            return;
        }
    }
    
    // Build item object
    var item = {
        title: titleField.value.trim(),
        org: orgField.value.trim(),
        is_current: currentCheckbox.checked ? '1' : '0',
        start_date: startYear.value + '-' + startMonth.value.padStart(2, '0'),
        end_date: ''
    };
    
    if (!currentCheckbox.checked && endMonth && endMonth.value && endYear && endYear.value) {
        item.end_date = endYear.value + '-' + endMonth.value.padStart(2, '0');
    }
    
    // Add description for experience
    if (type === 'experience' && modalConfig.fields.description) {
        var descriptionField = document.getElementById(modalConfig.fields.description.id);
        if (descriptionField) {
            item.desc = descriptionField.value.trim();
        }
    }
    
    // Get data array
    var dataArray = getDataArray(type);
    
    if (currentEditIndex === -1) {
        // Add new item
        dataArray.push(item);
        
    } else {
        // Update existing item
        dataArray[currentEditIndex] = item;
        
    }
    
    // Update UI and sync with SJB field
    renderCards(type);
    syncToSJBField(type);
    closeModal();
}
function deleteItem(type, index) {
    if (!confirm('Êtes-vous sûr de vouloir supprimer cet élément ?')) {
        return;
    }
    
    var dataArray = getDataArray(type);
    if (!dataArray || index < 0 || index >= dataArray.length) {
        
        return;
    }
    
    
    dataArray.splice(index, 1);
    
    
    // Update UI
    renderCards(type);
    syncToSJBField(type);
}

function editItem(type, index) {
    showModal(type, index);
}

// ======================= RENDER FUNCTIONS =======================
function renderCards(type) {
    var config = FORM_CONFIG[type];
    if (!config) return;
    
    var container = document.getElementById(config.container);
    if (!container) {
        
        return;
    }
    
    var dataArray = getDataArray(type);
    
    // Clear container
    container.innerHTML = '';
    
    if (!dataArray || dataArray.length === 0) {
        container.innerHTML = buildNoItemsHTML(type);
        return;
    }
    
    // Sort items by date (most recent first)
    var sortedItems = dataArray.slice().sort(function(a, b) {
        var dateA = a.start_date ? new Date(a.start_date + '-01') : new Date(0);
        var dateB = b.start_date ? new Date(b.start_date + '-01') : new Date(0);
        return dateB - dateA;
    });
    
    // Build cards
    for (var i = 0; i < sortedItems.length; i++) {
        var item = sortedItems[i];
        
        // Find original index
        var originalIndex = -1;
        for (var j = 0; j < dataArray.length; j++) {
            if (dataArray[j] === item) {
                originalIndex = j;
                break;
            }
        }
        
        if (originalIndex !== -1) {
            var cardHTML = buildCardHTML(type, item, originalIndex);
            container.innerHTML += cardHTML;
        }
    }
}

function buildCardHTML(type, item, index) {
    var config = FORM_CONFIG[type];
    var modalConfig = config.modalConfig;
    
    // Format period
    var period = '';
    if (item.start_date) {
        var startDate = new Date(item.start_date + '-01');
        period = startDate.getFullYear() + '-' + String(startDate.getMonth() + 1).padStart(2, '0');
        
        if (item.is_current === '1' || item.is_current === 1) {
            period += ' - Présent';
        } else if (item.end_date) {
            var endDate = new Date(item.end_date + '-01');
            period += ' - ' + endDate.getFullYear() + '-' + String(endDate.getMonth() + 1).padStart(2, '0');
        }
    }
    
    // Build HTML
    var html = '<div class="experience-card" data-index="' + index + '">';
    html += '<div class="card-header">';
    html += '<div>';
    html += '<div class="job-title">' + escapeHtml(item.title || 'Non spécifié') + '</div>';
    html += '<div class="company-info">';
    html += '<i class="' + modalConfig.cardIcon + '"></i>';
    html += '<span>' + escapeHtml(item.org || 'Non spécifié') + '</span>';
    html += '</div>';
    html += '</div>';
    html += '<div class="period">' + period + '</div>';
    html += '</div>';
    
    // Add description for experience
    if (type === 'experience' && item.desc) {
        var descPreview = item.desc.length > 200 ? item.desc.substring(0, 197) + '...' : item.desc;
        html += '<div class="card-content">';
        html += '<p class="job-description">' + escapeHtml(descPreview) + '</p>';
        html += '</div>';
    }
    
    html += '<div class="card-actions">';
    html += '<button type="button" class="btn btn-outline" onclick="editItem(\'' + type + '\', ' + index + ')">';
    html += '<i class="fas fa-edit"></i> Modifier';
    html += '</button>';
    html += '<button type="button" class="btn btn-secondary" onclick="deleteItem(\'' + type + '\', ' + index + ')">';
    html += '<i class="fas fa-trash"></i> Supprimer';
    html += '</button>';
    html += '</div>';
    html += '</div>';
    
    return html;
}

function buildNoItemsHTML(type) {
    var icons = {
        experience: 'fas fa-briefcase',
        education: 'fas fa-graduation-cap'
    };
    
    var messages = {
        experience: 'Aucune expérience ajoutée pour le moment',
        education: 'Aucune étude ajoutée pour le moment'
    };
    
    return '<div class="no-experiences" style="text-align: center; padding: 40px; color: #666; font-style: italic;">' +
           '<i class="' + (icons[type] || 'fas fa-list') + '" style="font-size: 48px; margin-bottom: 20px; color: #ddd;"></i><br>' +
           (messages[type] || 'Aucun élément ajouté pour le moment') +
           '</div>';
}

// ======================= SJB FIELD SYNC FUNCTIONS =======================
function syncToSJBField(type) {
    var config = FORM_CONFIG[type];
    if (!config) return;
    
    var container = document.querySelector(config.sjbContainer);
    if (!container) return;
    
    // Remove previously generated fields
    var oldFields = document.querySelectorAll('.generated-' + type);
    for (var i = 0; i < oldFields.length; i++) {
        if (oldFields[i].parentNode) {
            oldFields[i].parentNode.removeChild(oldFields[i]);
        }
    }
    
    var dataArray = getDataArray(type);
    
    // Create fields for each item
    for (var i = 0; i < dataArray.length; i++) {
        var item = dataArray[i];
        var sjbIndex = i + 1; // SJB uses 1-based indexing
        
        // Title field
        createSJBField(container, type, config.rootKey + '[' + config.fields.title + '][' + sjbIndex + ']', item.title || '');
        
        // Organization field
        createSJBField(container, type, config.rootKey + '[' + config.fields.org + '][' + sjbIndex + ']', item.org || '');
        
        // Start date (French format: DD/MM/YYYY)
        var startDate = '';
        if (item.start_date) {
            var parts = item.start_date.split('-');
            if (parts.length >= 2) {
                startDate = '01/' + parts[1] + '/' + parts[0];
            }
        }
        createSJBField(container, type, config.rootKey + '[' + config.fields.from + '][' + sjbIndex + ']', startDate);
        
        // End date
        var endDate = '';
        if (item.is_current === '1' || item.is_current === 1) {
            // Current: use today's date
            var today = new Date();
            endDate = String(today.getDate()).padStart(2, '0') + '/' + 
                     String(today.getMonth() + 1).padStart(2, '0') + '/' + 
                     today.getFullYear();
        } else if (item.end_date) {
            var parts = item.end_date.split('-');
            if (parts.length >= 2) {
                endDate = '01/' + parts[1] + '/' + parts[0];
            }
        }
        createSJBField(container, type, config.rootKey + '[' + config.fields.to + '][' + sjbIndex + ']', endDate);
        
        // Current field
        createSJBField(container, type, config.rootKey + '[' + config.fields.current + '][' + sjbIndex + ']', item.is_current || '0');
        
        // Description (for experience only)
        if (config.fields.desc && item.desc) {
            createSJBField(container, type, config.rootKey + '[' + config.fields.desc + '][' + sjbIndex + ']', item.desc || '');
        }
    }
}

function createSJBField(container, type, name, value) {
    var input = document.createElement('input');
    input.type = 'hidden';
    input.name = name;
    input.value = value || '';
    input.className = 'generated-' + type;
    container.appendChild(input);
}

// ======================= HELPER FUNCTIONS =======================
function getDataArray(type) {
    switch(type) {
        case 'experience': return experiences;
        case 'education': return educations;
        default: return null;
    }
}

function setupYearDropdowns(type) {
    var config = FORM_CONFIG[type];
    var modalConfig = config.modalConfig;
    
    var currentYear = new Date().getFullYear();
    
    // Setup start year
    var startYearSelect = document.getElementById(modalConfig.fields.startYear.id);
    if (startYearSelect && startYearSelect.options.length === 0) {
        startYearSelect.innerHTML = '<option value="">Année</option>';
        for (var year = currentYear; year >= 1900; year--) {
            var option = document.createElement('option');
            option.value = year;
            option.textContent = year;
            startYearSelect.appendChild(option);
        }
    }
    
    // Setup end year
    var endYearSelect = document.getElementById(modalConfig.fields.endYear.id);
    if (endYearSelect && endYearSelect.options.length === 0) {
        endYearSelect.innerHTML = '<option value="">Année</option>';
        for (var year = currentYear; year >= currentYear - 50; year--) {
            var option = document.createElement('option');
            option.value = year;
            option.textContent = year;
            endYearSelect.appendChild(option);
        }
    }
}

function escapeHtml(text) {
    if (!text) return '';
    var map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    };
    return text.replace(/[&<>"']/g, function(m) { return map[m]; });
}

// ======================= INITIALIZATION FUNCTIONS =======================
function initDataFromPHP(type) {
    var dataArray = getDataArray(type);
    if (!dataArray) return;
    
    // Clear existing data
    dataArray.length = 0;
    
    // Load from PHP template
    switch(type) {
        case 'experience':
            <?php if ($_smarty_tpl->tpl_vars['existingExperiences']->value && is_array($_smarty_tpl->tpl_vars['existingExperiences']->value)) {?>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['existingExperiences']->value, 'exp', false, 'index');
$_smarty_tpl->tpl_vars['exp']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['index']->value => $_smarty_tpl->tpl_vars['exp']->value) {
$_smarty_tpl->tpl_vars['exp']->do_else = false;
?>
                    <?php if (is_array($_smarty_tpl->tpl_vars['exp']->value)) {?>
                        experiences.push({
                            title: "<?php echo (($tmp = strtr((string)$_smarty_tpl->tpl_vars['exp']->value['WE_JobTitle'], array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/", "<!--" => "<\!--", "<s" => "<\s", "<S" => "<\S" )) ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
",
                            org: "<?php echo (($tmp = strtr((string)$_smarty_tpl->tpl_vars['exp']->value['WE_Company'], array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/", "<!--" => "<\!--", "<s" => "<\s", "<S" => "<\S" )) ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
",
                            start_date: "<?php echo (($tmp = strtr((string)smarty_modifier_date_format($_smarty_tpl->tpl_vars['exp']->value['WE_From'],'%Y-%m'), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/", "<!--" => "<\!--", "<s" => "<\s", "<S" => "<\S" )) ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
",
                            end_date: "<?php echo (($tmp = strtr((string)smarty_modifier_date_format($_smarty_tpl->tpl_vars['exp']->value['WE_To'],'%Y-%m'), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/", "<!--" => "<\!--", "<s" => "<\s", "<S" => "<\S" )) ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
",
                            desc: "<?php echo (($tmp = strtr((string)$_smarty_tpl->tpl_vars['exp']->value['WE_Description'], array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/", "<!--" => "<\!--", "<s" => "<\s", "<S" => "<\S" )) ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
",
                            is_current: "<?php echo strtr((string)(($tmp = $_smarty_tpl->tpl_vars['exp']->value['WE_Iworkhere'] ?? null)===null||$tmp==='' ? '0' ?? null : $tmp), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/", "<!--" => "<\!--", "<s" => "<\s", "<S" => "<\S" ));?>
"
                        });
                    <?php }?>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            <?php }?>
            break;
            
        case 'education':
            <?php if ($_smarty_tpl->tpl_vars['existingEducations']->value && is_array($_smarty_tpl->tpl_vars['existingEducations']->value)) {?>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['existingEducations']->value, 'edu', false, 'index');
$_smarty_tpl->tpl_vars['edu']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['index']->value => $_smarty_tpl->tpl_vars['edu']->value) {
$_smarty_tpl->tpl_vars['edu']->do_else = false;
?>
                    <?php if (is_array($_smarty_tpl->tpl_vars['edu']->value)) {?>
                        educations.push({
                            title: "<?php echo (($tmp = strtr((string)$_smarty_tpl->tpl_vars['edu']->value['ED_DegreeSpecialty'], array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/", "<!--" => "<\!--", "<s" => "<\s", "<S" => "<\S" )) ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
",
                            org: "<?php echo (($tmp = strtr((string)$_smarty_tpl->tpl_vars['edu']->value['ED_UniversityInstitution'], array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/", "<!--" => "<\!--", "<s" => "<\s", "<S" => "<\S" )) ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
",
                            start_date: "<?php echo (($tmp = strtr((string)smarty_modifier_date_format($_smarty_tpl->tpl_vars['edu']->value['ED_From'],'%Y-%m'), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/", "<!--" => "<\!--", "<s" => "<\s", "<S" => "<\S" )) ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
",
                            end_date: "<?php echo (($tmp = strtr((string)smarty_modifier_date_format($_smarty_tpl->tpl_vars['edu']->value['ED_To'],'%Y-%m'), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/", "<!--" => "<\!--", "<s" => "<\s", "<S" => "<\S" )) ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
",
                            is_current: "<?php echo strtr((string)(($tmp = $_smarty_tpl->tpl_vars['edu']->value['WE_Istudyhere'] ?? null)===null||$tmp==='' ? '0' ?? null : $tmp), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/", "<!--" => "<\!--", "<s" => "<\s", "<S" => "<\S" ));?>
"
                        });
                    <?php }?>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            <?php }?>
            break;
    }
    
    
}

function initializePage(type) {
    if (!type) {
        // Auto-detect based on current page
        if (document.getElementById('experienceCardsContainer')) {
            type = 'experience';
        } else if (document.getElementById('educationCardsContainer')) {
            type = 'education';
        }
    }
    
    if (!type) return;
    
    // Initialize data from PHP
    initDataFromPHP(type);
    
    // Render cards
    renderCards(type);
    
    // Sync to SJB fields
    syncToSJBField(type);
    
    // Setup year dropdowns if modal exists
    var config = FORM_CONFIG[type];
    if (config && config.modalConfig) {
        setupYearDropdowns(type);
    }
}

// ======================= FORM SUBMISSION =======================
function prepareFormBeforeSubmit() {
    // Sync all data types to their respective SJB fields
    for (var type in FORM_CONFIG) {
        if (FORM_CONFIG.hasOwnProperty(type)) {
            var dataArray = getDataArray(type);
            if (dataArray && dataArray.length > 0) {
                syncToSJBField(type);
            }
        }
    }
    
    // Set action_add
    var actionAddField = document.getElementById('hidden_action_add');
    if (actionAddField) {
        actionAddField.value = '1';
    }
    
    return true;
}

// ======================= COMPATIBILITY FUNCTIONS =======================
// Keep old function names for backward compatibility on Experience page
function showExperienceModal(index) {
    showModal('experience', index);
}

function saveExperience() {
    saveItem('experience');
}

function deleteExperience(index) {
    deleteItem('experience', index);
}

function editExperience(index) {
    editItem('experience', index);
}

// For Education page
function showEducationModal(index) {
    showModal('education', index);
}

function saveEducation() {
    saveItem('education');
}

function deleteEducation(index) {
    deleteItem('education', index);
}

function editEducation(index) {
    editItem('education', index);
}

// ======================= EVENT LISTENERS =======================
document.addEventListener('DOMContentLoaded', function() {
    // Initialize based on current page
    initializePage();
    
    // Setup event listeners for modal save buttons
    var experienceSaveBtn = document.querySelector('#experienceModal .btn-primary');
    if (experienceSaveBtn) {
        experienceSaveBtn.onclick = function() { saveItem('experience'); };
    }
    
    var educationSaveBtn = document.querySelector('#educationModal .btn-primary');
    if (educationSaveBtn) {
        educationSaveBtn.onclick = function() { saveItem('education'); };
    }
});

function hideDateAlert(type) {
    var config = FORM_CONFIG[type];
    var modalConfig = config.modalConfig;
    var modal = document.getElementById(modalConfig.modalId);
    
    if (modal) {
        // Hide the alert container
        var alertContainer = modal.querySelector('.date-validation-alert');
        if (alertContainer) {
            alertContainer.style.display = 'none';
        }
        
        // Remove red borders from date fields
        highlightDateFields(type, false);
    }
}

<?php echo '</script'; ?>
>
<?php $_block_repeat=false;
echo $_block_plugin11->_tpl_javascript(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>


<?php }
}
