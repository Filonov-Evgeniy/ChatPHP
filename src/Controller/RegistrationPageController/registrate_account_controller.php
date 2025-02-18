<?php
namespace Chat\src\Controllers;

require $_SERVER['DOCUMENT_ROOT'].'/chat/autoload.php';

use Chat\src\User\User;

$account = new User();
$account->createAccount();