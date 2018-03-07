<?php
include("config.php");

$url = 'https://api.sendgrid.com/';
 $user = 'azure_b3bf9e2e616acbdbf70787d4d712f06a@azure.com';
 $pass = 'Group35Email';

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
// $headers = "MIME-Version: 1.0" . "\r\n";
// $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// // More headers
// $headers .= 'From: <noreply@auction_website.com>' . "\r\n";
//$headers .= 'Cc: myboss@example.com' . "\r\n";

//mail($to,$subject,$message,$headers);

 $params = array(
      'api_user' => $user,
      'api_key' => $pass,
      'to' => $email_address,
      'subject' => $subject,
      'html' => $message,
      'text' => 'testing body',
      'from' => 'noreply@auction_website.com',
   );
echo $email_address;
 $request = $url.'api/mail.send.json';

 // Generate curl request
 $session = curl_init($request);

 // Tell curl to use HTTP POST
 curl_setopt ($session, CURLOPT_POST, true);

 // Tell curl that this is the body of the POST
 curl_setopt ($session, CURLOPT_POSTFIELDS, $params);

 // Tell curl not to return headers, but do return the response
 curl_setopt($session, CURLOPT_HEADER, false);
 curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

 // obtain response
 $response = curl_exec($session);
 curl_close($session);

 // print everything out
 print_r($response);

echo "DONE";
?>