<?php

class User{
    private $user;
    private $con;

    public function __construct($con, $user)
    {
        $this->con = $con;
        $user_details_query = mysqli_query($con, "select * from users where user_name = '$user'");
        $this->user = mysqli_fetch_array($user_details_query);
    }

    public function getFullName(){
        $username = $this->user['user_name'];
        $query = mysqli_query($this->con, "select first_name, last_name from users where user_name = '$username'");
        $row = mysqli_fetch_array($query);
        return $row['first_name'] . " " . $row['last_name'];
    }

    public function getUsername(){
        return$this->user['user_name'];
    }

    public function getNumPosts(){
        $username = $this->user['user_name'];
        $query = mysqli_query($this->con, "select num_posts from users where user_name = '$username'");
        $row = mysqli_fetch_array($query);
        return $row['num_posts'];
    }
    public function getNumberOfFriendRequests(){
        $username = $this->user['user_name'];
        $query = mysqli_query($this->con, "select * from friend_requests where user_to = '$username'");
        return mysqli_num_rows($query);
    }

    public function isClosed(){
        $username = $this->user['user_name'];
        $query = mysqli_query($this->con, "select user_closed from users where user_name = '$username'");
        $row = mysqli_fetch_array($query);

        if($row['user_closed'] == "yes"){
            return true;
        }
        else{
            return false;
        }

    }

    public function isFriend($username_to_check){
        $usernameComma = "," . $username_to_check . ",";


        if(strstr($this->user['friend_array'], $usernameComma) || $username_to_check == $this->user['user_name']){
            return true;
        }
        else
            return false;
    }

    public function getProfilePicture(){
        $username = $this->user['user_name'];
        $query = mysqli_query($this->con, "select profile_picture from users where user_name = '$username'");
        $row = mysqli_fetch_array($query);
        return $row['profile_picture'];
    }

    public function getFriendArray(){
        $username = $this->user['user_name'];
        $query = mysqli_query($this->con, "select friend_array from users where user_name = '$username'");
        $row = mysqli_fetch_array($query);
        return $row['friend_array'];
    }

    public function didReceiveRequest($user_from){
        $user_to = $this->user['user_name'];
        $check_request_query = mysqli_query($this->con,"select * from friend_requests where user_to = '$user_to' and user_from = '$user_from'");
        if(mysqli_num_rows($check_request_query) > 0){
            return true;
        }
        else return false;
    }

    public function didSendRequest($user_to){
        $user_from = $this->user['user_name'];
        $check_request_query = mysqli_query($this->con,"select * from friend_requests where user_to = '$user_to' and user_from = '$user_from'");
        if(mysqli_num_rows($check_request_query) > 0){
            return true;
        }
        else return false;
    }

    public function removeFriend($user_to_remove){
        $logged_in_user = $this->user['user_name'];

        $query = mysqli_query($this->con, "select friend_array from users where user_name = '$user_to_remove'");
        $row = mysqli_fetch_array($query);

        $friend_array_username = $row['friend_array'];
        $new_friend_array = str_replace($user_to_remove .",","",$this->user['friend_array']);
        $remove_friend = mysqli_query($this->con, "update users set friend_array = '$new_friend_array' where user_name = '$logged_in_user'");

        $new_friend_array = str_replace($this->user['user_name'] .",","", $friend_array_username);
        $remove_friend = mysqli_query($this->con, "update users set friend_array = '$new_friend_array' where user_name = '$user_to_remove'");


    }

    public function sendRequest($user_to){
        $user_from = $this->user['user_name'];

        $query = mysqli_query($this->con,"insert into friend_requests values('', '$user_to', '$user_from')");
    }

    public function getMutualFriends($user_to_check){
        $mutualFriends = 0;
        $user_array = $this->user['friend_array'];
        $user_array_explode = explode(",", $user_array);

        $query = mysqli_query($this->con, "select friend_array from users where user_name = '$user_to_check'");
        $row = mysqli_fetch_array($query);
        $user_to_check_array = $row['friend_array'];
        $user_to_check_array_explode = explode(",", $user_to_check_array);

        foreach($user_array_explode as $i){
            foreach ($user_to_check_array_explode as $j){
                if($i == $j && $i != ""){
                    $mutualFriends++;
                }
            }
        }
        return $mutualFriends;

    }

    public function updateAbout($update_content){
        $username = $this->user['user_name'];
        $update_content = strip_tags($update_content);
        $check_about = mysqli_query($this->con, "select about_content from about where user_name = '$username'");
        $row = mysqli_num_rows($check_about);
        if($row == 0){
            $insert_query = mysqli_query($this->con, "insert into about values ('','$update_content', '$username')");
        }

        else {
            $update_about_query = mysqli_query($this->con, "update about set about_content='$update_content' where user_name='$username'");
        }
    }

    public function getAbout($user_to_get_about){
        $get_about_query = mysqli_query($this->con, "select about_content from about where user_name = '$user_to_get_about'");
        $row = mysqli_num_rows($get_about_query);
        if($row == 0){
            return '';
        }
        else{
            $about_content = mysqli_fetch_array($get_about_query);
            return $about_content['about_content'];
        }
   }


}
