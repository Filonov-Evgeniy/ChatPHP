<?php
namespace Сhat\src\Controller\AuthorizationPageController;

require '/Сhat/autoload.php';

use chat\src\User\User;

$accountLogin = new User();
$accountLogin->login();
