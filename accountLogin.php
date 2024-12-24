<?php
    require_once 'DBConnection.php';
    if(!empty($_POST["login"]) && !empty($_POST["password"])) {
        $login = mysqli_real_escape_string($connect, $_POST['login']);
        $password = mysqli_real_escape_string($connect, $_POST['password']);

        $result = mysqli_query($connect, "Select * from ChatUsers where Email = '$login' and UserPassword = '$password'");
        mysqli_close($connect);

        if(mysqli_num_rows($result) > 0) {
            session_start();
            $row = mysqli_fetch_assoc($result);
            $_SESSION["email"] = $row["Email"];
            $_SESSION["username"] = $row["UserName"];
            $new_page_url = '/chatPage.php';
            header('Location: ' . $new_page_url);
            exit();
        }
    }