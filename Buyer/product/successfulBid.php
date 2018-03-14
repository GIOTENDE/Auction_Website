<?php include '../../config.php';

$getOutbidUser = "SELECT users.userID, users.fullName, users.email_address, product.prod_name, product.prod_buyerID FROM users INNER JOIN product ON users.userID = product.prod_buyerID WHERE product.prod_id = '" . $_POST['prod_ID'] . "' ;";
$result = mysqli_query($db, $getOutbidUser);
while ($row = mysqli_fetch_assoc($result)) {
    $fullName = $row["fullName"];
    $email_address = $row["email_address"];
    $name = $row["prod_name"];
    include 'outbidEmail.php';
}

//insert into bids table
$seller_ID = 26; //delete this column from table?

$insertBid = "INSERT INTO bids (prod_id, buyer_id, seller_id, amount) VALUES ('" . $_POST['prod_ID'] . "', '" . $_POST['buyer_ID'] . "', '26', '" . $_POST['amount'] . "')";
mysqli_query($db, $insertBid);

//update product table
$updateProduct = "UPDATE product SET prod_highest_bid = '" . $_POST['amount'] . "', prod_buyerID = '" . $_POST['buyer_ID'] . "' WHERE prod_id = '" . $_POST['prod_ID'] . "' ";
mysqli_query($db, $updateProduct);