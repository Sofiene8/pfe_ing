<?php

class SJB_UploadFileType extends SJB_Type
{
    protected $default_template = 'file.tpl';

    function isEmpty()
    {
        return parent::isEmpty() && !SJB_UploadFileManager::isFileReadyForUpload($this->property_info['id']);
    }

    function getPropertyVariablesToAssign()
    {
        $upload_manager = new SJB_UploadFileManager();
        $upload_manager->setFileGroup('files');

        return [
            'id' => $this->property_info['id'],
            'value' => [
                'file_url' => $upload_manager->getUploadedFileLink($this->property_info['value']),
                'file_name' => $upload_manager->getUploadedFileName($this->property_info['value']),
                'saved_file_name' => $upload_manager->getUploadedSavedFileName($this->property_info['value']),
                'file_id' => $this->property_info['value'],
            ],
        ];
    }

    function getValue()
    {
        $upload_manager = new SJB_UploadFileManager();
        if (is_array($this->property_info['value'])) {
            $value = [];
            foreach ($this->property_info['value'] as $key => $fileId) {
                $file_info = SJB_UploadFileManager::getUploadedFileInfo($fileId);
                $value[$key] = [
                    'file_url' => $upload_manager->getUploadedFileLink($fileId, $file_info),
                    'file_name' => $file_info['file_name'],
                    'saved_file_name' => $file_info['saved_file_name'],
                    'file_id' => $fileId,
                ];
            }
            return $value;
        }
        $file_info = SJB_UploadFileManager::getUploadedFileInfo($this->property_info['value']);
        return [
            'file_url' => $upload_manager->getUploadedFileLink($this->property_info['value'], $file_info),
            'file_name' => empty($file_info['file_name']) ? null : $file_info['file_name'],
            'saved_file_name' => empty($file_info['saved_file_name']) ? null : $file_info['saved_file_name'],
            'file_id' => $this->property_info['value'],
        ];
    }

    function isValid()
    {
        $this->fieldID = $this->property_info['id'];
        if (!isset($_FILES[$this->fieldID]['name']) || $_FILES[$this->fieldID]['name'] == '')
            return true;

        $upload_manager = new SJB_UploadFileManager();

        if ($upload_manager->isValidUploadedFile($this->property_info['id'])) {
            return true;
        }

        return $upload_manager->getError();
    }

    function getSQLValue()
    {
        if (is_array($this->property_info['value']) && !empty($this->property_info['value']['import'])) {
            return $this->property_info['value']['import'];
        }
        $fileId = $this->property_info['id'] . "_" . $this->object_sid;
        $this->property_info['value'] = $fileId;
        $uploadManager = new SJB_UploadFileManager();
        $uploadManager->setFileGroup('files');
        $uploadManager->setUploadedFileID($fileId);
        $uploadManager->uploadFile($this->property_info['id']);
        if (SJB_UploadFileManager::doesFileExistByID($fileId)) {
            return $fileId;
        }
        return '';
    }
}
