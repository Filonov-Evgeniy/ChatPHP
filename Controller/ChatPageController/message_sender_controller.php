<?php
namespace Chat\Controller\ChatPageController;

require '../autoload.php';

//use Chat\MessageSender;
use Chat\src\Message\MessageSender;

$sendMessage = new MessageSender();
$sendMessage->send();