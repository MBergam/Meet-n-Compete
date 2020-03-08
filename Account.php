<?php
include 'header.php'

?>
    <div class="account_wrapper">
    <div class="user_details flex-column">
        <a href="#" class="user_profile_image"> <img src="<?php echo $user['profile_picture'] ?>"></a>

        <div class="user_details_left_right">


        <a href="#">
        <?php
        echo "Hello, " . $user['first_name'] . " " . $user['last_name'] . "<br>";

        ?>
        </a>
        <br>
        <?php
        echo "Past Events: " . $user['past_events'] . "<br>";
        echo "Current Events: " . $user['current_events'];
        ?>
        </div>

    </div>

    </div>
    </body>
    </html>


<?php include 'footer.php'?>