<?php

class SJB_Admin_Miscellaneous_AjaxFileUploadHandler extends SJB_Miscellaneous_AjaxFileUploadHandler
{
    public function isAccessible()
    {
        $this->setPermissionLabel(SJB_Acl::ADMIN_JOB_BOARD);
        return parent::isAccessible();
    }
}
