<?php
namespace Chat;

class ExitAccount
{
    public function exit()
    {
        session_destroy();
        $new_page_url = '../Views/index.php';
        header('Location: ' . $new_page_url);
    }
}