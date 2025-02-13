<?php

namespace Chat\Model;

use Chat\DBConnect;

class ChatMessages
{
    protected $username;
    protected $email;
    protected $messageText;
    protected $date;
    protected $chatBrowser;
    protected $chatUserIp;
    protected $dbConnect;
    private $table = "ChatMessages";

//    public function __construct($username, $email, $messageText, $date, $chatBrowser, $chatUserIp) {
//        $this->username = $username;
//        $this->email = $email;
//        $this->messageText = $messageText;
//        $this->date = $date;
//        $this->chatBrowser = $chatBrowser;
//        $this->chatUserIp = $chatUserIp;
//    }

    public function __construct() {
        $dbConnect = DBConnect::getInstance();
    }

    public function sendMessage($columns, $values) {
        $this->dbConnect->filteredCreate($this->table, $columns, $values);
    }

    //TODO удалить булевские методы после перепривязки, они уже перенесены в Helper
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

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getMessageText()
    {
        return $this->messageText;
    }

    public function setMessageText($messageText)
    {
        $this->messageText = $messageText;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function getChatBrowser()
    {
        return $this->chatBrowser;
    }

    public function setChatBrowser($chatBrowser)
    {
        $this->chatBrowser = $chatBrowser;
    }

    public function getChatUserIp()
    {
        return $this->chatUserIp;
    }

    public function setChatUserIp($chatUserIp)
    {
        $this->chatUserIp = $chatUserIp;
    }

}