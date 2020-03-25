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
}
