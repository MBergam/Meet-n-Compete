<?php
session_start();
include 'config.php';
include 'User.php';
include 'Post.php';
include 'Message.php';
include 'Notification.php';

////THIS IS THE DATABASE CREDENTIALS FOR WHOEVER USING PDO CONNECTING METHOD
$p_ini = parse_ini_file("config.ini",true);
$servername = $p_ini['Database']['servername'];
$username = $p_ini['Database']['username'];
$password = $p_ini['Database']['password'];
$database = $p_ini['Database']['database'];

$user = "";
$userLogin = "";
//THIS IS FOR LOGIN CHECK-KHANH's CODE
echo $_SESSION['username'];
if(isset($_SESSION['username'])){
    $userLogin = $_SESSION['username'];
    $user_detail_query = mysqli_query($con, "select * from users where user_name = '$userLogin'");
    $user = mysqli_fetch_array($user_detail_query);
    $logged_in_bool  = true;
}
else{
    header("Location: register.php");
}
//END OF LOGIN CHECK
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Meet-N-Compete</title>


    <!--    FONTS-->
    <link href="https://fonts.googleapis.com/css?family=Fjalla+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Rubik+Mono+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">


    <!--    CSS-->
    <!--    <link rel="stylesheet" href="css/dropdown.css" />-->
    <link rel="stylesheet" href="css/bootstrap.min.css" >
    <link rel="stylesheet" href="css/normalize.css" />
    <link rel="stylesheet" href="css/hover-min.css" />
    <link rel="stylesheet" href="css/animate.min.css" />
    <link rel="stylesheet" href="css/vendor/fontawesome-free-5.12.0-web/css/all.min.css" />
    <link rel="stylesheet" href="style.css" />
    <link href ="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
    <link rel="stylesheet" href="css/jquery.timepicker.css" />


    <!--    JAVASCRIPT-->
    <script src="js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="js/vendor/jquery-3.3.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="js/vendor/bootstrap.bundle.js"></script>
    <script src="js/vendor/parallax.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDcp7a_Sb-9QaDw_u_wp1esshBVYYbRhl4&libraries=places"></script>
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"> </script>
    <script src="//code.jquery.com/ui/1.11.3/jquery-ui.js"></script>
    <script src = "meetncompete.js" async defer> </script>
    <script src = "js/jquery.timepicker.min.js"> </script>
    <script src="js/vendor/bootbox.min.js"></script>

    <script src="js/mnc.js"></script>


</head>
<body>
<header>
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <a href=""><img id="logo" src="img/logo.png" alt=""></a>
            </div>
            <div class="col-sm-6">
                <div class="search">
                    <form action="search.php" method="get" name="search_form">
                        <input type="text" onkeyup="getLiveSearchUsers(this.value, '<?php echo $userLogin;?>')" name="q" placeholder="Search for friends..." autocomplete="off" id="search_text_input">
                        <div class="button_holder">
                            <img src="img/search--v2.png">
                            
                        </div>
                    </form>
                    <div class="search_result">

                    </div>
                    <div class="search_result_footer_empty">

                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div id="header-right" class="vertical-center">
                    <ul class = "nav-login">
                        <?php
                        if($logged_in_bool){
                            //un-read messages
                            $messages = new Message($con,$userLogin);
                            $num_messages = $messages->getUnreadNumber();
                            //un-read notifications
                            $notifications = new Notification($con,$userLogin);
                            $num_notifications = $notifications->getUnreadNumber();
                            //un-decided friend requests
                            $friend_requests = new User($con,$userLogin);
                            $num_friend_requests = $friend_requests->getNumberOfFriendRequests();

                            echo "<li><a href='$userLogin'>$userLogin</a></li>";
                            ?>
                            <li><a href='friendRequests.php'>
                                    <i class="fa fa-users fa-lg"></i>
                                    <?php
                                    if($num_friend_requests > 0)
                                        echo '<span class="notification_badge" id="undecided_request">'.$num_friend_requests.'</span>';
                                    ?>
                                </a></li>
                            <!--                                this is for the message-->
                            <li><a href="javascript:void(0);" onclick="getDropdownData('<?php echo $userLogin; ?>', 'message')"
                                <i class='fa fa-envelope fa-lg'></i>
                                <?php
                                if($num_messages > 0)
                                    echo '<span class="notification_badge" id="unread_message">'.$num_messages.'</span>';
                                ?>
                                </a></li>

                            <!--                                This is for the notification-->
                            <li><a href="javascript:void(0);" onclick="getDropdownData('<?php echo $userLogin; ?>', 'notification')"
                                <i class='fa fa-bell fa-lg'></i>
                                <?php
                                if($num_notifications > 0)
                                    echo '<span class="notification_badge" id="unread_notification"> '.$num_notifications.'</span>';
                                ?>
                                </a></li>
                            <?php
                            echo "<li><a href='Logout.php'>Logout</a></li>";
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

    <div class="dropdown_data_window" style="height: 0px; border: none">


    </div>
    <input type="hidden" id="dropdown_data_type" value="">
</header>

<script>

    $(function(){

        var userLogin = '<?php echo $userLogin; ?>';
        var dropdownInProgress = false;

        $(".dropdown_data_window").scroll(function() {
            var bottomElement = $(".dropdown_data_window a").last();
            var noMoreData = $('.dropdown_data_window').find('.noMoreDropdownData').val();

            // isElementInViewport uses getBoundingClientRect(), which requires the HTML DOM object, not the jQuery object. The jQuery equivalent is using [0] as shown below.
            if (isElementInView(bottomElement[0]) && noMoreData == 'false') {
                loadPosts();
            }
        });

        function loadPosts() {
            if(dropdownInProgress) { //If it is already in the process of loading some posts, just return
                return;
            }

            dropdownInProgress = true;

            var page = $('.dropdown_data_window').find('.nextPageDropdownData').val() || 1; //If .nextPage couldn't be found, it must not be on the page yet (it must be the first time loading posts), so use the value '1'

            var pageName; //Holds name of page to send ajax request to
            var type = $('#dropdown_data_type').val();

            if(type == 'notification')
                pageName = "ajax_load_notifications.php";
            else if(type == 'message')
                pageName = "ajax_load_messages.php";

            $.ajax({
                url: "" + pageName,
                type: "POST",
                data: "page=" + page + "&userLogin=" + userLogin,
                cache: false,

                success: function(response) {

                    $('.dropdown_data_window').find('.nextPageDropdownData').remove(); //Removes current .nextpage
                    $('.dropdown_data_window').find('.noMoreDropdownData').remove();

                    $(".dropdown_data_window").append(response);
                    dropdownInProgress = false;
                }
            });
        }

        //Check if the element is in view
        function isElementInView (el) {

            if(el == null) {
                return;
            }
            var rect = el.getBoundingClientRect();

            return (
                rect.top >= 0 &&
                rect.left >= 0 &&
                rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) && //* or $(window).height()
                rect.right <= (window.innerWidth || document.documentElement.clientWidth) //* or $(window).width()
            );
        }
    });

</script>

<nav class="navbar navbar-expand-md navbar-light bg-light">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="Logged.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="upcoming-events.php">Upcoming Events</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="my-events.php">My Events</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Account.php">News Feed</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
