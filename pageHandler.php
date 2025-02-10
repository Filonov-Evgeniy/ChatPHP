<?php
    namespace Chat;

    require_once 'pageHandlerTrait.php';

    class PageHandler
    {
        use pageHandlerTrait;
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