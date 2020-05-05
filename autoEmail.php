<?php
$to = "somebody@example.com";
$subject = "My subject";
$body = "This is the body of your email...";
$headers = "From: Meet-N-Compete@meetncompete.com" . "\n";

//auto send an email to the creator event when there is a user join to his event
if(!empty($_SESSION['jointEvent']))
{
    $to = $_SESSION["user_email"];
    $body = 'Meet-N-Compete

    
    '. $_SESSION["username"] .' has joined your event '. $_SESSION["event_name"] .'';
}
//auto send an email to the creator event when there is a user cancel the event that he joined before
if(!empty($_SESSION['cancelEvent']))
{
    $to = $_SESSION["user_email"];
    $body = 'Meet-N-Compete

    
    '. $_SESSION["username"] .' has canceled your event '. $_SESSION["event_name"] .'';
}
//auto send an email to the all members' event when the creator edit that event
if(!empty($_SESSION['editEvent']))
{
    foreach($_SESSION['editEvent'] as $keys => $values)
    {
        $to = $values["user_email"];
        $body = 'Meet-N-Compete

    
        '. $values["event_name"] .' was edited';
    }
}
//auto send an email to the all members' event when the creator delete that event
if(!empty($_SESSION['deleteEvent']))
{
    foreach($_SESSION['deleteEvent'] as $keys => $values)
    {
        $to = $values["user_email"];
        $body = 'Meet-N-Compete

    
        '. $values["event_name"] .' was deleted';
    }
}
mail($to, $subject, $body, $headers);
?> 


