<?php
include "config.php";
include "User.php";

$query = $_POST['query'];
$userLogin = $_POST['userLogin'];

$names = explode(" ", $query);

//If query contains an underscore, assume user us searching for usernames
if(strpos($query,'_') !== false){
    $userReturnedQuery = mysqli_query($con, "select * from users where user_name like '$query%' and user_closed = 'no' limit 8");
}
//first and last name search
elseif (count($names) == 2){
    $userReturnedQuery = mysqli_query($con, "select * from users where (first_name like '$names[0]%' and last_name like '$names[1]%') and user_closed = 'no' limit 8");
}

//one word then search for first or last name

else{
    $userReturnedQuery = mysqli_query($con, "select * from users where (first_name like '$names[0]%' or last_name like '$names[0]%') and user_closed = 'no' limit 8");

}