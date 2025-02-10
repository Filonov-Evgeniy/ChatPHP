<?php

namespace Chat;

class DBConnect
{
    private static $instance;
    const host = "localhost";
    const user = "root";
    const password = "1234";
    const dbname = "chatDB";

    public static function getConnection()
    {
        return mysqli_connect(self::host, self::user, self::password, self::dbname);
    }

    public static function getInstance(): DBConnect
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }
}