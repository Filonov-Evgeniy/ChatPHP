<?php
namespace Chat\Controller\AuthorizationPageController;

require '../autoload.php';

use Chat\UserAuthorization;

$accountLogin = new UserAuthorization();
$accountLogin->login();
