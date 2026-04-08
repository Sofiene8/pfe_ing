<?php

namespace SJB\Social;

class LinkedIn
{
    /**
     * @var \Zend_Oauth_Consumer
     */
    private $consumer;

    private $fields = [
        'id',
        'email-address',
        'main-address',
        'formatted-name',
        'headline',
        'industry',
        'summary',
        'positions',
        'specialties',
        'picture-urls::(original)',
        'location'
    ];

    public static function getName()
    {
        return 'LinkedIn';
    }

    private function getOauthOptions()
    {
        return [
            'siteUrl'               => 'https://www.linkedin.com/uas/oauth',
            'requestTokenUrl'       => 'https://www.linkedin.com/uas/oauth/requestToken',
            'userAuthorizationUrl'  => 'https://www.linkedin.com/uas/oauth/authenticate',
            'accessTokenUrl'        => 'https://www.linkedin.com/uas/oauth/accessToken',
            'consumerKey'           => \SJB_Settings::getSettingByName('li_apiKey'),
            'consumerSecret'        => \SJB_Settings::getSettingByName('li_secKey'),
            'version'               => '1.0',
            'invalidateTokenUrl'    => 'https://www.linkedin.com/uas/oauth/invalidateToken',
            'localUrl'              => \SJB_H::getCustomDomainUrl() . \SJB_Navigator::getURI() . '?' . $_SERVER['QUERY_STRING'],
            'callbackUrl'           => \SJB_H::getCustomDomainUrl() . \SJB_Navigator::getURI() . '?' . $_SERVER['QUERY_STRING'],
        ];
    }

    public function init()
    {
        $this->consumer = new \Zend_Oauth_Consumer($this->getOauthOptions());

        if (!\SJB_Request::getVar('oauth_token')) {
            \SJB_Session::setValue('LinkedInRequestToken', $this->consumer->getRequestToken());
            $this->consumer->redirect();
        }
    }

    private function getUserInfo()
    {
        $client = $this->consumer
            ->getAccessToken(\SJB_Request::get(), \SJB_Session::getValue('LinkedInRequestToken'))
            ->getHttpClient($this->getOauthOptions());
        $client->setUri('https://api.linkedin.com/v1/people/~:(' . join(',', $this->fields) . ')');
        $client->setMethod(\Zend_Http_Client::GET);
        $client->setParameterGet('format', 'json');
        return json_decode($client->request()->getBody(), true);
    }

    public function getUser()
    {
        $userInfo = $this->getUserInfo();
        $user = \SJB_UserManager::getUserInfoByUserName($userInfo['emailAddress']);
        if ($user) {
            return $user;
        }
        return false;
    }

    public function fillUser(\SJB_User $user)
    {
        $u = $this->getUserInfo();
        $user->setPropertyValue('username', $u['emailAddress']);
        $user->setPropertyValue('FullName', $u['formattedName']);
        $user->setPropertyValue('password', md5(serialize($u)));
        if (!empty($u['positions']['values'][0]['company'])) {
            $user->setPropertyValue('CompanyName', $u['positions']['values'][0]['company']['name']);
        }
        if (!empty($u['location']['name'])) {
            $user->setPropertyValue('GooglePlace', $u['location']['name']);
        }
        return true;
    }

    public function fillListing(\SJB_Listing $listing)
    {
        $user = $this->getUserInfo();
        if (!empty($user['pictureUrls']['values'])) {
            $listing->setPropertyValue('Photo', $user['pictureUrls']['values'][0]);
        }
        if (!empty($user['location']['name'])) {
            $listing->setPropertyValue('GooglePlace', $user['location']['name']);
        }
        if (!empty($user['summary'])) {
            $listing->setPropertyValue('Skills', $user['summary']);
        }
        if (!empty($user['positions'])) {
            $we = [
                'WE_JobTitle' => [],
                'WE_Company' => [],
                'WE_From' => [],
                'WE_To' => [],
                'WE_Description' => [],
            ];
            foreach ($user['positions']['values'] as $key => $work) {
                $key++;
                $we['WE_JobTitle'][$key] = empty($work['title']) ? '' : $work['title'];
                $we['WE_Company'][$key] = empty($work['company']) ? '' : $work['company']['name'];
                $we['WE_From'][$key] = empty($work['startDate']) ? '' : '01-' . $work['startDate']['month'] . '-' . $work['startDate']['year'];
                $we['WE_To'][$key] = empty($work['endDate']) ? '' : '01-' . $work['endDate']['month'] . '-' . $work['endDate']['year'];;
                $we['WE_Description'][$key] = empty($work['summary']) ? '' : $work['summary'];;
            }
            $listing->setPropertyValue('WorkExperience', $we);
        }
        return true;
    }
}
