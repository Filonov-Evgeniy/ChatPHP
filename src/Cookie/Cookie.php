<?php
namespace Chat\src\Cookie;
class Cookie
{
    public function setCookie()
    {
        setcookie('loginError', ' ', ['path' => "/chat"]);
        setcookie('registrationError', ' ', ['path' => "/chat"]);
    }
}