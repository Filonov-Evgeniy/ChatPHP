<?php
    session_start();
    if ($_COOKIE['page'] > 0) {
        $pageNumber = $_COOKIE['page'] - 1;
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