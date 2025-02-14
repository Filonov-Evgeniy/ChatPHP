<?php
namespace Chat\Controller;

require "/chat/autoload.php";

use Chat\src\Cookie\Cookie;

$cookie = new Cookie();
$cookie->setCookie();