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

    public function getConversation(){
        $userLogin = $this->user_obj->getUsername();
        $return_string = "";
        $convos = array();

        $query = mysqli_query($this->con,"select user_to, user_from from messages where user_to = '$userLogin' or user_from = '$userLogin' order by id desc");

        while($row = mysqli_fetch_array($query)){
            $user_to_push = ($row['user_to'] != $userLogin)? $row['user_to']:$row['user_from'];

            if(!in_array($user_to_push,$convos)){
                array_push($convos,$user_to_push);
            }
        }

        foreach ($convos as $username){
            $user_found_obj = new User($this->con, $username);
            $latest_message_details = $this->getLatestMessage($userLogin,$username);
            $dots = (strlen($latest_message_details[1])>= 12)? "...":"";
            $split = str_split($latest_message_details[1], 12);
            $split = $split[0].$dots;

            $return_string .= "<a href='messages.php?u=$username'> 
                                    <div class='user_found_messages'>  
                                        <img src='".$user_found_obj->getProfilePicture()."' style='border-radius: 5px; margin-right: 5px;'>
                                        ".$user_found_obj->getFullName()."
                                        <span class='time_stamp_smaller' id='grey'>".$latest_message_details[2]."</span>
                                        <p id='grey' style='margin: 0;'>".$latest_message_details[0].$split."</p>
                                    </div>
                                    
                               </a>";
        }

        return $return_string;
    }

    private function getLatestMessage($userLogin, $user2){
        $details_array = array();
        $query = mysqli_query($this->con,"select body,date,user_to from messages where (user_to='$userLogin' and user_from = '$user2') or (user_to='$user2' and user_from = '$userLogin') order by id desc limit 1 ");
        $row = mysqli_fetch_array($query);

         //TODO: WILL UPDATE THE NAME THAT APPEARS FROM THE PARTNER LATER

        $sent_by = ($row['user_to']==$userLogin)? "$user2 said: " : "You said: ";
        //Timeframe

        $date_time_now = date("Y-m-d H:i:s");
        $start_date = new DateTime($row['date']);
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

        array_push($details_array,$sent_by);
        array_push($details_array,$row['body']);
        array_push($details_array,$time_message);

        return $details_array;
    }


}
?>