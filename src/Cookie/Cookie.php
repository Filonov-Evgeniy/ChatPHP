<?php
namespace Chat\src\Cookie;
class Cookie
{
    public static function setCookie()
    {
        if (empty($_COOKIE['loginError']) || empty($_COOKIE['registerError'])) {
            setcookie('loginError', ' ', ['path' => "/chat"]);
            setcookie('registrationError', ' ', ['path' => "/chat"]);
        }
    }
}