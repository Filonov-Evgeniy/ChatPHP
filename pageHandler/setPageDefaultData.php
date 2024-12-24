<?php
    session_start();
    setcookie('page', 0);
    $_SESSION["sortColumn"] = 'Input_Date';
    $_SESSION["sortOrder"] = 'asc';
    $pageNumber = $_COOKIE['page'];
    $new_page_url = 'http://localhost/chatPage.php';
    header('Location: ' . $new_page_url);
    exit;