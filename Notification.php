<?php
class Notification
{
    private $user_obj;
    private $con;

    public function __construct($con, $user)
    {
        $this->con = $con;
        $this->user_obj = new User($con, $user);
    }

    public function getUnreadNumber(){
        $userLogin = $this->user_obj->getUsername();
        $query = mysqli_query($this->con, "select * from notifications where viewed = 'no' and user_to = '$userLogin'");
        return mysqli_num_rows($query);
    }

    public function insertNotification($post_id, $user_to, $type){
        $userLogin = $this->user_obj->getUsername();
        $userLoginName = $this->user_obj->getFullName();

        $date_time = date("y-m-d H:i:s");

        switch ($type){
            case 'comment':
                $message = $userLoginName." commented on your post";
                break;

            case 'like':
                $message = $userLoginName." liked on your post";
                break;

            case 'profile_post':
                $message = $userLoginName." posted on your profile";
                break;

            case 'comment_non_owner':
                $message = $userLoginName." commented on a post you commented on";
                break;

            case 'profile_comment':
                $message = $userLoginName." commented on your profile post";
                break;
        }

        $link = "post_page.php?id=".$post_id;

        $insert_query = mysqli_query($this->con, "insert into notifications values('','$user_to','$userLogin', '$message', '$link' , '$date_time', 'no', 'no')");

    }

    public function getNotifications($data, $limit){
        $page = $data['page'];
        $userLogin = $this->user_obj->getUsername();
        $return_string = "";

        if($page==1){
            $start = 0;
        }

        else{
            $start = ($page -1) * $limit;
        }

        $set_viewed_query = mysqli_query($this->con, "update notifications set viewed = 'yes' where user_to = '$userLogin'");

        $query = mysqli_query($this->con,"select * from notifications where user_to = '$userLogin' order by id desc");

        if(mysqli_num_rows($query) == 0){
            echo "you have no notifications";
            return;
        }

        $num_iterations = 0; //number of messages checked
        $count = 1; //number of messages posted

        while($row = mysqli_fetch_array($query)){
            if($num_iterations++ < $start){
                continue;
            }

            if($count > $limit){
                break;
            }

            else $count++;

            $user_from = $row['user_from'];
            $user_data_query = mysqli_query($this->con, "select * from users where user_name = '$user_from'");
            $user_data = mysqli_fetch_array($user_data_query);

            //Timeframe

            $date_time_now = date("Y-m-d H:i:s");
            $start_date = new DateTime($row['datetime']);
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


            $opened = $row['opened'];
            $style = ($row['opened'] == 'no') ? "background-color: #DDEDFF;" : "";

            $return_string .= "<a href='".$row['link']."'> 
                                    <div class='resultDisplay resultDisplayNotification' style='".$style."'>
                                        <div class='notificationProfilePic'>
                                            <img src='".$user_data['profile_picture']."'>
                                        </div>
                                        <p class='time_stamp_smaller' id='grey'>".$time_message."</p>".$row['message']."
                                     </div>   
                               </a>";
        }
        //If posts were loaded
        if($count>$limit){
            $return_string .="<input type='hidden' class='nextPageDropdownData' value='".($page+1) ."'><input type='hidden' class='noMoreDropdownData' value='false'>";
        }
        else{
            $return_string .="<input type='hidden' class='noMoreDropdownData' value='true'><p style='text-align: center'>No more notifications to load</p>";
        }

        return $return_string;
    }
}