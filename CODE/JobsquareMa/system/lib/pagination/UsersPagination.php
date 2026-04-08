<?php

class SJB_UsersPagination extends SJB_Pagination
{
    public function __construct($userGroupInfo, $template)
    {
        if ($userGroupInfo['id'] == 'JobSeeker' || $userGroupInfo['id'] == 'Employer') {
            $this->item = mb_strtolower($userGroupInfo['name'], 'utf8') . 's';
        } else {
            $this->item = '\'' . mb_strtolower($userGroupInfo['name'], 'utf8') . '\' users';
        }

        $this->countActionsButtons = 2;
        $this->popUp = true;
        $actionsForSelect = [
            'activate' => ['name' => 'Activate'],
            'deactivate' => ['name' => 'Deactivate'],
            'delete' => ['name' => 'Delete'],
        ];
        $this->setActionsForSelect($actionsForSelect);

        $fields = [
            'CompanyName' => ['name' => 'Company Name', 'isVisible' => $userGroupInfo['id'] == 'Employer'],
            'name' => ['name' => 'Name', 'isVisible' => $userGroupInfo['id'] == 'JobSeeker', 'isSort' => false],
            'username' => ['name' => 'Email'],
            'Location' => ['name' => 'Location', 'isVisible' => $userGroupInfo['id'] == 'Employer', 'isSort' => false],
            'registration_date' => ['name' => 'Registration Date'],
            'active' => ['name' => 'Status', 'isSort' => false],
        ];

        $this->setSortingFieldsToPaginationInfo($fields);

        parent::__construct('registration_date', 'DESC');
    }
}
