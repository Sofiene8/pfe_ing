<?php

class SJB_Admin_Classifieds_EditState extends SJB_Function
{
    public function isAccessible()
    {
        $this->setPermissionLabel(SJB_Acl::ADMIN_SETTINGS);
        return parent::isAccessible();
    }

	public function execute()
	{
	
		$state_sid = SJB_Request::getVar('sid', null);
		$state_text = SJB_Request::getVar('state', '');
		$state_picture = SJB_Request::getVar('picture', '');
		$display=SJB_Request::getVar('display', 0);
		$description = SJB_Request::getVar('description', '');
		$url = SJB_Request::getVar('url', '');
		$tp = SJB_System::getTemplateProcessor();

		if (!is_null($state_sid)) {
			$state_info = SJB_StateManager::getStateInfoBySID($state_sid);
			
			$state_info = array_merge($state_info[0], $_REQUEST);
			}
			
			$state = new SJB_State($state_info);
			if (!is_null($state_sid)&&$state_sid!="" ) {
			$state->setSID($state_sid);
			$state->setName($state_info['state']);
			$state->setDisplay($display);
			$state->setUrl($url);
			$state->setPicture($state_info['picture']);
			$state->setDescription($description);
			}
			else{
			
			$state->setName($state_text);
			
			$state->setDisplay($display);
			$state->setUrl($url);
			$state->setDescription($description);
			
			}
		
	
			 $upload_file_directory = SJB_System::getSystemSettings('UPLOAD_FILES_DIRECTORY');
		
			 $target_dir = $upload_file_directory."/states/";
			
			 $target_file = $target_dir . basename($_FILES["picture"]["name"]);
			 
			 if (move_uploaded_file($_FILES['picture']['tmp_name'], $target_file)) {
			
				$state->setPicture(basename($_FILES["picture"]["name"]));
			} 
			$form_submitted = SJB_Request::getVar('action', '');

			//$edit_form = new SJB_Form($message);
			
			$errors = array();

		if ($form_submitted) {
			
				$id=SJB_StateManager::saveState($state);
				

				if ($id)
					SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL') . '/manage_states/');
			}

			//$edit_form->registerTags($tp);
			
		
			$tp->assign('object_sid', $state);
		//	$tp->assign('form_fields', $edit_form->getFormFieldsInfo());
			$tp->assign('errors', $errors);
			$tp->assign('state', $state_info);
			$tp->assign('state_sid', $state_sid);
			$tp->display('edit_state.tpl');
		
	}
}
