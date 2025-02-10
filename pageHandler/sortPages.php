<?php
    session_start();
    $sorttype = $_POST['sort'];
    switch ($sorttype) {
        case 'date-asc':
            $_SESSION["sortColumn"] = 'Input_Date';
            $_SESSION["sortOrder"] = 'asc';
            break;
        case 'date-desc':
            $_SESSION["sortColumn"] = 'Input_Date';
            $_SESSION["sortOrder"] = 'desc';
            break;
        case 'username-asc':
            $_SESSION["sortColumn"] = 'Username';
            $_SESSION["sortOrder"] = 'asc';
            break;
        case 'username-desc':
            $_SESSION["sortColumn"] = 'Username';
            $_SESSION["sortOrder"] = 'desc';
            break;
        case 'email-asc':
            $_SESSION["sortColumn"] = 'Email';
            $_SESSION["sortOrder"] = 'asc';
            break;
        case 'email-desc':
            $_SESSION['sortColumn'] = 'Email';
            $_SESSION["sortOrder"] = 'desc';
            break;
    }
    $new_page_url = 'http://localhost/chat/chatPage.php';
    header('Location: ' . $new_page_url);
    exit;