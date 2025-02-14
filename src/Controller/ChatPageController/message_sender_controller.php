<?php
namespace Chat\src\Controller\ChatPageController;

require $_SERVER['DOCUMENT_ROOT'].'/chat/autoload.php';

use Chat\src\Message\MessageSender;

$sendMessage = new MessageSender();
$sendMessage->send();