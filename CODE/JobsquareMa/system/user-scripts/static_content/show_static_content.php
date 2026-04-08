<?php

class SJB_StaticContent_ShowStaticContent extends SJB_Function
{
	public function execute()
	{
		$content = SJB_Request::getInstance()->page_config->getPageContent();
		$title = SJB_Request::getInstance()->page_config->getPageTitle();
		$tp = SJB_System::getTemplateProcessor();
		$tp->assign('staticContent', $content);
		$tp->assign('staticContentTitle', $title);
		$tp->display('static_content.tpl');
	}
}
