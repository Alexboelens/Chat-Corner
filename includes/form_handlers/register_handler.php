<?php

 // Declare variables to prevent errors
 $fname = ""; //first name
 $lname = ""; //last name
 $email = ""; //email
 $email2 = ""; //email2
 $password = ""; //password
 $password2 = ""; //password2
 $date = ""; //Sign up date
 $error_array = []; //Holds Error Messages

 if(isset($_POST['register_button'])){

     // Registration for values

     //First Name
     $fname = strip_tags($_POST["reg_fname"]); //strip HTML tags
     $fname = str_replace(' ', '', $fname); // Remove spaces
     $fname = ucfirst(strtolower($fname)); // convert to lowercase and make first letter Uppercase
     $_SESSION["reg_fname"] = $fname; // stores first name into session variable

     //Last Name
     $lname = strip_tags($_POST["reg_lname"]); //strip HTML tags
     $lname = str_replace(' ', '', $lname); // Remove spaces
     $lname = ucfirst(strtolower($lname)); // convert to lowercase and make first letter Uppercase
     $_SESSION["reg_lname"] = $lname; // stores last name name into session variable


     //Email
     $email = strip_tags($_POST["reg_email"]); //strip HTML tags
     $email = str_replace(' ', '', $email); // Remove spaces
     $email = ucfirst(strtolower($email)); // convert to lowercase and make first letter Uppercase
     $_SESSION["reg_email"] = $email; // stores email into session variable

     //Email 2
     $email2 = strip_tags($_POST["reg_email2"]); //strip HTML tags
     $email2 = str_replace(' ', '', $email2); // Remove spaces
     $email2 = ucfirst(strtolower($email2)); // convert to lowercase and make first letter Uppercase
     $_SESSION["reg_email2"] = $email2; // stores email2 into session variable

     //Password
     $password = strip_tags($_POST["reg_password"]); //strip HTML tags
     $password2 = strip_tags($_POST["reg_password2"]); //strip HTML tags


     //Date
     $date = date("Y-m-d"); //Current Date

     if($email == $email2){
         // check if email is in valid format
         if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
             
             $email = filter_var($email, FILTER_VALIDATE_EMAIL);

             // Check if email exists in the database
             $email_check = mysqli_query($db, "SELECT email FROM users WHERE email='$email' ");

             // count the number of rows returned
             $num_rows = mysqli_num_rows($email_check);

             if($num_rows > 0){
                 array_push($error_array, "Email already in use<br>");
             }
         } else{
             array_push($error_array, "Invalid email format<br>");
         }
     }else{
         array_push($error_array, "Emails dont't match<br>");
     }

     if(strlen($fname) > 25 || strlen($fname) < 2){
         array_push($error_array, "Your first name must be between 2 and 25 characters<br>");
     }

     if(strlen($lname) > 25 || strlen($lname) < 2){
         array_push($error_array, "Your last name must be between 2 and 25 characters<br>");
     }

     if($password != $password2){
         array_push($error_array, "Your passwords do not match<br>");
     } else if(preg_match('/[^A-Za-z0-9]/', $password)){
         array_push($error_array, "Your password can only contain english characters and numbers<br>");
         }

     if(strlen($password) < 5 || strlen($password) > 30){
         array_push($error_array, "Your password must be between 5 and 30 characters<br>");
     }

     if(empty($error_array)){
         $password = md5($password); // md5 encrypts password before sending to database
         $username = strtolower($fname . "_" . $lname);

         $check_username_query = mysqli_query($db, "SELECT username FROM users WHERE username='$username' " );

         $i=0;
         while(mysqli_num_rows($check_username_query) != 0){
             $i++;
             $username = $username . "_" . $i;
             $check_username_query = mysqli_query($db, "SELECT username FROM users WHERE username='$username' " );
         }

         // Profile picture assignment
         $randomNum = rand(1, 2); //random number between 1 and 2

         if($randomNum == 1){
             $profile_pic = "assets/images/profile_pics/defaults/head_deep_blue.png";
         }else if($randomNum == 2){
             $profile_pic = "assets/images/profile_pics/defaults/head_red.png";
         }

         $query = mysqli_query($db, "INSERT INTO users VALUES(
              NULL,            #id
             '$fname',         #first name
             '$lname',         #last name
             '$username',      #username
             '$email',         #email
             '$password',      #password
             '$date',          #date
             '$profile_pic',   #profile picture
             '0',              #num_posts
             '0',              #num_likes
             'no',             #user_closed
             ','               #friend_array
             )");

         array_push($error_array, "<span style='color: green'>Register Success</span><br>");

         // empty the input fields after registering
         $_SESSION['reg_fname'] = "";
         $_SESSION['reg_lname'] = "";
         $_SESSION['reg_email'] = "";
         $_SESSION['reg_email2'] = "";
     }
 }
?>