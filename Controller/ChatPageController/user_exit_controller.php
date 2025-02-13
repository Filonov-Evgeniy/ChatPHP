<?php
namespace Chat\Controller\ChatPageController;

require '../autoload.php';

use Chat\src\User\UserExit;

$exitAccount = new UserExit();
$exitAccount->exit();