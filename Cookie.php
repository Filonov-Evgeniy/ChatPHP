<?php
namespace Chat;
class Cookie
{
    public function setCookie()
    {
        setcookie('loginError', ' ', ['path' => "/chat"]);
        setcookie('registrationError', ' ', ['path' => "/chat"]);
    }
}