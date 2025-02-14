<?php
namespace Chat\Controller\ChatPageController;

require '/chat/autoload.php';

use Chat\src\User\UserExit;

$exitAccount = new UserExit();
$exitAccount->exit();