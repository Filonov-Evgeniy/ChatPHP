<?php

namespace Chat\Models\Login;

require '../../autoload.php';

use Chat\DBConnect;

class Account
{
    protected $username;
    protected $password;
    protected $email;
    protected $dbConnect;
    public function __construct($email, $password) {
        $this->email = $email;
        $this->password = $password;
        $this->dbConnect = DBConnect::getInstance();
    }

    public function isExists(): bool {
        $filter = [
            "Email = ". "'".$this->email."'",
            "UserPassword = ". "'".$this->password."'",
        ];
        $result = $this->dbConnect->getFilteredList("ChatUsers", $filter, ' and ');
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $this->username = $row['UserName'];
            return true;
        }
        return false;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getUsername() {
        return $this->username;
    }
}