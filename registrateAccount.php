<?php
    require_once 'DBConnection.php';
    if (!empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["userName"])) {
        $email = mysqli_real_escape_string($connect, $_POST["email"]);
        $password = mysqli_real_escape_string($connect, $_POST["password"]);
        $userName = mysqli_real_escape_string($connect, $_POST["userName"]);

        $result = mysqli_query($connect, "Select * from ChatUsers where Email = '$email' or UserName = '$userName'");
        if (mysqli_num_rows($result) > 0) {
            setcookie('registrationError', 'Аккаунт с такой почтой или именем пользователя уже существует');
            mysqli_close($connect);
            $new_page_url = 'http://localhost/chat/registrationPage.php';
            header('Location: ' . $new_page_url);
            exit();
        }
        else {
            $result = mysqli_query($connect,"insert into ChatUsers values('$email', '$userName', '$password')");
            mysqli_close($connect);
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
