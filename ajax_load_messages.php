<?php
include 'config.php';
include 'User.php';
include 'Message.php';

$limit = 20; // number of messages will be loaded

$message = new Message($con, $_REQUEST['userLogin']);
echo $message->getConvosDropdown($_REQUEST, $limit);