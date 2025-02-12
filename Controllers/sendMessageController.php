<?php
namespace Chat\Controllers;

require '../autoload.php';

use Chat\SendMessage;

$sendMessage = new SendMessage();
$sendMessage->send();