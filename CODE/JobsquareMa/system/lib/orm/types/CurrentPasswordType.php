<?php

class SJB_CurrentPasswordType extends SJB_Type
{
    protected $default_template = 'current_password.tpl';

    function isValid()
    {
        $isValid = parent::isValid();
        if ($isValid === true && !empty($this->property_info['current_password'])) {
            if (!empty($this->property_info['saas_owner'])) {
                $currentAdmin = SJB_Session::getValue('admin');
                $saasInfo = SJB_HelperFunctions::whmcsCall('saasinfo', [
                    'domain' => SJB_System::getSystemSettings('HTTPHOST'),
                    'saas_login' => $currentAdmin['email'],
                    'saas_pass' => $this->property_info['value'],
                ]);
                if (empty($saasInfo) || $saasInfo['result'] == 'error' || empty($saasInfo['owner'])) {
                    $isValid = 'Current Password is not valid';
                }
            } elseif (!self::verifyPassword($this->property_info['value'], $this->property_info['current_password'])) {
                $isValid = 'Current Password is not valid';
            }
        }
        return $isValid;
    }

    /**
     * Verify a password against a stored hash (bcrypt or legacy MD5).
     * Returns true if the password matches.
     */
    public static function verifyPassword($plainPassword, $storedHash)
    {
        // Try bcrypt first
        if (password_verify($plainPassword, $storedHash)) {
            return true;
        }
        // Fallback: legacy MD5 check
        if ($storedHash === md5($plainPassword)) {
            return true;
        }
        return false;
    }
}
