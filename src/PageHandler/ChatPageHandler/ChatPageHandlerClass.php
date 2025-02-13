<?php
namespace Chat\src\PageHandler\ChatPageHandler;

require $_SERVER['DOCUMENT_ROOT'].'/chat/autoload.php';

use Chat\src\PageHandler\ChatPageHandler;

class ChatPageHandlerClass
{
    use ChatPageHandlerTrait;
    function choosePage(&$page)
    {
        if (isset($_COOKIE['page'])) {
            if (isset($_POST['back'])) {
                $this->swipePagesBack();
            } elseif (isset($_POST["next"])) {
                $this->swipePagesNext();
            } elseif (isset($_POST['sortButton'])) {
                $this->sortPages();
            } else {
                $this->loadPage($page);
            }
        } else {
            $this->setPageDefaultData();
        }
    }
}