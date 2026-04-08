<?php

use SJB\Social;

class SJB_Social_SocialPlugins extends SJB_Function
{
    public function execute()
    {
        $tp = SJB_System::getTemplateProcessor();
        $tp->assign('networks', Social::getNetworks());
        $tp->assign('user_group', SJB_Array::get($this->params, 'user_group', []));
        $tp->assign('user_group_id', SJB_Request::getVar('user_group_id', null));
        $tp->display('social_plugins.tpl');
    }
}
