<?php
// process_message.php

include("configuration.php");
session_start();

if (!isset($_SESSION['email'])) {
    header("location: index.php");
    exit();
}

$msg = $_POST['msg'];
$email = $_SESSION['email'];
$sql = mysqli_query($al, "SELECT * FROM users WHERE email='$email'");
$b = mysqli_fetch_array($sql);
$name = $b['nick'];
$date = date('d-M-Y');

if (!empty($msg)) {
    mysqli_query($al, "INSERT INTO box(sender,msg,date) VALUES('$name','$msg','$date')");
}

// Redirect back to box.php (the chat page)
header("location: box.php");
exit();
?>
