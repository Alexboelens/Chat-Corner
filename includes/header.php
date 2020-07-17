<?php
   require 'config/config.php';

   if(isset($_SESSION['username'])){
       $userLoggedIn = $_SESSION['username'];
   } else {
       header("Location: register.php");
   }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Chat Corner</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">

</head>


   
<body>

