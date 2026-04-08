<?php

class SJB_Classifieds_ApplicationRedirect extends SJB_Function
{
    public function execute()
    {
        $listing_id = SJB_Request::getVar('listing_id');
        $listingInfo = SJB_ListingManager::getListingInfoBySID($listing_id);
        if (!empty($listingInfo['ApplicationSettings']['add_parameter']) && $listingInfo['ApplicationSettings']['add_parameter'] == 2) {
            $counted = SJB_Session::getValue('listing_redirect_' . $listing_id);
            if (!$counted) {
                SJB_DB::query('update `listings` set `application_redirects` = `application_redirects` + 1 where `sid` = ?n', $listing_id);
                SJB_Session::setValue('listing_redirect_' . $listing_id, 1);
            }
            SJB_H::redirect($listingInfo['ApplicationSettings']['value']);
        }

        echo SJB_System::executeFunction('miscellaneous', '404_not_found');
    }
}
