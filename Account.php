<?php
include 'header.php';
include 'User.php';
include 'Post.php';

if(isset($_POST['post'])){
    $post = new Post($con,$userLogin);
    $post->submitPost($_POST['post_text'], 'none');
    header("Location: Account.php");
}

?>
    <div class="account_wrapper">
        <div class="user_details flex-column">
            <a href="<?php echo $userLogin; ?>" class="user_profile_image"> <img src="<?php echo $user['profile_picture'] ?>"></a>

            <div class="user_details_left_right">


                <a href=" <?php echo $userLogin; ?>">
                    <?php
                    echo "Hello, " . $user['first_name'] . " " . $user['last_name'] . "<br>";

                    ?>
                </a>
                <br>

                <?php
                echo "Number of Post(s): ". $user['num_posts'] . "<br>";
                echo "Past Events: " . $user['past_events'] . "<br>";
                echo "Current Events: " . $user['current_events'];
                ?>
            </div>

        </div>
        <div class="main_column_new_feed flex-column">
            <form class="post_form" action="Account.php" method="POST">
                <textarea name="post_text" id="post_text" placeholder="What are you thinking...? "></textarea>
                <input type="submit" name="post" id="post_button" value="Post">
                <hr>
            </form>

            <?php
                $user_obj = new User($con, $userLogin);
                echo $user_obj->getFullName();
            ?>


        </div>


    </div>
    </body>
    </html>


<?php include 'footer.php'?>