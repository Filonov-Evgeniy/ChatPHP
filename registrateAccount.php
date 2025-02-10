<?php
    require_once 'DBConnect.php';
    require_once 'Registration/Account.php';

    use Chat\DBConnect;
    use Chat\Registration\Account;

    if (!empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["userName"])) {
        $connect = DBConnect::getConnection();
        $email = mysqli_real_escape_string($connect, $_POST["email"]);
        $password = mysqli_real_escape_string($connect, $_POST["password"]);
        $userName = mysqli_real_escape_string($connect, $_POST["userName"]);

        $account = new Account($userName, $email, $password);

        if (!$account->isUniqueAccount()) {
            setcookie('registrationError', 'Аккаунт с такой почтой или именем пользователя уже существует');
            $new_page_url = 'http://localhost/chat/registrationPage.php';
            header('Location: ' . $new_page_url);
            exit();
        }
        else {
            $account->registrateAccount();
            $new_page_url = 'http://localhost/chat/loginPage.php';
            header('Location: ' . $new_page_url);
            exit();
        }
    }
    else {
        setcookie('registrationError', 'Ошибка ввода данных');
        $new_page_url = 'http://localhost/chat/registrationPage.php';
        header('Location: ' . $new_page_url);
        exit();
    }
