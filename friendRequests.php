<?php
include 'header.php';

?>

<div class="main_column column" id="main_column">

    <h4>Friends Requests</h4>
    <?php

        $query = mysqli_query($con, "select * from friend_requests where user_to = '$userLogin'");
        if(mysqli_num_rows($query) == 0){
            echo "You don't have any requests at this moment";
        }
        else{
            while($row = mysqli_fetch_array($query)){
                $user_from  = $row['user_from'];
                $user_from_obj = new User($con,$user_from);

                echo $user_from_obj->getFullName()." sent you a friend request!";

                $user_from_friend_array = $user_from_obj->getFriendArray();
                if(isset($_POST['accept_request'.$user_from])){
                    $add_friend_query = mysqli_query($con,"update users set friend_array = CONCAT(friend_array,'$user_from,') where user_name = '$userLogin'");
                    $add_friend_query = mysqli_query($con,"update users set friend_array = CONCAT(friend_array,'$userLogin,') where user_name = '$user_from'");

                    $delete_request = mysqli_query($con,"delete from friend_requests where user_to = '$userLogin' and user_from = '$user_from'");

                    echo "You are now friends!";
                    header("Location: friendRequests.php");

                }

                if(isset($_POST['ignore_request'.$user_from])){
                    $delete_request = mysqli_query($con,"delete from friend_requests where user_to = '$userLogin' and user_from = '$user_from'");

                    echo "Requests is ignored!";
                    header("Location: friendRequests.php");
                }

                ?>
                <form action="friendRequests.php" method="post">
                    <input type="submit" name="accept_request<?php echo $user_from;?>" id="accept_button" value="Accept">
                    <input type="submit" name="ignore_request<?php echo $user_from;?>" id="ignore_button" value="Ignore">
                </form>

                <?php
            }
        }

    ?>

</div>

<?php
include 'footer.php';