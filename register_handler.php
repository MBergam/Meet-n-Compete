
<?php
require 'config.php';
$fname = "";
$lname="";
$email="";
$username="";
$password="";
$password2="";
$date = "";
$error_array = array();

if(isset($_POST['register_button'])){

    $fname = strip_tags($_POST['reg_fname']);//remove html tags
    $fname = str_replace(' ','',$fname); //remove spaces
    $fname = ucfirst(strtolower($fname));
    $_SESSION['reg_fname'] = $fname;

    $lname = strip_tags($_POST['reg_lname']);//remove html tags
    $lname = str_replace(' ','',$lname); //remove spaces
    $lname = ucfirst(strtolower($lname));
    $_SESSION['reg_lname'] = $lname;

    $email = strip_tags($_POST['reg_email']);//remove html tags
    $email = str_replace(' ','',$email); //remove spaces
    $_SESSION['reg_email'] = $email;

    $username = strip_tags($_POST['reg_username']);
    $username = str_replace(' ', '',$username);
    $_SESSION['reg_username'] = $username;

    $password = strip_tags($_POST['reg_pass']);//remove html tags
    $_SESSION['reg_pass'] = $password;
    $password2 = strip_tags($_POST['reg_pass2']);//remove html tags
    $_SESSION['reg_pass2'] = $password2;

    $date = date("Y-m-d");

    checkValidation($con, $fname, $lname, $username,$password,$password2,$email);

    if(empty($error_array)){
        $password = md5($password); //encrypt the password before sending to database

        $query = mysqli_query($con,"insert into users values ('', '$fname', '$lname', '$username', '$email', '$password', '$date', '', '0', '0', 'no', ',')");

        array_push($error_array, "<span style='color: #14C800'>Welcome friend! You have successfully created an account with us!");

        $_SESSION['reg_fname'] = " ";
        $_SESSION['reg_lname'] = " ";
        $_SESSION['reg_email'] = " ";
        $_SESSION['reg_username'] = " ";

    }

}

function checkValidation(mysqli $con, $fname, $lname, $username, $password, $password2,$email){
    global $error_array;
    if($password == $password2){

        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $email = filter_var($email,FILTER_VALIDATE_EMAIL);
            $email_check = mysqli_query($con, "select email from users where email = '$email'");
            $check_num_rows = mysqli_num_rows($email_check);
            if($check_num_rows > 0){
                array_push($error_array,"Email already used<br>");
            }
        }

        else{
            array_push($error_array,"invalid format<br>") ;
        }

    }

    else{
        array_push($error_array,"passwords don't match<br>");
    }

    //check username
    $username_check = mysqli_query($con, "select user_name from users where user_name = '$username'");
    $check_num_rows = mysqli_num_rows($username_check);
    if($check_num_rows > 0){
        array_push($error_array,"Username already used<br>");
    }


    if(strlen($fname) > 25 || strlen($fname ) < 2){
        array_push($error_array, "invalid inputs, first name should contain between 2-25 characters<br>");
    }

    if(strlen($lname) > 25 || strlen($lname ) < 2){
        array_push($error_array, "invalid inputs, last name should contain between 2-25 characters<br>");
    }


    if(strlen($password) >= 30 || strlen($password) < 5){
        array_push($error_array, "your password must have at least 6 characters and at most 30<br>");
    }
}

$con->close();
