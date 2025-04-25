<?php
    
    //database configuration
    $host       = getenv('MYSQL_HOST') ?: 'localhost';
    $user       = getenv('MYSQL_USER') ?: 'root';
    $pass       = getenv('MYSQL_PASSWORD') ?: '';
    $database   = getenv('MYSQL_DATABASE') ?: 'your_videos_channel_db';

    $connect = new mysqli($host, $user, $pass, $database);

    if (mysqli_connect_errno()) {
        die ('Whoops! failed to connect to database : ' . mysqli_connect_error());
    } else {
        $connect->set_charset('utf8mb4');
    }

    $ENABLE_RTL_MODE = 'false';

?>