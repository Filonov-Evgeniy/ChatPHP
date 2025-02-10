<?php
    namespace Chat;
    class Message {
        protected $text;
        protected $supplement;
        protected $maxImgWidth;
        protected $maxImgHeight;
        protected $supportedImgTypes = [];
        protected $supportedTxtType = [];
        protected $uploadDirectory;
        protected $maxTxtFileSize;

        public function getText()
        {
            return $this->text;
        }

        public function setText($text)
        {
            $this->text = $text;
        }

        public function getSupplement()
        {
            return $this->supplement;
        }

        public function setSupplement($supplement)
        {
            $this->supplement = $supplement;
        }

        public function getMaxImgWidth()
        {
            return $this->maxImgWidth;
        }

        public function setMaxImgWidth($maxImgWidth)
        {
            $this->maxImgWidth = $maxImgWidth;
        }

        public function getMaxImgHeight()
        {
            return $this->maxImgHeight;
        }

        public function setMaxImgHeight($maxImgHeight)
        {
            $this->maxImgHeight = $maxImgHeight;
        }

        public function getSupportedImgTypes()
        {
            return $this->supportedImgTypes;
        }

        public function setSupportedImgTypes($supportedImgTypes)
        {
            $this->supportedImgTypes = $supportedImgTypes;
        }

        public function getSupportedTxtType()
        {
            return $this->supportedTxtType;
        }

        public function setSupportedTxtType($supportedTxtType)
        {
            $this->supportedTxtType = $supportedTxtType;
        }

        public function getUploadDirectory()
        {
            return $this->uploadDirectory;
        }

        public function setUploadDirectory($uploadDirectory)
        {
            $this->uploadDirectory = $uploadDirectory;
        }

        public function getMaxTxtFileSize()
        {
            return $this->maxTxtFileSize;
        }

        public function setMaxTxtFileSize($maxTxtFileSize)
        {
            $this->maxTxtFileSize = $maxTxtFileSize;
        }

    }