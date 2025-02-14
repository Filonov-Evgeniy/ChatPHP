<?php
namespace Chat\src\Message;

require $_SERVER['DOCUMENT_ROOT'].'/chat/autoload.php';

use Chat\src\PageHandler\ChatPageHandler\ChatPageHandlerClass;

class TableFiller
{
    public $page = [];
    function fillTable()
    {
        $pageHandler = new ChatPageHandlerClass();
        $pageHandler->choosePage($this->page);
        return $this->page;
    }
}
    