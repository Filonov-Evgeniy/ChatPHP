<?php
    namespace Chat\Controller;

    $exitAccount = new ExitAccount();
    $exitAccount->exitAccount();
    
    class ExitAccount
    {
        public function exitAccount()
        {
            session_destroy();
            $new_page_url = 'http://localhost/chat/Views/loginPage.php';
            header('Location: ' . $new_page_url);
        }
    }