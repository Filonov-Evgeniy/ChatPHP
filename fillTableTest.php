<?php
    namespace Chat;

    require_once 'pageHandler.php';

    use Chat\pageHandler;

    $pageHandler = new pageHandler();
    $page = []; 
    $pageHandler->choosePage($page);
    
    