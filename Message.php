<?php
class Message
{
    private $user_obj;
    private $con;

    public function __construct($con, $user)
    {
        $this->con = $con;
        $this->user_obj = new User($con, $user);
    }

    public function getMostRecentUser(){
        $userLogin = $this->user_obj->getUsername();

        $query = mysqli_query($this->con, "select user_to, user_from from messages where user_to = '$userLogin' or user_from = '$userLogin' order by id desc limit 1");

        if(mysqli_num_rows($query) == 0){
            return false;
        }
        $row = mysqli_fetch_array($query);
        $user_to = $row['user_to'];
        $user_from = $row['user_from'];

        if($user_to != $userLogin){
            return $user_to;
        }

        else
            return $user_from;
    }

    public function sendMessage($user_to, $body, $date){

        if($body != ""){
            $userLogin = $this->user_obj->getUsername();
            $query = mysqli_query($this->con, "insert into messages values('', '$user_to','$userLogin', '$body', '$date', 'no', 'no', 'no')");
        }
    }

    public function getMessages($user_to){
        $userLogin = $this->user_obj->getUsername();
        $data = "";

        $query = mysqli_query($this->con, "update messages set opened = 'yes' where user_to = '$userLogin' and user_from = '$user_to'");

        $get_messages_query = mysqli_query($this->con, "select * from messages where (user_to = '$userLogin' and user_from = '$user_to') or (user_from = '$userLogin' and user_to = '$user_to')");

        while ($row = mysqli_fetch_array($get_messages_query)){
            $user_to = $row['user_to'];
            $user_from = $row['user_from'];
            $body = $row['body'];

            $div_top = ($user_to == $userLogin) ? "<div class='message' id='green'>":"<div class='message' id='blue'>";
            $data = $data.$div_top.$body."</div><br><br>";
        }

        return $data;

    }


}
?>