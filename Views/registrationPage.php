<?php
    require_once '../Controllers/setCookie.php';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <form method="POST" action="../Controllers/registrateAccount.php">
        <div class="form-group">
            <input type="text" name="email" placeholder="E-mail"><br>
            <input type="text" name="userName" placeholder="Имя пользователя"><br>
            <input type="text" name="password" placeholder="Пароль"><br>
            <button type="submit">Зарегестрироваться</button>
            <p class="error"><?php echo $_COOKIE['registrationError'] ?></p>
        </div>
    </form>
</body>
</html>