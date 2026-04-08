<?php

class SJB_Admin_ListingImport_DeleteImport extends SJB_Function
{
    public function isAccessible()
    {
        $this->setPermissionLabel(SJB_Acl::ADMIN_SETTINGS);
        return parent::isAccessible();
    }

    public function execute()
    {
        SJB_DB::query("DELETE FROM `parsers` WHERE id = ?n", SJB_Request::getInt('id'));
        SJB_H::redirect(SJB_H::getAdminSiteUrl() . '/show-import/');
    }
}
