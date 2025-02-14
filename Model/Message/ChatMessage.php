<?php

namespace Chat\Model\Message;

require $_SERVER['DOCUMENT_ROOT'].'/chat/autoload.php';

use Chat\DBConnect;
use Chat\src\Chat\ChatMessageInterface;

class ChatMessage implements ChatMessageInterface
{
    protected $username;
    protected $email;
    protected $messageText;
    protected $date;
    protected $chatBrowser;
    protected $chatUserIp;
    protected $supplement;
    protected $dbConnect;
    private $table = "ChatMessages";

    public function __construct() {
        $this->dbConnect = DBConnect::getInstance();
    }

    public function create(bool $withSupplement) {
        $this->dbConnect->filteredCreate($this->table, $this->getColumns($withSupplement), $this->setValuesForQuery($withSupplement));
    }

    public function getList(): array
    {
        return $this->dbConnect->getOrderedList($this->table, $_SESSION['sortColumn'], $_SESSION['sortOrder']);
    }

    private function getColumns(bool $withSupplement): array {
        $columns = [
            "Username",
            "Email",
            "Message",
            "Input_Date",
            "chat_browser",
            "chat_user_ip",
        ];
        if(!$withSupplement) {
            return $columns;
        }
        $columns[] = "Supplement";
        return $columns;
    }

    private function setValuesForQuery(bool $withSupplement): array {
        $values = [
            "'".$this->getUsername()."'",
            "'".$this->getEmail()."'",
            "'".$this->getMessageText()."'",
            "'".$this->getDate()."'",
            "'".$this->getChatBrowser()."'",
            "'".$this->getChatUserIp()."'",
        ];
        if($withSupplement) {
            $values[] = $this->getSupplement();
            return $values;
        }
        return $values;
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

    public function getSupplement()
    {
        return $this->supplement;
    }

    public function setSupplement($supplement)
    {
        $this->supplement = $supplement;
    }

}