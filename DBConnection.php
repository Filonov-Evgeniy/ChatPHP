<?php
    const host = "localhost";
    const user = "root";
    const password = "1234";
    const dbname = "chatDB";
    $connect = mysqli_connect(host, user, password, dbname);
    if(mysqli_connect_errno()) {
        echo mysqli_connect_error();
    }