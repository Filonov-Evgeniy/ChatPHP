<?php
namespace Chat\Registration;

require '../autoload.php';
//    require_once '../DBConnect.php';

use Chat\DBConnect;

class Account
{
    protected $userName;
    protected $email;
    protected $password;

    public function __construct($userName, $email, $password)
    {
        $this->userName = $userName;
        $this->email = $email;
        $this->password = $password;
    }
    public function registrateAccount() {
        $connect = DBConnect::getConnection();
        $result = mysqli_query($connect,"insert into ChatUsers values('$this->email', '$this->userName', '$this->password')");
        mysqli_close($connect);
    }
    public function isUniqueAccount(): bool {
        $connect = DBConnect::getConnection();
        $result = mysqli_query($connect, "Select * from ChatUsers where Email = '$this->email' or UserName = '$this->userName'");
        mysqli_close($connect);
        if (mysqli_num_rows($result) > 0) {
            return false;
        }

        return true;
    }

    public function getList($filter){

        $result = mysqli_query($connect, "Select * from ChatUsers where Email = '$this->email' or UserName = '$this->userName'");

    }
}