<?php
$password_message = "";
if(isset($_POST['update_details'])){
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];

    echo $_POST['first_name'];

    $email_check = mysqli_query($con, "select * from users where email = '$email'");
    $row = mysqli_fetch_array($email_check);

    $matched_user = $row['user_name'];
    if($matched_user == "" || $matched_user == $userLogin){
        $message = "Details Updated<br><br>";
        $query = mysqli_query($con,"update users set first_name = '$first_name', last_name = '$last_name', email = '$email' where user_name = '$userLogin'");
    }

    else{
        $message = "That email is already in use! <br><br>";
    }
}
else{
    $message = "";
}


//==========================================

if(isset($_POST['update_password'])){
    $old_password = strip_tags($_POST['old_password']);
    $new_password_1 = strip_tags($_POST['new_password_1']);
    $new_password_2 = strip_tags($_POST['new_password_2']);

    $password_query = mysqli_query($con, "select password from users where user_name = '$userLogin'");
    $row = mysqli_fetch_array($password_query);
    $db_password = $row['password'];

    if(md5($old_password)==$db_password){
        if($new_password_1 == $new_password_2){
            if(strlen($new_password_1)<=4){
                $password_message = "Sorry, your password must be greater than 4 characters<br><br>";
            }
            else{
                $new_password_md5 = md5($new_password_1);
                $password_query = mysqli_query($con,"update users set password = '$new_password_md5' where user_name = '$userLogin'");
                echo $new_password_md5."<br>";
                echo $userLogin;
                $password_message = "successfully changed your password<br><br>";
            }
        }
        else{
            $password_message = "Confirm password doesn't match! <br><br>";
        }
    }
    else{
        $password_message = "The old password is incorrect! <br><br>";
    }
}

else{
    $password_message = "";
}

if(isset($_POST['close_account'])){
    header("Location: close_account.php");
}