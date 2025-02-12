<?php
    namespace Chat\Controllers;
    class setCookie
    {
        function setCookie()
        {
            setcookie('loginError', ' ', ['path' => "/chat"]);
            setcookie('registrationError', ' ', ['path' => "/chat"]);
        }
    }

    $cookie = new setCookie();
    $cookie->setCookie();