<?php
include("../config.php");

$url = 'https://api.sendgrid.com/';
 $user = 'azure_b3bf9e2e616acbdbf70787d4d712f06a@azure.com';
 $pass = 'Group35Email';
 
$to = $email_address;
$subject = "Auction Website: come take a look!";
$message = "
<html>
<head>
<title>New items have been added!</title>
</head>
<div style='font-family:arial, sans-serif; font-size:15px; color: #444; max-width:720px; margin:0 auto; line-height:120%'>
<p> Does this work? </p>
</div>
</html>
";

 $params = array(
      'api_user' => $user,
      'api_key' => $pass,
      'to' => $email_address,
      'subject' => $subject,
      'html' => $message,
      'text' => 'testing body',
      'from' => 'noreply@auction_website.com',
   );

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

?>