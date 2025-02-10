<?php
    namespace Chat\Builder;

    use Builder;
    use Chat\Message;
    class MessageBuilder implements Builder
    {
        protected $message;
        public function __construct()
        {
            $this->message = new Message();
        }
        public function build(): Message {
            return $this->message;
        }
        public function setContent($text, $supplement = null) {
            $this->message->setText($text);
            $this->message->setSupplement($supplement);
        }
        public function setMaxImgSize($maxImgWidth, $maxImgHeight) {
            $this->message->setMaxImgWidth($maxImgWidth);
            $this->message->setMaxImgHeight($maxImgHeight);
        }
        public function setSupportedImgTypes($supportedImgTypes) {
            $this->message->setSupportedImgTypes($supportedImgTypes);
        }
        public function setSupportedTextTypes($supportedTextTypes){

        }
        public function setUploadDirectory($uploadDirectory = 'uploads/'){
            $this->message->setUploadDirectory($uploadDirectory);
        }
        public function setMaxTextFileSize($maxTextFileSize){
            $this->message->setMaxTxtFileSize($maxTextFileSize);
        }
    }