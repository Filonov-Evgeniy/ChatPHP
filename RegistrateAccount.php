<?php
namespace Chat;

require 'autoload.php';

use Chat\DBConnect;
use Chat\Registration\Account;

class RegistrateAccount
{
    public function createAccount()
    {
        if (!empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["userName"])) {
            $connect = DBConnect::getInstance()->getConnection();
            $email = mysqli_real_escape_string($connect, $_POST["email"]);
            $password = mysqli_real_escape_string($connect, $_POST["password"]);
            $userName = mysqli_real_escape_string($connect, $_POST["userName"]);

            $account = new Account($userName, $email, $password);

            if (!$account->isUniqueAccount()) {
                setcookie('registrationError', 'Аккаунт с такой почтой или именем пользователя уже существует', ['path' => '/chat/Views']);
                $new_page_url = '../Views/registrationPage.php';
                header('Location: ' . $new_page_url);
                exit();
            } else {
                $account->registrateAccount();
                $new_page_url = '../Views/loginPage.php';
                header('Location: ' . $new_page_url);
                exit();
            }
        } else {
            setcookie('registrationError', 'Ошибка ввода данных', ['path' => '/chat/Views']);
            $new_page_url = '../Views/registrationPage.php';
            header('Location: ' . $new_page_url);
            exit();
        }
    }
}
