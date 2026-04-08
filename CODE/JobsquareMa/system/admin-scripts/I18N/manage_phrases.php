<?php

class SJB_Admin_I18n_ManagePhrases extends SJB_Function
{
    public function isAccessible()
    {
        $this->setPermissionLabel(SJB_Acl::ADMIN_SETTINGS);
        return parent::isAccessible();
    }

	private static $phrases;

	public function execute()
	{
		$errors = [];
		$result = '';
		$paginator = new SJB_ManagePhrasesPagination();
		$tp = SJB_System::getTemplateProcessor();
		$foundPhrases = '';

		if (SJB_Request::getMethod() == SJB_Request::METHOD_POST && SJB_Request::getVar('i18n_default_language')) {
			SJB_Settings::updateSetting('i18n_default_language', SJB_Request::getVar('i18n_default_language'));
		}

		$action_name = SJB_Request::getVar('action', 'search_phrases');
		$paginator->setUniqueUrlParams($_REQUEST);
		$params = $_REQUEST;
		$params['language'] = SJB_Settings::getValue('i18n_default_language');

		$action = SJB_PhraseActionFactory::get($action_name, $params, $tp);
		if ($action->canPerform()) {
			$action->perform();
			$result = isset($_REQUEST['result']) ? $_REQUEST['result'] : $action->result;

			$total = $this->getPhrasesCount();
			$paginator->setItemsCount($total);
			if ($paginator->itemsPerPage == 'all') {
				$foundPhrases = self::$phrases;
			} else {
				$foundPhrases = $this->getPhrasesByPage($paginator->currentPage, $paginator->itemsPerPage);
			}
		} else {
			$errors = $action->getErrors();
		}

		$i18n = SJB_ObjectMother::createI18N();

		$domains = $i18n->getDomainsData();
		$languages = $i18n->getLanguagesData();

		$tp->assign('paginationInfo', $paginator->getPaginationInfo());
		$tp->assign('result', $result);
		$tp->assign('domains', $domains);
		$tp->assign('languages', $languages);
		$tp->assign('settings', SJB_Settings::getSettings());
		$tp->assign('errors', $errors);
		$tp->assign('found_phrases', $foundPhrases);
		$tp->display('manage_phrases.tpl');
	}

	public static function setPhrases($phrases)
	{
		self::$phrases = $phrases;
	}

	public function getPhrasesCount()
	{
		return count(self::$phrases);
	}

	private static function getPhrasesByPage($page, $items_per_page)
	{
		$end = $page * $items_per_page;
		$begin = $end - $items_per_page;
		if ($end > count(self::$phrases)) {
			$end = $end - ($end - count(self::$phrases));
		}
		$found_phrases = '';
		for ($i = $begin; $i <= $end - 1; $i++) {
			$found_phrases[$i] = self::$phrases[$i];
		}
		return $found_phrases;
	}
}
