<?php
namespace Chat\src\Controller\ChatPageController;

require $_SERVER['DOCUMENT_ROOT'].'/chat/autoload.php';

use Chat\src\Message\TableFiller;

$fillTable = new TableFiller();
$fillTable->fillTable();