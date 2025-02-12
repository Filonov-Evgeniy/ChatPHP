<?php
namespace Chat\Controllers;

require '../autoload.php';

use Chat\RegistrateAccount;

$accountRegistration = new RegistrateAccount();
$accountRegistration->createAccount();
