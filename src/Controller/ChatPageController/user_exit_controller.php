<?php
namespace Chat\src\Controller\ChatPageController;

require $_SERVER['DOCUMENT_ROOT'].'/chat/autoload.php';

use Chat\src\User\User;

$exitAccount = new User();
$exitAccount->exit();