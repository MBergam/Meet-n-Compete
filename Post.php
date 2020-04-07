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
                    $user_to = "to <a href=''". $row['user_to']."'".$user_to_name . "</a>";
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

                    $user_details_query = mysqli_query($this->con, "select first_name, last_name, profile_picture from users 
                                                where user_name = '$added_by'");
                    $user_row = mysqli_fetch_array($user_details_query);
                    $firs_name = $user_row['first_name'];
                    $last_name = $user_row['last_name'];
                    $profile_picture = $user_row['profile_picture'];



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

                    $str .= "<div class = 'status_post'>
                        <div class = 'post_profile_pic'>
                            <img src = '$profile_picture' width='75' >
                            </div>
                        <div class='posted_by' style='color: #ACACAC;'>
                            <a href='$added_by'> $firs_name $last_name </a> $user_to &nbsp;&nbsp;&nbsp;&nbsp;
                            posted $time_message   
                        </div>
                        
                        <div id='post_body'>
                        $body
                        <br>
                        </div>
                        
                        
                      </div><hr>";
                }
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
}
