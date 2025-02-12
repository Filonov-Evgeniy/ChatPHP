<?php
    namespace Chat\Controllers;

    require '../autoload.php';
    //require_once 'pageHandler.php';

    use Chat\Controllers\PageHandler;

    class FillTableTest
    {
        public $page = [];
        function fillTable()
        {
            $pageHandler = new PageHandler();
            $pageHandler->choosePage($this->page);
            return $this->page;
        }
    }

    $fillTable = new FillTableTest();
    $fillTable->fillTable();
    