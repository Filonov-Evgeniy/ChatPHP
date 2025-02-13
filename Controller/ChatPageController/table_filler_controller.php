<?php
namespace Chat\Controller\ChatPageController;

require '../autoload.php';

use Chat\src\Message\TableFiller;

$fillTable = new TableFiller();
$fillTable->fillTable();