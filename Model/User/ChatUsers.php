<?php
namespace Chat\Model\User;

require $_SERVER['DOCUMENT_ROOT'].'/chat/autoload.php';

use Chat\DBConnect;
use Chat\src\Chat\ChatUserInterface;

class ChatUsers implements ChatUserInterface
{
    protected $userName;
    protected $email;
    protected $password;

    protected $dbConnect;
    protected $table;

    public function __construct($userName, $email, $password)
    {
        $this->userName = $userName;
        $this->email = $email;
        $this->password = $password;
        $this->dbConnect = DBConnect::getInstance();
        $this->table = "ChatUsers";
    }

    public function create()
    {
        $values = [
            "'" . $this->email . "'",
            "'" . $this->userName . "'",
            "'" . $this->password . "'",
        ];
        $this->dbConnect->create($this->table, $values);
    }

    public function getList($filter, $separator)
    {
        return $this->dbConnect->getFilteredList($this->table, $filter, $separator);
    }

    public function isUniqueAccount(): bool
    {
        $filter = [
            "Email = " . "'" . $this->email . "'",
            "UserName = " . "'" . $this->userName . "'",
        ];
        $separator = ' or ';
        $result = $this->getList($filter, $separator);
        if (mysqli_num_rows($result) > 0) {
            return false;
        }

        return true;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getUsername()
    {
        return $this->userName;
    }

    public function isExists(): bool
    {
        $filter = [
            "Email = " . "'" . $this->email . "'",
            "UserPassword = " . "'" . $this->password . "'",
        ];
        $separator = ' and ';
        $result = $this->getList($filter, $separator);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $this->userName = $row['UserName'];
            return true;
        }
        return false;
    }
}