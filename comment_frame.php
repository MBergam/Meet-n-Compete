
<?php
session_start();
include 'config.php';
include 'User.php';
include 'Post.php';
include 'Notification.php';

$user = "";
$userLogin = "";
//THIS IS FOR LOGIN CHECK-KHANH's CODE
if(isset($_SESSION['username'])){
    $userLogin = $_SESSION['username'];
    $user_detail_query = mysqli_query($con, "select * from users where user_name = '$userLogin'");
    $user = mysqli_fetch_array($user_detail_query);
    $logged_in_bool  = true;

//    echo $userLogin." this is the username";
}
else{
    header("Location: register.php");
}
//END OF LOGIN CHECK
?>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>

<style type="text/css">*{
        font-size: 12px;
        font-family: Arial, Helvetica ,SansSerif;
    }</style>



<script>
    function toggle() {
        var element = document.getElementById("comment_section");
        if(element.style.display == "block"){
            element.style.display = "none";
        }

        else {
            element.style.display = "block";
        }
    }
</script>
<?php
//Get id of post
if(isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];
}

$user_query = mysqli_query($con, "SELECT added_by, user_to FROM posts WHERE id='$post_id'");
$row = mysqli_fetch_array($user_query);

$posted_to = $row['added_by'];
$user_to = $row['user_to'];

if(isset($_POST['postComment'.$post_id])) {
    $post_body = $_POST['post_body'];
    $post_body = mysqli_escape_string($con, $post_body);
    $date_time_now = date("Y-m-d H:i:s");
    $insert_post = mysqli_query($con, "INSERT INTO comments VALUES ('', '$post_body', '$userLogin', '$posted_to', '$date_time_now', 'no', '$post_id')");
    if($posted_to != $userLogin){
        $notification = new Notification($con, $userLogin);
        $notification->insertNotification($post_id, $posted_to, "comment");
    }
    if ($user_to != 'none' && $user_to != $userLogin){
        $notification = new Notification($con, $userLogin);
        $notification->insertNotification($post_id, $user_to, "profile_comment");
    }

    //Getting everyone that involved to the post and send them into the array. Then send notification to each person
    $get_commenters = mysqli_query($con, "select * from comments where post_id = '$post_id'");
    $notified_user = array();
    while ($row = mysqli_fetch_array($get_commenters)){
        if($row['posted_by'] != $posted_to && $row['posted_by']  != $user_to && $row['posted_by'] != $userLogin && !in_array($row['posted_by'], $notified_user)){
            $notification = new Notification($con, $userLogin);
            $notification->insertNotification($post_id, $row['posted_by'], "comment_non_owner");

            array_push($notified_user,$row['posted_by']);

        }
    }


    echo "<p>Comment Posted! </p>";

}

?>

<form action="comment_frame.php?post_id=<?php echo $post_id; ?>" id="comment_form" name="postComment<?php echo $post_id; ?>" method="POST">
    <textarea name="post_body" placeholder="Comment..."></textarea>
    <input type="submit" name="postComment<?php echo $post_id; ?>" value="Post">
</form>


<?php
    $get_comment = mysqli_query($con, "select * from comments where post_id = '$post_id' order by id asc");
    $count = mysqli_num_rows($get_comment);

    if($count != 0){
        while ($comment = mysqli_fetch_array($get_comment)){
            $comment_body = $comment['post_body'];
            $posted_to = $comment['posted_to'];
            $posted_by = $comment['posted_by'];
            $date_added = $comment['date_added'];
            $remove = $comment['removed'];

            $date_time_now = date("Y-m-d H:i:s");
            $start_date = new DateTime($date_added);
            $end_date = new DateTime($date_time_now);
            $interval = $start_date->diff($end_date);

            if($interval->y >= 1){
                if($interval == 1){
                    $time_message = $interval->y . "year ago";
                }

                else
                    $time_message = $interval->y . "year ago";
            }

            elseif($interval->m >= 1){
                if($interval -> d == 0){
                    $days = "ago";
                }

                elseif ($interval->d == 1){
                    $days = $interval ->d . " day ago";
                }

                else{
                    $days = $interval->d. " days ago";
                }

                if($interval->m == 1){
                    $time_message = $interval->m . " month". $days;
                }

                else{
                    $time_message = $interval->m . " months". $days;
                }
            }

            elseif ($interval->d >= 1){
                if ($interval->d == 1){
                    $time_message = "Yesterday";
                }

                else{
                    $time_message = $interval->d. " days ago";
                }
            }

            elseif($interval->h >= 1){
                if ($interval->h == 1){
                    $time_message = $interval ->h . " hour ago";
                }

                else{
                    $time_message = $interval->h. " hours ago";
                }
            }

            elseif($interval->i >= 1){
                if ($interval->i == 1){
                    $time_message = $interval ->i . " minute ago";
                }

                else{
                    $time_message = $interval->i. " minutes ago";
                }
            }
            else{
                if ($interval->s < 30){
                    $time_message =" just now";
                }

                else{
                    $time_message = $interval->s. " seconds ago";
                }
            }

            $user_obj = new User($con,$posted_by);

            ?>
            <div class="comment_section">
                <a href="<?php echo $posted_by;?>" target="_parent"> <img src="<?php echo $user_obj->getProfilePicture();?>" title="<?php echo $posted_by;?>" style="float: left;" height="30"></a>
                <a href="<?php echo $posted_by;?>"target="_parent" > <b> <?php echo $user_obj->getFullName(); ?></b></a>
                &nbsp;&nbsp;&nbsp; <?php echo $time_message . "<br>" . $comment_body;?>
                <hr>
            </div>

            <?php

        }

    }

    else{
        echo "<center> <br>No comments to show... </center>";
    }
?>

</body>
</html>