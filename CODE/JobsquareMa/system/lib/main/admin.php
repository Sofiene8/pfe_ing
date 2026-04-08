<?php

class SJB_Admin
{
    /**
     * @package Users
     * @subpackage Administrators
     */

    /**
     * checking for existing authorized administrator
     * Function checks if administrator has authorized
     * @return bool 'true' if administrator has authorized or 'false' otherwise
     */
    public static function admin_authed()
    {
        return !is_null(SJB_Session::getValue('username')) && !is_null(SJB_Session::getValue('usertype')) && SJB_Session::getValue('usertype') == "admin";
    }

    /**
     * logging into system as administrator
     *
     * Function logs administrator into system.
     * If operation succeded it registers session variables 'username' and 'usertype'
     *
     * @param string $username user's name
     * @param array $saas
     * @param array $admin
     * @param string $password
     * @return bool 'true' if operation succeeded or 'false' otherwise
     */
    public static function admin_login($username, $saas = [], $admin = [], $password = '')
    {
        SJB_Session::setValue('username', $username);
        if ($saas) {
            SJB_Session::setValue('saas', $saas);
            SJB_Session::setValue('password', $password);

            if (SJB_Settings::getValue('was_logged_in')) {
                \SJB\Analytics\Logger::log('Logged in');
            } else {
                SJB_Settings::addSetting('was_logged_in', '1');
                \SJB\Analytics\Logger::log('First login');
                SJB_Session::setValue('first_login', true);
            }
        }
        SJB_Session::setValue('usertype', 'admin');
        SJB_Session::setValue('admin', $admin ?: SJB_DB::query('select * from `admins` where `email` = ?s', $username)[0]);
        setcookie('admin_mode', 'on', 0, '/');
        return true;
    }

    public static function getAdmin($username)
    {
        $admin = SJB_DB::query("SELECT * FROM `admins` WHERE `email` = ?s AND `status` = 'Active'", $username);
        if ($admin) {
            return current($admin);
        }
        return false;
    }

    /**
     * logging administrator out of system
     *
     * Function logs administrator out of system
     */
    public static function admin_log_out()
    {
        SJB_Session::unsetValue('username');
        SJB_Session::unsetValue('usertype');
        SJB_Session::unsetValue('admin');
        setcookie("admin_mode", '', time() - 3600, '/');
    }
}
