<?php
    $pageSize = null;
    if(empty($pageSize)) {
        $pageSize = 25;
    }
    session_start();
    $pageNumber = $_COOKIE['page'];
    if ($_SESSION['db_rows_count'] > ($pageNumber + 1) * $pageSize)
    {
        $pageNumber = $_COOKIE['page'] + 1;
        setcookie('page', $pageNumber); 
        $new_page_url = 'http://localhost/chat/chatPage.php';
        header('Location: ' . $new_page_url);
        exit;
    }
    else {
        $new_page_url = 'http://localhost/chat/chatPage.php';
        header('Location: ' . $new_page_url);
        exit;
    }