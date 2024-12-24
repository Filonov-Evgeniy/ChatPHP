<?php
    session_destroy();
    $new_page_url = 'http://localhost/loginPage.php';
    header('Location: ' . $new_page_url);