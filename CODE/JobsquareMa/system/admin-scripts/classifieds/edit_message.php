<?php

class SJB_Admin_Classifieds_EditMessage extends SJB_Function
{
    public function isAccessible()
    {
        $this->setPermissionLabel(SJB_Acl::ADMIN_SETTINGS);
        return parent::isAccessible();
    }

	public function execute()
	{
	
		$message_sid = SJB_Request::getVar('sid', null);
		$message_text = SJB_Request::getVar('message', '');
		
		$tp = SJB_System::getTemplateProcessor();

		if (!is_null($message_sid)) {
			$message_info = SJB_MessageManager::getMessageInfoBySID($message_sid);
			
			$message_info = array_merge($message_info[0], $_REQUEST);
			}
			
			$message = new SJB_Message($message_info);
			if (!is_null($message_sid)&&$message_sid!="" ) {
			$message->setSID($message_sid);
			$message->setMessage($message_info['message']);
			}
			else{
			
			$message->setMessage($message_text);
			}
			$form_submitted = SJB_Request::getVar('action', '');

			//$edit_form = new SJB_Form($message);
			
			$errors = array();

		if ($form_submitted) {
			
				$id=SJB_MessageManager::saveMessage($message);
				

				if ($id)
					SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL') . '/edit-message/?sid='.$id);
			}

			//$edit_form->registerTags($tp);
			
		
			$tp->assign('object_sid', $message);
		//	$tp->assign('form_fields', $edit_form->getFormFieldsInfo());
			$tp->assign('errors', $errors);
			$tp->assign('message', $message_info);
			$tp->assign('message_sid', $message_sid);
			$tp->display('edit_message.tpl');
		
	}
}
