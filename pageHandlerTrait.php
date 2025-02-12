<?php
    namespace Chat;

    require_once 'autoload.php';

    session_start();

    trait pageHandlerTrait {
        public function loadPage(&$page) {
            $pageSize = 25;
            $pageNumber = $_COOKIE['page'];
            $sortCol = $_SESSION['sortColumn'];
            $sortOrder = $_SESSION['sortOrder'];

            $connect = DBConnect::getConnection();

            $result = mysqli_query($connect,"Select * from chatmessages order by ".$sortCol." ".$sortOrder);
            $messagesCount = mysqli_num_rows($result);
            $_SESSION['db_rows_count'] = $messagesCount;
            $resultArray = [];
            for ($i = 0; $i < $messagesCount; $i++) {
                $resultArray[$i] = mysqli_fetch_assoc($result);
            }

            if ($pageNumber * $pageSize + $pageSize > $messagesCount) {
                $difference = $pageNumber * $pageSize + $pageSize - $messagesCount;
                for ($i = $pageNumber * $pageSize; $i <= $pageNumber * $pageSize + $pageSize - $difference - 1; $i++) {
                    $page[] = $resultArray[$i];
                }
            }
            else {
                for ($i = $pageNumber * $pageSize; $i <= $pageNumber * $pageSize + $pageSize; $i++) {
                    $page[] = $resultArray[$i];
                }
            }
        }
        public function setPageDefaultData() {
//            session_start();
            setcookie('page', 0, ['path' => "/chat/Views"]);
            setcookie('errorChat', ' ');
            $_SESSION["sortColumn"] = 'Input_Date';
            $_SESSION["sortOrder"] = 'desc';
//            $pageNumber = $_COOKIE['page'];
            $new_page_url = 'http://localhost/chat/Views/chatPage.php';
            header('Location: ' . $new_page_url);
            exit;
        }
        public function sortPages() {
//            session_start();
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
            $new_page_url = 'http://localhost/chat/Views/chatPage.php';
            header('Location: ' . $new_page_url);
            exit;
        }
        public function swipePagesBack() {
            $pageSize = 25;
            $pageNumber = $_COOKIE['page'];
            if ($_SESSION['db_rows_count'] > ($pageNumber + 1) * $pageSize)
            {
                $pageNumber += 1;
                setcookie('page', $pageNumber, ['path' => "/chat/Views"]);
                $new_page_url = 'http://localhost/chat/Views/chatPage.php';
                header('Location: ' . $new_page_url);
                exit;
            }
            else {
                $new_page_url = 'http://localhost/chat/Views/chatPage.php';
                header('Location: ' . $new_page_url);
                exit;
            }
        }
        public function swipePagesNext() {
            if ($_COOKIE['page'] > 0) {
                $pageNumber = $_COOKIE['page'];
                $pageNumber -= 1;

                setcookie('page', $pageNumber, ['path' => "/chat/Views"]);
                $new_page_url = 'http://localhost/chat/Views/chatPage.php';
                header('Location: ' . $new_page_url);
                exit;
            }
            else {
                $new_page_url = 'http://localhost/chat/Views/chatPage.php';
                header('Location: ' . $new_page_url);
                exit;
            }
        }
    }