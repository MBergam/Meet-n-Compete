<?php
    include "config.php";
    include "User.php";
    include "Post.php";

    $limit = 5; //number of posts to be loaded per call

    $post = new Post($con,$_REQUEST['userLogin']);
    $post->loadPostFriend($_REQUEST,$limit);
?>