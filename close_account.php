<?php
include 'header.php';

if(isset($_POST['close_account'])){
    $close_query = mysqli_query($con, "update users set user_closed = 'yes' where user_name = '$userLogin'");
    session_destroy();
    header("Location: register.php");
}

if(isset($_POST['cancel'])){
    header("Location: settings.php");
}

?>

<div class="main_column column">
    <h4>Close Account</h4>
    Are you sure to perform this action?
    Closing your account will hide your profile and all your activities from other users.<br><br>
    You can re-open your account by logiging in again.<br><br>

    <form action="close_account.php" method="post">
        <input type="submit" class="danger settings_submit" name="close_account" id="close_account" value="Yes! Close now.">
        <input type="submit" class="info settings_submit" name="cancel" id="update_details" value="No not now...">

    </form>

</div>


<?php
include "footer.php";