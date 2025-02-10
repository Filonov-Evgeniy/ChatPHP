<?php
    namespace Chat\Registration;

    require_once 'DBConnection.php';
    require_once 'DBConnect.php';

    use Chat;
    use Chat\DBConnect;

    class Account {
        protected $userName;
        protected $email;
        protected $password;
        protected $dbConnect;

        public function __construct($userName, $email, $password)
        {
            $this->userName = $userName;
            $this->email = $email;
            $this->password = $password;
            $this->dbConnect = DBConnect::getInstance();
        }
        public function registrateAccount() {
            $connect = $this->dbConnect->getConnection();
            $result = mysqli_query($connect,"insert into ChatUsers values('$this->email', '$this->userName', '$this->password')");
            mysqli_close($connect);
        }
        public function isUniqueAccount(): bool {
            $connect = $this->dbConnect->getConnection();
            $result = mysqli_query($connect, "Select * from ChatUsers where Email = '$this->email' or UserName = '$this->userName'");
            mysqli_close($connect);
            if (mysqli_num_rows($result) > 0) {
                return false;
            }
            
            return true;
        }
    }