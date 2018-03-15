<?php
include("../config.php");

$url = 'https://api.sendgrid.com/';
 $user = 'azure_b3bf9e2e616acbdbf70787d4d712f06a@azure.com';
 $pass = 'Group35Email';

$itemsArray = array();
$getNewItems = "SELECT prod_name, prod_description, prod_start_price, prod_picture FROM product ORDER BY prod_id DESC LIMIT 3";
$result = mysqli_query($db, $getNewItems);
while ($row = mysqli_fetch_assoc($result)) {
    $itemsArray[] = $row;
}

$to = $email_address;
$subject = "Auction Website: come take a look!";
$message = "
<html>
<head>
<title>New items have been added!</title>
</head>
<div style='font-family:arial, sans-serif; font-size:15px; color: #444; max-width:720px; margin:0 auto; line-height:120%'>
<p>Dear $fullName,<p>

<p>New items have been added to the site!</p>

<img style='width: 20vw; height: 20vw;' src='data:image/jpeg;base64,'.base64_encode($itemsArray[0]['prod_picture']).'>
<p>$itemsArray[0]['prod_name']</p>
<p>$itemsArray[0]['prod_description']</p>
<p>Starting price: $itemsArray[0]['prod_start_price']</p>

<img style='width: 20vw; height: 20vw;' src='data:image/jpeg;base64,'.base64_encode($itemsArray[1]['prod_picture']).'>
<p>$itemsArray[1]['prod_name']</p>
<p>$itemsArray[1]['prod_description']</p>
<p>Starting price: $itemsArray[1]['prod_start_price']</p>

<img style='width: 20vw; height: 20vw;' src='data:image/jpeg;base64,'.base64_encode($itemsArray[2]['prod_picture']).'>
<p>$itemsArray[2]['prod_name']</p>
<p>$itemsArray[2]['prod_description']</p>
<p>Starting price: $itemsArray[2]['prod_start_price']</p>

<p>Please <a href='https://compgc06group35.azurewebsites.net'>click here</a> to take a look.</p>

Good luck and happy bidding!
</p>
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