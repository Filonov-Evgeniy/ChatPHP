<?php
namespace Chat\src\User;

class UserExit
{
    public function exit()
    {
        session_destroy();
        $new_page_url = '../View/index.php';
        header('Location: ' . $new_page_url);
    }
}