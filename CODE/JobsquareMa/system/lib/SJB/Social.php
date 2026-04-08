<?php

namespace SJB;

use SJB\Social\Facebook;
use SJB\Social\LinkedIn;

class Social
{
    private static $networks = false;

    private static function init()
    {
        if (self::$networks === false) {
            self::$networks = [];
            if (\SJB_PluginManager::isPluginActive('SocialLoginPlugin')) {
                if (\SJB_Settings::getValue('li_signin')) {
                    self::$networks['linkedin'] = new LinkedIn();
                }
                if (\SJB_Settings::getValue('fb_signin')) {
                    self::$networks['facebook'] = new Facebook();
                }
            }
        }
        $network = \SJB_Request::getVar('network');
        if ($network && isset(self::$networks[$network])) {
            self::$networks[$network]->init();
        }
    }

    public static function __callStatic($name, $arguments)
    {
        self::init();
        try {
            foreach (self::$networks as $network => $instance) {
                if (\SJB_Request::getVar('network') == $network) {
                    return call_user_func_array([$instance, $name], $arguments);
                }
            }
        } catch (\Exception $ex) {
        }
        return false;
    }

    public static function getNetworks()
    {
        self::init();
        return self::$networks;
    }

}
