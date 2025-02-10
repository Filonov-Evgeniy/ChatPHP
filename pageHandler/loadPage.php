<?php
    require_once 'dbConnect.php';

    use Chat\DBConnect;

    session_start();
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