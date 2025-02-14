<?php
namespace Chat\src\Controller\ChatPageController;

require '/chat/autoload.php';

//use Chat\MessageSender;
use Chat\src\Message\MessageSender;

$sendMessage = new MessageSender();
$sendMessage->send();