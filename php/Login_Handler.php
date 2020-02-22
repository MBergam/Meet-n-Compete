<?php
if(isset($_POST['login_button'])){
    $username = $_POST['user_login'];
    $_SESSION['user_login'] = $username;
    $password = md5($_POST['password_login']);

//    $password = $_POST['password_login'];
    $check_database_query = mysqli_query($con,"select * from users where user_name = '$username' AND password = '$password'");

    $check_login_query = mysqli_num_rows($check_database_query);
    if($check_login_query == 1){
        $row = mysqli_fetch_array($check_database_query);
        $username = $row['user_name'];

        $user_closed_query = mysqli_query($con, "select * from users where user_name = '$username' and user_closed = 'yes'");
        if(mysqli_num_rows($user_closed_query) == 1){
            $reopen_account = mysqli_query($con, "update users set user_closed = 'no' where  user_name = '$username'");
        }

        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit();
    }
    else{
        array_push($error_array,"Username or password is incorrect<br>");
    }
}