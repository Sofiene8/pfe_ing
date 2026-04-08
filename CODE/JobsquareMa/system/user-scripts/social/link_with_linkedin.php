<?php

class SJB_Social_LinkWithLinkedin extends SJB_Function
{
    public function execute()
    {
        if (SJB_Authorization::isUserLoggedIn() && class_exists('SJB_SocialPlugin') && !SJB_SocialPlugin::getProfileObject() && $socPlugins = SJB_SocialPlugin::getAvailablePlugins()) {
            if (empty($socPlugins)) {
                return null;
            }
            $tp = SJB_System::getTemplateProcessor();
            $socialNetworks = SJB_SocialPlugin::getSocialNetworks($socPlugins);
            $tp->assign('label', 'link');
            $tp->assign('social_plugins', $socialNetworks);
            $tp->display('social_plugins.tpl');
        }
    }
}
