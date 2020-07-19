<?php
   require 'config/config.php';

   if(isset($_SESSION['username'])){
       $userLoggedIn = $_SESSION['username'];
   } else {
       header("Location: register.php");
   }

   $user_detail_query = mysqli_query($db, "SELECT * FROM users WHERE username='$userLoggedIn' ");
   $user = mysqli_fetch_array($user_detail_query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Chat Corner</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="assets/css/style.css">


</head>
<body>
    <div class="top_bar">
        <div class="logo">
           <a href="index.php">Chat Corner</a>
        </div>

        <nav>
          <a href="<?php echo $userLoggedIn ?>">
            <?php echo $user['first_name'] ?>
          </a>
          <a href="index.php"><i class="fa fa-home fa-lg" aria-hidden="true"></i></a>
          <a href="#"><i class="fa fa-envelope fa-lg" aria-hidden="true"></i></a>
          <a href="#"><i class="fa fa-bell-o fa-lg" aria-hidden="true"></i></a>
          <a href="#"><i class="fa fa-users fa-lg" aria-hidden="true"></i></a>
          <a href="#"><i class="fa fa-cog fa-lg" aria-hidden="true"></i></a>
        </nav>
    </div>

    <div class="wrapper">
        

           

   

    
   



