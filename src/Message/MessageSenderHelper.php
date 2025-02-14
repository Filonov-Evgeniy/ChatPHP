<?php
namespace Chat\src\Message;
class MessageSenderHelper {
    public function checkTxtFileSize($fileSize, $maxFileSize) {
        if ($fileSize <= $maxFileSize) {
            return true;
        }
        return false;
    }

    public function checkImgSize($imgResolution, $maxImgWidth, $maxImgHeight) {
        if($imgResolution[0] <= $maxImgWidth && $imgResolution[1] <= $maxImgHeight) {
            return true;
        }
        return false;
    }
    public function isSupportedImgFileType(array $supportedImgTypes) {
        $fileType = $_FILES['supplement']['type'];
        if(in_array($fileType, $supportedImgTypes))
        {
            return true;
        }
        return false;
    }

    public function isSupportedTxtType(array $supportedTxtTypes) {
        $fileType = $_FILES['supplement']['type'];
        if(in_array($fileType, $supportedTxtTypes)) {
            return true;
        }
        return false;
    }
}