<?php
    namespace Chat\Controllers;

    require '../autoload.php';
    //require_once 'pageHandler.php';

    use Chat\Controllers\PageHandler;

    $pageHandler = new PageHandler();
    $page = []; 
    $pageHandler->choosePage($page);
    
    