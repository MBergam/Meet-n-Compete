<?php
include "header.php";

if(isset($_GET['id'])){
    $id = $_GET['id'];
}

else{
    $id = 0;
}

?>
<div class="user_details column">
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
        //                            echo "Past Events: " . $user['past_events'] . "<br>";
        //                            echo "Current Events: " . $user['current_events'];
        ?>
    </div>
</div>

<div class="main_column column" id="main_column">
    <div class="post_area">
        <?php
            $post = new Post($con, $userLogin);
            $post->getSinglePost($id);
        ?>

    </div>

</div>



<?php
include "footer.php";