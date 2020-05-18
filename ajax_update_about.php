<?php
include "config.php";
include "User.php";
include "Post.php";
if(isset($_POST['post_body'])) {
//    $post = new Post($con, $_REQUEST['userLogin']);
//    $post->loadProfilePosts($_REQUEST);
    $user = new User($con, $_POST['user_from']);
    $user->updateAbout($_POST['post_body']);
}