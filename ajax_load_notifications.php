<?php
include 'config.php';
include 'User.php';
include 'Notification.php';

$limit = 5; // number of messages will be loaded

$notification = new Notification($con, $_REQUEST['userLogin']);
echo $notification->getNotifications($_REQUEST, $limit);