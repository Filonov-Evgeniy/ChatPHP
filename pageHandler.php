<?php
    function choosePage(&$page)
    {
        require_once 'DBConnection.php';
        if (isset($_COOKIE['page'])) {
            if (isset($_POST['back'])) {
                require_once __DIR__.'/pageHandler/swipePagesBack.php';
            }
            elseif (isset($_POST["next"])) {
                require_once __DIR__.'/pageHandler/swipePagesNext.php';
            }
            elseif (isset($_POST['sortButton'])) {
                require_once __DIR__.'/pageHandler/sortPages.php';
            }
            else {
                require_once __DIR__.'/pageHandler/loadPage.php';
            }
        }
        else {
            require_once __DIR__.'/pageHandler/setPageDefaultData.php';
        }
    }