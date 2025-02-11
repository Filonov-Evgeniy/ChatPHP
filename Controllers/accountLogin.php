<?php
    namespace Chat\Controllers;

    require_once '../DBConnect.php';
    require_once '../Login/Account.php';
    require_once 'pageHandler.php';

    use Chat\DBConnect;
    use Chat\Login\Account;
    use Chat\Controllers\PageHandler;


    if(!empty($_POST["login"]) && !empty($_POST["password"])) {

        $connect = DBConnect::getConnection();

        $login = mysqli_real_escape_string($connect, $_POST['login']);
        $password = mysqli_real_escape_string($connect, $_POST['password']);

        $account  = new Account($login, $password);

        if($account->isExists()) {
            session_start();
            $_SESSION["email"] = $account->getEmail();
            $_SESSION["username"] = $account->getUsername();
            $pageHandler = new PageHandler();
            $pageHandler->setPageDefaultData();
            exit();
        }
        else {
            setcookie('loginError', 'Неправильный логин или пароль');
            $new_page_url = 'Views/loginPage.php';
            header('Location: ' . $new_page_url);
            exit();
        }
    }
    else {
        setcookie('loginError', 'Неправильный логин или пароль');
        $new_page_url = 'Views/loginPage.php';
        header('Location: ' . $new_page_url);
        exit();
    }