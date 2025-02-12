<?php
namespace Chat\Controllers;

require '../autoload.php';

use Chat\ExitAccount;

$exitAccount = new ExitAccount();
$exitAccount->exit();