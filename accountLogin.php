<?php
    require_once "DBConnect.php";
    require_once "Login\Account.php";

    use Chat\Login\Account;
    use Chat\DBConnect;

    $dbConnect = DBConnect::getInstance();
    $connect = $dbConnect->getConnection();

    if(!empty($_POST["login"]) && !empty($_POST["password"])) {
        $login = mysqli_real_escape_string($connect, $_POST['login']);
        $password = mysqli_real_escape_string($connect, $_POST['password']);
        mysqli_close($connect);

        $account = new Account($login, $password);

        //$result = mysqli_query($connect, "Select * from ChatUsers where Email = '$login' and UserPassword = '$password'");


        if($account->isExists()) {
            session_start();
            $_SESSION["email"] = $account->getEmail();
            $_SESSION["username"] = $account->getLogin();
            $new_page_url = '/chat/pageHandler/setPageDefaultData.php';
            header('Location: ' . $new_page_url);
            exit();
        }
        else {
            setcookie('loginError', 'Неправильный логин или пароль');
            $new_page_url = 'loginPage.php';
            header('Location: ' . $new_page_url);
            exit();
        }
    }
    else {
        setcookie('loginError', 'Неправильный логин или пароль');
        $new_page_url = 'loginPage.php';
        header('Location: ' . $new_page_url);
        exit();
    }