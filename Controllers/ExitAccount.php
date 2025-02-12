<?php
namespace Chat\Controller;

$exitAccount = new ExitAccount();
$exitAccount->exit();

class ExitAccount
{
    public function exit()
    {
        session_destroy();
        $new_page_url = 'http://localhost/chat/Views/loginPage.php';
        header('Location: ' . $new_page_url);
    }
}