<html>
<head>
    <title></title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>

<?php
include 'config.php';
include 'User.php';
include 'Post.php';

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
?>

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
    //get id of post
if(isset($_GET['post_id'])){
    $post_id = $_GET['post_id'];
}
$user_query = mysqli_query($con, "select added_by, user_to from posts where id = '$post_id'");
$row = mysqli_fetch_array($user_query);


$posted_to = $row['added_by'];

?>

</body>
</html>