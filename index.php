<?php
    include "includes/header.php";

?>
    <div class="column-1">        
        <div class="user_details column">
            <a href="<?php echo $userLoggedIn ?>"><img src="<?php echo $user['profile_pic']; ?>" alt="profile_pic"></a>

            <div class="user_details_wrap">
                <a href="<?php echo $userLoggedIn ?>"><?php echo $user['first_name'] . " " . $user['last_name']; ?></a>
                <br>
                <?php echo "Posts: " . $user['num_posts'] . "<br>"; 
                    echo "Likes: " .$user['num_likes'];
                ?>
            </div>
        </div>
    </div>

    <div class="column-2 column">
            <form action="index.php" class="post_form column" method="POST">
                <textarea name="post_text" id="post_text" placeholder="Got something to say?"></textarea>
                <input type="submit" name="post" id="post_button" value="Post" class="btn-lg btn-primary">
                <br>
            </form>
        </div>
    </div>  



        <!-- end wrapper -->
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>