<?php
// function Connect(){
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "auctionwebsitetest";

$connection = mysqli_connect($servername,$username,$password,$dbname) 
                or die('Error connecting to MySQL server.'. mysql_error());


//     return $connection;
// }
?>