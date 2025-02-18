<?php

namespace Chat\src\PageHandler\ChatPageHandler;

require_once $_SERVER['DOCUMENT_ROOT'] . '/chat/autoload.php';

use Chat\DBConnect;
use Chat\src\Message\ChatMessage;
use Chat\src\User\ChatUsers;

trait ChatPageHandlerTrait
{
    public function loadPage(&$page)
    {
        $pageSize = 25;
        $pageNumber = $_COOKIE['page'];
        $message = new ChatMessage();
        $resultArray = $message->getList();
        $messagesCount = $_SESSION['db_rows_count'];

        if ($pageNumber * $pageSize + $pageSize > $messagesCount) {
            $difference = $pageNumber * $pageSize + $pageSize - $messagesCount;
            for ($i = $pageNumber * $pageSize; $i <= $pageNumber * $pageSize + $pageSize - $difference - 1; $i++) {
                $page[] = $resultArray[$i];
            }
        } else {
            for ($i = $pageNumber * $pageSize; $i <= $pageNumber * $pageSize + $pageSize; $i++) {
                $page[] = $resultArray[$i];
            }
        }
    }

    public function setPageDefaultData()
    {
        setcookie('page', 0, ['path' => "/chat"]);
        setcookie('errorChat', ' ');
        $_SESSION["sortColumn"] = 'Input_Date';
        $_SESSION["sortOrder"] = 'desc';
        $new_page_url = '/chat/View/chatPage.php';
        header('Location: ' . $new_page_url);
        exit;
    }

    public function sortPages()
    {
        $sorttype = $_POST['sort'];
        switch ($sorttype) {
            case 'date-asc':
                $_SESSION["sortColumn"] = 'Input_Date';
                $_SESSION["sortOrder"] = 'asc';
                break;
            case 'date-desc':
                $_SESSION["sortColumn"] = 'Input_Date';
                $_SESSION["sortOrder"] = 'desc';
                break;
            case 'username-asc':
                $_SESSION["sortColumn"] = 'Username';
                $_SESSION["sortOrder"] = 'asc';
                break;
            case 'username-desc':
                $_SESSION["sortColumn"] = 'Username';
                $_SESSION["sortOrder"] = 'desc';
                break;
            case 'email-asc':
                $_SESSION["sortColumn"] = 'Email';
                $_SESSION["sortOrder"] = 'asc';
                break;
            case 'email-desc':
                $_SESSION['sortColumn'] = 'Email';
                $_SESSION["sortOrder"] = 'desc';
                break;
        }
        $new_page_url = '/chat/View/chatPage.php';
        header('Location: ' . $new_page_url);
        exit;
    }

    public function swipePagesBack()
    {
        $pageSize = 25;
        $pageNumber = $_COOKIE['page'];
        if ($_SESSION['db_rows_count'] > ($pageNumber + 1) * $pageSize) {
            $pageNumber += 1;
            setcookie('page', $pageNumber, ['path' => "/chat"]);
            $new_page_url = '/chat/View/chatPage.php';
            header('Location: ' . $new_page_url);
            exit;
        } else {
            $new_page_url = '/chat/View/chatPage.php';
            header('Location: ' . $new_page_url);
            exit;
        }
    }

    public function swipePagesNext()
    {
        if ($_COOKIE['page'] > 0) {
            $pageNumber = $_COOKIE['page'];
            $pageNumber -= 1;
            setcookie('page', $pageNumber, ['path' => "/chat"]);
            $new_page_url = '/chat/View/chatPage.php';
            header('Location: ' . $new_page_url);
            exit;
        } else {
            $new_page_url = '/chat/View/chatPage.php';
            header('Location: ' . $new_page_url);
            exit;
        }
    }
}