<?php
require_once "fillTableTest.php"; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Чат</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <aside>
        <p>Имя:</p>
        <p><?= $_SESSION["username"] ?></p>
        <p>Email:</p>
        <p><?= $_SESSION["email"] ?></p>
        <form action="exitAccount.php">
        <button type="submit">Выйти</button>
        </form>
    </aside>
    <form method="POST" action="fillTableTest.php" class="container">
        <table>
            <thead>
                <tr>
                    <th>Пользователь</th>
                    <th>E-mail</th>
                    <th>Сообщение</th>
                    <th>Дата публикации</th>
                    <th>Вложенные</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                foreach ($page as $row) {
                echo "<tr>";
                    echo "<td>".htmlspecialchars($row["Username"])."</td>";
                    echo "<td>".htmlspecialchars($row["Email"])."</td>";
                    echo "<td>".htmlspecialchars($row["Message"])."</td>";
                    echo "<td>".htmlspecialchars($row["Input_Date"])."</td>";
                    echo "<td><a href='".$row["Supplement"]."' target='_blank'>".$row['Supplement']."</a></td>";
                echo "<tr>";
                } 
                ?>
            </tbody>
        </table>
        <button type="submit" name="next">Следующая</button>
        <button type="submit" name="back">Предыдущая</button>
        <select name="sort">
            <option value="date-asc">Дата|По возрастанию</option>
            <option value="date-desc">Дата|По убыванию</option>
            <option value="username-asc">Пользователь|По возрастанию</option>
            <option value="username-desc">Пользователь|По убыванию</option>
            <option value="email-asc">Email|По возрастанию</option>
            <option value="email-desc">Email|По убыванию</option>
        </select>
        <button type="submit" name="sortButton">Сортировать</button>
    </form>

    <form class="chat-input" method="POST" action="sendMessage.php" enctype="multipart/form-data">
        <input type="file" name="supplement" accept="image/jpeg, image/gif, image/png, text/plain">
        <textarea name="message_box" placeholder="Сообщение"></textarea>
        <button type="submit">Отправить</button>
    </form>
</body>
</html>