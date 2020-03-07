<?php
session_start();
include 'config.php';
if(isset($_SESSION['username'])){
     $userLogin = $_SESSION['username'];
     $user_detail_query = mysqli_query($con, "select * from users where user_name = '$userLogin'");
     $user = mysqli_fetch_array($user_detail_query);
     $logged_in_bool  = true;
}
else{
    header("Location: register.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Meet-N-Compete</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>


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
                         <?php
                            if($logged_in_bool){
                                echo "<li><a href='#'>$userLogin</a></li>";
                                echo "<li><a href='index.php'>Logout</a></li>";
//                                echo "<input type='submit' name='logout_button' value='Logout'>";
                            }
                            else{
                                echo "<li><a href='register.php'>Login</a></li>";
                            }
                          ?>
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
                        <a class="nav-link" href="Logged.php">Home <span class="sr-only">(current)</span></a>
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