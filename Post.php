<?php
class Post{
    private $user_obj;
    private $con;

    public function __construct($con, $user)
    {
        $this->con = $con;
        $this->user_obj = new User($con,$user);
    }



    public function submitPost($body, $user_to){
        $body = strip_tags($body); //remove HTML tags
        $body = mysqli_real_escape_string($this->con, $body);
        $body = str_replace("\r\n", "\n",$body);
        $body = nl2br($body);

        $check_empty = preg_replace('/\s+/', '',$body); //Delete all spaces

        //Check if users submitting an empty post
        if($check_empty!= ""){

            //Current date and time
            $date_added = date("Y-m-d H:i:s");

            //Get username
            $added_by = $this->user_obj->getUsername();

            //If posting on their own profile page, then set the $user_to none
            if($user_to == $added_by){
                $user_to = "none";
            }

            //insert post
            $query = mysqli_query($this->con, "insert into posts values ('', '$body', '$added_by', '$user_to', 
                                    '$date_added', 'no', 'no', 0)");

            $returned_id = mysqli_insert_id($this->con);

            //insert notification
            if($user_to != 'none'){
                $notification = new Notification($this->con, $added_by);
                $notification->insertNotification($returned_id, $user_to, "profile_post");
            }
            //update post count for user
            $num_posts = $this->user_obj->getNumPosts();
            $num_posts++;
            $update_query = mysqli_query($this->con, "update users set num_posts = '$num_posts' where user_name = '$added_by'");
        }


    }

