<?php

namespace Chat\Login;

require_once '../DBConnect.php';

use Chat\DBConnect;

class Account
{
    protected $username;
    protected $password;
    protected $email;
    public function __construct($email, $password) {
        $this->email = $email;
        $this->password = $password;
    }

    public function isExists() {
        $connect = DBConnect::getConnection();
        $result = mysqli_query($connect, "Select * from ChatUsers where Email = '$this->email' and UserPassword = '$this->password'");
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $this->username = $row['UserName'];
            $connect->close();
            return true;
        }
        $connect->close();
        return false;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getUsername() {
        return $this->username;
    }
}