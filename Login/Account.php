<?php
namespace Chat\Login;

require_once 'DBConnection.php';
require_once 'DBConnect.php';

use Chat\DBConnect;
use Chat;

class Account {
    protected $login;
    protected $password;
    protected $email;
    protected $dbConnect;
    public function __construct($login, $password) {
        $this->login = $login;
        $this->password = $password;
        $this->dbConnect = DBConnect::getInstance();
    }

    public function isExists() {
        $connect = $this->dbConnect->getConnection();
        $result = mysqli_query($connect, "Select * from ChatUsers where Email = '$this->login' and UserPassword = '$this->password'");
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $this->email = $row['Email'];
            $connect->close();
            return true;
        }
        $connect->close();
        return false;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getLogin() {
        return $this->login;
    }
}