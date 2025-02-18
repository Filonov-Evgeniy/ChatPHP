<?php
require $_SERVER['DOCUMENT_ROOT'].'/chat/prolog.php';

use Chat\src\Cookie\Cookie;

Cookie::setCookie();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вход</title>
    <link rel="stylesheet" href="/chat/styles.css">
</head>
<body>
    <form method="POST" action="/chat/src/Controller/AuthorizationPageController/user_authorization_controller.php" class="form-group">
        <input type="text" name="login" placeholder="Email"><br>
        <input type="text" name="password" placeholder="Пароль"><br>
        <button type="submit">Вход</button><br>
        <a href="registrationPage.php"><span>Регистрация</span></a>
        <p class="error"><?php echo $_COOKIE['loginError'] ?></p>
    </form>
</body>
</html>