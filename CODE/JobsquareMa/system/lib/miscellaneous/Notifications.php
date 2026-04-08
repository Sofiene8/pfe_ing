<?php

class SJB_Notifications
{
    public static function sendUserPasswordChangeLetter($user_sid)
    {
        $user = SJB_UserManager::getObjectBySID($user_sid);
        $user_info = SJB_UserManager::createTemplateStructureForUser($user);
        $data = ['user' => $user_info];
        return SJB_EmailTemplateEditor::getEmail($user_info['username'], self::getEmailSid('Password Recovery'), $data)->send();
    }

    /**
     * @static
     * @param array $listing_info
     * @return null
     */
    public static function sendUserListingExpiredLetter($listing_info)
    {
        $userGroupSID = SJB_Array::getPath($listing_info, 'user/user_group_sid');
        $emailTplSID = SJB_UserGroupManager::getEmailTemplateSIDByUserGroupAndField($userGroupSID, 'notify_on_listing_expiration');
        $user_info = SJB_Array::get($listing_info, 'user');
        $data = ['user' => $user_info, 'listing' => $listing_info];
        $email = SJB_EmailTemplateEditor::getEmail($user_info['username'], $emailTplSID, $data);

        return $email->send();
    }

    /**
     * @param SJB_Contract $contract
     * @return bool
     */
    public static function sendUserContractExpiredLetter($contract)
    {
        $productInfo = SJB_ProductsManager::getProductInfoBySID($contract->getProductId());
        $user = SJB_UserManager::getObjectBySID($contract->getUserSID());
        if (!$user) {
            return false;
        }

        $data = [
            'user' => SJB_UserManager::createTemplateStructureForUser($user),
            'product' => array_merge($productInfo, SJB_ProductsManager::createTemplateStructureForProductForEmailTpl($productInfo)),
        ];
        $email = SJB_EmailTemplateEditor::getEmail($user->getUserName(), self::getEmailSid('Product Expiration Notice'), $data);
        return $email->send();
    }

    /**
     * @param SJB_Contract $contract
     * @param SJB_Invoice $invoice
     * @return bool
     */
    public static function sendUserRecurringContractExpiredLetter($contract, $invoice)
    {
        $productInfo = SJB_ProductsManager::getProductInfoBySID($contract->getProductId());

        $user = SJB_UserManager::getObjectBySID($contract->getUserSID());
        if (!$user) {
            return false;
        }

        $tax = 0;
        $i18n = SJB_I18N::getInstance();
        if ($invoice->getPropertyValue('tax_info')) {
            $taxInfo = $invoice->getPropertyValue('tax_info');
            $tax = $i18n->getFloat($taxInfo['tax_amount']);
        }
        $productInfo['price'] = $i18n->getFloat($productInfo['price']);
        $data = [
            'user' => SJB_UserManager::createTemplateStructureForUser($user),
            'product' => array_merge($productInfo, SJB_ProductsManager::createTemplateStructureForProductForEmailTpl($productInfo)),
            'invoice' => [
                'id' => $invoice->getSID(),
                'sub_total' => $i18n->getFloat($invoice->getPropertyValue('sub_total')),
                'total' => $i18n->getFloat($invoice->getPropertyValue('total')),
                'tax' => $tax,
                'date' => $invoice->getPropertyValue('date'),
                'hash' => $invoice->getHash(),
                'payment_method' => $invoice->getPropertyValue('payment_method'),
            ],
        ];
        $email = SJB_EmailTemplateEditor::getEmail($user->getUserName(), self::getEmailSid('Recurring Payment Failed'), $data);
        return $email->send();
    }

    /**
     * @param \SJB\Admins\Admin $admin
     * @return array|bool
     */
    public static function sendAdminInvite($admin)
    {
        $data = [
            'inviter' => SJB_Session::getValue('admin'),
            'admin' => [
                'name' => $admin->getPropertyValue('name'),
                'email' => $admin->getPropertyValue('email'),
                'hash' => $admin->getHash(),
            ],
        ];
        return SJB_EmailTemplateEditor::getEmail($admin->getPropertyValue('email'), self::getEmailSid('Admin Invite'), $data)->send();
    }

    public static function getEmailSid($name)
    {
        return SJB_DB::queryValue('select `sid` from `email_templates` where `name` = ?s', $name);
    }

    /**
     * @param array $admin
     * @return array
     */
    public static function sendAdminRecover($admin)
    {
        $data = [
            'admin' => $admin,
        ];
        return SJB_EmailTemplateEditor::getEmail($admin['email'], self::getEmailSid('Admin Recover'), $data)->send();
    }

    /**
     * @param SJB_Listing $listing
     * @param $user_sid
     * @return mixed
     */
    public static function sendUserListingActivatedLetter(SJB_Listing $listing, $user_sid)
    {
        $user = SJB_UserManager::getObjectBySID($user_sid);
        $userGroupSID = $user->getUserGroupSID();
        $emailTplSID = SJB_UserGroupManager::getEmailTemplateSIDByUserGroupAndField($userGroupSID, 'notify_on_listing_activation');

        $user_info = SJB_UserManager::createTemplateStructureForUser($user);
        $listing_info = SJB_ListingManager::createTemplateStructureForListing($listing);
        $data = [
            'listing' => $listing_info,
            'user' => $user_info
        ];
        $email = SJB_EmailTemplateEditor::getEmail($user_info['username'], $emailTplSID, $data);
        return $email->send();
    }

