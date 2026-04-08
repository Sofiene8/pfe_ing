<?php

class SJB_LogoType extends SJB_UploadFileType
{
    protected $default_template = 'logo.tpl';

    function getPropertyVariablesToAssign()
    {
        $propertyVariables = parent::getPropertyVariablesToAssign();
        $upload_manager = new SJB_UploadPictureManager();
        $upload_manager->setFileGroup("pictures");
        $newPropertyVariables = [
            'value' => [
                'file_url' => $upload_manager->getUploadedFileLink($this->property_info['value']),
                'file_name' => $upload_manager->getUploadedFileName($this->property_info['value']),
            ],
        ];
        return array_merge($propertyVariables, $newPropertyVariables);
    }

    function getValue()
    {
        $upload_manager = new SJB_UploadPictureManager();
        $upload_manager->setFileGroup("pictures");
        $fileInfo = SJB_UploadFileManager::getUploadedFileInfo($this->property_info['value']);
        $thumbFileInfo = SJB_UploadFileManager::getUploadedFileInfo($this->property_info['value'] . "_thumb");

        return [
            'file_url' => $upload_manager->getUploadedFileLink($this->property_info['value'], $fileInfo),
            'file_name' => empty($fileInfo['file_name']) ? null : $fileInfo['file_name'],
            'thumb_file_url' => $upload_manager->getUploadedFileLink($this->property_info['value'] . "_thumb", $thumbFileInfo),
            'thumb_file_name' => empty($thumbFileInfo['file_name']) ? null : $thumbFileInfo['file_name'],
        ];
    }

    function isValid()
    {
        if (strpos($this->property_info['value'], 'http') === 0) {
            return @getimagesize($this->property_info['value']) !== false;
        }
        $file_id = $this->property_info['id'] . "_" . $this->object_sid;
        $this->property_info['value'] = $file_id;
        $upload_manager = new SJB_UploadPictureManager();
        if ($upload_manager->isValidUploadedPictureFile($this->property_info['id'])) {
            return true;
        }

        return $upload_manager->getError();
    }

    function getSQLValue()
    {
        if (!empty($this->property_info['value'])) {
            if (strpos($this->property_info['value'], 'http') === 0) {
                $imageInfo = getimagesize($this->property_info['value']);
                if (!$imageInfo) {
                    return '';
                }
                $_FILES[$this->property_info['id']] = [
                    'type' => 'application/octet-stream',
                    'tmp_name' => $this->property_info['value'],
                    'name' => md5(microtime(true)) . image_type_to_extension($imageInfo[2], true),
                ];
            }

            $fileId = $this->property_info['id'] . '_' . $this->object_sid;
            $this->property_info['value'] = $fileId;
            $uploadManager = new SJB_UploadPictureManager();
            $uploadManager->setUploadedFileID($fileId);
            $uploadManager->setHeight($this->property_info['height']);
            $uploadManager->setWidth($this->property_info['width']);
            $uploadManager->uploadPicture($this->property_info['id'], $this->property_info);
            if (SJB_UploadPictureManager::doesFileExistByID($fileId)) {
                return $fileId;
            }
        }
        return '';
    }

    public static function getFieldExtraDetails()
    {
        return [
            [
                'id' => 'width',
                'caption' => 'Width',
                'type' => 'integer',
                'minimum' => '1',
                'value' => 100,
                'is_required' => false,
                'is_system' => true
            ],
            [
                'id' => 'height',
                'caption' => 'Height',
                'type' => 'integer',
                'minimum' => '1',
                'value' => '100',
                'is_required' => false,
                'is_system' => true
            ],
            [
                'id' => 'second_width',
                'caption' => 'Width',
                'type' => 'integer',
                'minimum' => '1',
                'value' => 100,
                'is_required' => false,
                'is_system' => true
            ],
            [
                'id' => 'second_height',
                'caption' => 'Height',
                'type' => 'integer',
                'minimum' => '1',
                'value' => '100',
                'is_required' => false,
                'is_system' => true
            ],
        ];
    }
}
