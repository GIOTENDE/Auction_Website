<?php
include("config.php");

$to = $email_address;
$subject = "Welcome to Auction Website";

$message = "
<html>
<head>
<title>Welcome to our Auction Website</title>
</head>

<body>
<div style='font-family:arial, sans-serif; font-size:15px; color: #444; max-width:720px; margin:0 auto; line-height:120%'>

<p>Thank you for submitting your completed application.</p>
<p>Account Details</p>
<p>
Full Name: <?php echo $fullname ?> <br>
Username: <?php echo $username ?> <br>
Email: <?php echo $email_address ?> <br>
Mobile Number: <?php echo $mobilenumber ?> <br>
Role: <?php echo $Seller_or_Buyer ?> <br>

</p>
</div>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <noreply@auction_webste.com>' . "\r\n";
//$headers .= 'Cc: myboss@example.com' . "\r\n";

mail($to,$subject,$message,$headers);
?>