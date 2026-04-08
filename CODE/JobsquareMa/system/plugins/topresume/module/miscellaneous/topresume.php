<?php

class SJB_Admin_Miscellaneous_Topresume extends SJB_Function
{
    public function isAccessible()
    {
        $this->setPermissionLabel(SJB_Acl::ADMIN_SETTINGS);
        return parent::isAccessible();
    }

    public function execute()
    {
        $tp = SJB_System::getTemplateProcessor();

        $errors = [];
        $action = SJB_Request::getVar('action', '');

        switch ($action) {
            case 'apply':
                $topResumeApply = new SJB_TopResumeApply($_REQUEST);
                $topResumeApplyForm = new SJB_Form($topResumeApply);
                $topResumeApplyForm->registerTags($tp);
                if ($topResumeApplyForm->isDataValid($errors)) {
                    $email = new SJB_Email('partnerships@talentinc.com', [
                        SJB_EmailInternal::EMAIL_DATA_LABEL => [
                            'subject' => sprintf('Partnership application from - %s (Smartjobboard)', $topResumeApply->getPropertyValue('site_url')),
                            'message' => "
                            <p>Contact Name: {$topResumeApply->getPropertyValue('name')}</p>
                            <p>Email: {$topResumeApply->getPropertyValue('email')}</p>
                            <p>Phone number: {$topResumeApply->getPropertyValue('phone')}</p>
                            <p>Site URL: {$topResumeApply->getPropertyValue('site_url')}</p>
                            <p>Country: {$topResumeApply->getPropertyValue('country')}</p>
                            <p>Majority of traffic comes from: {$topResumeApply->getPropertyValue('traffic_from')}</p>
                            <p>Job board audience: {$topResumeApply->getPropertyValue('audience')}</p>
                            ",
                        ]
                    ]);
                    $email->addBCC('telpizov@gmail.com');
                    if ($email->send()) {
                        $tp->assign('message', 'Your application is successfully sent');
                    } else {
                        $errors[] = 'Oops... Something went wrong. Please try again!';
                    }
                }
                break;
            case 'save':
                SJB_Settings::saveSetting('topresume_key', SJB_Request::getVar('key'));
                SJB_Settings::saveSetting('topresume_secret', SJB_Request::getVar('secret'));
                break;
        }
        $topResumeApply = new SJB_TopResumeApply($_REQUEST);
        $topResumeApplyForm = new SJB_Form($topResumeApply);
        $topResumeApplyForm->registerTags($tp);
        $tp->assign('form_fields', $topResumeApplyForm->getFormFieldsInfo());
        $tp->assign('errors', $errors);
        $tp->assign('action', $action);
        $tp->assign('settings', SJB_Settings::getSettings());
        $tp->display(__DIR__ . '/topresume.tpl');
    }
}
