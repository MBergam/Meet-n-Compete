<?php
include 'header.php';

$message_obj = new Message($con,$userLogin);
if(isset($_GET['u'])){
    $user_to = $_GET['u'];
}
else{
    $user_to = $message_obj->getMostRecentUser();
    if($user_to == false)
        $user_to = 'new';
}

if($user_to!="new")
    $user_to_obj = new User($con, $user_to);

if(isset($_POST['post_message'])){
    if(isset($_POST['message_body'])){
        $body = mysqli_real_escape_string($con,$_POST['message_body']);
        $date = date("Y-m-d H:i:s");
        $message_obj->sendMessage($user_to, $body, $date);
    }
}

if(!$logged_in_bool){
    header("Location: register.php");
}

?>
<div class="row">
    <div class="col-lg-4">
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
                ?>
            </div>
        </div>
        <div class="user_details column" id="conversations">
            <h4>Conversations</h4>
            <div class="loaded_conversations">
                <?php
                echo $message_obj->getConversation();
                ?>
            </div>
            <br>
            <a href="messages.php?u=new">New Message</a>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="message_main_column column" id="main_column">
            <?php
            if($user_to!= "new"){
                echo "<h4> You and <a href='$user_to'>". $user_to_obj->getFullName()."</a></h4><hr><br>";
                echo "<div class='loaded_messages' id='scrollable'>";
                echo $message_obj->getMessages($user_to);
                echo"</div>";
            }
            else{
                echo "<h4>New Message</h4>";
            }
            ?>

            <div class="message_post">
                <form action="" method = "POST">
                    <?php
                    if($user_to == "new"){
                        echo "Select a friend you would like to message <br><br>";
                        ?> To: <input type='text' onkeyup='getUser(this.value, "<?php echo $userLogin;?>")' name='q' placeholder='search your friend' autocomplete='off' id='search_text_input'><?php
                        echo "<div class='results'></div>";
                    }
                    else{
                        echo "<textarea name='message_body' id='message_textarea' placeholder='your message here...'></textarea>";
                        echo "<input type='submit' name='post_message' class='info' id='message_submit' value='Send'>";
                    }
                    ?>

                </form>
            </div>

            <script>
                var div = document.getElementById("scrollable")
                div.scrollTop = div.scrollHeight;
            </script>

        </div>

    </div>

</div>