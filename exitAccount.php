<?php
    session_destroy();
    $new_page_url = 'http://localhost/chat/loginPage.php';
    header('Location: ' . $new_page_url);