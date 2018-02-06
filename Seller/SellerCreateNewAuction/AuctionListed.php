<?php
require 'connectionection.php';
$connection    = connectionect();
$name    = $connection->real_escape_string($_POST['u_name']);
$email   = $connection->real_escape_string($_POST['u_email']);
$subj    = $connection->real_escape_string($_POST['subj']);
$message = $connection->real_escape_string($_POST['message']);
$query   = "INSERT into product (u_name,u_email,subj,message) VALUES('" . $name . "','" . $email . "','" . $subj . "','" . $message . "')";
$success = $connection->query($query);
 
if (!$success) {
    die("Couldn't enter data: ".$connection->error);
 
}


 
$connection->close();
?>