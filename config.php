<?php
$db = mysqli_init();
mysqli_ssl_set($db,NULL,NULL, "/var/www/html/BaltimoreCyberTrustRoot.crt.pem", NULL, NULL) ; 
mysqli_real_connect($db, 'compgc06group35db.mysql.database.azure.com', 'compgc06group35@compgc06group35db', 'Aakash123', 'auctionwebsite', 3306, MYSQLI_CLIENT_SSL, MYSQLI_CLIENT_SSL_DONT_VERIFY_SERVER_CERT);
if (mysqli_connect_errno($db)) {
die('Failed to connect to MySQL: '.mysqli_connect_error());
}
//require $_SESSION['userID'];
session_start();    
  if (!isset($_SESSION['userID'])) {
      echo "Accessed Denied!";
    header('../../Signin.php');
    exit(); // <-- terminates the current script
  }

?>