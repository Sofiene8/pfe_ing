<?php

class SJB_Admin_Miscellaneous_GuidedTour extends SJB_Function
{
    public function execute()
    {
        $action = SJB_Request::getVar('action');
        switch ($action) {
            case 'start':
                \SJB\Analytics\Logger::log('Tour Started');
                SJB_Settings::saveSetting('tour_accepted', true);
                break;
            case 'skipped':
            case 'finished':
                \SJB\Analytics\Logger::log('Tour ' . ucfirst($action));
                SJB_Settings::saveSetting('tour_accepted', false);
                break;
            case 'step':
                SJB_Settings::saveSetting('tour_step', SJB_Request::getVar('step'));
                break;
            default:
                $showTour = SJB_H::isSaas();
                $showTour &= SJB_Session::getValue('first_login') || SJB_Settings::getValue('tour_accepted');
                $admin = SJB_Session::getValue('admin');
                $showTour &= !empty($admin['owner']);
                if ($showTour) {
                    $tp = SJB_System::getTemplateProcessor();
                    $tp->assign('tour_accepted', SJB_Settings::getValue('tour_accepted'));
                    $tp->assign('step', SJB_Settings::getValue('tour_step', 1));
                    $tp->display('tour.tpl');
                }
                break;
        }
    }
}
