<?php include '../config.php';

//sql statement needed here
$getUsers = "SELECT Seller_or_Buyer, fullName, email_address FROM users";
$result = mysqli_query($db, $getUsers);
while ($row = mysqli_fetch_assoc($result)) {
    $role = $row["Seller_or_Buyers"];
    $fullName = $row["fullName"];
    $email_address = $row["email_address"];

    if ($role == "Seller") {
        include 'advertiseSeller.php';
    }

    else if ($role == "Buyer") {
        include 'advertiseBuyer.php';
    }
}
