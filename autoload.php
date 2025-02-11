<?php
    spl_autoload_register(function ($class) {

        // Полный путь к файлу класса
        $file = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . $class . '.php';

        $file = str_replace('\\', '/', $file);

        if (file_exists($file)) {
            require $file;
        } else {
            die("Файл $file не найден.");
        }
    });