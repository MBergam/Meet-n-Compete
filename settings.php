<?php
include 'header.php';
include 'settings_handler.php';

if(!$logged_in_bool){
    header("Location: register.php");
}
?>

<div class="main_column column">
    <h4>Account Settings</h4>
    <?php
    echo "<img src='".$user['profile_picture']."' id ='small_profile_pic'>";
    ?>
    <br>
    <a href="upload.php">Change profile picture</a>
    <br><br><br>

    Modify the values and click "Update Details"
    <?php
        $user_data_query = mysqli_query($con, "select first_name,last_name,email from users where user_name = '$userLogin'");
        $row = mysqli_fetch_array($user_data_query);

        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $email = $row['email'];
    ?>
    <form   action="settings.php" method="post">
        First Name: <input type="text" name="first_name" value="<?php echo $first_name;?>" id="settings_input"><br>
        Last Name: <input type="text" name="last_name" value="<?php echo $last_name;?>" id="settings_input"><br>
        Email: <input type="text" name="email" value="<?php echo $email;?>" id="settings_input"><br>

        <?php echo $message;?>
        <input type="submit" class="info settings_submit" name="update_details" id="save_details" value="Save Details">

    </form>
    <br>
    <h4>Change Password</h4>
    <form   action="settings.php" method="post">
        Old Password: <input type="password" name="old_password" id="settings_input"><br>
        New Password: <input type="password" name="new_password_1" id="settings_input"><br>
        Confirm Password: <input type="password" name="new_password_2" id="settings_input"><br>
        <?php echo $password_message; ?>
        <input type="submit" class="info settings_submit" name="update_password" id="save_password" value="Change Password">

    </form>
    <br>
    <h4>Close Account</h4>
    <form action="close_account.php" method="post">
        <input type="submit" class="danger settings_submit" name="close_account" id="close_account" value="Close Account">
    </form>
</div>




<?php
include 'footer.php';