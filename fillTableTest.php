<?php
    namespace Chat;

    require_once 'pageHandler.php';

    use Chat\PageHandler;

    $pageHandler = new PageHandler();
    $page = []; 
    $pageHandler->choosePage($page);
    
    