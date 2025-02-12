<?php
    namespace Chat;
    session_start();

    trait pageHandlerTrait {
        public function loadPage(&$page) {
            require_once 'DBConnect.php';
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

            if ($messagesCount < $pageSize) {
                foreach ($result as $row) {
                    $page[] = $row;
                }
            }
            else {
                $difference = $messagesCount - $pageSize * ($pageNumber + 1);
                if ($difference < 0) {
                    for ( $i = 0; $i < $pageSize; $i++) {
                        $page[] = $resultArray[$i];
                    }
                }
                else {
                    for ($i = $difference; $i < $messagesCount; $i++) {
                        $page[] = $resultArray[$i];
                    }
                }
            }
        }
        public function setPageDefaultData() {
            session_start();
            setcookie('page', 0);
            setcookie('errorChat', ' ');
            $_SESSION["sortColumn"] = 'Input_Date';
            $_SESSION["sortOrder"] = 'asc';
            $pageNumber = $_COOKIE['page'];
            $new_page_url = 'http://localhost/chat/Views/chatPage.php';
            header('Location: ' . $new_page_url);
            exit;
        }
        public function sortPages() {
            session_start();
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
            $pageSize;
            if(empty($pageSize)) {
                $pageSize = 25;
            }
            session_start();
            $pageNumber = $_COOKIE['page'];
            if ($_SESSION['db_rows_count'] > ($pageNumber + 1) * $pageSize)
            {
                $pageNumber = $_COOKIE['page'] + 1;
                setcookie('page', $pageNumber);
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
            session_start();
            if ($_COOKIE['page'] > 0) {
                $pageNumber = $_COOKIE['page'] - 1;
                setcookie('page', $pageNumber);
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