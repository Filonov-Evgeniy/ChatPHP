<?php
namespace Chat\Controllers;

require '../autoload.php';

use Chat\AccountLogin;

$accountLogin = new AccountLogin();
$accountLogin->login();
