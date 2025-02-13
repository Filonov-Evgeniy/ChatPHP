<?php
namespace Chat;

require 'autoload.php';

use Chat\ChatPageHandler\ChatPageHandler;
use Chat\Models\Login\Account;

class UserAuthorization
{
    public function login()
    {
        if (!empty($_POST["login"]) && !empty($_POST["password"])) {
            $dbConnect = DBConnect::getInstance();
            $connect = $dbConnect->getConnection();

            $login = mysqli_real_escape_string($connect, $_POST['login']);
            $password = mysqli_real_escape_string($connect, $_POST['password']);

            $connect->close();

            $account = new Account($login, $password);

            if ($account->isExists()) {
                session_start();
                $_SESSION["email"] = $account->getEmail();
                $_SESSION["username"] = $account->getUsername();
                $pageHandler = new ChatPageHandler();
                $pageHandler->setPageDefaultData();
                exit();
            } else {
                setcookie('loginError', 'Неправильный логин или пароль', ['path' => '/chat/View']);
                $new_page_url = '../View/index.php';
                header('Location: ' . $new_page_url);
                exit();
            }
        } else {
            setcookie('loginError', 'Неправильный логин или пароль', ['path' => '/chat/View']);
            $new_page_url = '../View/index.php';
            header('Location: ' . $new_page_url);
            exit();
        }
    }
}