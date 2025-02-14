<?php
namespace Chat\Model\User;

require $_SERVER['DOCUMENT_ROOT'].'/chat/autoload.php';

use Chat\DBConnect;

class ChatUsers
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

    public function registrateAccount()
    {
        $values = [
            "'" . $this->email . "'",
            "'" . $this->userName . "'",
            "'" . $this->password . "'",
        ];
        $this->dbConnect->create($this->table, $values);
    }

    public function isUniqueAccount(): bool
    {
        $filter = [
            "Email = " . "'" . $this->email . "'",
            "UserName = " . "'" . $this->userName . "'",
        ];
        $result = $this->dbConnect->getFilteredList("ChatUsers", $filter, ' or ');
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
        $result = $this->dbConnect->getFilteredList("ChatUsers", $filter, ' and ');
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $this->userName = $row['UserName'];
            return true;
        }
        return false;
    }
}