    public static function sendApplyNow($info, $file = '', $data_resume = [], $userData = false)
    {
        $application_email = SJB_Applications::getApplicationEmailbyListingId($info['listing']['id']);
        $email_address = !empty($application_email) ? $application_email : $info['listing']['user']['username'];

        $data = [
            'user' => SJB_Array::getPath($info, 'listing/user'),
            'listing' => $info['listing'],
            'applicant_request' => $info['submitted_data'],
            'data_resume' => $data_resume,
        ];

        $email = SJB_EmailTemplateEditor::getEmail($email_address, self::getEmailSid('Application Email to Employer'), $data);
        $email->setFromName($info['submitted_data']['name'] . ' via ' . SJB_Settings::getValue('site_title'));
        $email->setReplyTo($userData['email']);
        if ($file != '') {
            $email->setFile($file);
        }
        return $email->send();
    }

    /**
     * @param $productInfo
     * @param SJB_Invoice $invoice
     * @return mixed
     */
    public static function sendSubscriptionActivationLetter($productInfo, $invoice)
    {
        $user = SJB_UserManager::getObjectBySID($invoice->getUserSID());
        $user = SJB_UserManager::createTemplateStructureForUser($user);
        $productExtraInfo = SJB_ProductsManager::getProductExtraInfoBySID($productInfo['sid']);
        $productInfo = array_merge($productInfo, $productExtraInfo);
        $fields = SJB_ProductsManager::createTemplateStructureForProductForEmailTpl($productInfo);
        $items = $invoice->getPropertyValue('items');
        if (!empty($items['names'])) {
            $productExtraInfo['caption'] = implode(', ', $items['names']);
        }
        $i18n = SJB_I18N::getInstance();
        $product = array_merge($fields, $productExtraInfo);
        $product['price'] = $i18n->getFloat($product['price']);
        $tax = 0;
        if ($invoice->getPropertyValue('tax_info')) {
            $taxInfo = $invoice->getPropertyValue('tax_info');
            $tax = $i18n->getFloat($taxInfo['tax_amount']);
        }
        $data = [
            'user' => $user,
            'product' => $product,
            'invoice' => [
                'id' => $invoice->getSID(),
                'sub_total' => $i18n->getFloat($invoice->getPropertyValue('sub_total')),
                'total' => $i18n->getFloat($invoice->getPropertyValue('total')),
                'tax' => $tax,
                'date' => $invoice->getPropertyValue('date'),
                'hash' => $invoice->getHash(),
                'payment_method' => $invoice->getPropertyValue('payment_method'),
            ]
        ];

        $email = SJB_EmailTemplateEditor::getEmail($user['username'], self::getEmailSid('Order Confirmation'), $data);
        $result = $email->send();
        SJB_AdminNotifications::sendProductConfirmationLetter($data);
        return $result;
    }

    public static function sendUserWelcomeLetter($user_sid)
    {
        $user = SJB_UserManager::getObjectBySID($user_sid);
        $userGroupSID = $user->getUserGroupSID();
        $emailTplSID = SJB_UserGroupManager::getEmailTemplateSIDByUserGroupAndField($userGroupSID, 'welcome_email');

        $user = SJB_UserManager::createTemplateStructureForUser($user);
        $data = ['user' => $user];
        $email = SJB_EmailTemplateEditor::getEmail($user['username'], $emailTplSID, $data);
        return $email->send();
    }

    /**
     * @param array $listingsSIDs
     * @param array $guestAlertInfo
     * @param int $listingTypeSID
     * @return array|bool|null
     */
    public static function sendGuestAlertNewListingsFoundLetter(array $listingsSIDs, array $guestAlertInfo, $listingTypeSID)
    {
        $emailTplSID = SJB_ListingTypeManager::getListingTypeEmailTemplateForGuestAlert($listingTypeSID);

        $listings = [];
        foreach ($listingsSIDs as $listingSID) {
            $listing = SJB_ListingManager::getObjectBySID($listingSID);
            if ($listing instanceof SJB_Listing) {
                $listing = SJB_ListingManager::createTemplateStructureForListing($listing);
                array_push($listings, $listing);
            }
        }

        $data = [
            'listings' => $listings,
            'key' => $guestAlertInfo['alert_key']
        ];
        $email = SJB_EmailTemplateEditor::getEmail($guestAlertInfo['email'], $emailTplSID, $data);
        $email->setCustomHeader(sprintf('List-Unsubscribe: <%s/guest-alerts/unsubscribe/?key=%s>', SJB_H::getCustomDomainUrl(), rawurlencode($guestAlertInfo['alert_key'])));
        return $email->send();
    }
}
