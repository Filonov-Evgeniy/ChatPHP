<?php
namespace Chat\src\User;

require $_SERVER['DOCUMENT_ROOT'].'/chat/autoload.php';

use Chat\src\User\ChatUsers;
use Chat\src\PageHandler\ChatPageHandler\ChatPageHandlerCLass;
use Chat\DBConnect;
class User
{
    public function login()
    {
        if (!empty($_POST["login"]) && !empty($_POST["password"])) {
            $dbConnect = DBConnect::getInstance();
            $connect = $dbConnect->getConnection();

            $email = mysqli_real_escape_string($connect, $_POST['login']);
            $password = mysqli_real_escape_string($connect, $_POST['password']);

            $connect->close();

            $account = new ChatUsers(null, $email, $password);

            if ($account->isExists()) {
                session_start();
                $_SESSION["email"] = $account->getEmail();
                $_SESSION["username"] = $account->getUsername();
                $pageHandler = new ChatPageHandlerClass();
                $pageHandler->setPageDefaultData();
                exit();
            } else {
                setcookie('loginError', 'Неправильный логин или пароль', ['path' => '/chat/View']);
                $new_page_url = '/chat/View/index.php';
                header('Location: ' . $new_page_url);
                exit();
            }
        } else {
            setcookie('loginError', 'Неправильный логин или пароль', ['path' => '/chat/View']);
            $new_page_url = '/chat/View/index.php';
            header('Location: ' . $new_page_url);
            exit();
        }
    }

    public function exit()
    {
        session_destroy();
        $new_page_url = '/chat/View/index.php';
        header('Location: ' . $new_page_url);
    }

    public function createAccount()
    {
        if (!empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["userName"])) {
            $connect = DBConnect::getInstance()->getConnection();
            $email = mysqli_real_escape_string($connect, $_POST["email"]);
            $password = mysqli_real_escape_string($connect, $_POST["password"]);
            $userName = mysqli_real_escape_string($connect, $_POST["userName"]);

            $account = new ChatUsers($userName, $email, $password);

            if (!$account->isUniqueAccount()) {
                setcookie('registrationError', 'Аккаунт с такой почтой или именем пользователя уже существует', ['path' => '/chat/View']);
                $new_page_url = '/chat/View/registrationPage.php';
                header('Location: ' . $new_page_url);
                exit();
            } else {
                $account->create();
                $new_page_url = '/chat/View/index.php';
                header('Location: ' . $new_page_url);
                exit();
            }
        } else {
            setcookie('registrationError', 'Ошибка ввода данных', ['path' => '/chat/View']);
            $new_page_url = '/chat/View/registrationPage.php';
            header('Location: ' . $new_page_url);
            exit();
        }
    }
}