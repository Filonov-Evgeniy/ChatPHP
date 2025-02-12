<?php
namespace Chat;

require 'autoload.php';
//require_once 'PageHandler.php';

use Chat\PageHandler;

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
    