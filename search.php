<?php
include 'header.php';

if(isset($_GET['q'])){
    $query = $_GET['q'];
}
else{
    $query = "";
}

if(isset($_GET['type'])){
    $type = $_GET['type'];
}
else{
    $type = "name";
}

?>


    <div class="main_column column" id="main_column">
        <?php
        if($query == "")
            echo "You must enter a name in the search box...";
        else{

            //If query contains an underscore, assume user us searching for usernames
            if($type == "username"){
                $userReturnedQuery = mysqli_query($con, "select * from users where user_name like '$query%' and user_closed = 'no' limit 8");
            }
            else{
                $names = explode(" ", $query);

                //first and last name search
                if (count($names) == 3){
                    $userReturnedQuery = mysqli_query($con, "select * from users where (first_name like '$names[0]%' and last_name like '$names[2]%') and user_closed = 'no'");
                }

                //one word then search for first or last name
                elseif (count($names) == 2){
                    $userReturnedQuery = mysqli_query($con, "select * from users where (first_name like '$names[0]%' and last_name like '$names[1]%') and user_closed = 'no'");
                }
                else
                    $userReturnedQuery = mysqli_query($con, "select * from users where (first_name like '$names[0]%' or last_name like '$names[0]%') and user_closed = 'no'");
            }

            //check if results were found
            if(mysqli_num_rows($userReturnedQuery) == 0)
                echo "Could not find anyone with a ". $type ." like: ". $query;
            else
                echo mysqli_num_rows($userReturnedQuery). " results found: <br> <br>";


            echo "<p id='grey'> Try searching for:</p>";
            echo "<a href='search.php?q=".$query."&type=name'> Names</a>, <a href='search.php?q=".$query."&type=username'> Username</a><br><br><hr id='search_hr'>";

//            $row = mysqli_fetch_array($userReturnedQuery);
//            echo $row['user_name'];
//            echo $user['user_name'];

            while ($row = mysqli_fetch_array($userReturnedQuery)){
                $user_obj = new User($con,$user['user_name']);

                $button = "";

                $mutual_friends = "";

                if($user['user_name'] != $row['user_name']){

                    //generate button depending on friendship status
                    if($user_obj->isFriend($row['user_name']))
                        $button = "<input type='submit' name='".$row['user_name']."' class='danger' value='Remove Friend'>";
                    elseif($user_obj->didReceiveRequest($row['user_name']))
                        $button = "<input type='submit' name='".$row['user_name']."' class='warning' value='Respond to request'>";
                    elseif ($user_obj->didSendRequest($row['user_name']))
                        $button = "<input type='submit' class='default' value='Request Sent'>";
                    else
                        $button = "<input type='submit' name='".$row['user_name']."' class='success' value='Add Friend'>";


                    $mutual_friends = $user_obj->getMutualFriends($row['user_name']). " friends in common";


                    //Button forms
                    if(isset($_POST[$row['user_name']])){
                        if($user_obj->isFriend($row['user_name'])){
                            $user_obj->removeFriend($row['user_name']);
                            header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
                        }
                        elseif ($user_obj->didReceiveRequest($row['user_name'])){
                            header("Location: requests.php");
                        }
                        elseif ($user_obj->didSendRequest($row['user_name'])){
                            //could be developed more but it's okay atm
                        }
                        else{
                            $user_obj->sendRequest($row['user_name']);
                            header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");

                        }
                    }

                }

                echo "<div class='search_result_php'> 
                        <div class='searchPageFriendButtons'>
                            <form action='' method='post'>
                                ".$button."
                                <br>
                            </form>
                        </div>
                        <div class='result_profile_pic'>
                            <a href='".$row['user_name']."'> <img src='".$row['profile_picture']."' style='height: 100px;'></a>    
                        </div>
                        
                        <a href='".$row['user_name']."'> ".$row['first_name']. " ".$row['last_name']."
                            <p id='grey'>".$row['user_name']."</p>
                        </a>
                        <br>
                        ".$mutual_friends."
                        <br>
                       </div>
                       <hr id='search_hr'>";
            }//end while loop

        }
        ?>

    </div>



<?php

include 'footer.php';