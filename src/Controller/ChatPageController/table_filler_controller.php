<?php
namespace Chat\src\Controller\ChatPageController;

require '/chat/autoload.php';

use Chat\src\Message\TableFiller;

$fillTable = new TableFiller();
$fillTable->fillTable();