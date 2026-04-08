<?php

class SJB_Admin_Users_EditUserProfileField extends SJB_Function
{
    public function isAccessible()
    {
        $this->setPermissionLabel(SJB_Acl::ADMIN_SETTINGS);
        return parent::isAccessible();
    }

	public function execute()
	{
		$tp = SJB_System::getTemplateProcessor();
		$user_group_sid = SJB_Request::getVar('user_group_sid', null);
		$user_group_info = SJB_UserGroupManager::getUserGroupInfoBySID($user_group_sid);
		$user_profile_field_sid = SJB_Request::getVar('sid', null);

		if (!is_null($user_profile_field_sid)) {
			$user_profile_field_info = SJB_UserProfileFieldManager::getFieldInfoBySID($user_profile_field_sid);
			$user_profile_field_old_id = $user_profile_field_info['id'];
			$user_profile_field_info = array_merge($user_profile_field_info, $_REQUEST);
			$user_profile_field = new SJB_UserProfileField($user_profile_field_info);
			$user_profile_field->setSID($user_profile_field_sid);
			$user_profile_field->setUserGroupSID($user_group_sid);

			$form_submitted = SJB_Request::getVar('action');

			if (in_array($user_profile_field->field_type, array('multilist'))) {
				$user_profile_field->addDisplayAsProperty($user_profile_field_info['display_as']);
			}

			$edit_form = new SJB_Form($user_profile_field);

			$errors = array();

			if ($form_submitted && $edit_form->isDataValid($errors)) {
                $vals = SJB_Request::getVar('item_value', []);
                $itemManager = new SJB_UserProfileFieldListItemManager();
                foreach ($vals as $order => $val) {
                    $list_item = new SJB_ListItem();
                    $list_item->setFieldSID($user_profile_field_sid);
                    if (key($val) != 'new') {
                        $list_item->setSID(key($val));
                    }
                    $list_item->setValue(current($val));

                    if ($list_item->getSID() && $list_item->getValue() === '') {
                        $itemManager->deleteListItemBySID($list_item->getSID());
                    } elseif ($list_item->getValue() != '') {
                        $itemManager->saveListItem($list_item, $order);
                    }
                }
				SJB_UserProfileFieldManager::saveUserProfileField($user_profile_field);
				$user_profile_field_new_id = $user_profile_field_info['id'];
				if ($user_profile_field_old_id != $user_profile_field_new_id) {
					SJB_UserProfileFieldManager::changeUserPropertyIDs($user_group_sid, $user_profile_field_old_id, $user_profile_field_new_id);
				}

				if ($form_submitted == 'save_info') {
					SJB_HelperFunctions::redirect(SJB_System::getSystemSettings('SITE_URL') . '/edit-user-profile/?user_group_sid=' . $user_group_sid);
				}
			}
			if (($user_profile_field_info['id'] == 'Location') && empty($errors['ID'])) {
				$edit_form->makeDisabled('id');
			}
			$edit_form->registerTags($tp);
			$edit_form->makeDisabled('type');
            if (in_array($user_profile_field->getFieldType(), ['unique_email', 'password'])) {
                $edit_form->makeDisabled('is_required');
            }
			$tp->assign('user_group_sid', $user_group_sid);
			$tp->assign('form_fields', $edit_form->getFormFieldsInfo());
			$tp->assign('errors', $errors);
			$tp->assign('field_type', $user_profile_field->getFieldType());
			$tp->assign('user_profile_field_info', $user_profile_field_info);
			$tp->assign('user_profile_field_sid', $user_profile_field_sid);
			$tp->assign('user_group_info', $user_group_info);
			$tp->display('edit_user_profile_field.tpl');
		}
	}
}
