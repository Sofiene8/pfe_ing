<?php

class SJB_Admin_I18n_EditPhrase extends SJB_Function
{
    public function isAccessible()
    {
        $this->setPermissionLabel(SJB_Acl::ADMIN_SETTINGS);
        return parent::isAccessible();
    }

	public function execute()
	{
		$errors = array();
		$result = true;

		$phrases = SJB_Request::getVar('phrases');

		$i18n = SJB_ObjectMother::createI18N();
		$template_processor = SJB_System::getTemplateProcessor();
		$langData = $i18n->getLanguageData(SJB_Settings::getValue('i18n_default_language'));
		$i = 0;
		foreach ($phrases as $phrase) {
			$i++;
            $action = SJB_PhraseActionFactory::get('update_phrase', array(
                'phrase' => $phrase['name'],
                'domain' => 'Frontend',
                'translations' => array(
                    $langData['id'] => $phrase['value']
                )
            ), $template_processor);

            $action->perform($i == count($phrases));
            $result &= $action->result == 'saved';
		}
		if ($errors || empty($result)) {
			echo 'error';
		} else {
			echo 'ok';
		}
		exit();
	}
}
