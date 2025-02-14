<?php
namespace Chat\Controller\ChatPageController;

require '/Chat/autoload.php';

//use Chat\MessageSender;
use Сhat\src\Message\MessageSender;

$sendMessage = new MessageSender();
$sendMessage->send();