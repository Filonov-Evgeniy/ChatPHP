<?php
namespace Сhat\Controller\AuthorizationPageController;

require '/Сhat/autoload.php';

use chat\src\User\UserAuthorization;

$accountLogin = new UserAuthorization();
$accountLogin->login();
