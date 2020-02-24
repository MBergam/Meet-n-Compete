<?php
require 'config.php';
require 'register_handler.php';
require 'Login_Handler.php';
require 'header.php';

?>


<html>
<head>
    <title>
        PHP register
    </title>
    <link rel="stylesheet" type="text/css" href="register_style.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="./js/register.js"></script>

</head>

<body>

<?php
    if(isset($_POST['register_button'])){
        echo '<script>
            $(document).ready(function() {
               $(".login_form").hide();
               $(".signup_form").show();
            });
    </script>';
    }
?>

<div class="wrapper">

    <div class="login_box">
        <div class="login_header">
            <h1>Welcome to M-n-C</h1>
            Login or sign up below

        </div>
        <br>
        <div class="login_form">
            <form action="register.php" method="post">
                <input type="text" name="user_login" placeholder="Username" value =
                "<?php
                if(isset($_SESSION['login_username'])){
                    echo $_SESSION['login_username'];
                } ?>" required>
                <input type="password" name="password_login" placeholder="Password">
                <br>
                <input type="submit" name="login_button" value="Login" >
                <br>
                <?php
                if(in_array("Username or password is incorrect<br>",$error_array)){
                    echo "Username or password is incorrect<br>";
                }
                ?>
                <a href="#" id="signup" class="signup">Need an account? Click here</a>
                <br>
            </form>
        </div>
        <div class="signup_form">
            <form action="register.php" method="POST">
                <input type="text" name="reg_fname" placeholder="First Name" value =
                "<?php
                if(isset($_SESSION['reg_fname'])){
                    echo $_SESSION['reg_fname'];
                } ?>" required>
                <br>
                <?php
                if(in_array("invalid inputs, first name should contain between 2-25 characters<br>",$error_array)){
                    echo "invalid inputs, name should contain between 2-25 characters<br>";
                }
                ?>

                <input type="text" name="reg_lname" placeholder="Last Name" value =
                "<?php
                if(isset($_SESSION['reg_lname'])){
                    echo $_SESSION['reg_lname'];
                } ?>" required>
                <br>
                <?php
                if(in_array("invalid inputs, last name should contain between 2-25 characters<br>",$error_array)){
                    echo "invalid inputs, name should contain between 2-25 characters<br>";
                }
                ?>

                <input type="email" name="reg_email" placeholder="Email" value =
                "<?php
                if(isset($_SESSION['reg_email'])){
                    echo $_SESSION['reg_email'];
                } ?>" required>
                <br>
                <?php
                if(in_array("Email already used<br>",$error_array)){
                    echo "Email already used<br>";
                }
                ?>


                <input type="text" name = "reg_username" placeholder="Username" value =
                "<?php
                if(isset($_SESSION['reg_username'])){
                    echo $_SESSION['reg_username'];
                } ?>" required>
                <br>
                <?php
                if(in_array("Username already used<br>", $error_array)){
                    echo "Username already used<br>";
                }
                ?>

                <input type="password" name="reg_pass" placeholder="Password" required>
                <br>
                <input type="password" name="reg_pass2" placeholder="Confirm Password" required>
                <br>

                <?php
                if (in_array("passwords don't match<br>",$error_array)){
                    echo "passwords don't match<br>";
                }
                else if(in_array("your password must have at least 6 characters and at most 30<br>",$error_array)){
                    echo "your password must have at least 6 characters and at most 30<br>";
                }
                ?>
                <input type="submit" name="register_button" value="Register" >
                <br>
                <?php
                if (in_array("<span style='color: #14C800'>Welcome friend! You have successfully created an account with us!",$error_array)){
                    echo "<span style='color: #14C800'>Welcome friend! You have successfully created an account with us!";
                }
                ?>
                <a href="#" id="signin" class="signin">Already have an account? Click here</a>

            </form>
        </div>

    </div>
</div>
</body>
</html>

<?php
require 'footer.php';
?>
