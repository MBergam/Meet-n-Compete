<?php
session_start();
session_destroy(); // Destroy all session
header("Location: index.php");
?>