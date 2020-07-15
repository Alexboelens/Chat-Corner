<?php
    // database connection (host, username, password, database name)
    $db = mysqli_connect('localhost', 'root', 'alexalex', 'social');

    // check if connection works return nothing if connection fails
    if(mysqli_connect_errno()){
        echo 'failed to connect: ' . mysqli_connect_errno();
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Chat Corner</title>
</head>
<body>
    
</body>
</html>