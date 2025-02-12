<?php
    namespace Chat\Controllers;
    class setCookie
    {
        function setCookie()
        {
            setcookie('loginError', ' ');
            setcookie('registrationError', ' ');
        }
    }

    $cookie = new setCookie();
    $cookie->setCookie();