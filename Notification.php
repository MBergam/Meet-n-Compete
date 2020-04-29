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
}