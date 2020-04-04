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

    public function updatePostCount(){

    }

    public function getNumPosts(){
        $username = $this->user['user_name'];
        $query = mysqli_query($this->con, "select num_posts from users where user_name = '$username'");
        $row = mysqli_fetch_array($query);
        return $row['num_posts'];
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
}
