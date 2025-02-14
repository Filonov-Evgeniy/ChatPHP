<?php
namespace Chat\src\Message;
//define('NO_CONNECTION', 'Y');

require $_SERVER['DOCUMENT_ROOT'].'/chat/autoload.php';

use Chat\src\Message\Builder\MessageBuilderClass;
use Chat\Model\Message\ChatMessage;
use Chat\src\Message\MessageSenderHelper;
use Chat\DBConnect;

class MessageSender
{
    private $maxImgHeight = 240;
    private $maxImgWidth = 320;
    private $supportedImgTypes = ['image/jpeg', 'image/gif', 'image/png'];
    private $supportedTxtType = ['text/plain'];
    private $uploadDirectory = '/chat/uploads/';
    private $maxTxtFileSize = 100 * 1024;
    private $senderHelper;
    public function send()
    {
        session_start();

        if (!empty($_FILES['supplement']) || !empty($_POST['message_box'])) {
            setcookie('errorChat', ' ');

            $dbConnect = DBConnect::getInstance();
            $connect = $dbConnect->getConnection();
            $messageText = mysqli_real_escape_string($connect, $_POST["message_box"]);
            $messageText = htmlspecialchars($messageText);
            $messageText = $this->useBBCode($messageText);

            $message = $this->buildMessage($connect, $messageText);

            if (isset($_FILES['supplement']) && $_FILES['supplement']['error'] === UPLOAD_ERR_OK) {
                $tempFile = $_FILES['supplement']['tmp_name'];
                $fileName = $_FILES['supplement']['name'];
                $fileType = $_FILES['supplement']['type'];
                $fileSize = $_FILES['supplement']['size'];

                $targetFile = $this->uploadDirectory . $fileName;

                if ($this->senderHelper->isSupportedImgFileType($this->supportedImgTypes)) {
                    if ($this->senderHelper->checkImgSize(getimagesize($tempFile) ,$this->maxImgHeight, $this->maxImgWidth)) {
                        move_uploaded_file($tempFile, $targetFile);

                        $values[] = "'".$targetFile."'";

                        $message->sendMessage(false, $values);
                    } else {
                        setcookie('errorChat', 'Размер файла не соответствует заданным требованиям (не более 240x320px)');
                        $new_page_url = '../View/chatPage.php';
                        header('Location: ' . $new_page_url);
                        exit();
                    }
                } elseif($this->senderHelper->isSupportedTxtType($this->supportedTxtType)) {
                    if ($this->senderHelper->checkTxtFileSize($fileSize, $this->maxTxtFileSize)) {
                        move_uploaded_file($tempFile, $targetFile);

                        $values[] = "'".$targetFile."'";

                        $message->sendMessage(false, $values);
                    } else {
                        setcookie('errorChat', 'Размер файла не соответствует заданным требованиям (не более 100кб)');
                        $new_page_url = '../View/chatPage.php';
                        header('Location: ' . $new_page_url);
                        exit();
                    }
                }
            } else {
                $message->sendMessage(false);
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

    public function __construct()
    {
        $this->senderHelper = new MessageSenderHelper();
    }

    private function buildMessage($connect, $messageText): ChatMessage {
        $messageBuilder = new MessageBuilderClass();
        $messageBuilder->setMessageText($messageText);
        $messageBuilder->setDate(date('Y-m-d H:i:s'));
        $messageBuilder->setUsername(mysqli_real_escape_string($connect, $_SESSION["username"]));
        $messageBuilder->setEmail(mysqli_real_escape_string($connect, $_SESSION["email"]));
        $messageBuilder->setChatBrowser($_SERVER['HTTP_USER_AGENT']);
        $messageBuilder->setUserIp($_SERVER['REMOTE_ADDR']);

        $connect->close();

        return $messageBuilder->build();
    }
}