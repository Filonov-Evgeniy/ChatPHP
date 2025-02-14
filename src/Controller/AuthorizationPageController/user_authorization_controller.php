<?php
namespace Сhat\src\Controller\AuthorizationPageController;

require $_SERVER['DOCUMENT_ROOT'].'/chat/autoload.php';

use chat\src\User\User;

$accountLogin = new User();
$accountLogin->login();