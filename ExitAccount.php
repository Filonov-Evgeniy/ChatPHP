<?php
namespace Chat;

class ExitAccount
{
    public function exit()
    {
        session_destroy();
        $new_page_url = '../Views/loginPage.php';
        header('Location: ' . $new_page_url);
    }
}