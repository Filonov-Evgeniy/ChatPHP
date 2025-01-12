<?php
    session_start();
    $maxImgHeight = 240;
    $maxImgWidth = 320;
    $supportedImgTypes = ['image/jpeg', 'image/gif', 'image/png'];
    $supportedTxtType = 'text/plain';
    $uploadDirectory = 'uploads/';
    $maxTxtFileSize = 100 * 1024;

    if (isset($_POST['supplement']) || isset($_POST["message_box"])) {
        setcookie('errorChat', ' ');
        require_once 'DBConnection.php';
        $message = mysqli_real_escape_string($connect,$_POST["message_box"]);
        $date = date('Y-m-d H:i:s');
        $login = mysqli_real_escape_string($connect,$_SESSION["username"]);
        $email = mysqli_real_escape_string($connect,$_SESSION["email"]);
        $chat_browser = $_SERVER['HTTP_USER_AGENT'];
        $chatUserIp = $_SERVER['REMOTE_ADDR'];

        if (isset($_FILES['supplement']) && $_FILES['supplement']['error'] === UPLOAD_ERR_OK) {
            $tempFile = $_FILES['supplement']['tmp_name'];
            $fileName = $_FILES['supplement']['name'];
            $fileType = $_FILES['supplement']['type'];
            $fileSize = $_FILES['supplement']['size'];
            $targetFile = $uploadDirectory . $fileName;
            if (in_array($fileType, $supportedImgTypes)) {
                $imgResolution = getimagesize($tempFile);
                if ($imgResolution[0] <= $maxImgWidth && $imgResolution[1] <= $maxImgHeight) {
                    move_uploaded_file($tempFile, $targetFile);
                    $result = mysqli_query($connect,"insert into ChatMessages(Username, Email, Message, Input_Date, chat_browser, chat_user_ip, Supplement) values('$login', '$email', '$message', '$date', '$chat_browser', '$chatUserIp', '$targetFile')");
                }
                else {
                    setcookie('errorChat', 'Размер файла не соответствует заданным требованиям (не более 240x320px)');
                    $new_page_url = 'http://localhost/chatPage.php';
                    header('Location: ' . $new_page_url);
                    exit();
                }
            }
            elseif ($fileType === $supportedTxtType) {
                if ($fileSize <= $maxTxtFileSize) {
                    move_uploaded_file($tempFile, $targetFile);
                    $result = mysqli_query($connect,"insert into ChatMessages(Username, Email, Message, Input_Date, chat_browser, chat_user_ip, Supplement) values('$login', '$email', '$message', '$date', '$chat_browser', '$chatUserIp', '$targetFile')");
                }
                else {
                    setcookie('errorChat', 'Размер файла не соответствует заданным требованиям (не более 100кб)');
                    $new_page_url = 'http://localhost/chatPage.php';
                    header('Location: ' . $new_page_url);
                    exit();
                }
            }
        }
        else {
            $result = mysqli_query($connect,"insert into ChatMessages(Username, Email, Message, Input_Date, chat_browser, chat_user_ip) values('$login', '$email', '$message', '$date', '$chat_browser', '$chatUserIp')");
        }
        $new_page_url = 'http://localhost/chatPage.php';
        header('Location: ' . $new_page_url);
        exit();
    }
    else {
        setcookie('errorChat', 'Вы не можете отправить пустое сообщение');
        $new_page_url = 'http://localhost/chatPage.php';
        header('Location: ' . $new_page_url);
        exit();
    }