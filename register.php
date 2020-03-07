<?php
require 'config.php';
require 'register_handler.php';
require 'Login_Handler.php';
//require 'header.php';

?>


<html>
<head>
    <title>
        PHP register
    </title>
    <link rel="stylesheet" type="text/css" href="register_style.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="./js/register.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Meet-N-Compete</title>

    <link href="https://fonts.googleapis.com/css?family=Fjalla+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Rubik+Mono+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/normalize.css" />
    <link rel="stylesheet" href="css/hover-min.css" />
    <link rel="stylesheet" href="css/animate.min.css" />
    <link rel="stylesheet" href="css/vendor/fontawesome-free-5.12.0-web/css/all.min.css" />
    <link rel="stylesheet" href="style.css" />

    <script src="js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="js/vendor/jquery-3.3.1.min.js"></script>
    <script src="js/vendor/bootstrap.bundle.min.js"></script>
    <script src="js/vendor/parallax.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHoreTH9KWnvppgnaECTPBPkjosVlvGh8&libraries=places" async defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src = "life.js" async defer> </script>

</head>

<body>
<header>
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <a href=""><img id="logo" src="img/logo.png" alt=""></a>
            </div>
            <div class="col-sm-6">
                <div id="header-right" class="vertical-center">
                    <ul class = "nav-login">
<!--                        <li><a href="register.php">Login</a></li>-->
<!--                        <li><a href="register.php">Sign Up</a></li>-->
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>

<nav class="navbar navbar-expand-md navbar-light bg-light">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Upcoming Events</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">My Events</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Account</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

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
                <label for="user_login">
                    <i class="fas fa-user"></i>
                </label>
                <input type="text" name="user_login" placeholder="Username" value =
                "<?php
                if(isset($_SESSION['login_username'])){
                    echo $_SESSION['login_username'];
                } ?>" required>

                <label for="password">
                    <i class="fas fa-lock"></i>
                </label>
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
                <br>
                <a href="#" id="signin" class="signin">Already have an account? Click here</a>

            </form>
        </div>

    </div>
</div>
</body>
</html>

<?php
require 'footer.php';
$con->close();
?>
