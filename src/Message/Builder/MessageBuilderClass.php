<?php

namespace Chat\src\Message\Builder;

require '/chat/autoload.php';

use Chat\src\Message\Builder;
use Chat\Model\ChatMessages;

class MessageBuilderClass implements MessageBuilder
{
    protected $message;
    public function __construct() {
        $this->message = new ChatMessages();
    }
    public function build() {
        return $this->message;
    }
    public function setUsername($username) {
        $this->message->setUsername($username);
    }
    public function setEmail($email) {
        $this->message->setEmail($email);
    }
    public function setMessageText($messageText) {
        $this->message->setMessageText($messageText);
    }
    public function setDate($date) {
        $this->message->setDate($date);
    }
    public function setChatBrowser($chatBrowser) {
        $this->message->setChatBrowser($chatBrowser);
    }
    public function setUserIp($userIp) {
        $this->message->setChatUserIp($userIp);
    }
    public function setSupplement($supplement) {
        $this->message->setSupplement($supplement);
    }
}