    public function loadPostFriend($data, $limit){

        $page = $data['page'];
        $userLogin = $this->user_obj->getUsername();

        if($page == 1){
            $start = 0;
        }

        else{
            $start = ($page - 1) * $limit;
        }

        $str = "";
        $data_query = mysqli_query($this->con, "select * from posts where deleted = 'no' order by id desc");

        if(mysqli_num_rows($data_query) > 0){

            $num_iteration = 0;//Number of results check
            $count = 1;

            while ($row = mysqli_fetch_array($data_query)){
                $id = $row['id'];
                $body = $row['body'];
                $added_by = $row['added_by'];
                $date_time = $row['date_added'];

                //prepare user_to string so it can be included even if no posted to a user
                if($row['user_to'] == "none"){
                    $user_to = "";
                }
                else{
                    $user_to_object = new User($this->con, $row['user_to']);
                    $user_to_name = $user_to_object->getFullName();
                    $user_to = "to <a href='" . $row['user_to'] ."'>" . $user_to_name . "</a>";
                }
                $added_by_obj = new User($this->con, $added_by);
                if( $added_by_obj -> isClosed()){
                    continue;
                }


                $user_logged_obj = new User($this->con, $userLogin);
                if($user_logged_obj->isFriend($added_by)){

                    if($num_iteration++ < $start){
                        continue;
                    }

                    //Once 10 posts have been loaded,break

                    if($count > $limit)
                        break;

                    else
                        $count++;

                    if($userLogin == $added_by){
                        $delete_button = "<button class='delete_button btn-danger' id='post$id'>X</button>";
                    }
                    else
                        $delete_button = "";

                    $user_details_query = mysqli_query($this->con, "select first_name, last_name, profile_picture from users 
                                                where user_name = '$added_by'");
                    $user_row = mysqli_fetch_array($user_details_query);
                    $first_name = $user_row['first_name'];
                    $last_name = $user_row['last_name'];
                    $profile_picture = $user_row['profile_picture'];


                    ?>
                    <script>
                        function toggle<?php echo $id; ?>() {
                            var target = $(event.target);
                            if(!target.is("a")){
                                var element = document.getElementById("toggleComment<?php echo $id;?>");
                                if(element.style.display == "block"){
                                    element.style.display = "none";
                                }

                                else {
                                    element.style.display = "block";
                                }
                            }
                        }
                    </script>

                    <?php

                    $comments_check = mysqli_query($this->con, "select * from comments where post_id = '$id'");

                    $comments_check_num = mysqli_num_rows($comments_check);

                    //Timeframe

                    $date_time_now = date("Y-m-d H:i:s");
                    $start_date = new DateTime($date_time);
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

                    $str .= "<div class = 'status_post' onClick=javascript:toggle$id()>
                        <div class = 'post_profile_pic'>
                            <img src = '$profile_picture' width='75' >
                            </div>
                        <div class='posted_by' style='color: #ACACAC;'>
                            <a href='$added_by'> $first_name $last_name </a> 
                            $user_to &nbsp;&nbsp;
                            was posted $time_message
                            $delete_button
                            
                            
                        </div>
                        
                        <div id='post_body'>
                        $body
                        <br>
                        <br>
                        <br>
                        </div>
                        
                        <div class='newsfeedPostOption'>
                            Comments($comments_check_num)&nbsp;&nbsp;&nbsp;
                            <iframe src='like.php?post_id=$id' scrolling='no'> </iframe>
                        
                        </div>
                        
                        <div class='post_comment' id='toggleComment$id' style='display: none;'> 
                        
                          <iframe src='comment_frame.php?post_id=$id' id='comment_iframe' frameborder='0'></iframe>
                        </div>
                        
                        
                      </div><hr>";
                }

                ?>
                <script>
                    $(document).ready(function () {


                        $('#post<?php echo $id; ?>').on('click',function () {
                            bootbox.confirm("are you sure to delete this post?", function (result) {
                                $.post("delete_post.php?post_id=<?php echo $id;?>",{result:result});
                                if(result)
                                    location.reload();

                            });
                        });
                    });
                </script>

                <?php
            }

            if($count > $limit){
                $str .= "<input type='hidden' class='nextPage' value='" . ($page + 1) . "'>
							<input type='hidden' class='noMorePosts' value='false'>";
            }
            else{
                $str .= "<input type='hidden' class='noMorePosts' value='true'><p style='text-align: center;'> No more posts to show! </p>";
            }
        }

        echo $str;
    }


    public function loadProfilePosts($data, $limit){

        $page = $data['page'];
        $profileUser = $data['profileUsername'];
        $userLogin = $this->user_obj->getUsername();

        if($page == 1){
            $start = 0;
        }

        else{
            $start = ($page - 1) * $limit;
        }

        $str = "";
        $data_query = mysqli_query($this->con, "select * from posts where deleted = 'no' and ((added_by='$profileUser' and user_to='none') or user_to='$profileUser') order by id desc");

        if(mysqli_num_rows($data_query) > 0){

            $num_iteration = 0;//Number of results check
            $count = 1;

            while ($row = mysqli_fetch_array($data_query)){
                $id = $row['id'];
                $body = $row['body'];
                $added_by = $row['added_by'];
                $date_time = $row['date_added'];





                if($num_iteration++ < $start){
                    continue;
                }

                //Once 10 posts have been loaded,break

                if($count > $limit)
                    break;

                else
                    $count++;

                if($userLogin == $added_by){
                    $delete_button = "<button class='delete_button btn-danger' id='post$id'>X</button>";
                }
                else
                    $delete_button = "";

                $user_details_query = mysqli_query($this->con, "select first_name, last_name, profile_picture from users 
                                                where user_name = '$added_by'");
                $user_row = mysqli_fetch_array($user_details_query);
                $first_name = $user_row['first_name'];
                $last_name = $user_row['last_name'];
                $profile_picture = $user_row['profile_picture'];


                ?>
                <script>
                    function toggle<?php echo $id; ?>() {
                        var target = $(event.target);
                        if(!target.is("a")){
                            var element = document.getElementById("toggleComment<?php echo $id;?>");
                            if(element.style.display == "block"){
                                element.style.display = "none";
                            }

                            else {
                                element.style.display = "block";
                            }
                        }
                    }
                </script>

                <?php

                $comments_check = mysqli_query($this->con, "select * from comments where post_id = '$id'");

                $comments_check_num = mysqli_num_rows($comments_check);

                //Timeframe

                $date_time_now = date("Y-m-d H:i:s");
                $start_date = new DateTime($date_time);
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

                $str .= "<div class = 'status_post' onClick=javascript:toggle$id()>
                        <div class = 'post_profile_pic'>
                            <img src = '$profile_picture' width='75' >
                            </div>
                        <div class='posted_by' style='color: #ACACAC;'>
                            <a href='$added_by'> $first_name $last_name </a> 
                             &nbsp;&nbsp;
                            was posted $time_message
                            $delete_button
                            
                            
                        </div>
                        
                        <div id='post_body'>
                        $body
                        <br>
                        <br>
                        <br>
                        </div>
                        
                        <div class='newsfeedPostOption'>
                            Comments($comments_check_num)&nbsp;&nbsp;&nbsp;
                            <iframe src='like.php?post_id=$id' scrolling='no'> </iframe>
                        
                        </div>
                        
                        <div class='post_comment' id='toggleComment$id' style='display: none;'> 
                        
                          <iframe src='comment_frame.php?post_id=$id' id='comment_iframe' frameborder='0'></iframe>
                        </div>
                        
                        
                      </div><hr>";


                ?>
                <script>
                    $(document).ready(function () {


                        $('#post<?php echo $id; ?>').on('click',function () {
                            bootbox.confirm("are you sure to delete this post?", function (result) {
                                $.post("delete_post.php?post_id=<?php echo $id;?>",{result:result});
                                if(result)
                                    location.reload();

                            });
                        });
                    });
                </script>

                <?php
            }

            if($count > $limit){
                $str .= "<input type='hidden' class='nextPage' value='" . ($page + 1) . "'>
							<input type='hidden' class='noMorePosts' value='false'>";
            }
            else{
                $str .= "<input type='hidden' class='noMorePosts' value='true'><p style='text-align: center;'> No more posts to show! </p>";
            }
        }

        echo $str;
    }

    public function getSinglePost($post_id){
        $userLogin = $this->user_obj->getUsername();

        //update opened query
        $opened_query = mysqli_query($this->con, "update notifications set opened = 'yes' where user_to = '$userLogin' and link like '%=$post_id'");

        $str = "";
        $data_query = mysqli_query($this->con, "select * from posts where deleted = 'no' and id = '$post_id'");

        if(mysqli_num_rows($data_query) > 0){


            $row = mysqli_fetch_array($data_query);
            $id = $row['id'];
            $body = $row['body'];
            $added_by = $row['added_by'];
            $date_time = $row['date_added'];

            //prepare user_to string so it can be included even if no posted to a user
            if($row['user_to'] == "none"){
                $user_to = "";
            }
            else{
                $user_to_object = new User($this->con, $row['user_to']);
                $user_to_name = $user_to_object->getFullName();
                $user_to = "to <a href='" . $row['user_to'] ."'>" . $user_to_name . "</a>";
            }
            $added_by_obj = new User($this->con, $added_by);
            if( $added_by_obj -> isClosed()){
                return;
            }


            $user_logged_obj = new User($this->con, $userLogin);
            if($user_logged_obj->isFriend($added_by)){

                if($userLogin == $added_by){
                    $delete_button = "<button class='delete_button btn-danger' id='post$id'>X</button>";
                }
                else
                    $delete_button = "";

                $user_details_query = mysqli_query($this->con, "select first_name, last_name, profile_picture from users 
                                                where user_name = '$added_by'");
                $user_row = mysqli_fetch_array($user_details_query);
                $first_name = $user_row['first_name'];
                $last_name = $user_row['last_name'];
                $profile_picture = $user_row['profile_picture'];


                ?>
                <script>
                    function toggle<?php echo $id; ?>() {
                        var target = $(event.target);
                        if(!target.is("a")){
                            var element = document.getElementById("toggleComment<?php echo $id;?>");
                            if(element.style.display == "block"){
                                element.style.display = "none";
                            }

                            else {
                                element.style.display = "block";
                            }
                        }
                    }
                </script>

                <?php

                $comments_check = mysqli_query($this->con, "select * from comments where post_id = '$id'");

                $comments_check_num = mysqli_num_rows($comments_check);

                //Timeframe

                $date_time_now = date("Y-m-d H:i:s");
                $start_date = new DateTime($date_time);
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

                $str .= "<div class = 'status_post' onClick=javascript:toggle$id()>
                        <div class = 'post_profile_pic'>
                            <img src = '$profile_picture' width='75' >
                            </div>
                        <div class='posted_by' style='color: #ACACAC;'>
                            <a href='$added_by'> $first_name $last_name </a> 
                            $user_to &nbsp;&nbsp;
                            was posted $time_message
                            $delete_button
                            
                            
                        </div>
                        
                        <div id='post_body'>
                        $body
                        <br>
                        <br>
                        <br>
                        </div>
                        
                        <div class='newsfeedPostOption'>
                            Comments($comments_check_num)&nbsp;&nbsp;&nbsp;
                            <iframe src='like.php?post_id=$id' scrolling='no'> </iframe>
                        
                        </div>
                        
                        <div class='post_comment' id='toggleComment$id' style='display: none;'> 
                        
                          <iframe src='comment_frame.php?post_id=$id' id='comment_iframe' frameborder='0'></iframe>
                        </div>
                        
                        
                      </div><hr>";


            ?>
            <script>
                $(document).ready(function () {


                    $('#post<?php echo $id; ?>').on('click',function () {
                        bootbox.confirm("are you sure to delete this post?", function (result) {
                            $.post("delete_post.php?post_id=<?php echo $id;?>",{result:result});
                            if(result)
                                location.reload();

                        });
                    });
                });
            </script>
            <?php
            }

            else{
                echo "Please make friends with this post's owner to see the content of the post";
                return;
            }
        }
        else{
            echo "<p>Invalid page! No posts were found!</p>";
            return;
        }

        echo $str;
    }
}
?>