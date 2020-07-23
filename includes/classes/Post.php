<?php
    class Post {
        private $user_obj;
        private $db;

        public function __construct($db, $user){
            $this->db = $db; 
            $this->user_obj = new User($db, $user);
        }
    

    public function submitPost($body, $user_to){
       $body = strip_tags($body); //removes html tags  
       $body = mysqli_real_escape_string($this->db, $body);
       $body = str_replace('\r\n', "\n", $body);
       $body = nl2br($body); //convert new lines to line breaks <br>

       $check_empty = preg_replace('/\s+/', '', $body);

       if($check_empty != ""){

        $date_added = date("Y-m-d h:i:s"); // current date and time
        $added_by = $this->user_obj->getUsername();

        // if user is on own profile user_to is none
        if($user_to == $added_by){
            $user_to = "none";
        }

        //save post to database
        $query = mysqli_query($this->db, "INSERT INTO posts VALUES(
            NULL,
            '$body',
            '$added_by',
            '$user_to',
            '$date_added',
            'no',   # user_closed
            'no',   # deleted
            '0'     # likes
             )");
             echo mysqli_error($this->db);

            //return the id of the post
        $returned_id = mysqli_insert_id($this->db);

        //insert notification

        //update post count for user
        $num_posts = $this->user_obj->getNumPosts();
        $num_posts++;
        $update_query = mysqli_query($this->db, "UPDATE users SET num_posts='$num_posts' WHERE username='$added_by'");
       }
    }

    public function loadPostsFriends(){
        $str = "";
        $data = mysqli_query($this->db, "SELECT * FROM posts WHERE deleted='no' ORDER BY id DESC");

        while($row = mysqli_fetch_array($data)){
            $id = $row['id'];
            $body = $row['body'];
            $added_by = $row['added_by'];
            $date_time = $row['date_added'];

            //prepare user_to string so it can be included even if not posted to a user
            if($row['user_to'] == "none"){
                $user_to = "";   
            } else {
                $user_to_obj = new User($db, $row['user_to']);
                $user_to_name = $user_to_obj->getFirstAndLastName();
                $user_to = "to <a href='" . $row['user_to'] . "'>" . $user_to_name . "</a>";
            }

            // check if the user who posted has their account closed
            $added_by_obj = new User($this->db, $added_by);

            if($added_by_obj->isClosed()){
                continue;
            }

            $user_details_query = mysqli_query($this->db, "SELECT first_name, last_name, profile_pic from users WHERE username='$added_by'");
            $user_row = mysqli_fetch_array($user_details_query);
            $first_name = $user_row['first_name'];
            $last_name = $user_row['last_name'];
            $profile_pic = $user_row['profile_pic'];

            //Timeframe
            $date_time_now = date("Y-m-d H:i:s"); 
            $start_date = new DateTime($date_time); //Time of post
            $end_date = new DateTime($date_time_now); //Current Time
            $interval = $start_date->diff($end_date); //Difference between dates
            

            
            

            if($interval->y >= 1){
                if($interval->y == 1){
                    $time_message = $interval->y . "year ago"; //year ago
                } else{
                    $time_message = $interval->y . "years ago"; //+1 years ago
                }
            } 

            else if($interval->m >= 1){
                if($interval->d == 0){
                        $days = " ago";
                    } else if($interval->d == 1){
                        $days = $interval->d . " day ago";
                    } else{
                        $days = $interval->d . " days ago";
                    }

                if($interval->m == 1){
                    $time_message = $interval->m . "month" . $days;
                    } 
                else {
                    $time_message = $interval->m . "months" . $days;
                    }
            } 
            else if($interval->d >= 1){
                    if($interval->d == 1){
                        $time_message = "Yesterday";
                    } 
                   else{
                        $time_message = $interval->d . " days ago";
                    }
            }
            else if($interval-> h >= 1){
                    if($interval->h == 1){
                        $time_message = $interval->h . " hour ago";
                    } 
                    else{
                        $time_message = $interval->h . " hours ago";
                    }
            }
            else if($interval-> i >= 1){
                if($interval->i == 1){
                    $time_message = $interval->i . " hour ago";
                } 
                else{
                    $time_message = $interval->i . " hours ago";
                }
            }  
            else{
                 if($interval->s < 30){
                      $time_message = " Just Now";
                 } 
                 else{
                      $time_message = " Seconds ago";
                 }
            }

            $str .= "<div class='status_post'>
                <div class='profile_pic'>
                    <img src='$profile_pic' alt='profile picture' width='50'>
                </div>

                <div class='posted_by' style='color: grey'>
                    <a href='$added_by'>$first_name $last_name</a> $user_to &nbsp;&nbsp;&nbsp;&nbsp; $time_message
                </div>
                <div id='post_body'>
                    $body
                    <br>
                </div>
            </div>";   
        }   

        echo $str;
    }
}

?>