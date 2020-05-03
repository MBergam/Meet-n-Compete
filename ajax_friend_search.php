<?php
include 'config.php';
include 'User.php';

$query = $_POST['query'];
$userLogin = $_POST['userLogin'];

$name = explode(" ", $query);

if(strpos($query,"_") !== false){
    $userReturned = mysqli_query($con,"select * from users where user_name like '$query%' and user_closed ='no' limit 8");
}

elseif (count($name)== 2){
    $userReturned = mysqli_query($con, "select * from users where (first_name like '%$name[0]%' and last_name like '%$name[1]%') and user_closed = 'no' limit 8");
}

else{
    $userReturned = mysqli_query($con, "select * from users where (first_name like '%$name[0]%' or last_name like '%$name[0]%') and user_closed = 'no' limit 8");
}

if($query != ""){
    while ($row = mysqli_fetch_array($userReturned)){
        $user = new User($con, $userLogin);

        if($row['user_name'] != $userLogin){
            $mutual_friends = $user->getMutualFriends($row['user_name'])." friends in common";
        }
        else{
            $mutual_friends = "";
        }

        if($user->isFriend($row['user_name'])){
            echo "<div class='resultDisplay'>
                    <a href='messages.php?u=".$row['user_name']."' style='color: #000'>
                        <div class='liveSearchProfilePic'>
                            <img src='".$row['profile_picture']."'>
                        </div>
                        <div class='liveSearchText'>
                            ".$row['first_name']." ".$row['last_name']."
                            <p style='margin: 0'>".$row['user_name']."</p>
                            <p id='grey' style='margin-bottom: 5px'>".$mutual_friends."</p>
                        </div>
                    </a>
                    </div>";
        }
    }
}