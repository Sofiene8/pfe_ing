<?php

namespace SJB\Analytics;

use Intercom\IntercomBasicAuthClient;
use KISSmetrics\Client;
use KISSmetrics\Transport\Sockets;

class Logger
{
    public static function log($event, $params = [])
    {
        if (!\SJB_H::isSaas()) {
            return;
        }

        $billingEmail = \SJB_Settings::getValue('billing_email');
        if (!$billingEmail) {
            $response = \SJB_H::whmcsCall('getemailbydomain', [
                'domain' => \SJB_System::getSystemSettings('HTTPHOST'),
            ]);
            if (empty($response['email'])) {
                return;
            }
            $billingEmail = $response['email'];
            \SJB_Settings::saveSetting('billing_email', $billingEmail);
        }

        try {
            $params = array_merge(['Trial Name' => \SJB_System::getSystemSettings('HTTPHOST')], $params);
            $km = new Client(\SJB_System::getSystemSettings('env')['Kissmetrics']['key'], Sockets::initDefault());
            $km->identify($billingEmail)
                ->record($event, $params)
                ->submit();
        } catch (\Exception $ex) {
        }
    }

    public static function intercom($event)
    {
        if (!\SJB_H::isSaas()) {
            return;
        }

        $settings = \SJB_System::getSystemSettings('env')['Intercom'];
        if (!isset($settings['app'], $settings['key'])) {
            return;
        }

        try {
            $intercom = IntercomBasicAuthClient::factory([
                'app_id' => $settings['app'],
                'api_key' => $settings['key'],
            ]);
            $intercom->createEvent([
                'event_name' => $event,
                'created_at' => time(),
                'user_id' => \SJB_Session::getValue('saas')['id'],
            ]);
        } catch (\Exception $ex) {
        }
    }
}
