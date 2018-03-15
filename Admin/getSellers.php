<?php include '../config.php';

//sql statement needed here
$getBuyers = "SELECT email_address FROM users WHERE Seller_or_Buyer = 'Buyer'";
$result = mysqli_query($db, $getBuyers);
while ($row = mysqli_fetch_assoc($result)) {
    $email_address = $row["email_address"];
    include 'advertiseEmail.php';
}
