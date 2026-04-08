<?php

class SJB_AdminNotifications
{
    public static function sendContactFormMessage($name, $sEmail, $comments)
    {
        $params = [
            'name' => $name,
            'email' => $sEmail,
            'comments' => $comments
        ];
        $admin_email = SJB_Settings::getSettingByName('system_email');

        $email = SJB_EmailTemplateEditor::getEmail($admin_email, SJB_Notifications::getEmailSid('Contact Form Email'), $params);
        if ($email) {
            $email->setReplyTo($sEmail);
            return $email->send();
        }
        return null;
    }

    public static function sendProductConfirmationLetter($data)
    {
        $email = SJB_EmailTemplateEditor::getEmail(SJB_Settings::getSettingByName('system_email'), SJB_Notifications::getEmailSid('Product Purchase Confirmation for Admin'), $data);
        return $email->send();
    }

}
