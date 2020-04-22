<html>
<head>
    <title></title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>

<style type="text/css">
    *{
        font-family: Arial, Helvetica, SansSerif;
    }
    body{
        background-color: #ffffff;
    }
    form{
        position: absolute;
        top: 0;
    }
</style>
<?php
session_start();
include 'config.php';
include 'User.php';
include 'Post.php';

$user = "";
$userLogin = "";
//THIS IS FOR LOGIN CHECK-KHANH's CODE
if(isset($_SESSION['username'])){
    $userLogin = $_SESSION['username'];
    $user_detail_query = mysqli_query($con, "select * from users where user_name = '$userLogin'");
    $user = mysqli_fetch_array($user_detail_query);
    $logged_in_bool  = true;
}
else{
    header("Location: register.php");
}
//END OF LOGIN CHECK

//Getting the current post id
if(isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];
}

$get_likes = mysqli_query($con, "select likes, added_by from posts where id = '$post_id'");
$row = mysqli_fetch_array($get_likes);
$total_likes = $row['likes'];
$user_liked = $row['added_by'];


//Like button
if(isset($_POST['like_button'])){
    $total_likes++;
    $query = mysqli_query($con, "update posts set likes='$total_likes' where id='$post_id'");
    $insert_user = mysqli_query($con, "insert into likes values ('','$userLogin','$post_id')");

    //insert notification


}


//Unlike button

if(isset($_POST['unlike_button'])){
    $total_likes--;
    $query = mysqli_query($con, "update posts set likes = '$total_likes' where id = '$post_id'");
    $insert_user = mysqli_query($con, "delete from likes where user_name = '$userLogin' and post_id = '$post_id'");
}


//check for previous likes
$check_query = mysqli_query($con, "select * from likes where user_name = '$userLogin' and post_id = $post_id");
$num_rows = mysqli_num_rows($check_query);

if($num_rows > 0){
    echo '<form action="like.php?post_id='. $post_id.'" method = "POST">
                <input type="submit" class="comment_like" name="unlike_button" value="Unlike">
            
                <div class="like_value">
                    '. $total_likes.' Likes
            
            
                </div>
            </form>
            ';
}
else{
    echo '<form action="like.php?post_id='. $post_id.'" method = "POST">
                <input type="submit" class="comment_like" name="like_button" value="Like">
            
                <div class="like_value">
                    '. $total_likes.' Likes
            
            
                </div>
            </form>
            ';
}


?>
</body>

</html>