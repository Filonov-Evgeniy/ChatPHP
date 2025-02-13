<?php
namespace Chat;
define('NO_CONNECTION', 'Y');

require 'autoload.php';

use Chat\Builder\MessageBuilderClass;
use Chat\Models\Message;

class SendFileTest
{
//    private $table = "ChatMessages";
    public function send()
    {
        session_start();
        $messageBuilder = new MessageBuilderClass();
        $maxImgHeight = 240;
        $maxImgWidth = 320;
        $supportedImgTypes = ['image/jpeg', 'image/gif', 'image/png'];
        $supportedTxtType = ['text/plain'];
        $uploadDirectory = '../uploads/';
        $maxTxtFileSize = 100 * 1024;

        if (!empty($_FILES['supplement']) || !empty($_POST['message_box'])) {
            setcookie('errorChat', ' ');
            $dbConnect = DBConnect::getInstance();
            $connect = $dbConnect->getConnection();
            $messageText = mysqli_real_escape_string($connect, $_POST["message_box"]);
            $messageText = htmlspecialchars($messageText);
            $date = date('Y-m-d H:i:s');
            $login = mysqli_real_escape_string($connect, $_SESSION["username"]);
            $email = mysqli_real_escape_string($connect, $_SESSION["email"]);
            $chatBrowser = $_SERVER['HTTP_USER_AGENT'];
            $chatUserIp = $_SERVER['REMOTE_ADDR'];
            $connect->close();

            $messageText = $this->useBBCode($messageText);

            $messageBuilder->setMessageText($messageText);
            $messageBuilder->setDate($date);
            $messageBuilder->setUsername($login);
            $messageBuilder->setEmail($email);
            $messageBuilder->setChatBrowser($chatBrowser);
            $messageBuilder->setUserIp($chatUserIp);

            $message = $messageBuilder->build();

            $values = [
                "'".$message->getUsername()."'",
                "'".$message->getEmail()."'",
                "'".$message->getChatBrowser()."'",
                "'".$message->getDate()."'",
                "'".$message->getUsername()."'",
                "'".$message->getEmail()."'",
            ];

            if (isset($_FILES['supplement']) && $_FILES['supplement']['error'] === UPLOAD_ERR_OK) {
                $tempFile = $_FILES['supplement']['tmp_name'];
                $fileName = $_FILES['supplement']['name'];
                $fileType = $_FILES['supplement']['type'];
                $fileSize = $_FILES['supplement']['size'];
                $targetFile = $uploadDirectory . $fileName;
                if ($message->isSupportedImgFileType($supportedImgTypes)) {
                    if ($message->checkImgSize(getimagesize($tempFile) ,$maxImgHeight, $maxImgWidth)) {
                        move_uploaded_file($tempFile, $targetFile);
                        $columns = $this->getColumns(true);

                        $values[] = "'".$targetFile."'";

//                        $dbConnect->filteredCreate($this->table, $columns, $values);
                        $message->sendMessage($columns, $values);
                    } else {
                        setcookie('errorChat', 'Размер файла не соответствует заданным требованиям (не более 240x320px)');
                        $new_page_url = '../View/chatPage.php';
                        header('Location: ' . $new_page_url);
                        exit();
                    }
                } elseif
                ($message->isSupportedTxtType($supportedTxtType)) {
                    if ($message->checkTxtFileSize($fileSize, $maxTxtFileSize)) {
                        move_uploaded_file($tempFile, $targetFile);
                        $columns = $this->getColumns(true);

                        $values[] = "'".$targetFile."'";

//                        $dbConnect->filteredCreate($this->table, $columns, $values);
                        $message->sendMessage($columns, $values);
                    } else {
                        setcookie('errorChat', 'Размер файла не соответствует заданным требованиям (не более 100кб)');
                        $new_page_url = '../View/chatPage.php';
                        header('Location: ' . $new_page_url);
                        exit();
                    }
                }
            } else {
                $columns = $this->getColumns(false);
//                $dbConnect->filteredCreate($this->table, $columns, $values);
                $message->sendMessage($columns, $values);
            }
            $new_page_url = '../View/chatPage.php';
            header('Location: ' . $new_page_url);
            exit();
        } else {
            setcookie('errorChat', 'Вы не можете отправить пустое сообщение111');
            $new_page_url = '../View/chatPage.php';
            header('Location: ' . $new_page_url);
            exit();
        }
    }

    public function useBBCode($text) {
        $search = array(
            '/\[b\](.*?)\[\/b\]/is',
            '/\[i\](.*?)\[\/i\]/is',
            '/\[u\](.*?)\[\/u\]/is',
        );

        $replace = array(
            '<b>$1</b>',
            '<i>$1</i>',
            '<u>$1</u>',
        );

        return preg_replace($search, $replace, $text);
    }

    private function getColumns(bool $withSupplement): array {
        $columns = [
            "Username",
            "Email",
            "Message",
            "Input_Date",
            "chat_browser",
            "chat_user_ip",
        ];
        if(!$withSupplement) {
            return $columns;
        }
        $columns[] = "Supplement";
        return $columns;
    }
}