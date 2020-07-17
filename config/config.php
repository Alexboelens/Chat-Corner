<?php
    ob_start(); //turn on output buffering
    session_start();

    $timezone = date_default_timezone_set("Europe/Amsterdam");

    // database connection (host, username, password, database name)
    $db = mysqli_connect('localhost', 'root', 'alexalex', 'social');

    // check if connection works return nothing if connection fails
    if(mysqli_connect_errno()){
        echo 'failed to connect: ' . mysqli_connect_errno();
    }

?>