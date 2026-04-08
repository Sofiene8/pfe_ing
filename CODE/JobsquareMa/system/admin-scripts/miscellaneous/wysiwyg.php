<?php

class SJB_Admin_Miscellaneous_Wysiwyg extends SJB_Function
{
	public function execute()
	{
        header('Content-Type: application/json');

        $fm = new SJB_UploadPictureManager();
        if (!empty($_FILES['file']) && SJB_UploadFileManager::getErrorId('file') === false && $fm->isValidUploadedPictureFile('file')) {
            move_uploaded_file($_FILES['file']['tmp_name'], SJB_BASE_DIR . 'files/userfiles/' . $_FILES['file']['name']);
            echo json_encode([
                'file' => SJB_H::getUserSiteUrl() . '/files/userfiles/' . rawurlencode($_FILES['file']['name'])
            ]);
        } else {
            // fixme: analysing upload errors
            $message = SJB_UploadFileManager::getErrorId('file') ?: 'Failed to upload file';
            $dump = SJB_BASE_DIR . 'system/cache/' . time();
            @copy($_FILES['file']['tmp_name'], $dump);
            $message .= "\n" . $dump;
            $message .= "\n" . print_r($_FILES, true);
            SJB_Error::getInstance()->addWarning($message);

            SJB_Error::getInstance()->addError(sprintf('failed to validate image isValidUploadedPictureFile %s', print_r($_FILES, true) . "\n" . SJB_BASE_DIR . 'system/cache/' . time()));
            echo json_encode([
                'error' => 'Oops... Something went wrong. Please try again!'
            ]);
        }
        exit();
	}
}
