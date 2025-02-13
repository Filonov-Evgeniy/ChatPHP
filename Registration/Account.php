<?php
namespace Chat\Registration;

require '../autoload.php';

use Chat\DBConnect;

class Account
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
    public function registrateAccount() {
        $values = [
            "'".$this->email."'",
            "'".$this->userName."'",
            "'".$this->password."'",
        ];
        $this->dbConnect->create($this->table, $values);
    }
    public function isUniqueAccount(): bool {
        $filter = [
            "Email = ". "'".$this->email."'",
            "UserName = ". "'".$this->userName."'",
        ];
        $result = $this->dbConnect->getFilteredList("ChatUsers", $filter, ' or ');
        if (mysqli_num_rows($result) > 0) {
            return false;
        }

        return true;
    }

//    public function getList($filter){
//
//        $result = mysqli_query($connect, "Select * from ChatUsers where Email = '$this->email' or UserName = '$this->userName'");
//
//    }
}