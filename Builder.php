<?php
    interface Builder {
        public function build();
        public function setContent($text, $supplement = null);
        public function setMaxImgSize($maxImgWidth, $maxImgHeight);
        public function setSupportedImgTypes($supportedImgTypes);
        public function setSupportedTextTypes($supportedTextTypes);
        public function setUploadDirectory($uploadDirectory = 'uploads/');
        public function setMaxTextFileSize($maxTextFileSize);
    }