<?php
namespace Chat\src\Message;

require '/chat/autoload.php';
//require_once 'ChatPageHandlerClass.php';

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
    